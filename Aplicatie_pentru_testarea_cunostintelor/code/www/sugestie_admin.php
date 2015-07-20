<?php
include 'conexiune_baza_de_date.php';
//mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
//mysql_select_db("$db_name")or die("cannot select DB");

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
<form name="form1"   method="post" action="sugestie_admin.php" >
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

				
				<br>
&nbsp;<?php
				
					//get feedback
					$result = mysqli_query($con,"select f.*,u.* from sugestie f,utilizator u where f.s_u_id=u.u_id 
order by f.s_data desc");
					$count=mysqli_num_rows($result);
					
				?>
			<table border="1" width="660" cellspacing="1" id="table12" style="border-collapse: collapse">
				<tr>
					<td colspan="4" class="td_tablecap"><?php echo($count); ?> 
					Mesaje&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>
				</tr>
				<tr>
					<td width="100" class="td_tablehead">Data</td>
					<td width="200" class="td_tablehead">Subiect</td>
					<td width="205" class="td_tablehead">Continut</td>
					<td width="98" class="td_tablehead">User</td>
				</tr>
				
				<?php
				
				if ($count>0)
				{
					$i=0;
					$j='';
					for($i=0;$i<$count; $i++)
					{
						$j=$i+1;
						echo("<tr>");
							echo("<td width='100' align ='center' valign ='top'>".mysqli_result($result,$i,"s_data")."</td>");
							echo("<td width='200' align ='left' valign ='top'>".mysqli_result($result,$i,"s_subiect")."</td>");
							echo("<td width='205' align ='left' valign ='top'>".mysqli_result($result,$i,"s_continut")."</td>");
							echo("<td width='98' align ='left' valign ='top'>".mysqli_result($result,$i,"u_nume")."</td>");
						echo("</tr>");
					}
				}
				else
				{
							echo("<td width='51' align ='center' valign ='top'>&nbsp;</td>");
							echo("<td width='205' align ='left' valign ='top'>&nbsp;</td>");
							echo("<td width='98' align ='left' valign ='top'>&nbsp;</td>");
				}
				
				?>
			</table>
			<p>&nbsp;</td>
		</tr>
		<tr>
			<td  align="center" class ="td_copyright">&nbsp;
			<font face="Times New Roman"> </font></td>
		</tr>
		
		
	</table>
</div>
</form>
</body>

</html>