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

$date = $_GET['date'];
$datemonth = $_GET['datemonth'];


//$_localpath="C:/BingAds";
$_localpath="C:/Work_Env/BingAds";
$_logfolder="$_localpath/logs/";
$_logfolder_done="$_localpath/logs_done/";

 
$command_url0 = " $_localpath/tools/ScopeSDK/Scope.exe copy     https://cosmos08.osdinfra.net/cosmos/bingads.marketplace.VC1/users/tigertong/sogouads/2016result/FCDistribution_$date.csv	                        $_localpath/logs/FCDistribution_$date.csv	                   ";
$command_url1 = " $_localpath/tools/ScopeSDK/Scope.exe copy     https://cosmos08.osdinfra.net/cosmos/bingads.marketplace.VC1/users/tigertong/sogouads/2016result/IPSumFile_$date.csv	                            $_localpath/logs/IPSumFile_$date.csv	                       ";
$command_url2 = " $_localpath/tools/ScopeSDK/Scope.exe copy     https://cosmos08.osdinfra.net/cosmos/bingads.marketplace.VC1/users/tigertong/sogouads/2016result/QUDistribution_$date.csv	                        $_localpath/logs/QUDistribution_$date.csv	                   ";
$command_url3 = " $_localpath/tools/ScopeSDK/Scope.exe copy     https://cosmos08.osdinfra.net/cosmos/bingads.marketplace.VC1/users/tigertong/sogouads/2016result/RFDistribution_$date.csv	                        $_localpath/logs/RFDistribution_$date.csv	                   ";
$command_url4 = " $_localpath/tools/ScopeSDK/Scope.exe copy     https://cosmos08.osdinfra.net/cosmos/bingads.marketplace.VC1/users/tigertong/sogouads/2016result/RFDomainDistribution_$date.csv	                $_localpath/logs/RFDomainDistribution_$date.csv	               ";
$command_url5 = " $_localpath/tools/ScopeSDK/Scope.exe copy     https://cosmos08.osdinfra.net/cosmos/bingads.marketplace.VC1/users/tigertong/sogouads/2016result/State_GROUPBY_Distribution_$date.csv	            $_localpath/logs/State_GROUPBY_Distribution_$date.csv	       ";
$command_url6 = " $_localpath/tools/ScopeSDK/Scope.exe copy     https://cosmos08.osdinfra.net/cosmos/bingads.marketplace.VC1/users/tigertong/sogouads/2016result/TOP_GROUPBY_Location_Distribution_$date.csv	    $_localpath/logs/TOP_GROUPBY_Location_Distribution_$date.csv   ";
$command_url7 = " $_localpath/tools/ScopeSDK/Scope.exe copy     https://cosmos08.osdinfra.net/cosmos/bingads.marketplace.VC1/users/tigertong/sogouads/2016result/TOP_IP_GROUPBY_Distribution_$date.csv	        $_localpath/logs/TOP_IP_GROUPBY_Distribution_$date.csv	       ";
$command_url8 = " $_localpath/tools/ScopeSDK/Scope.exe copy     https://cosmos08.osdinfra.net/cosmos/bingads.marketplace.VC1/users/tigertong/sogouads/2016result/UADistribution_$date.csv                         $_localpath/logs/UADistribution_$date.csv                      ";

/*echo $command_url0;  exec($command_url0);
echo $command_url1;  exec($command_url1);
echo $command_url2;  exec($command_url2);
echo $command_url3;  exec($command_url3);
echo $command_url4;  exec($command_url4);
echo $command_url5;  exec($command_url5);
echo $command_url6;  exec($command_url6);
echo $command_url7;  exec($command_url7);
echo $command_url8;  exec($command_url8);*/
	


$dir = $_logfolder;
require_once($_localpath."/CODE/website/db.conf.php");

// Open a known directory, and proceed to read its contents

if(file_exists("$_localpath/logs/FCDistribution_$date.csv")) {
echo "-------FCDistribution_-------- <br>";
	file_handle("$_localpath/logs/FCDistribution_$date.csv",$db);                                
}     
if(file_exists("$_localpath/logs/IPSumFile_$date.csv"))	{
echo "-------IPSumFile_-------- <br>";
	file_handle("$_localpath/logs/IPSumFile_$date.csv",$db);                                     
}
if(file_exists("$_localpath/logs/QUDistribution_$date.csv")){
echo "-------QUDistribution_-------- <br>";
	file_handle("$_localpath/logs/QUDistribution_$date.csv",$db);                               
 }
if(file_exists("$_localpath/logs/RFDistribution_$date.csv")){
echo "-------RFDistribution_-------- <br>";
	file_handle("$_localpath/logs/RFDistribution_$date.csv",$db);                                
}
if(file_exists("$_localpath/logs/RFDomainDistribution_$date.csv")){
echo "-------RFDomainDistribution_-------- <br>";
	file_handle("$_localpath/logs/RFDomainDistribution_$date.csv",$db);                          
}
if(file_exists("$_localpath/logs/State_GROUPBY_Distribution_$date.csv")){
echo "-------State_GROUPBY_Distribution_-------- <br>";
	file_handle("$_localpath/logs/State_GROUPBY_Distribution_$date.csv",$db);                   
}
if(file_exists("$_localpath/logs/TOP_GROUPBY_Location_Distribution_$date.csv")){
echo "-------TOP_GROUPBY_Location_Distribution_-------- <br>";
	file_handle("$_localpath/logs/TOP_GROUPBY_Location_Distribution_$date.csv",$db);             
}
if(file_exists("$_localpath/logs/TOP_IP_GROUPBY_Distribution_$date.csv")){
echo "-------TOP_IP_GROUPBY_Distribution_-------- <br>";
	file_handle("$_localpath/logs/TOP_IP_GROUPBY_Distribution_$date.csv",$db);                   
}
if(file_exists("$_localpath/logs/UADistribution_$date.csv")){
echo "-------UADistribution_-------- <br>";
	file_handle("$_localpath/logs/UADistribution_$date.csv",$db);                                
}

