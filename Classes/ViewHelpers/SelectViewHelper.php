<?php
class Tx_Multiblog_ViewHelpers_SelectViewHelper extends Tx_Fluid_ViewHelpers_Form_SelectViewHelper {
 
    public function initializeArguments() {
        parent::initializeArguments();
        $this->registerArgument('additionalOptions', 'array', 'Associative array with values to prepend', FALSE);
    }
 
    protected function getOptions() {
        $options = parent::getOptions();
        $additionalOptions = array();
        foreach ($this->arguments['additionalOptions'] as $key => $value) {
            $additionalOptions[$key] = $value;
        }
        $return = $additionalOptions + $options;
        return $return;
    }
 
}?>