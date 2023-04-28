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
  function fileDownload(){
    $this->load->helper('download');
    $name = "sample.csv";
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$filename");
        header("Content-Type: application/csv; ");
 
   
    $data = file_get_contents(APPPATH . 'excelsample/'.$name); // Read the file's contents
   
    force_download($name, $data);
}
function material_Download(){
  $this->load->helper('csv');
    $export_arr = array();
   // $where_cond_s['status'] = 1;
    $result = $this->cbmodel->excel_download_mat();
  //  $data['Info'] =  $this->import->exportExcel();
 // print_r($result);
 // exit;
        $title = array("Aviary", "Group", "Species","Section","Raw material","Target","Actual type");
        array_push($export_arr, $title);
        if (!empty($result)) {
            foreach ($result as $group) {
                array_push($export_arr, array($group->aviary_name, $group->group_name, $group->species_name));
            }
        }
    convert_to_csv($export_arr, 'Raw material.csv', ',');
}


public function export_csv() {
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



  public function display() {
    $data['page'] = 'import';
    $data['title'] = 'Import XLSX ';
  //  $data['excelInfo'] = $this->import->exportExcel();
    //$this->load->view('masters/excel_display', $data);
    $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'ID');
       	$sheet->setCellValue('B1', 'Age');
        $sheet->setCellValue('C1', 'Standard Weight');
      //  $sheet->setCellValue('C1', 'Skills');
      //  $sheet->setCellValue('D1', 'Address');
//	$sheet->setCellValue('E1', 'Age');
      //  $sheet->setCellValue('F1', 'Designation');       
      /*  $rows = 2;
        foreach ($excelInfo as $val){
          $sheet->setCellValue('A' . 2, $val['1']);
            $sheet->setCellValue('B' . 2, $val['7']);
            $sheet->setCellValue('C' . 2, $val['8']);
           // $sheet->setCellValue('C' . $rows, $val['skills']);
           // $sheet->setCellValue('D' . $rows, $val['address']);
	    //$sheet->setCellValue('E' . $rows, $val['age']);
           // $sheet->setCellValue('F' . $rows, $val['designation']);
            $rows++;
        } */
        $writer = new Xlsx($spreadsheet);
		$writer->save("upload/".$fileName);
		header("Content-Type: application/vnd.ms-excel");
        redirect(base_url()."/upload/".$fileName);      
} 
  
public function uploadData(){
 
 //if ($this->input->post('submit')) {

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
									$inserdata[$i]['branch_id'] = $this->session->userdata('branch_id');
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
            redirect(base_url('index.php/Masters/species'));
                }else{
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
              echo $error['error'];
            }
            
            
  //}
  redirect(base_url('index.php/Masters/species'));
    
     }
 public function uploadMat(){
 
      //if ($this->input->post('submit')) {
     
        // $gr_id = $this->input->post('gp_id');
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
                     foreach ($allDataInSheet as $value) {
                       if($flag){
                         $flag =false;
                         continue;
                       }
                      
                       $inserdata[$i]['aviary_id'] =$value['A'];
                       $inserdata[$i]['group_id'] =  $value['B'];
                       $inserdata[$i]['species_id'] =  $value['C'];
                       $inserdata[$i]['section'] = $value['D'];
                       $inserdata[$i]['material'] = $value['E'];
                       $inserdata[$i]['target'] = $value['F'];
                       $inserdata[$i]['actual_type'] = $value['G'];
                       $inserdata[$i]['branch_id'] = $branch_id;
                       $i++;
                     }               
                     $sp_result = $this->import->importMat($inserdata);   
                   //  echo json_encode($sp_result);
                 /*   if($sp_result){
                       $result = array(
                           "logstatus" => "success",
                           "url" => "masters/raw_material"
                       );
                       echo json_encode($result);
               
                   }*/
                   if($sp_result){
                    $this->session->set_flashdata('message', ('Raw materials Data Successfully Imported!'));
              redirect(base_url('index.php/masters/raw_material'));
                  }else{
                    $this->session->set_flashdata('error', ('Please check File Format!'));
                    redirect(base_url('index.php/masters/raw_material'));
                  }  
                            
      
                    } catch (Exception $e) {
                   // die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
                         //    . '": ' .$e->getMessage());
                         $this->session->set_flashdata('error', ('Please check File Format!'));
                         redirect(base_url('index.php/Masters/raw_material'));
     
                 }
              }else{
                   echo $error['error'];
                 }
                 
                 
       //}
       redirect(base_url('index.php/masters/raw_material'));
         
          }


}//end class
 