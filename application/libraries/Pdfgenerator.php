<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PdfGenerator
 *
 * @author kurawall
 */
class Pdfgenerator {
    //put your code here
    public function generate($html, $filename) {
        define('DOMPDF_ENABLE_AUTOLOAD', false);
        require_once( APPPATH. "vendor/dompdf/dompdf/dompdf_config.inc.php");
        $dompdf = new DOMPDF();
        $dompdf->load_html($html);
        $dompdf->render();
        $dompdf->stream($filename .'.pdf', array("Attachment" => 0));
    }
}
