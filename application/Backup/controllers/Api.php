<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, OPTIONS");

class Api extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model('api_model');
		$this->load->helper(array('url', 'html'));
		date_default_timezone_set('Asia/Jakarta');
	}

	public function index(){
		echo "Api 1.0";
	}


	private function check_auth(){
		if(isset($_SESSION['user_name']) == null){
			redirect('Dashboard', 'refresh');
		}
	}

	public function saveclient()
	{
		$data 	= json_decode(file_get_contents('php://input'), true);
		print_r($data);die();
	}

	public function checkregisterdaily()
	{
		$data 	= json_decode(file_get_contents('php://input'), true);
		$phone  			= $data['phone'];
		$schedule_class_id  = $data['schedule_class_id'];
		$checkregisterdaily = $this->api_model->checkregisterdaily($phone, $schedule_class_id)->result_array();
		if($checkregisterdaily != null){
			echo json_encode(['code'=>0, 'result'=>'Data Sudah Ada']);
		}else{
			echo json_encode(['code'=>200, 'result'=>'Data Belum Ada']);
		}
	}



}

?>