<html>
<head>
<base href="<?php echo base_url();?>"/>
	<title></title>
</head>
<body>
<div class="container">
	<form action="HomeController/login" method="Post">
		<table>
			<tr>
				<td>UserName</td>
				<td>:</td>
				<td><input type="text" placeholder="UserName" name="userName"></td>
			</tr>
			<tr>
				<td>Password</td>
				<td>:</td>
				<td><input type="password" placeholder="Password" name="password"></td>
			</tr>
			<tr>
				<td><input type="submit" value="Login" name="submit"></td>
			</tr>
		</table>
	</form>
</div>
</body>
</html>
