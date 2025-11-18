<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, OPTIONS");
require 'vendor/autoload.php';

use Dompdf\Dompdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Register extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model('register_model');
		$this->load->model('masterdata_model');
		$this->load->model('global_model');
		$this->load->model('transaction_model');
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
			redirect('Register', 'refresh');
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
			$payment_list['payment_list'] = $this->global_model->payment_list();
			$check_auth['check_auth'] = $check_auth;
			$data['data'] = array_merge($check_auth, $coach_list, $class_list, $pt_list, $payment_list);
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
			$member_list['member_list'] = $this->global_model->member_list();
			$check_auth['check_auth'] = $check_auth;
			$data['data'] = array_merge($check_auth, $coach_list, $class_list, $promo_list, $pt_list, $member_list);
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
			$gym_package['gym_package'] = $this->global_model->gym_package();
			$class_package['class_package'] = $this->global_model->class_package();
			$pt_package_price['pt_package_price'] = $this->global_model->pt_package_price();
			$payment_list['payment_list'] = $this->global_model->payment_list();
			$check_auth['check_auth'] = $check_auth;
			$data['data'] = array_merge($check_auth, $coach_list, $class_list, $promo_list, $pt_list, $pt_package, $gym_package, $class_package, $pt_package_price, $payment_list);
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

				$detail = '<a href="'.base_url().'Register/detailregister?id='.$field['transaction_register_id'].'" data-fancybox="" data-type="iframe"><button type="button" class="btn btn-icon btn-primary btn-sm mb-2-btn" data-id="'.$field['transaction_register_id'].'"><i class="fas fa-eye sizing-fa"></i></button></a> ';

				if($check_auth[0]->edit == 'Y'){
					$edit = '<button type="button" class="btn btn-icon btn-warning btn-sm mb-2-btn" data-bs-toggle="modal" data-bs-target="#exampleModaledit" data-id="'.$field['transaction_register_id'].'" data-name="'.$field['transaction_register_inv'].'"><i class="fas fa-edit sizing-fa"></i></button> ';
				}else{
					$edit = '<button type="button" class="btn btn-icon btn-warning btn-sm mb-2-btn" disabled="disabled"><i class="fas fa-edit sizing-fa"></i></button> <button type="button" class="btn btn-icon btn-info btn-sm mb-2-btn" disabled="disabled"><i class="fas fa-cog sizing-fa"></i></button> ';
				}

				if($field['transaction_payment_status'] == 'Lunas'){
					$print = '<a href="'.base_url().'Register/print_nota?id='.$field['transaction_register_id'].'"><button type="button" class="btn btn-icon btn-danger btn-sm mb-2-btn" data-id="'.$field['transaction_register_id'].'" title="Print"><i class="fas fa-file-pdf sizing-fa"></i></button></a> ';
				}else{
					$print = '<a href="'.base_url().'Register/print_nota?id='.$field['transaction_register_id'].'"><button type="button" class="btn btn-icon btn-danger btn-sm mb-2-btn" data-id="'.$field['transaction_register_id'].'" title="Print"><i class="fas fa-file-pdf sizing-fa" disabledzv0></i></button></a> ';
				}


				if($field['transaction_payment_status'] == 'Lunas'){
					$status = '<span class="badge badge-success">Lunas</span>';
				}else{
					$status = '<a href="" data-bs-toggle="modal" data-bs-target="#exampleModaledit" data-id="'.$field['transaction_register_id'].'" data-inv="'.$field['transaction_register_inv'].'" data-total="'.$field['transaction_payment_total'].'"><span class="badge badge-danger">Belum Lunas</span></a>';
				}

				$date = date_create($field['transaction_register_date']); 

				//$url_image = base_url().'assets/products/'.$field['product_image'];
				$no++;
				$row = array();
				$row[] = $field['transaction_register_inv'];
				$row[] = $field['member_name'];
				$row[] = date_format($date,"d-m-Y");
				$row[] = $field['transaction_type_member'];
				$row[] = 'Rp. '.number_format($field['transaction_payment_discount']);
				$row[] = 'Rp. '.number_format($field['transaction_payment_total']);
				$row[] = $status;
				$row[] = $field['transaction_type_member'];
				$row[] = $detail.$print;
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

	public function detailregister()
	{
		$modul = 'Register';
		$check_auth = $this->check_auth($modul);
		if($check_auth[0]->view == 'Y'){
			$id = $this->input->get('id');
			$get_transaction_by_id['get_transaction_by_id'] = $this->register_model->get_transaction_by_id($id)->result_array();
			$this->load->view('Pages/Register/detailregister', $get_transaction_by_id);
		}else{
			$msg = "No Access";
			echo json_encode(['code'=>0, 'result'=>$msg]);
		}
	}

	public function save_register()
	{
		$modul = 'Register';
		$check_auth = $this->check_auth($modul);
		if($check_auth[0]->add == 'Y'){

			$member_id                 = $this->input->post('member_id');
			$class_member_type         = $this->input->post('class_member_type');
			$all_promo_package         = $this->input->post('all_promo_package');

			$gym_sessions_start        = $this->input->post('gym_sessions_start');
			$gym_package               = $this->input->post('gym_package');
			$gym_sessions_end          = $this->input->post('gym_sessions_end');
			$gym_price_val             = $this->input->post('gym_price_val');
			$discount_gym_val          = $this->input->post('discount_gym_val');
			$gym_total_val             = $this->input->post('gym_total_val');

			$pt_package                = $this->input->post('pt_package');
			$pt_package_price          = $this->input->post('pt_package_price');
			$pt_id                     = $this->input->post('pt_id');
			$pt_price_val              = $this->input->post('pt_price_val');
			$pt_session_month          = $this->input->post('pt_session_month');
			$pt_discount_val           = $this->input->post('pt_discount_val');
			$pt_total_val              = $this->input->post('pt_total_val');

			$class_sessions_start      = $this->input->post('class_sessions_start');
			$class_package             = $this->input->post('class_package');
			$class_price_val           = $this->input->post('class_price_val');
			$class_session_unit        = $this->input->post('class_session_unit');
			$class_discount_val        = $this->input->post('class_discount_val');
			$class_total_val           = $this->input->post('class_total_val');

			$payment                   = $this->input->post('payment');
			$discount_val              = $this->input->post('discount_val');
			$total_val                 = $this->input->post('total_val');

			$crfe_w_1                  = $this->input->post('crfe_w_1');
			$crfe_w_2                  = $this->input->post('crfe_w_2');
			$crfe_w_3                  = $this->input->post('crfe_w_3');
			$crfe_w_3_desc             = $this->input->post('crfe_w_3_desc');
			$crfe_w_4                  = $this->input->post('crfe_w_4');
			$crfe_w_5                  = $this->input->post('crfe_w_5');
			$crfe_r_1                  = $this->input->post('crfe_r_1');
			$crfe_r_1_desc             = $this->input->post('crfe_r_1_desc');
			$crfe_r_2                  = $this->input->post('crfe_r_2');
			$crfe_r_2_desc             = $this->input->post('crfe_r_2_desc');
			$crfe_m_1                  = $this->input->post('crfe_m_1');
			$crfe_m_1_desc             = $this->input->post('crfe_m_1_desc');
			$crfe_m_2                  = $this->input->post('crfe_m_2');
			$crfe_m_2_desc             = $this->input->post('crfe_m_2_desc');
			$crfe_m_3                  = $this->input->post('crfe_m_3');
			$crfe_m_3_desc             = $this->input->post('crfe_m_3_desc');
			$crfe_m_4                  = $this->input->post('crfe_m_4');
			$crfe_m_4_desc             = $this->input->post('crfe_m_4_desc');

			$user_id 		   			= $_SESSION['user_id'];

			
			if($class_member_type == 'Extend PT' || $pt_package == 'Ya'){
				if($pt_id == null || $pt_id == 0){
					$msg = "Silahkan Isi Nama PT";
					echo json_encode(['code'=>0, 'result'=>$msg]);die();
				}
			}

			if($class_member_type == 'Kelas Only'){
				if($class_package == null){
					$msg = "Silahkan Isi Paket Kelas";
					echo json_encode(['code'=>0, 'result'=>$msg]);die();
				}
			}

			if($class_member_type == 'Member (GYM) + Kelas'){
				if($gym_package == null){
					$msg = "Silahkan Isi Paket Gym";
					echo json_encode(['code'=>0, 'result'=>$msg]);die();
				}
				if($class_package == null){
					$msg = "Silahkan Isi Paket Kelas";
					echo json_encode(['code'=>0, 'result'=>$msg]);die();
				}
			}

			if($class_member_type == 'Member'){
				if($gym_package == null){
					$msg = "Silahkan Isi Paket Kelas";
					echo json_encode(['code'=>0, 'result'=>$msg]);die();
				}
			}

			if($total_val == 0){
				$msg = "Silahkan Isi Traansaksi Terlebih Dahulu";
				echo json_encode(['code'=>0, 'result'=>$msg]);die();
			}

			if($class_member_type == 'Extend PT' || $pt_package == 'Ya'){

				if($crfe_w_1 == null || $crfe_w_2 == null || $crfe_w_3 == null || $crfe_w_4 == null || $crfe_w_5 == null || $crfe_r_1 == null || $crfe_r_2 == null || $crfe_m_1 == null || $crfe_m_2 == null || $crfe_m_3 == null || $crfe_m_4 == null){
					$msg = "Silahkan Lengkapi Data Quisioner! ";
					echo json_encode(['code'=>0, 'result'=>$msg]);die();
				}
			}

			$maxCode  = $this->register_model->last_register();
			$inv_code = 'TRX/'.date("d/m/Y").'/';
			if ($maxCode == NULL) {
				$last_code_trx = $inv_code.'000001';
			} else {
				$maxCode   = $maxCode[0]->transaction_register_inv;
				$last_code = substr($maxCode, -6);
				$last_code_trx = $inv_code.substr('000000' . strval(floatval($last_code) + 1), -6);
			}

			$data_insert_header = array(
				'transaction_register_inv'	    => $last_code_trx,
				'member_id'	   					=> $member_id,
				'transaction_type_member'	   	=> $class_member_type,
				'transaction_paket_promo'	    => $all_promo_package,
				'transaction_payment_id'		=> $payment,
				'transaction_payment_discount'	=> $discount_val,
				'transaction_payment_total'		=> $total_val,
				'transaction_user_id'           => $user_id,
			);

			if($class_member_type == 'Member' || $class_member_type == 'Member (GYM) + Kelas'){
				$data_insert_gym = array(
					'member_gym'						=> 'Y',
					'transaction_gym_periode_start'	   	=> $gym_sessions_start,
					'transaction_gym_month'	   			=> $gym_package,
					'transaction_gym_periode_end'	    => $gym_sessions_end,
					'transaction_gym_price'	    		=> $gym_price_val,
					'transaction_gym_discount'	   		=> $discount_gym_val,
					'transaction_gym_total_price'	   	=> $gym_total_val,
				);
			}else{
				$data_insert_gym = array(
					'member_gym'						=> 'N',
					'transaction_gym_periode_start'	   	=> '',
					'transaction_gym_month'	   			=> '',
					'transaction_gym_periode_end'	    => '',
					'transaction_gym_price'	    		=> '',
					'transaction_gym_discount'	   		=> '',
					'transaction_gym_total_price'	   	=> '',
				);
			}

			if($class_member_type == 'Extend PT' || $pt_package == 'Ya'){
				$data_insert_pt = array(
					'transaction_pt'	   			=> 'Y',
					'transaction_pt_id'	   			=> $pt_id,
					'transaction_pt_price'	    	=> $pt_price_val,
					'transaction_pt_session'	    => $pt_package_price,
					'transaction_pt_month'	   		=> $pt_session_month,
					'transaction_pt_discount'	   	=> $pt_discount_val,
					'transaction_pt_total_price'	=> $pt_total_val,
				);
			}else{
				$data_insert_pt = array(
					'transaction_pt'	   			=> 'N',
					'transaction_pt_id'	   			=> '',
					'transaction_pt_price'	    	=> '',
					'transaction_pt_session'	    => '',
					'transaction_pt_month'	   		=> '',
					'transaction_pt_discount'	   	=> '',
					'transaction_pt_total_price'	=> '',
				);
			}	

			if($class_member_type == 'Kelas Only' || $class_member_type == 'Member (GYM) + Kelas'){
				$data_insert_class = array(
					'transaction_class'					=> 'Y',
					'transaction_class_id'	   			=> '',
					'transaction_class_price'	   		=> $class_price_val,
					'transaction_class_month'	    	=> $class_package,
					'transaction_class_total_month'	    => $class_session_unit,
					'transaction_class_total_discount'	=> $class_discount_val,
					'transaction_class_total_price'	   	=> $class_total_val,
				);
			}else{
				$data_insert_class = array(
					'transaction_class'					=> 'N',
					'transaction_class_id'	   			=> '',
					'transaction_class_price'	   		=> '',
					'transaction_class_month'	    	=> '',
					'transaction_class_total_month'	    => '',
					'transaction_class_total_discount'	=> '',
					'transaction_class_total_price'	   	=> '',
				);
			}
			

			$data_insert_result =  array_merge($data_insert_header, $data_insert_gym, $data_insert_pt, $data_insert_class);
			
			$save_transaction = $this->register_model->save_register($data_insert_result);

			if($class_member_type == 'Extend PT' || $pt_package == 'Ya'){
				$data_insert_parq = array(
					'member_id'	   			=> $member_id,
					'crfe_w_1'	   			=> $crfe_w_1,
					'crfe_w_2'	    		=> $crfe_w_2,
					'crfe_w_3'	    		=> $crfe_w_3,
					'crfe_w_3_desc'	   		=> $crfe_w_3_desc,
					'crfe_w_4'	   			=> $crfe_w_4,
					'crfe_w_5'				=> $crfe_w_5,
					'crfe_r_1'				=> $crfe_r_1,
					'crfe_r_1_desc'			=> $crfe_r_1_desc,
					'crfe_r_2'				=> $crfe_r_2,
					'crfe_r_2_desc'			=> $crfe_r_2_desc,
					'crfe_m_1'				=> $crfe_m_1,
					'crfe_m_1_desc'			=> $crfe_m_1_desc,
					'crfe_m_2'				=> $crfe_m_2,
					'crfe_m_3'				=> $crfe_m_3,
					'crfe_m_3_desc'			=> $crfe_m_3_desc,
					'crfe_m_4'				=> $crfe_m_4,
					'crfe_m_4_desc'			=> $crfe_m_4_desc
				);
			}

			$this->register_model->save_parq($data_insert_parq);

			$data_insert_act = array(
				'activity_table_desc'	       => 'Tambah Pendaftaran Member Baru',
				'activity_table_user'	       => $user_id,
			);
			$this->global_model->save($data_insert_act);
			$msg = "Succes Input";
			if($member_id != null){
				$save_member = $member_id;
			}
			echo json_encode(['code'=>200, 'result'=>$msg, 'member'=>$save_member]);
			die();
		}else{
			$msg = "No Access";
			echo json_encode(['code'=>0, 'result'=>$msg]);
		}	
	}	

	public function savepayment()
	{
		$modul = 'Register';
		$check_auth = $this->check_auth($modul);
		if($check_auth[0]->add == 'Y'){
			$transaction_id 			= $this->input->post('transaction_id');
			$transaction_inv 			= $this->input->post('transaction_inv');
			$transaction_payment_total 	= $this->input->post('transaction_payment_total');
			$transaction_payment_type 	= $this->input->post('transaction_payment_type');
			$transaction_payment_desc	= $this->input->post('transaction_payment_desc');
			$user_id 		   			= $_SESSION['user_id'];
			$check_transaction_id = $this->register_model->check_transaction_id($transaction_id)->result_array();
			if($check_transaction_id != null){
				$data_insert = array(
					'transaction_ref_id'	      => $check_transaction_id[0]['transaction_register_id'],
					'transaction_ref_invoice'	  => $check_transaction_id[0]['transaction_register_inv'],
					'transaction_payment_total'	  => $check_transaction_id[0]['transaction_payment_total'],
					'transaction_payment_type'	  => $transaction_payment_type,
					'transaction_payment_desc'	  => $transaction_payment_desc,
					'transaction_payment_user'	  => $user_id,
				);

				$save_payment = $this->register_model->save_payment($data_insert);

				$this->register_model->update_transaction($transaction_id);

				$data_insert_act = array(
					'activity_table_desc'	       => 'Tambah Pembayran Invoice '.$transaction_inv,
					'activity_table_user'	       => $user_id,
				);
				$this->global_model->save($data_insert_act);
				$msg = "Succes Input";
				echo json_encode(['code'=>200, 'result'=>$msg]);
				die();
			}else{
				$msg = "Data Tidak Di Temukan";
				echo json_encode(['code'=>0, 'result'=>$msg]);
			}			
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
		$modul = 'Register';
		$check_auth = $this->check_auth($modul);
		if($check_auth[0]->add == 'Y'){
			$id  = $this->input->get('id');
			$get_transaction_by_id['get_transaction_by_id'] = $this->register_model->get_transaction_by_id($id)->result_array();
			$this->load->view('Pages/Register/print', $get_transaction_by_id);
		}else{
			$msg = "No Access";
			echo json_encode(['code'=>0, 'result'=>$msg]);
		}
	}

	public function print_pdf()
	{
		$modul = 'Register';
		$check_auth = $this->check_auth($modul);
		if($check_auth[0]->add == 'Y'){
			$id  = $this->input->get('id');
			$get_transaction_by_id['get_transaction_by_id'] = $this->register_model->get_transaction_by_id($id)->result_array();
			$htmlView   = $this->load->view('Pages/Register/printpdf', $get_transaction_by_id, true);
			$dompdf = new Dompdf();
			$options = $dompdf->getOptions();
			$options->set('isRemoteEnabled', true);
			$options->set('isHtml5ParserEnabled', true);
			$dompdf->setOptions($options);

			$context = stream_context_create([
				'ssl' => [
					'verify_peer' => false,
					'verify_peer_name' => false,
					'allow_self_signed' => true,
				]
			]);
			$dompdf->setHttpContext($context);

			$dompdf->setOptions($options);
			$dompdf->loadHtml($htmlView);
			$dompdf->setPaper('A4', 'potrait');
			$dompdf->render();
			
			$dompdf->stream('printpdf.pdf', array("Attachment" => false));
			
			exit();
		}else{
			$msg = "No Access";
			echo json_encode(['code'=>0, 'result'=>$msg]);
		}
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

	public function get_gym_package()
	{
		$id = $this->input->post('id');
		$get_gym_package['get_gym_package'] = $this->register_model->get_gym_package($id)->result_array();
		echo json_encode(['code'=>200, 'result'=>$get_gym_package]);
	}

	public function get_class_info()
	{
		$class_id = $this->input->post('id');
		$get_class_info['get_class_info'] = $this->register_model->get_class_info($class_id)->result_array();
		echo json_encode(['code'=>200, 'result'=>$get_class_info]);
	}

	public function get_package_class_info()
	{
		$ms_class_package_id = $this->input->post('id');
		$get_package_class_info['get_package_class_info'] = $this->register_model->get_package_class_info($ms_class_package_id)->result_array();
		echo json_encode(['code'=>200, 'result'=>$get_package_class_info]);
	}

	public function get_pt_info()
	{
		$pt_id = $this->input->post('id');
		
		$get_pt_info['get_pt_info'] = $this->register_model->get_pt_info_price($pt_id)->result_array();
		echo json_encode(['code'=>200, 'result'=>$get_pt_info]);
	}

	public function get_pt_info_month()
	{
		$package_sesion = $this->input->post('id');
		$get_pt_info_month['get_pt_info_month'] = $this->register_model->get_pt_info_month($package_sesion)->result_array();
		echo json_encode(['code'=>200, 'result'=>$get_pt_info_month]);
	}

	public function get_pt_package_price()
	{
		$pt_package_price_id = $this->input->post('id');
		$get_pt_package_price['get_pt_package_price'] = $this->register_model->get_pt_package_price($pt_package_price_id)->result_array();
		echo json_encode(['code'=>200, 'result'=>$get_pt_package_price]);
	}

	public function ptselect()
	{	
		$id = $this->input->get('id');
		if($id == null){
			$result = ['success' => FALSE, 'num_product' => 0, 'data' => 0, 'message' => 'Silahkan Isi Paket PT Terlebih Dahulu'];
			echo json_encode($result);
		}else{
			$keyword = $this->input->get('term');
			$result = ['success' => FALSE, 'num_product' => 0, 'data' => [], 'message' => ''];
			if (!($keyword == '' || $keyword == NULL)) {
				$find = $this->global_model->search_ptselect($keyword, $id)->result_array();
				$find_result = [];
				foreach ($find as $row) {
					$diplay_text = $row['coach_name'].' - '.$row['coach_code'];
					$find_result[] = [
						'id'                  	 => $row['coach_id'],
						'value'               	 => $diplay_text
					];
				}
				$result = ['success' => TRUE, 'num_product' => count($find_result), 'data' => $find_result, 'message' => ''];
			}
			echo json_encode($result);
		}
	} 

	// end register //


	// register daily //

	public function registerdaily()
	{
		$modul = 'Register';
		$check_auth = $this->check_auth($modul);
		if($check_auth[0]->view == 'Y'){
			$class_list['class_list'] = $this->global_model->class_list_schedule();
			$coach_list['coach_list'] = $this->global_model->coach_list();
			$pt_list['pt_list'] = $this->global_model->pt_list();
			$payment_list['payment_list'] = $this->global_model->payment_list();
			$check_auth['check_auth'] = $check_auth;
			$data['data'] = array_merge($check_auth, $coach_list, $class_list, $pt_list, $payment_list);
			$this->load->view('Pages/Register/registerdaily', $data);
		}else{
			$msg = "No Access";
			echo json_encode(['code'=>0, 'result'=>$msg]);
		}	
	}

	public function register_daily_list()
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

			$list = $this->register_model->register_daily_list($search, $length, $start)->result_array();
			$count_list = $this->register_model->register_daily_list_count($search)->result_array();
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


				if($field['transaction_payment_status'] == 'Lunas'){
					$status = '<span class="badge badge-success">Lunas</span>';
				}else{
					$status = '<span class="badge badge-danger">Belum Lunas</span>';
				}

				$date = date_create($field['transaction_register_date']); 

				//$url_image = base_url().'assets/products/'.$field['product_image'];
				$no++;
				$row = array();
				$row[] = $field['transaction_register_inv'];
				$row[] = $field['member_name'];
				$row[] = date_format($date,"d-m-Y");
				$row[] = $field['transaction_type_member'];
				$row[] = 'Rp. '.number_format($field['transaction_payment_discount']);
				$row[] = 'Rp. '.number_format($field['transaction_payment_total']);
				$row[] = $status;
				$row[] = $field['transaction_type_member'];
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
				'member_category'			=> 'Daily',
				'member_info_join'			=> $member_info_join,
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
				'transaction_register_date'		=> date('Y/m/d'),
				'member_id'	       				=> $insert_member,
				'transaction_type_member'	   	=> 'Kelas Only',
				'transaction_class'	    		=> 'Y',
				'transaction_class_id'			=> $get_class_id[0]->class_id,
				'transaction_type'				=> 'Daily'
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

	// end register daily //

}	

?>