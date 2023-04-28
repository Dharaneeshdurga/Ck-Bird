<?php
class Masters_model extends CI_Model
{

	function get_table($table){ 
		$query = $this->db->get($table);
		return $query->result_array();
	}
	
	function insert_data($table, $data){
		 $this->db->insert($table, $data);
        $last_id = $this->db->insert_id();
        //echo $this->db->last_query();exit;
		return $last_id;
	}
	
	function get_table_last_row($table){
		$this->db->order_by("id", "desc");
		$this->db->limit(1);
		$query = $this->db->get($table);
		
		//echo $this->db->last_query(); exit;
		return $query->row_array();
		
		//return $query->result_array();
		
	}
	
	function updates($table, $data, $col, $id = ''){
		$this->db->where($col, $id);
		$this->db->update($table, $data);
		//echo $this->db->last_query(); exit;
		return true;
	}
	function menu_updates($table,$data, $menu_id, $role_id){
		$array_where = array('menu_id'=>$menu_id,'role_id'=>$role_id);
		$this->db->where($array_where);
		$this->db->update($table, $data);
		return true;
	}
	function branch_updates($table,$data, $array_where){
		//$array_where = array('egg'=>$menu_id,'role_id'=>$role_id);
		$this->db->where($array_where);
		$this->db->update($table, $data);
		return true;
	}
	function submenu_updates($table,$data, $menu_id, $role_id,$submenu_id){
		$array_where = array('menu_id'=>$menu_id,'role_id'=>$role_id,'submenu_id'=>$submenu_id);
		$this->db->where($array_where);
		$this->db->update($table, $data);
		return true;
	}
	
	function get_table_row($table, $col, $id){
		
		$this->db->where($col, $id); 
		$query = $this->db->get($table);
		$query->row_array();
		//echo $this->db->last_query(); exit;
		return $query->row_array();
	}
	function get_table_rows($table, $col, $id){
		$this->db->select("*");
		$this->db->from($table);
		$this->db->where($col, $id);
		$query = $this->db->get();   
		return $query->result_array();     
		//return $query->result();
	}
	
	
	function get_table_join($table1,$table2){
	$this->db->select(''.$table2.'.aviary_name,'.$table1.'.*');
	$this->db->from($table1);
	//$this->db->join(''.$table2.'',''.$table2.'.auto_id = '.$table1.'.aviary_id','inner');
	$this->db->join(''.$table2.'',''.$table2.'.auto_id = '.$table1.'.aviary_id');
	$this->db->order_by("id", "acs");
		$query = $this->db->get();
		//echo $this->db->last_query();exit;
		return $query->result_array();
	}
	
	
	function get_table_join2($table1,$table2){
	$this->db->select(''.$table2.'.group_name,'.$table1.'.*');
	$this->db->from($table1);
	//$this->db->join(''.$table2.'',''.$table2.'.auto_id = '.$table1.'.group_id','inner');
	$this->db->join(''.$table2.'',''.$table2.'.auto_id = '.$table1.'.group_id');
	$this->db->order_by("id", "acs");
		$query = $this->db->get();
		//echo $this->db->last_query();exit;
		return $query->result_array();
	}
	
	
	public function verify_data_rawmat_dt($postData)
	{
		$response = array();

		//$show = $postData['status'];
		$draw = $postData['draw'];
		$start = $postData['start'];
		$rowperpage = $postData['length']; // Rows display per page
		$columnIndex = $postData['order'][0]['column']; // Column index
		$columnName = $postData['columns'][$columnIndex]['data']; // Column name
		$columnSortOrder = $postData['order'][0]['dir']; // asc or desc
		$searchValue = $postData['search']['value']; // Search value
        $branch_id = $this->session->userdata('branch_id');

		//# Search
		$search_arr = array();
		$searchQuery = "";

		if ($searchValue != '') {
			$search_arr[] = " (group_id like '%" . $searchValue . "%' or 
            aviary_id like '%" . $searchValue . "%' or 
            species_id like '%" . $searchValue . "%' or 
            section like '%" . $searchValue . "%' or 
            target like '%" . $searchValue . "%' or 
			material like '%" . $searchValue . "%' or 
            actual_type like '%" . $searchValue . "%' ) ";
		}

