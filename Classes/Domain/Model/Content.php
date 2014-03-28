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
class Content extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

    /**
     * posttitel
     *
     * @var \int
     * 
     */
    protected $postid;

    /**
     * Blog Id
     * @var \string
     * 
     */
    protected $postcontent;

    /**
     * Image
     * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
     */
    protected $postpicture;

    /**
     * posttitel
     *
     * @var \int
     * 
     */
    protected $imageposition;

    public function getPostid() {
        return $this->postid;
    }

    public function setPostid($postid) {
        $this->postid = $postid;
    }

    public function getPostcontent() {
        return $this->postcontent;
    }

    public function setPostcontent($postcontent) {
        $this->postcontent = $postcontent;
    }

    public function getImageposition() {
        return $this->imageposition;
    }

    public function setImageposition($imageposition) {
        $this->imageposition = $imageposition;
    }

    /**
     * Returns the image
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference> $postpicture
     */
    public function getPostpicture() {
        return $this->postpicture;
    }

    /**
     * Sets the image
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference> $postpicture
     * @return void
     */
    public function setPostpicture($postpicture) {
        $this->postpicture = $postpicture;
    }

}

?>