<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Myfile {

    public function __construct() {
       
    }

    //หา Path ระดับ physical ของเว็บแบบย่อ จะแสดงออกมาเป็น /ชื่อเว็บ/
    //TCPDF เวลาแสดงรูปให้ใช้ function นี้ในการดึงภาพ
    function GetMainBaseFromURL() {
        $url = $_SERVER['PHP_SELF'];
        $chars = preg_split('//', $url, -1, PREG_SPLIT_NO_EMPTY);
        $slash = 2; // 3rd slash
        $i = 0;
        foreach ($chars as $key => $char) {
            if ($char == '/') {
                $j = $i++;
            }
            if ($i == 2) {
                $pos = $key;
                break;
            }
        }
        $main_base = substr($url, 0, $pos);
        return $main_base . '/';

        //return "/";
    }

//หา Path ระดับ physical ของเว็บแบบเต็ม จะแสดงออกมาเป็น เช่น d:/www/ชื่อเว็บ/
    function GetPhysicalFromURL_() {
        $url = $_SERVER['PHP_SELF'];
        $chars = preg_split('//', $url, -1, PREG_SPLIT_NO_EMPTY);
        $slash = 2; // 3rd slash
        $i = 0;
        $pos = '';
        foreach ($chars as $key => $char) {
            if ($char == '/') {
                $j = $i++;
            }
            if ($i == 2) {
                $pos = $key;
                break;
            }
        }
        $main_base = substr($url, 0, $pos);
        return $_SERVER['DOCUMENT_ROOT'] . $main_base . '/';
    }

    //หา Path ระดับ physical ของเว็บแบบเต็ม จะแสดงออกมาเป็น เช่น d:/www/ชื่อเว็บ/
    function GetPhysicalFromURL() {
        $url = $_SERVER['PHP_SELF'];
        $chars = preg_split('//', $url, -1, PREG_SPLIT_NO_EMPTY);
        $slash = 2; // 3rd slash
        $i = 0;
        $pos = '';
        foreach ($chars as $key => $char) {
            if ($char == '/') {
                $j = $i++;
            }
            if ($i == 2) {
                $pos = $key;
                break;
            }
        }
        $main_base = str_replace($url, 0, $pos);
        //$main_base = substr($url, 0, $pos);
        return $_SERVER['DOCUMENT_ROOT'] . $main_base . '/';
        //return $_SERVER['DOCUMENT_ROOT']."/";
    }

}
