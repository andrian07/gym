<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, OPTIONS");

class Register extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model('register_model');
		$this->load->model('masterdata_model');
		$this->load->model('global_model');
		$this->load->helper(array('url', 'html'));
		date_default_timezone_set('Asia/Jakarta');
	}

	public function index(){
		if(isset($_SESSION['user_name']) != null){
			redirect('Register/registerclass', 'refresh');
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

	// registerclass //

	public function registerclass()
	{
		$modul = 'Register';
		$check_auth = $this->check_auth($modul);
		if($check_auth[0]->view == 'Y'){
			$class_list['class_list'] = $this->global_model->class_list();
			$coach_list['coach_list'] = $this->global_model->coach_list();
			$pt_list['pt_list'] = $this->global_model->pt_list();
			$check_auth['check_auth'] = $check_auth;
			$data['data'] = array_merge($check_auth, $coach_list, $class_list, $pt_list);
			$this->load->view('Pages/Register/register', $data);
		}else{
			$msg = "No Access";
			echo json_encode(['code'=>0, 'result'=>$msg]);
		}	
	}

	public function addregister()
	{
		$modul = 'Register';
		$check_auth = $this->check_auth($modul);
		if($check_auth[0]->add == 'Y'){
			$class_list['class_list'] = $this->global_model->class_list();
			$coach_list['coach_list'] = $this->global_model->coach_list();
			$promo_list['promo_list'] = $this->global_model->promo_list();
			$pt_list['pt_list'] = $this->global_model->pt_list();
			$check_auth['check_auth'] = $check_auth;
			$data['data'] = array_merge($check_auth, $coach_list, $class_list, $promo_list, $pt_list);
			$this->load->view('Pages/Register/addregister', $data);
		}else{
			$msg = "No Access";
			echo json_encode(['code'=>0, 'result'=>$msg]);
		}
	}

	public function addregisterpayment()
	{
		$modul = 'Register';
		$check_auth = $this->check_auth($modul);
		if($check_auth[0]->add == 'Y'){
			$class_list['class_list'] = $this->global_model->class_list();
			$coach_list['coach_list'] = $this->global_model->coach_list();
			$promo_list['promo_list'] = $this->global_model->promo_list();
			$pt_list['pt_list'] = $this->global_model->pt_list();
			$pt_package['pt_package'] = $this->global_model->pt_package();
			$check_auth['check_auth'] = $check_auth;
			$data['data'] = array_merge($check_auth, $coach_list, $class_list, $promo_list, $pt_list, $pt_package);
			$this->load->view('Pages/Register/registerpayment', $data);
		}else{
			$msg = "No Access";
			echo json_encode(['code'=>0, 'result'=>$msg]);
		}
	}

	public function register_list()
	{
		$modul = 'Register';
		$check_auth = $this->check_auth($modul);
		if($check_auth[0]->view == 'Y'){
			$search 			= $this->input->post('search');
			$length 			= $this->input->post('length');
			$start 			  	= $this->input->post('start');

			if($search != null){
				$search = $search['value'];
			}
			$list = $this->register_model->register_list($search, $length, $start)->result_array();
			$count_list = $this->register_model->register_list_count($search)->result_array();
			$total_row = $count_list[0]['total_row'];
			$data = array();
			$no = $_POST['start'];
			foreach ($list as $field) {

				$detail = '<a href="'.base_url().'Register/detailtransaction?id='.$field['transaction_register_id'].'" data-fancybox="" data-type="iframe"><button type="button" class="btn btn-icon btn-primary btn-sm mb-2-btn" data-id="'.$field['transaction_register_id'].'"><i class="fas fa-eye sizing-fa"></i></button></a> ';

				if($check_auth[0]->edit == 'Y'){
					$edit = '<button type="button" class="btn btn-icon btn-warning btn-sm mb-2-btn" data-bs-toggle="modal" data-bs-target="#exampleModaledit" data-id="'.$field['transaction_register_id'].'" data-name="'.$field['transaction_register_inv'].'"><i class="fas fa-edit sizing-fa"></i></button> ';
				}else{
					$edit = '<button type="button" class="btn btn-icon btn-warning btn-sm mb-2-btn" disabled="disabled"><i class="fas fa-edit sizing-fa"></i></button> <button type="button" class="btn btn-icon btn-info btn-sm mb-2-btn" disabled="disabled"><i class="fas fa-cog sizing-fa"></i></button> ';
				}

				$print = '<a href="'.base_url().'Register/print_nota?id='.$field['transaction_register_id'].'"><button type="button" class="btn btn-icon btn-info btn-sm mb-2-btn" data-id="'.$field['transaction_register_id'].'" title="Print"><i class="fas fa-copy sizing-fa"></i></button></a> ';


				if($field['transaction_register_status'] == 'Success'){
					$status = '<span class="badge badge-success">Success</span>';
				}else{
					$status = '<span class="badge badge-danger">Cancel</span>';
				}

				$date = date_create($field['transaction_register_date']); 

				//$url_image = base_url().'assets/products/'.$field['product_image'];
				$no++;
				$row = array();
				$row[] = $field['transaction_register_inv'];
				$row[] = $field['member_name'];
				$row[] = date_format($date,"d-m-Y");
				$row[] = 'Rp. '.number_format($field['transaction_register_discount']);
				$row[] = 'Rp. '.number_format($field['transaction_register_total']);
				$row[] = $status;
				$row[] = $detail.$edit.$print;
				$data[] = $row;
			}

			$output = array(
				"draw" => $_POST['draw'],
				"recordsTotal" => $total_row,
				"recordsFiltered" => $total_row,
				"data" => $data,
			);
			echo json_encode($output);
		}else{
			$msg = "No Access";
			echo json_encode(['code'=>0, 'result'=>$msg]);die();
		}
	}

	public function save_register()
	{
		$modul = 'Register';
		$check_auth = $this->check_auth($modul);
		if($check_auth[0]->add == 'Y'){
			//$member_code 				= $this->input->post('member_code');
			$member_name 				= $this->input->post('member_name');
			$member_phone 				= $this->input->post('member_phone');
			$member_nik 				= $this->input->post('member_nik');
			$member_dob 				= $this->input->post('member_dob');
			$member_email				= $this->input->post('member_email');
			$member_address	 			= $this->input->post('member_address');
			$member_gender 				= $this->input->post('member_gender');
			$member_urgent_phone 		= $this->input->post('member_urgent_phone');
			$member_nik	 				= $this->input->post('member_nik');
			$member_urgent_name 		= $this->input->post('member_urgent_name');
			$member_urgent_sibiling 	= $this->input->post('member_urgent_sibiling');
			$member_desc 				= $this->input->post('member_desc');
			$parq_q1 					= $this->input->post('parq_q1');
			$parq_q2 					= $this->input->post('parq_q2');
			$parq_q3 					= $this->input->post('parq_q3');
			$parq_q4 					= $this->input->post('parq_q4');
			$parq_q5					= $this->input->post('parq_q5');
			$parq_q6	 				= $this->input->post('parq_q6');
			/*$crfe_w_1 					= $this->input->post('crfe_w_1');
			$crfe_w_2 					= $this->input->post('crfe_w_2');
			$crfe_w_3	 				= $this->input->post('crfe_w_3');
			$crfe_w_3_desc 				= $this->input->post('crfe_w_3_desc');
			$crfe_w_4 					= $this->input->post('crfe_w_4');
			$crfe_w_5 					= $this->input->post('crfe_w_5');
			$crfe_r_1 					= $this->input->post('crfe_r_1');
			$crfe_r_1_desc 				= $this->input->post('crfe_r_1_desc');
			$crfe_r_2 					= $this->input->post('crfe_r_2');
			$crfe_r_2_desc				= $this->input->post('crfe_r_2_desc');
			$crfe_m_1	 				= $this->input->post('crfe_m_1');
			$crfe_w_1 					= $this->input->post('crfe_w_1');
			$crfe_m_1_desc 				= $this->input->post('crfe_m_1_desc');
			$crfe_m_2	 				= $this->input->post('crfe_m_2');
			$crfe_m_2_desc 				= $this->input->post('crfe_m_2_desc');
			$crfe_m_3 					= $this->input->post('crfe_m_3');
			$crfe_m_3_desc 				= $this->input->post('crfe_m_3_desc');
			$crfe_m_4 					= $this->input->post('crfe_m_4');
			$crfe_m_4_desc	 			= $this->input->post('crfe_m_4_desc');*/
			$user_id 		   			= $_SESSION['user_id'];

			$check_member_nik = $this->masterdata_model->check_member_nik($member_nik);
			if($member_nik == null){
				$msg = "Nik Harus Di Isi";
				echo json_encode(['code'=>0, 'result'=>$msg]);die();
			}
			if($check_member_nik != null){
				$msg = "Nik Sudah Di Gunakan";
				echo json_encode(['code'=>0, 'result'=>$msg]);die();
			}

			$check_member_phone = $this->masterdata_model->check_member_phone($member_phone);
			if($member_phone == null){
				$msg = "No HP Harus Di Isi";
				echo json_encode(['code'=>0, 'result'=>$msg]);die();
			}
			if($check_member_phone != null){
				$msg = "No Hp Sudah Di Gunakan";
				echo json_encode(['code'=>0, 'result'=>$msg]);die();
			}


			$check_member_email = $this->masterdata_model->check_member_email($member_email);
			if($member_email == null){
				$msg = "Email Harus Di Isi";
				echo json_encode(['code'=>0, 'result'=>$msg]);die();
			}
			if($check_member_email != null){
				$msg = "Email Sudah Di Gunakan";
				echo json_encode(['code'=>0, 'result'=>$msg]);die();
			}

			if($member_name == null){
				$msg = "Nama member Harus Di isi";
				echo json_encode(['code'=>0, 'result'=>$msg]);die();
			}

			if($member_phone == null){
				$msg = "No Hp Harus Di isi";
				echo json_encode(['code'=>0, 'result'=>$msg]);die();
			}

			if($parq_q1 == null || $parq_q2 == null || $parq_q3 == null || $parq_q4 == null || $parq_q5 == null || $parq_q6 == null){
				$msg = "Silahkan Lengkapi Kuisioner Terlebih Dahulu";
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
				'member_dob'	       		=> $member_dob,
				'member_gender'	    		=> $member_gender,
				'member_nik'				=> $member_nik,
				'member_email'	    		=> $member_email,
				'member_urgent_name'		=> $member_urgent_name,
				'member_urgent_phone'		=> $member_urgent_phone,
				'member_urgent_sibiling'	=> $member_urgent_sibiling,
				'member_desc'				=> $member_desc
			);

			$save_member = $this->masterdata_model->save_member($data_insert);

			$data_insert_kuisioner = array(
				'member_id'				=> $save_member,
				'parq_q1'	       		=> $parq_q1,
				'parq_q2'	       		=> $parq_q2,
				'parq_q3'	   			=> $parq_q3,
				'parq_q4'	    		=> $parq_q4,
				'parq_q5'	       		=> $parq_q5,
				'parq_q6'	    		=> $parq_q6,
				/*'crfe_w_1'				=> $crfe_w_1,
				'crfe_w_2'	    		=> $crfe_w_2,
				'crfe_w_3'				=> $crfe_w_3,
				'crfe_w_3_desc'			=> $crfe_w_3_desc,
				'crfe_w_4'				=> $crfe_w_4,
				'crfe_w_5'				=> $crfe_w_5,
				'crfe_r_1'				=> $crfe_r_1,
				'crfe_r_1_desc'	    	=> $crfe_r_1_desc,
				'crfe_r_2'				=> $crfe_r_2,
				'crfe_r_2_desc'			=> $crfe_r_2_desc,
				'crfe_m_1'				=> $crfe_m_1,
				'crfe_m_1_desc'			=> $crfe_m_1_desc,
				'crfe_m_2'				=> $crfe_m_2,
				'crfe_m_2_desc'	    	=> $crfe_m_2_desc,
				'crfe_m_3'				=> $crfe_m_3,
				'crfe_m_3_desc'			=> $crfe_m_3_desc,
				'crfe_m_4'				=> $crfe_m_4,
				'crfe_m_4_desc'			=> $crfe_m_4_desc*/
			);

			$this->register_model->save_member_kuisioner($data_insert_kuisioner);

			$data_insert_act = array(
				'activity_table_desc'	       => 'Tambah Pendaftaran Member Baru',
				'activity_table_user'	       => $user_id,
			);
			$this->global_model->save($data_insert_act);
			$msg = "Succes Input";
			echo json_encode(['code'=>200, 'result'=>$msg, 'member'=>$save_member]);
			die();
		}else{
			$msg = "No Access";
			echo json_encode(['code'=>0, 'result'=>$msg]);
		}	
	}

	public function select_class()
	{
		$class_package = $this->input->post('class_package');
		$select_class_package = $this->global_model->select_class($class_package);
		echo json_encode(['code'=>200, 'result'=>$select_class_package]);
		die();
	}

	public function select_promo()
	{
		$promo_id = $this->input->post('promo_id');
		$select_promo = $this->global_model->select_promo($promo_id);
		echo json_encode(['code'=>200, 'result'=>$select_promo]);
		die();
	}

	public function cal_date()
	{	
		$class_session_val = $this->input->post('class_session_val');
		$class_session_unit = $this->input->post('class_session_unit');
		if($class_session_unit == 'Tahun'){
			$Date = "2026-01-01";
			$end_date = date('Y-m-d', strtotime($Date. ' + '.$class_session_val.' year'));
		}else if($class_session_unit == 'Bulan'){
			$Date = "2026-01-01";
			$end_date = date('Y-m-d', strtotime($Date. ' + '.$class_session_val.' month'));
		}else{
			$Date = "2026-01-01";
			$end_date = date('Y-m-d', strtotime($Date. ' + '.$class_session_val.' day'));
		}
		echo json_encode(['code'=>200, 'result'=>$end_date]);
		die();
	}
	
	public function save_transaction()
	{
		$modul = 'Register';
		$check_auth = $this->check_auth($modul);
		if($check_auth[0]->add == 'Y'){
			$member_id 				= $this->input->post('member_id');
			$class_package 			= $this->input->post('class_package');
			$class_price_val 		= $this->input->post('class_price_val');
			$class_session_val 		= $this->input->post('class_session_val');
			$class_session_unit 	= $this->input->post('class_session_unit');
			$class_total_val        = $this->input->post('class_total_val');
			$PT						= $this->input->post('PT');
			$class_sessions_start 	= $this->input->post('class_sessions_start');
			$class_sessions_end 	= $this->input->post('class_sessions_end');
			$class_package_promo	= $this->input->post('class_package_promo');
			$discount_val 			= $this->input->post('discount_val');
			$total_val 				= $this->input->post('total_val');
			$user_id 		   		= $_SESSION['user_id'];

			if($total_val == 0){
				$msg = "Transaksi Harus Di Isi Terlebih Dahulu";
				echo json_encode(['code'=>0, 'result'=>$msg]);die();
			}

			$maxCode  = $this->register_model->last_register();
			$inv_code = 'TRX/'.date("d/m/Y").'/';
			if ($maxCode == NULL) {
				$last_code = $inv_code.'000001';
			} else {
				$maxCode   = $maxCode[0]->transaction_register_inv;
				$last_code = substr($maxCode, -6);
				$last_code = $inv_code.substr('000000' . strval(floatval($last_code) + 1), -6);
			}

			$data_insert = array(
				'transaction_register_inv'	    => $last_code,
				'member_id'	       				=> $member_id,
				'transaction_register_discount'	=> $discount_val,
				'transaction_register_total'	=> $total_val,
				'transaction_user_id'			=> $user_id
			);

			$save_register = $this->register_model->save_register($data_insert);

			$data_insert_detail = array(
				'transaction_register_id'			=> $save_register,
				'class_id'	       					=> $class_package,
				'class_price'	       				=> $class_price_val,
				'transaction_register_session'	   	=> $class_session_val,
				'transaction_register_session_unit'	=> $class_session_unit,
				'transaction_register_subtotal'	    => $class_total_val,
				'transaction_register_coach_id'	   	=> $PT,
				'transaction_register_start_date'	=> $class_sessions_start,
				'transaction_register_end_date'	    => $class_sessions_end,
				'transaction_register_promo_id'		=> $class_package_promo
			);

			$this->register_model->save_register_detail($data_insert_detail);

			$data_insert_act = array(
				'activity_table_desc'	       => 'Tambah Pendaftaran Member Baru',
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

	public function print_nota()
	{
		$transaction_register_id  = $this->input->get('id');
		$get_register['get_register'] = $this->register_model->get_register($transaction_register_id);
		$get_detail_register['get_detail_register'] = $this->register_model->get_detail_register($transaction_register_id);
		$data['data'] = array_merge($get_register, $get_detail_register);
		$this->load->view('Pages/Register/print', $data);
	}

	public function get_promo_info()
	{
		$promo_id = $this->input->post('id');
		$get_promo_info['get_promo_info'] = $this->register_model->get_promo_info($promo_id)->result_array();
		echo json_encode(['code'=>200, 'result'=>$get_promo_info]);
	}

	public function get_member_info()
	{
		$member_id = $this->input->post('id');
		$get_member_info['get_member_info'] = $this->register_model->get_member_info($member_id)->result_array();
		echo json_encode(['code'=>200, 'result'=>$get_member_info]);
	}

	public function get_class_info()
	{
		$class_id = $this->input->post('id');
		$get_class_info['get_class_info'] = $this->register_model->get_class_info($class_id)->result_array();
		echo json_encode(['code'=>200, 'result'=>$get_class_info]);
	}

	public function get_pt_info()
	{
		$pt_id = $this->input->post('id');
		$get_pt_info['get_pt_info'] = $this->register_model->get_pt_info($pt_id)->result_array();
		echo json_encode(['code'=>200, 'result'=>$get_pt_info]);
	}

	public function get_pt_info_month()
	{
		$package_sesion = $this->input->post('id');
		$get_pt_info_month['get_pt_info_month'] = $this->register_model->get_pt_info_month($package_sesion)->result_array();
		echo json_encode(['code'=>200, 'result'=>$get_pt_info_month]);
	}
	// end register //

}	

?>