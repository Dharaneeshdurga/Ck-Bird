<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Feedmaintain_model extends CI_Model
{
	

	public function get_type(){
		$branch_id = $this->session->userdata('branch_id');
		$this->db->select('*');
		$this->db->from('ckb_stock_register_upload');
		$this->db->where('branch_id',$branch_id);
		$this->db->group_by('type');
		$records = $this->db->get()->result();
		return $records;

	}
	public function verify_data_cagetrack_dt($postData,$date,$to_date,$aviary_id,$cage_id)
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
			$search_arr[] = " (a.aviary_name like '%" . $searchValue . "%' or 
            s.bird_species like '%" . $searchValue . "%' or 
			ct.date like '%" . $searchValue . "%' or 
            ct.cage_id like '%" . $searchValue . "%'  ) ";
		}

		if (count($search_arr) > 0) {
			$searchQuery = implode(" and ", $search_arr);
		}

        //# Total number of records without filtering
		$this->db->select('count(*) as allcount');
		$this->db->from('ckb_cage_track as ct');
		$this->db->join('ckb_aviary as a', 'ct.aviary_id = a.auto_id');
		//$this->db->join('ckb_species as s', 'ct.species_id = s.auto_id');
		//$array_where = array('ct.date' => $date, 'ct.aviary_id' => $aviary_id,'ct.cage_id' => $cage_id);
		if ($date != '') $this->db->where('ct.date', $date);
		if ($aviary_id != '') $this->db->where('ct.aviary_id',$aviary_id);
		if ($cage_id != '') $this->db->where('ct.cage_id' , $cage_id);
		$this->db->where('ct.branch_id',$branch_id);
		$this->db->where('ct.status',1);
		//$this->db->or_where($array_where); 
		if ($searchQuery != '') $this->db->where($searchQuery);

        // $this->db->where($postData_where);

		$records = $this->db->get()->result();

		$totalRecords = $records[0]->allcount;

		
        //# Total number of record with filtering
		$this->db->select('count(*) as allcount');
		$this->db->from('ckb_cage_track as ct');
		$this->db->join('ckb_aviary as a', 'ct.aviary_id = a.auto_id');
		//$this->db->join('ckb_species as s', 'ct.species_id = s.auto_id');
		//$array_where = array('ct.date' => $date, 'ct.aviary_id' => $aviary_id,'ct.cage_id' => $cage_id);
       // $this->db->or_where($array_where); 
	   if ($date != '') $this->db->where('ct.date', $date);
		if ($aviary_id != '') $this->db->where('ct.aviary_id' , $aviary_id);
		if ($cage_id != '') $this->db->where('ct.cage_id' , $cage_id);
		$this->db->where('ct.branch_id',$branch_id);
		$this->db->where('ct.status',1);

		if ($searchQuery != '') $this->db->where($searchQuery);
		$records = $this->db->get()->result();

		$totalRecordwithFilter = $records[0]->allcount;

        //# Fetch records
		$this->db->select('ct.*,a.aviary_name as aviary_name');
		$this->db->from('ckb_cage_track as ct');
        $this->db->join('ckb_aviary as a', 'ct.aviary_id = a.auto_id');
		//$this->db->join('ckb_species as s', 'ct.species_id = s.auto_id');
		//$array_where = array('ct.date' => $date, 'ct.aviary_id' => $aviary_id,'ct.cage_id' => $cage_id);
       // $this->db->or_where($array_where); 
	   if ($date != '' && $to_date == '' ) $this->db->where('ct.date', $date);
	   $condition = "ct.date BETWEEN " . "'" . $date . "'" . " AND " . "'" . $to_date . "'";
	   if ($date != '' && $to_date != ''  ) $this->db->where($condition);
		if ($aviary_id != '') $this->db->where('ct.aviary_id' , $aviary_id);
		if ($cage_id != '') $this->db->where('ct.cage_id' , $cage_id);
		if ($searchQuery != '') $this->db->where($searchQuery);
		$this->db->where('ct.branch_id',$branch_id);
		$this->db->where('ct.status',1);

		//   $this->db->where($postData_where);
		$this->db->order_by('ct.id', 'desc');  // or desc

		$this->db->limit($rowperpage, $start);

		$records = $this->db->get()->result();

		$data = array();

		foreach ($records as $record) {
		
			$this->db->select('s.bird_species as species_name');
			$this->db->from('ckb_bird as b');
			$this->db->join('ckb_species as s', 's.auto_id = b.species_id');
			$this->db->where('b.aviary_id',$record->aviary_id);
			$this->db->where('b.cage_id',$record->cage_id);
			$this->db->where('b.branch_id',$branch_id);
			$wh_not_in  =array('Sale','Mortality');
			$this->db->where_not_in('bird_status',$wh_not_in);
			$this->db->group_by("b.species_id");
			$this->db->order_by('b.id', 'asc'); 
			$species_id = $this->db->get()->result();
			//print_r($species_id);
			//$sp_name = $species_id[0]->species_name;
			//$species_id = print_r($species_id); 
			if(!empty($species_id)){
				$sp_name = '';
			foreach ($species_id as $v){
				$sp_name .=  $v->species_name;
				$sp_name .= ',';
				$sp_name .= '<br>';
				}
			}
			else{
				$sp_name = '';
			}

$action = '<button  onclick="get_delete_cage('."'".$record->id."'".');" class="btn btn-danger btn-xs waves-effect text-center waves-light tooltips" data-placement="top" data-toggle="tooltip" id="delete" title="delete"><i class="fa fa-trash"></i></button>'; 


$date = date("d-m-Y", strtotime($record->date));	

$timedate1 = strtotime(date("Y-m-d", strtotime($record->created_on)));
$created_on = date("d-m-Y", $timedate1);
$today_date = date("d-m-Y");
$data[] = array(
				"id" => $record->id,
				"date" =>$date,
				"aviary_id" => $record->aviary_name,
				"cage_id" => $record->cage_id,
				"species_id" => $sp_name,
				"count" => $record->count,
				"mrg_feed" => $record->mrg_feed,
				"target_mrng_feed" => $record->target_mrng_feed,
				"aft_feed" => $record->aft_feed,
				"target_aft_feed" => $record->target_aft_feed,
				"target_feedg" => $record->target_feedg,
				"mrng_feed_wast" => $record->mrng_feed_wast,
				"aft_feed_wast" => $record->aft_feed_wast,
				"total_intake" => $record->total_intake,
				"mail_status" => $record->mail_status,
				"to_be_achieved" => $record->to_be_achieved,
				"achieved" => $record->achieved,
				"action" => $action,
				"created_on" => $created_on,
				"today_date" => $today_date,
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

	public function aviary_track_dt($postData,$avdate)
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
			$search_arr[] = " (a.aviary_name like '%" . $searchValue . "%' or 
            s.bird_species like '%" . $searchValue . "%' or 
			ct.date like '%" . $searchValue . "%' or 
            ct.cage_id like '%" . $searchValue . "%'  ) ";
		}

		if (count($search_arr) > 0) {
			$searchQuery = implode(" and ", $search_arr);
		}

        //# Total number of records without filtering
		$this->db->select('count(ct.aviary_id) as allcount');
		$this->db->from('ckb_cage_track as ct');
		$this->db->join('ckb_aviary as a', 'ct.aviary_id = a.auto_id');
		//$this->db->join('ckb_species as s', 'ct.species_id = s.auto_id');
		//$array_where = array('ct.date' => $date, 'ct.aviary_id' => $aviary_id,'ct.cage_id' => $cage_id);
		$this->db->group_by('ct.aviary_id');
		if ($avdate != '') $this->db->where('ct.date',$avdate);
		$this->db->where('ct.branch_id',$branch_id);
		if ($searchQuery != '') $this->db->where($searchQuery);

        // $this->db->where($postData_where);

		$records = $this->db->get()->result();

		$totalRecords = $records[0]->allcount;

		
        //# Total number of record with filtering
		
		$this->db->select('count(ct.aviary_id) as allcount');
		$this->db->from('ckb_cage_track as ct');
		$this->db->join('ckb_aviary as a', 'ct.aviary_id = a.auto_id');
		//$this->db->join('ckb_species as s', 'ct.species_id = s.auto_id');
		$this->db->group_by('ct.aviary_id');
		if ($avdate != '') $this->db->where('ct.date',$avdate);
		$this->db->where('ct.branch_id',$branch_id);
		if ($searchQuery != '') $this->db->where($searchQuery);
		$records = $this->db->get()->result();

		$totalRecordwithFilter = $records[0]->allcount;

        //# Fetch records
		$this->db->select_sum('ct.target_mrng_feed');
		$this->db->select_sum('ct.target_aft_feed');
		$this->db->select_sum('ct.mrng_feed_wast');
		$this->db->select_sum('ct.aft_feed_wast');
		$this->db->select('ct.date as date,a.aviary_name as aviary_name,ct.cage_id as cage');
		$this->db->from('ckb_cage_track as ct');
        $this->db->join('ckb_aviary as a', 'ct.aviary_id = a.auto_id');
		//$this->db->join('ckb_species as s', 'ct.species_id = s.auto_id');
		$this->db->group_by('ct.aviary_id');
		if ($avdate != '') $this->db->where('ct.date',$avdate);
		if ($searchQuery != '') $this->db->where($searchQuery);
		$this->db->where('ct.branch_id',$branch_id);

		//   $this->db->where($postData_where);
		$this->db->order_by('ct.id', 'desc');  // or desc

		$this->db->limit($rowperpage, $start);

		$records = $this->db->get()->result();

		$data = array();
