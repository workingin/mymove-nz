<?php
/* 
 * The first page which is requried in any page that needs to interact with the
 * database in any way. So, any page that requires login / logout / protected
 * page - basically any user 'login script' functions should include this page at
 * the top before any other code. eg, include_once('controller.php');
 */

// Error Handling
ini_set("display_errors", 1);
ini_set('log_errors', 1);
ini_set("error_reporting", E_ALL);

// Timezone - http://php.net/manual/en/timezones.php
date_default_timezone_set('Pacific/Auckland');
 	
// Load constants (database credentials etc.)
require 'constants.php';

// The auto-loader which loads classes automatically
require 'autoload.php';

// Create an instance of the Database Class and assign the object to $db
$db = new Database();

// Create / Include the Session, Configs and Functions Objects
$session = new Session($db);
$configs = new Configs($db);
$functions = new Functions($db);
$logger = new Logger($db);
$adminfunctions = new Adminfunctions($db, $functions, $configs, $logger);


$has_company_documents = 0;
if($session->username ?? false){
    $username = $session->username;
    $query = "SELECT * FROM users WHERE username='$username' LIMIT 1";
    $result = $db->prepare($query);
    $result->execute();
    $user = $result->fetch();
    if(!empty($user)) {
        $groupid = $user['groupid'];
        $sql = "SELECT * FROM uploadedfiles WHERE user_id='$groupid' LIMIT 1";
        $result = $db->prepare($sql);
        $result->execute();
        $files = $result->fetch();
            if(!empty($files)) {
                $has_company_documents = 1;
        }
    }
}
$_SESSION['has_company_documents'] = $has_company_documents;