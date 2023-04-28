<?php 
 
defined('BASEPATH') OR exit('No direct script access allowed');  
  
class Import extends CI_Controller {  
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
 
 
  public function uploadCsv(){
    
    $this->load->view('upload');
  }
 
public function export_csv() { //download sample  csv filefunction
    $this->load->helper('csv');
    $export_arr = array();
    $data['Info'] =  $this->import->exportExcel();
    $title = array("Age", "standard weight");
    $values = array("1", "8");
    $row2 = array("2", "9");
    $row3 = array("3", "10");
    $row4 = array("4", "11");
    
    array_push($export_arr, $title);
    array_push($export_arr,$row2);
    array_push($export_arr,$row3);
    array_push($export_arr,$row4);
    
    if (!empty($values)) {
            array_push($export_arr,$values );
        }
    
    convert_to_csv($export_arr, 'sample.csv', ',');
}



 
  public function uploadData(){
 
 if ($this->input->post('submit')) {

    $species_id = $this->input->post('species_id');
            
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
                foreach ($allDataInSheet as $value) {
                  if($flag){
                    $flag =false;
                    continue;
                  }
                  $inserdata[$i]['species_id'] = $species_id;
                  $inserdata[$i]['age'] = $value['A'];
                  $inserdata[$i]['std_weight'] = $value['B'];
               
                  $i++;
                }               
                $sp_result = $this->import->importdata($inserdata);   
              //  echo json_encode($sp_result);
            /*    if($sp_result){
                  $result = array(
                      "logstatus" => "success",
                      "url" => "masters/species"
                  );
                  echo json_encode($result);
          
              }*/

                if($sp_result){
                  $this->session->set_flashdata('message', ('Species Age And Weight Data Successfully Imported!'));
            redirect(base_url('masters/species'));
                }else{
                  $this->session->set_flashdata('error', ('Please check File Format!'));
                  redirect(base_url('masters/species'));
                }          
 
               } catch (Exception $e) {
              // die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
                    //    . '": ' .$e->getMessage());
                    $this->session->set_flashdata('error', ('Please check File Format!'));
                    redirect(base_url('masters/species'));

            }
         }else{
              echo $error['error'];
            }
            
            
  // }
  redirect(base_url('masters/species'));
    
     }
}
 