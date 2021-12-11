# NECTA-API
A PHP library which can fetch results national examinations (CSEE and ACSEE)
```
Project : NECTA API
Version : 1.0 Beta
Language : PHP (Pure)
Programmer : Bwire C Mashauri
Contact : +255 689 938 643
```

## Usage
```php
//Include the configuration file for the API on your project.
require_once('napi/config.php');

//Include the main class which perfom all the API functions on your project.
require_once('napi/necta_class.php');

//Call a function to fetch results from NECTA website.
//$results = fetch_results("Index Number", "Exam Type", "Exam Year");
$results = fetch_results("S2332/0009", "CSEE", "2020");

//Retrieving status message from the API.
$message = $results['message'];

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
