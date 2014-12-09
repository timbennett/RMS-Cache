<?php
/* Render latest traffic data as CSV (Eastbound M2 route) */
// TODO: Write to a static file so people aren't calling this script all the time.
// TODO: Move database details out of this file
// TODO: Generalise to render CSV for M1/M2/M4/M7 (probably a total rewrite)

echo "Time,M7 > Windsor Rd,Windsor Rd > Pennant Hills Rd,Pennant Hills Rd > Christie Rd,Christie Rd > Lane Cove Rd,Lane Cove Rd > Delhi Rd,Delhi Rd > Lane Cove Tunnel\n";

function convert($result){
      // using a function is probably overkill for this
	    while($item = mysqli_fetch_assoc($result)) {
	    echo $item['timestamp'].",".$item['E1'].",".$item['E2'].",".$item['E3'].",".$item['E4'].",".$item['E5'].",".$item['E6']."\n";
	    }
}

// database connection
$con = mysqli_connect("localhost","","","rms-cache");
$query= "
		SELECT `timestamp`, `ETOTAL`, `E1`, `E2`, `E3`, `E4`, `E5`, `E6`
		FROM (SELECT `timestamp`, `ETOTAL`, `E1`, `E2`, `E3`, `E4`, `E5`, `E6` FROM `m2_times` ORDER BY `timestamp` desc LIMIT 180) tmp
		ORDER BY `timestamp` ASC
		";
$result = mysqli_query($con, $query);
if($result) {
	convert($result);
}
?>
