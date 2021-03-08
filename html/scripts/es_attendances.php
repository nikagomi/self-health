<?php

require_once (__DIR__.'/../../vendor/autoload.php');
session_start();

use Elasticsearch\ClientBuilder;
use Neptune\{DbMapperUtility, EduPropertyService, Config};

// For attendance creatin from old data
$es_username = 'rneptune';
$es_passwd = 'nikagomi';

$facilityCode = \strtoupper(EduPropertyService::getProperty("facility.code", "---"));
$sql = "select daily_student_attendance_record_id FROM edu_daily_student_attendance_records where daily_student_attendance_record_id LIKE '".$facilityCode."%'";
$result = DbMapperUtility::dbQuery($sql);

$client = ClientBuilder::create()->setHosts(["http://".Config::$ELASTICSEARCH_HOST.":".Config::$ELASTICSEARCH_PORT])->setBasicAuthentication($es_username, $es_passwd)->build(); 

   
$params = ['body' => []];
$i = 0;

while ($res = DbMapperUtility::dbFetchArray($result)) {
    $newInstance = (new \Academic\Model\EduDailyStudentAttendanceRecord())->getObjectById($res[0]);
    $params['body'][] = [
        'index' => [
            '_index' => 'attendances',
            '_id' => $newInstance->getId()
            ]
    ];

    $params['body'][] = [
        'date' => $newInstance->getDailyClassGroupAttendanceRecord()->getAttendanceDate(),
        'attendance interval' => $newInstance->getDailyClassGroupAttendanceRecord()->getAttendanceInterval()->getName(),
        'class group' => $newInstance->getDailyClassGroupAttendanceRecord()->getAcademicYearClassGroup()->getLabel(),
        'academic year' => $newInstance->getDailyClassGroupAttendanceRecord()->getAcademicYearClassGroup()->getAcademicYear()->getName(),
        'academic period' => $newInstance->getDailyClassGroupAttendanceRecord()->getTermSemester()->getName(),
        'facility' => $newInstance->getDailyClassGroupAttendanceRecord()->getAcademicYearClassGroup()->getFacility()->getName(),
        'grade level' => $newInstance->getDailyClassGroupAttendanceRecord()->getAcademicYearClassGroup()->getClassGroup()->getGradeLevel()->getName(),
        'student' => $newInstance->getStudent()->getESArr(),
        'attendance status' => $newInstance->convertAttendanceStatusToText($newInstance->isPresent(), $newInstance->isLate(), $newInstance->isAbsent())
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
