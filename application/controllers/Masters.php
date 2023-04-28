<?php	
defined('BASEPATH') OR exit('No direct script access allowed');	
class Masters extends CI_Controller {	
	/**	
	 * Index Page for this controller.	
	 *	
	 * Maps to the following URL	
	 * 		http://example.com/index.php/welcome	
	 *	- or -	
	 * 		http://example.com/index.php/welcome/index	
	 *	- or -	
	 * Since this controller is set as the default controller in	
	 * config/routes.php, it's displayed at http://example.com/	
	 *	
	 * So any other public methods not prefixed with an underscore will	
	 * map to /index.php/welcome/<method_name>	
	 * @see https://codeigniter.com/user_guide/general/urls.html	
	 */	
	public function __construct()	
    {	
        parent::__construct();	
        $this->load->helper(array(	
            'form',	
            'html',	
            'file',	
            'url'	
        ));	
		$this->load->model('masters_model');
        $this->load->library('session');	
        $this->load->library('form_validation');	
        $this->load->library('javascript');	
        $this->load->library('email');	
		$this->load->model('CommonBird_model', 'cbmodel');
		if ( !$this->session->userdata('logged_in')){ 	
			redirect(base_url(), 'refresh');	
				
        }	
        	
    }	
	public function change_password(){
		$this->load->view('Masters/change_password');
	}
	public function employe(){
		// $where_cond_e['u.static_status']=1;
		// $table = 'ckb_users as u';
		// $join_table = 'ckb_branch as b';
		// $join_tb_cond = 'u.branch_id = b.auto_id';
		// $select = 'u.*,b.*';
		$where_cond_e1['status']=1;
        $data['employe_result'] = $this->cbmodel->get_all_data($where_cond_e1,'ckb_users');
		//$data['employe_result'] = $this->cbmodel->verify_data_join_one($where_cond_e,$table,$join_table,$join_tb_cond,$select);
		//print_r($data['employe_result']);
		$this->load->view('Masters/employe',$data);	
	}
	public function branch(){
		$where_cond_e['static_status']=1;
        $data['branch'] = $this->cbmodel->get_all_data($where_cond_e,'ckb_branch');
		$this->load->view('Masters/branch',$data);	
	}
	public function edit_healthcare_samples()
	{
		$this->load->view('Masters/edit_healthcare_samples');
	}
	public function edit_healthcare_lab()
	{
		$this->load->view('Masters/edit_healthcare_lab');
	}
	public function roles(){
		$where_cond_t['status']=1;
        $data['roles_result'] = $this->cbmodel->get_all_data($where_cond_t,'ckb_roles');
		$data['menu_result'] = $this->masters_model->get_table('ckb_menus');
		
		$data['submenu_result'] = $this->masters_model->get_table('ckb_submenus');
		$this->load->view('Masters/roles', $data);	
	}
	public function view_roles(){
		$roles = $this->masters_model->get_table('ckb_roles');
		$data['roles'] = $roles;
		$this->load->view('Masters/view_roles' , $data);		
	}
	public function get_all_roles(){
		$where_cond_t['status']=1;
        $roles_result = $this->cbmodel->get_all_data($where_cond_t,'ckb_roles');
		echo json_encode($roles_result);
	}
	public function get_all_branch(){
		$where_cond_t['status']=1;
        $branch_result = $this->cbmodel->get_all_data($where_cond_t,'ckb_branch');
		echo json_encode($branch_result);
	}
	public function get_ids_submenu(){
		$data['menu_id']= $this->input->post('menu_id');
		$sb_result['sb_ids'] = $this->cbmodel->verify_data($data,'ckb_submenus');
		$data1['menu_id']= $this->input->post('menu_id');
		$data1['role_id']= $this->input->post('role_id');
	//	$check_role = $this->db->get_where('ckb_role_permission',array('role_id'=>$rol))
		$sb_result['role_status'] = $this->cbmodel->verify_data($data1,'ckb_role_permission');
		echo json_encode($sb_result);

	}
	public function get_role_status(){
		$data['menu_id']= $this->input->post('menu_id');
		$data['role_id']= $this->input->post('role_id');
		$data['submenu_id']= $this->input->post('sbmenu_id');
		$rs_result = $this->cbmodel->verify_data($data,'ckb_role_permission');
		echo json_encode($rs_result);

	}
	public function updatePassword(){
		$user_id =  $this->session->userdata('user_id');
		$data['user_pass'] = md5($this->input->post('confirm_password'));
		$update_result = $this->masters_model->updates('ckb_users', $data, 'user_id', $user_id);
		if($update_result){
			$result = array(
				"logstatus" => "success",
				"url" => "Login/logout"
			);
			echo json_encode($result);
	
		}
	
	}	
	public function toggle_all_menus(){
		$role_id = $this->input->post('role_id');
		$ap = $this->input->post('ap');
		//echo $ap;
		
		$menu_result = $this->masters_model->get_table('ckb_menus');
		
		foreach($menu_result as $k => $val ){
			$query = $this->db->get_where('ckb_role_permission', array('role_id' => $role_id,'menu_id' => $val['id']));
		$al_exist = $query->num_rows();
		//echo $al_exist;
		if($al_exist > 0){
			$data['role_permission']  = $ap;	
			$rp_result = $this->masters_model->menu_updates('ckb_role_permission', $data, $val['id'], $role_id);
		
			//echo $up_result;
		}
	
	else {
			
		$where_cond_m['role_id'] = $role_id;
		$where_cond_m['menu_id'] = $val['id'];
		$where_cond_m['role_permission'] = $ap;
		 
		$where_submenu['menu_id'] = $val['id'];
		$sb_result = $this->cbmodel->verify_data($where_submenu,'ckb_submenus');
		//print_r($sb_result);
		if(!empty($sb_result)){
			foreach($sb_result as $value ){
				$where_cond_m['submenu_id'] = $value->id;
				$where_cond_m['role_permission'] = $ap;
				//echo $value->id;
				$rp_result = $this->cbmodel->data_add('ckb_role_permission',$where_cond_m);
				$rp_result="with submenu";
			}
		}
		else{
			$where_cond_m['submenu_id'] = 0;
			$where_cond_m['role_permission'] = $ap;
			$rp_result = $this->cbmodel->data_add('ckb_role_permission',$where_cond_m);
			$rp_result="without submenu";
		}
			
	
 }
 $rp_result ="success";
	}
		
	



	//if( $rp_result){
		$result = array(
            "status" => "success",
			"permission"=>$ap,
        );
       echo json_encode($result);
	//}
		
 }
 public function submenu_all_permissions(){
	$role_id = $this->input->post('role_id');
	$menu_id = $this->input->post('menu_id');
	$ap = $this->input->post('ap');
	//echo $ap;
	
	//$submenu_result = $this->masters_model->get_table('ckb_submenus');
	$data['menu_id']= $this->input->post('menu_id');
	$sb_result = $this->cbmodel->verify_data($data,'ckb_submenus');
	$query = $this->db->get_where('ckb_submenu_permission', array('role_id' => $role_id,'menu_id' => $menu_id));
	$al_exist = $query->num_rows();
	//echo $al_exist;
	if($al_exist > 0){
		$data['role_permission']  = $ap;
		$up_result = $this->masters_model->menu_updates('ckb_submenu_permission', $data, $menu_id, $role_id);
	
		//echo $up_result;
	}
	else {
		foreach($sb_result as  $val ){
			$where_cond_m['role_id'] = $role_id;
			$where_cond_m['menu_id'] = $menu_id;
			$where_cond_m['submenu_id'] = $val->id;
			$where_cond_m['role_permission'] = $ap;
			$rp_result = $this->cbmodel->data_add('ckb_submenu_permission',$where_cond_m);
			
		}
   }
if($up_result || $rp_result){
	$result = array(
		"status" => "success",
		"permission"=>$ap,
	);
   echo json_encode($result);
}
	
}
 public function toggle_menus(){
	$role_id = $this->input->post('role_id');
	$ap = $this->input->post('ap');
	$menu_id = $this->input->post('menu_id');
	//echo $ap;
	$data['menu_id']= $this->input->post('menu_id');
	$sb_result = $this->cbmodel->verify_data($data,'ckb_submenus');

	$query = $this->db->get_where('ckb_role_permission', array('role_id' => $role_id ,'menu_id' => $menu_id));
	$menu_exist = $query->num_rows();
	//echo $menu_exist;
//	print_r($sb_result);
	if($menu_exist > 0){
		$role['role_permission']  = $ap;
		$rp_result = $this->masters_model->menu_updates('ckb_role_permission', $role, $menu_id, $role_id);
	
		//echo $up_result;
	}
	else if(!empty($sb_result)) {
		
			foreach($sb_result as  $val ){
			$where_cond_m['role_id'] = $role_id;
			$where_cond_m['menu_id'] = $menu_id;
			$where_cond_m['submenu_id'] = $val->id;
			$where_cond_m['role_permission'] = $ap;
			$rp_result = $this->cbmodel->data_add('ckb_role_permission',$where_cond_m);
			
		}
		$rp_result ="sub menu update";
		
   			}
			   else if(empty($sb_result)) {
				$where_cond_v['role_id'] = $role_id;
				$where_cond_v['menu_id'] = $menu_id;
				$where_cond_v['role_permission'] = $ap;
				$rp_result = $this->cbmodel->data_add('ckb_role_permission',$where_cond_v);
				$rp_result ="without submenu update";
			   }
					if($rp_result){
							$result = array(
								"status" => $rp_result,
								"permission"=>$ap,
								);
   						echo json_encode($result);
						}
	
}
public function toggle_submenus(){
	$role_id = $this->input->post('role_id');
	$ap = $this->input->post('ap');
	$menu_id = $this->input->post('menu_id');
	$submenu_id = $this->input->post('submenu_id');
	//echo $ap;
	$query = $this->db->get_where('ckb_role_permission', array('submenu_id' => $submenu_id ));
		$sb_exist = $query->num_rows();
	if($sb_exist >0){
		$data['role_permission']  = $ap;
		$up_result = $this->masters_model->submenu_updates('ckb_role_permission', $data, $menu_id, $role_id,$submenu_id);
	}
	else{
		$where_cond_m['role_id'] = $role_id;
		$where_cond_m['menu_id'] = $menu_id;
		$where_cond_m['role_permission'] = $ap;
		$where_cond_m['submenu_id'] = $submenu_id;
		$up_result = $this->cbmodel->data_add('ckb_role_permission',$where_cond_m);

	}
		//echo $up_result;
	
					if($up_result){
							$result = array(
								"status" => "success",
								"permission"=>$up_result,
								);
   						echo json_encode($result);
						}
	
}

		
	
