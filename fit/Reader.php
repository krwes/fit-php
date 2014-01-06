<?php
namespace Fit;
/**
 * @author Karel Wesseling <karel@swc.nl>
 * @version 1.0
 * @copyright (c) 2013, Karel Wesseling
 * @license http://opensource.org/licenses/MIT The MIT License (MIT)
 * @package Fit
 * 
 * Permission is hereby granted, free of charge, to any person obtaining a copy of 
 * this software and associated documentation files (the "Software"), to deal in the 
 * Software without restriction, including without limitation the rights to use, copy, 
 * modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, 
 * and to permit persons to whom the Software is furnished to do so, subject to the 
 * following conditions:
 * 
 * The above copyright notice and this permission notice shall be included in all 
 * copies or substantial portions of the Software.
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR 
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS 
 * FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR 
 * COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER 
 * IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION 
 * WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */

/**
 * Class \Fit\Reader
 * Class to parse a .FIT file into data arrays.
 *
 * @example examples/create_data.php How to use this class
 * @uses \Zend_Io_Reader Binary file parser
 */
class Reader extends \Fit\Core {
	
	/**
	 * @var \Zend_Io_Reader 
	 */
	protected	$reader;
	
	/**
	 * Bitarray that represents the 1st byte of a record.
	 * @var bool[] 
	 */
	protected	$headerbits;
		
	/**
	 * The file header information.
	 * @var string[] 
	 */
	public		$file_header;
	
	/**
	 * The definitions read in the file. When of same type, only the last will 
	 * remain in this variable.
	 * @var string[] 
	 */
	protected	$message_type_definitions = array();
	
	/**
	 * The resulting data after parsing the file.
	 * @var string[] 
	 */
	public		$records = array();
	
	/**
	 * The filetype currently being read.
	 * @var enum \Fit\FileType 
	 */
	protected	$file_type;

	/**
	 * Parse a FIT file into data-arrays.
	 * After parsing, the ->records will be filled with the data. When the data
	 * matches the product's profile, the column names will be known and added. 
	 * If not the data will still be read, but we won't know what it is, what 
	 * scale factor to apply and what unit it is.
	 * 
	 * @param string $filepath Absolute path to the .FIT file
	 * @return false When unable to open the file for reading.
	 * @throws \Fit\Exception
	 */
	public function parseFile($filepath) {
		$handle = false;
		if (is_file($filepath)) {
			$handle = @fopen($filepath, 'rb');
		}
		if (false === $handle) {
			\Fit\Exception::create(1003, \Fit\Exception::$codes[1003].' filepath: '.$filepath);
		}
		$this->reader = new \Zend_Io_Reader($handle);
		try {
			$this->readFileHeader();
			$this->readRecords();
		}
		catch(\Exception $e) {
			$this->reader->close();
			throw $e;
		}
		$this->reader->close();
	}
	
	/**
	 * Every .FIT file starts of with a file header which is parsed here.
	 * @return string[] The file header
	 */
	protected function readFileHeader() {
		$this->file_header = array(
			'header_size'		=> $this->reader->readUInt8(),		// FIT_FILE_HDR_SIZE (size of this structure)
			'protocol_version'	=> $this->reader->readUInt8(),		// FIT_PROTOCOL_VERSION
			'profile_version'	=> $this->reader->readUInt16(),		// FIT_PROFILE_VERSION
			'data_size'			=> $this->reader->readUInt32LE(),	// Does not include file header or crc.  Little endian format.
			'data_type'			=> $this->reader->readString8(4),	// ".FIT"
		);
		//when not found, the profile will be the default
		$this->profile->setProtocolAndProfile(
			$this->file_header['protocol_version'],
			$this->file_header['profile_version']
		);
		if ($this->file_header['header_size'] > 12) {
			$this->file_header += array(
				'crc'			=> $this->reader->readUInt16LE(),	// CRC of this file header in little endian format.
			);
		}
		//make sure we are at start of first record
		$this->reader->setOffset($this->file_header['header_size']);
		return $this->file_header;
	}
	
