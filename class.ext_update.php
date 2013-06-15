<?php

/* * *************************************************************
 *  Copyright notice
 *
 *  (c) 2013 Klaus Heuer t3-developer.com
 *  All rights reserved
 *
 *  This script is part of the Typo3 project. The Typo3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
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

/**
 * Class for updating RealURL data
 *
 * 
 *
 * @author  Klaus Heuer <klaus.heuer@t3-developer.com>
 * @package TYPO3
 * @subpackage responsive-template
 */
class ext_update {

    /**
     * Stub function for the extension manager
     *
     * @param	string	$what	What should be updated
     * @return	boolean	true to allow access
     */
    public function access($what = 'all') {

        return TRUE;
    }

    /**
     * Updates nested sets
     *
     * @return	string		HTML output
     */
    public function main() {
        if (t3lib_div::_POST('nssubmit') != '') {
            
            $templatePID = t3lib_div::_POST('templatepid');
            $this->updateOverridePaths($templatePID);
            $content = 'The backend layouts are stored on the page pid = ' . $templatePID;
        } else {
            $content = $this->prompt();
        }
        return $content;
    }

    /**
     * Shows a form to created nested sets data.
     *
     * @return	string
     */
    protected function prompt() {
        return
                '<form action="' . t3lib_div::getIndpEnv('REQUEST_URI') . '" method="POST">' .
                '<p>This script will do the following:</p>' .
                '<ul>' .
                '<li>Import the backend layouts to your template root pid.</li>' .
                '<li></li>' .
                '</ul>' .
                '<p><b>Warning!</b> All current backend layouts will be removed!</p>' .
                '<br />' .
                'PID of your template root: <input name="templatepid" type="text" size="30" maxlength="40">' .
                '<br /><br />' .
                '<input type="submit" name="nssubmit" value="Update" /></form>';
    }

    /**
     * Creates nested sets data for pages
     *
     * @return	string	Result
     */
    protected function updateOverridePaths($templatePID) {
        //clear the database
        $result = $GLOBALS['TYPO3_DB']->exec_DELETEquery('backend_layout', '');

        $insertArray = array(
           'uid'   => '1'
          ,'pid'   =>  $templatePID 
          ,'title' => "Two Cols + Header 66% | 33%"
          ,'config' => 'backend_layout {\r\n	colCount = 2\r\n	rowCount = 2\r\n	rows {\r\n		1 {\r\n			columns {\r\n				1 {\r\n					name = SLIDER\r\n					colspan = 2\r\n					colPos = 0\r\n				}\r\n			}\r\n		}\r\n		2 {\r\n			columns {\r\n				1 {\r\n					name = Content\r\n					colPos = 1\r\n				}\r\n				2 {\r\n					name = Sidebar\r\n					colPos = 2\r\n				}\r\n                }\r\n    }\r\n}\r\n}\r\n'
         );
        $query = $GLOBALS['TYPO3_DB']->exec_INSERTquery('backend_layout', $insertArray);

        $insertArray = array(
           'uid'   => '2'
          ,'pid'   =>  $templatePID 
          ,'title' => "One Col + Header"
          ,'config' => 'backend_layout {\r\n	colCount = 1\r\n	rowCount = 2\r\n	rows {\r\n		1 {\r\n			columns {\r\n				1 {\r\n					name = SLIDER\r\n					colPos = 0\r\n				}\r\n			}\r\n		}\r\n		2 {\r\n			columns {\r\n				1 {\r\n					name = CONTENT_NORMAL\r\n					colPos = 1\r\n				}\r\n			}\r\n		}\r\n	}\r\n}\r\n'
         );
        $query = $GLOBALS['TYPO3_DB']->exec_INSERTquery('backend_layout', $insertArray);

        $insertArray = array(
           'uid'   => '3'
          ,'pid'   =>  $templatePID 
          ,'title' => "Three Cols + Header"
          ,'config' => 'backend_layout {\r\n	colCount = 3\r\n	rowCount = 2\r\n	rows {\r\n		1 {\r\n			columns {\r\n				1 {\r\n					name = SLIDER\r\n					colspan = 3\r\n					colPos = 0\r\n				}\r\n			}\r\n		}\r\n		2 {\r\n			columns {\r\n				1 {\r\n					name = Links	\r\n					colPos = 1\r\n				}\r\n                               2 {\r\n                                      name = Mitte\r\n                                      colPos = 2\r\n                              }\r\n                              3 {\r\n                                     name = Rechts\r\n                                     colPos = 3\r\n                               }\r\n                       }\r\n                }\r\n		\r\n		\r\n       }\r\n}'
         );
        $query = $GLOBALS['TYPO3_DB']->exec_INSERTquery('backend_layout', $insertArray);

        
//$res = $GLOBALS['TYPO3_DB']->sql(TYPO3_db, $query);
    }

}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/responsive-template/class.ext_update.php']) {
    include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/responsive-template/class.ext_update.php']);
}
?>