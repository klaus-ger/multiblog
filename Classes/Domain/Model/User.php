<?php
/**
 * @scope prototype
 * @entity
 */


class Tx_Multiblog_Domain_Model_User extends Tx_Extbase_Domain_Model_FrontendUser {

    /**
     * @var int
     */
    protected $uid;


    /**
     * @var string
     */
    protected $username;



    public function getUid() {
        return $this->uid;
    }

    public function setUid($uid) {
        $this->uid = $uid;
    }

    public function getUsername() {
        return $this->username;
    }

    public function setUsername($username) {
        $this->username = $username;
    }









}

?>