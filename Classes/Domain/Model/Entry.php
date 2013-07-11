<?php


class Tx_Multiblog_Domain_Model_Entry extends Tx_Extbase_DomainObject_AbstractEntity {

    /**
     * The uid
     * @var int
     * @validate NotEmpty 
     */
    protected $pid;
    
    
    /**
     * The uid
     * @var int
     * @validate NotEmpty 
     */
    protected $uid;

    /**
     * The Blogid
     * @var int
     * 
     */
    protected $blogid;

    /**
     * The entrytitel
     * @var string
     * 
     */
    protected $entrytitel;

    /**
     * The entryanleser
     * @var string
     * @validate NotEmpty 
     */
    protected $entryanleser;

    /**
     * The entrypicture
     * @var string
     * 
     */
    protected $entrypicture;
    
     /**
     * The entrypicturedelete
     * @var boolean
     * 
     */
    protected $entrypicturedelete;
    
        /**
     * The currentpicture
     * @var string
     * 
     */
    protected $currentpicture;

    /**
     * The entrypictureposition
     * @var int
     * 
     */
    protected $entrypictureposition;

    /**
     * The entrytext
     * @var string
     * 
     */
    protected $entrytext;

    /**
     * The entrydate
     * @var DateTime
     * 
     */
    protected $entrydate;

    /**
     * The entrykategorie1
     * @var Tx_Multiblog_Domain_Model_Kategorie
     * 
     */
    protected $entrykategorie1;

    /**
     * The entrykategorie2
     * @var Tx_Multiblog_Domain_Model_Kategorie
     * 
     */
    protected $entrykategorie2;

    /**
     * The entrykategorie3
     * @var Tx_Multiblog_Domain_Model_Kategorie
     * 
     */
    protected $entrykategorie3;

    /**
     * The entrykategorie4
     * @var Tx_Multiblog_Domain_Model_Kategorie
     * 
     * 
     */
    protected $entrykategorie4;

    /**
     * The Entrystatus
     * @var int
     * 
     */
    protected $entrystatus;
    
    /**
     * The Entrysticky
     * @var int
     * 
     */
    protected $entrysticky;
    
    
    public function __construct() {
        $this->entrydate = new DateTime();
       
    }

    /** Setters for Blog ****************************************** */

        /**
     *
     * Sets the pid
     * @param int $pid The Receiver
     * @return void
     *
     */
    Public Function setPid($pid) {
        $this->pid = $pid;
    }
    
    /**
     *
     * Sets the uid
     * @param int $uid The Receiver
     * @return void
     *
     */
    Public Function setUid($uid) {
        $this->uid = $uid;
    }

    /**
     *
     * Sets the blogid
     * @param int $uid The Blogid
     * @return void
     *
     */
    Public Function setBlogid($blogid) {
        $this->blogid = $blogid;
    }

    /**
     *
     * Sets the entrytitel
     * @param string $entrytitel The Entrytitel
     * @return void
     *
     */
    Public Function setEntrytitel($entrytitel) {
        $this->entrytitel = $entrytitel;
    }

    /**
     *
     * Sets the entryanleser
     * @param string $entryanleser The Anleser
     * @return void
     *
     */
    Public Function setEntryanleser($entryanleser) {
        $this->entryanleser = $entryanleser;
    }

    /**
     *
     * Sets the entrypicture
     * @param string $entrypicture The Picture of the Entry
     * @return void
     *
     */
    Public Function setEntrypicture($entrypicture) {
        $this->entrypicture = $entrypicture;
    }
    
        /**
     *
     * Sets the entrypicturedelete
     * @param boolean $entrypicturedelete The Picture of the Entry
     * @return void
     *
     */
    Public Function setEntrypicturedelete($entrypicturedelete) {
        $this->entrypicturedelete = $entrypicturedelete;
    }
    
    /**
     *
     * Sets the currentpicture
     * @param string $currentpicture The Picture of the Entry
     * @return void
     *
     */
    Public Function setCurrentpicture($currentpicture) {
        $this->currentpicture = $currentpicture;
    }
    /**
     *
     * Sets the entrypictureposition
     * @param int $entrypictureposition The blogcss
     * @return void
     *
     */
    Public Function setEntrypictureposition($entrypictureposition) {
        $this->entrypictureposition = $entrypictureposition;
    }

    /**
     *
     * Sets the entrytext
     * @param string $entrytext 
     * @return void
     *
     */
    Public Function setEntrytext($entrytext) {
        $this->entrytext = $entrytext;
    }

