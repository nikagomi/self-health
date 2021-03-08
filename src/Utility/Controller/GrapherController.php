<?php


namespace Utility\Controller;
use Neptune\BaseController;
use Symfony\Component\HttpFoundation\Response;

/**
 * Description of GrapherController
 * @author Randal Neptune
 */

class GrapherController extends BaseController{
    
    
    public function getSubjectHistoryGraphData($studentId, $subjectId, $type){
        $result = (new \Utility\Model\Grapher())->getSubjectHistoryGraphData($studentId, $subjectId, $type);
        $data = json_encode($result);
        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
    
    public function getTermSubjectPerformanceData($studentId, $termSemesterId, $academicYearClassGroupId, $gradeType){
        $result = (new \Utility\Model\Grapher())->studentAcademicPeriodSubjectGrades($studentId, $termSemesterId, $academicYearClassGroupId, $gradeType);
        $data = json_encode($result);
        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
    
    
    public function subjectGradeDistribution($subjectId, $termSemesterId, $academicYearClassGroupId){
        $result = (new \Utility\Model\Grapher())->subjectGradeDistribution($subjectId, $termSemesterId, $academicYearClassGroupId);
        $data = json_encode($result);
        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
    
    public function studentAttendanceSummaryChart($studentId, $termSemesterId, $academicYearClassGroupId) {
        $result = (new \Utility\Model\Grapher())->studentAttendanceChart($studentId, $termSemesterId, $academicYearClassGroupId);
        $data = json_encode($result);
        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
    
    public function getGradedAssessmentHistoryGraphData($studentId, $subjectId, $administeredDate){
        $result = (new \Utility\Model\Grapher())->getGradedAssessmentHistory ($studentId, $subjectId, $administeredDate);
        $data = json_encode($result);
        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
}
