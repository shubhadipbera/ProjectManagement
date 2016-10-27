<html>
	<head>
		<base href="<?php echo base_url();?>"/>
		<title></title>
		<script  src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
		<script type="text/javascript">
			$(function()
			{
				$('input').click(function()
				{
					if($(this).val() == 'unset')
					{
						$(this).next('.baseline').addClass('setclass');
					}
					else
					{
						$(this).next('.baseline').removeClass('setclass'); 
					}
				});
				$('#next_id').click(function()
				{
					$('input[name="baseline_id_array"]:checked').each(function() 
					{
						if($(this).is(':checked'))
						{
							var a =$(this).val();
							alert(a);
						}
					});
				});
			});
		</script>
	</head>
	<body>
		<form name="projectBaselineForm" id="projectBaselineForm" action="ProjectController/addBaseline" method="Post">
			<?php echo $header;?>
			<table>
				<?php
				//print_r($baseline);die;
					if(!empty($baseline))
					{
						//print_r($baseline);die;
						foreach($baseline as $result)
						{?>
						
							<input type='checkbox' class="baseline" value="<?php echo $result['Baseline_Id'];?>" name="Baseline_Id[]" style="display:block;"> <?php echo $result['Baseline_Name'];?></input>	<br>
				<?php	
						}
					 }
				?>
				<tr>
					<td><input type="submit" value="Next" name="Next" id='next_id'></td>
				</tr>
			</table>
		</form>
	</body>
</html>
