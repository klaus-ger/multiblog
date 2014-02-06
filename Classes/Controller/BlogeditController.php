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

class Tx_Multiblog_Controller_BlogeditController extends Tx_Extbase_MVC_Controller_ActionController {

    /**
     * @var Tx_Multiblog_Domain_Model_EntryRepository
     */
    protected $entryRepository;

    /**
     * @var Tx_Multiblog_Domain_Model_BlogRepository
     */
    protected $blogRepository;

    /**
     * @var Tx_Multiblog_Domain_Model_KategorieRepository
     */
    protected $kategorieRepository;

    /**
     * @var Tx_Multiblog_Domain_Model_CommentRepository
     */
    protected $commentRepository;

    /**
     * @var Tx_Extbase_Persistence_Manager
     */
    protected $persistanceManager;

    /**
     * @param Tx_Extbase_Persistence_Manager $persistanceManager
     * @return void
     */
    public function injectPersistanceManager(Tx_Extbase_Persistence_Manager $persistanceManager) {
        $this->persistenceManager = $persistanceManager;
    }

    /**
     * Initializes the current action 
     * @return void 
     */
    public function initializeAction() {
        $this->entryRepository = & t3lib_div::makeInstance("Tx_Multiblog_Domain_Repository_EntryRepository");
        $this->blogRepository = t3lib_div::makeInstance("Tx_Multiblog_Domain_Repository_BlogRepository");
        $this->kategorieRepository = t3lib_div::makeInstance("Tx_Multiblog_Domain_Repository_KategorieRepository");
        $this->commentRepository = t3lib_div::makeInstance("Tx_Multiblog_Domain_Repository_CommentRepository");
        $this->persistenceManager =
                t3lib_div::makeInstance('Tx_Extbase_Persistence_Manager');
        if ($this->arguments->hasArgument('Tx_Multiblog_Domain_Model_Entry')) {
            $this->arguments->getArgument('Tx_Multiblog_Domain_Model_Entry')->getPropertyMappingConfiguration()->setTargetTypeForSubProperty('entrypicture', 'array');
        }
    }

    /**
     * Blog EDIT
     * Displays Main Page Blog Edit, Table of Entrys.
     *  
     */
    public function indexAction() {

        $blogUid = $this->findsBlogUidByLoggedInUser();

        $entrys = $this->entryRepository->findByblogid($blogUid);

        $this->view->assign('view', 'articlelist');
        $this->view->assign('main-menu', 'articles');
        $this->view->assign('menu', 'articles-all');
        $this->view->assign('entrys', $entrys);
        $this->view->assign('blog', $this->blogRepository->findByUid($blogUid));
    }

    /**
     * Blog EDIT
     * Edit form for single Entry
     * 
     * @param Tx_Multiblog_Domain_Model_Entry $entry !  
     * @dontvalidate $entrys
     * @dontvalidate x_Multiblog_Domain_Model_Entry $entry
     * @ param int $uid
     */
    public function artikelEditAction() {

        $singleEntryUid = $this->request->getArgument('singleEntry');

        //finds the blogowner and blogUid
        $blogOwner = $GLOBALS['TSFE']->fe_user->user[uid];
        $blog = $this->blogRepository->findByblogwriter($blogOwner);
        $blogUid = $blog[0]->getUid();


        $entry = $this->entryRepository->findByUid($singleEntryUid);
        $entry->setEntrypicturedelete(FALSE);
        $entry->setCurrentpicture($entry->getEntrypicture());


        $this->view->assign('main-menu', 'articles');
        $this->view->assign('menu', 'article-edit');


        $this->view->assign('entry', $entry);
        $this->view->assign('kategorie', $this->kategorieRepository->findForAllKatView($blogUid));
    }

