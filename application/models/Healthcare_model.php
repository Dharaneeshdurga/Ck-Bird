<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Healthcare_model extends CI_Model
{
	
	public function get_data_byid($data,$table){
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where($data);
		$records = $this->db->get()->result();
        return $records;
	}
	public function get_temp_id($temp_id){
		$branch_id = $this->session->userdata('branch_id');
		
		$this->db->select(
			'hs.*,s.bird_species as species_name,a.aviary_name as aviary_name'
		);
		$this->db->from('ckb_healthcare_treatment hs');
		$this->db->join('ckb_species as s', 'hs.bird_species = s.auto_id');
		$this->db->join('ckb_aviary as a', 'hs.aviary_id = a.auto_id');
		$this->db->where('hs.auto_id',$temp_id);
		$this->db->where('hs.branch_id',$branch_id);
		$records = $this->db->get()->result();
       return $records;
	}
	public function get_mort_id($mort_id){
		$branch_id = $this->session->userdata('branch_id');
		
		$this->db->select(
			'hs.*,s.bird_species as species_name,a.aviary_name as aviary_name'
		);
		$this->db->from('ckb_healthcare_mort hs');
		$this->db->join('ckb_species as s', 'hs.bird_species = s.auto_id');
		$this->db->join('ckb_aviary as a', 'hs.aviary_id = a.auto_id');
		$this->db->where('hs.auto_id',$mort_id);
		$this->db->where('hs.branch_id',$branch_id);
		$records = $this->db->get()->result();
       return $records;
	}
	public function get_eggs_incub($data){
		$this->db->select('*');
		$this->db->from('ckb_incubation');
		$this->db->where($data);
		$records = $this->db->get()->result();
        return $records;
	}
	public function get_eggs_bird($data){
		$this->db->select('*');
		$this->db->from('ckb_bird');
		$this->db->where($data);
		$records = $this->db->get()->result();
        return $records;
	}
	public function parents_history_dt($data){
		$this->db->select('*');
		$this->db->from('ckb_egg_clutch');
		$this->db->where($data);
		$this->db->group_by('clutch_no');
		$records = $this->db->get()->result();
        return $records;
	}
	public function get_handfeed_dt($data){
		$this->db->select('*');
		$this->db->from('ckb_move_brooder');
		$this->db->where($data);
		$records = $this->db->get()->result();
        return $records;
	}
	public function get_eggs_clutch($eggno){
		$this->db->select('clutch_no');
		$this->db->from('ckb_breeding_proven');
		$this->db->like('eggno_incub', $eggno);
		$records = $this->db->get()->result();
        return $records;
	}
	public function get_eggno_inclutch($eggno){ // get egg number in current clutch
		$this->db->select('eggno_in_clutch');
		$this->db->from('ckb_egg_clutch');
		$this->db->where('egg_no', $eggno);
		$records = $this->db->get()->result();
        return $records;
	}
	public function get_birdspecies_dt($data_where){
		$this->db->select('i.*,cs.*');
		$this->db->from('ckb_incubation i');
		$this->db->join('ckb_species cs', 'cs.auto_id = i.species_id', 'left'); 
		$this->db->group_by("i.species_id");
		$this->db->where($data_where); 
	
		$query = $this->db->get();
		return $query->result();
	
	   }
	public function get_birdspecies_clutchbycage($species_id,$cage_id,$aviary_id){
		$this->db->select('b.*');
		$this->db->from('ckb_breeding_proven b');
		$data_where = array('b.species_id' => $species_id,'b.cage_id' => $cage_id,'b.aviary_id' => $aviary_id);
		$this->db->where($data_where); 
		$this->db->group_by("b.clutch_no");
		//$this->db->order_by('b.id','desc');
		$query = $this->db->get();
		return $query->result();
	
	   }
	public function get_all_mortaility_dt($postData){
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
		$this->db->where('b.bird_status','Mortality');

		if ($searchQuery != '') $this->db->where($searchQuery);

        // $this->db->where($postData_where);

		$records1 = $this->db->get()->result();

		
		// print_r($this->db->last_query());die;
		$this->db->select('count(*) as allcount');
		$this->db->from('ckb_incubation i');
		$this->db->where('i.branch_id',$branch_id);
		$this->db->where('i.health_status','Mortality');
		$this->db->or_where('i.health_status','Dis');

		if ($searchQuery != '') $this->db->where($searchQuery);

        // $this->db->where($postData_where);

		$records2 = $this->db->get()->result();

		// print_r($records2);die;
		// print_r($this->db->last_query());die;

		$totalRecords1 = $records1[0]->allcount;
		$totalRecords2 = $records2[0]->allcount;
		$totalRecords = ($totalRecords1 + $totalRecords2);

		$totalRecordwithFilter = $totalRecords;

		$this->db->select('i.egg_no as sp,i.health_change_date as mort_date, i.cage as cage,s.bird_species as sp_name,a.aviary_name as av_name');
		$this->db->from('ckb_incubation i');
		$this->db->join('ckb_species as s', 'i.species_id = s.auto_id');
		$this->db->join('ckb_aviary as a', 'i.aviary_id = a.auto_id');
		$this->db->where('i.health_status','Mortality'); 
		$this->db->or_where('i.health_status','Dis'); 
		$this->db->where('i.branch_id',$branch_id);
		$query1 = $this->db->get_compiled_select();


		$this->db->select('b.ring_no as sp,b.health_change_date as mort_date,b.cage_id as cage,s.bird_species as sp_name,a.aviary_name as av_name');
		$this->db->from('ckb_bird b');
		$this->db->join('ckb_species as s', 'b.species_id = s.auto_id');
		$this->db->join('ckb_aviary as a', 'b.aviary_id = a.auto_id');
		$this->db->where('b.bird_status','Mortality'); 
		$this->db->where('b.branch_id',$branch_id);
		$query2 = $this->db->get_compiled_select();
	 
		$final_query = $this->db->query($query1 . ' UNION ' . $query2);
	
		 $records = $final_query->result_array(); 

		//  print_r($this->db->last_query());die;

		$data = array();

		foreach ($records as $record) {
			// $timedate1 = strtotime(date("Y-m-d", strtotime($record->created_on)));
			// $created_on = date("d-m-Y", $timedate1);

			//print_r($record['sp']);
		$mort_date = date("d-m-Y", strtotime($record['mort_date']));
		$av = str_replace(' ', '%20', $record['av_name']);
		$sp = str_replace(' ', '%20', $record['sp_name']);
		$url_id = $av .",".$sp.",".$record['cage'].",".$record['sp'];
	//	$url_id = $record['av_name'] .",".$record['sp_name'].",".$record['cage'].",".$record['sp'];
		$action_url = base_url()."index.php/Healthcare/edit_mort/".urlencode($url_id);	
		$action_url1 = base_url()."index.php/Healthcare/mort_register/".$record['sp'];			
$action ='<a href="'.$action_url.'" target="_blank" ><button class="btn btn-pink btn-xs waves-effect text-center waves-light tooltips" data-placement="top" data-toggle="tooltip" id="update" title="add pm"><i class="fa fa-plus" aria-hidden="true"></i></button></a></td>';
$action .='<a href="'.$action_url1.'" target="_blank" style="margin-left: 10px;"><button class="btn btn-purple btn-xs waves-effect text-center waves-light tooltips" data-placement="top" data-toggle="tooltip" id="update" title="View pm"><i class="fa fa-eye" aria-hidden="true"></i></button></a></td>';

$data[] = array(
				
				"egg_no" => $record['sp'],
				 "mort_date" => $mort_date,
				 "action" => $action,
				"group_name" => "",
				"bird_species" => $record['sp_name'],
				"cage" => $record['cage'],
				"aviary_name" => $record['av_name'],

			);
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

/*************stunt REGISTER DETAILS START **************************************************/

	public function get_stunt_register_dt($postData,$date,$to_date,$aviary_id,$cage_id,$ring,$sp)
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
			$search_arr[] = " (hs.cage like '%" . $searchValue . "%' or 
            s.bird_species like '%" . $searchValue . "%' or 
            a.aviary_name like '%" . $searchValue . "%' ) ";
		}

		if (count($search_arr) > 0) {
			$searchQuery = implode(" and ", $search_arr);
		}

        //# Total number of records without filtering
		$this->db->select('count(*) as allcount');
		$this->db->from('ckb_healthcare_stunt hs');
		$this->db->join('ckb_species as s', 'hs.bird_species = s.auto_id');
		$this->db->join('ckb_aviary as a', 'hs.aviary_id = a.auto_id');
		if ($date != '' && $to_date == '' ) $this->db->where('hs.stund_date', $date);
		$condition = "hs.stund_date BETWEEN " . "'" . $date . "'" . " AND " . "'" . $to_date . "'";
		if ($date != '' && $to_date != ''  ) $this->db->where($condition);
		 if ($aviary_id != '') $this->db->where('hs.aviary_id' , $aviary_id);
		 if ($cage_id != '') $this->db->where('hs.cage' , $cage_id);
		 if ($sp != '') $this->db->where('hs.bird_species' , $sp);
		 if ($ring != '') $this->db->where('hs.egg_no' , $ring);
		 $this->db->where('hs.branch_id',$branch_id);
		 $this->db->where('hs.static_status',1);
		if ($searchQuery != '') $this->db->where($searchQuery);

        // $this->db->where($postData_where);

		$records = $this->db->get()->result();

		$totalRecords = $records[0]->allcount;

		
        //# Total number of record with filtering
		$this->db->select('count(*) as allcount');
		$this->db->from('ckb_healthcare_stunt hs');
		$this->db->join('ckb_species as s', 'hs.bird_species = s.auto_id');
		$this->db->join('ckb_aviary as a', 'hs.aviary_id = a.auto_id');
		if ($date != '' && $to_date == '' ) $this->db->where('hs.stund_date', $date);
		$condition = "hs.stund_date BETWEEN " . "'" . $date . "'" . " AND " . "'" . $to_date . "'";
		if ($date != '' && $to_date != ''  ) $this->db->where($condition);
		 if ($aviary_id != '') $this->db->where('hs.aviary_id' , $aviary_id);
		 if ($cage_id != '') $this->db->where('hs.cage' , $cage_id);
		 if ($sp != '') $this->db->where('hs.bird_species' , $sp);
		 if ($ring != '') $this->db->where('hs.egg_no' , $ring);
		 $this->db->where('hs.branch_id',$branch_id);
		 $this->db->where('hs.static_status',1);
		if ($searchQuery != '') $this->db->where($searchQuery);

		//   $this->db->where($postData_where);

		$records = $this->db->get()->result();

		$totalRecordwithFilter = $records[0]->allcount;

        //# Fetch records
		$this->db->select(
			'hs.*,s.bird_species as bird_species,a.aviary_name as aviary_name'
		);
	
		$this->db->from('ckb_healthcare_stunt hs');
		$this->db->join('ckb_species as s', 'hs.bird_species = s.auto_id');
		$this->db->join('ckb_aviary as a', 'hs.aviary_id = a.auto_id');
		if ($date != '' && $to_date == '' ) $this->db->where('hs.stund_date', $date);
		$condition = "hs.stund_date BETWEEN " . "'" . $date . "'" . " AND " . "'" . $to_date . "'";
		if ($date != '' && $to_date != ''  ) $this->db->where($condition);
		 if ($aviary_id != '') $this->db->where('hs.aviary_id' , $aviary_id);
		 if ($cage_id != '') $this->db->where('hs.cage' , $cage_id);
		 if ($sp != '') $this->db->where('hs.bird_species' , $sp);
		 if ($ring != '') $this->db->where('hs.egg_no' , $ring);
		 $this->db->where('hs.branch_id',$branch_id);
		 $this->db->where('hs.static_status',1);
		if ($searchQuery != '') $this->db->where($searchQuery);

		//   $this->db->where($postData_where);
		$this->db->order_by('hs.id', 'desc');  // or desc

		$this->db->limit($rowperpage, $start);

		$records = $this->db->get()->result();

		$data = array();

		foreach ($records as $record) {
		
			$query = $this->db->get_where('ckb_healthcare_stunt', array('mp_ring' => $record->mp_ring ));
	$query1 = $this->db->get_where('ckb_healthcare_stunt', array('fp_ring' => $record->fp_ring ));
	$count_male_ring = $query->num_rows();
	$count_female_ring = $query1->num_rows();
	//# Response
            
			

		
				
	$stund_date = date("d-m-Y", strtotime($record->stund_date));
	$action = '<button  onclick="get_delete_stunt('."'".$record->id."'".');" class="btn btn-danger btn-xs waves-effect text-center waves-light tooltips" data-placement="top" data-toggle="tooltip" id="delete" title="delete"><i class="fa fa-trash"></i></button>'; 

      	
$data[] = array(
				"id" => $record->id,
				"stund_date" => $stund_date,
				"aviary_id" => $record->aviary_name,
				"cage" => $record->cage,
				"bird_species" => $record->bird_species,
				"egg_no" => $record->egg_no,
				"hatch_date" => $record->hatch_date,
				"mp_ring" => $record->mp_ring,
				"fp_ring" => $record->fp_ring,
				"egg_weight" =>$record->egg_weight,
				"std_egg_weight" => $record->std_egg_weight,

				"hatch_weight" => $record->hatch_weight,
				"std_hatch_weight" => $record->std_hatch_weight,
				"clutch_no" => $record->clutch_no,
				"egg_no_clutch" => $record->egg_no_clutch,
				"stunt_f_day" => $record->stunt_f_day,
				"std_wean_days" => $record->std_wean_days,
				"handfeed_chick_issue" => $record->handfeed_chick_issue,
				"c_m_adapt" => $record->c_m_adapt,
				"egg_weight" =>$record->egg_weight,
                "count_male_ring" => $count_male_ring,
				"count_female_ring" => $count_female_ring,
				"status" => $record->status,
				"age" => $record->age,
				"body_weight" => $record->body_weight,
				"action" => $action,
				
			
			);
		
	}
	
		$response = array(
			"draw" => intval($draw),
			"iTotalRecords" => $totalRecords,
			"iTotalDisplayRecords" => $totalRecordwithFilter,
			"aaData" => $data
		);

		return $response;
	}

	/*************splay REGISTER DETAILS START **************************************************/

	public function get_splay_register_dt($postData,$date,$to_date,$aviary_id,$cage_id,$ring,$sp)
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
			$search_arr[] = " (sp.cage like '%" . $searchValue . "%' or 
            s.bird_species like '%" . $searchValue . "%' or 
            a.aviary_name like '%" . $searchValue . "%' ) ";
		}

		if (count($search_arr) > 0) {
			$searchQuery = implode(" and ", $search_arr);
		}

        //# Total number of records without filtering
		$this->db->select('count(*) as allcount');
		$this->db->from('ckb_healthcare_splay sp');
		$this->db->join('ckb_species as s', 'sp.bird_species = s.auto_id');
		$this->db->join('ckb_aviary as a', 'sp.aviary_id = a.auto_id');
		if ($date != '' && $to_date == '' ) $this->db->where('sp.splay_date', $date);
		$condition = "sp.splay_date BETWEEN " . "'" . $date . "'" . " AND " . "'" . $to_date . "'";
		if ($date != '' && $to_date != ''  ) $this->db->where($condition);
		 if ($aviary_id != '') $this->db->where('sp.aviary_id' , $aviary_id);
		 if ($cage_id != '') $this->db->where('sp.cage' , $cage_id);
		 if ($sp != '') $this->db->where('sp.bird_species' , $sp);
		 if ($ring != '') $this->db->where('sp.egg_no' , $ring);
		 $this->db->where('sp.branch_id',$branch_id);
		 $this->db->where('sp.static_status',1);

		if ($searchQuery != '') $this->db->where($searchQuery);

        // $this->db->where($postData_where);

		$records = $this->db->get()->result();

		$totalRecords = $records[0]->allcount;

		
        //# Total number of record with filtering
		$this->db->select('count(*) as allcount');
		$this->db->from('ckb_healthcare_splay sp');
		$this->db->join('ckb_species as s', 'sp.bird_species = s.auto_id');
		$this->db->join('ckb_aviary as a', 'sp.aviary_id = a.auto_id');
		if ($date != '' && $to_date == '' ) $this->db->where('sp.splay_date', $date);
		$condition = "sp.splay_date BETWEEN " . "'" . $date . "'" . " AND " . "'" . $to_date . "'";
		if ($date != '' && $to_date != ''  ) $this->db->where($condition);
		 if ($aviary_id != '') $this->db->where('sp.aviary_id' , $aviary_id);
		 if ($cage_id != '') $this->db->where('sp.cage' , $cage_id);
		 if ($sp != '') $this->db->where('sp.bird_species' , $sp);
		 if ($ring != '') $this->db->where('sp.egg_no' , $ring);
		 $this->db->where('sp.branch_id',$branch_id);
		 $this->db->where('sp.static_status',1);
		if ($searchQuery != '') $this->db->where($searchQuery);

		//   $this->db->where($postData_where);

		$records = $this->db->get()->result();

		$totalRecordwithFilter = $records[0]->allcount;

        //# Fetch records
		$this->db->select(
			'sp.*,s.bird_species as bird_species,a.aviary_name as aviary_name'
		);
	
		$this->db->from('ckb_healthcare_splay sp');
		$this->db->join('ckb_species as s', 'sp.bird_species = s.auto_id');
		$this->db->join('ckb_aviary as a', 'sp.aviary_id = a.auto_id');
		if ($date != '' && $to_date == '' ) $this->db->where('sp.splay_date', $date);
		$condition = "sp.splay_date BETWEEN " . "'" . $date . "'" . " AND " . "'" . $to_date . "'";
		if ($date != '' && $to_date != ''  ) $this->db->where($condition);
		 if ($aviary_id != '') $this->db->where('sp.aviary_id' , $aviary_id);
		 if ($cage_id != '') $this->db->where('sp.cage' , $cage_id);
		 if ($sp != '') $this->db->where('sp.bird_species' , $sp);
		 if ($ring != '') $this->db->where('sp.egg_no' , $ring);
		 $this->db->where('sp.branch_id',$branch_id);
		 $this->db->where('sp.static_status',1);
		if ($searchQuery != '') $this->db->where($searchQuery);

		//   $this->db->where($postData_where);
		$this->db->order_by('sp.id', 'desc');  // or desc

		$this->db->limit($rowperpage, $start);

		$records = $this->db->get()->result();

		$data = array();

		foreach ($records as $record) {
		
			$query = $this->db->get_where('ckb_healthcare_splay', array('mp_ring' => $record->mp_ring ));
	$query1 = $this->db->get_where('ckb_healthcare_splay', array('fp_ring' => $record->fp_ring ));
	$count_male_ring = $query->num_rows();
	$count_female_ring = $query1->num_rows();
	//# Response
            
			

		
				
	$splay_date = date("d-m-Y", strtotime($record->splay_date));
	$detect_date = date("d-m-Y", strtotime($record->detect_date));
	$action = '<button  onclick="get_delete_splay('."'".$record->id."'".');" class="btn btn-danger btn-xs waves-effect text-center waves-light tooltips" data-placement="top" data-toggle="tooltip" id="delete" title="delete"><i class="fa fa-trash"></i></button>'; 

$data[] = array(
				"id" => $record->id,
				"splay_date" => $splay_date,
				"aviary_id" => $record->aviary_name,
				"cage" => $record->cage,
				"bird_species" => $record->bird_species,
				"egg_no" => $record->egg_no,
				"hatch_date" => $record->hatch_date,
				"mp_ring" => $record->mp_ring,
				"fp_ring" => $record->fp_ring,
				"egg_weight" =>$record->egg_weight,
				"std_egg_weight" => $record->std_egg_weight,

				"hatch_weight" => $record->hatch_weight,
				"std_hatch_weight" => $record->std_hatch_weight,
				"detect_date" => $detect_date,
			//	"egg_no_clutch" => $record->egg_no_clutch,
				"c_m_adapt" => $record->c_m_adapt,
                "count_male_ring" => $count_male_ring,
				"count_female_ring" => $count_female_ring,
				"status" => $record->status,
				"action" => $action,
			
			);
		
	}
	
		$response = array(
			"draw" => intval($draw),
			"iTotalRecords" => $totalRecords,
			"iTotalDisplayRecords" => $totalRecordwithFilter,
			"aaData" => $data
		);

		return $response;
	}
	
