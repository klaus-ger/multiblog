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


class Tx_Multiblog_Controller_EntryController extends Tx_Extbase_MVC_Controller_ActionController {

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
     * Initializes the current action 
     * @return void 
     */
    public function initializeAction() {
        $this->entryRepository = & t3lib_div::makeInstance("Tx_Multiblog_Domain_Repository_EntryRepository");
        $this->blogRepository = t3lib_div::makeInstance("Tx_Multiblog_Domain_Repository_BlogRepository");
        $this->kategorieRepository = t3lib_div::makeInstance("Tx_Multiblog_Domain_Repository_KategorieRepository");
        $this->commentRepository = t3lib_div::makeInstance("Tx_Multiblog_Domain_Repository_CommentRepository");
    }

    /**
     * Startseite des Blogs
     * @param Tx_Multiblog_Domain_Model_Entry $entrys 
     * @param $uid
     * param $blogid
     * @dontvalidate Tx_Multiblog_Domain_Model_Comment $newComment
     */
    public function indexAction() {
        $uid = 0;    // The Entry UID
        $blogid = 0;    // The Blog ID

        if ($this->request->hasArgument('uid')) {
            $uid = $this->request->getArgument('uid');
        }
        if ($this->request->hasArgument('bloguid')) {
            $blogid = $this->request->getArgument('bloguid');
        } else {
            $blogid = '1';
        }

        //check which blogstyle should be used:
        $blog = $this->blogRepository->findByUid($blogid);

        if ($blog->getBlogstyle() == '0') {
            $this->redirect('showSingelView', 'Entry', NULL, array('blog' => $blog->getUid()));
        }
        if ($blog->getBlogstyle() == '1') {
            $this->redirect('showBlogView', 'Entry', NULL, array('blog' => $blog->getUid()));
        }
    }

    /**
     * Front Page of the Blog "Blog Style" 
     * 
     * @param $blogid
     * 
     */
    public function showBlogViewAction() {
        $blogUid = $this->request->getArgument('blog');
        $blog = $this->blogRepository->findByUid($blogUid);

        $entrys = $this->entryRepository->findByBlogIdStatusSticky($blogUid, '1');

        $stickyPost = $this->entryRepository->findStickyPost($blogUid);

        //Set the sidebar content
        $this->view->assign('blog', $blog);
        $this->view->assign('topkategorie', $this->kategorieRepository->findForTopKatView($blogUid));
        $this->view->assign('subkategorie', $this->kategorieRepository->findForSubKatView());
        $teaserentrys = $this->entryRepository->findForTeaserEntryView($blogUid);
        $this->view->assign('teaserentrys', $teaserentrys);
        $teasercomments = $this->commentRepository->findForTeaserCommentView($blogUid);
        $this->view->assign('teasercomments', $teasercomments);

        //Set main Content
        $this->view->assign('entrys', $entrys);
        $this->view->assign('stickyPost', $stickyPost[0]);
    }

    /**
     * Front Page of the Blog "Single View Style" 
     * 
     * @param $blogid
     * 
     */
    public function showSingelViewAction() {
        $blogUid = $this->request->getArgument('blog');
        $blog = $this->blogRepository->findByUid($blogUid);
        
        $sticky = $this->entryRepository->findStickyPost($blogUid);
        //Tx_Extbase_Utility_Debugger::var_dump($sticky);
        if($sticky[0] == ''){
           $blogentries = $this->entryRepository->findByBlogIdAndStatus($blogUid, '1');
           $lastentry = $blogentries[0]; 
        }else {
            $lastentry = $sticky[0];
        }
        
        
        $previous = $this->entryRepository->findForUidPreviousView($lastentry->getEntrydate(), $blogUid);
        $next = $this->entryRepository->findForUidNextView($lastentry->getEntrydate(), $blogUid);

        $comments = $this->commentRepository->findForCommentEntryView($entryUid);

        
        //Set the sidebar content
        $this->view->assign('blog', $blog);
        $this->view->assign('topkategorie', $this->kategorieRepository->findForTopKatView($blogUid));
        $this->view->assign('subkategorie', $this->kategorieRepository->findForSubKatView());
        $teaserentrys = $this->entryRepository->findForTeaserEntryView($blogUid);
        $this->view->assign('teaserentrys', $teaserentrys);
        $teasercomments = $this->commentRepository->findForTeaserCommentView($blogUid);
        $this->view->assign('teasercomments', $teasercomments);
        
        //Set main Content
        $this->view->assign('entry', $lastentry);
        $this->view->assign('prev', $previous[0]);
        $this->view->assign('next', $next[0]);
        $this->view->assign('comments', $comments);
    }

