<?php

$date=explode(" ", $data[0]);
$time = strtotime($date[0]);
$newformat = date('Y-m-d',$time);

print_r($data);
$date_1weekago = date("Y-m-d", strtotime("$newformat -1 week"));	
$date_2weekago = date("Y-m-d", strtotime("$newformat -2 week"));	


$SRPV_Raw = $data[1];
$SRPV_Anti_fraud  = $data[2]; 
$Revenue  = $data[3];
$Impressions_Raw	  = $data[4];
$Impressions_Anti_fraud   = $data[5];
$Clicks_Raw	   = $data[6];
$Clicks_Anti_fraud    = $data[7];
$Coverage_Raw	  = $data[8];
$Coverage_Anti_fraud   = $data[9];
$CTR   = $data[10];
$ECPM = $data[11];



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

$Years = date("Y", strtotime($newformat));
$Months = date("m", strtotime($newformat));
$Days = date("d", strtotime($newformat));
$Weeks = date("W", strtotime($newformat));
$YearMonth = date("Ym", strtotime($newformat));
$WeekS_NO = date("w", strtotime($newformat));


$import="INSERT Sogou_data (date,SRPV_Raw  , SRPV_Anti_fraud , Revenue ,Impressions_Raw	 ,Impressions_Anti_fraud  ,Clicks_Raw	  ,Clicks_Anti_fraud   ,Coverage_Raw	 ,Coverage_Anti_fraud  ,CTR  ,ECPM  ,CPC    ,Revenue_7 ,Revenue_14 ,SRPV_7 ,SRPV_14 , Impressions_7 ,Impressions_14 ,Clicks_7 ,Clicks_14 ,ECPM_7 ,ECPM_14 ,Coverage_Raw_7 ,Coverage_Raw_14 ,CPC_7 ,CPC_14 ,Years ,Months,Days,Weeks ,YearMonth ,WeekS_NO  ) values ( '$newformat',$SRPV_Raw  , $SRPV_Anti_fraud , $Revenue ,$Impressions_Raw	 ,$Impressions_Anti_fraud  ,$Clicks_Raw	  ,$Clicks_Anti_fraud   ,$Coverage_Raw	 ,$Coverage_Anti_fraud  ,$CTR  ,$ECPM  ,$CPC    ,$Revenue_7 ,$Revenue_14 ,$SRPV_7 ,$SRPV_14 , $Impressions_7 ,$Impressions_14 ,$Clicks_7 ,$Clicks_14 ,$ECPM_7 ,$ECPM_14 ,$Coverage_Raw_7 ,$Coverage_Raw_14 ,$CPC_7 ,$CPC_14 ,$Years ,$Months,$Days,$Weeks ,$YearMonth ,$WeekS_NO ) ON DUPLICATE KEY UPDATE SRPV_Raw=$SRPV_Raw,SRPV_Anti_fraud=$SRPV_Anti_fraud,Revenue=$Revenue,Impressions_Raw	=$Impressions_Raw	,Impressions_Anti_fraud=$Impressions_Anti_fraud,Clicks_Raw	=$Clicks_Raw	,Clicks_Anti_fraud=$Clicks_Anti_fraud,Coverage_Raw	=$Coverage_Raw	,Coverage_Anti_fraud=$Coverage_Anti_fraud,CTR=$CTR,ECPM=$ECPM,CPC=$CPC,Revenue_7=$Revenue_7,Revenue_14=$Revenue_14,SRPV_7=$SRPV_7,SRPV_14=$SRPV_14,Impressions_7=$Impressions_7,Impressions_14=$Impressions_14,Clicks_7=$Clicks_7,Clicks_14=$Clicks_14,ECPM_7=$ECPM_7,ECPM_14=$ECPM_14,Coverage_Raw_7=$Coverage_Raw_7,Coverage_Raw_14=$Coverage_Raw_14,CPC_7=$CPC_7,CPC_14=$CPC_14 ,Years=$Years ,Months=$Months,Days=$Days,Weeks=$Weeks ,YearMonth=$YearMonth ,WeekS_NO=$WeekS_NO  ";


?>