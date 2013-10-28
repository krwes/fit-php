<?php
return array(
	'type'		=> \Fit\FileType::device,
	'messages'	=> array(
		array(
			'name'				=> 'file_id',
			'architecture'		=> 0,
			'global_msg_number'	=> 0,
			'fields'			=> array(
				//		name,	field_def_number, factor, unit,	base_type_number, size
				array('type',				0,		1,		'',		\Fit\Core::ENUM		,1),
				array('manufacturer',		1,		1,		'',		\Fit\Core::UINT16		,2),
				array('product',			2,		1,		'',		\Fit\Core::UINT16		,2),
				array('serial_number',		3,		1,		'',		\Fit\Core::UINT32Z	,4),
				array('time_created',		4,		1,		'',		\Fit\Core::TIME		,4),
				array('number',				5,		1,		'',		\Fit\Core::UINT16		,2),
			),
		),
		array(
			'name'				=> 'software',
			'architecture'		=> 0,
			'global_msg_number'	=> 35,
			'fields'			=> array(
				array('message_index',		0,		1,		'',		\Fit\Core::UINT16		,2),
				array('version',			1,		0.01,	'',		\Fit\Core::UINT16		,2),
				array('part_number',		2,		1,		'',		\Fit\Core::STRING		,4), 
			),
		),
		array(
			'name'				=> 'capabilities',
			'architecture'		=> 0,
			'global_msg_number'	=> 1,
			'fields'			=> array(
				array('languages',			0,		1,		'',		\Fit\Core::UINT8Z		,1),
				array('workouts_supported',	1,		1,		'',		\Fit\Core::UINT32Z	,4),
			),
		),
		array(
			'name'				=> 'file_capabilities',
			'architecture'		=> 0,
			'global_msg_number'	=> 37,
			'fields'			=> array(
				array('message_index',		0,		1,		'',		\Fit\Core::UINT16		,2),
				array('type',				1,		1,		'',		\Fit\Core::ENUM		,1),
				array('flags',				2,		1,		'',		\Fit\Core::UINT8Z		,1),
				array('directory',			3,		1,		'',		\Fit\Core::STRING		,32),
				array('max_count',			4,		1,		'',		\Fit\Core::UINT16		,2),
				array('max_size',			5,		1,		'',		\Fit\Core::UINT32		,4),
			),
		),
		array(
			'name'				=> 'mesg_capabilities',
			'architecture'		=> 0,
			'global_msg_number'	=> 38,
			'fields'			=> array(
				array('message_index',		0,		1,		'',		\Fit\Core::UINT16		,2),
				array('file',				1,		1,		'',		\Fit\Core::ENUM		,1),
				array('mesg_num',			2,		1,		'',		\Fit\Core::UINT16		,2),
				array('count_type',			3,		1,		'',		\Fit\Core::ENUM		,1),
				array('count',				4,		1,		'',		\Fit\Core::UINT16		,2),
			),
		),
		array(
			'name'				=> 'field_capabilities',
			'architecture'		=> 0,
			'global_msg_number'	=> 39,
			'fields'			=> array(
				array('message_index',		0,		1,		'',		\Fit\Core::UINT16		,2),
				array('file',				1,		1,		'',		\Fit\Core::ENUM		,1),
				array('mesg_num',			2,		1,		'',		\Fit\Core::UINT16		,2),
				array('field_num',			3,		1,		'',		\Fit\Core::UINT8		,1),
				array('count',				4,		1,		'',		\Fit\Core::UINT16		,2),
			),
		),
	)
);
