<?php
/* Scrape M2 travel times from the RMS Live Traffic site */
// https://github.com/timbennett/RMS-Cache
// TODO: Make a single file to collect M1/M2/M4/M7 feeds. Will require generalising the database structure.

// Get remote file details
$jsonurl = "http://livetraffic.rta.nsw.gov.au/traffic/travel_time/m2.json";
$json = file_get_contents($jsonurl,0,null,null);
$responseData = json_decode($json, TRUE);

// database connection
$con = mysqli_connect("localhost","","","");
// Check connection
if (mysqli_connect_errno()) {
    echo 'Failed to connect to MySQL: ' . mysqli_connect_error();
    exit();
}

// Set up array for the DB push
$times = array();

// Use the source timestamp as primary key
// RMS publishes in milliseconds so we divide by 1000, but this is a little unsafe if they ever change it (should probably store original value too)
date_default_timezone_set('Australia/Sydney');
$times['timestamp'] = date('Y-m-d G:i:s', round($responseData['lastPublished'] / 1000)); 

echo $times['timestamp'] ."\n";
foreach ( $responseData['features'] as $segment => $data )
{
$times[$data['id']] = $data['properties']['travelTimeMinutes'];
}

print_r($times);

		$result = mysqli_query( $con, 
			"
			INSERT INTO rms_m2_times (
			timestamp,
			E1,
			E2,
			E3,
			E4,
			E5,
			E6,
			ETOTAL,
			W1,
			W2,
			W3,
			W4,
			W5,
			WTOTAL
			)
			VALUES (
			'$times[timestamp]',
			'$times[E1]',
			'$times[E2]',
			'$times[E3]',
			'$times[E4]',
			'$times[E5]',
			'$times[E6]',
			'$times[ETOTAL]',
			'$times[W1]',
			'$times[W2]',
			'$times[W3]',
			'$times[W4]',
			'$times[W5]',
			'$times[WTOTAL]'
			)
			" );

// Some logging I was using during development. Feel free to disable or remove.
		if($result){
			$string = time(). " success: ". $times['timestamp'] ."\n";
			echo $string;
			//file_put_contents($logfile, $string, FILE_APPEND);
		}else{
			$string = time(). " fail: ". mysqli_error($con) ."\n";
			echo $string;
			//file_put_contents($logfile, $string, FILE_APPEND);
		}

?>
