<?php
namespace T3developer\Multiblog\ViewHelpers;

class FacebookViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper {

    /**
     * Main method of the View Helper
     * 
     * @param array $share
     * 
     */
    public function render($share) {

        $title = urlencode($share['title']);
        $url = urlencode('http://blog.t3-developer.com/1-3-this-is-my-really-first-test-entry/');
        $summary = urlencode($share['text']);
        $image = urlencode($share['image']);
        
        $url = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];;
        //$summary = 'Summay';
        //$image = 'image';

        $link = "'https://www.facebook.com/sharer/sharer.php?";
        $link.= "u=" . $url . "'";

        $link.= ",'sharer','toolbar=0,status=0,width=548,height=325'";

        $linkwrap = '<a onClick="window.open(';
        $linkwrap.=   $link ;
        $linkwrap.= ');" href="javascript: void(0)">';
        $linkwrap.= 'Insert text or an image here.';
        $linkwrap.= '</a>';
        

        return $linkwrap;
    }

}
?>
