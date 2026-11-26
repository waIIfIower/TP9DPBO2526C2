<?php

require_once __DIR__ . '/KontrakPresenter.php';
require_once __DIR__ . '/../models/KontrakModel.php';
require_once __DIR__ . '/../views/KontrakView.php';

class PresenterKandidat implements KontrakPresenter
{
    private KontrakModel $model;
    private KontrakView $view;

    public function __construct(KontrakModel $model, KontrakView $view)
    {
        $this->model = $model;
        $this->view = $view;
    }

    private function buildRowHtml(int $no, Kandidat $kandidat): string
    {
        $id = $kandidat->getId();
        $nama = htmlspecialchars($kandidat->getNama(), ENT_QUOTES, 'UTF-8');
        $posisi = htmlspecialchars($kandidat->getPosisi(), ENT_QUOTES, 'UTF-8');
        $domisili = htmlspecialchars($kandidat->getDomisili(), ENT_QUOTES, 'UTF-8');
        $skorTes = $kandidat->getSkorTes();
        $pengalaman = $kandidat->getPengalamanTahun();

        return "<tr>
            <td class="col-id">{$no}</td>
            <td><strong>{$nama}</strong></td>
            <td>{$posisi}</td>
            <td>{$domisili}</td>
            <td>{$skorTes}</td>
            <td>{$pengalaman} tahun</td>
            <td class="col-actions">
                <a href="index.php?screen=edit&id={$id}" class="btn btn-edit">Edit</a>
                <form method="post" action="index.php" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus kandidat ini?');">
                    <input type="hidden" name="action" value="hapus">
                    <input type="hidden" name="id" value="{$id}">
                    <button type="submit" class="btn btn-delete">Hapus</button>
                </form>
            </td>
        </tr>";
    }

    public function tampilkanKandidat(): string
    {
        $listKandidat = $this->model->getAllKandidat();
        $totalKandidat = count($listKandidat);

        $rowsHtml = '';
        if (empty($listKandidat)) {
            $rowsHtml = '<tr><td colspan="7" style="text-align:center;color:#6b7280;padding:24px;">Belum ada data kandidat.</td></tr>';
        } else {
            $no = 1;
            foreach ($listKandidat as $kandidat) {
                $rowsHtml .= $this->buildRowHtml($no, $kandidat);
                $no++;
            }
        }

        return $this->view->renderDaftar($rowsHtml, $totalKandidat);
    }

    public function tampilkanFormKandidat(?int $id = null): string
    {
        if ($id !== null) {
            $kandidat = $this->model->getKandidatById($id);
            if ($kandidat === null) {
                header("Location: index.php");
                exit();
            }

            $formData = [
                'id'              => $kandidat->getId(),
                'nama'            => $kandidat->getNama(),
                'posisi'          => $kandidat->getPosisi(),
                'domisili'        => $kandidat->getDomisili(),
                'skorTes'         => $kandidat->getSkorTes(),
                'pengalamanTahun' => $kandidat->getPengalamanTahun(),
            ];
            return $this->view->renderForm("Ubah Data Kandidat", "ubah", $formData);
        }

        return $this->view->renderForm("Tambah Kandidat Baru", "tambah", []);
    }

    public function tambahKandidat(string $nama, string $posisi, string $domisili, int $skorTes, int $pengalamanTahun): void
    {
        if ($nama !== '' && $posisi !== '' && $domisili !== '') {
            $skorTes = max(0, min(100, $skorTes));
            $pengalamanTahun = max(0, $pengalamanTahun);
            $this->model->addKandidat($nama, $posisi, $domisili, $skorTes, $pengalamanTahun);
        }
    }

    public function ubahKandidat(int $id, string $nama, string $posisi, string $domisili, int $skorTes, int $pengalamanTahun): void
    {
        if ($id > 0 && $nama !== '' && $posisi !== '' && $domisili !== '') {
            $skorTes = max(0, min(100, $skorTes));
            $pengalamanTahun = max(0, $pengalamanTahun);
            $this->model->updateKandidat($id, $nama, $posisi, $domisili, $skorTes, $pengalamanTahun);
        }
    }

    public function hapusKandidat(int $id): void
    {
        if ($id > 0) {
            $this->model->deleteKandidat($id);
        }
    }
}
