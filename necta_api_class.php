<?php
/**
 * BwireTech
 *
 * This class helps to fetch results of various national examinations in Tanzania.
 *
 * @class           NectaAPI
 * @developer       Bwire Mashauri
 * @phone           +255 689 938 643
 * @email           mashauri@programmer.net
 */
class NectaAPI {
  public function getResults($data){
    $index_no =  $data['index_no'];
    $exam_year = $data['exam_year'];
    $exam_type = $data['exam_type'];

    $level = $exam_type;
    $year = $exam_year;
    $center_id = strtolower(strstr($index_no, '/', true));
    $remove_key = strstr($index_no, '/', true);

    $valid_y = $this->validate_year($year,$level);

    if ($valid_y = 1) {
    $data_link = $this->get_link($year,$level,$center_id);
    $exam_results = $this->crap_results($data_link,$index_no,$remove_key);
    return $exam_results;
    }else{
    $return['message'] = "Examination year is currentlynot supported";
    $return['school_name'] = "";
    $return['candidate_gender'] = "";
    $return['division'] = "";
    $return['aggregated_marks'] = "";
    $return['detailed_subjects'] = "";
    return $return;
    }

  }

  public function validate_year($year,$level) {
    define('NECTA_URL', 'https://onlinesys.necta.go.tz/results/');
    define('NECTA_URL_ALT', 'https://matokeo.necta.go.tz/');

    define('LEVELS', 'CSSE,ACSSE');

    define('O_LIMITS', '2015,2016,2017,2018,2019,2020,2021');
    define('A_LIMITS', '2014,2015,2016,2017,2018,2019,2020,2021,2022');
    define('O_LIMITS_ALT', '');
    define('A_LIMITS_ALT', '2022');

    $GLOBALS['level_list'] = explode(",",LEVELS);
    $GLOBALS['o_limits'] = explode(",",O_LIMITS);
    $GLOBALS['o_limits_alt'] = explode(",",O_LIMITS_ALT);
    $GLOBALS['a_limits'] = explode(",",A_LIMITS);
    $GLOBALS['a_limits_alt'] = explode(",",A_LIMITS_ALT);

    switch ($level) {
    case 'CSEE':
    if (in_array($year, $GLOBALS['o_limits_alt']))
    {
    return 1;
    }
    else
    {
    return 0;
    }
    break;

    case 'ACSEE':
    if (in_array($year, $GLOBALS['a_limits']))
    {
    return 1;
    }
    else
    {
    return 0;
    }
    break;

    default:
    return 0;
    }

  }

  public function get_link($year,$level,$center_id) {
    switch($level) {
      case 'CSEE':
      if (in_array($year, $GLOBALS['o_limits_alt'])) {
      $data_link = NECTA_URL_ALT.'results'.$year.'/csee/results/'.$center_id.'.htm';
      return $data_link;
      }else{
      $data_link = NECTA_URL.''.$year.'/'.strtolower($level).'/results/'.$center_id.'.htm';
      return $data_link;
      }
      break;

      case 'ACSEE':
      if (in_array($year, $GLOBALS['a_limits_alt'])) {
      $data_link = NECTA_URL_ALT.'acsee2022/results/'.$center_id.'.htm';
      return $data_link;
      }else{
      $data_link = NECTA_URL.''.$year.'/'.strtolower($level).'/results/'.$center_id.'.htm';
      return $data_link;
      }
    }
  }

  public function crap_results($data_link,$index_no,$remove_key) {
    $homepage = file_get_contents($data_link);
    $stringArr = explode("\n", strip_tags($homepage));
    $result_found = 0;
    foreach($stringArr as $key => $value){
    if ( strstr($value,$index_no) ) {
    $result_found = 1;
    $return['message'] = "Results fetched successfully";
    $return['school_name'] = str_replace($remove_key,"",$stringArr[7]);
    $return['candidate_gender'] = $stringArr[$key+2];
    $return['division'] = $stringArr[$key+6];
    $return['aggregated_marks'] = $stringArr[$key+4];
    $return['detailed_subjects'] = $stringArr[$key+8];
    return $return;
    }
    }
  }
}
