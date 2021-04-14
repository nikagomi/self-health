<?php

namespace Utility\Controller;
use Neptune\{BaseController, DbMapperUtility, EduPropertyService};
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Utility\Model\AcademicPositioner;

/**
 * FacilityMarkReadingPrintableController
 * @pacakage sarms
 * @author Randal Neptune
 */
class FacilityMarkReadingPrintableController extends BaseController {
    protected $modelClass = "\Utility\Model\EduFacilityMarkReadingSummaryPrintable";
    
    public function printSummaryForm(Request $request, $markReadingId, $studentId, $displayType){
        $printable = NULL;
        $now = \date("Y-m-d H:i:s");
        
        $gradeDisplay = ($displayType == "" || !in_array(\strtoupper($displayType), DbMapperUtility::gradeDisplayTypes())) ? EduPropertyService::getProperty("default.grade.display.type","numeric") : \strtoupper($displayType);
        $markReading = (new \Academic\Model\EduFacilityClassGroupMarkReading())->getObjectById($markReadingId);
        $checkPrintable = (new $this->modelClass())->getByMarkReadingStudent($markReadingId, $studentId);
        $studentSubjects = (new \Academic\Model\EduClassGroupStudentSubject())->getSubjectsByClassGroupStudentAcademicPeriod($markReading->getAcademicYearClassGroupId(), $markReading->getAcademicPeriodId(), $studentId);
        $subjects = (\count($studentSubjects) > 0) ? $studentSubjects : (new \Academic\Model\EduClassGroupSubject())->getSubjectsByAcademicYearClassGroup($markReading->getAcademicYearClassGroupId());
        
        
        if ($checkPrintable->getId() == ''){//does not yet exist, create one then.
            $obj = new $this->modelClass();
            $obj->setMarkReadingId($markReadingId);
            $obj->setStudentId($studentId);
            $obj->setModifiedById($_SESSION['userId']);
            $obj->setModifiedTime($now);
            $obj->setCreatedTime($now);
            $obj->setCreatedById($_SESSION['userId']);
            $obj->setComments("");
            $obj->setCoordinatorRemarks("");
            $obj->save();
          
            if($obj->getOpStatus()){
                $printable = $obj;
            }else{
                $this->_edu->assign("msg","Could not show detailed summary");
                return new RedirectResponse("/class/group/mark/reading/grade/summary/".$markReadingId."/".$gradeDisplay);
            }
        }else{
            $printable = $checkPrintable;
        }
        //Here determine and update subject teachers - to be done everytime grade report is accessed
        $sql = "";
        foreach ($subjects as $subject) {
            $subTeacher = (new $this->modelClass())->determineGradeReportSubjectTeacher($studentId, $markReadingId, $subject->getId());
            if (!$subTeacher->isIdEmpty()) {//A teacher was returned for the subject
                $gradeRemark = (new \Academic\Model\EduFacilityMarkReadingGradeRemark())->getByParameters($markReadingId, $subject->getId(), $studentId);
                if ($gradeRemark->isIdEmpty()) {//first time
                    $gradeRemark->setFacilityClassGroupMarkReadingId($markReadingId);
                    $gradeRemark->setSubjectId($subject->getId());
                    $gradeRemark->setTeacherId($subTeacher->getId());
                    $gradeRemark->setStudentId($studentId);
                    $gradeRemark->setCreatedById($_SESSION['userId']);
                    $gradeRemark->setModifiedById($_SESSION['userId']);
                    $gradeRemark->setCreatedTime($now);
                    $gradeRemark->setModifiedTime($now);
                    $sql .= $gradeRemark->generateSaveSql();
                } else {
                    $gradeRemark->setTeacherId($subTeacher->getId());
                    $sql .= $gradeRemark->generateUpdateSql();
                }
            }
        }
        DbMapperUtility::dbQuery('BEGIN TRANSACTION; ' .$sql. ' COMMIT;');
        
        $rankFunction = AcademicPositioner::getRankFunction($markReading->getAcademicYearClassGroupId());
        $lastTermSemester = (new \Academic\Model\EduTermSemester())->getLastTermSemesterInAcademicYear($markReading->getAcademicYearClassGroup()->getAcademicYearId());
        
        $this->_edu->assign("coordinator", new \Academic\Model\EduAcademicYearGradeLevelCoordinator());
        $this->_edu->assign("gradeReportSuffix", (new \Admin\Model\EduStudentGradeReportFacilitySuffix())->getByFacility($markReading->getAcademicYearClassGroup()->getFacilityId()));
        $this->_edu->assign("headTeacher", (new \Admin\Model\EduFacilityHeadTeacher())->getCurrentHeadTeacherByFacility($markReading->getAcademicYearClassGroup()->getFacilityId()));
        
        $this->_edu->assign("printable",$printable);
        $this->_edu->assign("lastTermSemester",$lastTermSemester);
        $this->_edu->assign('guardians', (new \Student\Model\EduLegalGuardian())->getGuardiansByStudentId($printable->getStudentId()));
        $this->_edu->assign("gradePref", (new \Admin\Model\EduFacilityGradingPreference())->getByAcademicYearAndFacility($markReading->getAcademicYearClassGroup()->getAcademicYearId(), $markReading->getAcademicYearClassGroup()->getFacilityId()));
        $this->_edu->assign("periodAttendance", (new \Academic\Model\EduDailyStudentAttendanceRecord())->getStudentAttendanceSummary($studentId, $markReading->getAcademicPeriod(), $markReading->getAcademicYearClassGroup(), $markReading->getStartDate(), $markReading->getEndDate()));
        
        $this->_edu->assign("ayClassGroup", $markReading->getAcademicYearClassGroup());
        $this->_edu->assign("termSemester", $markReading->getAcademicPeriod());
        $this->_edu->assign("markReading", $markReading);
        $this->_edu->assign("student",(new \Student\Model\EduStudent())->getEntityById($studentId));
        
        
        $this->_edu->assign('subjects', $subjects);
        
        $this->_edu->assign("letterSubjectGrade", new \Academic\Model\EduMarkReadingLetterGradeSubject());
        
        $this->_edu->assign("subjectTeacher", new \Academic\Model\EduClassGroupSubjectTeacherAssignment());
        $this->_edu->assign("finalGradeSubjectTeacher", new \Academic\Model\EduFinalGradeSubjectTeacher());
        $this->_edu->assign('html',$this->html);
        $this->_edu->assign('title','Student Term Grade Summary');
        
        $this->_edu->assign("numStudents",\count((new \Student\Model\EduStudentClassGroupAssignment())->getStudentsByAcademicYearClassGroup($markReading->getAcademicYearClassGroupId())));
        //$this->_edu->assign("highestGrades", (new \Academic\Model\EduClassGroupTermSemesterSubjectGradeActivityGrade())->getHighestTermSubjectGrades($ayClassGroupId, $termSemesterId, $displayType));
        
        $this->_edu->assign("studentAcademicPeriodGrades", (new \Academic\Model\EduClassGroupTermSemesterSubjectGradeActivityGrade())->getStudentAcademicPeriodGrades($studentId, $markReading->getAcademicYearClassGroupId(), $markReading->getAcademicPeriodId(), $displayType, $markReading->getStartDate(), $markReading->getEndDate()));
        $this->_edu->assign("currentUsr",(new \Authentication\Model\EduUser())->getObjectById($_SESSION['userId']));
        //$this->_edu->assign("onlyCompleteGrades", filter_var(\Neptune\EduPropertyService::getProperty("ext.user.show.only.completed.grade", true), FILTER_VALIDATE_BOOLEAN));
        
        $this->_edu->assign("requestUri",  DbMapperUtility::reconstructUri($request->getRequestUri()));
        $this->_edu->assign("rank",  AcademicPositioner::$rankFunction([],$markReading->getAcademicYearClassGroupId(), $markReading->getAcademicPeriodId(), $gradeDisplay, $markReading->getStartDate(), $markReading->getEndDate()));
        
        
        $this->_edu->assign("passGrade",  \Neptune\EduPropertyService::getProperty("term.pass.grade"));
        $this->_edu->assign("isCurrentAssignment",(new \Student\Model\EduStudentSchoolAssignment())->isCurrentAssignment($printable->getStudentId(),$_SESSION['facilityId']));
        $this->_edu->assign("isHomeroomTeacher",$markReading->getAcademicYearClassGroup()->isHomeroomTeacherByTermSemester($_SESSION['userId'], $markReading->getAcademicPeriodId()));
        $this->_edu->assign("prmManager",new \Authentication\Model\EduPermissionManager());
        $this->_edu->assign("privilegeEnforced",  \Neptune\EduPropertyService::getProperty("enforce.homeroom.teacher.privilege"));
        $this->_edu->assign("gradeRemark", new \Academic\Model\EduFacilityMarkReadingGradeRemark());
        
        $this->_edu->assign("gradeDisplay", \strtoupper($gradeDisplay));
         $this->_edu->assign("yearCoordinators", (new \Academic\Model\EduAcademicYearGradeLevelCoordinator())->getByFacilityAcademicYearGradeLevel($markReading->getAcademicYearClassGroup()->getFacilityId(), $markReading->getAcademicYearClassGroup()->getAcademicYearId(), $markReading->getAcademicYearClassGroup()->getClassGroup()->getGradeLevelId()));
        $this->_edu->assign("coordinatorSignatory", (new \Academic\Model\EduMarkReadingCoordinatorSignatory())->getByMarkReadingPrintable($printable->getId()));
        
        //Get all students in the class
        $students = \Student\Model\EduStudent::complexSort((new \Student\Model\EduStudentClassGroupAssignment())->getStudentsByAcademicYearClassGroup($markReading->getAcademicYearClassGroupId(), $markReading->getAcademicPeriodId()));
        //\usort($students,["\Neptune\DbMapperUtility","labelCompare"]);
        $idArr = DbMapperUtility::objectArrayToIdArray($students);
        
        $this->_edu->assign("scroller", DbMapperUtility::getScrollingNextPreviousElements($idArr, $studentId));
        
        return new Response($this->_edu->display('grading/markReadingStudentSummary.tpl'));
    }
    
