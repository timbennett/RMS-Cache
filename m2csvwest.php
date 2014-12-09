<?php
/* Render latest traffic data as CSV (Westbound M2 route) */
// TODO: Write to a static file so people aren't calling this script all the time.
// TODO: Move database details out of this file
// TODO: Generalise to render CSV for M1/M2/M4/M7 (probably a total rewrite)

echo "Time,Lane Cove Tunnel > Herring Rd,Herring Rd > Beecroft Rd,Beecroft Rd > Pennant Hills Rd,Pennant Hills Rd > Windsor Rd,Windsor Rd > M7\n";

function convert($result){
      // using a function is probably overkill for this   
	    while($item = mysqli_fetch_assoc($result)) {
	    echo $item['timestamp'].",".$item['W1'].",".$item['W2'].",".$item['W3'].",".$item['W4'].",".$item['W5']."\n";
	    }
}

// database connection
$con = mysqli_connect("localhost","","","rms-cache");
$query= "
		SELECT `timestamp`, `WTOTAL`, `W1`, `W2`, `W3`, `W4`, `W5`
		FROM (SELECT `timestamp`, `WTOTAL`, `W1`, `W2`, `W3`, `W4`, `W5` FROM `m2_times` ORDER BY `timestamp` desc LIMIT 180) tmp
		ORDER BY `timestamp` ASC
		";
$result = mysqli_query($con, $query);
if($result) {
	convert($result);
}
?>
