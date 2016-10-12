<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="initial-scale=1.0, width=device-width" />

<title>stats</title>
	<link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="./css/style.css">
 

<script src="./css/hm.js"></script><script src="./css/share.js"></script><link rel="stylesheet" href="./css/share_style0_24.css"></head>
		<script type="text/javascript" src="js/jquery-1.8.3.min.js"></script>
		<style type="text/css">
${demo.css}
		</style>

	<?php
$contentdate = $_GET["date"];	
require_once("./db.conf.php");
$submitdate  = "2016-08-22";

if (isset($_GET["submit"]) && isset($_GET["date"])) {
$date = $_GET["date"];
//categories'
$submitdate = $_GET["date"];
$categories="";
$datarow="";

$datarow1="";
//$result = mysqli_query($db,"SELECT SUBSTRING_INDEX(replace(replace(Request_Referrer,'http://',''),'https://',''),'/',1) as RF , SUM(NUMBEROFRF) as NUMBEROFRF FROM RFinfo  WHERE date='$date' group by  RF ORDER BY NUMBEROFRF DESC limit 0,21; ");
$result = mysqli_query($db,"SELECT * from RFDomaininfo  WHERE date='$date' ORDER BY NUMBEROFRF DESC limit 0,21  ") ;

while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
 {
 if ($row['Request_Domain'] != "null"){
$categories .= "'".$row['Request_Domain']."',";
$datarow .= "[0,". $row['NUMBEROFRF']."],";
// [-9.7, 9.4],
$datarow1 .= "['".$row['Request_Domain']."',". $row['NUMBEROFRF']."],";
}
 }
 
$categories = substr($categories ,0, strlen($categories)-1);
$categories = str_replace("null","-NULL-",$categories );

$datarow = substr($datarow ,0, strlen($datarow)-1);
$datarow1 = substr($datarow1 ,0, strlen($datarow1)-1);
}
	
	?>	
		
		
		<script type="text/javascript">

$(function () {
    $('#container').highcharts({
        chart: {
            type: 'column',
            inverted: true
        },
        title: {
            text: 'request number per refer top 20 [removed the refer "null" from the list]'
        },
        subtitle: {
            text: ' '
        },
        xAxis: {
            type: 'category',
            labels: {
                rotation: 0,
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'request number'
            }
        },
        legend: {
            enabled: false
        },
        tooltip: {
            pointFormat: '<b>{point.y:.1f}</b>'
        },
        series: [{
            name: 'number',
            data: [
                <?php echo $datarow1;?>
            ],
            dataLabels: {
                enabled: true,
                rotation: 0,
                color: '#FFFFFF',
                align: 'right',
                format: '{point.y:.1f}', // one decimal
                y: 10, // 10 pixels down from the top
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        }]
    });
});
		</script>
  

</head>

<body>
<div id="demo">
  <div id="demo_content">
    <div class="page-header">
      <h1>sougou stats request refer <?php echo $submitdate; ?></h1>
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
	<form   action='RFList.php' method='get'>
	date:<input type="text" id="date" name="date" size="20" value="<?php echo $submitdate; ?>"> <input name="submit" value="submit" id="submit"  type="submit" />
	</form>
	</p><p>
<script src="js/highcharts.js"></script>
<script src="js/exporting.js"></script>

<div id="container" style="min-width: 300px; height: 1200px; margin: 0 auto"></div>

	
	
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

$result = mysqli_query($db,"SELECT *  FROM rfinfo where date='$contentdate' order by  NUMBEROFRF desc limit 0,30 ");
while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
 {
 
  
  echo "  <tr>    <td>&nbsp;&nbsp;".$row['Request_Referrer']."&nbsp;&nbsp;</td>    <td>&nbsp;&nbsp;".$row['NUMBEROFRF']."&nbsp;&nbsp;</td>  </tr>  ";

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
