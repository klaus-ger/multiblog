<?php
namespace T3developer\Multiblog\ViewHelpers;

class ContentHeaderViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper {

    /**
     * Main method of the View Helper
     * 
     * @param string $content
     * 
     */
    public function render($content) {

        $plainText = strip_tags ( $content );
        $plainText = substr ( $plainText, 0 ,40 );

        return $plainText;
    }

}
?>
