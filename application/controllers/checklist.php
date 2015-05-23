<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Checklist extends CI_Controller {

	function  __construct()
	{
		parent::__construct();
		//$this->load->library('session');
		$this->load->model('main_m');


	}

	function search_checklist()
	{
	    
		$CourseID=$_POST['CourseID'];
		$ClassID=$_POST['ClassID'];
		$BeginDate=$_POST['BeginDate'];
		$EndDate=$_POST['EndDate'];
		$sql="SELECT *  FROM  `CheckList` WHERE Lenth>=0";
		$A=" AND (Date between '$BeginDate' AND '$EndDate' )";
		$B=" AND ClassID='$ClassID'";
		$C=" AND CourseID='$CourseID'";
		// if ($CourseID!='null'&&$ClassID!='null'&&$BeginDate!='null'&&$EndDate!='null') {
		
		// $sql="SELECT *  FROM  `CheckList` WHERE CourseID='$CourseID' AND ClassID='$ClassID'  AND (Date between '$BeginDate' AND '$EndDate' )GROUP BY StudentID";
		// }
		// else if ($BeginDate=='null'&&$EndDate=='null'&&$ClassID!='null'&&$CourseID!='null') {
		// 	$sql="SELECT * FROM `CheckList` WHERE  ClassID='$ClassID' AND CourseID='$CourseID' ";
		// }
		// else if ($BeginDate=='null'&&$EndDate=='null'&&$ClassID!='null'&&$CourseID=='null') {
		// 	$sql="SELECT * FROM `CheckList` WHERE  ClassID='$ClassID'  ";

		// }
		// else if ($BeginDate!='null'&&$EndDate!='null'&&$ClassID!='null'&&$CourseID=='null') {
		// 	$sql="SELECT *  FROM  `CheckList` WHERE ClassID='$ClassID'  AND (Date between '$BeginDate' AND '$EndDate' )GROUP BY StudentID";

		// }
		if ($BeginDate!='null'&&$EndDate!='null') {
		 $sql=$sql.$A;
		}
		if ($ClassID!='null') {
		 $sql=$sql.$B;
		}
		if ($CourseID!='null') {
		$sql=$sql.$C;
		}
		$rows = $this->main_m->run_sql($sql);
		$array=array();
		if(!empty($rows))
		{
			foreach ($rows as $r) {
				$date=$r->Date;
				$checklist_id=$r->CheckListID;
				$student_id=$r->StudentID;
				$student_name=$this->main_m->select_line('Students','StudentID',$student_id)->StudentName;
				$class_id=$r->ClassID;
				$class=$this->main_m->select_line('Classes','ClassID',$class_id);
				$class_name=$class->ClassName;
				$grade=$class->Grade;
				$class_name=$grade.'-'.$class_name;
				$course_id=$r->CourseID;
				$course=$this->main_m->select_line('Course','CourseID',$course_id);
				if (!empty($course)) {
					$course_name=$course->CourseName;
				
					$reason_id=$r->ReasonID;
					$reason_name=$this->main_m->select_line('Reason','ReasonID',$reason_id)->ReasonName;
					$lenth=$r->Lenth;
					$arr = array('CheckListID'=>$checklist_id,'Date' =>$date ,'StudentID'=>$student_id,'StudentName'=>$student_name,'ClassName'=>$class_name,'CourseName'=>$course_name,'ReasonName'=>$reason_name,'Lenth'=>$lenth );

					$array[]=$arr;
				}
			}
		}
		else
		{
			$data['message']='查询数据为空，请重新选择条件';
		}
		
	    $data['array']=$array;
		//$data['message']=$sql;
		echo json_encode($data);

	}

	function delete_checklist()
	{
		$checklist_id=$_POST['CheckListID'];
		$this->main_m->delete_checklist($checklist_id);
		$data['message']='删除成功';
		echo json_encode($data);

	}
	function test ()
	{
		echo "abc";
	}

}