	//For Aviary///////
	public function aviary(){
		$aviary = $this->masters_model->get_table('ckb_aviary');
		$data['last_id'] = $this->masters_model->get_table_last_row('ckb_aviary');
		$data['aviary'] = $aviary;
		$this->load->view('Masters/aviary' , $data);	
	}	
	public function raw_material(){
		$this->load->view('Masters/raw_material');	
	}	
	public function stock_register(){
		$data['stock'] = $this->masters_model->get_table('ckb_stock_register_upload');
		$this->load->view('Masters/stock_register',$data);	
	}	
	public function samples_collected(){
		$data['last_id'] = $this->masters_model->get_table_last_row('ckb_healthsetting_sample');
		$data['samples'] = $this->masters_model->get_table('ckb_healthsetting_sample');
		$this->load->view('Masters/healthcare_samples' , $data);	
	}	
	public function lab_diag(){
		$data['last_id'] = $this->masters_model->get_table_last_row('ckb_healthsetting_lab');
		$data['diag'] = $this->masters_model->get_table('ckb_healthsetting_lab');
		$this->load->view('Masters/healthcare_lab' , $data);	
	}	
	
	public function add_branch(){
	
		$get_cur_auto_id = $this->cbmodel->cur_auto_id('ckb_branch');
		if($get_cur_auto_id == "false"){
		   $auto_id="BR001";
		}
	   else{
	   $auto_id = "BR".str_pad( ( $get_cur_auto_id+1 ), 4, 0, STR_PAD_LEFT);
	   }
		$data['auto_id']   		=$auto_id;
		$data['branch_name']   	= $this->input->post('branch_name', TRUE);
		$data['created_by']   	= $this->input->post('created_by', TRUE);

		$this->masters_model->insert_data('ckb_branch', $data);
		$this->session->set_flashdata('message', ('Branch has been Added!'));
		redirect(base_url('index.php/Masters/branch'));


}
	
	
	
	
	public function add_roles(){
	
			$get_cur_auto_id = $this->cbmodel->cur_auto_id('ckb_roles');
			if($get_cur_auto_id == "false"){
			   $auto_id="R001";
			}
		   else{
		   $auto_id = "R".str_pad( ( $get_cur_auto_id+1 ), 4, 0, STR_PAD_LEFT);
		   }
			$data['auto_id']   		=$auto_id;
			$data['roles_name']   	= $this->input->post('role_name', TRUE);
			$data['roles_desc']   	= $this->input->post('roles_desc', TRUE);
			$data['created_by']   	= $this->input->post('created_by', TRUE);
			$data['status']  		= 1;

			$this->masters_model->insert_data('ckb_roles', $data);
			$this->session->set_flashdata('message', ('Roles has been Added!'));
			redirect(base_url('index.php/Masters/roles'));

	
}
	public function add_aviary(){
		$this->form_validation->set_rules('aviary_name', 'Aviary Name', 'required');
		
		if ($this->form_validation->run() == FALSE){
			//$pay = $this->masters_model->get_table('tbl_payroll');
			//$data['pay'] = $pay;
			//$this->load->view('admin/add_activity' , $data);
			 
		}else{

			$get_cur_auto_id = $this->cbmodel->cur_auto_id('ckb_aviary');
			if($get_cur_auto_id == "false"){
			   $auto_id="A001";
			}
		   else{
		   $auto_id = "A".str_pad( ( $get_cur_auto_id+1 ), 4, 0, STR_PAD_LEFT);
		   }
			$data['auto_id']   		= $auto_id;
			$data['aviary_name']   	= $this->input->post('aviary_name', TRUE);
			$data['created_by']   	= $this->input->post('created_by', TRUE);
			$data['status']  		= 1;
			$data['branch_id'] = $this->session->userdata('branch_id');

			$this->masters_model->insert_data('ckb_aviary', $data);
			$this->session->set_flashdata('message', ('Aviary has been Added!'));
			redirect(base_url('index.php/Masters/aviary'));

	}
		

	}
	public function edit_roles($param){
		if ($param == "update") {
			$update_id =  $this->input->post('r_id');
			$avi_info = $this->masters_model->get_table_row('ckb_roles', 'id', $update_id);
			
			//get the form values
			$data['roles_name']   	= $this->input->post('role_name', TRUE);
			$data['roles_desc']   	= $this->input->post('roles_desc', TRUE);
			//$data['status']  		= 1;
			
			$this->masters_model->updates('ckb_roles', $data, 'id', $update_id);
			
			$this->session->set_flashdata('message', ('Roles has been Updated!'));


			redirect(base_url('index.php/Masters/view_roles'));
		}
		

		$data['r_id'] = $this->masters_model->get_table_row('ckb_roles', 'id', $param);
		//echo "<pre>";print_r($data['avi_info']);exit;
		$this->load->view('Masters/edit_roles', $data);
	}
	public function edit_age(){
		$spc_id['spid'] = $this->input->get('val');
		$this->load->view('Masters/edit_age',$spc_id);
	}
	public function excel_display(){
		//$spc_id['spid'] = $this->input->get('val');
		$this->load->view('Masters/excel_display');
	}
	
