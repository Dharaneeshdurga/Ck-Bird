<?php	
defined('BASEPATH') OR exit('No direct script access allowed');	
class Feedmaintenance extends CI_Controller {	
    
    public function __construct()	
    {	
        parent::__construct();	
        $this->load->helper(array(	
            'form',	
            'utility_helper',
            'html',	
            'file',	
            'url'	
        ));	
		$this->load->model('masters_model');
        $this->load->library('session');	
        $this->load->library('form_validation');	
        $this->load->library('javascript');	
        $this->load->library('email');	
        $this->load->model('CommonBird_model', 'cbmodel');
        $this->load->model('Handfeed_model', 'hmodel');
        $this->load->model('Preweaning_model', 'pwmodel');
        $this->load->model('Weaning_model', 'wmodel');
        $this->load->model('Feedmaintain_model', 'fmmodel');

		if ( !$this->session->userdata('logged_in')){ 	
			redirect(base_url(), 'refresh');	
				
        }	
        	
    }	

    public function add_individual_cage(){
		$this->load->view('Feedmaintenance/add_individual_cage');	
	}

    public function individual_cage(){
		$this->load->view('Feedmaintenance/individual_cage');	
	}
    public function raw_material_track(){
		$this->load->view('Feedmaintenance/raw_material_track');	
	}
    public function aviary_feed_track(){
		$this->load->view('Feedmaintenance/aviary_track');	
	}
    public function stock_register_track(){
		$this->load->view('Feedmaintenance/stock_register_track');	
	}
    public function new_stock(){
		$this->load->view('Feedmaintenance/new_stock');	
	}
    public function get_type(){
        $get_type = $this->fmmodel->get_type();
        echo json_encode($get_type);
    }
    public function get_part(){
        $type = $this->input->post('type');
        $where_cond_t['type']=$type;
        $where_cond_t['branch_id'] = $this->session->userdata('branch_id');

        $part_result = $this->cbmodel->verify_data($where_cond_t,'ckb_stock_register_upload');
        echo json_encode($part_result);
    }
public function get_cagetrack_list(){
    $postData = $this->input->post();
    $date = $this->input->post('date');
    $to_date = $this->input->post('to_date');
    $aviary_id = $this->input->post('avairy');
    $cage_id= $this->input->post('cage');
     $cagetrack_result = $this->fmmodel->verify_data_cagetrack_dt($postData,$date,$to_date,$aviary_id,$cage_id);
    echo json_encode($cagetrack_result);

}
public function get_stock_list(){
    $postData = $this->input->post();
   // $date = $this->input->post('date');
    //$to_date = $this->input->post('to_date');
    $type = $this->input->post('type');
    $part = $this->input->post('part');
    $month= $this->input->post('month');
    $year= $this->input->post('year');
     $cagetrack_result = $this->fmmodel->stock_register_dt($postData,$type,$part,$month,$year);
    echo json_encode($cagetrack_result);

}
public function get_aviaryTrack_list(){
    $postData = $this->input->post();
    $avdate = $this->input->post('avdate');
    $aviarytr_result = $this->fmmodel->aviary_track_dt($postData,$avdate);
    echo json_encode($aviarytr_result);

}


