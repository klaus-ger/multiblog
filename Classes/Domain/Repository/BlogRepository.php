<?php
class Tx_Multiblog_Domain_Repository_BlogRepository extends Tx_Extbase_Persistence_Repository {

      protected $defaultOrderings = array('lastentry' => Tx_Extbase_Persistence_QueryInterface::ORDER_DESCENDING);



		/**
		 * Blog List auf Blog Startseite
		 * Finds the last 10 active User
		 *
		 * @param  Tx_Multiblog_Domain_Model_Blog $parent The parent project
		 * @return Array<Tx_Multiblog_Domain_Model_Blog>  The result list.
		 *
		 */

	Public Function findForIndexView ( Tx_Multiblog_Domain_Model_Blog $parent=NULL ) {

		$query = $this->createQuery();
		Return $query
			//->matching($query->equals('cousertyp', '3'))
			//->setOrderings(Array('isOnline' => Tx_Extbase_Persistence_Query::ORDER_DESCENDING))
			//-> setLimit (10)
			->execute();
	}
	
	
		/**
		 * Blog List auf Blog Startseite
		 * Finds the last 10 active User
		 *
		 * @param  Tx_Multiblog_Domain_Model_Blog $parent The parent project
		 * @return Array<Tx_Multiblog_Domain_Model_Blog>  The result list.
		 *
		 */

	Public Function findForBlogUidView ( Tx_Multiblog_Domain_Model_Blog $parent=NULL ) {
		$blogwriter = $GLOBALS['TSFE']->fe_user->user[uid];

		$query = $this->createQuery();
		Return $query
			->matching($query->equals('blogwriter', $blogwriter))
			//->setOrderings(Array('isOnline' => Tx_Extbase_Persistence_Query::ORDER_DESCENDING))
			-> setLimit (1)
			->execute();
	}





}
?>