	/**
	 * The recordheader consists of 1 byte, that could be in 2 formats:
	 * normal header or compressed timestamp here.
	 * @return string[] The record header
	 */
	protected function readRecordHeader() {
		$byte = $this->reader->readUInt8();
		$this->headerbits = self::inttobar($byte);
		if ($this->headerbits[7] === false) {
			//normal header
			$record_header = array(
				'Normal Header'			=> $this->headerbits[7],
				'Message Type'			=> $this->headerbits[6],
				'Reserved1'				=> $this->headerbits[5],
				'Reserved2'				=> $this->headerbits[4],
				'Local Message Type'	=> self::bartoint(array_slice($this->headerbits, 0, 4)),
			);
		}
		else {
			//compressed timestamp header
			$record_header = array(
				'Normal Header'			=> $this->headerbits[7],
				'Message Type'			=> false,
				'Local Message Type'	=> self::bartoint(array($this->headerbits[5], $this->headerbits[6])),
				'Time Offset'			=> self::bartoint(array_slice($this->headerbits, 0, 5)),
			);
		}
		return $record_header;
	}
	
	/**
	 * When the current record turns out to be a definition record, we will 
	 * parse it here.
	 * @return string[] The definition of the record
	 */
	protected function readRecordDefinition() {
		$definition = array(
			'reserved'			=> $this->reader->readUInt8(),
			'architecture'		=> $this->reader->readUInt8(),	//Architecture Type 0: Definition and Data Messages are Little Endian 1: Definition and Data Message are Big Endian
		);
		$big_endian = $definition['architecture'] === 1;
		$definition += array(
			'global_msg_number' => $big_endian ? $this->reader->readUInt16BE() : $this->reader->readUInt16LE(),	//0:65535 – Unique to each message *Endianness of this 2 Byte value is defined in the Architecture byte
			'no_of_fields'		=> $this->reader->readUInt8(),	//Number of fields in the Data Message
			'fields'			=> array(),
		);
		for ($p = 0; $p < $definition['no_of_fields']; $p++) {
			$field = array(
				'field_def_number'	=> $this->reader->readUInt8(),
				'size'				=> $this->reader->readUInt8(),
				'base_type'			=> $this->reader->readUInt8(),
			);
			$base_type_bits = self::inttobar($field['base_type']);
			$base_type = array(
				'endian_ability'	=> $base_type_bits[7], //0 - for single byte data 1 - if base type has endianness (i.e. base type is 2 or more bytes)
				'base_type_number'	=> self::bartoint(array_slice($base_type_bits, 0, 4)),
				'base_type_definition' => '',
			);
			if (array_key_exists($base_type['base_type_number'], self::$base_types)) {
				$base_type['base_type_definition'] = self::$base_types[$base_type['base_type_number']];
			}
			else {
				//fallback for unknown types, just setup to read the bytes as bytes
				$base_type['base_type_definition'] = array(
					'endian_ability'	=> $base_type['endian_ability'],	
					'name'				=> 'byte',		
					'bytes'				=> $field['size'],
				);
			}
			$field['base_type'] = $base_type;

			$definition['fields'][] = $field;
		}
		return $definition;
	}
	
	/**
	 * Reads all records in the file.
	 */
	protected function readRecords() {
		if ($this->debug) {
			static::$log->add('<table style="background:black;">');
		}
		while ($this->reader->getOffset() - $this->file_header['header_size'] < $this->file_header['data_size']) {
			$this->readRecord();
		}
		if ($this->debug) {
			static::$log->add('</table>');
		}
	}

