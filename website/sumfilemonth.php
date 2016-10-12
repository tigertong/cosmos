<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>stats</title>
	<link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="./css/style.css">
<script src="./css/hm.js"></script><script src="./css/share.js"></script><link rel="stylesheet" href="./css/share_style0_24.css">
<style type="text/css">
<!--
.STYLE1 {color: #FF0000}
-->
</style>
</head>
		<!--script type="text/javascript" src="http://cdn.hcharts.cn/jquery/jquery-1.8.3.min.js"></script-->
		
		<!-- Bootstrap -->
			<!--link href="Linear-Regression/bootstrap/css/bootstrap.min.css" rel="stylesheet"-->

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
	
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="Linear-Regression/bootstrap/js/jquery-1.11.3.min.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="Linear-Regression/bootstrap/js/bootstrap.min.js"></script>
		<script type="text/javascript"src="Linear-Regression/js/jquery.flot.min.js"></script>
		<script type="text/javascript"src="Linear-Regression/js/regression.min.js"></script>
		<script type="text/javascript" src="Linear-Regression/js/MathJax.js?config=AM_HTMLorMML-full"></script>
				
		
		
		<style type="text/css">
${demo.css}
		</style>
	<?php
$contentdate = $_GET["date"];	
require_once("./db.conf.php");
echo $_GET['submit'].$_GET['startdate'].$_GET["stopdate"];
$startdate = "2016-08-05";
$stopdate = "2016-09-05";

if (isset($_GET["submit"]) && isset($_GET["startdate"]) && isset($_GET["stopdate"])) {
$startdate = $_GET["startdate"];
$stopdate = $_GET["stopdate"];

$categories="1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31";

$number=1;
$result = mysqli_query($db,"SELECT *  FROM sumfileinfo A , Sogou_data B where A.date=B.date and A.date>='$startdate'  and  A.date<='$stopdate' order by B.YearMonth,B.Days asc");



$SRPV_filtered = "";
$SRPV = "";
$Impressions_filtered="";
$Impressions="";
$Clicks_filtered="";
$Clicks="";
$DSQ="";
$SRPV_Raw = "";
$SRPV_Anti_fraud = "";
$Impressions_Raw="";
$Impressions_Anti_fraud="";
$Clicks_Raw="";
$Clicks_Anti_fraud="";

$DATA_ARR = array();
$num=0;
$YearMonth=0;

while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
 {
 
if($YearMonth == 0 || $YearMonth == $row['YearMonth']){}else {$num++;}
 $DATA_ARR[$num]['YearMonth']=$row['YearMonth'];
 $DATA_ARR[$num]['SRPV'][$row['Days']]=$row['SRPV'];
 $DATA_ARR[$num]['SRPV_Raw'][$row['Days']]=$row['SRPV_Raw'];
 $DATA_ARR[$num]['SRPV_filtered'][$row['Days']]=$row['SRPV_filtered'];
 $DATA_ARR[$num]['SRPV_Anti_fraud'][$row['Days']]=$row['SRPV_Anti_fraud'];
 $DATA_ARR[$num]['DSQ'][$row['Days']]=$row['DSQ'];
 $DATA_ARR[$num]['Impressions'][$row['Days']]=$row['Impressions'];
 $DATA_ARR[$num]['Impressions_Raw'][$row['Days']]=$row['Impressions_Raw']; 
 $DATA_ARR[$num]['Impressions_filtered'][$row['Days']]=$row['Impressions_filtered'];
 $DATA_ARR[$num]['Impressions_Anti_fraud'][$row['Days']]=$row['Impressions_Anti_fraud'];  
 $DATA_ARR[$num]['Clicks'][$row['Days']]=$row['Clicks'];
 $DATA_ARR[$num]['Clicks_Raw'][$row['Days']]=$row['Clicks_Raw']; 
 $DATA_ARR[$num]['Clicks_filtered'][$row['Days']]=$row['Clicks_filtered'];
 $DATA_ARR[$num]['Clicks_Anti_fraud'][$row['Days']]=$row['Clicks_Anti_fraud'];
 $DATA_ARR[$num]['ECPM'][$row['Days']]=$row['ECPM'];
 $DATA_ARR[$num]['Revenue'][$row['Days']]=$row['Revenue'];
 
 
 $YearMonth = $row['YearMonth']; 


$SRPV_filtered .= "".$row['SRPV_filtered'].",";
$SRPV  .= "".$row['SRPV'].",";
$Impressions_filtered  .= "".$row['Impressions_filtered'].",";
$Impressions  .= "".$row['Impressions'].",";
$Clicks_filtered  .= "".$row['Clicks_filtered'].",";
$Clicks  .= "".$row['Clicks'].",";
$DSQ  .= "".$row['DSQ'].",";
$SRPV_Raw .= "".$row['SRPV_Raw'].",";
$SRPV_Anti_fraud  .= "".$row['SRPV_Anti_fraud'].",";
$Impressions_Raw  .= "".$row['Impressions_Raw'].",";
$Impressions_Anti_fraud  .= "".$row['Impressions_Anti_fraud'].",";
$Clicks_Raw  .= "".$row['Clicks_Raw'].",";
$Clicks_Anti_fraud  .= "".$row['Clicks_Anti_fraud'].",";


//$categories	 .= "'".$row['date']."',";

if($SRPV_filtered == NULL )$SRPV_filtered=0;
if($SRPV == NULL)$SRPV=0;
if($Impressions_filtered=="")$Impressions_filtered=0;
if($Impressions=="")$Impressions=0;
if($Clicks_filtered=="")$Clicks_filtered=0;
if($Clicks=="")$Clicks=0;
if($DSQ=="")$DSQ=0;
if($SRPV_Raw == NULL )$SRPV_Raw=0;
if($SRPV_Anti_fraud == NULL)$SRPV_Anti_fraud=0;
if($Impressions_Raw=="")$Impressions_Raw=0;
if($Impressions_Anti_fraud=="")$Impressions_Anti_fraud=0;
if($Clicks_Raw=="")$Clicks_Raw=0;
if($Clicks_Anti_fraud=="")$Clicks_Anti_fraud=0;



$SRPV_Linear .= "[".$number.",".$row['SRPV']."],";
$SRPV_filtered_Linear .= "[".$number.",".$row['SRPV_filtered']."],";
$DSQ_Linear .= "[".$number.",".$row['DSQ']."],";
$Impressions_Linear .= "[".$number.",".$row['Impressions']."],";
$Impressions_filtered_Linear .= "[".$number.",".$row['Impressions_filtered']."],";
$Clicks_Linear .= "[".$number.",".$row['Clicks']."],";
$Clicks_filtered_Linear .= "[".$number.",".$row['Clicks_filtered']."],";
$SRPV_Raw_Linear .= "[".$number.",".$row['SRPV_Raw']."],";
$SRPV_Anti_fraud_Linear .= "[".$number.",".$row['SRPV_Anti_fraud']."],";
$Impressions_Raw_Linear .= "[".$number.",".$row['Impressions_Raw']."],";
$Impressions_Anti_fraud_Linear .= "[".$number.",".$row['Impressions_Anti_fraud']."],";
$Clicks_Raw_Linear .= "[".$number.",".$row['Clicks_Raw']."],";
$Clicks_Anti_fraud_Linear .= "[".$number.",".$row['Clicks_Anti_fraud']."],";

$number++;
}

$SRPV_filtered = substr($SRPV_filtered ,0, strlen($SRPV_filtered)-1);
$SRPV = substr($SRPV ,0, strlen($SRPV)-1);
$Impressions_filtered = substr($Impressions_filtered ,0, strlen($Impressions_filtered)-1);
$Impressions = substr($Impressions ,0, strlen($Impressions)-1);
$Clicks_filtered = substr($Clicks_filtered ,0, strlen($Clicks_filtered)-1);
$Clicks = substr($Clicks ,0, strlen($Clicks)-1);
$DSQ = substr($DSQ ,0, strlen($DSQ)-1);
//$categories = substr($categories ,0, strlen($categories)-1);
$SRPV_Linear = substr($SRPV_Linear ,0, strlen($SRPV_Linear)-1); 
$SRPV_filtered_Linear = substr($SRPV_filtered_Linear ,0, strlen($SRPV_filtered_Linear)-1); 
$DSQ_Linear = substr($DSQ_Linear ,0, strlen($DSQ_Linear)-1); 
$Impressions_Linear = substr($Impressions_Linear ,0, strlen($Impressions_Linear)-1); 
$Impressions_filtered_Linear = substr($Impressions_filtered_Linear ,0, strlen($Impressions_filtered_Linear)-1); 
$Clicks_Linear = substr($Clicks_Linear ,0, strlen($Clicks_Linear)-1); 
$Clicks_filtered_Linear = substr($Clicks_filtered_Linear ,0, strlen($Clicks_filtered_Linear)-1); 

$SRPV_Raw = substr($SRPV_Raw ,0, strlen($SRPV_Raw)-1);
$SRPV_Anti_fraud = substr($SRPV_Anti_fraud ,0, strlen($SRPV_Anti_fraud)-1);
$Impressions_Raw = substr($Impressions_Raw ,0, strlen($Impressions_Raw)-1);
$Impressions_Anti_fraud = substr($Impressions_Anti_fraud ,0, strlen($Impressions_Anti_fraud)-1);
$Clicks_Raw = substr($Clicks_Raw ,0, strlen($Clicks_Raw)-1);
$Clicks_Anti_fraud = substr($Clicks_Anti_fraud ,0, strlen($Clicks_Anti_fraud)-1);
$SRPV_Raw_Linear = substr($SRPV_Raw_Linear ,0, strlen($SRPV_Raw_Linear)-1); 
$SRPV_Anti_fraud_Linear = substr($SRPV_Anti_fraud_Linear ,0, strlen($SRPV_Anti_fraud_Linear)-1); 
$Impressions_Raw_Linear = substr($Impressions_Raw_Linear ,0, strlen($Impressions_Raw_Linear)-1); 
$Impressions_Anti_fraud_Linear = substr($Impressions_Anti_fraud_Linear ,0, strlen($Impressions_Anti_fraud_Linear)-1); 
$Clicks_Raw_Linear = substr($Clicks_Raw_Linear ,0, strlen($Clicks_Raw_Linear)-1); 
$Clicks_Anti_fraud_Linear = substr($Clicks_Anti_fraud_Linear ,0, strlen($Clicks_Anti_fraud_Linear)-1); 
	//mysqli_close($db);
	


}

$line_color=array("'#058DC7'", "'#50B432'", "'#ED561B'", "'#DDDF00'", "'#24CBE5'", "'#64E572'", "'#FF9655'", "'#FFF263'", "'#6AF9C4'","'#058DC7'", "'#50B432'", "'#ED561B'", "'#DDDF00'", "'#24CBE5'", "'#64E572'", "'#FF9655'", "'#FFF263'", "'#6AF9C4'" );
$no_color	=0;

function monthkArrMapping($dataarr){
$temparr = array("''","''","''","''","''","''","''","''","''","''","''","''","''","''","''","''","''","''","''","''","''","''","''","''","''","''","''","''","''","''","''");
for($i=0;$i<31;$i++){
if (empty($dataarr[$i]) !=1) $temparr[$i] = $dataarr[$i];
}
$str="";
for($i=0;$i < count($temparr);$i++) {
$str .= $temparr[$i].",";
}
$str = substr($str ,0, strlen($str)-1);
return $str;
}

function monthkArrMappingLinear($dataarr){
//$temparr = array("''","''","''","''","''","''","''","''","''","''","''","''","''","''","''","''","''","''","''","''","''","''","''","''","''","''","''","''","''","''","''");
//$temparr = array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
$temparr = array();

$n=0;
for($i=0;$i<31;$i++){
if (empty($dataarr[$i]) !=1){
	 $temparr[$n] = $dataarr[$i];
	 $n++;
	 }
}
$str="";
for($i=0;$i < count($temparr);$i++) {
$str .= "[".($i+1).",".$temparr[$i]."],";
}
$str = substr($str ,0, strlen($str)-1);
return $str;
}

function monthkArrMappingLinearWithoutZero($dataarr){
//$temparr = array("''","''","''","''","''","''","''","''","''","''","''","''","''","''","''","''","''","''","''","''","''","''","''","''","''","''","''","''","''","''","''");
//$temparr = array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
$temparr = array();
$n=0;
for($i=0;$i<31;$i++){
if (empty($dataarr[$i]) !=1){
	 $temparr[$n] = $dataarr[$i];
	 $n++;
	 }
}

print_r($temparr);
$str="";
for($i=0;$i < count($temparr);$i++) {
$str .= "[".($i+1).",".$temparr[$i]."],";
}
$str = substr($str ,0, strlen($str)-1);
return $str;
}

function monthLinearReturnJSArray($dataarr,$arrname){
//$temparr = array("''","''","''","''","''","''","''","''","''","''","''","''","''","''","''","''","''","''","''","''","''","''","''","''","''","''","''","''","''","''","''");
//$temparr = array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
$arr = "var ".$arrname."=new Array(";
for($i=0;$i<31;$i++){
if (empty($dataarr[$i]) !=1)$arr  .= $dataarr[$i].",";
else $arr  .=  "0,";
}

$arr = substr($arr ,0, strlen($arr)-1);
$arr .=")";
return $arr;
}

function monthLinearReturnJSArrayAll($dataarr,$arrname,$localarrname){
//$temparr = array("''","''","''","''","''","''","''","''","''","''","''","''","''","''","''","''","''","''","''","''","''","''","''","''","''","''","''","''","''","''","''");
//$temparr = array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
$arr = "  var ".$arrname."=new Array(";
$local_arr = "  var ".$localarrname."=new Array(";

$n=0;
for($i=0;$i<31;$i++){
if (empty($dataarr[$i]) !=1){
	$arr.= $dataarr[$i].",";
	$local_arr  .=  $n.",";
	$n++;
} else{ 
	$arr  .=  "0,";
	$local_arr  .=  "-1,";
}
}

$arr = substr($arr ,0, strlen($arr)-1);
$arr .=");";
$local_arr = substr($local_arr ,0, strlen($local_arr)-1);
$local_arr .=");";
return $local_arr;
//return $arr.$local_arr;
}
	?>		
		
		
		<script type="text/javascript" >
// colors: ['#058DC7', '#50B432', '#ED561B', '#DDDF00', '#24CBE5', '#64E572', '#FF9655', '#FFF263', '#6AF9C4'] 
$(function () {

<?php 

 for($i=0;$i < count($DATA_ARR);$i++) 
{ 

$str_SRPV = monthkArrMappingLinear($DATA_ARR[$i]['SRPV']);
$str_SRPV_Raw = monthkArrMappingLinear($DATA_ARR[$i]['SRPV_Raw']);
		 ?>
    <?php echo monthLinearReturnJSArrayAll($DATA_ARR[$i]['SRPV'],"SRPV_arrdata".$i,"SRPV_local_arrdata".$i);?>  
	<?php echo monthLinearReturnJSArrayAll($DATA_ARR[$i]['SRPV_Raw'],"SRPV_Raw_arrdata".$i,"SRPV_Raw_local_arrdata".$i);?> 
	  
	var SRPV_data<?php echo $i ;?> = [<?php echo $str_SRPV ;?>];
	var SRPV_myRegression<?php echo $i ;?> = regression('linear', SRPV_data<?php echo $i ;?>);
 	var SRPV_linearArr<?php echo $i ;?>= new Array();	
			

	for(var i=0;i < SRPV_local_arrdata<?php echo $i ;?>.length ;i++){
	    var tempData = SRPV_local_arrdata<?php echo $i ;?>[i];
		if( tempData == -1 ){
			SRPV_linearArr<?php echo $i ;?>[i] = "''";
		}else{ 
			SRPV_linearArr<?php echo $i ;?>[i] = Math.round(SRPV_myRegression<?php echo $i ;?>.points[tempData][1]);
		}
	}
	
	var SRPV_Raw_data<?php echo $i ;?> = [<?php echo $str_SRPV_Raw ;?>];
	var SRPV_Raw_myRegression<?php echo $i ;?> = regression('linear', SRPV_Raw_data<?php echo $i ;?>);
 	var SRPV_Raw_linearArr<?php echo $i ;?>= new Array();	
			

	for(var i=0;i < SRPV_Raw_local_arrdata<?php echo $i ;?>.length ;i++){
	    var tempData = SRPV_Raw_local_arrdata<?php echo $i ;?>[i];
		if( tempData == -1 ){
			SRPV_Raw_linearArr<?php echo $i ;?>[i] = "''";
		}else{ 
			SRPV_Raw_linearArr<?php echo $i ;?>[i] = Math.round(SRPV_Raw_myRegression<?php echo $i ;?>.points[tempData][1]);
		}
	}
		<?php
		
		}
?>
	
	
    $('#container').highcharts({
        chart: {
            type: 'line'
        },
        title: {
            text: ' 总搜索量(Raw SRPV) by month) '
        },
        subtitle: {
            text: ' (Raw SRPV)/Sougou'
        },
        xAxis: {
            categories: [<?php echo $categories;?>]//['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
        },
        yAxis: {
            title: {
                text: 'request'
            }
        },
        plotOptions: {
            line: {
                dataLabels: {
                    enabled: true
                },
                enableMouseTracking: false
            }
        },
		
		series: [
		<?php 

		
		
		for($i=0;$i < count($DATA_ARR);$i++) 
{ 
       $str = monthkArrMapping($DATA_ARR[$i]['SRPV']);
		 ?>
        {
            name: 'SML <?php echo $DATA_ARR[$i]['YearMonth']?>',
            data: [<?php echo $str;?>] ,
			color: <?php echo $line_color[$no_color]?> ,
			lineWidth: 2  ,
			enableMouseTracking: true,
			dataLabels: {
                enabled: true,
				style: {"color": <?php echo $line_color[$no_color]?> }
			}
        }
		<?php
		if ( $i < count($DATA_ARR)) echo ",";
		
		$no_color++;
		}
		 
		
		for($i=0;$i < count($DATA_ARR);$i++) 
{ 
       $str = monthkArrMapping($DATA_ARR[$i]['SRPV_Raw']);
		 ?>
        {
            name: 'Sogou <?php echo $DATA_ARR[$i]['YearMonth']?>',
            data: [<?php echo $str;?>] ,
			color: <?php echo $line_color[$no_color]?> ,
			lineWidth: 2  ,
			enableMouseTracking: true,
			dataLabels: {
                enabled: true,
				style: {"color": <?php echo $line_color[$no_color]?> }
			}
        }
		<?php
		if ( $i < count($DATA_ARR)) echo ",";
		
		$no_color++;
		}
		 
		 for($i=0;$i < count($DATA_ARR);$i++) 
{ 
		 ?>
       {
            name: 'SML Linear <?php echo $DATA_ARR[$i]['YearMonth']?>',
            data: SRPV_linearArr<?php echo $i;?>,
			color:'#000000',
			lineWidth: 1   ,
			dashStyle: 'LongDashDot',
			marker: {
					fillColor: '#000000',//点填充色
                    lineColor: '#000000',//点边框色
                    enabled: true,
                    symbol: 'circle',//曲线点类型："circle", "square", "diamond", "triangle","triangle-down"，默认是"circle"
                    radius: 2 //曲线点半径，默认是4
                    
                },
			dataLabels: {
                    enabled: false
                }
        }
		<?php
		if ( $i < count($DATA_ARR)) echo ",";
		
		
		}
		  for($i=0;$i < count($DATA_ARR);$i++) 
{ 
		 ?>
       {
            name: 'Sogou Linear <?php echo $DATA_ARR[$i]['YearMonth']?>',
            data: SRPV_Raw_linearArr<?php echo $i;?>,
			color:'#000000',
			lineWidth: 1   ,
			dashStyle: 'LongDashDot',
			marker: {
					fillColor: '#000000',//点填充色
                    lineColor: '#000000',//点边框色
                    enabled: true,
                    symbol: 'circle',//曲线点类型："circle", "square", "diamond", "triangle","triangle-down"，默认是"circle"
                    radius: 2 //曲线点半径，默认是4
                    
                },
			dataLabels: {
                    enabled: false
                }
        }
		<?php
		if ( $i < (count($DATA_ARR)-1)) echo ",";
		
		
		}
		 ?>
		 
		 
		
		]

    });
});


////////////////有效搜索量(SRPV-filtered) by month/////////////////////////

$(function () {

<?php 
$no_color	=0;
 for($i=0;$i < count($DATA_ARR);$i++) 
{   

$str_SRPV_filtered = monthkArrMappingLinear($DATA_ARR[$i]['SRPV_filtered']);
$str_SRPV_Anti_fraud = monthkArrMappingLinear($DATA_ARR[$i]['SRPV_Anti_fraud']);
$str_DSQ = monthkArrMappingLinear($DATA_ARR[$i]['DSQ']);

		 ?>
    <?php echo monthLinearReturnJSArrayAll($DATA_ARR[$i]['SRPV'],"SRPV_filtered_arrdata".$i,"SRPV_filtered_local_arrdata".$i);?>  
	<?php echo monthLinearReturnJSArrayAll($DATA_ARR[$i]['SRPV_Raw'],"SRPV_Raw_arrdata".$i,"SRPV_Raw_local_arrdata".$i);?> 
	<?php echo monthLinearReturnJSArrayAll($DATA_ARR[$i]['DSQ'],"DSQ_arrdata".$i,"DSQ_local_arrdata".$i);?> 
		  
	var SRPV_filtered_data<?php echo $i ;?> = [<?php echo $str_SRPV_filtered ;?>];
	var SRPV_filtered_myRegression<?php echo $i ;?> = regression('linear', SRPV_filtered_data<?php echo $i ;?>);
 	var SRPV_filtered_linearArr<?php echo $i ;?>= new Array();		
			

	for(var i=0;i < SRPV_filtered_local_arrdata<?php echo $i ;?>.length ;i++){
	    var tempData = SRPV_filtered_local_arrdata<?php echo $i ;?>[i];
		if( tempData == -1 ){
			SRPV_filtered_linearArr<?php echo $i ;?>[i] = "''";
		}else{ 
			SRPV_filtered_linearArr<?php echo $i ;?>[i] = Math.round(SRPV_filtered_myRegression<?php echo $i ;?>.points[tempData][1]);
		}
	}
	
	
	var DSQ_data<?php echo $i ;?> = [<?php echo $str_DSQ ;?>];
	var DSQ_myRegression<?php echo $i ;?> = regression('linear', DSQ_data<?php echo $i ;?>);
 	var DSQ_linearArr<?php echo $i ;?> = new Array();	
			
	for(var i=0;i < DSQ_local_arrdata<?php echo $i ;?>.length ;i++){
	    var tempData = DSQ_local_arrdata<?php echo $i ;?>[i];
		if( tempData == -1 ){
			DSQ_linearArr<?php echo $i ;?>[i] = "''";
		}else{ 
			DSQ_linearArr<?php echo $i ;?>[i] = Math.round(DSQ_myRegression<?php echo $i ;?>.points[tempData][1]);
		}
	}
	
	var SRPV_Anti_fraud_data<?php echo $i ;?> = [<?php echo $str_SRPV_Anti_fraud ;?>];
	var SRPV_Anti_fraud_myRegression<?php echo $i ;?> = regression('linear', SRPV_Anti_fraud_data<?php echo $i ;?>);
 	var SRPV_Anti_fraud_linearArr<?php echo $i ;?> = new Array();	
			

	for(var i=0;i < SRPV_Raw_local_arrdata<?php echo $i ;?>.length ;i++){
	    var tempData = SRPV_Raw_local_arrdata<?php echo $i ;?>[i];
		if( tempData == -1 ){
			SRPV_Anti_fraud_linearArr<?php echo $i ;?>[i] = "''";
		}else{ 
			SRPV_Anti_fraud_linearArr<?php echo $i ;?>[i] = Math.round(SRPV_Anti_fraud_myRegression<?php echo $i ;?>.points[tempData][1]);
		}
	}
		<?php
		
		}
?>
	
	
    $('#container1').highcharts({
        chart: {
            type: 'line'
        },
        title: {
            text: ' 有效搜索量(SRPV-filtered) by month '
        },
        subtitle: {
            text: ' (SRPV-filtered/Sougou'
        },
        xAxis: {
            categories: [<?php echo $categories;?>]//['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
        },
        yAxis: {
            title: {
                text: 'request'
            }
        },
        plotOptions: {
            line: {
                dataLabels: {
                    enabled: true
                },
                enableMouseTracking: false
            }
        },
		
		series: [
		<?php 

		
		
		for($i=0;$i < count($DATA_ARR);$i++) 
{ 
       $str = monthkArrMapping($DATA_ARR[$i]['SRPV_filtered']);
		 ?>
        {
            name: 'SML <?php echo $DATA_ARR[$i]['YearMonth']?>',
            data: [<?php echo $str;?>] ,
			color: <?php echo $line_color[$no_color]?> ,
			lineWidth: 2  ,
			enableMouseTracking: true,
			dataLabels: {
                enabled: true,
				style: {"color": <?php echo $line_color[$no_color]?> }
			}
        }
		<?php
		if ( $i < count($DATA_ARR)) echo ",";
		
		$no_color++;
		}
		 
		 		for($i=0;$i < count($DATA_ARR);$i++) 
{ 
       $str = monthkArrMapping($DATA_ARR[$i]['DSQ']);
		 ?>
        {
            name: 'SML <?php echo $DATA_ARR[$i]['YearMonth']?>',
            data: [<?php echo $str;?>] ,
			color: <?php echo $line_color[$no_color]?> ,
			lineWidth: 2  ,
			enableMouseTracking: true,
			dataLabels: {
                enabled: true,
				style: {"color": <?php echo $line_color[$no_color]?> }
			}
        }
		<?php
		if ( $i < count($DATA_ARR)) echo ",";
		
		$no_color++;
		}
		
		for($i=0;$i < count($DATA_ARR);$i++) 
{ 
       $str = monthkArrMapping($DATA_ARR[$i]['SRPV_Anti_fraud']);
		 ?>
        {
            name: 'Sogou <?php echo $DATA_ARR[$i]['YearMonth']?>',
            data: [<?php echo $str;?>] ,
			color: <?php echo $line_color[$no_color]?> ,
			lineWidth: 2  ,
			enableMouseTracking: true,
			dataLabels: {
                enabled: true,
				style: {"color": <?php echo $line_color[$no_color]?> }
			}
        }
		<?php
		if ( $i < count($DATA_ARR)) echo ",";
		
		$no_color++;
		}
		 
		 for($i=0;$i < count($DATA_ARR);$i++) 
{ 
		 ?>
       {
            name: 'SML Linear <?php echo $DATA_ARR[$i]['YearMonth']?>',
            data: SRPV_filtered_linearArr<?php echo $i;?>,
			color:'#000000',
			lineWidth: 1   ,
			dashStyle: 'LongDashDot',
			marker: {
					fillColor: '#000000',//点填充色
                    lineColor: '#000000',//点边框色
                    enabled: true,
                    symbol: 'circle',//曲线点类型："circle", "square", "diamond", "triangle","triangle-down"，默认是"circle"
                    radius: 2 //曲线点半径，默认是4
                    
                },
			dataLabels: {
                    enabled: false
                }
        }
		<?php
		if ( $i < count($DATA_ARR)) echo ",";
		
		
		}
		
		
				 for($i=0;$i < count($DATA_ARR);$i++) 
{ 
		 ?>
       {
            name: 'DSQ Linear <?php echo $DATA_ARR[$i]['YearMonth']?>',
            data: DSQ_linearArr<?php echo $i;?>,
			color:'#000000',
			lineWidth: 1   ,
			dashStyle: 'LongDashDot',
			marker: {
					fillColor: '#000000',//点填充色
                    lineColor: '#000000',//点边框色
                    enabled: true,
                    symbol: 'circle',//曲线点类型："circle", "square", "diamond", "triangle","triangle-down"，默认是"circle"
                    radius: 2 //曲线点半径，默认是4
                    
                },
			dataLabels: {
                    enabled: false
                }
        }
		<?php
		if ( $i < count($DATA_ARR)) echo ",";
		
		
		}
		
		  for($i=0;$i < count($DATA_ARR);$i++) 
{ 
		 ?>
       {
            name: 'Sogou Linear <?php echo $DATA_ARR[$i]['YearMonth']?>',
            data: SRPV_Anti_fraud_linearArr<?php echo $i;?>,
			color:'#000000',
			lineWidth: 1   ,
			dashStyle: 'LongDashDot',
			marker: {
					fillColor: '#000000',//点填充色
                    lineColor: '#000000',//点边框色
                    enabled: true,
                    symbol: 'circle',//曲线点类型："circle", "square", "diamond", "triangle","triangle-down"，默认是"circle"
                    radius: 2 //曲线点半径，默认是4
                    
                },
			dataLabels: {
                    enabled: false
                }
        }
		<?php
		if ( $i < (count($DATA_ARR)-1)) echo ",";
		
		
		}
		 ?>
		 
		 
		
		]

    });
});



//////////////////////////总推广展示(Raw Impressions) by month///////////////////////////


$(function () {

<?php 
$no_color	=0;
 for($i=0;$i < count($DATA_ARR);$i++) 
{   

$str_Impressions = monthkArrMappingLinear($DATA_ARR[$i]['Impressions']);
$str_Impressions_Raw = monthkArrMappingLinear($DATA_ARR[$i]['Impressions_Raw']);
		 ?>
    <?php echo monthLinearReturnJSArrayAll($DATA_ARR[$i]['Impressions'],"Impressions_arrdata".$i,"Impressions_local_arrdata".$i);?>  
	<?php echo monthLinearReturnJSArrayAll($DATA_ARR[$i]['Impressions_Raw'],"Impressions_Raw_arrdata".$i,"Impressions_Raw_local_arrdata".$i);?> 
	  
	var Impressions_data<?php echo $i ;?> = [<?php echo $str_Impressions ;?>];
	var Impressions_myRegression<?php echo $i ;?> = regression('linear', Impressions_data<?php echo $i ;?>);
 	var Impressions_linearArr<?php echo $i ;?>= new Array();	
	
	for(var i=0;i < Impressions_local_arrdata<?php echo $i ;?>.length ;i++){
	    var tempData = Impressions_local_arrdata<?php echo $i ;?>[i];
		if( tempData == -1 ){
			Impressions_linearArr<?php echo $i ;?>[i] = "''";
		}else{ 
			Impressions_linearArr<?php echo $i ;?>[i] = Math.round(Impressions_myRegression<?php echo $i ;?>.points[tempData][1]);
		}
	}
	
	
	var Impressions_Raw_data<?php echo $i ;?> = [<?php echo $str_Impressions_Raw ;?>];
	var Impressions_Raw_myRegression<?php echo $i ;?> = regression('linear', Impressions_Raw_data<?php echo $i ;?>);
 	var Impressions_Raw_linearArr<?php echo $i ;?>= new Array();	
			

	for(var i=0;i < Impressions_Raw_local_arrdata<?php echo $i ;?>.length ;i++){
	    var tempData = Impressions_Raw_local_arrdata<?php echo $i ;?>[i];
		if( tempData == -1 ){
			Impressions_Raw_linearArr<?php echo $i ;?>[i] = "''";
		}else{ 
			Impressions_Raw_linearArr<?php echo $i ;?>[i] = Math.round(Impressions_Raw_myRegression<?php echo $i ;?>.points[tempData][1]);
		}
	}
		<?php
		
		}
?>
	
	
    $('#containerIP').highcharts({
        chart: {
            type: 'line'
        },
        title: {
            text: ' 总推广展示(Raw Impressions) by month '
        },
        subtitle: {
            text: ' Raw Impression/Sougou'
        },
        xAxis: {
            categories: [<?php echo $categories;?>]//['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
        },
        yAxis: {
            title: {
                text: 'request'
            }
        },
        plotOptions: {
            line: {
                dataLabels: {
                    enabled: true
                },
                enableMouseTracking: false
            }
        },
		
		series: [
		<?php 

		
		
		for($i=0;$i < count($DATA_ARR);$i++) 
{ 
       $str = monthkArrMapping($DATA_ARR[$i]['Impressions']);
		 ?>
        {
            name: 'SML <?php echo $DATA_ARR[$i]['YearMonth']?>',
            data: [<?php echo $str;?>] ,
			color: <?php echo $line_color[$no_color]?> ,
			lineWidth: 2  ,
			enableMouseTracking: true,
			dataLabels: {
                enabled: true,
				style: {"color": <?php echo $line_color[$no_color]?> }
			}
        }
		<?php
		if ( $i < count($DATA_ARR)) echo ",";
		
		$no_color++;
		}
		 
		
		for($i=0;$i < count($DATA_ARR);$i++) 
{ 
       $str = monthkArrMapping($DATA_ARR[$i]['Impressions_Raw']);
		 ?>
        {
            name: 'Sogou <?php echo $DATA_ARR[$i]['YearMonth']?>',
            data: [<?php echo $str;?>] ,
			color: <?php echo $line_color[$no_color]?> ,
			lineWidth: 2  ,
			enableMouseTracking: true,
			dataLabels: {
                enabled: true,
				style: {"color": <?php echo $line_color[$no_color]?> }
			}
        }
		<?php
		if ( $i < count($DATA_ARR)) echo ",";
		
		$no_color++;
		}
		 
		 for($i=0;$i < count($DATA_ARR);$i++) 
{ 
		 ?>
       {
            name: 'SML Linear <?php echo $DATA_ARR[$i]['YearMonth']?>',
            data: Impressions_linearArr<?php echo $i;?>,
			color:'#000000',
			lineWidth: 1   ,
			dashStyle: 'LongDashDot',
			marker: {
					fillColor: '#000000',//点填充色
                    lineColor: '#000000',//点边框色
                    enabled: true,
                    symbol: 'circle',//曲线点类型："circle", "square", "diamond", "triangle","triangle-down"，默认是"circle"
                    radius: 2 //曲线点半径，默认是4
                    
                },
			dataLabels: {
                    enabled: false
                }
        }
		<?php
		if ( $i < count($DATA_ARR)) echo ",";
		
		
		}
		  for($i=0;$i < count($DATA_ARR);$i++) 
{ 
		 ?>
       {
            name: 'Sogou Linear <?php echo $DATA_ARR[$i]['YearMonth']?>',
            data: Impressions_Raw_linearArr<?php echo $i;?>,
			color:'#000000',
			lineWidth: 1   ,
			dashStyle: 'LongDashDot',
			marker: {
					fillColor: '#000000',//点填充色
                    lineColor: '#000000',//点边框色
                    enabled: true,
                    symbol: 'circle',//曲线点类型："circle", "square", "diamond", "triangle","triangle-down"，默认是"circle"
                    radius: 2 //曲线点半径，默认是4
                    
                },
			dataLabels: {
                    enabled: false
                }
        }
		<?php
		if ( $i < (count($DATA_ARR)-1)) echo ",";
		
		
		}
		 ?>
		 
		 
		
		]

    });
});



//////////////////////////有效推广展示(Impressions-filtered) by month’///////////////////////////

$(function () {

<?php 
$no_color	=0;
 for($i=0;$i < count($DATA_ARR);$i++) 
{   

$str_Impressions_Anti_fraud = monthkArrMappingLinear($DATA_ARR[$i]['Impressions_filtered']);
$str_Impressions_filtered = monthkArrMappingLinear($DATA_ARR[$i]['Impressions_Anti_fraud']);
		 ?>
    <?php echo monthLinearReturnJSArrayAll($DATA_ARR[$i]['Impressions_filtered'],"Impressions_Anti_fraud_arrdata".$i,"Impressions_Anti_fraud_local_arrdata".$i);?>  
	<?php echo monthLinearReturnJSArrayAll($DATA_ARR[$i]['Impressions_Anti_fraud'],"Impressions_filtered_arrdata".$i,"Impressions_filtered_local_arrdata".$i);?> 
	  
	var Impressions_Anti_fraud_data<?php echo $i ;?> = [<?php echo $str_Impressions_Anti_fraud ;?>];
	var Impressions_Anti_fraud_myRegression<?php echo $i ;?> = regression('linear', Impressions_Anti_fraud_data<?php echo $i ;?>);
 	var Impressions_Anti_fraud_linearArr<?php echo $i ;?>= new Array();	
	
	
	for(var i=0;i < Impressions_Anti_fraud_local_arrdata<?php echo $i ;?>.length ;i++){
	    var tempData = Impressions_Anti_fraud_local_arrdata<?php echo $i ;?>[i];
		if( tempData == -1 ){
			Impressions_Anti_fraud_linearArr<?php echo $i ;?>[i] = "''";
		}else{ 
			Impressions_Anti_fraud_linearArr<?php echo $i ;?>[i] = Math.round(Impressions_Anti_fraud_myRegression<?php echo $i ;?>.points[tempData][1]);
		}
	}
	
	var Impressions_filtered_data<?php echo $i ;?> = [<?php echo $str_Impressions_filtered ;?>];
	var Impressions_filtered_myRegression<?php echo $i ;?> = regression('linear', Impressions_filtered_data<?php echo $i ;?>);
 	var Impressions_filtered_linearArr<?php echo $i ;?>= new Array();	
	
    for(var i=0;i < Impressions_filtered_local_arrdata<?php echo $i ;?>.length ;i++){
	    var tempData = Impressions_filtered_local_arrdata<?php echo $i ;?>[i];
		if( tempData == -1 ){
			Impressions_filtered_linearArr<?php echo $i ;?>[i] = "''";
		}else{ 
			Impressions_filtered_linearArr<?php echo $i ;?>[i] = Math.round(Impressions_filtered_myRegression<?php echo $i ;?>.points[tempData][1]);
		}
	}
		<?php
		
		}
?>
	
	
    $('#containerIPF').highcharts({
        chart: {
            type: 'line'
        },
        title: {
            text: ' 有效推广展示(Impressions-filtered) by month '
        },
        subtitle: {
            text: ' (Impressions-filtered/Sougou'
        },
        xAxis: {
            categories: [<?php echo $categories;?>]//['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
        },
        yAxis: {
            title: {
                text: 'request'
            }
        },
        plotOptions: {
            line: {
                dataLabels: {
                    enabled: true
                },
                enableMouseTracking: false
            }
        },
		
		series: [
		<?php 

		
		
		for($i=0;$i < count($DATA_ARR);$i++) 
{ 
       $str = monthkArrMapping($DATA_ARR[$i]['Impressions_filtered']);
		 ?>
        {
            name: 'SML <?php echo $DATA_ARR[$i]['YearMonth']?>',
            data: [<?php echo $str;?>] ,
			color: <?php echo $line_color[$no_color]?> ,
			lineWidth: 2  ,
			enableMouseTracking: true,
			dataLabels: {
                enabled: true,
				style: {"color": <?php echo $line_color[$no_color]?> }
			}
        }
		<?php
		if ( $i < count($DATA_ARR)) echo ",";
		
		$no_color++;
		}
		 
		
		for($i=0;$i < count($DATA_ARR);$i++) 
{ 
       $str = monthkArrMapping($DATA_ARR[$i]['Impressions_Anti_fraud']);
		 ?>
        {
            name: 'Sogou <?php echo $DATA_ARR[$i]['YearMonth']?>',
            data: [<?php echo $str;?>] ,
			color: <?php echo $line_color[$no_color]?> ,
			lineWidth: 2  ,
			enableMouseTracking: true,
			dataLabels: {
                enabled: true,
				style: {"color": <?php echo $line_color[$no_color]?> }
			}
        }
		<?php
		if ( $i < count($DATA_ARR)) echo ",";
		
		$no_color++;
		}
		 
		 for($i=0;$i < count($DATA_ARR);$i++) 
{ 
		 ?>
       {
            name: 'SML Linear <?php echo $DATA_ARR[$i]['YearMonth']?>',
            data: Impressions_filtered_linearArr<?php echo $i;?>,
			color:'#000000',
			lineWidth: 1   ,
			dashStyle: 'LongDashDot',
			marker: {
					fillColor: '#000000',//点填充色
                    lineColor: '#000000',//点边框色
                    enabled: true,
                    symbol: 'circle',//曲线点类型："circle", "square", "diamond", "triangle","triangle-down"，默认是"circle"
                    radius: 2 //曲线点半径，默认是4
                    
                },
			dataLabels: {
                    enabled: false
                }
        }
		<?php
		if ( $i < count($DATA_ARR)) echo ",";
		
		
		}
		  for($i=0;$i < count($DATA_ARR);$i++) 
{ 
		 ?>
       {
            name: 'Sogou Linear <?php echo $DATA_ARR[$i]['YearMonth']?>',
            data: Impressions_Anti_fraud_linearArr<?php echo $i;?>,
			color:'#000000',
			lineWidth: 1   ,
			dashStyle: 'LongDashDot',
			marker: {
					fillColor: '#000000',//点填充色
                    lineColor: '#000000',//点边框色
                    enabled: true,
                    symbol: 'circle',//曲线点类型："circle", "square", "diamond", "triangle","triangle-down"，默认是"circle"
                    radius: 2 //曲线点半径，默认是4
                    
                },
			dataLabels: {
                    enabled: false
                }
        }
		<?php
		if ( $i < (count($DATA_ARR)-1)) echo ",";
		
		
		}
		 ?>
		 
		 
		
		]

    });
});


////////////////////////// 总点击量(Raw Clicks) by month ///////////////////////////

$(function () {

<?php 
$no_color	=0;
 for($i=0;$i < count($DATA_ARR);$i++) 
{  

$str_Clicks = monthkArrMappingLinear($DATA_ARR[$i]['Clicks']);
$str_Clicks_Raw = monthkArrMappingLinear($DATA_ARR[$i]['Clicks_Raw']);
		 ?>
    <?php echo monthLinearReturnJSArrayAll($DATA_ARR[$i]['Clicks'],"Clicks_arrdata".$i,"Clicks_local_arrdata".$i);?>  
	<?php echo monthLinearReturnJSArrayAll($DATA_ARR[$i]['Clicks_Raw'],"Clicks_Raw_arrdata".$i,"Clicks_Raw_local_arrdata".$i);?> 
	
	var Clicks_data<?php echo $i ;?> = [<?php echo $str_Clicks ;?>];
	var Clicks_myRegression<?php echo $i ;?> = regression('linear', Clicks_data<?php echo $i ;?>);
 	var Clicks_linearArr<?php echo $i ;?>= new Array();	
	
	
	for(var i=0;i < Clicks_local_arrdata<?php echo $i ;?>.length ;i++){
	    var tempData = Clicks_local_arrdata<?php echo $i ;?>[i];
		if( tempData == -1 ){
			Clicks_linearArr<?php echo $i ;?>[i] = "''";
		}else{ 
			Clicks_linearArr<?php echo $i ;?>[i] = Math.round(Clicks_myRegression<?php echo $i ;?>.points[tempData][1]);
		}
	}
	
	var Clicks_Raw_data<?php echo $i ;?> = [<?php echo $str_Clicks_Raw ;?>];
	var Clicks_Raw_myRegression<?php echo $i ;?> = regression('linear', Clicks_Raw_data<?php echo $i ;?>);
 	var Clicks_Raw_linearArr<?php echo $i ;?>= new Array();	
	
    for(var i=0;i < Clicks_Raw_local_arrdata<?php echo $i ;?>.length ;i++){
	    var tempData = Clicks_Raw_local_arrdata<?php echo $i ;?>[i];
		if( tempData == -1 ){
			Clicks_Raw_linearArr<?php echo $i ;?>[i] = "''";
		}else{ 
			Clicks_Raw_linearArr<?php echo $i ;?>[i] = Math.round(Clicks_Raw_myRegression<?php echo $i ;?>.points[tempData][1]);
		}
	}
		<?php
		
		}
?>
	
	
    $('#containerC').highcharts({
        chart: {
            type: 'line'
        },
        title: {
            text: ' 总点击量(Raw Clicks) by month '
        },
        subtitle: {
            text: ' Raw Clicks/Sougou'
        },
        xAxis: {
            categories: [<?php echo $categories;?>]//['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
        },
        yAxis: {
            title: {
                text: 'request'
            }
        },
        plotOptions: {
            line: {
                dataLabels: {
                    enabled: true
                },
                enableMouseTracking: false
            }
        },
		
		series: [
		<?php 

		
		
		for($i=0;$i < count($DATA_ARR);$i++) 
{ 
       $str = monthkArrMapping($DATA_ARR[$i]['Clicks']);
		 ?>
        {
            name: 'SML <?php echo $DATA_ARR[$i]['YearMonth']?>',
            data: [<?php echo $str;?>] ,
			color: <?php echo $line_color[$no_color]?> ,
			lineWidth: 2  ,
			enableMouseTracking: true,
			dataLabels: {
                enabled: true,
				style: {"color": <?php echo $line_color[$no_color]?> }
			}
        }
		<?php
		if ( $i < count($DATA_ARR)) echo ",";
		
		$no_color++;
		}
		 
		
		for($i=0;$i < count($DATA_ARR);$i++) 
{ 
       $str = monthkArrMapping($DATA_ARR[$i]['Clicks_Raw']);
		 ?>
        {
            name: 'Sogou <?php echo $DATA_ARR[$i]['YearMonth']?>',
            data: [<?php echo $str;?>] ,
			color: <?php echo $line_color[$no_color]?> ,
			lineWidth: 2  ,
			enableMouseTracking: true,
			dataLabels: {
                enabled: true,
				style: {"color": <?php echo $line_color[$no_color]?> }
			}
        }
		<?php
		if ( $i < count($DATA_ARR)) echo ",";
		
		$no_color++;
		}
		 
		 for($i=0;$i < count($DATA_ARR);$i++) 
{ 
		 ?>
       {
            name: 'SML Linear <?php echo $DATA_ARR[$i]['YearMonth']?>',
            data: Clicks_linearArr<?php echo $i;?>,
			color:'#000000',
			lineWidth: 1   ,
			dashStyle: 'LongDashDot',
			marker: {
					fillColor: '#000000',//点填充色
                    lineColor: '#000000',//点边框色
                    enabled: true,
                    symbol: 'circle',//曲线点类型："circle", "square", "diamond", "triangle","triangle-down"，默认是"circle"
                    radius: 2 //曲线点半径，默认是4
                    
                },
			dataLabels: {
                    enabled: false
                }
        }
		<?php
		if ( $i < count($DATA_ARR)) echo ",";
		
		
		}
		  for($i=0;$i < count($DATA_ARR);$i++) 
{ 
		 ?>
       {
            name: 'Sogou Linear <?php echo $DATA_ARR[$i]['YearMonth']?>',
            data: Clicks_Raw_linearArr<?php echo $i;?>,
			color:'#000000',
			lineWidth: 1   ,
			dashStyle: 'LongDashDot',
			marker: {
					fillColor: '#000000',//点填充色
                    lineColor: '#000000',//点边框色
                    enabled: true,
                    symbol: 'circle',//曲线点类型："circle", "square", "diamond", "triangle","triangle-down"，默认是"circle"
                    radius: 2 //曲线点半径，默认是4
                    
                },
			dataLabels: {
                    enabled: false
                }
        }
		<?php
		if ( $i < (count($DATA_ARR)-1)) echo ",";
		
		
		}
		 ?>
		 
		 
		
		]

    });
});


////////////////////////// 有效点击量(Clicks-filtered)by month ///////////////////////////

$(function () {

<?php 
$no_color	=0;
 for($i=0;$i < count($DATA_ARR);$i++) 
{  
 
$str_Clicks_filtered = monthkArrMappingLinear($DATA_ARR[$i]['Clicks_filtered']);
$str_Clicks_Anti_fraud = monthkArrMappingLinear($DATA_ARR[$i]['Clicks_Anti_fraud']);
		 ?>
    <?php echo monthLinearReturnJSArrayAll($DATA_ARR[$i]['Clicks_filtered'],"Clicks_filtered_arrdata".$i,"Clicks_filtered_local_arrdata".$i);?>  
	<?php echo monthLinearReturnJSArrayAll($DATA_ARR[$i]['Clicks_Anti_fraud'],"Clicks_Anti_fraud_arrdata".$i,"Clicks_Anti_fraud_local_arrdata".$i);?> 
	
	var Clicks_filtered_data<?php echo $i ;?> = [<?php echo $str_Clicks_filtered ;?>];
	var Clicks_filtered_myRegression<?php echo $i ;?> = regression('linear', Clicks_filtered_data<?php echo $i ;?>);
 	var Clicks_filtered_linearArr<?php echo $i ;?>= new Array();	
	
	
	for(var i=0;i < Clicks_filtered_local_arrdata<?php echo $i ;?>.length ;i++){
	    var tempData = Clicks_filtered_local_arrdata<?php echo $i ;?>[i];
		if( tempData == -1 ){
			Clicks_filtered_linearArr<?php echo $i ;?>[i] = "''";
		}else{ 
			Clicks_filtered_linearArr<?php echo $i ;?>[i] = Math.round(Clicks_filtered_myRegression<?php echo $i ;?>.points[tempData][1]);
		}
	}
	
	var Clicks_Anti_fraud_data<?php echo $i ;?> = [<?php echo $str_Clicks_Anti_fraud ;?>];
	var Clicks_Anti_fraud_myRegression<?php echo $i ;?> = regression('linear', Clicks_Anti_fraud_data<?php echo $i ;?>);
 	var Clicks_Anti_fraud_linearArr<?php echo $i ;?>= new Array();	
	
    for(var i=0;i < Clicks_Anti_fraud_local_arrdata<?php echo $i ;?>.length ;i++){
	    var tempData = Clicks_Anti_fraud_local_arrdata<?php echo $i ;?>[i];
		if( tempData == -1 ){
			Clicks_Anti_fraud_linearArr<?php echo $i ;?>[i] = "''";
		}else{ 
			Clicks_Anti_fraud_linearArr<?php echo $i ;?>[i] = Math.round(Clicks_Anti_fraud_myRegression<?php echo $i ;?>.points[tempData][1]);
		}
	}
		<?php
		
		}
?>
	
	
    $('#containerCF').highcharts({
        chart: {
            type: 'line'
        },
        title: {
            text: ' 有效点击量(Clicks-filtered)by month '
        },
        subtitle: {
            text: ' (Clicks-filtered/Sougou'
        },
        xAxis: {
            categories: [<?php echo $categories;?>]//['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
        },
        yAxis: {
            title: {
                text: 'request'
            }
        },
        plotOptions: {
            line: {
                dataLabels: {
                    enabled: true
                },
                enableMouseTracking: false
            }
        },
		
		series: [
		<?php 

		
		
		for($i=0;$i < count($DATA_ARR);$i++) 
{ 
       $str = monthkArrMapping($DATA_ARR[$i]['Clicks_filtered']);
		 ?>
        {
            name: 'SML <?php echo $DATA_ARR[$i]['YearMonth']?>',
            data: [<?php echo $str;?>] ,
			color: <?php echo $line_color[$no_color]?> ,
			lineWidth: 2  ,
			enableMouseTracking: true,
			dataLabels: {
                enabled: true,
				style: {"color": <?php echo $line_color[$no_color]?> }
			}
        }
		<?php
		if ( $i < count($DATA_ARR)) echo ",";
		
		$no_color++;
		}
		 
		
		for($i=0;$i < count($DATA_ARR);$i++) 
{ 
       $str = monthkArrMapping($DATA_ARR[$i]['Clicks_Anti_fraud']);
		 ?>
        {
            name: 'Sogou <?php echo $DATA_ARR[$i]['YearMonth']?>',
            data: [<?php echo $str;?>] ,
			color: <?php echo $line_color[$no_color]?> ,
			lineWidth: 2  ,
			enableMouseTracking: true,
			dataLabels: {
                enabled: true,
				style: {"color": <?php echo $line_color[$no_color]?> }
			}
        }
		<?php
		if ( $i < count($DATA_ARR)) echo ",";
		
		$no_color++;
		}
		 
		 for($i=0;$i < count($DATA_ARR);$i++) 
{ 
		 ?>
       {
            name: 'SML Linear <?php echo $DATA_ARR[$i]['YearMonth']?>',
            data: Clicks_filtered_linearArr<?php echo $i;?>,
			color:'#000000',
			lineWidth: 1   ,
			dashStyle: 'LongDashDot',
			marker: {
					fillColor: '#000000',//点填充色
                    lineColor: '#000000',//点边框色
                    enabled: true,
                    symbol: 'circle',//曲线点类型："circle", "square", "diamond", "triangle","triangle-down"，默认是"circle"
                    radius: 2 //曲线点半径，默认是4
                    
                },
			dataLabels: {
                    enabled: false
                }
        }
		<?php
		if ( $i < count($DATA_ARR)) echo ",";
		
		
		}
		  for($i=0;$i < count($DATA_ARR);$i++) 
{ 
		 ?>
       {
            name: 'Sogou Linear <?php echo $DATA_ARR[$i]['YearMonth']?>',
            data: Clicks_Anti_fraud_linearArr<?php echo $i;?>,
			color:'#000000',
			lineWidth: 1   ,
			dashStyle: 'LongDashDot',
			marker: {
					fillColor: '#000000',//点填充色
                    lineColor: '#000000',//点边框色
                    enabled: true,
                    symbol: 'circle',//曲线点类型："circle", "square", "diamond", "triangle","triangle-down"，默认是"circle"
                    radius: 2 //曲线点半径，默认是4
                    
                },
			dataLabels: {
                    enabled: false
                }
        }
		<?php
		if ( $i < (count($DATA_ARR)-1)) echo ",";
		
		
		}
		 ?>
		 
		 
		
		]

    });
});





////////////////////////// ECPM(RPM) by month ///////////////////////////

$(function () {

<?php 
$no_color	=0;
 for($i=0;$i < count($DATA_ARR);$i++) 
{  

$str_ECPM = monthkArrMappingLinear($DATA_ARR[$i]['ECPM']);
		 ?>
    <?php echo monthLinearReturnJSArrayAll($DATA_ARR[$i]['ECPM'],"ECPM_arrdata".$i,"ECPM_local_arrdata".$i);?>  
	
	var ECPM_data<?php echo $i ;?> = [<?php echo $str_ECPM ;?>];
	var ECPM_myRegression<?php echo $i ;?> = regression('linear', ECPM_data<?php echo $i ;?>);
 	var ECPM_linearArr<?php echo $i ;?>= new Array();	
	
	
	for(var i=0;i < ECPM_local_arrdata<?php echo $i ;?>.length ;i++){
	    var tempData = ECPM_local_arrdata<?php echo $i ;?>[i];
		if( tempData == -1 ){
			ECPM_linearArr<?php echo $i ;?>[i] = "''";
		}else{ 
			ECPM_linearArr<?php echo $i ;?>[i] = Math.round(ECPM_myRegression<?php echo $i ;?>.points[tempData][1]*1000)/1000;
		}
	}

		<?php
		
		}
?>
	
	
    $('#containerCFD').highcharts({
        chart: {
            type: 'line'
        },
        title: {
            text: ' ECPM(RPM) by monthh '
        },
        subtitle: {
            text: ' ECPM'
        },
        xAxis: {
            categories: [<?php echo $categories;?>]//['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
        },
        yAxis: {
            title: {
                text: 'request'
            }
        },
        plotOptions: {
            line: {
                dataLabels: {
                    enabled: true
                },
                enableMouseTracking: false
            }
        },
		
		series: [
		<?php 

		
		
		for($i=0;$i < count($DATA_ARR);$i++) 
{ 
       $str = monthkArrMapping($DATA_ARR[$i]['ECPM']);
		 ?>
        {
            name: 'ECPM <?php echo $DATA_ARR[$i]['YearMonth']?>',
            data: [<?php echo $str;?>] ,
			color: <?php echo $line_color[$no_color]?> ,
			lineWidth: 2  ,
			enableMouseTracking: true,
			dataLabels: {
                enabled: true,
				style: {"color": <?php echo $line_color[$no_color]?> }
			}
        }
		<?php
		if ( $i < count($DATA_ARR)) echo ",";
		
		$no_color++;
		}
		 
		
		  for($i=0;$i < count($DATA_ARR);$i++) 
{ 
		 ?>
       {
            name: 'ECPM Linear <?php echo $DATA_ARR[$i]['YearMonth']?>',
            data: ECPM_linearArr<?php echo $i;?>,
			color:'#000000',
			lineWidth: 1   ,
			dashStyle: 'LongDashDot',
			marker: {
					fillColor: '#000000',//点填充色
                    lineColor: '#000000',//点边框色
                    enabled: true,
                    symbol: 'circle',//曲线点类型："circle", "square", "diamond", "triangle","triangle-down"，默认是"circle"
                    radius: 2 //曲线点半径，默认是4
                    
                },
			dataLabels: {
                    enabled: false
                }
        }
		<?php
		if ( $i < (count($DATA_ARR)-1)) echo ",";
		
		
		}
		 ?>
		 
		 
		
		]

    });
});




////////////////////////// 点击收入-元(Revenue-RMB) by month’) ///////////////////////////

$(function () {

<?php 
$no_color	=0;
 for($i=0;$i < count($DATA_ARR);$i++) 
{  
 
$str_Revenue = monthkArrMappingLinear($DATA_ARR[$i]['Revenue']);
 
		 ?>
    <?php echo monthLinearReturnJSArrayAll($DATA_ARR[$i]['Revenue'],"Revenue_arrdata".$i,"Revenue_local_arrdata".$i);?>  
  
	
	var Revenue_data<?php echo $i ;?> = [<?php echo $str_Revenue ;?>];
	var Revenue_myRegression<?php echo $i ;?> = regression('linear', Revenue_data<?php echo $i ;?>);
 	var Revenue_linearArr<?php echo $i ;?>= new Array();	
	
	
	for(var i=0;i < Revenue_local_arrdata<?php echo $i ;?>.length ;i++){
	    var tempData = Revenue_local_arrdata<?php echo $i ;?>[i];
		if( tempData == -1 ){
			Revenue_linearArr<?php echo $i ;?>[i] = "''";
		}else{ 
			Revenue_linearArr<?php echo $i ;?>[i] = Math.round(Revenue_myRegression<?php echo $i ;?>.points[tempData][1]);
		}
	}
	
			<?php
		
		}
?>
	
	
    $('#containerCFE').highcharts({
        chart: {
            type: 'line'
        },
        title: {
            text: ' 点击收入-元(Revenue-RMB) by month’) '
        },
        subtitle: {
            text: ' (Revenue-RMB/Sougou'
        },
        xAxis: {
            categories: [<?php echo $categories;?>]//['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
        },
        yAxis: {
            title: {
                text: 'request'
            }
        },
        plotOptions: {
            line: {
                dataLabels: {
                    enabled: true
                },
                enableMouseTracking: false
            }
        },
		
		series: [
		<?php 

		
		
		for($i=0;$i < count($DATA_ARR);$i++) 
{ 
       $str = monthkArrMapping($DATA_ARR[$i]['Revenue']);
		 ?>
        {
            name: 'Revenue <?php echo $DATA_ARR[$i]['YearMonth']?>',
            data: [<?php echo $str;?>] ,
			color: <?php echo $line_color[$no_color]?> ,
			lineWidth: 2  ,
			enableMouseTracking: true,
			dataLabels: {
                enabled: true,
				style: {"color": <?php echo $line_color[$no_color]?> }
			}
        }
		<?php
		if ( $i < count($DATA_ARR)) echo ",";
		
		$no_color++;
		}
		 
		
		  for($i=0;$i < count($DATA_ARR);$i++) 
{ 
		 ?>
       {
            name: 'Revenue Linear <?php echo $DATA_ARR[$i]['YearMonth']?>',
            data: Revenue_linearArr<?php echo $i;?>,
			color:'#000000',
			lineWidth: 1   ,
			dashStyle: 'LongDashDot',
			marker: {
					fillColor: '#000000',//点填充色
                    lineColor: '#000000',//点边框色
                    enabled: true,
                    symbol: 'circle',//曲线点类型："circle", "square", "diamond", "triangle","triangle-down"，默认是"circle"
                    radius: 2 //曲线点半径，默认是4
                    
                },
			dataLabels: {
                    enabled: false
                }
        }
		<?php
		if ( $i < (count($DATA_ARR)-1)) echo ",";
		
		
		}
		 ?>
		 
		 
		
		]

    });
});
		</script>
<script src="http://cdn.hcharts.cn/highcharts/highcharts.js"></script>
<script src="http://cdn.hcharts.cn/highcharts/modules/exporting.js"></script>

</head>

<body>
<div id="demo">
  <div id="demo_content">
    <div class="page-header">
      <h1>sougou traffic SumFile trend by <span class="STYLE1">month</span></h1>
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
    </p>	<br />
	            
	<table width="600" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="150"><a href="sumfile.php">normal tread</a></td>
        <td width="150"><a href="sumfileRegression.php">Linear Regression</a></td>
        <td width="150"><a href="sumfileweek.php">by Week</a></td>
        <td width="150"><a href="sumfilemonth.php"> by Month</a></td><td width="150"><a href="sumfilemixed.php"> mixed trend</a></td>
      </tr>
    </table><p>
	<form   action='sumfilemonth.php' method='get'>
	startdate:<input type="text" id="startdate" name="startdate" size="20" value="<?php echo $startdate ; ?>"><br> 
	stopdate:<input type="text" id="stopdate" name="stopdate" size="20" value="<?php echo $stopdate ; ?>"><br><input name="submit" value="submit" id="submit"  type="submit" />
	</form>
	</p>
    <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div><br><br>
	<div id="container1" style="min-width: 310px; height: 400px; margin: 0 auto"></div><br><br>
      <div id="containerIP" style="min-width: 310px; height: 400px; margin: 0 auto"></div><br><br>
	<div id="containerIPF" style="min-width: 310px; height: 400px; margin: 0 auto"></div><br><br>
      <div id="containerC" style="min-width: 310px; height: 400px; margin: 0 auto"></div><br><br>
	<div id="containerCF" style="min-width: 310px; height: 400px; margin: 0 auto"></div><br><br>
	<div id="containerCFD" style="min-width: 310px; height: 400px; margin: 0 auto"></div><br><br>
	<div id="containerCFE" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
  </div>

</div>
<p>&nbsp;</p>
</body>
</html>
