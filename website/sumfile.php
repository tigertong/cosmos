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
$startdate = "2016-08-05";
$stopdate = "2016-09-05";

if (isset($_GET["submit"]) && isset($_GET["startdate"]) && isset($_GET["stopdate"])) {
$startdate = $_GET["startdate"];
$stopdate = $_GET["stopdate"];


$result = mysqli_query($db,"SELECT *  FROM sumfileinfo where date>='$startdate'  and  date<='$stopdate' order by date asc");

$categories="";

$SRPV_filtered = "";
$SRPV = "";
$Impressions_filtered="";
$Impressions="";
$Clicks_filtered="";
$Clicks="";
$DSQ="";

while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
 {
 /*
 IP_COUNT INT(10),
REFFER_COUNT INT(10),
ROWQUERY_COUNT INT(10),
UA_COUNT INT(10) 
 */
$SRPV_filtered .= "".$row['SRPV_filtered'].",";
$SRPV  .= "".$row['SRPV'].",";
$Impressions_filtered  .= "".$row['Impressions_filtered'].",";
$Impressions  .= "".$row['Impressions'].",";
$Clicks_filtered  .= "".$row['Clicks_filtered'].",";
$Clicks  .= "".$row['Clicks'].",";
$DSQ  .= "".$row['DSQ'].",";

$categories	 .= "'".$row['date']."',";

if($SRPV_filtered == NULL )$SRPV_filtered=0;
if($SRPV == NULL)$SRPV=0;
if($Impressions_filtered=="")$Impressions_filtered=0;
if($Impressions=="")$Impressions=0;
if($Clicks_filtered=="")$Clicks_filtered=0;
if($Clicks=="")$Clicks=0;
if($DSQ=="")$DSQ=0;
}

$SRPV_filtered = substr($SRPV_filtered ,0, strlen($SRPV_filtered)-1);
$SRPV = substr($SRPV ,0, strlen($SRPV)-1);
$Impressions_filtered = substr($Impressions_filtered ,0, strlen($Impressions_filtered)-1);
$Impressions = substr($Impressions ,0, strlen($Impressions)-1);
$Clicks_filtered = substr($Clicks_filtered ,0, strlen($Clicks_filtered)-1);
$Clicks = substr($Clicks ,0, strlen($Clicks)-1);
$DSQ = substr($DSQ ,0, strlen($DSQ)-1);
$categories = substr($categories ,0, strlen($categories)-1);
	//mysqli_close($db);


$result1 = mysqli_query($db,"SELECT *  FROM Sogou_data where date>='$startdate'  and  date<='$stopdate' order by date asc");



$SRPV_Raw = "";
$SRPV_Anti_fraud = "";
$Impressions_Raw="";
$Impressions_Anti_fraud="";
$Clicks_Raw="";
$Clicks_Anti_fraud="";


while($row = mysqli_fetch_array($result1,MYSQLI_ASSOC))
 {
 /*
 IP_COUNT INT(10),
REFFER_COUNT INT(10),
ROWQUERY_COUNT INT(10),
UA_COUNT INT(10) 
 */
$SRPV_Raw .= "".$row['SRPV_Raw'].",";
$SRPV_Anti_fraud  .= "".$row['SRPV_Anti_fraud'].",";
$Impressions_Raw  .= "".$row['Impressions_Raw'].",";
$Impressions_Anti_fraud  .= "".$row['Impressions_Anti_fraud'].",";
$Clicks_Raw  .= "".$row['Clicks_Raw'].",";
$Clicks_Anti_fraud  .= "".$row['Clicks_Anti_fraud'].",";



if($SRPV_Raw == NULL )$SRPV_Raw=0;
if($SRPV_Anti_fraud == NULL)$SRPV_Anti_fraud=0;
if($Impressions_Raw=="")$Impressions_Raw=0;
if($Impressions_Anti_fraud=="")$Impressions_Anti_fraud=0;
if($Clicks_Raw=="")$Clicks_Raw=0;
if($Clicks_Anti_fraud=="")$Clicks_Anti_fraud=0;

}

$SRPV_Raw = substr($SRPV_Raw ,0, strlen($SRPV_Raw)-1);
$SRPV_Anti_fraud = substr($SRPV_Anti_fraud ,0, strlen($SRPV_Anti_fraud)-1);
$Impressions_Raw = substr($Impressions_Raw ,0, strlen($Impressions_Raw)-1);
$Impressions_Anti_fraud = substr($Impressions_Anti_fraud ,0, strlen($Impressions_Anti_fraud)-1);
$Clicks_Raw = substr($Clicks_Raw ,0, strlen($Clicks_Raw)-1);
$Clicks_Anti_fraud = substr($Clicks_Anti_fraud ,0, strlen($Clicks_Anti_fraud)-1);
 
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
            text: 'Raw SRPV'
        },
        subtitle: {
            text: ' SRPV/Sougou'
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
            name: 'SML',
            data: [<?php echo $SRPV;?>] //[7.0, 6.9, 9.5, 14.5, 18.4, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
        },{
            name: 'Sogou',
            data: [<?php echo $SRPV_Raw;?> ] //[7.0, 6.9, 9.5, 14.5, 18.4, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
        }/*,{
            name: 'UA_COUNT',
            data: [ ] //[7.0, 6.9, 9.5, 14.5, 18.4, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
        }*/
		
		]
    });
});
$(function () {
    $('#container1').highcharts({
        chart: {
            type: 'line'
        },
        title: {
            text: ' SRPV_filtered '
        },
        subtitle: {
            text: ' SRPV_filtered/Sougou/DSQ'
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
		{
            name: 'SML',
            data: [<?php echo $SRPV_filtered;?>]  
        },{
            name: 'DSQ',
            data: [<?php echo $DSQ;?>]  
        },{
            name: 'Sogou',
            data: [<?php echo $SRPV_Anti_fraud;?>]  
        }
		
		]
    });
});