$count = count($records);
		foreach ($records as $record) {
		
//$particulars = $record->aviary_name.'-->'.$record->cage;
$particulars = $record->aviary_name;
$mrng_target_wastage = ($record->target_mrng_feed * 20)/100;
$aft_target_wastage = ($record->target_aft_feed * 20)/100;
$mrng_actual = ($record->target_mrng_feed - $record->mrng_feed_wast);
$mrng_status = ($record->target_mrng_feed - $mrng_actual);// morning status
$aft_actual = ($record->target_aft_feed - $record->aft_feed_wast);
$aft_status = ($record->target_aft_feed - $aft_actual);// aft status
$status = $mrng_status + $aft_status; //total status
$date = date("d-m-Y", strtotime($record->date));		
$data[] = array(
				//"id" => $record->id,
				"date" =>$date,
				"particulars" => $particulars,
				"totalav_mrng_feed" => $record->target_mrng_feed,
				"mrng_target_wastage" => $mrng_target_wastage,
				"totalav_aft_feed" => $record->target_aft_feed,
				"aft_target_wastage" => $aft_target_wastage,
				"mrng_actual" => $mrng_actual,
				"aft_actual" => $aft_actual,
				"mrng_status" => $mrng_status,
				"aft_status" => $aft_status,
				"total_status" => $status,
			);
		
			//print_r($record);	

	}
        //# Response
		$response = array(
			"draw" => intval($draw),
			"iTotalRecords" => $count,
			"iTotalDisplayRecords" => $count,
			"aaData" => $data
		);

		return $response;
	//
	}

	public function stock_register_dt($postData,$type,$part,$month,$year)
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
			$search_arr[] = " (st.type like '%" . $searchValue . "%' or 
            st.part like '%" . $searchValue . "%' ) ";
		}

		if (count($search_arr) > 0) {
			$searchQuery = implode(" and ", $search_arr);
		}

        //# Total number of records without filtering
		$this->db->select('count(*) as allcount');
		$this->db->from('ckb_stock_register_dt as st');
		if ($type != '') $this->db->where('st.type',$type);
		if ($part != '') $this->db->where('st.part' , $part);
		if ($month != '') $this->db->where('st.month',$month);
		if ($year != '') $this->db->where('st.year' , $year);
		$this->db->where('st.branch_id',$branch_id);
		//$this->db->or_where($array_where); 
		if ($searchQuery != '') $this->db->where($searchQuery);

        // $this->db->where($postData_where);

		$records = $this->db->get()->result();

		$totalRecords = $records[0]->allcount;

		
        //# Total number of record with filtering
		$this->db->select('count(*) as allcount');
		$this->db->from('ckb_stock_register_dt as st');
		if ($type != '') $this->db->where('st.type',$type);
		if ($part != '') $this->db->where('st.part' , $part);
		if ($month != '') $this->db->where('st.month',$month);
		if ($year != '') $this->db->where('st.year' , $year);
		if ($searchQuery != '') $this->db->where($searchQuery);
		$this->db->where('st.branch_id',$branch_id);
		$records = $this->db->get()->result();

		$totalRecordwithFilter = $records[0]->allcount;

        //# Fetch records
		$this->db->select('*');
		$this->db->from('ckb_stock_register_dt as st');
		if ($searchQuery != '') $this->db->where($searchQuery);
		if ($type != '') $this->db->where('st.type',$type);
		if ($part != '') $this->db->where('st.part' , $part);
		if ($month != '') $this->db->where('st.month',$month);
		if ($year != '') $this->db->where('st.year' , $year);
		$this->db->where('st.branch_id',$branch_id);
		//   $this->db->where($postData_where);
		$this->db->order_by('st.id', 'desc');  // or desc

		$this->db->limit($rowperpage, $start);

		$records = $this->db->get()->result();

	



		$data = array();
		$data1 = array();

		foreach ($records as $record) {

			$this->db->select_sum('daily_used');
			$this->db->select_sum('dis_value');
			$this->db->from('ckb_daily_used_stock');
			$data_where = array('stock_id'=>$record->auto_id,'month' => $record->month, 'year' => $record->year);
			$this->db->where($data_where); 
			$query1 = $this->db->get()->result();
			foreach ($query1 as $daily_used) {
				$daily_stock = $daily_used->daily_used;
				$dis_value = $daily_used->dis_value;  // calculating daily stock from users data
			}
				
	        $this->db->select_sum('actual');
			//$this->db->select('dis_value');
		    $this->db->from('ckb_material_update');
			$this->db->like('material',$record->part);
			$data_where = array('month' => $record->month, 'year' => $record->year);
		    $this->db->where($data_where); 
			$query = $this->db->get()->result();
			foreach ($query as $mat_data) {
                $daily_mat_stock = $mat_data->actual; 
				//echo $daily_mat_stock; // calculate from raw material
				}
				

      		$action_url1 = base_url()."index.php/Preweaning/preweaning_details/".$record->id;

			 // $action_url3 = base_url()."index.php/Incubation/move_incubation/".$record->auto_id;
if($daily_mat_stock == '')
{
	$total_consumption = $daily_stock;
	$action  = ' <button  onclick="add_used_qty('."'".$record->auto_id."'".');" class="btn btn-info btn-xs waves-effect waves-light tooltips" data-placement="top" data-toggle="tooltip" id="add" title="add"><i class="fa fa-plus"></i></button>';
}
else if($daily_mat_stock !== '') {
	$total_consumption = $daily_mat_stock;
	$action  = ' <button  onclick="add_discrep_qty('."'".$record->auto_id."'".','."'".$total_consumption."'".');" class="btn btn-info btn-xs waves-effect waves-light tooltips" data-placement="top" data-toggle="tooltip" id="add" title="add"><i class="fa fa-plus"></i></button>';

}
$view = '<a href="'.$action_url1.'" class="btn btn-pink btn-xs waves-effect waves-light tooltips" data-trigger="hover" data-placement="top" data-toggle="tooltip" title="view"><i class="fa fa-eye" id="editBtn"></i></a>';

$remaining_stock = $record->total_pur_qty - $total_consumption; //remaining_stock stock calculation

$update_data = array('closing_stock' => $remaining_stock);
$this->db->where('auto_id', $record->auto_id);
$this->db->update('ckb_stock_register_dt', $update_data);


$pur_date = date("d-m-Y", strtotime($record->pur_date));
$p_date = $record->pur_date;
$previous_month = date("F", strtotime ( '-1 month' , strtotime ( $p_date ) )) ;
$c_year =date("Y", strtotime($record->pur_date));

            $this->db->select('closing_stock');
			$this->db->from('ckb_stock_register_dt');
			$data_where = array('type'=>$record->type,'part'=>$record->part,'month' => $previous_month, 'year' => $c_year);
			$this->db->where($data_where); 
			$closing_stock_result = $this->db->get()->result();
			if($closing_stock_result != NULL){
			foreach ($closing_stock_result as $closing){
				$opening_stock = $closing->closing_stock;	
			}
		}
		else{
              $opening_stock = 0;

		}
		 $closing_stock	=($opening_stock + $record->total_pur_qty) - $total_consumption;
		 $closing_stock	= $closing_stock - $dis_value;
			
//$total_consumption = 0;
$data[] = array(
				"id" => $record->id,
				"pur_date" =>$pur_date,
				"type" => $record->type,
				"particular" => $record->part,
				"opening_stock" => $opening_stock,
				"total_pur_qty" => $record->total_pur_qty,
				"total_pur_rs" => $record->total_pur_rs,
				"closing_stock" => $closing_stock,
				"total_consumption" => $total_consumption,
				"action" => $action,
				"view" => $view,
				"dis_value" => $dis_value,
				//"count" => $count,
				
			);
		
				//}		//print_r($record);	

	}
        //# Response
		$response = array(
			"draw" => intval($draw),
			"iTotalRecords" => $totalRecords,
			"iTotalDisplayRecords" => $totalRecordwithFilter,
			"aaData" => $data,
			"bbData" => $data1
		);

		return $response;
	//
	}

}//end class

	
