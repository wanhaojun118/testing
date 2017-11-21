<!DOCTYPE html> 
<html lang="en">
	<head>
	<meta charset="UTF-8">
	<!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
	<title><?php echo WEBSITE_TITLE;?></title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

	<!-- Favicons 
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/images/icons/apple-touch-icon-144-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/images/icons/apple-touch-icon-114-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/images/icons/apple-touch-icon-72-precomposed.png">
	<link rel="apple-touch-icon-precomposed" href="assets/images/icons/apple-touch-icon-57-precomposed.png">
	<link rel="shortcut icon" href="assets/images/icons/favicon.png">-->
	<link rel="shortcut icon" href="<?php print WEBSITE_ICON; ?>" />
	
	<!-- HELPERS -->
	<link rel="stylesheet" type="text/css" href="assets/helpers/animate.css">
	<link rel="stylesheet" type="text/css" href="assets/helpers/boilerplate.css">
	<link rel="stylesheet" type="text/css" href="assets/helpers/border-radius.css">
	<link rel="stylesheet" type="text/css" href="assets/helpers/grid.css">
	<link rel="stylesheet" type="text/css" href="assets/helpers/page-transitions.css">
	<link rel="stylesheet" type="text/css" href="assets/helpers/spacing.css">
	<link rel="stylesheet" type="text/css" href="assets/helpers/typography.css">
	<link rel="stylesheet" type="text/css" href="assets/helpers/utils.css">
	<link rel="stylesheet" type="text/css" href="assets/helpers/colors.css">

	<!-- MATERIAL -->
	<link rel="stylesheet" type="text/css" href="assets/material/ripple.css">

	<!-- ELEMENTS -->
	<link rel="stylesheet" type="text/css" href="assets/elements/badges.css">
	<link rel="stylesheet" type="text/css" href="assets/elements/buttons.css">
	<link rel="stylesheet" type="text/css" href="assets/elements/content-box.css">
	<link rel="stylesheet" type="text/css" href="assets/elements/dashboard-box.css">
	<link rel="stylesheet" type="text/css" href="assets/elements/forms.css">
	<link rel="stylesheet" type="text/css" href="assets/elements/images.css">
	<link rel="stylesheet" type="text/css" href="assets/elements/info-box.css">
	<link rel="stylesheet" type="text/css" href="assets/elements/invoice.css">
	<link rel="stylesheet" type="text/css" href="assets/elements/loading-indicators.css">
	<link rel="stylesheet" type="text/css" href="assets/elements/menus.css">
	<link rel="stylesheet" type="text/css" href="assets/elements/panel-box.css">
	<link rel="stylesheet" type="text/css" href="assets/elements/response-messages.css">
	<link rel="stylesheet" type="text/css" href="assets/elements/responsive-tables.css">
	<link rel="stylesheet" type="text/css" href="assets/elements/ribbon.css">
	<link rel="stylesheet" type="text/css" href="assets/elements/social-box.css">
	<link rel="stylesheet" type="text/css" href="assets/elements/tables.css">
	<link rel="stylesheet" type="text/css" href="assets/elements/tile-box.css">
	<link rel="stylesheet" type="text/css" href="assets/elements/timeline.css">

	<!-- ICONS -->
	<link rel="stylesheet" type="text/css" href="assets/icons/fontawesome/fontawesome.css">
	<link rel="stylesheet" type="text/css" href="assets/icons/linecons/linecons.css">
	<link rel="stylesheet" type="text/css" href="assets/icons/spinnericon/spinnericon.css">
	<link rel="stylesheet" type="text/css" href="assets/icons/iconic/iconic.css">
	<link rel="stylesheet" type="text/css" href="assets/icons/elusive/elusive.css">

	<!-- WIDGETS -->
	<link rel="stylesheet" type="text/css" href="assets/widgets/accordion-ui/accordion.css">
	<link rel="stylesheet" type="text/css" href="assets/widgets/calendar/calendar.css">
	<link rel="stylesheet" type="text/css" href="assets/widgets/carousel/carousel.css">

	<link rel="stylesheet" type="text/css" href="assets/widgets/charts/justgage/justgage.css">
	<link rel="stylesheet" type="text/css" href="assets/widgets/charts/morris/morris.css">
	<link rel="stylesheet" type="text/css" href="assets/widgets/charts/piegage/piegage.css">
	<link rel="stylesheet" type="text/css" href="assets/widgets/charts/xcharts/xcharts.css">

	<link rel="stylesheet" type="text/css" href="assets/widgets/chosen/chosen.css">
	<link rel="stylesheet" type="text/css" href="assets/widgets/colorpicker/colorpicker.css">
	<link rel="stylesheet" type="text/css" href="assets/widgets/datatable/datatable.css">
	<link rel="stylesheet" type="text/css" href="assets/widgets/datepicker/datepicker.css">
	<link rel="stylesheet" type="text/css" href="assets/widgets/datepicker-ui/datepicker.css">
	<link rel="stylesheet" type="text/css" href="assets/widgets/daterangepicker/daterangepicker.css">
	<link rel="stylesheet" type="text/css" href="assets/widgets/dialog/dialog.css">
	<link rel="stylesheet" type="text/css" href="assets/widgets/dropdown/dropdown.css">
	<link rel="stylesheet" type="text/css" href="assets/widgets/dropzone/dropzone.css">
	<link rel="stylesheet" type="text/css" href="assets/widgets/file-input/fileinput.css">
	<link rel="stylesheet" type="text/css" href="assets/widgets/input-switch/inputswitch.css">
	<link rel="stylesheet" type="text/css" href="assets/widgets/input-switch/inputswitch-alt.css">
	<link rel="stylesheet" type="text/css" href="assets/widgets/ionrangeslider/ionrangeslider.css">
	<link rel="stylesheet" type="text/css" href="assets/widgets/jcrop/jcrop.css">
	<link rel="stylesheet" type="text/css" href="assets/widgets/jgrowl-notifications/jgrowl.css">
	<link rel="stylesheet" type="text/css" href="assets/widgets/loading-bar/loadingbar.css">
	<link rel="stylesheet" type="text/css" href="assets/widgets/maps/vector-maps/vectormaps.css">
	<link rel="stylesheet" type="text/css" href="assets/widgets/markdown/markdown.css">
	<link rel="stylesheet" type="text/css" href="assets/widgets/modal/modal.css">
	<link rel="stylesheet" type="text/css" href="assets/widgets/multi-select/multiselect.css">
	<link rel="stylesheet" type="text/css" href="assets/widgets/multi-upload/fileupload.css">
	<link rel="stylesheet" type="text/css" href="assets/widgets/nestable/nestable.css">
	<link rel="stylesheet" type="text/css" href="assets/widgets/noty-notifications/noty.css">
	<link rel="stylesheet" type="text/css" href="assets/widgets/popover/popover.css">
	<link rel="stylesheet" type="text/css" href="assets/widgets/pretty-photo/prettyphoto.css">
	<link rel="stylesheet" type="text/css" href="assets/widgets/progressbar/progressbar.css">
	<link rel="stylesheet" type="text/css" href="assets/widgets/range-slider/rangeslider.css">
	<link rel="stylesheet" type="text/css" href="assets/widgets/slidebars/slidebars.css">
	<link rel="stylesheet" type="text/css" href="assets/widgets/slider-ui/slider.css">
	<link rel="stylesheet" type="text/css" href="assets/widgets/summernote-wysiwyg/summernote-wysiwyg.css">
	<link rel="stylesheet" type="text/css" href="assets/widgets/tabs-ui/tabs.css">
	<link rel="stylesheet" type="text/css" href="assets/widgets/timepicker/timepicker.css">
	<link rel="stylesheet" type="text/css" href="assets/widgets/tocify/tocify.css">
	<link rel="stylesheet" type="text/css" href="assets/widgets/tooltip/tooltip.css">
	<link rel="stylesheet" type="text/css" href="assets/widgets/touchspin/touchspin.css">
	<link rel="stylesheet" type="text/css" href="assets/widgets/uniform/uniform.css">
	<link rel="stylesheet" type="text/css" href="assets/widgets/wizard/wizard.css">
	<link rel="stylesheet" type="text/css" href="assets/widgets/xeditable/xeditable.css">

	<!-- SNIPPETS -->
	<link rel="stylesheet" type="text/css" href="assets/snippets/chat.css">
	<link rel="stylesheet" type="text/css" href="assets/snippets/files-box.css">
	<link rel="stylesheet" type="text/css" href="assets/snippets/login-box.css">
	<link rel="stylesheet" type="text/css" href="assets/snippets/notification-box.css">
	<link rel="stylesheet" type="text/css" href="assets/snippets/progress-box.css">
	<link rel="stylesheet" type="text/css" href="assets/snippets/todo.css">
	<link rel="stylesheet" type="text/css" href="assets/snippets/user-profile.css">
	<link rel="stylesheet" type="text/css" href="assets/snippets/mobile-navigation.css">

	<!-- APPLICATIONS -->
	<link rel="stylesheet" type="text/css" href="assets/applications/mailbox.css">

	<!-- Admin theme -->
	<link rel="stylesheet" type="text/css" href="assets/themes/admin/layout.css">
	<link rel="stylesheet" type="text/css" href="assets/themes/admin/color-schemes/default.css">

	<!-- Components theme -->
	<link rel="stylesheet" type="text/css" href="assets/themes/components/default.css">
	<link rel="stylesheet" type="text/css" href="assets/themes/components/border-radius.css">

	<!-- Admin responsive -->
	<link rel="stylesheet" type="text/css" href="assets/helpers/responsive-elements.css">
	<link rel="stylesheet" type="text/css" href="assets/helpers/admin-responsive.css">

	<!-- JS Core 
	<script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="js/bootstrap/bootstrap.min.js"></script>-->
	<script type="text/javascript" src="assets/js-core/jquery-core.js"></script>
	<script type="text/javascript" src="assets/js-core/jquery-ui-core.js"></script>
	<script type="text/javascript" src="assets/js-core/jquery-ui-widget.js"></script>
	<script type="text/javascript" src="assets/js-core/jquery-ui-mouse.js"></script>
	<script type="text/javascript" src="assets/js-core/jquery-ui-position.js"></script>
	<script type="text/javascript" src="assets/js-core/transition.js"></script>
	<script type="text/javascript" src="assets/js-core/modernizr.js"></script>
	<script type="text/javascript" src="assets/js-core/jquery-cookie.js"></script>
	
	<link rel="stylesheet" type="text/css" href="assets/frontend-elements/pricing-table.css">
	
	<!--Bootstrap -->
	<link rel="stylesheet" type="text/css" href="assets/bootstrap/css/bootstrap.min.css">
	<script type="text/javascript" src="assets/bootstrap/js/bootstrap.min.js"></script>
	
	<!-- CKEditor -->
	<script type="text/javascript" src="assets/widgets/ckeditor/ckeditor.js"></script>
	
	<!-- Custom Fonts -->
    <link href="plugin/bootstrap/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

	
	<?php include "js/public.php";?>
	<script type="text/javascript">
	$(document).ready(function(){
		setTimeout(function() {
			$('#loading').fadeOut( 400, "linear" );
		}, 300);
	});

	</script>

	<style>
		#loading .svg-icon-loader {position: absolute;top: 50%;left: 50%;margin: -50px 0 0 -50px;}
		
		.errorBorder{
			border:1px solid red;
		}
		
		#sidebar-menu li .sidebar-submenu ul li a{
			text-decoration:none;
		}
		
		#sidebar-menu li a:active{
			display: block;
		}
		
		a{
			cursor:pointer;
			color:#fff;
			text-decoration:none;
		}
		footer {
			width: 100%;
			background: #272634;
			float: left;
			margin: 0 0 0 0;
		}

		footer p{
			font-size : 16px; 
			text-align : center; 
			color: #efefef;
			padding: 1% 0;
			text-shadow: 1px 1px 0px #202020
		}
		
		#date_time{
			text-align: right;
			color: #000;
			margin-top: -20px;
		}
		
		@media only screen and (max-width: 991px){
			#date_time{
				margin-top:0px;
				text-align:center;
			}
		}


		.modal{
			z-index: 99999999999999999;
			padding-top:50px;
		}
		
	

	</style>
