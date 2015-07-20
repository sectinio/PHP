<?php
include 'conexiune_baza_de_date.php';
//mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
//mysql_select_db("$db_name")or die("cannot select DB");

$answer_correct=0;
$result10="";
session_start();

if(!isset($_SESSION['username']) || trim($_SESSION['username'])=='' )
{
	header("location:index.php");
}
else
{
	$username=$_SESSION['username'];
	$usertype=$_SESSION['usertype'];
	
	$id=$_GET["id"];
	
	
	
	$sql="select * from test s, intrebare q, utilizator, student_examen where u_id=se_u_id and se_t_id=s.t_id and
			q.i_test_id=s.t_id and  s.t_id=$id";
			
			$result=mysqli_query($con,$sql) or die(mysql_error());
			//row count
			$row_count=mysqli_num_rows($result);
			//echo $row_count;
			if ($row_count>0)
			{
				$nume=mysqli_result($result,0,"u_nume");
				//echo $nume;
			}
	
	if(isset($_POST['nume']))
	{
	$nume=$_POST['nume'];
	//echo $nume;
	}
	

}
?>





<html>

<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>Aplicatie online pentru testarea cunostintelor</title>
<link href="style/Style1.css" rel="stylesheet" type="text/css" />


</head>

<body>
<form name="form1" method="post" action="arata_rezultate.php?id=<?php echo($id)?>" >
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
			<td align="lef"' valign="top" style="padding-left: 10px; padding-top: 10px" >
			<?php
			//echo $nume, $id;
			$sql="select * from test s, intrebare q, utilizator, student_examen where u_id=se_u_id and se_t_id=s.t_id and
			q.i_test_id=s.t_id and  s.t_id =$id and u_nume='$nume'";
			
			$result=mysqli_query($con,$sql) or die(mysql_error());
			//row count
			$row_count=mysqli_num_rows($result);
			
			if ($row_count>0)
			{
				$i_puncte=mysqli_result($result,0,"i_puncte");
				//echo $i_puncte;
				$sm_name=mysqli_result($result,0,"t_titlu");
				$date1=mysqli_result($result,0,"se_data_creare");
				$date=substr($date1,0,10);
				echo("Rezultat: <b>".$sm_name."</b>   Data ".$date."<br/> &nbsp;</b>");
				$i=0;
				
				echo("<table border='0' width='600' id='table6'>");
					echo("<tr style='border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: solid; border-bottom-width: 1px; padding-bottom: 4px' align='left' >");
					echo("<td >");
					echo("Student");
					echo("</td>");
					echo("	<td >");
					echo("<select size='1' name='nume' >");
					$sql8="select * from  student_examen, utilizator, test where se_u_id=u_id and se_t_id=t_id and t_id=$id" ; 
  										$result8=mysqli_query($con,$sql8) or die(mysql_error());
										$prim_name=mysqli_result($result8,0,"u_nume");
  										$count8=mysqli_num_rows($result8);
											$i=0;
											for($i=0;$i<$count8; $i++)
											{
												$opt=mysqli_result($result8,$i,"u_nume");

											//	echo("<option value=".$i.">$opt</option>");
												if ($nume==$opt)
												{
													echo("<option selected >$opt</option>");
												}
												else
												{
													echo("<option>$opt</option>");
												}

											}
				
					echo("</select>");
					
					
					echo("<input type='submit' name='student'> </input>");
					echo("</td>");
					echo("</tr>");
					echo("</table>");
				
				
				
				
				
				for($i=0;$i<=$row_count-1;$i++)
				{	
					$i_id=mysqli_result($result,$i,"i_id");
					$i_text=mysqli_result($result,$i,"i_text");
					$i_tip=mysqli_result($result,$i,"i_tip");
					$u_id=mysqli_result($result,$i,"u_id");
					
					$sr_no=$i+1;
					
					//get the options
					$txt_op1="";
					$txt_op2="";
					$txt_op3="";
					$txt_op4="";
					
					$txt_p1="";
					$txt_p2="";
					$txt_p3="";
					$txt_p4="";
					
					$gr_width1="0";
					$gr_width2="0";
					$gr_width3="0";
					$gr_width4="0";
					
					//$result10="0";
					
					
					$sql2="select * from varianta_raspuns where vr_i_id=".$i_id." order by vr_id";
					$result2=mysqli_query($con,$sql2) or die(mysql_error());
					//row count
					$row_count2=mysqli_num_rows($result2);
					if ($row_count2>0)
					{
						if($i_tip=='Un singur raspuns corect - text -' || $i_tip=='Mai multe raspunsuri corecte - text -')
						{
							$txt_op1=mysqli_result($result2,0,"vr_text"); 
							$txt_op2=mysqli_result($result2,1,"vr_text"); 
							$txt_op3=mysqli_result($result2,2,"vr_text"); 
							$txt_op4=mysqli_result($result2,3,"vr_text"); 
						}
						if($i_tip=='Un singur raspuns corect - imagine -' || $i_tip=='Mai multe raspunsuri corecte - imagine -')
						{
							$txt_op1=mysqli_result($result2,0,"vr_locatie_imagine"); 
							$txt_op2=mysqli_result($result2,1,"vr_locatie_imagine"); 
							$txt_op3=mysqli_result($result2,2,"vr_locatie_imagine"); 
							$txt_op4=mysqli_result($result2,3,"vr_locatie_imagine"); 
							
							$txt_op1="<img src=Examen_images\\".$txt_op1.">";
							$txt_op2="<img src=Examen_images\\".$txt_op2.">";
							$txt_op3="<img src=Examen_images\\".$txt_op3.">";
							$txt_op4="<img src=Examen_images\\".$txt_op4.">";
							
						}
						
						//calculate results and percentage
						//$sql3="SELECT * FROM student_examen_intrebare sued, varianta_raspuns qo where sued.sei_i_id=qo.vr_i_id and sei_i_id=".$i_id." order by sei_id ";
						$sql3="select * from student_examen_intrebare, student_examen where sei_se_id=se_id and
						sei_i_id=$i_id and se_u_id=$u_id order by sei_id ";
						$sql4="select * from varianta_raspuns go where go.vr_i_id=".$i_id." order by vr_id ";
						$result3=mysqli_query($con,$sql3) or die(mysql_error());
						$result4=mysqli_query($con,$sql4) or die(mysql_error());
						//row count
						$row_count3=mysqli_num_rows($result3);
						$row_count4=mysqli_num_rows($result4);
						
						if (($row_count4>0)&&($row_count3>0))
						{
						$j=1;
						$correct=array();
						for($j=0;$j<=$row_count4-1;$j++)
							{
								if (mysqli_result($result4,$j,"vr_corect")==1)
								{
									$correct[$j]="100%";
								} 
								else 
								{$correct[$j]="0%";}
							}
							
							$gr_width1=$correct[0];//$gr_width1=round($op_count1/$tot_count*100);
							$gr_width2=$correct[1];//$gr_width2=round($op_count2/$tot_count*100);
							$gr_width3=$correct[2];//$gr_width3=round($op_count3/$tot_count*100);
							$gr_width4=$correct[3];
						
						
					
						
							
							
							$selected=array();
							for($j=0;$j<=$row_count3-1;$j++)
							{
								if (mysqli_result($result3,$j,"sei_vr_selectat")==1)
								{
									$selected[$j]="X";
								} 
								else 
								{$selected[$j]=" ";}
								
							}	
							
							
							
							
							
							for($j=0;$j<=$row_count3-1;$j++)
							{
							if(($correct[$j]=="100%")&&($selected[$j]=="X"))
							{
							$answer_correct++;
							}
							}
							$result10=$answer_correct;
						

							//$txt_p1=round($op_count1/$tot_count*100);$txt_p1=$txt_p1."%";
							$txt_p1=$selected[0];
							//echo $txt_p1;
							$txt_p2=$selected[1];//$txt_p2=round($op_count2/$tot_count*100);$txt_p2=$txt_p2."%";
							$txt_p3=$selected[2];//$txt_p3=round($op_count3/$tot_count*100);$txt_p3=$txt_p3."%";
							$txt_p4=$selected[3];//$txt_p4=round($op_count4/$tot_count*100);$txt_p4=$txt_p4."%";
							
							//$gr_width1=round($op_count1/$tot_count*100);
							//$gr_width2=round($op_count2/$tot_count*100);
							//$gr_width3=round($op_count3/$tot_count*100);
							//$gr_width4=round($op_count4/$tot_count*100);
							
							
						}
						
						
					}
					
					
					
					echo("<table border='0' width='600' id='table2'>");
					echo("<tr>");
					echo("	<td colspan='4' style='border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-style: solid; border-bottom-width: 1px; padding-bottom: 4px' align='left' valign='top'>");
					echo("	<b>Intrebarea ".$sr_no."</b> : <pre style='border:2px solid #b2b2b2; border-radius:5px; padding:5px;'>  ".$i_text." </pre><br/></td>");
					echo("</tr>");
					
					echo("<tr>");
					echo("	<td align='left' valign='top' width='83' style='padding-left: 6px'>");
					echo("	A</td>");
					echo("	<td align='left' valign='top' width='312'>".$txt_op1."</td>");					
					echo("	<td align='center' valign='top' width='93'>".$txt_p1."</td>");
					echo("	<td align='left' valign='top' width='100'>");
					echo("	<table border='0' width='100' cellspacing='0' cellpadding='0' bgcolor='#C0C0C0' id='table3' height='15'>");
					echo("		<tr>");
					echo("				<td>");
					echo("				<table border='0' width='".$gr_width1."' cellspacing='0' cellpadding='0' bgcolor='#00FF00' height='15' id='table4'>");
					echo("					<tr>");
					echo("						<td></td>");
					echo("					</tr>");
					echo("				</table>");
					echo("				</td>");
					echo("			</tr>");
					echo("		</table>");
					echo("		</td>");
					echo("	</tr>");
					echo("	<tr>");
					echo("		<td align='left' valign='top' width='83' style='padding-left: 6px'>B</td>");
					echo("		<td align='left' valign='top' width='312'>".$txt_op2."</td>");
					echo("		<td align='center' valign='top' width='93'>".$txt_p2."</td>");
					echo("	<td align='left' valign='top' width='100'>");
					echo("	<table border='0' width='100' cellspacing='0' cellpadding='0' bgcolor='#C0C0C0' id='table3' height='15'>");
					echo("		<tr>");
					echo("				<td>");
					echo("				<table border='0' width='".$gr_width2."' cellspacing='0' cellpadding='0' bgcolor='#00FF00' height='15' id='table4'>");
					echo("					<tr>");
					echo("						<td></td>");
					echo("					</tr>");
					echo("				</table>");
					echo("				</td>");
					echo("			</tr>");
					echo("		</table>");
					echo("		</td>");
					echo("	</tr>");
					echo("	<tr>");
					echo("		<td align='left' valign='top' width='83' style='padding-left: 6px'>C </td>");
					echo("		<td align='left' valign='top' width='312'>".$txt_op3."</td>"); 
					echo("	  <td align='center' valign='top' width='93'>".$txt_p3."</td>");
					echo("	<td align='left' valign='top' width='100'>");
					echo("	<table border='0' width='100' cellspacing='0' cellpadding='0' bgcolor='#C0C0C0' id='table3' height='15'>");
					echo("		<tr>");
					echo("				<td>");
					echo("				<table border='0' width='".$gr_width3."' cellspacing='0' cellpadding='0' bgcolor='#00FF00' height='15' id='table4'>");
					echo("					<tr>");
					echo("						<td></td>");
					echo("					</tr>");
					echo("				</table>");
					echo("				</td>");
					echo("			</tr>");
					echo("		</table>");
					echo("		</td>");
					echo("	 </tr>");
					echo("	 <tr>");
					echo("	 	<td align='left' valign='top' width='83' style='padding-left: 6px'>D </td>");
					echo("	 	<td align='left' valign='top' width='312'>".$txt_op4."</td>");
					echo("	 	<td align='center' valign='top' width='93'>".$txt_p4."</td>");
					echo("	<td align='left' valign='top' width='100'>");
					echo("	<table border='0' width='100' cellspacing='0' cellpadding='0' bgcolor='#C0C0C0' id='table3' height='15'>");
					echo("		<tr>");
					echo("				<td>");
					echo("				<table border='0' width='".$gr_width4."' cellspacing='0' cellpadding='0' bgcolor='#00FF00' height='15' id='table4'>");
					echo("					<tr>");
					echo("						<td></td>");
					echo("					</tr>");
					echo("				</table>");
					echo("				</td>");
					echo("			</tr>");
					echo("		</table>");
					echo("		</td>");
					echo("	 </tr>");
					echo("	 </table>");
					echo("	<br>");
					
				}
				
			}
			else
			{
				echo("Nu am gasit rezultate.");
				
			}
			$color="";
			
			
			
			
			if($result10/$row_count<=0.5)
			{$color="red";}
			else
			{$color="green";}
			
			
			echo("Raspunsuri corecte: <span style='color:".$color."'>".$result10."</span>/".$row_count);
			?>
			
			
			
			
			<br>
			
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