/*************TREATMENT REGISTER DETAILS START **************************************************/
	
public function treatment_register_get($postData,$date,$to_date,$aviary_id,$cage_id,$ring,$sp)
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
			$search_arr[] = " (ht.cage like '%" . $searchValue . "%' or 
            s.bird_species like '%" . $searchValue . "%' or 
            a.aviary_name like '%" . $searchValue . "%' ) ";
		}

		if (count($search_arr) > 0) {
			$searchQuery = implode(" and ", $search_arr);
		}

        //# Total number of records without filtering
		$this->db->select('count(*) as allcount');
		$this->db->from('ckb_healthcare_treatment ht');
		$this->db->join('ckb_species as s', 'ht.bird_species = s.auto_id');
		$this->db->join('ckb_aviary as a', 'ht.aviary_id = a.auto_id');
		if ($date != '' && $to_date == '' ) $this->db->where('ht.date', $date);
		$condition = "ht.date BETWEEN " . "'" . $date . "'" . " AND " . "'" . $to_date . "'";
		if ($date != '' && $to_date != ''  ) $this->db->where($condition);
		 if ($aviary_id != '') $this->db->where('ht.aviary_id' , $aviary_id);
		 if ($cage_id != '') $this->db->where('ht.cage' , $cage_id);
		 if ($sp != '') $this->db->where('ht.bird_species' , $sp);
		 if ($ring != '') $this->db->where('ht.eggring_no' , $ring);
		 $this->db->where('ht.branch_id',$branch_id);
		 $this->db->where('ht.static_status',1);


		if ($searchQuery != '') $this->db->where($searchQuery);

        // $this->db->where($postData_where);

		$records = $this->db->get()->result();

		$totalRecords = $records[0]->allcount;

		
        //# Total number of record with filtering
		$this->db->select('count(*) as allcount');
		$this->db->from('ckb_healthcare_treatment ht');
		$this->db->join('ckb_species as s', 'ht.bird_species = s.auto_id');
		$this->db->join('ckb_aviary as a', 'ht.aviary_id = a.auto_id');
		if ($date != '' && $to_date == '' ) $this->db->where('ht.date', $date);
		$condition = "ht.date BETWEEN " . "'" . $date . "'" . " AND " . "'" . $to_date . "'";
		if ($date != '' && $to_date != ''  ) $this->db->where($condition);
		 if ($aviary_id != '') $this->db->where('ht.aviary_id' , $aviary_id);
		 if ($cage_id != '') $this->db->where('ht.cage' , $cage_id);
		 if ($sp != '') $this->db->where('ht.bird_species' , $sp);
		 if ($ring != '') $this->db->where('ht.eggring_no' , $ring);
		 $this->db->where('ht.branch_id',$branch_id);
		 $this->db->where('ht.static_status',1);


		if ($searchQuery != '') $this->db->where($searchQuery);

		//   $this->db->where($postData_where);

		$records = $this->db->get()->result();

		$totalRecordwithFilter = $records[0]->allcount;

        //# Fetch records
		$this->db->select(
			'ht.*,s.bird_species as species_name,a.aviary_name as aviary_name'
		);
	
		$this->db->from('ckb_healthcare_treatment ht');
		$this->db->join('ckb_species as s', 'ht.bird_species = s.auto_id');
		$this->db->join('ckb_aviary as a', 'ht.aviary_id = a.auto_id');
		if ($date != '' && $to_date == '' ) $this->db->where('ht.date', $date);
		$condition = "ht.date BETWEEN " . "'" . $date . "'" . " AND " . "'" . $to_date . "'";
		if ($date != '' && $to_date != ''  ) $this->db->where($condition);
		 if ($aviary_id != '') $this->db->where('ht.aviary_id' , $aviary_id);
		 if ($cage_id != '') $this->db->where('ht.cage' , $cage_id);
		 if ($sp != '') $this->db->where('ht.bird_species' , $sp);
		 if ($ring != '') $this->db->where('ht.eggring_no' , $ring);
		 $this->db->where('ht.branch_id',$branch_id);
		 $this->db->where('ht.static_status',1);

		if ($searchQuery != '') $this->db->where($searchQuery);

		//   $this->db->where($postData_where);
		$this->db->order_by('ht.id', 'desc');  // or desc

		$this->db->limit($rowperpage, $start);

		$records = $this->db->get()->result();

		$data = array();

		foreach ($records as $record) {
		
	$action_url = base_url()."index.php/Healthcare/edit_treatment/".$record->auto_id;			
$action ='<a href="'.$action_url.'"><button class="btn btn-pink btn-xs waves-effect text-center waves-light tooltips" data-placement="top" data-toggle="tooltip" id="update" title="Update weaning Details"><i class="fa fa-plus" aria-hidden="true"></i></button></a></td>';
		
				
	$temp_date = date("d-m-Y", strtotime($record->date));
	$action .= '<button  onclick="get_delete_treat('."'".$record->id."'".');" style="margin-left:7px;" class="btn btn-danger btn-xs waves-effect text-center waves-light tooltips" data-placement="top" data-toggle="tooltip" id="delete" title="delete"><i class="fa fa-trash"></i></button>'; 
	
$data[] = array(
				"id" => $record->id,
				"temp_date" => $temp_date,
				"aviary_id" => $record->aviary_name,
				"aviary" => $record->aviary_id,
				"cage" => $record->cage,
				"bird_species" => $record->species_name,
				"species_id" => $record->bird_species,
				"egg_no" => $record->eegring_no,
				"division" => $record->division,
				"age" => $record->age,
				"sex" => $record->sex,
				"therapy_schedule" =>$record->therapy_schedule,
				"anamnesis" => $record->anamnesis,

				"body_weight" => $record->body_weight,
				"bcs" => $record->bcs,
				"physical_examination" => $record->physical_examination,
				"samples_collected" => $record->samples_collected,
				"lab_diagnostics" => $record->lab_diagnostics,
				"inferences" => $record->inferences,
				"medication_details" => $record->medication_details,
				"action" => $action,
				
			//	"egg_p" => $egg_p,
			
			);
		
	}
	
		$response = array(
			"draw" => intval($draw),
			"iTotalRecords" => $totalRecords,
			"iTotalDisplayRecords" => $totalRecordwithFilter,
			"aaData" => $data
		);

		return $response;
	}

