<?php

class UploadedFilesRepository {

    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function insert(string $filename, int $userId, string $category, string $title): bool
    {
        $stmt = $this->db->prepare(
            'INSERT INTO uploadedfiles (filename, user_id, filecategory, file_title)
             VALUES (:filename, :user_id, :filecategory, :file_title)'
        );

        return $stmt->execute([
            ':filename'     => $filename,
            ':user_id'      => $userId,
            ':filecategory' => $category,
            ':file_title'   => $title,
        ]);
    }

    public function findById(int $id): ?array
    {
        $stmt = $this->db->prepare('SELECT * FROM uploadedfiles WHERE id = :id LIMIT 1');
        $stmt->execute([':id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row ?: null;
    }

    public function deleteById(int $id): bool
    {
        $stmt = $this->db->prepare('DELETE FROM uploadedfiles WHERE id = :id');
        return $stmt->execute([':id' => $id]);
    }
}
