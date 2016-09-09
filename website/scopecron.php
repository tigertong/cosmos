<?php

$command_url = "C:/BingAds/tools/ScopeSDK/Scope.exe submit -i C:\BingAds\CODE\ScopeApplicationForSougou\ScopeApplicationForSougou\BasicRawData.script -vc https://cosmos08.osdinfra.net/cosmos/bingads.marketplace.VC2/ " ;
echo $command_url;
exec($command_url);

$command_url1 = "C:/BingAds/tools/ScopeSDK/Scope.exe submit -i C:\BingAds\CODE\ScopeApplicationForSougou\ScopeApplicationForSougou\ScopeBasicDataExtraction.script -vc https://cosmos08.osdinfra.net/cosmos/bingads.marketplace.VC2/ " ;

echo $command_url1;
exec($command_url1);

echo "completed";

?>