	public function edit_aviary($param){
		
		if ($param == "update") {
			$update_id =  $this->input->post('a_id');
			$avi_info = $this->masters_model->get_table_row('ckb_aviary', 'id', $update_id);
			
			//get the form values
			$data['aviary_name']   	= $this->input->post('aviary_name', TRUE);
			$data['created_by'] = $this->session->userdata('user_id');
			$data['branch_id'] = $this->session->userdata('branch_id');
			
			$this->masters_model->updates('ckb_aviary', $data, 'id', $update_id);
			
			$this->session->set_flashdata('message', ('Aviary has been Updated!'));


			redirect(base_url('index.php/Masters/aviary'));
		}
		

		$data['avi_info'] = $this->masters_model->get_table_row('ckb_aviary', 'id', $param);
		//echo "<pre>";print_r($data['avi_info']);exit;
		$this->load->view('Masters/edit_aviary', $data);

	}
	public function edit_branch($param){
		
		if ($param == "update") {
			$update_id =  $this->input->post('br_id');
			$br_info = $this->masters_model->get_table_row('ckb_branch', 'id', $update_id);
			
			//get the form values
			$data['branch_name']   	= $this->input->post('branch_name', TRUE);
			//$data['status']  		= 1;
			
			$this->masters_model->updates('ckb_branch', $data, 'id', $update_id);
			
			$this->session->set_flashdata('message', ('Branch has been Updated!'));


			redirect(base_url('index.php/Masters/branch'));
		}
		

		$data['br_info'] = $this->masters_model->get_table_row('ckb_branch', 'id', $param);
		//echo "<pre>";print_r($data['avi_info']);exit;
		$this->load->view('Masters/edit_branch', $data);

	}
	public function inactive_role(){
		$avi_id  =   $this->input->post('inactive_id');
		$data['status'] = 0;
		$this->masters_model->updates('ckb_roles', $data, 'id', $avi_id);
		$this->session->set_flashdata('error', ('The Role Inactive successfully !'));
		
		}
		
		
		public function active_role(){
		$avi_id  =   $this->input->post('active_id');
		$data['status'] = 1;
		$this->masters_model->updates('ckb_roles', $data, 'id', $avi_id);
		$this->session->set_flashdata('message', ('The Role Active successfully !'));
		
		}
	
