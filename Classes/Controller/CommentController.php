<?php

/* * *************************************************************
 *  Copyright notice
 *
 *  (c) 2013 Klaus Heuer <klaus.heuer@t3-developer.com>
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

class Tx_Multiblog_Controller_CommentController extends Tx_Extbase_MVC_Controller_ActionController {

    /**
     * @var Tx_Multiblog_Domain_Model_CommentRepository
     */
    protected $commentRepository;

    /**
     * @var Tx_Multiblog_Domain_Model_BlogRepository
     */
    protected $blogRepository;

    /**
     * @param Tx_Extbase_Persistence_Manager $persistanceManager
     * @return void
     */
    public function injectPersistanceManager(Tx_Extbase_Persistence_Manager $persistanceManager) {
        $this->persistanceManager = $persistanceManager;
    }

    /**
     * Initializes the current action 
     * @return void 
     */
    protected function initializeAction() {
        $this->commentRepository = t3lib_div::makeInstance("Tx_Multiblog_Domain_Repository_CommentRepository");
        $this->blogRepository = t3lib_div::makeInstance("Tx_Multiblog_Domain_Repository_BlogRepository");
    }

    /**
     * List action for this controller. Displays all Status. 
     */
    public function indexAction() {
        $status = $this->commentRepository->findAll();
        $this->view->assign('comments', $comments);
    }

    /**
     * Creates a new Comment and forwards to the index action. 
     * 
     * @param Tx_Multiblog_Domain_Model_Comment $newComment     ! A fresh note object which has not yet been added to ! the repository 
     * @dontvaidate Tx_Multiblog_Domain_Model_Comment $newComment

     */
    public function createAction(Tx_Multiblog_Domain_Model_Comment $newComment) {
        //Tx_Extbase_Utility_Debugger::var_dump($newComment);
        //Validierung
        // $commentname = $newComment->getCommentname();
        //Bug in Typo 4.7, persist all vor update setzten
        $this->objectManager->get('Tx_Extbase_Persistence_Manager')->persistAll();

        $this->commentRepository->add($newComment);
        $this->flashMessageContainer->add(
                   'Dein Kommentar wurde gespeichert und wird nach Prüfung freigeschalten.',
                   'Titel optional', 
                   t3lib_Flashmessage::NOTICE);
            
 




        
        // Emailversand
        // liest die emailadresse des blogbesitzers
        $blogid = $newComment->getBlogid();


        $blogbesitzer = $this->blogRepository->findbyUid($blogid);
        $receiver = $blogbesitzer->getBlogwritermail();

        //Inhalte für mail übernehmen
        $name = $newComment->getCommentname();
        $mail = $newComment->getCommentmail();
        $text = $newComment->getCommenttext();


        $oemessage = 'Hola, ein neuer Blogkommentar auf www.gentledom.de wartet auf Freigabe<br><br>';
        $oemessage.= '<hr />';
        $oemessage.= 'Absender: ' . $name . '<br>';
        $oemessage.= 'Absendermail: ' . $mail . '<br>';
        $oemessage.= '<br />Nachricht: <br />';
        $oemessage.= '' . nl2br($text) . '<br />';

        $oemessage.= '<hr /><br />';



        // Mail Content Array aufbauen
        $email['receiver'] = $receiver;
        $email['sender'] = 'noreply@gentledom.de';
        $email['subject'] = 'Neuer Blogkommentar auf www.gentledom.de';
        $email['message'] = $oemessage;

        //Mail Klasse instanzieren und absenden
        $mail = t3lib_div::makeInstance('t3lib_mail_Message');
        $mail->setTo($email['receiver']);
        $mail->setFrom($email['sender']);
        $mail->setSubject($email['subject']);
        $mail->setBody($email['message'], 'text/html'); //versendet html mail, alternativ: 'text/plain'
        $mail->send();



        $this->redirect('index', 'Entry', NULL, Array('uid' => $newComment->getEntryid(), bloguid => $newComment->getBlogid()));
    }

    /* Deaktiviert FlashMessage für Fehler
     * @see Tx_Extbase_MVC_Controller_ActionController::getErrorFlashMessage()
     */

    protected function getErrorFlashMessage() {
        return 'Dein Kommentar konnte nicht gespeichert werden. Bitte Eingaben überprüfen!';
    }

}

?>