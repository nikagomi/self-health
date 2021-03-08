<?php

namespace Survey\Controller;

use Neptune\BaseController;
use Symfony\Component\HttpFoundation\{Response, Request};

/**
 * Description of VisualizationController
 * @package oecs
 * @author nikagomi
 */
class VisualizationController extends BaseController {
    
   
    
    private function generateYears ($startYear = 2016) {
        $years = [];
        $years[''] = '';
        for($i = (\date("Y")+2); $i >= $startYear; $i--) {
            $years[$i] = $i;
        }
        $this->_oecs->assign("years", $years);
        
    }
    
    public function vizLikertHeatmapForm () {
        $this->generateYears();
        $this->_oecs->assign("selectedYear", \date("Y"));
         $this->_oecs->assign("year", \date("Y"));
        $this->_oecs->assign("actionPage", "/viz/likert/heatmap");
        $this->_oecs->assign("title", "Likert Heatmap");
        return new Response($this->_oecs->display("survey/visualization/likertHM.tpl"));
    }
    
    public function vizLikertHeatmap (Request $request) {
        $this->generateYears();
        $this->_oecs->assign("actionPage", "/viz/likert/heatmap");
        $this->_oecs->assign("title", "Likert Heatmap");
        $this->_oecs->assign("year", $request->request->get("year"));
        $this->_oecs->assign("selectedYear", $request->request->get("year"));
        return new Response($this->_oecs->display("survey/visualization/likertHM.tpl"));
    }
    
    public function vizIndicatorLikertHeatmapForm () {
        $this->generateYears();
        $this->_oecs->assign("selectedYear", \date("Y"));
         $this->_oecs->assign("year", \date("Y"));
        $this->_oecs->assign("actionPage", "/viz/indicator/likert/heatmap");
        $this->_oecs->assign("title", "Indicator Likert Heatmap");
        return new Response($this->_oecs->display("survey/visualization/indicatorLikertHM.tpl"));
    }
    
    public function vizIndicatorLikertHeatmap (Request $request) {
        $this->generateYears();
        $this->_oecs->assign("actionPage", "/viz/indicator/likert/heatmap");
        $this->_oecs->assign("title", "Indicator Likert Heatmap");
        $this->_oecs->assign("year", $request->request->get("year"));
        $this->_oecs->assign("selectedYear", $request->request->get("year"));
        return new Response($this->_oecs->display("survey/visualization/indicatorLikertHM.tpl"));
    }
    
}