/*************SHELL REGISTER DETAILS START **************************************************/

public function shell_register_get($postData,$date,$to_date,$aviary_id,$cage_id,$ring,$sp)
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
		$search_arr[] = " (at.cage like '%" . $searchValue . "%' or 
		s.bird_species like '%" . $searchValue . "%' or 
		a.aviary_name like '%" . $searchValue . "%' ) ";
	}

	if (count($search_arr) > 0) {
		$searchQuery = implode(" and ", $search_arr);
	}

	//# Total number of records without filtering
	$this->db->select('count(*) as allcount');
	$this->db->from('ckb_healthcare_shell at');
	$this->db->join('ckb_species as s', 'at.bird_species = s.auto_id');
	$this->db->join('ckb_aviary as a', 'at.aviary_id = a.auto_id');
	if ($date != '' && $to_date == '' ) $this->db->where('at.shell_date', $date);
	$condition = "at.shell_date BETWEEN " . "'" . $date . "'" . " AND " . "'" . $to_date . "'";
	if ($date != '' && $to_date != ''  ) $this->db->where($condition);
	 if ($aviary_id != '') $this->db->where('at.aviary_id' , $aviary_id);
	 if ($cage_id != '') $this->db->where('at.cage' , $cage_id);
	 if ($sp != '') $this->db->where('at.bird_species' , $sp);
	 if ($ring != '') $this->db->where('at.egg_no' , $ring);
	if ($searchQuery != '') $this->db->where($searchQuery);
	$this->db->where('at.branch_id',$branch_id);
	$this->db->where('at.static_status',1);

	// $this->db->where($postData_where);

	$records = $this->db->get()->result();

	$totalRecords = $records[0]->allcount;

	
	//# Total number of record with filtering
	$this->db->select('count(*) as allcount');
	$this->db->from('ckb_healthcare_shell at');
	$this->db->join('ckb_species as s', 'at.bird_species = s.auto_id');
	$this->db->join('ckb_aviary as a', 'at.aviary_id = a.auto_id');
	if ($date != '' && $to_date == '' ) $this->db->where('at.shell_date', $date);
	$condition = "at.shell_date BETWEEN " . "'" . $date . "'" . " AND " . "'" . $to_date . "'";
	if ($date != '' && $to_date != ''  ) $this->db->where($condition);
	 if ($aviary_id != '') $this->db->where('at.aviary_id' , $aviary_id);
	 if ($cage_id != '') $this->db->where('at.cage' , $cage_id);
	 if ($sp != '') $this->db->where('at.bird_species' , $sp);
	 if ($ring != '') $this->db->where('at.egg_no' , $ring);
	if ($searchQuery != '') $this->db->where($searchQuery);
	$this->db->where('at.branch_id',$branch_id);
	$this->db->where('at.static_status',1);
	//   $this->db->where($postData_where);

	$records = $this->db->get()->result();

	$totalRecordwithFilter = $records[0]->allcount;

	//# Fetch records
	$this->db->select(
		'at.*,s.bird_species as bird_species,a.aviary_name as aviary_name'
	);

	$this->db->from('ckb_healthcare_shell at');
	$this->db->join('ckb_species as s', 'at.bird_species = s.auto_id');
	$this->db->join('ckb_aviary as a', 'at.aviary_id = a.auto_id');
	if ($date != '' && $to_date == '' ) $this->db->where('at.shell_date', $date);
	$condition = "at.shell_date BETWEEN " . "'" . $date . "'" . " AND " . "'" . $to_date . "'";
	if ($date != '' && $to_date != ''  ) $this->db->where($condition);
	 if ($aviary_id != '') $this->db->where('at.aviary_id' , $aviary_id);
	 if ($cage_id != '') $this->db->where('at.cage' , $cage_id);
	 if ($sp != '') $this->db->where('at.bird_species' , $sp);
	 if ($ring != '') $this->db->where('at.egg_no' , $ring);
	if ($searchQuery != '') $this->db->where($searchQuery);
	$this->db->where('at.branch_id',$branch_id);
	$this->db->where('at.static_status',1);
	//   $this->db->where($postData_where);
	$this->db->order_by('at.id', 'desc');  // or desc

	$this->db->limit($rowperpage, $start);

	$records = $this->db->get()->result();

	$data = array();

	foreach ($records as $record) {
	
	
//# Response
		
$action ='<button  onclick="get_parents_history('."'".$record->mp_ring."'".','."'".$record->fp_ring."'".')"  class="btn btn-purple waves-effect waves-light" id="btnSave"><i class="fa fa-eye" aria-hidden="true"></i></button><br><br>';                                                      
$action .='<button  onclick="get_bos_video('."'".$record->video_bos."'".')"  class="btn btn-success waves-effect waves-light" id="btnSave"><i class="fa fa-play" aria-hidden="true"></i></button>';                                                      
$action .= '<button  onclick="get_delete_shell('."'".$record->id."'".');" style="margin-left:7px; margin-top:5px;" class="btn btn-danger btn-xs waves-effect text-center waves-light tooltips" data-placement="top" data-toggle="tooltip" id="delete" title="delete"><i class="fa fa-trash"></i></button>'; 

	
			
$shell_date = date("d-m-Y", strtotime($record->shell_date));
$dis_date = date("d-m-Y", strtotime($record->dis_date));
$bos_date = date("d-m-Y", strtotime($record->bos_date));
	  
$data[] = array(
			"id" => $record->id,
			"shell_date" => $shell_date,
			"aviary_id" => $record->aviary_name,
			"cage" => $record->cage,
			"bird_species" => $record->bird_species,
			"egg_no" => $record->egg_no,
			"dis_date" => $dis_date,
			"bos_date" => $bos_date,
			"mp_ring" => $record->mp_ring,
			"fp_ring" => $record->fp_ring,
			"egg_weight" =>$record->egg_weight,
			"std_egg_weight" => $record->std_egg_weight,

			"egg_shell_weight" => $record->egg_shell_weight,
			"egg_shell_thick" => $record->egg_shell_thick,
			"clutch_no" => $record->clutch_no,
			"egg_no_clutch" => $record->egg_no_clutch,
			"egg_lb" => $record->egg_lb,
			"membrane_integrity" => $record->membrane_integrity,
			"edema" => $record->edema,
			"hemo" => $record->hemo,
			"yolk" =>$record->yolk,
			"dis_type" => $record->dis_type,
			"inference" => $record->inference,
			"action" => $action,
			
		
		);
	
}

	$response = array(
		"draw" => intval($draw),
		"iTotalRecords" => $totalRecords,
		"iTotalDisplayRecords" => $totalRecordwithFilter,
		"aaData" => $data
	);

	return $response;
}
/*************MORT REGISTER DETAILS START **************************************************/
	
