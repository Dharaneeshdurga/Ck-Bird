<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Preweaning_model extends CI_Model
{
	
	public function get_preweaning_history_dt($date,$to_date){
		$branch_id = $this->session->userdata('branch_id');
		$this->db->select('count(*) as total_chicks');
		$this->db->from('ckb_incubation');
		$condition = "created_on BETWEEN " . "'" . $date . "'" . " AND " . "'" . $to_date . "'";
		if ($date != '' && $to_date != ''  ) $this->db->where($condition);
		$this->db->where('status',2);
		$this->db->where('branch_id',$branch_id);
		$records = $this->db->get()->result();
		$total_chicks = $records[0]->total_chicks;
		
	
		$this->db->select('count(*) as total_weaning');
		$this->db->from('ckb_incubation');
		$condition = "created_on BETWEEN " . "'" . $date . "'" . " AND " . "'" . $to_date . "'";
		if ($date != '' && $to_date != ''  ) $this->db->where($condition);
		//$array_where = array('status'=>'3','status'=>'4');
		//$this->db->where($array_where);
		$this->db->where('status','3');
		$this->db->where('branch_id',$branch_id);
		//$this->db->or_where('status','4');
		$records = $this->db->get()->result();
		$total_weaning = $records[0]->total_weaning;

		$this->db->select('count(*) as splay_leg');
		$this->db->from('ckb_incubation');
		$condition = "created_on BETWEEN " . "'" . $date . "'" . " AND " . "'" . $to_date . "'";
		if ($date != '' && $to_date != ''  ) $this->db->where($condition);
		$array_where = array('status'=>'2','health_status'=>'Splay Leg');
		$this->db->where($array_where);
		$this->db->where('branch_id',$branch_id);
		//$this->db->where('status',1);
		$records = $this->db->get()->result();
		$splay_leg = $records[0]->splay_leg;

		$this->db->select('count(*) as airbubble');
		$this->db->from('ckb_incubation');
		$condition = "created_on BETWEEN " . "'" . $date . "'" . " AND " . "'" . $to_date . "'";
		if ($date != '' && $to_date != ''  ) $this->db->where($condition);
		$array_where = array('status'=>'2','health_status'=>'Airbubble');
		$this->db->where($array_where);
		$this->db->where('branch_id',$branch_id);
		//$this->db->where('status',1);
		$records = $this->db->get()->result();
		$airbubble = $records[0]->airbubble;

		$this->db->select('count(*) as mortality');
		$this->db->from('ckb_incubation');
		$condition = "created_on BETWEEN " . "'" . $date . "'" . " AND " . "'" . $to_date . "'";
		if ($date != '' && $to_date != ''  ) $this->db->where($condition);
		$array_where = array('status'=>'2','health_status'=>'Mortality');
		$this->db->where($array_where);
		$this->db->where('branch_id',$branch_id);
		//$this->db->where('status',1);
		$records = $this->db->get()->result();
		$mortality = $records[0]->mortality;

		$this->db->select('count(*) as sale');
		$this->db->from('ckb_incubation');
		$condition = "created_on BETWEEN " . "'" . $date . "'" . " AND " . "'" . $to_date . "'";
		if ($date != '' && $to_date != ''  ) $this->db->where($condition);
		$array_where = array('status'=>'4','bird_status'=>'Sale');
		$this->db->where($array_where);
		$this->db->where('branch_id',$branch_id);
		//$this->db->where('status',1);
		$records = $this->db->get()->result();
		// print_r($this->db->last_query());die;
		$sale = $records[0]->sale;
	
		$this->db->select('count(*) as cured');
		$this->db->from('ckb_incubation');
		$condition = "created_on BETWEEN " . "'" . $date . "'" . " AND " . "'" . $to_date . "'";
		if ($date != '' && $to_date != ''  ) $this->db->where($condition);
		$array_where = array('status'=>'2','health_status'=>'Cured');
		$this->db->where($array_where);
		$this->db->where('branch_id',$branch_id);
		//$this->db->where('status',1);
		$records = $this->db->get()->result();
		$cured = $records[0]->cured;

		$this->db->select('count(*) as yolk_infection');
		$this->db->from('ckb_incubation');
		$condition = "created_on BETWEEN " . "'" . $date . "'" . " AND " . "'" . $to_date . "'";
		if ($date != '' && $to_date != ''  ) $this->db->where($condition);
		$array_where = array('status'=>'2','health_status'=>'Yolk sac infection');
		$this->db->where($array_where);
		$this->db->where('branch_id',$branch_id);
		//$this->db->where('status',1);
		$records = $this->db->get()->result();
		$yolk_infection = $records[0]->yolk_infection;

		$this->db->select('count(*) as obesity');
		$this->db->from('ckb_incubation');
		$condition = "created_on BETWEEN " . "'" . $date . "'" . " AND " . "'" . $to_date . "'";
		if ($date != '' && $to_date != ''  ) $this->db->where($condition);
		$array_where = array('status'=>'2','health_status'=>'Obesity');
		$this->db->where($array_where);
		$this->db->where('branch_id',$branch_id);
		//$this->db->where('status',1);
		$records = $this->db->get()->result();
		$obesity = $records[0]->obesity;

		$this->db->select('count(*) as ecoli');
		$this->db->from('ckb_incubation');
		$condition = "created_on BETWEEN " . "'" . $date . "'" . " AND " . "'" . $to_date . "'";
		if ($date != '' && $to_date != ''  ) $this->db->where($condition);
		$array_where = array('status'=>'2','health_status'=>'E.coli infection');
		$this->db->where($array_where);
		$this->db->where('branch_id',$branch_id);
		//$this->db->where('status',1);
		$records = $this->db->get()->result();
		$ecoli = $records[0]->ecoli;

		$this->db->select('count(*) as wry_neck');
		$this->db->from('ckb_incubation');
		$condition = "created_on BETWEEN " . "'" . $date . "'" . " AND " . "'" . $to_date . "'";
		if ($date != '' && $to_date != ''  ) $this->db->where($condition);
		$array_where = array('status'=>'2','health_status'=>'Wry neck');
		$this->db->where($array_where);
		$this->db->where('branch_id',$branch_id);
		//$this->db->where('status',1);
		$records = $this->db->get()->result();
		$wry_neck = $records[0]->wry_neck;

		$this->db->select('count(*) as asp_pnuem');
		$this->db->from('ckb_incubation');
		$condition = "created_on BETWEEN " . "'" . $date . "'" . " AND " . "'" . $to_date . "'";
		if ($date != '' && $to_date != ''  ) $this->db->where($condition);
		$array_where = array('status'=>'2','health_status'=>'Aspiration Pneumonia');
		$this->db->where($array_where);
		$this->db->where('branch_id',$branch_id);
		//$this->db->where('status',1);
		$records = $this->db->get()->result();
		$asp_pnuem = $records[0]->asp_pnuem;

		$this->db->select('count(*) as slow_digest');
		$this->db->from('ckb_incubation');
		$condition = "created_on BETWEEN " . "'" . $date . "'" . " AND " . "'" . $to_date . "'";
		if ($date != '' && $to_date != ''  ) $this->db->where($condition);
		$array_where = array('status'=>'2','health_status'=>'Slow digestion');
		$this->db->where($array_where);
		$this->db->where('branch_id',$branch_id);
		//$this->db->where('status',1);
		$records = $this->db->get()->result();
		$slow_digest = $records[0]->slow_digest;

		$this->db->select('count(*) as crop_burn');
		$this->db->from('ckb_incubation');
		$condition = "created_on BETWEEN " . "'" . $date . "'" . " AND " . "'" . $to_date . "'";
		if ($date != '' && $to_date != ''  ) $this->db->where($condition);
		$array_where = array('status'=>'2','health_status'=>'Crop burn');
		$this->db->where($array_where);
		$this->db->where('branch_id',$branch_id);
		//$this->db->where('status',1);
		$records = $this->db->get()->result();
		$crop_burn = $records[0]->crop_burn;

		$this->db->select('count(*) as crop_injury');
		$this->db->from('ckb_incubation');
		$condition = "created_on BETWEEN " . "'" . $date . "'" . " AND " . "'" . $to_date . "'";
		if ($date != '' && $to_date != ''  ) $this->db->where($condition);
		$array_where = array('status'=>'2','health_status'=>'Crop injury');
		$this->db->where($array_where);
		$this->db->where('branch_id',$branch_id);
		//$this->db->where('status',1);
		$records = $this->db->get()->result();
		$crop_injury = $records[0]->crop_injury;

		$this->db->select('count(*) as oes_injury');
		$this->db->from('ckb_incubation');
		$condition = "created_on BETWEEN " . "'" . $date . "'" . " AND " . "'" . $to_date . "'";
		if ($date != '' && $to_date != ''  ) $this->db->where($condition);
		$array_where = array('status'=>'2','health_status'=>'Oesophageal injury');
		$this->db->where($array_where);
		$this->db->where('branch_id',$branch_id);
		//$this->db->where('status',1);
		$records = $this->db->get()->result();
		$oes_injury = $records[0]->oes_injury;

		$this->db->select('count(*) as resp_distress');
		$this->db->from('ckb_incubation');
		$condition = "created_on BETWEEN " . "'" . $date . "'" . " AND " . "'" . $to_date . "'";
		if ($date != '' && $to_date != ''  ) $this->db->where($condition);
		$array_where = array('status'=>'2','health_status'=>'Respiratory distress');
		$this->db->where($array_where);
		$this->db->where('branch_id',$branch_id);
		//$this->db->where('status',1);
		$records = $this->db->get()->result();
		$resp_distress = $records[0]->resp_distress;


		$this->db->select('count(*) as dehydration');
		$this->db->from('ckb_incubation');
		$condition = "created_on BETWEEN " . "'" . $date . "'" . " AND " . "'" . $to_date . "'";
		if ($date != '' && $to_date != ''  ) $this->db->where($condition);
		$array_where = array('status'=>'2','health_status'=>'Dehydration');
		$this->db->where($array_where);
		$this->db->where('branch_id',$branch_id);
		//$this->db->where('status',1);
		$records = $this->db->get()->result();
		$dehydration = $records[0]->dehydration;

		$this->db->select('count(*) as unabsorbed_yolk_sac');
		$this->db->from('ckb_incubation');
		$condition = "created_on BETWEEN " . "'" . $date . "'" . " AND " . "'" . $to_date . "'";
		if ($date != '' && $to_date != ''  ) $this->db->where($condition);
		$array_where = array('status'=>'2','health_status'=>'Unabsorbed yolk sac');
		$this->db->where($array_where);
		$this->db->where('branch_id',$branch_id);
		//$this->db->where('status',1);
		$records = $this->db->get()->result();
		$unabsorbed_yolk_sac = $records[0]->unabsorbed_yolk_sac;

		$this->db->select('count(*) as air_crop');
		$this->db->from('ckb_incubation');
		$condition = "created_on BETWEEN " . "'" . $date . "'" . " AND " . "'" . $to_date . "'";
		if ($date != '' && $to_date != ''  ) $this->db->where($condition);
		$array_where = array('status'=>'2','health_status'=>'Air in the crop');
		$this->db->where($array_where);
		$this->db->where('branch_id',$branch_id);
		//$this->db->where('status',1);
		$records = $this->db->get()->result();
		$air_crop = $records[0]->air_crop;
		
		$this->db->select('count(*) as traumatic_injury');
		$this->db->from('ckb_incubation');
		$condition = "created_on BETWEEN " . "'" . $date . "'" . " AND " . "'" . $to_date . "'";
		if ($date != '' && $to_date != ''  ) $this->db->where($condition);
		$array_where = array('status'=>'2','health_status'=>'Traumatic injury');
		$this->db->where($array_where);
		$this->db->where('branch_id',$branch_id);
		//$this->db->where('status',1);
		$records = $this->db->get()->result();
		$traumatic_injury = $records[0]->traumatic_injury;

		$this->db->select('count(*) as stunted_chick');
		$this->db->from('ckb_incubation');
		$condition = "created_on BETWEEN " . "'" . $date . "'" . " AND " . "'" . $to_date . "'";
		if ($date != '' && $to_date != ''  ) $this->db->where($condition);
		$array_where = array('status'=>'2','health_status'=>'Stunted chick');
		$this->db->where($array_where);
		$this->db->where('branch_id',$branch_id);
		//$this->db->where('status',1);
		$records = $this->db->get()->result();
		$stunted_chick = $records[0]->stunted_chick;

		$this->db->select('count(*) as reduced_crop_size');
		$this->db->from('ckb_incubation');
		$condition = "created_on BETWEEN " . "'" . $date . "'" . " AND " . "'" . $to_date . "'";
		if ($date != '' && $to_date != ''  ) $this->db->where($condition);
		$array_where = array('status'=>'2','health_status'=>'Reduced crop size');
		$this->db->where($array_where);
		$this->db->where('branch_id',$branch_id);
		//$this->db->where('status',1);
		$records = $this->db->get()->result();
		$reduced_crop_size = $records[0]->reduced_crop_size;

		$this->db->select('count(*) as splayed_leg');
		$this->db->from('ckb_incubation');
		$condition = "created_on BETWEEN " . "'" . $date . "'" . " AND " . "'" . $to_date . "'";
		if ($date != '' && $to_date != ''  ) $this->db->where($condition);
		$array_where = array('status'=>'2','health_status'=>'Splayed leg');
		$this->db->where($array_where);
		$this->db->where('branch_id',$branch_id);
		//$this->db->where('status',1);
		$records = $this->db->get()->result();
		$splayed_leg = $records[0]->splayed_leg;
		
		$this->db->select('count(*) as fungal_infection');
		$this->db->from('ckb_incubation');
		$condition = "created_on BETWEEN " . "'" . $date . "'" . " AND " . "'" . $to_date . "'";
		if ($date != '' && $to_date != ''  ) $this->db->where($condition);
		$array_where = array('status'=>'2','health_status'=>'Fungal infection');
		$this->db->where($array_where);
		$this->db->where('branch_id',$branch_id);
		//$this->db->where('status',1);
		$records = $this->db->get()->result();
		$fungal_infection = $records[0]->fungal_infection;
		
		
			$data[] = array(
				"total_chicks" => $total_chicks,
				"total_weaning" => $total_weaning,
				"splay_leg" => $splay_leg,
				"airbubble" => $airbubble,
				"mortality" => $mortality,
				"sale" => $sale,
				"cured" => $cured,
				"yolk_infection" => $yolk_infection,
				"obesity" => $obesity,
				"ecoli" => $ecoli,
				"wry_neck" => $wry_neck,
				"asp_pnuem" => $asp_pnuem,
				"slow_digest" => $slow_digest,
				"crop_burn" => $crop_burn,
				"crop_injury" => $crop_injury,
				"oes_injury" => $oes_injury,
				"resp_distress" => $resp_distress,
				"dehydration" => $dehydration,
				"unabsorbed_yolk_sac" => $unabsorbed_yolk_sac,
				"air_crop" => $air_crop,
				"traumatic_injury"=>$traumatic_injury,
				"stunted_chick"=>$stunted_chick,
				"reduced_crop_size"=>$reduced_crop_size,
				"splayed_leg"=>$splayed_leg,
				"fungal_infection"=>$fungal_infection,

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
		$this->db->where('i.status',2);
		$this->db->where('i.branch_id',$branch_id);
		$condition = "i.created_on BETWEEN " . "'" . $date . "'" . " AND " . "'" . $to_date . "'";
		if ($date != '' && $to_date != ''  ) $this->db->where($condition);		$records = $this->db->get()->result();
		return $records;

	}
	public function get_stunded_after_birth($date,$to_date){
		$branch_id = $this->session->userdata('branch_id');
		$this->db->select('p.*');
		$this->db->from('ckb_incubation as i');
		$this->db->join('ckb_preweaning as p','i.auto_id = p.incub_id');
		$this->db->where('i.status',2);
		$this->db->where('i.branch_id',$branch_id);
		$condition = "i.created_on BETWEEN " . "'" . $date . "'" . " AND " . "'" . $to_date . "'";
		if ($date != '' && $to_date != ''  ) $this->db->where($condition);
		$records = $this->db->get()->result();
		return $records;

	}
	public function get_preweaning_historyView_dt($array_where,$date,$to_date,$status){
		
		$this->db->select('i.*,g.group_name as group_name,s.bird_species as bird_species,a.aviary_name as aviary_name');
		$this->db->from('ckb_incubation i');
		$this->db->join('ckb_group as g', 'i.group_id = g.auto_id');
		$this->db->join('ckb_species as s', 'i.species_id = s.auto_id');
		$this->db->join('ckb_aviary as a', 'i.aviary_id = a.auto_id');
		if ($array_where != '') $this->db->where($array_where);
		$condition = "i.created_on BETWEEN " . "'" . $date . "'" . " AND " . "'" . $to_date . "'";
		if ($date != '' && $to_date != ''  ) $this->db->where($condition);
		$this->db->where('i.status',$status);
		$records = $this->db->get()->result();
		// print_r($this->db->last_query());die;
		return $records;

	}
	
	public function verify_data_preweaning_dt($postData)
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
		$this->db->join('ckb_group as g', 'i.group_id = g.auto_id');
		$this->db->join('ckb_species as s', 'i.species_id = s.auto_id');
		$this->db->join('ckb_aviary as a', 'i.aviary_id = a.auto_id');
	//	$this->db->join('ckb_brooder as b', 'i.brooder = b.auto_id');
		$this->db->join('ckb_move_brooder as m', 'i.auto_id = m.incub_id');
		$this->db->where('i.status = 2');
		//$this->db->where_not_in('i.health_status','Mortality');
		$wh_arry = array('Production','Sale','Mortality');
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
		$this->db->join('ckb_group as g', 'i.group_id = g.auto_id');
		$this->db->join('ckb_species as s', 'i.species_id = s.auto_id');
		$this->db->join('ckb_aviary as a', 'i.aviary_id = a.auto_id');
		//$this->db->join('ckb_brooder as b', 'i.brooder = b.auto_id');
		$this->db->join('ckb_move_brooder as m', 'i.auto_id = m.incub_id');
		$this->db->where('i.status = 2');
		//$this->db->where_not_in('i.health_status','Mortality');
		$wh_arry = array('Production','Sale','Mortality');
		$this->db->where_not_in('i.bird_status',$wh_arry);
		$this->db->where('i.branch_id',$branch_id);
		//$this->db->join('ckb_brooder as c', 'm.move_35_brooder = b.auto_id');
		if ($searchQuery != '') $this->db->where($searchQuery);

		//   $this->db->where($postData_where);
		//test

		$records = $this->db->get()->result();

		$totalRecordwithFilter = $records[0]->allcount;

        //# Fetch records
		$this->db->select(
			'i.*,s.std_hatch_weight as std_hatch_weight,g.group_name as group_name,s.bird_species as bird_species,s.days_brooder as days_brooder,a.aviary_name as aviary_name,u.user_name as user_name'
		);
		$this->db->from('ckb_incubation i');
		$this->db->join('ckb_group as g', 'i.group_id = g.auto_id');
		$this->db->join('ckb_species as s', 'i.species_id = s.auto_id');
		$this->db->join('ckb_aviary as a', 'i.aviary_id = a.auto_id');
		$this->db->join('ckb_users as u', 'i.created_by = u.user_id');
		//$this->db->join('ckb_brooder as b', 'i.brooder = b.auto_id');
		//$this->db->join('ckb_move_brooder as m', 'i.auto_id = m.incub_id');
		//$this->db->join('ckb_brooder as b', 'm.move_handfeed_brooder = b.auto_id');
		$this->db->where('i.status = 2');
		//$this->db->where_not_in('i.health_status','Mortality');
		$wh_arry = array('Production','Sale','Mortality');
		$this->db->where_not_in('i.bird_status',$wh_arry);
		$this->db->where('i.branch_id',$branch_id);
		//$this->db->join('ckb_brooder as c', 'm.move_35_brooder = b.auto_id');

		if ($searchQuery != '') $this->db->where($searchQuery);

		//   $this->db->where($postData_where);
		$this->db->order_by('i.id', 'desc');  // or desc
		

		$this->db->limit($rowperpage, $start);

		$records = $this->db->get()->result();

		$data = array();

		foreach ($records as $record) {
		//	if($record->status == '2'){   // check the status and return the data
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
				
			$action_url1 = base_url()."index.php/Preweaning/view_preweaning_details/".$record->auto_id;

      		$action_url2 = base_url()."index.php/Preweaning/preweaning_details/".$record->auto_id;

			  $action_url3 = base_url()."index.php/Incubation/move_incubation/".$record->auto_id;

//$action = "";
$action = '<button  onclick="get_move_Weaning('."'".$record->auto_id."'".');" class="btn btn-success btn-xs waves-effect waves-light tooltips"  data-placement="top" data-toggle="tooltip" id="move" title="Move to Weaning"><i class="fa fa-exchange" aria-hidden="true"></i></button>';
if($record->bird_status == "Sale"){
	$action .= '<button  onclick="get_move_sale('."'".$record->auto_id."'".');" class="btn btn-purple btn-xs waves-effect   waves-light tooltips" data-placement="top" data-toggle="tooltip" id="move" title="Move to sale" disabled><i class="fa fa-exchange"></i></button>';
	}
	else{
		$action .= '<button  onclick="get_move_sale('."'".$record->auto_id."'".');" class="btn btn-purple btn-xs waves-effect   waves-light tooltips" data-placement="top" data-toggle="tooltip" id="move" title="Move to sale"><i class="fa fa-exchange"></i></button>';
	
	}
	$action .="</br>";
$action .= '<a href="'.$action_url2.'" target="_blank"><button class="btn btn-primary btn-xs waves-effect waves-light tooltips" style="margin-top:5px;" data-placement="top" data-toggle="tooltip" id="Weightlossbtn" title="Update Pre weaning Details"><i class="fa fa-eject" aria-hidden="true"></i></button></a>  '; 


$view = '<a href="'.$action_url1.'" class="btn btn-pink btn-xs waves-effect waves-light tooltips" style="margin-left:50px;margin-top:5px;" data-trigger="hover" data-placement="top" data-toggle="tooltip" title="View Preweaning History"><i class="fa fa-eye" aria-hidden="true"></i></a>';
$action .= '<button  onclick="change_healthStatus('."'".$record->auto_id."'".');" class="btn btn-danger btn-xs waves-effect waves-light tooltips" data-placement="top" data-toggle="tooltip" id="" title="change health status"><i class="fa fa-exchange" aria-hidden="true"></i></button>';		
$action .= '<button  onclick="revert_to_handfeed('."'".$record->egg_no."'".');" class="btn btn-warning btn-xs waves-effect waves-light tooltips" data-placement="top" data-toggle="tooltip" id="" title="Revert"><i class="fa fa-undo" aria-hidden="true"></i></button>';		

$health_status = '<button  onclick="change_healthStatus('."'".$record->auto_id."'".');" class="btn btn-success btn-xs waves-effect waves-light tooltips" data-placement="top" data-toggle="tooltip" id="" title="change health status"><i class="fa fa-exchange" aria-hidden="true"></i></button>';		

if($record->hatch_weight < $record->std_hatch_weight){
	$health_status .="Stunded By Birth,<br>";
}
$query = $this->db->get_where('ckb_preweaning', array('incub_id' => $record->auto_id ));
$count = $query->num_rows();
if($count >0){
	$this->db->select('std_weight,act_weight');
	$this->db->from('ckb_preweaning');
	$this->db->where('incub_id',$record->auto_id );
	$prewean_details = $this->db->get()->result();
	foreach($prewean_details as $result){
		$std_weight = $result->std_weight;
		$twenty_percent = ($std_weight/20)*100;
		$act_weight = $result->act_weight;
	}
	if($act_weight < $twenty_percent){
		$health_status .="Stunted after birth<br>";
	}

}
else if($count <=0){
	$health_status .="";
	$twenty_percent="";
}
$health_status .=$record->health_status;		
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
				"moved_pweaning_date" => $record->moved_pweaning_date,
				"action" => $action,
				"view" => $view,
				"health_status" => $health_status

			
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





	public function get_prewean_data_byone($postData,$postData1){  // get preweaning history
		$branch_id = $this->session->userdata('branch_id');

		$response = array();

		//$show = $postData['status'];
		$draw = $postData['draw'];
		$start = $postData['start'];
		$rowperpage = $postData['length']; // Rows display per page
		$columnIndex = $postData['order'][0]['column']; // Column index
		$columnName = $postData['columns'][$columnIndex]['data']; // Column name
		$columnSortOrder = $postData['order'][0]['dir']; // asc or desc
		$searchValue = $postData['search']['value']; // Search value
        $prewean_id = $postData1; //get id
		//# Search
		$search_arr = array();
		$searchQuery = "";

		if ($searchValue != '') {
			$search_arr[] = "( species_id like '%" . $searchValue . "%' or 
            brooder_name like '%" . $searchValue . "%' or 
            egg_no like '%" . $searchValue . "%') ";
		}

		if (count($search_arr) > 0) {
			$searchQuery = implode(" and ", $search_arr);
		}

        //# Total number of records without filtering
		$this->db->select('count(*) as allcount');
		$this->db->from('ckb_preweaning i');
		$this->db->where('incub_id',$prewean_id);
		$this->db->where('branch_id',$branch_id);
		//$this->db->join('ckb_group as g', 'i.group_id = g.auto_id');
		//$this->db->join('ckb_species as s', 'i.species_id = s.auto_id');
		//$this->db->join('ckb_aviary as a', 'i.aviary_id = a.auto_id');
		if ($searchQuery != '') $this->db->where($searchQuery);

        // $this->db->where($handfeed_id);

		$records = $this->db->get()->result();

		$totalRecords = $records[0]->allcount;

		
        //# Total number of record with filtering
		$this->db->select('count(*) as allcount');
		$this->db->from('ckb_preweaning i');
		$this->db->where('incub_id',$prewean_id);
		$this->db->where('branch_id',$branch_id);
		//$this->db->where('i.status = 2');
	//	$this->db->join('ckb_group as g', 'i.group_id = g.auto_id');
		//$this->db->join('ckb_species as s', 'i.species_id = s.auto_id');
		//$this->db->join('ckb_aviary as a', 'i.aviary_id = a.auto_id');

		if ($searchQuery != '') $this->db->where($searchQuery);

		  //$this->db->where($handfeed_id);

		$records = $this->db->get()->result();
		//$query = $this->db->get('employee_master');
		$totalRecordwithFilter = $records[0]->allcount;

        //# Fetch records
		$this->db->select('*');
		$this->db->from('ckb_preweaning');
		$this->db->where('incub_id',$prewean_id);
		$this->db->where('branch_id',$branch_id);
		//$this->db->where('i.status = 2');
		//$this->db->join('ckb_group as g', 'i.group_id = g.auto_id');
		//$this->db->join('ckb_species as s', 'i.species_id = s.auto_id');
	//	$this->db->join('ckb_aviary as a', 'i.aviary_id = a.auto_id');
	//	$this->db->join('ckb_users as u', 'i.created_by = u.user_id');

		if ($searchQuery != '') $this->db->where($searchQuery);

		
		$this->db->order_by('id', 'desc');  // or desc

		$this->db->limit($rowperpage, $start);

		$records = $this->db->get()->result();

		$data = array();

		foreach ($records as $record) {
			$timedate1 = strtotime(date("Y-m-d", strtotime($record->created_on)));
			$created_on = date("d-m-Y", $timedate1);
	//if($prewean_id == $record->incub_id ){
		$action = '  <button  onclick="feed_history_pop('."'".$record->incub_id."'".','."'".$created_on."'".');" class="btn btn-primary btn-xs waves-effect waves-light tooltips" data-placement="top" data-toggle="tooltip" id="birdDeletebtn" data-original-title="Delete"><i class="fa fa-eye"></i></button>';
			$data[] = array(
				"id" => $record->id,
				"incub_id" => $record->incub_id,
				"species_id" => $record->species_id,
				"age" => $record->age,
			//	"brooder_name" => $record->brooder_name,
				"egg_no" => $record->egg_no,
				"std_weight" => $record->std_weight,
				"act_weight" => $record->act_weight,
				"hatch_weight" => $record->hatch_weight,
				"status" => $record->status,
				"weight_gain" => $record->weight_gain,
				"target_vfeed" => $record->target_vfeed,
				"target_feed" => $record->target_feed,
				"actn_feed" => $record->actn_feed,
				"ratio" => $record->ratio,
				"volume" => $record->volume,
				"targetv_day" => $record->targetv_day,
				"targetg_day" => $record->targetg_day,
				"actualv_day" => $record->actualv_day,
				"actualf_day" => $record->actualf_day,
				"achieved" => $record->achieved,
				"mail_status" => $record->mail_status,
				"created_on" =>$created_on,	
				"action" =>$action,	
			
			

			);
		//}//end if
		
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

}//end class

