<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="initial-scale=1.0, width=device-width" />

<title>stats</title>
	<link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="./css/style.css">
<script src="./css/hm.js"></script><script src="./css/share.js"></script><link rel="stylesheet" href="./css/share_style0_24.css"></head>
		<script type="text/javascript" charset="UTF-8" src="http://js.cit.api.here.com/se/2.5.4/jsl.js?with=all"></script>
		<!-- JavaScript for example container (NoteContainer & Logger)  -->
		<script type="text/javascript" charset="UTF-8" src="http://developer.here.com/apiexplorer/examples/templates/js/exampleHelpers.js"></script>
		

<style type="text/css">
			html {
				overflow:hidden;
			}
			
			body {
				margin: 0;
				padding: 0;
				overflow: hidden;
				width: 100%;
				height: 100%;
				position: absolute;
			}
			
			#mapContainer {
				width: 100%;
				height: 100%;
				left: 0;
				top: 0;
				position: absolute;
			}
		</style>

</head>

<body>

<?php
$contentdate = $_GET["date"];	
$submitdate  = "2016-08-22";

require_once("./db.conf.php");

if (isset($_GET["date"])) {
$submitdate = $_GET["date"];
$result = mysqli_query($db,"SELECT User_Lat ,User_Long ,sum(NUMBEROFIP) as NUMBEROFIP  FROM Locationinfo where date='$contentdate'  group by User_Lat ,User_Long   ");

$i=0;
$str ="";
//{ value: 4.5, latitude: -7.789, longitude: -74.622  },
while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
 {
 
 if($row['User_Lat']!="" && $row['User_Long'] !="" ){
 $str .= "{ value: ".$row['NUMBEROFIP'].", latitude: ".$row['User_Lat'].", longitude: ".$row['User_Long']."  }," ;
}
 }

mysqli_close($db);

}
$str = substr($str ,0, strlen($str)-1);	
	?>
<div id="mapContainer"></div>
		<script type="text/javascript" id="exampleJsSource">
/*	Setup authentication app_id and app_code 
*	WARNING: this is a demo-only key
*	please register for an Evaluation, Base or Commercial key for use in your app.
*	Just visit http://developer.here.com/get-started for more details. Thank you!
*/
nokia.Settings.set("app_id", "DemoAppId01082013GAL"); 
nokia.Settings.set("app_code", "AJKnXv84fjrb0KIHawS0Tg");
// Use staging environment (remove the line for production environment)
nokia.Settings.set("serviceMode", "cit");

// Get the DOM node to which we will append the map
var mapContainer = document.getElementById("mapContainer");

// Create a map inside the map container DOM node
var map = new nokia.maps.map.Display(mapContainer, {
	components: [
		// Add the behavior component to allow panning / zooming of the map
		new nokia.maps.map.component.Behavior()
	],
	zoomLevel: 2
});

var heatmapProvider;
try {
	// Creating Heatmap overlay
	heatmapProvider = new nokia.maps.heatmap.Overlay({
		// This is the greatest zoom level for which the overlay will provide tiles
		max: 20,
		// This is the overall opacity applied to this overlay
		opacity: 0.6,
		// Defines if our heatmap is value or density based
		type: "value",
		// Coarseness defines the resolution with which the heat map is created.
		coarseness: 2
	});
} catch (e) {
	// The heat map overlay constructor throws an exception if there
	// is no canvas support in the browser
	alert(typeof e == "string" ? e : e.message);
}
// Only start loading data if the heat map overlay was successfully created
if (heatmapProvider) {
	// Trigger the load of data, after the map emmits the "displayready" event
	map.addListener("displayready", function () {
		/* We load a data file containing data points for the heat map
		 * LoadScript is an helper function and not part of the Maps API for JavaScript
		 * See exampleHelpers.js for implementation details 
		 */
		 
		 var data = [
	<?php echo $str ;?>
];
		 
		for (var i = 0; i < data.length; i++) {
					if (data[i].value < 4.5) {
						data.splice(i, 1);
					}
				}
				
				// Rendering the heat map overlay onto the map
				heatmapProvider.addData(data);
				map.overlays.add(heatmapProvider);
	}, false);
}
/* We create a UI notecontainer for example description
 * NoteContainer is a UI helper function and not part of the Maps API for JavaScript
 * See exampleHelpers.js for implementation details 
 */


		</script>
	



</body>
</html>
