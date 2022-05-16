<?php

use Symfony\Component\DependencyInjection;
use Symfony\Component\DependencyInjection\Reference;


$sc = new DependencyInjection\ContainerBuilder();

$sc->setParameter('port', 465);
$sc->setParameter('mail.server', \gethostbyname('smtp_server_name_or_address'));
$sc->setParameter('mail.encryption','ssl');
$sc->setParameter('mail.user', '[email_address]');
$sc->setParameter('mail.password', '[email_password]');
$sc->setParameter('ssl.stream', ['ssl' => [
    'allow_self_signed' => true,
    'verify_peer' => false,
    'verify_peer_name' => false,
]]);
        
$sc->setParameter("routes", include __DIR__.'/routes.php');

$sc->register('context','Symfony\Component\Routing\RequestContext');

$sc->register('stack','Symfony\Component\HttpFoundation\RequestStack');

$sc->register('matcher','Symfony\Component\Routing\Matcher\UrlMatcher')
   ->setArguments(array('%routes%', new Reference('context')));

$sc->register('resolver','Symfony\Component\HttpKernel\Controller\ControllerResolver');

$sc->register('listener.router','Symfony\Component\HttpKernel\EventListener\RouterListener')
   ->setArguments(array(new Reference('matcher'), new Reference('stack'))); //Stack is not needed for symfony <=2.8

$sc->register('listener.exception','Symfony\Component\HttpKernel\EventListener\ExceptionListener')
   ->setArguments(array("\Error\Controller\ErrorController::error404"));

//Specific Event Listeners
$sc->register('kernel.request','Neptune\Listener\AccessControlListener');
$sc->register('listener.mailer','Neptune\Listener\MailerListener');
$sc->register('listener.notify','Neptune\Listener\NotificationListener');
   
$sc->register('event.dispatcher','Symfony\Component\EventDispatcher\EventDispatcher')
   ->addMethodCall('addSubscriber', array(new Reference('listener.router')))
   ->addMethodCall('addSubscriber', array(new Reference('listener.exception')))
   ->addMethodCall('addSubscriber', array(new Reference('kernel.request')))
   ->addMethodCall('addSubscriber', array(new Reference('listener.mailer')))
   ->addMethodCall('addSubscriber', array(new Reference('listener.notify')));

$sc->register('framework','Neptune\Framework')
    ->setArguments(array(new Reference('event.dispatcher'), new Reference('resolver')));

/* Mailer functionality */ 
$sc->register('mail.transport','\Swift_SmtpTransport')
    ->setArguments(array('%mail.server%', '%port%','%mail.encryption%')) // Add '%mail.encryption%' for ssl
    ->addMethodCall('setUsername', array('%mail.user%'))
    ->addMethodCall('setPassword', array('%mail.password%'))
    ->addMethodCall('setStreamOptions', array('%ssl.stream%'));

$sc->register('mailer','Utility\Model\Mailer')->addArgument(new Reference('mail.transport'));

return $sc;