$(function () {
    $('#containerIP').highcharts({
        chart: {
            type: 'line'
        },
        title: {
            text: 'Raw Impressions'
        },
        subtitle: {
            text: ' Impressions/Sougou'
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
            name: 'SML',
            data: [<?php echo $Impressions;?>] //[7.0, 6.9, 9.5, 14.5, 18.4, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
        },{
            name: 'Sogou',
            data: [<?php echo $Impressions_Raw;?>] //[7.0, 6.9, 9.5, 14.5, 18.4, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
        } 
		
		]
    });
});
$(function () {
    $('#containerIPF').highcharts({
        chart: {
            type: 'line'
        },
        title: {
            text: ' Impressions_filtered '
        },
        subtitle: {
            text: ' Impressions_filtered/Sougou'
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
	{
           name: 'Sogou',
           data: [<?php echo $Impressions_Anti_fraud;?>]  
       },
	    {
            name: 'SML',
            data: [<?php echo $Impressions_filtered;?>]  
        }
		
		]
    });
});


$(function () {
    $('#containerC').highcharts({
        chart: {
            type: 'line'
        },
        title: {
            text: 'Raw Clicks'
        },
        subtitle: {
            text: ' Clicks/Sougou'
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
            name: 'SML',
            data: [<?php echo $Clicks;?>] //[7.0, 6.9, 9.5, 14.5, 18.4, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
        },{
            name: 'Sogou',
            data: [ <?php echo $Clicks_Raw; ?>] //[7.0, 6.9, 9.5, 14.5, 18.4, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
        } 
		
		]
    });
});
$(function () {
    $('#containerCF').highcharts({
        chart: {
            type: 'line'
        },
        title: {
            text: ' Clicks_filtered '
        },
        subtitle: {
            text: ' Clicks_filtered/Sougou'
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
		{
            name: 'Sogou',
            data: [<?php echo $Clicks_Anti_fraud;?>]  
       },
	    {
            name: 'SML',
            data: [<?php echo $Clicks_filtered;?>]  
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
      <h1>sougou traffic SumFile trend</h1>
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
	<form   action='sumfile.php' method='get'>
	startdate:<input type="text" id="startdate" name="startdate" size="20" value="<?php echo $startdate ; ?>"><br> 
	stopdate:<input type="text" id="stopdate" name="stopdate" size="20" value="<?php echo $stopdate ; ?>"><br><input name="submit" value="submit" id="submit"  type="submit" />
	</form>
	</p>
    <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
	<div id="container1" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
      <div id="containerIP" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
	<div id="containerIPF" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
      <div id="containerC" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
	<div id="containerCF" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
  </div>

</div>
<p>&nbsp;</p>
</body>
</html>