    public function updateMarkReadingComments(Request $request){
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
    
    public function updateMarkReadingHeadTeacherRemarks(Request $request){
        $obj = (new $this->modelClass())->getEntityById($request->request->get("id"));
        $obj->setHeadTeacherRemarks($request->request->get("headTeacherRemarks"));
        $obj->setModifiedById($_SESSION['userId']);
        $obj->setModifiedTime(date("Y-m-d H:i:s"));
        
        //Deal with html coordinator remarks
        $coorRemarks = \html_entity_decode($obj->getCoordinatorRemarks());
        $obj->setCoordinatorRemarks($coorRemarks);
        
        //Deal with html homeroom teacher comments
        $comments = \html_entity_decode($obj->getComments());
        $obj->setComments($comments);
        
        $obj->updateIncludeEmptyFields();
        
        $responseArr = array();
        $responseArr['status'] = $obj->getOpStatus();
        $responseArr['comments'] = \trim(\strip_tags($request->request->get("headTeacherRemarks")));
        $response = new Response(json_encode($responseArr));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
    
    public function updateMarkReadingCoordinatorRemarks(Request $request){
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
                $signatory = (new \Academic\Model\EduMarkReadingCoordinatorSignatory())->getByMarkReadingPrintable($obj->getId());
                if ($signatory->isIdEmpty() && $request->request->get("remarks") != '') {//new entry
                    //check to see if the user is a coordinator
                    if ($request->request->get("coordinatorId") != '') {
                        $coordinator = (new \Academic\Model\EduAcademicYearGradeLevelCoordinator())->getObjectById($request->request->get("coordinatorId"));
                        $signatory->setId('');
                        $signatory->setCoordinatorId($coordinator->getId());
                        $signatory->setMarkReadingPrintableId($obj->getId());
                    } else {
                        $coordinators = (new \Academic\Model\EduAcademicYearGradeLevelCoordinator())->getByFacilityAcademicYearGradeLevel($obj->getAcademicYearClassGroup()->getFacilityId(), $obj->getAcademicYearClassGroup()->getAcademicYearId(), $obj->getAcademicYearClassGroup()->getClassGroup()->getGradeLevelId());
                        foreach ($coordinators as $coordinator) {
                            if ($coordinator->getTeacher()->getUserId() == $_SESSION['userId']) {
                                //save a signatory entity
                                $signatory->setId('');
                                $signatory->setCoordinatorId($coordinator->getId());
                                $signatory->setMarkReadingPrintableId($obj->getId());
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
}