	public function inactive_aviary(){
		$avi_id  =   $this->input->post('inactive_id');
		$data['status'] = 0;
		$this->masters_model->updates('ckb_aviary', $data, 'id', $avi_id);
		$this->session->set_flashdata('error', ('The Aviary Inactive successfully !'));
		
		}
		
		
		public function active_aviary(){
		$avi_id  =   $this->input->post('active_id');
		$data['status'] = 1;
		$this->masters_model->updates('ckb_aviary', $data, 'id', $avi_id);
		$this->session->set_flashdata('message', ('The Aviary Active successfully !'));
		//redirect(base_url('employee/employee_list'));
		
		}
		public function inactive_weight(){
			$age  =   $this->input->post('inactive_id');
			$data['status'] = 0;
			$this->masters_model->updates('ckb_species_import', $data, 'id', $age);
			$this->session->set_flashdata('error', (' Inactive successfully !'));
			
			}
			
			
			public function active_weight(){
			$age  =   $this->input->post('active_id');
			$data['status'] = 1;
			$this->masters_model->updates('ckb_species_import', $data, 'id', $age);
			$this->session->set_flashdata('message', (' Active successfully !'));
			//redirect(base_url('employee/employee_list'));
			
			}
		
		
		//For Group///////
		public function group(){
		$group = $this->masters_model->get_table('ckb_group');
		$data['last_id'] = $this->masters_model->get_table_last_row('ckb_group');
		$data['group'] = $group;
		$this->load->view('Masters/group' , $data);	
	}
	
		public function add_group(){
		$this->form_validation->set_rules('group_name', 'Group Name', 'required');
		
		if ($this->form_validation->run() == FALSE){
			
			 
		}else{
			$get_cur_auto_id = $this->cbmodel->cur_auto_id('ckb_group');
			if($get_cur_auto_id == "false"){
			   $auto_id="G001";
			}
		   else{
		   $auto_id = "G".str_pad( ( $get_cur_auto_id+1 ), 4, 0, STR_PAD_LEFT);
		   }
			$data['auto_id']   		= $auto_id;
			$data['group_name']   	= $this->input->post('group_name', TRUE);
			$data['created_by']   	= $this->input->post('created_by', TRUE);
			$data['status']  		= 1;
			$data['branch_id'] = $this->session->userdata('branch_id');

			$this->masters_model->insert_data('ckb_group', $data);
			$this->session->set_flashdata('message', ('Group has been Added!'));
			redirect(base_url('index.php/Masters/group'));

		}
			
		}
		
		
		public function edit_group($param){
		
		if ($param == "update") {
			$update_id =  $this->input->post('g_id');
			$gro_info = $this->masters_model->get_table_row('ckb_group', 'id', $update_id);
			
			//get the form values
			$data['group_name']   	= $this->input->post('group_name', TRUE);
			$data['branch_id'] = $this->session->userdata('branch_id');
			//$data['status']  		= 1;
			
			$this->masters_model->updates('ckb_group', $data, 'id', $update_id);
			
			$this->session->set_flashdata('message', ('Group has been Updated!'));


			redirect(base_url('index.php/Masters/group'));
		}
		

		$data['gro_info'] = $this->masters_model->get_table_row('ckb_group', 'id', $param);
		$this->load->view('Masters/edit_group', $data);

	}
	
	
		public function inactive_group(){
		$gro_id  =   $this->input->post('inactive_id');
		$data['status'] = 0;
		$this->masters_model->updates('ckb_group', $data, 'id', $gro_id);
		$this->session->set_flashdata('error', ('The Group Inactive successfully !'));
		
		}
		
		
		public function active_group(){
		$gro_id  =   $this->input->post('active_id');
		$data['status'] = 1;
		$this->masters_model->updates('ckb_group', $data, 'id', $gro_id);
		$this->session->set_flashdata('message', ('The Group Active successfully !'));
		
		}
		
		
		
		//For Proven///////
		public function proven(){
		$proven = $this->masters_model->get_table('ckb_proven');
		$data['proven'] = $proven;
		$this->load->view('Masters/proven' , $data);	
	}
	
