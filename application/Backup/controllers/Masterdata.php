<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, OPTIONS");

class Masterdata extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model('masterdata_model');
		$this->load->model('global_model');
		$this->load->helper(array('url', 'html'));
		date_default_timezone_set('Asia/Jakarta');
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
			redirect('Masterdata', 'refresh');
		}else{
			$user_role_id = $_SESSION['user_role_id'];
			$check_access = $this->global_model->check_access($user_role_id, $modul);
			return($check_access);
		}
	}

	// member //

	public function member()
	{
		$modul = 'Member';
		$check_auth = $this->check_auth($modul);
		if($check_auth[0]->view == 'Y'){
			$coach_list['coach_list'] = $this->global_model->coach_list();
			$check_auth['check_auth'] = $check_auth;
			$data['data'] = array_merge($check_auth, $coach_list);
			$this->load->view('Pages/Masterdata/member', $data);
		}else{
			$msg = "No Access";
			echo json_encode(['code'=>0, 'result'=>$msg]);
		}	
	}

	public function member_list()
	{
		$modul = 'Member';
		$check_auth = $this->check_auth($modul);
		if($check_auth[0]->view == 'Y'){
			$search 			= $this->input->post('search');
			$length 			= $this->input->post('length');
			$start 			  	= $this->input->post('start');

			if($search != null){
				$search = $search['value'];
			}
			$list = $this->masterdata_model->member_list($search, $length, $start)->result_array();
			$count_list = $this->masterdata_model->member_list_count($search)->result_array();
			$total_row = $count_list[0]['total_row'];
			$data = array();
			$no = $_POST['start'];
			foreach ($list as $field) {

				$detail = '<a href="'.base_url().'Masterdata/detailmember?id='.$field['member_id'].'" data-fancybox="" data-type="iframe"><button type="button" class="btn btn-icon btn-primary btn-sm mb-2-btn" data-id="'.$field['member_id'].'"><i class="fas fa-eye sizing-fa"></i></button></a> ';

				if($check_auth[0]->edit == 'Y'){
					$edit = '<button type="button" class="btn btn-icon btn-warning btn-sm mb-2-btn" data-bs-toggle="modal" data-bs-target="#exampleModaledit" data-id="'.$field['member_id'].'" data-name="'.$field['member_name'].'"><i class="fas fa-edit sizing-fa"></i></button> ';
				}else{
					$edit = '<button type="button" class="btn btn-icon btn-warning btn-sm mb-2-btn" disabled="disabled"><i class="fas fa-edit sizing-fa"></i></button> <button type="button" class="btn btn-icon btn-info btn-sm mb-2-btn" disabled="disabled"><i class="fas fa-cog sizing-fa"></i></button> ';
				}

				$parq = '<a href="'.base_url().'Masterdata/detail_qusioner?id='.$field['member_id'].'" data-fancybox="" data-type="iframe"><button type="button" class="btn btn-icon btn-info btn-sm mb-2-btn" data-id="'.$field['member_id'].'" title="PARQ"><i class="fas fa-copy sizing-fa"></i></button></a> ';


				if($field['member_active'] == 'Y'){
					$status = '<span class="badge badge-success">Aktif</span>';
				}else{
					$status = '<span class="badge badge-danger">Non Aktif</span>';
				}

				$date = date_create($field['member_register']); 

				//$url_image = base_url().'assets/products/'.$field['product_image'];
				$no++;
				$row = array();
				$row[] = $field['member_code'];
				$row[] = $field['member_name'];
				$row[] = $field['member_address'];
				$row[] = $field['member_phone'];
				$row[] = $field['member_gender'];
				$row[] = $status;
				$row[] = date_format($date,"d-m-Y");
				$row[] = $detail.$edit.$parq;
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

	public function save_member()
	{	

		$modul = 'Member';
		$check_auth = $this->check_auth($modul);
		if($check_auth[0]->add == 'Y'){
			$screenshoot 				= $this->input->post('screenshoot');
			$member_name 				= $this->input->post('member_name');
			$member_phone 				= $this->input->post('member_phone');
			$member_nik 				= $this->input->post('member_nik');
			$member_dob					= $this->input->post('member_dob');
			$member_email	 			= $this->input->post('member_email');
			$member_address 			= $this->input->post('member_address');
			$member_gender 				= $this->input->post('member_gender');
			$member_urgent_name			= $this->input->post('member_urgent_name');
			$member_urgent_phone	 	= $this->input->post('member_urgent_phone');
			$member_urgent_sibiling 	= $this->input->post('member_urgent_sibiling');
			$member_info_join 			= $this->input->post('member_info_join');
			$member_desc 				= $this->input->post('member_desc');


			$user_id 		   			= $_SESSION['user_id'];

			$check_member_nik = $this->masterdata_model->check_member_nik($member_nik);
			if($check_member_nik != null){
				$msg = "Nik Sudah Di Gunakan";
				echo json_encode(['code'=>0, 'result'=>$msg]);die();
			}

			$check_member_phone = $this->masterdata_model->check_member_phone($member_phone);
			if($check_member_phone != null){
				$msg = "No Hp Sudah Di Gunakan";
				echo json_encode(['code'=>0, 'result'=>$msg]);die();
			}


			$check_member_email = $this->masterdata_model->check_member_email($member_email);
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

			$maxCode = $this->masterdata_model->last_member_code();
			if ($maxCode == NULL) {
				$last_code = '000001';
			} else {
				$maxCode = $maxCode[0]->member_code;
				$last_code = substr($maxCode, -6);
				$last_code = substr('00000' . strval(floatval($last_code) + 1), -6);
			}
			if($_FILES['screenshoot']['name'] == null){
				$new_image_name = 'default.png';
			}else{
				$new_image_name = $last_code.$this->generateRandomString().'.png';
				$config['upload_path'] = './assets/member/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg|PNG';
				$config['file_name'] = $new_image_name;
				$this->load->library('upload', $config);
				if (!$this->upload->do_upload('screenshoot')) 
				{
					$error = array('error' => $this->upload->display_errors());
					echo json_encode(['code'=>0, 'result'=>$error]);die();
				} 
				else
				{
					$data = array('image_metadata' => $this->upload->data());
				}
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
				'member_info_join'			=> $member_info_join,
				'member_desc'				=> $member_desc,
				'member_image'				=> $new_image_name
			);

			$this->masterdata_model->save_member($data_insert);

			$data_insert_act = array(
				'activity_table_desc'	       => 'Tambah Master member',
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

	function generateRandomString($length = 10) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';

		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[random_int(0, $charactersLength - 1)];
		}

		return $randomString;
	}

	public function edit_member()
	{
		$modul = 'Member';
		$check_auth = $this->check_auth($modul);
		if($check_auth[0]->edit == 'Y'){
			$screenshoot 				= $this->input->post('screenshoot_edit');
			$member_id   				= $this->input->post('member_id_edit');
			$member_code 				= $this->input->post('member_code_edit');
			$member_name 				= $this->input->post('member_name_edit');
			$member_phone 				= $this->input->post('member_phone_edit');
			$member_nik 				= $this->input->post('member_nik_edit');
			$member_dob 		 		= $this->input->post('member_dob_edit');
			$member_email   			= $this->input->post('member_email_edit');
			$member_address      		= $this->input->post('member_address_edit');
			$member_gender      		= $this->input->post('member_gender_edit');
			$member_urgent_name			= $this->input->post('member_urgent_name_edit');
			$member_urgent_phone	 	= $this->input->post('member_urgent_phone_edit');
			$member_urgent_sibiling 	= $this->input->post('member_urgent_sibiling_edit');
			$member_info_join 			= $this->input->post('member_info_join_edit');
			$member_desc 				= $this->input->post('member_desc_edit');

			$user_id 		   			= $_SESSION['user_id'];

			if($member_name == null){
				$msg = "Nama member Harus Di isi";
				echo json_encode(['code'=>0, 'result'=>$msg]);die();
			}

			if($member_phone == null){
				$msg = "No Hp Harus Di isi";
				echo json_encode(['code'=>0, 'result'=>$msg]);die();
			}

			$get_member_by_id = $this->masterdata_model->get_member_by_id($member_id);

			$check_image_name = $get_member_by_id[0]->member_image;

			if($_FILES['screenshoot_edit']['name'] == null){
				$new_image_name = $get_member_by_id[0]->member_image;
			}else{
				if($check_image_name != $_FILES['screenshoot_edit']['name']){
					$new_image_name = $member_code.$this->generateRandomString().'.png';
					$config['upload_path'] = './assets/member/';
					$config['allowed_types'] = 'gif|jpg|png|jpeg|PNG';
					$config['file_name'] = $new_image_name;
					$this->load->library('upload', $config);
					if (!$this->upload->do_upload('screenshoot_edit')) 
					{
						$error = array('error' => $this->upload->display_errors());
						echo json_encode(['code'=>0, 'result'=>$error]);die();
					} 
					else
					{
						$data = array('image_metadata' => $this->upload->data());
					}
				}else{
					$new_image_name = $check_image_name;
				}
			}

			$data_edit = array(
				'member_name'	       		=> $member_name,
				'member_phone'	   			=> $member_phone,
				'member_address'	    	=> $member_address,
				'member_dob'	       		=> $member_dob,
				'member_gender'	    		=> $member_gender,
				'member_nik'				=> $member_nik,
				'member_email'	    		=> $member_email,
				'member_image'				=> $new_image_name,
				'member_urgent_name'		=> $member_urgent_name,
				'member_urgent_phone'		=> $member_urgent_phone,
				'member_urgent_sibiling'	=> $member_urgent_sibiling,
				'member_info_join'			=> $member_info_join,
				'member_desc'				=> $member_desc,
			);

			$this->masterdata_model->edit_member($data_edit, $member_id);

			$data_insert_act = array(
				'activity_table_desc'	       => 'Ubah Master Member '.$member_name,
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

	public function detailmember()
	{
		$modul = 'Member';
		$check_auth = $this->check_auth($modul);
		if($check_auth[0]->view == 'Y'){
			$id = $this->input->get('id');
			$get_member_by_id['get_member_by_id'] = $this->masterdata_model->get_member_by_id($id);
			$get_class_by_member_id['get_class_by_member_id'] = $this->masterdata_model->get_class_by_member_id($id);
			$data['data'] = array_merge($get_member_by_id, $get_class_by_member_id);
			$this->load->view('Pages/Masterdata/member_detail', $data);
		}else{
			$msg = "No Access";
			echo json_encode(['code'=>0, 'result'=>$msg]);
		}
	}


	public function detail_qusioner()
	{

		$modul = 'Member';
		$check_auth = $this->check_auth($modul);
		if($check_auth[0]->view == 'Y'){
			$id = $this->input->get('id');
			$get_member_detail_by_id['get_member_detail_by_id'] = $this->masterdata_model->get_member_detail_by_id($id);
			$get_quisioner_member_by_id['get_quisioner_member_by_id'] = $this->masterdata_model->get_quisioner_member_by_id($id);
			$get_quisioner_member2_by_id['get_quisioner_member2_by_id'] = $this->masterdata_model->get_quisioner_member2_by_id($id);
			$data['data'] = array_merge($get_member_detail_by_id, $get_quisioner_member_by_id, $get_quisioner_member2_by_id);
			$this->load->view('Pages/Masterdata/quisioner_detail', $data);
		}else{
			$msg = "No Access";
			echo json_encode(['code'=>0, 'result'=>$msg]);
		}
	}

	public function get_member_id()
	{
		$id = $this->input->post('id');
		$get_member_by_id['get_member_by_id'] = $this->masterdata_model->get_member_by_id($id);
		echo json_encode(['code'=>200, 'result'=>$get_member_by_id]);
	}

	public function delete_member()
	{
		$modul = 'Member';
		$check_auth = $this->check_auth($modul);
		if($check_auth[0]->delete == 'Y'){
			$member_id  	= $this->input->post('id');
			$user_id 		= $_SESSION['user_id'];
			$this->masterdata_model->delete_member($member_id);
			$data_insert_act = array(
				'activity_table_desc'	       => 'Hapus Master member',
				'activity_table_user'	       => $user_id,
			);
			$this->global_model->save($data_insert_act);
			$msg = "Succes Delete";
			echo json_encode(['code'=>200, 'result'=>$msg]);
			die();
		}else{
			$msg = "No Access";
			echo json_encode(['code'=>0, 'result'=>$msg]);
		}	
	}

	public function get_edit_member()
	{
		$modul = 'Member';
		$check_auth = $this->check_auth($modul);
		if($check_auth[0]->view == 'Y'){
			$id = $this->input->post('id');
			$detail_edit_member = $this->masterdata_model->get_member_by_id($id);
			echo json_encode(['code'=>200, 'result'=>$detail_edit_member]);die();
		}else{
			$msg = "No Access";
			echo json_encode(['code'=>0, 'result'=>$msg]);die();
		}
	}
	
	// end member //


	// coach //

	public function personaltraining(){
		$modul = 'Coach';
		$check_auth = $this->check_auth($modul);
		if($check_auth[0]->view == 'Y'){
			$check_auth['check_auth'] = $check_auth;
			$get_class_pt['get_class_pt'] = $this->masterdata_model->get_class_pt();
			$data['data'] = array_merge($check_auth, $get_class_pt);
			$this->load->view('Pages/Masterdata/pt', $data);
		}else{
			$msg = "No Access";
			echo json_encode(['code'=>0, 'result'=>$msg]);
		}	
	}

	public function instruktur(){
		$modul = 'Coach';
		$check_auth = $this->check_auth($modul);
		if($check_auth[0]->view == 'Y'){
			$check_auth['check_auth'] = $check_auth;
			$this->load->view('Pages/Masterdata/instruktur', $check_auth);
		}else{
			$msg = "No Access";
			echo json_encode(['code'=>0, 'result'=>$msg]);
		}	
	}

	public function coach_list()
	{
		$modul = 'Coach';
		$check_auth = $this->check_auth($modul);
		if($check_auth[0]->view == 'Y'){
			$type 				= $this->input->post('type');
			$search 			= $this->input->post('search');
			$length 			= $this->input->post('length');
			$start 			  	= $this->input->post('start');

			if($search != null){
				$search = $search['value'];
			}
			$list = $this->masterdata_model->coach_list($search, $length, $start, $type)->result_array();
			$count_list = $this->masterdata_model->coach_list_count($search, $type)->result_array();
			$total_row = $count_list[0]['total_row'];
			$data = array();
			$no = $_POST['start'];
			foreach ($list as $field) {

				$detail = '<a href="'.base_url().'Masterdata/detailcoach?id='.$field['coach_id'].'" data-fancybox="" data-type="iframe"><button type="button" class="btn btn-icon btn-primary btn-sm mb-2-btn" data-id="'.$field['coach_id'].'"><i class="fas fa-eye sizing-fa"></i></button></a> ';

				if($check_auth[0]->edit == 'Y'){
					$edit = '<button type="button" class="btn btn-icon btn-warning btn-sm mb-2-btn" data-bs-toggle="modal" data-bs-target="#exampleModaledit" data-id="'.$field['coach_id'].'" data-name="'.$field['coach_name'].'"><i class="fas fa-edit sizing-fa"></i></button> ';
				}else{
					$edit = '<button type="button" class="btn btn-icon btn-warning btn-sm mb-2-btn" disabled="disabled"><i class="fas fa-edit sizing-fa"></i></button> <button type="button" class="btn btn-icon btn-info btn-sm mb-2-btn" disabled="disabled"><i class="fas fa-cog sizing-fa"></i></button> ';
				}

				if($field['coach_active'] == 'Y'){
					$status = '<span class="badge badge-success">Aktif</span>';
				}else{
					$status = '<span class="badge badge-danger">Non Aktif</span>';
				}


				$share_link = '<input type="hidden" value="'.$field['coach_ref_link'].'" id="shared'.$field['coach_id'].'"><button type="button" class="btn btn-icon btn-info btn-sm mb-2-btn" data-id="'.$field['coach_id'].'"><i class="fas fa-link sizing-fa"></i></button> ';

				$date = date_create($field['coach_register']); 

				//$url_image = base_url().'assets/products/'.$field['product_image'];
				$no++;
				$row = array();
				$row[] = $field['coach_code'];
				$row[] = $field['coach_name'];
				$row[] = $field['coach_phone'];
				$row[] = $field['coach_address'];
				$row[] = date_format($date,"d-m-Y");
				if($type == 'PT'){
					$row[] = $field['ms_pt_price_name'];
				}else{
					$row[] = $field['coach_title'];
				}
				$row[] = $status;
				$row[] = $detail.$edit.$share_link;
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

	public function detailcoach()
	{
		$modul = 'Coach';
		$check_auth = $this->check_auth($modul);
		if($check_auth[0]->view == 'Y'){
			$id = $this->input->get('id');
			$get_coach_by_id['get_coach_by_id'] = $this->masterdata_model->get_coach_by_id($id);
			$get_class_by_coach_id['get_class_by_coach_id'] = $this->masterdata_model->get_class_by_coach_id($id);
			$data['data'] = array_merge($get_coach_by_id, $get_class_by_coach_id);
			$this->load->view('Pages/Masterdata/coach_detail', $data);
		}else{
			$msg = "No Access";
			echo json_encode(['code'=>0, 'result'=>$msg]);
		}
	}

	public function save_coach()
	{	

		$modul = 'Coach';
		$check_auth = $this->check_auth($modul);
		if($check_auth[0]->add == 'Y'){
			$screenshoot 		= $this->input->post('screenshoot');
			$coach_code 		= $this->input->post('coach_code');
			$coach_name 		= $this->input->post('coach_name');
			$coach_phone 		= $this->input->post('coach_phone');
			$coach_email	 	= $this->input->post('coach_email');
			$coach_identity 	= $this->input->post('coach_identity');
			$coach_dob 			= $this->input->post('coach_dob');
			$coach_gender 		= $this->input->post('coach_gender');
			$coach_address 		= $this->input->post('coach_address');
			$coach_lvl 			= $this->input->post('coach_lvl');
			$coach_title 		= $this->input->post('coach_title');
			$coach_type 		= $this->input->post('coach_type');
			$coach_salary 		= $this->input->post('coach_salary');
			$coach_extra_charge = $this->input->post('coach_extra_charge');
			$user_id 		   	= $_SESSION['user_id'];

			$coach_salary_replace = str_replace('Rp. ', '', $coach_salary);
			$coach_salary = str_replace('.', '', $coach_salary_replace);


			$coach_extra_charge_replace = str_replace('Rp. ', '', $coach_extra_charge);
			$coach_extra_charge = str_replace('.', '', $coach_extra_charge_replace);

			$check_code = $this->masterdata_model->check_coach_code($coach_code);
			

			if($check_code != null){
				$msg = "Kode Instruktur / PT Sudah Di gunakan";
				echo json_encode(['code'=>0, 'result'=>$msg]);die();
			}

			if($coach_name == null){
				$msg = "Nama Instruktur Harus Di isi";
				echo json_encode(['code'=>0, 'result'=>$msg]);die();
			}

			if($coach_phone == null){
				$msg = "No HP Harus Di isi";
				echo json_encode(['code'=>0, 'result'=>$msg]);die();
			}

			if($coach_email == null){
				$msg = "Email Harus Di isi";
				echo json_encode(['code'=>0, 'result'=>$msg]);die();
			}

			if($coach_identity == null){
				$msg = "NIK Harus Di isi";
				echo json_encode(['code'=>0, 'result'=>$msg]);die();
			}

			if($coach_dob == null){
				$msg = "Tanggal Lahir Harus Di isi";
				echo json_encode(['code'=>0, 'result'=>$msg]);die();
			}

			if($coach_address == null){
				$msg = "Alamat Harus Di isi";
				echo json_encode(['code'=>0, 'result'=>$msg]);die();
			}
			if($coach_lvl == null){
				$msg = "LVL Harus Di isi";
				echo json_encode(['code'=>0, 'result'=>$msg]);die();
			}
			if($coach_salary == null){
				$msg = "Gaji Pokok Harus Di isi";
				echo json_encode(['code'=>0, 'result'=>$msg]);die();
			}


			if($_FILES['screenshoot']['name'] == null){
				$new_image_name = 'default.png';
			}else{
				$new_image_name = $coach_code.$this->generateRandomString().'.png';
				$config['upload_path'] = './assets/coach/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg|PNG';
				$config['file_name'] = $new_image_name;
				$this->load->library('upload', $config);
				if (!$this->upload->do_upload('screenshoot')) 
				{
					$error = array('error' => $this->upload->display_errors());
					echo json_encode(['code'=>0, 'result'=>$error]);die();
				} 
				else
				{
					$data = array('image_metadata' => $this->upload->data());
				}
			}

			$data_insert = array(
				'coach_code'	    	=> $coach_code,
				'coach_name'	    	=> $coach_name,
				'coach_phone'	   		=> $coach_phone,
				'coach_email'			=> $coach_email,
				'coach_address'	    	=> $coach_address,
				'coach_identity'	   	=> $coach_identity,
				'coach_gender'	   		=> $coach_gender,
				'coach_title'	   		=> $coach_title,
				'coach_lvl'	   			=> $coach_lvl,
				'coach_type'			=> $coach_type,
				'coach_dob'				=> $coach_dob,
				'coach_salary'	    	=> $coach_salary,
				'coach_extra_charge'	=> $coach_extra_charge,
				'coach_image'	   		=> $new_image_name
			);
			$this->masterdata_model->save_coach($data_insert);

			$data_insert_act = array(
				'activity_table_desc'	       => 'Tambah Master Instruktur '.$coach_name,
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

	public function edit_coach()
	{
		$modul = 'Coach';
		$check_auth = $this->check_auth($modul);
		if($check_auth[0]->edit == 'Y'){

			$screenshoot 		= $this->input->post('screenshoot');
			$coach_code   		= $this->input->post('coach_code_edit');
			$coach_id   		= $this->input->post('coach_id_edit');
			$coach_name 		= $this->input->post('coach_name_edit');
			$coach_phone 		= $this->input->post('coach_phone_edit');
			$coach_email	 	= $this->input->post('coach_email_edit');
			$coach_identity 	= $this->input->post('coach_identity_edit');
			$coach_dob 			= $this->input->post('coach_dob_edit');
			$coach_gender 		= $this->input->post('coach_gender_edit');
			$coach_address 		= $this->input->post('coach_address_edit');
			$coach_lvl 			= $this->input->post('coach_lvl_edit');
			$coach_title 		= $this->input->post('coach_title_edit');
			$coach_salary 		= $this->input->post('coach_salary_edit');
			$coach_extra_charge = $this->input->post('coach_extra_charge_edit');
			$user_id 		   	= $_SESSION['user_id'];

			$coach_salary_replace = str_replace('Rp. ', '', $coach_salary);
			$coach_salary = str_replace('.', '', $coach_salary_replace);


			$coach_extra_charge_replace = str_replace('Rp. ', '', $coach_extra_charge);
			$coach_extra_charge = str_replace('.', '', $coach_extra_charge_replace);


			if($coach_name == null){
				$msg = "Nama Instruktur Harus Di isi";
				echo json_encode(['code'=>0, 'result'=>$msg]);die();
			}

			if($coach_phone == null){
				$msg = "No HP Harus Di isi";
				echo json_encode(['code'=>0, 'result'=>$msg]);die();
			}

			if($coach_email == null){
				$msg = "Email Harus Di isi";
				echo json_encode(['code'=>0, 'result'=>$msg]);die();
			}

			if($coach_identity == null){
				$msg = "NIK Harus Di isi";
				echo json_encode(['code'=>0, 'result'=>$msg]);die();
			}

			if($coach_dob == null){
				$msg = "Tanggal Lahir Harus Di isi";
				echo json_encode(['code'=>0, 'result'=>$msg]);die();
			}

			if($coach_address == null){
				$msg = "Alamat Harus Di isi";
				echo json_encode(['code'=>0, 'result'=>$msg]);die();
			}

			if($coach_lvl == null){
				$msg = "LVL Harus Di isi";
				echo json_encode(['code'=>0, 'result'=>$msg]);die();
			}

			if($coach_salary == null){
				$msg = "Gaji Pokok Harus Di isi";
				echo json_encode(['code'=>0, 'result'=>$msg]);die();
			}

			$get_coach_by_id = $this->masterdata_model->get_coach_by_id($coach_id);

			$check_image_name = $get_coach_by_id[0]->coach_image;

			if($_FILES['screenshoot_edit']['name'] == null){
				$new_image_name = $get_coach_by_id[0]->coach_image;
			}else{
				if($check_image_name != $_FILES['screenshoot_edit']['name']){
					$new_image_name = $coach_code.$this->generateRandomString().'.png';
					$config['upload_path'] = './assets/coach/';
					$config['allowed_types'] = 'gif|jpg|png|jpeg|PNG';
					$config['file_name'] = $new_image_name;
					$this->load->library('upload', $config);
					if (!$this->upload->do_upload('screenshoot_edit')) 
					{
						$error = array('error' => $this->upload->display_errors());
						echo json_encode(['code'=>0, 'result'=>$error]);die();
					} 
					else
					{
						$data = array('image_metadata' => $this->upload->data());
					}
				}else{
					$new_image_name = $check_image_name;
				}
			}

			$data_edit = array(
				'coach_name'	    	=> $coach_name,
				'coach_phone'	   		=> $coach_phone,
				'coach_email'			=> $coach_email,
				'coach_address'	    	=> $coach_address,
				'coach_identity'	   	=> $coach_identity,
				'coach_gender'	   		=> $coach_gender,
				'coach_title'	   		=> $coach_title,
				'coach_lvl'	   			=> $coach_lvl,
				'coach_salary'	    	=> $coach_salary,
				'coach_dob'				=> $coach_dob,
				'coach_extra_charge'	=> $coach_extra_charge,
				'coach_image'	   		=> $new_image_name
			);
			$this->masterdata_model->edit_coach($data_edit, $coach_id);

			$data_insert_act = array(
				'activity_table_desc'	       => 'Ubah Master coach '.$coach_name,
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


	public function get_coach_id(){
		$id = $this->input->post('id');
		$get_coach_by_id['get_coach_by_id'] = $this->masterdata_model->get_coach_by_id($id);
		echo json_encode(['code'=>200, 'result'=>$get_coach_by_id]);
	}

	public function delete_coach()
	{
		$modul = 'Coach';
		$check_auth = $this->check_auth($modul);
		if($check_auth[0]->delete == 'Y'){
			$coach_id  	= $this->input->post('id');
			$user_id 		= $_SESSION['user_id'];
			$this->masterdata_model->delete_coach($coach_id);
			$data_insert_act = array(
				'activity_table_desc'	       => 'Hapus Master coach',
				'activity_table_user'	       => $user_id,
			);
			$this->global_model->save($data_insert_act);
			$msg = "Succes Delete";
			echo json_encode(['code'=>200, 'result'=>$msg]);
			die();
		}else{
			$msg = "No Access";
			echo json_encode(['code'=>0, 'result'=>$msg]);
		}	
	}

	public function get_edit_coach()
	{
		$modul = 'Coach';
		$check_auth = $this->check_auth($modul);
		if($check_auth[0]->view == 'Y'){
			$id = $this->input->post('id');
			$detail_edit_coach = $this->masterdata_model->get_coach_by_id($id);
			echo json_encode(['code'=>200, 'result'=>$detail_edit_coach]);die();
		}else{
			$msg = "No Access";
			echo json_encode(['code'=>0, 'result'=>$msg]);die();
		}
	}

	public function get_pt_price()
	{
		$ms_pt_price_id  = $this->input->post('id');
		$get_ms_pt_price['get_ms_pt_price'] = $this->global_model->get_ms_pt_price($ms_pt_price_id);
		echo json_encode(['code'=>200, 'result'=>$get_ms_pt_price]);
	}
	// end coach //

	// class //

	public function class(){
		$modul = 'Class';
		$check_auth = $this->check_auth($modul);
		if($check_auth[0]->view == 'Y'){
			$coach_list['coach_list'] = $this->global_model->coach_list();
			$check_auth['check_auth'] = $check_auth;
			$data['data'] = array_merge($coach_list, $check_auth);
			$this->load->view('Pages/Masterdata/class', $data);
		}else{
			$msg = "No Access";
			echo json_encode(['code'=>0, 'result'=>$msg]);
		}	
	}


	public function class_list()
	{
		$modul = 'Class';
		$check_auth = $this->check_auth($modul);
		if($check_auth[0]->view == 'Y'){
			$search 			= $this->input->post('search');
			$length 			= $this->input->post('length');
			$start 			  	= $this->input->post('start');

			if($search != null){
				$search = $search['value'];
			}
			$list = $this->masterdata_model->class_list($search, $length, $start)->result_array();
			$count_list = $this->masterdata_model->class_list_count($search)->result_array();
			$total_row = $count_list[0]['total_row'];
			$data = array();
			$no = $_POST['start'];
			foreach ($list as $field) {

				$detail = '<a href="'.base_url().'Masterdata/detailmember?id='.$field['class_id'].'" data-fancybox="" data-type="iframe"><button type="button" class="btn btn-icon btn-primary btn-sm mb-2-btn" data-id="'.$field['class_id'].'"><i class="fas fa-eye sizing-fa"></i></button></a> ';
				if($check_auth[0]->edit == 'Y'){
					$edit = '<button type="button" class="btn btn-icon btn-warning btn-sm mb-2-btn" data-bs-toggle="modal" data-bs-target="#exampleModaledit" data-id="'.$field['class_id'].'" data-name="'.$field['class_name'].'"><i class="fas fa-edit sizing-fa"></i></button> ';
				}else{
					$edit = '<button type="button" class="btn btn-icon btn-warning btn-sm mb-2-btn" disabled="disabled"><i class="fas fa-edit sizing-fa"></i></button> <button type="button" class="btn btn-icon btn-info btn-sm mb-2-btn" disabled="disabled"><i class="fas fa-cog sizing-fa"></i></button> ';
				}
				if($check_auth[0]->delete == 'Y'){
					$delete = '<button type="button" class="btn btn-icon btn-danger btn-sm mb-2-btn delete" data-id="'.$field['class_id'].'" data-name="'.$field['class_name'].'" onclick="delete_class('.$field['class_id'].')"><i class="fas fa-trash-alt sizing-fa"></i></button> ';
				}else{
					$delete = '<button type="button" class="btn btn-icon btn-danger btn-sm mb-2-btn delete" data-id="'.$field['class_id'].'" data-name="'.$field['class_name'].'" disabled="disabled"><i class="fas fa-trash-alt sizing-fa"></i></button> ';
				}
				if($check_auth[0]->edit == 'Y'){
					$schedule = '<button type="button" class="btn btn-icon btn-info btn-sm mb-2-btn" data-bs-toggle="modal" data-bs-target="#exampleModalschedule" data-id="'.$field['class_id'].'" data-name="'.$field['class_name'].'"><i class="fas fa-calendar-alt sizing-fa"></i></button> ';
				}else{
					$schedule = '<button type="button" class="btn btn-icon btn-info btn-sm mb-2-btn" data-bs-toggle="modal" data-bs-target="#exampleModalschedule" data-id="'.$field['class_id'].'" data-name="'.$field['class_name'].'" disabled="disabled"><i class="fas fa-calendar-alt sizing-fa"></i></button> ';
				}

				$no++;
				$row = array();
				$row[] = $field['class_code'];
				$row[] = $field['class_name'];
				$row[] = $field['class_desc'];
				$row[] = 'Rp. '.number_format($field['class_price_day']).' / Hari';
				$row[] = 'Rp. '.number_format($field['class_price']).' / Bulan';
				$row[] = $edit.$delete.$schedule;
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

	public function save_class()
	{	

		$modul = 'class';
		$check_auth = $this->check_auth($modul);
		if($check_auth[0]->add == 'Y'){
			$screenshoot 				= $this->input->post('screenshoot');
			$class_name 				= $this->input->post('class_name');
			$class_desc 				= $this->input->post('class_desc');
			$class_price_day	 		= $this->input->post('class_price_day');
			$class_price	 			= $this->input->post('class_price');
			$class_attend_type 			= $this->input->post('class_attend_type');
			$user_id 		   			= $_SESSION['user_id'];

			$class_price_day_replace = str_replace('Rp. ', '', $class_price_day);
			$class_price_day = str_replace('.', '', $class_price_day_replace);

			$class_price_replace = str_replace('Rp. ', '', $class_price);
			$class_price = str_replace('.', '', $class_price_replace);

			if($class_name == null){
				$msg = "Silahkan Isi Nama Kelas";
				echo json_encode(['code'=>0, 'result'=>$msg]);die();
			}

			if($class_price == null){
				$msg = "Silahkan Isi Harga Kelas";
				echo json_encode(['code'=>0, 'result'=>$msg]);die();
			}

			$maxCode = $this->masterdata_model->last_class_code();
			if ($maxCode == NULL) {
				$last_code = 'CLS'.'000001';
			} else {
				$maxCode = $maxCode[0]->class_code;
				$last_code = substr($maxCode, -6);
				$last_code = 'CLS'.substr('000000' . strval(floatval($last_code) + 1), -6);
			}		

			if($_FILES['screenshoot']['name'] == null){
				$new_image_name = 'default.png';
			}else{
				$new_image_name = $last_code.$this->generateRandomString().'.png';
				$config['upload_path'] = './assets/class/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg|PNG';
				$config['file_name'] = $new_image_name;
				$this->load->library('upload', $config);
				if (!$this->upload->do_upload('screenshoot')) 
				{
					$error = array('error' => $this->upload->display_errors());
					echo json_encode(['code'=>0, 'result'=>$error]);die();
				} 
				else
				{
					$data = array('image_metadata' => $this->upload->data());
				}
			}

			$data_insert = array(
				'class_code'	       	=> $last_code,
				'class_name'	       	=> $class_name,
				'class_price_day' 		=> $class_price_day,
				'class_price'	   		=> $class_price,
				'class_attend_type'	    => $class_attend_type,
				'class_desc'	       	=> $class_desc,
				'class_image'	    	=> $new_image_name,
			);
			$this->masterdata_model->save_class($data_insert);

			$data_insert_act = array(
				'activity_table_desc'	       => 'Tambah Master class',
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

	public function edit_class()
	{
		$modul = 'class';
		$check_auth = $this->check_auth($modul);
		if($check_auth[0]->edit == 'Y'){

			$screenshoot 				= $this->input->post('screenshoot_edit');
			$class_id   				= $this->input->post('class_id_edit');
			$class_name 				= $this->input->post('class_name_edit');
			$class_desc 				= $this->input->post('class_desc_edit');
			$class_price_day	 		= $this->input->post('class_price_day_edit');
			$class_price	 			= $this->input->post('class_price_edit');
			$class_attend_type 			= $this->input->post('class_attend_type_edit');
			$user_id 		   			= $_SESSION['user_id'];


			$class_price_day_replace = str_replace('Rp. ', '', $class_price_day);
			$class_price_day = str_replace('.', '', $class_price_day_replace);

			$class_price_replace = str_replace('Rp. ', '', $class_price);
			$class_price = str_replace('.', '', $class_price_replace);

			if($class_name == null){
				$msg = "Silahkan Isi Nama Kelas";
				echo json_encode(['code'=>0, 'result'=>$msg]);die();
			}

			if($class_price == null){
				$msg = "Silahkan Isi Harga Kelas";
				echo json_encode(['code'=>0, 'result'=>$msg]);die();
			}


			$get_class_by_id = $this->masterdata_model->get_class_by_id($class_id);

			$check_image_name = $get_class_by_id[0]->class_image;

			if($_FILES['screenshoot_edit']['name'] == null){
				$new_image_name = $get_class_by_id[0]->class_image;
			}else{
				if($check_image_name != $_FILES['screenshoot_edit']['name']){
					$new_image_name = $member_code.$this->generateRandomString().'.png';
					$config['upload_path'] = './assets/member/';
					$config['allowed_types'] = 'gif|jpg|png|jpeg|PNG';
					$config['file_name'] = $new_image_name;
					$this->load->library('upload', $config);
					if (!$this->upload->do_upload('screenshoot_edit')) 
					{
						$error = array('error' => $this->upload->display_errors());
						echo json_encode(['code'=>0, 'result'=>$error]);die();
					} 
					else
					{
						$data = array('image_metadata' => $this->upload->data());
					}
				}else{
					$new_image_name = $check_image_name;
				}
			}

			$data_edit = array(
				'class_name'	       	=> $class_name,
				'class_price_day'  		=> $class_price_day, 
				'class_price'	   		=> $class_price,
				'class_attend_type'	    => $class_attend_type,
				'class_desc'	       	=> $class_desc,
				'class_image'	    	=> $new_image_name,
			);
			$this->masterdata_model->edit_class($data_edit, $class_id);

			$data_insert_act = array(
				'activity_table_desc'	       => 'Ubah Master class '.$class_name,
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

	
	public function detailclass(){
		$modul = 'Class';
		$check_auth = $this->check_auth($modul);
		if($check_auth[0]->view == 'Y'){
			$id = $this->input->get('id');
			$get_class_by_id['get_class_by_id'] = $this->masterdata_model->get_class_by_id($id);
			$this->load->view('Pages/Masterdata/class_detail', $get_class_by_id);
		}else{
			$msg = "No Access";
			echo json_encode(['code'=>0, 'result'=>$msg]);
		}
	}


	public function get_class_id(){
		$id = $this->input->post('id');
		$get_class_by_id['get_class_by_id'] = $this->masterdata_model->get_class_by_id($id);

		$get_class_schedule['get_class_schedule'] = $this->masterdata_model->get_class_schedule($id);
		echo json_encode(['code'=>200, 'result'=>$get_class_by_id, 'schedule'=>$get_class_schedule]);
	}

	public function delete_class()
	{
		$modul = 'Class';
		$check_auth = $this->check_auth($modul);
		if($check_auth[0]->delete == 'Y'){
			$class_id  	= $this->input->post('id');
			$user_id 		= $_SESSION['user_id'];
			$this->masterdata_model->delete_class($class_id);
			$data_insert_act = array(
				'activity_table_desc'	       => 'Hapus Master Kelas',
				'activity_table_user'	       => $user_id,
			);
			$this->global_model->save($data_insert_act);
			$msg = "Succes Delete";
			echo json_encode(['code'=>200, 'result'=>$msg]);
			die();
		}else{
			$msg = "No Access";
			echo json_encode(['code'=>0, 'result'=>$msg]);
		}	
	}

	public function delete_schedule()
	{
		$modul = 'Class';
		$check_auth = $this->check_auth($modul);
		if($check_auth[0]->delete == 'Y'){
			$schedule_id  	= $this->input->post('id');
			$class_id  		= $this->input->post('class_id');
			$user_id 		= $_SESSION['user_id'];
			$this->masterdata_model->delete_schedule($schedule_id);
			$data_insert_act = array(
				'activity_table_desc'	       => 'Hapus Jadwal Kelas',
				'activity_table_user'	       => $user_id,
			);
			$this->global_model->save($data_insert_act);
			$msg = "Succes Delete";
			$id = $class_id;
			$get_class_by_id['get_class_by_id'] = $this->masterdata_model->get_class_by_id($id);
			$get_class_schedule['get_class_schedule'] = $this->masterdata_model->get_class_schedule($id);
			echo json_encode(['code'=>200, 'result'=>$get_class_by_id, 'schedule'=>$get_class_schedule]);
			die();
		}else{
			$msg = "No Access";
			echo json_encode(['code'=>0, 'result'=>$msg]);
		}
	}

	public function add_schedule()
	{
		$modul = 'class';
		$check_auth = $this->check_auth($modul);
		if($check_auth[0]->edit == 'Y'){
			$class_id_schedule    	= $this->input->post('class_id_schedule');
			$schedule_day   		= $this->input->post('schedule_day');
			$schedule_time_start 	= $this->input->post('schedule_time_start');
			$schedule_time_end 		= $this->input->post('schedule_time_end');
			$schedule_coach 		= $this->input->post('schedule_coach');
			$user_id 		   		= $_SESSION['user_id'];

			if($schedule_day == null){
				$msg = "Hari Kelas Harus Di Isi";
				echo json_encode(['code'=>0, 'result'=>$msg]);die();
			}

			if($schedule_coach == null){
				$msg = "Instruktur Harus Di Isi";
				echo json_encode(['code'=>0, 'result'=>$msg]);die();
			}

			if($schedule_day == 'Senin'){
				$schedule_sort = 1;
			}else if($schedule_day == 'Selasa'){
				$schedule_sort = 2;
			}else if($schedule_day == 'Rabu'){
				$schedule_sort = 3;
			}else if($schedule_day == 'Kamis'){
				$schedule_sort = 4;
			}else if($schedule_day == 'Jumat'){
				$schedule_sort = 5;
			}else if($schedule_day == 'Sabtu'){
				$schedule_sort = 6;
			}else{
				$schedule_sort = 7;
			}

			$data_insert = array(
				'class_id'	       		=> $class_id_schedule,
				'coach_id'	       		=> $schedule_coach,
				'schedule_day'	    	=> $schedule_day,
				'schedule_time_start'	=> $schedule_time_start,
				'schedule_time_end'	   	=> $schedule_time_end,
				'schedule_sort'	    	=> $schedule_sort,
			);

			$this->masterdata_model->save_schedule($data_insert);

			$data_insert_act = array(
				'activity_table_desc'	       => 'Tambah Jadwal '.$schedule_day,
				'activity_table_user'	       => $user_id,
			);
			$this->global_model->save($data_insert_act);

			$id = $class_id_schedule;
			$get_class_by_id['get_class_by_id'] = $this->masterdata_model->get_class_by_id($id);
			$get_class_schedule['get_class_schedule'] = $this->masterdata_model->get_class_schedule($id);
			echo json_encode(['code'=>200, 'result'=>$get_class_by_id, 'schedule'=>$get_class_schedule]);
			die();
		}else{
			$msg = "No Access";
			echo json_encode(['code'=>0, 'result'=>$msg]);
		}	
	}
	// end class //

	// pt Paket //
	public function ptpackage(){
		$modul = 'Ptpackage';
		$check_auth = $this->check_auth($modul);
		if($check_auth[0]->view == 'Y'){
			$pt_package['pt_package'] = $this->global_model->pt_package();
			$pt_price['pt_price'] = $this->global_model->pt_price();
			$check_auth['check_auth'] = $check_auth;
			$data['data'] = array_merge($pt_package, $check_auth, $pt_price);
			$this->load->view('Pages/Masterdata/ptpackage', $data);
		}else{
			$msg = "No Access";
			echo json_encode(['code'=>0, 'result'=>$msg]);
		}	
	}

	public function pt_package_list()
	{
		$modul = 'Ptpackage';
		$check_auth = $this->check_auth($modul);
		if($check_auth[0]->view == 'Y'){
			$search 			= $this->input->post('search');
			$length 			= $this->input->post('length');
			$start 			  	= $this->input->post('start');

			if($search != null){
				$search = $search['value'];
			}
			$list = $this->masterdata_model->pt_package_list($search, $length, $start)->result_array();
			$count_list = $this->masterdata_model->pt_package_list_count($search)->result_array();
			$total_row = $count_list[0]['total_row'];
			$data = array();
			$no = $_POST['start'];
			foreach ($list as $field) {


				if($check_auth[0]->delete == 'Y'){
					$delete = '<button type="button" class="btn btn-icon btn-danger btn-sm mb-2-btn delete" data-id="'.$field['ms_pt_package_price_id'].'" data-name="'.$field['ms_pt_package_price_name'].'" onclick="delete_pt_package('.$field['ms_pt_package_price_id'].')"><i class="fas fa-trash-alt sizing-fa"></i></button> ';
				}else{
					$delete = '<button type="button" class="btn btn-icon btn-danger btn-sm mb-2-btn delete" data-id="'.$field['ms_pt_package_price_id'].'" data-name="'.$field['ms_pt_package_price_name'].'" disabled="disabled"><i class="fas fa-trash-alt sizing-fa"></i></button> ';
				}
				if($check_auth[0]->edit == 'Y'){
					$edit = '<button type="button" class="btn btn-icon btn-warning btn-sm mb-2-btn" data-bs-toggle="modal" data-bs-target="#exampleModaledit" data-id="'.$field['ms_pt_package_price_id'].'" data-name="'.$field['ms_pt_package_price_name'].'"><i class="fas fa-edit sizing-fa"></i></button> ';
				}else{
					$edit = '<button type="button" class="btn btn-icon btn-warning btn-sm mb-2-btn" data-bs-toggle="modal" data-bs-target="#exampleModaledit" data-id="'.$field['ms_pt_package_price_id'].'" data-name="'.$field['ms_pt_package_price_name'].'" disabled="disabled"><i class="fas fa-edit sizing-fa"></i></button> ';
				}
				$url_image = base_url().'assets/pt/'.$field['ms_pt_package_image'];
				$no++;
				$row = array();
				$row[] = $field['ms_pt_package_price_name'];
				$row[] = $field['ms_pt_package_session'];
				$row[] = $field['ms_pt_price_name'];
				$row[] = 'Rp. '.number_format($field['ms_pt_package_price']);
				$row[] = '';
				$row[] = '<img src = "'.$url_image.'" style="height:70px; width:70px;"/>';
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
			echo json_encode(['code'=>0, 'result'=>$msg]);
		}	
	}


	public function save_pt_package()
	{
		$modul = 'Ptpackage';
		$check_auth = $this->check_auth($modul);
		if($check_auth[0]->add == 'Y'){
			$screenshoot 				= $this->input->post('screenshoot');
			$paket_name 				= $this->input->post('paket_name');
			$paket_session 				= $this->input->post('paket_session');
			$paket_lvl	 				= $this->input->post('paket_lvl');
			$price	 					= $this->input->post('price');
			$user_id 		   			= $_SESSION['user_id'];

			$price_replace = str_replace('Rp. ', '', $price);
			$price = str_replace('.', '', $price_replace);

			if($paket_name == null){
				$msg = "Silahkan Isi Nama Paket";
				echo json_encode(['code'=>0, 'result'=>$msg]);die();
			}

			if($paket_session == null){
				$msg = "Silahkan Isi Jumlah Sesi";
				echo json_encode(['code'=>0, 'result'=>$msg]);die();
			}

			if($paket_lvl == null){
				$msg = "Silahkan Isi Lvl PT";
				echo json_encode(['code'=>0, 'result'=>$msg]);die();
			}

			if($_FILES['screenshoot']['name'] == null){
				$new_image_name = 'default.png';
			}else{
				$new_image_name = 'PT-set-'.$this->generateRandomString().'.png';
				$config['upload_path'] = './assets/pt/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg|PNG';
				$config['file_name'] = $new_image_name;
				$this->load->library('upload', $config);
				if (!$this->upload->do_upload('screenshoot')) 
				{
					$error = array('error' => $this->upload->display_errors());
					echo json_encode(['code'=>0, 'result'=>$error]);die();
				} 
				else
				{
					$data = array('image_metadata' => $this->upload->data());
				}
			}

			$data_insert = array(
				'ms_pt_package_price_name'	=> $paket_name,
				'ms_pt_package_id'			=> $paket_session,
				'ms_pt_price_id'			=> $paket_lvl,
				'ms_pt_package_price'		=> $price,
				'ms_pt_package_image'	    => $new_image_name,
			);
			$save_pt_package = $this->masterdata_model->save_pt_package($data_insert);

			$data_insert_act = array(
				'activity_table_desc'	       => 'Tambah Master Paket PT',
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


	public function edit_pt_package()
	{
		$modul = 'Ptpackage';
		$check_auth = $this->check_auth($modul);
		if($check_auth[0]->edit == 'Y'){
			$screenshoot 				= $this->input->post('screenshoot_edit');
			$paket_id 					= $this->input->post('paket_id_edit');
			$paket_name 				= $this->input->post('paket_name_edit');
			$paket_session 				= $this->input->post('paket_session_edit');
			$paket_lvl	 				= $this->input->post('paket_lvl_edit');
			$price	 					= $this->input->post('price_edit');
			$user_id 		   			= $_SESSION['user_id'];

			$price_replace = str_replace('Rp. ', '', $price);
			$price = str_replace('.', '', $price_replace);

			if($paket_name == null){
				$msg = "Silahkan Isi Nama Paket";
				echo json_encode(['code'=>0, 'result'=>$msg]);die();
			}

			if($paket_session == null){
				$msg = "Silahkan Isi Jumlah Sesis";
				echo json_encode(['code'=>0, 'result'=>$msg]);die();
			}

			if($paket_lvl == null){
				$msg = "Silahkan Isi Lvl PT";
				echo json_encode(['code'=>0, 'result'=>$msg]);die();
			}

			$get_paket_by_id = $this->masterdata_model->get_edit_pt_package($paket_id);
			$check_image_name = $get_paket_by_id[0]->ms_pt_package_image;

			if($_FILES['screenshoot_edit']['name'] == null){
				$new_image_name = $get_paket_by_id[0]->ms_pt_package_image;
			}else{
				if($check_image_name != $_FILES['screenshoot_edit']['name']){
					$new_image_name = 'Gym-set-'.$this->generateRandomString().'.png';
					$config['upload_path'] = './assets/pt/';
					$config['allowed_types'] = 'gif|jpg|png|jpeg|PNG';
					$config['file_name'] = $new_image_name;
					$this->load->library('upload', $config);
					if (!$this->upload->do_upload('screenshoot_edit')) 
					{
						$error = array('error' => $this->upload->display_errors());
						echo json_encode(['code'=>0, 'result'=>$error]);die();
					} 
					else
					{
						$data = array('image_metadata' => $this->upload->data());
					}
				}else{
					$new_image_name = $check_image_name;
				}
			}

			$data_edit = array(
				'ms_pt_package_price_name'	=> $paket_name,
				'ms_pt_package_id'			=> $paket_session,
				'ms_pt_price_id'			=> $paket_lvl,
				'ms_pt_package_price'		=> $price,
				'ms_pt_package_image'	    => $new_image_name,
			);

			$this->masterdata_model->edit_pt_package($data_edit, $paket_id);

			$data_insert_act = array(
				'activity_table_desc'	       => 'Ubah Master Paket PT',
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

	public function get_edit_pt_package()
	{
		$modul = 'Ptpackage';
		$check_auth = $this->check_auth($modul);
		if($check_auth[0]->view == 'Y'){
			$id = $this->input->post('id');
			$get_edit_pt_package = $this->masterdata_model->get_edit_pt_package($id);
			echo json_encode(['code'=>200, 'result'=>$get_edit_pt_package]);die();
		}else{
			$msg = "No Access";
			echo json_encode(['code'=>0, 'result'=>$msg]);die();
		}
	}

	public function delete_pt_package()
	{
		$modul = 'Ptpackage';
		$check_auth = $this->check_auth($modul);
		if($check_auth[0]->add == 'Y'){
			$id  	= $this->input->post('id');
			$this->masterdata_model->delete_pt_package($id);
			$msg = "Success Hapus";
			echo json_encode(['code'=>200, 'result'=>$msg]);die();
		}else{
			$msg = "No Access";
			echo json_encode(['code'=>0, 'result'=>$msg]);die();
		}
	}
	// End Pt Paket //

	// class paket//

	public function save_class_package()
	{
		$modul = 'classpackage';
		$check_auth = $this->check_auth($modul);
		if($check_auth[0]->add == 'Y'){
			$screenshoot 				= $this->input->post('screenshoot');
			$paket_name 				= $this->input->post('paket_name');
			$daily_price 				= $this->input->post('daily_price');
			$monthly_price	 			= $this->input->post('monthly_price');
			$yearly_price	 			= $this->input->post('yearly_price');
			$paket_type	 				= $this->input->post('paket_type');
			$paket_qty	 				= $this->input->post('paket_qty');
			$user_id 		   			= $_SESSION['user_id'];

			$daily_price_replace = str_replace('Rp. ', '', $daily_price);
			$daily_price = str_replace('.', '', $daily_price_replace);

			$monthly_price_replace = str_replace('Rp. ', '', $monthly_price);
			$monthly_price = str_replace('.', '', $monthly_price_replace);

			$yearly_price_replace = str_replace('Rp. ', '', $yearly_price);
			$yearly_price = str_replace('.', '', $yearly_price_replace);

			if($paket_name == null){
				$msg = "Silahkan Isi Nama Paket";
				echo json_encode(['code'=>0, 'result'=>$msg]);die();
			}

			if($paket_type == null){
				$msg = "Silahkan Isi Tipe Paket";
				echo json_encode(['code'=>0, 'result'=>$msg]);die();
			}

			if($paket_qty == null){
				$msg = "Silahkan Isi Masa Berlaku";
				echo json_encode(['code'=>0, 'result'=>$msg]);die();
			}

			if($_FILES['screenshoot']['name'] == null){
				$new_image_name = 'default.png';
			}else{
				$new_image_name = 'Class-set-'.$this->generateRandomString().'.png';
				$config['upload_path'] = './assets/class/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg|PNG';
				$config['file_name'] = $new_image_name;
				$this->load->library('upload', $config);
				if (!$this->upload->do_upload('screenshoot')) 
				{
					$error = array('error' => $this->upload->display_errors());
					echo json_encode(['code'=>0, 'result'=>$error]);die();
				} 
				else
				{
					$data = array('image_metadata' => $this->upload->data());
				}
			}

			$data_insert = array(
				'ms_class_package_name'	    	=> $paket_name,
				'ms_class_package_day_price'	=> $daily_price,
				'ms_class_package_month_price'	=> $monthly_price,
				'ms_class_package_year_price'	=> $yearly_price,
				'ms_class_package_image'	    => $new_image_name,
				'ms_class_package_type'			=> $paket_type,
				'ms_class_package_qty'			=> $paket_qty
			);
			$save_class_package = $this->masterdata_model->save_class_package($data_insert);

			$get_temp_class_package = $this->masterdata_model->get_temp_class_package()->result_array();
			foreach($get_temp_class_package as $row){
				$data_insert_detail = array(
					'ms_class_package_id'	    	=> $save_class_package,
					'class_id'						=> $row['class_id'],
					'package_class_id'				=> $row['package_class_id']
				);
				$this->masterdata_model->save_class_package_detail($data_insert_detail);
			}

			$this->clear_temp_class_package();

			$data_insert_act = array(
				'activity_table_desc'	       => 'Tambah Master Paket Kelas',
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

	public function clear_temp_class_package()
	{
		$this->masterdata_model->clear_temp_class_package();
	}

	public function classpackage(){
		$modul = 'classpackage';
		$check_auth = $this->check_auth($modul);
		if($check_auth[0]->view == 'Y'){
			$coach_list['coach_list'] = $this->global_model->coach_list();
			$class_list['class_list'] = $this->global_model->class_list();
			$check_auth['check_auth'] = $check_auth;
			$data['data'] = array_merge($coach_list, $check_auth, $class_list);
			$this->load->view('Pages/Masterdata/classpackage', $data);
		}else{
			$msg = "No Access";
			echo json_encode(['code'=>0, 'result'=>$msg]);
		}	
	}

	public function get_package_class_temp()
	{
		$modul = 'classpackage';
		$check_auth = $this->check_auth($modul);
		if($check_auth[0]->add == 'Y'){
			$get_package_class_temp = $this->masterdata_model->get_package_class_temp()->result_array();
			echo json_encode(['code'=>200, 'result'=>$get_package_class_temp]);die();
		}else{
			$msg = "No Access";
			echo json_encode(['code'=>0, 'result'=>$msg]);die();
		}
	}

	public function add_class_package()
	{
		$modul = 'classpackage';
		$check_auth = $this->check_auth($modul);
		if($check_auth[0]->add == 'Y'){
			$add_class_package  	= $this->input->post('class_package');
			$check_class_package_input = $this->masterdata_model->check_class_package_input($add_class_package)->result_array();
			if($check_class_package_input != null){
				$msg = "Kelas Sudah Di Input";
				echo json_encode(['code'=>0, 'result'=>$msg]);die();
			}else{
				$data_insert = array(
					'class_id'	       		=> $add_class_package
				);

				$this->masterdata_model->save_class_package_temp($data_insert);
				$msg = "Success";
				echo json_encode(['code'=>200, 'result'=>$msg]);die();
			}
		}else{
			$msg = "No Access";
			echo json_encode(['code'=>0, 'result'=>$msg]);die();
		}
	}

	public function delete_class_package_temp()
	{
		$modul = 'classpackage';
		$check_auth = $this->check_auth($modul);
		if($check_auth[0]->add == 'Y'){
			$id  	= $this->input->post('id');
			$this->masterdata_model->delete_class_package_temp($id);
			$msg = "Success Hapus";
			echo json_encode(['code'=>200, 'result'=>$msg]);die();
		}else{
			$msg = "No Access";
			echo json_encode(['code'=>0, 'result'=>$msg]);die();
		}
	}

	public function delete_class_package()
	{
		$modul = 'classpackage';
		$check_auth = $this->check_auth($modul);
		if($check_auth[0]->delete == 'Y'){
			$id  	= $this->input->post('id');
			$this->masterdata_model->delete_class_package($id);
			$msg = "Success Hapus";
			echo json_encode(['code'=>200, 'result'=>$msg]);die();
		}else{
			$msg = "No Access";
			echo json_encode(['code'=>0, 'result'=>$msg]);die();
		}
	}

	public function class_package_list()
	{
		$modul = 'classpackage';
		$check_auth = $this->check_auth($modul);
		if($check_auth[0]->view == 'Y'){
			$search 			= $this->input->post('search');
			$length 			= $this->input->post('length');
			$start 			  	= $this->input->post('start');

			if($search != null){
				$search = $search['value'];
			}
			$list = $this->masterdata_model->class_package_list($search, $length, $start)->result_array();
			$count_list = $this->masterdata_model->class_package_list_count($search)->result_array();
			$total_row = $count_list[0]['total_row'];
			$data = array();
			$no = $_POST['start'];
			foreach ($list as $field) {

				if($check_auth[0]->delete == 'Y'){
					$delete = '<button type="button" class="btn btn-icon btn-danger btn-sm mb-2-btn delete" data-id="'.$field['ms_class_package_id'].'" data-name="'.$field['ms_class_package_name'].'" onclick="delete_class_package('.$field['ms_class_package_id'].')"><i class="fas fa-trash-alt sizing-fa"></i></button> ';
				}else{
					$delete = '<button type="button" class="btn btn-icon btn-danger btn-sm mb-2-btn delete" data-id="'.$field['ms_class_package_id'].'" data-name="'.$field['ms_class_package_name'].'" disabled="disabled"><i class="fas fa-trash-alt sizing-fa"></i></button> ';
				}

				$url_image = base_url().'assets/class/'.$field['ms_class_package_image'];

				$no++;
				$row = array();
				$row[] = $field['ms_class_package_name'];
				$row[] = 'Rp. '.number_format($field['ms_class_package_day_price']).' / Hari';
				$row[] = 'Rp. '.number_format($field['ms_class_package_month_price']).' / Bulan';
				$row[] = 'Rp. '.number_format($field['ms_class_package_year_price']).' / Tahun';
				$row[] = $field['ms_class_package_qty'].' '.$field['ms_class_package_type'];
				$row[] = '<img src="'.$url_image.'" style="height:70px; width:70px;" />';
				$row[] = $delete;
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

	// end class paket //

	// gym paket //

	public function gympackage(){
		$modul = 'Gympackage';
		$check_auth = $this->check_auth($modul);
		if($check_auth[0]->view == 'Y'){
			$coach_list['coach_list'] = $this->global_model->coach_list();
			$check_auth['check_auth'] = $check_auth;
			$data['data'] = array_merge($coach_list, $check_auth);
			$this->load->view('Pages/Masterdata/gym', $data);
		}else{
			$msg = "No Access";
			echo json_encode(['code'=>0, 'result'=>$msg]);
		}	
	}


	public function gym_list()
	{
		$modul = 'Gympackage';
		$check_auth = $this->check_auth($modul);
		if($check_auth[0]->view == 'Y'){
			$search 			= $this->input->post('search');
			$length 			= $this->input->post('length');
			$start 			  	= $this->input->post('start');

			if($search != null){
				$search = $search['value'];
			}
			$list = $this->masterdata_model->gym_list($search, $length, $start)->result_array();
			$count_list = $this->masterdata_model->gym_list_count($search)->result_array();
			$total_row = $count_list[0]['total_row'];
			$data = array();
			$no = $_POST['start'];
			foreach ($list as $field) {

				if($check_auth[0]->edit == 'Y'){
					$edit = '<button type="button" class="btn btn-icon btn-warning btn-sm mb-2-btn" data-bs-toggle="modal" data-bs-target="#exampleModaledit" data-id="'.$field['ms_gym_package_id'].'" data-name="'.$field['ms_gym_package_name'].'"><i class="fas fa-edit sizing-fa"></i></button> ';
				}else{
					$edit = '<button type="button" class="btn btn-icon btn-warning btn-sm mb-2-btn" disabled="disabled"><i class="fas fa-edit sizing-fa"></i></button> <button type="button" class="btn btn-icon btn-info btn-sm mb-2-btn" disabled="disabled"><i class="fas fa-cog sizing-fa"></i></button> ';
				}
				if($check_auth[0]->delete == 'Y'){
					$delete = '<button type="button" class="btn btn-icon btn-danger btn-sm mb-2-btn delete" data-id="'.$field['ms_gym_package_id'].'" data-name="'.$field['ms_gym_package_name'].'" onclick="delete_gym_package('.$field['ms_gym_package_id'].')"><i class="fas fa-trash-alt sizing-fa"></i></button> ';
				}else{
					$delete = '<button type="button" class="btn btn-icon btn-danger btn-sm mb-2-btn delete" data-id="'.$field['ms_gym_package_id'].'" data-name="'.$field['ms_gym_package_name'].'" disabled="disabled"><i class="fas fa-trash-alt sizing-fa"></i></button> ';
				}

				$url_image = base_url().'assets/gym/'.$field['ms_gym_package_image'];

				$no++;
				$row = array();
				$row[] = $field['ms_gym_package_name'];
				$row[] = 'Rp. '.number_format($field['ms_gym_package_day_price']).' / Hari';
				$row[] = 'Rp. '.number_format($field['ms_gym_package_month_price']).' / Bulan';
				$row[] = 'Rp. '.number_format($field['ms_gym_package_year_price']).' / Tahun';
				$row[] = $field['ms_gym_package_qty'].' '.$field['ms_gym_package_type'];
				$row[] = '<img src="'.$url_image.'" style="height:70px; width:70px;" />';
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

	public function save_gym_package()
	{	

		$modul = 'Gympackage';
		$check_auth = $this->check_auth($modul);
		if($check_auth[0]->add == 'Y'){
			$screenshoot 				= $this->input->post('screenshoot');
			$paket_name 				= $this->input->post('paket_name');
			$daily_price 				= $this->input->post('daily_price');
			$monthly_price	 			= $this->input->post('monthly_price');
			$yearly_price	 			= $this->input->post('yearly_price');
			$paket_type	 				= $this->input->post('paket_type');
			$paket_qty	 				= $this->input->post('paket_qty');
			$user_id 		   			= $_SESSION['user_id'];

			$daily_price_replace = str_replace('Rp. ', '', $daily_price);
			$daily_price = str_replace('.', '', $daily_price_replace);

			$monthly_price_replace = str_replace('Rp. ', '', $monthly_price);
			$monthly_price = str_replace('.', '', $monthly_price_replace);

			$yearly_price_replace = str_replace('Rp. ', '', $yearly_price);
			$yearly_price = str_replace('.', '', $yearly_price_replace);

			if($paket_name == null){
				$msg = "Silahkan Isi Nama Paket";
				echo json_encode(['code'=>0, 'result'=>$msg]);die();
			}

			if($paket_type == null){
				$msg = "Silahkan Isi Tipe Paket";
				echo json_encode(['code'=>0, 'result'=>$msg]);die();
			}

			if($paket_qty == null){
				$msg = "Silahkan Isi Masa Berlaku";
				echo json_encode(['code'=>0, 'result'=>$msg]);die();
			}

			if($_FILES['screenshoot']['name'] == null){
				$new_image_name = 'default.png';
			}else{
				$new_image_name = 'Gym-set-'.$this->generateRandomString().'.png';
				$config['upload_path'] = './assets/gym/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg|PNG';
				$config['file_name'] = $new_image_name;
				$this->load->library('upload', $config);
				if (!$this->upload->do_upload('screenshoot')) 
				{
					$error = array('error' => $this->upload->display_errors());
					echo json_encode(['code'=>0, 'result'=>$error]);die();
				} 
				else
				{
					$data = array('image_metadata' => $this->upload->data());
				}
			}

			$data_insert = array(
				'ms_gym_package_name'	    => $paket_name,
				'ms_gym_package_day_price'	=> $daily_price,
				'ms_gym_package_month_price'=> $monthly_price,
				'ms_gym_package_year_price'	=> $yearly_price,
				'ms_gym_package_image'	    => $new_image_name,
				'ms_gym_package_type'		=> $paket_type,
				'ms_gym_package_qty'		=> $paket_qty
			);
			$this->masterdata_model->save_gym_package($data_insert);

			$data_insert_act = array(
				'activity_table_desc'	       => 'Tambah Master Paket Gym',
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


	public function get_edit_gym_package()
	{
		$modul = 'Gympackage';
		$check_auth = $this->check_auth($modul);
		if($check_auth[0]->view == 'Y'){
			$id = $this->input->post('id');
			$get_edit_gym_package = $this->masterdata_model->get_edit_gym_package($id);
			echo json_encode(['code'=>200, 'result'=>$get_edit_gym_package]);die();
		}else{
			$msg = "No Access";
			echo json_encode(['code'=>0, 'result'=>$msg]);die();
		}
	}


	public function edit_gym_package()
	{
		$modul = 'Gympackage';
		$check_auth = $this->check_auth($modul);
		if($check_auth[0]->edit == 'Y'){
			$screenshoot 				= $this->input->post('screenshoot_edit');
			$paket_id 					= $this->input->post('paket_id_edit');
			$paket_name 				= $this->input->post('paket_name_edit');
			$daily_price 				= $this->input->post('daily_price_edit');
			$monthly_price	 			= $this->input->post('monthly_price_edit');
			$yearly_price	 			= $this->input->post('yearly_price_edit');
			$paket_type	 				= $this->input->post('paket_type_edit');
			$paket_qty	 				= $this->input->post('paket_qty_edit');
			$user_id 		   			= $_SESSION['user_id'];

			$daily_price_replace = str_replace('Rp. ', '', $daily_price);
			$daily_price = str_replace('.', '', $daily_price_replace);

			$monthly_price_replace = str_replace('Rp. ', '', $monthly_price);
			$monthly_price = str_replace('.', '', $monthly_price_replace);

			$yearly_price_replace = str_replace('Rp. ', '', $yearly_price);
			$yearly_price = str_replace('.', '', $yearly_price_replace);

			if($paket_name == null){
				$msg = "Silahkan Isi Nama Paket";
				echo json_encode(['code'=>0, 'result'=>$msg]);die();
			}

			if($paket_type == null){
				$msg = "Silahkan Isi Tipe Paket";
				echo json_encode(['code'=>0, 'result'=>$msg]);die();
			}

			if($paket_qty == null){
				$msg = "Silahkan Isi Masa Berlaku";
				echo json_encode(['code'=>0, 'result'=>$msg]);die();
			}


			$get_paket_by_id = $this->masterdata_model->get_edit_gym_package($paket_id);

			$check_image_name = $get_paket_by_id[0]->ms_gym_package_image;

			if($_FILES['screenshoot_edit']['name'] == null){
				$new_image_name = $get_paket_by_id[0]->ms_gym_package_image;
			}else{
				if($check_image_name != $_FILES['screenshoot_edit']['name']){
					$new_image_name = 'Gym-set-'.$this->generateRandomString().'.png';
					$config['upload_path'] = './assets/gym/';
					$config['allowed_types'] = 'gif|jpg|png|jpeg|PNG';
					$config['file_name'] = $new_image_name;
					$this->load->library('upload', $config);
					if (!$this->upload->do_upload('screenshoot_edit')) 
					{
						$error = array('error' => $this->upload->display_errors());
						echo json_encode(['code'=>0, 'result'=>$error]);die();
					} 
					else
					{
						$data = array('image_metadata' => $this->upload->data());
					}
				}else{
					$new_image_name = $check_image_name;
				}
			}

			$data_edit = array(
				'ms_gym_package_name'	    => $paket_name,
				'ms_gym_package_day_price'	=> $daily_price,
				'ms_gym_package_month_price'=> $monthly_price,
				'ms_gym_package_year_price'	=> $yearly_price,
				'ms_gym_package_image'	    => $new_image_name,
				'ms_gym_package_type'		=> $paket_type,
				'ms_gym_package_qty'		=> $paket_qty
			);
			$this->masterdata_model->edit_gym_package($data_edit, $paket_id);

			$data_insert_act = array(
				'activity_table_desc'	       => 'Ubah Master Paket Gym',
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

	public function delete_gym_package()
	{
		$modul = 'Gympackage';
		$check_auth = $this->check_auth($modul);
		if($check_auth[0]->delete == 'Y'){
			$paket_id  		= $this->input->post('id');
			$user_id 		= $_SESSION['user_id'];
			$this->masterdata_model->delete_gym_package($paket_id);
			$data_insert_act = array(
				'activity_table_desc'	       => 'Hapus Master Paket Gym',
				'activity_table_user'	       => $user_id,
			);
			$this->global_model->save($data_insert_act);
			$msg = "Succes Delete";
			echo json_encode(['code'=>200, 'result'=>$msg]);
			die();
		}else{
			$msg = "No Access";
			echo json_encode(['code'=>0, 'result'=>$msg]);
		}	
	}
	// end gym paket//

	// start promo //

	public function promo(){
		$modul = 'Promo';
		$check_auth = $this->check_auth($modul);
		if($check_auth[0]->view == 'Y'){
			$check_auth['check_auth'] = $check_auth;
			$list_pt_package_price['list_pt_package_price'] = $this->global_model->pt_package_price();
			$list_gym_package['list_gym_package'] = $this->global_model->gym_package();
			$list_class_package['list_class_package'] = $this->global_model->class_package();
			$data['data'] = array_merge($check_auth, $list_pt_package_price, $list_gym_package, $list_class_package);
			$this->load->view('Pages/Masterdata/promo', $data);
		}else{
			$msg = "No Access";
			echo json_encode(['code'=>0, 'result'=>$msg]);
		}	
	}


	public function promo_list()
	{
		$modul = 'Promo';
		$check_auth = $this->check_auth($modul);
		if($check_auth[0]->view == 'Y'){
			$search 			= $this->input->post('search');
			$length 			= $this->input->post('length');
			$start 			  	= $this->input->post('start');

			if($search != null){
				$search = $search['value'];
			}

			$list = $this->masterdata_model->promo_list($search, $length, $start)->result_array();
			$count_list = $this->masterdata_model->promo_list_count($search)->result_array();
			$total_row = $count_list[0]['total_row'];
			$data = array();
			$no = $_POST['start'];
			foreach ($list as $field) {

				if($check_auth[0]->edit == 'Y'){
					$edit = '<button type="button" class="btn btn-icon btn-warning btn-sm mb-2-btn" data-bs-toggle="modal" data-bs-target="#exampleModaledit" data-id="'.$field['ms_promo_id'].'" data-name="'.$field['ms_pormo_name'].'"><i class="fas fa-edit sizing-fa"></i></button> ';
				}else{
					$edit = '<button type="button" class="btn btn-icon btn-warning btn-sm mb-2-btn" disabled="disabled"><i class="fas fa-edit sizing-fa"></i></button> <button type="button" class="btn btn-icon btn-info btn-sm mb-2-btn" disabled="disabled"><i class="fas fa-cog sizing-fa"></i></button> ';
				}

				if($check_auth[0]->delete == 'Y'){
					$delete = '<button type="button" class="btn btn-icon btn-danger btn-sm mb-2-btn delete" data-id="'.$field['ms_promo_id'].'" data-name="'.$field['ms_pormo_name'].'" onclick="delete_promo('.$field['ms_promo_id'].')"><i class="fas fa-trash-alt sizing-fa"></i></button> ';
				}else{
					$delete = '<button type="button" class="btn btn-icon btn-danger btn-sm mb-2-btn delete" data-id="'.$field['ms_promo_id'].'" data-name="'.$field['ms_pormo_name'].'" disabled="disabled"><i class="fas fa-trash-alt sizing-fa"></i></button> ';
				}

				if($field['ms_promo_member'] == 'Y'){
					$promo_member = '<span class="badge badge-success">Include</span>';
					$gym_pacakge_val  = $field['ms_gym_package_name'];
				}else{
					$promo_member = '<span class="badge badge-danger">Non Include</span>';
					$gym_pacakge_val  = '-';
				}

				if($field['ms_promo_pt'] == 'Y'){
					$promo_pt = '<span class="badge badge-success">Include</span>';
					$pt_package_val = $field['ms_pt_package_price_name'];
				}else{
					$promo_pt = '<span class="badge badge-danger">Non Include</span>';
					$pt_package_val = '-';
				}

				if($field['ms_promo_class'] == 'Y'){
					$promo_kelas = '<span class="badge badge-success">Include</span>';
					$class_package_val = $field['ms_class_package_name'];
				}else{
					$promo_kelas = '<span class="badge badge-danger">Non Include</span>';
					$class_package_val = '-';
				}


				$no++;
				$row = array();
				$row[] = $field['ms_pormo_name'];
				$row[] = $promo_member;
				$row[] = $gym_pacakge_val;
				$row[] = $promo_pt;
				$row[] = $pt_package_val;
				$row[] = $promo_kelas;
				$row[] = $class_package_val;
				$row[] = $field['ms_promo_category'];
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

	public function detailpromo()
	{
		$modul = 'Promo';
		$check_auth = $this->check_auth($modul);
		if($check_auth[0]->view == 'Y'){
			$id = $this->input->get('id');
			$get_promo_by_id['get_promo_by_id'] = $this->masterdata_model->get_promo_id($id);
			$this->load->view('Pages/Masterdata/promo_detail', $get_promo_by_id);
		}else{
			$msg = "No Access";
			echo json_encode(['code'=>0, 'result'=>$msg]);
		}
	}

	public function save_promo()
	{
		$modul = 'Promo';
		$check_auth = $this->check_auth($modul);
		if($check_auth[0]->add == 'Y'){

			$promo_name 				= $this->input->post('promo_name');
			$promo_disc_val 			= $this->input->post('promo_disc_val');
			$promo_member 				= $this->input->post('promo_member');
			$member_session_unit 		= $this->input->post('member_session_unit');
			$promo_pt 					= $this->input->post('promo_pt');
			$pt_session_unit 			= $this->input->post('pt_session_unit');
			$promo_kelas 				= $this->input->post('promo_kelas');
			$class_session_unit 		= $this->input->post('class_session_unit');
			$promo_category 			= $this->input->post('promo_category');
			$promo_disc_pt 				= $this->input->post('promo_disc_pt_val');
			$promo_disc_member 			= $this->input->post('promo_disc_member_val');
			$promo_disc_class   		= $this->input->post('promo_disc_class_val');
			$user_id 		   			= $_SESSION['user_id'];
			
			if($promo_name == null){
				$msg = "Silahkan Isi Nama Promo";
				echo json_encode(['code'=>0, 'result'=>$msg]);die();
			}

			if($promo_member == 'Y' && $promo_kelas == 'N' ){
				$promo_category = 'GYM';
			}

			if($promo_member == 'N' && $promo_kelas == 'Y' ){
				$promo_category = 'Kelas';
			}

			if($promo_member == 'Y' && $promo_kelas == 'Y' ){
				$promo_category = 'GYM & Kelas';
			}


			$data_insert = array(
				'ms_pormo_name'	       	=> $promo_name,
				'ms_promo_member'	    => $promo_member,
				'ms_promo_member_month'	=> $member_session_unit,
				'ms_promo_pt'	       	=> $promo_pt,
				'ms_promo_pt_sesi'	   	=> $pt_session_unit,
				'ms_promo_class'	    => $promo_kelas,
				'ms_promo_class_month'	=> $class_session_unit,
				'ms_pormo_discount'	   	=> $promo_disc_val,
				'ms_promo_category'		=> $promo_category,
				'ms_promo_member_promo' => $promo_disc_member,
				'ms_promo_pt_promo'	   	=> $promo_disc_pt,
				'ms_promo_class_promo'	=> $promo_disc_class,
			);

			$this->masterdata_model->save_promo($data_insert);

			$data_insert_act = array(
				'activity_table_desc'	       => 'Tambah Promo',
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

	public function delete_promo()
	{
		$modul = 'Promo';
		$check_auth = $this->check_auth($modul);
		if($check_auth[0]->delete == 'Y'){
			$promo_id  	= $this->input->post('id');
			$user_id 	= $_SESSION['user_id'];
			$this->masterdata_model->delete_promo($promo_id);
			$data_insert_act = array(
				'activity_table_desc'	       => 'Hapus Master Promo '.$promo_id,
				'activity_table_user'	       => $user_id,
			);
			$this->global_model->save($data_insert_act);
			$msg = "Succes Delete";
			echo json_encode(['code'=>200, 'result'=>$msg]);
			die();
		}else{
			$msg = "No Access";
			echo json_encode(['code'=>0, 'result'=>$msg]);
		}	
	}

	public function edit_promo()
	{
		$modul = 'Promo';
		$check_auth = $this->check_auth($modul);
		if($check_auth[0]->edit == 'Y'){
			$promo_id 					= $this->input->post('promo_id_edit');
			$promo_name 				= $this->input->post('promo_name');
			$promo_member 				= $this->input->post('promo_member');
			$member_session_unit 		= $this->input->post('member_session_unit');
			$promo_disc_val 			= $this->input->post('promo_disc_val');
			$promo_pt 					= $this->input->post('promo_pt');
			$pt_session_unit 			= $this->input->post('pt_session_unit');
			$promo_kelas 				= $this->input->post('promo_kelas');
			$class_session_unit 		= $this->input->post('class_session_unit');
			$promo_category 			= $this->input->post('promo_category');
			$promo_disc_pt 				= $this->input->post('promo_disc_pt_val');
			$promo_disc_member 			= $this->input->post('promo_disc_member_val');
			$promo_disc_class   		= $this->input->post('promo_disc_class_val');
			$user_id 		   			= $_SESSION['user_id'];
			
			if($promo_name == null){
				$msg = "Silahkan Isi Nama Promo";
				echo json_encode(['code'=>0, 'result'=>$msg]);die();
			}

			if($promo_member == 'Y' && $promo_kelas == 'N' ){
				$promo_category = 'GYM';
			}

			if($promo_member == 'N' && $promo_kelas == 'Y' ){
				$promo_category = 'Kelas';
			}

			if($promo_member == 'Y' && $promo_kelas == 'Y' ){
				$promo_category = 'GYM & Kelas';
			}

			$data_edit = array(
				'ms_pormo_name'	       	=> $promo_name,
				'ms_promo_member'	    => $promo_member,
				'ms_promo_member_month'	=> $member_session_unit,
				'ms_promo_pt'	       	=> $promo_pt,
				'ms_promo_pt_sesi'	   	=> $pt_session_unit,
				'ms_promo_class'	    => $promo_kelas,
				'ms_promo_class_month'	=> $class_session_unit,
				'ms_pormo_discount'	   	=> $promo_disc_val,
				'ms_promo_category'		=> $promo_category,
				'ms_promo_member_promo' => $promo_disc_member,
				'ms_promo_pt_promo'	   	=> $promo_disc_pt,
				'ms_promo_class_promo'	=> $promo_disc_class,
			);

			$this->masterdata_model->edit_promo($data_edit, $promo_id);

			$data_insert_act = array(
				'activity_table_desc'	       => 'Edit Promo '.$promo_name,
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


	public function get_promo_id()
	{
		$id = $this->input->post('id');
		$get_promo_id['get_promo_id'] = $this->masterdata_model->get_promo_id($id);
		echo json_encode(['code'=>200, 'result'=>$get_promo_id]);
	}

	// end promo //


}	

?>