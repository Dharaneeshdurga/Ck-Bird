<?php	
defined('BASEPATH') OR exit('No direct script access allowed');	
class Incubation extends CI_Controller {	
	
	public function __construct()	
    {	
        parent::__construct();	
        $this->load->helper(array(	
            'form',	
            'utility_helper',
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
        $this->load->model('Incubation_model', 'imodel');

		if ( !$this->session->userdata('logged_in')){ 	
			redirect(base_url(), 'refresh');	
				
        }	
        	
    }	

    public function incubation(){
		$this->load->view('Incubation/incubation');	
	}
    public function incubation_history(){
        $date=$this->input->post('date');
        $to_date=$this->input->post('to_date');
        $data['incub_history'] = $this->imodel->get_incubation_history_dt($date,$to_date);
        $data['stunded'] = $this->imodel->get_stunded_byBirth($date,$to_date);
        $data['from_date']=$date;
        $data['to_date']=$to_date;
		$this->load->view('Incubation/incubation_history',$data);	
	}
    public function incubation_history_view_gt(){
        $date = $this->input->post('from_date');
        $to_date=$this->input->post('to_date');
        $datawhere = $this->input->post('type');
        if($datawhere == "all"){
            $array_data ="";
          }
        if($datawhere == "assist"){
        $array_data['fertile_type']="Fertile";
        $array_data['hatch_type']="Assist";
      }
      if($datawhere == "normal"){
        $array_data['fertile_type']="Fertile";
        $array_data['hatch_type']="Normal";
      }
      if($datawhere == "infertile"){
        $array_data['fertile_type']="In Fertile";
      }
      if($datawhere == "dis"){
        $array_data['fertile_type']="Dis";
      }
	  if($datawhere == "crack"){
        $array_data['fertile_type']="Crack";
      }
	  if($datawhere == "broken"){
        $array_data['fertile_type']="Broken";
      }
	  if($datawhere == "healthy"){
        $array_data['health_status']="Healthy chick";
      }
	  if($datawhere == "low_weight_chick"){
        $array_data['health_status']="Low hatch weight chick";
      } 
	  if($datawhere == "yolk_sac"){
        $array_data['health_status']="Unabsorbed yolk sac";
      }
	  if($datawhere == "yolk_sac_infection"){
        $array_data['health_status']="Yolk sac infection chick";
      }
	  if($datawhere == "wry_neck"){
        $array_data['health_status']="Wry neck chick";
      }
	  if($datawhere == "unknown"){
        $array_data['fertile_type']="Unknown";
      }
	  if($datawhere == "splay_leg"){
        $array_data['health_status']="Splayed leg chick";
      }
    //  echo $datawhere;
		$postData = $this->input->post();
     	$incub_history_view_result = $this->imodel->get_incubation_historyView_dt($postData,$array_data,$date,$to_date);
              
	  echo json_encode($incub_history_view_result);
       // $this->load->view('Incubation/incubation_history_view',$data);	
	}

	public function incubation_history_view(){
		$this->load->view('Incubation/incubation_history_view');	
	}
    public function add_incubation_details(){
		$this->load->view('Incubation/add_incubation_details');	
	}	
    public function view_weight_loss(){
		$this->load->view('Incubation/view_weight_loss');	
	}	

    public function addIncubation(){
        $get_cur_auto_id = $this->cbmodel->cur_auto_id('ckb_incubation');
		$auto_id = "I".str_pad( ( $get_cur_auto_id+1 ), 4, 0, STR_PAD_LEFT);

        $where_cond_b['auto_id'] = $auto_id;
        $where_cond_b['branch_id'] = $this->session->userdata('branch_id');
        $where_cond_b['group_id'] = $this->input->post('bird_group');
        $where_cond_b['species_id'] = $this->input->post('bird_species');
        $where_cond_b['aviary_id'] = $this->input->post('aviary_id');
        $where_cond_b['cage'] = $this->input->post('cage');
        $where_cond_b['male_parent_ringno'] = $this->input->post('male_parent_rno');
        $where_cond_b['female_parent_ringno'] = $this->input->post('female_parent_rno');
        $where_cond_b['egg_no'] = $this->input->post('egg_no');
       // $where_cond_b['egg_laid'] = $this->input->post('egg_laid_date');
        $where_cond_b['fertile_type'] = $this->input->post('fertile_type');
        $where_cond_b['doi'] = $this->input->post('doi');
        $where_cond_b['dof'] = $this->input->post('dof');
        $where_cond_b['egg_weight'] = $this->input->post('egg_weight');
        $where_cond_b['remark'] = $this->input->post('remark');
        $where_cond_b['pip_weight'] = $this->input->post('pip_weight');
        $where_cond_b['shell_weight'] = $this->input->post('shell_weight');
        $where_cond_b['pip_date'] = $this->input->post('pip_date');
        $where_cond_b['hatch_type'] = $this->input->post('hatch_type');
        $where_cond_b['hatch_weight'] = $this->input->post('hatch_weight');
        $where_cond_b['shell_thick'] = $this->input->post('shell_thick');
        $where_cond_b['hatch_date'] = $this->input->post('hatch_date');
        $where_cond_b['dis_type'] = $this->input->post('dis_type');
        $where_cond_b['dis_date'] = $this->input->post('dis_date');
        $where_cond_b['pip_weight'] = $this->input->post('pip_weight');
        $where_cond_b['created_by'] = $this->session->userdata('user_id');
        
//new added
		$where_cond_b['egg_length'] = $this->input->post('egg_length');
		$where_cond_b['egg_breadth'] = $this->input->post('egg_breadth');
		if($where_cond_b['egg_length'] != "" && $where_cond_b['egg_breadth'] != ""  ){
			$egg_index = ($where_cond_b['egg_breadth'] / $where_cond_b['egg_length'])*100 ;
			$where_cond_b['egg_index'] = number_format($egg_index,2);
		}
		$where_cond_b['shell_layer'] = $this->input->post('shell_layer');
		$where_cond_b['hatch_time'] = $this->input->post('hatch_time');
		$where_cond_b['moved_time'] = $this->input->post('moved_time');
		$where_cond_b['bos_date'] = $this->input->post('date_bos');
		$where_cond_b['bos_findings'] = $this->input->post('bos_findings');
		$where_cond_b['dis_weight'] = $this->input->post('dis_weight');
		$where_cond_b['incubator'] = $this->input->post('incubator');
	if($where_cond_b['egg_weight'] !="" &&  $where_cond_b['pip_weight']!=="" ){
		$lay_pip_weight = ($where_cond_b['egg_weight'] - $where_cond_b['pip_weight'])/$where_cond_b['egg_weight'];
		$where_cond_b['lay_pip_weight'] = number_format($lay_pip_weight,2).'%';
	}
		
	$where_cond_b['clutch_no'] = $this->input->post('clutch_no');
	 $where_cond_b['egg_no_clutch'] = $this->input->post('egg_no_clutch');


        $incub_result = $this->cbmodel->data_add('ckb_incubation',$where_cond_b);

        
        if($incub_result){
            $result = array(
                "logstatus" => "success",
                "url" => "Incubation/incubation"
            );
            echo json_encode($result);
    
        }
    }

    public function get_incubation_list(){
        $postData = $this->input->post();
		$incubation_result = $this->cbmodel->verify_data_incubation_dt($postData);

        echo json_encode($incubation_result);
    }
    public function get_incubdetails_list(){
        $postData = $this->input->post();
        $postData1 = $this->input->post('weightloss_id');
		$weightloss_result = $this->cbmodel->verify_data_incubdetails_dt($postData,$postData1);

        echo json_encode($weightloss_result);
    }

    public function get_ringno_fcage(){

        $where_cond_bed['cage_id'] = $this->input->post('cage');
        $where_cond_bed['aviary_id'] = $this->input->post('aviary_id');
        $where_cond_bed['branch_id'] = $this->session->userdata('branch_id');
		$get_ringno_details_result = $this->cbmodel->verify_data($where_cond_bed,'ckb_bird');

        echo json_encode($get_ringno_details_result);
    }

    public function edit_incubation_details(){
		$this->load->view('Incubation/edit_incubation_details');	
	}
    public function egg_no_check(){
        $egg_no = $this->input->post('egg_no');
        $query = $this->db->get_where('ckb_incubation', array('egg_no' => $egg_no ));
        $count = $query->num_rows();
        echo ($count);
    }
    public function getincubedit_details(){

        $where_cond_bed['auto_id'] = $this->input->post('current_incubid');
        $where_cond_bed['branch_id'] = $this->session->userdata('branch_id');
		$getincubedit_details_result = $this->cbmodel->verify_data($where_cond_bed,'ckb_incubation');

        echo json_encode($getincubedit_details_result);
    }

    public function editIncubation(){
        
        $auto_id = $this->input->post('auto_id');
        $where_cond_b['branch_id'] = $this->session->userdata('branch_id');
        $where_cond_b['group_id'] = $this->input->post('bird_group');
        $where_cond_b['species_id'] = $this->input->post('bird_species');
        $where_cond_b['aviary_id'] = $this->input->post('aviary_id');
        $where_cond_b['cage'] = $this->input->post('cage');
        $where_cond_b['male_parent_ringno'] = $this->input->post('male_parent_rno');
        $where_cond_b['female_parent_ringno'] = $this->input->post('female_parent_rno');
        $where_cond_b['egg_no'] = $this->input->post('egg_no');
      //  $where_cond_b['egg_laid'] = $this->input->post('egg_laid_date');
        $where_cond_b['fertile_type'] = $this->input->post('fertile_type');
        $where_cond_b['doi'] = $this->input->post('doi');
        $where_cond_b['dof'] = $this->input->post('dof');
        $where_cond_b['egg_weight'] = $this->input->post('egg_weight');
        $where_cond_b['remark'] = $this->input->post('remark');
        $where_cond_b['pip_weight'] = $this->input->post('pip_weight');
        $where_cond_b['shell_weight'] = $this->input->post('shell_weight');
        $where_cond_b['pip_date'] = $this->input->post('pip_date');
        $where_cond_b['hatch_type'] = $this->input->post('hatch_type');
        $where_cond_b['hatch_weight'] = $this->input->post('hatch_weight');
        $where_cond_b['shell_thick'] = $this->input->post('shell_thick');
        $where_cond_b['hatch_date'] = $this->input->post('hatch_date');
        $where_cond_b['dis_type'] = $this->input->post('dis_type');
        $where_cond_b['dis_date'] = $this->input->post('dis_date');
        $where_cond_b['pip_weight'] = $this->input->post('pip_weight');
        $where_cond_b['created_by'] = $this->session->userdata('user_id');

//new added
$where_cond_b['egg_length'] = $this->input->post('egg_length');
$where_cond_b['egg_breadth'] = $this->input->post('egg_breadth');
if($where_cond_b['egg_length'] != "" && $where_cond_b['egg_breadth'] != ""  ){
	$egg_index = ($where_cond_b['egg_length']/$where_cond_b['egg_breadth'])*100 ;
	$where_cond_b['egg_index'] = number_format($egg_index,2);
}
else{
	$where_cond_b['egg_index'] = "0";
}
$where_cond_b['shell_layer'] = $this->input->post('shell_layer');
$where_cond_b['hatch_time'] = $this->input->post('hatch_time');
$where_cond_b['moved_time'] = $this->input->post('moved_time');
$where_cond_b['bos_date'] = $this->input->post('date_bos');
$where_cond_b['bos_findings'] = $this->input->post('bos_findings');
$where_cond_b['dis_weight'] = $this->input->post('dis_weight');
$where_cond_b['incubator'] = $this->input->post('incubator');
if($where_cond_b['egg_weight'] !="" &&  $where_cond_b['pip_weight']!=="" ){
$lay_pip_weight = ($where_cond_b['egg_weight'] - $where_cond_b['pip_weight'])/$where_cond_b['egg_weight'];
$where_cond_b['lay_pip_weight'] = number_format($lay_pip_weight,2).'%';
}
else{
	$where_cond_b['lay_pip_weight'] = "0";
}
$where_cond_b['clutch_no'] = $this->input->post('clutch_no');
	 $where_cond_b['egg_no_clutch'] = $this->input->post('egg_no_clutch');

		$incub_result = $this->cbmodel->updates('ckb_incubation', $where_cond_b, 'auto_id', $auto_id);
        
        if($incub_result){
            $result = array(
                "logstatus" => "success",
                "url" => "Incubation/incubation"
            );
            echo json_encode($result);
    
        }
    }

    public function delete_incubation(){

        $where_cond_bed['auto_id'] = $this->input->post('incub_row_id');

        $delete_incub_result = $this->cbmodel->delete_data('ckb_incubation',$where_cond_bed);

        $response = "success";
        echo json_encode($response);
    }

    public function weight_loss(){
		$this->load->view('Incubation/weight_loss');	
    }

    public function add_weight_loss(){
		$this->load->view('Incubation/add_weight_loss');	
    }

    public function getincubedit_details_wl(){

        $where_cond_bed['ci.auto_id'] = $this->input->post('current_incubid');
        $where_cond_bed['ci.branch_id'] = $this->session->userdata('branch_id');
		$getincubedit_details_result = $this->imodel->verify_data_wl($where_cond_bed);

        echo json_encode($getincubedit_details_result);
    }
    public function getage(){

        $where_cond_bed['ci.auto_id'] = $this->input->post('current_incubid');
        $where_cond_bed['ci.branch_id'] = $this->session->userdata('branch_id');
		$getincubedit_details_result = $this->imodel->verify_data_wl($where_cond_bed);

        echo json_encode($getincubedit_details_result);
    }

    public function getincub_history_wl(){ // my code

        $where_cond_bed['ci.auto_id'] = $this->input->post('current_incubid');
        $where_cond_bed['ci.branch_id'] = $this->session->userdata('branch_id');
        
		$getincubedit_details_result = $this->imodel->verify_data_history_wl($where_cond_bed);

        echo json_encode($getincubedit_details_result);
    }


    public function getincub_wl_details(){

        $where_cond_bd['cid.incubation_id'] = $this->input->post('current_incubid');
        $where_cond_bd['cid.branch_id'] = $this->session->userdata('branch_id');
        $getincub_wl_details = $this->cbmodel->verify_data_join_one(
            $where_cond_bd,'ckb_incubation_details as cid','ckb_users as cu','cid.checked_by = cu.user_id','cid.*,cu.user_name'
        );

        echo json_encode($getincub_wl_details);


    }

    public function get_incubation_title(){

        $where_cond_bed['status'] = 1;
        $where_cond_bed['branch_id'] = $this->session->userdata('branch_id');
		$get_incubation_title_result = $this->cbmodel->verify_data($where_cond_bed,'ckb_addincubation');

        echo json_encode($get_incubation_title_result);
    }

    public function get_users_list(){

        $where_cond_ul['status'] = 1;
        $where_cond_ul['branch_id'] = $this->session->userdata('branch_id');
		$get_users_list_result = $this->cbmodel->verify_data($where_cond_ul,'ckb_users');

        echo json_encode($get_users_list_result);
    }

    public function submitIncubationdetails(){
        
        if(!empty($this->input->post('id_weight_14'))){
            for ($i=0; $i < count($this->input->post('id_weight_14')); $i++) { 
            
                $get_cur_auto_id = $this->cbmodel->cur_auto_id('ckb_incubation_details');
                $auto_id = "ID".str_pad( ( $get_cur_auto_id+1 ), 4, 0, STR_PAD_LEFT);
                
                if(!empty($this->input->post('id_weight_14')[$i])){
                    $where_cond_b['auto_id'] = $auto_id;
                    $where_cond_b['branch_id'] = $this->session->userdata('branch_id');
                    $where_cond_b['incubation_id'] = $this->input->post('incubation_id');
                    $where_cond_b['idate'] = $this->input->post('id_date')[$i];
                    $where_cond_b['weight_14'] = $this->input->post('id_weight_14')[$i];
                    $where_cond_b['weight_16'] = $this->input->post('id_weight_16')[$i];
                    $where_cond_b['actual_weight'] = $this->input->post('id_actual_weight')[$i];
                    $where_cond_b['heart_beat'] = $this->input->post('id_heart_beat')[$i];
                    $where_cond_b['incubation_name'] = $this->input->post('id_incubation_name')[$i];
                    $where_cond_b['humidity'] = $this->input->post('id_humidity')[$i];
                    $where_cond_b['aircell_density'] = $this->input->post('id_aircell_density')[$i];
                    $where_cond_b['checked_by'] = $this->input->post('id_checked_by')[$i];
                    $where_cond_b['created_by'] = $this->session->userdata('user_id');
            
                    $incub_result = $this->cbmodel->data_add('ckb_incubation_details',$where_cond_b);
                }
                
            }
    
        }
        $where_cond_uid['branch_id'] = $this->session->userdata('branch_id');
        $where_cond_uid['egg_weight'] =  $this->input->post('weight_of_egg');
        $where_cond_uid['egg_laid_date'] =  $this->input->post('elaid_date');
        $where_cond_uid['pip_date'] =  $this->input->post('pip_date');
        $where_cond_uid['hatch_date'] =  $this->input->post('hatch_date');
        $where_cond_uid['weight_loss_per_day_min'] =  $this->input->post('weight_loss_per_day_min');
        $where_cond_uid['weight_loss_per_day_max'] =  $this->input->post('weight_loss_per_day_min');
        $where_cond_uid['total_loss_min'] =  $this->input->post('total_loss_min');
        $where_cond_uid['total_loss_max'] =  $this->input->post('total_loss_max');
        $where_cond_uid['weight_tobe_lost'] =  $this->input->post('weight_tobe_lost');
        $where_cond_uid['hatch_weight'] =  $this->input->post('hatch_weight');
        
		$incub_result = $this->cbmodel->updates('ckb_incubation', $where_cond_uid, 'auto_id', $this->input->post('incubation_id'));

        if($incub_result){
            $result = array(
                "message" => "success",
                "url" => "Incubation/incubation"

            );
            echo json_encode($result);
    
        }else{
            $result = array(
                "message" => "failed",
            );
            echo json_encode($result);
        }
    }
//work on durga
public function move_incubation(){
    $data['id'] = $this->input->post('incub_row_id');
    //$brooder_result = 
   //  $this->load->view('Incubation/select_brooder','$data');	
   
 }

 public function change_health_status(){
           
	$auto_id = $this->input->post('incub_id');
	$where_cond_h['health_change_date'] = $this->input->post('hs_date');
	$where_cond_h['health_status'] = $this->input->post('health_status');
	$where_cond_h['branch_id'] = $this->session->userdata('branch_id');

	$change_result = $this->cbmodel->updates('ckb_incubation', $where_cond_h, 'auto_id', $auto_id);
	if($change_result){
		$result = array(
			"logstatus" => "success",
			"url" => "Incubation/incubation"
		);
		echo json_encode($result);

	}
}

    
}
?>
