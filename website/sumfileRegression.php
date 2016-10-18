<?php ini_set('date.timezone','Asia/Shanghai'); ?>
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
	
function getCategory($start,$stop){
	$categories_1 = "";
	$i=90;
	$type=0;
	$stop_date = $start;
	while($type==0){
		$categories_1	 .= "'".$stop_date."',";
		if($stop_date == $stop)$type=1;
		$i++;
		if($i==90)$type=1;
		$stop_date = date("Y-m-d", strtotime("$stop_date +1 day"));
		
	}
	$categories_1 = substr($categories_1 ,0, strlen($categories_1)-1);
	return $categories_1;
}
	
$contentdate = $_GET["date"];	
require_once("./db.conf.php");
echo $_GET['submit'].$_GET['startdate'].$_GET["stopdate"];
$startdate = "2016-08-05";
$stopdate = "2016-09-05";

if (isset($_GET["submit"]) && isset($_GET["startdate"]) && isset($_GET["stopdate"])) {
$startdate = $_GET["startdate"];
$stopdate = $_GET["stopdate"];
$categories_1 =  getCategory($startdate,$stopdate);


$number=1;
$result = mysqli_query($db,"SELECT *  FROM sumfileinfo where date>='$startdate'  and  date<='$stopdate' order by date asc");

$categories="";

$SRPV_filtered = "";
$SRPV = "";
$Impressions_filtered="";
$Impressions="";
$Clicks_filtered="";
$Clicks="";
$DSQ="";

$BSRPVFile="";
$BSRPVFileFiltered="";

while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
 {
 
 /*
 IP_COUNT INT(10),
REFFER_COUNT INT(10),
ROWQUERY_COUNT INT(10),
UA_COUNT INT(10) 
 */
$SRPV_filtered .= "".$row['SRPV_filtered'].",";
$SRPV  .= "".$row['SRPV'].",";
$Impressions_filtered  .= "".$row['Impressions_filtered'].",";
$Impressions  .= "".$row['Impressions'].",";
$Clicks_filtered  .= "".$row['Clicks_filtered'].",";
$Clicks  .= "".$row['Clicks'].",";
$DSQ  .= "".$row['DSQ'].",";

$categories	 .= "'".$row['date']."',";

if($SRPV_filtered == NULL )$SRPV_filtered=0;
if($SRPV == NULL)$SRPV=0;
if($Impressions_filtered=="")$Impressions_filtered=0;
if($Impressions=="")$Impressions=0;
if($Clicks_filtered=="")$Clicks_filtered=0;
if($Clicks=="")$Clicks=0;
if($DSQ=="")$DSQ=0;

$BSRPVFile  .= "".$row['BSRPVFile'].",";
$BSRPVFileFiltered  .= "".$row['BSRPVFileFiltered'].",";
if($BSRPVFileFiltered=="")$BSRPVFileFiltered=0;
if($BSRPVFile=="")$BSRPVFile=0;


$SRPV_Linear .= "[".$number.",".$row['SRPV']."],";
$SRPV_filtered_Linear .= "[".$number.",".$row['SRPV_filtered']."],";
$DSQ_Linear .= "[".$number.",".$row['DSQ']."],";
$Impressions_Linear .= "[".$number.",".$row['Impressions']."],";
$Impressions_filtered_Linear .= "[".$number.",".$row['Impressions_filtered']."],";
$Clicks_Linear .= "[".$number.",".$row['Clicks']."],";
$Clicks_filtered_Linear .= "[".$number.",".$row['Clicks_filtered']."],";


$BSRPVFile_Linear .= "[".$number.",".$row['BSRPVFile']."],";
$BSRPVFileFiltered_Linear .= "[".$number.",".$row['BSRPVFileFiltered']."],";

$number++;
}

$SRPV_filtered = substr($SRPV_filtered ,0, strlen($SRPV_filtered)-1);
$SRPV = substr($SRPV ,0, strlen($SRPV)-1);
$Impressions_filtered = substr($Impressions_filtered ,0, strlen($Impressions_filtered)-1);
$Impressions = substr($Impressions ,0, strlen($Impressions)-1);
$Clicks_filtered = substr($Clicks_filtered ,0, strlen($Clicks_filtered)-1);
$Clicks = substr($Clicks ,0, strlen($Clicks)-1);
$DSQ = substr($DSQ ,0, strlen($DSQ)-1);
$categories = substr($categories ,0, strlen($categories)-1);
$SRPV_Linear = substr($SRPV_Linear ,0, strlen($SRPV_Linear)-1); 
$SRPV_filtered_Linear = substr($SRPV_filtered_Linear ,0, strlen($SRPV_filtered_Linear)-1); 
$DSQ_Linear = substr($DSQ_Linear ,0, strlen($DSQ_Linear)-1); 
$Impressions_Linear = substr($Impressions_Linear ,0, strlen($Impressions_Linear)-1); 
$Impressions_filtered_Linear = substr($Impressions_filtered_Linear ,0, strlen($Impressions_filtered_Linear)-1); 
$Clicks_Linear = substr($Clicks_Linear ,0, strlen($Clicks_Linear)-1); 
$Clicks_filtered_Linear = substr($Clicks_filtered_Linear ,0, strlen($Clicks_filtered_Linear)-1); 

$BSRPVFileFiltered = substr($BSRPVFileFiltered ,0, strlen($BSRPVFileFiltered)-1); 
$BSRPVFile = substr($BSRPVFile ,0, strlen($BSRPVFile)-1); 
$BSRPVFileFiltered_Linear = substr($BSRPVFileFiltered_Linear ,0, strlen($BSRPVFileFiltered_Linear)-1); 
$BSRPVFile_Linear = substr($BSRPVFile_Linear ,0, strlen($BSRPVFile_Linear)-1); 
	//mysqli_close($db);

$number=1;
$result1 = mysqli_query($db,"SELECT *  FROM Sogou_data where date>='$startdate'  and  date<='$stopdate' order by date asc");



$SRPV_Raw = "";
$SRPV_Anti_fraud = "";
$Impressions_Raw="";
$Impressions_Anti_fraud="";
$Clicks_Raw="";
$Clicks_Anti_fraud="";


while($row = mysqli_fetch_array($result1,MYSQLI_ASSOC))
 {
 /*
 IP_COUNT INT(10),
REFFER_COUNT INT(10),
ROWQUERY_COUNT INT(10),
UA_COUNT INT(10) 
 */
$SRPV_Raw .= "".$row['SRPV_Raw'].",";
$SRPV_Anti_fraud  .= "".$row['SRPV_Anti_fraud'].",";
$Impressions_Raw  .= "".$row['Impressions_Raw'].",";
$Impressions_Anti_fraud  .= "".$row['Impressions_Anti_fraud'].",";
$Clicks_Raw  .= "".$row['Clicks_Raw'].",";
$Clicks_Anti_fraud  .= "".$row['Clicks_Anti_fraud'].",";
$ECPM  .= "".$row['ECPM'].",";
$Revenue  .= "".$row['Revenue'].",";


if($SRPV_Raw == NULL )$SRPV_Raw=0;
if($SRPV_Anti_fraud == NULL)$SRPV_Anti_fraud=0;
if($Impressions_Raw=="")$Impressions_Raw=0;
if($Impressions_Anti_fraud=="")$Impressions_Anti_fraud=0;
if($Clicks_Raw=="")$Clicks_Raw=0;
if($Clicks_Anti_fraud=="")$Clicks_Anti_fraud=0;

$SRPV_Raw_Linear .= "[".$number.",".$row['SRPV_Raw']."],";
$SRPV_Anti_fraud_Linear .= "[".$number.",".$row['SRPV_Anti_fraud']."],";
$Impressions_Raw_Linear .= "[".$number.",".$row['Impressions_Raw']."],";
$Impressions_Anti_fraud_Linear .= "[".$number.",".$row['Impressions_Anti_fraud']."],";
$Clicks_Raw_Linear .= "[".$number.",".$row['Clicks_Raw']."],";
$Clicks_Anti_fraud_Linear .= "[".$number.",".$row['Clicks_Anti_fraud']."],";

$ECPM_Linear .= "[".$number.",".$row['ECPM']."],";
$Revenue_Linear .= "[".$number.",".$row['Revenue']."],";

$number++;

}

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
$ECPM_Linear = substr($ECPM_Linear ,0, strlen($ECPM_Linear)-1); 
$Revenue_Linear = substr($Revenue_Linear ,0, strlen($Revenue_Linear)-1);
$ECPM = substr($ECPM ,0, strlen($ECPM)-1);
$Revenue = substr($Revenue ,0, strlen($Revenue)-1);
	//mysqli_close($db);
	
if(strlen($categories) < strlen($categories_1)) $categories = $categories_1;

}
	
	?>		
		
		
		<script type="text/javascript" >
