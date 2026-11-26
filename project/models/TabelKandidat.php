<?php

require_once __DIR__ . '/DB.php';
require_once __DIR__ . '/Kandidat.php';
require_once __DIR__ . '/KontrakModel.php';

class TabelKandidat extends DB implements KontrakModel
{
    private function mapRowToKandidat(array $row): Kandidat
    {
        return new Kandidat(
            (int) $row['id'],
            (string) $row['nama'],
            (string) $row['posisi'],
            (string) $row['domisili'],
            (int) $row['skorTes'],
            (int) $row['pengalamanTahun']
        );
    }

    public function getAllKandidat(): array
    {
        $query = "SELECT * FROM kandidat ORDER BY skorTes DESC, id ASC";
        $this->executeQuery($query);
        $rows = $this->getAllResult();

        $list = [];
        foreach ($rows as $row) {
            $list[] = $this->mapRowToKandidat($row);
        }
        return $list;
    }

    public function getKandidatById(int $id): ?Kandidat
    {
        $query = "SELECT * FROM kandidat WHERE id = :id LIMIT 1";
        $this->executeQuery($query, [':id' => $id]);
        $rows = $this->getAllResult();
        if (empty($rows)) {
            return null;
        }
        return $this->mapRowToKandidat($rows[0]);
    }

    public function addKandidat(string $nama, string $posisi, string $domisili, int $skorTes, int $pengalamanTahun): bool
    {
        $query = "INSERT INTO kandidat (nama, posisi, domisili, skorTes, pengalamanTahun)
                  VALUES (:nama, :posisi, :domisili, :skorTes, :pengalamanTahun)";
        $this->executeQuery($query, [
            ':nama'            => $nama,
            ':posisi'          => $posisi,
            ':domisili'        => $domisili,
            ':skorTes'         => $skorTes,
            ':pengalamanTahun' => $pengalamanTahun,
        ]);
        return true;
    }

    public function updateKandidat(int $id, string $nama, string $posisi, string $domisili, int $skorTes, int $pengalamanTahun): bool
    {
        $query = "UPDATE kandidat
                  SET nama = :nama,
                      posisi = :posisi,
                      domisili = :domisili,
                      skorTes = :skorTes,
                      pengalamanTahun = :pengalamanTahun
                  WHERE id = :id";
        $this->executeQuery($query, [
            ':id'              => $id,
            ':nama'            => $nama,
            ':posisi'          => $posisi,
            ':domisili'        => $domisili,
            ':skorTes'         => $skorTes,
            ':pengalamanTahun' => $pengalamanTahun,
        ]);
        return true;
    }

    public function deleteKandidat(int $id): bool
    {
        $query = "DELETE FROM kandidat WHERE id = :id";
        $this->executeQuery($query, [':id' => $id]);
        return true;
    }
}
