	<style>
		.errorBorder{
			border: 1px solid red;
		}
	</style>
	 
	 <div id="contact-page" class="container">
    	<div class="bg">
	    	<div class="row">    		
	    		<div class="col-sm-12">    			   			
					<h2 class="title text-center"><?php echo $LANG_CONTACT_US;?></h2>    			    				    				
					<div id="gmap" class="contact-map">
					</div>
				</div>			 		
			</div>    	
    		<div class="row">
				<?php if(isset($member)){ ?>
	    		<div class="col-sm-8">
	    			<div class="contact-form">
	    				<h2 class="title text-center"><?php echo $LANG_GET_IN_TOUCH;?></h2>
	    				<div class="status alert alert-success" style="display: none"></div>
				    	<form id="main-contact-form" class="contact-form row" name="contact-form" method="post">
				            <div class="form-group col-md-6">
				                <input type="text" name="name" id = "name" class="form-control" placeholder="Name" value = "<?php echo $member->getMember_name();?>">
				            </div>
				            <div class="form-group col-md-6">
				                <input type="email" name="email" id = "email" class="form-control" placeholder="Email" value = "<?php echo $member->getMember_email();?>">
				            </div>
				            <div class="form-group col-md-12">
				                <input type="text" name="subject" id = "subject" class="form-control" placeholder="Subject">
				            </div>
				            <div class="form-group col-md-12">
				                <textarea name="message" id="message" class="form-control" rows="8" placeholder="Your Message Here"></textarea>
				            </div>                        
				            <div class="form-group col-md-12">
				                <input type="submit" name="submit" class="btn btn-primary pull-right" value="Submit" onclick = "submit_email()">
				            </div>
				        </form>
	    			</div>
	    		</div>
				<?php } ?>
	    		<div class="col-sm-4">
	    			<div class="contact-info">
	    				<h2 class="title text-center"><?php echo $LANG_CONTACT_INFO;?></h2>
	    				<address>
	    					<p>E-Shopper Inc.</p>
							<p>935 W. Webster Ave New Streets Chicago, IL 60614, NY</p>
							<p>Newyork USA</p>
							<p>Mobile: +2346 17 38 93</p>
							<p>Fax: 1-714-252-0026</p>
							<p>Email: info@e-shopper.com</p>
	    				</address>
	    				<div class="social-networks">
	    					<h2 class="title text-center"><?php echo $LANG_SOCIAL_NETWORKING;?></h2>
							<ul>
								<li>
									<a href="#"><i class="fa fa-facebook"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-twitter"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-google-plus"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-youtube"></i></a>
								</li>
							</ul>
	    				</div>
	    			</div>
    			</div>    			
	    	</div>  
    	</div>	
    </div><!--/#contact-page-->

	
	<script>
	function submit_email(){
		var check = true;
		var error_msg = [];
		
		var name = $("#name").val();
		var email = $("#email").val();
		var subject = $("#subject").val();
		var message = $("#message").val();
		
		$("#main-contact-form .form-control").removeClass("errorBorder");
		$("#main-contact-form .form-control").each(function(){
			if($.trim($(this).val()) == ""){
				$(this).addClass("errorBorder");
				check = false;
				error_msg.push("<?php echo $LANG_BLANK;?>");
			}
		});

		if(check){
			$.ajax({
				url: '?pact=contact-us',
				type: 'POST',
				dataType: 'json',
				data: {
					name: name,
					email: email,
					subject: subject,
					message: message
				},
				success:function(data){
					if(data[1]){
						alert(data[1]);
					}else{
						alert(data[1]);
					}
				}
			});
		}else{
			alert($.unique(error_msg).join("\n"));
		}
	}
		
	</script>