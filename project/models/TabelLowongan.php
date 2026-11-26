<?php

require_once __DIR__ . '/DB.php';
require_once __DIR__ . '/Lowongan.php';
require_once __DIR__ . '/KontrakModelLowongan.php';

class TabelLowongan extends DB implements KontrakModelLowongan
{
    private function mapRowToLowongan(array $row): Lowongan
    {
        return new Lowongan(
            (int) $row['id'],
            (string) $row['judulPosisi'],
            (string) $row['departemen'],
            (string) $row['lokasi'],
            (int) $row['kuota'],
            (string) $row['status']
        );
    }

    public function getAllLowongan(): array
    {
        $query = "SELECT * FROM lowongan ORDER BY status ASC, id ASC";
        $this->executeQuery($query);
        $rows = $this->getAllResult();

        $list = [];
        foreach ($rows as $row) {
            $list[] = $this->mapRowToLowongan($row);
        }
        return $list;
    }

    public function getLowonganById(int $id): ?Lowongan
    {
        $query = "SELECT * FROM lowongan WHERE id = :id LIMIT 1";
        $this->executeQuery($query, [':id' => $id]);
        $rows = $this->getAllResult();
        if (empty($rows)) {
            return null;
        }
        return $this->mapRowToLowongan($rows[0]);
    }

    public function addLowongan(string $judulPosisi, string $departemen, string $lokasi, int $kuota, string $status): bool
    {
        $query = "INSERT INTO lowongan (judulPosisi, departemen, lokasi, kuota, status)
                  VALUES (:judulPosisi, :departemen, :lokasi, :kuota, :status)";
        $this->executeQuery($query, [
            ':judulPosisi' => $judulPosisi,
            ':departemen'  => $departemen,
            ':lokasi'      => $lokasi,
            ':kuota'       => $kuota,
            ':status'      => $status,
        ]);
        return true;
    }

    public function updateLowongan(int $id, string $judulPosisi, string $departemen, string $lokasi, int $kuota, string $status): bool
    {
        $query = "UPDATE lowongan
                  SET judulPosisi = :judulPosisi,
                      departemen = :departemen,
                      lokasi = :lokasi,
                      kuota = :kuota,
                      status = :status
                  WHERE id = :id";
        $this->executeQuery($query, [
            ':id'          => $id,
            ':judulPosisi' => $judulPosisi,
            ':departemen'  => $departemen,
            ':lokasi'      => $lokasi,
            ':kuota'       => $kuota,
            ':status'      => $status,
        ]);
        return true;
    }

    public function deleteLowongan(int $id): bool
    {
        $query = "DELETE FROM lowongan WHERE id = :id";
        $this->executeQuery($query, [':id' => $id]);
        return true;
    }
}
