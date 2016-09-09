<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
</head>

<body>

<?php
/*$fname = $_FILES["myfile"]["name"]; 
$dbname = $_REQUEST["dbname"]; 
print_r( $_FILES["myfile"]);
print_r ( $_REQUEST["dbname"]); 


$do = copy($_files["myfile"]["tmp_name"],$fname); 
if ($do){ 
echo"导入数据成功<br>"; 
}else{ 
echo "$do $error"; 
}
 
error_reporting(0);// 导入csv格式的文件 
$connect=mysql_connect("localhost","sougou","12346") or die("could not connect to database"); 
mysql_select_db("sougou",$connect) or die (mysql_error()); 
mysql_query("set names 'utf-8'"); 
$fname = $_files["myfile"]["tmp_name"]; 
$handle=fopen("$fname","r"); 
while($data=fgetcsv($handle,10000,"	")){ 

if($dbname=="statinfo"){
$date=explode(" ", $data[1]);
$q="insert into $dbname (date ,IP_COUNT INT(10),REFFER_COUNT,ROWQUERY_COUNT ,UA_COUNT ) values ('$date[0]','$data[1]','$data[2]','$data[3]','$data[4]')";
}
 
mysql_query($q) or die (mysql_error()); 
}
fclose($handle); */
//echo "<meta http-equiv="refresh" content="1;url=inputdata.php">1秒钟转入列表页,请稍等.";
?>  
<form enctype="multipart/form-data" action="inputdata1.php" method="post"> 
<p>导入cvs数据 <input name="myfile" type="file"> <input value="提交" type="submit"> </p>
<br>
  <label>
  <input type="radio" name="dbname" value="statinfo" checked="checked" />
  statinfo</label>
 
  <label>
  <input type="radio" name="dbname" value="IPinfo" />
  IPinfo</label>
    <label>
  <input type="radio" name="dbname" value="UAinfo" />
  UAinfo</label>
    <label>
  <input type="radio" name="dbname" value="RFinfo" />
  RFinfo</label>
    <label>
  <input type="radio" name="dbname" value="QUinfo" />
  QUinfo</label>
</form>
</body>
</html>
