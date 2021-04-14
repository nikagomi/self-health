<?php

namespace Patient\Model;

use Neptune\{Logger, DbMapperUtility};

/**
 * PatientCovid19Vaccination
 * @package self-health
 * @author Randal Neptune
 */
class PatientCovid19Vaccination extends Logger {
    protected $_tableName = "patient_covid19_vaccinations";
    protected $primaryKeyField = "patient_covid19_vaccination_id";

    protected $uniqueCombo = [["patientId","covid19VaccineId","doseNumber"]];
    protected $uniqueComboErrorMsg = "The indicated vaccination dose seems to have already been recorded.";

    protected $fieldMapper = [
        "id" => ["patient_covid19_vaccination_id","T"],
        "patientId" => ["patient_id","T"],
        "covid19VaccineId" => ["covid19_vaccine_id","T"],
        "doseNumber" => ["dose_number", "I"],
        "dateReceived" => ["date_received","D"]
    ];
    
    protected $patientId;
    protected $covid19VaccineId;
    protected $doseNumber;
    protected $dateReceived;
    
    protected $patient;
    protected $covid19Vaccine;
    
    public function __construct() {
        parent::__construct();
        $this->patient = new Patient();
        $this->covid19Vaccine = new \Clinical\Model\Covid19Vaccine();
    }
    
    public function getPatientId() {
        return $this->patientId;
    }

    public function getCovid19VaccineId() {
        return $this->covid19VaccineId;
    }

    public function getDoseNumber() {
        return $this->doseNumber;
    }

    public function getDateReceived() {
        return $this->dateReceived;
    }
    
    public function displayDateReceived() {
        return DbMapperUtility::formatSqlDate($this->getDateReceived());
    }

    public function getPatient() {
        return $this->patient->getObjectById($this->getPatientId());
    }

    public function getCovid19Vaccine() {
        return $this->covid19Vaccine->getObjectById($this->getCovid19VaccineId());
    }
    
    public function setPatientId($patientId) {
        $this->patientId = $patientId;
    }

    public function setCovid19VaccineId($covid19VaccineId) {
        $this->covid19VaccineId = $covid19VaccineId;
    }

    public function setDoseNumber($doseNumber) {
        $this->doseNumber = $doseNumber;
    }

    public function setDateReceived($dateReceived) {
        $dateObj = \DateTime::createFromFormat("M d, Y", $dateReceived);
        $this->dateReceived = $dateObj->format("Y-m-d");
    }

    public function setPatient($patient) {
        $this->patient = $patient;
    }

    public function setCovid19Vaccine($covid19Vaccine) {
        $this->covid19Vaccine = $covid19Vaccine;
    }

    public function getByPatientId($patientId) {
        return $this->getObjectsByMultipleCriteria(["patientId"], [$patientId], TRUE);
    }


}
