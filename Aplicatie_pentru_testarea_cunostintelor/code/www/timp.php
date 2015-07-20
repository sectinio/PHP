<?php


session_start();
if(isset($_SESSION['time']))
{
$timp=60 * $_SESSION['time']; 

$timestamp_file = 'end_timestamp.txt';
if(!file_exists($timestamp_file))
{
  file_put_contents($timestamp_file, time()+$timp);
}
$end_timestamp = file_get_contents($timestamp_file);
$current_timestamp = time();
$difference = $end_timestamp - $current_timestamp;
$difference_m = (int) (($end_timestamp - $current_timestamp)/60);
$difference_s = ($end_timestamp - $current_timestamp)%60;

if($difference <= 0)
{

  echo 'Timpul s-a scurs';
 echo '<script>window.location="test_finalizat.php"</script>';
  // execute your function here
  // reset timer by writing new timestamp into file
 // file_put_contents($timestamp_file, time()+$timer);
 unlink('end_timestamp.txt');
}
else
{
if ($difference_s < 10)
{
 $difference_s = '0'.$difference_s;
 

}

  echo "Timp ramas ".$difference_m.":".$difference_s;
}
}
?>