    public function add_cageTrack(){
        // $get_cur_auto_id = $this->cbmodel->cur_auto_id('ckb_incubation');
       //  $auto_id = "I".str_pad( ( $get_cur_auto_id+1 ), 4, 0, STR_PAD_LEFT);
 
        // $where_cond_b['auto_id'] = $auto_id;
         $where_cond_b['date'] = $this->input->post('track_date');
         $where_cond_b['aviary_id'] = $this->input->post('aviary_id');
         $where_cond_b['branch_id'] = $this->session->userdata('branch_id');

		 $cage_id = $this->input->post('cage');
		// $species_id = $this->input->post('bird_species');
		 $bird_count = $this->input->post('bird_count');
		 $mrg_feed = $this->input->post('mrng_feed');
        $target_mrng_feed = $this->input->post('total_mrng_feed');
        $aft_feed = $this->input->post('aft_feed');
	 	$target_aft_feed = $this->input->post('total_aft_feed');
         $target_feedg = $this->input->post('target_feedg');
         $mrng_feed_wast = $this->input->post('mrg_wastage');
         $aft_feed_wast = $this->input->post('aft_wastage');
         $total_intake = $this->input->post('total_intake');
		 $to_be_achieved = $this->input->post('to_be_achieved');
         $achieved = $this->input->post('achieved');


		 $count = count($cage_id);
		// $count1 = count($mrg_feed);
		// echo $count1;

		for($i=0; $i < $count; $i++){
			$where_cond_b['cage_id'] =  $cage_id[$i];
			//$where_cond_b['species_id'] =  $species_id[$i];
			$where_cond_b['count'] = $bird_count[$i];
			$where_cond_b['mrg_feed'] =  $mrg_feed[$i];
			$where_cond_b['target_mrng_feed'] = $target_mrng_feed[$i];
			$where_cond_b['aft_feed'] = $aft_feed[$i];

			$where_cond_b['target_aft_feed'] = $target_aft_feed[$i];
			$where_cond_b['target_feedg'] = $target_feedg[$i];
			$where_cond_b['mrng_feed_wast'] = $mrng_feed_wast[$i];
			$where_cond_b['aft_feed_wast'] =  $aft_feed_wast[$i];
			$where_cond_b['total_intake'] = $total_intake[$i];
			$where_cond_b['to_be_achieved'] = $to_be_achieved[$i];
			$where_cond_b['achieved'] = $achieved[$i];

			$cagetrack_result = $this->cbmodel->data_add('ckb_cage_track',$where_cond_b);
			//echo $cagetrack_result;
		}

		
       
       
       
        
         

         
        //  if($cagetrack_result){
             $result = array(
                 "logstatus" => "success",
                 "url" => "Feedmaintenance/individual_cage"
             );
             echo json_encode($result);
     
         //}
        }
        public function get_raw_material_track(){
        
        $group_id = $this->input->post('group_id');
        $where_cond_a['auto_id']=$group_id;
        $where_cond_a['branch_id'] = $this->session->userdata('branch_id');

        $gr_result = $this->cbmodel->verify_data($where_cond_a,'ckb_group');
        foreach($gr_result as $val) { 
            $group_name = $val->group_name;
        }
        $aviary_id = $this->input->post('aviary_id');
        $where_cond_b['auto_id']=$aviary_id;
        $av_result = $this->cbmodel->verify_data($where_cond_b,'ckb_aviary');
        foreach($av_result as $val) { 
            $aviary_name = $val->aviary_name;
        }
        $species_id = $this->input->post('species_id');
        $where_cond_b['auto_id']=$species_id;
        $sp_result = $this->cbmodel->verify_data($where_cond_b,'ckb_species');
        foreach($sp_result as $val) { 
            $species_name = $val->bird_species;
        }
            $act = $this->input->post('act');
    
            $where_cond_s['group_id'] = $group_name;
            $where_cond_s['aviary_id'] = $aviary_name;
            $where_cond_s['species_id'] = $species_name;
            $where_cond_s['actual_type'] = $act;
            $where_cond_s['branch_id'] = $this->session->userdata('branch_id');

            $mat_result['mat_result'] = $this->cbmodel->verify_data($where_cond_s,'ckb_materials_import');
            $sp_count = $this->input->post('count_sp');
            $mat_result['count_sp'] = $sp_count;
            $this->load->view('Feedmaintenance/raw_material_track', $mat_result);
           //print_r($where_cond_s);
            //echo json_encode($mat_result);
        }
        public function add_matTrack(){
            $count = $this->input->post('count[]');
            $aviary_name = $this->input->post('aviary_name[]');
            $species_name = $this->input->post('species_name[]');
            $group_name = $this->input->post('group_name[]');
            $section = $this->input->post('section[]');
            $material = $this->input->post('material[]');
            $target = $this->input->post('target[]');
            $actual = $this->input->post('actual[]');
            $status = $this->input->post('status[]');
            $date = $this->input->post('mat_date');
            $val = count($count);
            $time=strtotime($date);
            $month=date("F",$time);
            $year=date("Y",$time);
            $branch_id = $this->session->userdata('branch_id');

            for ($i=0; $i < $val ; $i++) {

             $where_cond_b['mdate'] = $date;
             $where_cond_b['month'] = $month;
             $where_cond_b['year'] = $year;
             $where_cond_b['aviary_name'] = $aviary_name[$i];
             $where_cond_b['species_name'] = $species_name[$i];
             $where_cond_b['group_name'] = $group_name[$i];
             $where_cond_b['section'] = $section[$i];
             $where_cond_b['material'] = $material[$i];
             $where_cond_b['target'] = $target[$i];
             $where_cond_b['actual'] = $actual[$i];
             $where_cond_b['status'] = $status[$i];
             $where_cond_b['branch_id'] = $branch_id;

            $mat_track_result = $this->cbmodel->data_add('ckb_material_update',$where_cond_b);
           
           
           }
        
          // $mat_track_result = $this->db->insert_batch('ckb_material_update', $where_cond_b);
             
             if($mat_track_result){
                 $result = array(
                     "logstatus" => "success",
                     "url" => "Feedmaintenance/raw_material_track"
                 );
                 echo json_encode($result);
         
             }
            }

