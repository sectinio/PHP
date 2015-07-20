
<?php

include 'conexiune_baza_de_date.php';
session_start();
if(!isset($_SESSION['username']) || trim($_SESSION['username'])=='')
{
	header("location:index.php");
}
else
{
	$u_id=$_SESSION['userid'];
	$u_nume=$_SESSION['username'];
	$usertype=$_SESSION['usertype'];

}
// Connect to server and select databse.
//mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
//mysql_select_db("$db_name")or die("cannot select DB");

$result = mysqli_query($con, "select * from utilizator where u_nume='$_SESSION[username]'");


if(isset($_POST['BtnSubmit']))//if($_POST['BtnSubmit']=='Trimite')
{
	 
	
	$u_nume=$_POST['TxtUserName'];
	$um_emailid=$_POST['TxtEmailID'];
	$u_parola=$_POST['TxtPassword'];

	
	//update
	$sql_update = "update utilizator set u_email='$um_emailid',u_parola='$u_parola'
								where u_id=$u_id;";

		mysqli_query($con, $sql_update) or die("updation Failed:" . mysql_error());
		
		
		header("location:contul_meu.php");
	

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
	
<form name="form1" onsubmit="return validateForm(this)" method="post" action="editeaza_profil.php" >
<div align="center">
	<table border="0" width="100%" cellspacing="1" height="100%" id="table1">
		 
		
				<tr>
			<td  align="left" class ="td_topvav" >
			<table width ="100%" align ="left">
				<tr>
					<td width="33%" align ="left" style="padding-left: 10px" valign="top">
						 <b><?php echo($u_nume.'</b> ('.$usertype.')') ?>  
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
						<table border="0" width="100%" id="table7" >
							<tr>
								<td>
								<table border="0" width="100%" id="table8" cellpadding="2">
									<tr>
										<td align="left"><b>Editeaza profilul</b></td>
									</tr>
									<tr>
										<td align="left" valign="bottom" style="padding-left: 10px">
										Nume</td>
									</tr>
									<tr>
										<td align="left" valign="top" style="padding-left: 10px" >
                                            <input type="text" name="TxtUserName" size="25" class ="TextBoxStyle" value="<?php echo mysqli_result($result,0,"u_nume"); ?>" disabled ></td>
									</tr>
									<tr>
										<td align="left" valign="bottom" style="padding-left: 10px">
										Email</td>
									</tr>
									<tr>
										<td align="left" valign="top" style="padding-left: 10px">
                                            <input type="text" name="TxtEmailID" size="25"  class ="TextBoxStyle" value="<?php echo mysqli_result($result,0,"u_email"); ?>" ></td>
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
                                            <input type="submit" value="Trimite" name="BtnSubmit" class="ButtonStyle">&nbsp; 
                                            <input type="reset" value="Sterge" name="BtnReset" class="ButtonStyle"></td>
									</tr>
									<tr>
										<td align="left">
										&nbsp;</td>
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