		public function add_proven(){
		$this->form_validation->set_rules('title', 'Title', 'required');
		
		if ($this->form_validation->run() == FALSE){
			
			 
		}else{
			$data['title']   		= $this->input->post('title', TRUE);
			$data['created_by']   	= $this->input->post('created_by', TRUE);
			$data['status']  		= 1;
			$data['branch_id'] = $this->session->userdata('branch_id');

			$this->masters_model->insert_data('ckb_proven', $data);
			$this->session->set_flashdata('message', ('Proven has been Added!'));
			redirect(base_url('index.php/Masters/proven'));

		}
			
		}
		
		
		public function edit_proven($param){
		
		if ($param == "update") {
			$update_id =  $this->input->post('p_id');
			$pro_info = $this->masters_model->get_table_row('ckb_proven', 'id', $update_id);
			
			//get the form values
			$data['title']   	= $this->input->post('title', TRUE);
			$data['branch_id'] = $this->session->userdata('branch_id');
			//$data['status']  		= 1;
			
			$this->masters_model->updates('ckb_proven', $data, 'id', $update_id);
			
			$this->session->set_flashdata('message', ('Proven has been Updated!'));


			redirect(base_url('index.php/Masters/proven'));
		}
		

		$data['pro_info'] = $this->masters_model->get_table_row('ckb_proven', 'id', $param);
		$this->load->view('Masters/edit_proven', $data);

	}
	
	
		public function inactive_proven(){
		$pro_id  =   $this->input->post('inactive_id');
		$data['status'] = 0;
		$this->masters_model->updates('ckb_proven', $data, 'id', $pro_id);
		$this->session->set_flashdata('error', ('The Proven Inactive successfully !'));
		
		}
		
		
		public function active_proven(){
		$pro_id  =   $this->input->post('active_id');
		$data['status'] = 1;
		$this->masters_model->updates('ckb_proven', $data, 'id', $pro_id);
		$this->session->set_flashdata('message', ('The Proven Active successfully !'));
		
		}
		public function delete_row_byid(){

			$where_cond_bed['id'] = $this->input->post('row_id');
			$table_name  = $this->input->post('table');
	
			$delete_result = $this->cbmodel->delete_data($table_name,$where_cond_bed);
			$response ="success";
			//if($delete_result){
			echo json_encode($response);
			//}

		}
		public function delete_species_all(){
			$where_cond_bed['branch_id'] = $this->session->userdata('branch_id');
			$table_name  = $this->input->post('table');
			$delete_result = $this->cbmodel->delete_data($table_name,$where_cond_bed);
			$response ="success";
		
			echo json_encode($response);
		}	
		
		public function update_bird_status(){
           
			//$branch_id = $this->session->userdata('branch_id');
			//$where_cond_h['status'] = '1';
			$where_cond_h['branch_id'] =$this->session->userdata('branch_id');
			//$bird_status_result = $this->cbmodel->updates('ckb_bird', $where_cond_h, 'branch_id', $branch_id);
			$delete_result = $this->cbmodel->delete_data('ckb_bird',$where_cond_h);
	
			$response ="success";
		
			echo json_encode($response);
				
		
		}
		//For Species///////
	public function species(){
		$data['species'] = $this->masters_model->get_table('ckb_species');
		$data['group'] = $this->masters_model->get_table('ckb_group');
		$data['last_id'] = $this->masters_model->get_table_last_row('ckb_species');
		$data['species_join_group'] = $this->masters_model->get_table_join2('ckb_species','ckb_group');
		$this->load->view('Masters/species' , $data);	
	}	
	
	
	public function add_species(){
		$this->form_validation->set_rules('bird_species', 'species Name', 'required');
		
		if ($this->form_validation->run() == FALSE){
			
			 
		}else{
			$get_cur_auto_id = $this->cbmodel->cur_auto_id('ckb_species');
			if($get_cur_auto_id == "false"){
			   $auto_id="S001";
			}
		   else{
		   $auto_id = "S".str_pad( ( $get_cur_auto_id+1 ), 4, 0, STR_PAD_LEFT);
		   }
			$data['auto_id']   		= $auto_id;
			$data['group_id']   	= $this->input->post('group_id', TRUE);
			$data['bird_species']  	= $this->input->post('bird_species', TRUE);
			$data['days_brooder']  	= $this->input->post('days_brooder', TRUE);
			$data['weight_loss_min']  	= $this->input->post('weight_loss_min', TRUE);
			$data['weight_loss_max']  	= $this->input->post('weight_loss_max', TRUE);
			$data['incub_days_min']  	= $this->input->post('incub_days_min', TRUE);
			$data['incub_days_max']  	= $this->input->post('incub_days_max', TRUE);
			$data['target_mrg_feed']  	= $this->input->post('mrng_feed', TRUE);
			$data['target_aft_feed']  	= $this->input->post('aft_feed', TRUE);
			$data['std_egg_weight']  	= $this->input->post('std_egg_weight', TRUE);
			$data['std_hatch_weight']  	= $this->input->post('std_hatch_weight', TRUE);
		
			$data['created_by']   	= $this->input->post('created_by', TRUE);
			$data['status']  		= 1;
			$data['branch_id'] = $this->session->userdata('branch_id');

			$this->masters_model->insert_data('ckb_species', $data);
			$this->session->set_flashdata('message', ('Species has been Added!'));
			redirect(base_url('index.php/Masters/species'));

	}
		

	}
	
	
	
