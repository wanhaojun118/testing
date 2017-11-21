<?php
$loc = filter_input(INPUT_GET, "loc", FILTER_SANITIZE_STRING);
$target = filter_input(INPUT_GET, "target", FILTER_SANITIZE_STRING);
// $_SESSION['power_key']="";
$power_key_required = array();
if (isset($loc)) {
	if (file_exists('app/' . $loc . '.php')) {
		if(in_array($loc,$power_key_required)){
			if($_SESSION['power_key']=="1"){
				include 'app/remove_power_key.php';
				if(isset($target)){
					include 'app/' . $target . '.php';
				}else{
					include 'app/' . $loc . '.php';
				}
			}else{
				?><script>
					window.location="?loc=power_key&target=<?php echo $loc?>";
				</script><?php
			}
		}else if(in_array($target,$power_key_required) && $_SESSION['power_key']=="1"){
			?><script>
					window.location="?loc=<?php echo $target?>";
				</script><?php
		}else{
			include 'app/' . $loc . '.php';
		}
        // include_once 'app/' . $loc . '.php';
    }
    else {
        include_once 'app/error.php';
    }
}
else {
    include_once 'app/dashboard.php';
}
?>