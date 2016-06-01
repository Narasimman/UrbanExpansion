<?php

// without composer this line can be used
require_once '../survey/application/libraries/jsonRPCClient.php';
require_once 'config.php';

// the survey to process
$postvars = $_POST['id'];
$lang = $_POST['lang'];
$survey_ids = array();
$titles = array();

foreach($postvars as $var) {
    $item = explode("|", $var);
    array_push($survey_ids, $item[0]);
    array_push($titles, $item[1]);
}


if(sizeof($survey_ids) <= 0) {
    $survey_ids = array($_GET['id']);
    $lang = $_GET['lang'];
}

if(empty($lang)) {
    $lang = 'en';
}


// instanciate a new client
$myJSONRPCClient = new JsonRPCClient( LS_BASEURL.'/admin/remotecontrol' );

// receive session key
$sessionKey= $myJSONRPCClient->get_session_key( LS_USER, LS_PASSWORD );


$results = array();
// receive all ids and info of groups belonging to a given survey
foreach($survey_ids as $survey_id) {
    $responses = $myJSONRPCClient->export_responses( $sessionKey, $survey_id, 'json', $lang, 'complete','full');
    if(!isset($responses['status'])) {
        $json = base64_decode($responses);
        $decoded = json_decode( $json, true );
        $processed_pairs = array();
        foreach ($decoded['responses'] as $key => $jsons) { // This will search in the 2 jsons
            foreach($jsons as $key => $pairs) {
                foreach($pairs as $key => $value) {
                    $processed_pairs[$key] = $value;
                }
        
                array_push($results, $processed_pairs);
            }
        } #for
    } #if
}

?>

<head>
<!-- Latest compiled and minified CSS -->
<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css' integrity='sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7' crossorigin='anonymous'>

<!-- Latest compiled and minified JavaScript -->
<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js' integrity='sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS' crossorigin='anonymous'></script></head>

<body>

<?php 
#$ids = $myJSONRPCClient->list_surveys($sessionKey, 'admin');
#print_r( $ids);


$keys = array_keys($results[0]);

print "<table class='table table-bordered table-hover'>";
print "<th>Question</th>";

$length = sizeof($results);

for($i = 0; $i < $length ; $i++){
    print "<th>" . $titles[$i] . "</th>";
}
print "<tbody>";


foreach($keys as $key) {
    print "<tr>";
    print "<td>" . $key . "</td>";
    for($i = 0; $i < $length; $i++){         
        print_r("<td>" . $results[$i][$key] . "</td>", null);
    }
    print "</tr>";
}
    
print "</tbody></table>";

?>
</body>

<?php
#print_r($decoded, null );

// release the session key
$myJSONRPCClient->release_session_key( $sessionKey );
?>
