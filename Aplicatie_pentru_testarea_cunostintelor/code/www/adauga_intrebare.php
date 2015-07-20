<?php
include 'conexiune_baza_de_date.php';
//mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
//mysql_select_db("$db_name")or die("cannot select DB");
$sc_id=''; 
$t_titlu='';
$sc_description='';
$sc_active='';
$op_mode='';
$chk_display='';
$rd_display='';
$file_display='';
$text_display='';
//question
$qm_type='';
$qm_id='';
$qm_text='';
$qm_active='';
$sm_active='';
//answer
$rightoption_1='';
$rightoption_2='';
$rightoption_3='';
$rightoption_4='';

$op_text1='';
$op_text2='';
$op_text3='';
$op_text4='';

session_start();
if(!isset($_SESSION['username']) || trim($_SESSION['username'])=='')
{
	header("location:index.php");
}
else
{
	$uid=$_SESSION['userid'];
	$username=$_SESSION['username'];
	$usertype=$_SESSION['usertype'];

}
?>

<?php

	$mode=$_GET["mode"]; 
	$id=$_GET["id"]; 

if(isset($_POST['BtnSubmit']))	//if($_POST['BtnSubmit']=='Trimite')
	{
/*	$check=mysqli_query($con,"select se_t_id from student_examen, test where t_id=se_t_id and t_titlu='".$_POST['DdlExam']."'");	
	$row_check=mysqli_num_rows($check);
	if($row_check>0)
	{
	$msg = urlencode("Invalid Login. Please try again with correct user name and password. ");
			header("Location:adauga_intrebare.php?mode=add&id=0&msg=$msg");}
else {	*/

		ob_start();
		$points=$_POST['quantity'];
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
			

			//get right option
			$chk_op1=0;
			if (isset($_POST['Chk1'])||$_POST['Rd1']=='V2')
			{
				$chk_op1=1;
			}
			else
			{
				$chk_op1=0;
			}

			$chk_op2=0;
			if (isset($_POST['Chk2'])||$_POST['Rd1']=='V3')
			{
				$chk_op2=1;
			}
			else
			{
				$chk_op2=0;
			}
			
			$chk_op3=0;
			if (isset($_POST['Chk3'])||$_POST['Rd1']=='V4')
			{
				$chk_op3=1;
			}
			else
			{
				$chk_op3=0;
			}
			
			$chk_op4=0;
			if (isset($_POST['Chk4'])||$_POST['Rd1']=='V5')
			{
				$chk_op4=1;
			}
			else
			{
				$chk_op4=0;
			}
			
			
		 	$result1=mysqli_query($con,"select t_id from test where t_titlu='".$_POST['DdlExam']."'");	
		 	$t_id=mysqli_result($result1,0,"t_id");
			//echo $t_id;
			$txt_question=$_POST['TxtQuestion'];
			$txt_type=$_POST['DdlAnswerType'];
			
			echo $points;
		  $sql="update intrebare set i_test_id='$t_id', i_text='$txt_question', i_tip='$txt_type', i_arata=$chk_dis, i_puncte=$points where i_creat_de=".$_SESSION['userid']." and i_id=".$id; 
		  
		 // echo($sql);
		  //exit();
		  
		  $result=mysqli_query($con,$sql) or die(mysql_error());
			
			//delete options
			$sql="delete from   varianta_raspuns where vr_i_id=".$id; 
	    $result=mysqli_query($con,$sql) or die(mysql_error()); 
	    			
			//insert options
			$result1=mysqli_query($con,"select ifnull(max(vr_id)+1,1) m from varianta_raspuns");	
		 	$vr_id=mysqli_result($result1,0,"m");
			
			//op 1
		 	$txt_opt=$_POST['TxtOption1'];		 	
		 	$filename = stripslashes($_FILES['File1']['name']);		 	
		 	$image_name=$filename;
			$newname="images/".$image_name;
			//$copied = copy($_FILES['File1']['name'], $newname); 	
		 	$orig = isset($_FILES['File1']) && isset($_FILES['File1']['tmp_name']) ? $_FILES['File1']['tmp_name'] : '';
			$copied = move_uploaded_file($orig, $newname);$txt_image=$filename;
			$sql="insert into varianta_raspuns values($vr_id,$id,'$txt_opt','$txt_image',$chk_op1)"; $vr_id=$vr_id+1;
			$result=mysqli_query($con,$sql) or die(mysql_error());
			//op 2
			
		 	$txt_opt=$_POST['TxtOption2'];
		 	$filename = stripslashes($_FILES['File2']['name']);		 	
		 	$image_name=$filename;
			$newname="images/".$image_name;
			//$copied = copy($_FILES['image']['File2'], $newname); 	
		 	$orig = isset($_FILES['File2']) && isset($_FILES['File2']['tmp_name']) ? $_FILES['File2']['tmp_name'] : '';

$copied = move_uploaded_file($orig, $newname);$txt_image=$filename;
			$sql="insert into varianta_raspuns values($vr_id,$id,'$txt_opt','$txt_image',$chk_op2)";$vr_id=$vr_id+1;
			$result=mysqli_query($con,$sql) or die(mysql_error());			
			//op 3
		 	$txt_opt=$_POST['TxtOption3'];
		 	$filename = stripslashes($_FILES['File3']['name']);		 	
		 	$image_name=$filename;
			$newname="images/".$image_name;
			//$copied = copy($_FILES['image']['File3'], $newname); 	
		 	$orig = isset($_FILES['File3']) && isset($_FILES['File3']['tmp_name']) ? $_FILES['File3']['tmp_name'] : '';

$copied = move_uploaded_file($orig, $newname);$txt_image=$filename; 	
			$sql="insert into varianta_raspuns values($vr_id,$id,'$txt_opt','$txt_image',$chk_op3)";$vr_id=$vr_id+1;
			$result=mysqli_query($con,$sql) or die(mysql_error());
			//op 4
		 	$txt_opt=$_POST['TxtOption4'];
		 	$filename = stripslashes($_FILES['File4']['name']);		 	
		 	$image_name=$filename;
			$newname="images/".$image_name;
		//	$copied = copy($_FILES['image']['File1'], $newname); 	
		$orig = isset($_FILES['File4']) && isset($_FILES['File4']['tmp_name']) ? $_FILES['File4']['tmp_name'] : '';

$copied = move_uploaded_file($orig, $newname); 	$txt_image=$filename;
			$sql="insert into varianta_raspuns values($vr_id,$id,'$txt_opt','$txt_image',$chk_op4)";$vr_id=$vr_id+1;
			$result=mysqli_query($con,$sql) or die(mysql_error());
			
			header("location:lista_intrebari.php"); 

	 
		}
		if ($mode=='add')
		{
		 
			$chk_dis=0;	
			if(isset($_POST['ChkAfiseaza']))//if ($_POST['ChkAfiseaza']=='ON')
			{
				$chk_dis=1;
			}
			else
			{
				$chk_dis=0;
			}
			
			//get right option
			$chk_op1=0;
			if (isset($_POST['Chk1'])||$_POST['Rd1']=='V2')
			{
				$chk_op1=1;
			}
			else
			{
				$chk_op1=0;
			}

			$chk_op2=0;
			if (isset($_POST['Chk2'])||$_POST['Rd1']=='V3')
			{
				$chk_op2=1;
			}
			else
			{
				$chk_op2=0;
			}
			
			$chk_op3=0;
			if (isset($_POST['Chk3'])||$_POST['Rd1']=='V4')
			{
				$chk_op3=1;
			}
			else
			{
				$chk_op3=0;
			}
			
			$chk_op4=0;
			if (isset($_POST['Chk4'])||$_POST['Rd1']=='V5')
			{
				$chk_op4=1;
			}
			else
			{
				$chk_op4=0;
			}

			
		 	$result1=mysqli_query($con,"select t_id from test where t_titlu='".$_POST['DdlExam']."'");	
		 	$t_id=mysqli_result($result1,0,"t_id");
		 	
		 	$result2=mysqli_query($con,"select ifnull(max(i_id)+1,1) m from intrebare ");	
		 	$i_id=mysqli_result($result2,0,"m");
		 	
			$txt_question=$_POST['TxtQuestion'];
			$txt_type=$_POST['DdlAnswerType'];
			
		  $sql="insert into intrebare values($i_id,$t_id,null,'$txt_question','$txt_type',$uid,sysdate(),$chk_dis,$points)"; //aici de uitat
		  $result3=mysqli_query($con,$sql) or die(mysql_error());
		   
			
			//delete options
			$sql="delete from  varianta_raspuns where vr_i_id=".$i_id; 
	    $result=mysqli_query($con,$sql) or die(mysql_error()); 
	    			
			//insert options
			$result1=mysqli_query($con,"select ifnull(max(vr_id)+1,1) m from varianta_raspuns");	
		 	$vr_id=mysqli_result($result1,0,"m");
			//op 1
		 	$txt_opt=$_POST['TxtOption1'];
		 	$filename = stripslashes($_FILES['File1']['name']);		 	
		 	$image_name=$filename;
			$newname="images/".$image_name;
			//$copied = copy($_FILES['File1']['tmp_name'], $newname); 	
			//copy( $_FILES['File1']['tmp_name'], "/images/".$_FILES['File1']['name'] );
			$orig = isset($_FILES['File1']) && isset($_FILES['File1']['tmp_name']) ? $_FILES['File1']['tmp_name'] : '';

$copied = move_uploaded_file($orig, $newname);
		 	$txt_image=$filename;
			$sql="insert into varianta_raspuns values($vr_id,$i_id,'$txt_opt','$txt_image',$chk_op1)";$vr_id=$vr_id+1;
			$result=mysqli_query($con,$sql) or die(mysql_error());
			//op 2
		 	$txt_opt=$_POST['TxtOption2'];
		 	$filename = stripslashes($_FILES['File2']['name']);		 	
		 	$image_name=$filename;
			$newname="images/".$image_name;
			//$copied = copy($_FILES['File2']['name'], $newname); 
$orig = isset($_FILES['File2']) && isset($_FILES['File2']['tmp_name']) ? $_FILES['File2']['tmp_name'] : '';

$copied = move_uploaded_file($orig, $newname);			
		 	$txt_image=$filename;
			$sql="insert into varianta_raspuns values($vr_id,$i_id,'$txt_opt','$txt_image',$chk_op2)";$vr_id=$vr_id+1;
			$result=mysqli_query($con,$sql) or die(mysql_error());			
			//op 3
		 	$txt_opt=$_POST['TxtOption3'];
		 	$filename = stripslashes($_FILES['File3']['name']);		 	
		 	$image_name=$filename;
			$newname="images/".$image_name;
			//$copied = copy($_FILES['File3']['name'], $newname); 
$orig = isset($_FILES['File3']) && isset($_FILES['File3']['tmp_name']) ? $_FILES['File3']['tmp_name'] : '';

$copied = move_uploaded_file($orig, $newname);			
		 	$txt_image=$filename;
			$sql="insert into varianta_raspuns values($vr_id,$i_id,'$txt_opt','$txt_image',$chk_op3)";$vr_id=$vr_id+1;
			$result=mysqli_query($con,$sql) or die(mysql_error());
			//op 1
		 	$txt_opt=$_POST['TxtOption4'];
		 	$filename = stripslashes($_FILES['File4']['name']);		 	
		 	$image_name=$filename;
			$newname="images/".$image_name;
			//$copied = copy($_FILES['File4']['name'], $newname); 	
$orig = isset($_FILES['File4']) && isset($_FILES['File4']['tmp_name']) ? $_FILES['File4']['tmp_name'] : '';

$copied = move_uploaded_file($orig, $newname);		 	$txt_image=$filename;
			$sql="insert into varianta_raspuns values($vr_id,$i_id,'$txt_opt','$txt_image',$chk_op4)";$vr_id=$vr_id+1;
			$result=mysqli_query($con,$sql) or die(mysql_error());
			
			header("location:lista_intrebari.php"); 

	
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
			$cond="and i_creat_de=".$_SESSION['userid'];
		}
	//echo $cond;
	
	if ($mode=='delete')
	{
			$sql="delete from  varianta_raspuns where vr_i_id=".$id; 
	    $result=mysqli_query($con,$sql) or die(mysql_error()); 
		
	    $sql="delete from  intrebare where i_id=".$id." ".$cond; 
	    $result=mysqli_query($con,$sql) or die(mysql_error()); 
	    
			header("location:lista_intrebari.php"); 
	}
	if ($mode=='edit')
	{
		$op_mode = "Editeaza intrebarea";
		$sql="SELECT q.*, o.*, e.* FROM intrebare q, varianta_raspuns o, test e 
			where q.i_test_id=e.t_id and o.vr_i_id=q.i_id and i_id=".$id." ".$cond;
		
		
		
	    $result=mysqli_query($con,$sql) or die(mysql_error());

	   // $qm_id=mysqli_num_rows($result);
	    $qm_id=mysqli_result($result,0,"i_id");
		//echo $qm_id;
	    $qm_text=mysqli_result($result,0,"i_text");
		//echo $qm_text;
	    if (mysqli_result($result,0,"i_arata")==1)
	    {
	    	$qm_active='Checked';
	    }
	    else
	    {
	    	$qm_active='';
	    }
	    $t_titlu=mysqli_result($result,0,"t_titlu");
		
	    $em_active=" disabled ";
	    //get options 
	   
	    
	    $qm_type=mysqli_result($result,0,"i_tip");
	    
	   	$op_text1=mysqli_result($result,0,"vr_text");
	  	$op_text2=mysqli_result($result,1,"vr_text");
	  	$op_text3=mysqli_result($result,2,"vr_text");
	  	$op_text4=mysqli_result($result,3,"vr_text");
	  	
	  	$op_image1=mysqli_result($result,0,"vr_locatie_imagine");
	  	$op_image2=mysqli_result($result,1,"vr_locatie_imagine");
	  	$op_image3=mysqli_result($result,2,"vr_locatie_imagine");
	  	$op_image4=mysqli_result($result,3,"vr_locatie_imagine");
	  	
	  	$link1="<a href='\\images\\".$op_image1."' target=_blank>".$op_image1."</a>";
	  	$link2="<a href='\\images\\".$op_image2."' target=_blank>".$op_image2."</a>";
	  	$link3="<a href='\\images\\".$op_image3."' target=_blank>".$op_image3."</a>";
	  	$link4="<a href='\\images\\".$op_image4."' target=_blank>".$op_image4."</a>";
	    
		$blabla=mysqli_result($result,0,"vr_corect");
		
	    if (mysqli_result($result,0,"vr_corect")=="1" )
	    {
	   		$rightoption_1 ='Checked';
	   	}
	   	else
	   	{
	   		$rightoption_1 ='';
	   	}
	    if (mysqli_result($result,1,"vr_corect")=="1" )
	    {
	   		$rightoption_2 ='Checked';
	   	}
	   	else
	   	{
	   		$rightoption_3 ='';
	   	}
	   	if (mysqli_result($result,2,"vr_corect")=="1" )
	    {
	   		$rightoption_3 ='Checked';
	   	}
	   	else
	   	{
	   		$rightoption_3 ='';
	   	}
	   	if (mysqli_result($result,3,"vr_corect")=="1" )
	    {
	   		$rightoption_4 ='Checked';
	   	}
	   	else
	   	{
	   		$rightoption_4 ='';
	   	}
  
	    
	    
	    if ($qm_type=="Un singur raspuns corect - text -")
	    {
	    	//style.display="none"
	    	$text_display=" ";
	    	$file_display="style='display:none'";
	    	$chk_display="style='display:none'";
	    	$rd_display=" ";
	    	
		   	$link1="";
		  	$link2="";
		  	$link3="";
		  	$link4="";
		  	
		  	
	    	
	    }
	    if ($qm_type=="Un singur raspuns corect - imagine -")
			{
				$text_display="style='display:none'";
	    	$file_display=" ";
	    	$chk_display=" ";
	    	$rd_display="style='display:none'";
	  	}
	  	if ($qm_type=="Mai multe raspunsuri corecte - text -")
			{
				$text_display=" ";
	    	$file_display="style='display:none'";
	    	$chk_display="style='display:none'";
	    	$rd_display=" ";
	    	
	    	$link1="";
		  	$link2="";
		  	$link3="";
		  	$link4="";
	  	}
	  	if ($qm_type=="Mai multe raspunsuri corecte - imagine -")
			{
				$text_display="style='display:none'";
	    	$file_display=" ";
	    	$chk_display="style='display:none'";
	    	$rd_display=" ";
	  	}
	  	

	  	
	  	
	   
	    
	     
	    $t_id=mysqli_result($result,0,"t_id"); 
	   // $sm_category=mysqli_result($result,0,"sc_name");
	   // $sm_name=mysqli_result($result,0,"sm_name");
	   // $sm_description=mysqli_result($result,0,"sm_description");
	    
	    

	}
	if ($mode=='add')
	{
	$link1="";
		  	$link2="";
		  	$link3="";
		  	$link4="";
	    	//style.display="none"
	    	$text_display=" ";
	    	$file_display="style='display:none'";
	    	$chk_display="style='display:none'";
	    	$rd_display=" ";
	    	
		   	
			
		
	    	

	}

