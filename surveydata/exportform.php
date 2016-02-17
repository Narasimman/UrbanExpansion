<?php

// without composer this line can be used
require_once '../survey/application/libraries/jsonRPCClient.php';
// with composer support just add the autoloader

define( 'LS_BASEURL', 'http://urbanexpansion.org/survey/index.php');  // adjust this one to your actual LimeSurvey URL
define( 'LS_USER', 'admin' );
define( 'LS_PASSWORD', 'NYUurban1!' );

// the survey to process
$survey_ids=array(117325,147543);

// instanciate a new client
$myJSONRPCClient = new JsonRPCClient( LS_BASEURL.'/admin/remotecontrol' );

// receive session key
$sessionKey= $myJSONRPCClient->get_session_key( LS_USER, LS_PASSWORD );

print "<head>";
print "
<!-- Latest compiled and minified CSS -->
<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css' integrity='sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7' crossorigin='anonymous'>

<!-- Latest compiled and minified JavaScript -->
<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js' integrity='sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS' crossorigin='anonymous'></script></head>";

print "<body>";

$results = $myJSONRPCClient->list_surveys($sessionKey, 'admin');
#print_r( $results);

print "<table class='table table-striped'>";
print "<th>Survey Details</th>";
print "<tbody>";

foreach($results as $result) {
    if($result['active'] == 'Y') {
        print_r("<tr><td><a href='/surveydata/export.php?id=" . $result['sid'] . "' target='_blank'>" . $result['sid'] . "</a></td><td>" . $result['surveyls_title'] . "</td></tr>", null);    
    }
}

print "</tbody></table>";
print "</body>";

#print_r($decoded, null );

// release the session key
$myJSONRPCClient->release_session_key( $sessionKey );
