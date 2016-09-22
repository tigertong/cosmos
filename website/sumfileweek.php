<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>stats</title>
	<link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="./css/style.css">
<script src="./css/hm.js"></script><script src="./css/share.js"></script><link rel="stylesheet" href="./css/share_style0_24.css">
<style type="text/css">
<!--
.STYLE1 {color: #FF0000}
-->
</style>
</head>
		<script type="text/javascript" src="http://cdn.hcharts.cn/jquery/jquery-1.8.3.min.js"></script>
		<style type="text/css">
${demo.css}
		</style>
	<?php
$contentdate = $_GET["date"];	
require_once("./db.conf.php");
echo $_GET['submit'].$_GET['startdate'].$_GET["stopdate"];
$startdate = "2016-08-05";
$stopdate = "2016-09-05";

if (isset($_GET["submit"]) && isset($_GET["startdate"]) && isset($_GET["stopdate"])) {
$startdate = $_GET["startdate"];
$stopdate = $_GET["stopdate"];


$result = mysqli_query($db,"SELECT *  FROM sumfileinfo A , Sogou_data B where A.date=B.date and A.date>='$startdate'  and  A.date<='$stopdate' order by B.Years , B.Weeks,B.WeekS_NO asc");

$categories="'Mon','Tue','Wed','Thu','Fri','Sat','Sun'";
$DATA_ARR = array();
$Revenue = "";
$num=0;
$weeks=0;
while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
 {
 if($weeks == 0 || $weeks == $row['Weeks']){}else {$num++;}
 $DATA_ARR[$num]['Weeks']=$row['Weeks'];
 $DATA_ARR[$num]['Revenue'][$row['WeekS_NO']]=$row['Revenue'];
 $DATA_ARR[$num]['ECPM'][$row['WeekS_NO']]=$row['ECPM'];
 $DATA_ARR[$num]['SRPV_filtered'][$row['WeekS_NO']]=$row['SRPV_filtered'];
 $DATA_ARR[$num]['Clicks_filtered'][$row['WeekS_NO']]=$row['Clicks_filtered'];
 $DATA_ARR[$num]['Impressions_filtered'][$row['WeekS_NO']]=$row['Impressions_filtered']; 
 
 
 $weeks = $row['Weeks'];
 /*
 IP_COUNT INT(10),
REFFER_COUNT INT(10),
ROWQUERY_COUNT INT(10),
UA_COUNT INT(10) 
 */
/*$Revenue .= "".$row['Revenue'].",";
$categories	 .= "'".$row['date']."',";
if($Revenue == NULL )$Revenue=0;
$Revenue = substr($Revenue ,0, strlen($Revenue)-1);*/

}
}	

//print_r($DATA_ARR);

	?>		
		
		
		<script type="text/javascript">


$(function () {
    $('#container0').highcharts({
        chart: {
            type: 'line'
        },
        title: {
            text: '点击收入-元(Revenue-RMB) by week'
        },
        subtitle: {
            text: ' weekly'
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
		series: [
		<?php 
function weekArrMapping($dataarr){
$temparr = array("''","''","''","''","''","''","''");
if (empty($dataarr[0]) !=1) $temparr[6] = $dataarr[0];
if (empty($dataarr[1]) !=1) $temparr[0] = $dataarr[1];
if (empty($dataarr[2]) !=1) $temparr[1] = $dataarr[2];
if (empty($dataarr[3]) !=1) $temparr[2] = $dataarr[3];
if (empty($dataarr[4]) !=1) $temparr[3] = $dataarr[4];
if (empty($dataarr[5]) !=1) $temparr[4] = $dataarr[5];
if (empty($dataarr[6]) !=1) $temparr[5] = $dataarr[6];


$str="";
for($i=0;$i < count($temparr);$i++) {
$str .= $temparr[$i].",";
}
$str = substr($str ,0, strlen($str)-1);
return $str;
}
		
		
		for($i=0;$i < count($DATA_ARR);$i++) 
{ 
       $str = weekArrMapping($DATA_ARR[$i]['Revenue']);

		 ?>
        {
            name: 'week<?php echo $DATA_ARR[$i]['Weeks']?>',
            data: [<?php echo $str;?>] 
        }
		<?php
		if ( $i < (count($DATA_ARR)-1)) echo ",";
		}
		 ?>
		
		]
    });
});


$(function () {
    $('#container1').highcharts({
        chart: {
            type: 'line'
        },
        title: {
            text: 'ECPM(RPM) by week’'
        },
        subtitle: {
            text: ' weekly '
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
		series: [
		<?php 
		
		
		for($i=0;$i < count($DATA_ARR);$i++) 
{ 
       $str = weekArrMapping($DATA_ARR[$i]['ECPM']);

		 ?>
        {
            name: 'week<?php echo $DATA_ARR[$i]['Weeks']?>',
            data: [<?php echo $str;?>] 
        }
		<?php
		if ( $i < (count($DATA_ARR)-1)) echo ",";
		}
		 ?>
		
		]
    });
});

$(function () {
    $('#container2').highcharts({
        chart: {
            type: 'line'
        },
        title: {
            text: '有效搜索量(SRPV-filtered) by week’'
        },
        subtitle: {
            text: ' weekly '
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
		series: [
		<?php 
		
		
		for($i=0;$i < count($DATA_ARR);$i++) 
{ 
       $str = weekArrMapping($DATA_ARR[$i]['SRPV_filtered']);

		 ?>
        {
            name: 'week<?php echo $DATA_ARR[$i]['Weeks']?>',
            data: [<?php echo $str;?>] 
        }
		<?php
		if ( $i < (count($DATA_ARR)-1)) echo ",";
		}
		 ?>
		
		]
    });
});

$(function () {
    $('#container3').highcharts({
        chart: {
            type: 'line'
        },
        title: {
            text: '有效推广展示(Impressions-filtered) by week’'
        },
        subtitle: {
            text: ' weekly '
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
		series: [
		<?php 
		
		
		for($i=0;$i < count($DATA_ARR);$i++) 
{ 
       $str = weekArrMapping($DATA_ARR[$i]['Impressions_filtered']);

		 ?>
        {
            name: 'week<?php echo $DATA_ARR[$i]['Weeks']?>',
            data: [<?php echo $str;?>] 
        }
		<?php
		if ( $i < (count($DATA_ARR)-1)) echo ",";
		}
		 ?>
		
		]
    });
});

$(function () {
    $('#container4').highcharts({
        chart: {
            type: 'line'
        },
        title: {
            text: '有效点击量(Clicks-filtered)by week’'
        },
        subtitle: {
            text: ' weekly '
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
		series: [
		<?php 
		
		
		for($i=0;$i < count($DATA_ARR);$i++) 
{ 
       $str = weekArrMapping($DATA_ARR[$i]['Clicks_filtered']);

		 ?>
        {
            name: 'week<?php echo $DATA_ARR[$i]['Weeks']?>',
            data: [<?php echo $str;?>] 
        }
		<?php
		if ( $i < (count($DATA_ARR)-1)) echo ",";
		}
		 ?>
		
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
      <h1>sougou traffic SumFile trend by <span class="STYLE1">week</span></h1>
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
    </p>	<br />
	            
	<table width="600" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="150"><a href="sumfile.php">normal tread</a></td>
        <td width="150"><a href="sumfileRegression.php">Linear Regression</a></td>
        <td width="150"><a href="sumfileweek.php">by Week</a></td>
        <td width="150"><a href="sumfilemonth.php"> by Month</a></td>
      </tr>
    </table><p>
	<form   action='sumfileweek.php' method='get'>
	startdate:<input type="text" id="startdate" name="startdate" size="20" value="<?php echo $startdate ; ?>"><br> 
	stopdate:<input type="text" id="stopdate" name="stopdate" size="20" value="<?php echo $stopdate ; ?>"><br><input name="submit" value="submit" id="submit"  type="submit" />
	</form>
	</p>
    <div id="container0" style="min-width: 310px; height: 400px; margin: 0 auto"></div><br><br>
	<div id="container1" style="min-width: 310px; height: 400px; margin: 0 auto"></div><br><br>
      <div id="container2" style="min-width: 310px; height: 400px; margin: 0 auto"></div><br><br>
	<div id="container3" style="min-width: 310px; height: 400px; margin: 0 auto"></div><br><br>
      <div id="container4" style="min-width: 310px; height: 400px; margin: 0 auto"></div><br><br>
 
  </div>

</div>
<p>&nbsp;</p>
</body>
</html>