		if (count($search_arr) > 0) {
			$searchQuery = implode(" and ", $search_arr);
		}

        //# Total number of records without filtering
		$this->db->select('count(*) as allcount');
		$this->db->from('ckb_materials_import');
		$this->db->where('branch_id',$branch_id);
	//	$this->db->join('ckb_brooder as c', 'm.move_35_brooder = b.auto_id');
		if ($searchQuery != '') $this->db->where($searchQuery);

        // $this->db->where($postData_where);

		$records = $this->db->get()->result();

		$totalRecords = $records[0]->allcount;

		
        //# Total number of record with filtering
		$this->db->select('count(*) as allcount');
		$this->db->from('ckb_materials_import');
		$this->db->where('branch_id',$branch_id);
		//$this->db->join('ckb_brooder as c', 'm.move_35_brooder = b.auto_id');
		if ($searchQuery != '') $this->db->where($searchQuery);

		//   $this->db->where($postData_where);

		$records = $this->db->get()->result();

		$totalRecordwithFilter = $records[0]->allcount;

        //# Fetch records
		$this->db->select('*');
		$this->db->from('ckb_materials_import');
		$this->db->where('branch_id',$branch_id);
		//$this->db->join('ckb_brooder as c', 'm.move_35_brooder = b.auto_id');

		if ($searchQuery != '') $this->db->where($searchQuery);

		//   $this->db->where($postData_where);
		$this->db->order_by('id', 'desc');  // or desc

		$this->db->limit($rowperpage, $start);

		$records = $this->db->get()->result();

		$data = array();

		foreach ($records as $record) {
		//	if($record->status == '2'){   // check the status and return the data
			$timedate1 = strtotime(date("Y-m-d", strtotime($record->created_on)));
			$created_on = date("d-m-Y", $timedate1);

		
				
		//	$action_url1 = base_url()."index.php/Weaning/view_weaning_details/".$record->auto_id;

      		//$action_url2 = base_url()."index.php/Weaning/weaning_details/".$record->auto_id;

			 // $action_url3 = base_url()."index.php/Incubation/move_incubation/".$record->auto_id;

//$action = "";
//$action = '<button  onclick="get_move_Weaning('."'".$record->auto_id."'".');" class="btn btn-success btn-xs waves-effect waves-light tooltips" style="margin-top:5px;" data-placement="top" data-toggle="tooltip" id="Deletebtn" data-original-title="Delete">Move to Weaning</button>';
//$action = '<br><a href="'.$action_url2.'" target="_blank"><button class="btn btn-primary btn-xs waves-effect waves-light tooltips" style="margin-top:5px;" data-placement="top" data-toggle="tooltip" id="Weightlossbtn" title="">Update weaning Details</button></a><br><br>'; 


//$view = '<a href="'.$action_url1.'" class="btn btn-pink btn-xs waves-effect waves-light tooltips" data-trigger="hover" data-placement="top" data-toggle="tooltip" data-original-title="Edit">View Weaning History</i></a>';
			
$data[] = array(
				"id" => $record->id,
				"group_id" => $record->group_id,
				"species_id" => $record->species_id,
				"aviary_id" => $record->aviary_id,
				"section" => $record->section,
				"material" => $record->material,
				"target" => $record->target,
				"actual_type" => $record->actual_type,
				//"action" => $action,
				//"view" => $view,
			
			);
		//}
	}
        //# Response
		$response = array(
			"draw" => intval($draw),
			"iTotalRecords" => $totalRecords,
			"iTotalDisplayRecords" => $totalRecordwithFilter,
			"aaData" => $data
		);

		return $response;
	}

	
	
	
	
	
	

}
