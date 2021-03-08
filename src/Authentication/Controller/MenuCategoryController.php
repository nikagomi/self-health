<?php

namespace Authentication\Controller;
use Neptune\{BaseController,MessageResources};
use Symfony\Component\HttpFoundation\Response;

/**
 * MenuCategoryController
 * @package smart
 * @author nikagomi
 */
class MenuCategoryController extends BaseController {
    
    public function getSubmenus ($categoryId) {
        $objArr = (new \Authentication\Model\EduPermission())->getObjectsByMultipleCriteria(["categoryId","isContainer"], [$categoryId, true], true);
        $result = [];
        $i = 0;
        foreach ($objArr as $obj) {
            $result[$i] = ["id" => $obj->getId(), "label" => MessageResources::i18n($obj->getSubmenuNameKey())];
            $i++;
        }
        $response = new Response(json_encode($result));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
}
