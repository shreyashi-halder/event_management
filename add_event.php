<?php
    $con = mysqli_connect("localhost","root","", "manage_event");
   
    //read the json file contents
    $jsondata = file_get_contents('events.json');
	
    //convert json object to php associative array
     $event_records = json_decode($jsondata, true);
	 //echo "<pre>";
	 //print_r($event_records);
	 //echo "</pre>";
	 
    //get the event details
	if (!empty($event_records)){
		foreach ($event_records as $event_record) {
			
			$participation_id = $event_record['participation_id'];
			$employee_name = $event_record['employee_name'];
			$employee_mail = $event_record['employee_mail'];
			$event_id = $event_record['event_id'];
			$event_name = $event_record['event_name'];
			$participation_fee = $event_record['participation_fee'];
			$event_date = $event_record['event_date'];
			
		
	//insert into mysql table
	$sql_select="select * from tbl_event where event_id='".$event_id."'";
	$row_select=mysqli_query($con, $sql_select);
	$result_select=mysqli_fetch_array($row_select);
	if($result_select==''){
	
			$sql_event = "INSERT INTO tbl_event(event_id, event_name , event_date)
			VALUES('$event_id', '$event_name', '$event_date')";
			mysqli_query($con, $sql_event);
			
			
		}
		
		$sql_employee = "INSERT INTO tbl_employee(participation_id, employee_name , employee_email, event_id, participation_fee)
			VALUES('', '$employee_name', '$employee_mail', '$event_id', '$participation_fee')";
			mysqli_query($con, $sql_employee);
		}
	}
	
?>




