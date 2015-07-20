<?php
include 'conexiune_baza_de_date.php';


//mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
//mysql_select_db("$db_name")or die("cannot select DB");
$sc_id=''; 
$sc_name='';
$sc_description='';
$sc_active='';
$op_mode='';

//question
$qm_id='';
$qm_text='';
$qm_active='';
$sm_active='';
//answer
$row_count=0;


$Chk1='0';
$Chk2='0';
$Chk3='0';
$Chk4='0';


$Rd1='';
$Rd2='';
$Rd3='';
$Rd4='';

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
	//session_start();
	$currind=0;
	$currind=$_SESSION['currind'];
	$inainte_id=$currind;//$_GET["inainte_id"]; 
	$id=$_GET["id"]; 
	
	
	$sql="SELECT  q.*,s.* FROM intrebare q, test s where q.i_test_id=s.t_id and s.t_id=".$id."";
		$result=mysqli_query($con,$sql) or die(mysql_error());
	$_SESSION['time']= mysqli_result($result,0,"t_timp");
	
//echo $_SESSION['time'];
	if(isset($_POST['Btninainte']))//if($_POST['Btninainte']=='  inainte >  ')
	{
		$row_count=0;
		$inainte_id=0;
		$currind=0;
		$currind=$_SESSION['currind'];
		$inainte_id=$currind;
		

	
	
		$inainte_id=$inainte_id+1;
		$_SESSION['currind']=$inainte_id;
		
		
		$sql="SELECT  q.*,s.* FROM intrebare q, test s 
		where q.i_test_id=s.t_id and s.t_id=".$id."";
		
    //echo($id);
    $result=mysqli_query($con,$sql) or die(mysql_error());
	
	
		//row count
		$row_count=mysqli_num_rows($result);
		//echo($row_count-1);
		//echo('bla');
		
		//-----------------
			//update Examen details
			$qm_id=mysqli_result($result,$inainte_id-1,"i_id");
			$qm_type=mysqli_result($result,$inainte_id-1,"i_tip");
			$sql="SELECT * FROM student_examen  
			where se_u_id=".$uid." and se_t_id=".$id."";
						
			$result1=mysqli_query($con,$sql) or die(mysql_error());
			$row_count1=mysqli_num_rows($result1);
			//echo $row_count1;
			
		
			if ($row_count1<=0)
			{ 				 
				$sql="SELECT IFNULL(max(se_id)+1,1) m FROM student_examen  ";
				$result2=mysqli_query($con,$sql) or die(mysql_error());				
				$last_id=mysqli_result($result2,0,"m");	
//echo $last_id;
echo $uid;
echo $id;				
				//insert user Examen
				$sql="insert into student_examen values ($last_id,$uid,$id,sysdate(),null)";
				//echo($sql);				
				$result1=mysqli_query($con,$sql) or die(mysql_error());							
				//insert user Examen details
				$sql="SELECT IFNULL(max(sei_id)+1,1) m FROM student_examen_intrebare  ";
				$result1=mysqli_query($con,$sql) or die(mysql_error());
				$last_detail_id=mysqli_result($result1,0,"m");								
				//get the options				
				//echo($_POST['Rd1']."   ".$_POST['Chk1'].' -- '.$_POST['Rd2']."   ".$_POST['Chk2']);
				$i=0;
				for($i=1;$i<=4;$i++)
				{					
					$checkbox="Chk".$i;
					$radiobutton="Rd".$i;
					 
					//if ( $_POST[$radiobutton]!='' || $_POST[$checkbox]!='' )
					//if ( $_POST['Rd1']==$i || isset($_POST[$checkbox]=='1' ))
					if ( $_POST['Rd1']==$i || isset($_POST[$checkbox]))
					{
						$chk_dis=1;
					}
					else
					{
						$chk_dis=0;
					}
					
					 $sql="insert into  student_examen_intrebare values ($last_detail_id,$last_id,$qm_id,$chk_dis,null)";//echo($sql);
					$result1=mysqli_query($con,$sql) or die(mysql_error());	
					//s.`sei_id`, s.`sei_se_id`, s.`usd_vr_id`, s.`sei_vr_selectat`, s.`usd_text` 
					$last_detail_id=$last_detail_id+1;					
				}													
			}
			else
			{				
				$userExamenid=mysqli_result($result1,0,"se_id");								
				$sql="delete FROM student_examen_intrebare  
				where sei_se_id=".$userExamenid." and sei_i_id=".$qm_id;				
				//echo($sql);
				$result1=mysqli_query($con,$sql) or die(mysql_error());
				//$row_count=mysql_num_rows($result1);								
				//insert details								
				$sql="SELECT IFNULL(max(sei_id)+1,1) m FROM student_examen_intrebare  ";
				$result1=mysqli_query($con,$sql) or die(mysql_error());
				$last_detail_id=mysqli_result($result1,0,"m");								
				//get the options		
				//echo($_POST['Rd1']."   ".$_POST['Chk1'].' -- '.$_POST['Rd2']."   ".$_POST['Chk2']);		
				$i=0;
				for($i=1;$i<=4;$i++)
				{					
					$checkbox="Chk".$i;
					$radiobutton="Rd".$i;
					//check the question type and save					
					//if ( $_POST[$radiobutton]='ON' || $_POST[$checkbox]!='' )
					//if ( $_POST['Rd1']==$i || $_POST[$checkbox]=='1' )
					if ( $_POST['Rd1']==$i || isset($_POST[$checkbox]))
					{
						$chk_dis=1;
					}
					else
					{
						$chk_dis=0;
					}
					 $sql="insert into  student_examen_intrebare values ($last_detail_id,$userExamenid,$qm_id,$chk_dis,null)";//echo($sql);
					$result1=mysqli_query($con,$sql) or die(mysql_error());	
					//s.`sei_id`, s.`sei_se_id`, s.`sei_vr_id`, s.`sei_vr_selectat`, s.`sei_text` 
					$last_detail_id=$last_detail_id+1;					
				}				 
			} 						
			//----------------
		
		//echo $_SESSION['time'];
		
		if($inainte_id> $row_count-1)
		{

			header("location:test_finalizat.php?id=1"); 
			 
		}
		


		
		
	}
	
	if(isset($_POST['Btninapoi']))//if($_POST['Btninapoi']=='< inapoi')
	{
		
		$currind=0;
		$currind=$_SESSION['currind'];
		$inainte_id=$currind;
		if ($inainte_id>0)
		{
		
			$inainte_id=$inainte_id-1;
			$_SESSION['currind']=$inainte_id;
			
		}

	}
	

