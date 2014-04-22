<?php

namespace T3developer\Multiblog\Domain\Repository;

/* * *************************************************************
 *  Copyright notice
 *
 *  (c) 2013 Klaus Heuer | t3-developer.com
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

class PostRepository extends \TYPO3\CMS\Extbase\Persistence\Repository {
    //protected $defaultOrderings = array('category' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING);

    /**
     * find Sticky Posts by Blog
     * 
     * @param int $blogId Blog Uid
     * @return object
     */
    public function findStickyPosts($blogId) {
        $orderings = array('postdate' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_DESCENDING);
        $query = $this->createQuery();
        $query->setOrderings($orderings);
        $query->matching(
                $query->logicalAnd(array(
                    $query->equals('blogid', $blogId),
                    $query->equals('poststatus', 1),
                    $query->equals('poststicky', 1)
                ))
        );

        return $query->execute();
    }

    /**
     * find Posts by Blog
     * 
     * @param int $blogId Blog Uid
     * @param int $limit limit
     * @return object
     */
    public function findPostsByLimitAndBlogId($blogId, $limit) {
        $orderings = array('postdate' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_DESCENDING);
        $query = $this->createQuery();
        $query->setOrderings($orderings);
        $query->matching(
                $query->logicalAnd(array(
                    $query->equals('blogid', $blogId),
                    $query->equals('poststatus', 1),
                    $query->equals('poststicky', 0)
                ))
        );

        return $query->execute();
    }

    /**
     * find Posts by Blog
     * 
     * @param int $blogId Blog Uid
     * @param int $queryOffset Offset
     * @param int $itemsPerPage item per page
     * @return object
     */
    public function findPostsByLimitOffsetAndBlogId($blogId, $queryOffset, $itemsPerPage) {
        $orderings = array('postdate' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_DESCENDING);
        $query = $this->createQuery();
        $query->setOrderings($orderings);
        $query->setOffset($queryOffset);
        $query->setLimit($itemsPerPage);
        $query->matching(
                $query->logicalAnd(array(
                    
                    $query->equals('blogid', $blogId),
                    $query->equals('poststatus', 1),
                    $query->equals('poststicky', 0)
                ))
        );

        return $query->execute();
    }

    /**
     * find previos post in blog
     * 
     * @param int $timestamp timestamp from actual post
     * @param int $blogId Blog Uid
     * 
     * @return object
     */
    public function findPreviousEntry($timestamp, $blogId) {
        $orderings = array('postdate' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_DESCENDING);
        $query = $this->createQuery();
        $query->setOrderings($orderings);
        $query->setLimit(1);
        $query->matching(
                $query->logicalAnd(array(
                    $query->equals('blogid', $blogId),
                    $query->equals('poststatus', 1),
                    $query->equals('poststicky', 0),
                    $query->lessThan('postdate', $timestamp)
                ))
        );
        return $query->execute();
    }

    /**
     * find previos post in blog
     * 
     * @param int $timestamp timestamp from actual post
     * @param int $blogId Blog Uid
     * 
     * @return object
     */
    public function findNextEntry($timestamp, $blogId) {
        $orderings = array('postdate' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING);
        $query = $this->createQuery();
        $query->setOrderings($orderings);
        $query->setLimit(1);
        $query->matching(
                $query->logicalAnd(array(
                    $query->equals('blogid', $blogId),
                    $query->equals('poststatus', 1),
                    $query->equals('poststicky', 0),
                    $query->greaterThan('postdate', $timestamp)
                ))
        );
        return $query->execute();
    }

    /**
     * Count visible Posts by Blog ID
     * 
     * @param int $blogId Blog Uid
     * 
     * @return object
     */
    public function countPostByBlogId($blogId) {
        $query = $this->createQuery();
        $query->matching(
                $query->logicalAnd(array(
                    $query->equals('blogid', $blogId),
                    $query->equals('poststatus', 1),
                    
                ))
        );
        return $query->execute()->count();
    }

      /**
     * Count visible Posts by Blog ID
     * 
     * @param int $blogId Blog Uid
       * @param int $categoryId Description
     * 
     * @return object
     */
    public function countPostByBlogIdCategory($blogId, $categoryId) {
        $query = $this->createQuery();
        $query->matching(
                $query->logicalAnd(array(
                    $query->contains('category', $categoryId),
                    $query->equals('blogid', $blogId),
                    $query->equals('poststatus', 1),
                    
                ))
        );
        return $query->execute()->count();
    }
    
        /**
     * find Posts by Blog & Category
     * 
     * @param int $blogId Blog Uid
     * 
     * @param int $itemsPerPage item per page
         * @param int $category category
     * @return object
     */
    public function findPostsByLimitBlogIdCategory($blogId,  $itemsPerPage, $category) {
        $orderings = array('postdate' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_DESCENDING);
        $query = $this->createQuery();
        $query->setOrderings($orderings);
        $query->setLimit($itemsPerPage);
        $query->matching(
                $query->logicalAnd(array(
                    $query->contains('category', $category),
                    $query->equals('blogid', $blogId),
                    $query->equals('poststatus', 1),
                    $query->equals('poststicky', 0)
                ))
        );

        return $query->execute();
    }
    
        /**
     * find Posts by Blog
     * 
     * @param int $blogId Blog Uid
     * @param int $queryOffset Offset
     * @param int $itemsPerPage item per page
         *  @param int $category category
     * @return object
     */
    public function findPostsByLimitOffsetBlogIdCategory($blogId, $queryOffset, $itemsPerPage, $category) {
        $orderings = array('postdate' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_DESCENDING);
        $query = $this->createQuery();
        $query->setOrderings($orderings);
        $query->setOffset($queryOffset);
        $query->setLimit($itemsPerPage);
        $query->matching(
                $query->logicalAnd(array(
                    $query->contains('category', $category),
                    $query->equals('blogid', $blogId),
                    $query->equals('poststatus', 1),
                    $query->equals('poststicky', 0)
                ))
        );

        return $query->execute();
    }
    
    /**
     * Find Posts by BlogId, for Blog Edit page
     * 
     *  @param int $blogId Blog Uid
     */
    public function findPostByBlogid($blogId){
        $orderings = array('postdate' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_DESCENDING);
        $query = $this->createQuery();
        $query->setOrderings($orderings);
         $query->matching(
                $query->equals('blogid', $blogId)
        );

        return $query->execute();
    }
}

?>
