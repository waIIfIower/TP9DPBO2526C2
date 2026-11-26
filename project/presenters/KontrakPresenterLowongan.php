<?php

interface KontrakPresenterLowongan
{
    public function tampilkanLowongan(): string;
    public function tampilkanFormLowongan(?int $id = null): string;
    public function tambahLowongan(string $judulPosisi, string $departemen, string $lokasi, int $kuota, string $status): void;
    public function ubahLowongan(int $id, string $judulPosisi, string $departemen, string $lokasi, int $kuota, string $status): void;
    public function hapusLowongan(int $id): void;
}
