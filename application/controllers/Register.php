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
		$this->load->model('global_model');
		$this->load->helper(array('url', 'html'));
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
			$coach_list['coach_list'] = $this->global_model->coach_list();
			$check_auth['check_auth'] = $check_auth;
			$data['data'] = array_merge($check_auth, $coach_list);
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
			$coach_list['coach_list'] = $this->global_model->coach_list();
			$check_auth['check_auth'] = $check_auth;
			$data['data'] = array_merge($check_auth, $coach_list);
			$this->load->view('Pages/Register/addregister', $data);
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
				$row[] = $detail.$edit;
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
			$member_urgent_phone	 	= $this->input->post('member_urgent_phone');
			$member_urgent_sibiling 	= $this->input->post('member_urgent_sibiling');
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
				'member_urgent_phone'		=> $member_urgent_phone,
				'member_urgent_sibiling'	=> $member_urgent_sibiling,
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
			$member_urgent_phone	 	= $this->input->post('member_urgent_phone_edit');
			$member_urgent_sibiling 	= $this->input->post('member_urgent_sibiling_edit');
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
				'member_urgent_phone'		=> $member_urgent_phone,
				'member_urgent_sibiling'	=> $member_urgent_sibiling,
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

}	

?>