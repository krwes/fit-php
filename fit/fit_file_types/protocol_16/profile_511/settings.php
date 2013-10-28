<?php
return array(
	'type'		=> \Fit\FileType::settings,
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
//		array(
//			'name'				=> 'user_profile',
//			'architecture'		=> 0,
//			'global_msg_number'	=> 0,
//			'fields'			=> array(
//				//		name,	field_def_number, factor, unit,	base_type_number, size
//				array('type',				0,		1,		'',		\Fit\Core::ENUM		,1),
//			),
//		),
	),
);
