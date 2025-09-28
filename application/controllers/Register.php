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

	public function register_list()
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

	public function save_register()
	{
		print_r($_POST);die();
	}
	
	// end member //

}	

?>