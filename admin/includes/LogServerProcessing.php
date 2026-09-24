<?php
include("controller.php");

if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && 
    strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

    $table      = 'log_table';
    $primaryKey = 'id';

    $columns = array(
        array('db' => '`users`.`username`',      'dt' => 0, 'field' => 'username'),
        array('db' => '`lt`.`log_operation`',    'dt' => 1, 'field' => 'log_operation'),
        array('db' => '`lt`.`timestamp`',        'dt' => 2, 'field' => 'timestamp',
            'formatter' => function($d, $row) {
                return date('M d, Y h:i A', $d);
            }
        ),
        array('db' => '`lt`.`ip`',               'dt' => 3, 'field' => 'ip'),
    );

    $sql_details = array(
        'user' => DB_USER,
        'pass' => DB_PASS,
        'db'   => DB_NAME,
        'host' => DB_HOST
    );

    require('ssp.class.php');

    // --- Build extraWhere ---
    $extraWhere = '1=1';

    if (!$session->isSuperAdmin()) {
        $pdo = new PDO(
            DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8',
            DB_USER,
            DB_PASS,
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
        );

        $stmt = $pdo->prepare("
            SELECT DISTINCT ug.group_id
            FROM users u
            INNER JOIN users_groups ug ON u.id = ug.user_id
            INNER JOIN groups g ON ug.group_id = g.group_id
            WHERE g.group_id != 1
              AND u.username = ?
        ");
        $stmt->execute([$session->username]);
        $allowedGroups = $stmt->fetchAll(PDO::FETCH_COLUMN);

        if (empty($allowedGroups)) {
            // User has no valid groups — return empty result immediately
            echo json_encode(['data' => [], 'recordsTotal' => 0, 'recordsFiltered' => 0]);
            exit;
        }

        // Safe integer cast — group_id should be int
        $groupIdList = implode(',', array_map('intval', $allowedGroups));
        $extraWhere .= " AND users_groups.group_id IN ($groupIdList)";
    }

    $filter_group = $_GET['filter_group']      ?? '';
    $from_date    = $_GET['filter_from_date']  ?? '';
    $end_date     = $_GET['filter_end_date']   ?? '';

    if (!empty($filter_group) && $filter_group !== 'all') {
        $extraWhere .= " AND users_groups.group_id = " . intval($filter_group);
    }

    if (!empty($from_date) && !empty($end_date)) {
        // Convert Y-m-d strings to Unix timestamps so the index on lt.timestamp is used
        $tsFrom = strtotime($from_date);
        $tsEnd  = strtotime($end_date) + 86399; // include the full end day (23:59:59)

        if ($tsFrom !== false && $tsEnd !== false) {
            $extraWhere .= " AND lt.timestamp >= $tsFrom AND lt.timestamp <= $tsEnd";
        }
    }

    $joinQuery = "FROM log_table AS lt
                  JOIN users         ON lt.userid = users.id
                  JOIN users_groups  ON lt.userid = users_groups.user_id";

    $groupBy = '';
    $order   = 'lt.timestamp DESC';

    echo json_encode(
        SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns,
                    $joinQuery, $extraWhere, $groupBy, $order)
    );
}