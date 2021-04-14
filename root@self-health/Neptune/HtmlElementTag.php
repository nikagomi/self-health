<?php

namespace Neptune;

/**
 * Creates html elements using  functions. Allows for central easier modifications
 * @package smart
 * @author nikagomi
 */
class HtmlElementTag {
    
    private function __construct() {
        
    }
    
    public static function submitBtn ($tabIndex, $text = '' , $name = 'submit', $class = 'button', $includeWaitTip = true) {
        $btnTxt = (\trim($text) == '') ? MessageResources::i18n("link.update") :  $text;
        $submitBtn = '<button style="width:auto;padding: 0px 6px;" type="submit" name="'.$name.'" id="'.$name.'" class="'.$class.'" tabindex="'.$tabIndex.'">' 
                        . '<i class="fas fa-save" style="font-size:1rem;font-weight:bold;"></i>&nbsp;&nbsp;'.$btnTxt
                    .'</button>';
        $submitBtn .=  ($includeWaitTip) ? '<span class="wait_tip" style="display:none;"><img src="/images/newloader.gif" width="24px" height="24px" id="loading_img"/> Please wait...</span>' : ''; 
        return $submitBtn;                 
    }
    
    public static function deleteBtn ($tabIndex, $link, $text = '' , $name = 'delete', $class = 'button delete alert') {
        $btnTxt = (\trim($text) == '') ? MessageResources::i18n("link.delete") : $text;
        $deleteBtn = '<button type="button" name="'.$name.'" class="'.$class.'"  tabindex="'.$tabIndex.'" '
                        . 'disabled="disabled" onclick="window.location.href=\''.$link.'\'">' 
                        . '<i class="fas fa-trash-alt" style="font-size:1rem;font-weight:bold;"></i>&nbsp;&nbsp;'.$btnTxt
                    .'</button>';
        return $deleteBtn;                 
    }
    
    public static function customBtn ($tabIndex, $faIconName, $btnTxt, $name, $class, $type='button', $includeWaitTip = true) {
        $customBtn = '<button style="width:auto;padding:auto 3px;" type="'.$type.'" name="'.$name.'" class="'.$class.'"  tabindex="'.$tabIndex.'" id="'.$name.'">'
                        . '&nbsp;<i class="fas fa-'.$faIconName.'" style="font-size:1rem;font-weight:bold;"></i>&nbsp;&nbsp;'.$btnTxt.'&nbsp'
                    .'</button>';
        $customBtn .=  ($includeWaitTip) ? '<span class="wait_tip" style="display:none;"><img src="/images/newloader.gif" width="24px" height="24px" id="loading_img"/> Please wait...</span>' : '';
        return $customBtn;                 
    }
    
}
