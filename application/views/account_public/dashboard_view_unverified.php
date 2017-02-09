<?php $this->load->view($this->config->item('public_login_folder') . '/header'); ?>
<style>
.bs-wizard {margin-top: 40px;}

/*Form Wizard*/
.bs-wizard {border-bottom: solid 1px #e0e0e0; padding: 0 0 10px 0;}
.bs-wizard > .bs-wizard-step {padding: 0; position: relative;}
.bs-wizard > .bs-wizard-step + .bs-wizard-step {}
.bs-wizard > .bs-wizard-step .bs-wizard-stepnum {color: #595959; font-size: 16px; margin-bottom: 5px;}
.bs-wizard > .bs-wizard-step .bs-wizard-info {color: #999; font-size: 14px;}
.bs-wizard > .bs-wizard-step > .bs-wizard-dot {position: absolute; width: 30px; height: 30px; display: block; background: #fbe8aa; top: 45px; left: 50%; margin-top: -15px; margin-left: -15px; border-radius: 50%;} 
.bs-wizard > .bs-wizard-step > .bs-wizard-dot:after {content: ' '; width: 14px; height: 14px; background: #fbbd19; border-radius: 50px; position: absolute; top: 8px; left: 8px; } 
.bs-wizard > .bs-wizard-step > .progress {position: relative; border-radius: 0px; height: 8px; box-shadow: none; margin: 20px 0;}
.bs-wizard > .bs-wizard-step > .progress > .progress-bar {width:0px; box-shadow: none; background: #fbe8aa;}
.bs-wizard > .bs-wizard-step.complete > .progress > .progress-bar {width:100%;}
.bs-wizard > .bs-wizard-step.active > .progress > .progress-bar {width:50%;}
.bs-wizard > .bs-wizard-step:first-child.active > .progress > .progress-bar {width:0%;}
.bs-wizard > .bs-wizard-step:last-child.active > .progress > .progress-bar {width: 100%;}
.bs-wizard > .bs-wizard-step.disabled > .bs-wizard-dot {background-color: #f5f5f5;}
.bs-wizard > .bs-wizard-step.disabled > .bs-wizard-dot:after {opacity: 0;}
.bs-wizard > .bs-wizard-step:first-child  > .progress {left: 50%; width: 50%;}
.bs-wizard > .bs-wizard-step:last-child  > .progress {width: 50%;}
.bs-wizard > .bs-wizard-step.disabled a.bs-wizard-dot{ pointer-events: none; }
/*END Form Wizard*/


.orange-circle-button {
	box-shadow: 2px 4px 0 2px rgba(0,0,0,0.1);
	border: .5em solid #E84D0E;
	font-size: 1em;
	line-height: 2.1em;
	color: #ffffff;
	background-color: #e84d0e;
	margin: auto;
	border-radius: 50%;
	height: 25em;
	width: 25em;
	position: relative;
}
.orange-circle-button:hover {
	color:#ffffff;
    background-color: #e84d0e;
	text-decoration: none;
	border-color: #ff7536;
	
}
.orange-circle-button:visited {
	color:#ffffff;
    background-color: #e84d0e;
	text-decoration: none;
	
}
.orange-circle-link-greater-than {
    font-size: 3em;
}

</style>
<div class="main-container">
   

   <div class="container">
       
        <?php if (!empty($message)) { ?>
            <div id="message">
                <?php echo $message; ?>
            </div>
        <?php } ?>
			<?php 
			
				  //Step2
				  ($user['upro_identity_image'] == '') ? $step2_status = 'active' : $step2_status = 'complete';
			      ($user['upro_identity_image'] == '') ? $count = 2 : $count = 1;			
				  ($user['upro_identity_image'] == '') ? $step2_complete = '' : $step2_complete = 'Completed';
				  ($user['upro_identity_image'] == '') ? $step3 = '#' : $step3 = site_url('account/upload-work-image');
				  //Step 3
				  ($work_image_count > 0)  ? $step3_complete = 'Completed' : $step3_complete = '';
				  ($work_image_count == 0 && $user['upro_identity_image'] != '')  ?  $step3_status = 'active' : '' ;
				  ($work_image_count > 0 && $user['upro_identity_image'] != '')  ? $step3_status = 'complete' : '';
				  ($work_image_count > 0 && $user['upro_identity_image'] != '')  ? $div_class = 'col-xs-3' : $div_class = 'col-xs-4';
				  
				  
			?>
			<?php if($verified_value == 0){ ?>
			<center><h3>Complete <?php echo $count; ?> More Steps to Start getting Clients/Customers</h3><div class="bs-wizard-info text-center">We will finalize you after looking at your details.</div></center> 
            <div class="row bs-wizard" style="border-bottom:0;">
                
                <div class="<?php echo $div_class; ?> bs-wizard-step complete">
                  <div class="text-center bs-wizard-stepnum">Step 1</div>
                  <div class="progress"><div class="progress-bar"></div></div>
                  <a href="#" class="bs-wizard-dot"></a>
                  <div class="bs-wizard-info text-center">Sign Up Completed</div>
                </div>
                
                <div class="<?php echo $div_class; ?> bs-wizard-step <?php echo $step2_status;?>">
                  <div class="text-center bs-wizard-stepnum">Step 2</div>
                  <div class="progress"><div class="progress-bar"></div></div>
                  <a href="<?php echo ($user['upro_identity_image'] == '') ? site_url('account/upload-identity-image') : '#'?>" class="bs-wizard-dot"></a>
                  <div class="bs-wizard-info text-center"><?php if($user['upro_identity_image'] == ''){ ?><a href="<?php echo ($user['upro_identity_image'] == '') ? site_url('account/upload-identity-image') : '#'?>">Upload</a><?php }else{?>Upload<?php }?> Your Identity (Aadhar Card/Driving License) <?php echo $step2_complete;?></div>
                </div>
                
                <div class="<?php echo $div_class; ?> bs-wizard-step <?php echo $step3_status;?>"><!-- complete -->
                  <div class="text-center bs-wizard-stepnum">Step 3</div>
                  <div class="progress"><div class="progress-bar"></div></div>
                  <a href="<?php echo $step3 ;?>" class="bs-wizard-dot"></a>
                  <div class="bs-wizard-info text-center"><?php if($user['upro_identity_image'] !=''){ ?><a href="<?php echo $step3 ;?>">Upload</a><?php }else{?>Upload<?php }?> Your Work (Photos/Certificates) <?php echo $step3_complete;?></div>
                </div>
                <?php if($step3_status == 'complete') { ?>
				 <div class="<?php echo $div_class; ?> bs-wizard-step <?php echo $step3_status;?>"><!-- complete -->
                  <div class="text-center bs-wizard-stepnum">Step 4</div>
                  <div class="progress"><div class="progress-bar"></div></div>
                  <a href="#" class="bs-wizard-dot"></a>
                  <div class="bs-wizard-info text-center"><a href="<?php echo site_url('account/verification-submit');?>" class="btn btn-primary" >Verify</a></div>
                </div>
				<?php } ?>
            </div>
			<?php } else { ?>
			<center><h3>Your detials are saved our Team is verifying it. Once verified you will be contacted.</h3><div class="bs-wizard-info text-center">We will finalize you after looking at your details.</div></center> 
			<br/><br/>
			<div class="row">
			<div class="col-md-offset-4 col-md-6">
		    <button class="btn btn-default orange-circle-button">Sit back and Relax we will get back to you shortly<br/> after our team verifys your profile.<br /></button>
			</div>   
			</div>
			<?php } ?>
           
	</div>
	

	
	</div>


    <?php $this->load->view($this->config->item('public_login_folder') . '/footer'); ?>