    /**
     * Shows a single Entry
     * 
     * @param $blogid
     * 
     */
    public function showSingleEntryAction() {
        if ($this->request->hasArgument('uid')) {
            $entryUid = $this->request->getArgument('uid');
        }
        if ($this->request->hasArgument('blogid')) {
            $blogid = $this->request->getArgument('blogid');
        }

        $blog = $this->blogRepository->findByUid($blogid);
        $entry = $this->entryRepository->findByUid($entryUid);

        $previous = $this->entryRepository->findForUidPreviousView($entry->getEntrydate(), $blogid);
        $next = $this->entryRepository->findForUidNextView($entry->getEntrydate(), $blogid);

        $comments = $this->commentRepository->findForCommentEntryView($entryUid);

        //Set the sidebar content
        $this->view->assign('blog', $blog);
        $this->view->assign('topkategorie', $this->kategorieRepository->findForTopKatView($blogid));
        $this->view->assign('subkategorie', $this->kategorieRepository->findForSubKatView());
        $teaserentrys = $this->entryRepository->findForTeaserEntryView($blogid);
        $this->view->assign('teaserentrys', $teaserentrys);
        $teasercomments = $this->commentRepository->findForTeaserCommentView($blogid);
        $this->view->assign('teasercomments', $teasercomments);

        //Set main Content
        $this->view->assign('entry', $entry);
        $this->view->assign('prev', $previous[0]);
        $this->view->assign('next', $next[0]);
        $this->view->assign('comments', $comments);
    }

