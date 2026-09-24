<?php
include("controller.php");
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) 
   && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') 
  {
// DB table to use
$table = 'log_table';

// Table's primary key
$primaryKey = 'id';

$columns = array(
	array( 'db' => '`users`.`username`',     'dt' => 0, 'field' => 'username'),
	array( 'db' => '`lt`.`log_operation`','dt' => 1, 'field' => 'log_operation' ),
	array( 'db' => '`lt`.`timestamp`', 'dt' => 2, 'field' => 'timestamp', 'formatter' => function( $d, $row ) {
																	return date( 'M d,Y h:m A', $d);
																}),
);

$sql_details = array(
	'user' => DB_USER,
	'pass' => DB_PASS,
	'db'   => DB_NAME,
	'host' => DB_HOST
);

require('ssp.class.php' );

$joinQuery = "FROM log_table as lt JOIN users_groups ON lt.userid = users_groups.user_id JOIN users ON lt.userid = users.id ";

$extraWhere = "(lt.log_operation='LOGIN' OR lt.log_operation LIKE 'REGISTERED%') ";

if(!$session->isSuperAdmin()){
    $extraWhere .= "AND users_groups.group_id IN (SELECT group_concat(groups.group_id) FROM `users` INNER JOIN users_groups ON users.id = users_groups.user_id INNER JOIN groups ON users_groups.group_id = groups.group_id WHERE groups.group_id != 1 AND username= '$session->username')";
}
$filter_group = $_GET['filter_group'];
$from_date = $_GET['filter_from_date'];
$end_date = $_GET['filter_end_date'];

if(!empty($filter_group) AND $filter_group != 'all'){
    $extraWhere .= " AND users_groups.group_id = '$filter_group'";
}

if(!empty($from_date) AND !empty($end_date)){
    $extraWhere .= " AND DATE(FROM_UNIXTIME(lt.timestamp)) >= '$from_date' AND DATE(FROM_UNIXTIME(lt.timestamp)) <= '$end_date'";
}

// $extraWhere = "`u`.`salary` >= 90000";
$groupBy = " lt.userid, lt.log_operation ";
$order = "lt.timestamp DESC";

echo json_encode(
	SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraWhere, $groupBy, $order)
);
}