<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Handfeed_model extends CI_Model{

    public function verify_data_wl($data_where) {
        
        $this->db->select('ci.*,cg.group_name,cs.bird_species,cs.days_brooder,cs.target_feed,ca.aviary_name');
        $this->db->from('ckb_incubation ci');
        $this->db->join('ckb_group cg', 'cg.auto_id = ci.group_id', 'left'); 
        $this->db->join('ckb_species cs', 'cs.auto_id = ci.species_id', 'left'); 
        $this->db->join('ckb_aviary ca', 'ca.auto_id = ci.aviary_id', 'left'); 
		$this->db->where($data_where); 

        $query = $this->db->get();
        return $query->result();
    }

	public function get_handfeeding_history_dt($date,$to_date){
		$branch_id = $this->session->userdata('branch_id');
		$this->db->select('count(*) as total_chicks');
		$this->db->from('ckb_incubation');
		$condition = "created_on BETWEEN " . "'" . $date . "'" . " AND " . "'" . $to_date . "'";
		if ($date != '' && $to_date != ''  ) $this->db->where($condition);
		$this->db->where('status',0);
		$this->db->where('branch_id',$branch_id);
		$records = $this->db->get()->result();
		$total_chicks = $records[0]->total_chicks;
		
	
		$this->db->select('count(*) as total_preweaning');
		$this->db->from('ckb_incubation');
		$condition = "created_on BETWEEN " . "'" . $date . "'" . " AND " . "'" . $to_date . "'";
		if ($date != '' && $to_date != ''  ) $this->db->where($condition);
		//$array_where = array('fertile_type'=>'Fertile','hatch_type'=>'Assist');
		//$this->db->where($array_where);
		$this->db->where('status',2);
		$this->db->where('branch_id',$branch_id);
		$records = $this->db->get()->result();
		$total_preweaning = $records[0]->total_preweaning;

		$this->db->select('count(*) as splay_leg');
		$this->db->from('ckb_incubation');
		$condition = "created_on BETWEEN " . "'" . $date . "'" . " AND " . "'" . $to_date . "'";
		if ($date != '' && $to_date != ''  ) $this->db->where($condition);
		$array_where = array('status'=>'0','health_status'=>'Splay Leg');
		$this->db->where($array_where);
		$this->db->where('branch_id',$branch_id);
		//$this->db->where('status',1);
		$records = $this->db->get()->result();
		$splay_leg = $records[0]->splay_leg;

		$this->db->select('count(*) as airbubble');
		$this->db->from('ckb_incubation');
		$condition = "created_on BETWEEN " . "'" . $date . "'" . " AND " . "'" . $to_date . "'";
		if ($date != '' && $to_date != ''  ) $this->db->where($condition);
		$array_where = array('status'=>'0','health_status'=>'Airbubble');
		$this->db->where($array_where);
		$this->db->where('branch_id',$branch_id);
		//$this->db->where('status',1);
		$records = $this->db->get()->result();
		$airbubble = $records[0]->airbubble;

		$this->db->select('count(*) as mortality');
		$this->db->from('ckb_incubation');
		$condition = "created_on BETWEEN " . "'" . $date . "'" . " AND " . "'" . $to_date . "'";
		if ($date != '' && $to_date != ''  ) $this->db->where($condition);
		$array_where = array('status'=>'0','health_status'=>'Mortality');
		$this->db->where($array_where);
		$this->db->where('branch_id',$branch_id);
		//$this->db->where('status',1);
		$records = $this->db->get()->result();
		$mortality = $records[0]->mortality;

		$this->db->select('count(*) as sale');
		$this->db->from('ckb_incubation');
		$condition = "created_on BETWEEN " . "'" . $date . "'" . " AND " . "'" . $to_date . "'";
		if ($date != '' && $to_date != ''  ) $this->db->where($condition);
		$array_where = array('status'=>'0','bird_status'=>'Sale');
		$this->db->where($array_where);
		$this->db->where('branch_id',$branch_id);
		//$this->db->where('status',1);
		$records = $this->db->get()->result();
		$sale = $records[0]->sale;

		$this->db->select('count(*) as cured');
		$this->db->from('ckb_incubation');
		$condition = "created_on BETWEEN " . "'" . $date . "'" . " AND " . "'" . $to_date . "'";
		if ($date != '' && $to_date != ''  ) $this->db->where($condition);
		$array_where = array('status'=>'0','health_status'=>'Cured');
		$this->db->where($array_where);
		$this->db->where('branch_id',$branch_id);
		//$this->db->where('status',1);
		$records = $this->db->get()->result();
		$cured = $records[0]->cured;

		$this->db->select('count(*) as yolk_infection');
		$this->db->from('ckb_incubation');
		$condition = "created_on BETWEEN " . "'" . $date . "'" . " AND " . "'" . $to_date . "'";
		if ($date != '' && $to_date != ''  ) $this->db->where($condition);
		$array_where = array('status'=>'0','health_status'=>'Yolk sac infection');
		$this->db->where($array_where);
		$this->db->where('branch_id',$branch_id);
		//$this->db->where('status',1);
		$records = $this->db->get()->result();
		$yolk_infection = $records[0]->yolk_infection;

		$this->db->select('count(*) as obesity');
		$this->db->from('ckb_incubation');
		$condition = "created_on BETWEEN " . "'" . $date . "'" . " AND " . "'" . $to_date . "'";
		if ($date != '' && $to_date != ''  ) $this->db->where($condition);
		$array_where = array('status'=>'0','health_status'=>'Obesity');
		$this->db->where($array_where);
		$this->db->where('branch_id',$branch_id);
		//$this->db->where('status',1);
		$records = $this->db->get()->result();
		$obesity = $records[0]->obesity;

		$this->db->select('count(*) as ecoli');
		$this->db->from('ckb_incubation');
		$condition = "created_on BETWEEN " . "'" . $date . "'" . " AND " . "'" . $to_date . "'";
		if ($date != '' && $to_date != ''  ) $this->db->where($condition);
		$array_where = array('status'=>'0','health_status'=>'E.coli infection');
		$this->db->where($array_where);
		$this->db->where('branch_id',$branch_id);
		//$this->db->where('status',1);
		$records = $this->db->get()->result();
		$ecoli = $records[0]->ecoli;

		$this->db->select('count(*) as wry_neck');
		$this->db->from('ckb_incubation');
		$condition = "created_on BETWEEN " . "'" . $date . "'" . " AND " . "'" . $to_date . "'";
		if ($date != '' && $to_date != ''  ) $this->db->where($condition);
		$array_where = array('status'=>'0','health_status'=>'Wry neck');
		$this->db->where($array_where);
		$this->db->where('branch_id',$branch_id);
		//$this->db->where('status',1);
		$records = $this->db->get()->result();
		$wry_neck = $records[0]->wry_neck;

		$this->db->select('count(*) as asp_pnuem');
		$this->db->from('ckb_incubation');
		$condition = "created_on BETWEEN " . "'" . $date . "'" . " AND " . "'" . $to_date . "'";
		if ($date != '' && $to_date != ''  ) $this->db->where($condition);
		$array_where = array('status'=>'0','health_status'=>'Aspiration Pneumonia');
		$this->db->where($array_where);
		$this->db->where('branch_id',$branch_id);
		//$this->db->where('status',1);
		$records = $this->db->get()->result();
		$asp_pnuem = $records[0]->asp_pnuem;

		$this->db->select('count(*) as slow_digest');
		$this->db->from('ckb_incubation');
		$condition = "created_on BETWEEN " . "'" . $date . "'" . " AND " . "'" . $to_date . "'";
		if ($date != '' && $to_date != ''  ) $this->db->where($condition);
		$array_where = array('status'=>'0','health_status'=>'Slow digestion');
		$this->db->where($array_where);
		$this->db->where('branch_id',$branch_id);
		//$this->db->where('status',1);
		$records = $this->db->get()->result();
		$slow_digest = $records[0]->slow_digest;

		$this->db->select('count(*) as crop_burn');
		$this->db->from('ckb_incubation');
		$condition = "created_on BETWEEN " . "'" . $date . "'" . " AND " . "'" . $to_date . "'";
		if ($date != '' && $to_date != ''  ) $this->db->where($condition);
		$array_where = array('status'=>'0','health_status'=>'Crop burn');
		$this->db->where($array_where);
		$this->db->where('branch_id',$branch_id);
		//$this->db->where('status',1);
		$records = $this->db->get()->result();
		$crop_burn = $records[0]->crop_burn;

		$this->db->select('count(*) as crop_injury');
		$this->db->from('ckb_incubation');
		$condition = "created_on BETWEEN " . "'" . $date . "'" . " AND " . "'" . $to_date . "'";
		if ($date != '' && $to_date != ''  ) $this->db->where($condition);
		$array_where = array('status'=>'0','health_status'=>'Crop injury');
		$this->db->where($array_where);
		$this->db->where('branch_id',$branch_id);
		//$this->db->where('status',1);
		$records = $this->db->get()->result();
		$crop_injury = $records[0]->crop_injury;

		$this->db->select('count(*) as oes_injury');
		$this->db->from('ckb_incubation');
		$condition = "created_on BETWEEN " . "'" . $date . "'" . " AND " . "'" . $to_date . "'";
		if ($date != '' && $to_date != ''  ) $this->db->where($condition);
		$array_where = array('status'=>'0','health_status'=>'Oesophageal injury');
		$this->db->where($array_where);
		$this->db->where('branch_id',$branch_id);
		//$this->db->where('status',1);
		$records = $this->db->get()->result();
		$oes_injury = $records[0]->oes_injury;

		$this->db->select('count(*) as resp_distress');
		$this->db->from('ckb_incubation');
		$condition = "created_on BETWEEN " . "'" . $date . "'" . " AND " . "'" . $to_date . "'";
		if ($date != '' && $to_date != ''  ) $this->db->where($condition);
		$array_where = array('status'=>'0','health_status'=>'Respiratory distress');
		$this->db->where($array_where);
		$this->db->where('branch_id',$branch_id);
		//$this->db->where('status',1);
		$records = $this->db->get()->result();
		$resp_distress = $records[0]->resp_distress;


		$this->db->select('count(*) as dehydration');
		$this->db->from('ckb_incubation');
		$condition = "created_on BETWEEN " . "'" . $date . "'" . " AND " . "'" . $to_date . "'";
		if ($date != '' && $to_date != ''  ) $this->db->where($condition);
		$array_where = array('status'=>'0','health_status'=>'Dehydration');
		$this->db->where($array_where);
		$this->db->where('branch_id',$branch_id);
		//$this->db->where('status',1);
		$records = $this->db->get()->result();
		$dehydration = $records[0]->dehydration;

		$this->db->select('count(*) as unabsorbed_yolk_sac');
		$this->db->from('ckb_incubation');
		$condition = "created_on BETWEEN " . "'" . $date . "'" . " AND " . "'" . $to_date . "'";
		if ($date != '' && $to_date != ''  ) $this->db->where($condition);
		$array_where = array('status'=>'0','health_status'=>'Unabsorbed yolk sac');
		$this->db->where($array_where);
		$this->db->where('branch_id',$branch_id);
		//$this->db->where('status',1);
		$records = $this->db->get()->result();
		$unabsorbed_yolk_sac = $records[0]->unabsorbed_yolk_sac;

		$this->db->select('count(*) as air_crop');
		$this->db->from('ckb_incubation');
		$condition = "created_on BETWEEN " . "'" . $date . "'" . " AND " . "'" . $to_date . "'";
		if ($date != '' && $to_date != ''  ) $this->db->where($condition);
		$array_where = array('status'=>'0','health_status'=>'Air in the crop');
		$this->db->where($array_where);
		$this->db->where('branch_id',$branch_id);
		//$this->db->where('status',1);
		$records = $this->db->get()->result();
		$air_crop = $records[0]->air_crop;
		
		$this->db->select('count(*) as traumatic_injury');
		$this->db->from('ckb_incubation');
		$condition = "created_on BETWEEN " . "'" . $date . "'" . " AND " . "'" . $to_date . "'";
		if ($date != '' && $to_date != ''  ) $this->db->where($condition);
		$array_where = array('status'=>'0','health_status'=>'Traumatic injury');
		$this->db->where($array_where);
		$this->db->where('branch_id',$branch_id);
		//$this->db->where('status',1);
		$records = $this->db->get()->result();
		$traumatic_injury = $records[0]->traumatic_injury;

		$this->db->select('count(*) as stunted_chick');
		$this->db->from('ckb_incubation');
		$condition = "created_on BETWEEN " . "'" . $date . "'" . " AND " . "'" . $to_date . "'";
		if ($date != '' && $to_date != ''  ) $this->db->where($condition);
		$array_where = array('status'=>'0','health_status'=>'Stunted chick');
		$this->db->where($array_where);
		$this->db->where('branch_id',$branch_id);
		//$this->db->where('status',1);
		$records = $this->db->get()->result();
		$stunted_chick = $records[0]->stunted_chick;

		$this->db->select('count(*) as reduced_crop_size');
		$this->db->from('ckb_incubation');
		$condition = "created_on BETWEEN " . "'" . $date . "'" . " AND " . "'" . $to_date . "'";
		if ($date != '' && $to_date != ''  ) $this->db->where($condition);
		$array_where = array('status'=>'0','health_status'=>'Reduced crop size');
		$this->db->where($array_where);
		$this->db->where('branch_id',$branch_id);
		//$this->db->where('status',1);
		$records = $this->db->get()->result();
		$reduced_crop_size = $records[0]->reduced_crop_size;

		$this->db->select('count(*) as splayed_leg');
		$this->db->from('ckb_incubation');
		$condition = "created_on BETWEEN " . "'" . $date . "'" . " AND " . "'" . $to_date . "'";
		if ($date != '' && $to_date != ''  ) $this->db->where($condition);
		$array_where = array('status'=>'0','health_status'=>'Splayed leg');
		$this->db->where($array_where);
		$this->db->where('branch_id',$branch_id);
		//$this->db->where('status',1);
		$records = $this->db->get()->result();
		$splayed_leg = $records[0]->splayed_leg;
		
		$this->db->select('count(*) as fungal_infection');
		$this->db->from('ckb_incubation');
		$condition = "created_on BETWEEN " . "'" . $date . "'" . " AND " . "'" . $to_date . "'";
		if ($date != '' && $to_date != ''  ) $this->db->where($condition);
		$array_where = array('status'=>'0','health_status'=>'Fungal infection');
		$this->db->where($array_where);
		$this->db->where('branch_id',$branch_id);
		//$this->db->where('status',1);
		$records = $this->db->get()->result();
		$fungal_infection = $records[0]->fungal_infection;


		

			$data[] = array(
				"total_chicks" => $total_chicks,
				"total_preweaning" => $total_preweaning,
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
		$this->db->where('i.status',0);
		$this->db->where('i.branch_id',$branch_id);
		$condition = "i.created_on BETWEEN " . "'" . $date . "'" . " AND " . "'" . $to_date . "'";
		if ($date != '' && $to_date != ''  ) $this->db->where($condition);
		$records = $this->db->get()->result();
		return $records;

	}
	public function get_stunded_after_birth($date,$to_date){
		$branch_id = $this->session->userdata('branch_id');
		$this->db->select('h.*');
		$this->db->from('ckb_incubation as i');
		$this->db->join('ckb_handfee as h','i.auto_id = h.incub_id');
		$this->db->where('i.status',0);
		$this->db->where('i.branch_id',$branch_id);
		$condition = "i.created_on BETWEEN " . "'" . $date . "'" . " AND " . "'" . $to_date . "'";
		if ($date != '' && $to_date != ''  ) $this->db->where($condition);
		$records = $this->db->get()->result();
		return $records;

	}
	public function get_handfeeding_historyView_dt($array_where,$date,$to_date,$status){
		$branch_id = $this->session->userdata('branch_id');
		$this->db->select(
			'i.*,g.group_name as group_name,s.bird_species as bird_species,a.aviary_name as aviary_name'
		);
		$this->db->from('ckb_incubation i');
		$this->db->join('ckb_group as g', 'i.group_id = g.auto_id');
		$this->db->join('ckb_species as s', 'i.species_id = s.auto_id');
		$this->db->join('ckb_aviary as a', 'i.aviary_id = a.auto_id');
		if ($array_where != '') $this->db->where($array_where);
		$condition = "i.created_on BETWEEN " . "'" . $date . "'" . " AND " . "'" . $to_date . "'";
		if ($date != '' && $to_date != ''  ) $this->db->where($condition);
		$this->db->where('i.status',$status);
		$this->db->where('i.branch_id',$branch_id);
		$records = $this->db->get()->result();
		return $records;

	}
        
	public function verify_data_handfeed_history($postData,$postData1){
		$response = array();

		//$show = $postData['status'];
		$draw = $postData['draw'];
		$start = $postData['start'];
		$rowperpage = $postData['length']; // Rows display per page
		$columnIndex = $postData['order'][0]['column']; // Column index
		$columnName = $postData['columns'][$columnIndex]['data']; // Column name
		$columnSortOrder = $postData['order'][0]['dir']; // asc or desc
		$searchValue = $postData['search']['value']; // Search value
        $handfeed_id = $postData1; //get id
		$branch_id = $this->session->userdata('branch_id');
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
		$this->db->from('ckb_handfee');
		$this->db->where('incub_id',$handfeed_id);
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
		$this->db->from('ckb_handfee');
		$this->db->where('incub_id',$handfeed_id);
		$this->db->where('branch_id',$branch_id);
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
		$this->db->from('ckb_handfee');
		$this->db->where('incub_id',$handfeed_id);
		$this->db->where('branch_id',$branch_id);
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
	//if($handfeed_id == $record->incub_id ){
		$action = '  <button  onclick="feed_history_pop('."'".$record->incub_id."'".','."'".$created_on."'".');" class="btn btn-primary btn-xs waves-effect waves-light tooltips" data-placement="top" data-toggle="tooltip" id="birdDeletebtn" data-original-title="Delete"><i class="fa fa-eye"></i></button>';
			$data[] = array(
				"id" => $record->id,
				"incub_id" => $record->incub_id,
				"species_id" => $record->species_id,
				"age" => $record->age,
				"brooder_name" => $record->brooder_name,
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


	
}// end class

?>
