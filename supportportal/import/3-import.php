<?php
// (A) CONNECT TO DATABASE - CHANGE SETTINGS TO YOUR OWN!
$dbHost = 'localhost';
$dbName = 'conzvisa_epsPortal110';
$dbChar = 'utf8';
$dbUser = 'conzvisa_portalUser';
$dbPass = 'YVMJAT@#\$#AYWinP';
$winz110="$2y$10$SfZSai9CE5Frbfg2Ak3TRex1yRwpF73i4g8LlPlBZ0ASUowvw97P6";
try {
  $pdo = new PDO(
    "mysql:host=".$dbHost.";dbname=".$dbName.";charset=".$dbChar,
    $dbUser, $dbPass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
  );
} catch (Exception $ex) { exit($ex->getMessage()); }

// (B) READ UPLOADED CSV
$fh = fopen($_FILES["upcsv"]["tmp_name"], "r");
if ($fh === false) { exit("Failed to open uploaded CSV file"); }

// (C) IMPORT ROW BY ROW
while (($row = fgetcsv($fh)) !== false) {
  try {
    // print_r($row);
    $stmt = $pdo->prepare("INSERT INTO `users` (`user_first_name`,`user_last_name`, `user_email`) VALUES (?,?,?)");
    $stmt->execute([$row[0], $row[1], $row[2]]);
  } catch (Exception $ex) { echo $ex->getmessage(); }
}
fclose($fh);
echo "<center><h2>Default Password : Winz110 has been set.</h2></center>";

