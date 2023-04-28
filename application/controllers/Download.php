<?php 
 
defined('BASEPATH') OR exit('No direct script access allowed');  
  
class Download extends CI_Controller {  
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
  public function stock_register_csv() {
    $this->load->helper('csv');
    $export_arr = array();
    $title = array("Particulars","Type");
    $values = ""; 
    array_push($export_arr, $title);
    if (!empty($values)) {
            array_push($export_arr,$values );
        }
    convert_to_csv($export_arr, 'Stock register.csv', ',');
}
/*************** Aviary Function  **************************************************************/
public function export_aviary_csv() {
    $this->load->helper('csv');
    $export_arr = array();
    $title = array("Aviary Name");
    $values = array("Aruvi"); 
    array_push($export_arr, $title);
    if (!empty($values)) {
            array_push($export_arr,$values );
        }
    convert_to_csv($export_arr, 'Aviary sample.csv', ',');
}
public function stock_register_upload(){

  $user_id = $this->session->userdata('user_id');
  $branch_id = $this->session->userdata('branch_id');
  $get_cur_auto_id = $this->cbmodel->cur_auto_id('ckb_stock_register_upload');
  if($get_cur_auto_id == "false"){
     $auto_id="SR001";
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
            
               $part = $allDataInSheet[1]['A'];
               $type = $allDataInSheet[1]['B'];
             if($part == "Particulars" && $type == "Type"){

              foreach ($allDataInSheet as $value) {
                if($flag){
                  $flag =false;
                  continue;
                }
               // print_r ($value);
               // exit;
              // else{
               $auto_id = "SR".str_pad( ( $get_cur_auto_id+$i ), 4, 0, STR_PAD_LEFT);
              // }
                $inserdata[$i]['auto_id'] = $auto_id;
                $inserdata[$i]['particular'] = ucfirst($value['A']);
                $inserdata[$i]['type'] = ucfirst($value['B']);
                $inserdata[$i]['branch_id'] = $branch_id;
               // $inserdata[$i]['created_by'] = $user_id;
             
                $i++;
              }               
              $av_result = $this->import->stock_upload($inserdata);   
            } // end aviary if
               else{
                $this->session->set_flashdata('error', ('Column order Does not match with your file, <br>please download the sample file and upload in it correct format!'));
                redirect(base_url('Masters/stock_register'));
               }

              if($av_result == TRUE){
                $this->session->set_flashdata('message', ('Stock register`s Data Successfully Imported!'));
               redirect(base_url('Masters/stock_register'));
              }
              else if($av_result == FALSE ){
                $this->session->set_flashdata('error', ('Please check File Format!'));
                redirect(base_url('Masters/stock_register'));
              }          

             } catch (Exception $e) {
            // die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
                  //    . '": ' .$e->getMessage());
                  $this->session->set_flashdata('error', ('Please check File Format!'));
                  redirect(base_url('index.php/Masters/stock_register'));

          }
       }else{

            $error_msg =  $error['error'];
            $this->session->set_flashdata('error', ($error_msg));
            redirect(base_url('index.php/Masters/stock_register'));

       } 
          

         redirect(base_url('index.php/Masters/stock_register'));
  
   }
  