?>



<html>

<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>Aplicatie online pentru testatea cunostintelor</title>
<link href="style/Style1.css" rel="stylesheet" type="text/css" />

<script language ="javascript" type ="text/javascript" >



	function GoBack()
	{
		window.location.href="lista_intrebari.php";
	}
	
	function validateForm(theForm) 
	{
		

		
	    if (trimAll(document.form1.TxtQuestion.value).length == 0) 
	    {
	    	alert("Nu ati introdus textul intrebarii." );
	    	document.form1.TxtQuestion.focus();
	    	return false;
	
	    } 
		if (trimAll(document.form1.quantity.value).length == 0) 
	    {
	    	alert("Nu ati introdus punctajul." );
	    	document.form1.quantity.focus();
	    	return false;
	
	    } 
    	return true;
	}
	
	function DisplayControl()
	{
		var sel_text=document.form1.DdlAnswerType.options[document.form1.DdlAnswerType.selectedIndex].text;
		//var sel_text=document.getElementById("schimba").value;
		//var sel_text=document.form1.DdlAnswerType.value;
		//var sel_text=selTag.options[selTag.selectedIndex].text;
		
		if (sel_text=='Un singur raspuns corect - text -')
		{
		
			document.form1.Chk1.style.display="none";
			//document.form1.Rd1.style.display="inline";
			document.form1.Chk2.style.display="none";
			//document.form1.Rd2.style.display="inline";
			document.form1.Chk3.style.display="none";
			//document.form1.Rd3.style.display="inline";
			document.form1.Chk4.style.display="none";
			//document.form1.Rd4.style.display="inline";
			document.getElementById("Rd1a").style.display = "inline";
			document.getElementById("Rd1b").style.display = "inline";
			document.getElementById("Rd1c").style.display = "inline";
			document.getElementById("Rd1d").style.display = "inline";
			
			document.form1.TxtOption1.style.display="inline";
			document.form1.File1.style.display="none";
			document.form1.TxtOption2.style.display="inline";
			document.form1.File2.style.display="none";
			document.form1.TxtOption3.style.display="inline";
			document.form1.File3.style.display="none";
			document.form1.TxtOption4.style.display="inline";
			document.form1.File4.style.display="none";
			
			document.getElementById('div1').style.visibility = 'hidden';
			document.getElementById('div2').style.visibility = 'hidden';
			document.getElementById('div3').style.visibility = 'hidden';
			document.getElementById('div4').style.visibility = 'hidden';
			
		}
		
	
		if (sel_text=='Un singur raspuns corect - imagine -')
		{
			document.form1.Chk1.style.display="none";
			//document.form1.Rd1.style.display="inline";
			document.form1.Chk2.style.display="none";
			//document.form1.Rd2.style.display="";
			document.form1.Chk3.style.display="none";
			//document.form1.Rd3.style.display="";
			document.form1.Chk4.style.display="none";
			//document.form1.Rd4.style.display="";
			
				document.getElementById("Rd1a").style.display = "inline";
			document.getElementById("Rd1b").style.display = "inline";
			document.getElementById("Rd1c").style.display = "inline";
			document.getElementById("Rd1d").style.display = "inline";
			
			document.form1.TxtOption1.style.display="none";
			document.form1.File1.style.display="inline";
			document.form1.TxtOption2.style.display="none";
			document.form1.File2.style.display="inline";
			document.form1.TxtOption3.style.display="none";
			document.form1.File3.style.display="inline";
			document.form1.TxtOption4.style.display="none";
			document.form1.File4.style.display="inline";
			
			document.getElementById('div1').style.visibility = 'visible'; 
			document.getElementById('div2').style.visibility = 'visible'; 
			document.getElementById('div3').style.visibility = 'visible'; 
			document.getElementById('div4').style.visibility = 'visible'; 
			
		}
		
		if (sel_text=='Mai multe raspunsuri corecte - text -')
		{
			//var rbtn = document.getElementById('Rd1');
			//rbtn.style.display = "none";
			document.form1.Chk1.style.display="";
			//document.form1.Rd1.style.display="none";
			document.form1.Chk2.style.display="";
			//document.form1.Rd2.style.display="none";
			document.form1.Chk3.style.display="";
			//document.form1.Rd3.style.display="none";
			document.form1.Chk4.style.display="";
			//document.form1.Rd4.style.display="none";
			
				document.getElementById("Rd1a").style.display = "none";
			document.getElementById("Rd1b").style.display = "none";
			document.getElementById("Rd1c").style.display = "none";
			document.getElementById("Rd1d").style.display = "none";
			
			document.form1.TxtOption1.style.display="";
			document.form1.File1.style.display="none";
			document.form1.TxtOption2.style.display="";
			document.form1.File2.style.display="none";
			document.form1.TxtOption3.style.display="";
			document.form1.File3.style.display="none";
			document.form1.TxtOption4.style.display="";
			document.form1.File4.style.display="none";
			
			document.getElementById('div1').style.visibility = 'hidden';
			document.getElementById('div2').style.visibility = 'hidden';
			document.getElementById('div3').style.visibility = 'hidden';
			document.getElementById('div4').style.visibility = 'hidden';
			
		}
		if (sel_text=="Mai multe raspunsuri corecte - imagine -")
		{
			document.form1.Chk1.style.display="";
			//document.form1.Rd1.style.display="none";
			document.form1.Chk2.style.display="";
			//document.form1.Rd2.style.display="none";
			document.form1.Chk3.style.display="";
			//document.form1.Rd3.style.display="none";
			document.form1.Chk4.style.display="";
			//document.form1.Rd4.style.display="none";
			
				document.getElementById("Rd1a").style.display = "none";
			document.getElementById("Rd1b").style.display = "none";
			document.getElementById("Rd1c").style.display = "none";
			document.getElementById("Rd1d").style.display = "none";
			
			document.form1.TxtOption1.style.display="none";
			document.form1.File1.style.display="";
			document.form1.TxtOption2.style.display="none";
			document.form1.File2.style.display="";
			document.form1.TxtOption3.style.display="none";
			document.form1.File3.style.display="";
			document.form1.TxtOption4.style.display="none";
			document.form1.File4.style.display="";
			
			
			document.getElementById('div1').style.visibility = 'visible'; 
			document.getElementById('div2').style.visibility = 'visible'; 
			document.getElementById('div3').style.visibility = 'visible'; 
			document.getElementById('div4').style.visibility = 'visible'; 
		}
	
		
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

<form name="form1" onsubmit="return validateForm(this)" method="post" action="adauga_intrebare.php?mode=<?php echo($mode)?>&id=<?php echo($id)?>" enctype="multipart/form-data" >
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
			
			
			
<table border="0" width="500" id="table9">
					<tr>
						<td width="500">
						<table border="0" width="100%" id="table10">
							<tr>
								<td>
								<table border="0" width="500" id="table11" >
									<tr>
										<td align="left" class="td_tablecap1" width="500" colspan="2">
										<b> <font color="red"> <?php echo($op_mode); ?></font></b></td>
									</tr>
									<tr>
										<td align="left" valign="bottom" style="padding-left: 10px" width="500" colspan="2">
										Examen :
										<select size="1" name="DdlExam"   >
										<?php
											//session_start();
									    $sql1="select t_titlu from  test where t_arata=1 order by t_titlu " ; 
  										$result=mysqli_query($con,$sql1) or die(mysql_error());
  										$count=mysqli_num_rows($result);
											$i=0;
											for($i=0;$i<$count; $i++)
											{
												$opt=mysqli_result($result,$i,"t_titlu");

												if ($t_titlu==$opt)
												{
													echo("<option selected >$opt</option>");
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
										<td align="left" valign="bottom" style="padding-left: 10px" width="500" colspan="2">
										Intrebarea nr. :
                                            <input type="text" name="TxtQuestionID" size="11" class ="TextBoxStyle" disabled value="<?php echo($qm_id);?>" ></td>
									</tr>
									<tr>
										<td align="left" valign="bottom" style="padding-left: 10px" width="500" colspan="2">
                                            Intrebare :</td>
									</tr>
									<tr>
										<td align="left" valign="bottom" style="padding-left: 10px" width="500" colspan="2">
										    <textarea rows="3" name="TxtQuestion" cols="67" class ="TextBoxArea" ><?php echo($qm_text); ?></textarea></td>
									</tr>
									<tr>
										<td align="left" valign="bottom" style="padding-left: 10px" width="165">
                                            <input type="checkbox" name="ChkAfiseaza" value="ON" <?php echo($qm_active);?> > Afiseaza&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>
										<td align="left" valign="bottom" style="padding-left: 10px" width="312">
										Tip raspuns :
										<select id='schimba' size="1" name="DdlAnswerType" onchange="DisplayControl()">
										<option <?php if ($qm_type=='Un singur raspuns corect - text -') {echo('selected');} ?> >Un singur raspuns corect - text -</option>
										<option <?php if ($qm_type=='Un singur raspuns corect - imagine -') {echo('selected');} ?> >Un singur raspuns corect - imagine -</option>
										<option <?php if ($qm_type=='Mai multe raspunsuri corecte - text -') {echo('selected');} ?>>Mai multe raspunsuri corecte - text -</option>
										<option <?php if ($qm_type=='Mai multe raspunsuri corecte - imagine -') {echo('selected');} ?>>Mai multe raspunsuri corecte - imagine -</option>
										</select> </td>
									</tr>
									<tr>
									<td>
									Valoare punctaj: <input type="number" name="quantity" min="1" max="10">
									</td>
									</tr>
									<tr>
										<td align="left" valign="bottom" style="padding-left: 10px" width="500" colspan="2">
										Optiuni</td>
									</tr>
									<tr>
										<td align="left" valign="bottom" style="padding-left: 10px" width="500" colspan="2">
										<table border="0" width="100%" id="table12">
											<tr>
												<td width="4" align="left" valign="top">
                                            A.</td>
												<td width="4" align="left" valign="top">
                                            <input type="checkbox" name="Chk1" value="ON" <?php echo($chk_display); ?> ><input id="Rd1a" type="radio" value="V2" name="Rd1" <?php echo($rightoption_1);?> <?php echo($rd_display); ?> ></td>
												<td align="left" valign="top">
                                            <textarea rows="3" name="TxtOption1" cols="63" class ="TextBoxArea" <?php echo($text_display); ?> ><?php echo($op_text1); ?></textarea> 
											<input type="file" accept="image/*" name="File1" size="20" <?php echo($file_display); ?>> &nbsp; <div id="div1"><?php echo($link1); ?></div></td>
											</tr>
											<tr>
												<td width="4" align="left" valign="top">
                                            B.</td>
												<td width="4" align="left" valign="top">
                                            <input type="checkbox" name="Chk2" value="ON" <?php echo($chk_display); ?> ><input id="Rd1b" type="radio" value="V3" name="Rd1" <?php echo($rightoption_2);?> <?php echo($rd_display); ?> ></td>
												<td align="left" valign="top">
                                            <textarea rows="3" name="TxtOption2" cols="63" class ="TextBoxArea" <?php echo($text_display); ?>><?php echo($op_text2);?></textarea> 
											<input type="file" accept="image/*" name="File2" size="20" <?php echo($file_display); ?>> &nbsp; <div id="div2"><?php echo($link2); ?></div></td>
											</tr>
											<tr>
												<td width="4" align="left" valign="top">
                                            C.</td>
												<td width="4" align="left" valign="top">
                                            <input type="checkbox" name="Chk3" value="ON" <?php echo($chk_display); ?> ><input id="Rd1c" type="radio" value="V4" name="Rd1" <?php echo($rightoption_3);?> <?php echo($rd_display); ?> ></td>
												<td align="left" valign="top">
                                            <textarea rows="3" name="TxtOption3" cols="63" class ="TextBoxArea" <?php echo($text_display); ?>><?php echo($op_text3);?></textarea> 
											<input type="file" accept="image/*" name="File3" size="20" <?php echo($file_display); ?>> &nbsp; <div id="div3"><?php echo($link3); ?></div></td>
											</tr>
											<tr>
												<td width="4" align="left" valign="top">
                                            D.</td>
												<td width="4" align="left" valign="top">
                                            <input type="checkbox" name="Chk4" value="ON" <?php echo($chk_display); ?> ><input id="Rd1d" type="radio" value="V5" name="Rd1" <?php echo($rightoption_4);?> <?php echo($rd_display); ?> ></td>
												<td align="left" valign="top">
                                            <textarea rows="3" name="TxtOption4" cols="63" class ="TextBoxArea" <?php echo($text_display); ?>><?php echo($op_text4);?></textarea> 
											<input type="file" name="File4" size="20" <?php echo($file_display); ?>> &nbsp; <div id="div4"><?php echo($link4); ?></div> </td>
											</tr>
										</table>
										</td>
									</tr>
									<tr>
										<td align="left" style="padding-left: 10px" width="500" colspan="2">
                                            &nbsp;</td>
									</tr>
									<tr>
										<td align="left" style="padding-left: 10px" width="500" colspan="2">
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