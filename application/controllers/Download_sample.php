<?php 
 
defined('BASEPATH') OR exit('No direct script access allowed');  
  
class Download_sample extends CI_Controller {  
  public function __construct()	
  {	
      parent::__construct();	
      error_reporting(0);
ini_set('display_errors', 0);
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
      $this->load->model('import_model', 'import');
    //  $this->load->library('excel');

  if ( !$this->session->userdata('logged_in')){ 	
    redirect(base_url(), 'refresh');	
      
      }	
        
  }	
 

       public function species_Download(){
          $this->load->helper('csv');
          $export_arr = array();
          $where_cond_s['status'] = 1;
          $result = $this->cbmodel->verify_data($where_cond_s,"ckb_group");
        //  $data['Info'] =  $this->import->exportExcel();
       // print_r($result);
       // exit;
              $title = array("Group Name","Species Name","No of days in brooder","Days of incubation(min)","Days of incubation(max)",
            "Target Mrng Feed","Target Aftn Feed","Std Egg weight","Std Hatch weight");
              array_push($export_arr, $title);
              if (!empty($result)) {
                  foreach ($result as $group) {
                      array_push($export_arr, array($group->group_name));
                  }
              }
          convert_to_csv($export_arr, 'Species sample.csv', ',');
      }

      public function species_upload(){

        $user_id = $this->session->userdata('user_id');
        $branch_id = $this->session->userdata('branch_id');
        $get_cur_auto_id = $this->cbmodel->cur_auto_id('ckb_species');
        if($get_cur_auto_id == "false"){
           $auto_id="S001";
        }
                
                $path = 'uploads/';
                require_once APPPATH . "/third_party/PHPExcel.php";
                $config['upload_path'] = $path;
                $config['allowed_types'] = 'xlsx|xls|csv';
                $config['remove_spaces'] = TRUE;
                $this->load->library('upload', $config);
                $this->upload->initialize($config);            
                if (!$this->upload->do_upload('uploadFile')) {
                    $error = array('error' => $this->upload->display_errors());
                } else {
                    $data = array('upload_data' => $this->upload->data());
                }
                if(empty($error)){
                  if (!empty($data['upload_data']['file_name'])) {
                    $import_xls_file = $data['upload_data']['file_name'];
                } else {
                    $import_xls_file = 0;
                }
                $inputFileName = $path . $import_xls_file;
                
                try {
                    $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
                    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                    $objPHPExcel = $objReader->load($inputFileName);
                    $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
                    $flag = true;
                    $i=1;
                   // print_r ($allDataInSheet);
                     //exit;
                     $group_name = $allDataInSheet[1]['A'];
                     $species = $allDataInSheet[1]['B'];
                     $days_br = $allDataInSheet[1]['C'];
                   //  $w_min = $allDataInSheet[1]['D'];
                   //  $w_max = $allDataInSheet[1]['E'];
                    //  $d_min = $allDataInSheet[1]['F'];
                    //  $d_max = $allDataInSheet[1]['G'];
                    //  $t_m = $allDataInSheet[1]['H'];
                    //  $t_f = $allDataInSheet[1]['I'];
                    //  $s_e = $allDataInSheet[1]['J'];
                    //  $s_h = $allDataInSheet[1]['K'];

                    
                      $d_min = $allDataInSheet[1]['D'];
                     $d_max = $allDataInSheet[1]['E'];
                     $t_m = $allDataInSheet[1]['F'];
                     $t_f = $allDataInSheet[1]['G'];
                     $s_e = $allDataInSheet[1]['H'];
                     $s_h = $allDataInSheet[1]['I'];

                   if ($group_name == "Group Name" && $species == "Species Name" && $days_br == "No of days in brooder"  && $d_min == "Days of incubation(min)" && $d_max == "Days of incubation(max)" && $t_m == "Target Mrng Feed" && $t_f == "Target Aftn Feed" && $s_e == "Std Egg weight" && $s_h == "Std Hatch weight")
                   {
    
                    foreach ($allDataInSheet as $value) {
                      if($flag){
                        $flag =false;
                        continue;
                      }
                     // print_r ($value);
                     // exit;
                   
                     $auto_id = "S".str_pad( ( $get_cur_auto_id+$i ), 4, 0, STR_PAD_LEFT);
                    $where_cond_s['status'] = 1;
                    $where_cond_s['group_name'] = ucfirst($value['A']);
                    $where_cond_s['branch_id'] = $branch_id;
                    $av_id = $this->cbmodel->verify_data($where_cond_s,"ckb_group");
                   if($av_id){
                    foreach ($av_id as $group) {
                      $group_id =  $group->auto_id;
                      $inserdata[$i]['group_id'] = $group_id;
                      }
                    }
                    else{
                      $this->session->set_flashdata('error', ( ucfirst($value['A']).'  Not Match/found in Group list'));
                      redirect(base_url('index.php/Masters/species'));
                      exit;
                    }
                      $inserdata[$i]['auto_id'] = $auto_id;
                      $inserdata[$i]['bird_species'] = ucfirst($value['B']);
                      $inserdata[$i]['days_brooder'] = $value['C'];
                    //  $inserdata[$i]['weight_loss_min'] = $value['D'];
                    //  $inserdata[$i]['weight_loss_max'] = $value['E'];
                      $inserdata[$i]['incub_days_min'] = $value['D'];
                      $inserdata[$i]['incub_days_max'] = $value['E'];
                      $inserdata[$i]['target_mrg_feed'] = $value['F'];
                      $inserdata[$i]['target_aft_feed'] = $value['G'];
                      $inserdata[$i]['std_egg_weight'] = $value['H'];
                      $inserdata[$i]['std_hatch_weight'] = $value['I'];
                      $inserdata[$i]['status'] = 1;
                      $inserdata[$i]['created_by'] = $user_id;
                      $inserdata[$i]['branch_id'] = $branch_id;
                   
                      $i++;
                    }               
                    $av_result = $this->import->insert_bulk_data($inserdata,"ckb_species");   
                  } // end aviary if
                    else {
                      $this->session->set_flashdata('error', ('Column order Does not match with your file, <br>please download the sample file and upload in it correct format!'));
                      redirect(base_url('index.php/Masters/species'));
                     }
    
                    if($av_result == TRUE){
                      $this->session->set_flashdata('message', ('species`s Data Successfully Imported!'));
                     redirect(base_url('index.php/Masters/species'));
                    }
                    else if($av_result == FALSE ){
                      $this->session->set_flashdata('error', ('Please check File Format!'));
                      redirect(base_url('index.php/Masters/species'));
                    }          
     
                   } catch (Exception $e) {
                  // die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
                        //    . '": ' .$e->getMessage());
                        $this->session->set_flashdata('error', ('Please check File Format!'));
                        redirect(base_url('index.php/Masters/species'));
    
                }
             }else{
    
                  $error_msg =  $error['error'];
                  $this->session->set_flashdata('error', ($error_msg));
                  redirect(base_url('index.php/Masters/species'));
    
             } 
                
     
               redirect(base_url('index.php/Masters/species'));
        
         }


         public function bird_Download(){
          $this->load->helper('csv');
            $export_arr = array();
          //  $where_cond_s['status'] = 1;
           // $result = $this->cbmodel->verify_data($where_cond_s,"ckb_group");
        
                $title = array("Group Name","Aviary Name","Cage","Species Name","Ring no","Gender","Proven","Bird status");
                array_push($export_arr, $title);
               
            convert_to_csv($export_arr, 'Bird sample.csv', ',');
        }
  
