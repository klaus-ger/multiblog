<?php

class Tx_ResponsiveTemplate_Domain_Repository_SliderimagesRepository extends Tx_Extbase_Persistence_Repository {
    //    protected $defaultOrderings = array('myValue' => Tx_Extbase_Persistence_QueryInterface::ORDER_ASCENDING);

    /**
     * Find slider Images
     *
     * @param  Tx_ResponsiveTemplate_Domain_Model_Sliderimages $uid 
     * @return Array<Tx_ResponsiveTemplate_Domain_Model_Sliderimages>  The result list.
     *
     */
    Public Function findSliderimages( $uid ) {
        
        $query = $this->createQuery();
        $query->getQuerySettings()->setRespectStoragePage(FALSE);
        Return $query
               ->matching(
                       $query->equals('sliderId', $uid)
                       )
               ->execute();
    }

}

?>
