
<html>
<head>
<?php

	$con = mysqli_connect("localhost","root","", "manage_event");
	$sql_event="select * from tbl_event order by event_id";
	$sql_emp="select * from tbl_employee order by participation_id";
	$result_event=mysqli_query($con, $sql_event);
	$result_emp=mysqli_query($con, $sql_emp);
	$result_event1=mysqli_query($con, $sql_event);
 ?>
<title>Event Listing</title>

</head>
<body>
<form name="frmSubmit" method="POST" action="">

<select name="employee_name">
   
  <option value="">Employee Name</option> 
  <?php while($row_emp=mysqli_fetch_array($result_emp)){
	
	 
	  ?>
		
		<option value="<?php echo $row_emp['employee_name']; ?>" ><?php echo $row_emp['employee_name']?></option>
   <?php
	}
	?>
	
   
</select>  

<select name="event_name">
  
  <option value="">Event Name</option> 
  <?php while($row_event=mysqli_fetch_array($result_event)){?>
		
		<option value="<?php echo $row_event['event_name']; ?>"  ><?php echo $row_event['event_name']?></option>
   <?php
	}
	?>
	
   
</select>
<select name="event_date">
  
  <option value="">Event Date</option> 
  <?php 
  
  while($row_event1=mysqli_fetch_array($result_event1)){?>
		
		<option value="<?php echo $row_event1['event_date']; ?>"><?php echo $row_event1['event_date']?></option>
   <?php
	}
	?>
	
   
</select>
<input type="submit" name="event_submit" value="SUBMIT" id="event_submit" >	
</form>
		
    	<table align="center" width="100%" border="0" cellspacing="3" cellpadding="3" id="tblEvent" >
		

 <?php

 $sql_cond="";
 $total_fee = "0";
if(!empty($_POST['employee_name'])){
	 $sql_cond .=" and emp.employee_name='".$_POST['employee_name']."'";
	 
 }
 if(!empty($_POST['event_name'])){
	 $sql_cond .=" and event.event_name='".$_POST['event_name']."'";
	 
 }
 if(!empty($_POST['event_date'])){
	 $sql_cond .=" and event.event_date='".$_POST['event_date']."'";
	 
 }

	
		
		
$sql="select event.event_name,event.event_date, emp.employee_name,emp.employee_email,emp.participation_fee from tbl_event as event, tbl_employee as emp where emp.event_id=event.event_id".$sql_cond;
	
	
	
	$result=mysqli_query($con, $sql);
 ?>
 
  <tr>
    
	<th align="left" width="20%"><strong>Employee Name</strong></th>
	<th align="left" width="30%"><strong>Employee Email</strong></th>
	<th align="left" width="20%"><strong>Event Name</strong></th>
	<th align="left" width="10%"><strong>Date</strong></th>
	<th align="left" width="20%"><strong>Participation Fee</strong></th>
	
  </tr>
  
  <?php
  
  while($row=mysqli_fetch_array($result)){
	  
   
  ?>
  <tr>
    <td align="left" data-input="employee_name"><?php echo $row['employee_name'];?></td>
	<td align="left" data-input="employee_email"><?php echo $row['employee_email'];?></td>
	<td align="left" data-input="event_name"><?php echo $row['event_name'];?></td>
	<td align="left" data-input="event_date"><?php echo $row['event_date'];?></td>
	<td align="left" data-input="participation_fee"><?php echo $row['participation_fee'];?></td>
	
  </tr>
  <?php 
  $total_fee += $row['participation_fee'];
  ?>
  <?php
  
  }
  ?>
 <tr><td colspan="4"><strong>Total Value:</strong></td>
 <td align="left"><strong><?php echo $total_fee;?></td></strong></tr>
  <tr>
 
</table>
</body>
</html>