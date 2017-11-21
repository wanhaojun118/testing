<!-- Latest compiled and minified CSS -->


<!-- Latest compiled and minified JavaScript -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.11.2/js/bootstrap-select.min.js"></script> -->

<style>
	.errorBorder{
		border: 1px solid red;
	}
	
	select{
		background: none;
		border: 1px solid #bdb9b9;
	}
</style>


<?php if(isset($member)){ ?>
<div class="panel panel-default" >
    <div class="panel-heading">
        <b><?php echo $LANG_EDIT_PROFILE;?></b>
    </div>
<div class="panel-body">	
	<div class="box box-info">
		<form id="edit_form" class="form-horizontal">
			<div class="box-body">
			
				<div class="form-group">
					<label for="" class="col-sm-3 control-label"><?php echo $LANG_NAME;?></label>
					<div class="col-sm-9">
						<input type="text" class="form-control required" id="member_name" name="member_name" value = "<?php echo $member -> getMember_name();?>" />
					</div>
				</div>
				
				<div class="form-group">
					<label for="" class="col-sm-3 control-label"><?php echo $LANG_EMAIL;?></label>
					<div class="col-sm-9">
						<input type = "text" class="form-control required" id="member_email" name="member_email" value = "<?php echo $member -> getMember_email();?>"/>
					</div>
				</div>
				
				<div class="form-group">
					<?php 
						$stmt_select_birthday = $mysqli -> prepare("SELECT member_birthday FROM member WHERE member_id = ?");
						$stmt_select_birthday -> bind_param('i', $member -> getMember_id());
						$stmt_select_birthday -> execute();
						$stmt_select_birthday -> store_result();
						$stmt_select_birthday -> bind_result($member_birthday);
						$stmt_select_birthday -> fetch();
						$birthday = explode("/", $member_birthday);
						// if($birthday[1] == "01" || $birthday[1] == "January"){
							// $birthday[1] = "January";
						// }else if($birthday[1] == "02" || $birthday[1] == "Febuary"){
							// $birthday[1] = "Febuary";
						// }else if($birthday[1] == "03" || $birthday[1] == "March"){
							// $birthday[1] = "March";
						// }else if($birthday[1] == "04" || $birthday[1] == "April"){
							// $birthday[1] = "April";
						// }else if($birthday[1] == "05" || $birthday[1] == "May"){
							// $birthday[1] = "May";
						// }else if($birthday[1] == "06" || $birthday[1] == "June"){
							// $birthday[1] = "June";
						// }else if($birthday[1] == "07" || $birthday[1] == "July"){
							// $birthday[1] = "July";
						// }else if($birthday[1] == "08" || $birthday[1] == "August"){
							// $birthday[1] = "August";
						// }else if($birthday[1] == "09" || $birthday[1] == "September"){
							// $birthday[1] = "September";
						// }else if($birthday[1] == "10" || $birthday[1] == "October"){
							// $birthday[1] = "October";
						// }else if($birthday[1] == "11" || $birthday[1] == "November"){
							// $birthday[1] = "November";
						// }else if($birthday[1] == "12" || $birthday[1] == "December"){
							// $birthday[1] = "December";
						// }
					?>
					<label for="" class="col-sm-3 control-label"><?php echo $LANG_BIRTHDAY;?></label>
					<div class="col-sm-9">
						<div class = "birthday-collection" style = "display:flex;">
							<select class = "birthday" id = "birthday-day">
							<option value = "<?php echo $birthday[0];?>" selected = "selected"><?php echo $birthday[0];?></option>
							<?php 
								for($day = 01; $day < 32; $day++){
							?>
								<option value = "<?php echo $day;?>"><?php echo $day; }?></option>
							</select>
						
							<select class = "birthday" id = "birthday-month" style = "margin: 0 0 0 10px;">
								<option value = "<?php echo $birthday[1];?>" selected = "selected"><?php echo $birthday[1];?></option>
								<option value = "January">January</option>
								<option value = "Febuary">Febuary</option>
								<option value = "March">March</option>
								<option value = "April">April</option>
								<option value = "May">May</option>
								<option value = "June">June</option>
								<option value = "July">July</option>
								<option value = "August">August</option>
								<option value = "September">September</option>
								<option value = "October">October</option>
								<option value = "November">November</option>
								<option value = "December">December</option>
							</select>
				
							<select class = "birthday" id = "birthday-year" style = "margin: 0 0 0 10px;">
								<option value = "<?php echo $birthday[2];?>" selected = "selected"><?php echo $birthday[2];?></option>
								<?php
									for($year = 2017; $year > 1899; $year--){
								?>
								<option value = "<?php echo $year;?>"><?php echo $year;?></option>
								<?php } ?>
							</select>
						</div>
					</div>
				</div>
				
				<div class="form-group">
					<label for="" class="col-sm-3 control-label"><?php echo $LANG_GENDER;?></label>
					<div class="col-sm-9">
						<input type = "hidden" id = "member_gender" value = "<?php echo $member -> getMember_gender();?>"/>
						<input type = "radio" class="gender" id="gender-male" name="gender" value = "Male" style = "margin: 0 20px 0 0;"/><?php echo $LANG_MALE;?>
						<input type = "radio" class="gender" id = "gender-female" name = "gender" value = "Female" style = "margin: 0 20px 0 40px;"/><?php echo $LANG_FEMALE;?>
					</div>
				</div>
				
				<div class = "form-group">
					<label for = "" class="col-sm-3 control-label"><?php echo $LANG_ADDRESS;?></label>
					<div class = "col-sm-9">
						<input type = "text" class="form-control required" id = "member_address" name = "member_address" value = "<?php echo $member->getMember_address();?>"/>
					</div>
				</div>
				
				<div class = "form-group">
					<label for = "" class="col-sm-3 control-label"><?php echo $LANG_POSTCODE;?></label>
					<div class = "col-sm-9">
						<input type = "text" class="form-control required" id = "member_postcode" name = "member_postcode" value = "<?php echo $member->getMember_postcode();?>"/>
					</div>
				</div>
				
				<div class = "form-group">
					<label for = "" class="col-sm-3 control-label"><?php echo $LANG_CITY;?></label>
					<div class = "col-sm-9">
						<input type = "text" class="form-control required" id = "member_city" name = "member_city" value = "<?php echo $member->getMember_city();?>"/>
					</div>
				</div>
				
				<div class = "form-group">
					<label for = "" class="col-sm-3 control-label"><?php echo $LANG_PROVINCE;?></label>
					<div class = "col-sm-9">
						<input type = "text" class="form-control required" id = "member_province" name = "member_province" value = "<?php echo $member->getMember_province();?>"/>
					</div>
				</div>
				
				<div class = "form-group">
					<label for = "" class="col-sm-3 control-label"><?php echo $LANG_COUNTRY;?></label>
					<div class = "col-sm-9">
						<select id = "member_country" name="member_country">
							<?php
								$stmt_select_member_country = $mysqli -> prepare("SELECT c.country_name FROM `country` c JOIN `member` m  WHERE m.member_id = ? AND m.member_country = c.country_id");
								$stmt_select_member_country -> bind_param('i', $member->getMember_id());
								$stmt_select_member_country -> execute();
								$stmt_select_member_country -> store_result();
								$stmt_select_member_country -> bind_result($member_country);
								$stmt_select_member_country -> fetch();
							?>
							<option value = "<?php echo $member->getMember_country();?>"><?php echo $member_country;?></option>
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
					<label for = "" class="col-sm-3 control-label"><?php echo $LANG_PHONE;?></label>
					<div class = "col-sm-9">
						<input type = "text" class="form-control required" id = "member_phone" name = "member_phone" value = "<?php echo $member->getMember_phone();?>"/>
					</div>
				</div>
			</div>	
			
			<div class="bg-default content-box text-center pad20A mrg25T">
				<input type = "button" class="btn btn-primary" onclick="edit()" value = "Submit"/>
				<input type = "reset" class = "btn btn-primary" value = "Cancel"/>
			</div>
		</form>	
	</div>
	</div>
</div>
<?php } else {} ?>


