<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="initial-scale=1.0, width=device-width" />

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
$submitdate  = "2016-08-22";
require_once("./db.conf.php");

if (isset($_GET["submit"]) && isset($_GET["date"])) {
$date = $_GET["date"];
//'MSIE', 'Firefox', 'Chrome', 'Safari', 'Opera'
$submitdate = $_GET["date"];
$result = mysqli_query($db,"SELECT sum(NUMBEROFUA) as NUMBEROFUA FROM uainfo where date='$date' and Request_UserAgent like '%MSIE%'  ");
while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
 {

$MSIE = $row['NUMBEROFUA'];
 }

$result1 = mysqli_query($db,"SELECT sum(NUMBEROFUA) as NUMBEROFUA FROM uainfo where date='$date' and Request_UserAgent like '%Firefox%'  ");
while($row1 = mysqli_fetch_array($result1,MYSQLI_ASSOC))
 {

$Firefox = $row1['NUMBEROFUA'];
 }
$result2 = mysqli_query($db,"SELECT sum(NUMBEROFUA) as NUMBEROFUA FROM uainfo where date='$date' and Request_UserAgent like '%Chrome%'  ");
while($row2 = mysqli_fetch_array($result2,MYSQLI_ASSOC))
 {

$Chrome = $row2['NUMBEROFUA'];
 }
$result3 = mysqli_query($db,"SELECT sum(NUMBEROFUA) as NUMBEROFUA FROM uainfo where date='$date' and Request_UserAgent like '%Safari%'  ");
while($row3 = mysqli_fetch_array($result3,MYSQLI_ASSOC))
 {

$Safari = $row3['NUMBEROFUA'];
 }
$result4 = mysqli_query($db,"SELECT sum(NUMBEROFUA) as NUMBEROFUA FROM uainfo where date='$date' and Request_UserAgent like '%Opera%'  ");
while($row4 = mysqli_fetch_array($result4,MYSQLI_ASSOC))
 {

$Opera = $row4['NUMBEROFUA'];
 }

}
	
	?>		
		
		
		<script type="text/javascript">

$(function () {
    $('#container').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Browser market shares <?php echo $date?>'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    }
                }
            }
        },
		

        
		series: [{
            name: 'Brands',
            colorByPoint: true,
            data: [{
                name: 'Microsoft Internet Explorer', 
                y: <?php echo round($MSIE/($MSIE + $Firefox + $Chrome + $Safari + $Opera)*100,2); ?>,
                sliced: true,
                selected: true
            }, {
                name: 'Chrome',
                y: <?php echo round($Chrome/($MSIE + $Firefox + $Chrome + $Safari + $Opera)*100,2);?>
            }, {
                name: 'Firefox',
                y: <?php echo round($Firefox/($MSIE + $Firefox + $Chrome + $Safari + $Opera)*100,2);?>
            }, {
                name: 'Safari',
                y: <?php echo round($Safari/($MSIE + $Firefox + $Chrome + $Safari + $Opera)*100,2);?>
            }, {
                name: 'Opera',
                y: <?php echo round($Opera/($MSIE + $Firefox + $Chrome + $Safari + $Opera)*100,2);?>
            } ]
		
		
		
        }]
    });
});




		</script>
  

</head>

<body>
<div id="demo">
  <div id="demo_content">
    <div class="page-header">
      <h1>sougou IP UA distribution  <?php echo $submitdate; ?></h1>
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
	<p>
	<form   action='UAList.php' method='get'>
	date:<input type="text" id="date" name="date" size="20" value="<?php echo $submitdate; ?>"> <input name="submit" value="submit" id="submit"  type="submit" />
	</form>
	</p><p>
<script src="http://cdn.hcharts.cn/highcharts/highcharts.js"></script>
<script src="http://cdn.hcharts.cn/highcharts/modules/exporting.js"></script>

<div id="container" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
	
	
	</p>
	
 
    <div id="demo_url11">
	TOP 30 ip list<br>
	
	<table width="1000" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td>Request_UserAgent</td>
    <td>NUMBEROFUA</td>
  </tr>

		<?php
$contentdate = $_GET["date"];	

require_once("./db.conf.php");
echo $_GET['submit'].$_GET['date']."<br/>";
if (isset($_GET["submit"]) && isset($_GET["date"])) {

$result = mysqli_query($db,"SELECT *  FROM uainfo where date='$contentdate' order by  NUMBEROFUA desc limit 0,30 ");
while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
 {
 
  
  echo "  <tr>    <td>&nbsp;&nbsp;".$row['Request_UserAgent']."&nbsp;&nbsp;</td>    <td>&nbsp;&nbsp;".$row['NUMBEROFUA']."&nbsp;&nbsp;</td>  </tr>  ";

 }
	//mysqli_close($db);

}
	mysqli_close($db);
	?>
 
 
</table>
	</div>
 
  </div>
 
</div>
<p>&nbsp;</p>
</body>
</html>
