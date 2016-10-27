<html>
	<head>
		<base href="<?php echo base_url();?>"/>
		<title>Initiating the Propject</title>
		<script src="js/jquery.js"></script>
		<script src="js/jquery.validate.js"></script>
		<script  src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
		<script>
			$(function()
			{ 
				$('#next').click(function()
				{
					if(!document.getElementById('iAgree').checked)
					{
						alert('Check the checkbox');
						return false;
					}
					return true;
				});
			});
		</script>
	</head>
	<body>
		<div class="container">
		<?php echo $header;?>
			<form method="Post" action="ProjectController/viewBaseline" id="initiateForm">
				<table>
					<tr>
						<td><label>Tentative Start Date:</label></td>
						<td><input type="date" class="required date" name="tentativeStartDate"></td>
					</tr>
					<tr>
						<td><label>Tentative End Date:</label></td>
						<td><input type="date" class="required date" name="tentativeEndDate"></td>
					</tr>
					<tr>
						<td><label>Tentative Amount:</label></td>
						<td><input type="text" class="required" name="tentativeAmount"></td>
					</tr>
					<tr>
						<td><input type="checkbox" name="iAgree" value="iAgree" id="iAgree"/></td>
						<td><label>I Agree</label></td>
					</tr>
					<tr>
						<td><input type="submit" value="Next" name="Next" id="next"></td>
					</tr>
				</table>
			</form>
		</div>
	</body>
</html>