        public function bird_upload(){
  
          $user_id = $this->session->userdata('user_id');   
         $branch_id = $this->session->userdata('branch_id');
          $get_cur_auto_id = $this->cbmodel->cur_auto_id('ckb_bird');
          if($get_cur_auto_id == "false"){
             $auto_id="B001";
          }
                  
                  $path = 'uploads/';
                  require_once APPPATH . "/third_party/PHPExcel.php";
                  $config['upload_path'] = $path;
                  $config['allowed_types'] = 'xlsx|xls|csv';
                  $config['remove_spaces'] = TRUE;
                  $this->load->library('upload', $config);
                  $this->upload->initialize($config);            
                  if (!$this->upload->do_upload('uploadFile')) {
                      $error = array('error' => $this->upload->display_errors());
                  } else {
                      $data = array('upload_data' => $this->upload->data());
                  }
                  if(empty($error)){
                    if (!empty($data['upload_data']['file_name'])) {
                      $import_xls_file = $data['upload_data']['file_name'];
                  } else {
                      $import_xls_file = 0;
                  }
                  $inputFileName = $path . $import_xls_file;
                  
                  try {
                      $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
                      $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                      $objPHPExcel = $objReader->load($inputFileName);
                      $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
                      $flag = true;
                      $i=1;
                     // print_r ($allDataInSheet);
                       //exit;
                       $group_name = $allDataInSheet[1]['A'];
                       $aviary = $allDataInSheet[1]['B'];
                       $cage = $allDataInSheet[1]['C'];
                       $sp = $allDataInSheet[1]['D'];
                       $ring_no = $allDataInSheet[1]['E'] ;
                       $gender = $allDataInSheet[1]['F'];
                       $proven = $allDataInSheet[1]['G'];
                       $bird_status = $allDataInSheet[1]['H'];
                     
  
                     if ($group_name == "Group Name" && $aviary == "Aviary Name" && $cage == "Cage" && $sp == "Species Name" && $ring_no == "Ring no" && $gender == "Gender" && $proven == "Proven" && $bird_status == "Bird status")
                     {
      
                      foreach ($allDataInSheet as $value) {
                        if($flag){
                          $flag =false;
                          continue;
                        }
                        for ($char = 'A'; $char <= 'H'; $char++) {
                          if($value[$char] == NULL){
                            $value[$char] = "";
                           // echo $value[$char];
                           // exit;
                          }
                        }
                       // print_r ($value);
                       // exit;
                     
                       $auto_id = "B".str_pad( ( $get_cur_auto_id+$i ), 4, 0, STR_PAD_LEFT);
                      $where_cond_g['status'] = 1;
                      $where_cond_g['group_name'] = ucfirst($value['A']);
                      $where_cond_g['branch_id'] = $branch_id;
                      $av_id = $this->cbmodel->verify_data($where_cond_g,"ckb_group");
                      foreach ($av_id as $group) {
                        $group_id =  $group->auto_id;
                        $inserdata[$i]['group_id'] = $group_id;
                        $updatedata[$i]['group_id'] = $group_id;
                        }
                        //aviary
                        $where_cond_a['status'] = 1;
                        $where_cond_a['aviary_name'] = ucfirst($value['B']);
                        $where_cond_a['branch_id'] = $branch_id;
                        $av_id = $this->cbmodel->verify_data($where_cond_a,"ckb_aviary");
                        foreach ($av_id as $av) {
                          $av_id =  $av->auto_id;
                          $inserdata[$i]['aviary_id'] = $av_id;
                          $updatedata[$i]['aviary_id'] = $av_id;
                          }
                          //species
                          $where_cond_s['status'] = 1;
                          $where_cond_s['bird_species'] = $value['D'];
                          $where_cond_s['branch_id'] = $branch_id;
                          $av_id = $this->cbmodel->verify_data($where_cond_s,"ckb_species");
                          foreach ($av_id as $sp) {
                            $sp_id =  $sp->auto_id;
                            $inserdata[$i]['species_id'] = $sp_id;
                            $updatedata[$i]['species_id'] = $sp_id;
                            }
                        $inserdata[$i]['auto_id'] = $auto_id;
                        $inserdata[$i]['cage_id'] = ucfirst($value['C']);
                       
                        $inserdata[$i]['ring_no'] = trim(preg_replace('/\s+/','',$value['E']));
                        $inserdata[$i]['gender'] = ucfirst($value['F']);
                        $inserdata[$i]['proven'] = $value['G'];
                        $inserdata[$i]['bird_status'] = $value['H'];
                        $inserdata[$i]['status'] = 1;
                        $inserdata[$i]['created_by'] = $user_id;
                        $inserdata[$i]['branch_id'] = $branch_id;

                        $check_ringno = $this->db->get_where('ckb_bird', array('ring_no' => trim(preg_replace('/\s+/','',$value['E'])) , 'branch_id' =>$branch_id));
                         $if_exist = $check_ringno->num_rows();
                         if($if_exist > 0){
                           $bird_where= array('ring_no' =>trim(preg_replace('/\s+/','',$value['E'])) , 'branch_id' =>$branch_id);

                           $updatedata[$i]['cage_id'] = ucfirst($value['C']);
                       
                           $updatedata[$i]['ring_no'] =trim(preg_replace('/\s+/','',$value['E']));
                           $updatedata[$i]['gender'] = ucfirst($value['F']);
                           $updatedata[$i]['proven'] = $value['G'];
                           $updatedata[$i]['bird_status'] = $value['H'];
                           $updatedata[$i]['status'] = 1;
                           $updatedata[$i]['created_by'] = $user_id;
                        
                           $av_result = $this->masters_model->branch_updates('ckb_bird', $updatedata[$i], $bird_where);
                         }
                         else{
                        $av_result = $this->cbmodel->data_add('ckb_bird',$inserdata[$i]);
                         }

                        $i++;
                      }               
                     // $av_result = $this->import->insert_bulk_data($inserdata,"ckb_bird");  
                     $av_result = TRUE;
                    } // end aviary if
                      else {
                        $this->session->set_flashdata('error', ('Column order Does not match with your file, <br>please download the sample file and upload in it correct format!'));
                        redirect(base_url('index.php/Bird/bird_manage'));
                       }
      
                      if($av_result == TRUE){
                        $this->session->set_flashdata('message', ('Bird`s Data Successfully Imported!'));
                       redirect(base_url('index.php/Bird/bird_manage'));
                      }
                      else if($av_result == FALSE ){
                        $this->session->set_flashdata('error', ('Please check File Format!'));
                        redirect(base_url('index.php/Bird/bird_manage'));
                      }          
       
                     } catch (Exception $e) {
                    // die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
                          //    . '": ' .$e->getMessage());
                          $this->session->set_flashdata('error', ('Please check File Format!'));
                          redirect(base_url('index.php/Bird/bird_manage'));
      
                  }
               }else{
      
                    $error_msg =  $error['error'];
                    $this->session->set_flashdata('error', ($error_msg));
                    redirect(base_url('index.php/Bird/bird_manage'));
      
               } 
                  
       
                 redirect(base_url('index.php/Bird/bird_manage'));
          
           }
           public function handfeeding_Download(){
            $this->load->helper('csv');
            $export_arr = array();
            $where_cond_s['status'] = 1;
            $title = array("Group Name","Aviary Name","Cage","Species Name","Male Parent Ring no","Female Parent Ring no","Egg no","Date of incubation","Egg type","Date of fertile",
            "Date of brooder 36","Date of brooder 35","Date of brooder 34","Date of brooder 33","Remark", "Pip Weight","Pip Date","Hatch Weight","Hatch Date","Shell weight","Hatch Type","Shell Thick","Dis type","Dis Date");
                array_push($export_arr, $title);
            convert_to_csv($export_arr, 'Handfeeding sample.csv', ',');
        } 
        public function preweaning_Download(){
          $this->load->helper('csv');
          $export_arr = array();
         // $where_cond_s['status'] = 1;
          $title = array("Group Name","Aviary Name","Cage","Species Name","Male Parent Ring no","Female Parent Ring no","Egg no","Date of incubation","Egg type","Date of fertile","Preweaning Moved Date","Health status",
          "Remark", "Pip Weight","Pip Date","Hatch Weight","Hatch Date","Shell weight","Hatch Type","Shell Thick","Dis type","Dis Date");
              array_push($export_arr, $title);
          convert_to_csv($export_arr, 'Preweaning sample.csv', ',');
      } 
      public function weaning_Download(){
        $this->load->helper('csv');
        $export_arr = array();
       // $where_cond_s['status'] = 1;
        $title = array("Group Name","Aviary Name","Cage","Species Name","Male Parent Ring no","Female Parent Ring no","Ring no","Date of incubation","Egg type","Date of fertile","Weaning Moved Date","Health status",
        "Remark", "Pip Weight","Pip Date","Hatch Weight","Hatch Date","Shell weight","Hatch Type","Shell Thick","Dis type","Dis Date");
            array_push($export_arr, $title);
        convert_to_csv($export_arr, 'Weaning sample.csv', ',');
    } 
           public function incubation_Download(){
            $this->load->helper('csv');
            $export_arr = array();
            $where_cond_s['status'] = 1;
            $title = array("Group Name","Aviary Name","Cage","Species Name","Male Parent Ring no","Female Parent Ring no","Egg no","Date of incubation","Egg type","Date of fertile","Remark",
            "Pip Weight","Pip Date","Hatch Weight","Hatch Date","Shell weight","Hatch Type","Shell Thick","Dis type","Dis Date","Egg weight");
                array_push($export_arr, $title);
            convert_to_csv($export_arr, 'Incubation sample.csv', ',');
        }   
        public function incubation_upload(){
  
          $user_id = $this->session->userdata('user_id');
          $branch_id = $this->session->userdata('branch_id');
          $get_cur_auto_id = $this->cbmodel->cur_auto_id('ckb_incubation');
          if($get_cur_auto_id == "false"){
             $auto_id="I001";
          }
                  
                  $path = 'uploads/';
                  require_once APPPATH . "/third_party/PHPExcel.php";
                  $config['upload_path'] = $path;
                  $config['allowed_types'] = 'xlsx|xls|csv';
                  $config['remove_spaces'] = TRUE;
                  $this->load->library('upload', $config);
                  $this->upload->initialize($config);            
                  if (!$this->upload->do_upload('uploadFile')) {
                      $error = array('error' => $this->upload->display_errors());
                  } else {
                      $data = array('upload_data' => $this->upload->data());
                  }
                  if(empty($error)){
                    if (!empty($data['upload_data']['file_name'])) {
                      $import_xls_file = $data['upload_data']['file_name'];
                  } else {
                      $import_xls_file = 0;
                  }
                  $inputFileName = $path . $import_xls_file;
                  
                  try {
                      $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
                      $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                      $objPHPExcel = $objReader->load($inputFileName);
                      $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
                      $flag = true;
                      $i=1;
                    // print_r ($allDataInSheet);
                     //  exit;
                       $group_name = $allDataInSheet[1]['A'];
                       $aviary = $allDataInSheet[1]['B'];
                       $cage = $allDataInSheet[1]['C'];
                       $sp = $allDataInSheet[1]['D'];
                       $male_ring_no = $allDataInSheet[1]['E'];
                       $female_ring_no = $allDataInSheet[1]['F'];
                       $eggno = $allDataInSheet[1]['G'];
                       $doi = $allDataInSheet[1]['H'];
                       $eggtype = $allDataInSheet[1]['I'];
                       $dof = $allDataInSheet[1]['J'];
                       $remark = $allDataInSheet[1]['K'];
                       $pweight = $allDataInSheet[1]['L'];
                       $pdate = $allDataInSheet[1]['M'];
                       $hw = $allDataInSheet[1]['N'];
                       $hd = $allDataInSheet[1]['O'];
                       $sw = $allDataInSheet[1]['P'];
                       $ht = $allDataInSheet[1]['Q'];
                       $sth = $allDataInSheet[1]['R'];
                       $dis_type = $allDataInSheet[1]['S'];
                       $dis_date = $allDataInSheet[1]['T'];
                       $egg_weight = $allDataInSheet[1]['U'];
                    
                       if ($egg_weight == "Egg weight" && $group_name == "Group Name" && $aviary == "Aviary Name" && $cage == "Cage" && $sp == "Species Name" && $male_ring_no == "Male Parent Ring no" && $female_ring_no == "Female Parent Ring no" &&  $eggno == "Egg no" && $doi == "Date of incubation" && $eggtype == "Egg type" && $dof == "Date of fertile" && $remark == "Remark" && $pweight == "Pip Weight" && $pdate == "Pip Date" && $hw == "Hatch Weight" && $hd == "Hatch Date" && $sw == "Shell weight" && $ht =="Hatch Type" && $sth =="Shell Thick" && $dis_type =="Dis type" && $dis_date == "Dis Date")
                     {
      
                      foreach ($allDataInSheet as $value) {
                        
                        if($flag){
                          $flag =false;
                          continue;
                        }
                        for ($char = 'A'; $char <= 'T'; $char++) {
                        if($value[$char] == NULL){
                          $value[$char] = "";
                         // echo $value[$char];
                         // exit;
                        }
                      }
                      
                       $auto_id = "I".str_pad( ( $get_cur_auto_id+$i ), 4, 0, STR_PAD_LEFT);
                      $where_cond_g['status'] = 1;
                      $where_cond_g['group_name'] = ucfirst($value['A']);
                      $where_cond_g['branch_id'] = $branch_id;
                      $av_id1 = $this->cbmodel->verify_data($where_cond_g,"ckb_group");
                     if($av_id1){
                      foreach ($av_id1 as $group) {
                        $group_id =  $group->auto_id;
                        $inserdata[$i]['group_id'] = $group_id;
                        $updatedata[$i]['group_id'] = $group_id;
                        }
                      }
                      else{
                        $this->session->set_flashdata('error', ( ucfirst($value['A']).'  Not Match/found in group list'));
                        redirect(base_url('index.php/Incubation/incubation'));
                        exit;
                      }
                        //aviary
                        $where_cond_a['status'] = 1;
                        $where_cond_a['aviary_name'] = ucfirst($value['B']);
                        $where_cond_a['branch_id'] = $branch_id;
                        $av_id2 = $this->cbmodel->verify_data($where_cond_a,"ckb_aviary");
                      if($av_id2){
                        foreach ($av_id2 as $av) {
                          $av_id =  $av->auto_id;
                          $inserdata[$i]['aviary_id'] = $av_id;
                          $updatedata[$i]['aviary_id'] = $av_id;
                          }
                        }
                          else{
                            $this->session->set_flashdata('error', ( ucfirst($value['B']).'  Not Match/found in Aviary list'));
                            redirect(base_url('index.php/Incubation/incubation'));
                            exit;
                          }
                          //species
                          $where_cond_s['status'] = 1;
                         $where_cond_s['bird_species'] = $value['D'];
                      // $where_cond_s['bird_species'] = ucfirst("Red Lory");
                          $where_cond_s['branch_id'] = $branch_id;
                          $av_id3 = $this->cbmodel->verify_data($where_cond_s,"ckb_species");
                         // print_r( $where_cond_s['bird_species']);
                         // print_r($where_cond_s['branch_id']);
                         // print_r($av_id3);
                    //  exit;
                          if($av_id3){
                          foreach ($av_id3 as $sp) {
                            $sp_id =  $sp->auto_id;
                            $inserdata[$i]['species_id'] = $sp_id;
                            $updatedata[$i]['species_id'] = $sp_id;
                            }
                          }
                            else{
                              $this->session->set_flashdata('error', ( ucfirst($value['D']).'  Not Match/found in Species list'));
                              redirect(base_url('index.php/Incubation/incubation'));
                              exit;
                            }
                        $inserdata[$i]['auto_id'] = $auto_id;
                        $inserdata[$i]['cage'] = ucfirst($value['C']);
                       
                        $inserdata[$i]['male_parent_ringno'] = $value['E'];
                        $inserdata[$i]['female_parent_ringno'] = ucfirst($value['F']);
                        $inserdata[$i]['egg_no'] = $value['G'];
                        $doi = strtotime(date("Y-m-d", strtotime($value['H'])));
                        $doi = date("Y-m-d", $doi);
                        $inserdata[$i]['doi'] = $doi;
                        $inserdata[$i]['fertile_type'] = $value['I'];
                        $dof = strtotime(date("Y-m-d", strtotime($value['J'])));
                        $dof = date("Y-m-d", $dof);
                        $inserdata[$i]['dof'] = $dof;
                        $inserdata[$i]['remark'] = $value['K'];
                        $inserdata[$i]['pip_weight'] = $value['L'];
                        $pip_date = strtotime(date("Y-m-d", strtotime($value['M'])));
                        $pip_date = date("Y-m-d", $pip_date);
                        $inserdata[$i]['pip_date'] = $pip_date;
                        $inserdata[$i]['hatch_weight'] = $value['N'];
                        $hatch_date = strtotime(date("Y-m-d", strtotime($value['0'])));
                        $hatch_date = date("Y-m-d", $hatch_date);
                        $inserdata[$i]['hatch_date'] = $hatch_date;
                        $inserdata[$i]['shell_weight'] = $value['P'];
                        $inserdata[$i]['hatch_type'] = $value['Q'];
                        $inserdata[$i]['shell_thick'] = $value['R'];
                        $inserdata[$i]['dis_type'] = $value['S'];
                        $dis_date = strtotime(date("Y-m-d", strtotime($value['T'])));
                        $dis_date = date("Y-m-d", $dis_date);
                        $inserdata[$i]['dis_date'] = $value['T'];
                        $inserdata[$i]['egg_weight'] = $value['U'];
                  
                        $inserdata[$i]['status'] = 1;
                        $inserdata[$i]['created_by'] = $user_id;
                        $inserdata[$i]['branch_id'] = $branch_id;
                        $check_eggno = $this->db->get_where('ckb_incubation', array('egg_no' => $value['G'], 'branch_id' => $branch_id ));
                         $if_exist = $check_eggno->num_rows();
                         if($if_exist > 0){
                        
                          $updatedata[$i]['cage'] = ucfirst($value['C']);
                       
                          $updatedata[$i]['male_parent_ringno'] = $value['E'];
                          $updatedata[$i]['female_parent_ringno'] = ucfirst($value['F']);
                          $updatedata[$i]['egg_no'] = $value['G'];
                          $doi = strtotime(date("Y-m-d", strtotime($value['H'])));
                          $doi = date("Y-m-d", $doi);
                          $updatedata[$i]['doi'] = $doi;
                          $updatedata[$i]['fertile_type'] = $value['I'];
                          $dof = strtotime(date("Y-m-d", strtotime($value['J'])));
                          $dof = date("Y-m-d", $dof);
                          $updatedata[$i]['dof'] = $dof;
                          $updatedata[$i]['remark'] = $value['K'];
                          $updatedata[$i]['pip_weight'] = $value['L'];
                          $pip_date = strtotime(date("Y-m-d", strtotime($value['M'])));
                          $pip_date = date("Y-m-d", $pip_date);
                          $updatedata[$i]['pip_date'] = $pip_date;
                          $updatedata[$i]['hatch_weight'] = $value['N'];
                          $hatch_date = strtotime(date("Y-m-d", strtotime($value['0'])));
                          $hatch_date = date("Y-m-d", $hatch_date);
                          $updatedata[$i]['hatch_date'] = $hatch_date;
                          $updatedata[$i]['shell_weight'] = $value['P'];
                          $updatedata[$i]['hatch_type'] = $value['Q'];
                          $updatedata[$i]['shell_thick'] = $value['R'];
                          $updatedata[$i]['dis_type'] = $value['S'];
                          $dis_date = strtotime(date("Y-m-d", strtotime($value['T'])));
                          $dis_date = date("Y-m-d", $dis_date);
                          $updatedata[$i]['dis_date'] = $value['T'];
                          $updatedata[$i]['egg_weight'] = $value['U'];
                    
                          $updatedata[$i]['status'] = 1;
                          $updatedata[$i]['created_by'] = $user_id;
                        
                          $incub_where= array('egg_no' => $value['G'] , 'branch_id' =>$branch_id);

                          $av_result = $this->masters_model->branch_updates('ckb_incubation', $updatedata[$i], $incub_where);
                       //   $av_result = $this->masters_model->updates('ckb_incubation', $inserdata[$i], 'egg_no', $value['G']);
                         }
                         else{
                        $av_result = $this->cbmodel->data_add('ckb_incubation',$inserdata[$i]);
                         }
                        $i++;
                       
                      }               
                    //  $av_result = $this->import->insert_bulk_data($inserdata,"ckb_incubation");   
                    $av_result = TRUE;
                  } // end aviary if
                      else {
                        $this->session->set_flashdata('error', ('Column order Does not match with your file, <br>please download the sample file and upload in it correct format!'));
                        redirect(base_url('index.php/Incubation/incubation'));
                       }
      
                      if($av_result == TRUE){
                        $this->session->set_flashdata('message', ('Incubation`s Data Successfully Imported!'));
                       redirect(base_url('index.php/Incubation/incubation'));
                      }
                      else if($av_result == FALSE ){
                        $this->session->set_flashdata('error', ('Please check File Format!'));
                        redirect(base_url('index.php/Incubation/incubation'));
                      }          
       
                     } catch (Exception $e) {
                    // die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
                          //    . '": ' .$e->getMessage());
                          $this->session->set_flashdata('error', ('Please check File Format!'));
                          redirect(base_url('index.php/Incubation/incubation'));
      
                  }
               }else{
      
                    $error_msg =  $error['error'];
                    $this->session->set_flashdata('error', ($error_msg));
                    redirect(base_url('index.php/Incubation/incubation'));
      
               } 
                  
       
                 redirect(base_url('index.php/Incubation/incubation'));
          
           }



