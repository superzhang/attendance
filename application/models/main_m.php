<?php
class Main_m extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	function user_select($uname)
	{
		$this->db->where('UserName',$uname);
		$this->db->select('*');
		$query=$this->db->get('sys_user');
		return $query->result();
	}
	
	function select_class()
	{

		$this->db->select('*');
		$query=$this->db->get('Classes');
		return $query->result();
	}

	function insert($db,$arr)
	{	
 		$this->db->insert($db,$arr);
	}

	function select($db)
	{
		
		$q=$this->db->get($db);
		return $q->result();
	}

	


	function get_all($db,$per_page,$desc) 
	{
		
		
		$this->db->order_by($desc,"desc");
		$q = $this->db->get($db, $per_page, $this->uri->segment(3));
		if($q->num_rows() > 0) {
			foreach ($q->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}		
	}

	function select_student($class_id)
	{
		$this->db->where('ClassID',$class_id);
		$this->db->select('*');
		$query=$this->db->get('Students');
		return $query->result();
	}

	function select_syllabus($class_id)
	{
		$this->db->where('ClassID',$class_id);
		$this->db->select('*');
		$query=$this->db->get('Syllabus');
		return $query->result();
	}
	
	function select_course($course_id)
	{
		$this->db->where('CourseID',$course_id);
		$this->db->where('delete','0');
		$this->db->select('*');
		//$this->db->order_by('CourseID',"desc");
		$query=$this->db->get('Course');
		return $query->row(0);
	}

	function delete_class($class_id)
	{
		$this->db->delete('Classes', array('ClassID' => $class_id)); 
	}

	function delete_course($course_id)
	{
		$this->db->delete('Course', array('CourseID' => $course_id)); 
	}

	function delete_syllabus($syllabus_id)
	{
		$this->db->delete('Syllabus', array('SyllabusID' => $syllabus_id)); 
	}
		function delete_checklist($checklist_id)
	{
		$this->db->delete('CheckList', array('CheckListID' => $checklist_id)); 
	}
	function select_line($db,$field,$value)
	{
		$this->db->where($field,$value);
		$this->db->select('*');
		$query=$this->db->get($db);
		return $query->row(0);
	}

	function update_student($student_id,$arr)
	{
		$this->db->where('StudentID', $student_id);
		$this->db->update('Students', $arr); 
	}
	
	function getLine($sql)
	{
		$q=$this->db->query($sql);
		return $q->row(0);
	}
		function run_sql($sql)
	{
		$q=$this->db->query($sql);
		return $q->result();
		
	}

	


	
}