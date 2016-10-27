<html>
<head>
<base href="<?php echo base_url();?>"/>
	<title></title>
</head>
<body>
<div class="container">
<?php echo $header;?>
	<form action="ProjectController/addProject" method="Post">
		<table border="1">
		<tr>
			<td><input type="submit" value="Addnew"></td>
		</tr>
			
		</table>
		<table border="1">
		<th>
			<td>project Name</td>
		</th>
		<?php if(!empty($ProjectInfo)){
		foreach($ProjectInfo as $result){
		?>
		<tr>
			<td><a href="ProjectController/viewProject/<?=$result['Project_Id']?>"><?=$result['Project_Name']?></a></td>
		</tr>
		<?php } } ?>		
		</table>
	</form>
</div>
</body>
</html>
 
