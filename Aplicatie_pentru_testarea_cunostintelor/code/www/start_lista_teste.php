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


	if(isset($_POST['BtnSubmit']))//if($_POST['BtnSubmit']=='Start Examen')
	{
	 	$result1=mysqli_query($con,"select t_id from test where t_titlu='".$_POST['DdlExamen']."' and t_arata=1");	
	 	$sm_id=mysqli_result($result1,0,"t_id");
		
		$sql="SELECT  q.*,s.* FROM intrebare q, test s 
		where q.i_test_id=s.t_id and s.t_id=".$sm_id."";
    //echo($id);
    $result=mysqli_query($con,$sql) or die(mysql_error());
		//row count
		$row_count=mysqli_num_rows($result);
		if ($row_count>0)
		{
			//alreday enter
			$sql2="SELECT  * FROM student_examen where se_u_id=".$userid." and se_t_id =".$sm_id;
	   // echo($sql2);
	    
	    $result2=mysqli_query($con,$sql2) or die(mysql_error());
			
			$row_count2=mysqli_num_rows($result2);
			if ($row_count2>0)
			{
				$msg = urlencode("Ai participat deja la acest examen. ");
				header("Location:start_lista_teste.php?msg=$msg");
				exit();
			}
		
			session_start();
			$_SESSION['currind']=0;
			header("location:test_main.php?id=$sm_id&inainte_id=0"); 
		}
		else
		{
			$msg = urlencode("Nu sunt intrebari disponibile. ");
			header("Location:start_lista_teste.php?msg=$msg");
		}
		
		
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
<form name="form1" method="post" action="start_lista_teste.php" >
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
															<p>
				  <?php
	  /******************** ERROR MESSAGES*************************************************
	  This code is to show error messages 
	  **************************************************************************/
      if (isset($_GET['msg'])) {
	  $msg =$_GET['msg'];// mysql_real_escape_string($_GET['msg']);
	  echo "<div class=\"msg\"><p class='Errortext'>$msg</p></div>";
	  }
	  /******************************* END ********************************/
			?>
			
			</p>
			
			
<table border="0" width="329" id="table9">
					<tr>
						<td width="323">
						<table border="0" width="100%" id="table10" >
							<tr>
								<td >

									
								<table border="0" width="100%" id="table11" cellpadding="2">
									<tr>
										<td align="left" class="td_tablecap1"><b>
										Start Examen </b></td>
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
									    $sql="select t_titlu from  test where t_arata=1 order by t_titlu " ; 
  										$result=mysqli_query($con, $sql) or die(mysql_error());
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
                                            <input type="submit" value="Start Examen" name="BtnSubmit" class="ButtonStyle">&nbsp; 
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