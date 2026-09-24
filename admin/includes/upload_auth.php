<?php

require_once dirname(__FILE__) . '/controller.php';

function requireUploadAdmin(): void
{
    global $session;

    if (!$session->logged_in || !$session->isAdmin()) {
        http_response_code(403);
        exit('Access denied.');
    }
}

function getLoggedInUserGroupId(PDO $db, Session $session): ?int
{
    $stmt = $db->prepare('SELECT groupid FROM users WHERE username = :username LIMIT 1');
    $stmt->execute([':username' => $session->username]);
    $groupid = $stmt->fetchColumn();

    if ($groupid === false || $groupid === null || $groupid === '') {
        return null;
    }

    return (int) $groupid;
}

function assertUserOwnsGroup(PDO $db, Session $session, int $requestedGroupId): void
{
    if ($session->isSuperAdmin()) {
        return;
    }

    $groupId = getLoggedInUserGroupId($db, $session);

    if ($groupId === null || $groupId !== $requestedGroupId) {
        http_response_code(403);
        exit('You are not allowed to perform this action for the selected group.');
    }
}

function userCanAccessUploadedFile(PDO $db, Session $session, array $fileRow): bool
{
    if ($session->isSuperAdmin()) {
        return true;
    }

    $groupId = getLoggedInUserGroupId($db, $session);

    if ($groupId === null) {
        return false;
    }

    return (int) $fileRow['user_id'] === $groupId;
}

function adminFilesReportUrl(Configs $configs): string
{
    return rtrim($configs->getConfig('WEB_ROOT'), '/') . '/files_report.php';
}
