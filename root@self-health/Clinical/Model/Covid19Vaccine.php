<?php

namespace Clinical\Model;

use Neptune\DbMapper;

/**
 * Covid19Vaccine
 * @package self-health
 * @author Randal Neptune
 */
class Covid19Vaccine extends DbMapper {
    protected $_tableName = "covid19_vaccines";
    protected $primaryKeyField = "covid19_vaccine_id";

    protected $uniqueCombo = [["manufacturer","doseAmount"]];
    protected $uniqueComboErrorMsg = "A vaccine with the same manufacturer and dose amount has already been defined.";

    protected $fieldMapper = [
        "id" => ["covid19_vaccine_id","T"],
        "manufacturer" => ["manufacturer","T"],
        "doseAmount" => ["dose_amount","I"]
    ];
    
    protected $manufacturer;
    protected $doseAmount;
    
    public function getManufacturer() {
        return $this->manufacturer;
    }

    public function getDoseAmount() {
        return $this->doseAmount;
    }

    public function setManufacturer($manufacturer) {
        $this->manufacturer = $manufacturer;
    }

    public function setDoseAmount($doseAmount) {
        $this->doseAmount = $doseAmount;
    }
    
    public function getLabel() {
        return $this->getManufacturer()." (".$this->getDoseAmount()." dose)";
    }


}
