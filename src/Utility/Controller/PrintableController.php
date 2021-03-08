<?php

namespace Utility\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Neptune\{DbMapperUtility,EduPropertyService};
use Utility\Model\AcademicPositioner;

/**
 * Description of PrintableController
 * @package sarms
 * @author Randal Neptune
 */
class PrintableController extends \Neptune\BaseController{
    protected $modelClass = "\Utility\Model\EduStudentTermGradeSummaryPrintable";
    
    public function printTermSummaryForm(Request $request, $ayClassGroupId, $termSemesterId, $studentId, $displayType){
        $printable = NULL;
        $now = \date("Y-m-d H:i:s");
        $ayClassGroup = (new \Academic\Model\EduAcademicYearClassGroup())->getObjectById($ayClassGroupId);
        $gPref = (new \Admin\Model\EduFacilityGradingPreference())->getByAcademicYearAndFacility($ayClassGroup->getAcademicYearId(), $ayClassGroup->getFacilityId());
        
        $checkPrintable = (new \Utility\Model\EduStudentTermGradeSummaryPrintable())->getByClassGroupTermSemesterStudent($ayClassGroupId, $termSemesterId, $studentId);
        //$studentSubjects = (new \Academic\Model\EduClassGroupStudentSubject())->getSubjectsByClassGroupStudentAcademicPeriod($ayClassGroupId, $termSemesterId, $studentId);
        //$subjs = (\count($studentSubjects) > 0) ? $studentSubjects : (new \Academic\Model\EduClassGroupSubject())->getSubjectsByAcademicYearClassGroup($ayClassGroupId);
        $subjs = (new \Academic\Model\EduClassGroupSubject())->getSubjectsByAcademicYearClassGroup($ayClassGroupId);
        
        if ($checkPrintable->getId() == ''){//does not yet exist, create one then.
            //Is there a default signatory?
            $signatories = (new \Academic\Model\EduGradeReportSignatory())->getByFacilityAndDivision($ayClassGroup->getFacilityId(), $ayClassGroup->getClassGroup()->getFacilityDivisionId());
             
            
            $obj = new \Utility\Model\EduStudentTermGradeSummaryPrintable();
            $obj->setAcademicYearClassGroupId($ayClassGroupId);
            $obj->setTermSemesterId($termSemesterId);
            $obj->setStudentId($studentId);
            $obj->setModifiedById($_SESSION['userId']);
            $obj->setModifiedTime(\date("Y-m-d H:i:s"));
            $obj->setCreatedById($_SESSION['userId']);
            $obj->setComments("");
            
            $signatoryId = (\count($signatories) == 1) ? $signatories[0]->getId() : 'null';
            $obj->setGradeReportSignatoryId($signatoryId);
            
            $obj->save();
            if($obj->getOpStatus()){
                //Here determine and update subject teachers
                /*$sql = "";
                $now = \date("Y-m-d H:i:s");
                foreach ($subjects as $subject) {
                    $subTeacher = (new \Utility\Model\EduStudentTermGradeSummaryPrintable())->determineGradeReportSubjectTeacher($studentId, $ayClassGroupId, $termSemesterId, $subject->getId());
                    if (!$subTeacher->isIdEmpty()) {//A teacher was returned for the subject
                        $gradeReportTeacher = (new \Academic\Model\EduFinalGradeSubjectTeacher());
                        $gradeReportTeacher->setAcademicYearClassGroupId($ayClassGroupId);
                        $gradeReportTeacher->setTermSemesterId($termSemesterId);
                        $gradeReportTeacher->setSubjectId($subject->getId());
                        $gradeReportTeacher->setStudentId($studentId);
                        $gradeReportTeacher->setTeacherId($subTeacher->getId());
                        $gradeReportTeacher->setCreatedById($_SESSION['userId']);
                        $gradeReportTeacher->setModifiedById($_SESSION['userId']);
                        $gradeReportTeacher->setModifiedTime($now);
                        $sql .= $gradeReportTeacher->generateSaveSql();
                    }
                }*/
                $printable = $obj;
                //$obj->dbQuery($sql);
                $obj->saveHistory();
            }else{
                $this->_edu->assign("msg","Could not show detailed summary");
                return new RedirectResponse("/classgroup/grade/summary/term/view/".$ayClassGroupId."/".$termSemesterId);
            }
        }else{
            $printable = $checkPrintable;
            $checkPrintable->updateHistory();
        }
        //Update subject teachers each time we come here after printable has been worked on
        $sql = "";
        $subjects = [];
        foreach ($subjs as $subject) {
            $usesLetterGrade = (new \Academic\Model\EduLetterGradeSubject())->subjectUsesLetterGrades($ayClassGroupId, $termSemesterId, $subject->getId());
            $hasGrade = (new \Academic\Model\EduClassGroupTermSemesterSubjectGradeActivityGrade())->studentHasGradesForSubjectInClassGroup($studentId, $ayClassGroupId, $subject->getId(), $termSemesterId);
            if  (($hasGrade && !$usesLetterGrade) || 
                 ($usesLetterGrade && (new \Academic\Model\EduFinalGradeRemark())->getByParameters($ayClassGroupId, $termSemesterId, $subject->getId(), $studentId)->getLetterGrade() != '')
                 || ($gPref->hasFinalGrade() && !$gPref->showFinalGradeWithLastPeriodExam())) {
                    
                \array_push($subjects, $subject);
                $subTeacher = (new \Utility\Model\EduStudentTermGradeSummaryPrintable())->determineGradeReportSubjectTeacher($studentId, $ayClassGroupId, $termSemesterId, $subject->getId());
                if (!$subTeacher->isIdEmpty()) {//A teacher was returned for the subject
                    $gradeReportTeacher = (new \Academic\Model\EduFinalGradeSubjectTeacher());
                    $gradeReportTeacher->setAcademicYearClassGroupId($ayClassGroupId);
                    $gradeReportTeacher->setTermSemesterId($termSemesterId);
                    $gradeReportTeacher->setSubjectId($subject->getId());
                    $gradeReportTeacher->setStudentId($studentId);
                    $gradeReportTeacher->setTeacherId($subTeacher->getId());
                    $gradeReportTeacher->setCreatedById($_SESSION['userId']);
                    $gradeReportTeacher->setModifiedById($_SESSION['userId']);
                    $gradeReportTeacher->setModifiedTime($now);
                    $sql .= $gradeReportTeacher->generateSaveSql();
                }
            }
        }
        DbMapperUtility::dbQuery("BEGIN TRANSACTION; " .$sql. " COMMIT;");
        
        //Now onto other aspects of processing the printable object.
        $gradeDisplay = ($displayType == "" || !in_array(\strtoupper($displayType), DbMapperUtility::gradeDisplayTypes())) ? EduPropertyService::getProperty("default.grade.display.type","numeric") : \strtoupper($displayType);
        
        $termSemester = (new \Academic\Model\EduTermSemester())->getObjectById($termSemesterId);
        $rankFunction = AcademicPositioner::getRankFunction($ayClassGroupId);
        $lastTermSemester = (new \Academic\Model\EduTermSemester())->getLastTermSemesterInAcademicYear($ayClassGroup->getAcademicYearId());
        
        $this->_edu->assign("coordinator", new \Academic\Model\EduAcademicYearGradeLevelCoordinator());
        $this->_edu->assign("gradeReportSuffix", (new \Admin\Model\EduStudentGradeReportFacilitySuffix())->getByFacility($ayClassGroup->getFacilityId()));
        $this->_edu->assign("headTeacher", (new \Admin\Model\EduFacilityHeadTeacher())->getCurrentHeadTeacherByFacility($ayClassGroup->getFacilityId()));
        
        $this->_edu->assign("printable",$printable);
        $this->_edu->assign("lastTermSemester",$lastTermSemester);
        $this->_edu->assign('guardians',(new \Student\Model\EduLegalGuardian())->getGuardiansByStudentId($printable->getStudentId()));
        $this->_edu->assign("gradePref", (new \Admin\Model\EduFacilityGradingPreference())->getByAcademicYearAndFacility($ayClassGroup->getAcademicYearId(), $ayClassGroup->getFacilityId()));
        $this->_edu->assign("periodAttendance", (new \Academic\Model\EduDailyStudentAttendanceRecord())->getStudentAttendanceSummary($studentId, $termSemester, $ayClassGroup));
        
        $this->_edu->assign("ayClassGroup", $ayClassGroup);
        $this->_edu->assign("termSemester", $termSemester);
        $this->_edu->assign("student",(new \Student\Model\EduStudent())->getEntityById($studentId));
        
        
        $this->_edu->assign('subjects', $subjects);
        
        $this->_edu->assign("subjectTeacher", new \Academic\Model\EduClassGroupSubjectTeacherAssignment());
        $this->_edu->assign("letterSubjectGrade", new \Academic\Model\EduLetterGradeSubject());
        $this->_edu->assign("finalGradeSubjectTeacher", new \Academic\Model\EduFinalGradeSubjectTeacher());
        $this->_edu->assign('html',$this->html);
        $this->_edu->assign('title','Student Term Grade Summary');
        
        $this->_edu->assign("numStudents",\count((new \Student\Model\EduStudentClassGroupAssignment())->getStudentsByAcademicYearClassGroup($ayClassGroupId)));
        //$this->_edu->assign("highestGrades", (new \Academic\Model\EduClassGroupTermSemesterSubjectGradeActivityGrade())->getHighestTermSubjectGrades($ayClassGroupId, $termSemesterId, $displayType));
        
        $this->_edu->assign("studentAcademicPeriodGrades", (new \Academic\Model\EduClassGroupTermSemesterSubjectGradeActivityGrade())->getStudentAcademicPeriodGrades($studentId, $ayClassGroupId, $termSemesterId, $displayType));
        $this->_edu->assign("currentUsr",(new \Authentication\Model\EduUser())->getObjectById($_SESSION['userId']));
        $this->_edu->assign("onlyCompleteGrades", filter_var(\Neptune\EduPropertyService::getProperty("ext.user.show.only.completed.grade", true), FILTER_VALIDATE_BOOLEAN));
        
        $this->_edu->assign("requestUri",  DbMapperUtility::reconstructUri($request->getRequestUri()));
        $this->_edu->assign("rank",  AcademicPositioner::$rankFunction([],$ayClassGroupId, $termSemesterId, $gradeDisplay));
        
        
        $this->_edu->assign("passGrade",  \Neptune\EduPropertyService::getProperty("term.pass.grade"));
        $this->_edu->assign("isCurrentAssignment",(new \Student\Model\EduStudentSchoolAssignment())->isCurrentAssignment($printable->getStudentId(),$_SESSION['facilityId']));
        $this->_edu->assign("isHomeroomTeacher",$printable->getAcademicYearClassGroup()->isHomeroomTeacherByTermSemester($_SESSION['userId'], $termSemesterId));
        $this->_edu->assign("prmManager",new \Authentication\Model\EduPermissionManager());
        $this->_edu->assign("privilegeEnforced",  \Neptune\EduPropertyService::getProperty("enforce.homeroom.teacher.privilege"));
        $this->_edu->assign("finalGradeRemark", new \Academic\Model\EduFinalGradeRemark());
        $this->_edu->assign("histories", (new \Utility\Model\EduStudentTermGradeSummaryPrintableHistory())->getByPrintableId($printable->getId()));
        
        $this->_edu->assign("gradeDisplay", \strtoupper($gradeDisplay));
        $this->_edu->assign("yearCoordinators", (new \Academic\Model\EduAcademicYearGradeLevelCoordinator())->getByFacilityAcademicYearGradeLevel($ayClassGroup->getFacilityId(), $ayClassGroup->getAcademicYearId(), $ayClassGroup->getClassGroup()->getGradeLevelId()));
        $this->_edu->assign("coordinatorSignatory", (new \Academic\Model\EduPrintableCoordinatorSignatory())->getByPrintable($printable->getId()));
        $this->_edu->assign("signatories", (new \Academic\Model\EduGradeReportSignatory())->getSignatoryDropDown($ayClassGroup->getFacilityId(), $ayClassGroup->getClassGroup()->getFacilityDivisionId()));
        
        //Get all students in the class
        $students = \Student\Model\EduStudent::complexSort((new \Student\Model\EduStudentClassGroupAssignment())->getStudentsByAcademicYearClassGroup($ayClassGroupId, $termSemesterId));
        $idArr = DbMapperUtility::objectArrayToIdArray($students);
        
        $this->_edu->assign("scroller", DbMapperUtility::getScrollingNextPreviousElements($idArr, $studentId));
        
        return new Response($this->_edu->display('utility/print/studentGradeSummary.tpl'));
    }
    
