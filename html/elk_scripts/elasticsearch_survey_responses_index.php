<?php

require_once (__DIR__.'/../../vendor/autoload.php');
session_start();

use Elasticsearch\ClientBuilder;
use Neptune\{Config};

// For grades creating from existing data
$es_username = 'rneptune';
$es_passwd = 'nikagomi';

$client = ClientBuilder::create()->setHosts(["http://".Config::$ELASTICSEARCH_HOST.":".Config::$ELASTICSEARCH_PORT])->setBasicAuthentication($es_username, $es_passwd)->build(); 

$sqrs = (new Survey\Model\SurveyQuestionResponse())->getAll();

$params = ['body' => []];
foreach ($sqrs as $sqr) {
            //Now for elasticsearch stuff
            $params['body'][] = [
                'index' => [
                    '_index' => 'survey_responses',
                    '_id' => $sqr->getId()
                    ]
            ];

            $params['body'][] = [
                'survey year' => $sqr->getSurvey()->getYear(),
                'survey title' => $sqr->getSurvey()->getTitle(),
                'question' => $sqr->getQuestion()->getQuestionText(),
                'response' => $sqr->getResponse(),
                'indicator' => $sqr->getQuestion()->getIndicatorList(),
                'question type' => $sqr->getQuestion()->getQuestionType()->getLabel(),
            ];
}

// Send the last batch if it exists
if (!empty($params['body'])) {
     $client->bulk($params);
}