public function mort_register_get($postData,$egg_no)
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
			$search_arr[] = " (mt.cage like '%" . $searchValue . "%' or 
            s.bird_species like '%" . $searchValue . "%' or 
            a.aviary_name like '%" . $searchValue . "%' ) ";
		}

		if (count($search_arr) > 0) {
			$searchQuery = implode(" and ", $search_arr);
		}

        //# Total number of records without filtering
		$this->db->select('count(*) as allcount');
		$this->db->from('ckb_healthcare_mort mt');
		// $this->db->join('ckb_species as s', 'mt.bird_species = s.auto_id');
		// $this->db->join('ckb_aviary as a', 'mt.aviary_id = a.auto_id');
		// if ($date != '' && $to_date == '' ) $this->db->where('mt.mort_date', $date);
		// $condition = "mt.mort_date BETWEEN " . "'" . $date . "'" . " AND " . "'" . $to_date . "'";
		// if ($date != '' && $to_date != ''  ) $this->db->where($condition);
		//  if ($aviary_id != '') $this->db->where('mt.aviary_id' , $aviary_id);
		//  if ($cage_id != '') $this->db->where('mt.cage' , $cage_id);
		//  if ($sp != '') $this->db->where('mt.bird_species' , $sp);
		// if ($ring != '') $this->db->where('mt.egg_no' , $ring);
		$this->db->where('mt.egg_no' , $egg_no);
		if ($searchQuery != '') $this->db->where($searchQuery);
		$this->db->where('mt.branch_id',$branch_id);
		$this->db->where('mt.static_status',1);


        // $this->db->where($postData_where);

		$records = $this->db->get()->result();

		$totalRecords = $records[0]->allcount;

		
        //# Total number of record with filtering
		$this->db->select('count(*) as allcount');
		$this->db->from('ckb_healthcare_mort mt');
		// $this->db->join('ckb_species as s', 'mt.bird_species = s.auto_id');
		// $this->db->join('ckb_aviary as a', 'mt.aviary_id = a.auto_id');
		// if ($date != '' && $to_date == '' ) $this->db->where('mt.mort_date', $date);
		// $condition = "mt.mort_date BETWEEN " . "'" . $date . "'" . " AND " . "'" . $to_date . "'";
		// if ($date != '' && $to_date != ''  ) $this->db->where($condition);
		//  if ($aviary_id != '') $this->db->where('mt.aviary_id' , $aviary_id);
		//  if ($cage_id != '') $this->db->where('mt.cage' , $cage_id);
		//  if ($sp != '') $this->db->where('mt.bird_species' , $sp);
		//  if ($ring != '') $this->db->where('mt.egg_no' , $ring);
		 $this->db->where('mt.egg_no' , $egg_no);
		if ($searchQuery != '') $this->db->where($searchQuery);
		$this->db->where('mt.branch_id',$branch_id);
		$this->db->where('mt.static_status',1);

		//   $this->db->where($postData_where);

		$records = $this->db->get()->result();

		$totalRecordwithFilter = $records[0]->allcount;

        //# Fetch records
		$this->db->select(
			'mt.*'
		);
	
		$this->db->from('ckb_healthcare_mort mt');
		// $this->db->join('ckb_species as s', 'mt.bird_species = s.auto_id');
		// $this->db->join('ckb_aviary as a', 'mt.aviary_id = a.auto_id');
		// if ($date != '' && $to_date == '' ) $this->db->where('mt.mort_date', $date);
		// $condition = "mt.mort_date BETWEEN " . "'" . $date . "'" . " AND " . "'" . $to_date . "'";
		// if ($date != '' && $to_date != ''  ) $this->db->where($condition);
		//  if ($aviary_id != '') $this->db->where('mt.aviary_id' , $aviary_id);
		//  if ($cage_id != '') $this->db->where('mt.cage' , $cage_id);
		//  if ($sp != '') $this->db->where('mt.bird_species' , $sp);
		//  if ($ring != '') $this->db->where('mt.egg_no' , $ring);
		 $this->db->where('mt.egg_no' , $egg_no);
		 $this->db->where('mt.branch_id',$branch_id);
		 $this->db->where('mt.static_status',1);


		if ($searchQuery != '') $this->db->where($searchQuery);

		//   $this->db->where($postData_where);
		$this->db->order_by('mt.id', 'desc');  // or desc

		$this->db->limit($rowperpage, $start);

		$records = $this->db->get()->result();

		$data = array();

		foreach ($records as $record) {
		
	//$action_url = base_url()."index.php/Healthcare/edit_mort/".$record->auto_id;			
//action ='<a href="'.$action_url.'"><button class="btn btn-pink btn-xs waves-effect text-center waves-light tooltips" data-placement="top" data-toggle="tooltip" id="update" title="Update weaning Details"><i class="fa fa-plus" aria-hidden="true"></i></button></a></td>';
$action ='<button  onclick="get_mort_video('."'".$record->video_mort."'".')"  style = "margin-top:5px;"  class="btn btn-success waves-effect waves-light" id="btnSave"><i class="fa fa-play" aria-hidden="true"></i></button>';                                                      
$action .= '<button  onclick="get_delete_mort('."'".$record->id."'".');" style = "margin-top:5px;" class="btn btn-danger btn-xs waves-effect text-center waves-light tooltips" data-placement="top" data-toggle="tooltip" id="delete" title="delete"><i class="fa fa-trash"></i></button>'; 

				
	$mort_date = date("d-m-Y", strtotime($record->mort_date));
      	
$data[] = array(
				"id" => $record->id,
				"mort_date" => $mort_date,
				//"aviary_id" => $record->aviary_name,
				"aviary" => $record->aviary_id,
				"cage" => $record->cage,
			//	"bird_species" => $record->species_name,
				"species_id" => $record->bird_species,
				"egg_no" => $record->egg_no,
				"division" => $record->division,
				"age" => $record->age,
				"sex" => $record->sex,
				"history" =>$record->history,
				"carcass_weight" => $record->carcass_weight,
				"bcs" => $record->bcs,
				"pm_lesions" => $record->pm_lesions,
				"tentative_diagnosis" => $record->tentative_diagnosis,
				"confirmative_diagnosis" => $record->confirmative_diagnosis,
				"cause_categorization" => $record->cause_categorization,
				//"medication_details" => $record->medication_details,
				"action" => $action,
				
			//	"egg_p" => $egg_p,
			
			);
		
	}
	
		$response = array(
			"draw" => intval($draw),
			"iTotalRecords" => $totalRecords,
			"iTotalDisplayRecords" => $totalRecordwithFilter,
			"aaData" => $data
		);

		return $response;
	}
}//end class

