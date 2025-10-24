<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, OPTIONS");

class Transaction extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model('transaction_model');
		$this->load->model('global_model');
		$this->load->helper(array('url', 'html'));
	}

	public function index()
	{
		if(isset($_SESSION['user_name'] ) != null || isset($_SESSION['user_branch'] ) != null){
			redirect('Dashboard/Admin', 'refresh');
		}else{
			$this->load->view('Pages/login');
		}
	}

	private function check_auth($modul){
		if(isset($_SESSION['user_name']) == null){
			redirect('Masterdata', 'refresh');
		}else{
			$user_role_id = $_SESSION['user_role_id'];
			$check_access = $this->global_model->check_access($user_role_id, $modul);
			return($check_access);
		}
	}

	public function daily(){
		$modul = 'Transactiondaily';
		$check_auth = $this->check_auth($modul);
		if($check_auth[0]->view == 'Y'){
			$class_list['class_list'] = $this->global_model->class_list_schedule();
			$coach_list['coach_list'] = $this->global_model->coach_list();
			$pt_list['pt_list'] = $this->global_model->pt_list();
			$payment_list['payment_list'] = $this->global_model->payment_list();
			$check_auth['check_auth'] = $check_auth;
			$data['data'] = array_merge($check_auth, $coach_list, $class_list, $pt_list, $payment_list);
			$this->load->view('Pages/Transaction/daily', $data);
		}else{
			$msg = "No Access";
			echo json_encode(['code'=>0, 'result'=>$msg]);
		}
	}

	public function get_class_info()
	{
		$schedule_class_id = $this->input->post('id');
		$get_schedule_class_info['get_schedule_class_info'] = $this->global_model->get_schedule_class_info($schedule_class_id);
		echo json_encode(['code'=>200, 'result'=>$get_schedule_class_info]);
	}

	public function daily_save()
	{
		$modul = 'Transactiondaily';
		$check_auth = $this->check_auth($modul);
		if($check_auth[0]->add == 'Y'){
			
		}else{
			$msg = "No Access";
			echo json_encode(['code'=>0, 'result'=>$msg]);
		}
	}

}

?>