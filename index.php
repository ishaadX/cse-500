<?php
include 'db_connect.php'; 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Web Event Calender</title>
<script>
function goLastMonth(month, year){
// If the month is January, decrement the year
if(month == 1){
--year;
month = 13;
}
document.location.href = '<?=$_SERVER['PHP_SELF'];?>?month='+(month-1)+'&year='+year;
}
//next function
function goNextMonth(month, year){
// If the month is December, increment the year
if(month == 12){
++year;
month = 0;
}
document.location.href = '<?=$_SERVER['PHP_SELF'];?>?month='+(month+1)+'&year='+year;
} 

function remChars(txtControl, txtCount, intMaxLength)
{
if(txtControl.value.length > intMaxLength)
txtControl.value = txtControl.value.substring(0, (intMaxLength-1));
else
txtCount.value = intMaxLength - txtControl.value.length;
}

function checkFilled() {
var filled = 0
var x = document.form1.calName.value;
//x = x.replace(/^\s+/,""); // strip leading spaces
if (x.length > 0) {filled ++}

var y = document.form1.calDesc.value;
//y = y.replace(/^s+/,""); // strip leading spaces
if (y.length > 0) {filled ++}

if (filled == 2) {
document.getElementById("Submit").disabled = false;
}
else {document.getElementById("Submit").disabled = true} // in case a field is filled then erased

}

</script>
<style>
body{
font-family:Georgia, "Times New Roman", Times, serif;
font-size:20px;
background-color: white;
}
.today{
background-color:white;
font-weight:bold;
/*background-image:url(calBg.jpg);*/
background-repeat:no-repeat;
background-position:center;
position:relative;
}
.today span{
position:absolute;
left:0;
top:0; 
}

