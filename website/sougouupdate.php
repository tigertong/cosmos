<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>stats</title>
	<link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="./css/style.css">
<script src="./css/hm.js"></script><script src="./css/share.js"></script><link rel="stylesheet" href="./css/share_style0_24.css"></head>




</head>

<body>
<div id="demo">
  <div id="demo_content1">
    <div class="page-header">
      <h1>sougou stats</h1>
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
	
	<?php
date_default_timezone_set("PRC"); 
$contentdate = $_GET["date"];	
require_once("./db.conf.php");
echo $_REQUEST['submit'].$_REQUEST["date"];
if (isset($_REQUEST["submit"]) && isset($_REQUEST["date"])) {

$date = $_REQUEST["date"] ;
$SRPV_Raw = $_REQUEST["SRPV_Raw"] ;
$SRPV_Anti_fraud = $_REQUEST["SRPV_Anti_fraud"] ;
$Revenue = $_REQUEST["Revenue"] ;
$Impressions_Raw = $_REQUEST["Impressions_Raw"] ;
$Impressions_Anti_fraud = $_REQUEST["Impressions_Anti_fraud"] ;
$Clicks_Raw = $_REQUEST["Clicks_Raw"] ;
$Clicks_Anti_fraud = $_REQUEST["Clicks_Anti_fraud"] ;
$Coverage_Raw = $_REQUEST["Coverage_Raw"] ;
$Coverage_Anti_fraud = $_REQUEST["Coverage_Anti_fraud"] ;
$CTR = $_REQUEST["CTR"] ;
$ECPM = $_REQUEST["ECPM"] ;


$date_1weekago = date("Y-m-d", strtotime("$date -1 week"));	
$date_2weekago = date("Y-m-d", strtotime("$date -2 week"));	


$result = mysqli_query($db,"SELECT *  FROM Sogou_data where date='$date_1weekago' ");

$Revenue_1weekago=0;
$SRPV_Anti_fraud_1weekago = 0;
$Impressions_Anti_fraud_1weekago = 0;
$Clicks_Anti_fraud_1weekago=0;
$ECPM_1weekago=0;
$Coverage_Anti_fraud_1weekago=0;
$CPC_1weekago=0;


while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
 {

$Revenue_1weekago = $row['Revenue'];
$SRPV_Anti_fraud_1weekago =  $row['SRPV_Anti_fraud'];
$Impressions_Anti_fraud_1weekago  =  $row['Impressions_Anti_fraud'];
$Clicks_Anti_fraud_1weekago = $row['Clicks_Anti_fraud'];
$ECPM_1weekago = $row['ECPM'];
$Coverage_Anti_fraud_1weekago = $row['Coverage_Anti_fraud'];
$CPC_1weekago = $row['CPC'];
}

$result2 = mysqli_query($db,"SELECT *  FROM Sogou_data where date='$date_2weekago' ");

$Revenue_2weekago=0;
$SRPV_Anti_fraud_2weekago = 0;
$Impressions_Anti_fraud_2weekago = 0;
$Clicks_Anti_fraud_2weekago=0;
$ECPM_2weekago=0;
$Coverage_Anti_fraud_2weekago=0;
$CPC_2weekago=0;


while($row2 = mysqli_fetch_array($result2,MYSQLI_ASSOC))
 {

$Revenue_2weekago = $row2['Revenue'];
$SRPV_Anti_fraud_2weekago =  $row2['SRPV_Anti_fraud'];
$Impressions_Anti_fraud_2weekago  =  $row2['Impressions_Anti_fraud'];
$Clicks_Anti_fraud_2weekago = $row2['Clicks_Anti_fraud'];
$ECPM_2weekago = $row2['ECPM'];
$Coverage_Anti_fraud_2weekago = $row2['Coverage_Anti_fraud'];
$CPC_2weekago = $row2['CPC'];
}



$CPC = $Revenue/$Clicks_Raw;  //‘=点击收入/总点击量,
if($Revenue_1weekago==0){$Revenue_7 = 0;}
else{
$Revenue_7 =  ($Revenue - $Revenue_1weekago)/$Revenue_1weekago ; //’=(Day8点击收入-Day1点击收入)/Day1点击收入
}
if($Revenue_2weekago==0){$Revenue_14 = 0;}
else{
$Revenue_14 =  ($Revenue - $Revenue_2weekago  )/$Revenue_2weekago ; //’=(Day15点击收入-Day1点击收入)/Day1点击收入
}


if($SRPV_Anti_fraud_1weekago==0){$SRPV_7 = 0;}
else{
 //’=(Day8有效搜索量-Day1有效搜索量)/Day1有效搜索
$SRPV_7 =  ($SRPV_Anti_fraud - $SRPV_Anti_fraud_1weekago)/$SRPV_Anti_fraud_1weekago ; 
}
if($SRPV_Anti_fraud_2weekago==0){$SRPV_14 = 0;}
else{
$SRPV_14 =  ($SRPV_Anti_fraud - $SRPV_Anti_fraud_2weekago)/$SRPV_Anti_fraud_2weekago ;//’=(Day15有效搜索量Day1有效搜索量)/Day1有效搜索量
}
 
if($Impressions_Anti_fraud_1weekago==0){$Impressions_7 = 0;}
else{
$Impressions_7 =  ($Impressions_Anti_fraud -$Impressions_Anti_fraud_1weekago )/$Impressions_Anti_fraud_1weekago ;//’=(Day8有效推广展示-Day1有效推广展示)/Day1有效推广展示
}
if($Impressions_Anti_fraud_2weekago==0){$Impressions_14 = 0;}
else{
$Impressions_14 =  ($Impressions_Anti_fraud -$Impressions_Anti_fraud_2weekago )/$Impressions_Anti_fraud_2weekago ; //’=(Day15有效推广展示-Day1有效推广展示)/Day1有效推广展示量
}
 
if($Clicks_Anti_fraud_1weekago==0){$Clicks_7 = 0;}
else{
$Clicks_7 =  ($Clicks_Anti_fraud -$Clicks_Anti_fraud_1weekago )/$Clicks_Anti_fraud_1weekago ; //’=(Day8有效点击量-Day1有效点击量)/Day1有效点击量示
}
if($Clicks_Anti_fraud_2weekago==0){$Clicks_14 = 0;}
else{
$Clicks_14 =  ($Clicks_Anti_fraud -$Clicks_Anti_fraud_2weekago )/$Clicks_Anti_fraud_2weekago ;//’=(Day15有效点击量Day1有效点击量)/Day1有效点击量展示量
}


if($ECPM_1weekago==0){$ECPM_7 = 0;}
else{
$ECPM_7 =  ($ECPM -$ECPM_1weekago )/$ECPM_1weekago ;//’=(Day8有效点击量-Day1有效点击量)/Day1有效点击量示
}
if($ECPM_2weekago==0){$ECPM_14 = 0;}
else{
$ECPM_14 =  ($ECPM -$ECPM_2weekago )/$ECPM_2weekago ; //’=(Day15有效点击量Day1有效点击量)/Day1有效点击量展示量
}

if($Coverage_Anti_fraud_1weekago==0){$Coverage_Raw_7 = 0;}
else{
$Coverage_Raw_7 =  ($Coverage_Anti_fraud -$Coverage_Anti_fraud_1weekago )/$Coverage_Anti_fraud_1weekago ; //’=(Day8有效点击量-Day1有效点击量)/Day1有效点击量示
}
if($Coverage_Anti_fraud_2weekago==0){$Coverage_Raw_14 = 0;}
else{
$Coverage_Raw_14 =  ($Coverage_Anti_fraud -$Coverage_Anti_fraud_2weekago )/$Coverage_Anti_fraud_2weekago ; //’=(Day15有效点击量Day1有效点击量)/Day1有效点击量展示量
}



if($CPC_1weekago==0){$CPC_7 = 0;}
else{
$CPC_7 =  ($CPC_1weekago -$CPC )/$CPC ; //’=(Day8有效点击量-Day1有效点击量)/Day1有效点击量示
}
if($CPC_2weekago==0){$CPC_14 = 0;}
else{
$CPC_14 =  ($CPC_2weekago -$CPC )/$CPC ; //’=(Day15有效点击量Day1有效点击量)/Day1有效点击量展示量
}



$import="INSERT Sogou_data (date,SRPV_Raw  , SRPV_Anti_fraud , Revenue ,Impressions_Raw	 ,Impressions_Anti_fraud  ,Clicks_Raw	  ,Clicks_Anti_fraud   ,Coverage_Raw	 ,Coverage_Anti_fraud  ,CTR  ,ECPM  ,CPC    ,Revenue_7 ,Revenue_14 ,SRPV_7 ,SRPV_14 , Impressions_7 ,Impressions_14 ,Clicks_7 ,Clicks_14 ,ECPM_7 ,ECPM_14 ,Coverage_Raw_7 ,Coverage_Raw_14 ,CPC_7 ,CPC_14   ) values ( '$date',$SRPV_Raw  , $SRPV_Anti_fraud , $Revenue ,$Impressions_Raw	 ,$Impressions_Anti_fraud  ,$Clicks_Raw	  ,$Clicks_Anti_fraud   ,$Coverage_Raw	 ,$Coverage_Anti_fraud  ,$CTR  ,$ECPM  ,$CPC    ,$Revenue_7 ,$Revenue_14 ,$SRPV_7 ,$SRPV_14 , $Impressions_7 ,$Impressions_14 ,$Clicks_7 ,$Clicks_14 ,$ECPM_7 ,$ECPM_14 ,$Coverage_Raw_7 ,$Coverage_Raw_14 ,$CPC_7 ,$CPC_14  ) ON DUPLICATE KEY UPDATE SRPV_Raw=$SRPV_Raw,SRPV_Anti_fraud=$SRPV_Anti_fraud,Revenue=$Revenue,Impressions_Raw	=$Impressions_Raw	,Impressions_Anti_fraud=$Impressions_Anti_fraud,Clicks_Raw	=$Clicks_Raw	,Clicks_Anti_fraud=$Clicks_Anti_fraud,Coverage_Raw	=$Coverage_Raw	,Coverage_Anti_fraud=$Coverage_Anti_fraud,CTR=$CTR,ECPM=$ECPM,CPC=$CPC,Revenue_7=$Revenue_7,Revenue_14=$Revenue_14,SRPV_7=$SRPV_7,SRPV_14=$SRPV_14,Impressions_7=$Impressions_7,Impressions_14=$Impressions_14,Clicks_7=$Clicks_7,Clicks_14=$Clicks_14,ECPM_7=$ECPM_7,ECPM_14=$ECPM_14,Coverage_Raw_7=$Coverage_Raw_7,Coverage_Raw_14=$Coverage_Raw_14,CPC_7=$CPC_7,CPC_14=$CPC_14  ";
mysqli_query($db,$import) or die(mysql_error());


$result = mysqli_query($db,"SELECT *  FROM Sogou_data where date='$date' ");
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
}



}
$limitation1=20;
$limitation2=-20;	
	?>	
	<?php if($type==1){?>
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
		  <td width="41"  <?php if ($db_Revenue_7 >=$limitation1 || $db_Revenue_7 <=$limitation2 ) { echo "bgcolor=\"#FF9966\"";} ?> ><?php echo $db_Revenue_7                  ;?>%</td>
		  <td width="41"  <?php if ($db_Revenue_14 >=$limitation1 || $db_Revenue_14 <=$limitation2 ) { echo "bgcolor=\"#FF9966\"";} ?> ><?php echo $db_Revenue_14                 ;?>%</td>
		  <td width="41"  <?php if ($db_SRPV_7 >=$limitation1 || $db_SRPV_7 <=$limitation2 ) { echo "bgcolor=\"#FF9966\"";} ?> ><?php echo $db_SRPV_7                     ;?>%</td>
		  <td width="41  <?php if ($db_SRPV_14 >=$limitation1 || $db_SRPV_14 <=$limitation2 ) { echo "bgcolor=\"#FF9966\"";} ?> "><?php echo $db_SRPV_14                    ;?>%</td>
		  <td width="41"  <?php if ($db_Impressions_7 >=$limitation1 || $db_Impressions_7 <=$limitation2 ) { echo "bgcolor=\"#FF9966\"";} ?> ><?php echo $db_Impressions_7              ;?>%</td>
		  <td width="41"  <?php if ($db_Impressions_14 >=$limitation1 || $db_Impressions_14 <=$limitation2 ) { echo "bgcolor=\"#FF9966\"";} ?> ><?php echo $db_Impressions_14             ;?>%</td>
		  <td width="41"  <?php if ($db_Clicks_7 >=$limitation1 || $db_Clicks_7 <=$limitation2 ) { echo "bgcolor=\"#FF9966\"";} ?> ><?php echo $db_Clicks_7                   ;?>%</td>
		  <td width="41"  <?php if ($db_Clicks_14 >=$limitation1 || $db_Clicks_14 <=$limitation2 ) { echo "bgcolor=\"#FF9966\"";} ?> ><?php echo $db_Clicks_14                  ;?>%</td>
