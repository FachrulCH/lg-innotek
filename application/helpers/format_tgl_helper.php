<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('format_tgl')){

    function format_tgl($tgl){
        return date_format(date_create($tgl),"D, d-M-Y");
    }
}
