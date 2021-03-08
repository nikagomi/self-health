<?php

require_once (__DIR__.'/../../vendor/autoload.php');
session_start();

use Elasticsearch\ClientBuilder;
use Neptune\{DbMapperUtility, EduPropertyService, Config};

// For grades creating from existing data
$es_username = 'rneptune';
$es_passwd = 'nikagomi';

$facilityCode = \strtoupper(EduPropertyService::getProperty("facility.code", "---"));

$sql = "SELECT DISTINCT b.student_id, a.subject_id, a.term_semester_id, a.academic_year_class_group_id 
FROM edu_class_group_term_semester_subject_grade_activities a, edu_class_group_term_semester_subject_grade_activity_grades b 
WHERE a.class_group_term_semester_subject_grade_activity_id = b.class_group_term_semester_subject_grade_activity_id AND
b.class_group_term_semester_subject_grade_activity_grade_id LIKE '".$facilityCode."%'";
$result = DbMapperUtility::dbQuery($sql);

$client = ClientBuilder::create()->setHosts(["http://".Config::$ELASTICSEARCH_HOST.":".Config::$ELASTICSEARCH_PORT])->setBasicAuthentication($es_username, $es_passwd)->build(); 

   
$params = ['body' => []];
$i = 0;

while ($res = DbMapperUtility::dbFetchArray($result)) {
    $studentGrades = (new Academic\Model\EduClassGroupTermSemesterSubjectGradeActivityGrade())->getStudentSubjectGrade($res[1], $res[3], $res[2], $res[0]);
    $gradeRemark = (new Academic\Model\EduFinalGradeRemark())->getByParameters($res[3], $res[2], $res[1], $res[0]);
    $aycg = (new \Academic\Model\EduAcademicYearClassGroup())->getObjectById($res[3]);
    $student = (new \Student\Model\EduStudent())->getObjectById($res[0]);
    $subject = (new \Academic\Model\EduSubject())->getObjectById($res[1]);
    $ap = (new Academic\Model\EduTermSemester())->getObjectById($res[2]);
    
    $params['body'][] = [
        'index' => [
            '_index' => "student_academic_period_subject_grades",
            '_id' => $res[0]."_".$res[1]."_".$res[2]."_".$res[3],
        ]
    ];

    $params['body'][] = [
        "facility" => $aycg->getFacility()->getESArr(),
        "academic year" => $aycg->getAcademicYear()->getName(),
        "class group" => $aycg->getLabel(),
        "student" => $student->getESArr(),
        "subject" => $subject->getName(),
        "academic period" => $ap->getName(),
        "subject term grade" => $studentGrades['grade'],
        "subject exam grade" => $studentGrades['termExamGrade'],
        "subject final grade" => '',
        "grade level" => $aycg->getClassGroup()->getGradeLevel()->getName(),
        "remarks" => $gradeRemark->getRemarks(),
        "conduct grade" => $gradeRemark->getConductGradeClean(),
        "letter grade" => $gradeRemark->getLetterGrade()
    ];
    
    // Every 1000 documents stop and send the bulk request
    if ($i % 1000 == 0) {
        $responses = $client->bulk($params);

        // erase the old bulk request
        $params = ['body' => []];

        // unset the bulk response when you are done to save memory
        unset($responses);
    }
    $i++;
}

// Send the last batch if it exists
if (!empty($params['body'])) {
    $responses = $client->bulk($params);
}
