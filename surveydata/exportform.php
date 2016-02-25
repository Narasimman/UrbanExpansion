<?php

// without composer this line can be used
require_once '../survey/application/libraries/jsonRPCClient.php';
// with composer support just add the autoloader

define( 'LS_BASEURL', 'http://urbanexpansion.org/survey/index.php');  // adjust this one to your actual LimeSurvey URL

// the survey to process
$survey_ids=array(117325,147543);

// instanciate a new client
$myJSONRPCClient = new JsonRPCClient( LS_BASEURL.'/admin/remotecontrol' );

// receive session key
$sessionKey= $myJSONRPCClient->get_session_key( LS_USER, LS_PASSWORD );
?>

<head>
<!-- Latest compiled and minified CSS -->
    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css' integrity='sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7' crossorigin='anonymous'>

<!-- Latest compiled and minified JavaScript -->
    <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js' integrity='sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS' crossorigin='anonymous'></script>

<style>
.options {
    margin : 10px;
}

.survey_container {
    width : 50%;
    display: inline-block;
}

</style>

</head>

<body>



<?php
$results = $myJSONRPCClient->list_surveys($sessionKey, 'admin');
$reglist = array();
$afflist = array();

foreach($results as $result) {
    if(strpos($result['surveyls_title'], 'Regulatory') !== FALSE) {
        array_push($reglist, $result);        
    } else {
	    array_push($afflist, $result);
    }
}
#print_r( $results);
?>

<form action="/surveydata/csv.php" method="post" class="form-horizontal">
    <?php


    print "<div class='survey_container'> <p> Regulatory Survey </p>";
    foreach($reglist as $result) {
        if($result['active'] == 'Y') {
 	    $label = substr($result['surveyls_title'], strpos($result['surveyls_title'], "-") + 1);
        print "<p class='options'><input type='checkbox' name='id[]' value='" . $result['sid'] . "|" . $label . "'><label>" . $label . "</label></p>";
      }
    }
    print "</div>";

    #Aff
    print "<div class='survey_container'><p>Affordability Survey </p>";
    foreach($afflist as $result) {
        if($result['active'] == 'Y') {
 	    $label = substr($result['surveyls_title'], strpos($result['surveyls_title'], "-") + 1);
        print "<p class='options'><input type='checkbox' name='id[]' value='" . $result['sid'] . "|" . $label . "'><label>" . $label . "</label></p>";
      }
    }
    print "</div>";

    ?>
    <input type="submit" name="submit" value="Submit" class="btn btn-primary"/>
</form>


<table class='table table-striped'>
<th>View on Web</th> <th> Export to Excel </th><th> Title </th>
<tbody>

<?php
foreach($reglist as $result) {
    if($result['active'] == 'Y') {
        print "<tr><td><a href='/surveydata/export.php?id=" . $result['sid'] . "' target='_blank'>Web</a></td>";
        print "<td><a href='/surveydata/csv.php?type=reg&id=" . $result['sid'] . "' target='_blank'>Excel</a></td>";
        print "<td>" . $result['surveyls_title'] . "</td></tr>";    
    }
}

foreach($afflist as $result) {
    if($result['active'] == 'Y') {
        print "<tr><td><a href='/surveydata/export.php?id=" . $result['sid'] . "' target='_blank'>Web</a></td>";
        print "<td><a href='/surveydata/csv.php?type=aff&id=" . $result['sid'] . "' target='_blank'>Excel</a></td>";
        print "<td>" . $result['surveyls_title'] . "</td></tr>";    
    }
}


?>

</tbody></table>
</body>

<?php

// release the session key
$myJSONRPCClient->release_session_key( $sessionKey );
?>

