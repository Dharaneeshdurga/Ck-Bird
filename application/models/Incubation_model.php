<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Incubation_model extends CI_Model{

    public function verify_data_wl($data_where) {
        
        $this->db->select('ci.*,cg.group_name,cs.bird_species,cs.days_brooder,cs.weight_loss_min,
		cs.weight_loss_max,cs.incub_days_min,cs.incub_days_max,ca.aviary_name');
        $this->db->from('ckb_incubation ci');
        $this->db->join('ckb_group cg', 'cg.auto_id = ci.group_id', 'left'); 
        $this->db->join('ckb_species cs', 'cs.auto_id = ci.species_id', 'left'); 
        $this->db->join('ckb_aviary ca', 'ca.auto_id = ci.aviary_id', 'left'); 
		$this->db->where($data_where); 

        $query = $this->db->get();
        return $query->result();
    }
	public function get_incubation_history_dt($date,$to_date){
		$branch_id = $this->session->userdata('branch_id');
		$this->db->select('count(*) as total_eggs');
		$this->db->from('ckb_incubation');
		$condition = "created_on BETWEEN " . "'" . $date . "'" . " AND " . "'" . $to_date . "'";
		if ($date != '' && $to_date != ''  ) $this->db->where($condition);
		$this->db->where('status',1);
		$this->db->where('branch_id',$branch_id);
		$records = $this->db->get()->result();
		$totalEggs = $records[0]->total_eggs;
		
	
		$this->db->select('count(*) as fertile_assist');
		$this->db->from('ckb_incubation');
		$condition = "created_on BETWEEN " . "'" . $date . "'" . " AND " . "'" . $to_date . "'";
		if ($date != '' && $to_date != ''  ) $this->db->where($condition);
		$array_where = array('fertile_type'=>'Fertile','hatch_type'=>'Assist');
		$this->db->where($array_where);
		$this->db->where('status',1);
		$this->db->where('branch_id',$branch_id);
		$records = $this->db->get()->result();
		$fertile_assist = $records[0]->fertile_assist;

		$this->db->select('count(*) as fertile_normal');
		$this->db->from('ckb_incubation');
		$condition = "created_on BETWEEN " . "'" . $date . "'" . " AND " . "'" . $to_date . "'";
		if ($date != '' && $to_date != ''  ) $this->db->where($condition);
		$array_where = array('fertile_type'=>'Fertile','hatch_type'=>'Normal');
		$this->db->where($array_where);
		$this->db->where('status',1);
		$this->db->where('branch_id',$branch_id);
		$records = $this->db->get()->result();
		$fertile_normal = $records[0]->fertile_normal;

		$this->db->select('count(*) as infertile');
		$this->db->from('ckb_incubation');
		$condition = "created_on BETWEEN " . "'" . $date . "'" . " AND " . "'" . $to_date . "'";
		if ($date != '' && $to_date != ''  ) $this->db->where($condition);
		$array_where = array('fertile_type'=>'In Fertile');
		$this->db->where($array_where);
		$this->db->where('status',1);
		$this->db->where('branch_id',$branch_id);
		$records = $this->db->get()->result();
		$infertile = $records[0]->infertile;

		$this->db->select('count(*) as dis');
		$this->db->from('ckb_incubation');
		$condition = "created_on BETWEEN " . "'" . $date . "'" . " AND " . "'" . $to_date . "'";
		if ($date != '' && $to_date != ''  ) $this->db->where($condition);
		$array_where = array('fertile_type'=>'Dis');
		$this->db->where($array_where);
		$this->db->where('status',1);
		$this->db->where('branch_id',$branch_id);
		$records = $this->db->get()->result();
		$dis = $records[0]->dis;


		$this->db->select('count(*) as crack');
		$this->db->from('ckb_incubation');
		$condition = "created_on BETWEEN " . "'" . $date . "'" . " AND " . "'" . $to_date . "'";
		if ($date != '' && $to_date != ''  ) $this->db->where($condition);
		$array_where = array('fertile_type'=>'Crack');
		$this->db->where($array_where);
		$this->db->where('status',1);
		$this->db->where('branch_id',$branch_id);
		$records = $this->db->get()->result();
		$crack = $records[0]->crack;

		$this->db->select('count(*) as broken');
		$this->db->from('ckb_incubation');
		$condition = "created_on BETWEEN " . "'" . $date . "'" . " AND " . "'" . $to_date . "'";
		if ($date != '' && $to_date != ''  ) $this->db->where($condition);
		$array_where = array('fertile_type'=>'Broken');
		$this->db->where($array_where);
		$this->db->where('status',1);
		$this->db->where('branch_id',$branch_id);
		$records = $this->db->get()->result();
		$broken = $records[0]->broken;



		$this->db->select('count(*) as unknown');
		$this->db->from('ckb_incubation');
		$condition = "created_on BETWEEN " . "'" . $date . "'" . " AND " . "'" . $to_date . "'";
		if ($date != '' && $to_date != ''  ) $this->db->where($condition);
		$array_where = array('fertile_type'=>'Unknown');
		$this->db->where($array_where);
		$this->db->where('status',1);
		$this->db->where('branch_id',$branch_id);
		$records = $this->db->get()->result();
		$unknown = $records[0]->unknown;

		$this->db->select('count(*) as healthy_chick');
		$this->db->from('ckb_incubation');
		$condition = "created_on BETWEEN " . "'" . $date . "'" . " AND " . "'" . $to_date . "'";
		if ($date != '' && $to_date != ''  ) $this->db->where($condition);
		$array_where = array('health_status'=>'Healthy chick');
		$this->db->where($array_where);
		$this->db->where('status',1);
		$this->db->where('branch_id',$branch_id);
		$records = $this->db->get()->result();
		$healthy_chick = $records[0]->healthy_chick;

		$this->db->select('count(*) as low_hatch_weight');
		$this->db->from('ckb_incubation');
		$condition = "created_on BETWEEN " . "'" . $date . "'" . " AND " . "'" . $to_date . "'";
		if ($date != '' && $to_date != ''  ) $this->db->where($condition);
		$array_where = array('health_status'=>'Low hatch weight chick');
		$this->db->where($array_where);
		$this->db->where('status',1);
		$this->db->where('branch_id',$branch_id);
		$records = $this->db->get()->result();
		$low_hatch_weight = $records[0]->low_hatch_weight;

		$this->db->select('count(*) as yolk_sac');
		$this->db->from('ckb_incubation');
		$condition = "created_on BETWEEN " . "'" . $date . "'" . " AND " . "'" . $to_date . "'";
		if ($date != '' && $to_date != ''  ) $this->db->where($condition);
		$array_where = array('health_status'=>'Unabsorbed yolk sac');
		$this->db->where($array_where);
		$this->db->where('status',1);
		$this->db->where('branch_id',$branch_id);
		$records = $this->db->get()->result();
		$yolk_sac = $records[0]->yolk_sac;

		
		$this->db->select('count(*) as yolk_sac_infection');
		$this->db->from('ckb_incubation');
		$condition = "created_on BETWEEN " . "'" . $date . "'" . " AND " . "'" . $to_date . "'";
		if ($date != '' && $to_date != ''  ) $this->db->where($condition);
		$array_where = array('health_status'=>'Yolk sac infection chick');
		$this->db->where($array_where);
		$this->db->where('status',1);
		$this->db->where('branch_id',$branch_id);
		$records = $this->db->get()->result();
		$yolk_sac_infection = $records[0]->yolk_sac_infection;

		$this->db->select('count(*) as splay_leg');
		$this->db->from('ckb_incubation');
		$condition = "created_on BETWEEN " . "'" . $date . "'" . " AND " . "'" . $to_date . "'";
		if ($date != '' && $to_date != ''  ) $this->db->where($condition);
		$array_where = array('health_status'=>'Splayed leg chick');
		$this->db->where($array_where);
		$this->db->where('status',1);
		$this->db->where('branch_id',$branch_id);
		$records = $this->db->get()->result();
		$splay_leg = $records[0]->splay_leg;

		$this->db->select('count(*) as wry_neck');
		$this->db->from('ckb_incubation');
		$condition = "created_on BETWEEN " . "'" . $date . "'" . " AND " . "'" . $to_date . "'";
		if ($date != '' && $to_date != ''  ) $this->db->where($condition);
		$array_where = array('health_status'=>'Wry neck chick');
		$this->db->where($array_where);
		$this->db->where('status',1);
		$this->db->where('branch_id',$branch_id);
		$records = $this->db->get()->result();
		$wry_neck = $records[0]->wry_neck;

			$data[] = array(
				"total_eggs" => $totalEggs,
				"fertile_assist" => $fertile_assist,
				"fertile_normal" => $fertile_normal,
				"infertile" => $infertile,
				"dis" => $dis,
				"crack" => $crack,
				"broken" => $broken,
				"healthy_chick" => $healthy_chick,
				"low_hatch_weight" => $low_hatch_weight,
				"yolk_sac" => $yolk_sac,
				"yolk_sac_infection" => $yolk_sac_infection,
				"splay_leg" => $splay_leg,
				"wry_neck" => $wry_neck,
				"unknown" => $unknown,
			);


		return $data;

	}
	public function get_stunded_byBirth($date,$to_date){
		$branch_id = $this->session->userdata('branch_id');
		$this->db->select('i.*,s.*,i.hatch_weight as hatch_weight,s.std_hatch_weight as std_weight,
		g.group_name as group_name,s.bird_species as bird_species,a.aviary_name as aviary_name');
		$this->db->from('ckb_incubation i');
		$this->db->join('ckb_group as g', 'i.group_id = g.auto_id');
		$this->db->join('ckb_species as s', 'i.species_id = s.auto_id');
		$this->db->join('ckb_aviary as a', 'i.aviary_id = a.auto_id');
		$this->db->where('i.status',1);
		$condition = "i.created_on BETWEEN " . "'" . $date . "'" . " AND " . "'" . $to_date . "'";
		if ($date != '' && $to_date != ''  ) $this->db->where($condition);
		$this->db->where('i.status',1);
		$this->db->where('i.branch_id',$branch_id);
		$records = $this->db->get()->result();
		return $records;

	}

	public function verify_data_history_wl($data_where) {
		$response = array();

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
			$search_arr[] = " (i.male_parent_ringno like '%" . $searchValue . "%' or 
            group_name like '%" . $searchValue . "%' or 
            bird_species like '%" . $searchValue . "%' or 
            gender like '%" . $searchValue . "%' or 
            cage like '%" . $searchValue . "%' or 
            aviary_name like '%" . $searchValue . "%' or 
            i.female_parent_ringno like'%" . $searchValue . "%' ) ";
		}

		if (count($search_arr) > 0) {
			$searchQuery = implode(" and ", $search_arr);
		}

        //# Total number of records without filtering
		$this->db->select('count(*) as allcount');
		$this->db->from('ckb_incubation i');
		$this->db->join('ckb_group as g', 'i.group_id = g.auto_id');
		$this->db->join('ckb_species as s', 'i.species_id = s.auto_id');
		$this->db->join('ckb_aviary as a', 'i.aviary_id = a.auto_id');
		if ($searchQuery != '') $this->db->where($searchQuery);

        // $this->db->where($postData_where);

		$records = $this->db->get()->result();

		$totalRecords = $records[0]->allcount;

		
        //# Total number of record with filtering
		$this->db->select('count(*) as allcount');
		$this->db->from('ckb_incubation i');
		$this->db->join('ckb_group as g', 'i.group_id = g.auto_id');
		$this->db->join('ckb_species as s', 'i.species_id = s.auto_id');
		$this->db->join('ckb_aviary as a', 'i.aviary_id = a.auto_id');

		if ($searchQuery != '') $this->db->where($searchQuery);

		//   $this->db->where($postData_where);

		$records = $this->db->get()->result();

		$totalRecordwithFilter = $records[0]->allcount;

        //# Fetch records
		$this->db->select(
			'i.*,s.std_hatch_weight as std_hatch_weight,
			g.group_name as group_name,s.bird_species as bird_species,a.aviary_name as aviary_name,u.user_name as user_name'
		);
		$this->db->from('ckb_incubation i');
		$this->db->join('ckb_group as g', 'i.group_id = g.auto_id');
		$this->db->join('ckb_species as s', 'i.species_id = s.auto_id');
		$this->db->join('ckb_aviary as a', 'i.aviary_id = a.auto_id');
		$this->db->join('ckb_users as u', 'i.created_by = u.user_id');

		if ($searchQuery != '') $this->db->where($searchQuery);

		//   $this->db->where($postData_where);
		$this->db->order_by('i.id', 'desc');  // or desc

		$this->db->limit($rowperpage, $start);

		$records = $this->db->get()->result();

		$data = array();

		foreach ($records as $record) {
			if($record->status == '0'){   // check the status and return the data
			$timedate1 = strtotime(date("Y-m-d", strtotime($record->created_on)));
			$created_on = date("d-m-Y", $timedate1);

			$timedate2 = strtotime(date("Y-m-d", strtotime($record->doi)));
			$doi = date("d-m-Y", $timedate2);
			
			$timedate3 = strtotime(date("Y-m-d", strtotime($record->dof)));
			$dof = date("d-m-Y", $timedate3);
			
			if($record->pip_date !='0000-00-00'){
				$timedate4 = strtotime(date("Y-m-d", strtotime($record->pip_date)));
				$pip_date = date("d-m-Y", $timedate4);
			}else{
				$pip_date = "";
			}

			if($record->hatch_date !='0000-00-00'){
				$timedate5 = strtotime(date("Y-m-d", strtotime($record->hatch_date)));
				$hatch_date = date("d-m-Y", $timedate5);
			}else{
				$hatch_date = "";
			}

			if($record->dis_date !='0000-00-00'){
				$timedate6 = strtotime(date("Y-m-d", strtotime($record->dis_date)));
				$dis_date = date("d-m-Y", $timedate6);
			}else{
				$dis_date = "";
			}
				
      		$action_url1 = base_url()."index.php/Incubation/edit_incubation_details/".$record->auto_id;

      		$action_url2 = base_url()."index.php/Incubation/add_weight_loss/".$record->auto_id;

			  $action_url3 = base_url()."index.php/Incubation/move_incubation/".$record->auto_id;

			$action = '<a href="'.$action_url1.'" class="btn btn-info btn-xs waves-effect waves-light tooltips" data-trigger="hover" data-placement="top" data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-pencil-square-o" id="editBtn"></i></a>';
			
      		$action .= '  <button  onclick="get_delete_pop('."'".$record->auto_id."'".');" class="btn btn-danger btn-xs waves-effect waves-light tooltips" data-placement="top" data-toggle="tooltip" id="Deletebtn" data-original-title="Delete"><i class="fa fa-close"></i></button>';
      		
			if($record->fertile_type =='Fertile'){
				$action .= '<br><a href="'.$action_url2.'" target="_blank"><button class="btn btn-primary btn-xs waves-effect waves-light tooltips" style="margin-top:5px;" data-placement="top" data-toggle="tooltip" id="Weightlossbtn" title="Weight Loss">Update Weight Loss</button></a>';
			}  
			// if($record->hatch_weight < $record->std_weight){
			// 	$stund_status ="Stunded By Birth";
			// }
			// if($record->hatch_weight >= $record->std_weight){
			// 	$stund_status = $record->std_weight;
			// }
			$health_status = "Normal";
			$data[] = array(
				"id" => $record->id,
				"auto_id" => $record->auto_id,
				"group_name" => $record->group_name,
				"bird_species" => $record->bird_species,
				"cage" => $record->cage,
				"aviary_name" => $record->aviary_name,
				"male_parent_ringno" => $record->male_parent_ringno,
				"female_parent_ringno" => $record->female_parent_ringno,
				"egg_no" => $record->egg_no,
				"doi" => $doi,
				"egg_weight" => $record->egg_weight,
				"fertile_type" => $record->fertile_type,
				"dof" => $dof,
				"remark" => $record->remark,
				"pip_weight" => $record->pip_weight,
				"pip_date" => $pip_date,
				"hatch_weight" => $record->hatch_weight,
				"hatch_date" => $hatch_date,
				"shell_weight" => $record->shell_weight,
				"hatch_type" => $record->hatch_type,
				"shell_thick" => $record->shell_thick,
				"dis_type" => $record->dis_type,
				"dis_date" => $dis_date,
				"user_name" => $record->user_name,
				"moved_on" => $record->moved_on,
				"brooder" => $record->brooder,
				"action" => $action,
				//"stunt_status" => "normal"

			);
		}
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
	
        
	public function verify_data_handfeed_dt($postData){
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
			$search_arr[] = " (i.male_parent_ringno like '%" . $searchValue . "%' or 
            g.group_name like '%" . $searchValue . "%' or 
            s.bird_species like '%" . $searchValue . "%' or 
            a.aviary_name like '%" . $searchValue . "%' or 
			i.egg_no like '%" . $searchValue . "%' or
            i.female_parent_ringno like'%" . $searchValue . "%' ) ";
		}

		if (count($search_arr) > 0) {
			$searchQuery = implode(" and ", $search_arr);
		}

        //# Total number of records without filtering
		$this->db->select('count(*) as allcount');
		$this->db->from('ckb_incubation i');
		$this->db->join('ckb_group as g', 'i.group_id = g.auto_id','left');
		$this->db->join('ckb_species as s', 'i.species_id = s.auto_id','left');
		$this->db->join('ckb_aviary as a', 'i.aviary_id = a.auto_id','left');
	//	$this->db->join('ckb_brooder as b', 'i.brooder = b.auto_id');
		$this->db->join('ckb_move_brooder as m', 'i.auto_id = m.incub_id','left');
		$this->db->where('i.status = 0');
		$this->db->where_not_in('i.health_status','Mortality');
		$wh_arry = array('Production','Sale');
		$this->db->where_not_in('i.bird_status',$wh_arry);
		$this->db->where('i.branch_id',$branch_id);
	//	$this->db->join('ckb_brooder as c', 'm.move_35_brooder = b.auto_id');
		if ($searchQuery != '') $this->db->where($searchQuery);

        // $this->db->where($postData_where);

		$records = $this->db->get()->result();

		$totalRecords = $records[0]->allcount;

		
        //# Total number of record with filtering
		$this->db->select('count(*) as allcount');
		$this->db->from('ckb_incubation i');
		$this->db->join('ckb_group as g', 'i.group_id = g.auto_id','left');
		$this->db->join('ckb_species as s', 'i.species_id = s.auto_id','left');
		$this->db->join('ckb_aviary as a', 'i.aviary_id = a.auto_id','left');
		//$this->db->join('ckb_brooder as b', 'i.brooder = b.auto_id');
		$this->db->join('ckb_move_brooder as m', 'i.auto_id = m.incub_id','left');
		$this->db->where('i.status = 0');
		$this->db->where_not_in('i.health_status','Mortality');
		$wh_arry = array('Production','Sale');
		$this->db->where_not_in('i.bird_status',$wh_arry);
		$this->db->where('i.branch_id',$branch_id);
		//$this->db->join('ckb_brooder as c', 'm.move_35_brooder = b.auto_id');
		if ($searchQuery != '') $this->db->where($searchQuery);

		//   $this->db->where($postData_where);

		$records = $this->db->get()->result();

		$totalRecordwithFilter = $records[0]->allcount;

        //# Fetch records
		$this->db->select(
			'i.*,s.std_hatch_weight as std_hatch_weight,g.group_name as group_name,s.bird_species as bird_species,s.days_brooder as days_brooder,a.aviary_name as aviary_name,u.user_name as user_name, m.move_handfeed_date as move_handfeed_date,
			m.move_handfeed_brooder as move_handfeed_brooder,m.move_35_date as move_35_date,m.move_34_date as move_34_date,m.move_33_date as move_33_date,m.status as move_status'
		);
		$this->db->from('ckb_incubation i');
		$this->db->join('ckb_group as g', 'i.group_id = g.auto_id','left');
		$this->db->join('ckb_species as s', 'i.species_id = s.auto_id','left');
		$this->db->join('ckb_aviary as a', 'i.aviary_id = a.auto_id','left');
		$this->db->join('ckb_users as u', 'i.created_by = u.user_id','left');
		$this->db->join('ckb_move_brooder as m', 'i.auto_id = m.incub_id','left');
	//	$this->db->join('ckb_move_brooder as m', 'i.egg_no = m.incub_id');
		//$this->db->join('ckb_brooder as b', 'm.move_handfeed_brooder = b.auto_id');
		$this->db->where('i.status = 0');
		$this->db->where_not_in('i.health_status','Mortality');
		$wh_arry = array('Production','Sale');
		$this->db->where_not_in('i.bird_status',$wh_arry);
		$this->db->where('i.branch_id',$branch_id);
		//$this->db->join('ckb_brooder as c', 'm.move_35_brooder = b.auto_id');

		if ($searchQuery != '') $this->db->where($searchQuery);

		//   $this->db->where($postData_where);
		$this->db->order_by('i.id', 'desc');  // or desc

		$this->db->limit($rowperpage, $start);

		$records = $this->db->get()->result();
		// print_r($this->db->last_query());die;
		$data = array();

		foreach ($records as $record) {
		//	if($record->status == '0'){   // check the status and return the data
			$timedate1 = strtotime(date("Y-m-d", strtotime($record->created_on)));
			$created_on = date("d-m-Y", $timedate1);

			$timedate2 = strtotime(date("Y-m-d", strtotime($record->doi)));
			$doi = date("d-m-Y", $timedate2);
			
			$timedate3 = strtotime(date("Y-m-d", strtotime($record->dof)));
			$dof = date("d-m-Y", $timedate3);
			
			if($record->pip_date !='0000-00-00'){
				$timedate4 = strtotime(date("Y-m-d", strtotime($record->pip_date)));
				$pip_date = date("d-m-Y", $timedate4);
			}else{
				$pip_date = "";
			}

			if($record->hatch_date !='0000-00-00'){
				$timedate5 = strtotime(date("Y-m-d", strtotime($record->hatch_date)));
				$hatch_date = date("d-m-Y", $timedate5);
			}else{
				$hatch_date = "";
			}

			if($record->dis_date !='0000-00-00'){
				$timedate6 = strtotime(date("Y-m-d", strtotime($record->dis_date)));
				$dis_date = date("d-m-Y", $timedate6);
			}else{
				$dis_date = "";
			}
				if($record->gender !=""){
					$action = "sold";
					$view = "sold";
					$moved_ch_date="00-00-0000";
				}


			$action_url1 = base_url()."index.php/Handfeeding/view_handfeed_details/".$record->auto_id;

      		$action_url2 = base_url()."index.php/Handfeeding/handfeed_details/".$record->auto_id;

			  $action_url3 = base_url()."index.php/Incubation/move_incubation/".$record->auto_id;

//$action = "";
//$action = '<button  onclick="handfeed_history_pop('."'".$record->auto_id."'".');" class="btn btn-pink btn-xs waves-effect waves-light tooltips" style="margin-top:5px;" data-placement="top" data-toggle="tooltip" id="Deletebtn" data-original-title="Delete">View Handfeed History</button>';
$action = '<a href="'.$action_url2.'" target="_blank"><button class="btn btn-primary btn-xs waves-effect waves-light tooltips" data-placement="top" data-toggle="tooltip" id="update" title="Update Handfeed Details"><i class="fa fa-eject" aria-hidden="true"></i> </button></a>  '; 
$action .= '<button  onclick="get_move_production('."'".$record->auto_id."'".');" class="btn btn-purple btn-xs waves-effect   waves-light tooltips" data-placement="top" data-toggle="tooltip" id="move" title="Move to sale"><i class="fa fa-exchange"></i></button><br><br>';

// very important for moving brooder and pre weaning ***** start code
$days_brooder = $record->days_brooder;// species-- no of days in brooder

if($record->move_status == 0){
	$moved_ch_date = $record->move_handfeed_date;
	$moved_36_date = date_create($record->move_handfeed_date);
$today_date = date("d-m-Y");
$today_date = date_create($today_date);
$diff = date_diff($moved_36_date,$today_date);
$diff_36 = $diff->format("%a"); // days calcualted from brooder 4

$brooder_name ="Brooder 36";

if($diff_36 >= $days_brooder){
	$action .= '  <button  onclick="get_moveBrooder_pop('."'".$record->auto_id."'".','."'".$brooder_name."'".');" class="btn btn-success btn-xs waves-effect waves-light tooltips " data-placement="top" data-toggle="tooltip" id="" title="Move Brooder"><i class="fa fa-exchange" aria-hidden="true"></i></i></button>  ';

}
else {
	$action .= '<button  onclick="get_moveBrooder_pop('."'".$record->auto_id."'".','."'".$brooder_name."'".');" class="btn btn-success btn-xs waves-effect waves-light tooltips" data-placement="top" data-toggle="tooltip" id="" title="Move Brooder" disabled><i class="fa fa-exchange" aria-hidden="true"></i></button>  ';		
}
}

//$diff_35 = $diff_34 = $diff_33 = "";
if($record->move_status == 3){
	$brooder_name = "Brooder 35";
	$moved_ch_date = $record->move_35_date;
//	$moved_ch_date = "14-09-2021";
	$moved_35_date = date_create($moved_ch_date);
	//$moved_35_date = date_create($record->move_35_date);
$today_date = date("d-m-Y");
$today_date = date_create($today_date);
$diff = date_diff($moved_35_date,$today_date);
$diff_35 = $diff->format("%a");
if($diff_35 >= $days_brooder){
	$action .= '  <button  onclick="get_moveBrooder_pop('."'".$record->auto_id."'".','."'".$brooder_name."'".');" class="btn btn-success btn-xs waves-effect waves-light tooltips" data-placement="top" data-toggle="tooltip" id="" title="Move Brooder"><i class="fa fa-exchange" aria-hidden="true"></i></button>  ';

}
else {
	$action .= '<button  onclick="get_moveBrooder_pop('."'".$record->auto_id."'".','."'".$brooder_name."'".');" class="btn btn-success btn-xs waves-effect waves-light tooltips" data-placement="top" data-toggle="tooltip" id="" title="Move Brooder" disabled><i class="fa fa-exchange" aria-hidden="true"></i></button>  ';		
}
}
if($record->move_status == 2){
	$brooder_name = "Brooder 34";
	$moved_ch_date = $record->move_34_date;
	$moved_34_date = date_create($record->move_34_date);
	//$moved_ch_date = "14-09-2021";
	//$moved_34_date = date_create("14-09-2021");
	
$today_date = date("d-m-Y");
//$today_date = date_create($today_date);
$diff = date_diff($moved_34_date,$today_date);
$diff_34 = $diff->format("%a");
if($diff_34 >= $days_brooder){
	$action .= '  <button  onclick="get_moveBrooder_pop('."'".$record->auto_id."'".','."'".$brooder_name."'".');" class="btn btn-success btn-xs waves-effect waves-light tooltips" data-placement="top" data-toggle="tooltip" id="" data-original-title="move"><i class="fa fa-exchange" aria-hidden="true"></i></button>  ';

}
else {
	$action .= '<button  onclick="get_moveBrooder_pop('."'".$record->auto_id."'".','."'".$brooder_name."'".');" class="btn btn-success btn-xs waves-effect waves-light tooltips" data-placement="top" data-toggle="tooltip" id="" data-original-title="move" disabled><i class="fa fa-exchange" aria-hidden="true"></i></button>  ';		
}

} 

if($record->move_status == 1){
	$brooder_name = "Brooder 33";
	$moved_ch_date = $record->move_33_date;
	$moved_33_date = date_create($record->move_33_date);
//	$moved_ch_date = "14-09-2021";
	//$moved_33_date = date_create("14-09-2021");
$today_date = date("d-m-Y");
$today_date = date_create($today_date);
$diff = date_diff($moved_33_date,$today_date);
$diff_33 = $diff->format("%a");

if($diff_33 >= $days_brooder){
	$action .= '<button  onclick="get_movePreWeaning('."'".$record->auto_id."'".','."'".$brooder_name."'".');" class="btn btn-success btn-xs waves-effect waves-light tooltips" data-placement="top" data-toggle="tooltip" id="" title="Move to Pre Weaning"><i class="fa fa-exchange" aria-hidden="true"></i></button>	';	

}
else{
	$action .= '<button  onclick="get_movePreWeaning('."'".$record->auto_id."'".','."'".$brooder_name."'".');" class="btn btn-success btn-xs waves-effect waves-light tooltips" data-placement="top" data-toggle="tooltip" id="" title="Move to Pre Weaning" disabled><i class="fa fa-exchange" aria-hidden="true"></i></button>	';		
}

}
/*if(($diff >= $days_brooder) && ($diff_35 >= $days_brooder) && ($diff_34 >= $days_brooder)  ){
$action .= '  <button  onclick="get_moveBrooder_pop('."'".$record->auto_id."'".');" class="btn btn-success btn-xs waves-effect waves-light tooltips" data-placement="top" data-toggle="tooltip" id="" data-original-title="move">Move Brooder</i></button>';	
}*/



// very important for moving brooder and pre weaning ***** end code


$view = '<a href="'.$action_url1.'" class="btn btn-pink btn-xs waves-effect waves-light tooltips text-center" style="margin-left:50px;margin-top:5px;" data-trigger="hover" data-placement="top" data-toggle="tooltip" title="View handfeed history"><i class="fa fa-eye" aria-hidden="true"></i></a>';
//end of sale if
$action .= '<button  onclick="change_healthStatus('."'".$record->auto_id."'".');" class="btn btn-danger btn-xs waves-effect waves-light tooltips" data-placement="top" data-toggle="tooltip" id="" title="change health status"><i class="fa fa-exchange" aria-hidden="true"></i></button>	<br><br>';		
$action .= '<button  onclick="revert_to_incubation('."'".$record->egg_no."'".','."'".$record->auto_id."'".');" class="btn btn-warning btn-xs waves-effect   waves-light tooltips" data-placement="top" data-toggle="tooltip" id="move" title="Revert"><i class="fa fa-undo"></i></button><br><br>';

// if($record->hatch_weight < $record->std_hatch_weight){
// 	$health_status .="Stunded By Birth,<br>";
// }
// if($record->hatch_weight >= $record->std_hatch_weight){
// 	$stund_status = "Normal";
// }

// $query = $this->db->get_where('ckb_handfee', array('incub_id' => $record->auto_id ));
// $count = $query->num_rows();
// if($count >0){
// 	$this->db->select('std_weight,act_weight');
// 	$this->db->from('ckb_handfee');
// 	$this->db->where('incub_id',$record->auto_id );
// 	$handfee_details = $this->db->get()->result();
// 	foreach($handfee_details as $result){
// 		$std_weight = $result->std_weight;
// 		$twenty_percent = ($std_weight*20)/100;
// 		$act_weight = $result->act_weight;
// 	}
// 	if($act_weight < $twenty_percent){
// 		$health_status .="Stunted after birth<br>";
// 	}

// }
// else if($count <=0){
// 	$health_status .="";
// 	$twenty_percent="";
// }
//$health_status .=$record->health_status;
$data[] = array(
				"id" => $record->id,
				"auto_id" => $record->auto_id,
				"group_name" => $record->group_name,
				"bird_species" => $record->bird_species,
				"cage" => $record->cage,
				"aviary_name" => $record->aviary_name,
				"male_parent_ringno" => $record->male_parent_ringno,
				"female_parent_ringno" => $record->female_parent_ringno,
				"egg_no" => $record->egg_no,
				"doi" => $doi,
				"egg_weight" => $record->egg_weight,
				"fertile_type" => $record->fertile_type,
				"dof" => $dof,
				"remark" => $record->remark,
				"pip_weight" => $record->pip_weight,
				"pip_date" => $pip_date,
				"hatch_weight" => $record->hatch_weight,
				"hatch_date" => $hatch_date,
				"shell_weight" => $record->shell_weight,
				"hatch_type" => $record->hatch_type,
				"shell_thick" => $record->shell_thick,
				"dis_type" => $record->dis_type,
				"dis_date" => $dis_date,
				"user_name" => $record->user_name,
				"moved_on" =>$moved_ch_date,
				"brooder" => $brooder_name,
				"action" => $action,
				"view" => $view,
				//"stunt_status" => $stund_status,
				"health_status" => $record->health_status



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


		
		
	public function get_incubation_historyView_dt($postData,$array_where,$date,$to_date){
		$branch_id = $this->session->userdata('branch_id');
		$response = array();
        //# Read value
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
			$search_arr[] = " (i.male_parent_ringno like '%" . $searchValue . "%' or 
            g.group_name like '%" . $searchValue . "%' or 
            s.bird_species like '%" . $searchValue . "%' or 
            a.aviary_name like '%" . $searchValue . "%' or 
			i.egg_no like '%" . $searchValue . "%' or 
			i.cage like '%" . $searchValue . "%' or 
            i.female_parent_ringno like'%" . $searchValue . "%' ) ";
		}

		if (count($search_arr) > 0) {
			$searchQuery = implode(" and ", $search_arr);
		}

        //# Total number of records without filtering
		$this->db->select('count(*) as allcount');
		$this->db->from('ckb_incubation i');
		$this->db->join('ckb_group as g', 'i.group_id = g.auto_id');
		$this->db->join('ckb_species as s', 'i.species_id = s.auto_id');
		$this->db->join('ckb_aviary as a', 'i.aviary_id = a.auto_id');
		if ($array_where != '') $this->db->where($array_where);
		$condition = "i.created_on BETWEEN " . "'" . $date . "'" . " AND " . "'" . $to_date . "'";
		if ($date != '' && $to_date != ''  ) $this->db->where($condition);
		$this->db->where('i.status',1);
		$this->db->where('i.branch_id',$branch_id);
		if ($searchQuery != '') $this->db->where($searchQuery);

        // $this->db->where($postData_where);

		$records = $this->db->get()->result();

		$totalRecords = $records[0]->allcount;

        //# Total number of record with filtering
		$this->db->select('count(*) as allcount');
		$this->db->from('ckb_incubation i');
		$this->db->join('ckb_group as g', 'i.group_id = g.auto_id');
		$this->db->join('ckb_species as s', 'i.species_id = s.auto_id');
		$this->db->join('ckb_aviary as a', 'i.aviary_id = a.auto_id');
		if ($array_where != '') $this->db->where($array_where);
		$condition = "i.created_on BETWEEN " . "'" . $date . "'" . " AND " . "'" . $to_date . "'";
		if ($date != '' && $to_date != ''  ) $this->db->where($condition);
		$this->db->where('i.status',1);
		$this->db->where('i.branch_id',$branch_id);
		if ($searchQuery != '') $this->db->where($searchQuery);

		//   $this->db->where($postData_where);

		$records = $this->db->get()->result();

		$totalRecordwithFilter = $records[0]->allcount;

        //# Fetch records
		$this->db->select(
			'i.*,s.std_hatch_weight as std_hatch_weight,s.std_egg_weight as std_egg_weight,
			g.group_name as group_name,s.bird_species as bird_species,a.aviary_name as aviary_name,u.user_name as user_name'
		);
		$this->db->from('ckb_incubation i');
		$this->db->join('ckb_group as g', 'i.group_id = g.auto_id');
		$this->db->join('ckb_species as s', 'i.species_id = s.auto_id');
		$this->db->join('ckb_aviary as a', 'i.aviary_id = a.auto_id');
		$this->db->join('ckb_users as u', 'i.created_by = u.user_id');
		if ($array_where != '') $this->db->where($array_where);
		$condition = "i.created_on BETWEEN " . "'" . $date . "'" . " AND " . "'" . $to_date . "'";
		if ($date != '' && $to_date != ''  ) $this->db->where($condition);
		$this->db->where('i.status',1);
		$this->db->where('i.branch_id',$branch_id);
		if ($searchQuery != '') $this->db->where($searchQuery);

		//   $this->db->where($postData_where);
		$this->db->order_by('i.id', 'desc');  // or desc

		$this->db->limit($rowperpage, $start);

		$records = $this->db->get()->result();

		$data = array();

		foreach ($records as $record) {
		//	if($record->status == '1'){
			$timedate1 = strtotime(date("Y-m-d", strtotime($record->created_on)));
			$created_on = date("d-m-Y", $timedate1);

			$timedate2 = strtotime(date("Y-m-d", strtotime($record->doi)));
			$doi = date("d-m-Y", $timedate2);
			
			$timedate3 = strtotime(date("Y-m-d", strtotime($record->dof)));
			$dof = date("d-m-Y", $timedate3);
			
			if($record->pip_date !='0000-00-00'){
				$timedate4 = strtotime(date("Y-m-d", strtotime($record->pip_date)));
				$pip_date = date("d-m-Y", $timedate4);
			}else{
				$pip_date = "";
			}

			if($record->hatch_date !='0000-00-00'){
				$timedate5 = strtotime(date("Y-m-d", strtotime($record->hatch_date)));
				$hatch_date = date("d-m-Y", $timedate5);
			}else{
				$hatch_date = "";
			}

			if($record->dis_date !='0000-00-00'){
				$timedate6 = strtotime(date("Y-m-d", strtotime($record->dis_date)));
				$dis_date = date("d-m-Y", $timedate6);
			}else{
				$dis_date = "";
			}
				
      		$action_url1 = base_url()."index.php/Incubation/edit_incubation_details/".$record->auto_id;

      		$action_url2 = base_url()."index.php/Incubation/add_weight_loss/".$record->auto_id;

			  $action_url3 = base_url()."index.php/Incubation/move_incubation/".$record->auto_id;
			  $action_url4 = base_url()."index.php/Incubation/view_weight_loss/".$record->auto_id;

			$action = '<a href="'.$action_url1.'" class="btn btn-info btn-xs waves-effect waves-light tooltips" data-trigger="hover" data-placement="top" data-toggle="tooltip" title="Edit"><i class="fa fa-pencil-square-o" id="editBtn"></i></a>';
			
      		$action .= '  <button  onclick="get_delete_pop('."'".$record->auto_id."'".');" class="btn btn-danger btn-xs waves-effect waves-light tooltips" data-placement="top" data-toggle="tooltip" id="Deletebtn" title="Delete"><i class="fa fa-close"></i></button><br>';
      		
			if($record->fertile_type =='Fertile'){
				$action .= '<a href="'.$action_url2.'" target="_blank"><button class="btn btn-primary btn-xs waves-effect waves-light tooltips" style="margin-top:5px;" data-placement="top" data-toggle="tooltip" id="update" title="Update weight loss"><i class="fa fa-eject" aria-hidden="true"></i></button></a>';
			}  
			if($record->fertile_type =='Fertile'){
				//$action .= '<br><a href="'.$action_url3.'" target="_blank"><button class="btn btn-success btn-xs waves-effect waves-light tooltips" style="margin-top:5px;" data-placement="top" data-toggle="tooltip" id="movehandfeedbtn" title="move handfeed">Move to Handfeeding</button></a>';
				$action .= '     <button  onclick="get_move_pop('."'".$record->auto_id."'".');" class="btn btn-success btn-xs waves-effect waves-light tooltips" style="margin-top:5px;" data-placement="top" data-toggle="tooltip" id="move" title="Move to Handfeeding"><i class="fa fa-exchange" aria-hidden="true"></i></button>';
			}
			$action .= '     <button  onclick="change_health_status('."'".$record->auto_id."'".');" class="btn btn-warning btn-xs waves-effect waves-light tooltips" style="margin-top:5px; color:white;" data-placement="top" data-toggle="tooltip" id="move" title="Change Health Status"><i class="fa fa-exchange" aria-hidden="true"></i></button>';

	        $weight_loss = '<br><a href="'.$action_url4.'" target="_blank"><button class="btn btn-purple btn-xs waves-effect waves-light tooltips text-center" style="margin-left:50px;" data-placement="top" data-toggle="tooltip" id="view weight loss history" title="view"><i class="fa fa-eye"></i></button></a>';
			/*	$action .='<select class="form-control" style="margin-top:5px;" onchange="get_incubation_status(this);">';
			$action .='<option value="">Select</option>';
			$action .='<option value="Hand Feeding">Hand Feeding</option>';
			$action .='<option value="Pre Weaning">Pre Weaning</option>';
			$action .='<option value="Weaning">Weaning</option>';
			$action .='</select>';*/
			if($record->hatch_weight < $record->std_hatch_weight){
					$stund_status ="Stunted By Birth";
				}
				if($record->hatch_weight >= $record->std_hatch_weight){
					$stund_status = "Normal";
				}
			$bos_date = strtotime(date("Y-m-d", strtotime($record->bos_date)));
			$bos_date = date("d-m-Y", $bos_date);
			$data[] = array(
				"id" => $record->id,
				"auto_id" => $record->auto_id,
				"group_name" => $record->group_name,
				"bird_species" => $record->bird_species,
				"cage" => $record->cage,
				"aviary_name" => $record->aviary_name,
				"male_parent_ringno" => $record->male_parent_ringno,
				"female_parent_ringno" => $record->female_parent_ringno,
				"egg_no" => $record->egg_no,
				"doi" => $doi,
				"egg_weight" => $record->egg_weight,
				"fertile_type" => $record->fertile_type,
				"dof" => $dof,
				"remark" => $record->remark,
				"pip_weight" => $record->pip_weight,
				"pip_date" => $pip_date,
				"hatch_weight" => $record->hatch_weight,
				"hatch_date" => $hatch_date,
				"shell_weight" => $record->shell_weight,
				"hatch_type" => $record->hatch_type,
				"shell_thick" => $record->shell_thick,
				"dis_type" => $record->dis_type,
				"dis_date" => $dis_date,
				"user_name" => $record->user_name,
				"created_on" => $created_on,
				"action" => $action,
				"weight_loss" => $weight_loss,
				"stunt_status" => $record->health_status,
				"egg_length" =>$record->egg_length,
				"egg_breadth" =>$record->egg_breadth,
				"egg_index" =>$record->egg_index,
				"shell_layer" =>$record->shell_layer,
				"hatch_time" =>$record->hatch_time,
				"moved_time" =>$record->moved_time,
				"bos_date" =>$bos_date,
				"bos_findings" =>$record->bos_findings,
				"lay_pip_weight" =>$record->lay_pip_weight,
				"dis_weight" =>$record->dis_weight,
				"incubator" =>$record->incubator,
				"std_egg_weight" =>$record->std_egg_weight,
				"clutch_no" =>$record->clutch_no,
				"egg_no_clutch" =>$record->egg_no_clutch,
				"std_hatch_weight" => $record->std_hatch_weight,


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
	// public function select_brooder($id){
	// 	$this->db->select('i.*,s.*,i.hatch_weight as hatch_weight,s.std_hatch_weight as std_weight,
	// 	g.group_name as group_name,s.bird_species as bird_species,a.aviary_name as aviary_name');
	// 	$this->db->from('ckb_incubation i');
	// 	$this->db->join('ckb_group as g', 'i.group_id = g.auto_id');
	// 	$this->db->join('ckb_species as s', 'i.species_id = s.auto_id');
	// 	$this->db->join('ckb_aviary as a', 'i.aviary_id = a.auto_id');
	// 	$this->db->where('i.auto_id', $id);
	// 	$records = $this->db->get()->result();
	// 	return $records;

	// }



}

?>
