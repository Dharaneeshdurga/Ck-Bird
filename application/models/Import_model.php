<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
 
class Import_model extends CI_Model {
 
public function insert_bulk_data($data,$table) {

   
  $res = $this->db->insert_batch($table,$data);
  
  if($res){
        return TRUE;
    }else{
        return FALSE;
    }

}
    public function importData($data) {

        $species_id = $data[1]['species_id'];
      $query = $this->db->get_where('ckb_species_import',array('species_id'=> $species_id));
      if ($query->num_rows() > 0){
        $this->db->where('species_id', $species_id);	
        $res = $this->db->delete('ckb_species_import');
       
      }
        $res = $this->db->insert_batch('ckb_species_import',$data);
        
        if($res){
              return TRUE;
          }else{
              return FALSE;
          }

    }
    public function importMat($data) {

        $group_id = $data[1]['group_id'];
        $aviary_id = $data[1]['aviary_id'];
        $this->db->select('count(*) as allcount');
	     	$this->db->from('ckb_materials_import');
         $records = $this->db->get()->result();
	    	$totalRecords = $records[0]->allcount;
        //echo $totalRecords;
       // exit;
     // $query = $this->db->get_where('ckb_materials_import',array('group_id'=> $group_id,'aviary_id'=> $aviary_id));
      if ($totalRecords > 0){
        $res = $this->db->empty_table('ckb_materials_import');
       
      }
        $res = $this->db->insert_batch('ckb_materials_import',$data);
        
        if($res){
              return TRUE;
          }else{
              return FALSE;
          }

    }
    public function stock_upload($data) {

     
      $this->db->select('count(*) as allcount');
       $this->db->from('ckb_stock_register_upload');
       $records = $this->db->get()->result();
      $totalRecords = $records[0]->allcount;
      
    if ($totalRecords > 0){
      $res = $this->db->empty_table('ckb_stock_register_upload');
     
    }
      $res = $this->db->insert_batch('ckb_stock_register_upload',$data);
      
      if($res){
            return TRUE;
        }else{
            return FALSE;
        }

  }
    public function exportExcel()
    {
        $this->db->select(array('e.age', 'e.std_weight'));
        $this->db->from('ckb_species_import as e');
        $query = $this->db->get();
        return $query->result_array();
    }
 
}
 
?>