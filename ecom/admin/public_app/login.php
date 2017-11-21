<?php
//require_once("plugin/securimage/securimage.php");
?> 
<script type="text/javascript">
    function login() {
        var username = $.trim($('#admin_username').val());
        var password = $.trim($('#admin_password').val());

        //   var verification_captcha_code = $('#verification_captcha_code').val();
        //  var captchaId = $('#captchaId').val();
       $('.errorBorder').removeClass("errorBorder");
	   if (!username) {
			$('#admin_username').addClass("errorBorder");
            $('#admin_username').val("");
            $('#admin_password').val("");
            alert_notice("alert_warning", "<?php echo ucwords($LANG_LOGIN_USERNAME_ERROR); ?>");
        } else if (!password) {
			$('#admin_password').addClass("errorBorder");
            $('#admin_password').val("");
            alert_notice("alert_warning", "<?php echo ucwords($LANG_LOGIN_PASSWORD_ERROR); ?>");
        } /*
         else if (!verification_captcha_code) {
         $('#verification_captcha_code').val("");
         alert_notice("alert_warning", "<?php echo ucwords($LANG_LOGIN_VERIFICATION_ERROR); ?>");
         } */

        else {
            //show_processing();
            $.ajax({
                url: '?pact=login',
                type: "POST",
                dataType: 'json',
                data: {
                    username: username,
                    password: password
                },
                success: function (data) {
                    //hide_processing();
                    if (data[0]) {
                        window.location = '?loc=dashboard';
                    } else {
                        alert(data[1]);
                        window.location.reload();
                    }

                }
            });
        }
    }
</script>
<div class="center-vertical bg-black">
	<div class="center-content">
		<form id="login-validation" class="col-md-5 col-sm-5 col-xs-11 center-margin">
			<h3 class="text-center pad25B font-gray font-size-23">Admin <span class="opacity-80">v1.0</span></h3>
            <div id="login-form" class="content-box">
				<div class="content-box-wrapper pad20A">
					<div class="form-group">
                        <label for="exampleInputEmail1">Username:</label>
                        <div class="input-group input-group-lg">
							<span class="input-group-addon addon-inside bg-white font-primary">
								<i class="glyph-icon icon-user"></i>
                            </span>
							<input type="text" class="form-control" id="admin_username" placeholder="Enter username">
                        </div>
                    </div>
                    <div class="form-group">
						<label for="exampleInputPassword1">Password:</label>
                        <div class="input-group input-group-lg">
                            <span class="input-group-addon addon-inside bg-white font-primary">
                                <i class="glyph-icon icon-unlock-alt"></i>
                            </span>
                            <input type="password" class="form-control" id="admin_password" placeholder="Password">
                        </div>
                    </div>
					<div class="row">
                        <div id="alert_warning"></div>
                    </div>
                </div>
                <div class="button-pane">
                    <a onclick="login()" class="btn btn-block btn-primary">Login</a>
                </div>
            </div>

           

        </form>

    </div>
</div>



