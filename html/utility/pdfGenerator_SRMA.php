<?php
session_start();

require_once(__DIR__.'/../../src/pdf/tcpdf.php');
require_once (__DIR__.'/../../vendor/autoload.php');



date_default_timezone_set(\Neptune\EduPropertyService::getProperty("default.time.zone","America/St_Lucia"));

//Comming in via ajax
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_STRING);
$userId = filter_input(INPUT_GET, 'userId', FILTER_SANITIZE_STRING);
$outputType = \filter_input(INPUT_GET, 'outputType', FILTER_SANITIZE_STRING);



    //Check to see if student is currently assigned to this facilty.
    if($id !== false && $userId !== false){ //the filter succeeded and returned true
        $printable = (new \Utility\Model\EduStudentTermGradeSummaryPrintable())->getEntityById($id);
        $gradeDisplay = \Neptune\EduPropertyService::getProperty("default.grade.display.type","numeric");

        /*$currentAssignment = (new \Student\Model\EduStudentSchoolAssignment())->getCurrentAssignment($printable->getStudent()->getId());
        if(($currentAssignment->getFacilityId() == $_SESSION['facilityId'] && $_SESSION['isEducational'] && $currentAssignment->getId() != '')
                OR $_SESSION['isAdmin']){//make sure student is assigned to this school*/
            
            //General for all students
            $gradePref = (new \Admin\Model\EduFacilityGradingPreference())->getByAcademicYearAndFacility($printable->getAcademicYearClassGroup()->getAcademicYearId(), $printable->getAcademicYearClassGroup()->getFacilityId());
            $rankFunction = \Utility\Model\AcademicPositioner::getRankFunction($printable->getAcademicYearClassGroupId());
            
            $lastTermSemester = (new Academic\Model\EduTermSemester())->getLastTermSemesterInAcademicYear($printable->getAcademicYearClassGroup()->getAcademicYearId(), $printable->getAcademicYearClassGroup()->getFacilityId());
            if ($printable->getTermSemesterId() == $lastTermSemester->getId() && !empty($printable->getTermSemesterId())) {
                $nextYear = (new Academic\Model\EduAcademicYear())->getNextAcademicYear($printable->getAcademicYearClassGroup()->getAcademicYearId());
                $nextTermSemester = (new Academic\Model\EduTermSemester())->getFirstTermSemesterInAcademicYear($nextYear->getId());
            } else {
                $nextTermSemester = $printable->getTermSemester()->getNext($printable->getAcademicYearClassGroup()->getFacilityId());
            }
      
            $conductGrades = (new \Academic\Model\EduFacilityConductLetterGrade())->getByFacility($printable->getAcademicYearClassGroup()->getFacilityId());
            $onlyCompleteGrades = \filter_var(\Neptune\EduPropertyService::getProperty("ext.user.show.only.completed.grade", true), FILTER_VALIDATE_BOOLEAN);
            
            $coordinators = (new \Academic\Model\EduAcademicYearGradeLevelCoordinator())->getByFacilityAcademicYearGradeLevel($printable->getAcademicYearClassGroup()->getFacilityId(), $printable->getAcademicYearClassGroup()->getAcademicYearId(), $printable->getAcademicYearClassGroup()->getClassGroup()->getGradeLevelId());
            $homeroomTeacher = (new \Academic\Model\EduAcademicPeriodClassGroupHomeroomTeacher())->getHomeroomTeacher($printable->getAcademicYearClassGroupId(), $printable->getTermSemesterId());
            $user = (new Authentication\Model\EduUser())->getObjectById($userId);
            
            $numStudents = \count((new \Student\Model\EduStudentClassGroupAssignment())->getStudentsByAcademicYearClassGroup($printable->getAcademicYearClassGroupId()));
            $position = \Utility\Model\AcademicPositioner::$rankFunction([], $printable->getAcademicYearClassGroupId(), $printable->getTermSemesterId(), $gradeDisplay);
                   
            $eduFacility = (new \Admin\Model\EduFacility())->getEntityById($printable->getAcademicYearClassGroup()->getClassGroup()->getFacility()->getId());
            $finalGradeRemark = new \Academic\Model\EduFinalGradeRemark();
            $finalGradeSubjectTeacher = new \Academic\Model\EduFinalGradeSubjectTeacher();
            
            //Student Specific
            $studentSubjects = (new \Academic\Model\EduClassGroupStudentSubject())->getSubjectsByClassGroupStudentAcademicPeriod($printable->getAcademicYearClassGroupId(), $printable->getTermSemesterId(), $printable->getStudentId());
            $subjects = (\count($studentSubjects) > 0) ? $studentSubjects : (new \Academic\Model\EduClassGroupSubject())->getSubjectsByAcademicYearClassGroup($printable->getAcademicYearClassGroupId());
            
            $studentAcademicPeriodGrades = (new \Academic\Model\EduClassGroupTermSemesterSubjectGradeActivityGrade())->getStudentAcademicPeriodGrades($printable->getStudentId(), $printable->getAcademicYearClassGroupId(), $printable->getTermSemesterId(), $gradeDisplay);
            $attendance = (new \Academic\Model\EduDailyStudentAttendanceRecord())->getStudentAttendanceSummary($printable->getStudentId(), $printable->getTermSemester(), $printable->getAcademicYearClassGroup());
             
            class MYPDF extends TCPDF {  
                //Page Header
                public function Header(){
                    $this->Rect(0,0,220,297,'F','',$fill_color = array(255, 255, 255));
                    $printable = (new \Utility\Model\EduStudentTermGradeSummaryPrintable())->getEntityById(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_STRING));
                    $eduFacility = (new \Admin\Model\EduFacility())->getEntityById($printable->getAcademicYearClassGroup()->getClassGroup()->getFacility()->getId());
                    
                    $x = 15;
                    $l = 15;
                    $ln = 5;
                    if($eduFacility->getEmblemName() != ''){
                        $x = 52; //52
                        $l = 130;
                        $ln = 8;
                        $this->Image($eduFacility->getEmblemPath(), 10, 2, '', '', '', '', 'T', false, 300, '', false, false, 0, false, false, false);
                    }
                    $this->ln(5);
                    //Title
                    $this->SetFont('helvetica', 'B', 15);
                    $this->setX($x);
                    $this->Cell($l, 0, $eduFacility->getName(), 0, 1, 'L');

                    $this->SetFont('helvetica', '', 8);
                    $this->setX($x);
                    $this->Cell($l, 4, $eduFacility->getDistrict()->getName(), 0, 1, 'L');
                    $this->setX($x);
                    $this->Cell($l, 4, $eduFacility->getAddress1(), 0, 1, 'L');
                    $this->setX($x);
                    $this->Cell($l, 4, $eduFacility->getCountry()->getName(), 0, 1, 'L');
                    $this->setX($x);
                    $this->Cell($l, 4, "Tel.: ".\Neptune\EduPropertyService::getProperty("phone.area.code",'')." ".$eduFacility->getPhone(), 0, 1, 'L');
                    $this->Ln($ln);

                    $this->Line(15, $this->y, $this->w - 15, $this->y);
                }
                
                // Page footer
                public function Footer() {
                    $printable2 = (new \Utility\Model\EduStudentTermGradeSummaryPrintable())->getEntityById(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_STRING));
                    $facility = $printable2->getAcademicYearClassGroup()->getClassGroup()->getFacility();
                    
                    $now = \Neptune\DbMapperUtility::formatSqlDateTime(\date("Y-m-d H:i:s"));
                    $user = (new \Authentication\Model\EduUser())->getObjectById(filter_input(INPUT_GET, 'userId', FILTER_SANITIZE_STRING));

                    // Position at 15 mm from bottom
                    $this->SetY(-20);
                    // Set font
                    $this->SetFont('helvetica', 'I', 8);
                    $this->SetTextColor(180, 180, 180);

                    $this->setCellPaddings(1, 1, 1, 1);
                    // Page number
                    if(!$user->isExternalUser()){
                        $this->MultiCell(120, 15, "Generated by ".$user->getLabel()." at ".$facility->getName()." on ".$now, 'T', 'L', 0, 0, '', '', true);
                    }else{
                        $this->MultiCell(120, 15, "Generated by ".$user->getLabel()." on ".$now, 'T', 'L', 0, 0, '', '', true);
                    }

                    $this->SetFont('helvetica', '', 8);
                    $this->MultiCell(65, 15, "Page ".$this->getAliasNumPage()." of ".$this->getAliasNbPages(), 'T', 'R', 0, 0, '', '', true);
                }      
            }
            $pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
            $pdf->setFontSubsetting(false);
            // set document information
            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetAuthor('Student Management & Academic Record Toolkit');
            $pdf->SetTitle('Student Term Grade Summary');
            $pdf->SetSubject('Term Grade Summary');
            $pdf->SetKeywords('term, grade, summary, student');

            $headerTitle = $eduFacility->getName();
            