    //Such anzuzeigenden Beitrag
    //$showEntryUid = $uid;
    // Finds Sticky Post
//        $blogData = $this->blogRepository->findByUid($blogid);
//        $stickyPost = $blogData->getStickyPost();
//        if ($stickyPost != NULL) {
//            $stickyPostUid = $stickyPost->getUid();
//        }
//
//        /** Wenn von Indexseite suche nach letztem Eintrag oder StickyPost * */
//        if ($uid == 0) {
//            if ($stickyPost != NULL) {
//                $showEntryUid = $stickyPost->getUid();
//            } else {
//                $lastEntry = $this->entryRepository->findForUidPreviousView('10000', $blogid);
//                if ($lastEntry[0]) {
//                    $showEntryUid = $lastEntry[0]->getUid();
//                }
//            }
//
//
//
//            //uid für Kommentarsuche setzen, uid wir im weiterem Verlauf geändern (next/prev Ansicht)
//            $uidForCommentSearch = $showEntryUid;
//        }
//
//        /** Holt Eintrag und setzt View * */
//        $entrys = $this->entryRepository->findByUid($showEntryUid);
//        $this->view->assign('entry', $entrys);
//        $this->view->assign('blogs', $this->blogRepository->findbyUid($blogid));
//        $this->view->assign('topkategorie', $this->kategorieRepository->findForTopKatView($blogid));
//        $this->view->assign('subkategorie', $this->kategorieRepository->findForSubKatView());
//
//        /** Sucht die UID und setzt Inhalt für den Previous link * */
//        $searchPrev = $showEntryUid;
//        if ($showEntryUid == $stickyPostUid) {
//            $searchPrev = '10000';
//        }
//
//        $previous = $this->entryRepository->findForUidPreviousView($searchPrev, $blogid);
//        $this->view->assign('prev', $previous[0]);
//
//        /** Sucht die UID und setzt Inhalt für den Next link * */
//        $next = NULL;
//        if ($showEntryUid != $stickyPostUid) {
//            $next = $this->entryRepository->findForUidNextView($showEntryUid, $blogid);
//            if ($next[0] == NULL) {
//                $next[0] = $stickyPost;
//            }
//            $this->view->assign('next', $next[0]);
//        }
//
//
//        /** Sucht Kommentare und setzt View * */
//        $uid = $showEntryUid;
//        $comments = $this->commentRepository->findForCommentEntryView($uid);
//        $this->view->assign('comments', $comments);
//
//        /** Letzte Artikel / Letzte Kommentare Teaser * */
//        $teaserentrys = $this->entryRepository->findForTeaserEntryView($blogid);
//        $this->view->assign('teaserentrys', $teaserentrys);
//        $teasercomments = $this->commentRepository->findForTeaserCommentView($blogid);
//        $this->view->assign('teasercomments', $teasercomments);
//
//        //** Schreibt Kommentarformular wenn Kommentarsoeicherung fehlschlägt **//
//        if ($this->request->hasArgument('newcommentTitel')) {
//            $newComment = Array(
//                'commenttitel' => $this->request->getArgument('newcommentTitel'),
//            );
//            $this->view->assign('newComment', $newComment);
//        }
//
//        //** Prüft ob User eingeloggt, -> Ausageb des Meta Widgets in FE **/
//        $blogOwner = $GLOBALS['TSFE']->fe_user->user[uid];
//        $blog = $this->blogRepository->findByblogwriter($blogOwner);
//
//        if ($blog[0] != NULL) {
//            $blogUid = $blog[0]->getUid();
//        }
//        if ($blogUid != NULL) {
//            $this->view->assign('meta', $blogUid);
//        }
//    }
//
    /**
     * Displays the All Entrys.
     *  @ param int $katuid
     *  @ param int $bloguid
     *  
     */
    public function allEntrysAction() {
        /** Holt Get Variabeln * */
        $blogid = $this->request->getArgument('blogid');

        $blog = $blogid; // Die Repositoryabfrage für den BlogEdit wird verwendet, daher Variable umschreiben.
        /** Holt die Einträge und setzt View * */
        $entrys = $this->entryRepository->findForWidgetAllEntrysView($blogid);
        $this->view->assign('entrys', $entrys);
        $this->view->assign('blogs', $this->blogRepository->findbyUid($blogid));

        //Set the sidebar content
        $this->view->assign('blog', $blog);
        $this->view->assign('topkategorie', $this->kategorieRepository->findForTopKatView($blogUid));
        $this->view->assign('subkategorie', $this->kategorieRepository->findForSubKatView());
        $teaserentrys = $this->entryRepository->findForTeaserEntryView($blogUid);
        $this->view->assign('teaserentrys', $teaserentrys);
        $teasercomments = $this->commentRepository->findForTeaserCommentView($blogUid);
        $this->view->assign('teasercomments', $teasercomments);


//        $this->view->assign('topkategorie', $this->kategorieRepository->findForTopKatView($blogid));
//        $this->view->assign('subkategorie', $this->kategorieRepository->findForSubKatView());
//        $this->view->assign('suchkategorie', $this->kategorieRepository->findForSuchKategorieView($katuid));
//
//        /** Letzte Artikel / Letzte Kommentare Teaser * */
//        $teaserentrys = $this->entryRepository->findForTeaserEntryView($blogid);
//        $this->view->assign('teaserentrys', $teaserentrys);
//        $teasercomments = $this->commentRepository->findForTeaserCommentView($blogid);
//        $this->view->assign('teasercomments', $teasercomments);
//
//        //** Prüft ob User eingeloggt, -> Ausageb des Meta Widgets in FE **/
//        $blogOwner = $GLOBALS['TSFE']->fe_user->user[uid];
//        $blog = $this->blogRepository->findByblogwriter($blogOwner);
//
//        if ($blog[0] != NULL) {
//            $blogUid = $blog[0]->getUid();
//        }
//        if ($blogUid != NULL) {
//            $this->view->assign('meta', $blogUid);
//        }
    }

    /**
     * Displays the Kategorie Entrys.
     *  @ param int $katuid
     *  @ param int $bloguid
     *  
     */
    public function kategorieViewAction() {

        /** Holt Get Variabeln * */
        $blogid = $this->request->getArgument('blogid');
        $katuid = $this->request->getArgument('kat');

        /** Holt die Einträge und setzt View * */
        $entrys = $this->entryRepository->findForKategorieView($katuid, $blogid);
        $this->view->assign('entrys', $entrys);
        $this->view->assign('blog', $this->blogRepository->findbyUid($blogid));
        $this->view->assign('topkategorie', $this->kategorieRepository->findForTopKatView($blogid));
        $this->view->assign('subkategorie', $this->kategorieRepository->findForSubKatView());
        $this->view->assign('suchkategorie', $this->kategorieRepository->findForSuchKategorieView($katuid));

        /** Letzte Artikel / Letzte Kommentare Teaser * */
        $teaserentrys = $this->entryRepository->findForTeaserEntryView($blogid);
        $this->view->assign('teaserentrys', $teaserentrys);
        $teasercomments = $this->commentRepository->findForTeaserCommentView($blogid);
        $this->view->assign('teasercomments', $teasercomments);
    }

}

?>