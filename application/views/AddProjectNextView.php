<html>
<head>
<base href="<?php echo base_url();?>"/>
<title></title>
<script  src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript">
	$(function()	
	{		
		
	
		$('#add_non_functional').click(function()		
		{	
				
			$('#add_non_functional').after('<div class="removalediv"><input type="text" class="array_class" name="abc[]">&nbsp<input type="button" name="Remove"  onclick="removewhole(this);" class="remove_btn" value="remove"></div>');	
			//$('#add_non_functional').after($('.container'));
		});
		$('#add_functional').click(function()		
		{	
					
			$('#add_functional').after('<div class="removalediv"><input type="text" class="array_class" name="def[]">&nbsp<input type="button" name="Remove"  onclick="removewhole(this);" class="remove_btn" value="remove"></div>');	
//$('#addDiv').append($('.container'));			
		});			
		$("#next").click(function()		
		{			
			alert($(".removalediv").next().find('array_class').val());		
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

<h1>Step2</h1>
	<form action="ProjectController/save" method="Post">
		<table>
			<tr>
				<td>Introduction</td>
				<td>:</td>
				<td><input type="text" name="Introduction"></td>
			</tr>
			<tr>
			<div class="container">
				<td>Non-Functional</td>
				<td>:</td>
				<td><input type="text" class="array_class" id="a" name="abc[]"></td>
				<div id="addDiv">
				<td><input type="button" id="add_non_functional" name="add" value="add"></td>
				</div>
				</div>
				
			</tr>
			<tr>
			<div class="container1">
				<td>Functional</td>
				<td>:</td>
				<td><input type="text" class="array_class" name="def[]"> </td>
				<div id="addDiv1">
				<td><input type="button" id="add_functional" name="add" value="add"></td>
				</div>
				</div>
			</tr>
			
			
			<tr>
				<td>Buisness Needs</td>
				<td>:</td>
				<td><input type="text"  name="Buisenessneeds"></td>
			</tr>
			<tr>
				<td>Project Financer</td>
				<td>:</td>
				<td><input type="text"  name="ProjectFinancer"></td>
			</tr>
			<tr>
				<td><input type="submit" value="submit" name="save"></td>
			</tr>
		</table>
	</form>

</body>
  </html>