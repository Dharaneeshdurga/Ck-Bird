$check_eggno = $this->db->get_where('ckb_incubation', array('egg_no' => $value['G'] ));
                          $if_exist = $check_eggno->num_rows();
                          if($if_exist > 0){
                           $av_result = $this->masters_model->updates('ckb_incubation', $inserdata[$i], 'egg_no', $value['G']);
                          }
                          else{
                         $av_result = $this->cbmodel->data_add('ckb_incubation',$inserdata[$i]);
                          }