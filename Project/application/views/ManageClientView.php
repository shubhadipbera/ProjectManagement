<html>
<head>
<base href="<?php echo base_url();?>"/>
	<title></title>
</head>
<body>
<div class="container">
<?php echo $header;?>
<a href = "ClientController/addClientView">Add Client</a>
<form action="ClientController" method="Post">
	
	<table>
		<tr>
			<td>Name:</td>
			<td><input type="text" placeholder="ClientName" name="clientName" value="<?php if (isset($_POST["clientName"])){echo $_POST["clientName"];} ?>"></td>
		</tr>
		<tr>
			<td>AddedDate:</td>
			<td><input type="date" placeholder="AddDate" name="addDate" value="<?php if (isset($_POST["addDate"])){echo $_POST["addDate"];} ?>"></td>
		</tr>
		<tr></tr>
		<tr>
			<td><input type="submit" value="Search" name="search"></td>
		</tr>
	</table>
</form>
<form>
	<table>
		<tr>
			<td><label>Name</label></td>
			<td><label>Address</label></td>
			<td><label>Email</label></td>
			<td><label>Country</label></td>
		</tr>
		<?php
			foreach($records as $rec)
			{
		?>
		<tr>
			<td><?php echo $rec['Client_Name']; ?></td>
			<td><?php echo $rec['Client_Address']; ?></td>
			<td><?php echo $rec['Client_Email']; ?></td>
			<td><?php echo $rec['Country_Name']; ?></td>
		</tr>
		<?php 
			}
		?>
	</table>
</form>
</div>
</body>
</html>