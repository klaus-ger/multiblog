<?php
if (!defined ('TYPO3_MODE'))  die ('Access denied.');

Tx_Extbase_Utility_Extension::configurePlugin(
    $_EXTKEY,
    'blogindex',

    array ('Blog' => 'index'
              ),
	
    array ('Blog' => 'index'
               )
);

Tx_Extbase_Utility_Extension::configurePlugin(
    $_EXTKEY,
    'blogsingle',

    array ('Entry' => 'index, showBlogView, showSingleEntry, previous,next,kategorieView, allEntrys, showSingelView',
           'Comment' => 'commentEditIndex,commentEdit,update,create' 
            ),
	
    array ('Entry' => 'index, showBlogView, showSingleEntry, showSingeView',
	   'Comment' => 'commentEditIndex,commentEdit,update,create' 
            )
);

Tx_Extbase_Utility_Extension::configurePlugin(
    $_EXTKEY,
    'blogedit',

    array ('Blogedit' => 'index, artikelEdit,artikelUpdate, artikelNew, artikelCreate, 
                          kategoryShow,settingsUpdateKategorie,settingsCreateKategorie,
                          commentsShowAll, commentsDelete, commentsShowNew,
                          commentEdit, commentUpdate,
                          widgetsShow, widgetsUpdate, blogstyleShow, blogstyleUpdate,
                          usersettingsShow, usersettingsUpdate,
                          manualIndex, login',
            
           'Comment'  => 'commentEditIndex,commentEdit,update,create',
           'Blognews' => 'einstellungen, news'
            ),
	
    array ('Blogedit' => 'index, artikelEdit,artikelUpdate, artikelNew, artikelCreate, 
                          kategoryShow,settingsUpdateKategorie, settingsCreateKategorie, 
                          commentsShowAll, commentsDelete, commentsShowNew,
                          commentEdit, commentUpdate,
                          widgetsShow, widgetsUpdate, blogstyleShow, blogstyleUpdate,
                          usersettingsShow, usersettingsUpdate, login',
	   'Comment'  => 'commentEditIndex,commentEdit,update,create',
           'Blognews' => 'einstellungen, news'
            )
);


?>