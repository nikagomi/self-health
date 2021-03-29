<?php

namespace Patient\Model;

use Neptune\{Logger, Modifiable, DbMapperUtility, PropertyService, Config};

/**
 * Patient
 * @package self-health
 * @author Randal Neptune
 */
class Patient extends Logger implements Modifiable {
    protected $_tableName = "patients";
    protected $primaryKeyField = "patient_id";
    protected $uniqueCombo = [["userId"]];
    protected $uniqueComboErrorMsg = 'The patient is already associated to another user. Please modify.';
    
    protected $fieldMapper = array(
        "id" => array("patient_id", "T"),
        "firstName" => array("first_name", "T"),
        "middleNames" => array("middle_names", "T"),
        "lastName" => array("last_name", "T"),
        "createdById" => array("created_by_id", "T"),
        "modifiedById" => array("modified_by_id", "T"),
        "createdTime" => array("created_time", "TS"),
        "modifiedTime" => array("modified_time", "TS"),
        "userId" => array("user_id", "T"),
        "genderId" => array("gender_id", "T"),
        "dateOfBirth" => array("date_of_birth", "D"),
        "countryId" => array("country_id", "T"),
        "contactNumber" => ["contact_number","T"],
        "otherContactNumber" => ["other_contact_number","T"],
        "religionId" => ["religion_id", "T"],
        "ethnicityId" => ["ethnicity_id", "T"],
        "address" => ["address", "T"],
        "primaryDoctor" => ["primary_doctor","T"],
        "principalHealthCareFacility" => ["principal_health_care_facility","T"]
    );
    
    protected $firstName;
    protected $middleNames;
    protected $lastName;
    protected $createdById;
    protected $modifiedById;
    protected $createdTime;
    protected $modifiedTime;
    protected $userId;
    protected $genderId;
    protected $dateOfBirth;
    protected $countryId;
    protected $contactNumber;
    protected $otherContactNumber;
    protected $religionId;
    protected $ethnicityId;
    protected $principalHealthCareFacility;
    protected $address;
    protected $primaryDoctor;
    
    protected $country;
    protected $gender;
    protected $user;
    protected $religion;
    protected $ethnicity;
    
    protected $labelSortProperty = "lastName";
    
    public function __construct() {
        parent::__construct();
        $this->user = new \Authentication\Model\User();
        $this->gender = new \Admin\Model\Gender();
        $this->country = new \Admin\Model\Country();
        $this->religion = new \Admin\Model\Religion();
        $this->ethnicity = new \Admin\Model\Ethnicity();
    }
    
    
    public function getESArr() {
        $arr = [];
        if (!$this->isIdEmpty()) {
            $arr = [
                "obj_id" => $this->getId(), 
                "name" => $this->getLabel(),
                "first_name" => $this->getFirstName(),
                "last_name" => $this->getLastName(),
                "middle_names" => $this->getMiddleNames(),
                "date_of_birth" => $this->getDateOfBirth(),
                "gender" => $this->getGender()->getName(),
                "country" => $this->getCountry()->getName(),
                "contact_number" => $this->getContactNumber()
            ];
            //$json = \json_encode($arr, JSON_PRETTY_PRINT);
        }
        return (\count($arr) == 0) ? new \stdClass() : $arr;
    }
    
    public function getIndexName() {
        return "patients";
    }
    
    public function constructESDoc() {
        $params = [
            'index' => $this->getIndexName(),
            'id' => $this->getId(),
            'body'  => $this->getESArr()
        ];
        return $params;
    }
    
    public function getFirstName() {
        return $this->firstName;
    }

    public function getMiddleNames() {
        return $this->middleNames;
    }

    public function getLastName() {
        return $this->lastName;
    }

    public function getCreatedById() {
        return $this->createdById;
    }

    public function getModifiedById() {
        return $this->modifiedById;
    }

    public function getCreatedTime() {
        return $this->createdTime;
    }

    public function getModifiedTime() {
        return $this->modifiedTime;
    }

    public function getUserId() {
        return $this->userId;
    }

    public function getGenderId() {
        return $this->genderId;
    }

    public function getDateOfBirth() {
        return $this->dateOfBirth;
    }
    
    public function displayDateOfBirth() {
        return DbMapperUtility::sqlToDisplayDateFormat($this->getDateOfBirth());
    }

    public function showBirthDate(){
        return DbMapperUtility::formatSqlDate($this->getDateOfBirth());
    }

    public function getCountryId() {
        return $this->countryId;
    }

    public function getCountry() {
        return $this->country->getObjectById($this->getCountryId());
    }

    public function getGender() {
        return $this->gender->getObjectById($this->getGenderId());
    }

    public function getUser() {
        return $this->user->getObjectById($this->getUserId());
    }
    