    /**
     * Updates an existing Entry and forwards to the index action. 
     * 
     * 
     * @dontvalidate Tx_Multiblog_Domain_Model_Entry $entry 
     * @dontvalidate $entry
     * 
     */
    public function artikelUpdateAction() {
        if ($this->request->hasArgument('entry')) {
            $entry = $this->request->getArgument('entry');
        }

        //Convert Date to DateTime
        $date = explode(".", $entry['entrydate']);
        $timestamp = '@' . mktime(0, 0, 0, $date[1], $date[0], $date[2]);
        $entry['entrydate'] = new DateTime($timestamp);


        // Setzt letztes Ändeungsdatum in Blogtabelle um Blogübersicht nach letztem Eintrag zu sortieren
        // last_entry in tx_gentleblog_domain_model_blog
        //Prüft ob Beitrag sichtbar ist, Status: online
        $status = $entry['entrystatus'];
        if ($status == '1') {

            //Liest Beitragsdatum aus
            $entrydate = $entry['entrydate'];

            // Holt datum des letzten Beitrags aus der Blogtabelle
            $blogid = $entry['blogid'];
            $blogdaten = $this->blogRepository->findbyUid($blogid);
            $lastentrydate = $blogdaten->getLastentry()->getTimestamp();

            //Prüft welches Datum neuer ist, setzt ggf. neues Datum

            if ($entrydate > $lastentrydate) {

                $blogdaten->setLastentry()->setTimestamp($entrydate);
                //Bug in Typo 4.7, persist all vor update setzten
                $this->objectManager->get('Tx_Extbase_Persistence_Manager')->persistAll();
                $this->blogRepository->update($blogdaten);
            }
        }

        // Bilddateihandling
        $entrypicture = $entry['currentpicture'];
        //$entry->setEntrypicture($currentPicture);
        if ($_FILES['tx_multiblog_blogedit']['name']['entry']['entrypicture']) {
            $basicFileFunctions = t3lib_div::makeInstance('t3lib_basicFileFunctions');

            $fileName = $basicFileFunctions->getUniqueName(
                    $_FILES['tx_multiblog_blogedit']['name']['entry']['entrypicture'], t3lib_div::getFileAbsFileName('uploads/multiblog/'));

            t3lib_div::upload_copy_move(
                    $_FILES['tx_multiblog_blogedit']['tmp_name']['entry']['entrypicture'], $fileName);

            $entrypicture = basename($fileName);
        }

        if ($entry['entrypicturedelete'] == 1) {
            $entrypicture = NULL;
        }

        //Check is already a sticky post exist and set it to sticky = 0
        if ($entry['entrysticky'] == '1') {
            $stickyEntry = $this->entryRepository->findStickyPost($blogid);
            if ($stickyEntry[0]) {
                $stickyEntry[0]->setEntrysticky('0');
                $this->entryRepository->update($stickyEntry[0]);
            }
        }
        // Loads the original entry an set the array to objects, 
        // we do this in reason of the new property mapping in 6.1 versus 4.5 / 4.7
        // it's silly - I know this :)

        $updateEntry = $this->entryRepository->findByUid($entry['uid']);
        $updateEntry->setEntrytitel($entry['entrytitel']);
        $updateEntry->setEntrystatus($entry['entrystatus']);
        $updateEntry->setEntryanleser($entry['entryanleser']);
        $updateEntry->setEntrytext($entry['entrytext']);
        $updateEntry->setEntrykategorie1($entry['entrykategorie1']);
        $updateEntry->setEntrykategorie2($entry['entrykategorie2']);
        $updateEntry->setEntrykategorie3($entry['entrykategorie3']);
        $updateEntry->setEntrykategorie4($entry['entrykategorie4']);
        $updateEntry->setEntrypicture($entrypicture);
        $updateEntry->setEntrypictureposition($entry['entrypictureposition']);
        $updateEntry->setEntrydate($entry['entrydate']);
        $updateEntry->setEntrysticky($entry['entrysticky']);
        $updateEntry->setEntrycommentoption($entry['entrycommentoption']);



        //Tx_Extbase_Utility_Debugger::var_dump($updateEntry);
        $this->entryRepository->update($updateEntry);

        $this->redirect('index');
    }

