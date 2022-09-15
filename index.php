<?php
require_once ('necta_api_class.php');
$handler = new NectaAPI();

$query = array(
"index_no"=>"P0104/0503",
"exam_year"=>"2022",
"exam_type"=>"ACSEE"
);

$results = $handler->getResults($query);
?>
<h4>SCHOOL / CENTER NAME : <b style="color:green"><?php echo $results['school_name']; ?></b></h4>
<h4>CANDIDATE GENDER : <b style="color:green"><?php echo $results['candidate_gender']; ?></b></h4>
<h4>AGGREGATED MARKS : <b style="color:green"><?php echo $results['aggregated_marks']; ?></b></h4>
<h4>DIVISION : <b style="color:green"><?php echo $results['division']; ?></b></h4>
<h4>DETAILED SUBJECTS : <b style="color:green"><?php echo $results['detailed_subjects']; ?></b></h4>
