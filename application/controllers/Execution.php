<?php	
defined('BASEPATH') OR exit('No direct script access allowed');	
class  Execution extends CI_Controller {	
	
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
        $this->load->model('Breeding_model', 'brmodel');
        $this->load->model('import_model', 'import');

		if ( !$this->session->userdata('logged_in')){ 	
			redirect(base_url(), 'refresh');	
				
        }	
        	
    }	
    public function upload_brid_image(){
      
        $branch_id = $this->session->userdata('branch_id');
            //Check whether Member upload profile_img
            if(!empty($_FILES['profile_image']['name'])){
                $config['upload_path'] = 'uploads/images/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['file_name'] = $_FILES['profile_image']['name'];
                
                //Load upload library and initialize here configuration
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                
                if($this->upload->do_upload('profile_image')){
                    $uploadData = $this->upload->data();
                    $profile_img = $uploadData['file_name'];
                }else{
                    $profile_img = '';
                }
            }else{
                $profile_img = 'empty';
            }
            $update_id = $this->input->post('bird_id');
            $Data['bird_image'] = $profile_img;
            $Data['branch_id']   	= $branch_id;	

          // $insertData = $this->cbmodel->data_add('ckb_bird_image',$Data);
          $insertData= $this->masters_model->updates('ckb_bird', $Data, 'auto_id', $update_id);

            
            //Storing insertion status message.
            if($insertData){
                $this->session->set_flashdata('message', 'Image added successfully.');
                redirect(base_url('index.php/Bird/bird_manage'));
            }else{
                $this->session->set_flashdata('error', 'Some problems occured, please try again.');
                redirect(base_url('index.php/Bird/bird_manage'));
            }
        
        
    }
    public function upload_brid_video(){
      
        $branch_id = $this->session->userdata('branch_id');

        //Check whether Member upload profile_img
        if(!empty($_FILES['profile_video']['name'])){
            $config['upload_path'] = 'uploads/video/';
            $config['allowed_types'] = 'wmv|mp4|avi|mov';
            $config['file_name'] = $_FILES['profile_video']['name'];
            
            //Load upload library and initialize here configuration
            $this->load->library('upload',$config);
            $this->upload->initialize($config);
            
            if($this->upload->do_upload('profile_video')){
                $uploadData = $this->upload->data();
                $profile_video = $uploadData['file_name'];
            }else{
                $profile_video = '';
            }
        }else{
            $profile_video = 'empty';
        }
        $update_id = $this->input->post('bird_id');
        $Data['bird_video'] = $profile_video;
        $Data['branch_id'] = $branch_id;
        
  //$insertData = $this->cbmodel->data_add('ckb_bird_video',$Data);
  $insertData= $this->masters_model->updates('ckb_bird', $Data, 'auto_id', $update_id);

        
        //Storing insertion status message.
        if($insertData){
            $this->session->set_flashdata('message', 'Video added successfully.');
            redirect(base_url('index.php/Bird/bird_manage'));
        }else{
            $this->session->set_flashdata('error', 'Some problems occured, please try again.');
            redirect(base_url('index.php/Bird/bird_manage'));
        }
    
    
}



