<?php

require_once __DIR__ . '/Lowongan.php';

interface KontrakModelLowongan
{
    public function getAllLowongan(): array;
    public function getLowonganById(int $id): ?Lowongan;
    public function addLowongan(string $judulPosisi, string $departemen, string $lokasi, int $kuota, string $status): bool;
    public function updateLowongan(int $id, string $judulPosisi, string $departemen, string $lokasi, int $kuota, string $status): bool;
    public function deleteLowongan(int $id): bool;
}
