

<?php

include 'conexiune_baza_de_date.php';

if(isset($_POST['BtnLogin']))//if($_POST['BtnLogin']=='Login')
{
	ob_start();
	

	// Connect to server and select databse.
	//mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
	//mysql_select_db("$db_name")or die("cannot select DB");
	
	// Define $myusername and $mypassword 
	$myusername=$_POST['TxtUserName']; 
	$mypassword=$_POST['TxtPassword'];
	
	// To protect MySQL injection (more detail about MySQL injection)
	$myusername = stripslashes($myusername);
	$mypassword = stripslashes($mypassword);
	$myusername = mysqli_real_escape_string($con,$myusername);
	$mypassword = mysqli_real_escape_string($con,$mypassword);
	
	$sql="SELECT * FROM utilizator WHERE u_nume='$myusername' and u_parola='$mypassword'"; //and um_is_login=1";
	$result=mysqli_query($con,$sql);
	
	
	// Mysql_num_row is counting table row
	$count=mysqli_num_rows($result);
	
	// If result matched $myusername and $mypassword, table row must be 1 row
	
	if($count==1)
	{
		if (mysqli_result($result,0,"u_tip")!='Administrator'&& mysqli_result($result,0,"u_data_activare")=='')
		{
			$msg = urlencode("Contul tau inca nu a fost activat. Te rog contacteaza administratorul.");
			header("Location:index.php?msg=$msg");
			exit();
		}
		
		session_start();
		// Inregistreaza-te $myusername, $mypassword and redirect to file "login_success.php"
		//session_register("myusername");
		//session_register("mypassword");
		//mysql_result($result,1,"sau_name");
		$_SESSION['username']= mysqli_result($result,0,"u_nume"); //$myusername; //
		$_SESSION['usertype']= mysqli_result($result,0,"u_tip");
		$_SESSION['useremail']= mysqli_result($result,0,"u_email");
		$_SESSION['userid']= mysqli_result($result,0,"u_id");

		header("location:contul_meu.php");
		}
	else 
	{
	
			$msg = urlencode("Login invalid. Te rugam mai incearca. ");
			header("Location:index.php?msg=$msg");
	
	}
	
	ob_end_flush();

}


?>

<html>

<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>Aplicatie online pentru testarea cunostintelor</title>
<link href="style/Style1.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" type="text/javascript">

	function validateForm(theForm) 
	{
		
    if (document.form1.TxtUserName.value.length == 0) 
    {
    	alert("Te rugam introdu username." );
    	document.form1.TxtUserName.focus();
    	return false;

    } 
    
    if (document.form1.TxtPassword.value.length == 0) 
    {
    	alert("Te rugam introdu parola." );
    	document.form1.TxtUserName.focus();
    	return false;
    } 
     
	}
	
	function GoRegister()
	{
		
		window.location.href="inregistrare.php";
	}


</script>
</head>

<body>
<form name="form1" onsubmit="return validateForm(this)" method="post" action="index.php" >
<div align="center">
	<table border="0" width="100%" cellspacing="1" height="100%" id="table1">
		
		<tr >
			<td align="center" >
			&nbsp;
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
				<table border="0" width="390" id="table6">
					<tr>
						<td width="144">
						<img border="0" src="images/img1.png" width="144" height="183"></td>
						<td width="211">
						<table border="0" width="100%" id="table7">
							<tr>
								<td>
								<table border="0" width="100%" id="table8" >
									<tr>
										<td align="left"><b>Conecteaza-te</b></td>
									</tr>
									<tr>
										<td align="left" valign="bottom">
										Nume</td>
									</tr>
									<tr>
										<td align="left" valign="top" >
                                            <input type="text" name="TxtUserName" size="20" class ="TextBoxStyle"></td>
									</tr>
									<tr>
										<td align="left" valign="bottom">
										Parola</td>
									</tr>
									<tr>
										<td align="left" valign="top">
                                            <input type="password" name="TxtPassword" size="20"  class ="TextBoxStyle"></td>
									</tr>
									<tr>
										<td align="left">
                                            <input type="submit" value="Login" name="BtnLogin" class="ButtonStyle">&nbsp; 
											 <input type="button" value="Inregistreaza-te" name="BtnRegister" class="ButtonStyle"  onclick="GoRegister()" >
								
											</td>
									</tr>
									<tr>
										<td align="left">
										<a href="parola_uitata.php">Ai uitat parola?</a></td>
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