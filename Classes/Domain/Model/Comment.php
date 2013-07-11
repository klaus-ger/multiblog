<?php
/**
 * @scope prototype
 * @entity

*
 */
 
 
class Tx_Multiblog_Domain_Model_Comment extends Tx_Extbase_DomainObject_AbstractEntity {
 


    
           /** 
         * The uid
         * @var int
         *  
         */ 
    protected $uid; 

        /** 
         * The entryid
         * @var Tx_Multiblog_Domain_Model_Entry
         * 
         *  
         */ 
    protected $entryid; 


       /** 
         * The blogid
         * @var int
         * 
         */ 
    protected $blogid; 

        /** 
         * The commentdate
         * @var DateTime
         * 
         */ 
    protected $commentdate; 

        /** 
         * The commentname
         * @var string
         * @validate NotEmpty
         */ 
    protected $commentname; 


        /** 
         * The commentmail
         * @var string
         * @validate EmailAddress
         */ 
    protected $commentmail; 


        /** 
         * The commenttitel
         * @var string
         * @validate NotEmpty
         */ 
    protected $commenttitel; 


        /** 
         * The commenttext
         * @var string
         * @validate NotEmpty
         */ 
    protected $commenttext; 


         /** 
         * The commentreply
         * @var string
         * 
         */ 
    protected $commentreply; 


        /** 
         * The commentproved
         * @var int
         * 
         */ 
    protected $commentproved; 


 	public function __construct() {
			$this->commentdate = new DateTime();
	}

   
 /** Setters for Blog *******************************************/
 
         	 /**
		  *
		  * Sets the uid
		  * @param int $uid
		  * @return void
		  *
		  */

	Public Function setUid($uid) { $this->uid = $uid; }

   
    
       	 /**
		  *
		  * Sets the entryid
		  * @param int $entryid
		  * @return void
		  *
		  */

	Public Function setEntryid($entryid) { $this->entryid = $entryid; }

       	 /**
		  *
		  * Sets the blogid
		  * @param int $blogid
		  * @return void
		  *
		  */

	Public Function setBlogid($blogid) { $this->blogid = $blogid; }

       	 /**
		  *
		  * Sets the commentdate
		  * @param DateTime $commentdate
		  * @return void
		  *
		  */

	Public Function setCommentdate($commentdate) { $this->commentdate = $commentdate; }
  



    	 /**
		  *
		  * Sets the commentname
		  * @param string $commentname The commentname
		  * @return void
		  *
		  */

	Public Function setCommentname($commentname) { $this->commentname = $commentname; }


    	 /**
		  *
		  * Sets the commentmail
		  * @param string $commentmail 
		  * @return void
		  *
		  */

	Public Function setCommentmail($commentmail) { $this->commentmail = $commentmail; }

   
    	 /**
		  *
		  * Sets the commenttitel
		  * @param string $commenttitel 
		  * @return void
		  *
		  */

	Public Function setCommenttitel($commenttitel) { $this->commenttitel = $commenttitel; }

   
    	 /**
		  *
		  * Sets the commenttext
		  * @param string $commenttext 
		  * @return void
		  *
		  */

	Public Function setCommenttext($commenttext) { $this->commenttext = $commenttext; }

   
    	 /**
		  *
		  * Sets the commentreply
		  * @param string $commentreply 
		  * @return void
		  *
		  */

	Public Function setCommentreply($commentreply) { $this->commentreply = $commentreply; }

   
    	 /**
		  *
		  * Sets the commentproved
		  * @param int $commentproved 
		  * @return void
		  *
		  */

	Public Function setCommentproved($commentproved) { $this->commentproved = $commentproved; }

   


/** GETTERS ****************************/





		 /**
		  *
		  * Gets the entryid
		  * @return int entryid
		  *
		  */

	Public Function getEntryid() { Return $this->entryid; }



		 /**
		  *
		  * Gets the blogid
		  * @return int blogid
		  *
		  */

	Public Function getBlogid() { Return $this->blogid; }


		 /**
		  *
		  * Gets the commentdate
		  * @return DateTime 
		  *
		  */

	Public Function getCommentdate() { Return $this->commentdate; }

	
		 /**
		  *
		  * Gets the commentname
		  * @return string
		  *
		  */

	Public Function getCommentname() { Return $this->commentname; }

 


		 /**
		  *
		  * Gets the commentmail
		  * @return string commentmail
		  *
		  */

	Public Function getCommentmail() { Return $this->commentmail; }


		 /**
		  *
		  * Gets the commenttitel
		  * @return string commenttitel
		  *
		  */

	Public Function getCommenttitel() { Return $this->commenttitel; }


		 /**
		  *
		  * Gets the commenttext
		  * @return string commenttext
		  *
		  */

	Public Function getCommenttext() { Return $this->commenttext; }


		 /**
		  *
		  * Gets the commentreply
		  * @return string commentreply
		  *
		  */

	Public Function getCommentreply() { Return $this->commentreply; }


		 /**
		  *
		  * Gets the commentproved
		  * @return int commentproved
		  *
		  */

	Public Function getCommentproved() { Return $this->commentproved; }





}
?>