            public function add_stock_register(){
                $get_cur_auto_id = $this->cbmodel->cur_auto_id('ckb_stock_register_dt');
                if($get_cur_auto_id == "false"){
                   $auto_id="SR001";
                }
                else{
                    $auto_id = "SR".str_pad( ( $get_cur_auto_id+1 ), 4, 0, STR_PAD_LEFT);
                    }
             
                $data['auto_id'] = $auto_id;
                $data['type'] = $this->input->post('type');
                $data['part'] = $this->input->post('part');
                $data['pur_date'] = $this->input->post('pur_date');
                $data['total_pur_qty'] = $this->input->post('total_pur_qty');
                $data['total_pur_rs'] = $this->input->post('total_pur_rs');
                $data['branch_id'] = $this->session->userdata('branch_id');

                 $pur_date = $this->input->post('pur_date');
                 $time=strtotime($pur_date);
                 $data['month']=date("F",$time);
                 $data['year']=date("Y",$time);

            $stock_track_result = $this->cbmodel->data_add('ckb_stock_register_dt', $data);
            $month=date("F",$time);
            $year=date("Y",$time);

             if($stock_track_result){
                $result = array(
                    "logstatus" => "success",
                    "url" => "Feedmaintenance/stock_register_track/"."$month"."/".$year,
                );
                echo json_encode($result);
        
              }
            }
            public function add_used_register(){
               
             
                $data['stock_id'] = $this->input->post('stock_id');
                $data['daily_used_date'] = $this->input->post('us_date');
                $data['daily_used'] = $this->input->post('us_qty');
                $data['dis_value'] = $this->input->post('dis_value');
                $data['branch_id'] = $this->session->userdata('branch_id');


                 $us_date = $this->input->post('us_date');
                 $time=strtotime($us_date);
                 $data['month']=date("F",$time);
                 $data['year']=date("Y",$time);

            $used_track_result = $this->cbmodel->data_add('ckb_daily_used_stock', $data);
            $month=date("F",$time);
            $year=date("Y",$time);

             if($used_track_result){
                $result = array(
                    "logstatus" => "success",
                    "url" => "Feedmaintenance/stock_register_track/"."$month"."/".$year,
                );
                echo json_encode($result);
        
              }
            }
           
}//end class
?>
