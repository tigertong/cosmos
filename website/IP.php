<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="initial-scale=1.0, width=device-width" />

<title>stats</title>
	<link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="./css/style.css">
<script src="./css/hm.js"></script><script src="./css/share.js"></script><link rel="stylesheet" href="./css/share_style0_24.css"></head>

<script src="http://js.api.here.com/v3/3.0/mapsjs-core.js"
 type="text/javascript" charset="utf-8"></script>
<script src="http://js.api.here.com/v3/3.0/mapsjs-service.js"
 type="text/javascript" charset="utf-8"></script>


</head>

<body>
<?php

$submitdate  = "2016-08-22";

if (isset($_GET["submit"]) && isset($_GET["date"])) {
$submitdate = $_GET["date"];
}
?>	

<div id="demo">
  <div id="demo_content">
    <div class="page-header">
      <h1>sougou IP HeatMap  <?php echo $submitdate; ?> </h1>
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
    </p>
	</div>
    <div class="clear"></div>
  </div>
  <div class="clear"></div>
</div>
<p>
	<form   action='IP.php' method='get'>
	date:<input type="text" id="date" name="date" size="20" value="<?php echo $submitdate; ?>"> <input name="submit" value="submit" id="submit"  type="submit" />
	</form>
	</p><p><!--iframe frameborder=0 width=1200 height=700 marginheight=0 marginwidth=0 scrolling=yes src="./IPnew.php?date=<?php echo $submitdate; ?>"></iframe--></p>
    
	
	
 <br> <br>
    <div id="demo_url11">
	TOP 30 State List<br>
	<table width="200" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td>User_CountryIso</td>
    <td>User_State</td>
    <td>NUMBEROFIP</td>
  </tr>
<?php
$contentdate = $_GET["date"];	

require_once("./db.conf.php");
echo $_GET['submit'].$_GET['date']."<br/>";
if (isset($_GET["submit"]) && isset($_GET["date"])) {

$result = mysqli_query($db,"SELECT *  FROM Stateinfo where date='$contentdate' order by  NUMBEROFIP desc limit 0,30 ");
while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
 {
 
  
  echo "  <tr>    <td>&nbsp;&nbsp;".$row['User_CountryIso']."&nbsp;&nbsp;</td>    <td>&nbsp;&nbsp;".$row['User_State']."&nbsp;&nbsp;</td>    <td>&nbsp;&nbsp;".$row['NUMBEROFIP']
  ."&nbsp;&nbsp;</td> </tr>  ";

 }
	//mysqli_close($db);

}
	//mysqli_close($db);
	?>
 
</table>	<br>
	<br>
	<br>
	<br>
	TOP 30 ip list<br>
	
	<table width="200" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td  style="width: 110px">User_Ip</td>
    <td>NUMBEROFIP</td>
    <td>User_CountryIso</td>
    <td>User_State</td>
    <td>User_City</td>
    <td>User_Lat</td>
    <td>User_Long</td>
  </tr>

		<?php
$contentdate = $_GET["date"];	

require_once("./db.conf.php");
echo $_GET['submit'].$_GET['date']."<br/>";
if (isset($_GET["submit"]) && isset($_GET["date"])) {

$result = mysqli_query($db,"SELECT *  FROM ipinfo where date='$contentdate' order by  NUMBEROFIP desc limit 0,30 ");
while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
 {
 
  
  echo "  <tr>    <td>&nbsp;&nbsp;".$row['User_Ip']."&nbsp;&nbsp;</td>    <td>&nbsp;&nbsp;".$row['NUMBEROFIP']."&nbsp;&nbsp;</td>    <td>&nbsp;&nbsp;".$row['User_CountryIso']
  ."&nbsp;&nbsp;</td>    <td>&nbsp;&nbsp;".$row['User_State']."&nbsp;&nbsp;</td>    <td>&nbsp;&nbsp;".$row['User_City']."&nbsp;&nbsp;</td>    <td>&nbsp;&nbsp;".$row['User_Lat']."&nbsp;&nbsp;</td>    <td>&nbsp;&nbsp;".$row['User_Long']."&nbsp;&nbsp</td>  </tr>  ";

 }
	//mysqli_close($db);

}
	mysqli_close($db);
	?>
 
 
</table>
</body>
</html>