	public function edit_species($param){
		
		if ($param == "update") {
			$update_id =  $this->input->post('s_id');
			$spe_info = $this->masters_model->get_table_row('ckb_species', 'id', $update_id);
			
			//get the form values
			$data['group_id']   		= $this->input->post('group_id', TRUE);
			$data['bird_species']   	= $this->input->post('bird_species', TRUE);
			$data['days_brooder']   	= $this->input->post('days_brooder', TRUE);
			$data['weight_loss_min']  	= $this->input->post('weight_loss_min', TRUE);
			$data['weight_loss_max']  	= $this->input->post('weight_loss_max', TRUE);
			$data['incub_days_min']  	= $this->input->post('incub_days_min', TRUE);
			$data['incub_days_max']  	= $this->input->post('incub_days_max', TRUE);
			$data['target_mrg_feed']  	= $this->input->post('mrng_feed', TRUE);
			$data['target_aft_feed']  	= $this->input->post('aft_feed', TRUE);
			$data['std_egg_weight']  	= $this->input->post('std_egg_weight', TRUE);
			$data['std_hatch_weight']  	= $this->input->post('std_hatch_weight', TRUE);
			$data['branch_id'] = $this->session->userdata('branch_id');
			//$data['status']  		= 1;
			
			$this->masters_model->updates('ckb_species', $data, 'id', $update_id);
			
			$this->session->set_flashdata('message', ('Species has been Updated!'));


			redirect(base_url('index.php/Masters/species'));
		}
		
		$data['group'] = $this->masters_model->get_table('ckb_group');
		$data['spe_info'] = $this->masters_model->get_table_row('ckb_species', 'id', $param);
		$this->load->view('Masters/edit_species', $data);

	}

	
	public function edit_weight($param){
		
		if ($param == "update") {
			$update_id =  $this->input->post('age_id');
			$spe_info = $this->masters_model->get_table_row('ckb_species_import', 'id', $update_id);
			
			//get the form values
			$data['age']   		= $this->input->post('age', TRUE);
			$data['std_weight']   	= $this->input->post('std_weight', TRUE);
			
			//$data['status']  		= 1;
			
			$this->masters_model->updates('ckb_species_import', $data, 'id', $update_id);
			
			$this->session->set_flashdata('message', ('Species age and weight has been Updated!'));


			redirect(base_url('index.php/Masters/species'));
		}
		
		$data['spc_info'] = $this->masters_model->get_table_row('ckb_species_import', 'id', $param);
		//echo "<pre>";print_r($data['avi_info']);exit;
	//	$this->load->view('masters/edit_brooder', $data);
		$this->load->view('Masters/edit_age', $data);

	}
	
	
	
	public function inactive_species(){
		$spe_id  =   $this->input->post('inactive_id');
		$data['status'] = 0;
		$this->masters_model->updates('ckb_species', $data, 'id', $spe_id);
		$this->session->set_flashdata('error', ('The Species Inactive successfully !'));
		
		}
		
		
		public function active_species(){
		$spe_id  =   $this->input->post('active_id');
		$data['status'] = 1;
		$this->masters_model->updates('ckb_species', $data, 'id', $spe_id);
		$this->session->set_flashdata('message', ('The Species Active successfully !'));
		
		}
		
		
		//For Cage///////
	public function cage(){
		$data['cage'] = $this->masters_model->get_table('ckb_cage');
		$data['aviary'] = $this->masters_model->get_table('ckb_aviary');
		$data['last_id'] = $this->masters_model->get_table_last_row('ckb_cage');
		$data['cage_join_aviary'] = $this->masters_model->get_table_join('ckb_cage','ckb_aviary');
		$this->load->view('Masters/cage' , $data);	
	}	
	
	
	public function add_cage(){
		$this->form_validation->set_rules('cage', 'Cage', 'required');
		
		if ($this->form_validation->run() == FALSE){
			
			 
		}else{
			$get_cur_auto_id = $this->cbmodel->cur_auto_id('ckb_cage');
			if($get_cur_auto_id == "false"){
			   $auto_id="C001";
			}
		   else{
		   $auto_id = "C".str_pad( ( $get_cur_auto_id+1 ), 4, 0, STR_PAD_LEFT);
		   }
			$data['auto_id']   		=  $auto_id;
			$data['aviary_id']   	= $this->input->post('aviary_id', TRUE);
			$data['cage']  			= $this->input->post('cage', TRUE);
			//$data['no_of_birds']  	= $this->input->post('no_of_birds', TRUE);
			$data['created_by']   	= $this->input->post('created_by', TRUE);
			$data['status']  		= 1;
			$data['branch_id'] = $this->session->userdata('branch_id');
			$data['target_mrg_feed']  	= $this->input->post('mrng_feed', TRUE);
			$data['target_aft_feed']  	= $this->input->post('aft_feed', TRUE);
			$data['diet_pattern']  	= $this->input->post('diet', TRUE);


			$this->masters_model->insert_data('ckb_cage', $data);
			$this->session->set_flashdata('message', ('Cage has been Added!'));
			redirect(base_url('index.php/Masters/cage'));

	}
		

	}
	
	
	
	public function edit_cage($param){
		
		if ($param == "update") {
			$update_id =  $this->input->post('c_id');
			$cag_info = $this->masters_model->get_table_row('ckb_cage', 'id', $update_id);
			
			//get the form values
			$data['aviary_id']   	= $this->input->post('aviary_id', TRUE);
			$data['cage']  			= $this->input->post('cage', TRUE);
			$data['branch_id'] = $this->session->userdata('branch_id');
			//$data['no_of_birds']  	= $this->input->post('no_of_birds', TRUE);
			//$data['status']  		= 1;
			$data['target_mrg_feed']  	= $this->input->post('mrng_feed', TRUE);
			$data['target_aft_feed']  	= $this->input->post('aft_feed', TRUE);
			$data['diet_pattern']  	= $this->input->post('diet', TRUE);
			$this->masters_model->updates('ckb_cage', $data, 'id', $update_id);
			
			$this->session->set_flashdata('message', ('Cage has been Updated!'));


			redirect(base_url('index.php/Masters/cage'));
		}
		
		$data['aviary'] = $this->masters_model->get_table('ckb_aviary');
		$data['cag_info'] = $this->masters_model->get_table_row('ckb_cage', 'id', $param);
		$this->load->view('Masters/edit_cage', $data);

	}
	
	
	
