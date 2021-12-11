<?php
function fetch_results ($index_no, $level, $year) {

$center_id = strtolower(strstr($index_no, '/', true));
$remove_key = strstr($index_no, '/', true);
$inc_no = ltrim(str_replace(''.strtoupper($center_id).'/', '', $index_no), '0');

$level_list = explode(",",LEVELS);
$o_limits = explode(",",O_LIMITS);
$a_limits = explode(",",A_LIMITS);

switch ($level) {
case 'CSEE':
if (in_array($year, $o_limits))
{
$search_ok = 1;
}
else
{
$search_ok = 0;
}
break;

case 'ACSEE':
if (in_array($year, $a_limits))
{
$search_ok = 1;
}
else
{
$search_ok = 0;
}
break;

default:
$search_ok = 0;
break;
}

if ($search_ok == '1') {

if ($level == "CSEE") {
$data_link = NECTA_URL.''.$year.'/'.strtolower($level).'/results/'.$center_id.'.htm';

$homepage = file_get_contents($data_link);

if ( strstr( $homepage, $index_no) ) {

$result_found = 1;

if ($year < 2019) {
$inc_id = 17+(10*$inc_no);

$stringArr = explode("\n", $homepage);
$school_name = $stringArr[7];
$school_name = strip_tags($school_name);
$school_name = str_replace($remove_key,"",$school_name);

$gender = strip_tags($stringArr[$inc_id + 8]);
$aggt = strip_tags($stringArr[$inc_id + 0]);
$division = strip_tags($stringArr[$inc_id + 2]);
$detail_subs = strip_tags($stringArr[$inc_id + 4]);

$return['message'] = "<b style='color:green;'>Results fetched successfully</b>";
$return['school_name'] = preg_replace('~[\r\n]+~', '', $school_name);
$return['candidate_gender'] = preg_replace('~[\r\n]+~', '', $gender);
$return['division'] = preg_replace('~[\r\n]+~', '', $division);
$return['aggregated_marks'] = preg_replace('~[\r\n]+~', '', $aggt);
$return['detailed_subjects'] = preg_replace('~[\r\n]+~', '', $detail_subs);

}else{
$inc_id = 77+(10*$inc_no);

$stringArr = explode("\n", $homepage);
$school_name = $stringArr[7];
$school_name = strip_tags($school_name);
$school_name = str_replace($remove_key,"",$school_name);

$gender = strip_tags($stringArr[$inc_id + 2]);
$aggt = strip_tags($stringArr[$inc_id + 4]);
$division = strip_tags($stringArr[$inc_id + 6]);
$detail_subs = strip_tags($stringArr[$inc_id + 8]);

$return['message'] = "<b style='color:green;'>Results fetched successfully</b>";
$return['school_name'] = preg_replace('~[\r\n]+~', '', $school_name);
$return['candidate_gender'] = preg_replace('~[\r\n]+~', '', $gender);
$return['division'] = preg_replace('~[\r\n]+~', '', $division);
$return['aggregated_marks'] = preg_replace('~[\r\n]+~', '', $aggt);
$return['detailed_subjects'] = preg_replace('~[\r\n]+~', '', $detail_subs);


}

}else{
$return['message'] = "<b style='color:red;'>Index number was not found</b>";
$return['school_name'] = "";
$return['candidate_gender'] = "";
$return['division'] = "";
$return['aggregated_marks'] = "";
$return['detailed_subjects'] = "";
}

}


 if ($level == "ACSEE") {
 $data_link = NECTA_URL.''.$year.'/'.strtolower($level).'/results/'.$center_id.'.htm';

 $homepage = file_get_contents($data_link);

 if ( strstr( $homepage, $index_no) ) {

 $result_found = 1;

 if ($year < 2020) {
 $inc_id = 77+(10*$inc_no);

 $stringArr = explode("\n", $homepage);
 $school_name = $stringArr[7];
 $school_name = strip_tags($school_name);
 $school_name = str_replace($remove_key,"",$school_name);

 $gender = strip_tags($stringArr[$inc_id - 5062]);
 $aggt = strip_tags($stringArr[$inc_id - 5060]);
 $division = strip_tags($stringArr[$inc_id - 5058]);
 $detail_subs = strip_tags($stringArr[$inc_id - 5056]);

 $return['message'] = "<b style='color:green;'>Results fetched successfully</b>";
 $return['school_name'] = preg_replace('~[\r\n]+~', '', $school_name);
 $return['candidate_gender'] = preg_replace('~[\r\n]+~', '', $gender);
 $return['division'] = preg_replace('~[\r\n]+~', '', $division);
 $return['aggregated_marks'] = preg_replace('~[\r\n]+~', '', $aggt);
 $return['detailed_subjects'] = preg_replace('~[\r\n]+~', '', $detail_subs);

 }else{
 $inc_id = 77+(10*$inc_no);

 $stringArr = explode("\n", $homepage);
 $school_name = $stringArr[7];
 $school_name = strip_tags($school_name);
 $school_name = str_replace($remove_key,"",$school_name);

 $gender = strip_tags($stringArr[$inc_id - 4998]);
 $aggt = strip_tags($stringArr[$inc_id - 4996]);
 $division = strip_tags($stringArr[$inc_id - 4994]);
 $detail_subs = strip_tags($stringArr[$inc_id - 4992]);

 $return['message'] = "<b style='color:green;'>Results fetched successfully</b>";
 $return['school_name'] = preg_replace('~[\r\n]+~', '', $school_name);
 $return['candidate_gender'] = preg_replace('~[\r\n]+~', '', $gender);
 $return['division'] = preg_replace('~[\r\n]+~', '', $division);
 $return['aggregated_marks'] = preg_replace('~[\r\n]+~', '', $aggt);
 $return['detailed_subjects'] = preg_replace('~[\r\n]+~', '', $detail_subs);


 }

 }else{
 $return['message'] = "<b style='color:red;'>Index number was not found</b>";
 $return['school_name'] = "";
 $return['candidate_gender'] = "";
 $return['division'] = "";
 $return['aggregated_marks'] = "";
 $return['detailed_subjects'] = "";
 }

 }


 }else{
 $return['message'] = "<b style='color:orange;'>Exam type is currently not supported</b>";
 $return['school_name'] = "";
 $return['candidate_gender'] = "";
 $return['division'] = "";
 $return['aggregated_marks'] = "";
 $return['detailed_subjects'] = "";
 }

 $exam_results = array("message"=>$return['message'],"school_name"=>$return['school_name'],"candidate_gender"=>$return['candidate_gender'],"division"=>$return['division'],"aggregated_marks"=>$return['aggregated_marks'],"detailed_subjects"=>$return['detailed_subjects']);
 return $exam_results;

}

?>
