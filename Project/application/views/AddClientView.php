<html>
<head>
<base href="<?php echo base_url();?>"/>
	<title>Adding new client</title>
	<script src="js/jquery.js"></script>
	<script src="js/jquery.validate.js"></script>
	<script>
		$(document).ready(function()
		{	
			//alert();	
			$("#clientForm").validate();	
		});
	</script>
	<style>	
		.error	
		{
			color:red !important;font-size:12px !important;font-weight:bold !important;	
		}	
	</style>
</head>
<body>
<div class="container">
<?php echo $header; ?>
<form action="ClientController/addClient" method="Post" id="clientForm">
	<table>
		<tr>
			<td>Name:</td>
			<td><input type="text" class="required" placeholder="ClientName" name="clientName"></td>
		</tr>
		<tr>
			<td>Email:</td>
			<td><input type="text" placeholder="Email" class="required email" name="clientEmail"></td>
		</tr>
		<tr>
			<td>Address:</td>
			<td><input type="text" placeholder="Address" class="required" name="clientAddress"></td>
		</tr>
		<tr>
			<td>Country:</td>
			<td>
			<select id="Client_Country_Id" name="Client_Country_Id">
			<option value=""> -- select country --</option>
			<?php
			if(!empty($countryInfo)){
				//print_r($countryInfo);
			foreach($countryInfo as $result){?>
			<option value="<?php echo $result['Country_Id']?>"> <?php echo $result['Country_Name']?></option>	
			<?php	} }
			?>
			</select>
			</td>
		</tr>
		<tr>
			<td><input type="submit" value="Add" name="submit"></td>
		</tr>
	</table>
</form>
</body>
</html>
