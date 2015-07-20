

<?php
include 'conexiune_baza_de_date.php';

if(isset($_POST['BtnSubmit']))
//if($_POST['BtnSubmit']=='Trimite')
{
	 
	

		$um_emailid=$_POST['TxtEmailID'];
		//mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
		//mysql_select_db("$db_name")or die("cannot select DB");
		$rs_validate = mysqli_query($con,"select * from utilizator where u_email='$um_emailid'") or die(mysql_error());
		$total = mysqli_num_rows($rs_validate);
		if ($total > 0)
		{
			$to = $um_emailid;
			$subject = "Aplicatie pentru testarea cunostintelor - ai uitat parola";
			$passwd=mysqli_result($rs_validate,0,"u_parola");
			$body = "Parola ta este ".$passwd;
			if (mail($to, $subject, $body)) 
			{
			  echo("<p>Mesajul a fost expediat!</p>");
			 } else {
			
			  echo("<p>Mesajul nu a fost expediat...</p>");
			
			 }
			$err = urlencode("Parola a fost trimisa printr-un email catre adresa ta.");
			header("Location:parola_uitata.php?msg=$err");
			exit();
		}
		else
		{
			$err = urlencode("Eroare: aceasta adresa de email nu este inregistrata in sistem.");
			header("Location:parola_uitata.php?msg=$err");
			exit();
		}

	
	
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
		
    if (document.form1.TxtEmailID.value.length == 0) 
    {
    	alert("Nu ai completat adresa de email." );
    	document.form1.TxtEmailID.focus();
    	return false;

    } 

    
	}
	

function goBack() {
    window.history.back()
}

	



</script>
</head>

<body>
<form name="form1" onsubmit="return validateForm(this)" method="post" action="parola_uitata.php" >
<div align="center">
	<table border="0" width="100%" height="100%" id="table1">
		 
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
								<table border="0" width="100%" id="table8" >
									<tr>
										<td align="left">
										<b>Ai uitat parola</b></td>
									</tr>
									<tr>
										<td align="left" valign="top" style="padding-left: 10px" >
                                            &nbsp;</td>
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
                                            <font size="1">(Parola va fi trimisa printr-un email)</font></td>
									</tr>
									<tr>
										<td align="left" style="padding-left: 10px">
                                            <input type="submit" value="Trimite" name="BtnSubmit" class="ButtonStyle">&nbsp; 
                                            <input type="reset" value="Sterge" name="BtnReset" class="ButtonStyle">&nbsp;
											<button class="ButtonStyle" onclick="goBack()">Inapoi </button>  </td>
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