	public function inactive_cage(){
		$cag_id  =   $this->input->post('inactive_id');
		$data['status'] = 0;
		$this->masters_model->updates('ckb_cage', $data, 'id', $cag_id);
		$this->session->set_flashdata('error', ('The Cage Inactive successfully !'));
		
		}
		
		
		public function active_cage(){
		$cag_id  =   $this->input->post('active_id');
		$data['status'] = 1;
		$this->masters_model->updates('ckb_cage', $data, 'id', $cag_id);
		$this->session->set_flashdata('message', ('The Cage Active successfully !'));
		
		}
	//work on durga
//add beooder
			public function brooder(){
		$brooder = $this->masters_model->get_table('ckb_brooder');
		$data['last_id'] = $this->masters_model->get_table_last_row('ckb_brooder');
		$data['brooder'] = $brooder;
		$this->load->view('Masters/brooder' , $data);	
	}	
	public function add_brooder(){
		$this->form_validation->set_rules('brooder_name', 'Brooder Name', 'required');
		
		if ($this->form_validation->run() == FALSE){
			//$pay = $this->masters_model->get_table('tbl_payroll');
			//$data['pay'] = $pay;
			//$this->load->view('admin/add_activity' , $data);
			 
		}else{
			$get_cur_auto_id = $this->cbmodel->cur_auto_id('ckb_brooder');
			if($get_cur_auto_id == "false"){
			   $auto_id="B001";
			}
		   else{
		   $auto_id = "B".str_pad( ( $get_cur_auto_id+1 ), 4, 0, STR_PAD_LEFT);
		   }
			$data['auto_id']   		= $auto_id;
		//	$data['auto_id']   		= $this->input->post('auto_id', TRUE);
			$data['brooder_name']   	= $this->input->post('brooder_name', TRUE);
			$data['target_feed']  	= $this->input->post('target_feed', TRUE);
			$data['created_by']   	= $this->input->post('created_by', TRUE);
			$data['status']  		= 1;
			$data['branch_id'] = $this->session->userdata('branch_id');

			$this->masters_model->insert_data('ckb_brooder', $data);
			$this->session->set_flashdata('message', ('Brooder has been Added!'));
			redirect(base_url('index.php/Masters/brooder'));

	}
		

	}
	public function edit_brooder($param){
		
		if ($param == "update") {
			$update_id =  $this->input->post('a_id');
			$broo_info = $this->masters_model->get_table_row('ckb_brooder', 'id', $update_id);
			
			//get the form values
			$data['brooder_name']   	= $this->input->post('brooder_name', TRUE);
			$data['target_feed']   	= $this->input->post('target_feed', TRUE);
			$data['branch_id'] = $this->session->userdata('branch_id');
			//$data['status']  		= 1;
			
			$this->masters_model->updates('ckb_brooder', $data, 'id', $update_id);
			
			$this->session->set_flashdata('message', ('Brooder has been Updated!'));


			redirect(base_url('index.php/Masters/brooder'));
		}
		

		$data['broo_info'] = $this->masters_model->get_table_row('ckb_brooder', 'id', $param);
		//echo "<pre>";print_r($data['avi_info']);exit;
		$this->load->view('Masters/edit_brooder', $data);

	}
	public function inactive_brooder(){
		$broo_id  =   $this->input->post('inactive_id');
		$data['status'] = 0;
		$this->masters_model->updates('ckb_brooder', $data, 'id', $broo_id);
		$this->session->set_flashdata('error', ('The Brooder Inactive successfully !'));
		
		}
		
		
		public function active_brooder(){
		$broo_id  =   $this->input->post('active_id');
		$data['status'] = 1;
		$this->masters_model->updates('ckb_brooder', $data, 'id', $broo_id);
		$this->session->set_flashdata('message', ('The Brooder Active successfully !'));
		//redirect(base_url('employee/employee_list'));
		
		}
		public function inactive_branch(){
			$br_id  =   $this->input->post('inactive_id');
			$data['status'] = 0;
			$this->masters_model->updates('ckb_branch', $data, 'id', $br_id);
			$this->session->set_flashdata('error', ('The Branch Inactive successfully !'));
			
			}
			
			
			public function active_branch(){
			$br_id  =   $this->input->post('active_id');
			$data['status'] = 1;
			$this->masters_model->updates('ckb_branch', $data, 'id', $br_id);
			$this->session->set_flashdata('message', ('The Branch Active successfully !'));
			//redirect(base_url('employee/employee_list'));
			
			}


		//add incubation


