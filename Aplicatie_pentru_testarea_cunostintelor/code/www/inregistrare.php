

<?php
include 'conexiune_baza_de_date.php';

if(isset($_POST['BtnSubmit']))//if($_POST['BtnSubmit']=='Trimite')
{
	//ob_start();
	
	$u_nume=$_POST['TxtUserName'];
	$um_emailid=$_POST['TxtEmailID'];
	$u_parola=$_POST['TxtPassword'];
if (isset($_POST['ChkProfesor']))	//if ($_POST['ChkProfesor']=='ON' )
	{
		$usertype='Profesor';
		
	}
	else
	{
		$usertype='Student';
		
	}
	
	// Connect to server and select databse.
	

	//mysqli_select_db($con,"$db_name")or die("cannot select DB");
	
	$rs_duplicate = mysqli_query($con, "select count(*) as total from utilizator where u_email='$um_emailid' OR u_nume='$u_nume'") or die(mysql_error());
	list($total) = mysqli_fetch_row($rs_duplicate);
	
	if ($total > 0)
	{
		$err = urlencode("ERROR: The username/email already exists. Please try again with different username and email.");
		header("Location:inregistrare.php?msg=$err");
		exit();
	}
	

	
	//get max id
	$qr_id = mysqli_query($con,"select max(u_id) + 1 from utilizator ") or die(mysql_error());
	list($u_id) = mysqli_fetch_row($qr_id);
	
	//insert
	$sql_insert = "INSERT into utilizator

		    VALUES
		    ('$u_id','$u_nume','$u_parola','$um_emailid','$usertype',now(),null)";


		mysqli_query($con,$sql_insert) or die(mysqli_error($con));		//or die("Insertion Failed:" . mysql_error());
		//mysqli_close($con);
		session_start();
		$_SESSION['username']=$u_nume;
		$_SESSION['usertype']=$usertype;
		
		header("location:inregistrare_confirma.php");
	
	/*
	
	// Define $myusername and $mypassword 
	$myusername=$_POST['TxtUserName']; 
	$mypassword=$_POST['TxtPassword'];
	
	// To protect MySQL injection (more detail about MySQL injection)
	$myusername = stripslashes($myusername);
	$mypassword = stripslashes($mypassword);
	$myusername = mysql_real_escape_string($myusername);
	$mypassword = mysql_real_escape_string($mypassword);
	
	$sql="SELECT * FROM Examen_admin_users WHERE sau_name='$myusername' and sau_passwd='$mypassword'";
	$result=mysqli_query($con,$sql);
	
	// Mysql_num_row is counting table row
	$count=mysql_num_rows($result);
	// If result matched $myusername and $mypassword, table row must be 1 row
	
	if($count==1)
	{
		session_start();
		// Inregistreaza-te $myusername, $mypassword and redirect to file "login_success.php"
		//session_register("myusername");
		//session_register("mypassword");
		$_SESSION['myusername']= $myusername;
		header("location:contul_meu.php");
		}
	else 
	{
	
			$msg = urlencode("Invalid Login. Please try again with correct user name and password. ");
			header("Location:index.php?msg=$msg");
	
	}
	*/
	
	//ob_end_flush();

}


?>

<html>

<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>Aplicatie online pentru testarea cunostintelor </title>
<link href="style/Style1.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" type="text/javascript">

	function validateForm(theForm) 
	{
		
		if (trimAll(document.form1.TxtUserName.value).length == 0) 
	    {
	    	alert("Nume can't blank." );
	    	document.form1.TxtUserName.focus();
	    	return false;
	
	    } 
	    
	    //valid email
	   if ((document.form1.TxtEmailID.value==null)||(document.form1.TxtEmailID.value==""))
	   {
	        alert("Please Enter your Email ID");
	        document.form1.TxtEmailID.focus();
	        return false;
	    }
	    if (echeck(document.form1.TxtEmailID.value)==false)
	    {
	        document.form1.TxtEmailID.value="";
	        document.form1.TxtEmailID.focus();
	        return false;
	    }
	    
	    
	    if (document.form1.TxtPassword.value.length == 0) 
	    {
	    	alert("Parola can't blank." );
	    	document.form1.TxtPassword.focus();
	    	return false;
	    } 
	    if (document.form1.TxtPassword.value == document.form1.TxtConfirmPassword.value) 
	    {
	    
	    }
	    else
	    {
	    	alert("Passwords are not match." );
	    	document.form1.TxtPassword.focus();
	    	return false;
	    } 
    
    
    	return true;


	}
	
	function GoRegister()
	{
		location.href('inregistrare.php');
	}

