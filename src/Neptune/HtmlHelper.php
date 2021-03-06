<?php

namespace Neptune;

class HtmlHelper {

    var $_errorMsg = "Error: Could not save your changes. Please try again or contact your administrator.";
    var $_successMsg = "Your changes were successfully saved";

    public function __construct() {
  
    }

    public function showPaginationHeader() {
        if (!empty($this->_paginationHeader)) {
            echo $this->_paginationHeader;
        } else {
            echo "&nbsp;";
        }
    }

    public function cleanText($str) {//eliminar espacios en la cadena
        return trim(addslashes(strip_tags($str)), " ");
    }

    public function printMessageText($flg, $text) {
        $div = "";
        if ($flg) {
            $div .= "<div align='left' class='successMessage'>" . $text . "</div>";
        } else {
            $div .= "<div align='left' class='errorMessage'>" . $text . "</div>";

        }
        return $div;
    }

    public function truncateString($str, $length = 10, $trailing = '...') {
        
        if (strlen($str) <= $length) {
            return \trim($str);
        } else {
            // take off chars for the trailing
            $length -= strlen($trailing);
            if (strlen($str) > $length) {
                // string exceeded length, truncate and add trailing dots
                return substr($str, 0, $length) . $trailing;
            } else {
                // string was already short enough, return the string
                $res = $str;
            }
            return \trim($res);
        }
    }

    public function groupPageElements($arr, $rowsOf = 4, $containerStart = "<div class='row'>", $containerEnd = "</div>") {//10
        
        $result = "";
        if(\count($arr) > 0){
            $i = 0;
            $arrSize = count($arr);
            $size = floor(12 / $rowsOf);
            //0, 1, 2, 3,4, 5, 6, 7,8,9 
            foreach ($arr as $cb) {
                if ($i == 0) {
                    $result .= $containerStart;
                }
                if ($i < $rowsOf) {
                    $result .= "<div class='medium-" . $size . " columns'>";
                    $result .= $cb;
                    $result .= "</div>";
                    $i++;
                }
                if ($i >= $rowsOf && $i < $arrSize) {
                    $result .= $containerEnd;
                    $i = 0;
                }
                if ($i >= $rowsOf && $i >= $arrSize) {
                    $result .= $containerEnd;
                    //$i = 0;
                }
            }
            if ($i < $rowsOf && $i != 0) {
                for ($x = 0; $x < ($rowsOf - $i); $x++) {
                    $result .= "<div class='medium-" . $size . " columns'>";
                    $result .= "</div>";
                }
                $result .= $containerEnd;
            }
        }
        return $result;
    }

    public function generateYearDropDown() {
        date_default_timezone_set('America/St_Lucia');
        $thisYear = date("Y");
        $dropDown = array();
        $dropDown[''] = '';
        for ($i = $thisYear ; $i >= ($thisYear - 40); $i--) {
            $dropDown[$i] = $i;
        }
        return $dropDown;
    }
    
    public static function replaceQuotes ($text) {
        $textPhaseOne = \str_replace("'", '&quot;', $text);
        return \str_replace('"', '&quot;', $textPhaseOne);
    }

    //transform: translate(-50%, 0); left:50%;
    public static function generateToast ($flag, $msg) {
        $toast = "";
        $toastType = ($flag || $flag == 1) ? "successToast" : "errorToast";
        $hiding  = ($flag || $flag == 1) ? 'data-delay="3000"' : 'data-autohide="false"';
        
        //<!-- Then put toasts within -->
        $toast .= '<div class="toast '.$toastType.'" role="alert" aria-live="assertive" aria-atomic="true" '.$hiding.' style="">
          <div class="toast-body" style="position: relative !important;">
          <button type="button" style="width: 40px !important;position:absolute !important; top: 0; right: -3px;margin-bottom:14px !important;padding-bottom:14px !important;" class="close" data-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true" style="color: #FFFFFF !important;">&times;</span>
                </button>'.
            $msg
          .'</div>
        </div>';
        
        return $toast;
}

    public static function toastWrapperStart () {
        $toastWrapper = '<div aria-live="polite"  aria-atomic="true" style="pointer-events:none; position: absolute; top: 0; right: 0; z-index:30; min-height: 200px; max-width:350px; min-width:300px;">';
        //<!-- Position it -->
        $toastWrapper .= '<div style="position: absolute; top: 0; right: 0;pointer-events:auto;">';
        //$toastWrapper .= '<div style="">';
        return $toastWrapper;
    }
    
    public static function toastWrapperEnd () {
        $toastWrapper = '</div></div>';
        return $toastWrapper;
    }
    
    public static function composeToastMessage (array $messages) {
        $toastContent = '';
        $toastMsg = "";
        if (\count($messages) > 1) {
            foreach ($messages as $msgArr) {
                foreach ($msgArr as $flg => $msg) {
                    $toastContent .= (\trim($msg) != '') ? self::generateToast(\boolval($flg), $msg) : '';
                }
            }
            $toastMsg .= (\trim($toastContent) != '') ? self::toastWrapperStart() . $toastContent . self::toastWrapperEnd() : '';
        } elseif (\count($messages) == 1) {
            if (\is_array($messages[0])) {
                $msg = $messages[0];
                $flg = \key($msg);
                $txt = $msg[$flg];
                $toastContent .= (\trim($txt) != '') ? self::generateToast(\boolval($flg), $txt) : '';
            } else {
                //Not a multi-dimensional array 
                //$msg = $messages[0];
                //echo "me"; print_r($messages);
                $flg = \key($messages);
                $txt = $messages[$flg];
                
                $toastContent .= (\trim($txt) != '') ? self::generateToast(\boolval($flg), $txt) : '';
            }
            $toastMsg .= (\trim($toastContent) != '') ? self::toastWrapperStart() . $toastContent . self::toastWrapperEnd() : ''; 
        }
        return $toastMsg;
    }

}