    /**
     *
     * Sets the entrydate
     * @param DateTime $entrydate
     * @return void
     *
     */
    Public Function setEntrydate(DateTime $entrydate) {
        $this->entrydate = $entrydate;
    }

    /**
     *
     * Sets the entrykategorie1
     * @param int $entrykategorie1 The blogcss
     * @return void
     *
     */
    Public Function setEntrykategorie1($entrykategorie1) {
        $this->entrykategorie1 = $entrykategorie1;
    }

    /**
     *
     * Sets the entrykategorie2
     * @param int $entrykategorie2 The blogcss
     * @return void
     *
     */
    Public Function setEntrykategorie2($entrykategorie2) {
        $this->entrykategorie2 = $entrykategorie2;
    }

    /**
     *
     * Sets the entrykategorie3
     * @param int $entrykategorie3 The blogcss
     * @return void
     *
     */
    Public Function setEntrykategorie3($entrykategorie3) {
        $this->entrykategorie3 = $entrykategorie3;
    }

    /**
     *
     * Sets the entrykategorie4
     * @param int $entrykategorie4 The blogcss
     * @return void
     *
     */
    Public Function setEntrykategorie4($entrykategorie4) {
        $this->entrykategorie4 = $entrykategorie4;
    }

    /**
     *
     * Sets the entrystatus
     * @param int $entrystatus The Receiver
     * @return void
     *
     */
    Public Function setEntrystatus($entrystatus) {
        $this->entrystatus = $entrystatus;
    }
    
    /**
     *
     * Sets the entrysticky
     * @param int $entrysticky 
     * @return void
     *
     */
    Public Function setEntrysticky($entrysticky) {
        $this->entrysticky = $entrysticky;
    }

    /** GETTERS *************************** */
    /**
     *
     * Gets the pid
     * @return int pid
     *
     */
    Public Function getPid() {
        Return $this->pid;
    }
    /**
     *
     * Gets the blogid
     * @return int blogid
     *
     */
    Public Function getBlogid() {
        Return $this->blogid;
    }

    /**
     *
     * Gets the entrytitel
     * @return string
     *
     */
    Public Function getEntrytitel() {
        Return $this->entrytitel;
    }

    /**
     *
     * Gets the entryanleser
     * @return string entryanleser
     *
     */
    Public Function getEntryanleser() {
        Return $this->entryanleser;
    }

    /**
     *
     * Gets the entrypicture
     * @return string entrypicture
     *
     */
    Public Function getEntrypicture() {
        Return $this->entrypicture;
    }
    
    /**
     *
     * Gets the entrypicturedelete
     * @return boolean entrypicturedelete
     *
     */
    Public Function getEntrypicturedelete() {
        Return $this->entrypicturedelete;
    }
    /**
     *
     * Gets the currentpicture
     * @return string currentpicture
     *
     */
    Public Function getCurrentpicture() {
        Return $this->currentpicture;
    }
    /**
     *
     * Gets the entrypictureposition
     * @return int entrypictureposition
     *
     */
    Public Function getEntrypictureposition() {
        Return $this->entrypictureposition;
    }

    /**
     *
     * Gets the entrytext
     * @return string entrytext
     *
     */
    Public Function getEntrytext() {
        Return $this->entrytext;
    }

    /**
     *
     * Gets the entrydate
     * @return DateTime
     *
     */
    Public Function getEntrydate() {
        Return $this->entrydate;
    }

    /**
     *
     * Gets the entrykategorie1
     * @return int entrykategorie1
     *
     */
    Public Function getEntrykategorie1() {
        Return $this->entrykategorie1;
    }

    /**
     *
     * Gets the entrykategorie2
     * @return int entrykategorie2
     *
     */
    Public Function getEntrykategorie2() {
        Return $this->entrykategorie2;
    }

    /**
     *
     * Gets the entrykategorie3
     * @return int entrykategorie3
     *
     */
    Public Function getEntrykategorie3() {
        Return $this->entrykategorie3;
    }

    /**
     *
     * Gets the entrykategorie4
     * @return int entrykategorie4
     *
     */
    Public Function getEntrykategorie4() {
        Return $this->entrykategorie4;
    }

    /**
     *
     * Gets the entrystatus
     * @return int entrystatus
     *
     */
    Public Function getEntrystatus() {
        Return $this->entrystatus;
    }

    /**
     *
     * Gets the entrysticky
     * @return int entrysticky
     *
     */
    Public Function getEntrysticky() {
        Return $this->entrysticky;
    }
}

?>