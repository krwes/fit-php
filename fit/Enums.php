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

class Activity {
	const manual			= 0;
	const auto_multi_sport	= 1;
}
class ActivityLevel {
	const low = 0;
	const medium = 1;
	const high = 2;
}
class ActivitySubtype {
	const generic  = 0;
	const treadmill = 1;	// Run
	const street = 2;	// Run
	const trail = 3;	// Run
	const track = 4;	// Run
	const spin = 5;	// Cycling
	const indoor_cycling = 6;	// Cycling
	const road = 7;	// Cycling
	const mountain = 8;	// Cycling
	const downhill = 9;	// Cycling
	const recumbent = 10;	// Cycling
	const cyclocross = 11;	// Cycling
	const hand_cycling = 12;	// Cycling
	const track_cycling = 13;	// Cycling
	const indoor_rowing = 14;	// Fitness Equipment
	const elliptical = 15;	// Fitness Equipment
	const stair_climbing = 16;	// Fitness Equipment
	const lap_swimming = 17;	// Swimming
	const open_water = 18;	// Swimming
	const all  = 254;
}
class Checksum {
	const clear = 0;
	const ok = 1;
}
class CoursePoint {
	const generic  = 0;
	const summit  = 1;
	const valley  = 2;
	const water  = 3;
	const food  = 4;
	const danger  = 5;
	const left  = 6;
	const right  = 7;
	const straight  = 8;
	const first_aid  = 9;
	const fourth_category  = 10;
	const third_category  = 11;
	const second_category  = 12;
	const first_category  = 13;
	const hors_category  = 14;
	const sprint  = 15;
	const left_fork  = 16;
	const right_fork  = 17;
	const middle_fork  = 18;
	const slight_left  = 19;
	const sharp_left  = 20;
	const slight_right  = 21;
	const sharp_right  = 22;
	const u_turn  = 23;
}
class DeviceType {
	const antfs  = 1;
	const bike_power  = 11;
	const environment_sensor_legacy  = 12;
	const multi_sport_speed_distance  = 15;
	const control  = 16;
	const fitness_equipment  = 17;
	const blood_pressure  = 18;
	const geocache_node  = 19;
	const light_electric_vehicle  = 20;
	const env_sensor  = 25;
	const racquet  = 26;
	const weight_scale  = 119;
	const heart_rate  = 120;
	const bike_speed_cadence  = 121;
	const bike_cadence  = 122;
	const bike_speed  = 123;
	const stride_speed_distance = 124;
}
class DisplayHeart {
	const bpm = 0;
	const max = 1;
	const reserve = 2;
}
class DisplayMeasure {
	const metric = 0;
	const statute = 1;
}
class DisplayPosition {
	const degree = 0;	// dd.dddddd 
	const degree_minute = 1;	// dddmm.mmm 
	const degree_minute_second = 2;	// dddmmss 
	const austrian_grid = 3;	// Austrian Grid (BMN) 
	const british_grid = 4;	// British National Grid 
	const dutch_grid = 5;	// Dutch grid system 
	const hungarian_grid = 6;	// Hungarian grid system 
	const finnish_grid = 7;	// Finnish grid system Zone3 KKJ27 
	const german_grid = 8;	// Gausss Krueger (German) 
	const icelandic_grid = 9;	// Icelandic Grid 
	const indonesian_equatorial = 10;	// Indonesian Equatorial LCO 
	const indonesian_irian = 11;	// Indonesian Irian LCO 
	const indonesian_southern = 12;	// Indonesian Southern LCO 
	const india_zone_0 = 13;	// India zone 0 
	const india_zone_IA = 14;	// India zone IA 
	const india_zone_IB = 15;	// India zone IB 
	const india_zone_IIA = 16;	// India zone IIA 
	const india_zone_IIB = 17;	// India zone IIB 
	const india_zone_IIIA = 18;	// India zone IIIA 
	const india_zone_IIIB = 19;	// India zone IIIB 
	const india_zone_IVA = 20;	// India zone IVA 
	const india_zone_IVB = 21;	// India zone IVB 
	const irish_transverse = 22;	// Irish Transverse Mercator 
	const irish_grid = 23;	// Irish Grid 
	const loran = 24;	// Loran TD 
	const maidenhead_grid = 25;	// Maidenhead grid system 
	const mgrs_grid = 26;	// MGRS grid system 
	const new_zealand_grid = 27;	// New Zealand grid system 
	const new_zealand_transverse = 28;	// New Zealand Transverse Mercator 
	const qatar_grid = 29;	// Qatar National Grid 
	const modified_swedish_grid = 30;	// Modified RT-90 (Sweden) 
	const swedish_grid = 31;	// RT-90 (Sweden) 
	const south_african_grid = 32;	// South African Grid 
	const swiss_grid = 33;	// Swiss CH-1903 grid 
	const taiwan_grid = 34;	// Taiwan Grid 
	const united_states_grid = 35;	// United States National Grid 
	const utm_ups_grid = 36;	// UTM/UPS grid system 
	const west_malayan = 37;	// West Malayan RSO 
	const borneo_rso = 38;	// Borneo RSO
	const estonian_grid = 39;	// Estonian grid system
	const latvian_grid = 40;	// Latvian Transverse Mercator
	const swedish_ref_99_grid = 41;	// Reference Grid 99 TM (Swedish)
}
class DisplayPower {
	const watts = 0;
	const percent_ftp = 1;
}
class Event {
	const timer = 0;	// Group 0. Start / stop_all
	const workout = 3;	// start / stop
	const workout_step = 4;	// Start at beginning of workout. Stop at end of each step.
	const power_down = 5;	// stop_all group 0
	const power_up = 6;	// stop_all group 0
	const off_course = 7;	// start / stop group 0
	const session = 8;	// Stop at end of each session.
	const lap = 9;	// Stop at end of each lap.
	const course_point = 10;	// marker
	const battery = 11;	// marker
	const virtual_partner_pace = 12;	// Group 1. Start at beginning of activity if VP enabled, when VP pace is changed during activity or VP enabled mid activity. stop_disable when VP disabled.
	const hr_high_alert = 13;	// Group 0. Start / stop when in alert condition.
	const hr_low_alert = 14;	// Group 0. Start / stop when in alert condition.
	const speed_high_alert = 15;	// Group 0. Start / stop when in alert condition.
	const speed_low_alert = 16;	// Group 0. Start / stop when in alert condition.
	const cad_high_alert = 17;	// Group 0. Start / stop when in alert condition.
	const cad_low_alert = 18;	// Group 0. Start / stop when in alert condition.
	const power_high_alert = 19;	// Group 0. Start / stop when in alert condition.
	const power_low_alert = 20;	// Group 0. Start / stop when in alert condition.
	const recovery_hr = 21;	// marker
	const battery_low = 22;	// marker
	const time_duration_alert = 23;	// Group 1. Start if enabled mid activity (not required at start of activity). Stop when duration is reached. stop_disable if disabled.
	const distance_duration_alert = 24;	// Group 1. Start if enabled mid activity (not required at start of activity). Stop when duration is reached. stop_disable if disabled.
	const calorie_duration_alert = 25;	// Group 1. Start if enabled mid activity (not required at start of activity). Stop when duration is reached. stop_disable if disabled.
	const activity = 26;	// Group 1.. Stop at end of activity.
	const fitness_equipment = 27;	// marker
	const length = 28;	// Stop at end of each length.
	const user_marker = 32;	// marker
	const sport_point = 33;	// marker
	const calibration = 36; // start/stop/marker
}
class EventType {
	const start = 0;	//0
	const stop = 1;	//1
	const consecutive_depreciated = 2;	//2
	const marker = 3;	//3
	const stop_all = 4;	//4
	const begin_depreciated = 5;	//5
	const end_depreciated = 6;	//6
	const end_all_depreciated = 7;	//7
	const stop_disable = 8;	//8
	const stop_disable_all = 9;	//9
}
class Field {
	const NAME			= 0;
	const DEF_NUMBER	= 1;
	const FACTOR		= 2;
	const UNIT			= 3;
	const TYPE_NUMBER	= 4;
	const SIZE			= 5;
}
class FileType {
	const device = 1;	// Read only, single file. Must be in root directory.
	const settings = 2;	// Read/write, single file. Directory=Settings
	const sport = 3;	// Read/write, multiple files, file number = sport type. Directory=Sports
	const activity = 4;	// Read/erase, multiple files. Directory=Activities
	const workout = 5;	// Read/write/erase, multiple files. Directory=Workouts
	const course = 6;	// Read/write/erase, multiple files. Directory=Courses
	const schedules = 7;	// Read/write, single file. Directory=Schedules
	const weight = 9;	// Read only, single file. Circular buffer. All message definitions at start of file. Directory=Weight
	const totals = 10;	// Read only, single file. Directory=Totals
	const goals = 11;	// Read/write, single file. Directory=Goals
	const blood_pressure = 14;	// Read only. Directory=Blood Pressure
	const monitoring = 15;	// Read only. Directory=Monitoring
	const activity_summary = 20;	// Read/erase, multiple files. Directory=Activities
	const monitoring_daily = 2;
}
class Goal {
	const time = 0;
	const distance = 1;
	const calories = 2;
	const frequency = 3;
	const steps = 4;
}
class Language {
	const english  = 0;
	const french  = 1;
	const italian  = 2;
	const german  = 3;
	const spanish  = 4;
	const croatian  = 5;
	const czech  = 6;
	const danish  = 7;
	const dutch  = 8;
	const finnish  = 9;
	const greek  = 10;
	const hungarian  = 11;
	const norwegian  = 12;
	const polish  = 13;
	const portuguese  = 14;
	const slovakian  = 15;
	const slovenian  = 16;
	const swedish  = 17;
	const russian  = 18;
	const turkish  = 19;
	const latvian  = 20;
	const ukrainian  = 21;
	const arabic  = 22;
	const farsi  = 23;
	const bulgarian  = 24;
	const romanian  = 25;
	const custom  = 254;
}
class Manufacturer {
	const garmin  = 1;
	const garmin_fr405_antfs = 2; // Do not use. Used by FR405 for ANTFS man id.
	const zephyr  = 3;
	const dayton  = 4;
	const idt  = 5;
	const srm  = 6;
	const quarq  = 7;
	const ibike  = 8;
	const saris  = 9;
	const spark_hk  = 10;
	const tanita  = 11;
	const echowell  = 12;
	const dynastream_oem  = 13;
	const nautilus  = 14;
	const dynastream  = 15;
	const timex  = 16;
	const metrigear  = 17;
	const xelic  = 18;
	const beurer  = 19;
	const cardiosport  = 20;
	const a_and_d  = 21;
	const hmm  = 22;
	const suunto  = 23;
	const thita_elektronik  = 24;
	const gpulse  = 25;
	const clean_mobile  = 26;
	const pedal_brain  = 27;
	const peaksware  = 28;
	const saxonar  = 29;
	const lemond_fitness  = 30;
	const dexcom  = 31;
	const wahoo_fitness  = 32;
	const octane_fitness  = 33;
	const archinoetics  = 34;
	const the_hurt_box  = 35;
	const citizen_systems  = 36;
	const magellan  = 37;
	const osynce  = 38;
	const holux  = 39;
	const concept2  = 40;
	const one_giant_leap  = 42;
	const ace_sensor  = 43;
	const brim_brothers  = 44;
	const xplova  = 45;
	const perception_digital  = 46;
	const bf1systems  = 47;
	const pioneer  = 48;
	const spantec  = 49;
	const metalogics  = 50;
	const fouriiiis  = 51;
	const seiko_epson  = 52;
	const seiko_epson_oem  = 53;
	const ifor_powell  = 54;
	const maxwell_guider  = 55;
	const star_trac  = 56;
	const breakaway  = 57;
	const alatech_technology_ltd  = 58;
	const mio_technology_europe  = 59;
	const rotor  = 60;
	const geonaute  = 61;
	const id_bike  = 62;
	const specialized  = 63;
	const wtek  = 64;
	const physical_enterprises  = 65;
	const north_pole_engineering  = 66;
	const bkool  = 67;
	const cateye  = 68;
	const stages_cycling  = 69;
	const sigmasport  = 70;
	const tomtom  = 71;
	const peripedal  = 72;
	const moxy  = 76;
	const development  = 255;
	const actigraphcorp = 5759;
}
class MesgCount {
	const num_per_file = 0;
	const max_per_file = 1;
	const max_per_file_type = 2;
}
class MesgNum {
	const file_id  = 0;
	const capabilities  = 1;
	const device_settings  = 2;
	const user_profile  = 3;
	const hrm_profile  = 4;
	const sdm_profile  = 5;
	const bike_profile  = 6;
	const zones_target  = 7;
	const hr_zone  = 8;
	const power_zone  = 9;
	const met_zone  = 10;
	const sport  = 12;
	const goal  = 15;
	const session  = 18;
	const lap  = 19;
	const record  = 20;
	const event  = 21;
	const device_info  = 23;
	const workout  = 26;
	const workout_step  = 27;
	const schedule  = 28;
	const weight_scale  = 30;
	const course  = 31;
	const course_point  = 32;
	const totals  = 33;
	const activity  = 34;
	const software  = 35;
	const file_capabilities  = 37;
	const mesg_capabilities  = 38;
	const field_capabilities  = 39;
	const file_creator  = 49;
	const blood_pressure  = 51;
	const speed_zone  = 53;
	const monitoring  = 55;
	const hrv  = 78;
	const length  = 101;
	const monitoring_info  = 103;
	const pad  = 105;
	const slave_device  = 106;
	const cadence_zone  = 131;
}
class Schedule {
	const workout = 0;
	const course = 1;
}
class Sport {
	const generic			= 0;
	const running			= 1;
	const cycling			= 2;
	const transition		= 3;	//Mulitsport transition
	const fitness_equipment = 4;
	const swimming			= 5;
	const basketball		= 6;
	const soccer			= 7;
	const tennis			= 8;
	const american_football = 9;
	const training			= 10;
	const all				= 254;	//All is for goals only to include all sports.
}
class SubSport {
	const generic				= 0;
	const treadmill				= 1;	// Run
	const street				= 2;	// Run
	const trail					= 3;	// Run
	const track					= 4;	// Run
	const spin					= 5;	// Cycling
	const indoor_cycling		= 6;	// Cycling
	const road					= 7;	// Cycling
	const mountain				= 8;	// Cycling
	const downhill				= 9;	// Cycling
	const recumbent				= 10;	// Cycling
	const cyclocross			= 11;	// Cycling
	const hand_cycling			= 12;	// Cycling
	const track_cycling			= 13;	// Cycling
	const indoor_rowing			= 14;	// Fitness Equipment
	const elliptical			= 15;	// Fitness Equipment
	const stair_climbing		= 16;	// Fitness Equipment
	const lap_swimming			= 17;	// Swimming
	const open_water			= 18;	// Swimming
	const flexibility_training	= 19;	// Training
	const strength_training		= 20;	// Training
	const warm_up				= 21;	// Tennis
	const match					= 22;	// Tennis
	const exercise				= 23;	// Tennis
	const challenge				= 24;	// Tennis
	const all					= 254;
}
class TimerTrigger {
	const manual = 0;
	const auto = 1;
	const fitness_equipment = 2;
}
