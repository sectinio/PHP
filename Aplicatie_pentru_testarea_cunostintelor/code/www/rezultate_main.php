<?php
include 'conexiune_baza_de_date.php';
//mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
//mysql_select_db("$db_name")or die("cannot select DB");
$sc_id=''; 
$sc_name='';
$sc_description='';
$sc_active='';
$op_mode='';

session_start();
if(!isset($_SESSION['username']) || trim($_SESSION['username'])=='')
{
	header("location:index.php");
}
else
{
	$userid=$_SESSION['userid'];
	$username=$_SESSION['username'];
	$usertype=$_SESSION['usertype'];

}
?>

<?php

if ($usertype=='Administrator')
			{
				$cond=" ";
			}
			else
			{
			
			
				$cond="where t_creat_de=".$_SESSION['userid'];
			}

	if(isset($_POST['BtnSubmit']))//if($_POST['BtnSubmit']=='Arata rezultat')
	{
	 	//$result1=mysqli_query($con,"select sm_id from test where sm_name='".$_POST['DdlExamen']."'");	
	 	$result1=mysqli_query($con,"select e.t_id from test e, student_examen se where e.t_id=se.se_t_id and e.t_titlu='".$_POST['DdlExamen']."'");	
		$sm_id=mysqli_result($result1,0,"t_id");
		
if ($usertype=='Student')
		{header("location:arata_rezultate_student.php?id=$sm_id"); 
		}
		else
		{header("location:arata_rezultate.php?id=$sm_id");}

	}

?>


<html>

<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>Aplicatie online pentru testarea cunostintelor</title>
<link href="style/Style1.css" rel="stylesheet" type="text/css" />

<script language ="javascript" type ="text/javascript" >



	function GoBack()
	{
	
		location.href("contul_meu.php");
	
	}
	

	
	

</script>



</head>

<body>
<form name="form1" method="post" action="rezultate_main.php" >
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

			<p>

			
			
<table border="0" width="329" id="table9">
					<tr>
						<td width="323">
						<table border="0" width="100%" id="table10" >
							<tr>
								<td >

									
								<table border="0" width="100%" id="table11" cellpadding="2">
									<tr>
										<td align="left" class="td_tablecap1"><b>
										Rezultate la teste </b></td>
									</tr>
									<tr>
										<td align="left" valign="bottom" style="padding-left: 10px">
										&nbsp;</td>
									</tr>
									<tr>
										<td align="left" valign="bottom" style="padding-left: 10px">
										Alege test</td>
									</tr>
									<tr>
										<td align="left" valign="bottom" style="padding-left: 10px">
										<select size="1" name="DdlExamen">
										<?php
										//session_start();
									  //  $sql="select sm_name from  test ".$cond." order by sm_name " ; 
									  
									  if ($usertype=='Student') {
									  $sql="select e.t_titlu from test e, student_examen se where e.t_id=se.se_t_id and se.se_u_id='$userid'";}
									  else {
									  $sql="select t_titlu from  test ".$cond." order by t_titlu " ; }
  										$result=mysqli_query($con,$sql) or die(mysql_error());
  										$count=mysqli_num_rows($result);
											$i=0;
											for($i=0;$i<$count; $i++)
											{
												$opt=mysqli_result($result,$i,"t_titlu");

												echo("<option>$opt</option>");
												

											}
											
										?>
										</select></td>
									</tr>
									<tr>
										<td align="left" valign="top" style="padding-left: 10px" >
                                            &nbsp;</td>
									</tr>
									<tr>
										<td align="left" style="padding-left: 10px">
                                            <input type="submit" value="Arata rezultat" name="BtnSubmit" class="ButtonStyle">&nbsp; 
                                            <input type="button" value=" Inapoi " name="BtnBack" class="ButtonStyle" onclick="GoBack()"></td>
									</tr>
									</table>
								</td>
							</tr>
						</table>
						</td>
					</tr>
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