public function save_sales_update(){
    // echo $this->input->post('invoice');
    // exit;
              
      //Check whether Member upload profile_img
      $branch_id = $this->session->userdata('branch_id');
      $get_cur_auto_id = $this->cbmodel->cur_auto_id('ckb_sales_update');
      if($get_cur_auto_id == "false"){
         $auto_id="SP001";
      }
      else{
          $auto_id = "SP".str_pad( ( $get_cur_auto_id+1 ), 4, 0, STR_PAD_LEFT);
      }
      $data['auto_id'] = $auto_id;
      $data['date'] = $this->input->post('sales_date');

      $pur_date = $this->input->post('sales_date');
      $time=strtotime($pur_date);
      $data['month']=date("m",$time);
      $data['year']=date("Y",$time);

      $data['sp_name'] = $this->input->post('sp_name');
      $data['ring_no'] = $this->input->post('sp_ring');
      $data['act_cost'] = $this->input->post('act_cost');
      $data['sale_cost'] = $this->input->post('sale_cost');
      $data['discrep_value'] = $this->input->post('discrep_value');
      $data['reason'] = $this->input->post('reason');
      $data['branch_id']   	= $branch_id;	

     
     $query1 = $this->db->get_where('ckb_sales_update', array('ring_no' =>  $data['ring_no'] ));
     $count = $query1->num_rows();
    if($count > 0){
        $data1['date'] = $this->input->post('sales_date');

        $pur_date = $this->input->post('sales_date');
        $time=strtotime($pur_date);
        $data1['month']=date("m",$time);
        $data1['year']=date("Y",$time);
  
        $data1['sp_name'] = $this->input->post('sp_name');
        $data1['ring_no'] = $this->input->post('sp_ring');
        $data1['act_cost'] = $this->input->post('act_cost');
        $data1['sale_cost'] = $this->input->post('sale_cost');
        $data1['discrep_value'] = $this->input->post('discrep_value');
        $data1['reason'] = $this->input->post('reason');
        $insertData = $this->cbmodel->updates('ckb_sales_update', $data1, 'ring_no', $data['ring_no']);
    }
    else{
  $insertData = $this->cbmodel->data_add('ckb_sales_update',$data);
    }
  //$insertData= $this->masters_model->updates('ckb_bird', $Data, 'auto_id', $update_id);
  
      
      //Storing insertion status message.
      if($insertData){
          $this->session->set_flashdata('message', 'Data successfully Saved.');
          redirect(base_url('index.php/Execution/sales_register'));
      }else{
          $this->session->set_flashdata('error', 'Some problems occured, please try again.');
          redirect(base_url('index.php/Execution/sales_register'));
      }
  
  
  }
  public function upload_purchase_invoice(){
     //echo ($_FILES['invoice_purchase']['name']);
     //exit;
     $branch_id = $this->session->userdata('branch_id');     
      //Check whether Member upload profile_img
      if(!empty($_FILES['invoice_purchase']['name'])){
          $config['upload_path'] = 'uploads/purchase/';
          $config['allowed_types'] = 'pdf|csv';
          $config['file_name'] = $_FILES['invoice_purchase']['name'];
          
          //Load upload library and initialize here configuration
          $this->load->library('upload',$config);
          $this->upload->initialize($config);
          
          if($this->upload->do_upload('invoice_purchase')){
              $uploadData = $this->upload->data();
              $invoice = $uploadData['file_name'];
          }else{
              $invoice = 'fail';
             // echo $invoice;
             // exit;
          }
      }else{
          $invoice = 'empty';
      }
     
      $update_id = $this->input->post('pur_id');
      $data['invoice'] = $invoice;
      $data['branch_id']   	= $branch_id;	

      
  //$insertData = $this->cbmodel->data_add('ckb_sales_update',$data);
  $insertData= $this->masters_model->updates('ckb_purchase_register', $data, 'auto_id', $update_id);
  
      
      //Storing insertion status message.
      if($insertData){
          $this->session->set_flashdata('message', 'Invoice and Data successfully Saved.');
          redirect(base_url('index.php/Execution/purchase_register'));
      }else{
          $this->session->set_flashdata('error', 'Some problems occured, please try again.');
          redirect(base_url('index.php/Execution/purchase_register'));
      }
  
  
  }