.today a{
color:#000000;
padding-top:20px;
}
.selected {
color: green;
background-color:red;
}
.event {
background-color: blue;
border:5px solid #ffffff;
} 
.normal {

} 
table{
border:10px transparent #cccccc;
background-color:gray;
padding:8px;
}
th{
width:100px;
background-color:white;
text-align:center;
color:purple;
border-left:10px solid #ffffff;
}
td{
text-align:center;
padding:10px;
margin:10px auto;
}
table.tableClass{
width:350px;
border:none;
border-collapse: collapse;
font-size:100%;
border:10px dotted black;
}
table.tableClass input,textarea{
font-size:90%;
}
#form1{
margin:20px 5px 5px 5px auto;
}
#greyBox{
height:100px;
width:100px;
background-color:#C6D1DC;
border:10px solid #666666;
margin:50px;
}
#legend{
margin:5 0 10px 50px;
width:200px;
}
#hr{border-bottom:1px solid #cccccc;width:300px;}
.output{width:300px;border-bottom:1px dotted #ccc;margin-bottom:5px;padding:6px;}
h5{margin:0;}
</style>
</head>

<?php
  //include_once "webCal_sign_up.php";
?>
<h4>click here to <a href="webCal_sign_up.php"><strong>sign-up</strong></a></h4>

<body>
<div id="legend"> 
<img src="sq.jpg" /> Scheduled Events<br/><img src="calBg.jpg" height="10"/> Todays Date</div>
<?php
//$todaysDate = date("n/j/Y");
//echo $todaysDate;
// Get values from query string
$day = (isset($_GET["day"])) ? $_GET['day'] : "";
$month = (isset($_GET["month"])) ? $_GET['month'] : "";
$year = (isset($_GET["year"])) ? $_GET['year'] : "";
//comparaters for today's date
//$todaysDate = date("n/j/Y");
//$sel = (isset($_GET["sel"])) ? $_GET['sel'] : "";
//$what = (isset($_GET["what"])) ? $_GET['what'] : "";

//$day = (!isset($day)) ? $day = date("j") : $day = "";
if(empty($day)){ $day = date("j"); }

if(empty($month)){ $month = date("n"); }

if(empty($year)){ $year = date("Y"); } 
//set up vars for calendar etc
$currentTimeStamp = strtotime("$year-$month-$day");
$monthName = date("F", $currentTimeStamp);
$numDays = date("t", $currentTimeStamp);
$counter = 0;
//$numEventsThisMonth = 0;
//$hasEvent = false;
//$todaysEvents = ""; 
//run a selec statement to hi-light the days
function hiLightEvt($eMonth,$eDay,$eYear){
//$tDayName = date("l");
$todaysDate = date("n/j/Y");
$dateToCompare = $eMonth . '/' . $eDay . '/' . $eYear;
if($todaysDate == $dateToCompare){
//$aClass = '<span>' . $tDayName . '</span>';
$aClass='class="today"';
}else{
//$dateToCompare = $eMonth . '/' . $eDay . '/' . $eYear;
//echo $todaysDate;
//return;
$sql="select count(calDate) as eCount from calTbl where calDate = '" . $eMonth . '/' . $eDay . '/' . $eYear . "'";
//echo $sql;
//return;
$result = mysql_query($sql);
while($row= mysql_fetch_array($result)){
if($row['eCount'] >=1){
$aClass = 'class="event"';
}elseif($row['eCount'] ==0){
$aClass ='class="normal"';
}
}
}
return $aClass;
}
?>
<table width="500" cellpadding="0" cellspacing="0">
<tr>
<td width="150" colspan="1">
<input type="button" value=" < " onClick="goLastMonth(<?php echo $month . ", " . $year; ?>);">
</td>
<td width="250" colspan="25">
<span class="title"><?php echo $monthName . " " . $year; ?></span><br>
</td>
<td width="100" colspan="1" align="right">
<input type="button" value=" > " onClick="goNextMonth(<?php echo $month . ", " . $year; ?>);">
</td>
</tr> 
<tr>
<th> Sunday </td>
<th> Monday </td>
<th> Tuesday </td>
<th> Wedensday </td>
<th> Thursday </td>
<th> Friday </td>
<th> Saturday </td>
</tr>
<tr>
<?php
for($i = 1; $i < $numDays+1; $i++, $counter++){
$dateToCompare = $month . '/' . $i . '/' . $year;
$timeStamp = strtotime("$year-$month-$i");
//echo $timeStamp . '<br/>';
if($i == 1){
// Workout when the first day of the month is
$firstDay = date("w", $timeStamp);
for($j = 0; $j < $firstDay; $j++, $counter++){
echo "<td>&nbsp;</td>";
} 
}
if($counter % 7 == 0){
?>
</tr><tr>
<?php
}
?>
<!--right here--><td width="100" <?=hiLightEvt($month,$i,$year);?>><a href="<?=$_SERVER['PHP_SELF'] . '?month='. $month . '&day=' . $i . '&year=' . $year;?>&v=1"><?=$i;?></a></td> 
<?php
}
?>
</table>
<?php
if(isset($_GET['v'])){
if(isset($_POST['Submit'])){
$sql="insert into calTbl(calName,calDesc,calDate,calStamp) values('" . $_POST['calName'] ."','" . $_POST['calDesc'] . "','" . $_POST['calDate'] . "',now())";
mysql_query($sql);
}
$sql="select calName,calDesc, DATE_FORMAT(calStamp, '%a %b %e %Y') as calStamp from calTbl where calDate = '" . $month . '/' . $day . '/' . $year . "'";
//echo $sql;
//return;
$result = mysql_query($sql);
$numRows = mysql_num_rows($result);
?>
<a href="<?=$_SERVER['PHP_SELF'];?>?month=<?=$_GET['month'] . '&day=' . $_GET['day'] . '&year=' . $_GET['year'];?>&v=1&f=true">New Event</a><br/>
<?php
if(isset($_GET['f'])){
include 'webCal.php';
}
if($numRows == 0 ){
echo '<h3>No Events</h3>';
}else{
//echo '<ul>';
echo '<h3>Events Listed</h3>';
while($row = mysql_fetch_array($result)){
?>
<div class="output">
<h5><?=$row['calName'];?></h5>
<?=$row['calDesc'];?><br/>
Listed On: <?=$row['calStamp'];?>
</div>
<?php
}
}
}
?>
</body>
</body>
</html>
