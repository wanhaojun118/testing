<!DOCTYPE html>
<html lang="en">
<style>
	.errorBorder {
		border: 1px solid red;
	}
</style>
<body>
	<section id="form"><!--form-->
		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-sm-offset-1">
					<div class="login-form"><!--login form-->
						<h2><?php echo $LANG_LOGIN_TO_YOUR_ACCOUNT;?></h2>
						<form id = "login-form">
							<label for = "login-email"><?php echo $LANG_EMAIL;?>: </label>
							<input type="text" id = "login-email" placeholder="Email" />
							
							<label for = "login-password"><?php echo $LANG_PASSWORD;?>: </label>
							<input type="password" id = "login-password" placeholder="Password" />
							<span>
								<input type="checkbox" class="checkbox" id = "checkbox" name = "checkbox" value = "checked"> 
								<?php echo $LANG_KEEP_ME_SIGNED_IN;?>
							</span>
							
							<div class = "collection" style = "display: flex;">
								<button type="button" class="btn btn-default" style = "margin-left:-22px;" onclick = "login()"><?php echo $LANG_LOGIN;?></button>
								<button type = "reset" class = "btn btn-default" style = "margin: 0 0 0 20px; max-height: 32px; transform: translateY(23px);"><?php echo $LANG_CANCEL;?></button>
							</div>
						</form>
					</div><!--/login form-->
				</div>
				<div class="col-sm-1">
					<h2 class="or"><?php echo $LANG_OR;?></h2>
				</div>
				<div class="col-sm-4">
					<div class="signup-form"><!--sign up form-->
						<h2><?php echo $LANG_NEW_USER_SIGNUP;?></h2>
						<form id = "register-form">
							<label for = "name"><?php echo $LANG_NAME;?>: </label>
							<input type="text" id = "name" class = "name" value = "" placeholder="<?php echo $LANG_NAME;?>"/>
							
							<label for = "birthday-combo"><?php echo $LANG_BIRTHDAY;?>: </label>
							<div class = "collection" id = "birthday-combo" style = "display:flex; margin: 10px 0 10px 0;">
								<select class = "birthday" id = "birthday-day">
									<option value = "" selected = "selected"><?php echo $LANG_DAY;?></option>
									<?php 
										for($day = 01; $day < 32; $day++){
									?>
										<option value = "<?php echo $day;?>"><?php echo $day; }?></option>	
								</select>
								
								<select class = "birthday" id = "birthday-month" style = "margin: 0 0 0 5px;">
									<option value = "" selected = "selected"><?php echo $LANG_MONTH;?></option>
									<option value = "01">January</option>
									<option value = "02">Febuary</option>
									<option value = "03">March</option>
									<option value = "04">April</option>
									<option value = "05">May</option>
									<option value = "06">June</option>
									<option value = "07">July</option>
									<option value = "08">August</option>
									<option value = "09">September</option>
									<option value = "10">October</option>
									<option value = "11">November</option>
									<option value = "12">December</option>
								</select>
								
								<select class = "birthday" id = "birthday-year" style = "margin: 0 0 0 5px;">
									<option value = "" selected = "selected"><?php echo $LANG_YEAR;?></option>
									<?php 
										for($year = 2017; $year >1899; $year--){
									?>
									<option value = "<?php echo $year;?>"><?php echo $year; }?></option>
								</select>
							</div>
							
							<label for = "email"><?php echo $LANG_EMAIL;?>: </label>
							<input type="email" id = "email" class = "email" placeholder="<?php echo $LANG_EMAIL;?>"/>
							
							<label for = "password"><?php echo $LANG_PASSWORD;?>: </label>
							<input type="password" id = "password" class = "password" placeholder="<?php echo $LANG_PASSWORD;?>"/>
							
							<label for= "confirm-password"><?php echo $LANG_CONFIRM_PASSWORD;?>: </label>
							<input type = "password" id = "confirm-password" class = "confirm-password" placeholder = "<?php echo $LANG_CONFIRM_PASSWORD;?>"?>
							
							<label for = "gender"><?php echo $LANG_GENDER;?>: </label>
							<div class = "collection" id = "gender" style = "display:-webkit-box; margin: 10px 0 10px 70px;">
								<label for = "radio-gender-male" style = "color:blue;"><?php echo $LANG_MALE;?></label>
								<input type = "radio" value = "Male" id = "radio-gender-male" class = "radio-gender" name = "radio-gender" style = "width:20px; height:20px; margin:0 0 0 20px;"/> 
								<label for = "radio-gender-female" style = "margin:0 0 0 30px; color:hotpink;"><?php echo $LANG_FEMALE;?></label>
								<input type = "radio" value = "Female" id = "radio-gender-female" class = "radio-gender" name = "radio-gender" checked = "checked" style = "width:20px; height:20px; margin:0 0 0 20px;"/> 
							</div>
							
							<div class = "form-group">
								<label for = ""><?php echo $LANG_ADDRESS;?>: </label>
								<div class = "">
									<input type = "text" id = "address" name = "address" placeholder = "<?php echo $LANG_ADDRESS;?>"/>
								</div>
							</div>
							
							<div class = "form-group">
								<label for = ""><?php echo $LANG_POSTCODE;?>: </label>
								<div class = "">
									<input type = "text" id = "postcode" name = "postcode" placeholder = "<?php echo $LANG_POSTCODE;?>"/>
								</div>
							</div>
							
							<div class = "form-group">
								<label for = ""><?php echo $LANG_CITY;?>: </label>
								<div class = "">
									<input type = "text" id = "city" name = "city" placeholder = "<?php echo $LANG_CITY;?>"/>
								</div>
							</div>
							
							<div class = "form-group">
								<label for = ""><?php echo $LANG_PROVINCE;?>: </label>
								<div class = "">
									<input type = "text" id = "province" name = "province" placeholder = "<?php echo $LANG_PROVINCE;?>"/>
								</div>
							</div>
							
							<div class = "form-group">
								<label for = ""><?php echo $LANG_COUNTRY;?>: </label>
								<div class = "">
									<select id = "country" name = "country">
										<option value = ""><?php echo $LANG_COUNTRY;?></option>
										<?php
											$stmt_select_country = $mysqli -> prepare("SELECT country_id, country_name FROM country");
											$stmt_select_country -> execute();
											$stmt_select_country -> store_result();
											$stmt_select_country -> bind_result($country_id, $country_name);
											while($stmt_select_country -> fetch()){
										?>
										<option value = "<?php echo $country_id;?>"><?php echo $country_name;?></option>
										<?php 	} ?>
									</select>
								</div>
							</div>
							
							<div class = "form-group">
								<label for = ""><?php echo $LANG_PHONE;?>: </label>
								<div class = "">
									<input type = "text" id = "phone" name = "phone" placeholder = "<?php echo $LANG_PHONE;?>"/>
								</div>
							</div>
							
							<div class = "collection" style = "display: flex;">
								<button type="button" class="btn btn-default" onclick = "register()"><?php echo $LANG_SIGNUP;?></button>
								<button type = "reset" class = "btn btn-default" style = "margin: 0 0 0 20px;"><?php echo $LANG_CANCEL;?></button>
							</div>
						</form>
					</div><!--/sign up form-->
				</div>
			</div>
		</div>
	</section><!--/form-->
	
	<script>
		// REGISTER
		function register(){
			var member_name = $("#name").val();
			var member_birthday = $("#birthday-day").val() + "/" + $("#birthday-month").val() + "/" + $("#birthday-year").val();
			var member_email = $("#email").val();
			var member_password = $("#password").val();
			var member_confirm_password = $("#confirm-password").val();
			var member_gender = $("input[name=radio-gender]:checked").val();
			var member_address = $("#address").val();
			var member_postcode = $("#postcode").val();
			var member_city = $("#city").val();
			var member_province = $("#province").val();
			var member_country = $("#country").val();
			var member_phone = $("#phone").val();
			
			var check = true;
			var error_msg = [];
			var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
			
			
			$("#register-form input").removeClass("errorBorder");
			$("#register-form input").each(function(){
				if($.trim($(this).val()) == ""){
					$(this).addClass("errorBorder");
					check = false;
					error_msg.push("<?php echo $LANG_FORM_BLANK;?>");
				}
			});
			
			$(".password").each(function(){
				if($.trim($(this).val()) !== ""){
					if(($.trim($(this).val()).length < 6) || ($.trim($(this).val()).length > 12)){
						$(this).addClass("errorBorder");
						check = false;
						error_msg.push("<?php echo $LANG_PASSWORD_WRONG_FORMAT;?>");
					}
				}
			});
			
			$(".email").each(function(){
				if($.trim($(this).val()) !== ""){
					if(!pattern.test($(this).val())){
						$(this).addClass("errorBorder");
						error_msg.push("<?php echo $LANG_INVALID_EMAIL_FORMAT;?>")
						check = false;
					}
				}
			});
			
			$(".birthday").each(function(){
				if($.trim($(this).val()) == ""){
					$(this).addClass("errorBorder");
					check = false;
				}
			});
			
			if(member_password !== member_confirm_password){
				$("#confirm-password").addClass("errorBorder");
				check = false;
				error_msg.push("<?php echo $LANG_PASSWORD_AND_CPASSWORD_DIFFERENT;?>")
			}
			
			if(check){
				$.ajax({
					url: '?pact=register',
					type: 'POST',
					dataType: 'json',
					data: {
						member_name: member_name,
						member_birthday: member_birthday,
						member_email: member_email,
						member_password: member_password,
						member_gender: member_gender,
						member_address: member_address,
						member_postcode: member_postcode,
						member_city: member_city,
						member_province: member_province,
						member_country: member_country,
						member_phone: member_phone
					},
					success: function(data){
						if(data[0]){
							alert(data[1]);
							location.reload(true);
						}else{
							alert(data[1]);
							location.reload(true);
						}
					}
				});
			}else{
				alert($.unique(error_msg).join("\n\n"));
			}
		}
		
		
		
		// LOGIN
		function login(){
			var member_email = $("#login-email").val();
			var member_password = $("#login-password").val();
			if($("#checkbox").is(":checked")){
				var remember_user = true;
			}else{
				var remember_user = false;
			}
		
			var check = true;
			var error_msg = [];
			var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
			
			$("#login-form input").removeClass("errorBorder");
			$("#login-email").each(function(){
				if($.trim($(this).val()) == ""){
					$(this).addClass("errorBorder");
					check = false;
					error_msg.push("<?php echo $LANG_EMAIL_BLANK;?>");
				}else{
					if(!pattern.test($(this).val())){
						$(this).addClass("errorBorder");
						error_msg.push("<?php echo $LANG_INVALID_EMAIL_FORMAT;?>")
						check = false;
					}
				}
			});
			
			$("#login-password").each(function(){
				if($.trim($(this).val()) == ""){
					$(this).addClass("errorBorder");
					check = false;
					error_msg.push("<?php echo $LANG_PASSWORD_BLANK;?>");
				}
			});
			
			if(check){
				$.ajax({
					url: '?pact=login',
					type: 'POST',
					dataType: 'json',
					data: {
						member_email: member_email,
						member_password: member_password,
						//remember_user: remember_user
					},
					success: function(data){
						if(data[0]){
							alert(data[1]);
							window.location = "?papp=home";
						}else{
							alert(data[1]);
						}
					}
				});
			}else{
				alert($.unique(error_msg).join("\n\n"));
			}
		}
		
	</script>
	
	
</body>
</html>