           public function preweaning_upload(){
  
            $user_id = $this->session->userdata('user_id');
            $branch_id = $this->session->userdata('branch_id');
            $get_cur_auto_id = $this->cbmodel->cur_auto_id('ckb_incubation');
            if($get_cur_auto_id == "false"){
               $auto_id="I001";
            }
                    
                    $path = 'uploads/';
                    require_once APPPATH . "/third_party/PHPExcel.php";
                    $config['upload_path'] = $path;
                    $config['allowed_types'] = 'xlsx|xls|csv';
                    $config['remove_spaces'] = TRUE;
                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);            
                    if (!$this->upload->do_upload('uploadFile')) {
                        $error = array('error' => $this->upload->display_errors());
                    } else {
                        $data = array('upload_data' => $this->upload->data());
                    }
                    if(empty($error)){
                      if (!empty($data['upload_data']['file_name'])) {
                        $import_xls_file = $data['upload_data']['file_name'];
                    } else {
                        $import_xls_file = 0;
                    }
                    $inputFileName = $path . $import_xls_file;
                    
                    try {
                        $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
                        $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                        $objPHPExcel = $objReader->load($inputFileName);
                        $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
                        $flag = true;
                        $i=1;
                      // print_r ($allDataInSheet);
                       //  exit;
                         $group_name = $allDataInSheet[1]['A'];
                         $aviary = $allDataInSheet[1]['B'];
                         $cage = $allDataInSheet[1]['C'];
                         $sp = $allDataInSheet[1]['D'];
                         $male_ring_no = $allDataInSheet[1]['E'];
                         $female_ring_no = $allDataInSheet[1]['F'];
                         $eggno = $allDataInSheet[1]['G'];
                         $doi = $allDataInSheet[1]['H'];
                         $eggtype = $allDataInSheet[1]['I'];
                         $dof = $allDataInSheet[1]['J'];
                         $p_moved_date = $allDataInSheet[1]['K'];
                         $health_status = $allDataInSheet[1]['L'];
                         $remark = $allDataInSheet[1]['M'];
                         $pweight = $allDataInSheet[1]['N'];
                         $pdate = $allDataInSheet[1]['O'];
                         $hw = $allDataInSheet[1]['P'];
                         $hd = $allDataInSheet[1]['Q'];
                         $sw = $allDataInSheet[1]['R'];
                         $ht = $allDataInSheet[1]['S'];
                         $sth = $allDataInSheet[1]['T'];
                         $dis_type = $allDataInSheet[1]['U'];
                         $dis_date = $allDataInSheet[1]['V'];
                      
                         if ($group_name == "Group Name" && $aviary == "Aviary Name" && $cage == "Cage" && $sp == "Species Name" && $male_ring_no == "Male Parent Ring no" && $female_ring_no == "Female Parent Ring no" &&  $eggno == "Egg no" && $doi == "Date of incubation" && $eggtype == "Egg type" && $dof == "Date of fertile" && $remark == "Remark" && $pweight == "Pip Weight" && $pdate == "Pip Date" && $hw == "Hatch Weight" && $hd == "Hatch Date" && $sw == "Shell weight" && $ht =="Hatch Type" && $sth =="Shell Thick" && $dis_type =="Dis type" && $dis_date == "Dis Date" && $p_moved_date == "Preweaning Moved Date"&& $health_status == "Health status")
                       {
        
                        foreach ($allDataInSheet as $value) {
                          
                          if($flag){
                            $flag =false;
                            continue;
                          }
                          for ($char = 'A'; $char <= 'V'; $char++) {
                          if($value[$char] == NULL){
                            $value[$char] = "";
                           // echo $value[$char];
                           // exit;
                          }
                        }
                        
                         $auto_id = "I".str_pad( ( $get_cur_auto_id+$i ), 4, 0, STR_PAD_LEFT);
                        $where_cond_g['status'] = 1;
                        $where_cond_g['group_name'] = ucfirst($value['A']);
                        $where_cond_g['branch_id'] = $branch_id;
                        $av_id3 = $this->cbmodel->verify_data($where_cond_g,"ckb_group");
                     if($av_id3){
                        foreach ($av_id3 as $group) {
                          $group_id =  $group->auto_id;
                          $inserdata[$i]['group_id'] = $group_id;
                          $updatedata[$i]['group_id'] = $group_id;
                          }
                        }
                        else{
                          $this->session->set_flashdata('error', ( ucfirst($value['A']).'  Not Match/found in Group list'));
                          redirect(base_url('index.php/Preweaning/preweaning'));
                          exit;
                        }
                          //aviary
                          $where_cond_a['status'] = 1;
                          $where_cond_a['aviary_name'] = ucfirst($value['B']);
                          $where_cond_a['branch_id'] = $branch_id;
                          $av_id1 = $this->cbmodel->verify_data($where_cond_a,"ckb_aviary");
                        if($av_id1 ){
                          foreach ($av_id1 as $av) {
                            $av_id =  $av->auto_id;
                            $inserdata[$i]['aviary_id'] = $av_id;
                            $updatedata[$i]['aviary_id'] = $av_id;
                            }
                          }
                            else{
                              $this->session->set_flashdata('error', ( ucfirst($value['B']).'  Not Match/found in Aviary list'));
                              redirect(base_url('index.php/Preweaning/preweaning'));
                              exit;
                            }
                            //species
                            $where_cond_s['status'] = 1;
                            $where_cond_s['bird_species'] = ucfirst($value['D']);
                            $where_cond_s['branch_id'] = $branch_id;
                            $av_id2 = $this->cbmodel->verify_data($where_cond_s,"ckb_species");
                           if ($av_id2){
                            foreach ($av_id2 as $sp) {
                              $sp_id =  $sp->auto_id;
                              $inserdata[$i]['species_id'] = $sp_id;
                              $updatedata[$i]['species_id'] = $sp_id;
                              }
                            }
                            else{
                              $this->session->set_flashdata('error', ( ucfirst($value['D']).'  Not Match/found in Species list'));
                              redirect(base_url('index.php/Preweaning/preweaning'));
                              exit;
                            }
                              
                          $inserdata[$i]['auto_id'] = $auto_id;
                          $inserdata[$i]['cage'] = ucfirst($value['C']);
                         
                          $inserdata[$i]['male_parent_ringno'] = $value['E'];
                          $inserdata[$i]['female_parent_ringno'] = ucfirst($value['F']);
                          $inserdata[$i]['egg_no'] = $value['G'];
                          $doi = strtotime(date("Y-m-d", strtotime($value['H'])));
                          $doi = date("Y-m-d", $doi);
                          $inserdata[$i]['doi'] = $doi;
                          $inserdata[$i]['fertile_type'] = $value['I'];
                          $dof_date = strtotime(date("Y-m-d", strtotime($value['J'])));
                          $dof_date = date("Y-m-d", $dof_date);
                          $inserdata[$i]['dof'] =$dof_date;

                          $moved_pweaning_date = strtotime(date("Y-m-d", strtotime($value['K'])));
                            $moved_pweaning_date = date("Y-m-d", $moved_pweaning_date);
                            $inserdata[$i]['moved_pweaning_date'] = $moved_pweaning_date;
                         // $inserdata[$i]['moved_pweaning_date'] = $value['K'];
                          $inserdata[$i]['health_status'] = $value['L'];

                          $inserdata[$i]['remark'] = $value['M'];
                          $inserdata[$i]['pip_weight'] = $value['N'];
                        
 $pip_date = strtotime(date("Y-m-d", strtotime($value['O'])));
 $pip_date = date("Y-m-d", $pip_date);
 $inserdata[$i]['pip_date'] =  $pip_date;
                          $inserdata[$i]['hatch_weight'] = $value['P'];
                       
 $inserdata[$i]['hatch_weight'] = $value['P'];
 $hatch_date = strtotime(date("Y-m-d", strtotime($value['Q'])));
 $hatch_date = date("Y-m-d", $hatch_date);
                          $inserdata[$i]['shell_weight'] = $value['R'];
                          $inserdata[$i]['hatch_type'] = $value['S'];
                          $inserdata[$i]['shell_thick'] = $value['T'];
                          $inserdata[$i]['dis_type'] = $value['U'];
                    
  $dis_date = strtotime(date("Y-m-d", strtotime($value['V'])));
  $dis_date = date("Y-m-d", $dis_date);
  $inserdata[$i]['dis_date'] = $dis_date;
                          $inserdata[$i]['status'] = 2;
                          $inserdata[$i]['created_by'] = $user_id;

                          $data_insert[$i]['incub_id'] = $auto_id;
                          $data_insert[$i]['move_33_brooder'] ="B0004";
                          $data_insert[$i]['status'] = "3";
                          $data_insert[$i]['branch_id'] = $branch_id;
                          $inserdata[$i]['branch_id'] = $branch_id;
                        
                        
                          $check_eggno = $this->db->get_where('ckb_incubation', array('egg_no' => $value['G'],'branch_id' => $branch_id  ));
                          $if_exist = $check_eggno->num_rows();
                        
                          if($if_exist > 0){
                           
                           
                            $updatedata[$i]['cage'] = ucfirst($value['C']);
                         
                            $updatedata[$i]['male_parent_ringno'] = $value['E'];
                            $updatedata[$i]['female_parent_ringno'] = ucfirst($value['F']);
                            $updatedata[$i]['egg_no'] = $value['G'];
                            $doi = strtotime(date("Y-m-d", strtotime($value['H'])));
                            $doi = date("Y-m-d", $doi);
                            $updatedata[$i]['doi'] = $doi;
                            $updatedata[$i]['fertile_type'] = $value['I'];
                            $dof_date = strtotime(date("Y-m-d", strtotime($value['J'])));
                            $dof_date = date("Y-m-d", $dof_date);
                            $updatedata[$i]['dof'] =$dof_date;
  
                            $moved_pweaning_date = strtotime(date("Y-m-d", strtotime($value['K'])));
                              $moved_pweaning_date = date("Y-m-d", $moved_pweaning_date);
                              $updatedata[$i]['moved_pweaning_date'] = $moved_pweaning_date;
                           // $inserdata[$i]['moved_pweaning_date'] = $value['K'];
                            $updatedata[$i]['health_status'] = $value['L'];
  
                            $updatedata[$i]['remark'] = $value['M'];
                            $updatedata[$i]['pip_weight'] = $value['N'];
                          
   $pip_date = strtotime(date("Y-m-d", strtotime($value['O'])));
   $pip_date = date("Y-m-d", $pip_date);
   $updatedata[$i]['pip_date'] =  $pip_date;
                            $updatedata[$i]['hatch_weight'] = $value['P'];
                         
   $updatedata[$i]['hatch_weight'] = $value['P'];
   $hatch_date = strtotime(date("Y-m-d", strtotime($value['Q'])));
   $hatch_date = date("Y-m-d", $hatch_date);
                            $updatedata[$i]['shell_weight'] = $value['R'];
                            $updatedata[$i]['hatch_type'] = $value['S'];
                            $updatedata[$i]['shell_thick'] = $value['T'];
                            $updatedata[$i]['dis_type'] = $value['U'];
                      
    $dis_date = strtotime(date("Y-m-d", strtotime($value['V'])));
    $dis_date = date("Y-m-d", $dis_date);
    $updatedata[$i]['dis_date'] = $dis_date;
                            $updatedata[$i]['status'] = 2;
                            $updatedata[$i]['created_by'] = $user_id;
                         
                         

   $prewean_where= array('egg_no' => $value['G'] , 'branch_id' =>$branch_id);

   $av_result = $this->masters_model->branch_updates('ckb_incubation', $updatedata[$i], $prewean_where);

                         //   $av_result = $this->masters_model->updates('ckb_incubation', $inserdata[$i], 'egg_no', $value['G']);
                          }
                          else{
                         $av_result = $this->cbmodel->data_add('ckb_incubation',$inserdata[$i]);
                          }
                           
                          $i++;
                        }   
                        $mv_result = $this->import->insert_bulk_data($data_insert,"ckb_move_brooder"); 
                       // $av_result = $this->import->insert_bulk_data($inserdata,"ckb_incubation");   
                       $av_result = TRUE;
                      } // end aviary if
                        else {
                          $this->session->set_flashdata('error', ('Column order Does not match with your file, <br>please download the sample file and upload in it correct format!'));
                          redirect(base_url('index.php/Preweaning/preweaning'));
                         }
        
                        if($av_result == TRUE){
                          $this->session->set_flashdata('message', ('Preweaning`s Data Successfully Imported!'));
                         redirect(base_url('index.php/Preweaning/preweaning'));
                        }
                        else if($av_result == FALSE ){
                          $this->session->set_flashdata('error', ('Please check File Format!'));
                          redirect(base_url('index.php/Preweaning/preweaning'));
                        }          
         
                       } catch (Exception $e) {
                      // die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
                            //    . '": ' .$e->getMessage());
                            $this->session->set_flashdata('error', ('Please check File Format!'));
                            redirect(base_url('index.php/Preweaning/preweaning'));
        
                    }
                 }else{
        
                      $error_msg =  $error['error'];
                      $this->session->set_flashdata('error', ($error_msg));
                      redirect(base_url('index.php/Preweaning/preweaning'));
        
                 } 
                    
         
                   redirect(base_url('index.php/Preweaning/preweaning'));
            
             }

             public function weaning_upload(){
  
              $user_id = $this->session->userdata('user_id');
              $branch_id = $this->session->userdata('branch_id');
              $get_cur_auto_id = $this->cbmodel->cur_auto_id('ckb_incubation');
              if($get_cur_auto_id == "false"){
                 $auto_id="I001";
              }
                      
                      $path = 'uploads/';
                      require_once APPPATH . "/third_party/PHPExcel.php";
                      $config['upload_path'] = $path;
                      $config['allowed_types'] = 'xlsx|xls|csv';
                      $config['remove_spaces'] = TRUE;
                      $this->load->library('upload', $config);
                      $this->upload->initialize($config);            
                      if (!$this->upload->do_upload('uploadFile')) {
                          $error = array('error' => $this->upload->display_errors());
                      } else {
                          $data = array('upload_data' => $this->upload->data());
                      }
                      if(empty($error)){
                        if (!empty($data['upload_data']['file_name'])) {
                          $import_xls_file = $data['upload_data']['file_name'];
                      } else {
                          $import_xls_file = 0;
                      }
                      $inputFileName = $path . $import_xls_file;
                      
                      try {
                          $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
                          $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                          $objPHPExcel = $objReader->load($inputFileName);
                          $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
                          $flag = true;
                          $i=1;
                        // print_r ($allDataInSheet);
                         //  exit;
                           $group_name = $allDataInSheet[1]['A'];
                           $aviary = $allDataInSheet[1]['B'];
                           $cage = $allDataInSheet[1]['C'];
                           $sp = $allDataInSheet[1]['D'];
                           $male_ring_no = $allDataInSheet[1]['E'];
                           $female_ring_no = $allDataInSheet[1]['F'];
                           $eggno = $allDataInSheet[1]['G'];
                           $doi = $allDataInSheet[1]['H'];
                           $eggtype = $allDataInSheet[1]['I'];
                           $dof = $allDataInSheet[1]['J'];
                           $p_moved_date = $allDataInSheet[1]['K'];
                           $health_status = $allDataInSheet[1]['L'];
                           $remark = $allDataInSheet[1]['M'];
                           $pweight = $allDataInSheet[1]['N'];
                           $pdate = $allDataInSheet[1]['O'];
                           $hw = $allDataInSheet[1]['P'];
                           $hd = $allDataInSheet[1]['Q'];
                           $sw = $allDataInSheet[1]['R'];
                           $ht = $allDataInSheet[1]['S'];
                           $sth = $allDataInSheet[1]['T'];
                           $dis_type = $allDataInSheet[1]['U'];
                           $dis_date = $allDataInSheet[1]['V'];
                        
                           if ($group_name == "Group Name" && $aviary == "Aviary Name" && $cage == "Cage" && $sp == "Species Name" && $male_ring_no == "Male Parent Ring no" && $female_ring_no == "Female Parent Ring no" &&  $eggno == "Ring no" && $doi == "Date of incubation" && $eggtype == "Egg type" && $dof == "Date of fertile" && $remark == "Remark" && $pweight == "Pip Weight" && $pdate == "Pip Date" && $hw == "Hatch Weight" && $hd == "Hatch Date" && $sw == "Shell weight" && $ht =="Hatch Type" && $sth =="Shell Thick" && $dis_type =="Dis type" && $dis_date == "Dis Date" && $p_moved_date == "Weaning Moved Date"&& $health_status == "Health status")
                         {
          
                          foreach ($allDataInSheet as $value) {
                            
                            if($flag){
                              $flag =false;
                              continue;
                            }
                            for ($char = 'A'; $char <= 'V'; $char++) {
                            if($value[$char] == NULL){
                              $value[$char] = "";
                             // echo $value[$char];
                             // exit;
                            }
                          }
                          
                           $auto_id = "I".str_pad( ( $get_cur_auto_id+$i ), 4, 0, STR_PAD_LEFT);
                          $where_cond_g['status'] = 1;
                          $where_cond_g['group_name'] = ucfirst($value['A']);
                          $where_cond_g['branch_id'] = $branch_id;
                          $av_id1 = $this->cbmodel->verify_data($where_cond_g,"ckb_group");
                          if($av_id1){
                          foreach ($av_id1 as $group) {
                            $group_id =  $group->auto_id;
                            $inserdata[$i]['group_id'] = $group_id;
                            $updatedata[$i]['group_id'] = $group_id;
                            }
                          }
                          else{
                            $this->session->set_flashdata('error', ( ucfirst($value['A']).'  Not Match/found in Group list'));
                            redirect(base_url('index.php/Weaning/weaning'));
                            exit;
                          }
                            //aviary
                            $where_cond_a['status'] = 1;
                            $where_cond_a['aviary_name'] = ucfirst($value['B']);
                            $where_cond_a['branch_id'] = $branch_id;
                            $av_id2 = $this->cbmodel->verify_data($where_cond_a,"ckb_aviary");
                            if($av_id2){
                            foreach ($av_id2 as $av) {
                              $av_id =  $av->auto_id;
                              $inserdata[$i]['aviary_id'] = $av_id;
                              $updatedata[$i]['aviary_id'] = $av_id;
                              }
                            }
                              else{
                                $this->session->set_flashdata('error', ( ucfirst($value['B']).'  Not Match/found in Aviary list'));
                                redirect(base_url('index.php/Weaning/weaning'));
                                exit;
                              }
                              //species
                              $where_cond_s['status'] = 1;
                              $where_cond_s['bird_species'] = ucfirst($value['D']);
                              $where_cond_s['branch_id'] = $branch_id;
                              $av_id3 = $this->cbmodel->verify_data($where_cond_s,"ckb_species");
                             if($av_id3){
                              foreach ($av_id3 as $sp) {
                                $sp_id =  $sp->auto_id;
                                $inserdata[$i]['species_id'] = $sp_id;
                                $updatedata[$i]['species_id'] = $sp_id;
                                }
                              }
                              else{
                                $this->session->set_flashdata('error', ( ucfirst($value['D']).'  Not Match/found in Species list'));
                                redirect(base_url('index.php/Weaning/weaning'));
                                exit;
                              }
                            $inserdata[$i]['auto_id'] = $auto_id;
                            $inserdata[$i]['cage'] = ucfirst($value['C']);
                           
                            $inserdata[$i]['male_parent_ringno'] = $value['E'];
                            $inserdata[$i]['female_parent_ringno'] = ucfirst($value['F']);
                            $inserdata[$i]['weaning_ring_no'] = $value['G'];
                            $inserdata[$i]['egg_no'] = $value['G'];
                            $doi_date = strtotime(date("Y-m-d", strtotime($value['H'])));
                            $doi_date = date("Y-m-d", $doi_date);
                            
                            $inserdata[$i]['doi'] = $doi_date;
                            $inserdata[$i]['fertile_type'] = $value['I'];
                            $dof_date = strtotime(date("Y-m-d", strtotime($value['J'])));
                            $dof_date = date("Y-m-d", $dof_date);
                            $inserdata[$i]['dof'] =$dof_date;
                          
                            $moved_weaning_date = strtotime(date("Y-m-d", strtotime($value['K'])));
                            $moved_weaning_date = date("Y-m-d", $moved_weaning_date);
                            $inserdata[$i]['moved_weaning_date'] = $moved_weaning_date;
                            $inserdata[$i]['health_status'] = $value['L'];
  
                            $inserdata[$i]['remark'] = $value['M'];
                            $inserdata[$i]['pip_weight'] = $value['N'];
                            $pip_date = strtotime(date("Y-m-d", strtotime($value['O'])));
                            $pip_date = date("Y-m-d", $pip_date);
                            $inserdata[$i]['pip_date'] =  $pip_date;
                            $inserdata[$i]['hatch_weight'] = $value['P'];
                            $hatch_date = strtotime(date("Y-m-d", strtotime($value['Q'])));
                            $hatch_date = date("Y-m-d", $hatch_date);
                            $inserdata[$i]['hatch_date'] = $hatch_date;
                            $inserdata[$i]['shell_weight'] = $value['R'];
                            $inserdata[$i]['hatch_type'] = $value['S'];
                            $inserdata[$i]['shell_thick'] = $value['T'];
                            $inserdata[$i]['dis_type'] = $value['U'];
                            $dis_date = strtotime(date("Y-m-d", strtotime($value['V'])));
                            $dis_date = date("Y-m-d", $dis_date);
                            $inserdata[$i]['dis_date'] = $dis_date;
                            $inserdata[$i]['status'] = 3;
                            $inserdata[$i]['created_by'] = $user_id;  
                           
                            $inserdata[$i]['branch_id'] = $branch_id;

                            $data_insert[$i]['incub_id'] = $auto_id;
                            $data_insert[$i]['move_33_brooder'] ="B0004";
                            $data_insert[$i]['status'] = "3";
                            $data_insert[$i]['branch_id'] = $branch_id;
                           
                            $check_eggno = $this->db->get_where('ckb_incubation', array('egg_no' => $value['G'],'branch_id' =>$branch_id ));
                            $if_exist = $check_eggno->num_rows();
                          
                            if($if_exist > 0){

                              $updatedata[$i]['cage'] = ucfirst($value['C']);
                           
                              $updatedata[$i]['male_parent_ringno'] = $value['E'];
                              $updatedata[$i]['female_parent_ringno'] = ucfirst($value['F']);
                              $updatedata[$i]['weaning_ring_no'] = $value['G'];
                              $updatedata[$i]['egg_no'] = $value['G'];
                              $doi_date = strtotime(date("Y-m-d", strtotime($value['H'])));
                              $doi_date = date("Y-m-d", $doi_date);
                              
                              $updatedata[$i]['doi'] = $doi_date;
                              $updatedata[$i]['fertile_type'] = $value['I'];
                              $dof_date = strtotime(date("Y-m-d", strtotime($value['J'])));
                              $dof_date = date("Y-m-d", $dof_date);
                              $updatedata[$i]['dof'] =$dof_date;
                            
                              $moved_weaning_date = strtotime(date("Y-m-d", strtotime($value['K'])));
                              $moved_weaning_date = date("Y-m-d", $moved_weaning_date);
                              $updatedata[$i]['moved_weaning_date'] = $moved_weaning_date;
                              $updatedata[$i]['health_status'] = $value['L'];
    
                              $updatedata[$i]['remark'] = $value['M'];
                              $updatedata[$i]['pip_weight'] = $value['N'];
                              $pip_date = strtotime(date("Y-m-d", strtotime($value['O'])));
                              $pip_date = date("Y-m-d", $pip_date);
                              $updatedata[$i]['pip_date'] =  $pip_date;
                              $updatedata[$i]['hatch_weight'] = $value['P'];
                              $hatch_date = strtotime(date("Y-m-d", strtotime($value['Q'])));
                              $hatch_date = date("Y-m-d", $hatch_date);
                              $updatedata[$i]['hatch_date'] = $hatch_date;
                              $updatedata[$i]['shell_weight'] = $value['R'];
                              $updatedata[$i]['hatch_type'] = $value['S'];
                              $updatedata[$i]['shell_thick'] = $value['T'];
                              $updatedata[$i]['dis_type'] = $value['U'];
                              $dis_date = strtotime(date("Y-m-d", strtotime($value['V'])));
                              $dis_date = date("Y-m-d", $dis_date);
                              $updatedata[$i]['dis_date'] = $dis_date;
                              $updatedata[$i]['status'] = 3;
                              $updatedata[$i]['created_by'] = $user_id;  
                            
                              $wean_where= array('egg_no' => $value['G'] , 'branch_id' =>$branch_id);

                              $av_result = $this->masters_model->branch_updates('ckb_incubation', $updatedata[$i], $wean_where);
    
                            // $av_result = $this->masters_model->updates('ckb_incubation', $inserdata[$i], 'egg_no', $value['G']);
                            }
                            else{
                           $av_result = $this->cbmodel->data_add('ckb_incubation',$inserdata[$i]);
                            }
                         
                            $i++;
                          }               
                          $mv_result = $this->import->insert_bulk_data($data_insert,"ckb_move_brooder"); 
                         // $av_result = $this->import->insert_bulk_data($inserdata,"ckb_incubation");   
                         $av_result = TRUE;
                        } // end aviary if
                          else {
                            $this->session->set_flashdata('error', ('Column order Does not match with your file, <br>please download the sample file and upload in it correct format!'));
                            redirect(base_url('index.php/Weaning/weaning'));
                           }
          
                          if($av_result == TRUE){
                            $this->session->set_flashdata('message', ('Weaning`s Data Successfully Imported!'));
                           redirect(base_url('index.php/Weaning/weaning'));
                          }
                          else if($av_result == FALSE ){
                            $this->session->set_flashdata('error', ('Please check File Format!'));
                            redirect(base_url('index.php/Weaning/weaning'));
                          }          
           
                         } catch (Exception $e) {
                        // die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
                              //    . '": ' .$e->getMessage());
                              $this->session->set_flashdata('error', ('Please check File Format!'));
                              redirect(base_url('index.php/Weaning/weaning'));
          
                      }
                   }else{
          
                        $error_msg =  $error['error'];
                        $this->session->set_flashdata('error', ($error_msg));
                        redirect(base_url('index.php/Weaning/weaning'));
          
                   } 
                      
           
                     redirect(base_url('index.php/Weaning/weaning'));
              
               }

               public function handfeeding_upload(){
  
                $user_id = $this->session->userdata('user_id');
                $branch_id = $this->session->userdata('branch_id');
               // $branch_id = $this->session->userdata('branch_id');
                $get_cur_auto_id = $this->cbmodel->cur_auto_id('ckb_incubation');
                if($get_cur_auto_id == "false"){
                   $auto_id="I001";
                }
                        
                        $path = 'uploads/';
                        require_once APPPATH . "/third_party/PHPExcel.php";
                        $config['upload_path'] = $path;
                        $config['allowed_types'] = 'xlsx|xls|csv';
                        $config['remove_spaces'] = TRUE;
                        $this->load->library('upload', $config);
                        $this->upload->initialize($config);            
                        if (!$this->upload->do_upload('uploadFile')) {
                            $error = array('error' => $this->upload->display_errors());
                        } else {
                            $data = array('upload_data' => $this->upload->data());
                        }
                        if(empty($error)){
                          if (!empty($data['upload_data']['file_name'])) {
                            $import_xls_file = $data['upload_data']['file_name'];
                        } else {
                            $import_xls_file = 0;
                        }
                        $inputFileName = $path . $import_xls_file;
                        
                        try {
                            $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
                            $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                            $objPHPExcel = $objReader->load($inputFileName);
                            $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
                            $flag = true;
                            $i=1;
                          // print_r ($allDataInSheet);
                           //  exit;
                             $group_name = $allDataInSheet[1]['A'];
                             $aviary = $allDataInSheet[1]['B'];
                             $cage = $allDataInSheet[1]['C'];
                             $sp = $allDataInSheet[1]['D'];
                             $male_ring_no = $allDataInSheet[1]['E'];
                             $female_ring_no = $allDataInSheet[1]['F'];
                             $eggno = $allDataInSheet[1]['G'];
                            
                             $doi = $allDataInSheet[1]['H'];
                             $eggtype = $allDataInSheet[1]['I'];
                             $dof = $allDataInSheet[1]['J'];
                           
                             $b_36 = $allDataInSheet[1]['K'];
                             $b_35 = $allDataInSheet[1]['L'];
                             $b_34 = $allDataInSheet[1]['M'];
                             $b_33 = $allDataInSheet[1]['N'];
                           
                             $remark = $allDataInSheet[1]['O'];
                             $pweight = $allDataInSheet[1]['P'];
                             $pdate = $allDataInSheet[1]['Q'];
                             $hw = $allDataInSheet[1]['R'];
                             $hd = $allDataInSheet[1]['S'];
                             $sw = $allDataInSheet[1]['T'];
                             $ht = $allDataInSheet[1]['U'];
                             $sth = $allDataInSheet[1]['V'];
                             $dis_type = $allDataInSheet[1]['W'];
                             $dis_date = $allDataInSheet[1]['X'];
                          
                             if ( $b_36 == "Date of brooder 36" && $b_35 == "Date of brooder 35" && $b_34 == "Date of brooder 34" && $b_33 == "Date of brooder 33" && $group_name == "Group Name" && $aviary == "Aviary Name" && $cage == "Cage" && $sp == "Species Name" && $male_ring_no == "Male Parent Ring no" && $female_ring_no == "Female Parent Ring no" &&  $eggno == "Egg no" && $doi == "Date of incubation" && $eggtype == "Egg type" && $dof == "Date of fertile" && $remark == "Remark" && $pweight == "Pip Weight" && $pdate == "Pip Date" && $hw == "Hatch Weight" && $hd == "Hatch Date" && $sw == "Shell weight" && $ht =="Hatch Type" && $sth =="Shell Thick" && $dis_type =="Dis type" && $dis_date == "Dis Date")
                           {
            
                            foreach ($allDataInSheet as $value) {
                              
                              if($flag){
                                $flag =false;
                                continue;
                              }
                              for ($char = 'A'; $char <= 'X'; $char++) {
                              if($value[$char] == NULL){
                                $value[$char] = "";
                               // echo $value[$char];
                               // exit;
                              }
                            }
                            
                             $auto_id = "I".str_pad( ( $get_cur_auto_id+$i ), 4, 0, STR_PAD_LEFT);
                            $where_cond_g['status'] = 1;
                            $where_cond_g['group_name'] = ucfirst($value['A']);
                            $where_cond_g['branch_id'] = $branch_id;
                            $av_id1 = $this->cbmodel->verify_data($where_cond_g,"ckb_group");
                            if($av_id1){
                            foreach ($av_id1 as $group) {
                              $group_id =  $group->auto_id;
                              $inserdata[$i]['group_id'] = $group_id;
                              $updatedata[$i]['group_id'] = $group_id;
                              }
                            }
                              else{
                                $this->session->set_flashdata('error', ( ucfirst($value['A']).'  Not Match/found in Group list'));
                                redirect(base_url('index.php/Handfeeding/handfeeding'));
                                exit;
                              }
                          
                              //aviary
                              $where_cond_a['status'] = 1;
                              $where_cond_a['aviary_name'] = ucfirst($value['B']);
                              $where_cond_a['branch_id'] = $branch_id;
                              $av_id2 = $this->cbmodel->verify_data($where_cond_a,"ckb_aviary");
                              if($av_id2){
                              foreach ($av_id2 as $av) {
                                $av_id =  $av->auto_id;
                                $inserdata[$i]['aviary_id'] = $av_id;
                                $updatedata[$i]['aviary_id'] = $av_id;
                                }
                              }
                             
                                else{
                                  $this->session->set_flashdata('error', ( ucfirst($value['B']).'  Not Match/found in Aviary list'));
                                  redirect(base_url('index.php/Handfeeding/handfeeding'));
                                  exit;
                                }
                            
                                //species
                                $where_cond_s['status'] = 1;
                                $where_cond_s['bird_species'] = ucfirst($value['D']);
                                $where_cond_s['branch_id'] = $branch_id;
                                $av_id3 = $this->cbmodel->verify_data($where_cond_s,"ckb_species");
                                if($av_id3){
                                foreach ($av_id3 as $sp) {
                                  $sp_id =  $sp->auto_id;
                                  $inserdata[$i]['species_id'] = $sp_id;
                                  $updatedata[$i]['species_id'] = $sp_id;
                                  }
                                }
                                else{
                                  $this->session->set_flashdata('error', ( ucfirst($value['D']).'  Not Match/found in species list'));
                                  redirect(base_url('index.php/Handfeeding/handfeeding'));
                                  exit;
                                }
                              $inserdata[$i]['auto_id'] = $auto_id;
                              $inserdata[$i]['cage'] = ucfirst($value['C']);
                             
                              $inserdata[$i]['male_parent_ringno'] = $value['E'];
                              $inserdata[$i]['female_parent_ringno'] = ucfirst($value['F']);
                              $inserdata[$i]['egg_no'] = $value['G'];
                              
                              $doi_date = strtotime(date("Y-m-d", strtotime($value['H'])));
                              $doi_date = date("Y-m-d", $doi_date);
                              
                              $inserdata[$i]['doi'] = $doi_date;
                              $inserdata[$i]['fertile_type'] = $value['I'];
                              $dof_date = strtotime(date("Y-m-d", strtotime($value['J'])));
                              $dof_date = date("Y-m-d", $dof_date);
                              $inserdata[$i]['dof'] =$dof_date;
    
                             
    
                              $inserdata[$i]['remark'] = $value['O'];
                              $inserdata[$i]['pip_weight'] = $value['P'];
                              $pip_date = strtotime(date("Y-m-d", strtotime($value['Q'])));
                              $pip_date = date("Y-m-d", $pip_date);
                              $inserdata[$i]['pip_date'] = $pip_date;
                              $inserdata[$i]['hatch_weight'] = $value['R'];

                              $hatch_date = strtotime(date("Y-m-d", strtotime($value['S'])));
                              $hatch_date = date("Y-m-d", $hatch_date);
                              $inserdata[$i]['hatch_date'] = $hatch_date;
                              $inserdata[$i]['shell_weight'] = $value['T'];
                              $inserdata[$i]['hatch_type'] = $value['U'];
                              $inserdata[$i]['shell_thick'] = $value['V'];
                              $inserdata[$i]['dis_type'] = $value['W'];
                              $dis_date = strtotime(date("Y-m-d", strtotime($value['X'])));
                              $dis_date = date("Y-m-d", $dis_date);
                              $inserdata[$i]['dis_date'] = $dis_date;
                              $inserdata[$i]['status'] = 0;
                              $inserdata[$i]['created_by'] = $user_id;
                           
                              $data_insert[$i]['incub_id'] = $auto_id;
                              $move_handfeed_date = strtotime(date("Y-m-d", strtotime($value['K'])));
                              $move_handfeed_date = date("Y-m-d", $move_handfeed_date);
                              $data_insert[$i]['move_handfeed_date'] = $move_handfeed_date;
                            
                              $move_35_date = strtotime(date("Y-m-d", strtotime($value['L'])));
                              $move_35_date = date("Y-m-d", $move_35_date);
                              $data_insert[$i]['move_35_date'] = $move_35_date;
                              $move_34_date = strtotime(date("Y-m-d", strtotime($value['M'])));
                              $move_34_date = date("Y-m-d", $move_34_date);
                              $data_insert[$i]['move_34_date'] = $move_34_date;
                              $move_33_date = strtotime(date("Y-m-d", strtotime($value['N'])));
                              $move_33_date = date("Y-m-d", $move_33_date);
                              $data_insert[$i]['move_33_date'] = $value['N'];

                              $data_insert[$i]['move_handfeed_brooder'] = "B0001";
                              $data_insert[$i]['move_35_brooder'] = "B0002";
                              $data_insert[$i]['move_34_brooder'] ="B0003";
                              $data_insert[$i]['move_33_brooder'] ="B0004";

                              $inserdata[$i]['branch_id'] = $branch_id;
                              $data_insert[$i]['branch_id'] =$branch_id;

                              $check_eggno = $this->db->get_where('ckb_incubation', array('egg_no' => $value['G'],'branch_id' => $branch_id ));
                              $if_exist = $check_eggno->num_rows();
                              if($if_exist > 0){
                                $updatedata[$i]['cage'] = ucfirst($value['C']);
                             
                                $updatedata[$i]['male_parent_ringno'] = $value['E'];
                                $updatedata[$i]['female_parent_ringno'] = ucfirst($value['F']);
                                $updatedata[$i]['egg_no'] = $value['G'];
                                
                                $doi_date = strtotime(date("Y-m-d", strtotime($value['H'])));
                                $doi_date = date("Y-m-d", $doi_date);
                                
                                $updatedata[$i]['doi'] = $doi_date;
                                $updatedata[$i]['fertile_type'] = $value['I'];
                                $dof_date = strtotime(date("Y-m-d", strtotime($value['J'])));
                                $dof_date = date("Y-m-d", $dof_date);
                                $updatedata[$i]['dof'] =$dof_date;
      
                               
      
                                $updatedata[$i]['remark'] = $value['O'];
                                $updatedata[$i]['pip_weight'] = $value['P'];
                                $pip_date = strtotime(date("Y-m-d", strtotime($value['Q'])));
                                $pip_date = date("Y-m-d", $pip_date);
                                $updatedata[$i]['pip_date'] = $pip_date;
                                $updatedata[$i]['hatch_weight'] = $value['R'];
  
                                $hatch_date = strtotime(date("Y-m-d", strtotime($value['S'])));
                                $hatch_date = date("Y-m-d", $hatch_date);
                                $updatedata[$i]['hatch_date'] = $hatch_date;
                                $updatedata[$i]['shell_weight'] = $value['T'];
                                $updatedata[$i]['hatch_type'] = $value['U'];
                                $updatedata[$i]['shell_thick'] = $value['V'];
                                $updatedata[$i]['dis_type'] = $value['W'];
                                $dis_date = strtotime(date("Y-m-d", strtotime($value['X'])));
                                $dis_date = date("Y-m-d", $dis_date);
                                $updatedata[$i]['dis_date'] = $dis_date;
                                $updatedata[$i]['status'] = 0;
                                $updatedata[$i]['created_by'] = $user_id;
                             
                               // $data_insert[$i]['incub_id'] = $auto_id;
                                $move_handfeed_date = strtotime(date("Y-m-d", strtotime($value['K'])));
                                $move_handfeed_date = date("Y-m-d", $move_handfeed_date);
                               // $data_insert[$i]['move_handfeed_date'] = $move_handfeed_date;
                                $data_update[$i]['move_handfeed_date'] = $move_handfeed_date;
                              
                                $move_35_date = strtotime(date("Y-m-d", strtotime($value['L'])));
                                $move_35_date = date("Y-m-d", $move_35_date);
                               
                                $data_update[$i]['move_35_date'] = $move_35_date;
                              
                                $move_34_date = strtotime(date("Y-m-d", strtotime($value['M'])));
                                $move_34_date = date("Y-m-d", $move_34_date);
                                $data_update[$i]['move_34_date'] = $move_34_date;
                              
                                $move_33_date = strtotime(date("Y-m-d", strtotime($value['N'])));
                                $move_33_date = date("Y-m-d", $move_33_date);
                                $data_update[$i]['move_33_date'] = $value['N'];
  
                                $data_update[$i]['move_handfeed_brooder'] = "B0001";
                                $data_update[$i]['move_35_brooder'] = "B0002";
                                $data_update[$i]['move_34_brooder'] ="B0003";
                                $data_update[$i]['move_33_brooder'] ="B0004";
                             
                                $handfeed_where= array('egg_no' => $value['G'] , 'branch_id' =>$branch_id);
                               // $move_brooder= array('incub_id' => $value['G'] , 'branch_id' =>$branch_id);
                                $av_result = $this->masters_model->branch_updates('ckb_incubation', $updatedata[$i], $handfeed_where);
                              //  $mv_result =$this->masters_model->branch_updates('ckb_move_brooder', $data_update[$i], $handfeed_where);

                                // $av_result = $this->masters_model->updates('ckb_incubation', $inserdata[$i], 'egg_no', $value['G']);
                              }
                              else{
                             $av_result = $this->cbmodel->data_add('ckb_incubation',$inserdata[$i]);
                              }
                              $i++;
                            }  
                             $mv_result = $this->import->insert_bulk_data($data_insert,"ckb_move_brooder"); 
                             //print_r($mv_result);
                            // exit;
                            $av_result = TRUE;
                          //  $av_result = $this->import->insert_bulk_data($inserdata,"ckb_incubation");   
                          } // end aviary if
                            else {
                              $this->session->set_flashdata('error', ('Column order Does not match with your file, <br>please download the sample file and upload in it correct format!'));
                              redirect(base_url('index.php/Handfeeding/handfeeding'));
                             }
            
                            if($av_result == TRUE){
                              $this->session->set_flashdata('message', ('Handfeeding`s Data Successfully Imported!'));
                             redirect(base_url('index.php/Handfeeding/handfeeding'));
                            }
                            else if($av_result == FALSE ){
                              $this->session->set_flashdata('error', ('Please check File Format!'));
                              redirect(base_url('index.php/Handfeeding/handfeeding'));
                            }          
             
                           } catch (Exception $e) {
                          // die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
                                //    . '": ' .$e->getMessage());
                                $this->session->set_flashdata('error', ('Please check File Format!'));
                                redirect(base_url('index.php/Handfeeding/handfeeding'));
            
                        }
                     }else{
            
                          $error_msg =  $error['error'];
                          $this->session->set_flashdata('error', ($error_msg));
                          redirect(base_url('index.php/Handfeeding/handfeeding'));
            
                     } 
                        
             
                       redirect(base_url('index.php/Handfeeding/handfeeding'));
                
                 }

}//end class
 