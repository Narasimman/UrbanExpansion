<?php

// without composer this line can be used
require_once '../survey/application/libraries/jsonRPCClient.php';
// with composer support just add the autoloader

define( 'LS_BASEURL', 'http://urbanexpansion.org/survey/index.php');  // adjust this one to your actual LimeSurvey URL
define( 'LS_USER', 'admin' );
define( 'LS_PASSWORD', 'NYUurban1!' );

// the survey to process
$param_id = $_GET['id'];
$survey_ids = explode(",", $param_id);

// instanciate a new client
$myJSONRPCClient = new JsonRPCClient( LS_BASEURL.'/admin/remotecontrol' );

// receive session key
$sessionKey= $myJSONRPCClient->get_session_key( LS_USER, LS_PASSWORD );

$results = array();
// receive all ids and info of groups belonging to a given survey
foreach($survey_ids as $survey_id) {
    $responses = $myJSONRPCClient->export_responses( $sessionKey, $survey_id, 'json', 'en', 'complete','abbreviated','long'); 
    $json = base64_decode($responses);
    $decoded = json_decode( $json, true );
    $processed_pairs = array();
    foreach ($decoded['responses'] as $key => $jsons) { // This will search in the 2 jsons
        foreach($jsons as $key => $pairs) {
	    foreach($pairs as $key => $value) {
            	#if(preg_match("/^G[0-9]Q*/", $key)) {
		    $processed_pairs[$key] = $value;
		#}
            }


	    array_push($results, $processed_pairs);
        }
    }
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

print "<table class='table table-striped'>";
print "<th>Question</th><th>Answer</th>";
print "<tbody>";

$length = sizeof($results);

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