// colors: ['#058DC7', '#50B432', '#ED561B', '#DDDF00', '#24CBE5', '#64E572', '#FF9655', '#FFF263', '#6AF9C4'] 
$(function () {

	var SRPV_data = [<?php echo $SRPV_Linear ;?>];
	var SRPV_myRegression = regression('linear', SRPV_data);
 	var SRPV_linearArr= new Array();	
			
	for(var i=0;i < SRPV_myRegression.points.length ;i++){
		 SRPV_linearArr[i] = Math.round(SRPV_myRegression.points[i][1]);
	}
	
	var SRPV_Raw_data = [<?php echo $SRPV_Raw_Linear ;?>];
	var SRPV_Raw_myRegression = regression('linear', SRPV_Raw_data);
 	var SRPV_Raw_linearArr= new Array();	
			
	for(var i=0;i < SRPV_Raw_myRegression.points.length ;i++){
		 SRPV_Raw_linearArr[i] = Math.round(SRPV_Raw_myRegression.points[i][1]);
	}
	
    $('#container').highcharts({
        chart: {
            type: 'line'
        },
        title: {
            text: ' 总搜索量(Raw SRPV) '
        },
        subtitle: {
            text: ' SRPV/Sougou'
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
        series: [{
            name: 'SML',
            data: [<?php echo $SRPV;?>] ,//[7.0, 6.9, 9.5, 14.5, 18.4, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6],
			color:'#058DC7' ,
			lineWidth: 3  ,
			enableMouseTracking: true,
			dataLabels: {
                enabled: true,
				style: {"color": "#058DC7" }
			}
        },{
            name: 'Sogou',
            data: [<?php echo $SRPV_Raw;?> ], //[7.0, 6.9, 9.5, 14.5, 18.4, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6],
			color: '#50B432' ,
			lineWidth: 3   ,
			enableMouseTracking: true,
			dataLabels: {
                enabled: true,
				style: {"color": "#50B432" }
			}
        },{
            name: 'SML Linear',
            data: SRPV_linearArr,
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
        },{
            name: 'Sogou Linear',
            data: SRPV_Raw_linearArr,
			color:'#000000'  ,
			lineWidth: 1  ,
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
		
		]
    });
});
$(function () {
	var SRPV_filtered_data = [<?php echo $SRPV_filtered_Linear ;?>];
	var SRPV_filtered_myRegression = regression('linear', SRPV_filtered_data);
 	var SRPV_filtered_linearArr= new Array();	
			
	for(var i=0;i < SRPV_filtered_myRegression.points.length ;i++){
		 SRPV_filtered_linearArr[i] = Math.round(SRPV_filtered_myRegression.points[i][1]);
	}
	
	var DSQ_data = [<?php echo $DSQ_Linear ;?>];
	var DSQ_myRegression = regression('linear', DSQ_data);
 	var DSQ_linearArr= new Array();	
			
	for(var i=0;i < DSQ_myRegression.points.length ;i++){
		 DSQ_linearArr[i] = Math.round(DSQ_myRegression.points[i][1]);
	}


	var SRPV_Anti_fraud_data = [<?php echo $SRPV_Anti_fraud_Linear ;?>];
	var SRPV_Anti_fraud_myRegression = regression('linear', SRPV_Anti_fraud_data);
 	var SRPV_Anti_fraud_linearArr= new Array();	
			
	for(var i=0;i < SRPV_Anti_fraud_myRegression.points.length ;i++){
		 SRPV_Anti_fraud_linearArr[i] = Math.round(SRPV_Anti_fraud_myRegression.points[i][1]);
	}

    $('#container1').highcharts({
        chart: {
            type: 'line'
        },
        title: {
            text: ' 有效搜索量(SRPV-filtered) '
        },
        subtitle: {
            text: ' SRPV_filtered/Sougou/DSQ'
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
		{
            name: 'SML',
            data: [<?php echo $SRPV_filtered;?>]  ,
			color:'#058DC7' ,
			lineWidth: 3  ,
			enableMouseTracking: true,
			dataLabels: {
                enabled: true,
				style: {"color": "#058DC7" }
			}
        },{
            name: 'DSQ',
            data: [<?php echo $DSQ;?>]  ,
			color:'#50B432' ,
			lineWidth: 3  ,
			enableMouseTracking: true,
			dataLabels: {
                enabled: true,
				style: {"color": "#50B432" }
			}
        },{
            name: 'Sogou',
            data: [<?php echo $SRPV_Anti_fraud;?>]  ,
			color:'#ED561B' ,
			lineWidth: 3  ,
			enableMouseTracking: true,
			dataLabels: {
                enabled: true,
				style: {"color": "#ED561B" }
			}
        },{
            name: 'SML Linear',
            data: SRPV_filtered_linearArr,
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
        },{
            name: 'DSQ Linear',
            data: DSQ_linearArr,
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
        },{
            name: 'Sogou Linear',
            data: SRPV_Anti_fraud_linearArr,
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
		
		]
    });
});



$(function () {
	var Impressions_data = [<?php echo $Impressions_Linear ;?>];
	var Impressions_myRegression = regression('linear', Impressions_data);
 	var Impressions_linearArr= new Array();	
			
	for(var i=0;i < Impressions_myRegression.points.length ;i++){
		 Impressions_linearArr[i] = Math.round(Impressions_myRegression.points[i][1]);
	}
	
	var Impressions_Raw_data = [<?php echo $Impressions_Raw_Linear ;?>];
	var Impressions_Raw_myRegression = regression('linear', Impressions_Raw_data);
 	var Impressions_Raw_linearArr= new Array();	
			
	for(var i=0;i < Impressions_Raw_myRegression.points.length ;i++){
		 Impressions_Raw_linearArr[i] = Math.round(Impressions_Raw_myRegression.points[i][1]);
	}

    $('#containerIP').highcharts({
        chart: {
            type: 'line'
        },
        title: {
            text: ' 总推广展示(Raw Impressions) '
        },
        subtitle: {
            text: ' Impressions/Sougou'
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
        series: [{
            name: 'SML',
            data: [<?php echo $Impressions;?>]  ,
			color:'#058DC7' ,
			lineWidth: 3  ,
			enableMouseTracking: true,
			dataLabels: {
                enabled: true,
				style: {"color": "#058DC7" }
			}//[7.0, 6.9, 9.5, 14.5, 18.4, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
        },{
            name: 'Sogou',
            data: [<?php echo $Impressions_Raw;?>] ,
			color:'#50B432' ,
			lineWidth: 3  ,
			enableMouseTracking: true,
			dataLabels: {
                enabled: true,
				style: {"color": "#50B432" }
			}//[7.0, 6.9, 9.5, 14.5, 18.4, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
        } ,{
            name: 'SML Linear',
            data: Impressions_linearArr,
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
        },{
            name: 'Sogou Linear',
            data: Impressions_Raw_linearArr,
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
		
		]
    });
});
$(function () {
	var Impressions_Anti_fraud_data = [<?php echo $Impressions_Anti_fraud_Linear ;?>];
	var Impressions_Anti_fraud_myRegression = regression('linear', Impressions_Anti_fraud_data);
 	var Impressions_Anti_fraud_linearArr= new Array();	
			
	for(var i=0;i < Impressions_Anti_fraud_myRegression.points.length ;i++){
		 Impressions_Anti_fraud_linearArr[i] = Math.round(Impressions_Anti_fraud_myRegression.points[i][1]);
	}
	
	var Impressions_filtered_data = [<?php echo $Impressions_filtered_Linear ;?>];
	var Impressions_filtered_myRegression = regression('linear', Impressions_filtered_data);
 	var Impressions_filtered_linearArr= new Array();	
			
	for(var i=0;i < Impressions_filtered_myRegression.points.length ;i++){
		 Impressions_filtered_linearArr[i] = Math.round(Impressions_filtered_myRegression.points[i][1]);
	}
    $('#containerIPF').highcharts({
        chart: {
            type: 'line'
        },
        title: {
            text: ' 有效推广展示(Impressions-filtered) '
        },
        subtitle: {
            text: ' Impressions_filtered/Sougou'
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
	{
           name: 'SML',
           data: [<?php echo $Impressions_filtered;?>]   ,
			color:'#058DC7' ,
			lineWidth: 3  ,
			enableMouseTracking: true,
			dataLabels: {
                enabled: true,
				style: {"color": "#058DC7" }
			}
       },
	    {
            name: 'Sogou',
            data:  [<?php echo $Impressions_Anti_fraud;?>]  ,
			color:'#50B432' ,
			lineWidth: 3  ,
			enableMouseTracking: true,
			dataLabels: {
                enabled: true,
				style: {"color": "#50B432" }
			}
        },{
            name: 'SML Linear',
            data: Impressions_filtered_linearArr,
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
        },{
            name: 'Sogou Linear',
            data: Impressions_Anti_fraud_linearArr,
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
		
		]
    });
});


$(function () {
	var Clicks_data = [<?php echo $Clicks_Linear ;?>];
	var Clicks_myRegression = regression('linear', Clicks_data);
 	var Clicks_linearArr= new Array();	
			
	for(var i=0;i < Clicks_myRegression.points.length ;i++){
		 Clicks_linearArr[i] = Math.round(Clicks_myRegression.points[i][1]);
	}
	
	var Clicks_Raw_data = [<?php echo $Clicks_Raw_Linear ;?>];
	var Clicks_Raw_myRegression = regression('linear', Clicks_Raw_data);
 	var Clicks_Raw_linearArr= new Array();	
			
	for(var i=0;i < Clicks_Raw_myRegression.points.length ;i++){
		 Clicks_Raw_linearArr[i] = Math.round(Clicks_Raw_myRegression.points[i][1]);
	}
    $('#containerC').highcharts({
        chart: {
            type: 'line'
        },
        title: {
            text: '总点击量(Raw Clicks)'
        },
        subtitle: {
            text: ' Clicks/Sougou'
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
        series: [{
            name: 'SML',
            data: [<?php echo $Clicks;?>]  ,
			color:'#058DC7' ,
			lineWidth: 3  ,
			enableMouseTracking: true,
			dataLabels: {
                enabled: true,
				style: {"color": "#058DC7" }
			}//[7.0, 6.9, 9.5, 14.5, 18.4, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
        },{
            name: 'Sogou',
            data: [ <?php echo $Clicks_Raw; ?>] ,
			color:'#50B432' ,
			lineWidth: 3  ,
			enableMouseTracking: true,
			dataLabels: {
                enabled: true,
				style: {"color": "#50B432" }
			}//[7.0, 6.9, 9.5, 14.5, 18.4, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
        } ,{
            name: 'SML Linear',
            data: Clicks_linearArr,
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
        },{
            name: 'Sogou Linear',
            data: Clicks_Raw_linearArr,
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
		
		]
    });
});
$(function () {
	var Clicks_filtered_data = [<?php echo $Clicks_filtered_Linear ;?>];
	var Clicks_filtered_myRegression = regression('linear', Clicks_filtered_data);
 	var Clicks_filtered_linearArr= new Array();	
			
	for(var i=0;i < Clicks_filtered_myRegression.points.length ;i++){
		 Clicks_filtered_linearArr[i] = Math.round(Clicks_filtered_myRegression.points[i][1]);
	}
	
	var Clicks_Anti_fraud_data = [<?php echo $Clicks_Anti_fraud_Linear ;?>];
	var Clicks_Anti_fraud_myRegression = regression('linear', Clicks_Anti_fraud_data);
 	var Clicks_Anti_fraud_linearArr= new Array();	
			
	for(var i=0;i < Clicks_Anti_fraud_myRegression.points.length ;i++){
		 Clicks_Anti_fraud_linearArr[i] = Math.round(Clicks_Anti_fraud_myRegression.points[i][1]);
	}
    $('#containerCF').highcharts({
        chart: {
            type: 'line'
        },
        title: {
            text: ' 有效点击量(Clicks-filtered) '
        },
        subtitle: {
            text: ' Clicks_filtered/Sougou'
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
		{
            name: 'SML',
            data:  [<?php echo $Clicks_filtered;?>] ,
			color:'#058DC7' ,
			lineWidth: 3  ,
			enableMouseTracking: true,
			dataLabels: {
                enabled: true,
				style: {"color": "#058DC7" }
			}
       },
	    {
            name: 'Sogou',
            data:   [<?php echo $Clicks_Anti_fraud;?>] ,
			color:'#50B432' ,
			lineWidth: 3  ,
			enableMouseTracking: true,
			dataLabels: {
                enabled: true,
				style: {"color": "#50B432" }
			}//[7.0, 6.9, 9.5, 14.5, 18.4, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
        } ,{
            name: 'SML Linear',
            data: Clicks_filtered_linearArr,
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
        },{
            name: 'Sogou Linear',
            data: Clicks_Anti_fraud_linearArr,
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
		
		]
    });
});


//////////////////ECPM(RPM)////////////////////
$(function () {
	var ECPM_data = [<?php echo $ECPM_Linear ;?>];
	var ECPM_myRegression = regression('linear', ECPM_data);
 	var ECPM_linearArr= new Array();	
			
	for(var i=0;i < ECPM_myRegression.points.length ;i++){
		 ECPM_linearArr[i] = Math.round(ECPM_myRegression.points[i][1]*1000)/1000;
	}
	//alert(ECPM_linearArr);
	
	$('#containerCF1').highcharts({
        chart: {
            type: 'line'
        },
        title: {
            text: ' ECPM(RPM) '
        },
        subtitle: {
            text: ' ECPM '
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
		{
            name: 'ECPM',
            data:  [<?php echo $ECPM;?>] ,
			color:'#058DC7' ,
			lineWidth: 3  ,
			enableMouseTracking: true,
			dataLabels: {
                enabled: true,
				style: {"color": "#058DC7" }
			}
       },{
            name: 'ECPM Linear',
            data: ECPM_linearArr,
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
		
		]
    });
});


///////////////点击收入-元(Revenue-RMB)’)//////////////
$(function () {
	var Revenue_data = [<?php echo $Revenue_Linear ;?>];
	var Revenue_myRegression = regression('linear', Revenue_data);
 	var Revenue_linearArr= new Array();	
			
	for(var i=0;i < Revenue_myRegression.points.length ;i++){
		 Revenue_linearArr[i] = Math.round(Revenue_myRegression.points[i][1]);
	}
	$('#containerCF2').highcharts({
        chart: {
            type: 'line'
        },
        title: {
            text: ' 点击收入-元(Revenue-RMB) '
        },
        subtitle: {
            text: ' Revenue '
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
		{
            name: 'Revenue',
            data:  [<?php echo $Revenue;?>] ,
			color:'#058DC7' ,
			lineWidth: 3  ,
			enableMouseTracking: true,
			dataLabels: {
                enabled: true,
				style: {"color": "#058DC7" }
			}
       } ,{
            name: 'Revenue Linear',
            data: Revenue_linearArr,
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
		
		]
    });
});



///////////////Bidded-SRPV/////////////
$(function () {
	var BSRPVFile_data = [<?php echo $BSRPVFile_Linear ;?>];
	var BSRPVFile_myRegression = regression('linear', BSRPVFile_data);
 	var BSRPVFile_linearArr= new Array();	
			
	for(var i=0;i < BSRPVFile_myRegression.points.length ;i++){
		 BSRPVFile_linearArr[i] = Math.round(BSRPVFile_myRegression.points[i][1]);
	}
	
	var BSRPVFileFiltered_data = [<?php echo $BSRPVFileFiltered_Linear ;?>];
	var BSRPVFileFiltered_myRegression = regression('linear', BSRPVFileFiltered_data);
 	var BSRPVFileFiltered_linearArr= new Array();	
			
	for(var i=0;i < BSRPVFileFiltered_myRegression.points.length ;i++){
		 BSRPVFileFiltered_linearArr[i] = Math.round(BSRPVFileFiltered_myRegression.points[i][1]);
	}
	
	alert(BSRPVFileFiltered_linearArr);
    $('#containerCF3').highcharts({
        chart: {
            type: 'line'
        },
        title: {
            text: ' Bidded-SRPV '
        },
        subtitle: {
            text: ' Bidded-SRPV '
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
		{
            name: 'Raw Bidded-SRPV_SML',
            data:  [<?php echo $BSRPVFile;?>] ,
			color:'#058DC7' ,
			lineWidth: 3  ,
			enableMouseTracking: true,
			dataLabels: {
                enabled: true,
				style: {"color": "#058DC7" }
			}
       },
	    {
            name: 'Bidded-SRPV-Filterd_SML',
            data:   [<?php echo $BSRPVFileFiltered;?>] ,
			color:'#50B432' ,
			lineWidth: 3  ,
			enableMouseTracking: true,
			dataLabels: {
                enabled: true,
				style: {"color": "#50B432" }
			}//[7.0, 6.9, 9.5, 14.5, 18.4, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
        } ,{
            name: 'Raw Bidded-SRPV_SML Linear',
            data: BSRPVFile_linearArr,
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
        },{
            name: 'Bidded-SRPV-Filterd_SML Linear',
            data: BSRPVFileFiltered_linearArr,
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
		
		]
    });
});
		</script>
<script src="js/highcharts.js"></script>
<script src="js/exporting.js"></script>

</head>

<body>
<div id="demo">
  <div id="demo_content">
    <div class="page-header">
      <h1>sougou traffic SumFile trend <span class="STYLE1">Linear Regression</span></h1>
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
	<form   action='sumfileRegression.php' method='get'>
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
	<div id="containerCF1" style="min-width: 310px; height: 400px; margin: 0 auto"></div><br><br>
	<div id="containerCF2" style="min-width: 310px; height: 400px; margin: 0 auto"></div><br><br>
	<div id="containerCF3" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
  </div>

</div>
<p>&nbsp;</p>
</body>
</html>
