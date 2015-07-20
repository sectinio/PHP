<?php
include 'conexiune_baza_de_date.php';
//mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
//mysql_select_db("$db_name")or die("cannot select DB");
$tg_id=''; 
$tg_titlu='';
$tg_descriere='';
$ec_active='';
$op_mode='';

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

<?php
	$mode=$_GET["mode"]; 
	$id=$_GET["id"]; 
if(isset($_POST['BtnSubmit']))	//if($_POST['BtnSubmit']=='Trimite')
	{
		ob_start();
		if ($mode=='edit')
		{
		 

			$chk_dis=0;	
			if ($_POST['ChkAfiseaza']=='ON')
			{
				$chk_dis=1;
			}
			else
			{
				$chk_dis=0;
			}
			$txt_name=$_POST['TxtCategory'];
			$txt_desc=$_POST['TxtDescription'];
			if ($usertype=='Administrator')
			{
				$cond=" ";
			}
			else
			{
				$cond="and tg_creat_de=".$_SESSION['userid'];
			}
			
		    $sql="update  test_grup set tg_titlu='$txt_name', tg_descriere='$txt_desc', tg_arata=$chk_dis where tg_id=".$id." ".$cond; 
		    $result=mysqli_query($con,$sql) or die(mysql_error());
			
			header("location:lista_grup_teste.php"); 

	 
		}
		if ($mode=='add')
		{
		
			$chk_dis=0;	
			if ($_POST['ChkAfiseaza']=='ON')
			{
				$chk_dis=1;
			}
			else
			{
				$chk_dis=0;
			}
			
			$txt_name=$_POST['TxtCategory'];
			$txt_desc=$_POST['TxtDescription'];
			
			$result=mysqli_query($con,"select max(tg_id)+1 as m from  test_grup" );
			
			$id_=mysqli_result($result,0,"m"); 
			
			$uid=$_SESSION['userid'];
			
		    $sql="insert into  test_grup values('$id_','$txt_name','$txt_desc','$uid','$chk_dis')"; 
		    
		    $result=mysqli_query($con,$sql) or die(mysql_error());
			
			header("location:lista_grup_teste.php"); 

	
		}
		
	
	
		ob_end_flush();
	}


?>

<?php 
	if ($usertype=='Administrator')
	{
		$cond=" ";
	}
	else
	{
		$cond="and tg_creat_de=".$_SESSION['userid'];
	}
	
	if ($mode=='delete')
	{
	    $sql="delete from  test_grup  where tg_id=".$id." ".$cond; 
	    $result=mysqli_query($con,$sql) or die(mysql_error()); 
	    
		header("location:lista_grup_teste.php"); 
	}
	if ($mode=='edit')
	{
		$op_mode = "Editeaza grupul de teste";
	    $sql="select * from  test_grup where tg_id=".$id." ".$cond; 
	    $result=mysqli_query($con,$sql) or die(mysql_error());
	    $tg_id=mysqli_result($result,0,"tg_id"); 
	    $tg_titlu=mysqli_result($result,0,"tg_titlu");
	    $tg_descriere=mysqli_result($result,0,"tg_descriere");
	    if (mysqli_result($result,0,"tg_arata")==1)
	    {
	    	$ec_active='Checked';
	    }
	    else
	    {
	    	$ec_active='';

	    }
	}
	if ($mode=='add')
	{
		$op_mode = "Adauga un nou grup de teste";

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
		
		window.location.href="lista_grup_teste.php";
	
	}
	
	function validateForm(theForm) 
	{
		
	    if (trimAll(document.form1.TxtCategory.value).length == 0) 
	    {
	    	alert("Category can't blank." );
	    	document.form1.TxtCategory.focus();
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
<form name="form1" onsubmit="return validateForm(this)" method="post" action="adauga_grup_teste.php?mode=<?php echo($mode)?>&id=<?php echo($id)?>" >
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
								<td>
								<table border="0" width="100%" id="table11" cellpadding="2">
									<tr>
										<td align="left" class="td_tablecap1">
										<b> <font color="red"> <?php echo($op_mode); ?></font></b></td>
									</tr>
									<tr>
										<td align="left" valign="bottom" style="padding-left: 10px">
										ID</td>
									</tr>
									<tr>
										<td align="left" valign="bottom" style="padding-left: 10px">
                                            <input type="text" name="TxtCatID" size="25" class ="TextBoxStyle" disabled value="<?php echo($tg_id);?>" ></td>
									</tr>
									<tr>
										<td align="left" valign="bottom" style="padding-left: 10px">
										Categorie</td>
									</tr>
									<tr>
										<td align="left" valign="top" style="padding-left: 10px" >
                                            <input type="text" name="TxtCategory" size="25" class ="TextBoxStyle" value="<?php echo($tg_titlu);?>" ></td>
									</tr>
									<tr>
										<td align="left" valign="bottom" style="padding-left: 10px">
										Descriere</td>
									</tr>
									<tr>
										<td align="left" valign="top" style="padding-left: 10px">
                                            <textarea rows="3" name="TxtDescription" cols="24" class ="TextBoxArea" ><?php echo($tg_descriere);?></textarea></td>
									</tr>
									<tr>
										<td align="left" style="padding-left: 10px">
                                            <input type="checkbox" name="ChkAfiseaza" value="ON" <?php echo($ec_active);?> >Activ</td>
									</tr>
									<tr>
										<td align="left" style="padding-left: 10px">
                                            <input type="submit" value="Trimite" name="BtnSubmit" class="ButtonStyle">&nbsp; 
                                            <input type="reset" value="Sterge" name="BtnReset" class="ButtonStyle">&nbsp;&nbsp; 
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