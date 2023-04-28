<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Incubtemp_model extends CI_Model
{
	
public function verify_data_jointable($postData1,$postData2){
	$branch_id = $this->session->userdata('branch_id');
	   $this->db->select('i.*,u.user_name as user_name');
	//	$this->db->select('i.*,u.*');
		$this->db->from('ckb_incubtemp as i');
		$this->db->join('ckb_users as u', 'i.sign = u.user_id','right outer');
	//	$this->db->get('ckb_users as u');
		$array_where = array('i.date' => $postData1, 'i.incub_no' => $postData2);
        $this->db->where($array_where); 
		$this->db->where('i.branch_id',$branch_id);

		$records = $this->db->get()->result();
		return $records;

}
	
	public function verify_data_incubtemperature_dt($postData,$postData1,$postData2)
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
			$search_arr[] = " (b.incubation_name like '%" . $searchValue . "%' or 
            i.date like'%" . $searchValue . "%' ) ";
		}

		if (count($search_arr) > 0) {
			$searchQuery = implode(" and ", $search_arr);
		}

        //# Total number of records without filtering
		$this->db->select('count(*) as allcount');
		$this->db->from('ckb_incubtemp as i');
		$this->db->join('ckb_addincubation as b', 'i.incub_no = b.auto_id');
		$this->db->join('ckb_users as u', 'i.sign = u.user_id');
		$array_where = array('i.date' => $postData1, 'i.incub_no' => $postData2);
        $this->db->where($array_where); 
		$this->db->where('i.branch_id',$branch_id);
		//$this->db->group_by("date");
		//$this->db->group_by(array("date", "incub_no")); 
		
	//	$this->db->join('ckb_brooder as c', 'm.move_35_brooder = b.auto_id');
		if ($searchQuery != '') $this->db->where($searchQuery);

        // $this->db->where($postData_where);

		$records = $this->db->get()->result();

		$totalRecords = $records[0]->allcount;

		
        //# Total number of record with filtering
		$this->db->select('count(*) as allcount');
		$this->db->from('ckb_incubtemp as i');
		$this->db->join('ckb_addincubation as b', 'i.incub_no = b.auto_id');
		$this->db->join('ckb_users as u', 'i.sign = u.user_id');
		$array_where = array('i.date' => $postData1, 'i.incub_no' => $postData2);
        $this->db->where($array_where); 
		$this->db->where('i.branch_id',$branch_id);

		//$this->db->group_by("date");
		//$this->db->group_by(array("date", "incub_no")); 
		//
		if ($searchQuery != '') $this->db->where($searchQuery);

		//   $this->db->where($postData_where);

		$records = $this->db->get()->result();

		$totalRecordwithFilter = $records[0]->allcount;

        //# Fetch records
		$this->db->select('i.*,b.incubation_name as incub_name,u.user_name as user_name');
		$this->db->from('ckb_incubtemp as i');
		$this->db->join('ckb_addincubation as b', 'i.incub_no = b.auto_id');
		$this->db->join('ckb_users as u', 'i.sign = u.user_id');
		$array_where = array('i.date' => $postData1, 'i.incub_no' => $postData2);
        $this->db->where($array_where); 
		$this->db->where('i.branch_id',$branch_id);

		//$this->db->group_by("date");
		//$this->db->group_by(array("date", "incub_no")); 
		//$this->db->join('ckb_brooder as c', 'm.move_35_brooder = b.auto_id');

		if ($searchQuery != '') $this->db->where($searchQuery);

		//   $this->db->where($postData_where);
		$this->db->order_by('i.id', 'desc');  // or desc

		$this->db->limit($rowperpage, $start);

		$records = $this->db->get()->result();

		$data = array();

		foreach ($records as $record) {
		//	if($record->status == '2'){   // check the status and return the data
			
				
			//$action_url1 = base_url()."index.php/Preweaning/view_preweaning_details/".$record->auto_id;

      		//$action_url2 = base_url()."index.php/Preweaning/preweaning_details/".$record->auto_id;

			 // $action_url3 = base_url()."index.php/Incubation/move_incubation/".$record->auto_id;

//$action = "";
$action = '<a href="" class="btn btn-info btn-xs waves-effect waves-light tooltips" data-trigger="hover" data-placement="top" data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-pencil-square-o" id="editBtn"></i></a>';
//$action = '<button  onclick="view_temp_pop('."'".$record->incub_no."'".','."'".$record->date."'".');" class="btn btn-pink btn-xs waves-effect waves-light tooltips" style="margin-top:5px;" data-placement="top" data-toggle="tooltip" id="Viewbtn" data-original-title="view"><i class="fa fa-eye" id="viewbtn"></i></button>';
//$action = '<br><a href="'.$action_url2.'" target="_blank"><button class="btn btn-primary btn-xs waves-effect waves-light tooltips" style="margin-top:5px;" data-placement="top" data-toggle="tooltip" id="Weightlossbtn" title="Weight Loss">Update Pre weaning Details</button></a><br><br>'; 

//$view = '<a href="'.$action_url1.'" class="btn btn-pink btn-xs waves-effect waves-light tooltips" data-trigger="hover" data-placement="top" data-toggle="tooltip" data-original-title="Edit">View Preweaning History</i></a>';
			
$data[] = array(
				"id" => $record->id,
				"date" => $record->date,
				"incub_no" => $record->incub_name,
				"time" => $record->time,
				"temperature" => $record->temperature,
				"relative_humidity" => $record->relative_humidity,
				"rotation" => $record->rotation,
				"egg_no" => $record->egg_no,
				"sign" => $record->user_name,
				"action" => $action,
			);
		
			//print_r($record);	

	}
        //# Response
		$response = array(
			"draw" => intval($draw),
			"iTotalRecords" => $totalRecords,
			"iTotalDisplayRecords" => $totalRecordwithFilter,
			"aaData" => $data
		);

		return $response;
	//
	}

	public function verify_data_handtemperature_dt($postData,$postData1,$postData2)
	{
		$response = array();
		$branch_id = $this->session->userdata('branch_id');

		//$show = $postData['status'];
		$draw = $postData['draw'];
		$start = $postData['start'];
		$rowperpage = $postData['length']; // Rows display per page
		$columnIndex = $postData['order'][0]['column']; // Column index
		$columnName = $postData['columns'][$columnIndex]['data']; // Column name
		$columnSortOrder = $postData['order'][0]['dir']; // asc or desc
		$searchValue = $postData['search']['value']; // Search value
        
		//# Search
		$search_arr = array();
		$searchQuery = "";

		if ($searchValue != '') {
			$search_arr[] = " (h.date like '%" . $searchValue . "%' or 
            b.brooder_name like '%" . $searchValue . "%' ) ";
		}

		if (count($search_arr) > 0) {
			$searchQuery = implode(" and ", $search_arr);
		}

        //# Total number of records without filtering
		$this->db->select('count(*) as allcount');
		$this->db->from('ckb_handfeed_temp as h');
		$this->db->join('ckb_brooder as b', 'h.brooder_id = b.auto_id');
		$this->db->join('ckb_users as u', 'h.sign = u.user_id');
		$array_where = array('h.date' => $postData1, 'h.brooder_id' => $postData2);
        $this->db->where($array_where); 
		$this->db->where('h.branch_id',$branch_id);
		//$this->db->group_by("date");
		//$this->db->group_by(array("date", "brooder_id")); 
		
	//	$this->db->join('ckb_brooder as c', 'm.move_35_brooder = b.auto_id');
		if ($searchQuery != '') $this->db->where($searchQuery);

        // $this->db->where($postData_where);

		$records = $this->db->get()->result();

		$totalRecords = $records[0]->allcount;

		
        //# Total number of record with filtering
		$this->db->select('count(*) as allcount');
		$this->db->from('ckb_handfeed_temp as h');
		$this->db->join('ckb_brooder as b', 'h.brooder_id = b.auto_id');
		$this->db->join('ckb_users as u', 'h.sign = u.user_id');
		$array_where = array('h.date' => $postData1, 'h.brooder_id' => $postData2);
        $this->db->where($array_where); 
		$this->db->where('h.branch_id',$branch_id);

		//$this->db->join('ckb_brooder as c', 'm.move_35_brooder = b.auto_id');
		if ($searchQuery != '') $this->db->where($searchQuery);

		//   $this->db->where($postData_where);

		$records = $this->db->get()->result();

		$totalRecordwithFilter = $records[0]->allcount;

        //# Fetch records
		$this->db->select('h.*,b.brooder_name as brooder_name,u.user_name as user_name');
		$this->db->from('ckb_handfeed_temp as h');
		$this->db->join('ckb_brooder as b', 'h.brooder_id = b.auto_id');
		$this->db->join('ckb_users as u', 'h.sign = u.user_id');
		$array_where = array('h.date' => $postData1, 'h.brooder_id' => $postData2);
        $this->db->where($array_where); 
		$this->db->where('h.branch_id',$branch_id);

		//$this->db->group_by(array("date", "brooder_id")); 
		//$this->db->join('ckb_brooder as c', 'm.move_35_brooder = b.auto_id');

		if ($searchQuery != '') $this->db->where($searchQuery);

		//   $this->db->where($postData_where);
		$this->db->order_by('h.id', 'desc');  // or desc

		$this->db->limit($rowperpage, $start);

		$records = $this->db->get()->result();

		$data = array();

		foreach ($records as $record) {
		//	if($record->status == '2'){   // check the status and return the data
			
				
			//$action_url1 = base_url()."index.php/Preweaning/view_preweaning_details/".$record->auto_id;

      		//$action_url2 = base_url()."index.php/Preweaning/preweaning_details/".$record->auto_id;

			 // $action_url3 = base_url()."index.php/Incubation/move_incubation/".$record->auto_id;

//$action = "";
$action = '<a href="" class="btn btn-info btn-xs waves-effect waves-light tooltips" data-trigger="hover" data-placement="top" data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-pencil-square-o" id="editBtn"></i></a>';
//$action = '<button  onclick="view_temp_pop('."'".$record->incub_no."'".','."'".$record->date."'".');" class="btn btn-pink btn-xs waves-effect waves-light tooltips" style="margin-top:5px;" data-placement="top" data-toggle="tooltip" id="Viewbtn" data-original-title="view"><i class="fa fa-eye" id="viewbtn"></i></button>';
//$action = '<br><a href="'.$action_url2.'" target="_blank"><button class="btn btn-primary btn-xs waves-effect waves-light tooltips" style="margin-top:5px;" data-placement="top" data-toggle="tooltip" id="Weightlossbtn" title="Weight Loss">Update Pre weaning Details</button></a><br><br>'; 

//$view = '<a href="'.$action_url1.'" class="btn btn-pink btn-xs waves-effect waves-light tooltips" data-trigger="hover" data-placement="top" data-toggle="tooltip" data-original-title="Edit">View Preweaning History</i></a>';
			
$data[] = array(
				"id" => $record->id,
				"date" => $record->date,
				"brooder_id" => $record->brooder_name,
				"time" => $record->time,
				"temperature" => $record->temperature,
				"relative_humidity" => $record->relative_humidity,
				"rotation" => $record->rotation,
				"egg_no" => $record->egg_no,
				"sign" => $record->user_name,
				"action" => $action,
			);
		
			//print_r($record);	

	}
        //# Response
		$response = array(
			"draw" => intval($draw),
			"iTotalRecords" => $totalRecords,
			"iTotalDisplayRecords" => $totalRecordwithFilter,
			"aaData" => $data
		);

		return $response;
	//
	}



	

}//end class

