<?php

class Tx_Multiblog_Domain_Repository_CommentRepository extends Tx_Extbase_Persistence_Repository {

    protected $defaultOrderings = array('commentdate' => Tx_Extbase_Persistence_QueryInterface::ORDER_DESCENDING);

    /**
     * Find all Comments per Blogs
     *
     *
     * @param  Tx_Multiblog_Domain_Model_Comment $blog The parent project
     * @return Array<Tx_Multiblog_Domain_Model_Comment>  The result list.
     *
     */
    Public Function findForEditIndexView($blog) {

        $query = $this->createQuery();
        Return $query
                        ->matching(
                                $query->equals('blogid', $blog)
                        )
                        //->setOrderings(Array('isOnline' => Tx_Extbase_Persistence_Query::ORDER_DESCENDING))
                        //-> setLimit (10)
                        ->execute();
    }

    /**
     * findet einzlnen Kommentar nach uid
     *
     * 
     * @param  Tx_Multiblog_Domain_Model_Comment $commentfetch The parent project
     * @return Array<Tx_Multiblog_Domain_Model_Comment>  The result list.
     *
     */
    Public Function findForSingleCommentView($commentfetch) {

        $query = $this->createQuery();

        Return $query
                        ->matching($query->equals('uid', $commentfetch))
                        ->setOrderings(Array('uid' => Tx_Extbase_Persistence_Query::ORDER_DESCENDING))
                        ->setLimit(1)
                        ->execute();
    }

    /**
     * findet Kommentar nach Entry uid
     *
     * 
     * @param  Tx_Multiblog_Domain_Model_Comment $uid The parent project
     * @return Array<Tx_Multiblog_Domain_Model_Comment>  The result list.
     *
     */
    Public Function findForCommentEntryView($uid) {




        $query = $this->createQuery();

        Return $query
                        ->matching(
                                $query->logicalAnd(
                                        $query->equals('entryid', $uid), 
                                        $query->equals('commentproved', '1')
                                )
                        )
                        ->setOrderings(Array('uid' => Tx_Extbase_Persistence_Query::ORDER_ASCENDING))
                        ->execute();
    }

    /**
     * findet die letzten 5 Kommentare für Blog Teaser
     *
     * 
     * @param  Tx_Multiblog_Domain_Model_Comment $blogid The parent project
     * @return Array<Tx_Multiblog_Domain_Model_Comment>  The result list.
     *
     */
    Public Function findForTeaserCommentView($blogid) {




        $query = $this->createQuery();

        Return $query
                        ->matching(
                                $query->logicalAnd(
                                        $query->equals('blogid', $blogid), 
                                        $query->equals('commentproved', '1')
                                )
                        )
                        ->setOrderings(Array('commentdate' => Tx_Extbase_Persistence_Query::ORDER_DESCENDING))
                        ->setLimit(5)
                        ->execute();
    }

    /**
     * Find Comments By Blog ID and Status
     * Needed in the multiblog edit views
     * 
     * @param  Tx_Multiblog_Domain_Model_Comment $blogid , $status
     * @return Array<Tx_Multiblog_Domain_Model_Comment>  The result list.
     *
     */
    Public Function findByBlogidAndStatus($blogid, $status) {

        $query = $this->createQuery();

        Return $query
            ->matching(
                $query->logicalAnd(
                    $query->equals('blogid', $blogid), 
                    $query->equals('commentproved', $status)
                    )
                        )
             ->setOrderings(Array('commentdate' => Tx_Extbase_Persistence_Query::ORDER_DESCENDING))
             ->execute();
    }

}

?>