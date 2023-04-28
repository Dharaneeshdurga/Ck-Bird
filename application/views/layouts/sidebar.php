<div class="left side-menu">
                <div class="sidebar-inner slimscrollleft">
                    <div class="user-details">
                        <div class="pull-left">
                            <img src="<?php echo base_url();?>assets/images/pro_pic2.jpg" alt="" class="thumb-md img-circle">
                        </div>
                        <div class="user-info">
                            <div class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><?php echo $this->session->userdata('user_name'); ?><span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                      <li><a href="<?php echo base_url('index.php/Masters/change_password');?>"><i class="md md-face-unlock"></i> Change Password</a></li>
                                    <li><a href="javascript:void(0)"><i class="md md-settings"></i> Settings</a></li>
                                    <li><a href="javascript:void(0)"><i class="md md-lock"></i> Lock screen</a></li>
                                    <li><a href="<?php echo base_url('index.php/Login/logout');?>"><i class="md md-settings-power"></i> Logout</a></li>
                                </ul>
                            </div>
                            
                            <p class="text-muted m-0"><?php echo $this->session->userdata('role_type'); ?></p>
                        </div>
                    </div>
                    <!--- Divider -->

                    <div id="sidebar-menu">
                    <?php $role_permission_result = $this->session->userdata('role_result'); 
                        foreach($role_permission_result as $k => $val){
                            $menu_array[] = $val['menu_id'];
                            $submenu_id[] = $val['submenu_id'];
                            $role_perm[] =  $val['role_permission'];
                          

                        }
            //   print_r($menu_array);
            //   echo '<br><br><br>';
            //    print_r($submenu_id);
                    ?>
                        <ul> 
                           <?php
                           if(isset($role_perm[0]) && isset($role_perm[1]) && isset($role_perm[2])&& isset($role_perm[3])&& isset($role_perm[4])&& isset($role_perm[5])&&isset($role_perm[6])&&isset($role_perm[7])&&isset($role_perm[8])&&isset($role_perm[9])&&isset($role_perm[10])) {
                           
                           if($role_perm[0]|| $role_perm[1] || $role_perm[2] || $role_perm[3] || $role_perm[4] || $role_perm[5] || $role_perm[6] || $role_perm[7] || $role_perm[8] || $role_perm[9] || $role_perm[10] == 1){?>
                            <li class="has_sub settings_li">
                                <a href="#" class="waves-effect settings_m"><i class="md md-settings"></i><span> Settings </span><span class="pull-right"><i class="md md-add"></i></span></a>
                                  <ul class="list-unstyled">
                                  <?php if($role_perm[11] == 1) {?> 
                                         <li class="branch"><a href="<?php echo base_url(); ?>index.php/Masters/branch">Branch</a></li>
                              <?php } ?>
                          
                                  <?php if($role_perm[0] == 1) {?>
                                         <li class="users"><a href="<?php echo base_url(); ?>index.php/Masters/employe">Employees</a></li>
                              <?php } ?>

                              <?php if($role_perm[1] == 1) {?>
                                <li class="roles"><a href="<?php echo base_url(); ?>index.php/Masters/roles">Roles</a></li>
                                <?php } ?>

                                <?php if($role_perm[2] == 1) {?>
                                    <li class="aviary"><a href="<?php echo base_url(); ?>index.php/Masters/aviary">Aviary</a></li>
                                 <?php } ?> 
                                 <?php if($role_perm[3] == 1) {?>
                                    <li class="cage"><a href="<?php echo base_url(); ?>index.php/Masters/cage">Cage</a></li>
                                    <?php } ?> 
                                    <?php if($role_perm[4] == 1) {?>
                                    <li class="group"><a href="<?php echo base_url(); ?>index.php/Masters/group">Group</a></li>
                                    <?php } ?> 
                                    <?php if($role_perm[5] == 1) {?>
                                            <li class="species"><a href="<?php echo base_url(); ?>index.php/Masters/species">Species</a></li>
                                    <?php } ?> 
                                    <?php if($role_perm[6] == 1) {?>
                                         <li class="proven"><a href="<?php echo base_url(); ?>index.php/Masters/proven">Proven</a></li>
                                    <?php } ?> 
                                    <?php if($role_perm[7] == 1) {?>
                                             <li class="brooder"><a href="<?php echo base_url(); ?>index.php/Masters/brooder">Brooder</a></li>
                                    <?php } ?> 
                                    <?php if($role_perm[8] == 1) {?>
                                             <li class="incubation"><a href="<?php echo base_url(); ?>index.php/Masters/incubation">Incubation</a></li>
                                    <?php } ?> 
                                    <?php if($role_perm[9] == 1) {?>
                                         <li class="raw-material"><a href="<?php echo base_url(); ?>index.php/Masters/raw_material">Raw Material</a></li>
                                    <?php } ?> 
                                     <?php if($role_perm[10] == 1) {?>
                                      <li class="stock-register"><a href="<?php echo base_url(); ?>index.php/Masters/stock_register">Stock Register</a></li>
                                    <?php } ?> 
                                </ul>
                            </li>
                           <?php }} ?>

                           <?php 
                           //// if(isset($role_perm[28])){
                           // if($role_perm[28] == 1){?> 
                            <li class="mis_m">
                                <a href="<?php echo base_url(); ?>index.php/Mis/mis_format" class="waves-effect"><i class="md md-settings"></i><span>MIS format</span></a>
                            </li>
                            <?php// }} ?> 



                           <?php
                           if(isset($role_perm[31]) && isset($role_perm[32])) {
                           if($role_perm[31] || $role_perm[32] == 1) {?>   
                            <li class="has_sub sop_li">
                                <a href="#" class="waves-effect sop_m"><i class="md md-settings"></i><span>SOP</span><span class="pull-right"><i class="md md-add"></i></span></a>
                                <ul class="list-unstyled">
                                <?php if($role_perm[31] == 1) {?>
                                     <li class="tf"><a href="<?php echo base_url(); ?>index.php/Execution/sop">SOP Admin</a></li>
                                     <?php } ?>
                                     <?php if($role_perm[32] == 1) {?>
                                     <li class="tr"><a href="<?php echo base_url(); ?>index.php/Execution/sop_tr">SOP Training </a></li>
                                     <?php } ?>
                                    </ul>
                            </li>
                            <?php } }?>
                           <!-- array 11 -- menu id 16 = breeding -->
                           <?php 
                            if(isset($role_perm[12])) {
                           if($role_perm[12] == 1){?>
                            <li class="has_sub breeding_li"> 
                                     <a href="#" class="waves-effect breeding_m"><i class="md md-settings"></i><span> Breeding </span><span class="pull-right"><i class="md md-add"></i></span></a>
                                     <ul class="list-unstyled">
                                     <li class="proven"><a href="<?php echo base_url(); ?>index.php/Breeding/view_proven">Proven</a></li>
                                     <!-- <li class="proven_history"><a href="<?php// echo base_url(); ?>index.php/Breeding/proven_history">Proven History</a></li> -->

                                     <li class="non-proven"><a href="<?php echo base_url(); ?>index.php/Breeding/non_proven">Non Proven</a></li>
                                    </ul>
                                </li>
                                <?php } ?>
                                <?php
                                if(isset($role_perm[13]) && isset($role_perm[14]) && isset($role_perm[15])&& isset($role_perm[16])){
                                if($role_perm[13] == 1 || $role_perm[14] == 1 || $role_perm[15] == 1 || $role_perm[16] == 1) {?>
                                <li class="has_sub sales_li">
                                <a href="#" class="waves-effect sales_m"><i class="md md-settings"></i><span> Sales Register </span><span class="pull-right"><i class="md md-add"></i></span></a>

                                <ul class="list-unstyled">
                                <?php if($role_perm[13] == 1) { ?>
                                     <li class="sales"><a href="<?php echo base_url(); ?>index.php/Execution/sales_register" class="waves-effect">Sales Register</a></li>
                                <?php } ?>
                                <?php if($role_perm[16] == 1) { ?>
                                    <li class="purchase_reg"><a href="<?php echo base_url(); ?>index.php/Execution/purchase_register">View Purchase Register</a></li>
                                <?php } ?>
                                <?php if($role_perm[14] == 1) { ?>
                                          <li class="view_sales"><a href="<?php echo base_url(); ?>index.php/Execution/view_sales">View sales update</a></li>
                                <?php } ?>
                                <?php if($role_perm[15] == 1) { ?>
                                    <li class="sales_history"><a href="<?php echo base_url(); ?>index.php/Execution/sales_history">Sales History</a></li>
                                <?php } ?>
                               
                                </ul>
                                     </li>
                            <?php }}} ?>
                            <?php 
                              if(isset($role_perm[20]) && isset($role_perm[19]) && isset($role_perm[17]) && isset($role_perm[18])){
                            if($role_perm[20] == 1 || $role_perm[19] == 1 || $role_perm[17] == 1 || $role_perm[18] == 1) {?>
                                <li class="has_sub execution_li">
                                     <a href="#" class="waves-effect excecution_m"><i class="md md-settings"></i><span> Execution Register </span><span class="pull-right"><i class="md md-add"></i></span></a>
                                     <ul class="list-unstyled">
                                     <?php if($role_perm[17] == 1) { ?>
                                        <li class="team"><a href="<?php echo base_url(); ?>index.php/Execution/team_register">Requirements</a></li>
                                     <?php } ?>
                                     <?php if($role_perm[18] == 1){ ?>
                                            <li class="manage"><a href="<?php echo base_url(); ?>index.php/Execution/manage_register">Management</a></li>
                                     <?php } ?>
                                     <?php if($role_perm[19] == 1) { ?>
                                            <li class="head"><a href="<?php echo base_url(); ?>index.php/Execution/head_register">R&D Head </a></li>
                                      <?php } ?>
                                      <?php if($role_perm[20] == 1) { ?>
                                            <li class="division"><a href="<?php echo base_url(); ?>index.php/Execution/division_register">Buisness Head </a></li>
                                            <?php } ?>
                                </ul>
                                </li>
                                <?php }} ?>
                                   <!-- array 20 -- menu id 20 = healthsetting -->
                                 <!-- <?php 
                                  if(isset($role_perm[22])){
                                 if($role_perm[22] == 1){
                                     ?>
                                <li class="has_sub healthsetting_li">
                                <a href="#" class="waves-effect settingshealth_m"><i class="md md-settings"></i><span> Healthcare Settings </span><span class="pull-right"><i class="md md-add"></i></span></a>
                                <ul class="list-unstyled">
                                    <li class="samples"><a href="<?php echo base_url(); ?>index.php/Masters/samples_collected">Samples Collected</a></li>
                                    <li class="lab"><a href="<?php echo base_url(); ?>index.php/Masters/lab_diag">Lab Diagnostics</a></li>
                                  
                                 
                                </ul>
                            </li>
                            <?php }} ?> -->
 <!-- array 19 -- menu id 19 = healthcare_li -->
 
 <?php 
 if(isset($role_perm[21])){
 
 if($role_perm[21] == 1){
     
     ?>
                                <li class="has_sub healthcare_li">
                                     <a href="#" class="waves-effect healthcare_m"><i class="fa fa-medkit"></i><span> Health </span><span class="pull-right"><i class="md md-add"></i></span></a>
                                     <ul class="list-unstyled">
									 <li class="samples"><a href="<?php echo base_url(); ?>index.php/Masters/samples_collected">Samples Collected</a></li>
                                    <li class="lab"><a href="<?php echo base_url(); ?>index.php/Masters/lab_diag">Lab Diagnostics</a></li>
                                  
                                     <!-- <li class="splay"><a href="<?php// echo base_url(); ?>index.php/Healthcare/view_splay">Splay Leg Chick Register</a></li> -->
                                     <!-- <li class="stunded"><a href="<?php //echo base_url(); ?>index.php/Healthcare/view_stund">Stunted Chick Register</a></li> -->
                                    <li class="treatment"><a href="<?php echo base_url(); ?>index.php/Healthcare/view_treatment">Treatment Register</a></li>
                                    <!-- <li class="shell"><a href="<?php //echo base_url(); ?>index.php/Healthcare/view_shell">Dead in Shell Register</a></li> -->
                                    <li class="mort"><a href="<?php echo base_url(); ?>index.php/Healthcare/view_mort">Mortality & Postmortem Register</a></li>
                                    </ul>
                                </li>
                                <?php }} ?>  
                               
                                <!-- array 21 -- menu id 21 = bird_manage_m -->
 <?php// if($role_perm[21] == 1){?>   
                            <li class="has_sub bird_li">
                                <a href="#" class="waves-effect bird_manage_m"><i class="fa fa-twitter"></i><span> Bird Manage</span><span class="pull-right"><i class="md md-add"></i></span></a>
								<ul class="list-unstyled">
								<li class="bird_manage"><a href="<?php echo base_url(); ?>index.php/Bird/bird_manage">Bird Manage</a></li>
								<li class="bird_history"><a href="<?php echo base_url(); ?>index.php/Bird/bird_history">Bird Manage History</a></li>
 								</ul>
							</li>
                            <?php// } ?>  

                            <?php 
                            if(isset($role_perm[24])){
                            if($role_perm[24] == 1){?>   
                            <li class="has_sub incubation_li">
                                <a href="#" class="waves-effect incubation_m"><i class="fa fa-dashcube"></i><span> Incubation </span><span class="pull-right"><i class="md md-add"></i></span></a>
                                <ul class="list-unstyled">
                                <li class="incub_history"><a href="<?php echo base_url(); ?>index.php/Incubation/incubation_history">Incubation History</a></li>

                                    <li class="add_incubation_m"><a href="<?php echo base_url(); ?>index.php/Incubation/incubation">Add Incubation</a></li>
                                    <!--li class="weightloss_incubation"><a href="<?php //echo base_url(); ?>Incubation/weight_loss">Weight Loss Incubation</a></li-->
                                    <li class="temhum_incubation_m"><a href="<?php echo base_url(); ?>index.php/Incubtemperature/incubtemperature">Temperature & Humidity</a></li>
                                    
                                </ul>
                            </li>
                            <?php }} ?>  
    <?php
    if(isset($role_perm[25])){
    if($role_perm[25] == 1){?>   
                            <li class="has_sub handfeeding_li">
                            <a href="#" class="waves-effect handfeeding_m"><i class="fa fa-hand-o-right"></i></button><span> Handfeeding </span><span class="pull-right"><i class="md md-add"></i></span></a>
                               
                            <ul class="list-unstyled">
                            <li class="handfeeding_history"><a href="<?php echo base_url(); ?>index.php/Handfeeding/handfeeding_history">Handfeeding History</a></li>

                            <li class="add_handfeeding_m"><a href="<?php echo base_url(); ?>index.php/Handfeeding/handfeeding" class="waves-effect"><span>Add Handfeeding</span></a>
                            </li>
                            <li class="temhum_handfeeding_m"><a href="<?php echo base_url(); ?>index.php/Handfeeding/list_handfeed_temp">Temperature & Humidity</a></li>
                                    
                                    </ul>
                                </li>
                 <?php }} ?> 
                 
                 <?php 
                 if(isset($role_perm[26])){
                 if($role_perm[26] == 1){?>   
                   <li class="has_sub preweaning_li">
                    <a href="#" class="waves-effect preweaning_m"><i class="fa fa-hand-o-right"></i></button><span> Preweaning </span><span class="pull-right"><i class="md md-add"></i></span></a>
                               
                               <ul class="list-unstyled">
                               <li class="preweaning_history"><a href="<?php echo base_url(); ?>index.php/Preweaning/preweaning_history">Preweaning History</a></li>
   
                               <li class="add_preweaning_m"><a href="<?php echo base_url(); ?>index.php/Preweaning/preweaning" class="waves-effect"><span>Add Preweaning</span></a>
                               </li>
                             
                                </ul>
                 </li>
                    <?php }} ?> 
                    <?php 
                    if(isset($role_perm[27])){
                    if($role_perm[27] == 1){?> 
                     <li class="has_sub weaning_li">
                    <a href="#" class="waves-effect weaning_m"><i class="fa fa-hand-o-right"></i></button><span> Weaning </span><span class="pull-right"><i class="md md-add"></i></span></a>
                               
                               <ul class="list-unstyled">
                               <li class="weaning_history"><a href="<?php echo base_url(); ?>index.php/Weaning/weaning_history">Weaning History</a></li>
   
                               <li class="add_weaning_m"><a href="<?php echo base_url(); ?>index.php/Weaning/weaning" class="waves-effect"><span>Add Weaning</span></a>
                               </li>
                             
                                </ul>
                 </li> 
                           
                            <?php }} ?> 
                     <?php 
                     if(isset($role_perm[29])){
                     if($role_perm[29] == 1){?>  
                            <li class="stock_m">
                                <a href="<?php echo base_url(); ?>index.php/Feedmaintenance/new_stock" class="waves-effect"><i class="fa fa-life-ring" aria-hidden="true"></i><span>Stock Register Track</span></a>
                            </li>
                    <?php }} ?> 
                    <?php 
                    if(isset($role_perm[28])){
                    if($role_perm[28] == 1){?>  
                            <li class="has_sub feedm_li">
                                <a href="#" class="waves-effect feedm_m"><i class="fa fa-coffee"></i><span> Feed Maintenance </span><span class="pull-right"><i class="md md-add"></i></span></a>
                                <ul class="list-unstyled">
                                    <li class="add_ic_feed_m"><a href="<?php echo base_url(); ?>index.php/Feedmaintenance/individual_cage">Individual Cage Track</a></li>
                                    <li class="raw_mat_m"><a href="<?php echo base_url(); ?>index.php/Feedmaintenance/raw_material_track">Raw Material Track</a></li>
                                    <li class="av_feed_m"><a href="<?php echo base_url(); ?>index.php/Feedmaintenance/aviary_feed_track">Aviary Feed Track</a></li>
                                    <!--li class="stock_m"><a href="<?php //echo base_url(); ?>index.php/Feedmaintenance/stock_register_track">Stock Register Track</a></li-->

                                </ul>
                               
                            </li>
                            <?php } } ?> 
                            <?php 
                            if(isset($role_perm[30])){
                            if($role_perm[30] == 1){?> 
                            <li class="lifecycle_m">
                                <a href="<?php echo base_url(); ?>index.php/Lifecycle/lifecycle" class="waves-effect"><i class="fa fa-life-ring" aria-hidden="true"></i><span>Birds Lifecycle</span></a>
                            </li>
                            <?php }} ?> 
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