public function upload_brid_invoice(){
  // echo $this->input->post('invoice');
  // exit;
  $branch_id = $this->session->userdata('branch_id');    
    //Check whether Member upload profile_img
    if(!empty($_FILES['invoice']['name'])){
        $config['upload_path'] = 'uploads/invoice/';
        $config['allowed_types'] = 'pdf|csv';
        $config['file_name'] = $_FILES['invoice']['name'];
        
        //Load upload library and initialize here configuration
        $this->load->library('upload',$config);
        $this->upload->initialize($config);
        
        if($this->upload->do_upload('invoice')){
            $uploadData = $this->upload->data();
            $invoice = $uploadData['file_name'];
        }else{
            $invoice = '';
        }
    }else{
        $invoice = 'empty';
    }
   
    $update_id = $this->input->post('bird_id');
    $data['invoice'] = $invoice;
    $data['branch_id']   	= $branch_id;	

    
//$insertData = $this->cbmodel->data_add('ckb_sales_update',$data);
$insertData= $this->masters_model->updates('ckb_sales_update', $data, 'auto_id', $update_id);

    
    //Storing insertion status message.
    if($insertData){
        $this->session->set_flashdata('message', 'Invoice and Data successfully Saved.');
        redirect(base_url('index.php/Execution/view_sales'));
    }else{
        $this->session->set_flashdata('error', 'Some problems occured, please try again.');
        redirect(base_url('index.php/Execution/view_sales'));
    }


}
function image_download($img)
{
   
    $this->load->helper('download');
    $data = file_get_contents("uploads/images/".$img); // Read the file's contents
    force_download($img, $data);
     
     
}
function tf_download($tf)
{
   
    $this->load->helper('download');
    $data = file_get_contents("uploads/sop/".$tf); // Read the file's contents
    force_download($tf, $data);
     
     
}
function tv_download($tv)
{
   
    $this->load->helper('download');
    $data = file_get_contents("uploads/sop/".$tv); // Read the file's contents
    force_download($tv, $data);
     
     
}
public function sop(){
    $where_cond_t['status']=1;
    $where_cond_t['branch_id'] = $this->session->userdata('branch_id');
    $data['sop_file'] = $this->cbmodel->get_all_data($where_cond_t,'ckb_sop_files');
    $data['sop_video'] = $this->cbmodel->get_all_data($where_cond_t,'ckb_sop_video');
    $this->load->view('Execution/sop', $data);	
}
public function sop_tr(){
    $where_cond_t['status']=1;
    $where_cond_t['branch_id'] = $this->session->userdata('branch_id');
    $data['sop_file'] = $this->cbmodel->get_all_data($where_cond_t,'ckb_sop_files');
    $data['sop_video'] = $this->cbmodel->get_all_data($where_cond_t,'ckb_sop_video');
    $this->load->view('Execution/sop_tr', $data);	
}
    
    public function team_register(){
        $where_cond_t['static_status']=1;
        $where_cond_t['branch_id'] = $this->session->userdata('branch_id');
        $team_result['team_result'] = $this->cbmodel->get_all_data($where_cond_t,'ckb_exec_team_register');
		$this->load->view('Execution/team_register', $team_result);	
	}
    public function sales_register(){
        $data['total_chick_details'] = $this->cbmodel->get_chicks_dt();
		$data['total_eggs_details'] = $this->cbmodel->get_incubation_dt();
		$data['total_pro_details'] = $this->cbmodel->get_production_dt();
		$data['total_sales_details'] = $this->cbmodel->get_sales_dt();
		$data['total_pur_details'] = $this->cbmodel->get_purchase_dt();
		$this->load->view('Execution/sales_register',$data);	
	}
    public function purchase_register(){
        $where_cond_t['status']=1;
        $where_cond_t['branch_id'] = $this->session->userdata('branch_id');
        $pur_result['pur_result'] = $this->cbmodel->get_all_data($where_cond_t,'ckb_purchase_register');
		$this->load->view('Execution/purchase_register',$pur_result);	
	}
    public function update_purchase_status($auto_id){
        $update_id = $auto_id; 
        $data['pay_status'] = "Paid";
        $data['branch_id'] = $this->session->userdata('branch_id');
        $insertData= $this->masters_model->updates('ckb_purchase_register', $data, 'auto_id', $update_id);
        if($insertData){
            $this->session->set_flashdata('message', 'Update Successfully.');
            redirect(base_url('index.php/Execution/purchase_register'));
        }else{
            $this->session->set_flashdata('error', 'Some problems occured, please try again.');
            redirect(base_url('index.php/Execution/purchase_register'));
        }

    }
    public function sales_history(){
      $c_month = date('m');// current month
      $date =  date('Y-m-d');
     $prev_month = date("m", strtotime ( '-1 month' , strtotime ( $date ) )) ;
     $pc_month = date("m", strtotime ( '-2 month' , strtotime ( $date ) )) ;
       $c_year = date('Y');

      // $sale_history['get_month'] = $this->cbmodel->sale_history_month($c_month,$c_year);
       $sale_history['sale_history_bymonth'] = $this->cbmodel->sale_history_3month($c_month,$prev_month,$pc_month,$c_year);
       
       //$query1 = $this->db->get_where('ckb_sales_update', array('month' => $c_month,'year' => $c_year ));
      // $sale_history['count_birds1'] =  $sale_history['sale_history_bymonth']->num_rows();
       // print_r($sale_history['sale_history_bymonth']);
      // exit;
       //	$this->load->view('Execution/sales_history');	
       $this->load->view('Execution/sales_history',$sale_history);	
	}
    public function sales_update(){
       $data['sp_name'] = $this->input->post('sp_name');
       $data['sp_ring'] = $this->input->post('sp_ring');
		$this->load->view('Execution/sales_update',$data);
	}
    public function get_sales_history(){
        $month1=$this->input->post('sp_month');
        $year1=$this->input->post('sp_year');
        $fdate=$this->input->post('fdate');
        $tdate=$this->input->post('tdate');
       // $time=strtotime($pur_date);
     // $data['month']=date("m",$time);
    //  $data['year']=date("Y",$time);
     // echo  $fdate.'<br>'. $tdate;
    
        $sale_history['sale_history'] = $this->cbmodel->sale_history_det($month1,$year1,$fdate,$tdate);
       // $sale_history['get_month'] = $this->cbmodel->sale_history_month($month1,$year1);
       // $query1 = $this->db->get_where('ckb_sales_update', array('month' => $month1,'year' => $year1 ));
       // $sale_history['count_birds'] = $query1->num_rows();
       // print_r(  $sale_history['sale_history']);
      //exit;
		$this->load->view('Execution/sales_history',$sale_history);	
	}
    public function view_sales(){
        $where_cond_t['status']=1;
        $where_cond_t['branch_id'] = $this->session->userdata('branch_id');

        $sale_result['sales_result'] = $this->cbmodel->get_all_data($where_cond_t,'ckb_sales_update');
		$this->load->view('Execution/view_sales',$sale_result);	
	}
    public function manage_register(){
        $where_cond_t['static_status']=1;
        $where_cond_t['branch_id'] = $this->session->userdata('branch_id');

        $team_result['team_result'] = $this->cbmodel->get_all_data($where_cond_t,'ckb_exec_team_register');
		$this->load->view('Execution/manage_register',$team_result);	
	}
    public function head_register(){
        $where_cond_t['static_status']=1;
        $where_cond_t['branch_id'] = $this->session->userdata('branch_id');
        $team_result['team_result'] = $this->cbmodel->get_all_data($where_cond_t,'ckb_exec_team_register');
		$this->load->view('Execution/head_register',$team_result);	
	}
    public function division_register(){
        $where_cond_t['static_status']=1;
        $where_cond_t['branch_id'] = $this->session->userdata('branch_id');
        $team_result['team_result'] = $this->cbmodel->get_all_data($where_cond_t,'ckb_exec_team_register');
		$this->load->view('Execution/division_register',$team_result);	
	}
   
    public function update_doc(){
        $branch_id = $this->session->userdata('branch_id');
        $update_id = $this->input->post('team_id');
        $data['date_doc']   	= $this->input->post('doc');	
        $data['branch_id']   	= $branch_id;	

        $team_result_up= $this->masters_model->updates('ckb_exec_team_register', $data, 'auto_id', $update_id);
      
    
          if($team_result_up){
            $this->session->set_flashdata('message', ('Date of completion has been Updated!'));
			redirect(base_url('index.php/Execution/manage_register'));
          //  $result = array(
             //   "logstatus" => "success",
               // "url" => "Execution/manage_register"
            //);
        }
          //  echo json_encode($result);
      /*  $where_cond_t['static_status']=1;
        $team_result['team_result'] = $this->cbmodel->verify_data($where_cond_t,'ckb_exec_team_register');
		$this->load->view('Execution/manage_register',$team_result);	*/
	}
    public function update_reason(){
        $branch_id = $this->session->userdata('branch_id');
        $update_id = $this->input->post('manage_id');
        $status = $this->input->post('change_status');
        if($status == 1){
            $data['status_change']   	= $this->input->post('change_status');	
            $data['branch_id']   	= $branch_id;	

            $manage_result_up= $this->masters_model->updates('ckb_exec_team_register', $data, 'auto_id', $update_id);

        }
        else{
        $data['status_change']   	= $this->input->post('change_status');	
        $data['reason']   	= $this->input->post('reason');	
        $data['date_doc']   	= $this->input->post('new_doc');	
        $data['branch_id']   	= $branch_id;	

        $manage_result_up= $this->masters_model->updates('ckb_exec_team_register', $data, 'auto_id', $update_id);
        }
    
          if($manage_result_up){
            $this->session->set_flashdata('message', ('Status has been Updated!'));
			redirect(base_url('index.php/Execution/manage_register'));
         
        }
          
	}
    public function update_head_decision(){
        $branch_id = $this->session->userdata('branch_id');
        $update_id = $this->input->post('team_id');
        $data['status_rd']   	= $this->input->post('status_rd');	
        $data['branch_id']   	= $branch_id;	

        $team_result_up= $this->masters_model->updates('ckb_exec_team_register', $data, 'auto_id', $update_id);
      
    
          if($team_result_up){
            $this->session->set_flashdata('message', ('Status has been sent!'));
			redirect(base_url('index.php/Execution/head_register'));
          
        }
        
	}
    public function update_division_decision(){
        $branch_id = $this->session->userdata('branch_id');
        $update_id = $this->input->post('team_id');
        $data['status_division']   	= $this->input->post('status_division');	
        $data['branch_id']   	= $branch_id;	

        $team_result_up= $this->masters_model->updates('ckb_exec_team_register', $data, 'auto_id', $update_id);
      
    
          if($team_result_up){
            $this->session->set_flashdata('message', ('Status has been sent!'));
			redirect(base_url('index.php/Execution/division_register'));
          
        }
        
	}
   
     public function add_team_register(){
        $branch_id = $this->session->userdata('branch_id');
        $get_cur_auto_id = $this->cbmodel->cur_auto_id('ckb_exec_team_register');
        if($get_cur_auto_id == "false"){
           $auto_id="TR001";
        }
       else{
       $auto_id = "TR".str_pad( ( $get_cur_auto_id+1 ), 4, 0, STR_PAD_LEFT);
       }

        $where_cond_b['auto_id'] = $auto_id;
        $where_cond_b['divisions'] = $this->input->post('divisions');
		$where_cond_b['to_division'] = $this->input->post('to_divisions');
        $where_cond_b['requirement'] = $this->input->post('requirement');
        $where_cond_b['date_req'] = $this->input->post('date_req');
        $where_cond_b['branch_id'] = $branch_id;
      
        
        $team_result = $this->cbmodel->data_add('ckb_exec_team_register',$where_cond_b);

       // $id = $this->db->insert_id();
        
        if($team_result){
            $result = array(
                "logstatus" => "success",
                "url" => "Execution/team_register"
            );
            echo json_encode($result);
    
        }
    }

    public function get_total_eggs(){
      //  $where_cond_e['status']=1;
        $total_eggs_details = $this->cbmodel->get_incubation_dt();
		echo json_encode($total_eggs_details);	
	}
    public function get_total_chicks(){
        //  $where_cond_e['status']=1;
          $total_chick_details = $this->cbmodel->get_chicks_dt();
          echo json_encode($total_chick_details);	
      }
      public function get_total_production(){
        //  $where_cond_e['status']=1;
          $total_pro_details = $this->cbmodel->get_production_dt();
          echo json_encode($total_pro_details);	
      }
      public function get_total_sales(){
        //  $where_cond_e['status']=1;
          $total_pro_details = $this->cbmodel->get_sales_dt();
          echo json_encode($total_pro_details);	
      }
      public function get_total_purchase(){
        //  $where_cond_e['status']=1;
          $total_pur_details = $this->cbmodel->get_purchase_dt();
          echo json_encode($total_pur_details);	
      }

      public function add_purchase(){
        $branch_id = $this->session->userdata('branch_id');
        $get_cur_auto_id = $this->cbmodel->cur_auto_id('ckb_purchase_register');
        if($get_cur_auto_id == "false"){
           $auto_id="PS001";
        }
       else{
       $auto_id = "PS".str_pad( ( $get_cur_auto_id+1 ), 4, 0, STR_PAD_LEFT);
       }

        $where_cond_b['auto_id'] = $auto_id;
        $where_cond_b['pur_date'] = $this->input->post('pur_date');
        $where_cond_b['species_name'] = $this->input->post('sp_name');
        $where_cond_b['egg_no'] = $this->input->post('ring_no');
        $where_cond_b['price'] = $this->input->post('price');
        $where_cond_b['pay_status'] = $this->input->post('pay_status');
        $where_cond_b['branch_id'] = $branch_id;

        $query = $this->db->get_where('ckb_purchase_register', array('egg_no' => $where_cond_b['egg_no'] ));
        $count_reg = $query->num_rows();
        if($count_reg > 0){
            $data['price'] = $this->input->post('price');
            $data['pay_status'] = $this->input->post('pay_status');
            $pur_result= $this->masters_model->updates('ckb_purchase_register', $data, 'egg_no', $where_cond_b['egg_no'] );

        }
        else{
            $pur_result = $this->cbmodel->data_add('ckb_purchase_register',$where_cond_b);

        }

        
        if($pur_result){
            $result = array(
                "logstatus" => "success",
                "url" => "Execution/sales_register"
            );
            echo json_encode($result);
    
        }
    }

    public function upload_sop_file(){
        //echo ($_FILES['invoice_purchase']['name']);
        //exit;
                 
         //Check whether Member upload profile_img
         $branch_id = $this->session->userdata('branch_id');
         if(!empty($_FILES['sop_file']['name'])){
             $config['upload_path'] = 'uploads/sop/';
             $config['allowed_types'] = 'pdf|csv|xlsx|.docx';
             $config['file_name'] = $_FILES['sop_file']['name'];
             
             //Load upload library and initialize here configuration
             $this->load->library('upload',$config);
             $this->upload->initialize($config);
             
             if($this->upload->do_upload('sop_file')){
                 $uploadData = $this->upload->data();
                 $invoice = $uploadData['file_name'];
             }else{
                 $invoice = 'fail';
                 $this->session->set_flashdata('error', 'Check File Format.');
                 redirect(base_url('index.php/Execution/sop'));
             }
         }else{
             $invoice = 'empty';
         }
        
         $data['date'] = $this->input->post('sop_date');
         $data['title'] = $this->input->post('title');
         $data['sop_file'] = $invoice;
         $data['branch_id'] = $branch_id;
         
     $insertData = $this->cbmodel->data_add('ckb_sop_files',$data);
     //$insertData= $this->masters_model->updates('ckb_purchase_register', $data, 'auto_id', $update_id);
     
         
         //Storing insertion status message.
         if($insertData){
             $this->session->set_flashdata('message', 'File successfully Saved.');
             redirect(base_url('index.php/Execution/sop'));
         }else{
             $this->session->set_flashdata('error', 'Some problems occured, please try again.');
             redirect(base_url('index.php/Execution/sop'));
         }
     
     
     }


     public function upload_sop_video(){
        //echo ($_FILES['invoice_purchase']['name']);
        //exit;
        $branch_id = $this->session->userdata('branch_id');
                 
         //Check whether Member upload profile_img
         if(!empty($_FILES['sop_video']['name'])){
             $config['upload_path'] = 'uploads/sop/';
             $config['allowed_types'] = 'wmv|mp4|avi|mov';
             $config['file_name'] = $_FILES['sop_video']['name'];
             
             //Load upload library and initialize here configuration
             $this->load->library('upload',$config);
             $this->upload->initialize($config);
             
             if($this->upload->do_upload('sop_video')){
                 $uploadData = $this->upload->data();
                 $sop_video = $uploadData['file_name'];
             }else{
                 $sop_video = 'fail';
                 $this->session->set_flashdata('error', 'Check File Format.');
                 redirect(base_url('index.php/Execution/sop'));
             }
         }else{
             $sop_video = 'empty';
         }
        
         $data['date'] = $this->input->post('sop_date');
         $data['title'] = $this->input->post('title');
         $data['sop_video'] = $sop_video;
         $data['branch_id'] = $branch_id;

         
     $insertData = $this->cbmodel->data_add('ckb_sop_video',$data);
     //$insertData= $this->masters_model->updates('ckb_purchase_register', $data, 'auto_id', $update_id);
     
         
         //Storing insertion status message.
         if($insertData){
             $this->session->set_flashdata('message', 'File successfully Saved.');
             redirect(base_url('index.php/Execution/sop'));
         }else{
             $this->session->set_flashdata('error', 'Some problems occured, please try again.');
             redirect(base_url('index.php/Execution/sop'));
         }
     
     
     }
     public function update_delete_status(){
        $id  =   $this->input->post('id');
        $table = $this->input->post('table');
        $where_con['status'] = 0;
        $br_ch_result = $this->cbmodel->updates($table, $where_con, 'id', $id);
        if($br_ch_result){
            $result = array(
                "logstatus" => "success",
            );
            echo json_encode($result);
    
        }
    }
}//end class
?>
