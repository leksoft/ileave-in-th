<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mydate {

    public function __construct() {
        date_default_timezone_set('Asia/Bangkok');
    }

    /* แปลงวันที่จาก Text ลงฐานข้อมูล
     * รับค่าเข้ามาเป็น วว/ดด/ปปปป
     * แปลงค่ากลับไปเป็น yyyy/mm/dd
     */

    function dateToMysql($txt) {
        $result = "";
        if ($txt != "") {
            $year = substr($txt, 6, 4);
            if ($year > 2500) {
                $year = $year - 543;
            }
            $month = substr($txt, 3, 2);
            $day = substr($txt, 0, 2);
            $result = $year . "-" . $month . "-" . $day;
        }
        return $result;
    }

    /* แปลงวันที่จากฐานข้อมูล ไป TextBox รปแบบวันที่นำเข้า 2009-07-30 */

    function dateToText($strDate) {
        $result = "";
        if ($strDate === "" || $strDate == null || $strDate == "0000-00-00") {
            return "";
        } else if (substr($strDate, 0, 4) != "0000") {
            $strYear = date("Y", strtotime($strDate)) + 543;
            $strMonth = date("m", strtotime($strDate));
            $strDay = date("d", strtotime($strDate));
            $result = "$strDay/$strMonth/$strYear";
            return $result;
        }
    }

    //หาวันสุดท้ายของเดือนปัจจุบัน
    function lastDate($year = '', $month = '') {
        $day = array(31, 30, 29, 28);
        if ($month == '')
            $month = date("m");
        if ($year == '')
            $year = date("Y");
        for ($i = 0; $i < count($day); $i++) {
            $day_check = $day[$i];
            if (checkdate($month, $day_check, $year)) {
                $last_date = $day_check . "/" . $month . "/" . ((int) $year + 543);
                break;
            }
        }

        return $last_date;
    }

    /**
     *
     * @param <date> $strDate
     * @param <int> $style 0=วัน เดือน ปี พ.ศ, 1=เดือน ปี พ.ศ.
     * @return <string> string
     */
    function dateThaiLong($strDate, $style = 0) {
        $strYear = date("Y", strtotime($strDate)) + 543;
        $strMonth = date("n", strtotime($strDate));
        $strDay = date("d", strtotime($strDate));
        $strMonthCut = Array("", "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");
        $strMonthThai = $strMonthCut[$strMonth];

        if ($style == 0) {
            return "$strDay $strMonthThai $strYear";
        } else {
            return "$strMonthThai พ.ศ.$strYear";
        }
    }
        /**
     *
     * @param <date> $strDate
     * @param <int> $style 0=วัน เดือน ปี พ.ศ, 1=เดือน ปี พ.ศ.
     * @return <string> string
     */
    function dateThaiLongFull($strDate, $style = 0) {
        $strYear = date("Y", strtotime($strDate)) + 543;
        $strMonth = date("n", strtotime($strDate));
        $strDay = date("d", strtotime($strDate));
        $strMonthCut = Array("", "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฏาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
        $strMonthThai = $strMonthCut[$strMonth];

        if ($style == 0) {
            return "$strDay $strMonthThai $strYear";
        } else {
            return "$strMonthThai พ.ศ.$strYear";
        }
    }
    
        function dateThaiLongShot($strDate, $style = 0) {
        $strYear = date("Y", strtotime($strDate)) + 543;
        $strMonth = date("n", strtotime($strDate));
        $strDay = date("d", strtotime($strDate));
        $strMonthCut = Array("", "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");
        $strMonthThai = $strMonthCut[$strMonth];

        if ($style == 0) {
            return "$strDay $strMonthThai $strYear";
        } else {
            return "$strMonthThai พ.ศ.$strYear";
        }
    }

    
     function MonthAndYear($strDate, $style = 0) {
        $strYear = date("Y", strtotime($strDate)) + 543;
        $strMonth = date("n", strtotime($strDate));

        $strMonthCut = Array("", "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");
        $strMonthThai = $strMonthCut[$strMonth];

        if ($style == 0) {
            return "$strMonthThai $strYear";
        } else {
            return "$strMonthThai พ.ศ.$strYear";
        }
    }


    /* แปลงวันที่จากฐานข้อมูล ไป TextBox รปแบบวันที่นำเข้า 2009-07-30 */

    function dateToTextShort($strDate) {
        $result = "";
        if ($strDate === "")
            return $this->dateToText(date("Y/m/d"));

        if (substr($strDate, 0, 4) != "0000") {
            $strYear = date("Y", strtotime($strDate)) + 543;
            $strYear = substr($strYear, 2);
            $strMonth = date("m", strtotime($strDate));
            $strDay = date("d", strtotime($strDate));
            $result = "$strDay/$strMonth/$strYear";
        }
        return $result;
    }

    //คืนค่าวันที่ การป้อนป้อน 2012-12-01
    function get_dateMySql($date) {
        $day = substr($date, 8, 2);
        return $day;
    }

    /*
     * หาผลต่างของวันที่และเวลา return เป็นชั่วโมง
     * echo "Date Time Diff = ".dateTimeDiff("2008-08-01 00:00","2008-08-01 19:00")."<br>";
     */

    function dateTimeDiff($strDateTime1, $strDateTime2) {
        return (strtotime($strDateTime2) - strtotime($strDateTime1)) / ( 60 * 60 ); // 1 Hour =  60*60
    }

    //คำนวนหาจำนวนวัน

    function DateDiff($strDate1, $strDate2) {
        return (strtotime($strDate2) - strtotime($strDate1)) / ( 60 * 60 * 24 ) + 1;  // 1 day = 60*60*24
    }

    function TimeDiff($strTime1, $strTime2) {
        return (strtotime($strTime2) - strtotime($strTime1)) / ( 60 * 60 ); // 1 Hour =  60*60
    }

    function compareDate($date1, $date2) {
        $arrDate1 = explode("-", $date1);
        $arrDate2 = explode("-", $date2);
        $timStmp1 = mktime(0, 0, 0, $arrDate1[1], $arrDate1[2], $arrDate1[0]);
        $timStmp2 = mktime(0, 0, 0, $arrDate2[1], $arrDate2[2], $arrDate2[0]);

        if ($timStmp1 == $timStmp2) {
            echo "\$date = \$date2";
        } else if ($timStmp1 > $timStmp2) {
            echo "\$date > \$date2";
        } else if ($timStmp1 < $timStmp2) {
            echo "\$date < \$date2";
        }
    }
    
     function dateDay($strDate, $style = 0) {
        $strYear = date("Y", strtotime($strDate)) + 543;
        $strMonth = date("n", strtotime($strDate));
        $strDay = date("d", strtotime($strDate));
        $strMonthCut = Array("", "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฏาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
        $strMonthThai = $strMonthCut[$strMonth];

        if ($style == 0) {
            return "วันที่  $strDay เดือน  $strMonthThai  พ.ศ.$strYear";
        } else {
            return "$strMonthThai พ.ศ.$strYear";
        }
    }

}
