<?php

// without composer this line can be used
require_once '../survey/application/libraries/jsonRPCClient.php';
require_once 'config.php';

// instanciate a new client
$myJSONRPCClient = new JsonRPCClient( LS_BASEURL.'/admin/remotecontrol' );

// receive session key
$sessionKey= $myJSONRPCClient->get_session_key( LS_USER, LS_PASSWORD );
?>

<head>
    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css'>

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
$afflist = array();

foreach($results as $result) {
    if(strpos($result['surveyls_title'],'Affordability') !== FALSE) {
        $city = substr($result['surveyls_title'], strpos($result['surveyls_title'], "-") + 1);
        $city = trim($city);
        $city = strtolower($city);
        $afflist[$city]  = $result;   
    }
}

ksort($afflist);
#print_r( $results);
?>

<form action="/surveydata/csv.php" method="post" class="form-horizontal">
   <table class='table table-striped'>
    <th>Affordability</th> 
    <tbody>
    <input type='hidden' name='type' value='aff'/>
    <?php
    
    #Affordability
    foreach($afflist as $k => $result) {
        if($result['active'] == 'Y') {
            $responses = $myJSONRPCClient->export_responses( $sessionKey, $result['sid'], 'json', 'en', 'complete','short', 'long');
            $valid = false;
            if(!isset($responses['status'])) {
                $json = base64_decode($responses);
                $decoded = json_decode( $json, true );
                foreach ($decoded['responses'] as $key => $jsons) { // This will search in the 2 jsons
                    foreach($jsons as $key => $pairs) {
                        $valid = true;
                        break;
                    }
                }
            }
            if($valid){
                print "<tr><td><input type='checkbox' name='id[]' value='" . $result['sid'] . "|" . $k . "'><label>" . $k . "</label></td></tr>";
            }
      }
    }

?>
    </tbody></table>
    <input type="submit" name="submit" value="Submit" class="btn btn-primary"/>
</form>


<table class='table table-striped'>
<th>View on Web</th> <th> Export to Excel </th><th> Title </th>
<tbody>

<?php

foreach($afflist as $result) {
    if($result['active'] == 'Y') {
        print "<tr><td><a href='/surveydata/export.php?id=" . $result['sid'] . "' target='_blank'>Web</a></td>";
        print "<td><a href='/surveydata/csv.php?type=aff&id=" . $result['sid'] . "' target='_blank'>Excel</a></td>";
        print "<td>" . $result['surveyls_title'] . "</td></tr>";    
    }
}


?>

</tbody>
</table>
<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js'></script>
</body>

<?php

// release the session key
$myJSONRPCClient->release_session_key( $sessionKey );
?>

