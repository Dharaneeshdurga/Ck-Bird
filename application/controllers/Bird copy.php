<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bird extends CI_Controller {

    public function __construct() {
        parent::__construct();
        
        //load the required libraries and helpers for login
        $this->load->helper('url');
        $this->load->library(['form_validation','session']);
        $this->load->database();
        
        //load the Login Model
        $this->load->model('CommonBird_model', 'cbmodel');
        if ( !$this->session->userdata('logged_in')){ 	
			redirect(base_url(), 'refresh');	
				
        }	
    }

    public function bird_manage(){
		$this->load->view('bird_manage');	
    }

    public function add_bird(){
		$this->load->view('add_bird');	
    }
    
    public function check_ringno(){

        $ring_no = $this->input->post('ring_no');

        $where_cond_b['ring_no'] = $ring_no;

		$ring_no_count = $this->cbmodel->count_menu($where_cond_b,'ckb_bird','menu_id');

        if($ring_no_count ==0){
            
            $result = array(
                "response" => "proceed",
            );
        }
        else{
            $result = array(
                "response" => "already_exits",
            );
        }

        echo json_encode($result);

    }

    public function get_birdgroup(){
        
        $where_cond_g['status'] = 1;
		$group_result = $this->cbmodel->verify_data($where_cond_g,'ckb_group');

        echo json_encode($group_result);

    }

    public function get_birdspecies(){
        
        $group_id = $this->input->post('group_id');

        $where_cond_s['group_id'] = $group_id;
        $where_cond_s['status'] = 1;
		$species_result = $this->cbmodel->verify_data($where_cond_s,'ckb_species');

        echo json_encode($species_result);
    }

    public function get_proven(){

        $where_cond_p['status'] = 1;
		$proven_result = $this->cbmodel->verify_data($where_cond_p,'ckb_proven');

        echo json_encode($proven_result);
    }

    public function get_cage_info(){

        $cage_id = $this->input->post('cage_id');

        
            
        $cage_result = $this->cbmodel->verify_data_join_one($where_cond_bd,'ckb_cage_details as cd','ckb_cage as c','cd.cage_id = c.auto_id','cd.*,c.*');
            // print_r($cage_result);


            if(count($cage_result) !=''){

                $cage_detail_html = '<div class="row" >';
                $cage_detail_html .= '<h4>Recommended Cages</h4>';

                for ($i=0; $i < count($cage_result); $i++) { 
                    
                    $cage_detail_html.='<div class="col-lg-3">';
                        $cage_detail_html.='<div class="panel panel-border panel-pink">';
                            $cage_detail_html.='<div class="panel-heading"> ';
                            $cage_detail_html.='<h3 class="panel-title-new">'.$cage_result[$i]->cage.'</h3> ';
                            $cage_detail_html.='</div>';
                            
                            $cage_detail_html.='<div class="panel-body">';
                                $cage_detail_html.='<div class="row">';

                                    if($new_gender =='Female'){
                                        $cage_detail_html.='<div class="col-lg-6" style="border: thin solid #ccc;">';
                                            $cage_detail_html.='<div class="radio radio-danger">';
                                                $cage_detail_html.='<input id="radio3" type="radio" disabled checked>';
                                                $cage_detail_html.='<label for="radio3">Taken | '.$cage_result[$i]->slot_right_gender.'</label>';
                                            $cage_detail_html.='</div>';
                                        $cage_detail_html.='</div>';
                                    }
                                    else{
                                        $cage_detail_html.='<div class="col-lg-6" style="border: thin solid #ccc;">';
                                            $cage_detail_html.='<div class="radio radio-danger">';
                                                $cage_detail_html.='<input id="radio3" type="radio" disabled checked>';
                                                $cage_detail_html.='<label for="radio3">Taken | '.$cage_result[$i]->slot_left_gender.'</label>';
                                            $cage_detail_html.='</div>';
                                        $cage_detail_html.='</div>';
                                    }
                                    $cage_detail_html.='<div class="col-lg-6" style="border: thin solid #ccc;">';
                                        $cage_detail_html.='<div class="radio radio-success">';
                                            $cage_detail_html.='<input id="get_cage_id_'.$i.'" name="get_cage_id" class="get_cage_id" type="radio" value="'.$cage_result[$i]->cage_id.'">';
                                            $cage_detail_html.='<label for="get_cage_id_'.$i.'">Not Taken</label>';
                                        $cage_detail_html.='</div>';
                                    $cage_detail_html.='</div>';
                                
                                $cage_detail_html.='</div>';
                            $cage_detail_html.='</div>';
                        $cage_detail_html.='</div>';
                    $cage_detail_html.='</div>';
                    
                    
                }
                $cage_detail_html .= '</div>';

                // new cage
                $where_cond_nbd['cd.slot_right_species_id'] = '';
                $where_cond_nbd['cd.slot_right_gender'] = '';
                $where_cond_nbd['cd.slot_left_species_id'] = '';
                $where_cond_nbd['cd.slot_left_gender'] = '';

                $cage_result_new = $this->cbmodel->verify_data_join_one($where_cond_nbd,'ckb_cage_details as cd','ckb_cage as c','cd.cage_id = c.auto_id','cd.*,c.*');

                if(count($cage_result_new) !=''){
                    $cage_detail_html .= '<div class="row" >';

                    $cage_detail_html .= '<h4>New Cages</h4>';

                    for ($i=0; $i < count($cage_result_new); $i++) { 
                    
                        $cage_detail_html.='<div class="col-lg-3">';
                            $cage_detail_html.='<div class="panel panel-border panel-pink">';
                                $cage_detail_html.='<div class="panel-heading"> ';
                                $cage_detail_html.='<h3 class="panel-title-new">'.$cage_result_new[$i]->cage.'</h3> ';
                                $cage_detail_html.='</div>';
                                
                                $cage_detail_html.='<div class="panel-body">';
                                    $cage_detail_html.='<div class="row">';

                                        $cage_detail_html.='<div class="col-lg-6" style="border: thin solid #ccc;">';
                                            $cage_detail_html.='<div class="radio radio-success">';
                                                $cage_detail_html.='<input id="get_cage_id_ln_'.$i.'" name="get_cage_id" class="get_cage_id" type="radio" value="'.$cage_result[$i]->cage_id.'">';
                                                $cage_detail_html.='<label for="get_cage_id_ln_'.$i.'">Not Taken</label>';
                                            $cage_detail_html.='</div>';
                                        $cage_detail_html.='</div>';
                            
                                        $cage_detail_html.='<div class="col-lg-6" style="border: thin solid #ccc;">';
                                            $cage_detail_html.='<div class="radio radio-success">';
                                                $cage_detail_html.='<input id="get_cage_id_rn_'.$i.'" name="get_cage_id" class="get_cage_id" type="radio" value="'.$cage_result[$i]->cage_id.'">';
                                                $cage_detail_html.='<label for="get_cage_id_rn_'.$i.'">Not Taken</label>';
                                            $cage_detail_html.='</div>';
                                        $cage_detail_html.='</div>';
                                    
                                    $cage_detail_html.='</div>';
                                $cage_detail_html.='</div>';
                            $cage_detail_html.='</div>';
                        $cage_detail_html.='</div>';
    
                    }
                    $cage_detail_html .= '</div>';

                }

            }else{
                $where_cond_nbd['cd.slot_right_species_id'] = '';
                $where_cond_nbd['cd.slot_right_gender'] = '';
                $where_cond_nbd['cd.slot_left_species_id'] = '';
                $where_cond_nbd['cd.slot_left_gender'] = '';

                $cage_result = $this->cbmodel->verify_data_join_one($where_cond_nbd,'ckb_cage_details as cd','ckb_cage as c','cd.cage_id = c.auto_id','cd.*,c.*');

                if(count($cage_result) !=''){
                    $cage_detail_html = '<div class="row" >';

                    $cage_detail_html .= '<h4>New Cages</h4>';

                    for ($i=0; $i < count($cage_result); $i++) { 
                    
                        $cage_detail_html.='<div class="col-lg-3">';
                            $cage_detail_html.='<div class="panel panel-border panel-pink">';
                                $cage_detail_html.='<div class="panel-heading"> ';
                                $cage_detail_html.='<h3 class="panel-title-new">'.$cage_result[$i]->cage.'</h3> ';
                                $cage_detail_html.='</div>';
                                
                                $cage_detail_html.='<div class="panel-body">';
                                    $cage_detail_html.='<div class="row">';

                                        $cage_detail_html.='<div class="col-lg-6" style="border: thin solid #ccc;">';
                                            $cage_detail_html.='<div class="radio radio-success">';
                                                $cage_detail_html.='<input id="get_cage_id_ln_'.$i.'" name="get_cage_id" class="get_cage_id" type="radio" value="'.$cage_result[$i]->cage_id.'">';
                                                $cage_detail_html.='<label for="get_cage_id_ln_'.$i.'">Not Taken</label>';
                                            $cage_detail_html.='</div>';
                                        $cage_detail_html.='</div>';
                            
                                        $cage_detail_html.='<div class="col-lg-6" style="border: thin solid #ccc;">';
                                            $cage_detail_html.='<div class="radio radio-success">';
                                                $cage_detail_html.='<input id="get_cage_id_rn_'.$i.'" name="get_cage_id" class="get_cage_id" type="radio" value="'.$cage_result[$i]->cage_id.'">';
                                                $cage_detail_html.='<label for="get_cage_id_rn_'.$i.'">Not Taken</label>';
                                            $cage_detail_html.='</div>';
                                        $cage_detail_html.='</div>';
                                    
                                    $cage_detail_html.='</div>';
                                $cage_detail_html.='</div>';
                            $cage_detail_html.='</div>';
                        $cage_detail_html.='</div>';
    
                    }
                    $cage_detail_html .= '</div>';

                }
            }

            $result = array(
                "response" => $cage_detail_html,
            );
            echo json_encode($result);

        
        
    }

    public function get_aviary(){

        // $cage_id = $this->input->post('cage_id');

        // $where_cond_a['c.auto_id'] = $cage_id;
        $where_cond_a['status'] = 1;
        
		$aviary_result = $this->cbmodel->verify_data($where_cond_a,'ckb_aviary');

        echo json_encode($aviary_result);
    }

    public function process_bird_save(){

        $get_cur_auto_id = $this->cbmodel->cur_auto_id('ckb_bird');
		$auto_id = "B".str_pad( ( $get_cur_auto_id+1 ), 4, 0, STR_PAD_LEFT);

        $where_cond_b['auto_id'] = $auto_id;
        $where_cond_b['ring_no'] = $this->input->post('ring_no');
        $where_cond_b['group_id'] = $this->input->post('bird_group');
        $where_cond_b['species_id'] = $this->input->post('bird_species');
        $where_cond_b['gender'] = $this->input->post('gender');
        $where_cond_b['cage_id'] = $this->input->post('cage');
        $where_cond_b['aviary_id'] = $this->input->post('aviary_id');
        $where_cond_b['proven'] = $this->input->post('proven');
        $where_cond_b['status'] = 1;
        $where_cond_b['created_by'] = $this->session->userdata('user_id');

		$bird_result = $this->cbmodel->data_add('ckb_bird',$where_cond_b);



        if($bird_result){
            $result = array(
                "logstatus" => "success",
                "url" => "Bird/bird_manage"
            );
            echo json_encode($result);
    
        }
        
    }

    public function get_cage_listall(){
        $aviary_id = $this->input->post('aviary_id');

        $where_cond_c['aviary_id'] = $aviary_id;
        $where_cond_c['status'] = 1;
		$cage_result = $this->cbmodel->verify_data($where_cond_c,'ckb_cage');

        echo json_encode($cage_result);
    }

    public function get_birdmanage_list(){
        
        $postData = $this->input->post();
        // $postData_where['b.status'] = "1";
        // $postData_where='';
		$bird_result = $this->cbmodel->verify_data_bird_dt($postData);

        echo json_encode($bird_result);
    }
}