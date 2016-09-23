<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Upload page</title>
<style type="text/css">
body {
	background: #E3F4FC;
	font: normal 14px/30px Helvetica, Arial, sans-serif;
	color: #2b2b2b;
}
a {
	color:#898989;
	font-size:14px;
	font-weight:bold;
	text-decoration:none;
}
a:hover {
	color:#CC0033;
}

h1 {
	font: bold 14px Helvetica, Arial, sans-serif;
	color: #CC0033;
}
h2 {
	font: bold 14px Helvetica, Arial, sans-serif;
	color: #898989;
}
#container {
	background: #CCC;
	margin: 100px auto;
	width: 945px;
}
#form 			{padding: 20px 150px;}
#form input     {margin-bottom: 20px;}
</style>
</head>
<body>
<div id="container">
<div id="form">

<?php
function startWith($str, $needle) {

    return strpos($str, $needle) === 0;

}

require_once("./db.conf.php");
$dbname = $_REQUEST["dbname"];
//echo $dbname; 
//Upload File
if (isset($_POST['submit'])) {
	if (is_uploaded_file($_FILES['filename']['tmp_name'])) {
		echo "<h1>" . "File ". $_FILES['filename']['name'] ." uploaded successfully." . "</h1>";
		//echo "<h2>Displaying contents:</h2>";
		//readfile($_FILES['filename']['tmp_name']);
	}

	//Import uploaded file to Database
	$handle = fopen($_FILES['filename']['tmp_name'], "r");
	echo $_FILES['filename']['name'];

	$file = fopen($_FILES['filename']['tmp_name'],"r");
	$conts = file_get_contents($_FILES['filename']['tmp_name']);
	$arrConts = explode("\n",$conts);
	foreach($arrConts as $cont){
		if($cont== NULL) continue;
		$cont = str_replace("'","\'",$cont);
		$data = explode("	",$cont); 
		$date=explode(" ", $data[0]);
		$time = strtotime($date[0]);
		$newformat = date('Y-m-d',$time);
		
		//$newformat = "2016-08-24";
		
		if($dbname=="statinfo"){

			$import="insert into $dbname (date ,IP_COUNT ,REFFER_COUNT,ROWQUERY_COUNT ,UA_COUNT ) values ('$newformat','$data[1]','$data[2]','$data[3]','$data[4]')";
		} else if($dbname=="IPinfo"){

			$import="insert into $dbname (date ,User_Ip,NUMBEROFIP,  User_CountryIso,User_State,User_City,User_Lat,User_Long  ) values ('$newformat','$data[1]','$data[2]','$data[3]','$data[4]','$data[5]','$data[6]','$data[7]')";
			
			//sql with the format no date
			//$import="insert into $dbname (date ,User_Ip,NUMBEROFIP,  User_CountryIso,User_State,User_City,User_Lat,User_Long  ) values ('$newformat','$data[0]','$data[1]','$data[2]','$data[3]','$data[4]','$data[5]','$data[6]')";
			
		}
		else if($dbname=="UAinfo"){

			$import="insert into $dbname (date ,Request_UserAgent  , NUMBEROFUA  ) values ('$newformat','$data[1]','$data[2]')";
			//sql with the format no date
			//$import="insert into $dbname (date ,Request_UserAgent  , NUMBEROFUA  ) values ('$newformat','$data[0]','$data[1]')";
		}else if($dbname=="RFinfo"){

			$import="insert into $dbname (date ,Request_Referrer  , NUMBEROFRF  ) values ('$newformat','$data[1]','$data[2]')";
			//sql with the format no date
			//$import="insert into $dbname (date ,Request_Referrer  , NUMBEROFRF  ) values ('$newformat','$data[0]','$data[1]')";
			
		}else if($dbname=="RFDomaininfo"){

			$import="insert into $dbname (date ,Request_Domain  , NUMBEROFRF  ) values ('$newformat','$data[1]','$data[2]')";
			//sql with the format no date
			//$import="insert into $dbname (date ,Request_Referrer  , NUMBEROFRF  ) values ('$newformat','$data[0]','$data[1]')";
			
		}else if($dbname=="QUinfo"){

			$import="insert into $dbname (date ,Query_RawQuery  , NUMBEROFQU  ) values ('$newformat','$data[1]','$data[2]')";
			//sql with the format no date
			//$import="insert into $dbname (date ,Query_RawQuery  , NUMBEROFQU  ) values ('$newformat','$data[0]','$data[1]')";
		}else if($dbname=="Stateinfo"){

			$import="insert into $dbname (date,User_CountryIso,User_State  ,NUMBEROFIP  ) values ('$newformat','$data[1]','$data[2]','$data[3]')";
			//sql with the format no date
			//$import="insert into $dbname (date ,Query_RawQuery  , NUMBEROFQU  ) values ('$newformat','$data[0]','$data[1]')";
		}else if($dbname=="FromCodeinfo"){

			$import="insert into $dbname (date,fromcode,NUMBEROFFC    ) values ('$newformat','$data[1]','$data[2]' )";
			//sql with the format no date
			//$import="insert into $dbname (date ,Query_RawQuery  , NUMBEROFQU  ) values ('$newformat','$data[0]','$data[1]')";
		}else if($dbname=="Locationinfo"){

			$import="insert into $dbname (date,User_CountryIso,User_State  , User_City  , User_Lat ,User_Long  ,NUMBEROFIP  ) values ('$newformat','$data[1]','$data[2]','$data[3]','$data[4]','$data[5]','$data[6]')";
			//sql with the format no date
			//$import="insert into $dbname (date ,Query_RawQuery  , NUMBEROFQU  ) values ('$newformat','$data[0]','$data[1]')";
		}else if($dbname=="SumFileinfo"){
		//DSQ_2016-08-05.ss
		    $datename = explode(".",$_FILES['filename']['name'])[0];
			 
			$newformat = explode("_",$datename)[1];
			//echo $datename ."-------".$newformat ;
			if($newformat=="")$newformat = "2016-08-24";
		
			if (startWith($_FILES['filename']['name'],"SRPVFileFiltered")){
			//SRPVFileFiltered_2016-08-25.csv
			$import="INSERT $dbname (date ,SRPV_filtered  ,Impressions_filtered ,Clicks_filtered  ) values ('$newformat', '$data[0]','$data[1]','$data[2]') ON DUPLICATE KEY UPDATE SRPV_filtered ='$data[0]' ,Impressions_filtered ='$data[1]' ,Clicks_filtered = '$data[2]'";
			}else if (startWith($_FILES['filename']['name'],"SumFile")){
			//SumFile_2016-08-25.csv  
			$import="INSERT $dbname (date   ,  SRPV   , Impressions   , Clicks    ) values ('$newformat', '$data[0]','$data[1]','$data[2]') ON DUPLICATE KEY UPDATE SRPV ='$data[0]' ,Impressions ='$data[1]' ,Clicks = '$data[2]'";
			}
			else if (startWith($_FILES['filename']['name'],"DSQ")){
			//DSQ_2016-08-25.ss
			$import="INSERT $dbname (date   ,  DSQ  ) values ('$newformat', '$data[0]' ) ON DUPLICATE KEY UPDATE DSQ ='$data[0]'  ";
			}
			
			//sql with the format no date
			//$import="insert into $dbname (date ,Query_RawQuery  , NUMBEROFQU  ) values ('$newformat','$data[0]','$data[1]')";
		}else if($dbname=="Sogou_data"){
		 ////
		 ////
		 
		 
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
$CPC_7 =  ($CPC -$CPC_1weekago )/$CPC_1weekago ; //’=(Day8有效点击量-Day1有效点击量)/Day1有效点击量示
}
if($CPC_2weekago==0){$CPC_14 = 0;}
else{
$CPC_14 =  ($CPC -$CPC_2weekago )/$CPC_2weekago ; //’=(Day15有效点击量Day1有效点击量)/Day1有效点击量展示量
}

$Years = date("Y", strtotime($newformat));
$Months = date("m", strtotime($newformat));
$Days = date("d", strtotime($newformat));
$Weeks = date("W", strtotime($newformat));
$YearMonth = date("Ym", strtotime($newformat));
$WeekS_NO = date("w", strtotime($newformat));


$import="INSERT Sogou_data (date,SRPV_Raw  , SRPV_Anti_fraud , Revenue ,Impressions_Raw	 ,Impressions_Anti_fraud  ,Clicks_Raw	  ,Clicks_Anti_fraud   ,Coverage_Raw	 ,Coverage_Anti_fraud  ,CTR  ,ECPM  ,CPC    ,Revenue_7 ,Revenue_14 ,SRPV_7 ,SRPV_14 , Impressions_7 ,Impressions_14 ,Clicks_7 ,Clicks_14 ,ECPM_7 ,ECPM_14 ,Coverage_Raw_7 ,Coverage_Raw_14 ,CPC_7 ,CPC_14 ,Years ,Months,Days,Weeks ,YearMonth ,WeekS_NO  ) values ( '$newformat',$SRPV_Raw  , $SRPV_Anti_fraud , $Revenue ,$Impressions_Raw	 ,$Impressions_Anti_fraud  ,$Clicks_Raw	  ,$Clicks_Anti_fraud   ,$Coverage_Raw	 ,$Coverage_Anti_fraud  ,$CTR  ,$ECPM  ,$CPC    ,$Revenue_7 ,$Revenue_14 ,$SRPV_7 ,$SRPV_14 , $Impressions_7 ,$Impressions_14 ,$Clicks_7 ,$Clicks_14 ,$ECPM_7 ,$ECPM_14 ,$Coverage_Raw_7 ,$Coverage_Raw_14 ,$CPC_7 ,$CPC_14 ,$Years ,$Months,$Days,$Weeks ,$YearMonth ,$WeekS_NO ) ON DUPLICATE KEY UPDATE SRPV_Raw=$SRPV_Raw,SRPV_Anti_fraud=$SRPV_Anti_fraud,Revenue=$Revenue,Impressions_Raw	=$Impressions_Raw	,Impressions_Anti_fraud=$Impressions_Anti_fraud,Clicks_Raw	=$Clicks_Raw	,Clicks_Anti_fraud=$Clicks_Anti_fraud,Coverage_Raw	=$Coverage_Raw	,Coverage_Anti_fraud=$Coverage_Anti_fraud,CTR=$CTR,ECPM=$ECPM,CPC=$CPC,Revenue_7=$Revenue_7,Revenue_14=$Revenue_14,SRPV_7=$SRPV_7,SRPV_14=$SRPV_14,Impressions_7=$Impressions_7,Impressions_14=$Impressions_14,Clicks_7=$Clicks_7,Clicks_14=$Clicks_14,ECPM_7=$ECPM_7,ECPM_14=$ECPM_14,Coverage_Raw_7=$Coverage_Raw_7,Coverage_Raw_14=$Coverage_Raw_14,CPC_7=$CPC_7,CPC_14=$CPC_14 ,Years=$Years ,Months=$Months,Days=$Days,Weeks=$Weeks ,YearMonth=$YearMonth ,WeekS_NO=$WeekS_NO  ";
		 
		 
		 
		 ////
		 ////
		}


		
		echo $i.$import;
		$i++;
		mysqli_query($db,$import) or die(mysql_error());
	}
	fclose($handle);
	mysql_close($db);
	/*while(! feof($file))
	{
     $dataLine = fgets($file, 4096000);

		$data = explode("	", $dataLine); 
		$date = explode(" ", $data[0]);

		$date=explode(" ", $data[0]);
		$time = strtotime($date[0]);
		$newformat = date('Y-m-d',$time);
		print_r($data);
		if($dbname=="statinfo"){

			$import="insert into $dbname (date ,IP_COUNT ,REFFER_COUNT,ROWQUERY_COUNT ,UA_COUNT ) values ('$newformat','$data[1]','$data[2]','$data[3]','$data[4]')";
		} else if($dbname=="IPinfo"){

			$import="insert into $dbname (date ,User_Ip,NUMBEROFIP,  User_CountryIso,User_State,User_City,User_Lat,User_Long  ) values ('$newformat','$data[1]','$data[2]','$data[3]','$data[4]','$data[5]','$data[6]','$data[7]')";
		}
		else if($dbname=="UAinfo"){

			$import="insert into $dbname (date ,Request_UserAgent  , NUMBEROFUA  ) values ('$newformat','$data[1]','$data[2]')";
		}else if($dbname=="RFinfo"){

			$import="insert into $dbname (date ,Request_Referrer  , NUMBEROFRF  ) values ('$newformat','$data[1]','$data[2]')";
		}else if($dbname=="QUinfo"){

			$import="insert into $dbname (date ,Query_RawQuery  , NUMBEROFQU  ) values ('$newformat','$data[1]','$data[2]')";
		}
		echo $import;
		mysqli_query($db,$import) or die(mysql_error());
		
	}

	fclose($file);*/
	//fclose($handle);

	print "Import done";

	//view upload form
}else {

	print "Upload new csv by browsing to file and clicking on Upload<br />\n";

	print "<form enctype='multipart/form-data' action='inputdata.php' method='post'>";

	print "File name to import:<br />\n";

	print "<input size='50' type='file' name='filename'><br />\n";

	print "<input type='submit' name='submit' value='Upload'>\n\n";
	print  "<label> <input type='radio' name='dbname' value='statinfo' checked='checked' />  statinfo</label><br>";
	print "<label> <input type='radio' name='dbname' value='IPinfo' />  IPinfo</label>";
	print "<label> <input type='radio' name='dbname' value='Stateinfo' />  Stateinfo State_GROUPBY_Distribution</label>";
	print "<label> <input type='radio' name='dbname' value='Locationinfo' />  Locationinfo TOP_GROUPBY_Location_Distribution </label><br>";
	print "<label>  <input type='radio' name='dbname' value='UAinfo' />  UAinfo</label>";
	print "<label>  <input type='radio' name='dbname' value='RFinfo' />  RFinfo RFDistribution </label>";
	print "<label>  <input type='radio' name='dbname' value='RFDomaininfo' />  RFinfo RFDomainDistribution  </label><br>";
	
	print "<label>  <input type='radio' name='dbname' value='FromCodeinfo' />  FromCodeinfo   </label>";
	print "<label>  <input type='radio' name='dbname' value='QUinfo' />  QUinfo</label>";
	print "<label>  <input type='radio' name='dbname' value='SumFileinfo' />  SumFileinfo</label><br>";
	print "<label>  <input type='radio' name='dbname' value='Sogou_data' />  Sogou_data</label></form>";
	
}

?>

</div>
</div>
</body>
</html>
