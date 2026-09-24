<?php
$useremail="mehboob@dataintel.co.nz";
$url = 'https://workingin91596.api-us1.com';
$params = array(
'api_key' => '9229acccf9ff43180e40f8dba16af88f693dcb9fbe885b43eb80ec690d1c4bad9d83ff2d',
'api_action' => 'deal_list',
'api_output' => 'json',
'filters[email]' =>$useremail ,
'full' => 1,
);
$query = "";
foreach( $params as $key => $value ) $query .= urlencode($key) . '=' . urlencode($value) . '&';
$query = rtrim($query, '& ');
$url = rtrim($url, '/ ');
if ( !function_exists('curl_init') ) die('CURL not supported. (introduced in PHP 4.0.2)');
if ( $params['api_output'] == 'json' && !function_exists('json_decode') ) {
    die('JSON not supported. (introduced in PHP 5.2.0)');
}
$api = $url . '/admin/api.php?' . $query;

$request = curl_init($api); // initiate curl object
curl_setopt($request, CURLOPT_HEADER, 0); // set to 0 to eliminate header info from response
curl_setopt($request, CURLOPT_RETURNTRANSFER, 1); // Returns response data instead of TRUE(1)
//curl_setopt($request, CURLOPT_SSL_VERIFYPEER, FALSE); // uncomment if you get no gateway response and are using HTTPS
curl_setopt($request, CURLOPT_FOLLOWLOCATION, true);

$response = (string)curl_exec($request); // execute curl fetch and store results in $response

curl_close($request); // close curl object

if ( !$response ) {
    die('Nothing was returned. Do you have a connection to Email Marketing server?');
}
$result = json_decode($response, true);
echo $result['deals']['0']['id'];

$dealid=$result['deals']['0']['id'];

$params = array(
'api_key' => '9229acccf9ff43180e40f8dba16af88f693dcb9fbe885b43eb80ec690d1c4bad9d83ff2d',
    'api_action'   => 'deal_note_add',
    'api_output'   => 'json'
);

$post = array(
    'note'    => 'Follow up about this deal soon',
    'dealid'         => $dealid,
    
);


$query = "";
foreach( $params as $key => $value ) $query .= urlencode($key) . '=' . urlencode($value) . '&';
$query = rtrim($query, '& ');

$data = "";
foreach( $post as $key => $value ) $data .= urlencode($key) . '=' . urlencode($value) . '&';
$data = rtrim($data, '& ');

// clean up the url
$url = rtrim($url, '/ ');
if ( !function_exists('curl_init') ) die('CURL not supported. (introduced in PHP 4.0.2)');

if ( $params['api_output'] == 'json' && !function_exists('json_decode') ) {
    die('JSON not supported. (introduced in PHP 5.2.0)');
}

$api = $url . '/admin/api.php?' . $query;

$request = curl_init($api); // initiate curl object
curl_setopt($request, CURLOPT_HEADER, 0); // set to 0 to eliminate header info from response
curl_setopt($request, CURLOPT_RETURNTRANSFER, 1); // Returns response data instead of TRUE(1)
curl_setopt($request, CURLOPT_POSTFIELDS, $data); // use HTTP POST to send form data
//curl_setopt($request, CURLOPT_SSL_VERIFYPEER, FALSE); // uncomment if you get no gateway response and are using HTTPS
curl_setopt($request, CURLOPT_FOLLOWLOCATION, true);

$response = (string)curl_exec($request); // execute curl post and store results in $response

curl_close($request); // close curl object

if ( !$response ) {
    die('Nothing was returned. Do you have a connection to Email Marketing server?');
}
$result = json_decode($response, true);


?>