<script>
$(function() {
	if($("#member_gender").val() == "Male"){
		$("input:radio[name=gender]").filter('[value = "Male"]').attr("checked", true);
	}else{
		$("input:radio[name=gender]").filter('[value = "Female"]').attr("checked", true);
	}
});

function edit() {
	if (confirm("<?php echo $LANG_CONFIRM ?>")) {
		var check = true;
		var error_msg = [];
		
		var member_name = $("#member_name").val();
		var member_email = $("#member_email").val();
		var member_birthday = $("#birthday-day").val() + "/" + $("#birthday-month").val() + "/" + $("#birthday-year").val();
		var member_gender = $('input[name = gender]:checked', '#edit_form').val();
		var member_address = $("#member_address").val();
		var member_postcode = $("#member_postcode").val();
		var member_city = $("#member_city").val();
		var member_province = $("#member_province").val();
		var member_country = $("#member_country").val();
		var member_phone = $("#member_phone").val();
		
		var pattern = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{3,}))$/;

		$("#edit_form input").removeClass("errorBorder");
		$("#edit_form input").each(function(){
			if($.trim($(this).val()) == ""){
				$(this).addClass("errorBorder");
				check = false;
				error_msg.push("<?php echo $LANG_BLANK;?>");
			}
		});
		
		$(".birthday").each(function(){
			if($.trim($(this).val()) == ""){
				$(this).addClass("errorBorder");
				check = false;
			}
		});
		
		$("#member_email").each(function(){
			if($.trim($(this).val()) !== ""){
				if(!pattern.test($(this).val())){
					$(this).addClass("errorBorder");
					error_msg.push("<?php echo $LANG_INVALID_EMAIL_FORMAT;?>")
					check = false;
				}
			}
		});
		
		if (check) {
			$.ajax({
				dataType: 'json',
				type: 'POST',
				url: '?pact=edit_profile',
				data: {
					member_name: member_name,
					member_email: member_email,
					member_birthday: member_birthday,
					member_gender: member_gender,
					member_address: member_address,
					member_postcode: member_postcode,
					member_city: member_city,
					member_province: member_province,
					member_country: member_country,
					member_phone: member_phone
				},
				success: function(data) {
					if (data[0]) {
						alert(data[1]);
						location.reload(true);
					} else {
						alert(data[1]);
					}
				}
			});
		} else {
			alert(jQuery.unique(error_msg).join("\n\n"));
		}
	}
}

function back(){
	location.replace("?loc=dashboard");
}
</script>

