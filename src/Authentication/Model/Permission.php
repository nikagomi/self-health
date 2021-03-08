<?php

namespace Authentication\Model;

use Neptune\{DbMapper, MessageResources};

/**
 * Permission: Constants that determine what functionality the assignee has access to.
 * @package hiags
 * @author Randal Neptune
 */
class Permission extends DbMapper {

    protected $_tableName = "permissions";
    protected $primaryKeyField = "permission_id";
    protected $uniqueCombo;
    protected $uniqueComboErrorMsg;
    protected $fieldMapper = array(
        "id" => array("permission_id", "I"),
        "submenuNameKey" => array("submenu_name_key","T"),
        "url" => array("url", "T"),
        "categoryId" => array("category_id", "I"),
        "level" => array("level", "I"),
        "level1Id" => array("level1_id", "I"),
        "permTextKey" => array("perm_text_key","T"),
        "constant" => array("constant", "T"),
        "isMenu" => array("is_menu", "B"),
        "isContainer" => array("is_container", "B"),
        "commentKey" => array("comments", "T")
    );

    protected $submenuNameKey;
    protected $url;
    protected $categoryId;
    protected $level;
    protected $level1Id;
   
    protected $permTextKey;
    protected $constant;
    protected $isMenu;
    protected $isContainer;
    protected $commentKey;
    protected $category;
    protected $htmlHelper;

    public function __construct() {
        parent::__construct();
        $this->category = new MenuCategory();
        $this->htmlHelper = new \Neptune\HtmlHelper();
    }

    public function getUrl() {
        return $this->url;
    }

    public function getCategoryId() {
        return $this->categoryId;
    }

    public function getLevel() {
        return $this->level;
    }

    public function getLevel1Id() {
        return $this->level1Id;
    }

    public function getConstant() {
        return $this->constant;
    }

    public function getIsMenu() {
        return ($this->isMenu == 1 or $this->isMenu == 't') ? (bool) true : (bool) false;
    }

    public function getIsContainer() {
        return ($this->isContainer == 1 or $this->isContainer == 't') ? (bool) true : (bool) false;
    }

    public function getCategory() {
        return $this->category->getEntityById($this->getCategoryId());
    }

    public function getCommentKey() {
        return $this->commentKey;
    }
    
    public function getSubmenuNameKey() {
        return $this->submenuNameKey;
    }

    public function getPermTextKey() {
        return $this->permTextKey;
    }

    public function setSubmenuNameKey($submenuNameKey) {
        $this->submenuNameKey = $submenuNameKey;
    }

    public function setPermTextKey($permTextKey) {
        $this->permTextKey = $permTextKey;
    }

    public function setCommentKey($commentKey) {
        $this->commentKey = $commentKey;
    }

    public function setUrl($url) {
        $this->url = $url;
    }

    public function setCategoryId($categoryId) {
        $this->categoryId = $categoryId;
    }

    public function setLevel($level) {
        $this->level = $level;
    }

    public function setLevel1Id($level1Id) {
        $this->level1Id = $level1Id;
    }

    public function setConstant($constant) {
        $this->constant = \strtoupper($constant);
    }

    public function setIsMenu($isMenu) {
        $this->isMenu = $isMenu;
    }

    public function setIsContainer($isContainer) {
        $this->isContainer = $isContainer;
    }

    public function setCategory($category) {
        $this->category = $category;
    }

    public function getCheckboxIdsByCategoryId($categoryId, $truncate = false, $truncateLength = 24) {
        $objArr = array();
        $sql = "SELECT " . $this->getPK() . " FROM " . $this->getTableName() . " WHERE category_id = " . $categoryId;
        $sql .= " AND is_container = false AND " . $this->getSoftDeleteFieldName() . " = true";
        $result = $this->dbQuery($sql);
        if ($this->dbNumRows($result) > 0) {
            while ($res = $this->dbFetchArray($result)) {
                $idx = $res['permission_id'];
                $objArr[$idx] = ($truncate && \strlen($res['perm_text']) > $truncateLength) ? "<span class='hotspot' title='" . $res['perm_text'] . "'>" . $this->htmlHelper->truncateString($res['perm_text'], $truncateLength) . "</span>" : $res['perm_text'];
            }
        }
        return $objArr;
    }

    /**
     * gets menu container id  for a permission if it doesn't exist.
     * @param type $permId
     * @return integer
     */
    public function getContainerId($permId) {
        $sql = "SELECT level1_id from " . $this->getTableName() . " WHERE " . $this->getPK() . " = " . $permId;
        $sql .= " AND is_menu = true AND " . $this->getSoftDeleteFieldName() . " = true";
        $res = $this->dbFetchArray($this->dbQuery($sql));
        return $res[0];
    }

    /**
     * Returns the permission identifier (id) given its constant value.
     * @param string $constant
     * @return integer 
     */
    public function getPermissionIdByConstant($constant) {
        $sql = " SELECT " . $this->getPk() . " FROM " . $this->getTableName() . " WHERE upper(const) = '" . strtoupper($constant) . "'";
        $sql .= " AND " . $this->getSoftDeleteFieldName() . " = true";
        //echo $sql;
        $res = $this->dbFetchArray($this->dbQuery($sql));
        return $res[0];
    }

    /**
     * Returns checkbox ready array for permissions from the array that fall into the category provided
     * @param array $perms
     * @param integer $categoryId
     * @deprecated since version 2
     * @return array
     */
    public function selectPermissionIdsByCategoryIdForCheckbox(array $perms, $categoryId, $truncate = false, $truncateLength = 24) {
        $checkboxArr = array();
        $i = 0;
        foreach ($perms as $perm) {
            if ($perm->getCategoryId() == $categoryId) {
                $idx = $perm->getId();
                $checkboxArr[$idx] = ($truncate && \strlen($perm->getPermText()) > $truncateLength) ? "<span class='hotspot' title='" . $perm->getPermText() . "'>" . $this->htmlHelper->truncateString($perm->getPermText(), $truncateLength) . "</span>" : $perm->getPermText();
                $i++;
            }
        }
        return $checkboxArr;
    }


    /**
     * Returns an array of permission objects that correspond to the category
     * @param integer $categoryId
     * @return array
     */
    public function getByCategoryId($categoryId) {
        $objArr = array();
        $sql = "SELECT " . $this->getPK() . " FROM " . $this->getTableName() . " WHERE category_id = " . $categoryId;
        $sql .= " AND is_container = false AND " . $this->getSoftDeleteFieldName() . " = true ";
        $result = $this->dbQuery($sql);
        if($this->dbNumRows($result) > 0){
            while($res = $this->dbFetchArray($result)){
                array_push($objArr, (new $this->className())->getObjectById($res[0]));
            }
        }
        return $objArr;
    }
    
    
    public function getLevelOneMenus(){
        return $this->getObjectsByMultipleCriteria(["isMenu","isContainer"], [TRUE, TRUE], TRUE);
    }

    public function getLabel(){
        return MessageResources::i18n($this->getSubmenuNameKey());
    }
    
    public function getSubMenusByCategory ($categoryId) {
        return (new $this->className())->getObjectsByMultipleCriteria (["categoryId","isContainer","isMenu"],[$categoryId, TRUE, TRUE], true);
    }
}
