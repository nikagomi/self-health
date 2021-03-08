<?php


namespace Utility\Controller;
use Neptune\{BaseController, DbMapperUtility, EduPropertyService, MessageResources};

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Description of StudentFromExcelUploadController
 * @package sarms
 * @version  1.2.0
 * @author Randal Neptune
 */
class StudentFromExcelUploadController extends BaseController {
    protected $template = "utility/files/uploadStudentExcel.tpl";
    private $actionPage = "/utility/student/excel/upload";
    protected $columnArray = ["first_name", 'middle_names', 'last_name', 'sex', 'date_of_birth', 'national_identifier','country_of_birth',
                              "address", "district", 'primary_contact', 'other_contact', 'religion', 'sports_house'];
    
    public function uploadStudentForm () {
        $this->_edu->assign("actionPage", $this->actionPage);
        $this->_edu->assign("academicYears", DbMapperUtility::convertObjectArrayToDropDown((new \Academic\Model\EduAcademicYear())->getCurrentAndAfter()));
        return new Response ($this->_edu->display($this->template));
    }
    
    public function uploadStudentsFromFile (Request $request) {
        $xlsFile = $request->files->get("studentFile");
        $ayClassGroupId = $request->request->get("academicYearClassGroupId");
        $objReader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        
        //$objReader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader();//load($xlsFile);
        
        //$objReader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx(); //\PHPExcel_IOFactory::createReader('Excel2007');
        if (!$objReader->canRead($xlsFile)) {
            $this->_edu->assign("msg", $this->html->printMessageText(false, "Cannot read the uploaded file"));
        } else {
            $errors = [];
            $students = [];
            $sportsHouseId = '';
            $objReader->setReadDataOnly(true);
            $spreadsheet = $objReader->load($xlsFile);
            $objWorksheet = $spreadsheet->setActiveSheetIndex(0); //first sheet
            
            //Determine the dimaensions of the worksheet
            $highestRow = $objWorksheet->getHighestRow();
            $highestColumn = $objWorksheet->getHighestColumn();
            $highestColumnIndex = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highestColumn); 
            
            if ($highestRow > 151 || $highestColumnIndex > 13) {
                $this->_edu->assign("msg", $this->html->printMessageText(false, "Rows or columns exceed maximum limits"));
            } else {
                //now iterate through the rows and columns to make sure everything is ok
                $errIdx = 0;
                $errorCnt = 0;
                for ($row = 2; $row <= $highestRow; $row++) {
                    $errors[$errIdx] = array();
                    $errors[$errIdx]['rowDetails'] = array();
                    
                    $hasErrors = false;
                    $student = new \Student\Model\EduStudent();
                    for ($col = 1; $col <= 13; $col++) {
                        
                        $cellValue = \trim($objWorksheet->getCellByColumnAndRow($col, $row)->getValue());
                        
                        switch ($col) {
                            case 1:
                                if ($this->validateContent($cellValue, 80) === true) {
                                    $student->setFirstName(\ucwords($cellValue));
                                } else {
                                    $hasErrors = true;
                                    $colName = $this->columnArray[$col-1];
                                    $errors[$errIdx]['rowDetails'][$colName] = $this->validateContent($cellValue, 80);
                                }
                                break;
                            case 2:
                                if ($this->validateContent($cellValue, 120, false) === true) {
                                    $student->setMiddleNames(\ucwords($cellValue));
                                } else {
                                    $hasErrors = true;
                                    $colName = $this->columnArray[$col-1];
                                    $errors[$errIdx]['rowDetails'][$colName] = $this->validateContent($cellValue, 80, false);
                                }
                                break;
                            case 3:
                                if ($this->validateContent($cellValue, 80) === true) {
                                    $student->setLastName(\ucwords($cellValue));
                                } else {
                                    $hasErrors = true;
                                    $colName = $this->columnArray[$col-1];
                                    $errors[$errIdx]['rowDetails'][$colName] = $this->validateContent($cellValue, 80);
                                }
                                break;
                            case 4:
                                $gender = (new \Admin\Model\EduGender())->getByName($cellValue);
                                if (!$gender->isIdEmpty()) {
                                    $student->setGenderId($gender->getId());
                                } else {
                                    $hasErrors = true;
                                    $colName = $this->columnArray[$col-1];
                                    $errors[$errIdx]['rowDetails'][$colName] = "value not recognized";
                                }
                                break;
                            case 5:
                                $dateValue = \PhpOffice\PhpSpreadsheet\Style\NumberFormat::toFormattedString($cellValue, 'M/D/YYYY');
                                $date = \DateTime::createFromFormat('m/d/Y', $dateValue);
                                if ($date !== false) {
                                    $student->setDateOfBirth($date->format("d/m/Y"));
                                } else {
                                    $hasErrors = true;
                                    $colName = $this->columnArray[$col-1];
                                    $errors[$errIdx]['rowDetails'][$colName] = "Incorrect format/Invalid";
                                }
                                break;
                            case 6: //student identifier not required
                                if ($cellValue != '') {
                                    $idFormat = EduPropertyService::getProperty("student.identifier.format","");
                                    if (\trim($idFormat) == '') {
                                        $student->setStudentIdentifier('');
                                    } elseif (\trim($idFormat) != '') {
                                        $regexExp = DbMapperUtility::convertJSMatchRegex($idFormat);
                                        if (\preg_match($regexExp, $cellValue)) {
                                            $student->setStudentIdentifier($cellValue);
                                        } else {
                                            $hasErrors = true;
                                            $colName = $this->columnArray[$col-1];
                                            $errors[$errIdx]['rowDetails'][$colName] = "Incorrect format/invalid";
                                        }
                                    }
                                }
                                break;
                            case 7: //not a required field
                                if ($cellValue != '') {
                                    $country = (new \Admin\Model\EduCountry())->getByName($cellValue);
                                    if (!$country->isIdEmpty()) {
                                        $student->setCountryOfBirthId($country->getId());
                                    } else {
                                        $hasErrors = true;
                                        $colName = $this->columnArray[$col-1];
                                        $errors[$errIdx]['rowDetails'][$colName] = "Value not recognized";
                                    }
                                }
                                break;
                            case 8: //not a required field
                                if ($this->validateContent($cellValue, 150, false) === true) {
                                    $student->setAddressLine1($cellValue);
                                } else {
                                    $hasErrors = true;
                                    $colName = $this->columnArray[$col-1];
                                    $errors[$errIdx]['rowDetails'][$colName] = $this->validateContent($cellValue, 150, false);
                                }
                                break;
                            case 9:
                                $district = (new \Admin\Model\EduDistrict())->getByName($cellValue);
                                if (!$district->isIdEmpty()) {
                                    $student->setDistrictId($district->getId());
                                } else {
                                    $hasErrors = true;
                                    $colName = $this->columnArray[$col-1];
                                    $errors[$errIdx]['rowDetails'][$colName] = "Value not recognized";
                                }
                                break;
                            case 10:
                                if ($this->validateContent($cellValue, 15) === true) {
                                    $student->setPrimaryContactNumber($cellValue);
                                } else {
                                    $hasErrors = true;
                                    $colName = $this->columnArray[$col-1];
                                    $errors[$errIdx]['rowDetails'][$colName] = $this->validateContent($cellValue, 15);
                                }
                                break;
                            case 11:
                                if ($this->validateContent($cellValue, 20, false) === true) {
                                    $student->setOtherContactNumber($cellValue);
                                } else {
                                    $hasErrors = true;
                                    $colName = $this->columnArray[$col-1];
                                    $errors[$errIdx]['rowDetails'][$colName] = $this->validateContent($cellValue, 20, false);
                                }
                                break;
                            case 12:
                                if ($cellValue != '') {
                                    $religion = (new \Admin\Model\EduReligion())->getByName($cellValue);
                                    if (!$religion->isIdEmpty()) {
                                        $student->setReligionId($religion->getId());
                                    } else {
                                        $hasErrors = true;
                                        $colName = $this->columnArray[$col-1];
                                        $errors[$errIdx]['rowDetails'][$colName] = "Value not recognized";
                                    }
                                }
                                break;
                            case 13:
                                if ($cellValue != '') {
                                    $sportsHouse = (new \Academic\Model\EduSportsHouse())->getByName($cellValue);
                                    if (!$sportsHouse->isIdEmpty()) {
                                        $sportsHouseId = $sportsHouse->getId();
                                    } else {
                                        $hasErrors = true;
                                        $colName = $this->columnArray[$col-1];
                                        $errors[$errIdx]['rowDetails'][$colName] = "Value not recognized";
                                    }
                                } else {
                                     $sportsHouseId = "SPRTH";
                                }
                                break;
                        }
                    }
                    //Now if no errors exist, populate student array
                    if (!$hasErrors) {
                        $students[$row] = ['student' => $student, 'sportsHouseId' => $sportsHouseId];
                        unset($errors[$errIdx]);
                    } else {
                        $errorCnt++;
                        $errors[$errIdx]['rowDetails']['rowNumber'] = $row;
                    }
                    $errIdx++;
                }
                //Iterated through all rows, if no errors proceed to save into db
                if ($errorCnt > 0) {
                    $this->_edu->assign("msg", $this->html->printMessageText(false, "Errors exist and must be addressed before proceeding. See table below."));
                    $this->_edu->assign("errors", $errors);
                } else {
                    //Prep DB stuff
                    $sql = '';
                    $now = \date('Y-m-d H:i:s');
                    $userId = $_SESSION['userId'];
                    $facilityId = $_SESSION['facilityId'];
                    $errorText = '';
                    
                    $schoolAssignments = [];
                    $classGroupAssignments = [];
                    $sportsHouses = [];
                    
                    foreach ($students as $row => $studentArr) {
                        $estudiante = $studentArr['student'];
                        $houseId = $studentArr['sportsHouseId'];
                        
                        $id = \trim($estudiante->constructPk(), "'");
                        $estudiante->setId($id);
                        $estudiante->setCreatedById($userId);
                        $estudiante->setModifiedById($userId);
                        $estudiante->setModifiedTime($now);
                        $estudiante->saveTest();
                        if ($estudiante->getOpStatus()) {
                            $sql .= $estudiante->generateSaveSql();
                            if ($_SESSION['isEducational']) {
                                //Assign student to this facility
                                $schoolAssignment = (new \Student\Model\EduStudentSchoolAssignment());
                                $schoolAssignment->setFacilityId($facilityId);
                                $schoolAssignment->setStudentId($id);
                                $schoolAssignment->setCurrent(true);
                                $schoolAssignment->setCreatedById($userId);
                                $schoolAssignment->setModifiedById($userId);
                                $schoolAssignment->setModifiedTime($now);
                                \array_push($schoolAssignments, $schoolAssignment);
                               
                                //Sporting house if available
                                if ($houseId != '' && $houseId != 'SPRTH') {
                                    $studentHouse = (new \Student\Model\EduStudentSportsHouse());
                                    $studentHouse->setStudentId($id);
                                    $studentHouse->setSportsHouseId($houseId);
                                    $studentHouse->setFacilityId($facilityId);
                                    \array_push($sportsHouses, $studentHouse);
                                }
                                
                                //Class group assignments
                                if ($ayClassGroupId != '') {
                                    $classGroupAssignment = new \Student\Model\EduStudentClassGroupAssignment();
                                    $classGroupAssignment->setStudentId($id);
                                    $classGroupAssignment->setAcademicYearClassGroupId($ayClassGroupId);
                                    $classGroupAssignment->setCurrent(true);
                                    $classGroupAssignment->setCreatedById($userId);
                                    $classGroupAssignment->setModifiedById($userId);
                                    $classGroupAssignment->setModifiedTime($now);
                                    \array_push($classGroupAssignments, $classGroupAssignment);
                                }
                            }
                        } else {
                            $errorText .= "<div style='font-size:1.0rem;padding-left:7px;color:#006699;'><b>".$estudiante->getName()."</b> may already be recorded in the system so wasn't saved.</div>";
                        }
                    }
                    //Now save sql through a transaction
                    $dbTrx = 'BEGIN TRANSACTION; ' . $sql . ' COMMIT;';
                    $msg = '';
                    //echo $dbTrx;
                    $result = DbMapperUtility::dbQuery($dbTrx);
                    if ($result !== false) {
                        $msg .= $this->html->printMessageText(true,"All students from rows 2 - ".$highestRow." were successfully uploaded");
                        if ($_SESSION['isEducational']) {
                            $otherSql = '';
                            foreach ($schoolAssignments as $sa) {
                                $otherSql .= $sa->generateSaveSql();
                            }
                            foreach ($sportsHouses as $sh) {
                                $otherSql .= $sh->generateSaveSql();
                            }
                            foreach ($classGroupAssignments as $cga) {
                                $otherSql .= $cga->generateSaveSql();
                            }
                            $otherTrx = 'BEGIN TRANSACTION; ' . $otherSql. ' COMMIT;';
                            $otherResult = DbMapperUtility::dbQuery($otherTrx);
                            if ($otherResult !== false) {
                                $msg .= $this->html->printMessageText(true,"School assignments and sports house assignments were also created for students.");
                            } else {
                                $msg .= $this->html->printMessageText(false,"An error occurred. Could not create school assignments and sports house assignments.");
                            }
                        }
                        
                    } else {
                        $msg = $this->html->printMessageText(false,"An error occurred. Could not upload students to SM@RT.");
                    }
                    $this->_edu->assign("msg", $msg);
                }
                
            }
            
        }
        //Display of template occurs here
        $this->_edu->assign("errorText", $errorText);
        $this->_edu->assign("actionPage", $this->actionPage);
        return new Response ($this->_edu->display($this->template));
    }
    
    private function validateContent ($name, $length, $required = true) {
        if (\strlen(\trim($name)) == 0 && $required) {
            return "Required but empty";
        } elseif (\strlen(\trim($name)) > $length) {
            return "Exceeds ".$length." chars";
        } else {
            return true;
        }
    }
    
    
    
    
}
