<?php

class Tx_Multiblog_Domain_Repository_KategorieRepository extends Tx_Extbase_Persistence_Repository {

    /**
     * Find TOP Kategories
     *
     *
     * @param  Tx_Multiblog_Domain_Model_Kategorie $singleBlog The parent project
     * @return Array<Tx_Multiblog_Domain_Model_Kategorie>  The result list.
     *
     */
    Public Function findForTopKatView($singleBlog) {

        $query = $this->createQuery();
        Return $query
                        ->matching(
                                $query->logicalAnd(
                                        $query->equals('blogid', 
                                        $singleBlog), $query->equals('topkategorie', '0'), 
                                        $query->greaterThan('uid', '1')
                                )
                        )
                        ->setOrderings(Array('kategorie' => Tx_Extbase_Persistence_Query::ORDER_ASCENDING))
                        //-> setLimit (10)
                        ->execute();
    }

    /**
     * Find Sub Kategories
     *
     *
     * @param  Tx_Multiblog_Domain_Model_Kategorie $parent The parent project
     * @return Array<Tx_Multiblog_Domain_Model_Kategorie>  The result list.
     *
     */
    Public Function findForSubKatView(Tx_Multiblog_Domain_Model_Kategorie $parent = NULL) {

        $query = $this->createQuery();
        Return $query
                        ->matching($query->greaterThan('topkategorie', 'NULL'))
                        //->setOrderings(Array('isOnline' => Tx_Extbase_Persistence_Query::ORDER_DESCENDING))
                        //-> setLimit (10)
                        ->execute();
    }

    /**
     * Find Scuhkategorie
     *
     *
     * @param  Tx_Multiblog_Domain_Model_Kategorie $katuid The parent project
     * @return Array<Tx_Multiblog_Domain_Model_Kategorie>  The result list.
     *
     */
    Public Function findForSuchKategorieView($katuid) {

        $query = $this->createQuery();
        Return $query
                        ->matching($query->equals('uid', $katuid))
                        //->setOrderings(Array('isOnline' => Tx_Extbase_Persistence_Query::ORDER_DESCENDING))
                        //-> setLimit (10)
                        ->execute();
    }

    /**
     * Find all Kategories per Bloguid
     *
     *
     * @param  Tx_Multiblog_Domain_Model_Kategorie $blog The parent project
     * @return Array<Tx_Multiblog_Domain_Model_Kategorie>  The result list.
     *
     */
    Public Function findForAllKatView($blog) {

        $query = $this->createQuery();
        Return $query
                        ->matching(
                                $query->logicalOr(
                                        $query->equals('blogid', $blog), $query->equals('uid', '1')
                                )
                        )
                        //->setOrderings(Array('isOnline' => Tx_Extbase_Persistence_Query::ORDER_DESCENDING))
                        //-> setLimit (10)
                        ->execute();
    }

}

?>