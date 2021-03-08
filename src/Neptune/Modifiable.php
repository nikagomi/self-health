<?php

namespace Neptune;
/**
 * Interface for logabble classes
 * @package edur
 * @author Randal Neptune
 */
interface Modifiable {
    
    public function getCreatedById();
    public function getModifiedById();
    public function getModifiedTime();
    
    public function setCreatedById($createdById);
    public function setModifiedById($modifiedById);
    public function setModifiedTime($modifiedTime);
}

?>