function echeck(str) 
	{
	 
		var at="@"
		var dot="."
		var lat=str.indexOf(at)
		var lstr=str.length
		var ldot=str.indexOf(dot)
		if (str.indexOf(at)==-1){
		alert("Invalid E-mail ID")
		return false
		}
		
		if (str.indexOf(at)==-1 || str.indexOf(at)==0 || str.indexOf(at)==lstr){
		alert("Invalid E-mail ID")
		return false
		}
		
		if (str.indexOf(dot)==-1 || str.indexOf(dot)==0 || str.indexOf(dot)==lstr){
		alert("Invalid E-mail ID")
		return false
		}
		
		if (str.indexOf(at,(lat+1))!=-1){
		alert("Invalid E-mail ID")
		return false
		}
		
		if (str.substring(lat-1,lat)==dot || str.substring(lat+1,lat+2)==dot){
		alert("Invalid E-mail ID")
		return false
		}
		
		if (str.indexOf(dot,(lat+2))==-1){
		alert("Invalid E-mail ID")
		return false
		}
		
		if (str.indexOf(" ")!=-1){
		alert("Invalid E-mail ID")
		return false
		}
		
		return true                                                     
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
<form name="form1" onsubmit="return validateForm(this)" method="post" action="inregistrare.php" >
<div align="center">
	<table border="0" width="100%" cellspacing="1" height="100%" id="table1">
		<tr>
			
		</tr>
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
				<table border="0" width="329" id="table6">
					<tr>
						<td width="323">
						<table border="0" width="100%" id="table7"  >
							<tr>
								<td>
								<table border="0" width="100%" id="table8" cellpadding="2">
									<tr>
										<td align="left"><b>Inscriere</b></td>
									</tr>
									<tr>
										<td align="left" valign="bottom" style="padding-left: 10px">
										Nume</td>
									</tr>
									<tr>
										<td align="left" valign="top" style="padding-left: 10px" >
                                            <input type="text" name="TxtUserName" size="25" class ="TextBoxStyle"></td>
									</tr>
									<tr>
										<td align="left" valign="bottom" style="padding-left: 10px">
										Email</td>
									</tr>
									<tr>
										<td align="left" valign="top" style="padding-left: 10px">
                                            <input type="text" name="TxtEmailID" size="25"  class ="TextBoxStyle"></td>
									</tr>
									<tr>
										<td align="left" style="padding-left: 10px">
                                            Parola</td>
									</tr>
									<tr>
										<td align="left" style="padding-left: 10px">
                                            <input type="password" name="TxtPassword" size="25"  class ="TextBoxStyle"></td>
									</tr>
									<tr>
										<td align="left" style="padding-left: 10px">
                                            Confirma parola</td>
									</tr>
									<tr>
										<td align="left" style="padding-left: 10px">
                                            <input type="password" name="TxtConfirmPassword" size="25"  class ="TextBoxStyle"></td>
									</tr>
									<tr>
										<td align="left" style="padding-left: 10px">
                                            <input type="checkbox" name="ChkProfesor" value="ON">Sunt profesor<font size="1">
											</font></td>
									</tr>
									<tr>
										<td align="left" style="padding-left: 10px">
                                            <input type="submit" value="Trimite" name="BtnSubmit" class="ButtonStyle">&nbsp; 
                                            <input type="reset" value="Sterge" name="BtnReset" class="ButtonStyle"></td>
									</tr>
									<tr>
										<td align="left">
										Ai deja cont?
										<a href="index.php">Login</a></td>
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
			
			</php>
			</td>
		</tr>
		
		
	</table>
</div>
</form>
</body>

</html>