//            $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, $headerTitle, $headerString);

            // set header and footer fonts

            $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
            $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

            // set default monospaced font
            $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

            // set margins
            $pdf->SetMargins(PDF_MARGIN_LEFT, 35, PDF_MARGIN_RIGHT);
            $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
            $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

            // set auto page breaks
            $pdf->SetAutoPageBreak(TRUE, 10);

            // set image scale factor
            $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

            // set some language-dependent strings (optional)
            if (file_exists(dirname(__FILE__).'../../src/pdf/lang/eng.php')) {
                    require_once(dirname(__FILE__).'../../src/pdf/lang/eng.php');
                    $pdf->setLanguageArray($l);
            }

            // set font
            $pdf->SetFont('helvetica', '', 8);

            // add a page
            $pdf->AddPage('P');

            // set cell padding
            $pdf->setCellPaddings(0, 1, 1, 1);
            $pdf->Ln(6);
            $height = 3;
            
            //student
            $pdf->SetFont('helvetica', 'B', 10);
            $pdf->MultiCell(35, $height, $printable->getTermSemester()->getAcademicYear()->getLabel(), 0, 'L', 0, 0, '', '', true);
            $pdf->MultiCell(57, $height, "ACADEMIC REPORT FOR:", 0, 'R', 0, 0, '', '', true);
            $pdf->SetFont('helvetica', 'B', 10);
            $pdf->MultiCell(50, $height, $printable->getStudent()->getFullName(), 0, 'R', 0, 0, '', '', true);
            $pdf->SetFont('helvetica', '', 10);
            $pdf->MultiCell(35, $height, " (".$printable->getStudent()->getAgeAtDate($printable->getTermSemester()->getEndDate())." yrs)", 0, 'L', 0, 1, '', '', true);
            //$printable->getStudent()->getAgeAtDate($printable->getTermSemester()->getEndDate())." yrs"
            
            //Class & Term Information
            $pdf->Ln(3);
            $pdf->SetFont('helvetica', 'B', 8);
            $pdf->MultiCell(36, $height, \strtoupper($printable->getAcademicYearClassGroup()->getClassGroup()->getLabel()), 0, 'L', 0, 0, '', '', true);
            $pdf->SetFont('helvetica', '', 8);
            $pdf->MultiCell(26, $height, " Students in class:", 0, 'R', 0, 0, '', '', true);
            $pdf->SetFont('helvetica', 'B', 8);
            $pdf->MultiCell(5, $height, " ".$numStudents, 0, 'L', 0, 0, '', '', true);
            $pdf->SetFont('helvetica', 'B', 8);
            $pdf->MultiCell(60, $height, \strtoupper($printable->getTermSemester()->getLabel()), 0, 'R', 0, 0, '', '', true);
            $pdf->SetFont('helvetica', '', 8);
            $pdf->MultiCell(46, $height, "  ending: ".  (new \DateTime($printable->getTermSemester()->getEndDate()))->format('F jS, Y'), 0, 'L', 0, 1, '', '', true);
            
            //Attendance & ranking information
            $pdf->SetFillColor(235, 235, 235);
            $pdf->Ln(3);
            $pdf->SetFont('helvetica', 'B', 8);
            $pdf->MultiCell(60, $height, "Attendance", 1, 'C', 1, 0, '', '', true);
            $pdf->MultiCell(40, $height, "", 0, 'C', 0, 0, '', '', true);
            $pdf->MultiCell(85, $height, "Grades", 1, 'C', 1, 1, '', '', true);
            
            //First row
            $pdf->SetFont('helvetica', '', 8);
            $pdf->MultiCell(40, $height, " Attendance Possible", 1, 'L', 0, 0, '', '', true);
            $pdf->MultiCell(20, $height, " ".$attendance["num_attendances"], 1, 'L', 0, 0, '', '', true);
            
            $pdf->MultiCell(40, $height, "", 0, 'C', 0, 0, '', '', true);
            
            $pdf->SetFont('helvetica', 'B', 8);
            
            $pdf->MultiCell(15, $height, " ", 1, 'C', 0, 0, '', '', true);
            $pdf->MultiCell(15, $height, "Avg.", 1, 'C', 0, 0, '', '', true);
            $pdf->MultiCell(15, $height, "Rank", 1, 'C', 0, 0, '', '', true);
            $pdf->MultiCell(40, $height, "Subjects Passed", 1, 'C', 0, 1, '', '', true);
            
            //second row
            $pdf->SetFont('helvetica', '', 8);
            $pdf->MultiCell(40, $height, " Late", 1, 'L', 0, 0, '', '', true);
            $pdf->MultiCell(20, $height, " ".$attendance["late"], 1, 'L', 0, 0, '', '', true);
            
            $pdf->MultiCell(40, $height, "", 0, 'C', 0, 0, '', '', true);
            
            $pdf->MultiCell(15, $height, "Term  ", 1, 'R', 0, 0, '', '', true);
            $pdf->MultiCell(15, $height, $position['average'][$printable->getStudentId()]['grade'], 1, 'C', 0, 0, '', '', true);
            $pdf->writeHTMLCell(15, $height, 145, 70, \Neptune\DbMapperUtility::addOrdinalSuffix($position['average'][$printable->getStudentId()]['rank']), 1, 0, false, false, "C");
            $pdf->MultiCell(40, $height, $position['average'][$printable->getStudentId()]['subjectsPassed'].'  of  '.$position['average'][$printable->getStudentId()]['gradedSubjects'], 1, 'C', 0, 1, '', '', true);
            
            //third row
            $pdf->SetFont('helvetica', '', 8);
            $pdf->MultiCell(40, $height, " Absent", 1, 'L', 0, 0, '', '', true);
            $pdf->MultiCell(20, $height, " ".$attendance["absent"], 1, 'L', 0, 0, '', '', true);
            
            $pdf->MultiCell(40, $height, "", 0, 'C', 0, 0, '', '', true);
            
            $pdf->MultiCell(15, $height, "Exam  ", 1, 'R', 0, 0, '', '', true);
            $pdf->MultiCell(15, $height, $position['examAverage'][$printable->getStudentId()]['grade'], 1, 'C', 0, 0, '', '', true);
            $pdf->writeHTMLCell(15, $height, 145, 75.5, \Neptune\DbMapperUtility::addOrdinalSuffix($position['examAverage'][$printable->getStudentId()]['rank']), 1, 0, false, false, "C");
            $pdf->MultiCell(40, $height, (($position['examAverage'][$printable->getStudentId()]['subjectsPassed'] != '') ? $position['examAverage'][$printable->getStudentId()]['subjectsPassed'].'  of  '.$position['examAverage'][$printable->getStudentId()]['gradedSubjects'] : ''), 1, 'C', 0, 1, '', '', true);
            
            
            //fourth row
            
            $pdf->MultiCell(40, $height, " Punctuality", 1, 'L', 0, 0, '', '', true);
            $pdf->SetFont('helvetica', 'B', 8);
            $pdf->MultiCell(20, $height, ($attendance['present'] != "" && $attendance['num_attendances'] != 0) ? " ".\floatval(\number_format(($attendance['present']/$attendance['num_attendances']) * 100, 1))." %" : "", 1, 'L', 0, 0, '', '', true);
            
            $pdf->MultiCell(40, $height, "", 0, 'C', 0, 0, '', '', true);
            
            $pdf->SetFont('helvetica', '', 8);
            $pdf->MultiCell(15, $height, "Finals  ", 1, 'R', 0, 0, '', '', true);
            $pdf->MultiCell(15, $height, $position['finalAverage'][$printable->getStudentId()]['grade'], 1, 'C', 0, 0, '', '', true);
            $pdf->writeHTMLCell(15, $height, 145, 81, \Neptune\DbMapperUtility::addOrdinalSuffix($position['finalAverage'][$printable->getStudentId()]['rank']), 1, 0, false, false, "C");
            $pdf->MultiCell(40, $height, (($position['finalAverage'][$printable->getStudentId()]['subjectsPassed'] != '') ? $position['finalAverage'][$printable->getStudentId()]['subjectsPassed'].'  of  '.$position['finalAverage'][$printable->getStudentId()]['gradedSubjects'] : ''), 1, 'C', 0, 1, '', '', true);
            
            $pdf->Ln(7);
            
            //Achievement Table
            $table = '<table border="0" width="100%" cellpadding="3">
            <thead>
                <tr height="30px" style="">
                    <th style="font-weight:bold;border:none;" width="4%"> &nbsp; </th>
                    <th style="font-weight:bold;text-align:left;border:none;" width="20%">&nbsp;</th>
                    <th colspan="3" style="font-weight:bold;text-align:center;border:1px solid #444;" width="21%">Achievements</th>
                    <th rowspan="2" style="font-weight:normal;text-align:center;font-size:10px;vertical-align:middle;border:1px solid #444;" width="8%">Conduct Grades</th>
                    <th rowspan="2" style="font-weight:normal; padding-top:10px; font-size:10px;text-align:center;border:1px solid #444;" width="34%"> Remarks </th>
                    <th rowspan="2" style="border:1px solid #444;vertical-align:middle;font-size:10px;" width="13%"> Subject Teacher </th>
                </tr>
                <tr height="30px" style="">
                    <th style="font-weight:bold;border:none;" width="4%"> &nbsp; </th>
                    <th style="font-weight:bold;text-align:left;border:1px solid #444;font-size:10px;" width="20%">Subjects</th>
                    <th style="text-align:center;border:1px solid #444;font-size:10px;" width="7%">Term</th>
                    <th style="text-align:center;border:1px solid #444;font-size:10px;" width="7%">Exam</th>
                    <th style="text-align:center;border:1px solid #444;font-size:10px;" width="7%">Final</th>
                </tr>
            </thead>
            <tbody>';
            $i = 1;
            $termTotal = 0;
            $examTotal = 0;
            $finalTotal = 0;
            $termCnt = 0;
            $examCnt = 0;
            $finalCnt = 0;
            foreach($subjects as $subject){
                $subjectTeacher =  $finalGradeSubjectTeacher->getByParameters($printable->getAcademicYearClassGroupId(), $printable->getTermSemesterId(), $subject->getId(), $printable->getStudentId());
                $fgr = $finalGradeRemark->getByParameters($printable->getAcademicYearClassGroupId(), $printable->getTermSemesterId(), $subject->getId(), $printable->getStudentId());
                //calculate accummulated grades
                if (\array_key_exists($subject->getCode(), $studentAcademicPeriodGrades) && $studentAcademicPeriodGrades[$subject->getCode()]["display"] !== "" ) {
                    $termTotal += $studentAcademicPeriodGrades[$subject->getCode()]["grade"];
                    $termCnt++;
                }
                
                if (\array_key_exists($subject->getCode(), $studentAcademicPeriodGrades) && $studentAcademicPeriodGrades[$subject->getCode()]["examDisplay"] !== "") {
                    $examTotal += $studentAcademicPeriodGrades[$subject->getCode()]["examGrade"];
                    $examCnt++;
                }
                
                
                if (\array_key_exists($subject->getCode(), $studentAcademicPeriodGrades) && $studentAcademicPeriodGrades[$subject->getCode()]["overrideFinalGrade"]) {
                    if ($studentAcademicPeriodGrades[$subject->getCode()]["finalGradeOverrideDisplay"] !== "") {
                        $finalTotal += $studentAcademicPeriodGrades[$subject->getCode()]["finalGradeOverride"] ;
                        $finalCnt++;
                    }
                } elseif (\array_key_exists($subject->getCode(), $studentAcademicPeriodGrades) && $studentAcademicPeriodGrades[$subject->getCode()]["finalGradeDisplay"] !== "") {
                    $finalTotal += $studentAcademicPeriodGrades[$subject->getCode()]["finalGrade"];
                    $finalCnt++;
                }
                //$examTotal += ($studentAcademicPeriodGrades[$subject->getCode()]["examDisplay"] != "") ? $studentAcademicPeriodGrades[$subject->getCode()]["examGrade"] : 0;
                //$finalTotal += ($studentAcademicPeriodGrades[$subject->getCode()]["finalGradeDisplay"] != "") ? $studentAcademicPeriodGrades[$subject->getCode()]["finalGrade"] : 0;
                $finalGrade = '';
                if (\array_key_exists($subject->getCode(), $studentAcademicPeriodGrades)) {
                    if ($studentAcademicPeriodGrades[$subject->getCode()]["overrideFinalGrade"]) {
                        $finalGrade = $studentAcademicPeriodGrades[$subject->getCode()]["finalGradeOverrideDisplay"] ;
                    } else {
                        $finalGrade = $studentAcademicPeriodGrades[$subject->getCode()]["finalGradeDisplay"];
                    }
                }
                
                $table .= '<tr >
                    <td style="border:1px solid #444;text-align:right;vertical-align:middle;" width="4%">'.$i.'</td>
                    <td style="border:1px solid #444;font-size:9px;"  width="20%">'.\ucwords($subject->getName()).'</td>
                    <td style="text-align:center;border:1px solid #444;font-size:9px;"  width="7%" >'.((\array_key_exists($subject->getCode(), $studentAcademicPeriodGrades)) ? $studentAcademicPeriodGrades[$subject->getCode()]["display"] : '&nbsp;').'</td>
                        <td style="text-align:center;border:1px solid #444;font-size:9px;"  width="7%">'.((\array_key_exists($subject->getCode(), $studentAcademicPeriodGrades)) ? $studentAcademicPeriodGrades[$subject->getCode()]["examDisplay"] : '&nbsp;').'</td>
                            <td style="text-align:center;border:1px solid #444;font-size:9px;"  width="7%">'.$finalGrade.'</td>
                    <td style="text-align:left;border:1px solid #444;font-size:9px;text-align:center;" width="8%">'.$fgr->getConductGradeClean().'</td>                   
                    <td style="border:1px solid #444;font-size:9px;" width="34%"><i>'.$fgr->getRemarks().'</i></td>
                    <td style="border:1px solid #444;font-size:9px;"  width="13%"><i>'.\ucwords($subjectTeacher->getTeacher()->getShortName()).'</i></td>
                </tr>';
                $i++;
            }
            
            $table .= '<tr >
                    <td style="border:none;" width="4%">&nbsp;</td>
                    <td style="border:1px solid #444;font-size:10px;"  width="20%"><b>'.\strtoupper("TOTAL").'</b></td>
                    <td style="text-align:center;border:1px solid #444;font-size:9px;font-weight:bold;color:#003366;"  width="7%" >'.(($termCnt > 0) ? $termTotal : "").'</td>
                        <td style="text-align:center;border:1px solid #444;font-size:9px;font-weight:bold;color:#003366;"  width="7%">'.(($examCnt > 0) ? $examTotal : "").'</td>
                            <td style="text-align:center;border:1px solid #444;font-size:9px;font-weight:bold;color:#003366;"  width="7%">'.(($finalCnt > 0) ? $finalTotal : "").'</td>
                    <td style="text-align:left;border:1px solid #444;font-size:9px;text-align:center;" width="8%">&nbsp;</td>                   
                    <td style="border:1px solid #444;font-size:9px;" width="34%"><i>&nbsp;</i></td>
                    <td style="border:1px solid #444;font-size:9px;"  width="13%"><i>&nbsp;</i></td>
                </tr>';
            
            $table .= '<tr >
                    <td style="border:none;" width="4%">&nbsp;</td>
                    <td colspan="2" style="border:1px solid #444;font-size:9px;text-align:center;"  width="27%"><span style="text-align:left;">'.\Neptune\EduPropertyService::getProperty("class.teacher.title",'Homeroom Teacher').':</span><br/>';
            
            $homeroomSignature = ($homeroomTeacher->getUser()->getSignature() != '') ? '<img style="border-bottom:1px dashed #464646;max-height:50px;max-width:150px;" src="'.$homeroomTeacher->getUser()->getSignaturePath().'" width="150px" height="50px"/>' : '<br/><br/>------------------------------------';
            $table .= '<span style="width:100%;padding:0px;margin:0px;">&nbsp;'.$homeroomSignature.'&nbsp;</span><br/>';
            $table .= '<span align="center" style="width:100%;font-size:10px;font-weight:bold;margin:0px;padding:0px;">'.$homeroomTeacher->getTitle()->getName().' '.$homeroomTeacher->getShortName().'</span>';
            
            $table .= '</td>
                    <td colspan="5" valign="top" style="text-align:left;border:1px solid #444;font-size:9px;font-weight:bold;color:#003366;" width="69%">Remarks:
                        <div style="margin:0px;padding:0px;color:#222222;font-weight:normal;font-size:11px;">'.\html_entity_decode($printable->getComments(), ENT_COMPAT, 'UTF-8').'</div>
                    </td>
                </tr>';
            //Include year head for schools that use it.
            if (\Neptune\EduPropertyService::getBoolean("has.academic.year.grade.level.coordinator")) {
                $signatory = (new Academic\Model\EduPrintableCoordinatorSignatory())->getByPrintable($printable->getId());
                $table .= '<tr >
                    <td style="border:none;" width="4%">&nbsp;</td>
                    <td colspan="2" style="border:1px solid #444;font-size:9px;text-align:center;"  width="27%"><span style="text-align:left;">'.\ucwords(\Neptune\EduPropertyService::getProperty("academic.year.grade.level.coordinator.designation",'Year Coordinator')).'(s):</span><br/>';
            
                    $coordSignature = ($signatory->getCoordinator()->getTeacher()->getUser()->getSignature() != '') ? '<img style="border-bottom:1px dashed #464646;max-height:50px;max-width:150px;" src="'.$signatory->getCoordinator()->getTeacher()->getUser()->getSignaturePath().'" width="150px" height="50px"/>' : '<br/><br/>------------------------------------';
                    //$coordSignature = '<br/><br/>------------------------------------';
                    $table .= '<span style="width:100%;padding:0px;margin:0px;">&nbsp;'.$coordSignature.'&nbsp;</span>';
                    $table .= '<span align="center" style="width:100%;font-size:10px;font-weight:bold;margin:0px;padding:0px;">';
                            foreach ($coordinators as $coordinator) {
                                $table .= ((!$coordinator->getTeacher()->isIdEmpty()) ? "<br/>".$coordinator->getTeacher()->getTitle()->getName().' '.$coordinator->getTeacher()->getShortName() : '');
                                $table .= ((!$coordinator->isIdEmpty() && $signatory->getCoordinatorId() == $coordinator->getId() /*&& $signatory->getCoordinator()->getTeacher()->getUser()->getSignature() != ''*/) ? ' <span style="font-weight:normal;font-style:italic;">(sgd)</span>' : '');
                            }
                            $table .= '</span>';
                    $table .= '</td>
                            <td colspan="5" style="text-align:left;border:1px solid #444;font-size:9px;font-weight:bold;color:#003366;" width="69%">Comments:
                                <div style="margin:0px;padding:0px;color:#222222;font-weight:normal;font-size:11px;">'.\html_entity_decode($printable->getCoordinatorRemarks(), ENT_COMPAT, 'UTF-8').'</div>
                            </td>
                        </tr>';
            }
            $table .= '<tr >
                    <td style="border:none;" width="4%">&nbsp;</td>
                    <td colspan="7" style="border:1px solid #444;font-size:9px;text-align:center;"  width="96%">
                        <br/><br/>
                        (Signed) &nbsp;&nbsp;&nbsp;-------------------------------------------------------------------- <br/>
                        Parent / Guardian
                    </td>
            </tr>';
            
            $table .= '<tr >
                    <td style="border:none;" width="4%">&nbsp;</td>
                    <td colspan="7" style="border:none;font-size:9px;text-align:left;"  width="96%"><b>Next '.\Neptune\EduPropertyService::getProperty("academic.period.designation",'Term').' Begins --> </b>&nbsp;'.((!$nextTermSemester->isIdEmpty()) ? (new \DateTime($nextTermSemester->getStartDate()))->format("l, jS F, Y") : '').'
                    </td>
            </tr>';
            
            if (\count($conductGrades) > 0) {
                $table .= '<tr >
                    <td style="border:none;" width="4%">&nbsp;</td>
                    <td colspan="7" style="border:none;font-size:9px;text-align:left;"  width="96%"><b>Conduct Grades:</b><br/>';
                foreach ($conductGrades as $conductGrade) {
                    $table .= "<i>".\strtoupper($conductGrade->getLetterGrade()).'</i> - '.\ucwords($conductGrade->getDescription()).'&nbsp;&nbsp;';
                }
                    
                $table .= '</td>
            </tr>';
            }
            $table .= "</tbody></table>";
            $pdf->writeHTML($table, false);
            //Head Teacher
            if (\Neptune\EduPropertyService::getBoolean("student.grade.report.head.teacher.signature")) {
                $facilityHeadTeacher = (new \Admin\Model\EduFacilityHeadTeacher())->getCurrentHeadTeacherByFacility($printable->getAcademicYearClassGroup()->getClassGroup()->getFacilityId());
                $designation = ($facilityHeadTeacher->getId() == "") ? \Neptune\EduPropertyService::getProperty("default.head.teacher.designation", "Principal") : $facilityHeadTeacher->getHeadTeacherDesignation()->getLabel(); 
                $pdf->setCellPaddings(0, 0, 0, 0);
                //Get signature if exists
                if($facilityHeadTeacher->getTeacher()->getUser()->getSignature() != ''){
                    $pdf->writeHTMLCell(40,20, 75, 230, '<div align="center"><img  src="'.$facilityHeadTeacher->getTeacher()->getUser()->getSignaturePath().'"/></div>', 0, 0, false);
                } 
                $pdf->SetFont('helvetica', '', 8);
                $pdf->writeHTMLCell(50, 5, 150, 242, '<div align="center" style="width:100px;z-index:1000;width:100%;margin:0px;padding:0px;">--------------------------------------</div>', 0, 0, false);
                $pdf->writeHTMLCell(50, 5, 150, 248, '<div align="center">'. ((!$facilityHeadTeacher->getTeacher()->isIdEmpty()) ? $facilityHeadTeacher->getTeacher()->getLabel().' <i>('.$facilityHeadTeacher->getTeacher()->getTitle()->getName() .')</i>' : '').'</div>', 0, 0, false);
                $pdf->SetFont('helvetica', '', 9);
                $pdf->writeHTMLCell(50, 5, 150, 252, '<div align="center">'.$designation.'</div>', 0, 1, false);
            }
            
            //Print barcode
            if ($gradePref->printsReportQRCode()) {
                $style = array(
                    'border' => false,
                    'padding' => 0,
                    'fgcolor' => array(100, 100, 100),
                    'bgcolor' => false
                );

                $info = $printable->getStudent()->getFullName()."\n".$printable->getTermSemester()->getName();
                $info .= " (".$printable->getAcademicYearClassGroup()->getClassGroup()->getName().")\n";
                $info .= $printable->getAcademicYearClassGroup()->getAcademicYear()->getName()."\n";
                $info .= $printable->getAcademicYearClassGroup()->getFacility()->getName()."\n";
                $info .= "Term Avg: ".$position['average'][$printable->getStudentId()]['grade']."\n";
                $info .= "Exam Avg: ".$position['examAverage'][$printable->getStudentId()]['grade']."\n";
                $info .= "Final Avg: ".$position['finalAverage'][$printable->getStudentId()]['grade'];
                $pdf->write2DBarcode($info, 'QRCODE,M', 180,10, 50, 50, $style, 'T');
            }
            
            $pdf->lastPage();
            $PDFFileName = $printable->getStudent()->getFullName()."_".$printable->getAcademicYearClassGroup()->getAcademicYear()->getName()."_".$printable->getTermSemester()->getName()."_term_report".'.pdf';
            /**************************************************************
            WATERMARK To SHOW REPORT IS UNOFFICIAL IF NOT APPROPRIATE USER
            **************************************************************/
            if ($user->getId() != $homeroomTeacher->getUserId() && !\Authentication\Model\PermissionManager::userHasPermissionAtFacility('OVERRIDE.HOMEROOM.TEACHER.PRIVILEGE', $user->getId(), $printable->getAcademicYearClassGroup()->getFacilityId())){
                $tipoLetra = "Helvetica";
                $tamanoLetra = 60;
                $estiloLetra = "B";
                $pdf->setTextColor(255, 0, 0);
                // Calcular ancho de la cadena
                $widthCadena = $pdf->GetStringWidth('UNOFFICIAL REPORT', $tipoLetra, $estiloLetra, $tamanoLetra, false );
                $factorCentrado = round(($widthCadena * sin(deg2rad(60))) / 2 ,0);

                // Get the page width/height
                $myPageWidth = $pdf->getPageWidth();
                $myPageHeight = $pdf->getPageHeight();

                // Find the middle of the page and adjust.
                $myX = ( $myPageWidth / 2 ) - $factorCentrado;
                $myY = ( $myPageHeight / 2 ) + $factorCentrado;

                // Set the transparency of the text to really light
                $pdf->SetAlpha(0.2);

                // Rotate 45 degrees and write the watermarking text
                $pdf->StartTransform();
                $pdf->Rotate(60, $myX, $myY);
                $pdf->SetFont($tipoLetra, $estiloLetra, $tamanoLetra);

                $pdf->Text($myX, $myY, 'UNOFFICIAL REPORT');
                $pdf->StopTransform();

                // Reset the transparency to default
                $pdf->SetAlpha(1);
            }

            $outType = ($outputType == '') ? 'I' : \strtoupper($outputType);
            //$data = 
            $pdf->Output($PDFFileName, $outType);
               // }
    } else {
        echo "<div><b>No image to show for supplied parameters";
    }

    