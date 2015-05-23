<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class py extends CI_Controller {

	
	/**	中文转拼音首字母***/
	 
  function  __construct()
  {
    parent::__construct();
 
    //$this->load->library('session');
    $this->load->model('main_m');


  }

  function change()
  {
    $value=$this->db->get_where('Students',array('PY'=>''))->result();
    foreach ($value as $r) 
        {
         
          
          
           $student_id=$r->StudentID;
           $name = $r->StudentName ;
           $len = mb_strlen($name,'utf-8') ;
           $py = "" ;
          
          for($h = 0 ; $h < $len ; $h++)
          {
              $chr = mb_substr($name , $h , 1 , 'utf-8') ;
            echo  $py .= $this->getfirstchar($chr) ;
          }
        
          $arr=array('PY'=>$py);
          echo $py;
          $this->main_m->update_student($student_id,$arr);
  }
}

   function getfirstchar($s)
   { 
      
   
        $sqlGetchar = "select pinyin from py where hanzi like '%$s%'" ;
        $rs = $this->main_m->getLine($sqlGetchar) ;
        if ($rs) {
          return $rs->pinyin ; 
        }
        
   } 

}

