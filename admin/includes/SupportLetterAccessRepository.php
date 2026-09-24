<?php

class SupportLetterAccessRepository {

    private PDO $db;

    private const VISA_AEWV = 'Accredited Employer Work Visa';
    private const VISA_SRV = 'Straight to Residence Visa';

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function getAccessType(int $userId): ?string
    {
        $stmt = $this->db->prepare(
            'SELECT support_letter_access FROM users WHERE id = :id LIMIT 1'
        );
        $stmt->execute([':id' => $userId]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) {
            return null;
        }

        $access = trim((string) ($row['support_letter_access'] ?? ''));

        return in_array($access, ['both', 'aewv', 'SRV'], true) ? $access : null;
    }

    public function canAccessVisaType(?string $accessType, string $visaType): bool
    {
        $visaType = trim($visaType);

        if ($accessType === 'both') {
            return in_array($visaType, [self::VISA_AEWV, self::VISA_SRV], true);
        }

        if ($accessType === 'aewv') {
            return $visaType === self::VISA_AEWV;
        }

        if ($accessType === 'SRV') {
            return $visaType === self::VISA_SRV;
        }

        return false;
    }
}
