<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Report_m extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_header() {
        $row = $this->db->get('systems')->row_array();
        $company = $row['company'];

        return $company;
    }

    function set_header($text = '') {
        $row = $this->db->get('systems')->row_array();
        $company = $row['company'];
        $header = '<div class="caption">' . $company . '</div>';
        return $header;
    }

    function set_footer($text = '') {
        if ($text == '') {
            $footer = '<div style="padding-top:10px;font-size:14px">*** สิ้นสุดรายงาน ***</div>';
        } else {
            $footer = '<div style="padding-top:10px;font-size:14px">' . $text . '</div>';
        }
        return $footer;
    }

    function set_caption($text = '') {
        $caption = "<div class='caption_rpt'>$text</div>";
        return $caption;
    }

    function get_css_pdf() {
        //$stylesheet = '<link rel="stylesheet" media="print" href="'.base_url().'assets/css/print-preview-pdf.css" />';
        $style = <<<EOD
.caption{
    padding: 0px 0 4px 0;
    text-align: center;
    font-size: 20px;

}
                .h{
            border-bottom: dashed 1px #333;
                font-size: 16px;
                
   }
.caption_rpt{
    padding: 0px 0 10px 0;
    text-align: right;
    font-size: 14px;
  
}
 .caption_center{
    padding: 0px 0 10px 0;
    text-align: center;
    font-size: 14px;
   
}
table{
    width: 100%;
    border: 0px solid gray;
    border-collapse: collapse;
    font-size: 14px;
}
table.size10{
    font-size:10px;
}
table th{
    border: 0px solid gray;
    padding: 5px 3px;
    text-align: left;
}
table td{
    border: 0px solid gray;
    padding: 5px 3px;
}

table.letter td{
    border:none;
}

table.noborder {
    border:none;
}
table.noborder td{
    border:none;
}
.center{
text-align:center;
}
EOD;
        return $style;
    }
    function get_combo() {
        $this->db->order_by('name');
        $result = $this->db->get('tbleave_type')->result_array();
        return $result;
    }
    function get_one($id) {
        $this->db->where('id',$id);
        $row = $this->db->get('tbleave_type')->row_array();
        if(count($row)==0) {
            $row['id'] = '';
             $row['name'] = '';
             
                  }

        return $row;
    }

}