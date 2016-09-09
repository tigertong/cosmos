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
	print "<label>  <input type='radio' name='dbname' value='SumFileinfo' />  SumFileinfo</label></form>";
}

?>

</div>
</div>
</body>
</html>
