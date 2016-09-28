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
	
	$start = $_GET["startdate"];
	$stop =  $_GET["stopdate"];
	if ($start == ""){$start="2016-08-01";}
	if ($stop == ""){$stop="2016-09-30";}
	?>	


</head>

<body>
<div id="demo">
  <div id="demo_content">
    <div class="page-header">
      <h1>sougou：distribution map </h1>
      <div class="clear"></div>
    </div>
    <p> 图表主题：
       <a href="IP.php"  > <button class="btn" theme="default">IP distribution</button></a>
      <a href="IPList.php" > <button class="btn" theme="grid">traffic trend</button></a>
      <a href="UAList.php" > <button class="btn" theme="grid">UA distribution</button></a>
      <a href="RFList.php" > <button class="btn" theme="grid">RF distribution</button></a>
      <a href="QUList.php" > <button class="btn" theme="grid">QUERY distribution</button></a>
	  	  <a href="sougou.php" > <button class="btn" theme="grid">From Code distribution</button></a>
<a href="sumfile.php" > <button class="btn" theme="grid">SumFile distribution</button></a>
<a href="sougou.php" > <button class="btn" theme="grid">sougou distribution</button></a>
    </p><p>
	<form   action='sougou.php' method='get'>
	startdate:<input type="text" id="startdate" name="startdate" size="20" value="<?php echo $start;?>"><br> 
	stopdate:<input type="text" id="stopdate" name="stopdate" size="20" value="<?php echo $stop;?>"><br><input name="submit" value="submit" id="submit"  type="submit" />
	</form>
	<h3><a href="sougouupdate.php">update data</a></h3></p>
	
    
  </div>
	<div> 
		  <table border="1" cellspacing="0" cellpadding="0" width="918">
        <tr>
          <td width="63" nowrap="nowrap"><p align="center"><strong>Date</strong></p></td>
          <td width="68" nowrap="nowrap"><p align="center"><strong>Raw SRPV</strong></p></td>
          <td width="77" nowrap="nowrap"><p align="center"><strong>SRPV Anti-fraud</strong></p></td>
          <td width="95" nowrap="nowrap"><p align="center"><strong>Revenue(yuan)</strong></p></td>
          <td width="77" nowrap="nowrap"><p align="center"><strong>Raw Impressions</strong></p></td>
          <td width="92" nowrap="nowrap"><p align="center"><strong>Impressions Anti-fraud</strong></p></td>
          <td width="63" nowrap="nowrap"><p align="center"><strong>Raw Clicks</strong></p></td>
          <td width="77" nowrap="nowrap"><p align="center"><strong>Clicks Anti-fraud</strong></p></td>
          <td width="63" nowrap="nowrap"><p align="center"><strong>Raw Coverage</strong></p></td>
          <td width="92" nowrap="nowrap"><p align="center"><strong>Coverage Anti-fraud</strong></p></td>
          <td width="41" nowrap="nowrap"><p align="center"><strong>CTR</strong></p></td>
          <td width="41" nowrap="nowrap"><p align="center"><strong>ECPM</strong></p></td>
          <td width="41" nowrap="nowrap"><p align="center"><strong>CPC</strong></p></td>
		  <td width="41" nowrap="nowrap"><p align="center"><strong>点击收入变化率-W1</strong></p></td>
		  <td width="41" nowrap="nowrap"><p align="center"><strong>点击收入变化率-W2</strong></p></td>
		  <td width="41" nowrap="nowrap"><p align="center"><strong>SRPV change-W1</strong></p></td>
		  <td width="41" nowrap="nowrap"><p align="center"><strong>SRPV change-W2</strong></p></td>
		  <td width="41" nowrap="nowrap"><p align="center"><strong>IM change-W1</strong></p></td>
		  <td width="41" nowrap="nowrap"><p align="center"><strong>IM change-W2</strong></p></td>
		  <td width="41" nowrap="nowrap"><p align="center"><strong>Click change-W1</strong></p></td>
		  <td width="41" nowrap="nowrap"><p align="center"><strong>Click change-W2</strong></p></td>
		  <td width="41" nowrap="nowrap"><p align="center"><strong>ECPM change-W1</strong></p></td>
		  <td width="41" nowrap="nowrap"><p align="center"><strong>ECPM change-W2</strong></p></td>
		  <td width="41" nowrap="nowrap"><p align="center"><strong>Coverage change-W1</strong></p></td>
		  <td width="41" nowrap="nowrap"><p align="center"><strong>Coverage change-W2</strong></p></td>
		  <td width="41" nowrap="nowrap"><p align="center"><strong>CPC change -W1</strong></p></td>
		  <td width="41" nowrap="nowrap"><p align="center"><strong>CPC change -W2</strong></p></td>
        </tr>
        
		<?php

	
