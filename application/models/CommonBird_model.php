<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CommonBird_model extends CI_Model
{
	function count_menu($array, $table)
	{
		$this->db->where($array);
		$this->db->select('*');
		$records = $this->db->get($table);
		$records1 = $records->num_rows();

		return $records1;
	}
   function get_all_data($array, $table){
	$this->db->select('*');
	$this->db->from($table);
	$this->db->where($array); 
	$this->db->order_by('id','desc');
	$query = $this->db->get();
	    return $query->result();

   }
	function verify_data($array, $table)
	{
		$this->db->where($array);
		$records = $this->db->get($table);
		return $records->result();
	}

	function verify_data_join_one($array, $table, $join_table, $join_tb_cond, $select)
	{
		$this->db->where($array);
		$this->db->select($select);
		$this->db->join($join_table, $join_tb_cond);
		$records = $this->db->get($table);
		$records1 = $records->result();

		return $records1;
	}
	public function count_items($array, $table)
	{
		$this->db->where($array);
		$this->db->select('*');
		$records = $this->db->get($table);
		$records1 = $records->num_rows();

		return $records1;
	}
	public function data_add($table, $val)
	{
		$this->db->insert($table, $val);
		$message = "success";
		return $message;
	}

	public function cur_auto_id($table)
	{
		$this->db->select('MAX(id) AS `maxid`');
		$records = $this->db->get($table);
		$query = $records->row();

		if ($query) {
			return $maxid = $query->maxid;
		}
		else{
			return "false";
		}
	}
	public function get_birdcount_avBYcage($aviary,$cage){
	$branch_id = $this->session->userdata('branch_id');
	$this->db->select('count(*) as bird_count');
	$this->db->from('ckb_bird');
	$this->db->where('aviary_id',$aviary);
	$this->db->where('cage_id',$cage);
	$this->db->where('branch_id',$branch_id);
	$wh_not_in  =array('Sale','Mortality');
	$this->db->where_not_in('bird_status',$wh_not_in);
	$records = $this->db->get()->result();
	$bird_count = $records[0]->bird_count;
	return $bird_count;
	}
   public function get_birdspecies_dt($data_where){
	$this->db->select('b.*,cs.*');
	$this->db->from('ckb_bird b');
	$this->db->join('ckb_species cs', 'cs.auto_id = b.species_id', 'left'); 
	//$this->db->group_by("b.species_id");
	$this->db->where($data_where); 

	$query = $this->db->get();
	return $query->result();

   }
   public function get_incubation_dt(){
	$this->db->select('i.*,cs.*');
	$this->db->from('ckb_incubation i');
	$this->db->join('ckb_species cs', 'cs.auto_id = i.species_id', 'left'); 
	//$this->db->group_by("b.species_id");
	$this->db->where('i.status',1); 

	$query = $this->db->get();
	return $query->result();

   }
   public function get_chicks_dt(){
	$branch_id = $this->session->userdata('branch_id');

	$this->db->select('i.*,cs.*');
	$this->db->from('ckb_incubation i');
	$this->db->join('ckb_species cs', 'cs.auto_id = i.species_id', 'left'); 
	//$data_where = array('i.status' => 0,'i.move_production_date' => '0000-00-00');
	$this->db->where('i.move_production_date','0000-00-00'); 
	$this->db->where('i.branch_id',$branch_id);
	$this->db->where_not_in('i.status',1); 

	$query = $this->db->get();
	return $query->result();

   }
   public function sale_history_det($m,$y,$fdate,$tdate){
	  
	//return $data_where;
	$branch_id = $this->session->userdata('branch_id');
	$this->db->select_sum('sale_cost');
	$this->db->select_sum('discrep_value');
	$this->db->select_sum('static_status');
	$this->db->select('month,year');
	$this->db->from('ckb_sales_update');
	if ($m != '') $this->db->where('month',$m);
	$condition = "date BETWEEN " . "'" . $fdate . "'" . " AND " . "'" . $tdate . "'";
	if ($fdate != '' && $tdate != ''  ) $this->db->where($condition);
	if ($y != '') $this->db->where('year',$y); 
	$this->db->where('branch_id',$branch_id);
	//$this->db->group_by('month,year');
	$query = $this->db->get();
	return $query->result();
	//return $fdate;
	


   }
   public function sale_history_3month($c_month,$prev_month,$pc_month,$c_year){
	  
	//return $data_where;
	$branch_id = $this->session->userdata('branch_id');

	$this->db->select_sum('sale_cost');
	$this->db->select_sum('discrep_value');
	$this->db->select_sum('static_status');
	$this->db->select('month,year');
	$this->db->from('ckb_sales_update');
	//if ($c_month != '') $this->db->where('month',$c_month);
	//$condition = "month BETWEEN " . "'" . $c_month . "'" . " AND " . "'" . $pc_month . "'";
	//if ($c_month != '' && $pc_month != ''  ) $this->db->where($condition);
	//if ($prev_month != '') $this->db->where('month',$prev_month);
//	if ($pc_month != '') $this->db->where('month',$pc_month);
	//if ($c_year != '') $this->db->where('year',$c_year); 
	$this->db->where('branch_id',$branch_id);
	$this->db->group_by('month,year');
	$query = $this->db->get();
	return $query->result();
	//return $c_month;
	


   }
   public function sale_history_month($m,$y){
	  
	//return $data_where;

	//$this->db->select_sum('sale_cost');
	//$this->db->select_sum('discrep_value');
    $this->db->select('month,year');
	$this->db->from('ckb_sales_update');
	if ($m != '') $this->db->where('month',$m);
	if ($y != '') $this->db->where('year',$y); 

	$query = $this->db->get();
	return $query->result();
	//return $year;
	


   }
   public function get_production_dt(){
	$branch_id = $this->session->userdata('branch_id');
	$this->db->select('i.*,cs.*,a.aviary_name as aviary_name');
	$this->db->from('ckb_bird i');
	$this->db->join('ckb_species cs', 'cs.auto_id = i.species_id', 'left'); 
	$this->db->join('ckb_aviary a', 'a.auto_id = i.aviary_id', 'left'); 
	//$data_where = array('i.status' => 0,'i.move_production_date' => '0000-00-00');
	$this->db->where('i.bird_status','Production'); 
	$this->db->where('i.branch_id',$branch_id);
	//$this->db->where_not_in('i.move_production_date','0000-00-00'); 

	$query = $this->db->get();
	return $query->result();

   }
   public function get_sales_dt(){
	$branch_id = $this->session->userdata('branch_id');

	$this->db->select('b.*,cs.*,a.aviary_name as aviary_name');
	$this->db->from('ckb_bird b');
	$this->db->join('ckb_species cs', 'cs.auto_id = b.species_id', 'left'); 
	$this->db->join('ckb_aviary a', 'a.auto_id = b.aviary_id', 'left'); 
	//$data_where = array('i.status' => 0,'i.move_production_date' => '0000-00-00');
	$this->db->where('b.bird_status','Sale'); 
	$this->db->where('b.branch_id',$branch_id);
	//$this->db->where_not_in('i.move_production_date','0000-00-00'); 

	$query = $this->db->get();
	return $query->result();

   }
   public function get_purchase_dt(){
	$branch_id = $this->session->userdata('branch_id');

	$this->db->select('b.*,cs.*,a.aviary_name as aviary_name');
	$this->db->from('ckb_bird b');
	$this->db->join('ckb_species cs', 'cs.auto_id = b.species_id', 'left'); 
	$this->db->join('ckb_aviary a', 'a.auto_id = b.aviary_id', 'left'); 
	//$data_where = array('i.status' => 0,'i.move_production_date' => '0000-00-00');
	$this->db->where('b.bird_status','Purchase'); 
	$this->db->where('b.branch_id',$branch_id);

	//$this->db->where_not_in('i.move_production_date','0000-00-00'); 

	$query = $this->db->get();
	return $query->result();

   }

    public function excel_download_mat(){
		$branch_id = $this->session->userdata('branch_id');
		$this->db->select('b.*,a.aviary_name as aviary_name,g.group_name as group_name,s.bird_species as species_name');
		$this->db->from('ckb_bird b');
		$this->db->join('ckb_aviary a', 'a.auto_id = b.aviary_id'); 
		$this->db->join('ckb_group g', 'g.auto_id = b.group_id'); 
		$this->db->join('ckb_species s', 's.auto_id = b.species_id'); 
		$this->db->group_by("b.aviary_id,b.group_id,b.species_id");
		$this->db->where('b.branch_id',$branch_id);
		$query = $this->db->get();
	    return $query->result();
      }
	  public function get_birdspecies_ringbycage($status,$species_id,$cage_id,$aviary_id){
		$branch_id = $this->session->userdata('branch_id');
		$this->db->select('b.*');
		$this->db->from('ckb_bird b');
		$data_where = array('b.status' => $status, 'b.species_id' => $species_id,'b.cage_id' => $cage_id,'b.aviary_id' => $aviary_id);
		$this->db->where($data_where); 
		$this->db->where('b.branch_id',$branch_id);
		//$this->db->group_by("b.group_id");
		$this->db->order_by('b.id','desc');
		$query = $this->db->get();
		return $query->result();
	
	   }
	   public function get_birdspecies_eggno($species_id,$cage_id,$aviary_id){
		$branch_id = $this->session->userdata('branch_id');

		$this->db->select('i.*');
		$this->db->from('ckb_incubation i');
		$data_where = array('i.species_id' => $species_id,'i.cage' => $cage_id,'i.aviary_id' => $aviary_id);
		$this->db->where($data_where); 
		$this->db->where('i.branch_id',$branch_id);

		//$this->db->group_by("b.group_id");
		$this->db->order_by('i.id','desc');
		$query = $this->db->get();
		return $query->result();
	
	   }
	   public function get_birdspecies_mort_eggno($species_id,$cage_id,$aviary_id){
		$branch_id = $this->session->userdata('branch_id');

		$this->db->select('i.egg_no');
		$this->db->from('ckb_incubation i');
		$data_where = array('i.species_id' => $species_id,'i.cage' => $cage_id,'i.aviary_id' => $aviary_id);
		$this->db->where($data_where); 
		$this->db->where('i.health_status','Mortality'); 
		$this->db->where('i.branch_id',$branch_id);
		$query1 = $this->db->get_compiled_select();

		$this->db->select('b.ring_no');
		$this->db->from('ckb_bird b');
		$data_where = array('b.cage_id' => $cage_id,'b.aviary_id' => $aviary_id);
		$this->db->where($data_where); 
		$this->db->where('b.bird_status','Mortality'); 
		$this->db->where('b.branch_id',$branch_id);

		$query2 = $this->db->get_compiled_select();
	 
		$final_query = $this->db->query($query1 . ' UNION ' . $query2);
	
		 $records = $final_query->result_array(); 
		 return $records;
		// //$this->db->group_by("b.group_id");
		// $this->db->order_by('i.id','desc');
		// $query = $this->db->get();
		return $query->result();
	
	   }
	   public function get_birdspecies_eggandring($status,$cage_id,$aviary_id){
		$branch_id = $this->session->userdata('branch_id');

		$this->db->select('i.species_id');
		$this->db->from('ckb_incubation i');
		$data_where = array('i.cage' => $cage_id,'i.aviary_id' => $aviary_id);
		$this->db->where($data_where); 
		$this->db->where_not_in('i.health_status','Mortality'); 
		$this->db->where('i.branch_id',$branch_id);

		$query1 = $this->db->get_compiled_select();


		$this->db->select('b.species_id');
		$this->db->from('ckb_bird b');
		$data_where = array('b.cage_id' => $cage_id,'b.aviary_id' => $aviary_id);
		$this->db->where($data_where); 
		$this->db->where_not_in('b.bird_status','Mortality'); 
		$this->db->where('b.branch_id',$branch_id);

		$query2 = $this->db->get_compiled_select();
	 
		$final_query = $this->db->query($query1 . ' UNION ' . $query2);
	
		 $records = $final_query->result_array(); 
		 return $records;
	
	
	
	   }
	   public function get_mortality_species($status,$cage_id,$aviary_id){
		$branch_id = $this->session->userdata('branch_id');

		$this->db->select('i.species_id');
		$this->db->from('ckb_incubation i');
		$data_where = array('i.cage' => $cage_id,'i.aviary_id' => $aviary_id);
		$this->db->where($data_where); 
		$this->db->where_not_in('i.health_status','Mortality'); 
		$this->db->where('i.branch_id',$branch_id);

		$query1 = $this->db->get_compiled_select();


		$this->db->select('b.species_id');
		$this->db->from('ckb_bird b');
		$data_where = array('b.cage_id' => $cage_id,'b.aviary_id' => $aviary_id);
		$this->db->where($data_where); 
		$this->db->where_not_in('b.bird_status','Mortality'); 
		$this->db->where('b.branch_id',$branch_id);

		$query2 = $this->db->get_compiled_select();
	 
		$final_query = $this->db->query($query1 . ' UNION ' . $query2);
	
		 $records = $final_query->result_array(); 
		 return $records;
	
	
	
	   }
	   public function get_speciesname_eggandring($status,$cage_id,$aviary_id){
		$branch_id = $this->session->userdata('branch_id');
		$this->db->select('i.species_id,s.bird_species,s.auto_id');
		$this->db->from('ckb_incubation i');
		$this->db->join('ckb_species s', 's.auto_id = i.species_id'); 
		$data_where = array('i.cage' => $cage_id,'i.aviary_id' => $aviary_id);
		$this->db->where($data_where); 
		$this->db->where('i.branch_id',$branch_id);

		$this->db->group_by("i.species_id");
		//$this->db->order_by('i.id','desc');
		$query1 = $this->db->get_compiled_select();

		//$query1 = $this->db->get();
		//$query1 = $query1->result();

		$this->db->select('b.species_id,s.bird_species,s.auto_id');
		$this->db->from('ckb_bird b');
		$this->db->join('ckb_species s', 's.auto_id = b.species_id'); 
		$data_where = array('b.cage_id' => $cage_id,'b.aviary_id' => $aviary_id);
		$this->db->where($data_where); 
		$this->db->where('b.branch_id',$branch_id);

		$this->db->group_by("b.species_id");
	//	$this->db->order_by('b.id','desc');
		$query2 = $this->db->get_compiled_select();
	  // $query2 = $this->db->get();
	  // $query2 = $query1->result();
		$final_query = $this->db->query($query1 . ' UNION ' . $query2);
	
		 $records = $final_query->result_array(); 
		 return $records;
	
		//return $query->result();
	
	   }
	   public function get_eggandring_no($species_id,$cage_id,$aviary_id){
		$branch_id = $this->session->userdata('branch_id');
		$this->db->select('i.egg_no as sp');
		$this->db->from('ckb_incubation i');
		$data_where = array('i.cage' => $cage_id,'i.aviary_id' => $aviary_id,'i.species_id' => $species_id);
		$this->db->where($data_where); 
		$this->db->where_not_in('i.health_status','Mortality'); 
		$this->db->where('i.branch_id',$branch_id);
		$query1 = $this->db->get_compiled_select();


		$this->db->select('b.ring_no as sp');
		$this->db->from('ckb_bird b');
		$data_where = array('b.cage_id' => $cage_id,'b.aviary_id' => $aviary_id,'b.species_id' => $species_id);
		$this->db->where($data_where); 
		$this->db->where_not_in('b.bird_status','Mortality'); 
		$this->db->where('b.branch_id',$branch_id);
		$query2 = $this->db->get_compiled_select();
	 
		$final_query = $this->db->query($query1 . ' UNION ' . $query2);
	
		 $records = $final_query->result_array(); 
		 return $records;
	
		
	
	   }
   public function get_birdspecies_ring($status,$species_id,$group_id,$aviary_id){
	$branch_id = $this->session->userdata('branch_id');
	$this->db->select('b.*');
	$this->db->from('ckb_bird b');
	$data_where = array('b.status' => $status, 'b.species_id' => $species_id,'b.group_id' => $group_id,'b.aviary_id' => $aviary_id);
	$this->db->where($data_where); 
	$this->db->where('b.branch_id',$branch_id);

	//$this->db->group_by("b.group_id");
	$this->db->order_by('b.id','desc');
	$query = $this->db->get();
	return $query->result();

   }
   public function get_birdgroup_dt($status,$aviary_id ){
	$branch_id = $this->session->userdata('branch_id');
	
	$this->db->select('b.*,g.*');
	$this->db->from('ckb_bird b');
	$this->db->join('ckb_group g', 'g.auto_id = b.group_id', 'left'); 
	$data_where = array('b.status' => $status, 'b.aviary_id' => $aviary_id);
	$this->db->where($data_where); 
	$this->db->where('b.branch_id',$branch_id);

	$this->db->group_by("b.group_id");
	$this->db->order_by('b.id','desc');
	$query = $this->db->get();
	return $query->result();

   }
   public function get_bird_species($status,$group_id,$aviary_id){
	$branch_id = $this->session->userdata('branch_id');
	$this->db->select('b.*,s.*');
	$this->db->from('ckb_bird b');
	$this->db->join('ckb_species s', 's.auto_id = b.species_id', 'left'); 
	$data_where = array('b.status' => $status, 'b.group_id' => $group_id,'b.aviary_id' => $aviary_id);
	$this->db->where($data_where); 
	$this->db->where('b.branch_id',$branch_id);

	$this->db->group_by("b.species_id");
	$this->db->order_by('b.id','desc');
	$query = $this->db->get();
	return $query->result();

   }
   public function get_material_type($aviary_id,$group_id,$species_id ){
	$branch_id = $this->session->userdata('branch_id');
	$this->db->select('im.*');
	$this->db->from('ckb_materials_import im');
	//$this->db->join('ckb_species s', 's.bird_species = im.species_id', 'left'); 
	$data_where = array('im.aviary_id' => $aviary_id, 'im.group_id' => $group_id,'im.species_id' => $species_id);
	$this->db->where($data_where); 
	$this->db->where('im.branch_id',$branch_id);

	$this->db->group_by("im.actual_type");
	$this->db->order_by('im.id','desc');
	$query = $this->db->get();
	return $query->result();

   }

   public function get_birdsjoin_dt($data_where){
	$this->db->select(
		'b.*,i.*,b.created_on as bird_date,i.created_on as incub_date,i.auto_id as incub_id,g.group_name as group_name,s.bird_species as bird_species,a.aviary_name as aviary_name,u.user_name as user_name, bn.brooder_name as brooder_name,m.move_handfeed_date as move_handfeed_date,
		m.move_handfeed_brooder as move_handfeed_brooder,m.move_35_date as move_35_date,m.move_34_date as move_34_date,m.move_33_date as move_33_date,m.status as move_status,pw.age as pw_age,pw.std_weight as pw_weight,pw.status as pw_status,
		w.age as w_age,w.std_weight as w_weight,pw.status as w_status'
	);
	$this->db->from('ckb_bird b');
	$this->db->join('ckb_group as g', 'b.group_id = g.auto_id');
	$this->db->join('ckb_species as s', 'b.species_id = s.auto_id');
	$this->db->join('ckb_aviary as a', 'b.aviary_id = a.auto_id');
	$this->db->join('ckb_users as u', 'b.created_by = u.user_id');
	$this->db->join('ckb_incubation as i', 'b.ring_no = i.weaning_ring_no','right');
	$this->db->join('ckb_preweaning as pw', 'i.auto_id = pw.incub_id');
	$this->db->join('ckb_weaning as w', 'i.auto_id = w.incub_id');
	$this->db->join('ckb_move_brooder as m', 'i.auto_id = m.incub_id');
	$this->db->join('ckb_brooder as bn', 'm.move_handfeed_brooder = bn.auto_id');
    $this->db->where('b.auto_id',$data_where);
	$query = $this->db->get();
	return $query->result();

   }

   public function get_incubation_join_dt($ring_no){
	$this->db->select(
		'i.*,pw.*,w.*,g.group_name as group_name,s.bird_species as bird_species,s.days_brooder as days_brooder,a.aviary_name as aviary_name,u.user_name as user_name, b.brooder_name as brooder_name,m.move_handfeed_date as move_handfeed_date,
		m.move_handfeed_brooder as move_handfeed_brooder,m.move_35_date as move_35_date,m.move_34_date as move_34_date,m.move_33_date as move_33_date,m.status as move_status'
	);
	$this->db->from('ckb_incubation i');
	$this->db->join('ckb_group as g', 'i.group_id = g.auto_id');
	$this->db->join('ckb_species as s', 'i.species_id = s.auto_id');
	$this->db->join('ckb_aviary as a', 'i.aviary_id = a.auto_id');
	$this->db->join('ckb_users as u', 'i.created_by = u.user_id');
	$this->db->join('ckb_preweaning as pw', 'i.auto_id = pw.incub_id');
	$this->db->join('ckb_weaning as w', 'i.auto_id = w.incub_id');
	$this->db->join('ckb_move_brooder as m', 'i.auto_id = m.incub_id');
	$this->db->join('ckb_brooder as b', 'm.move_handfeed_brooder = b.auto_id');
	//$array_where = array('i.status' => 0, 'i.weaning_ring_no' => $ring_no);
	$this->db->where('i.weaning_ring_no', $ring_no);
   //  $this->db->where($array_where);
	$query = $this->db->get();
	return $query->result();

   }
   public function get_bird_history_dt($date,$to_date){
	$branch_id = $this->session->userdata('branch_id');
	$this->db->select('count(*) as total_birds');
	$this->db->from('ckb_bird');
	$condition = "created_on BETWEEN " . "'" . $date . "'" . " AND " . "'" . $to_date . "'";
	if ($date != '' && $to_date != ''  ) $this->db->where($condition);
	$this->db->where('branch_id',$branch_id);
	$this->db->where('status','1');
	$records = $this->db->get()->result();
	// print_r($this->db->last_query());die;
	$total_birds = $records[0]->total_birds;


	$this->db->select('count(*) as mort');
	$this->db->from('ckb_bird');
	$condition = "created_on BETWEEN " . "'" . $date . "'" . " AND " . "'" . $to_date . "'";
	if ($date != '' && $to_date != ''  ) $this->db->where($condition);
	$this->db->where('bird_status','Mortality');
	$this->db->where('branch_id',$branch_id);
	$records = $this->db->get()->result();
	$mort = $records[0]->mort;

	$this->db->select('count(*) as sale');
	$this->db->from('ckb_bird');
	$condition = "created_on BETWEEN " . "'" . $date . "'" . " AND " . "'" . $to_date . "'";
	if ($date != '' && $to_date != ''  ) $this->db->where($condition);
	$this->db->where('bird_status','Sale');
	$this->db->where('branch_id',$branch_id);
	$records = $this->db->get()->result();
	$sale = $records[0]->sale;

	$this->db->select('count(*) as purchase');
	$this->db->from('ckb_bird');
	$condition = "created_on BETWEEN " . "'" . $date . "'" . " AND " . "'" . $to_date . "'";
	if ($date != '' && $to_date != ''  ) $this->db->where($condition);
	$this->db->where('bird_status','Purchase');
	$this->db->where('branch_id',$branch_id);
	$records = $this->db->get()->result();
	$purchase = $records[0]->purchase;

	$this->db->select('count(*) as semi_adult');
	$this->db->from('ckb_bird');
	$condition = "created_on BETWEEN " . "'" . $date . "'" . " AND " . "'" . $to_date . "'";
	if ($date != '' && $to_date != ''  ) $this->db->where($condition);
	$this->db->where('proven','Semi adult');
	$this->db->where('branch_id',$branch_id);
	$records = $this->db->get()->result();
	$semi_adult = $records[0]->semi_adult;

	$this->db->select('count(*) as proven');
	$this->db->from('ckb_bird');
	$condition = "created_on BETWEEN " . "'" . $date . "'" . " AND " . "'" . $to_date . "'";
	if ($date != '' && $to_date != ''  ) $this->db->where($condition);
	$this->db->where('proven','Proven');
	$this->db->where('branch_id',$branch_id);
	$records = $this->db->get()->result();
	$proven = $records[0]->proven;

	$this->db->select('count(*) as non_proven');
	$this->db->from('ckb_bird');
	$condition = "created_on BETWEEN " . "'" . $date . "'" . " AND " . "'" . $to_date . "'";
	if ($date != '' && $to_date != ''  ) $this->db->where($condition);
	$this->db->where('proven','Non proven');
	$this->db->where('branch_id',$branch_id);
	$records = $this->db->get()->result();
	$non_proven = $records[0]->non_proven;

	$this->db->select('count(*) as other_branch');
	$this->db->from('ckb_bird');
	$condition = "created_on BETWEEN " . "'" . $date . "'" . " AND " . "'" . $to_date . "'";
	if ($date != '' && $to_date != ''  ) $this->db->where($condition);
	$this->db->where('old_branch_id',$branch_id);
	$records = $this->db->get()->result();
	$other_branch = $records[0]->other_branch;

	$data[] = array(
		"total_birds" => $total_birds,	
		"mort" => $mort,	
		"sale" => $sale,	
		"purchase" =>$purchase,
		"semi_adult" => $semi_adult,
		"proven" => $proven,
		"non_proven" => $non_proven,
		"other_branch" => $other_branch

	);
	return $data;
   }




public function get_other_branch_birds(){
	$branch_id = $this->session->userdata('branch_id');
	$this->db->select(
		'b.*,g.group_name as group_name,s.bird_species as bird_species,a.aviary_name as aviary_name,u.user_name as user_name,br.branch_name as branch_name'
	);
	$this->db->from('ckb_bird b');
	$this->db->join('ckb_group as g', 'b.group_id = g.auto_id');
	$this->db->join('ckb_species as s', 'b.species_id = s.auto_id');
	$this->db->join('ckb_aviary as a', 'b.aviary_id = a.auto_id');
	$this->db->join('ckb_users as u', 'b.created_by = u.user_id');
	$this->db->join('ckb_branch as br', 'b.branch_id = br.auto_id');
	$this->db->where('b.old_branch_id',$branch_id);
	$query = $this->db->get();
	return $query->result();

}




	public function verify_data_bird_dt($postData)
	{
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
		$this->db->where('b.status','1');
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
		$this->db->where('b.status','1');
		$wh_not_in  =array('Sale','Mortality');
		$this->db->where_not_in('b.bird_status',$wh_not_in);
		if ($searchQuery != '') $this->db->where($searchQuery);

		//   $this->db->where($postData_where);

		$records = $this->db->get()->result();

		$totalRecordwithFilter = $records[0]->allcount;

        //# Fetch records
		$this->db->select(
			'b.*,g.group_name as group_name,s.bird_species as bird_species,a.aviary_name as aviary_name,u.user_name as user_name'
		);
		$this->db->from('ckb_bird b');
		$this->db->join('ckb_group as g', 'b.group_id = g.auto_id');
		$this->db->join('ckb_species as s', 'b.species_id = s.auto_id');
		// $this->db->join('ckb_cage as c', 'b.cage_id = c.auto_id');
		$this->db->join('ckb_aviary as a', 'b.aviary_id = a.auto_id');
		$this->db->join('ckb_users as u', 'b.created_by = u.user_id');
		$this->db->where('b.branch_id',$branch_id);
		$this->db->where('b.status','1');
		$wh_not_in  =array('Sale','Mortality');
		$this->db->where_not_in('b.bird_status',$wh_not_in);
		if ($searchQuery != '') $this->db->where($searchQuery);

		//   $this->db->where($postData_where);
		$this->db->order_by('b.id', 'desc');  // or desc

		$this->db->limit($rowperpage, $start);

		$records = $this->db->get()->result();

		$data = array();

		foreach ($records as $record) {
			$timedate1 = strtotime(date("Y-m-d", strtotime($record->created_on)));
			$created_on = date("d-m-Y", $timedate1);

		/*	if ($record->status == 0) {
				$status = '<span class="label label-warning">Inactive</span>';
			} else {
				$status = '<span class="label label-success">Active</span>';
			}
			*/
      $action_url1 = base_url()."index.php/Bird/edit_bird/".$record->auto_id;
      $image_url = base_url()."index.php/Execution/upload_brid_image";
	  $video_url = base_url()."index.php/Execution/upload_brid_video";


			$action = '<a href="'.$action_url1.'" class="btn btn-info btn-xs waves-effect waves-light tooltips" data-trigger="hover"
      data-placement="top" data-toggle="tooltip" title="Edit"><i class="fa fa-pencil-square-o" id="editBtn"></i></a>';
			
      $action .= '<button  onclick="get_delete_pop('."'".$record->auto_id."'".');" class="btn btn-danger btn-xs waves-effect waves-light tooltips" data-placement="top" data-toggle="tooltip" id="birdDeletebtn" title="Delete"><i class="fa fa-close"></i></button></br>';
	  $action .= '<button  onclick="change_branch('."'".$record->ring_no."'".','."'".$record->branch_id."'".');"style = "margin-top: 5px;" class="btn btn-warning btn-xs waves-effect waves-light tooltips" data-placement="top" data-toggle="tooltip" id="changeBranch" title="Change branch"><i class="fa fa-exchange"></i></button>';

	
	  $status = '<button  onclick="get_move_status('."'".$record->auto_id."'".');" class="btn btn-success btn-xs waves-effect waves-light tooltips" style="margin-top:5px;" data-placement="top" data-toggle="tooltip" id="move" title="Move to Handfeeding"><i class="fa fa-exchange" aria-hidden="true"></i></button>';
	 $upload =' <div class="row">
	 <div class="col-md-4">
	  <div class="form-group"> 
	 <form method="post" action="'.$image_url.'" style="width:173px;"  enctype="multipart/form-data">
	  
			  <input type="file" style="width:173px;" class="btn btn-light" id="profile_image" name="profile_image" size="33" />
			  <input type="hidden" class="form-control" id="bird_id" name="bird_id" value="'.$record->auto_id.'"  />

			 
				<input type="submit" class="btn btn-light" value="Upload Image" />
			  </div>
			 </div>
		 </form>
		 <div class="form-group"> 
		 <form method="post" action="'.$video_url.'" style="width:173px;"  enctype="multipart/form-data">
		  
				  <input type="file" style="width:173px;" class="btn btn-light" id="profile_video" name="profile_video"/>
				  <input type="hidden" class="form-control" id="b_id" name="bird_id" value="'.$record->auto_id.'"  />
	
				 
					<input type="submit" class="btn btn-light" value="Upload video" />
				  </div>
				 </div>
			 </form>


</div>';
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
				"user_name" => $record->user_name,
				"created_on" => $created_on,
				"status" => $status,
				"bird_status" => $record->bird_status,
				"action" => $action,
				"upload" => $upload

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

	public function verify_data_join_two($array, $table, $join_table1, $join_tb_cond1, $join_table2, $join_tb_cond2, $select)
	{
		$this->db->where($array);
		$this->db->select($select);
		$this->db->join($join_table1, $join_tb_cond1);
		$this->db->join($join_table2, $join_tb_cond2);
		$records = $this->db->get($table);
		$records1 = $records->result();

		return $records1;
	}

 	public function delete_data($table,$val){
		$this->db->where($val);
		$this->db->delete($table);
		$message = "success";
		return $message?true:false;
	}
	public function delete_id($table, $col, $id){
		$this->db->where($col, $id);
		$this->db->delete($table);
		//echo $this->db->last_query(); exit;
		return true;
	}

	public function updates($table, $data, $col, $id = ''){
		$this->db->where($col, $id);
		$this->db->update($table, $data);
		//echo $this->db->last_query(); exit;
		return true;
	}

	public function verify_data_incubation_dt($postData){
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
		$this->db->where('i.status = 1');
		$this->db->where('i.fertile_type', 'Fertile');
		$this->db->or_where('i.fertile_type', 'Unknown');
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
        $this->db->where('i.status = 1');
		$this->db->where('i.fertile_type', 'Fertile');
		$this->db->or_where('i.fertile_type', 'Unknown');
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
		$this->db->where('i.status = 1');
		$this->db->where('i.fertile_type', 'Fertile');
		$this->db->or_where('i.fertile_type', 'Unknown');
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
			// if($record->hatch_weight < $record->std_hatch_weight){
			// 		$stund_status ="Stunted By Birth";
			// 	}
			// 	if($record->hatch_weight >= $record->std_hatch_weight){
			// 		$stund_status = "Normal";
			// 	}
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


public function verify_data_incubdetails_dt($postData,$postData1){
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
		$search_arr[] = " (incubation_name like '%" . $searchValue . "%') ";
	}

	if (count($search_arr) > 0) {
		$searchQuery = implode(" and ", $search_arr);
	}

	//# Total number of records without filtering
	$this->db->select('count(*) as allcount');
	$this->db->from('ckb_incubation_details');
	$this->db->where('incubation_id',$postData1);
	$this->db->where('branch_id',$branch_id);
	if ($searchQuery != '') $this->db->where($searchQuery);

	// $this->db->where($postData_where);

	$records = $this->db->get()->result();

	$totalRecords = $records[0]->allcount;

	//# Total number of record with filtering
	$this->db->select('count(*) as allcount');
	$this->db->from('ckb_incubation_details');
	$this->db->where('incubation_id',$postData1);
	$this->db->where('branch_id',$branch_id);
	if ($searchQuery != '') $this->db->where($searchQuery);

	//   $this->db->where($postData_where);

	$records = $this->db->get()->result();

	$totalRecordwithFilter = $records[0]->allcount;

	//# Fetch records
	$this->db->select('*');
	$this->db->from('ckb_incubation_details');
	$this->db->where('incubation_id',$postData1);
	$this->db->where('branch_id',$branch_id);
	if ($searchQuery != '') $this->db->where($searchQuery);

	//   $this->db->where($postData_where);
	$this->db->order_by('id', 'desc');  // or desc

	$this->db->limit($rowperpage, $start);

	$records = $this->db->get()->result();

	$data = array();

	foreach ($records as $record) {
	//	if($record->status == '1'){
		
			
		  $action_url1 = base_url()."index.php/Incubation/edit_incubation_details/".$record->auto_id;

		  $action_url2 = base_url()."index.php/Incubation/add_weight_loss/".$record->auto_id;

		  $action_url3 = base_url()."index.php/Incubation/move_incubation/".$record->auto_id;
		  $action_url4 = base_url()."index.php/Incubation/view_weight_loss/".$record->auto_id;

		$action = '<a href="'.$action_url1.'" class="btn btn-info btn-xs waves-effect waves-light tooltips" data-trigger="hover" data-placement="top" data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-pencil-square-o" id="editBtn"></i></a>';
		
		  $action .= '  <button  onclick="get_delete_pop('."'".$record->auto_id."'".');" class="btn btn-danger btn-xs waves-effect waves-light tooltips" data-placement="top" data-toggle="tooltip" id="Deletebtn" data-original-title="Delete"><i class="fa fa-close"></i></button>';
	
		$weight_loss = '<br><a href="'.$action_url4.'" target="_blank"><button class="btn btn-pink btn-xs waves-effect waves-light tooltips" style="margin-top:5px;" data-placement="top" data-toggle="tooltip" id="Weightlossbtn" title="Weight Loss">View Weight Loss History</button></a>';
		/*	$action .='<select class="form-control" style="margin-top:5px;" onchange="get_incubation_status(this);">';
		$action .='<option value="">Select</option>';
		$action .='<option value="Hand Feeding">Hand Feeding</option>';
		$action .='<option value="Pre Weaning">Pre Weaning</option>';
		$action .='<option value="Weaning">Weaning</option>';
		$action .='</select>';*/
		$date = date("d-m-Y", strtotime($record->idate));	
		$data[] = array(
			"id" => $record->id,
			"auto_id" => $record->auto_id,
			"incubation_id" => $record->incubation_id,
			"idate" => $date,
			"weight_14" => $record->weight_14,
			"weight_16" => $record->weight_16,
			"actual_weight" => $record->actual_weight,
			"heart_beat" => $record->heart_beat,
			"incubation_name" => $record->incubation_name,
			"humidity" => $record->humidity,
			"aircell_density" => $record->aircell_density,
			"checked_by" => $record->checked_by,
			"action" => $action,
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


public function get_bird_history_data($postData,$array_where,$date,$to_date)
	{
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
		if ($array_where != '') $this->db->where($array_where);
		$condition = "b.created_on BETWEEN " . "'" . $date . "'" . " AND " . "'" . $to_date . "'";
		if ($date != '' && $to_date != ''  ) $this->db->where($condition);
		$this->db->where('b.branch_id',$branch_id);
		$this->db->where_not_in('b.bird_status','Sale');

		if ($searchQuery != '') $this->db->where($searchQuery);

        // $this->db->where($postData_where);

		$records = $this->db->get()->result();

		$totalRecords = $records[0]->allcount;

        //# Total number of record with filtering
		$this->db->select('count(*) as allcount');
		$this->db->from('ckb_bird b');
		$this->db->join('ckb_group as g', 'b.group_id = g.auto_id','left');
		$this->db->join('ckb_species as s', 'b.species_id = s.auto_id','left');
		// $this->db->join('ckb_cage as c', 'b.cage_id = c.auto_id');
		$this->db->join('ckb_aviary as a', 'b.aviary_id = a.auto_id','left');
		if ($array_where != '') $this->db->where($array_where);
		$condition = "b.created_on BETWEEN " . "'" . $date . "'" . " AND " . "'" . $to_date . "'";
		if ($date != '' && $to_date != ''  ) $this->db->where($condition);
		$this->db->where('b.branch_id',$branch_id);
		$this->db->where_not_in('b.bird_status','Sale');
		if ($searchQuery != '') $this->db->where($searchQuery);

		//   $this->db->where($postData_where);

		$records = $this->db->get()->result();

		$totalRecordwithFilter = $records[0]->allcount;

        //# Fetch records
		$this->db->select(
			'b.*,g.group_name as group_name,s.bird_species as bird_species,a.aviary_name as aviary_name,u.user_name as user_name'
		);
		$this->db->from('ckb_bird b');
		$this->db->join('ckb_group as g', 'b.group_id = g.auto_id','left');
		$this->db->join('ckb_species as s', 'b.species_id = s.auto_id','left');
		// $this->db->join('ckb_cage as c', 'b.cage_id = c.auto_id');
		$this->db->join('ckb_aviary as a', 'b.aviary_id = a.auto_id','left');
		$this->db->join('ckb_users as u', 'b.created_by = u.user_id','left');
		if ($array_where != '') $this->db->where($array_where);
		$condition = "b.created_on BETWEEN " . "'" . $date . "'" . " AND " . "'" . $to_date . "'";
		if ($date != '' && $to_date != ''  ) $this->db->where($condition);
		$this->db->where('b.branch_id',$branch_id);
		$this->db->where_not_in('b.bird_status','Sale');
		if ($searchQuery != '') $this->db->where($searchQuery);

		//   $this->db->where($postData_where);
		$this->db->order_by('b.id', 'desc');  // or desc

		$this->db->limit($rowperpage, $start);

		$records = $this->db->get()->result();
		// print_r($this->db->last_query());die;

		$data = array();

		foreach ($records as $record) {
			$timedate1 = strtotime(date("Y-m-d", strtotime($record->created_on)));
			$created_on = date("d-m-Y", $timedate1);

		/*	if ($record->status == 0) {
				$status = '<span class="label label-warning">Inactive</span>';
			} else {
				$status = '<span class="label label-success">Active</span>';
			}
			*/
      $action_url1 = base_url()."index.php/Bird/edit_bird/".$record->auto_id;
      $image_url = base_url()."index.php/Execution/upload_brid_image";
	  $video_url = base_url()."index.php/Execution/upload_brid_video";


			$action = '<a href="'.$action_url1.'" class="btn btn-info btn-xs waves-effect waves-light tooltips" data-trigger="hover"
      data-placement="top" data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-pencil-square-o" id="editBtn"></i></a>';
			
      $action .= '<button  onclick="get_delete_pop('."'".$record->auto_id."'".');" class="btn btn-danger btn-xs waves-effect waves-light tooltips" data-placement="top" data-toggle="tooltip" id="birdDeletebtn" data-original-title="Delete"><i class="fa fa-close"></i></button>';
	  $status = '<button  onclick="get_move_status('."'".$record->auto_id."'".');" class="btn btn-success btn-xs waves-effect waves-light tooltips" style="margin-top:5px;" data-placement="top" data-toggle="tooltip" id="move" title="Move to Handfeeding"><i class="fa fa-exchange" aria-hidden="true"></i></button>';
	
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
				"user_name" => $record->user_name,
				"created_on" => $created_on,
				"status" => $status,
				"bird_status" => $record->bird_status,
				"action" => $action,
				

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






}//end class
