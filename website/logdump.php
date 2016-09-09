<?php

if(!isset($argv[1]) || !isset($argv[2])){
$datemonth = date('Ym',strtotime("-2 day")); 
$date = date('Y-m-d',strtotime("-2 day")); 
}else{
$datemonth = $argv[1];
$date = $argv[2];
}

$_localpath="C:/BingAds";


$command_url = "$_localpath/tools/ScopeSDK/Scope.exe copy https://cosmos08.osdinfra.net/cosmos/bingads.marketplace.VC1/users/mmaisda/sogouads/$datemonth/SRPVFileFiltered_$date.csv   $_localpath/logs/SRPVFileFiltered_$date.csv  "  ;
echo $command_url;
exec($command_url);

$command_url1 = "$_localpath/tools/ScopeSDK/Scope.exe  copy https://cosmos08.osdinfra.net/cosmos/bingads.marketplace.VC1/users/mmaisda/sogouads/$datemonth/SumFile_$date.csv     $_localpath/logs/SumFile_$date.csv  "  ;
echo $command_url1;
exec($command_url1);

$command_url2 = "$_localpath/tools/ScopeSDK/Scope.exe  copy https://cosmos08.osdinfra.net/cosmos/bingads.marketplace.VC1/users/mmaisda/sogouads/DSQ/DSQ_$date.csv   $_localpath/logs/DSQ_$date.csv "  ;
echo $command_url2;
exec($command_url2);

?>
