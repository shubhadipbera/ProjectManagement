<html>
<head>
<base href="<?php echo base_url();?>"/>
	<title></title>
</head>
<body>
<div class="container">
<?php echo $header;?>
<h1>Step1</h1>

	<form action="ProjectController/next" method="Post">
		<table>
			<tr>
				<td>Project Name</td>
				
				<td><input type="text" name="ProjectName"></td>
			</tr>
			<tr>
				<td>Tentative Start</td>
				
				<td><input type="date"  name="TentativeStart"></td>
			</tr>
			<tr>
				<td>Tentative End</td>
				
				<td><input type="date"  name="TentativeEnd"></td>
			</tr>
			<tr>
				<td>Summary Budget</td>
				
				<td><input type="text"  name="SummaryBudget"></td>
			</tr>
			<tr>
				<td><input type="submit" value="Next" name="Next"></td>
			</tr>
		</table>
	</form>
</div>
</body>
</html>
  