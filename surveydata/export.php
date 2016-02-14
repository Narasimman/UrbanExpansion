<?php

// without composer this line can be used
require_once '../survey/application/libraries/jsonRPCClient.php';
// with composer support just add the autoloader

define( 'LS_BASEURL', 'http://urbanexpansion.org/survey/index.php');  // adjust this one to your actual LimeSurvey URL
define( 'LS_USER', 'admin' );
define( 'LS_PASSWORD', 'NYUurban1!' );

// the survey to process
$survey_id=117325;

// instanciate a new client
$myJSONRPCClient = new JsonRPCClient( LS_BASEURL.'/admin/remotecontrol' );

// receive session key
$sessionKey= $myJSONRPCClient->get_session_key( LS_USER, LS_PASSWORD );

// receive all ids and info of groups belonging to a given survey
#$groups = $myJSONRPCClient->list_groups( $sessionKey, $survey_id );

$responses = $myJSONRPCClient->export_responses( $sessionKey, $survey_id, 'json', 'en', 'complete'); 
$json = base64_decode($responses);
$decoded = json_decode( $json, true );

$results = array();

foreach ($decoded['responses'] as $key => $jsons) { // This will search in the 2 jsons
     foreach($jsons as $key => $pairs) {
	array_push($results, $pairs);
     }
}

print "<head>";
print "
<!-- Latest compiled and minified CSS -->
<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css' integrity='sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7' crossorigin='anonymous'>

<!-- Latest compiled and minified JavaScript -->
<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js' integrity='sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS' crossorigin='anonymous'></script>";

print "<table class='table table-striped'>";
print "<th>Question</th><th>Answer</th>";
print "<tbody>";

foreach($results[0] as $key => $value) {
    print_r("<tr><td>" . $key . "</td><td>" . $value . "</td></tr>", null);
}

print "</tbod></table>";
#print_r($decoded, null );

// release the session key
$myJSONRPCClient->release_session_key( $sessionKey );
