	<?php

	defined('BASEPATH') OR exit('No direct script access allowed');
	header('Access-Control-Allow-Origin: *');
	header("Access-Control-Allow-Methods: GET, OPTIONS");

	class Setting extends CI_Controller {

		public function __construct(){
			parent::__construct();
			$this->load->helper('url');
			$this->load->library('session');
			$this->load->model('masterdata_model');
			$this->load->model('global_model');
			$this->load->model('setting_model');
			$this->load->helper(array('url', 'html'));
		}

		public function index(){
			if(isset($_SESSION['user_name']) != null){
				redirect('Dashboard/Admin', 'refresh');
			}else{
				$this->load->view('Pages/login');
			}
		}


		private function check_auth($modul){
			if(isset($_SESSION['user_name']) == null){
				redirect('Setting', 'refresh');
			}else{
				$user_role_id = $_SESSION['user_role_id'];
				$check_access = $this->global_model->check_access($user_role_id, $modul);
				return($check_access);
			}
		}

		public function role(){
			$this->check_auth();
			$group_role['group_role'] = $this->masterdata_model->group_role();
			$this->load->view('Pages/Setting/group', $group_role);
		}

		public function get_setting_permission()
		{
			$this->check_auth();
			$id = $this->input->post('id');
			$get_setting_permission = $this->masterdata_model->get_setting_permission($id);
			echo json_encode($get_setting_permission);
		}

		public function save_role(){
			$role_name = $this->input->post('role_name');
			$user_id   = $_SESSION['user_id'];

			if($role_name == null){
				$msg = "Nama Group Harus Di isi";
				echo json_encode(['code'=>0, 'result'=>$msg]);die();
			}

			$check_role = $this->masterdata_model->check_role($role_name);
			if($check_role != null){
				$msg = "Nama Group Sudah Ada";
				echo json_encode(['code'=>0, 'result'=>$msg]);die();
			}


			$insert = array(
				'role_name'	       => $role_name
			);
			$this->masterdata_model->save_role($insert);
			$role_id = $this->db->insert_id();

			$data_insert_permision = array(
				'role_id'	       => $role_id
			);
			$this->masterdata_model->save_permision($data_insert_permision);

			$data_insert_act = array(
				'activity_table_desc'	       => 'Tambah Group Baru '. $role_name,
				'activity_table_user'	       => $user_id,
			);
			$this->global_model->save($data_insert_act);
			$msg = "Succes Input";
			echo json_encode(['code'=>200, 'result'=>$msg]);
			die();
		}

		public function edit_role()
		{
			$role_id   	       = $this->input->post('role_id');
			$role_name   	   = $this->input->post('role_name_edit');
			$user_id   		   = $_SESSION['user_id'];

			if($role_name == null){
				$msg = "Nama Group Harus Di isi";
				echo json_encode(['code'=>0, 'result'=>$msg]);die();
			}

			$update = array(
				'role_name'	       => $role_name
			);

			$this->masterdata_model->update_role($update, $role_id);

			$data_insert_act = array(
				'activity_table_desc'	       => 'Update Group Menjadi '. $role_name,
				'activity_table_user'	       => $user_id,
			);
			$this->global_model->save($data_insert_act);

			$msg = "Succes Update";
			echo json_encode(['code'=>200, 'result'=>$msg]);
			die();
		}


		public function delete_role()
		{
			$role_id  	= $this->input->post('id');
			$role_name  = $this->input->post('role_name');
			$user_id   	= $_SESSION['user_id'];

			$this->masterdata_model->delete_role($role_id);
			$msg = "Succes Delete";


			$data_insert_act = array(
				'activity_table_desc'	       => 'Delete Group '. $role_name,
				'activity_table_user'	       => $user_id,
			);
			$this->global_model->save($data_insert_act);

			echo json_encode(['code'=>200, 'result'=>$msg]);
			die();
		}

		// start paymennt

		public function payment()
		{
			$modul = 'Settingpayment';
			$check_auth = $this->check_auth($modul);
			if($check_auth[0]->view == 'Y'){
				$payment_list['payment_list'] = $this->global_model->payment_list();
				$check_auth['check_auth'] = $check_auth;
				$data['data'] = array_merge($check_auth, $payment_list);
				$this->load->view('Pages/Setting/payment', $data);
			}else{
				$msg = "No Access";
				echo json_encode(['code'=>0, 'result'=>$msg]);
			}	
		}

		public function payment_list()
		{
			$modul = 'Settingpayment';
			$check_auth = $this->check_auth($modul);
			if($check_auth[0]->view == 'Y'){
				$search 			= $this->input->post('search');
				$length 			= $this->input->post('length');
				$start 			  	= $this->input->post('start');

				if($search != null){
					$search = $search['value'];
				}
				$list = $this->setting_model->payment_list($search, $length, $start)->result_array();
				$count_list = $this->setting_model->payment_list_count($search)->result_array();
				$total_row = $count_list[0]['total_row'];
				$data = array();
				$no = $_POST['start'];
				foreach ($list as $field) {

					if($check_auth[0]->edit == 'Y'){
						$edit = '<button type="button" class="btn btn-icon btn-warning btn-sm mb-2-btn" data-bs-toggle="modal" data-bs-target="#exampleModaledit" data-id="'.$field['payment_id'].'" data-name="'.$field['payment_name'].'" data-rek="'.$field['payment_rekening'].'"><i class="fas fa-edit sizing-fa"></i></button> ';
					}else{
						$edit = '<button type="button" class="btn btn-icon btn-warning btn-sm mb-2-btn" disabled="disabled"><i class="fas fa-edit sizing-fa"></i></button> <button type="button" class="btn btn-icon btn-info btn-sm mb-2-btn" disabled="disabled"><i class="fas fa-cog sizing-fa"></i></button> ';
					}
					if($check_auth[0]->delete == 'Y'){
						$delete = '<button type="button" class="btn btn-icon btn-danger btn-sm mb-2-btn delete" data-id="'.$field['payment_id'].'" data-name="'.$field['payment_id'].'" onclick="delete_payment('.$field['payment_id'].')"><i class="fas fa-trash-alt sizing-fa"></i></button> ';
					}else{
						$delete = '<button type="button" class="btn btn-icon btn-danger btn-sm mb-2-btn delete" data-id="'.$field['payment_id'].'" data-name="'.$field['payment_id'].'" disabled="disabled"><i class="fas fa-trash-alt sizing-fa"></i></button> ';
					}

					$no++;
					$row = array();
					$row[] = $field['payment_name'];
					$row[] = $field['payment_rekening'];
					$row[] = $edit.$delete;
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

		public function save_payment()
		{
			$modul = 'Settingpayment';
			$check_auth = $this->check_auth($modul);
			if($check_auth[0]->add == 'Y'){
				$payment_name 				= $this->input->post('payment_name');
				$payment_rekening 			= $this->input->post('payment_rekening');
				$user_id 		   			= $_SESSION['user_id'];

				if($payment_name == null){
					$msg = "Nama Pembayaran Harus Di Isi";
					echo json_encode(['code'=>0, 'result'=>$msg]);die();
				}

				$data_insert = array(
					'payment_name'	       		=> $payment_name,
					'payment_rekening'	       	=> $payment_rekening
				);

				$this->setting_model->save_payment($data_insert);

				$data_insert_act = array(
					'activity_table_desc'	       => 'Tambah Master Pembayaran '.$payment_name ,
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

		public function edit_payment()
		{
			$modul = 'Settingpayment';
			$check_auth = $this->check_auth($modul);
			if($check_auth[0]->edit == 'Y'){
				$payment_id 				= $this->input->post('payment_id');
				$payment_name 				= $this->input->post('payment_name');
				$payment_rekening 			= $this->input->post('payment_rekening');
				$user_id 		   			= $_SESSION['user_id'];

				if($payment_name == null){
					$msg = "Nama Pembayaran Harus Di Isi";
					echo json_encode(['code'=>0, 'result'=>$msg]);die();
				}

				$data_edit = array(
					'payment_name'	       		=> $payment_name,
					'payment_rekening'	       	=> $payment_rekening
				);

				$this->setting_model->edit_payment($data_edit, $payment_id);

				$data_insert_act = array(
					'activity_table_desc'	       => 'Ubah Master Pembayaran '.$payment_name,
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

		public function delete_payment()
		{
			$modul = 'Settingpayment';
			$check_auth = $this->check_auth($modul);
			if($check_auth[0]->delete == 'Y'){
				$payment_id 				= $this->input->post('id');
				$user_id 		   			= $_SESSION['user_id'];

				$this->setting_model->delete_payment($payment_id);

				$data_insert_act = array(
					'activity_table_desc'	       => 'Hapus Master Pembayaran',
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
		// end payment


		// start Personal Training Price


		public function personaltrainingprice()
		{
			$modul = 'Personaltrainingprice';
			$check_auth = $this->check_auth($modul);
			if($check_auth[0]->view == 'Y'){
				$payment_list['payment_list'] = $this->global_model->payment_list();
				$check_auth['check_auth'] = $check_auth;
				$data['data'] = array_merge($check_auth, $payment_list);
				$this->load->view('Pages/Setting/personaltrainingprice', $data);
			}else{
				$msg = "No Access";
				echo json_encode(['code'=>0, 'result'=>$msg]);
			}	
		}

		public function personaltrainingprice_list()
		{
			$modul = 'Personaltrainingprice';
			$check_auth = $this->check_auth($modul);
			if($check_auth[0]->view == 'Y'){
				$search 			= $this->input->post('search');
				$length 			= $this->input->post('length');
				$start 			  	= $this->input->post('start');

				if($search != null){
					$search = $search['value'];
				}
				$list = $this->setting_model->personaltrainingprice_list($search, $length, $start)->result_array();
				$count_list = $this->setting_model->personaltrainingprice_list_count($search)->result_array();
				$total_row = $count_list[0]['total_row'];
				$data = array();
				$no = $_POST['start'];
				foreach ($list as $field) {

					if($check_auth[0]->edit == 'Y'){
						$edit = '<button type="button" class="btn btn-icon btn-warning btn-sm mb-2-btn" data-bs-toggle="modal" data-bs-target="#exampleModaledit" data-id="'.$field['ms_pt_price_id'].'" data-name="'.$field['ms_pt_price_name'].'" data-price="'.$field['ms_pt_price_price'].'"><i class="fas fa-edit sizing-fa"></i></button> ';
					}else{
						$edit = '<button type="button" class="btn btn-icon btn-warning btn-sm mb-2-btn" disabled="disabled"><i class="fas fa-edit sizing-fa"></i></button> <button type="button" class="btn btn-icon btn-info btn-sm mb-2-btn" disabled="disabled"><i class="fas fa-cog sizing-fa"></i></button> ';
					}
					if($check_auth[0]->delete == 'Y'){
						$delete = '<button type="button" class="btn btn-icon btn-danger btn-sm mb-2-btn delete" data-id="'.$field['ms_pt_price_id'].'" data-name="'.$field['ms_pt_price_id'].'" onclick="delete_personaltrainingprice('.$field['ms_pt_price_id'].')"><i class="fas fa-trash-alt sizing-fa"></i></button> ';
					}else{
						$delete = '<button type="button" class="btn btn-icon btn-danger btn-sm mb-2-btn delete" data-id="'.$field['ms_pt_price_id'].'" data-name="'.$field['ms_pt_price_id'].'" disabled="disabled"><i class="fas fa-trash-alt sizing-fa"></i></button> ';
					}

					$no++;
					$row = array();
					$row[] = $field['ms_pt_price_name'];
					$row[] = 'Rp. '.number_format($field['ms_pt_price_price']);
					$row[] = $edit.$delete;
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

		public function session_list()
		{
			$modul = 'Personaltrainingprice';
			$check_auth = $this->check_auth($modul);
			if($check_auth[0]->view == 'Y'){
				$search 			= $this->input->post('search');
				$length 			= $this->input->post('length');
				$start 			  	= $this->input->post('start');

				if($search != null){
					$search = $search['value'];
				}
				$list = $this->setting_model->ptsession_list($search, $length, $start)->result_array();
				$count_list = $this->setting_model->ptsession_list_count($search)->result_array();
				$total_row = $count_list[0]['total_row'];
				$data = array();
				$no = $_POST['start'];
				foreach ($list as $field) {

					if($check_auth[0]->edit == 'Y'){
						$edit = '<button type="button" class="btn btn-icon btn-warning btn-sm mb-2-btn" onclick="edit_sesion('.$field['ms_pt_package_id'].', '.$field['ms_pt_package_session'].', '.$field['ms_pt_package_month'].')"><i class="fas fa-edit sizing-fa"></i></button> ';
					}else{
						$edit = '<button type="button" class="btn btn-icon btn-warning btn-sm mb-2-btn" onclick="edit_sesion('.$field['ms_pt_package_id'].', '.$field['ms_pt_package_session'].', '.$field['ms_pt_package_month'].')"><i class="fas fa-edit sizing-fa" disabled="disabled"></i></button>';
					}
					if($check_auth[0]->delete == 'Y'){
						$delete = '<button type="button" class="btn btn-icon btn-danger btn-sm mb-2-btn delete" data-id="'.$field['ms_pt_package_id'].'" data-name="'.$field['ms_pt_package_id'].'" onclick="delete_personaltrainingprice('.$field['ms_pt_package_id'].')"><i class="fas fa-trash-alt sizing-fa"></i></button> ';
					}else{
						$delete = '<button type="button" class="btn btn-icon btn-danger btn-sm mb-2-btn delete" data-id="'.$field['ms_pt_package_id'].'" data-name="'.$field['ms_pt_package_id'].'" disabled="disabled"><i class="fas fa-trash-alt sizing-fa"></i></button> ';
					}

					$no++;
					$row = array();
					$row[] = $field['ms_pt_package_session'].' Sesi';
					$row[] = $field['ms_pt_package_month'].' Bulan';
					$row[] = $edit.$delete;
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

		public function save_personaltrainingprice()
		{
			$modul = 'Settingpayment';
			$check_auth = $this->check_auth($modul);
			if($check_auth[0]->add == 'Y'){
				$pt_price_name 		= $this->input->post('pt_price_name');
				$pt_price 			= $this->input->post('pt_price');
				$user_id 		   	= $_SESSION['user_id'];

				if($pt_price_name == null){
					$msg = "Nama LVL PT Harus Di Isi";
					echo json_encode(['code'=>0, 'result'=>$msg]);die();
				}

				$data_insert = array(
					'ms_pt_price_name'	       	=> $pt_price_name,
					'ms_pt_price_price'	       	=> $pt_price
				);

				$this->setting_model->save_personaltrainingprice($data_insert);

				$data_insert_act = array(
					'activity_table_desc'	       => 'Tambah Master Jenis Harga PT '.$pt_price_name ,
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

		public function save_session()
		{
			$modul = 'Settingpayment';
			$check_auth = $this->check_auth($modul);
			if($check_auth[0]->add == 'Y'){
				$pt_package_id  		= $this->input->post('pt_package_id');
				$pt_session 			= $this->input->post('pt_session');
				$pt_session_month		= $this->input->post('pt_session_month');
				$user_id 		   		= $_SESSION['user_id'];
				$data_insert = array(
					'ms_pt_package_session'	       	=> $pt_session,
					'ms_pt_package_month'	       	=> $pt_session_month
				);
				if($pt_package_id == null){
					$this->setting_model->save_session($data_insert);
				}else{
					$this->setting_model->edit_session($data_insert, $pt_package_id);
				}
				$msg = "Sukses";
				echo json_encode(['code'=>200, 'result'=>$msg]);
				die();
			}else{
				$msg = "No Access";
				echo json_encode(['code'=>0, 'result'=>$msg]);
			}	
		}

		public function edit_personaltrainingprice()
		{
			$modul = 'Settingpayment';
			$check_auth = $this->check_auth($modul);
			if($check_auth[0]->edit == 'Y'){
				$pt_price_id 				= $this->input->post('pt_price_id');
				$pt_price_name 				= $this->input->post('pt_price_name');
				$pt_price_val 				= $this->input->post('pt_price_val');
				$user_id 		   			= $_SESSION['user_id'];

				if($pt_price_name == null){
					$msg = "Nama LVL PT Harus Di Isi";
					echo json_encode(['code'=>0, 'result'=>$msg]);die();
				}

				$data_edit = array(
					'ms_pt_price_name'	       	=> $pt_price_name,
					'ms_pt_price_price'	       	=> $pt_price_val
				);

				$this->setting_model->edit_personaltrainingprice($data_edit, $pt_price_id);

				$data_insert_act = array(
					'activity_table_desc'	       => 'Ubah Master Jenis Harga PT '.$pt_price_name,
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

		public function delete_personaltrainingprice()
		{
			$modul = 'Settingpayment';
			$check_auth = $this->check_auth($modul);
			if($check_auth[0]->delete == 'Y'){
				$ms_pt_price_id  			= $this->input->post('id');
				$user_id 		   			= $_SESSION['user_id'];

				$this->setting_model->delete_personaltrainingprice($ms_pt_price_id );

				$data_insert_act = array(
					'activity_table_desc'	       => 'Hapus Master Jenis Harga PT',
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
		// end payment




	}

?>