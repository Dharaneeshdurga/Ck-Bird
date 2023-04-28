<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Breeding_model extends CI_Model
{

	public function get_proven_history_dt($date,$to_date){
		$branch_id = $this->session->userdata('branch_id');
		$this->db->select('Month(created_on) as month,Year(created_on) as year,sum(total_eggs) as total_eggs,
		round(sum(eggs_broken)/count(*),2) as broken_percent,
		round(sum(eggs_if)/count(*),2) as infertile_percent,
		round(sum(eggs_dis)/count(*),2) as dis_percent,
		round(sum(egg_hatch)/count(*),2) as hatch_percent');
		$this->db->from('ckb_breeding_proven');
		//if ($date != '' && $to_date == '' ) $this->db->where('created_on', $date);
		$condition = "created_on BETWEEN " . "'" . $date . "'" . " AND " . "'" . $to_date . "'";
		if ($date != '' && $to_date != ''  ) $this->db->where($condition);
		$this->db->where('branch_id',$branch_id);
		$this->db->group_by('Month(created_on),Year(created_on)');
		$records = $this->db->get()->result();
      	 return $records;

	}

	public function get_proven_byid($proven_id){
		$this->db->select(
			'bp.*,s.bird_species as bird_species,a.aviary_name as aviary_name'
		);
		$this->db->from('ckb_breeding_proven bp');
		$this->db->join('ckb_species as s', 'bp.species_id = s.auto_id');
		$this->db->join('ckb_aviary as a', 'bp.aviary_id = a.auto_id');
		$this->db->where('bp.auto_id',$proven_id);
		$records = $this->db->get()->result();
       return $records;
	}
	public function get_eggs_incub($data){
		$this->db->select('i.*,s.bird_species as bird_species,a.aviary_name as aviary_name');
		$this->db->from('ckb_incubation i');
		$this->db->join('ckb_species as s', 'i.species_id = s.auto_id');
		$this->db->join('ckb_aviary as a', 'i.aviary_id = a.auto_id');
		$this->db->where($data);
		$this->db->where_not_in('i.clutch_status','clutched');
		$this->db->order_by('i.doi','asc');
		$records = $this->db->get()->result();
       return $records;
	}
	public function get_av_names($data){
		$this->db->select('i.cage,s.bird_species as bird_species,a.aviary_name as aviary_name');
		$this->db->from('ckb_incubation i');
		$this->db->join('ckb_species as s', 'i.species_id = s.auto_id');
		$this->db->join('ckb_aviary as a', 'i.aviary_id = a.auto_id');
		$this->db->where($data);
		//$this->db->where_not_in('clutch_status','clutched');
		//$this->db->order_by('i.doi','asc');
		$records = $this->db->get()->result();
       return $records;
	}
	
	public function get_birdspecies_dt($aviary_id,$cage,$branch_id){
		$this->db->select('i.*,cs.*');
		$this->db->from('ckb_incubation i');
		$this->db->join('ckb_species cs', 'cs.auto_id = i.species_id', 'left'); 
		$data_where = array('i.cage' => $cage,'i.aviary_id' => $aviary_id,'i.branch_id' => $branch_id);
		$this->db->where($data_where); 
		$this->db->group_by("i.species_id");
		$query = $this->db->get();
		return $query->result();
	
	   }
	   public function  get_birsmanage_sp($aviary_id,$cage,$branch_id){
		$this->db->select('b.*,cs.*');
		$this->db->from('ckb_bird b');
		$this->db->join('ckb_species cs', 'cs.auto_id = b.species_id', 'left'); 
		$data_where = array('b.cage_id' => $cage,'b.aviary_id' => $aviary_id,'b.branch_id' => $branch_id);
		$this->db->where($data_where); 
		$this->db->group_by("b.species_id");
		$query = $this->db->get();
		return $query->result();
	   }
	   public function  get_birsmanage_sp_count($aviary_id,$cage,$branch_id){
		$this->db->select('b.*,cs.*,count(b.auto_id) as count_bird');
		$this->db->from('ckb_bird b');
		$this->db->join('ckb_species cs', 'cs.auto_id = b.species_id', 'left'); 
		$data_where = array('b.cage_id' => $cage,'b.aviary_id' => $aviary_id,'b.branch_id' => $branch_id);
		$this->db->where($data_where); 
		$query = $this->db->get();
		return $query->result();
	   }
	public function get_birdspecies_clutchbycage($species_id,$cage_id,$aviary_id){
		$branch_id = $this->session->userdata('branch_id');
		$this->db->select('b.*');
		$this->db->from('ckb_breeding_proven b');
		$data_where = array('b.species_id' => $species_id,'b.cage_id' => $cage_id,'b.aviary_id' => $aviary_id);
		$this->db->where($data_where); 
		$this->db->group_by("b.clutch_no");
		$this->db->where('b.branch_id',$branch_id);
		$this->db->where('b.branch_id',$branch_id);
		//$this->db->order_by('b.id','desc');
		$query = $this->db->get();
		return $query->result();
	
	   }
	   public function get_cltuch_byring($ring_no){
		$this->db->select('*');
		$this->db->from('ckb_incubation');		
		$this->db->where('male_parent_ringno',$ring_no);
		$this->db->or_where('female_parent_ringno',$ring_no);
		//$this->db->group_by("clutch_no");
		$this->db->order_by('clutch_no ASC','egg_no_clutch ASC');
		$query = $this->db->get();
		return $query->result();
	   }
	public function verify_data_proven_dt($postData,$date,$to_date,$aviary_id,$cage_id,$clutch,$sp)
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
			$search_arr[] = " (bp.cage_id like '%" . $searchValue . "%' or 
            s.bird_species like '%" . $searchValue . "%' or 
            a.aviary_name like '%" . $searchValue . "%' ) ";
		}

		if (count($search_arr) > 0) {
			$searchQuery = implode(" and ", $search_arr);
		}

        //# Total number of records without filtering
		$this->db->select('count(*) as allcount');
		$this->db->from('ckb_breeding_proven bp');
		//$this->db->join('ckb_group as g', 'bp.group_id = g.auto_id');
		$this->db->join('ckb_species as s', 'bp.species_id = s.auto_id');
		$this->db->join('ckb_aviary as a', 'bp.aviary_id = a.auto_id');
		if ($date != '' && $to_date == '' ) $this->db->where('bp.created_on', $date);
		$condition = "bp.created_on BETWEEN " . "'" . $date . "'" . " AND " . "'" . $to_date . "'";
		if ($date != '' && $to_date != ''  ) $this->db->where($condition);
		 if ($aviary_id != '') $this->db->where('bp.aviary_id' , $aviary_id);
		 if ($cage_id != '') $this->db->where('bp.cage_id' , $cage_id);
		 if ($sp != '') $this->db->where('bp.species_id' , $sp);
		 if ($clutch != '') $this->db->where('bp.clutch_no' , $clutch);
		 $this->db->where('bp.branch_id',$branch_id);
		 $this->db->where('bp.status',1);
		if ($searchQuery != '') $this->db->where($searchQuery);

        // $this->db->where($postData_where);

		$records = $this->db->get()->result();

		$totalRecords = $records[0]->allcount;

		
        //# Total number of record with filtering
		$this->db->select('count(*) as allcount');
		$this->db->from('ckb_breeding_proven bp');
		$this->db->join('ckb_species as s', 'bp.species_id = s.auto_id');
		$this->db->join('ckb_aviary as a', 'bp.aviary_id = a.auto_id');
		if ($date != '' && $to_date == '' ) $this->db->where('bp.created_on', $date);
		$condition = "bp.created_on BETWEEN " . "'" . $date . "'" . " AND " . "'" . $to_date . "'";
		if ($date != '' && $to_date != ''  ) $this->db->where($condition);
		 if ($aviary_id != '') $this->db->where('bp.aviary_id' , $aviary_id);
		 if ($cage_id != '') $this->db->where('bp.cage_id' , $cage_id);
		 if ($sp != '') $this->db->where('bp.species_id' , $sp);
		 if ($clutch != '') $this->db->where('bp.clutch_no' , $clutch);
		 $this->db->where('bp.branch_id',$branch_id);
		 $this->db->where('bp.status',1);
		if ($searchQuery != '') $this->db->where($searchQuery);

		//   $this->db->where($postData_where);

		$records = $this->db->get()->result();

		$totalRecordwithFilter = $records[0]->allcount;

        //# Fetch records
		$this->db->select(
			'bp.*,s.bird_species as bird_species,a.aviary_name as aviary_name'
		);
		$this->db->from('ckb_breeding_proven bp');
		$this->db->join('ckb_species as s', 'bp.species_id = s.auto_id');
		$this->db->join('ckb_aviary as a', 'bp.aviary_id = a.auto_id');
		if ($date != '' && $to_date == '' ) $this->db->where('bp.created_on', $date);
		$condition = "bp.created_on BETWEEN " . "'" . $date . "'" . " AND " . "'" . $to_date . "'";
		if ($date != '' && $to_date != ''  ) $this->db->where($condition);
		 if ($aviary_id != '') $this->db->where('bp.aviary_id' , $aviary_id);
		 if ($cage_id != '') $this->db->where('bp.cage_id' , $cage_id);
		 if ($sp != '') $this->db->where('bp.species_id' , $sp);
		 if ($clutch != '') $this->db->where('bp.clutch_no' , $clutch);
		 $this->db->where('bp.branch_id',$branch_id);
		 $this->db->where('bp.status',1);

		if ($searchQuery != '') $this->db->where($searchQuery);

		//   $this->db->where($postData_where);
		$this->db->order_by('bp.id', 'desc');  // or desc

		$this->db->limit($rowperpage, $start);

		$records = $this->db->get()->result();

		$data = array();

		foreach ($records as $record) {
		//	if($record->status == '2'){   // check the status and return the data
			$timedate1 = strtotime(date("Y-m-d", strtotime($record->created_on)));
			$created_on = date("d-m-Y", $timedate1);

		
				
			

      		$action_url2 = base_url()."index.php/Breeding/add_chick/".$record->auto_id;
			  $eggno_incub =  $record->eggno_incub;	
			  $eggno_incub = str_replace('[', '', $eggno_incub);
			  $eggno_incub = str_replace(']', '', $eggno_incub);
			  $url_id = $record->aviary_id.",".$record->species_id.",".$record->cage_id;
			  $action_url3 = base_url()."index.php/Breeding/view_incubation/".urlencode($url_id);
			  $action_url1 = base_url()."index.php/Breeding/add_clutch/".urlencode($url_id);
//$action = "";
$view = '<button  onclick="get_egg_details('."'".$record->auto_id."'".');" class="btn btn-info btn-xs waves-effect waves-light tooltips" style="margin-top:5px;" data-placement="top" data-toggle="tooltip" id="view" original-title="view more"><i class="fa fa-eye" aria-hidden="true"></i></button>';
//$action = '<br><a href="'.$action_url2.'" target="_blank"><button class="btn btn-pink btn-xs waves-effect text-center waves-light tooltips" style="margin-top:-26px;" data-placement="top" data-toggle="tooltip" id="update" title="Add egg"><i class="md md-account-circle"></i></button></a><br>'; 
$action = '<br><a href="'.$action_url1.'" target="_blank"><button class="btn btn-success btn-xs waves-effect text-center waves-light tooltips" style="margin-top:-26px;" data-placement="top" data-toggle="tooltip" id="update" title="Add clutch"><i class="fa fa-plus"></i></button></a>'; 
$action .= '<button  onclick="get_delete_proven('."'".$record->id."'".','."'".$record->eggno_incub."'".');" class="btn btn-danger btn-xs waves-effect text-center waves-light tooltips" style="margin-top:-26px; margin-left: 1px;" data-placement="top" data-toggle="tooltip" id="delete" title="delete"><i class="fa fa-trash"></i></button>'; 

$incub = '<br><a href="'.$action_url3.'" target="_blank"><button class="btn btn-purple btn-xs waves-effect text-center waves-light tooltips" style="margin-top:-26px;" data-placement="top" data-toggle="tooltip" id="update" title="Update weaning Details"><i class="fa fa-eye" aria-hidden="true"></i></button></a>'; 



//$view = '<a href="'.$action_url1.'" class="btn btn-pink text-center btn-xs waves-effect waves-light tooltips" data-trigger="hover" style="margin-left:50px;margin-top:5px;" data-placement="top" data-toggle="tooltip" title="View Weaning History"><i class="fa fa-eye" aria-hidden="true"></i></a>';
		
$eggno_broken =  $record->eggno_broken;	
		$eggno_broken = str_replace('"', '', $eggno_broken);
		$eggs_broken = $record->eggs_broken.'<br>'.$eggno_broken;

		$eggno_if =  $record->eggno_if;	
		$eggno_if =str_replace('"', '', $eggno_if);
		$eggs_if = $record->eggs_if.'<br>'.$eggno_if;

		$eggno_dis =  $record->eggno_dis;	
		$eggno_dis = str_replace('"', '', $eggno_dis);
		$eggs_dis = $record->eggs_dis.'<br>'.$eggno_dis;

		$eggno_hatch =  $record->eggno_hatch;	
		$eggno_hatch =str_replace('"', '', $eggno_hatch);
		$egg_hatch = $record->egg_hatch.'<br>'.$eggno_hatch;
		//$date = date("d-m-Y", strtotime($record->date));
		$last_date = date("d-m-Y", strtotime($record->last_date));
		$first_date = date("d-m-Y", strtotime($record->cfirst_date));
$total_eggs =$record->total_eggs.'<br>'. $view;
$data[] = array(
				"id" => $record->id,
				"date" => $created_on,
				"auto_id" => $record->auto_id,
				"clutch_no" => $record->clutch_no,
				"bird_species" => $record->bird_species,
				"cage" => $record->cage_id,
				"aviary_name" => $record->aviary_name,
			//	"male_parent_ringno" => $record->male_parent_ringno,
			//	"female_parent_ringno" => $record->female_parent_ringno,
				"total_eggs" => $total_eggs,
				"eggs_broken" => $eggs_broken,
				//"eggno_broken" => $eggno_broken,
				"eggs_if" =>$eggs_if,
				//"eggno_if" => $record->eggno_if,
				"eggs_dis" =>$eggs_dis,
				//"eggno_dis" => $record->eggno_dis,
				"egg_hatch" => $egg_hatch,
				//"eggno_hatch" => $record->eggno_hatch,
				"last_date" => $last_date,
				"cfirst_date" => $first_date,
				"clutch_int" => $record->clutch_int,
				"avg_days" =>  $record->avg_days,
				"avg_weight" => $record->avg_weight,
			//	"moved_weaning_date" => $record->moved_weaning_date,
				"mail_status" => $record->mail_status,
				"action" => $action,
				"view" => $view,
				"incub" => $incub,
			
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





	public function verify_data_nonproven_dt($postData,$date,$to_date,$aviary_id,$cage_id,$ring,$sp)
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
			$search_arr[] = " (bp.cage_id like '%" . $searchValue . "%' or 
            s.bird_species like '%" . $searchValue . "%' or 
            a.aviary_name like '%" . $searchValue . "%' ) ";
		}

		if (count($search_arr) > 0) {
			$searchQuery = implode(" and ", $search_arr);
		}

        //# Total number of records without filtering
		$this->db->select('count(*) as allcount');
		$this->db->from('ckb_breeding_nonproven bp');
		//$this->db->join('ckb_group as g', 'bp.group_id = g.auto_id');
		$this->db->join('ckb_species as s', 'bp.species_id = s.auto_id');
		$this->db->join('ckb_aviary as a', 'bp.aviary_id = a.auto_id');
		if ($date != '' && $to_date == '' ) $this->db->where('bp.created_on', $date);
		$condition = "bp.created_on BETWEEN " . "'" . $date . "'" . " AND " . "'" . $to_date . "'";
		if ($date != '' && $to_date != ''  ) $this->db->where($condition);
		 if ($aviary_id != '') $this->db->where('bp.aviary_id' , $aviary_id);
		 if ($cage_id != '') $this->db->where('bp.cage_id' , $cage_id);
		 if ($sp != '') $this->db->where('bp.species_id' , $sp);
		 if ($ring != '') $this->db->where('bp.ring_no' , $clutch);
		 $this->db->where('bp.branch_id',$branch_id);
		 $this->db->where('bp.status',1);

		if ($searchQuery != '') $this->db->where($searchQuery);

        // $this->db->where($postData_where);

		$records = $this->db->get()->result();

		$totalRecords = $records[0]->allcount;

		
        //# Total number of record with filtering
		$this->db->select('count(*) as allcount');
		$this->db->from('ckb_breeding_nonproven bp');
		$this->db->join('ckb_species as s', 'bp.species_id = s.auto_id');
		$this->db->join('ckb_aviary as a', 'bp.aviary_id = a.auto_id');
		if ($date != '' && $to_date == '' ) $this->db->where('bp.created_on', $date);
		$condition = "bp.created_on BETWEEN " . "'" . $date . "'" . " AND " . "'" . $to_date . "'";
		if ($date != '' && $to_date != ''  ) $this->db->where($condition);
		 if ($aviary_id != '') $this->db->where('bp.aviary_id' , $aviary_id);
		 if ($cage_id != '') $this->db->where('bp.cage_id' , $cage_id);
		 if ($sp != '') $this->db->where('bp.species_id' , $sp);
		 if ($ring != '') $this->db->where('bp.ring_no' , $ring);
		 $this->db->where('bp.branch_id',$branch_id);
		 $this->db->where('bp.status',1);

		if ($searchQuery != '') $this->db->where($searchQuery);

		//   $this->db->where($postData_where);

		$records = $this->db->get()->result();

		$totalRecordwithFilter = $records[0]->allcount;

        //# Fetch records
		$this->db->select(
			'bp.*,s.bird_species as bird_species,a.aviary_name as aviary_name'
		);
		$this->db->from('ckb_breeding_nonproven bp');
		$this->db->join('ckb_species as s', 'bp.species_id = s.auto_id');
		$this->db->join('ckb_aviary as a', 'bp.aviary_id = a.auto_id');
		if ($date != '' && $to_date == '' ) $this->db->where('bp.created_on', $date);
		$condition = "bp.created_on BETWEEN " . "'" . $date . "'" . " AND " . "'" . $to_date . "'";
		if ($date != '' && $to_date != ''  ) $this->db->where($condition);
		 if ($aviary_id != '') $this->db->where('bp.aviary_id' , $aviary_id);
		 if ($cage_id != '') $this->db->where('bp.cage_id' , $cage_id);
		 if ($sp != '') $this->db->where('bp.species_id' , $sp);
		 if ($ring != '') $this->db->where('bp.ring_no' , $ring);
		 $this->db->where('bp.branch_id',$branch_id);
		 $this->db->where('bp.status',1);

		if ($searchQuery != '') $this->db->where($searchQuery);

		//   $this->db->where($postData_where);
		$this->db->order_by('bp.id', 'desc');  // or desc

		$this->db->limit($rowperpage, $start);

		$records = $this->db->get()->result();

		$data = array();

		foreach ($records as $record) {
		//	if($record->status == '2'){   // check the status and return the data
			/*function ch_date($in_date){
				$timedate1 = strtotime(date("Y-m-d", strtotime($in_date)));
				$created_on = date("d-m-Y", $timedate1);
				return $created_on;
				}*/

			$date =  date("d-m-Y", strtotime($record->created_on));
			$dna_sex =  date("d-m-Y", strtotime($record->dna_sex));
			$pair_date =  date("d-m-Y",strtotime( $record->pair_date));
			$bond =  date("d-m-Y", strtotime($record->bond));
			$preening =  date("d-m-Y", strtotime($record->preening));

			$fw_dom =  date("d-m-Y", strtotime($record->fw_dom));
			$food_sh =  date("d-m-Y", strtotime($record->food_sh));
			$nx_int =  date("d-m-Y", strtotime($record->nx_int));

			$sb_nest =  date("d-m-Y", strtotime($record->sb_nest));
			$db_nest =  date("d-m-Y", strtotime($record->db_nest));
			$breed_nest = date("d-m-Y", strtotime($record->breed_nest));
			$ent_nest =  date("d-m-Y",strtotime($record->ent_nest));
			$mm_perch =  date("d-m-Y", strtotime($record->mm_perch));

			$bs_mat =  date("d-m-Y", strtotime($record->bs_mat));
			$ew_mat =  date("d-m-Y", strtotime($record->ew_mat));
			$egg_lay_mat =  date("d-m-Y", strtotime($record->egg_lay_mat));
			$egg_p =  date("d-m-Y", strtotime($record->egg_p));
			$fertile_type = date("d-m-Y", strtotime($record->fertile_type));

			

			$action = '<button  onclick="get_delete_nonproven('."'".$record->id."'".');" class="btn btn-danger btn-xs waves-effect text-center waves-light tooltips" data-placement="top" data-toggle="tooltip" id="delete" title="delete"><i class="fa fa-trash"></i></button>'; 

				
			//$action_url1 = base_url()."index.php/Weaning/view_weaning_details/".$record->auto_id;

      	
$data[] = array(
				"id" => $record->id,
				"date" => $date,
				"auto_id" => $record->auto_id,
				"ring_no" => $record->ring_no,
				"bird_species" => $record->bird_species,
				"cage" => $record->cage_id,
				"aviary_name" => $record->aviary_name,
				"ring_no" => $record->ring_no,
				"gender" => $record->gender,
				"fertile_type" =>$record->fertile_type,
				"pair_type" => $record->pair_type,

				"dna_sex" => $dna_sex,
				"pair_date" =>$pair_date,
				"bond" => $bond,
				"preening" =>$preening,
				"fw_dom" => $fw_dom,
				"food_sh" => $food_sh,
				"nx_int" => $nx_int,
				"sb_nest" => $sb_nest,
				"db_nest" => $db_nest,
				"breed_nest" => $breed_nest,
				"ent_nest" =>  $ent_nest,
				"mm_perch" => $mm_perch,
				"bs_mat" => $bs_mat,
				"ew_mat" => $ew_mat,
				"egg_lay_mat" => $egg_lay_mat,
				"egg_p" => $egg_p,
				"fertile_type" => $fertile_type,
				"action" => $action,
			
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
	public function verify_data_incubation_dt($postData,$ring_no){
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
        
		//# Search
		$search_arr = array();
		$searchQuery = "";

		if ($searchValue != '') {
			$search_arr[] = " (i.male_parent_ringno like '%" . $searchValue . "%' or 
            g.group_name like '%" . $searchValue . "%' or 
            s.bird_species like '%" . $searchValue . "%' or 
            a.aviary_name like '%" . $searchValue . "%' or 
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
		$this->db->where('i.branch_id',$branch_id);
	//	$data_where = array('i.status' =>'1','i.egg_no' => 'ck_0018');
		//$this->db->where($data_where);
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

		$this->db->where('i.branch_id',$branch_id);

	//	$condition = "i.egg_no  AND "; 
		//$data_where = array('i.status' =>'1','i.egg_no' => 'ck_0018' );
		//$this->db->where($data_where);
		if ($searchQuery != '') $this->db->where($searchQuery);

		//   $this->db->where($postData_where);

		$records = $this->db->get()->result();

		$totalRecordwithFilter = $records[0]->allcount;

        //# Fetch records
		$this->db->select(
			'i.*,g.group_name as group_name,s.bird_species as bird_species,a.aviary_name as aviary_name,u.user_name as user_name'
		);
		$this->db->from('ckb_incubation i');
		$this->db->join('ckb_group as g', 'i.group_id = g.auto_id');
		$this->db->join('ckb_species as s', 'i.species_id = s.auto_id');
		$this->db->join('ckb_aviary as a', 'i.aviary_id = a.auto_id');
		$this->db->join('ckb_users as u', 'i.created_by = u.user_id');
		//$data_where = array('i.status' =>'1','i.cage' =>  $cage_id,'i.species_id' =>  $species_id,'i.aviary_id' =>  $aviary_id);
	//	$data_where1 = array('i.status' =>'1','i.egg_no' => 'ck_0017');
		//$this->db->where($data_where);
		$this->db->where('male_parent_ringno',$ring_no);
		$this->db->or_where('female_parent_ringno',$ring_no);
		$this->db->where('i.branch_id',$branch_id);

	//	$this->db->where($data_where1);
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
				
      		
			$weight_loss = '<button  onclick="get_incubdetails_list('."'".$record->auto_id."'".');" class="btn btn-success btn-xs waves-effect waves-light tooltips" style="margin-top:5px;" data-placement="top" data-toggle="tooltip" id="move" title="view weight loss"><i class="fa fa-eye" aria-hidden="true"></i></button>';			
		

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
				//"action" => $action,
				"weight_loss" => $weight_loss

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
	

public function get_birds_proven_dt($postData){
	$response = array();
        //# Read value
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
			$search_arr[] = " (ring_no like '%" . $searchValue . "%' or 
            group_name like '%" . $searchValue . "%' or 
            bird_species like '%" . $searchValue . "%' or 
            gender like '%" . $searchValue . "%' or 
            cage_id like '%" . $searchValue . "%' or 
            aviary_name like '%" . $searchValue . "%' or 
            proven like'%" . $searchValue . "%' ) ";
		}

		if (count($search_arr) > 0) {
			$searchQuery = implode(" and ", $search_arr);
		}

        //# Total number of records without filtering
		$this->db->select('count(*) as allcount');
		$this->db->from('ckb_bird b');
		$this->db->join('ckb_group as g', 'b.group_id = g.auto_id');
		$this->db->join('ckb_species as s', 'b.species_id = s.auto_id');
		// $this->db->join('ckb_cage as c', 'b.cage_id = c.auto_id');
		$this->db->join('ckb_aviary as a', 'b.aviary_id = a.auto_id');
		
		$this->db->where('b.branch_id',$branch_id);
		$wh_not_in  =array('Sale','Mortality');
		$this->db->where_not_in('b.bird_status',$wh_not_in);

		if ($searchQuery != '') $this->db->where($searchQuery);

        // $this->db->where($postData_where);

		$records = $this->db->get()->result();
		// print_r($this->db->last_query());die;

		$totalRecords = $records[0]->allcount;

        //# Total number of record with filtering
		$this->db->select('count(*) as allcount');
		$this->db->from('ckb_bird b');
		$this->db->join('ckb_group as g', 'b.group_id = g.auto_id');
		$this->db->join('ckb_species as s', 'b.species_id = s.auto_id');
		// $this->db->join('ckb_cage as c', 'b.cage_id = c.auto_id');
		$this->db->join('ckb_aviary as a', 'b.aviary_id = a.auto_id');
		$this->db->where('b.branch_id',$branch_id);
		$wh_not_in  =array('Sale','Mortality');
		$this->db->where_not_in('b.bird_status',$wh_not_in);
		if ($searchQuery != '') $this->db->where($searchQuery);

		//   $this->db->where($postData_where);

		$records = $this->db->get()->result();

		$totalRecordwithFilter = $records[0]->allcount;

        //# Fetch records
		$this->db->select(
			'b.*,g.group_name as group_name,s.bird_species as bird_species,a.aviary_name as aviary_name'
		);
		$this->db->from('ckb_bird b');
		$this->db->join('ckb_group as g', 'b.group_id = g.auto_id');
		$this->db->join('ckb_species as s', 'b.species_id = s.auto_id');
		// $this->db->join('ckb_incubation as c', 'b.cage_id = c.auto_id');
		$this->db->join('ckb_aviary as a', 'b.aviary_id = a.auto_id');
	//	$this->db->join('ckb_users as u', 'b.created_by = u.user_id');
		$this->db->where('b.branch_id',$branch_id);
		$wh_not_in  =array('Sale','Mortality');
		$this->db->where_not_in('b.bird_status',$wh_not_in);
		if ($searchQuery != '') $this->db->where($searchQuery);

		//   $this->db->where($postData_where);
		$this->db->order_by('b.id', 'desc');  // or desc

		$this->db->limit($rowperpage, $start);

		$records = $this->db->get()->result();
		// print_r($records);die;

		// print_r($this->db->last_query());die;

		$data = array();
		$count = 0;
		foreach ($records as $record) {
			$timedate1 = strtotime(date("Y-m-d", strtotime($record->created_on)));
			$created_on = date("d-m-Y", $timedate1);

		if($record->gender == "Male"){
			$this->db->select('*');
			$this->db->from('ckb_incubation');
			$this->db->where('male_parent_ringno',$record->ring_no);
			$incub_eggs_result = $this->db->get()->result();

			$this->db->select('count(*) as fertile_count');
			$this->db->from('ckb_incubation');
			$this->db->where('male_parent_ringno',$record->ring_no);
			$this->db->where('fertile_type',"Fertile");
			$fresult = $this->db->get()->result();
			// print_r($this->db->last_query());die;
			// print_r($fresult);die;
			$fertile_count = $fresult[0]->fertile_count;
			//echo $fertile_count ;
		}
		else{
			$this->db->select('*');
			$this->db->from('ckb_incubation');
			$this->db->where('female_parent_ringno',$record->ring_no);
			$incub_eggs_result = $this->db->get()->result();

			$this->db->select('count(*) as fertile_count');
			$this->db->from('ckb_incubation');
			$this->db->where('female_parent_ringno',$record->ring_no);
			$this->db->where('fertile_type',"Fertile");
			$fresult = $this->db->get()->result();
			// print_r($this->db->last_query());die;
			// print_r($fresult);die;
			$fertile_count = $fresult[0]->fertile_count;
//echo $fertile_count ;
		}
		$total_eggs =  count($incub_eggs_result);
		// foreach ($incub_eggs_result as $eggs) {
			$action_url1 = base_url()."index.php/Breeding/add_clutch/";
		//	$action = '<br><a href="'.$action_url1.'" target="_blank"><button class="btn btn-success btn-xs waves-effect text-center waves-light tooltips" style="margin-top:-26px;" data-placement="top" data-toggle="tooltip" id="update" title="Clutch History"><i class="fa fa-plus"></i></button></a>'; 
			$action ='<form target="_blank" action="'.$action_url1.'";  method="post">
			<input type="hidden" name="ring_no" value="'.$record->ring_no.'">
			<input type="submit" value="View">
   			</form>';
	if($fertile_count > 0){
		$count = $count+1;
	  $data[] = array(
				"id" => $record->id,
				"auto_id" => $record->auto_id,
				"ring_no" => $record->ring_no,
				"group_name" => $record->group_name,
				"bird_species" => $record->bird_species,
				"cage" => $record->cage_id,
				"aviary_name" => $record->aviary_name,
				"gender" => $record->gender,
				"proven" => $record->proven,
				"weight" => $record->weight,
				"total_eggs" => $total_eggs,
				"action" => $action,
			);
		}
		}

        //# Response
		$response = array(
			"draw" => intval($draw),
			"iTotalRecords" => $count,
			"iTotalDisplayRecords" => $count,
			"aaData" => $data
		);

		return $response;
}
public function get_birds_nonproven_dt($postData){
	$response = array();
        //# Read value
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
			$search_arr[] = " (ring_no like '%" . $searchValue . "%' or 
            group_name like '%" . $searchValue . "%' or 
            bird_species like '%" . $searchValue . "%' or 
            gender like '%" . $searchValue . "%' or 
            cage_id like '%" . $searchValue . "%' or 
            aviary_name like '%" . $searchValue . "%' or 
            proven like'%" . $searchValue . "%' ) ";
		}

		if (count($search_arr) > 0) {
			$searchQuery = implode(" and ", $search_arr);
		}

        //# Total number of records without filtering
		$this->db->select('count(*) as allcount');
		$this->db->from('ckb_bird b');
		$this->db->join('ckb_group as g', 'b.group_id = g.auto_id');
		$this->db->join('ckb_species as s', 'b.species_id = s.auto_id');
		// $this->db->join('ckb_cage as c', 'b.cage_id = c.auto_id');
		$this->db->join('ckb_aviary as a', 'b.aviary_id = a.auto_id');
		$this->db->where('b.branch_id',$branch_id);
		$wh_not_in  =array('Sale','Mortality');
		$this->db->where_not_in('b.bird_status',$wh_not_in);

		if ($searchQuery != '') $this->db->where($searchQuery);

        // $this->db->where($postData_where);

		$records = $this->db->get()->result();

		$totalRecords = $records[0]->allcount;

        //# Total number of record with filtering
		$this->db->select('count(*) as allcount');
		$this->db->from('ckb_bird b');
		$this->db->join('ckb_group as g', 'b.group_id = g.auto_id');
		$this->db->join('ckb_species as s', 'b.species_id = s.auto_id');
		// $this->db->join('ckb_cage as c', 'b.cage_id = c.auto_id');
		$this->db->join('ckb_aviary as a', 'b.aviary_id = a.auto_id');
		$this->db->where('b.branch_id',$branch_id);
		$wh_not_in  =array('Sale','Mortality');
		$this->db->where_not_in('b.bird_status',$wh_not_in);
		if ($searchQuery != '') $this->db->where($searchQuery);

		//   $this->db->where($postData_where);

		$records = $this->db->get()->result();

		$totalRecordwithFilter = $records[0]->allcount;

        //# Fetch records
		$this->db->select(
			'b.*,g.group_name as group_name,s.bird_species as bird_species,a.aviary_name as aviary_name'
		);
		$this->db->from('ckb_bird b');
		$this->db->join('ckb_group as g', 'b.group_id = g.auto_id');
		$this->db->join('ckb_species as s', 'b.species_id = s.auto_id');
		// $this->db->join('ckb_incubation as c', 'b.cage_id = c.auto_id');
		$this->db->join('ckb_aviary as a', 'b.aviary_id = a.auto_id');
	//	$this->db->join('ckb_users as u', 'b.created_by = u.user_id');
		$this->db->where('b.branch_id',$branch_id);
		$wh_not_in  =array('Sale','Mortality');
		$this->db->where_not_in('b.bird_status',$wh_not_in);
		if ($searchQuery != '') $this->db->where($searchQuery);

		//   $this->db->where($postData_where);
		$this->db->order_by('b.id', 'desc');  // or desc

		$this->db->limit($rowperpage, $start);

		$records = $this->db->get()->result();
		
		$data = array();
		$count = 0;
		foreach ($records as $record) {
			$timedate1 = strtotime(date("Y-m-d", strtotime($record->created_on)));
			$created_on = date("d-m-Y", $timedate1);

		if($record->gender == "Male"){
			$this->db->select('*');
			$this->db->from('ckb_incubation');
			$this->db->where('male_parent_ringno',$record->ring_no);
			$incub_eggs_result = $this->db->get()->result();

			$this->db->select('count(*) as fertile_count');
			$this->db->from('ckb_incubation');
			$this->db->where('male_parent_ringno',$record->ring_no);
			$this->db->where('fertile_type',"Fertile");
			$fresult = $this->db->get()->result();
			$fertile_count = $fresult[0]->fertile_count;

		}
		else{
			$this->db->select('*');
			$this->db->from('ckb_incubation');
			$this->db->where('female_parent_ringno',$record->ring_no);
			$incub_eggs_result = $this->db->get()->result();

			$this->db->select('count(*) as fertile_count');
			$this->db->from('ckb_incubation');
			$this->db->where('female_parent_ringno',$record->ring_no);
			$this->db->where('fertile_type',"Fertile");
			$fresult = $this->db->get()->result();
			$fertile_count = $fresult[0]->fertile_count;

		}
		$total_eggs =  count($incub_eggs_result);
	
		$action_url3 = base_url()."index.php/Breeding/view_incubation/".$record->ring_no;

$action = '<br><a href="'.$action_url3.'" target="_blank"><button class="btn btn-purple btn-xs waves-effect text-center waves-light tooltips" style="margin-top:-26px;" data-placement="top" data-toggle="tooltip" id="update" title="Update weaning Details"><i class="fa fa-eye" aria-hidden="true"></i></button></a>'; 

if($fertile_count == 0){
	$count = $count+1;
	  $data[] = array(
				"id" => $record->id,
				"auto_id" => $record->auto_id,
				"ring_no" => $record->ring_no,
				"group_name" => $record->group_name,
				"bird_species" => $record->bird_species,
				"cage" => $record->cage_id,
				"aviary_name" => $record->aviary_name,
				"gender" => $record->gender,
				"proven" => $record->proven,
				"weight" => $record->weight,
				"total_eggs" => $total_eggs,
				"action" => $action,
			);
		}
		}

        //# Response
		$response = array(
			"draw" => intval($draw),
			"iTotalRecords" => $count,
			"iTotalDisplayRecords" => $count,
			"aaData" => $data
		);

		return $response;
}

}//end class


