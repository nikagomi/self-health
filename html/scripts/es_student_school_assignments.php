<?php

require_once (__DIR__.'/../../vendor/autoload.php');
session_start();

use Elasticsearch\ClientBuilder;
use Neptune\{DbMapperUtility, EduPropertyService, Config};

// For student school assignment data
$es_username = 'rneptune';
$es_passwd = 'nikagomi';

$facilityCode = \strtoupper(EduPropertyService::getProperty("facility.code", "---"));

$sql = "select student_school_assignment_id, student_id, facility_id, modified_time, current from edu_student_school_assignments where student_school_assignment_id LIKE '".$facilityCode."%'";
$result = DbMapperUtility::dbQuery($sql);

$client = ClientBuilder::create()->setHosts(["http://".Config::$ELASTICSEARCH_HOST.":".Config::$ELASTICSEARCH_PORT])->setBasicAuthentication($es_username, $es_passwd)->build(); 

   
$params = ['body' => []];
$i = 0;

while ($res = DbMapperUtility::dbFetchArray($result)) {
    
    $student = (new \Student\Model\EduStudent())->getObjectById($res[1]);
    $facility = (new \Admin\Model\EduFacility())->getObjectById($res[2]);
    $modifiedTimeObj = \DateTime::createFromFormat("Y-m-d H:i:s", $res[3]);
    
    $params['body'][] = [
        'index' => [
            '_index' => "student_school_assignments",
            '_id' => $res[0],
        ]
    ];

    $params['body'][] = [
        "facility" => $facility->getESArr(),
        "student" => $student->getESArr(),
        "modified time" => \strtotime($res[3]),
        "current" => ($res[4] == 't' || $res[4] == 1) ? true : false,
        "academic year" => (new \Academic\Model\EduAcademicYear())->getClosestSubsequent($modifiedTimeObj->format("Y-m-d"))->getName()
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