    public function getContactNumber() {
        return $this->contactNumber;
    }
    
    public function getOtherContactNumber() {
        return $this->otherContactNumber;
    }

    public function getReligionId() {
        return $this->religionId;
    }

    public function getEthnicityId() {
        return $this->ethnicityId;
    }

    public function getReligion() {
        return $this->religion->getObjectById($this->getReligionId());
    }

    public function getEthnicity() {
        return $this->ethnicity->getObjectById($this->getEthnicityId());
    }
    
    public function getPrincipalHealthCareFacility() {
        return $this->principalHealthCareFacility;
    }

    public function getAddress() {
        return $this->address;
    }

    public function getPrimaryDoctor() {
        return $this->primaryDoctor;
    }

    public function setPrincipalHealthCareFacility($principalHealthCareFacility) {
        $this->principalHealthCareFacility = $principalHealthCareFacility;
    }

    public function setAddress($address) {
        $this->address = $address;
    }

    public function setPrimaryDoctor($primaryDoctor) {
        $this->primaryDoctor = $primaryDoctor;
    }

    public function setOtherContactNumber($otherContactNumber) {
        $this->otherContactNumber = $otherContactNumber;
    }

    public function setReligionId($religionId) {
        $this->religionId = $religionId;
    }

    public function setEthnicityId($ethnicityId) {
        $this->ethnicityId = $ethnicityId;
    }

    public function setReligion($religion) {
        $this->religion = $religion;
    }

    public function setEthnicity($ethnicity) {
        $this->ethnicity = $ethnicity;
    }

    public function setContactNumber($contactNumber) {
        $this->contactNumber = $contactNumber;
    }

    public function setFirstName($firstName) {
        $this->firstName = $firstName;
    }

    public function setMiddleNames($middleNames) {
        $this->middleNames = $middleNames;
    }

    public function setLastName($lastName) {
        $this->lastName = $lastName;
    }

    public function setCreatedById($createdById) {
        $this->createdById = $createdById;
    }

    public function setModifiedById($modifiedById) {
        $this->modifiedById = $modifiedById;
    }

    public function setCreatedTime($createdTime) {
        $this->createdTime = $createdTime;
    }

    public function setModifiedTime($modifiedTime) {
        $this->modifiedTime = $modifiedTime;
    }

    public function setUserId($userId) {
        $this->userId = $userId;
    }

    public function setGenderId($genderId) {
        $this->genderId = $genderId;
    }

    function setDateOfBirth($dateOfBirth) {
        $this->dateOfBirth = \Neptune\DbMapperUtility::displayToSqlDate($dateOfBirth);
    }

    public function setCountryId($countryId) {
        $this->countryId = $countryId;
    }

    public function setCountry($country) {
        $this->country = $country;
    }

    public function setGender($gender) {
        $this->gender = $gender;
    }

    public function setUser($user) {
        $this->user = $user;
    }

    public function setLabelSortProperty($labelSortProperty) {
        $this->labelSortProperty = $labelSortProperty;
    }

    public function getLabel() {
        return $this->getFirstName()." ".$this->getLastName();
    }
    
    public function __toString() {
        return $this->getLabel();
    }
    
    public function getByUserId ($userId) {
        return $this->getEntityByCriteria("userId", $userId, TRUE);
    }
    
    public function getFullName(){
        return $this->getFirstName()." ".$this->getLastName();
    }
    
     /**
     * Returns the age of a student
     * @return integer
     */
    public function getAge($date = ''){
        $ageDiff = $this->calculateAge($date);
        $age = [];
        if ($ageDiff->y > 0) {
            $age['number'] = $ageDiff->y;
            $age['units'] = "yrs";
        } elseif ($ageDiff->m > 0) {
            $age['number'] = $ageDiff->m;
            $age['units'] = "mnths";
        } elseif ($ageDiff->d > 0) {
            $age['number'] = $ageDiff->d;
            $age['units'] = "dys";
        } else {
            $age['number'] = 0;
            $age['units'] = "";
        }
        return $age;
    }
    
    public function getAgeInYears ($date = '') {
        $ageDiff = $this->calculateAge($date);
        return $ageDiff->y;
    }
    
    public function displayAge ($date = '') {
        $age = $this->getAge($date);
        return $age['number']." ".$age['units'];
    }
    
    private function calculateAge ($date = '') {
        $bday = new \DateTime($this->getDateOfBirth()); // Your date of birth
        $startDate = (\trim($date) == '') ? new \Datetime(\date('Y-m-d')) : new \Datetime($date);
        $ageDiff = $startDate->diff($bday);
        return $ageDiff;
    }
    
