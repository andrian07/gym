<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, OPTIONS");

class Transaction extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model('masterdata_model');
		$this->load->model('register_model');
		$this->load->model('transaction_model');
		$this->load->model('global_model');
		$this->load->helper(array('url', 'html'));
		date_default_timezone_set('Asia/Jakarta');
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

	public function get_hari(){
		$hari = date("l");
		if($hari == 'Sunday'){
			$cari_hari = 'Minggu'; 
		}
		if($hari == 'Monday'){
			$cari_hari = 'Senin'; 
		}
		if($hari == 'Tuesday'){
			$cari_hari = 'Selasa'; 
		}
		if($hari == 'Wednesday'){
			$cari_hari = 'Rabu'; 
		}
		if($hari == 'Thursday'){
			$cari_hari = 'Kamis'; 
		}
		if($hari == 'Friday'){
			$cari_hari = 'Jumat'; 
		}
		if($hari == 'Saturday'){
			$cari_hari = 'Sabtu'; 
		}
		return $cari_hari;
	}

	public function get_class_info()
	{
		$schedule_class_id = $this->input->post('id');
		$get_schedule_class_info['get_schedule_class_info'] = $this->global_model->get_schedule_class_info($schedule_class_id);
		echo json_encode(['code'=>200, 'result'=>$get_schedule_class_info]);
	}

	public function get_class_schedule()
	{
		$class_name = $this->input->post('class_name');
		$hari = $this->get_hari();
		$get_class_schedule['get_class_schedule'] = $this->global_model->get_class_schedule($class_name, $hari);
		echo json_encode(['code'=>200, 'result'=>$get_class_schedule]);
	}

	public function daily_save()
	{
		$modul = 'Transactiondaily';
		$check_auth = $this->check_auth($modul);
		if($check_auth[0]->add == 'Y'){
			$member_id 					= $this->input->post('member_id');
			$member_name 				= $this->input->post('member_name');
			$member_phone 				= $this->input->post('member_phone');
			$member_address 			= $this->input->post('member_address');
			$member_gender 				= $this->input->post('member_gender');
			$member_info_join 			= $this->input->post('ellunainfo');
			$schedule_class_id  		= $this->input->post('schedule_class_id');
			$class_price_val 			= $this->input->post('class_price_val');
			$payment 					= $this->input->post('payment');
			$user_id 		   			= $_SESSION['user_id'];



			$check_member_phone = $this->masterdata_model->check_member_phone($member_phone);

			if($member_id == null){
				if($check_member_phone != null){
					$msg = "No Hp Sudah Di Gunakan";
					echo json_encode(['code'=>0, 'result'=>$msg]);die();
				}

				if($member_name == null){
					$msg = "Nama Harus Di isi";
					echo json_encode(['code'=>0, 'result'=>$msg]);die();
				}
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
				'member_gender'				=> $member_gender,
				'member_info_join'			=> $member_info_join
			);

			if($member_id == null){
				$insert_member = $this->masterdata_model->save_member($data_insert);
			}else{
				$insert_member = $member_id;
			}

			$get_class_id = $this->transaction_model->get_class_id($schedule_class_id);

			$maxCode  = $this->register_model->last_register();
			$inv_code = 'TRX/'.date("d/m/Y").'/';
			if ($maxCode == NULL) {
				$last_code = $inv_code.'000001';
			} else {
				$maxCode   = $maxCode[0]->transaction_register_inv;
				$last_code = substr($maxCode, -6);
				$last_code = $inv_code.substr('000000' . strval(floatval($last_code) + 1), -6);
			}

			$data_insert_register = array(
				'transaction_register_inv'	    => $last_code,
				'member_id'	       				=> $insert_member,
				'transaction_type_member'	   	=> 'Kelas Only',
				'transaction_class'	    		=> 'Y',
				'transaction_class_id'			=> $get_class_id[0]->class_id
			);

			$save_transaction = $this->transaction_model->save_transaction($data_insert_register);


			$insert_transaction_register_daily = array(
				'transaction_register_id '	=> $save_transaction,
				'schedule_class_id'	       	=> $schedule_class_id
			);

			$this->transaction_model->save_transaction_daily($insert_transaction_register_daily);

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
	}

	public function get_member_class()
	{
		$hari = $this->get_hari();
		$title = $this->input->post('title');
		$name = $this->input->post('name');
		$get_member_class['get_member_class'] = $this->global_model->get_member_class($title, $hari, $name)->result_array();
		echo json_encode(['code'=>200, 'result'=>$get_member_class]);
	}

	public function get_absence()
	{
		$title = $this->input->post('title');
		$get_absence['get_absence'] = $this->global_model->get_absence($title)->result_array();
		echo json_encode(['code'=>200, 'result'=>$get_absence]);
	}

	public function search_member()
	{	
		$keyword = $this->input->get('term');
		$result = ['success' => FALSE, 'num_product' => 0, 'data' => [], 'message' => ''];
		if (!($keyword == '' || $keyword == NULL)) {
			$find = $this->global_model->search_member($keyword)->result_array();
			$find_result = [];
			foreach ($find as $row) {
				$diplay_text = $row['member_name'].' - '.$row['member_phone'];
				$find_result[] = [
					'id'                  => $row['member_id'],
					'value'               => $diplay_text,
					'member_code'		  => $row['member_code'],
					'member_phone'        => $row['member_phone'],
					'member_gender'       => $row['member_gender'],
					'member_address'      => $row['member_address'],
				];
			}
			$result = ['success' => TRUE, 'num_product' => count($find_result), 'data' => $find_result, 'message' => ''];
		}
		echo json_encode($result);
	} 

	public function save_abssence()
	{
		$modul = 'Absence';
		$check_auth = $this->check_auth($modul);
		if($check_auth[0]->add == 'Y'){

			$memberid_abs 		= $this->input->post('memberid_abs');
			$membername_abs 	= $this->input->post('membername_abs');
			$membertype_abs 	= $this->input->post('membertype_abs');
			$classid_abs 		= $this->input->post('classid_abs');
			$scheduleid_abs 	= $this->input->post('scheduleid_abs');
			$user_id 		   	= $_SESSION['user_id'];

			$data_insert = array(
				'absence_member_id'	       	=> $memberid_abs,
				'absence_type_member'	    => $membertype_abs,
				'absence_class_id'	   		=> $classid_abs,
				'absence_schedule_class_id'	=> $scheduleid_abs,
				'absence_user'				=> $user_id
			);

			$insert_member = $this->transaction_model->save_abssence($data_insert);
			
			$data_insert_act = array(
				'activity_table_desc'	       => 'Absen: '.$membername_abs,
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
	}

}

?>