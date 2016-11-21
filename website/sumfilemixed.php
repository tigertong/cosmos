<?php ini_set('date.timezone','Asia/Shanghai'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>stats</title>
	<link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="./css/style.css">
<script src="./css/hm.js"></script><script src="./css/share.js"></script><link rel="stylesheet" href="./css/share_style0_24.css"></head>
		<script type="text/javascript" src="http://cdn.hcharts.cn/jquery/jquery-1.8.3.min.js"></script>
		<style type="text/css">
${demo.css}
		</style>
	<?php

function getCategory($start,$stop){
	$categories_1 = "";
	$i=90;
	$type=0;
	$stop_date = $start;
	while($type==0){
		$categories_1	 .= "'".$stop_date."',";
		if($stop_date == $stop)$type=1;
		$i++;
		if($i==90)$type=1;
		$stop_date = date("Y-m-d", strtotime("$stop_date +1 day"));
		
	}
	$categories_1 = substr($categories_1 ,0, strlen($categories_1)-1);
	return $categories_1;
}



$contentdate = $_GET["date"];	
require_once("./db.conf.php");
echo $_GET['submit'].$_GET['startdate'].$_GET["stopdate"];
$startdate = "2016-08-05";
$stopdate = "2016-09-05";

if (isset($_GET["submit"]) && isset($_GET["startdate"]) && isset($_GET["stopdate"])) {
$startdate = $_GET["startdate"];
$stopdate = $_GET["stopdate"];

$categories_1 =  getCategory($startdate,$stopdate);


$result = mysqli_query($db,"SELECT *  FROM sumfileinfo where date>='$startdate'  and  date<='$stopdate' order by date asc");

$categories="";
$Clicks_filtered="";
$Clicks="";

$Clicks_filtered_arr=array();
$Clicks_arr=array();

while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
 {
$Clicks_filtered  .= "".$row['Clicks_filtered'].",";
$Clicks  .= "".$row['Clicks'].",";
$categories	 .= "'".$row['date']."',";

if($Clicks_filtered=="")$Clicks_filtered=0;
if($Clicks=="")$Clicks=0;

$Clicks_filtered_arr[] = $row['Clicks_filtered']; 
$Clicks_arr[] = $row['Clicks']; 

}

$Clicks_filtered = substr($Clicks_filtered ,0, strlen($Clicks_filtered)-1);
$Clicks = substr($Clicks ,0, strlen($Clicks)-1);
$categories = substr($categories ,0, strlen($categories)-1);

$result1 = mysqli_query($db,"SELECT *  FROM Sogou_data where date>='$startdate'  and  date<='$stopdate' order by date asc");



$ECPM = "";
$Revenue = "";
$Clicks_Raw="";
$Clicks_Anti_fraud="";
$ECPM_arr=array();
$Revenue_arr=array();
$Clicks_Raw_arr=array();
$Clicks_Anti_fraud_arr=array();

while($row = mysqli_fetch_array($result1,MYSQLI_ASSOC))
 {
 /*
 IP_COUNT INT(10),
REFFER_COUNT INT(10),
ROWQUERY_COUNT INT(10),
UA_COUNT INT(10) 
 */
$ECPM .= "".$row['ECPM'].",";
$Revenue  .= "".$row['Revenue'].",";
$Clicks_Raw  .= "".$row['Clicks_Raw'].",";
$Clicks_Anti_fraud  .= "".$row['Clicks_Anti_fraud'].",";



if($ECPM == NULL )$ECPM=0;
if($Revenue == NULL)$Revenue=0;
if($Clicks_Raw=="")$Clicks_Raw=0;
if($Clicks_Anti_fraud=="")$Clicks_Anti_fraud=0;

$ECPM_arr[] = $row['ECPM']; 
$Revenue_arr[] = $row['Revenue']; 
$Clicks_Raw_arr[] = $row['Clicks_Raw']; 
$Clicks_Anti_fraud_arr[] = $row['Clicks_Anti_fraud']; 

}

$ECPM = substr($ECPM ,0, strlen($ECPM)-1);
$Revenue = substr($Revenue ,0, strlen($Revenue)-1);
$Clicks_Raw = substr($Clicks_Raw ,0, strlen($Clicks_Raw)-1);
$Clicks_Anti_fraud = substr($Clicks_Anti_fraud ,0, strlen($Clicks_Anti_fraud)-1);
if(strlen($categories) < strlen($categories_1)) $categories = $categories_1;

//1
$Clicks_arr_max = $Clicks_arr[array_search(max($Clicks_arr), $Clicks_arr)];
$Clicks_arr_min = $Clicks_arr[array_search(min($Clicks_arr), $Clicks_arr)];
$Clicks="";

foreach($Clicks_arr as $value){ 
    $tmp = round(($value - $Clicks_arr_min)/($Clicks_arr_max - $Clicks_arr_min) * 10000000)/10000000;
    $Clicks  .= "".$tmp.",";   //(x-min(X))/(max(X)-min(X))
} 
$Clicks = substr($Clicks ,0, strlen($Clicks)-1);

//2
$Clicks_filtered_arr_max = $Clicks_filtered_arr[array_search(max($Clicks_filtered_arr), $Clicks_filtered_arr)];
$Clicks_filtered_arr_min = $Clicks_filtered_arr[array_search(min($Clicks_filtered_arr), $Clicks_filtered_arr)];
$Clicks_filtered="";
foreach($Clicks_filtered_arr as $value){ 
    $tmp = round(($value - $Clicks_filtered_arr_min)/($Clicks_filtered_arr_max - $Clicks_filtered_arr_min) * 10000000)/10000000;
    $Clicks_filtered  .= "".$tmp.",";   //(x-min(X))/(max(X)-min(X))
} 
$Clicks_filtered = substr($Clicks_filtered ,0, strlen($Clicks_filtered)-1);

//3
$ECPM_arr_max = $ECPM_arr[array_search(max($ECPM_arr), $ECPM_arr)];
$ECPM_arr_min = $ECPM_arr[array_search(min($ECPM_arr), $ECPM_arr)];
$ECPM="";

foreach($ECPM_arr as $value){ 
    $tmp = round(($value - $ECPM_arr_min)/($ECPM_arr_max - $ECPM_arr_min) * 10000000)/10000000;
    $ECPM  .= "".$tmp.",";   //(x-min(X))/(max(X)-min(X))
} 
$ECPM = substr($ECPM ,0, strlen($ECPM)-1);

//4
$Revenue_arr_max = $Revenue_arr[array_search(max($Revenue_arr), $Revenue_arr)];
$Revenue_arr_min = $Revenue_arr[array_search(min($Revenue_arr), $Revenue_arr)];
$Revenue="";
foreach($Revenue_arr as $value){ 
    $tmp = round(($value - $Revenue_arr_min)/($Revenue_arr_max - $Revenue_arr_min) * 10000000)/10000000;
    $Revenue  .= "".$tmp.",";   //(x-min(X))/(max(X)-min(X))
} 
$Revenue = substr($Revenue ,0, strlen($Revenue)-1);

//5
$Clicks_Raw_arr_max = $Clicks_Raw_arr[array_search(max($Clicks_Raw_arr), $Clicks_Raw_arr)];
$Clicks_Raw_arr_min = $Clicks_Raw_arr[array_search(min($Clicks_Raw_arr), $Clicks_Raw_arr)];
$Clicks_Raw="";

foreach($Clicks_Raw_arr as $value){ 
    $tmp = round(($value - $Clicks_Raw_arr_min)/($Clicks_Raw_arr_max - $Clicks_Raw_arr_min) * 10000000)/10000000;
    $Clicks_Raw  .= "".$tmp.",";   //(x-min(X))/(max(X)-min(X))
} 
$Clicks_Raw = substr($Clicks_Raw ,0, strlen($Clicks_Raw)-1);

//6
$Clicks_Anti_fraud_arr_max = $Clicks_Anti_fraud_arr[array_search(max($Clicks_Anti_fraud_arr), $Clicks_Anti_fraud_arr)];
$Clicks_Anti_fraud_arr_min = $Clicks_Anti_fraud_arr[array_search(min($Clicks_Anti_fraud_arr), $Clicks_Anti_fraud_arr)];
$Clicks_Anti_fraud="";
foreach($Clicks_Anti_fraud_arr as $value){ 
    $tmp = round(($value - $Clicks_Anti_fraud_arr_min)/($Clicks_Anti_fraud_arr_max - $Clicks_Anti_fraud_arr_min) * 10000000)/10000000;
    $Clicks_Anti_fraud  .= "".$tmp.",";   //(x-min(X))/(max(X)-min(X))
} 
$Clicks_Anti_fraud = substr($Clicks_Anti_fraud ,0, strlen($Clicks_Anti_fraud)-1);
//print_r($Clicks_arr);
//echo "Clicks_arr_max=".$Clicks_arr_max ;
//echo "Clicks_arr_min=".$Clicks_arr_min ;
}
	
	?>		
		
		
		<script type="text/javascript">


$(function () {
    $('#container').highcharts({
         chart: {
            type: 'line'
        },
		credits : {      enabled : true,      text : ""  }, 
        title: {
            text: 'Min-Max Normalization'
        },
        subtitle: {
            text: ' Min-Max Normalization '
        },
        xAxis: {
            categories: [<?php echo $categories;?>]//['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
        },
        yAxis: {
            title: {
                text: 'request'
            },
			tickInterval: 0.05
        },
        plotOptions: {
            line: {
                dataLabels: {
                    enabled: false
                },
                enableMouseTracking: false
            }
        },
        series: [{
            name: 'Raw Clicks_SML_Norm',
            data: [<?php echo $Clicks;?>] 
        },{
            name: 'Clicks-filtered_SML_Norm',
            data: [<?php echo $Clicks_filtered;?> ] 
        },{
            name: 'Raw Clicks_Sogou_Norm',
            data: [<?php echo $Clicks_Raw;?>] 
        },{
            name: 'Clicks-filtered_Sogou_Norm',
            data: [<?php echo $Clicks_Anti_fraud;?> ] 
        },{
            name: 'ECPM(RPM)_Norm',
            data: [<?php echo $ECPM;?>] 
        },{
            name: 'Revenue_Norm',
            data: [<?php echo $Revenue;?> ]
        }  
		
		]
    });
});



$(function () {
    $('#container1').highcharts({
         chart: {
            type: 'line'
        },
		credits : {      enabled : true,      text : ""  }, 
        title: {
            text: 'Min-Max Normalization'
        },
        subtitle: {
            text: ' Min-Max Normalization '
        },
        xAxis: {
            categories: [<?php echo $categories;?>]
        },
        yAxis: {
            title: {
                text: 'request'
            },
			tickInterval: 0.05
        },
        plotOptions: {
            line: {
                dataLabels: {
                    enabled: true
                },
                enableMouseTracking: false
            }
        },
        series: [{
            name: 'Raw Clicks_SML_Norm',
            data: [<?php echo $Clicks;?>] 
        },{
            name: 'Clicks-filtered_SML_Norm',
            data: [<?php echo $Clicks_filtered;?> ] 
        } 
		
		]
    });
});
		</script>
<script src="js/highcharts.js"></script>
<script src="js/exporting.js"></script>

</head>

<body>
<div id="demo">
  <div id="demo_content">
    <div class="page-header">
      <h1>sougou traffic SumFile Mixed trend </h1>
      <div class="clear"></div>
    </div>
    <p> 图表主题：
       <a href="IP.php"  > <button class="btn" theme="default">IP distribution</button></a>
      <a href="IPList.php" > <button class="btn" theme="grid">traffic trend</button></a>
      <a href="UAList.php" > <button class="btn" theme="grid">UA distribution</button></a>
      <a href="RFList.php" > <button class="btn" theme="grid">RF distribution</button></a>
      <a href="QUList.php" > <button class="btn" theme="grid">QUERY distribution</button></a>
	  	  <a href="fromCode.php" > <button class="btn" theme="grid">From Code distribution</button></a>
<a href="sumfile.php" > <button class="btn" theme="grid">SumFile distribution</button></a>
<a href="sougou.php" > <button class="btn" theme="grid">sougou distribution</button></a>
    </p>
	<br />
	            
	<table width="600" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="150"><a href="sumfile.php">normal trend</a></td>
        <td width="150"><a href="sumfileRegression.php">Linear Regression</a></td>
        <td width="150"><a href="sumfileweek.php">by Week</a></td>
        <td width="150"><a href="sumfilemonth.php"> by Month</a></td>
		<td width="150"><a href="sumfilemixed.php"> mixed trend</a></td>
      </tr>
    </table>
	
	<p>
	<form   action='sumfilemixed.php' method='get'>
	startdate:<input type="text" id="startdate" name="startdate" size="20" value="<?php echo $startdate ; ?>"><br> 
	stopdate:<input type="text" id="stopdate" name="stopdate" size="20" value="<?php echo $stopdate ; ?>"><br><input name="submit" value="submit" id="submit"  type="submit" />
	</form>
	</p>
    <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
	<div id="container1" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
<br><br>
  </div>

</div>
<p>&nbsp;</p><br><br>
</body>
</html>
