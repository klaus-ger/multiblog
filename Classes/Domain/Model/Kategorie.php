<?php

/**
 * @scope prototype
 * @entity

 *
 */
class Tx_Multiblog_Domain_Model_Kategorie extends Tx_Extbase_DomainObject_AbstractEntity {

    /**
     * The uid
     * @var int
     * 
     */
    protected $uid;

    /**
     * The Blogid
     * @var int
     * @validate NotEmpty 
     */
    protected $blogid;

    /**
     * The topkategorie
     * @var int
     * 
     */
    protected $topkategorie;

    /**
     * The kategorie
     * @var string
     * 
     */
    protected $kategorie;

    /** Setters for Blog ****************************************** */

    /**
     *
     * Sets the bloguid
     * @param int $blogid 
     * @return void
     *
     */
    Public Function setBlogid($blogid) {
        $this->blogid = $blogid;
    }

    /**
     *
     * Sets the etopkategorie
     * @param int $topkategorie
     * @return void
     *
     */
    Public Function setTopkategorie($topkategorie) {
        $this->topkategorie = $topkategorie;
    }

    /**
     *
     * Sets the Kategorie
     * @param string $kategorie 
     * @return void
     *
     */
    Public Function setKategorie($kategorie) {
        $this->kategorie = $kategorie;
    }

    /** GETTERS *************************** */

    /**
     *
     * Gets the bloguid
     * @return int bloguid
     *
     */
    Public Function getBlogid() {
        Return $this->blogid;
    }

    /**
     *
     * Gets the topkategorie
     * @return int
     *
     */
    Public Function getTopkategorie() {
        Return $this->topkategorie;
    }

    /**
     *
     * Gets the Kategorie
     * @return string kategorie
     *
     */
    Public Function getKategorie() {
        Return $this->kategorie;
    }

}

?>