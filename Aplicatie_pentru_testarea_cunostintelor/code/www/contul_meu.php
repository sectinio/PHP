
<?php

session_start();
if(!isset($_SESSION['username']) )//|| trim($_SESSION['username'])=='')
{
print_r(array_values($_SESSION));
	// header("location:index.php");
}
else
{
	$username=$_SESSION['username'];
	$usertype=$_SESSION['usertype'];

}
?>




<html>

<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>Aplicatie online pentru testarea cunostintelor</title>
<link href="style/Style1.css" rel="stylesheet" type="text/css" />

</head>

<body>
<form name="form1" onsubmit="return validateForm(this)" method="post" action="contul_meu.php" >
<div align="center">
	<table border="0" width="100%" cellspacing="1" height="100%" id="table1">
		
		<tr>
			<td  align="left" class ="td_topvav" >
			<table width ="100%" align ="left">
				<tr>
					<td width="33%" align ="left" style="padding-left: 10px" valign="top">
						 <b><?php echo($username.'</b> ('.$usertype.')') ?>  
					</td>
					<td  width="64%" align="right" style="padding-right: 10px" valign="top">
					
					<?php
						include 'bara_navigare.php';	
					
					?>
					</td>
				</tr>


			</table>
			
			
			
			</td>
		</tr>
		
		<tr >
			<td align="center" >
			&nbsp;

				<table border="0" width="455" id="table6" height="117">
					<tr>
						<td width="449">
						
						<p align="center">
						<img border="1" src="images/img1.png" width="118" height="146"></p>
						<p align="center"><b><font size="3">Aplicatie online pentru testarea cunostintelor</font></b></td>
					</tr>
				</table>
				<p>&nbsp;</td>
		</tr>
		<tr>
			<td  align="center" class ="td_copyright">
			<?php 
			include 'footer.php';
			?>
			
			</td>
		</tr>
		
		
	</table>
</div>
</form>
</body>

</html>