$contentdate = $_GET["date"];	
require_once("./db.conf.php");
echo $_GET['submit'].$_GET['startdate'].$_GET["stopdate"];
if (isset($_GET["submit"]) && isset($_GET["startdate"]) && isset($_GET["stopdate"])) {
$startdate = $_GET["startdate"];
$stopdate = $_GET["stopdate"];

$result = mysqli_query($db,"SELECT *  FROM Sogou_data where date>='$startdate' and date <='$stopdate' order by date asc");
//echo "SELECT *  FROM Sogou_data where date>='$startdate' and date <='$stopdate'";
$type =0;
while($row4 = mysqli_fetch_array($result,MYSQLI_ASSOC))
 {
$type=1;
$db_date=$row4['date'];
$db_SRPV_Raw   =$row4['SRPV_Raw'];
$db_SRPV_Anti_fraud  =$row4['SRPV_Anti_fraud'];
$db_Revenue =$row4['Revenue'];
$db_Impressions_Raw	 =$row4['Impressions_Raw'];
$db_Impressions_Anti_fraud  =$row4['Impressions_Anti_fraud'];
$db_Clicks_Raw	  =$row4['Clicks_Raw'];
$db_Clicks_Anti_fraud   =$row4['Clicks_Anti_fraud'];
$db_Coverage_Raw	 =$row4['Coverage_Raw'];
$db_Coverage_Anti_fraud  =$row4['Coverage_Anti_fraud'];
$db_CTR  =$row4['CTR'];
$db_ECPM  =$row4['ECPM'];
$db_CPC    =$row4['CPC'];
$db_Revenue_7 =$row4['Revenue_7']*100;
$db_Revenue_14 =$row4['Revenue_14']*100;
$db_SRPV_7 =$row4['SRPV_7']*100;
$db_SRPV_14  =$row4['SRPV_14']*100;
$db_Impressions_7 =$row4['Impressions_7']*100;
$db_Impressions_14 =$row4['Impressions_14']*100;
$db_Clicks_7 =$row4['Clicks_7']*100;
$db_Clicks_14 =$row4['Clicks_14']*100;
$db_ECPM_7 =$row4['ECPM_7']*100;
$db_ECPM_14 =$row4['ECPM_14']*100;
$db_Coverage_Raw_7 =$row4['Coverage_Raw_7']*100;
$db_Coverage_Raw_14 =$row4['Coverage_Raw_14']*100;
$db_CPC_7 =$row4['CPC_7']*100;
$db_CPC_14 =$row4['CPC_14']*100;


$limitation1=20;
$limitation2=-20;
?>
<tr>

          <td width="63"><?php echo $db_date                       ;?> </td>
          <td width="68"><?php echo $db_SRPV_Raw                   ;?></td>
          <td width="77"><?php echo $db_SRPV_Anti_fraud            ;?></td>
          <td width="95"><?php echo $db_Revenue                    ;?></td>
          <td width="77"><?php echo $db_Impressions_Raw	          ;?></td>
          <td width="92"><?php echo $db_Impressions_Anti_fraud     ;?></td>
          <td width="63"><?php echo $db_Clicks_Raw	              ;?></td>
          <td width="77"><?php echo $db_Clicks_Anti_fraud          ;?></td>
          <td width="63"><?php echo $db_Coverage_Raw	              ;?></td>
          <td width="92"><?php echo $db_Coverage_Anti_fraud        ;?></td>
          <td width="41"><?php echo $db_CTR                        ;?></td>
          <td width="41"><?php echo $db_ECPM                       ;?></td>
          <td width="41"><?php echo $db_CPC                        ;?></td>
		  <td width="41"  <?php if ($db_Revenue_7 >=$limitation1 ) { echo "bgcolor=\"#33CC00\"";} if ($db_Revenue_7 <=$limitation2 ) { echo "bgcolor=\"#FF9966\"";} ?> ><?php echo $db_Revenue_7                  ;?>%</td>
		  <td width="41"  <?php if ($db_Revenue_14 >=$limitation1 ) { echo "bgcolor=\"#33CC00\"";} if ( $db_Revenue_14 <=$limitation2 ) { echo "bgcolor=\"#FF9966\"";} ?> ><?php echo $db_Revenue_14                 ;?>%</td>
		  <td width="41"  <?php if ($db_SRPV_7 >=$limitation1 ) { echo "bgcolor=\"#33CC00\"";} if ( $db_SRPV_7 <=$limitation2 ) { echo "bgcolor=\"#FF9966\"";} ?> ><?php echo $db_SRPV_7                     ;?>%</td>
		  <td width="41  <?php if ($db_SRPV_14 >=$limitation1 ) { echo "bgcolor=\"#33CC00\"";} if ($db_SRPV_14 <=$limitation2 ) { echo "bgcolor=\"#FF9966\"";} ?> "><?php echo $db_SRPV_14                    ;?>%</td>
		  <td width="41"  <?php if ($db_Impressions_7 >=$limitation1 ) { echo "bgcolor=\"#33CC00\"";} if ( $db_Impressions_7 <=$limitation2 ) { echo "bgcolor=\"#FF9966\"";} ?> ><?php echo $db_Impressions_7              ;?>%</td>
		  <td width="41"  <?php if ($db_Impressions_14 >=$limitation1 ) { echo "bgcolor=\"#33CC00\"";} if ( $db_Impressions_14 <=$limitation2 ) { echo "bgcolor=\"#FF9966\"";} ?> ><?php echo $db_Impressions_14             ;?>%</td>
		  <td width="41"  <?php if ($db_Clicks_7 >=$limitation1 ) { echo "bgcolor=\"#33CC00\"";} if ( $db_Clicks_7 <=$limitation2 ) { echo "bgcolor=\"#FF9966\"";} ?> ><?php echo $db_Clicks_7                   ;?>%</td>
		  <td width="41"  <?php if ($db_Clicks_14 >=$limitation1 ) { echo "bgcolor=\"#33CC00\"";} if ( $db_Clicks_14 <=$limitation2 ) { echo "bgcolor=\"#FF9966\"";} ?> ><?php echo $db_Clicks_14                  ;?>%</td>
<td width="41"  <?php if ($db_ECPM_7 >=$limitation1 ) { echo "bgcolor=\"#33CC00\"";} if ( $db_ECPM_7 <=$limitation2 ) { echo "bgcolor=\"#FF9966\"";} ?> ><?php echo $db_ECPM_7                     ;?>%</td>
<td width="41"  <?php if ($db_ECPM_14 >=$limitation1 ) { echo "bgcolor=\"#33CC00\"";} if ( $db_ECPM_14 <=$limitation2 ) { echo "bgcolor=\"#FF9966\"";} ?> ><?php echo $db_ECPM_14                    ;?>%</td>
<td width="41"  <?php if ($db_Coverage_Raw_7 >=$limitation1 ) { echo "bgcolor=\"#33CC00\"";} if ( $db_Coverage_Raw_7 <=$limitation2 ) { echo "bgcolor=\"#FF9966\"";} ?> ><?php echo $db_Coverage_Raw_7             ;?>%</td>
<td width="41"  <?php if ($db_Coverage_Raw_14 >=$limitation1 ) { echo "bgcolor=\"#33CC00\"";} if ( $db_Coverage_Raw_14 <=$limitation2 ) { echo "bgcolor=\"#FF9966\"";} ?> ><?php echo $db_Coverage_Raw_14            ;?>%</td>
<td width="41"  <?php if ($db_CPC_7 >=$limitation1 ) { echo "bgcolor=\"#33CC00\"";} if ( $db_CPC_7 <=$limitation2 ) { echo "bgcolor=\"#FF9966\"";} ?> ><?php echo $db_CPC_7                      ;?>%</td>
<td width="41"  <?php if ($db_CPC_14 >=$limitation1 ) { echo "bgcolor=\"#33CC00\"";} if ( $db_CPC_14 <=$limitation2 ) { echo "bgcolor=\"#FF9966\"";} ?> ><?php echo $db_CPC_14                     ;?>%</td></tr>
<?php

}



}
	
	?>	
		
	
	

        
      </table>
	</div>
	
</div>
<p>&nbsp;</p>
</body>
</html>
