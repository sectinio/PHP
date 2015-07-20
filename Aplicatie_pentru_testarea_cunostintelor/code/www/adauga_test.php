<?php
include 'conexiune_baza_de_date.php';
//mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
//mysql_select_db("$db_name")or die("cannot select DB");
$t_id=''; 
$t_titlu='';
$t_descriere='';
$em_active='';
$op_mode='';
$em_category='';
$timp='';

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
		if ($usertype=='Administrator')
		{
			$cond=" ";
		}
		else
		{
			$cond="and t_creat_de=".$_SESSION['userid'];
		}


	$mode=$_GET["mode"]; 
	$id=$_GET["id"]; 

	if(isset($_POST['BtnSubmit']))//if($_POST['BtnSubmit']=='Trimite')
	{
		ob_start();
		if ($mode=='edit')
		{
		
			$chk_dis=0;	
			if(isset($_POST['ChkAfiseaza'])) //if ($_POST['ChkAfiseaza']=='ON')
			{
				$chk_dis=1;
			}
			else
			{
				$chk_dis=0;
			}
		 	$result1=mysqli_query($con,"select tg_id from test_grup where tg_titlu='".$_POST['DdlCategory']."'");	
		 	$cat_id=mysqli_result($result1,0,"tg_id");
			$txt_name=$_POST['TxtExam'];
			$txt_desc=$_POST['TxtDescription'];
			$time=$_POST['time'];
		    $sql="update  test set t_timp='$time', t_tg_id='$cat_id', t_titlu='$txt_name', t_descriere='$txt_desc', t_arata='$chk_dis' where  t_id=".$id." ".$cond ; 
		    $result=mysqli_query($con,$sql) or die(mysql_error());
			
			header("location:lista_teste.php"); 

	 
		}
		if ($mode=='add')
		{
		 
			$chk_dis=0;	
		if(isset($_POST['ChkAfiseaza']))//	if ($_POST['ChkAfiseaza']=='ON')
			{
				$chk_dis=1;
			}
			else
			{
				$chk_dis=0;
			}
		 	$result1=mysqli_query($con,"select tg_id from test_grup where tg_titlu='".$_POST['DdlCategory']."'");	
		 	$cat_id=mysqli_result($result1,0,"tg_id");
			$txt_name=$_POST['TxtExam'];
			$txt_desc=$_POST['TxtDescription'];
			$timp=$_POST['time'];
			$result=mysqli_query($con,"select max(t_id)+1 as m from test" );
			
			$id_=mysqli_result($result,0,"m"); 
			
			$uid=$_SESSION['userid'];
			
		    $sql="insert into  test values('$id_','$cat_id','$txt_name','$txt_desc','$uid','$chk_dis',$timp)"; 
		    
		    $result=mysqli_query($con,$sql) or die(mysql_error());
			
			header("location:lista_teste.php"); 

	
		}
		
	
	
		ob_end_flush();
	}


?>

<?php 

	
	if ($mode=='delete')
	{
	    $sql="delete from  test where  t_id=".$id." ".$cond ;  
	    $result=mysqli_query($con,$sql) or die(mysql_error()); 
	    
		header("location:lista_teste.php"); 
	}
	if ($mode=='edit')
	{
		$op_mode = "Editeaza examen";
	    $sql="select e.*,c.* from  test e,test_grup c where e.t_tg_id=c.tg_id and  t_id=".$id." ".$cond ; 
	    $result=mysqli_query($con,$sql) or die(mysql_error());
	    
	    $t_id=mysqli_result($result,0,"t_id"); 
	    $em_category=mysqli_result($result,0,"tg_titlu");
	    $t_titlu=mysqli_result($result,0,"t_titlu");
	    $t_descriere=mysqli_result($result,0,"t_descriere");
		$timp=mysqli_result($result,0,"t_timp");
	    if (mysqli_result($result,0,"t_arata")==1)
	    {
	    	$em_active='Checked';
	    }
	    else
	    {
	    	$em_active='';

	    }
	}
	if ($mode=='add')
	{
		$op_mode = "Adauga examen";

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
	
		window.location.href="lista_teste.php";
	
	}
	
	function validateForm(theForm) 
	{
		
	    if (trimAll(document.form1.TxtExamen.value).length == 0) 
	    {
	    	alert("Titlul testului nu trebuie sa lipseasca." );
	    	document.form1.TxtExamen.focus();
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
<form name="form1" onsubmit="return validateForm(this)" method="post" action="adauga_test.php?mode=<?php echo($mode)?>&id=<?php echo($id)?>" >
<div align="center">
	<table border="0" width="100%" cellspacing="1" height="70" id="table1">
		
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
						<table  width="100%" id="table10" >
							<tr>
								<td>
								<table border="0" width="100%" id="table11" cellpadding="2">
									<tr>
										<b> <font color="red"> <?php echo($op_mode); ?></font></b></td>
										
									</tr>
									<tr>
										<td align="left" valign="bottom" style="padding-left: 10px">
										ID</td>
									</tr>
									<tr>
										<td align="left" valign="bottom" style="padding-left: 10px">
                                            <input type="text" name="TxtExamID" size="25" class ="TextBoxStyle" disabled value="<?php echo($t_id);?>" ></td>
									</tr>
									<tr>
										<td align="left" valign="bottom" style="padding-left: 10px">
										Categorie</td>
									</tr>
									<tr>
										<td align="left" valign="bottom" style="padding-left: 10px">
										<select size="1" name="DdlCategory">
										<?php
												if ($usertype=='Administrator')
												{
													$cond1=" ";
												}
												else
												{
													$cond1="and tg_creat_de=".$_SESSION['userid'];
												}
										
										//	session_start();
									    $sql="select tg_titlu from  test_grup where 1=1 ".$cond1 ; 
  										$result=mysqli_query($con,$sql) or die(mysql_error());
  										$count=mysqli_num_rows($result);
								
								$i=0;
											for($i=0;$i<$count; $i++)
											{
												$opt=mysqli_result($result,$i,"tg_titlu");
												if ($opt==$em_category)
												{
													echo("<option selected>$opt</option>");
												}
												else
												{
													echo("<option>$opt</option>");
												}

											}
											
										?>
										</select></td>
									</tr>
									<tr>
										<td align="left" valign="bottom" style="padding-left: 10px">
										Nume examen</td>
									</tr>
									<tr>
										<td align="left" valign="top" style="padding-left: 10px" >
                                            <input type="text" name="TxtExam" size="25" class ="TextBoxStyle" value="<?php echo($t_titlu);?>" ></td>
									</tr>
									<tr>
										<td align="left" valign="bottom" style="padding-left: 10px">
										Descriere examen</td>
									</tr>
									<tr>
										<td align="left" valign="top" style="padding-left: 10px">
                                            <textarea rows="3" name="TxtDescription" cols="24" class ="TextBoxArea" ><?php echo($t_descriere);?></textarea></td>
									</tr>
									<tr>
										<td align="left" valign="bottom" style="padding-left: 10px">
										Durata examen</td>
									</tr>
									<tr>
										<td align="left" style="padding-left: 10px">
                                            <input type="number" name="time" min=1 max=90 value="<?php echo($timp);?>" >minute</td>
									</tr>
									<tr>
										<td align="left" style="padding-left: 10px">
                                            <input type="checkbox" name="ChkAfiseaza" value="ON" <?php echo($em_active);?> >Examenul este activat</td>
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