?>

<?php 
		$id=$_GET["id"];
		//session_start();
		$currind=0;
		$currind=$_SESSION['currind'];
		$inainte_id=$currind;
		// echo $id;
		
		//$sql="SELECT q.*, o.*, s.* FROM intrebare q, s_varianta_raspuns o, test s 
		//where q.q_sm_id=s.sm_id and o.vr_i_id=q.i_id and s.t_id=".$id."";
    $sql="SELECT  q.*,s.* FROM intrebare q, test s 
		where q.i_test_id=s.t_id and s.t_id=".$id."";
    //echo($id);
    $result=mysqli_query($con,$sql) or die(mysql_error());
		//row count
		
		$row_count=mysqli_num_rows($result);
		//echo $row_count;
		
   // $qm_id=mysqli_num_rows($result);
    $qm_id=mysqli_result($result,$inainte_id,"i_id");
    $qm_text=mysqli_result($result,$inainte_id,"i_text");
    $qm_type=mysqli_result($result,$inainte_id,"i_tip");
    $sm_name=mysqli_result($result,$inainte_id,"t_titlu");
 // echo($qm_type);
    
    $sql="SELECT  * FROM varianta_raspuns  
		where vr_i_id=".$qm_id."";
		$result=mysqli_query($con,$sql) or die(mysql_error());
		
		$op_text1=mysqli_result($result,0,"vr_text");
  	$op_text2=mysqli_result($result,1,"vr_text");
  	$op_text3=mysqli_result($result,2,"vr_text");
  	$op_text4=mysqli_result($result,3,"vr_text");
	
	
	//echo $op_text1;
  	
  	$op_image1=mysqli_result($result,0,"vr_locatie_imagine");
  	$op_image2=mysqli_result($result,1,"vr_locatie_imagine");
  	$op_image3=mysqli_result($result,2,"vr_locatie_imagine");
  	$op_image4=mysqli_result($result,3,"vr_locatie_imagine");
  	
  	$link1="<img src='\\images\\".$op_image1."'>";
  	$link2="<img src='\\images\\".$op_image2."'>";
  	$link3="<img src='\\images\\".$op_image3."'>";
  	$link4="<img src='\\images\\".$op_image4."'>";
		
		$is_checked1="";
		$is_checked2="";
		$is_checked3="";
		$is_checked4="";
		//echo $uid, $qm_id;
		$sql2=" select us.*,usd.* from student_examen us, student_examen_intrebare usd
					where usd.sei_se_id=us.se_id and se_u_id=".$uid." and sei_i_id=".$qm_id ;
		$result2=mysqli_query($con,$sql2) or die(mysql_error());
		$row_count2=mysqli_num_rows($result2);
		$blabla1=mysqli_result($result2,0,"sei_vr_selectat");
		//echo $blabla1;
		if ($row_count2>0)
		{
			if (mysqli_result($result2,0,"sei_vr_selectat")==1)
			{
				$is_checked1="checked";
			}
			if (mysqli_result($result2,1,"sei_vr_selectat")==1)
			{
				$is_checked2="checked";
			}
			if (mysqli_result($result2,2,"sei_vr_selectat")==1)
			{
				$is_checked3="checked";
			}
			if (mysqli_result($result2,3,"sei_vr_selectat")==1)
			{
				$is_checked4="checked";
			}
			
		}
		//echo $row_count2;
		
		if ($qm_type=='Un singur raspuns corect - text -')
		{
	    	$text_display=" ";
	    	$file_display="style='display:none'";
	    	$chk_display="style='display:none'";
	    	$rd_display=" ";
			
				$link1=" ";
		  	$link2=" ";
		  	$link3=" ";
		  	$link4=" ";
		}
		
		if ($qm_type=='Un singur raspuns corect - imagine -')
		{
				$text_display="style='display:none'";
	    	$file_display=" ";
	    	$chk_display=" ";
	    	$rd_display="style='display:none'";
	    	
				$op_text1="";
				$op_text2="";
				$op_text3="";
				$op_text4="";
			
		}
		if ($qm_type=='Mai multe raspunsuri corecte - text -')
		{
				$text_display=" ";
	    	$file_display="style='display:none'";
	    	$chk_display="style='display:none'";
	    	$rd_display=" ";
			
				$link1=" ";
		  	$link2=" ";
		  	$link3=" ";
		  	$link4=" ";
			
		}
		if ($qm_type=='Mai multe raspunsuri corecte - imagine -')
		{
				$text_display="style='display:none'";
	    	$file_display=" ";
	    	$chk_display="style='display:none'";
	    	$rd_display=" ";
	    	
				$op_text1="";
				$op_text2="";
				$op_text3="";
				$op_text4="";
			
		}
 