function file_handle($filename,$db){
//echo $filename;
	
	$conts = file_get_contents($filename);
	$arrConts = explode("\n",$conts);
	//print_r($arrConts);
	$i=0;
	foreach($arrConts as $cont){
		if($cont== NULL) continue;
		if($i>=1000) break;
		$cont = str_replace("\\","",$cont);
		$cont = str_replace("'","\'",$cont);
		$data = explode("	",$cont); 
		$filecheckArr=explode("/", $filename);
		$filecheck = $filecheckArr[count($filecheckArr)-1];
		$datename_tmp = explode(".",$filecheck)[0];
			 
	    $temp_arr = explode("_",$datename_tmp);
		$temp_arr_len = count($temp_arr);
		$newformat = $temp_arr[$temp_arr_len-1];
		if($newformat=="")$newformat = "2016-08-24";
		
		
		
		if(startWith($filecheck,"IPSumFile")){

			$import="insert into statinfo (date ,IP_COUNT ,REFFER_COUNT,ROWQUERY_COUNT ,UA_COUNT ) values ('$newformat','$data[1]','$data[2]','$data[3]','$data[4]')";
		} else if(startWith($filecheck,"TOP_IP_GROUPBY_Distribution")){  // if($dbname=="IPinfo"){

			$import="insert into IPinfo (date ,User_Ip,NUMBEROFIP,  User_CountryIso,User_State,User_City,User_Lat,User_Long  ) values ('$newformat','$data[1]','$data[2]','$data[3]','$data[4]','$data[5]','$data[6]','$data[7]')";
			//sql with the format no date
			//$import="insert into $dbname (date ,User_Ip,NUMBEROFIP,  User_CountryIso,User_State,User_City,User_Lat,User_Long  ) values ('$newformat','$data[0]','$data[1]','$data[2]','$data[3]','$data[4]','$data[5]','$data[6]')";
			
		}
		else if(startWith($filecheck,"UADistribution")){  //if($dbname=="UAinfo"){

			$import="insert into UAinfo (date ,Request_UserAgent  , NUMBEROFUA  ) values ('$newformat','$data[1]','$data[2]')";
			//sql with the format no date
			//$import="insert into $dbname (date ,Request_UserAgent  , NUMBEROFUA  ) values ('$newformat','$data[0]','$data[1]')";
		}else if(startWith($filecheck,"RFDistribution")){  //if($dbname=="RFinfo"){

			$import="insert into RFinfo (date ,Request_Referrer  , NUMBEROFRF  ) values ('$newformat','$data[1]','$data[2]')";
			//sql with the format no date
			//$import="insert into $dbname (date ,Request_Referrer  , NUMBEROFRF  ) values ('$newformat','$data[0]','$data[1]')";
			
		}else if(startWith($filecheck,"RFDomainDistribution")){  // if($dbname=="RFDomaininfo"){

			$import="insert into RFDomaininfo (date ,Request_Domain  , NUMBEROFRF  ) values ('$newformat','$data[1]','$data[2]')";
			//sql with the format no date
			//$import="insert into $dbname (date ,Request_Referrer  , NUMBEROFRF  ) values ('$newformat','$data[0]','$data[1]')";
			
		}else if(startWith($filecheck,"QUDistribution")){  // if($dbname=="QUinfo"){

			$import="insert into QUinfo (date ,Query_RawQuery  , NUMBEROFQU  ) values ('$newformat','$data[1]','$data[2]')";
			//sql with the format no date
			//$import="insert into $dbname (date ,Query_RawQuery  , NUMBEROFQU  ) values ('$newformat','$data[0]','$data[1]')";
		}else if(startWith($filecheck,"State_GROUPBY_Distribution")){  //if($dbname=="Stateinfo"){

			$import="insert into Stateinfo (date,User_CountryIso,User_State  ,NUMBEROFIP  ) values ('$newformat','$data[1]','$data[2]','$data[3]')";
			//sql with the format no date
			//$import="insert into $dbname (date ,Query_RawQuery  , NUMBEROFQU  ) values ('$newformat','$data[0]','$data[1]')";
		}else  if(startWith($filecheck,"FCDistribution")){  //if($dbname=="FromCodeinfo"){

			$import="insert into FromCodeinfo (date,fromcode,NUMBEROFFC    ) values ('$newformat','$data[1]','$data[2]' )";
			//sql with the format no date
			//$import="insert into $dbname (date ,Query_RawQuery  , NUMBEROFQU  ) values ('$newformat','$data[0]','$data[1]')";
		}else if(startWith($filecheck,"TOP_GROUPBY_Location_Distribution")){  //if($dbname=="Locationinfo"){

			$import="insert into Locationinfo (date,User_CountryIso,User_State  , User_City  , User_Lat ,User_Long  ,NUMBEROFIP  ) values ('$newformat','$data[1]','$data[2]','$data[3]','$data[4]','$data[5]','$data[6]')";
			//sql with the format no date
			//$import="insert into $dbname (date ,Query_RawQuery  , NUMBEROFQU  ) values ('$newformat','$data[0]','$data[1]')";
		}
		echo $i.$import;
		$i++;
		mysqli_query($db,$import) or die(mysql_error());
	}
	
}
	//sql with the format no date
	//$import="insert into $dbname (date ,Query_RawQuery  , NUMBEROFQU  ) values ('$newformat','$data[0]','$data[1]')";
		

mysql_close($db);
?>