	/**
	 * Reads 1 record from the file.
	 */
	protected function readRecord() {
		$record_header = $this->readRecordHeader();
		$local_msg_type = $record_header['Local Message Type'];
		if ($record_header['Message Type'] === true) {
			//this is a definition message
			$def = $this->readRecordDefinition();
			$this->message_type_definitions[$local_msg_type] = $def;
		}
		else {
			//this is a data message
			$def = $this->message_type_definitions[$local_msg_type];
			$data = array();
			/*
			 * Architecture Type 
			 * 0: Definition and Data Messages are Little Endian 
			 * 1: Definition and Data Message are Big Endian
			 */
			$big_endian = $def['architecture'] === 1;
			if ($this->file_type === null) {
				//default filetype, file_id is overal hetzelfde
				$this->file_type		= \Fit\FileType::activity;
			}
			foreach($def['fields'] as $field_def) {
				$profile_field_def = $this->profile->findFieldDefinition(
					$this->file_type, 
					$def['global_msg_number'],
					$field_def['field_def_number']
				);
				if ($profile_field_def) {
					$field_name		= $profile_field_def[\Fit\Field::NAME];
					$field_factor	= (double)$profile_field_def[\Fit\Field::FACTOR];
					$field_unit		= $profile_field_def[\Fit\Field::UNIT];
				}
				else {
					$field_name		= 'no:'.$field_def['field_def_number'];
					$field_factor	= 1;
					$field_unit		= '';
				}

				switch($field_def['base_type']['base_type_definition']['name']) {
					case 'string'	: $value = $this->reader->readString8($field_def['size']); break;
					case 'sint8'	: $value = $this->reader->readInt8(); break;
					case 'enum'		:
					case 'uint8z'	:	
					case 'uint8'	: $value = $this->reader->readUInt8(); break;
					case 'sint16'	: $value = $big_endian ? $this->reader->readInt16BE() : $this->reader->readInt16LE(); break;
					case 'uint16z'	: 
					case 'uint16'	: $value = $big_endian ? $this->reader->readUInt16BE() : $this->reader->readUInt16LE(); break;
					case 'sint32'	: $value = $big_endian ? $this->reader->readInt32BE() : $this->reader->readInt32LE(); break;
					case 'uint32z'	: 
					case 'uint32'	: $value = $big_endian ? $this->reader->readUInt32BE() : $this->reader->readUInt32LE(); break;
					case 'float32'	: $value = $big_endian ? $this->reader->readFloatBE() : $this->reader->readFloatLE(); break;
					case 'float64'	: $value = $big_endian ? $this->reader->readDoubleBE() : $this->reader->readDoubleLE(); break;
					case 'byte'		:
					default			: $value = $this->reader->read($field_def['size']);
				}
				if (is_numeric($value) && $field_factor > 0) {
					$value *= $field_factor;
				}
				$data[$field_name] = array(
					'value'		=> $value,
					'unit'		=> $field_unit,
				);
				if (
					$def['global_msg_number'] === 0 &&
					$field_name === 'type'
				) {
					$this->file_type		= $value;
				}
			}
			$this->records[] = $data;
		}
		if ($this->debug) {
			$style = 'padding:1px 3px;background:white;';
			$style2 = 'padding:1px 3px;background:lightgrey;';
			$style3 = 'padding:1px 3px;background:darkgrey;';
			static::$log->add('
				<tr>
					<td style="'.$style.'">'.intval($this->headerbits[7]).'</td>
					<td style="'.$style2.'">'.intval($this->headerbits[6]).'</td>
					<td style="'.$style.'">'.intval($this->headerbits[5]).'</td>
					<td style="'.$style.'">'.intval($this->headerbits[4]).'</td>
					<td style="'.$style2.'">'.intval($this->headerbits[3]).'</td>
					<td style="'.$style2.'">'.intval($this->headerbits[2]).'</td>
					<td style="'.$style2.'">'.intval($this->headerbits[1]).'</td>
					<td style="'.$style2.'">'.intval($this->headerbits[0]).'</td>
					<td style="'.$style3.'">'.$local_msg_type.'</td>
					<td style="'.$style3.'">'.$def['global_msg_number'].'</td>
					<td style="'.$style3.'">'.$this->file_type.'</td>
						');
			if (isset($data)) {
				foreach($data as $k => $d) {
					$v = $d['value'];
					if (stripos($k, 'time') !== false && stripos($k, 'total') === false) $v = strftime('%FT%H:%M:%S%z', \Fit\Data::timeToUnix($v));
					elseif ($d['unit'] === 'deg') $v = \Fit\Data::positionToDegrees($v);
					static::$log->add('<td style="'.$style.'">'.$k.': '.$v.$d['unit'].'</td>');
				}
			}
			static::$log->add('</tr>');
		}
	}
}
