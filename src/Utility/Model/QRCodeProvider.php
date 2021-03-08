<?php

namespace Utility\Model;

require_once __DIR__.'/../../../phpqrcode.php';                 

use RobThree\Auth\Providers\Qr\IQRCodeProvider;

/**
 * EduQRCodeProvider
 * @package smart
 * @author nikagomi
 */
class QRCodeProvider implements IQRCodeProvider {
    public function getMimeType() {
        return 'image/png';                             // This provider only returns PNG's
      }

      public function getQRCodeImage($qrtext, $size = 3) {
        ob_start();             // 'Catch' QRCode's output
        
        \QRcode::png($qrtext, null, QR_ECLEVEL_L, $size, 4); // We ignore $size and set it to 3
                                                        // since phpqrcode doesn't support
                                                        // a size in pixels...
        $result = ob_get_contents();                    // 'Catch' QRCode's output
        ob_end_clean();                                 // Cleanup
        return $result;                                 // Return image
      }
}
