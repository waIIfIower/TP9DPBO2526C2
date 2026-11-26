<?php

interface KontrakPresenter
{
    public function tampilkanKandidat(): string;
    public function tampilkanFormKandidat(?int $id = null): string;
    public function tambahKandidat(string $nama, string $posisi, string $domisili, int $skorTes, int $pengalamanTahun): void;
    public function ubahKandidat(int $id, string $nama, string $posisi, string $domisili, int $skorTes, int $pengalamanTahun): void;
    public function hapusKandidat(int $id): void;
}