public function aviary_upload(){
  $branch_id = $this->session->userdata('branch_id');
    $user_id = $this->session->userdata('user_id');
    $get_cur_auto_id = $this->cbmodel->cur_auto_id('ckb_aviary');
    if($get_cur_auto_id == "false"){
       $auto_id="A001";
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
              
                 $aviary_name = $allDataInSheet[1]['A'];
               if($aviary_name == "Aviary Name"){

                foreach ($allDataInSheet as $value) {
                  if($flag){
                    $flag =false;
                    continue;
                  }
                 // print_r ($value);
                 // exit;
                // else{
                 $auto_id = "A".str_pad( ( $get_cur_auto_id+$i ), 4, 0, STR_PAD_LEFT);
                // }
                  $inserdata[$i]['auto_id'] = $auto_id;
                  $inserdata[$i]['aviary_name'] = ucfirst($value['A']);
                  $inserdata[$i]['status'] = 1;
                  $inserdata[$i]['created_by'] = $user_id;
                  $inserdata[$i]['branch_id'] = $branch_id;
               
                  $i++;
                }               
                $av_result = $this->import->insert_bulk_data($inserdata,"ckb_aviary");   
              } // end aviary if
                 else{
                  $this->session->set_flashdata('error', ('Column order Does not match with your file, <br>please download the sample file and upload in it correct format!'));
                  redirect(base_url('index.php/Masters/aviary'));
                 }

                if($av_result == TRUE){
                  $this->session->set_flashdata('message', ('Aviary`s Data Successfully Imported!'));
                 redirect(base_url('index.php/Masters/aviary'));
                }
                else if($av_result == FALSE ){
                  $this->session->set_flashdata('error', ('Please check File Format!'));
                  redirect(base_url('index.php/Masters/aviary'));
                }          
 
               } catch (Exception $e) {
              // die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
                    //    . '": ' .$e->getMessage());
                    $this->session->set_flashdata('error', ('Please check File Format!'));
                    redirect(base_url('index.php/Masters/aviary'));

            }
         }else{

              $error_msg =  $error['error'];
              $this->session->set_flashdata('error', ($error_msg));
              redirect(base_url('index.php/Masters/aviary'));

         } 
            
 
           redirect(base_url('index.php/Masters/aviary'));
    
     }
 
    /*************** End of Aviary Function  **************************************************************/
       /*************** Start of cage Function  **************************************************************/

       public function cage_Download(){
        $this->load->helper('csv');
          $export_arr = array();
          $where_cond_s['status'] = 1;
          $result = $this->cbmodel->verify_data($where_cond_s,"ckb_aviary");
        //  $data['Info'] =  $this->import->exportExcel();
       // print_r($result);
       // exit;
              $title = array("Aviary Name","Cage","Diet pattern","Target mrng Feed","Target Aft Feed");
              array_push($export_arr, $title);
              if (!empty($result)) {
                  foreach ($result as $aviary) {
                      array_push($export_arr, array($aviary->aviary_name));
                  }
              }
          convert_to_csv($export_arr, 'Cage sample.csv', ',');
      }

      public function cage_upload(){

        $user_id = $this->session->userdata('user_id');
        
        $branch_id = $this->session->userdata('branch_id');

        $get_cur_auto_id = $this->cbmodel->cur_auto_id('ckb_cage');
        if($get_cur_auto_id == "false"){
           $auto_id="C001";
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
                     $aviary_name = $allDataInSheet[1]['A'];
                     $cage = $allDataInSheet[1]['B'];
                   if($aviary_name == "Aviary Name" && $cage == "Cage" ){
    
                    foreach ($allDataInSheet as $value) {
                      if($flag){
                        $flag =false;
                        continue;
                      }
                     // print_r ($value);
                     // exit;
                   
                     $auto_id = "C".str_pad( ( $get_cur_auto_id+$i ), 4, 0, STR_PAD_LEFT);
                    $where_cond_s['status'] = 1;
                    $where_cond_s['aviary_name'] = ucfirst($value['A']);
                    $where_cond_s['branch_id'] = $branch_id;
                    $av_id = $this->cbmodel->verify_data($where_cond_s,"ckb_aviary");
                    foreach ($av_id as $aviary) {
                      $aviary_id =  $aviary->auto_id;
                      $inserdata[$i]['aviary_id'] = $aviary_id;
                  }
                      $inserdata[$i]['auto_id'] = $auto_id;
                      $inserdata[$i]['cage'] = ucfirst($value['B']);
											$inserdata[$i]['diet_pattern'] = ucfirst($value['C']);
											$inserdata[$i]['target_mrg_feed'] = ucfirst($value['D']);
											$inserdata[$i]['target_aft_feed'] = ucfirst($value['E']);
                      $inserdata[$i]['status'] = 1;
                      $inserdata[$i]['created_by'] = $user_id;
                    $inserdata[$i]['branch_id'] = $branch_id;
                      $i++;
                    }               
                    $av_result = $this->import->insert_bulk_data($inserdata,"ckb_cage");   
                  } // end aviary if
                     else{
                      $this->session->set_flashdata('error', ('Column order Does not match with your file, <br>please download the sample file and upload in it correct format!'));
                      redirect(base_url('index.php/Masters/cage'));
                     }
    
                    if($av_result == TRUE){
                      $this->session->set_flashdata('message', ('Cage`s Data Successfully Imported!'));
                     redirect(base_url('index.php/Masters/cage'));
                    }
                    else if($av_result == FALSE ){
                      $this->session->set_flashdata('error', ('Please check File Format!'));
                      redirect(base_url('index.php/Masters/cage'));
                    }          
     
                   } catch (Exception $e) {
                  // die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
                        //    . '": ' .$e->getMessage());
                        $this->session->set_flashdata('error', ('Please check File Format!'));
                        redirect(base_url('index.php/Masters/cage'));
    
                }
             }else{
    
                  $error_msg =  $error['error'];
                  $this->session->set_flashdata('error', ($error_msg));
                  redirect(base_url('index.php/Masters/cage'));
    
             } 
                
     
               redirect(base_url('index.php/Masters/cage'));
        
         }

    /*************** End of cage Function  **************************************************************/
    /*************** start of group Function  **************************************************************/
    public function group_Download() {
      $this->load->helper('csv');
      $export_arr = array();
      $title = array("Group Name");
      $values = array("Amazon"); 
      array_push($export_arr, $title);
      if (!empty($values)) {
              array_push($export_arr,$values );
          }
      convert_to_csv($export_arr, 'Group sample.csv', ',');
  }
  
    
  public function group_upload(){
  
      $user_id = $this->session->userdata('user_id');
      
      $branch_id = $this->session->userdata('branch_id');
      $get_cur_auto_id = $this->cbmodel->cur_auto_id('ckb_group');
      if($get_cur_auto_id == "false"){
         $auto_id="G001";
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
                
                   $group_name = $allDataInSheet[1]['A'];
                 if($group_name == "Group Name"){
  
                  foreach ($allDataInSheet as $value) {
                    if($flag){
                      $flag =false;
                      continue;
                    }
                   // print_r ($value);
                   // exit;
                  // else{
                   $auto_id = "G".str_pad( ( $get_cur_auto_id+$i ), 4, 0, STR_PAD_LEFT);
                  // }
                    $inserdata[$i]['auto_id'] = $auto_id;
                    $inserdata[$i]['group_name'] = ucfirst($value['A']);
                    $inserdata[$i]['status'] = 1;
                    $inserdata[$i]['created_by'] = $user_id;                

  $inserdata[$i]['branch_id'] = $branch_id;
                 
                    $i++;
                  }               
                  $av_result = $this->import->insert_bulk_data($inserdata,"ckb_group");   
                } // end aviary if
                   else{
                    $this->session->set_flashdata('error', ('Column order Does not match with your file, <br>please download the sample file and upload in it correct format!'));
                    redirect(base_url('index.php/Masters/group'));
                   }
  
                  if($av_result == TRUE){
                    $this->session->set_flashdata('message', ('Group`s Data Successfully Imported!'));
                   redirect(base_url('index.php/Masters/group'));
                  }
                  else if($av_result == FALSE ){
                    $this->session->set_flashdata('error', ('Please check File Format!'));
                    redirect(base_url('index.php/Masters/group'));
                  }          
   
                 } catch (Exception $e) {
                // die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
                      //    . '": ' .$e->getMessage());
                      $this->session->set_flashdata('error', ('Please check File Format!'));
                      redirect(base_url('index.php/Masters/group'));
  
              }
           }else{
  
                $error_msg =  $error['error'];
                $this->session->set_flashdata('error', ($error_msg));
                redirect(base_url('index.php/Masters/group'));
  
           } 
              
   
             redirect(base_url('index.php/Masters/group'));
      
       }
         /*************** End of group Function  **************************************************************/
    /*************** start of proven Function  **************************************************************/
    public function proven_Download() {
      $this->load->helper('csv');
      $export_arr = array();
      $title = array("Proven Name");
      $values = array("Proven"); 
      array_push($export_arr, $title);
      if (!empty($values)) {
              array_push($export_arr,$values );
          }
      convert_to_csv($export_arr, 'Proven sample.csv', ',');
  }
  
    
  public function proven_upload(){
  
      $user_id = $this->session->userdata('user_id');
      $branch_id = $this->session->userdata('branch_id');
              
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
                
                   $group_name = $allDataInSheet[1]['A'];
                 if($group_name == "Proven Name"){
  
                  foreach ($allDataInSheet as $value) {
                    if($flag){
                      $flag =false;
                      continue;
                    }
                   // print_r ($value);
                   // exit;
                  // else{
                  // $auto_id = "G".str_pad( ( $get_cur_auto_id+$i ), 4, 0, STR_PAD_LEFT);
                  // }
                  //  $inserdata[$i]['auto_id'] = $auto_id;
                    $inserdata[$i]['title'] = ucfirst($value['A']);
                    $inserdata[$i]['status'] = 1;
                    $inserdata[$i]['created_by'] = $user_id;
                    $inserdata[$i]['branch_id'] = $branch_id;
                 
                    $i++;
                  }               
                  $av_result = $this->import->insert_bulk_data($inserdata,"ckb_proven");   
                } // end aviary if
                   else{
                    $this->session->set_flashdata('error', ('Column order Does not match with your file, <br>please download the sample file and upload in it correct format!'));
                    redirect(base_url('index.php/Masters/proven'));
                   }
  
                  if($av_result == TRUE){
                    $this->session->set_flashdata('message', ('Proven`s Data Successfully Imported!'));
                   redirect(base_url('index.php/Masters/proven'));
                  }
                  else if($av_result == FALSE ){
                    $this->session->set_flashdata('error', ('Please check File Format!'));
                    redirect(base_url('index.php/Masters/proven'));
                  }          
   
                 } catch (Exception $e) {
                // die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
                      //    . '": ' .$e->getMessage());
                      $this->session->set_flashdata('error', ('Please check File Format!'));
                      redirect(base_url('index.php/Masters/proven'));
  
              }
           }else{
  
                $error_msg =  $error['error'];
                $this->session->set_flashdata('error', ($error_msg));
                redirect(base_url('index.php/Masters/proven'));
  
           } 
              
   
             redirect(base_url('index.php/Masters/proven'));
      
       }
        /*************** End of proven Function  **************************************************************/
    /*************** start of Brooder Function  **************************************************************/
    public function brooder_Download() {
      $this->load->helper('csv');
      $export_arr = array();
      $title = array("Brooder Name","Target no of Feeds");
      $values = array("Brooder 36","16"); 
      array_push($export_arr, $title);
      if (!empty($values)) {
              array_push($export_arr,$values );
          }
      convert_to_csv($export_arr, 'Brooder sample.csv', ',');
  }
  
    
  public function brooder_upload(){
  
      $user_id = $this->session->userdata('user_id');
      $branch_id = $this->session->userdata('branch_id');

      $get_cur_auto_id = $this->cbmodel->cur_auto_id('ckb_brooder');
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
                
                   $br_name = $allDataInSheet[1]['A'];
                   $tr_feed = $allDataInSheet[1]['B'];
                  
                 if($br_name == "Brooder Name" && $tr_feed == "Target no of Feeds" ){
  
                  foreach ($allDataInSheet as $value) {
                    if($flag){
                      $flag =false;
                      continue;
                    }
                  
                   $auto_id = "B".str_pad( ( $get_cur_auto_id+$i ), 4, 0, STR_PAD_LEFT);
                
                    $inserdata[$i]['auto_id'] = $auto_id;
                    $inserdata[$i]['brooder_name'] = ucfirst($value['A']);
                    $inserdata[$i]['target_feed'] = ucfirst($value['B']);
                    $inserdata[$i]['status'] = 1;
                    $inserdata[$i]['created_by'] = $user_id;
                    $inserdata[$i]['branch_id'] = $branch_id;
                 
                    $i++;
                  }               
                  $av_result = $this->import->insert_bulk_data($inserdata,"ckb_brooder");   
                } // end aviary if
                   else{
                    $this->session->set_flashdata('error', ('Column order Does not match with your file, <br>please download the sample file and upload in it correct format!'));
                    redirect(base_url('index.php/Masters/brooder'));
                   }
  
                  if($av_result == TRUE){
                    $this->session->set_flashdata('message', ('Brooder`s Data Successfully Imported!'));
                   redirect(base_url('index.php/Masters/brooder'));
                  }
                  else if($av_result == FALSE ){
                    $this->session->set_flashdata('error', ('Please check File Format!'));
                    redirect(base_url('index.php/Masters/brooder'));
                  }          
   
                 } catch (Exception $e) {
                // die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
                      //    . '": ' .$e->getMessage());
                      $this->session->set_flashdata('error', ('Please check File Format!'));
                      redirect(base_url('index.php/Masters/brooder'));
  
              }
           }else{
  
                $error_msg =  $error['error'];
                $this->session->set_flashdata('error', ($error_msg));
                redirect(base_url('index.php/Masters/brooder'));
  
           } 
              
   
             redirect(base_url('index.php/Masters/brooder'));
      
       }
 /*************** End of proven Function  **************************************************************/
    /*************** start of Brooder Function  **************************************************************/
    public function incub_Download() {
      $this->load->helper('csv');
      $export_arr = array();
      $title = array("Incubation Name");
      $values = array("Incubation 1"); 
      array_push($export_arr, $title);
      if (!empty($values)) {
              array_push($export_arr,$values );
          }
      convert_to_csv($export_arr, 'incubation name sample.csv', ',');
  }
  
    
  public function incub_upload(){
  
      $user_id = $this->session->userdata('user_id');
      $branch_id = $this->session->userdata('branch_id');

      $get_cur_auto_id = $this->cbmodel->cur_auto_id('ckb_addincubation');
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
                
                   $incub_name = $allDataInSheet[1]['A'];
                 
                 if($incub_name == "Incubation Name"){
  
                  foreach ($allDataInSheet as $value) {
                    if($flag){
                      $flag =false;
                      continue;
                    }
                  
                   $auto_id = "I".str_pad( ( $get_cur_auto_id+$i ), 4, 0, STR_PAD_LEFT);
                
                    $inserdata[$i]['auto_id'] = $auto_id;
                    $inserdata[$i]['incubation_name'] = ucfirst($value['A']);
                    $inserdata[$i]['status'] = 1;
                    $inserdata[$i]['created_by'] = $user_id;
                    $inserdata[$i]['branch_id'] = $branch_id;
                 
                    $i++;
                  }               
                  $av_result = $this->import->insert_bulk_data($inserdata,"ckb_addincubation");   
                } // end aviary if
                   else{
                    $this->session->set_flashdata('error', ('Column order Does not match with your file, <br>please download the sample file and upload in it correct format!'));
                    redirect(base_url('index.php/Masters/incubation'));
                   }
  
                  if($av_result == TRUE){
                    $this->session->set_flashdata('message', ('Incubation`s Data Successfully Imported!'));
                   redirect(base_url('index.php/Masters/incubation'));
                  }
                  else if($av_result == FALSE ){
                    $this->session->set_flashdata('error', ('Please check File Format!'));
                    redirect(base_url('index.php/Masters/incubation'));
                  }          
   
                 } catch (Exception $e) {
                // die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
                      //    . '": ' .$e->getMessage());
                      $this->session->set_flashdata('error', ('Please check File Format!'));
                      redirect(base_url('index.php/Masters/incubation'));
  
              }
           }else{
  
                $error_msg =  $error['error'];
                $this->session->set_flashdata('error', ($error_msg));
                redirect(base_url('index.php/Masters/incubation'));
  
           } 
              
   
             redirect(base_url('index.php/Masters/incubation'));
      
       }
}//end class
 