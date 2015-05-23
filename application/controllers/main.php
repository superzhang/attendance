<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	function  __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->library('session');
		$this->load->model('main_m');


	}

	function index()
	{

		$this->load->helper('url');
		$this->load->library('session');

		if ($this->session->userdata('admin')) {
			 
			$this->load->view('main.html');
		}
		else
		{
			$this->load->view('login.php');


	    }

	}

	function checklogin()
	{
		$this->load->library('session');
		$this->load->helper('url');
	   		$this->load->helper( array('form','url' ));
		$this->load->library('form_validation');
		$this->form_validation->set_rules('uname','用户名','required|min_length[4]|max_length[32]');
		if ($this->session->userdata('admin')==FALSE) {

		if ($this->form_validation->run()==FALSE) {
			$data['error']='请输入用户名';
			$this->load->view('login',$data);
		}
		else
		{
			$user_name=$this->input->post('uname');
			$user=$this->main_m->user_select($user_name);
			if($user)
			{
				if($user[0]->UserPWD==md5($this->input->post('upwd')))
				{
					$this->load->library('session');
					$this->session->set_userdata('admin','admin');
				header('Location: /wecheck/index.php/main/index');	
				}
				else
				{
					$data['error']='密码不正确';
					$this->load->view('login',$data);
				}
			}
			else
			{
				$data['error']='用户名不存在';
				$this->load->view('login',$data);
			}
		}
	}
	else
	{
				header('Location: /wecheck/index.php/main/index');	
	}
}

	function all_json()
	{
		$array=array();
		$value=$this->main_m->select_class();
		$c['CourseID']="无";
				
		$c['CourseName']="无";
		$c['CourseLenth']="无";
		foreach ($value as $r) {
			$class_id=$r->ClassID;//获得课程班级id
			$grade=$r->Grade;
			$class_name=$r->ClassName;
			$option1=$grade.'-'.$class_name;
			$wecheck['class_name']=$option1;
			$wecheck['class_id']=$r->ClassID;
			
			$students=$this->main_m->select_student($class_id);
			$course_ids=$this->main_m->select_syllabus($class_id);//根据班级id获取课程id
			$arr1= array();
			foreach ($course_ids as $v) {
				$course_id=$v->CourseID;
				$time=$v->Time;

				if ($time==1) {
					$times='周一';
				}
				else if ($time==2) {
					$times='周二';
				}
				else if($time==3)
				{
					$times='周三';
				}
				else if ($time==4) {
					$times='周四';
				}
				else if ($time==5) {
					$times='周五' ;
				}
				
				//$course_name=$this->main_m->select_course($course_id)->CourseName;
				$course=$this->main_m->select_course($course_id);
				// echo "start";
				// echo $course_id;
				// echo "end";
				if (!empty($course)) {
					$course_name=$course->CourseName;
					$option2=$times."--".$course_name;
					
					$c['CourseID']=$course->CourseID;
					
					$c['CourseName']=$option2;
					$c['CourseLenth']=$course->CourseLenth;
				}
			
			
				$arr1[]=$c;
			}
			$wecheck['student']=$students;
			$wecheck['course_name']=$arr1;
			$array[]=$wecheck;
		}
		echo json_encode($array);
	}

	function proccess()//接收json字符串，然后插入签到表里面
	{
		$json = file_get_contents('php://input');
		$json = json_decode($json);
		
		if (empty($json)) {
			$data['message']='请添加再提交';
		}
		else
		{
		for ($i=0; $i <count($json) ; $i++) { 
				$date=$json[$i]->date;
				$class_id=$json[$i]->class_id;
				$course_id=$json[$i]->course_id;
				$student_id=$json[$i]->student_id;
				$lenth=$json[$i]->lenth;
				$reason=$json[$i]->reason;
				if ($reason=='旷课') {
					$reason_id=0;
				}
				else if ( $reason=='迟到') {
					$reason_id=1;
					$lenth=1;
				}
				else if ($reason=='早退') {
					$reason_id=2;
					$lenth=1;
				}
				else if ($reason=='公假') {
					$reason_id=3;
					
				}
				else if ($reason=='私假') {
					$reason_id=4;
					
				}
				$ar=array('Date'=>$date,'ClassID'=>$class_id,'CourseID'=>$course_id,'StudentID'=>$student_id,'ReasonID'=>$reason_id,'Lenth'=>$lenth);
				$this->main_m->insert('CheckList',$ar);
		}

	
		
		$data['message']= '添加成功';
	}

    // return all our data to an AJAX call
   		 echo json_encode($data);
	}

	function manager_class()
	{
		if ($this->session->userdata('admin'))
		{
		
			$this->load->view('class.html');

		}
		else
		{
			header('Location: /wecheck/index.php/main/index');	

		}
	}

	function class_json()
	{
		$value=$this->main_m->select_class();
		echo json_encode($value);
	}

	function add_class()
	{
		$Grade=$_POST['Grade'];
		$ClassName=$_POST['ClassName'];
		$Peoples=$_POST['Peoples'];
		$arr=array('Grade'=>$Grade,'ClassName'=>$ClassName,'Peoples'=>$Peoples);
		$this->main_m->insert('Classes',$arr);
		$row=$this->db->affected_rows();
		$ClassID=$this->db->insert_id();
		$data['insert']=array('ClassID'=>$ClassID,'Grade'=>$Grade,'ClassName'=>$ClassName,'Peoples'=>$Peoples);
		
		if ($row!=0) {
			$data['message']='添加成功';

		}
		else
		{
			$data['message']='失败';
		}
		echo json_encode($data);

	}

	function delete_class()
	{
		$ClassID=$_POST['ClassID'];
		$this->main_m->delete_class($ClassID);
		$data['message']='删除成功';
		echo json_encode($data);

	}

	function manager_course()
	{
		if ($this->session->userdata('admin'))
		{
		  $this->load->view('course.html');
		}
		else
		{
			header('Location: /wecheck/index.php/main/index');	
		}
	}

	function course_json()
	{
		$value=$this->main_m->select('Course');
		echo json_encode($value);
	}
	function add_course()
	{
		$course_name=$_POST['CourseName'];
		$course_lenth=$_POST['CourseLenth'];
		
		$arr=array('CourseName'=>$course_name,'CourseLenth'=>$course_lenth);
		$this->main_m->insert('Course',$arr);
		$CourseID=$this->db->insert_id();
		$data['insert']=array('CourseID'=>$CourseID,'CourseName'=>$course_name,'CourseLenth'=>$course_lenth);
		$data['message']='添加成功';
		echo json_encode($data);

	}

	function delete_course()
	{
		$CourseID=$_POST['CourseID'];
		$this->main_m->delete_course($CourseID);
		$data['message']='删除成功';
		echo json_encode($data);

	}
	function manager_checklist()
	{
		if ($this->session->userdata('admin'))
		{
			$this->load->view('checklist.html');
		}
		else
		{
			header('Location: /wecheck/index.php/main/index');	

		}
	}

	function checklist_json()
	{
		$array=array();
		$value=$this->main_m->select('CheckList');
		foreach ($value as $r) {
			$date=$r->Date;
			$checklist_id=$r->CheckListID;
			$student_id=$r->StudentID;
			$student_name=$this->main_m->select_line('Students','StudentID',$student_id)->StudentName;
			$class_id=$r->ClassID;
			$class=$this->main_m->select_line('Classes','ClassID',$class_id);
			if(!empty($class))
			{
			$class_name=$class->ClassName;
			$grade=$class->Grade;
			$class_name=$grade.'-'.$class_name;}
			$course_id=$r->CourseID;
			//$course=$this->main_m->select_line('Course','CourseID',$course_id);
			$course=$this->db->get_where('Course',array('CourseID' => $course_id,'delete'=>0))->row(0);
			if (!empty($course)) {
				$course_name=$course->CourseName;
			
			$reason_id=$r->ReasonID;
			$reason_name=$this->main_m->select_line('Reason','ReasonID',$reason_id)->ReasonName;
			$lenth=$r->Lenth;
			$arr = array('CheckListID'=>$checklist_id,'Date' =>$date ,'StudentID'=>$student_id,'StudentName'=>$student_name,'ClassName'=>$class_name,'CourseName'=>$course_name,'ReasonName'=>$reason_name,'Lenth'=>$lenth );

			$array[]=$arr;
		}
		}
		echo json_encode($array);

	}

	function syllabus()
	{
		if ($this->session->userdata('admin'))
	    {
			$this->load->view('syllabus.html');
		}
		else
		{
			header('Location: /wecheck/index.php/main/index');	

		}
	}

	function syllabus_json()
	{
		$array=array();
		$value=$this->main_m->select('Syllabus');
		$course_name='';
		foreach ($value as $r) {
			$class_id=$r->ClassID;
			$class_value=$this->main_m->select_line('Classes','ClassID',$class_id);
			if(!empty($class_value))
			{
				$grade=$class_value->Grade;
				$class_name=$class_value->ClassName;
			
			//$class_name=$this->main_m->select_line('Classes','ClassID',$class_id)->ClassName;

			$option1=$grade.'-'.$class_name;
			$course_id=$r->CourseID;

			//$course=$this->main_m->select_line('Course','CourseID',$course_id);
			$course=$this->db->get_where('Course',array('CourseID'=>$course_id,'delete'=>0))->row(0);
			if (!empty($course)) {
				$course_name=$course->CourseName;
			}
			$time=$r->Time;

			if ($time==1) {
				$times='周一';
			}
			else if ($time==2) {
				$times='周二';
			}
			else if ($time==3) {
				$times='周三';
			}
			else if ($time==4) {
				$times='周四';
			}
			else if ($time==5) {
				$times='周五';
			}
			$wecheck['class_name']=$option1;
			$wecheck['course_name']=$course_name;
			$wecheck['time']=$times;
			$wecheck['syllabus_id']=$r->SyllabusID;
			$wecheck['course_info']=$r->CourseInfo;
			$array[]=$wecheck;
			}
		}
		

		
		echo json_encode($array);
	}


	function all_class_json()
	{
		$array1=array();
		$value1=$this->main_m->select('Classes');
		foreach ($value1 as $r) {
			$class_id=$r->ClassID;//获得课程班级id
			$grade=$r->Grade;
			$class_name=$r->ClassName;
			$option1=$grade.'-'.$class_name;
			$wecheck['class_name']=$option1;
			$wecheck['class_id']=$class_id;
			$array[]=$wecheck;
		}
		echo json_encode($array);
	}
	function all_course_json()
	{
		$value=$this->db->get_where('Course',array('delete'=>0))->result();
		echo  json_encode($value);
	}

	function add_syllabus()
	{
		$course_id=$_POST['course_id'];
		$class_id=$_POST['class_id'];
		$course_info=$_POST['course_info'];
		$time=$_POST['time'];
		$arr=array('ClassID'=>$class_id,'CourseID'=>$course_id,'Time'=>$time,'CourseInfo'=>$course_info);
		$this->main_m->insert('Syllabus',$arr);
		$SyllabusID=$this->db->insert_id();
		$data['syllabus_id']=$SyllabusID;
		$data['message']='添加成功';
		echo json_encode($data);

	}
	function delete_syllabus()
	{
		$syllabus_id=$_POST['syllabus_id'];
		$this->main_m->delete_syllabus($syllabus_id);
		$data['message']='删除成功';
		echo json_encode($data);

	}
	
}


/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */