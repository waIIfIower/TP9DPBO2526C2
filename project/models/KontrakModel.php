<?php

require_once __DIR__ . '/Kandidat.php';

interface KontrakModel
{
    public function getAllKandidat(): array;
    public function getKandidatById(int $id): ?Kandidat;
    public function addKandidat(string $nama, string $posisi, string $domisili, int $skorTes, int $pengalamanTahun): bool;
    public function updateKandidat(int $id, string $nama, string $posisi, string $domisili, int $skorTes, int $pengalamanTahun): bool;
    public function deleteKandidat(int $id): bool;
}