    public function updateTermSummaryComments(Request $request){
        $obj = (new $this->modelClass())->getEntityById($request->request->get("id"));
        $obj->setComments($request->request->get("comments"));
        
        $obj->setModifiedById($_SESSION['userId']);
        $obj->setModifiedTime(date("Y-m-d H:i:s"));
        //Deal with html coordinator remarks
        $coorRemarks = \html_entity_decode($obj->getCoordinatorRemarks());
        $obj->setCoordinatorRemarks($coorRemarks);
        
        $htRemarks = \html_entity_decode($obj->getHeadTeacherRemarks());
        $obj->setHeadTeacherRemarks ($htRemarks);
        
        $obj->updateIncludeEmptyFields();
        
        $responseArr = array();
        $responseArr['status'] = $obj->getOpStatus();
        $responseArr['comments'] = $obj->getComments();
        $response = new Response(json_encode($responseArr));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
    
    public function updateHeadTeacherSummaryRemarks(Request $request){
        $obj = (new $this->modelClass())->getEntityById($request->request->get("id"));
        $obj->setHeadTeacherRemarks($request->request->get("headTeacherRemarks"));
        $obj->setModifiedById($_SESSION['userId']);
        $obj->setModifiedTime(date("Y-m-d H:i:s"));
        
        
        $comments = \html_entity_decode($obj->getComments());
        $obj->setComments($comments);
        
        //Deal with html coordinator remarks
        $coorRemarks = \html_entity_decode($obj->getCoordinatorRemarks());
        $obj->setCoordinatorRemarks($coorRemarks);
        
        $obj->updateIncludeEmptyFields();
        
        $responseArr = array();
        $responseArr['status'] = $obj->getOpStatus();
        $responseArr['comments'] = $obj->getHeadTeacherRemarks();
        $response = new Response(json_encode($responseArr));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
    
    public function updateTermSummaryCoordinatorRemarks(Request $request){
        $responseArr = array();
        $obj = (new $this->modelClass())->getEntityById($request->request->get("id"));
        $obj->setCoordinatorRemarks($request->request->get("remarks"));
        $obj->setModifiedById($_SESSION['userId']);
        
        $obj->setModifiedTime(date("Y-m-d H:i:s"));
        //Deal with html homeroom teacher comments
        $comments = \html_entity_decode($obj->getComments());
        $obj->setComments($comments);
        
        $htRemarks = \html_entity_decode($obj->getHeadTeacherRemarks());
        $obj->setHeadTeacherRemarks ($htRemarks);
        
        $obj->updateIncludeEmptyFields();
        
        if($obj->getOpstatus()) {
            //For year head signatory if exists
            if (EduPropertyService::getBoolean("has.academic.year.grade.level.coordinator")) {
                $signatory = (new \Academic\Model\EduPrintableCoordinatorSignatory())->getByPrintable($obj->getId());
                if ($signatory->isIdEmpty() && $request->request->get("remarks") != '') {//new entry
                    //check to see if the user is a coordinator
                    if ($request->request->get("coordinatorId") != '') {
                        $coordinator = (new \Academic\Model\EduAcademicYearGradeLevelCoordinator())->getObjectById($request->request->get("coordinatorId"));
                        $signatory->setId('');
                        $signatory->setCoordinatorId($coordinator->getId());
                        $signatory->setPrintableId($obj->getId());
                    } else {
                        $coordinators = (new \Academic\Model\EduAcademicYearGradeLevelCoordinator())->getByFacilityAcademicYearGradeLevel($obj->getAcademicYearClassGroup()->getFacilityId(), $obj->getAcademicYearClassGroup()->getAcademicYearId(), $obj->getAcademicYearClassGroup()->getClassGroup()->getGradeLevelId());
                        foreach ($coordinators as $coordinator) {
                            if ($coordinator->getTeacher()->getUserId() == $_SESSION['userId']) {
                                //save a signatory entity
                                $signatory->setId('');
                                $signatory->setCoordinatorId($coordinator->getId());
                                $signatory->setPrintableId($obj->getId());
                                break;
                            }
                        }
                    }
                    $signatory->pushObjectToDB();
                    $responseArr['coordId'] = $coordinator->getId();
                    $responseArr['coordName'] = $coordinator->getTeacher()->getLabel();
                }  elseif (!$signatory->isIdEmpty() && $request->request->get("remarks") == '') {
                    $signatory->setCoordinatorId(NULL);
                    $signatory->updateIncludeEmptyFields();
                    $responseArr['coordId'] = '';
                    $responseArr['coordName'] = '';
                }  elseif (!$signatory->isIdEmpty() && $request->request->get("remarks") != '' && $request->request->get("coordinatorId") != '') {
                    if ($signatory->getCoordinatorId() != $request->request->get('coordinatorId')){
                       $signatory->setCoordinatorId($request->request->get('coordinatorId'));
                       $signatory->update();
                    }
                    $responseArr['coordId'] = $signatory->getCoordinatorId();
                    $responseArr['coordName'] = $signatory->getCoordinator()->getTeacher()->getLabel();
                } 
            }
        }
        
        $responseArr['status'] = $obj->getOpStatus();
        $responseArr['remarks'] = trim(\strip_tags($request->request->get("remarks")));
        $response = new Response(json_encode($responseArr));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
    
    public function ajaxSummarizedGradeTable($studentId, $academicYearClassGroupId, $termSemesterId) {
        $ayClassGroup = (new \Academic\Model\EduAcademicYearClassGroup())->getObjectById($academicYearClassGroupId);
        $gPref = (new \Admin\Model\EduFacilityGradingPreference())->getByAcademicYearAndFacility($ayClassGroup->getAcademicYearId(), $ayClassGroup->getFacilityId());
        $table = "";
        
        if($ayClassGroup->canBeViewedAtFacility()) {
            $studentSubjects = (new \Academic\Model\EduClassGroupStudentSubject())->getSubjectsByClassGroupStudentAcademicPeriod($academicYearClassGroupId, $termSemesterId, $studentId);
            $subjects = (\count($studentSubjects) > 0) ? $studentSubjects : (new \Academic\Model\EduClassGroupSubject())->getSubjectsByAcademicYearClassGroup($academicYearClassGroupId);
            $studentAcademicPeriodGrades = (new \Academic\Model\EduClassGroupTermSemesterSubjectGradeActivityGrade())->getStudentAcademicPeriodGrades($studentId, $academicYearClassGroupId, $termSemesterId, "NUMERIC");
            $letterSubjectGrade = new \Academic\Model\EduLetterGradeSubject();
            $fgr = new \Academic\Model\EduFinalGradeRemark();
            
            $table .= "<table border='0' class='' cellspacing='0' width='100%' style='background-color:#fdfdfd;border:1px solid #006699;'>";
                $table .= "<thead>";
                    $table .= "<tr style='background-color:transparent;'>";
                        $table .= "<th style='background-color:#006699;text-decoration:none;color:#fff;border-right:1px dotted #fff;'>Subject</th>";
                        $table .= "<th style='background-color:#006699;text-decoration:none;color:#fff;'>Term (%)</th>";
                        if ($gPref->hasAcademicPeriodExam()) {
                            $table .= "<th style='background-color:#006699;text-decoration:none;color:#fff;'>Exam (%)</th>";
                        }
                    $table .= "</tr>";
                $table .= "</thead>";
                $table .= "<tbody>";
                foreach($subjects as $subject){
                    $sfgr = $fgr->getByParameters($ayClassGroup->getId(), $termSemesterId, $subject->getId(), $studentId);
                    $usesLetterGrade = $letterSubjectGrade->subjectUsesLetterGrades($ayClassGroup->getId(), $termSemesterId, $subject->getId());
                    
                    $table .= "<tr style='background-color:transparent;'>";
                        $table .= "<td style='background-color:transparent;text-decoration:none;color:#000;border-bottom:1px dotted #d0e8e8;'>".$subject->getLabel()."</td>";
                        $table .= "<td style='background-color:transparent;text-decoration:none;color:#000;border-bottom:1px dotted #d0e8e8;border-left:1px dotted #d0e8e8;'>";
                            $table .= ($usesLetterGrade) ? $sfgr->getLetterGrade() : $studentAcademicPeriodGrades[$subject->getCode()]['display'];
                            if (!$usesLetterGrade && $studentAcademicPeriodGrades[$subject->getCode()]['display'] !== null && $studentAcademicPeriodGrades[$subject->getCode()]['display'] !== '' && !$studentAcademicPeriodGrades[$subject->getCode()]['complete']) {
                                $table .= "&nbsp;*";
                            }
                        $table .= "</td>";
                        if ($gPref->hasAcademicPeriodExam()) {
                            $table .= "<td style='background-color:transparent;text-decoration:none;color:#000;border-bottom:1px dotted #d0e8e8;border-left:1px dotted #d0e8e8;'>";
                            $table .= $studentAcademicPeriodGrades[$subject->getCode()]['examDisplay'];
                            $table .= "</td>";
                        }
                    $table .= "</tr>";
                }
                $table .= "</tbody>";
            $table .= "</table>";
        }
        $response = new Response($table);
        return $response;
    }
    
    public function updateGradeReportSignatory (Request $request){
        $obj = (new $this->modelClass())->getEntityById($request->request->get("id"));
        $obj->setGradeReportSignatoryId($request->request->get("gradeReportSignatoryId"));
        
        $obj->setModifiedById($_SESSION['userId']);
        $obj->setModifiedTime(date("Y-m-d H:i:s"));
        //Deal with html coordinator remarks
        $coorRemarks = \html_entity_decode($obj->getCoordinatorRemarks());
        $obj->setCoordinatorRemarks($coorRemarks);
        
        $htRemarks = \html_entity_decode($obj->getHeadTeacherRemarks());
        $obj->setHeadTeacherRemarks ($htRemarks);
        
        $obj->updateIncludeEmptyFields();
        
        $responseArr = array();
        $responseArr['status'] = $obj->getOpStatus();
        $responseArr['signatoryName'] = $obj->getGradeReportSignatory()->getUser()->getLabel();
        $responseArr['signatoryTitle'] = $obj->getGradeReportSignatory()->getTitle();
        $responseArr['signatoryPrefix'] = $obj->getGradeReportSignatory()->getPrefixedAddition();
        $response = new Response(json_encode($responseArr));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
    
    public function removeGradeReportSignatory (Request $request){
        $obj = (new $this->modelClass())->getEntityById($request->request->get("id"));
        $obj->setGradeReportSignatoryId("");
        
        $obj->setModifiedById($_SESSION['userId']);
        $obj->setModifiedTime(date("Y-m-d H:i:s"));
        //Deal with html coordinator remarks
        $coorRemarks = \html_entity_decode($obj->getCoordinatorRemarks());
        $obj->setCoordinatorRemarks($coorRemarks);
        
        $htRemarks = \html_entity_decode($obj->getHeadTeacherRemarks());
        $obj->setHeadTeacherRemarks ($htRemarks);
        
        $obj->updateIncludeEmptyFields();
        
        $responseArr = array();
        $responseArr['status'] = $obj->getOpStatus();
        
        $response = new Response(json_encode($responseArr));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
    
}
