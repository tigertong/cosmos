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
$contentdate = $_GET["date"];	
require_once("./db.conf.php");
echo $_GET['submit'].$_GET['startdate'].$_GET["stopdate"];
if (isset($_GET["submit"]) && isset($_GET["startdate"]) && isset($_GET["stopdate"])) {
$startdate = $_GET["startdate"];
$stopdate = $_GET["stopdate"];


$result = mysqli_query($db,"SELECT *  FROM statinfo where date>='$startdate'  and  date<='$stopdate' order by date asc");

$categories = "";
$IP_COUNT_str = "";
$REFFER_COUNT_str="";
$ROWQUERY_COUNT_str="";
$UA_COUNT_str="";
while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
 {
 /*
 IP_COUNT INT(10),
REFFER_COUNT INT(10),
ROWQUERY_COUNT INT(10),
UA_COUNT INT(10) 
 */
 
$categories .= "'".$row['date']."',";
 $IP_COUNT_str .= $row['IP_COUNT'].",";
  $REFFER_COUNT_str .= $row['REFFER_COUNT'].",";
   $ROWQUERY_COUNT_str .= $row['ROWQUERY_COUNT'].",";
    $UA_COUNT_str .= $row['UA_COUNT'].",";
 }

$categories = substr($categories ,0, strlen($categories)-1);
$IP_COUNT_str = substr($IP_COUNT_str ,0, strlen($IP_COUNT_str)-1);
$REFFER_COUNT_str = substr($REFFER_COUNT_str ,0, strlen($REFFER_COUNT_str)-1);
$ROWQUERY_COUNT_str = substr($ROWQUERY_COUNT_str ,0, strlen($ROWQUERY_COUNT_str)-1);
$UA_COUNT_str = substr($UA_COUNT_str ,0, strlen($UA_COUNT_str)-1);
	//mysqli_close($db);

}
	
	?>		
		
		
		<script type="text/javascript">


$(function () {
    $('#container').highcharts({
        chart: {
            type: 'line'
        },
        title: {
            text: 'traffic trend'
        },
        subtitle: {
            text: 'IP_COUNT   ROWQUERY_COUNT  UA_COUNT'
        },
        xAxis: {
            categories: [<?php echo $categories;?>]//['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
        },
        yAxis: {
            title: {
                text: 'request'
            }
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
            name: 'IP_COUNT',
            data: [<?php echo $IP_COUNT_str;?>] //[7.0, 6.9, 9.5, 14.5, 18.4, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
        },{
            name: 'ROWQUERY_COUNT',
            data: [<?php echo $ROWQUERY_COUNT_str;?>] //[7.0, 6.9, 9.5, 14.5, 18.4, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
        },{
            name: 'UA_COUNT',
            data: [<?php echo $UA_COUNT_str;?>] //[7.0, 6.9, 9.5, 14.5, 18.4, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
        }
		
		]
    });
});
$(function () {
    $('#container1').highcharts({
        chart: {
            type: 'line'
        },
        title: {
            text: 'traffic trend'
        },
        subtitle: {
            text: '   REFFER_COUNT   '
        },
        xAxis: {
            categories: [<?php echo $categories;?>]//['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
        },
        yAxis: {
            title: {
                text: 'request'
            }
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
            name: 'REFFER_COUNT',
            data: [<?php echo $REFFER_COUNT_str;?>] //[7.0, 6.9, 9.5, 14.5, 18.4, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
        }
		
		]
    });
});

		</script>
<script src="http://cdn.hcharts.cn/highcharts/highcharts.js"></script>
<script src="http://cdn.hcharts.cn/highcharts/modules/exporting.js"></script>

</head>

<body>
<div id="demo">
  <div id="demo_content">
    <div class="page-header">
      <h1>sougou traffic trend</h1>
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
    </p><p>
	<form   action='IPList.php' method='get'>
	startdate:<input type="text" id="startdate" name="startdate" size="20" value="2016-08-22"><br> 
	stopdate:<input type="text" id="stopdate" name="stopdate" size="20" value="2016-08-24"><br><input name="submit" value="submit" id="submit"  type="submit" />
	</form>
	</p>
    <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
	<div id="container1" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

  </div>
  <div class="clear"></div>
</div>
<p>&nbsp;</p>
</body>
</html>
