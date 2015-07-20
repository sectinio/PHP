
<?php

session_start();
if(!isset($_SESSION['username']) || trim($_SESSION['username'])=='')
{
	header("location:index.php");
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
<form name="form1" onsubmit="return validateForm(this)" method="post" action="index.php" >
<div align="center">
	<table border="0" width="100%" cellspacing="1" height="100%" id="table1">
		 


		
		<tr >
			<td align="center" >
			&nbsp;

				<table border="0" width="455" id="table6" height="117">
					<tr>
						<div>

<td  align="center"  height="70" valign="middle">
<font color="red">Te-ai inregistrat ca succes. Urmeaza ca administratorul sa iti activeze contul.
 </font><br><br> <b>Apasa <a href='index.php'> aici</a> pentru a te loga in aplicatie<br><br><br></td>			
			</div
					</tr>
				</table>
				<p>&nbsp;</td>
		</tr>
		
		
			
		
	
			<td  align="center" class ="td_copyright">&nbsp;
			<font face="Times New Roman"> </font></td>
		</tr>
		
		
	</table>
</div>
</form>
</body>

</html>