	public function incubation(){
		$incubation = $this->masters_model->get_table('ckb_addincubation');
		$data['last_id'] = $this->masters_model->get_table_last_row('ckb_addincubation');
		$data['incubation'] = $incubation;
		$this->load->view('Masters/incubation' , $data);	
	}
	public function add_incubation(){
		$this->form_validation->set_rules('incubation_name', 'Incubation Name', 'required');
		
		if ($this->form_validation->run() == FALSE){
			//$pay = $this->masters_model->get_table('tbl_payroll');
			//$data['pay'] = $pay;
			//$this->load->view('admin/add_activity' , $data);
			 
		}else{
			$get_cur_auto_id = $this->cbmodel->cur_auto_id('ckb_addincubation');
			if($get_cur_auto_id == "false"){
			   $auto_id="II001";
			}
		   else{
		   $auto_id = "II".str_pad( ( $get_cur_auto_id+1 ), 4, 0, STR_PAD_LEFT);
		   }
			$data['auto_id']   		= $auto_id;
			$data['incubation_name']   	= $this->input->post('incubation_name', TRUE);
			$data['created_by']   	= $this->input->post('created_by', TRUE);
			$data['status']  		= 1;
			$data['branch_id'] = $this->session->userdata('branch_id');

			$this->masters_model->insert_data('ckb_addincubation', $data);
			$this->session->set_flashdata('message', ('Incubation has been Added!'));
			redirect(base_url('index.php/Masters/incubation'));

	}
		
	}
	public function edit_incubation($param){
		
		if ($param == "update") {
			$update_id =  $this->input->post('a_id');
			$incu_info = $this->masters_model->get_table_row('ckb_addincubation', 'id', $update_id);
			
			//get the form values
			$data['incubation_name']   	= $this->input->post('incubation_name', TRUE);
			$data['branch_id'] = $this->session->userdata('branch_id');
			//$data['status']  		= 1;
			
			$this->masters_model->updates('ckb_addincubation', $data, 'id', $update_id);
			
			$this->session->set_flashdata('message', ('Incubation Details has been Updated!'));


			redirect(base_url('index.php/Masters/incubation'));
		}
		

		$data['incu_info'] = $this->masters_model->get_table_row('ckb_addincubation', 'id', $param);
		//echo "<pre>";print_r($data['avi_info']);exit;
		$this->load->view('Masters/edit_incubation', $data);

	}
	public function inactive_incubation(){
		$incu_id  =   $this->input->post('inactive_id');
		$data['status'] = 0;
		$this->masters_model->updates('ckb_addincubation', $data, 'id', $incu_id);
		$this->session->set_flashdata('error', ('The Incubation Inactive successfully !'));
		
		}
		
		
		public function active_incubation(){
		$incu_id  =   $this->input->post('active_id');
		$data['status'] = 1;
		$this->masters_model->updates('ckb_addincubation', $data, 'id', $incu_id);
		$this->session->set_flashdata('message', ('The Incubation Active successfully !'));
		//redirect(base_url('employee/employee_list'));
		
		}
		public function add_employe(){
	
			
			$data['user_id']   		= $this->input->post('employe_id', TRUE);
			$data['user_name']   	= $this->input->post('employe_name', TRUE);
			$data['user_pass']   	= md5('123456');
			$data['role_id']   	= $this->input->post('emp_roles', TRUE);

			$where_role['auto_id']   	= $this->input->post('emp_roles', TRUE);
			$roles_result = $this->cbmodel->verify_data($where_role,'ckb_roles');
       		 $role_name = $roles_result[0]->roles_name;
				
			$data['role_type']   	= $role_name;
			$data['created_by']   	= $this->input->post('created_by', TRUE);
			$data['status']  		= 1;
			$data['branch_id']  	= $this->input->post('emp_branch', TRUE);
			$where_branch['auto_id']   	= $this->input->post('emp_branch', TRUE);
			$branch_result = $this->cbmodel->verify_data($where_branch,'ckb_branch');
       	//	print_r($branch_result);
			$branch_name = $branch_result[0]->branch_name;
			$data['branch_name']  	= $branch_name;

			$check_user_exist = $this->db->get_where('ckb_users',array('user_id'=>$data['user_id']));
			$al_exist = $check_user_exist->num_rows();
			//echo $al_exist;
			//exit;
			if($al_exist == 0){
	
		
			$this->masters_model->insert_data('ckb_users', $data);
			$this->session->set_flashdata('message', ('Employee has been Added!'));
}
else{
	$this->session->set_flashdata('error', ('Employee ID Already Exist !'));	
}
			redirect(base_url('index.php/Masters/employe'));


	
}
public function edit_employe($param){
	if ($param == "update") {
		$update_id =  $this->input->post('r_id');
		$avi_info = $this->masters_model->get_table_row('ckb_users', 'id', $update_id);
		
		//get the form values
		$data['user_id']   		= $this->input->post('employe_id', TRUE);
		$data['user_name']   	= $this->input->post('employe_name', TRUE);
		$data['role_id']   	= $this->input->post('emp_roles', TRUE);

			$where_role['auto_id']   	= $this->input->post('emp_roles', TRUE);
			$roles_result = $this->cbmodel->verify_data($where_role,'ckb_roles');
       		 $role_name = $roles_result[0]->roles_name;
				
		$data['role_type']   	= $role_name;

		$data['branch_id']   	= $this->input->post('branch_id', TRUE);

			$where_b['auto_id']   	= $this->input->post('branch_id', TRUE);
			$branch_result = $this->cbmodel->verify_data($where_b,'ckb_branch');
       		 $branch_name = $branch_result[0]->branch_name;
				
		$data['branch_name']   	= $branch_name;
		
		$this->masters_model->updates('ckb_users', $data, 'id', $update_id);
		
		$this->session->set_flashdata('message', ('Employee Detail has been Updated!'));


		redirect(base_url('index.php/Masters/employe'));
	}
	

	$data['r_id'] = $this->masters_model->get_table_row('ckb_users', 'id', $param);
	//echo "<pre>";print_r($data['avi_info']);exit;
	$this->load->view('Masters/edit_employe', $data);
}
public function inactive_employe(){
	$incu_id  =   $this->input->post('inactive_id');
	$data['status'] = 0;
	$this->masters_model->updates('ckb_users', $data, 'id', $incu_id);
	$this->session->set_flashdata('error', ('The Employee Inactive successfully !'));
	
	}
	
	
	public function active_employe(){
	$incu_id  =   $this->input->post('active_id');
	$data['status'] = 1;
	$this->masters_model->updates('ckb_users', $data, 'id', $incu_id);
	$this->session->set_flashdata('message', ('The Employee Active successfully !'));
	//redirect(base_url('employee/employee_list'));
	
	}

	}	//end class
