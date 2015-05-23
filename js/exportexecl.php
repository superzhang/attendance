<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class Exportexecl extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->library('Authcode');
      //  $this->load->model('cs_m');
    }
    function importvalue()
    {
        //接收json字符串，然后插入签到表里面
     set_include_path(get_include_path() . PATH_SEPARATOR . './PHPExcel/');

        include  'PHPExcel.php';
        /** PHPExcel_IOFactory */
        include 'PHPExcel/IOFactory.php';
        
        /** include php_excel5 */
        include 'PHPExcel/Reader/Excel5.php';
        /***** include php_excel2007*/
        include 'PHPExcel/Reader/Excel2007.php';

        $json = file_get_contents('php://input');
        $json = json_decode($json);

       

        //set_include_path(' http://localhost/PHPExcel/phpexcel/');
        /** PHPExcel */
     
        //新建 
        $resultPHPExcel = new PHPExcel(); 
        //设置参数 
        //设值 
        $resultPHPExcel->getActiveSheet()->setCellValue('A1', '学号'); 
        $resultPHPExcel->getActiveSheet()->setCellValue('B1', '姓名'); 
        $resultPHPExcel->getActiveSheet()->setCellValue('C1', '班级'); 
        $resultPHPExcel->getActiveSheet()->setCellValue('D1', '课程'); 
        $resultPHPExcel->getActiveSheet()->setCellValue('E1', '时间'); 
        $resultPHPExcel->getActiveSheet()->setCellValue('F1', '原因');
        $resultPHPExcel->getActiveSheet()->setCellValue('G1', '节/次');  
        $i = 2; 
        
      
       // print_r($data);
        for ($j=0; $j <count($json) ; $j++) { 
            $date=$json[$j]->Date;
            $student_id=$json[$j]->StudentID;
            $student_name=$json[$j]->StudentName;
            $class_name=$json[$j]->ClassName;
            $course_name=$json[$j]->CourseName;
            $reason_name=$json[$j]->ReasonName;
            $lenth=$json[$j]->Lenth;
         
        $resultPHPExcel->getActiveSheet()->setCellValue('A' . $i, $student_id); 
        $resultPHPExcel->getActiveSheet()->setCellValue('B' . $i, $student_name); 
        $resultPHPExcel->getActiveSheet()->setCellValue('C' . $i, $class_name); 
        $resultPHPExcel->getActiveSheet()->setCellValue('D' . $i, $course_name); 
        $resultPHPExcel->getActiveSheet()->setCellValue('E' . $i, $date);
        $resultPHPExcel->getActiveSheet()->setCellValue('F' . $i, $reason_name); 
        $resultPHPExcel->getActiveSheet()->setCellValue('G' . $i, $lenth);
        $i ++; 
        }
        
        $xlsWriter = new PHPExcel_Writer_Excel5($resultPHPExcel); 
        $outputFileName='考勤表';
        header("Content-Type: application/force-download"); 
        header("Content-Type: application/octet-stream"); 
        header("Content-Type: application/download"); 
        header('Content-Disposition:inline;filename="'.$outputFileName.'"'); 
        header("Content-Transfer-Encoding: binary"); 
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); 
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); 
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
        header("Pragma: no-cache"); 
        $xlsWriter->save( "php://output" );
       // $data['message']='成功';
       $data=$json;
        echo json_encode($json);



    }
    function exportexcel()
    {
        $outputFileName = 'total.xls'; 
        $xlsWriter = new PHPExcel_Writer_Excel5($resultPHPExcel); 
        //ob_start(); ob_flush(); 
        header("Content-Type: application/force-download"); 
        header("Content-Type: application/octet-stream"); 
        header("Content-Type: application/download"); 
        header('Content-Disposition:inline;filename="'.$outputFileName.'"'); 
        header("Content-Transfer-Encoding: binary"); 
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); 
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); 
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
        header("Pragma: no-cache"); 
        $xlsWriter->save( "php://output" );
       
    }

}
?>