<?php

class Kandidat
{
    private int $id;
    private string $nama;
    private string $posisi;
    private string $domisili;
    private int $skorTes;
    private int $pengalamanTahun;

    public function __construct(
        int $id = 0,
        string $nama = '',
        string $posisi = '',
        string $domisili = '',
        int $skorTes = 0,
        int $pengalamanTahun = 0
    ) {
        $this->id = $id;
        $this->nama = $nama;
        $this->posisi = $posisi;
        $this->domisili = $domisili;
        $this->skorTes = $skorTes;
        $this->pengalamanTahun = $pengalamanTahun;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getNama(): string
    {
        return $this->nama;
    }

    public function setNama(string $nama): void
    {
        $this->nama = $nama;
    }

    public function getPosisi(): string
    {
        return $this->posisi;
    }

    public function setPosisi(string $posisi): void
    {
        $this->posisi = $posisi;
    }

    public function getDomisili(): string
    {
        return $this->domisili;
    }

    public function setDomisili(string $domisili): void
    {
        $this->domisili = $domisili;
    }

    public function getSkorTes(): int
    {
        return $this->skorTes;
    }

    public function setSkorTes(int $skorTes): void
    {
        $this->skorTes = $skorTes;
    }

    public function getPengalamanTahun(): int
    {
        return $this->pengalamanTahun;
    }

    public function setPengalamanTahun(int $pengalamanTahun): void
    {
        $this->pengalamanTahun = $pengalamanTahun;
    }
}
