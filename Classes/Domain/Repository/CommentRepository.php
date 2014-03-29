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


class CommentRepository extends \TYPO3\CMS\Extbase\Persistence\Repository {

     protected $defaultOrderings = array('commentdate' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING);

     /**
     * find approved Comments By Post
     * 
     * @param int $post Post Uid
     *
     * @return object
     */
    public function findApprovedByPostid($post){
        $orderings = array('commentdate' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING);
        $query = $this->createQuery();
        $query->setOrderings($orderings);
        $query->matching(
                $query->logicalAnd(array(
                    $query->equals('postid', $post),
                    $query->equals('commentapprove', 1)
                ))
        );
        return $query->execute();
    }
    
    /**
     * find last Comments by Blog
     * 
     * @param int $blogId Blog Uid
     * @param int $limit limit
     * @return object
     */
    public function findLastByBlogid($blogId, $limit) {
        $orderings = array('commentdate' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_DESCENDING);
        $query = $this->createQuery();
        $query->setOrderings($orderings);
        $query->setLimit($limit);
        $query->matching(
                $query->logicalAnd(array(
                    $query->equals('blogid', $blogId),
                    $query->equals('commentapprove', 1)
                ))
        );

        return $query->execute();
    }

     /**
     * count approved Comments By Post
     * 
     * @param int $post Post Uid
     *
     * @return object
     */
    public function countCommentsperPost($post){
        $orderings = array('commentdate' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING);
        $query = $this->createQuery();
        $query->setOrderings($orderings);
        $query->matching(
                $query->logicalAnd(array(
                    $query->equals('postid', $post),
                    $query->equals('commentapprove', 1)
                ))
        );
        return $query->execute()->count();
    }

}
?>
