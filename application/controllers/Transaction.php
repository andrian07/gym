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
			if($check_auth[0]->add == 'Y'){
				$member_name 				= $this->input->post('member_name');
				$member_phone 				= $this->input->post('member_phone');
				$member_address 			= $this->input->post('member_address');
				$member_info_join 			= $this->input->post('ellunainfo');
				$schedule_class_id  		= $this->input->post('schedule_class_id');
				$class_price_val 			= $this->input->post('class_price_val');
				$payment 					= $this->input->post('payment');
				$user_id 		   			= $_SESSION['user_id'];

				

				$check_member_phone = $this->masterdata_model->check_member_phone($member_phone);
				if($check_member_phone != null){
					$msg = "No Hp Sudah Di Gunakan";
					echo json_encode(['code'=>0, 'result'=>$msg]);die();
				}

				if($member_name == null){
					$msg = "Nama Harus Di isi";
					echo json_encode(['code'=>0, 'result'=>$msg]);die();
				}

				if($member_phone == null){
					$msg = "No Hp Harus Di isi";
					echo json_encode(['code'=>0, 'result'=>$msg]);die();
				}

				if($schedule_class_id == null){
					$msg = "Kelas Harus di Pilih Harus Di isi";
					echo json_encode(['code'=>0, 'result'=>$msg]);die();
				}

				if($payment == null){
					$msg = "Pembayaran di Pilih Harus Di isi";
					echo json_encode(['code'=>0, 'result'=>$msg]);die();
				}

				$maxCode = $this->masterdata_model->last_member_code();
				if ($maxCode == NULL) {
					$last_code = '000001';
				} else {
					$maxCode = $maxCode[0]->member_code;
					$last_code = substr($maxCode, -6);
					$last_code = substr('00000' . strval(floatval($last_code) + 1), -6);
				}

				$data_insert = array(
					'member_code'	       		=> $last_code,
					'member_name'	       		=> $member_name,
					'member_phone'	   			=> $member_phone,
					'member_address'	    	=> $member_address,
					'member_info_join'			=> $member_info_join
				);

				$insert_member = $this->masterdata_model->save_member($data_insert);


				$data_insert_schedule_member = array(
					'member_id'	       			=> $insert_member,
					'schedule_class_id'	       	=> $schedule_class_id
				);

				$this->masterdata_model->save_schedule_member($data_insert_schedule_member);

				
				$data_insert_transaction = array(
					'member_code'	       		=> $last_code,
					'member_name'	       		=> $member_name,
					'member_phone'	   			=> $member_phone,
					'member_address'	    	=> $member_address,
					'member_info_join'			=> $member_info_join
				);

				$insert_member = $this->masterdata_model->save_member($data_insert_transaction);


				$data_insert_act = array(
					'activity_table_desc'	       => 'Tambah Pendaftaran Kelas Harian Member: '.$last_code,
					'activity_table_user'	       => $user_id,
				);
				$this->global_model->save($data_insert_act);
				$msg = "Succes Input";
				echo json_encode(['code'=>200, 'result'=>$msg]);
				die();
			}else{
				$msg = "No Access";
				echo json_encode(['code'=>0, 'result'=>$msg]);
			}	
		}else{
			$msg = "No Access";
			echo json_encode(['code'=>0, 'result'=>$msg]);
		}
	}

}

?>