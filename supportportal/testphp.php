TEST<?php
// This function will retrieve the current user IP
// needed to query the geo country
function _wp_get_ip() {
   // $ip = '127.0.0.1';

    if ( ! empty( $_SERVER['HTTP_CLIENT_IP'] ) ) {
        //check ip from share internet
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif ( ! empty( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) {
        //to check ip is pass from proxy
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } elseif( ! empty( $_SERVER['REMOTE_ADDR'] ) ) {
        $ip = $_SERVER['REMOTE_ADDR'];
    }

    $ip_array = explode( ',', $ip );
    $ip_array = array_map( 'trim', $ip_array );

    if ( $ip_array[0] == '::1' ) {
        $ip_array[0] = '127.0.0.1';
    }

    return $ip_array[0];
}

// get the country code XX 
// will return null/empty if any error
function _wp_get_country_code() {

    $response = wp_remote_get( 'http://ipinfo.io/' . _wp_get_ip() . '/country' );
    if ( strlen( $country_code = (string) trim( $response['body'] ) ) == 2 ) {
        return $country_code;   
    }

    return '';
}

$country_code = _wp_get_country_code();

if ( $country_code == 'US' ) {
    echo "US";

} else if ( $country_code == 'UK' ) {
echo "UK";
} else {

   echo $country_code;

}
?>
CHECK