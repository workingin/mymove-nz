<?php

include_once 'controller.php';

if (!$session->isAdmin()) {
    header("Location: " . $configs->homePage());
    exit;
}

/**
 * logprocess.php 
 */
if (isset($_POST['form_submission'])) {

    Csrf::requireValidRequest();

    $form_submission = $_POST['form_submission'];
    switch ($form_submission) {

        case "delete_logs" :
            deleteLogs($logger, $session);
            break;
        case "delete_some_logs" :
            deleteSomeLogs($logger, $session);
            break;
        default :
            if ($session->logged_in) {
                logout($session, $configs);
            } else {
                header("Location: " . $configs->homePage());
            }
    }
} else {
    header("Location: " . $configs->homePage());
    exit;
}

/**
 * *************************************************************************
 * deleteLogs - 
 * *************************************************************************
 */
function deleteLogs($logger, $session) {
    
    $logger->purgeLogs();
    $logger->logAction($session->id, "DELETED ALL LOGS");
    Flash::success('All logs have been deleted.');
    header("Location: " . $session->referrer);
    
}

/**
 * *************************************************************************
 * deleteSomeLogs - 
 * *************************************************************************
 */
function deleteSomeLogs($logger, $session) {
    
    $logger->deleteLogs(30);
    $logger->logAction($session->id, "DELETED LOGS");
    Flash::success('Logs older than 30 days have been deleted.');
    header("Location: " . $session->referrer);
    
}