$ttitlu= mysqli_result($result2,0,"i_text");
echo $ttitlu;

?>



<html>
<head>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/
libs/jquery/1.3.0/jquery.min.js"></script>

<script type="text/javascript">
var auto_refresh = setInterval(
function ()
{
$('#cd').load('timp.php').fadeIn("slow");
}, 1000); // refresh every second
</script>


<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>Aplicatie online pentru testarea cunostintelor</title>
<link href="style/style1.css" rel="stylesheet" type="text/css" />





</head>

<body>

<form name="form1"  method="post" action="test_main.php?id=<?php echo($id)?>&inainte_id=<?php echo($inainte_id)?>" >
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
			
			
			<div id='cd'>




			</div>
<table border="0" width="497" id="table9">
					<tr>
						<td width="491">
						<table border="0" width="100%" id="table10" style="border: 1px solid #00CC99">
							<tr>
								<td>
								<table border="0" width="483" id="table11" cellpadding="2">

									<tr>
										<td align="left" valign="bottom" style="padding-left: 10px" width="467" class="td_tablecap1" >
										<b>Examen</b> :  <?php  echo($sm_name) ?>
										</td>
									</tr>
									<tr>
										<td align="left" valign="bottom" style="padding-left: 10px" width="467">
										<b>Intrebarea nr.</b> : <?php echo($qm_id);?>
                                            </td>
									</tr>
									<tr>
										<td align="left" valign="bottom" style="padding-left: 10px" width="467">
                                            <b>Intrebare</b> : <?php echo($qm_text); ?></td>
									</tr>
									<tr>
										<td align="left" valign="bottom" style="padding-left: 10px" width="467">
										&nbsp;
										</td>
									</tr>
									<tr>
										<td align="left" valign="bottom" style="padding-left: 10px" width="467">
										<u><b>Variante de raspuns</b></u></td>
									</tr>
									<tr>
										<td align="left" valign="bottom" style="padding-left: 10px" width="467">
										<table border="0" width="100%" id="table12">
											<tr>
												<td width="4" align="left" valign="top">
                                            <b>A.</b></td>
												<td width="4" align="left" valign="top">
                                            <input type="checkbox" name="Chk1" value="1"  <?php echo($chk_display); echo(" "); echo($is_checked1);?> ><input type="radio" value="1" name="Rd1"  <?php echo($rd_display); echo(" "); echo($is_checked1);?> ></td>
												<td align="left" valign="top"> <?php echo($op_text1); ?> <div id="div1"><?php echo($link1); ?></div></td>
											</tr>
											<tr>
												<td width="4" align="left" valign="top">
                                            <b>B.</b></td>
												<td width="4" align="left" valign="top">
                                            <input type="checkbox" name="Chk2" value="1" <?php echo($chk_display); echo(" "); echo($is_checked2); ?> ><input type="radio" value="2" name="Rd1"  <?php echo($rd_display); echo(" "); echo($is_checked2); ?> ></td>
												<td align="left" valign="top"> <?php echo($op_text2);?><div id="div2"><?php echo($link2); ?></div> </td>
											</tr>
											<tr>
												<td width="4" align="left" valign="top">
                                            <b>C.</b></td>
												<td width="4" align="left" valign="top">
                                            <input type="checkbox" name="Chk3" value="1" <?php echo($chk_display); echo(" "); echo($is_checked3); ?> ><input type="radio" value="3" name="Rd1"  <?php echo($rd_display); echo(" "); echo($is_checked3); ?> ></td>
												<td align="left" valign="top"><?php echo($op_text3);?><div id="div3"><?php echo($link3); ?>
												</td>
											</tr>
											<tr>
												<td width="4" align="left" valign="top">
                                            <b>D.</b></td>
												<td width="4" align="left" valign="top">
                                            <input type="checkbox" name="Chk4" value="1" <?php echo($chk_display); echo(" "); echo($is_checked4); ?> ><input type="radio" value="4" name="Rd1"  <?php echo($rd_display); echo(" "); echo($is_checked4); ?> ></td>
												<td align="left" valign="top"> <?php echo($op_text4);?><div id="div4"><?php echo($link4); ?></div>
												 </td>
											</tr>
										</table>
										</td>
									</tr>
									<tr>
										<td align="left" style="padding-left: 10px" width="467">
                                            &nbsp;</td>
									</tr>
									<tr>
										<td align="left" style="padding-left: 10px" width="467">
                                            <input type="submit" value="< inapoi" name="Btninapoi" class="ButtonStyle">&nbsp; &nbsp; <?php echo(($inainte_id+1)."/".$row_count) ?> &nbsp; &nbsp; 
                                            <input type="submit" value="  inainte >  " name="Btninainte" class="ButtonStyle">&nbsp;&nbsp; 
                                            </td>
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