<html>
	<head>
		<base href="<?php echo base_url();?>"/>
		<title></title>
		<script  src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
		<script type="text/javascript">
			$(function()
			{
				$('#add').click(function()
				{
					$('#addDiv').after(
					'<div class="removalediv"><input type="text" class="array_class" name="abd[]">&nbsp<input type="date" class="array_class" name="date[]">&nbsp<input type="button" name="Remove"  onclick="removewhole(this);" class="remove_btn" value="remove"></div>');
					
				});
			});
			function removewhole(marker)
			{
				$(marker).parent().remove();
			}
		</script>
	</head>
	<body>
		<?php echo $header;?>
		<form action="ProjectController/addStories" method="POST">
			<div id="addDiv">
				
			</div>
			<br />
			<input id="add" type="button" value="Add" /><br><br>
			<input id="next" type="submit" value="Next" />
		</form>
	</body>
