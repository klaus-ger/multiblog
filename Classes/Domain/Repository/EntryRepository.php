<?php

class Tx_Multiblog_Domain_Repository_EntryRepository extends Tx_Extbase_Persistence_Repository {

    protected $defaultOrderings = array('entrydate' => Tx_Extbase_Persistence_QueryInterface::ORDER_DESCENDING);

    /**
     * Find Entrys by Blog Id and Status
     *
     * 
     * @param  $blogid $status
     * @return Array<Tx_Multiblog_Domain_Model_Entry>  The result list.
     *
     */
    Public Function findByBlogIdAndStatus($blogid, $status) {

        $query = $this->createQuery();
        Return $query
            ->matching(
                $query->logicalAnd(
                    $query->equals('blogid', $blogid), 
                    $query->equals('entrystatus', $status)
                    )
                  )
             ->setOrderings(Array('entrydate' => Tx_Extbase_Persistence_Query::ORDER_DESCENDING))
            ->execute();
    }
    
    /**
     * Find Entrys by Blog Id and Status, ignored sticky Posts
     *
     * 
     * @param  $blogid $status
     * @return Array<Tx_Multiblog_Domain_Model_Entry>  The result list.
     *
     */
    Public Function findByBlogIdStatusSticky($blogid, $status) {

        $query = $this->createQuery();
        Return $query
            ->matching(
                $query->logicalAnd(
                    $query->equals('blogid', $blogid), 
                    $query->equals('entrystatus', $status),
                    $query->equals('entrysticky', '0')
                    )
                  )
            ->setOrderings(Array('entrydate' => Tx_Extbase_Persistence_Query::ORDER_DESCENDING))
            ->execute();
    }

    /**
     * Find Entrys by Uid and Status
     *
     * 
     * @param  $uid $status
     * @return Array<Tx_Multiblog_Domain_Model_Entry>  The result list.
     *
     */
    Public Function findByUidAndStatus($uid, $status) {

        $query = $this->createQuery();
        Return $query
            ->matching(
                $query->logicalAnd(
                    $query->equals('uid', $uid), 
                    $query->equals('entrystatus', $status)
                    )
                  )
            ->execute();
    }
    
    
    
    /**
     * Findet Artikel per Uid
     *
     * 
     * @param  Tx_Multiblog_Domain_Model_Entry $uid   The parent project
     * @return Array<Tx_Multiblog_Domain_Model_Entry>  The result list.
     *
     */
    Public Function findForEntryPerUidView($uid) {


        $query = $this->createQuery();

        Return $query
                        ->matching($query->equals('uid', $uid))
                        ->execute();
    }

    /**
     * Findet letzte gültigen Artikel UID PREVIOUS
     *
     * 
     * @param  Tx_Multiblog_Domain_Model_Entry $entrydate $blogid   The parent project
     * @return $uid
     *
     */
    Public Function findForUidPreviousView($entrydate, $blogid) {

        $query = $this->createQuery();

        Return $query
            ->matching(
                $query->logicalAnd(
                    $query->equals('blogid', $blogid), 
                    $query->lessThan('entrydate', $entrydate), 
                    $query->equals('entrystatus', '1')
                                )
                        )
            ->setOrderings(Array('entrydate' => Tx_Extbase_Persistence_Query::ORDER_DESCENDING))
            ->setLimit(1)
            ->execute();
    }

    /**
     * Findet nächste gültigen Artikel UID NEXT
     *
     * 
     * @param  Tx_Multiblog_Domain_Model_Entry $entrydate $blogid   The parent project
     * @return $uid
     *
     */
    Public Function findForUidNextView($entrydate, $blogid) {

        $query = $this->createQuery();

        Return $query
            ->setOrderings(Array('entrydate' => Tx_Extbase_Persistence_Query::ORDER_ASCENDING))
            ->matching(
                $query->logicalAnd(
                    $query->equals('blogid', $blogid), 
                    $query->greaterThan('entrydate', $entrydate), 
                    $query->equals('entrystatus', '1')
                                )
                        )
                ->setLimit(1)
                ->execute();
    }

    /**
     * Kategorie View
     *
     * 
     * @param  Tx_Multiblog_Domain_Model_Entry $katuid $blogid  The parent project
     * @return Array<Tx_Multiblog_Domain_Model_Entry>  The result list.
     *
     */
    Public Function findForKategorieView($katuid, $blogid) {


        $query = $this->createQuery();

        Return $query
                        ->matching(
                                $query->logicalAnd(
                                        $query->equals('blogid', $blogid), $query->equals('entrystatus', '1'), $query->logicalOr(
                                                $query->equals('entrykategorie1', $katuid), $query->equals('entrykategorie2', $katuid), $query->equals('entrykategorie3', $katuid), $query->equals('entrykategorie4', $katuid)
                                        )
                                )
                        )
                        ->execute();
    }

    /**
     * Find all Entrys per Blog
     * Abfrage wird für die Funktion  Blogeditierung: Artikelübersicht verwendet.
     * 
     * @param  Tx_Multiblog_Domain_Model_Entry $blog  The parent project
     * @return Array<Tx_Multiblog_Domain_Model_Entry>  The result list.
     *
     */
    Public Function findForEditIndexView($blog) {


        $query = $this->createQuery();

        Return $query
                        ->matching($query->equals('blogid', $blog))
                        ->execute();
    }

    /**
     * Findet die letzte 5 Einträge für Teaser per Blog
     *
     * 
     * @param  Tx_Multiblog_Domain_Model_Entry $blogid  The parent project
     * @return Array<Tx_Multiblog_Domain_Model_Entry>  The result list.
     *
     */
    Public Function findForTeaserEntryView($blogid) {


        $query = $this->createQuery();

        Return $query
                        ->matching(
                                $query->logicalAnd(
                                        $query->equals('blogid', $blogid), 
                                        $query->equals('entrystatus', '1')
                                )
                        )
                        ->setLimit(5)
                        ->execute();
    }

    /**
     * Widget All Entrys
     *
     * 
     * @param  Tx_Multiblog_Domain_Model_Entry  $blogid  The parent project
     * @return Array<Tx_Multiblog_Domain_Model_Entry>  The result list.
     *
     */
    Public Function findForWidgetAllEntrysView($blogid) {


        $query = $this->createQuery();

        Return $query
                        ->matching(
                                $query->logicalAnd(
                                        $query->equals('blogid', $blogid), $query->equals('entrystatus', '1')
                                )
                        )
                        ->execute();
    }

    
    
    /**
     *Find Sticky Post
     *
     * 
     * @param  Tx_Multiblog_Domain_Model_Entry  $blogid  The parent project
     * @return Array<Tx_Multiblog_Domain_Model_Entry>  The result list.
     *
     */
    Public Function findStickyPost($blogid) {
        $query = $this->createQuery();

        Return $query
            ->matching(
                $query->logicalAnd(
                    $query->equals('blogid', $blogid), 
                    $query->equals('entrysticky', '1')
                                )
                        )
            ->execute();
    }
}

?>