</head>

<body>
    <div id="sb-site">
		<div id="loading">
			<div class="svg-icon-loader">
				<img src="assets/images/svg-loaders/bars.svg" width="40" alt="">
			</div>
		</div>
    <div id="page-wrapper">
        <div id="mobile-navigation">
			<button id="nav-toggle" class="collapsed" data-toggle="collapse" data-target="#page-sidebar"><span></span></button>
		</div>
		<div id="page-sidebar" style="height:100%">
			<div id="header-logo" class="logo-bg">
			<a href="?loc=dashboard" class="logo-content-big" title="">

			</a>
			<a href="?loc=dashboard" class="logo-content-small" title="">
				
			</a>
			<a id="close-sidebar" href="#" title="Close sidebar">
				<i class="glyph-icon icon-outdent"></i>
			</a>
			</div>
				<div class="scroll-sidebar">
					<ul id="sidebar-menu">
						<li class="header"><?php echo $LANG_MENU;?></li>
						<li>
							<a href="?loc=dashboard" title="<?php echo $LANG_DASHBOARD;?>">
								<i class="glyph-icon icon-linecons-tv"></i>
								<span style = "position:absolute; padding-left:10px;"><?php echo $LANG_DASHBOARD;?></span>
							</a>       
						</li>
						<li>
							<a href="javascript:void(0);" title="<?php echo $LANG_MOBILE_TOPUP;?>">
								<i class="glyph-icon icon-linecons-mobile"></i>
								<!--<image src = "images/login_page/icon/icon1.png" style = "width:30px;height:30px;" alt = "Mobile Top Up"/>-->
								<span style = "position:absolute; padding-left:10px;"><?php echo $LANG_MEMBER;?></span>
							</a>
							<div class="sidebar-submenu">
								<ul>        
									<li><a href = "?loc=member_list"><span><?php echo $LANG_MEMBER_LIST;?></span></a></li>
								</ul>
							</div>
						</li>
						<li>
							<a title="<?php echo $LANG_PRODUCT;?>">
								<i class="glyph-icon icon-shopping-cart"></i>
								<!--<image src = "images/login_page/icon/icon3.png" style = "width:30px;height:30px"/>-->
								<span style = "position:absolute; padding-left:10px;"><?php echo $LANG_PRODUCT;?></span>
							</a>
							<div class="sidebar-submenu">
								<ul>
									<li><a href = "?loc=product_category"><span><?php echo $LANG_PRODUCT_CATEGORY;?></span></a></li>
									<li><a href = "?loc=product_sub_category"><span><?php echo $LANG_PRODUCT_SUB_CATEGORY;?></span></a></li>
									<li><a href = "?loc=product"><span><?php echo $LANG_CREATE_PRODUCT;?></span></a></li>
								</ul>
							</div>
						</li>
									
					</ul><!-- #sidebar-menu -->
				</div>
			</div>
			<!--end of sidebar menu-->
			
			<!--start profile above-->
			<div id="page-content-wrapper">
				<div id="page-content">
					<div id="page-header" style="background:#272634;">
						<div id="header-nav-left" style="padding-right:60px;">
							<a class="header-btn" id="logout-btn" title="Logout" onclick="logout()">
								<i class="glyph-icon icon-linecons-lock"></i>
								<span style = "position:absolute; padding-left:10px;font-size:medium; font-weight:bold; font-family:cursive;"><?php echo $LANG_LOGOUT;?></span>
							</a>				
							<div class="user-account-btn dropdown">
								<a href="#" title="My Account" class="user-profile clearfix" data-toggle="dropdown">
									<img width="28" src="images/login_page/profile_pic.png" alt="Profile image">
									<span><?php echo $LANG_PROFILE;?></span>
									<i class="glyph-icon icon-angle-down"></i>
								</a>
								<div class="dropdown-menu float-right">
									<div class="box-sm">
										<div class="login-box clearfix">
											<div class="user-img">
												<!--<a href="#" title="" class="change-img">Change photo</a>-->
												<img src="images/login_page/profile_pic.png" alt="">
											</div>
											<div class="user-info">
												
												<span><?php echo $LANG_USERNAME;?>: <?php echo $admin -> getadmin_username();?></span>
												<span><?php echo $LANG_NAME;?>: <?php echo $admin -> getadmin_name();?></span><br>
												<center><a href="?loc=edit_profile" title="" style="color:blue;font-size:15px;text-decoration:none;"><?php echo $LANG_EDIT_PROFILE;?></a> |  
												<a href="#myModal" data-toggle="modal" title="" style="color:blue;font-size:15px;text-decoration:none;"><?php echo $LANG_EDIT_PASSWORD;?></a></center>
												
											</div>
										</div>
										<div class="divider"></div>							
										<div class="button-pane button-pane-alt pad5L pad5R text-center">
											<a class="btn btn-flat display-block font-normal btn-danger">
												<i class="glyph-icon icon-power-off"></i> <?php echo $LANG_LOGOUT;?>
											</a>
										</div>
									</div>
								</div>
							</div>
						</div><!-- #header-nav-left -->
						<div id="header-nav-right">			
						</div><!-- #header-nav-right -->
					</div>         
					
					
					<div id="page-title" style="border-bottom:2px solid #000;">
						
						<h2></h2>
						
						<div id="date_time">  
							<i class="icon-iconic-clock" aria-hidden="true"></i>
							<span class="dropdown-toggle dropdown-user" data-toggle="dropdown" id="curTime"></span> <span id="curDate"></span> 
						</div>
					</div>
					<div class="row" style="background-color:#fff;padding:10px 10px;">
					<?php
						include_once("content.php");
					?> 
					</div>
				</div>
			</div>
		</div>
   </div>   


	<div class = "modal" id = "myModal" role = "dialog">
		<div class = "modal-dialog">
			<!-- Model content -->
			<div class = "modal-content">
				<div class = "modal-header">
					<button type = "button" id = "close" class = "close" data-dismiss = "modal" onclick = "reset_form()">&times;</button>
					<h2 class = "modal-title"><?php echo $LANG_CHANGE_PASSWORD;?></h2>
				</div>
				<div class = "modal-body" style="min-height:200px;">
					<form id = "password_form">
						<div class = "form-group">
							<label for="" class="col-sm-3 control-label"><?php echo $LANG_NEW_PASSWORD;?></label>
							<div class = "col-sm-9">
								<input type = "password" id = "new_password" class = "form-control" name = "new_password"/><br><br>
							</div>
						</div>
						<div class = "form-group">
							<label for ="" class="col-sm-3 control-label"><?php echo $LANG_CONFIRM_PASSWORD;?></label>
							<div class = "col-sm-9">
								<input type = "password" id = "confirm_password" class = "form-control" name = "confirm_password"/><br>
							</div>
						</div>
					</form>
				</div>
				<div class = "modal-footer">
					<button type = "button" id = "edit" class = "btn btn-primary" style = "" onclick = "change_password()"><?php echo $LANG_SUBMIT;?></button>
					<button type = "button" class = "btn btn-default" style = "" data-dismiss = "modal" onclick = "reset_form()"><?php echo $LANG_CANCEL_BTN?></button>
				</div>
			</div>
		</div>
	</div>
  
  
		<footer>
			<p><?php echo WEBSITE_TITLE; ?> &copy; Copyright 2017 All Rights Reserved</p>
		</footer>
		<!-- Skycons -->
		<script type="text/javascript" src="assets/widgets/skycons/skycons.js"></script>

		<!-- Data tables -->

		<!--<link rel="stylesheet" type="text/css" href="../assets/widgets/datatable/datatable.css">-->
		<script type="text/javascript" src="assets/widgets/datatable/datatable.js"></script>
		<script type="text/javascript" src="assets/widgets/datatable/datatable-bootstrap.js"></script>
		<script type="text/javascript" src="assets/widgets/datatable/datatable-tabletools.js"></script>

		<script type="text/javascript">

		/* Datatables basic */
		$(document).ready(function() {
			$('#datatable-example').dataTable();
		});

		/* Datatables hide columns */
		$(document).ready(function() {
			var table = $('#datatable-hide-columns').DataTable( {
				"scrollY": "300px",
				"paging": false
			});

			$('#datatable-hide-columns_filter').hide();

			$('a.toggle-vis').on( 'click', function (e) {
				e.preventDefault();

				// Get the column API object
				var column = table.column( $(this).attr('data-column'));

				// Toggle the visibility
				column.visible( ! column.visible() );
			});
		});

		/* Datatable row highlight */
		$(document).ready(function() {
			var table = $('#datatable-row-highlight').DataTable();

			$('#datatable-row-highlight tbody').on( 'click', 'tr', function () {
				$(this).toggleClass('tr-selected');
			} );
		});


		$(document).ready(function() {
			$('.dataTables_filter input').attr("placeholder", "Search...");
		});
		
		function logout(member_id) {
			if (confirm("Are you sure want to logout?")) {
				$.ajax({
					type: 'POST',
					url: '?pact=logout',
					data: {
						member_id: member_id
					},
					success: function (data) {
						if (data) {			
								window.location = '?papp=home';
						} else {
							alert("<?php echo $LANG_ERROR_ALERT; ?>");
						}
					}
				});
			}
		}
		
		
		
		function reset_form(){
			$("#password_form")[0].reset();
		}
		
		// document.addEventListener('keyup', function(e){
			// if(e.keyCode == 27){
				// jQuery('#myModal').modal('hide');
				// $("#password_form")[0].reset();
			// }
		// });
		
		
		function change_password(){			
			var new_password = $("#new_password").val();
			var comfirm_password = $("#confirm_password").val();
			var check = true;
			var error_msg = [];

			$("#password_form input").removeClass('errorBorder');
			$("#password_form input").each(function(){
				if($(this).val() == ""){
					$(this).addClass('errorBorder');
					error_msg.push("<?php echo $LANG_BLANK; ?>");
					check = false;
				}
			});
			if(new_password != comfirm_password){
				error_msg.push("<?php echo $LANG_PASSWORD_NOT_MATCH; ?>");
				$('#password_form')[0].reset();
				check = false;
			}
			if(check){
				$.ajax({
					url: '?f=edit_password',
					dataType: 'json',
					type: 'POST',
					data: {
						new_password: new_password
					},
					success: function(data){
						if(data[0]){
							alert(data[1]);
							location.reload(true);
						}else{
							alert(data[1]);
						}
					}
				});	
			}else{
				alert(jQuery.unique(error_msg).join("\n"));
				$('.errorBorder:first').focus();
			}
		}
	</script>

	<!-- Chart.js -->
	<script type="text/javascript" src="assets/widgets/charts/chart-js/chart-core.js"></script>
	<script type="text/javascript" src="assets/widgets/charts/chart-js/chart-doughnut.js"></script>
	<!--<script type="text/javascript" src="assets/widgets/charts/chart-js/chart-demo-1.js"></script>-->

	<!-- Flot charts 
	<script type="text/javascript" src="assets/widgets/charts/flot/flot.js"></script>
	<script type="text/javascript" src="assets/widgets/charts/flot/flot-resize.js"></script>
	<script type="text/javascript" src="assets/widgets/charts/flot/flot-stack.js"></script>
	<script type="text/javascript" src="assets/widgets/charts/flot/flot-pie.js"></script>
	<script type="text/javascript" src="assets/widgets/charts/flot/flot-tooltip.js"></script>
	<script type="text/javascript" src="assets/widgets/charts/flot/flot-demo-1.js"></script>-->

	<!-- Sparklines charts -->
	<script type="text/javascript" src="assets/widgets/charts/sparklines/sparklines.js"></script>
	<script type="text/javascript" src="assets/widgets/charts/sparklines/sparklines-demo.js"></script>

	<!-- Owl carousel -->
	<link rel="stylesheet" type="text/css" href="assets/widgets/owlcarousel/owlcarousel.css">
	<script type="text/javascript" src="assets/widgets/owlcarousel/owlcarousel.js"></script>
	<script type="text/javascript" src="assets/widgets/owlcarousel/owlcarousel-demo.js"></script>

	<!-- WIDGETS -->
	<!-- Bootstrap Dropdown 
	<script type="text/javascript" src="assets/widgets/dropdown/dropdown.js"></script>-->

	<!--Bootstrap modal
	<script type="text/javascript" src="assets/widgets/modal/modal.js"></script>-->
	
	<!-- Bootstrap Tooltip -->
	<script type="text/javascript" src="assets/widgets/tooltip/tooltip.js"></script>

	<!-- Bootstrap Popover -->
	<script type="text/javascript" src="assets/widgets/popover/popover.js"></script>

	<!-- Bootstrap Progress Bar -->
	<script type="text/javascript" src="assets/widgets/progressbar/progressbar.js"></script>

	<!-- Bootstrap Buttons -->
	<script type="text/javascript" src="assets/widgets/button/button.js"></script>

	<!-- Bootstrap Collapse -->
	<script type="text/javascript" src="assets/widgets/collapse/collapse.js"></script>

	<!-- Superclick -->
	<script type="text/javascript" src="assets/widgets/superclick/superclick.js"></script>

	<!-- Input switch alternate -->
	<script type="text/javascript" src="assets/widgets/input-switch/inputswitch-alt.js"></script>
	
	<!-- Slim scroll -->
	<script type="text/javascript" src="assets/widgets/slimscroll/slimscroll.js"></script>

	<!-- Slidebars -->
	<script type="text/javascript" src="assets/widgets/slidebars/slidebars.js"></script>
	<script type="text/javascript" src="assets/widgets/slidebars/slidebars-demo.js"></script>

	<!-- PieGage -->
	<script type="text/javascript" src="assets/widgets/charts/piegage/piegage.js"></script>
	<script type="text/javascript" src="assets/widgets/charts/piegage/piegage-demo.js"></script>

	<!-- Screenfull -->
	<script type="text/javascript" src="assets/widgets/screenfull/screenfull.js"></script>

	<!-- Content box -->
	<script type="text/javascript" src="assets/widgets/content-box/contentbox.js"></script>

	<!-- Material -->
	<script type="text/javascript" src="assets/widgets/material/material.js"></script>
	<script type="text/javascript" src="assets/widgets/material/ripples.js"></script>

	<!-- Overlay -->
	<script type="text/javascript" src="assets/widgets/overlay/overlay.js"></script>

	<!-- Widgets init for demo -->
	<script type="text/javascript" src="assets/js-init/widgets-init.js"></script>

	<!-- Theme layout -->
	<script type="text/javascript" src="assets/themes/admin/layout1.js"></script>
		
	</body>
</html>