<td width="41"  <?php if ($db_ECPM_7 >=$limitation1 || $db_ECPM_7 <=$limitation2 ) { echo "bgcolor=\"#FF9966\"";} ?> ><?php echo $db_ECPM_7                     ;?>%</td>
<td width="41"  <?php if ($db_ECPM_14 >=$limitation1 || $db_ECPM_14 <=$limitation2 ) { echo "bgcolor=\"#FF9966\"";} ?> ><?php echo $db_ECPM_14                    ;?>%</td>
<td width="41"  <?php if ($db_Coverage_Raw_7 >=$limitation1 || $db_Coverage_Raw_7 <=$limitation2 ) { echo "bgcolor=\"#FF9966\"";} ?> ><?php echo $db_Coverage_Raw_7             ;?>%</td>
<td width="41"  <?php if ($db_Coverage_Raw_14 >=$limitation1 || $db_Coverage_Raw_14 <=$limitation2 ) { echo "bgcolor=\"#FF9966\"";} ?> ><?php echo $db_Coverage_Raw_14            ;?>%</td>
<td width="41"  <?php if ($db_CPC_7 >=$limitation1 || $db_CPC_7 <=$limitation2 ) { echo "bgcolor=\"#FF9966\"";} ?> ><?php echo $db_CPC_7                      ;?>%</td>
<td width="41"  <?php if ($db_CPC_14 >=$limitation1 || $db_CPC_14 <=$limitation2 ) { echo "bgcolor=\"#FF9966\"";} ?> ><?php echo $db_CPC_14                     ;?>%</td></tr>
      </table>
	</div>
	
	<?php } ?>
	
    <div id="container" style="width: 900px; height: 400px;" data-highcharts-chart="0"><form   action='sougouupdate.php' method='post'>
      <table width="595" border="1" cellspacing="0" cellpadding="0">
        <tr>
          <td width="176"><strong>Date</strong></td>
          <td width="413"><input type="text" id="date" name="date"/></td>
        </tr>
        <tr>
          <td><strong>Raw SRPV</strong></td>
          <td width="413"><input type="text" id="SRPV_Raw" name="SRPV_Raw"/></td>
        </tr>
        <tr>
          <td><strong>SRPV Anti-fraud</strong></td>
          <td width="413"><input type="text" id="SRPV_Anti_fraud" name="SRPV_Anti_fraud"/></td>
        </tr>
        <tr>
          <td><strong>Revenue(yuan)</strong></td>
          <td width="413"><input type="text" id="Revenue" name="Revenue"/></td>
        </tr>
        <tr>
          <td><strong>Raw Impressions</strong></td>
          <td width="413"><input type="text" id="Impressions_Raw" name="Impressions_Raw"/></td>
        </tr>
        <tr>
          <td><strong>Impressions Anti-fraud</strong></td>
          <td width="413"><input type="text" id="Impressions_Anti_fraud" name="Impressions_Anti_fraud"/></td>
        </tr>
        <tr>
          <td><strong>Raw Clicks</strong></td>
          <td width="413"><input type="text" id="Clicks_Raw" name="Clicks_Raw"/></td>
        </tr>
        <tr>
          <td><strong>Clicks Anti-fraud</strong></td>
          <td width="413"><input type="text" id="Clicks_Anti_fraud" name="Clicks_Anti_fraud"/></td>
        </tr>
        <tr>
          <td><strong>Raw Coverage</strong></td>
          <td width="413"><input type="text" id="Coverage_Raw" name="Coverage_Raw"/></td>
        </tr>
        <tr>
          <td><strong>Coverage Anti-fraud</strong></td>
          <td width="413"><input type="text" id="Coverage_Anti_fraud" name="Coverage_Anti_fraud"/></td>
        </tr>
        <tr>
          <td><strong>CTR</strong></td>
          <td width="413"><input type="text" id="CTR" name="CTR"/></td>
        </tr>
        <tr>
          <td><strong>ECPM</strong></td>
          <td width="413"><input type="text" id="ECPM" name="ECPM"/></td>
        </tr>
      </table><input name="submit" value="submit" id="submit"  type="submit" />
	  
	  </form>
	  <p>&nbsp;</p>
    </div>
 
 
  
  </div>
 
</div>
<p>&nbsp;</p>
</body>
</html>
