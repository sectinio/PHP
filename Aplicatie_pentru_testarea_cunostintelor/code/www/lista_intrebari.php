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

<script type="text/javascript">
<!--
function confirmation(ID) {
	var answer = confirm("Sterge selected record ?")
	if (answer){
		//alert("Entry Deleted")
		//window.location = "links.php?act=trackdelete&id="+ID;
		window.location = "adauga_intrebare.php?mode=delete&id="+ID;

	}
	else{
		//alert("No action taken")
	}
}
//-->
</script>

</head>

<body>
<form name="form1" onsubmit="return validateForm(this)" method="post" action="my-account.php" >
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
				if ($usertype=='Administrator')
					{
						$cond=" ";
					}
					else
					{
						$cond="and t_creat_de=".$_SESSION['userid'];
					}
					
				
				
					//get category
					$result = mysqli_query($con,"SELECT q.i_id, e.t_titlu, q.i_text FROM intrebare  q, test e where q.i_test_id=e.t_id ".$cond);
					$count=mysqli_num_rows($result);
					
				?>
			<table  width="560" cellspacing="1" id="table12" >
				<tr>
					<td colspan="4" class="td_tablecap"><?php echo($count); ?> intrebari&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<a href="adauga_intrebare.php?mode=add&id=0"><u>Adauga intrebari</u></a></td>
				</tr>
				<tr>
					<td width="51" class="td_tablehead">ID</td>
					<td width="70" class="td_tablehead">Examen</td>
					<td width="130" class="td_tablehead">Intrebare</td>
					<td width="200" class="td_tablehead">&nbsp;</td>
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
							echo("<td width='51' align ='center' valign ='top'>".$j."</td>");
							echo("<td width='200' align ='left' valign ='top'>".mysqli_result($result,$i,"t_titlu")."</td>");
							echo("<td width='205' align ='left' valign ='top'>".mysqli_result($result,$i,"i_text")."</td>");
							//echo("<td width='98' align ='left' valign ='top'><a href='adauga_intrebare.php?mode=edit&id=".mysql_result($result,$i,"i_id")."'>Editeaza</a>&nbsp; <a href='adauga_intrebare.php?mode=delete&id=".mysql_result($result,$i,"i_id")."'>Sterge</a></td>");
							echo("<td width='98' align ='left' valign ='top'><a href='adauga_intrebare.php?mode=edit&id=".mysqli_result($result,$i,"i_id")."'>Editeaza</a>&nbsp; <a href='javascript:confirmation(".mysqli_result($result,$i,"i_id").")'>Sterge</a></td>");
						
						
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