    /**
     * Displays a form for creating a new Entry 
     * 
     * @param Tx_Multiblog_Domain_Model_Entry $newEntry ! A fresh entry object taken as a basis for the rendering 
     * @dontvalidate $newEntry 
     */
    public function artikelNewAction(Tx_Multiblog_Domain_Model_Entry $newEntry = NULL) {


        $blogUid = $this->findsBlogUidByLoggedInUser();

        $newEntry = new Tx_Multiblog_Domain_Model_Entry;
        $newEntry->setBlogid($blogUid);
        $newEntry->setEntrystatus('0');
        $newEntry->setEntrykategorie1('1');
        $newEntry->setEntrykategorie2('1');
        $newEntry->setEntrykategorie3('1');
        $newEntry->setEntrykategorie4('1');
        $newEntry->setPid($this->settings['storagePid']);



        $this->view->assign('main-menu', 'articles');
        $this->view->assign('menu', 'articlecreate');
        $this->view->assign('entry', $newEntry);
        $this->view->assign('kategorie', $this->kategorieRepository->findForAllKatView($blogUid));
    }

    /**
     * Creates a new Blogentry and forwards to the index action. 
     * 
     * @param Tx_Multiblog_Domain_Model_Entry $entry     ! A fresh note object which has not yet been added to ! the repository 
     * @dontvalidate $entry 

     */
    public function artikelCreateAction() {
        if ($this->request->hasArgument('entry')) {
            $entry = $this->request->getArgument('entry');
        }

        //Convert Date to DateTime
        $date = explode(".", $entry['entrydate']);
        $timestamp = '@' . mktime(0, 0, 0, $date[1], $date[0], $date[2]);
        $entry['entrydate'] = new DateTime($timestamp);


        //Tx_Extbase_Utility_Debugger::var_dump($entry);
        // Setzt letztes Ändeungsdatum in Blogtabelle um Blogübersicht nach letztem Eintrag zu sortieren
        // last_entry in tx_gentleblog_domain_model_blog
        //Prüft ob Beitrag sichtbar ist, Status: online
        $status = $entry['entrystatus'];
        if ($status == '1') {

            //Liest Beitragsdatum aus
            $entrydate = $entry['entrydate'];

            // Holt datum des letzten Beitrags aus der Blogtabelle
            $blogid = $entry->getBlogid();
            $blogdaten = $this->blogRepository->findbyUid($blogid);
            $lastentrydate = $blogdaten->getLastentry()->getTimestamp();

            //Prüft welches Datum neuer ist, setzt ggf. neues Datum

            if ($entrydate > $lastentrydate) {

                $blogdaten->setLastentry($entrydate);
                //Bug in Typo 4.7, persist all vor update setzten
                $this->objectManager->get('Tx_Extbase_Persistence_Manager')->persistAll();
                $this->blogRepository->update($blogdaten);
            }
        }

        // Bilddateihandling
        $entrypicture = $entry['currentpicture'];
        //$entry->setEntrypicture($currentPicture);
        if ($_FILES['tx_multiblog_blogedit']['name']['entry']['entrypicture']) {
            $basicFileFunctions = t3lib_div::makeInstance('t3lib_basicFileFunctions');

            $fileName = $basicFileFunctions->getUniqueName(
                    $_FILES['tx_multiblog_blogedit']['name']['entry']['entrypicture'], t3lib_div::getFileAbsFileName('uploads/multiblog/'));

            t3lib_div::upload_copy_move(
                    $_FILES['tx_multiblog_blogedit']['tmp_name']['entry']['entrypicture'], $fileName);

            $entrypicture = basename($fileName);
        }

        if ($entry['entrypicturedelete'] == 1) {
            $entrypicture = NULL;
        }

        //Check is already a sticky post exist and set it to sticky = 0
        if ($entry['entrysticky'] == '1') {
            $stickyEntry = $this->entryRepository->findStickyPost($blogid);
            if ($stickyEntry[0]) {
                $stickyEntry[0]->setEntrysticky('0');
                $this->entryRepository->update($stickyEntry[0]);
            }
        }

        // Loads the original entry an set the array to objects, 
        // we do this in reason of the new property mapping in 6.1 versus 4.5 / 4.7
        // it's silly - I know this :)

        $newEntry = new Tx_Multiblog_Domain_Model_Entry;
        $newEntry->setBlogid($entry['blogid']);
        $newEntry->setEntrytitel($entry['entrytitel']);
        $newEntry->setEntrystatus($entry['entrystatus']);
        $newEntry->setEntryanleser($entry['entryanleser']);
        $newEntry->setEntrytext($entry['entrytext']);
        $newEntry->setEntrykategorie1($entry['entrykategorie1']);
        $newEntry->setEntrykategorie2($entry['entrykategorie2']);
        $newEntry->setEntrykategorie3($entry['entrykategorie3']);
        $newEntry->setEntrykategorie4($entry['entrykategorie4']);
        $newEntry->setEntrypicture($entrypicture);
        $newEntry->setEntrypictureposition($entry['entrypictureposition']);
        $newEntry->setEntrydate($entry['entrydate']);
        $updateEntry->setEntrycommentoption($entry['entrycommentoption']);

        $newEntry->setPid($this->settings['storagePid');

        //Tx_Extbase_Utility_Debugger::var_dump($entry);
        //$this->objectManager->get('Tx_Extbase_Persistence_Manager')->persistAll();
        $this->entryRepository->add($newEntry);

        $this->redirect('index');
    }

    /**
     * Shows the List of all online Comments 
     * 
     * @return Tx_Munltiblog_Domain_Model_Comment The List of Comments
     */
    public function commentsShowAllAction() {

        $blogUid = $this->findsBlogUidByLoggedInUser();
        $comments = $this->commentRepository->findByBlogidAndStatus($blogUid, '1');

        $this->view->assign('main-menu', 'comments');
        $this->view->assign('menu', 'allcomments');
        $this->view->assign('comments', $comments);
    }

    /**
     * Shows the List of all draft Comments 
     * 
     * @return Tx_Munltiblog_Domain_Model_Comment The List of Comments
     */
    public function commentsShowNewAction() {

        $blogUid = $this->findsBlogUidByLoggedInUser();
        $comments = $this->commentRepository->findByBlogidAndStatus($blogUid, '0');

        $this->view->assign('main-menu', 'comments');
        $this->view->assign('menu', 'newcomments');
        $this->view->assign('comments', $comments);
    }

    /**
     * Shows a single Kommentar for editing 
     * 
     * @param Tx_Multiblog_Domain_Model_Comment $comment
     */
    public function commentEditAction() {

        $commentfetch = $this->request->getArgument('uid');

        $comment = $this->commentRepository->findByUid($commentfetch);

        $this->view->assign('main-menu', 'comments');
        $this->view->assign('menu', 'commentedit');
        $this->view->assign('comment', $comment);
    }

    /**
     * Updates an existing Comment and forwards to the comment index action. 
     * 
     * @param Tx_Multiblog_Domain_Model_Comment $comment 
     * @dontvalidate $comment
     */
    public function commentUpdateAction(Tx_Multiblog_Domain_Model_Comment $comment) {

        //Bug in Typo 4.7, persist all vor update setzten
        $this->objectManager->get('Tx_Extbase_Persistence_Manager')->persistAll();
        $this->commentRepository->update($comment);
        //$this->flashMessageContainer->add('Your Project was updated.'); 
        $this->redirect('commentsShowAll');
    }

    /**
     * Deletes an existing Comment and forwards to the comment index action. 
     * 
     * @param $uid 
     * @dontvalidate $comment
     */
    public function commentsDeleteAction() {
        $commentfetch = $this->request->getArgument('uid');

        $comment = $this->commentRepository->findByUid($commentfetch);
        $this->commentRepository->remove($comment);
        $this->redirect('commentsShowAll');
    }

    public function kategoryShowAction() {
        $blogUid = $this->findsBlogUidByLoggedInUser();

        $newKat = new Tx_Multiblog_Domain_Model_Kategorie;
        $newKat->setBlogid($blogUid);

        $this->view->assign('topkategorie', $this->kategorieRepository->findForTopKatView($blogUid));
        $this->view->assign('subkategorie', $this->kategorieRepository->findForSubKatView());
        $this->view->assign('newKat', $newKat);
        $this->view->assign('main-menu', 'articles');
        $this->view->assign('menu', 'category');
    }

    /**
     * Create a new Kategories of the Blogowner
     * @param 
     * @dontvalidate Tx_Multiblog_Domain_Model_Kategorie $newKat
     */
    public function settingsCreateKategorieAction(Tx_Multiblog_Domain_Model_Kategorie $newKat) {


        //Bug in Typo 4.7, persist all vor update setzten
        $this->objectManager->get('Tx_Extbase_Persistence_Manager')->persistAll();
        $this->kategorieRepository->add($newKat);

        $this->redirect('kategoryShow');
    }

    /**
     * Shows the Widgetpage
     * 
     */
    public function widgetsShowAction() {
        $blogUid = $this->findsBlogUidByLoggedInUser();

        $this->view->assign('blog', $this->blogRepository->findByUid($blogUid));


        $this->view->assign('menu', 'widgets');
        $this->view->assign('main-menu', 'settings');
    }

    /**
     * update the widgets setting
     * 
     */
    public function widgetsUpdateAction(Tx_Multiblog_Domain_Model_Blog $blog) {
       
        $this->blogRepository->update($blog);

        $this->redirect('widgetsShow');
    }

    /**
     * Shows the Blogstylepage
     * 
     */
    public function blogstyleShowAction() {
        $blogUid = $this->findsBlogUidByLoggedInUser();

        $this->view->assign('blog', $this->blogRepository->findByUid($blogUid));


        $this->view->assign('menu', 'blogstyle');
        $this->view->assign('main-menu', 'settings');
    }

    /**
     * update the widgets setting
     * 
     */
    public function blogstyleUpdateAction(Tx_Multiblog_Domain_Model_Blog $blog) {
        $this->objectManager->get('Tx_Extbase_Persistence_Manager')->persistAll();
        $this->blogRepository->update($blog);

        $this->redirect('blogstyleShow');
    }

    /**
     * Shows the User Settings
     * 
     */
    public function usersettingsShowAction() {
        $blogUid = $this->findsBlogUidByLoggedInUser();

        $this->view->assign('blog', $this->blogRepository->findByUid($blogUid));


        $this->view->assign('menu', 'usersettings');
        $this->view->assign('main-menu', 'settings');
    }

    /**
     * update the widgets setting
     * 
     */
    public function usersettingsUpdateAction(Tx_Multiblog_Domain_Model_Blog $blog) {

        $this->blogRepository->update($blog);

        $this->redirect('usersettingsShow');
    }

    /**
     * Finds the BlogUid by Logged In FE User
     * 
     */
    public function findsBlogUidByLoggedInUser() {

        $blogOwner = $GLOBALS['TSFE']->fe_user->user[uid];
        $blog = $this->blogRepository->findByblogwriter($blogOwner);

        if ($blog[0] != NULL) {
            $blogUid = $blog[0]->getUid();
            return $blogUid;
        } else {
            $this->redirect('login');
        }
    }

    /*
     * if the login is dated out
     */

    public function loginAction() {
        $user = $GLOBALS['TSFE']->fe_user->user;
        //Tx_Extbase_Utility_Debugger::var_dump($user);
        if ($user['uid'] == '') {
            if (is_array($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['felogin']['loginFormOnSubmitFuncs'])) {
                $_params = array();
                foreach ($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['felogin']['loginFormOnSubmitFuncs'] as $funcRef) {
                    list($onSub, $hid) = t3lib_div::callUserFunction($funcRef, $_params, $this);
                    $onSubmitAr[] = $onSub;
                    $extraHiddenAr[] = $hid;
                }
            }

            if (count($onSubmitAr)) {
                $onSubmit = implode('; ', $onSubmitAr) . '; return true;';
            }

            if (count($extraHiddenAr)) {
                $extraHidden = implode(LF, $extraHiddenAr);
            }
            
            $this->view->assign('storagePid', $this->settings['storagePid']);
            $this->view->assign('onSubmit', $onSubmit);
            $this->view->assign('extraHidden', $extraHidden);
            $this->view->assign('currentPid', t3lib_div::_GP('id'));
        } else {
            $this->redirect('index');
        }
    }

}

?>
