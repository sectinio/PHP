<?php
include 'conexiune_baza_de_date.php';
//mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
//mysql_select_db("$db_name")or die("cannot select DB");

session_start();
if(!isset($_SESSION['username']) || trim($_SESSION['username'])=='' || $_SESSION['usertype']=='Student' || $_SESSION['usertype']=='Profesor')
{
	header("location:index.php");
}
else
{
	$username=$_SESSION['username'];
	$usertype=$_SESSION['usertype'];

}
?>

<?php
$mode='';

	if(isset($_GET["mode"]))
	{
	$mode=$_GET["mode"]; 
	$id=$_GET["id"]; 
	}
	
	if ($mode=='A')
	{
		$result1=mysqli_query($con,"update  set u_data_activare=sysdate() where u_id=".$id);
		header("location:activeaza_utilizator.php"); 	

	}
	if ($mode=='D')
	{
		$result1=mysqli_query($con,"update utilizator set u_data_activare=null where u_id=".$id);	
		header("location:activeaza_utilizator.php"); 	

	
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
<form name="form1"   method="post" action="activeaza_utilizator.php" >
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
					$result = mysqli_query($con,"select * from utilizator order by u_data_creare desc");
					$count=mysqli_num_rows($result);
					
				?>
			<table border="1" width="660" cellspacing="1" id="table12" style="border-collapse: collapse">
				<tr>
					<td colspan="4" class="td_tablecap"><?php echo($count); ?> 
					Utilizatori&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>
				</tr>
				<tr>
					<td width="60" class="td_tablehead">Data inregistrarii</td>
					<td width="40" class="td_tablehead">Nume</td>
					<td width="30" class="td_tablehead">Tip de utilizator</td>
					<td width="98" class="td_tablehead">Activare</td>
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
							echo("<td width='60' align ='center' valign ='top'>".mysqli_result($result,$i,"u_data_creare")."</td>");
							echo("<td width='40' align ='left' valign ='top'>".mysqli_result($result,$i,"u_nume")."</td>");
							echo("<td width='30' align ='left' valign ='top'>".mysqli_result($result,$i,"u_tip")."</td>");
							
							if (mysqli_result($result,$i,"u_data_activare")=='')
							{
								if (mysqli_result($result,$i,"u_tip")=='Profesor'||mysqli_result($result,$i,"u_tip")=='Student')
								{
									$link_text="<a href='activeaza_utilizator.php?mode=A&id=".mysqli_result($result,$i,"u_id")."'>Activeaza</a>";
								}
								else
								{
									$link_text="--";
								}
							}
							else
							{
								if (mysqli_result($result,$i,"u_tip")=='Profesor'||mysqli_result($result,$i,"u_tip")=='Student')
								{
									$link_text="<a href='activeaza_utilizator.php?mode=D&id=".mysqli_result($result,$i,"u_id")."'>Dezactiveaza</a>";
								}
								else
								{
									$link_text="--";

								}
								

							}
							
							
							echo("<td width='98' align ='left' valign ='top'>".$link_text."</td>");
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