<?php
//Create some data, always set a message 'file_id'.
$time = time() - mktime(0,0,0,12,31,1989);
$data = new \Fit\Data;
$data->setFile(\Fit\FileType::activity);
$data
	->add('file_id', array(
		'type'					=> \Fit\FileType::activity,
		'manufacturer'			=> \Fit\Manufacturer::development,
		'product'				=> 0,
		'serial_number'			=> 0,
		'time_created'			=> $time,
	))
	->add('activity', array(
		'timestamp'				=> $time,
		'num_sessions'			=> 1,
		'type'					=> \Fit\Activity::manual,
		'event'					=> \Fit\Event::workout,
		'event_type'			=> \Fit\EventType::start,
	))
	->add('event', array(
		'timestamp'				=> $time,
		'event_type'			=> \Fit\EventType::start,
	))
	->add('session', array(
		'sport'					=> \Fit\Sport::cycling,
		'sub_sport'				=> \Fit\SubSport::spin,
		'total_elapsed_time'	=> 0,
		'total_timer_time'		=> 0,
		'total_distance'		=> 0,
		'total_ascent'			=> 0,
	))
	->add('record', array(
		'timestamp'				=> $time++, 
		'position_lat'			=> 0, 
		'position_long'			=> 0, 
		'altitude'				=> 0, 
		'heart_rate'			=> 65, 
		'cadence'				=> 45, 
		'distance'				=> 0, 
		'power'					=> 0, 
		'temperature'			=> 19, 
	))
	->add('record', array(
		'timestamp'				=> $time++, 
		'position_lat'			=> 0, 
		'position_long'			=> 0, 
		'altitude'				=> 0, 
		'heart_rate'			=> 70, 
		'cadence'				=> 90, 
		'distance'				=> 10, 
		'power'					=> 0, 
		'temperature'			=> 19, 
	))
	->add('record', array(
		'timestamp'				=> $time++, 
		'position_lat'			=> 0, 
		'position_long'			=> 0, 
		'altitude'				=> 0, 
		'heart_rate'			=> 73, 
		'cadence'				=> 90, 
		'distance'				=> 20, 
		'power'					=> 0, 
		'temperature'			=> 19, 
	))
	->add('event', array(
		'timestamp'				=> $time,
		'event_type'			=> \Fit\EventType::stop,
	))
;

$debug = true;

//Write the data
$fitwriter = new \Fit\Writer($debug);
$filepath = $fitwriter->writeData($data);

//Read the data that was just created
$fit = new \Fit\Reader(true);
$fit->parseFile($filepath, $debug);

//Delete the written data
unlink($filepath);

//output the resulting data
pre_dump_die($fit);
