<?php

namespace T3developer\Multiblog\Domain\Model;

/* * *************************************************************
 *  Copyright notice
 *
 *  (c) 2014 Klaus Heuer <klaus.heuer@t3-developer.com>, t3-developer.com
 *  
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 * ************************************************************* */

/**
 *
 *
 * @package multiblog
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class Post extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

    /**
     * posttitel
     *
     * @var \string
     * 
     */
    protected $posttitel;

    /**
     * Blog Id
     * @var \int
     * 
     */
    protected $blogid;

    /**
     * postintro
     *
     * @var \string
     */
    protected $postintro;

    /**
     * postpicture
     *
     * @var \string
     */
    protected $postpicture;

    /**
     * postdate
     *
     * @var \DateTime
     */
    protected $postdate;

    /**
     * poststatus
     *
     * @var \int
     */
    protected $poststatus;

    /**
     * poststicky
     *
     * @var \int
     */
    protected $poststicky;

    /**
     * postcommentoption
     *
     * @var \int
     */
    protected $postcommentoption;

    /**
     * SEO Description
     *
     * @var \string
     * 
     */
    protected $postseodescription;

    /**
     * Link for real URL
     *
     * @var \string
     * 
     */
    protected $postlink;

    /**
     * Image
     * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
     */
    protected $image;

    /**
     * Files
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference>
     */
    protected $files;

    /**
     * category
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\T3developer\Multiblog\Domain\Model\Category>
     */
    protected $category;

    /**
     * count comments
     * 
     * This value is live calculated and not stored in the DB!
     * @var int
     */
    protected $contComments;

    /**
     * __construct
     *
     * @return Category
     */
    public function __construct() {
        //Do not remove the next line: It would break the functionality
        $this->initStorageObjects();
    }

    /**
     * Initializes all ObjectStorage properties.
     *
     * @return void
     */
    protected function initStorageObjects() {
        /**
         * Do not modify this method!
         * It will be rewritten on each save in the extension builder
         * You may modify the constructor of this class instead
         */
        $this->category = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
    }

    public function getPosttitel() {
        return $this->posttitel;
    }

    public function setPosttitel($posttitel) {
        $this->posttitel = $posttitel;
    }

    public function getBlogid() {
        return $this->blogid;
    }

    public function setBlogid($blogid) {
        $this->blogid = $blogid;
    }

    public function getPostintro() {
        return $this->postintro;
    }

    public function setPostintro($postintro) {
        $this->postintro = $postintro;
    }

    public function getPostpicture() {
        return $this->postpicture;
    }

    public function setPostpicture($postpicture) {
        $this->postpicture = $postpicture;
    }

    public function getPostdate() {
        return $this->postdate;
    }

    public function setPostdate($postdate) {
        $this->postdate = $postdate;
    }

    public function getPoststatus() {
        return $this->poststatus;
    }

    public function setPoststatus($poststatus) {
        $this->poststatus = $poststatus;
    }

    public function getPoststicky() {
        return $this->poststicky;
    }

    public function setPoststicky($poststicky) {
        $this->poststicky = $poststicky;
    }

    public function getPostcommentoption() {
        return $this->postcommentoption;
    }

    public function setPostcommentoption($postcommentoption) {
        $this->postcommentoption = $postcommentoption;
    }

    /**
     * Adds a Event
     *
     * @param \T3developer\Multiblog\Domain\Model\Category $category
     * @return void
     */
    public function addCategory(\T3developer\Multiblog\Domain\Model\Category $category) {
        $this->category->attach($category);
    }

    /**
     * Removes a Event
     *
     * @param \T3developer\Multiblog\Domain\Model\Category $category The Event to be removed
     * @return void
     */
    public function removeCategory(\T3developer\Multiblog\Domain\Model\Category $category) {
        $this->category->detach($category);
    }

    /**
     * Returns the Category
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\T3developer\Multiblog\Domain\Model\Category> $category
     */
    public function getCategory() {
        return $this->category;
    }

    /**
     * Sets the events
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\T3developer\Multiblog\Domain\Model\Category> $category
     * @return void
     */
    public function setCategory(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $category) {
        $this->category = $category;
    }

    /**
     * Returns the image
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference> $image
     */
    public function getImage() {
        return $this->image;
    }

    /**
     * Sets the image
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference> $image
     * @return void
     */
    public function setImage($image) {
        $this->image = $image;
    }

    /**
     * Returns the files
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference> $files
     */
    public function getFiles() {
        return $this->files;
    }

    /**
     * Sets the files
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference> $files
     * @return void
     */
    public function setFiles($files) {
        $this->files = $files;
    }

    public function getPostseodescription() {
        return $this->postseodescription;
    }

    public function setPostseodescription($postseodescription) {
        $this->postseodescription = $postseodescription;
    }

    public function getPostlink() {
        return $this->postlink;
    }

    public function setPostlink($postlink) {
        $this->postlink = $postlink;
    }

    public function getContComments() {
        return $this->contComments;
    }

    public function setContComments($contComments) {
        $this->contComments = $contComments;
    }

}

?>