    public function displayID () {
        $idPrefix = PropertyService::getProperty("pk.code.prefix", "");
        return \ltrim($this->getId(), \trim($idPrefix));
    }
    
    /**
     * Returns the patient's age at a particular point in time.
     * @param string $date
     * @deprecated since version 1.0
     * @see getAge
     * @return integer
     */
    public function getAgeAtDate($date){
        $sql = "SELECT extract(year from age(timestamp '".$date."', timestamp '".$this->getDateOfBirth()."'))";
        $result = $this->dbFetchArray($this->dbQuery($sql));
        return ($result[0] > 0) ? $result[0] : "";
    }
    
    /**
     * Returns an array of patient objects based on search criteria.
     * @param string $firstName
     * @param string $lastName
     * @param string $genderId
     * @param integer $limit
     * @return array
     */
    public function search($firstName, $lastName, $countryId, $genderId, $limit = 20, $ageRangeStart = '', $ageRangeEnd = ''){
        $objArr = array();
        $ageRangeSQl = "";
        if ($ageRangeStart != '' && $ageRangeEnd != '') {
            $ageRangeSQl = "AND date_part('year', age(s.date_of_birth)) >= ".$ageRangeStart." AND ";
            $ageRangeSQl .= "date_part('year', age(s.date_of_birth)) <= ".$ageRangeEnd." ";
        }
        
        if($firstName != '' && $lastName != ''){
            $countryClause = ($countryId != '') ? " AND s.country_id = '".$countryId."' " : ''; 
            $genderCriteria = ($genderId != '') ? " AND s.gender_id = '".$genderId."' " : '';
            $sql = "select s.".$this->getPK()." FROM ".$this->getTableName()." s WHERE ";
            $sql .= " upper(s.first_name) LIKE '".\strtoupper($firstName)."%' AND upper(s.last_name) LIKE '".\strtoupper($lastName)."%'".$genderCriteria.$countryClause.$ageRangeSQl;
            $sql .= " AND s.".$this->getSoftDeleteFieldName()." = true LIMIT ".$limit;
            //echo $sql;
            $result = $this->dbQuery($sql);
            if($this->dbNumRows($result) > 0){
                $i = 0;
                while($res = $this->dbFetchArray($result)){
                    $objArr[$i]  = (new \Patient\Model\Patient())->getEntityById($res[0]);
                    $i++;
                }
            }
        }
        return $objArr;
    }
    
    public function getLastRecordedHeight() {
        $sql = "select vtri.test_result FROM patient_vital_test_record_items vtri, patient_vital_test_records vtr WHERE 
        vtr.patient_vital_test_record_id = vtri.patient_vital_test_record_id AND vtr.alive = true AND vtr.patient_id = '".$this->getId()."' 
        AND vtri.vital_test_id = (select vt.vital_test_id FROM vital_tests vt where bmi_height_component = TRUE AND vt.alive = true) 
        ORDER BY vtr.record_date DESC LIMIT 1";
        $result = DbMapperUtility::dbQuery($sql);
        $res = DbMapperUtility::dbFetchArray($result);
        return $res[0];
    }
    
    public function currentlySmokes() {
        $smokingDrinkingStatus = (new PatientSmokingDrinkingStatus())->getByPatientId($this->getId());
        return ($smokingDrinkingStatus->isSmoker() && !$smokingDrinkingStatus->hasStoppedSmoking()) ? (bool) true : (bool) false;
    }
    
    public function isSmokerAtDate($date) {
        $smokingDrinkingStatus = (new PatientSmokingDrinkingStatus())->getByPatientId($this->getId());
        return ($smokingDrinkingStatus->isSmoker() && (!$smokingDrinkingStatus->hasStoppedSmoking() || ($smokingDrinkingStatus->hasStoppedSmoking() && \strtotime($smokingDrinkingStatus->getStopSmokingDate()) >= \strtotime($date)))) ? (bool) true : (bool) false;
    }
    
    public function currentlyDrinks() {
        $smokingDrinkingStatus = (new PatientSmokingDrinkingStatus())->getByPatientId($this->getId());
        return ($smokingDrinkingStatus->isDrinker() && !$smokingDrinkingStatus->hasStoppedDrinking()) ? (bool) true : (bool) false;
    }
    
    public function isDrinkerAtDate($date) {
        $smokingDrinkingStatus = (new PatientSmokingDrinkingStatus())->getByPatientId($this->getId());
        return ($smokingDrinkingStatus->isDrinker() && (!$smokingDrinkingStatus->hasStoppedDrinking() || ($smokingDrinkingStatus->hasStoppedDrinking() && \strtotime($smokingDrinkingStatus->getStopDrinkingDate()) >= \strtotime($date)))) ? (bool) true : (bool) false;
    }

}
