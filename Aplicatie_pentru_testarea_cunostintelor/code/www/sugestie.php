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
	$userid=$_SESSION['userid'];
	$username=$_SESSION['username'];
	$usertype=$_SESSION['usertype'];

}
?>

<?php


if(isset($_POST['BtnSubmit']))//	if($_POST['BtnSubmit']=='Trimite')
	{
	
		
	 	$result1=mysqli_query($con, "select IFNULL(max(s_id),0)+1 m from sugestie");	
	 	$f_id=mysqli_result($result1,0,"m");
		
		$t_subject=$_POST['TxtSubject'];
		$t_feedback=$_POST['TxtSugestii'];
		
		$sql="insert into sugestie values($f_id,sysdate(),'$t_subject','$t_feedback',$userid)";
    $result=mysqli_query($con, $sql) or die(mysql_error());
    
    header("location:sugestie_trimisa.php"); 
    
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
	
	function validateForm(theForm) 
	{

		var f1=trimAll(document.form1.TxtSubject.value);
		var f2=trimAll(document.form1.TxtSugestii.value);
		
	    if (f1.length == 0) 
	    {
	    	alert("Enter subject" );
	    	document.form1.TxtSubject.focus();
	    	return false;
	
	    } 
	   if (f2.length == 0) 
	    {
	    	alert("Enter feedback" );
	    	document.form1.TxtSugestii.focus();
	    	return false;
	
	    } 
    	return true;
	}
	
	function trimAll(sString)
{
while (sString.substring(0,1) == ' ')
{
sString = sString.substring(1, sString.length);
}
while (sString.substring(sString.length-1, sString.length) == ' ')
{
sString = sString.substring(0,sString.length-1);
}
return sString;
} 

</script>



</head>

<body>
<form name="form1" onsubmit="return validateForm(this)" method="post" action="sugestie.php" >
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
						<table border="0" width="100%" id="table10">
							<tr>
								<td >

									
								<table border="0" width="100%" id="table11" cellpadding="2">
									<tr>
										<td align="left" class="td_tablecap1">
										<b>
										Trimite o sugestie </b></td>
									</tr>
									<tr>
										<td align="left" valign="bottom" style="padding-left: 10px">
										Subiect</td>
									</tr>
									<tr>
										<td align="left" valign="bottom" style="padding-left: 10px">
										<input type="text" name="TxtSubject" size="40"></td>
									</tr>
									<tr>
										<td align="left" valign="bottom" style="padding-left: 10px">
										Continut</td>
									</tr>
									<tr>
										<td align="left" valign="bottom" style="padding-left: 10px">
										<textarea rows="4" name="TxtSugestii" cols="34"></textarea></td>
									</tr>
									<tr>
										<td align="left" valign="top" style="padding-left: 10px" >
                                            &nbsp;</td>
									</tr>
									<tr>
										<td align="left" style="padding-left: 10px">
                                            <input type="submit" value="Trimite" name="BtnSubmit" class="ButtonStyle">&nbsp; 
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