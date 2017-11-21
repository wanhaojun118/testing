<?php

$address = filter_input(INPUT_POST,"member_address");
$city = filter_input(INPUT_POST,"member_city");
$state = filter_input(INPUT_POST,"member_state");
$country = filter_input(INPUT_POST,"member_country");
$postcode = filter_input(INPUT_POST,"member_postcode");
		

	
echo json_encode($output);
?>