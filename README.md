# NECTA-API
A PHP API which can fetch national examinations results (CSEE and ACSEE)
```
Project : NECTA API
Language : PHP (Pure)
Developer : Bwire C Mashauri
Contact : +255 689 938 643
```

## Usage
```php
//Load and initialize the class
require_once ('necta_api_class.php');
$handler = new NectaAPI();

//Set your parameters.
$query = array(
"index_no"=>"Index Number",
"exam_year"=>"Exam Type",
"exam_type"=>"Exam Year"
);

//Fire the API to fetch results.
$results = $handler->getResults($query);

//Retrieving school name from the API.
$school_name = $results['school_name'];

//Retrieving candidate gender from the API.
$candidate_gender = $results['candidate_gender'];

//Retrieving division from the API.
$division = $results['division'];

//Retrieving aggregated marks from the API.
$aggregated_marks = $results['aggregated_marks'];

//Retrieving detailed subjects from the API.
$detailed_subjects = $results['detailed_subjects'];
```

## Supported Exams
```
CSEE (2015,2016,2017,2018,2019,2020,2021)
ACSEE (2014,2015,2016,2017,2018,2019,2020,2021,2022)
```

## Full Example
```php
include_once 'necta_api_class.php';
$handler = new NectaAPI();

$query = array(
"index_no"=>"P0104/0503",
"exam_year"=>"2022",
"exam_type"=>"ACSEE"
);

$results = $handler->getResults($query);
```html
<h4>SCHOOL / CENTER NAME : <b style="color:green"><?php echo $results['school_name']; ?></b></h4>
<h4>CANDIDATE GENDER : <b style="color:green"><?php echo $results['candidate_gender']; ?></b></h4>
<h4>AGGREGATED MARKS : <b style="color:green"><?php echo $results['aggregated_marks']; ?></b></h4>
<h4>DIVISION : <b style="color:green"><?php echo $results['division']; ?></b></h4>
<h4>DETAILED SUBJECTS : <b style="color:green"><?php echo $results['detailed_subjects']; ?></b></h4>
