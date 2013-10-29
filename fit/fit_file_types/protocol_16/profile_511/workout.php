<?php
return array(
	'type'		=> \Fit\FileType::workout,
	'messages'	=> array(
		array(
			'name'				=> 'file_id',
			'architecture'		=> 0,
			'global_msg_number'	=> 0,
			'fields'			=> array(
				//		name,	field_def_number, factor, unit,	base_type_number, size
				array('type',				0,		1,		'',		\Fit\Core::ENUM		,1),
				array('manufacturer',		1,		1,		'',		\Fit\Core::UINT16	,2),
				array('product',			2,		1,		'',		\Fit\Core::UINT16	,2),
				array('serial_number',		3,		1,		'',		\Fit\Core::UINT32Z	,4),
				array('time_created',		4,		1,		'',		\Fit\Core::TIME		,4),
				array('number',				5,		1,		'',		\Fit\Core::UINT16	,2),
			),
		),
		array(
			'name'				=> 'workout',
			'architecture'		=> 0,
			'global_msg_number'	=> 26,
			'fields'			=> array(
				//		name,	field_def_number, factor, unit,	base_type_number, size
				array('sport',				0,		1,		'',		\Fit\Core::ENUM		,1),
				array('capabilities',		1,		1,		'',		\Fit\Core::UINT32Z	,4),
				array('num_valid_steps',	2,		1,		'',		\Fit\Core::UINT16	,2),
				array('wkt_name',			3,		1,		'',		\Fit\Core::STRING	,64),
			),
		),
		array(
			'name'				=> 'workout_step',
			'architecture'		=> 0,
			'global_msg_number'	=> 27,
			'fields'			=> array(
				//		name,	field_def_number, factor, unit,	base_type_number, size
				array('message_index',		0,		1,		'',		\Fit\Core::UINT16		,2),
				array('wkt_step_name',		1,		1,		'',		\Fit\Core::STRING		,32),
				array('duration_type',		2,		1,		'',		\Fit\Core::ENUM		,1),
				array('duration_value',		3,		1,		'',		\Fit\Core::UINT32		,4),
				array('target_type',		4,		1,		'',		\Fit\Core::ENUM		,1),
				array('target_value',		5,		1,		'',		\Fit\Core::UINT32		,4),
				array('custom_target_value_low',6,	1,		'',		\Fit\Core::UINT32		,4),
				array('custom_target_value_high',7,	1,		'',		\Fit\Core::UINT32		,4),
				array('intensity',			8,		1,		'',		\Fit\Core::ENUM		,1),
			),
		),
	),
);
