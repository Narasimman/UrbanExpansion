<?php
// without composer this line can be used
require_once '../survey/application/libraries/jsonRPCClient.php';
include 'PHPExcel/Classes/PHPExcel/IOFactory.php';
require_once 'config.php';

// the survey to process
if(!empty($_POST)) {
    $postvars = $_POST['id'];
    $survey_ids = array();
    $titles = array();
    $type = $_POST['type'];

    foreach($postvars as $var) {
        $item = explode("|", $var);
        array_push($survey_ids, $item[0]);
        array_push($titles, $item[1]);
    }
} else if(!empty($_GET)) {
    $survey_ids = array($_GET['id']);
    $type       = $_GET['type'];
} else {
    print "<h1>No Survey Ids passed!</h1>";
}

#$survey_ids = array(147451);
// instanciate a new client
$myJSONRPCClient = new JsonRPCClient( LS_BASEURL.'/admin/remotecontrol' );

// receive session key
$sessionKey= $myJSONRPCClient->get_session_key( LS_USER, LS_PASSWORD );


$results = array();
$i = 0;
// receive all ids and info of groups belonging to a given survey
foreach($survey_ids as $survey_id) {
    $responses = $myJSONRPCClient->export_responses( $sessionKey, $survey_id, 'json', 'en', 'complete','short', 'long');
    $title = $titles[$i];
    if(!isset($responses['status'])) {
        $json = base64_decode($responses);
        $decoded = json_decode( $json, true );
        $processed_pairs = array();
        foreach ($decoded['responses'] as $key => $jsons) { // This will search in the 2 jsons
            foreach($jsons as $key => $pairs) {
                foreach($pairs as $key => $value) {
                    if(preg_match("/^G[^2]*Q[0-9]*/", $key) == True) {
                        $processed_pairs[$key] = $value;
                    }
                }
                $processed_pairs['title'] = $title;
                #array_push($results, $processed_pairs);
                $results[$title] = $processed_pairs;
            }
        } #for
    } #if
    $i++;
}
if(sizeof($results) == 0) {
    print "No Response recorded for this survey";
} else {
$keys = array_keys(array_values($results)[0]);

$length = sizeof($results);
ksort($results);
$inputFileType = PHPExcel_IOFactory::identify('reg.xlsx');
$objReader = PHPExcel_IOFactory::createReader($inputFileType);


if($type == 'reg') {
    $filename = 'reg.xlsx';
    $activeindex = 1;
} else {
    $filename = 'aff.xlsx';
    $activeindex = 3;
}

$objPHPExcel = $objReader->load($filename);

$objPHPExcel->setActiveSheetIndex($activeindex);
$worksheet = $objPHPExcel->getActiveSheet();

$row = 2;
$column = 'A';

foreach($results as $k => $result) {
    $column = 'A';
    foreach ($keys as $key) {
        $worksheet->setCellValue($column.$row, $result[$key]);
        $column++;
    }
    $worksheet->setCellValue($column.$row, $result['title']);
    $row++;
}

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="export.xlsx"');
header('Cache-Control: max-age=0');


$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, $inputFileType);
$filePath = '/tmp/' . rand(0, getrandmax()) . rand(0, getrandmax()) . ".tmp";
$objWriter->save($filePath);
readfile($filePath);
unlink($filePath);
}
?>
