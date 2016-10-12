<?php

function startWith($str, $needle) {
    return strpos($str, $needle) === 0;
}

if(!isset($argv[1]) || !isset($argv[2])){
$datemonth = date('Ym',strtotime("-5 day")); 
$date = date('Y-m-d',strtotime("-5 day")); 
}else{
$datemonth = $argv[1];
$date = $argv[2];
}


if(isset($_GET['date']) && isset($_GET['datemonth'])){
	$date = $_GET['date'];
	$datemonth = $_GET['datemonth'];
}


	$date = $_GET['date'];
	$datemonth = $_GET['datemonth'];


//$_localpath="C:/BingAds";
$_localpath="C:/Work_Env/BingAds";
$_logfolder="$_localpath/logs/";
$_logfolder_done="$_localpath/logs_done/";

$command_url = "$_localpath/tools/ScopeSDK/Scope.exe copy https://cosmos08.osdinfra.net/cosmos/bingads.marketplace.VC1/users/mmaisda/sogouads/$datemonth_test/SRPVFileFiltered_$date.csv   $_localpath/logs/SRPVFileFiltered_$date.csv  "  ;
echo $command_url;
exec($command_url);

$command_url1 = "$_localpath/tools/ScopeSDK/Scope.exe  copy https://cosmos08.osdinfra.net/cosmos/bingads.marketplace.VC1/users/mmaisda/sogouads/$datemonth_test/SumFile_$date.csv     $_localpath/logs/SumFile_$date.csv  "  ;
echo $command_url1;
exec($command_url1);

$command_url2 = "$_localpath/tools/ScopeSDK/Scope.exe  copy https://cosmos08.osdinfra.net/cosmos/bingads.marketplace.VC1/users/mmaisda/sogouads/DSQ_test/DSQ_$date.csv   $_localpath/logs/DSQ_$date.csv "  ;
echo $command_url2;
exec($command_url2);



$dir = $_logfolder;
require_once("C:/Work_Env/BingAds/GIT/website/db.conf.php");

// Open a known directory, and proceed to read its contents
if(file_exists("$_localpath/logs/DSQ_$date.csv"))
{    
	file_handle("$_localpath/logs/DSQ_$date.csv",$db);
}
if(file_exists("$_localpath/logs/SumFile_$date.csv"))
{    
	file_handle("$_localpath/logs/SumFile_$date.csv",$db);
}
if(file_exists("$_localpath/logs/SRPVFileFiltered_$date.csv"))
{    
	file_handle("$_localpath/logs/SRPVFileFiltered_$date.csv",$db);
}

function file_handle($filename,$db){
//echo $filename;
	$conts = file_get_contents($filename);
	$arrConts = explode("\n",$conts);
	print_r($arrConts);
	foreach($arrConts as $cont){
		if($cont== NULL) continue;
		$cont = str_replace("'","\'",$cont);
		$data = explode("	",$cont); 
		$filecheckArr=explode("/", $filename);
		$filecheck = $filecheckArr[count($filecheckArr)-1];
		$datename_tmp = explode(".",$filecheck)[0];
			 
		$newformat = explode("_",$datename_tmp)[1];
		if($newformat=="")$newformat = "2016-08-24";
		

		echo "-------$filecheck-----------".startWith($filecheck,"DSQ");
		if (startWith($filecheck,"SRPVFileFiltered")){
		//SRPVFileFiltered_2016-08-25.csv
		$import="INSERT SumFileinfo (date ,SRPV_filtered  ,Impressions_filtered ,Clicks_filtered  ) values ('$newformat', '$data[0]','$data[1]','$data[2]') ON DUPLICATE KEY UPDATE SRPV_filtered ='$data[0]' ,Impressions_filtered ='$data[1]' ,Clicks_filtered = '$data[2]'";
		}else if (startWith($filecheck,"SumFile")){
		//SumFile_2016-08-25.csv  
		$import="INSERT SumFileinfo (date   ,  SRPV   , Impressions   , Clicks    ) values ('$newformat', '$data[0]','$data[1]','$data[2]') ON DUPLICATE KEY UPDATE SRPV ='$data[0]' ,Impressions ='$data[1]' ,Clicks = '$data[2]'";
		}
		else if (startWith($filecheck,"DSQ")){
		//DSQ_2016-08-25.ss
		$import="INSERT SumFileinfo (date   ,  DSQ  ) values ('$newformat', '$data[0]' ) ON DUPLICATE KEY UPDATE DSQ ='$data[0]'  ";
		}
				
		echo $import;
		mysqli_query($db,$import) or die(mysql_error());
	}
	
}
	//sql with the format no date
	//$import="insert into $dbname (date ,Query_RawQuery  , NUMBEROFQU  ) values ('$newformat','$data[0]','$data[1]')";
		

mysql_close($db);
?>
