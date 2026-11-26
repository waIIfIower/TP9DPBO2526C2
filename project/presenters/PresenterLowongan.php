<?php

require_once __DIR__ . '/KontrakPresenterLowongan.php';
require_once __DIR__ . '/../models/KontrakModelLowongan.php';
require_once __DIR__ . '/../views/KontrakViewLowongan.php';

class PresenterLowongan implements KontrakPresenterLowongan
{
    private KontrakModelLowongan $model;
    private KontrakViewLowongan $view;

    public function __construct(KontrakModelLowongan $model, KontrakViewLowongan $view)
    {
        $this->model = $model;
        $this->view = $view;
    }

    private function buildRowHtml(int $no, Lowongan $lowongan): string
    {
        $id = $lowongan->getId();
        $judulPosisi = htmlspecialchars($lowongan->getJudulPosisi(), ENT_QUOTES, 'UTF-8');
        $departemen = htmlspecialchars($lowongan->getDepartemen(), ENT_QUOTES, 'UTF-8');
        $lokasi = htmlspecialchars($lowongan->getLokasi(), ENT_QUOTES, 'UTF-8');
        $kuota = $lowongan->getKuota();
        $statusRaw = $lowongan->getStatus();
        $status = htmlspecialchars($statusRaw, ENT_QUOTES, 'UTF-8');

        $badgeClass = $statusRaw === 'Dibuka' ? 'badge-open' : 'badge-closed';

        return "<tr>
            <td class="col-id">{$no}</td>
            <td><strong>{$judulPosisi}</strong></td>
            <td>{$departemen}</td>
            <td>{$lokasi}</td>
            <td>{$kuota} orang</td>
            <td><span class="badge {$badgeClass}">{$status}</span></td>
            <td class="col-actions">
                <a href="index.php?modul=lowongan&screen=edit&id={$id}" class="btn btn-edit">Edit</a>
                <form method="post" action="index.php?modul=lowongan" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus lowongan ini?');">
                    <input type="hidden" name="modul" value="lowongan">
                    <input type="hidden" name="action" value="hapus">
                    <input type="hidden" name="id" value="{$id}">
                    <button type="submit" class="btn btn-delete">Hapus</button>
                </form>
            </td>
        </tr>";
    }

    public function tampilkanLowongan(): string
    {
        $listLowongan = $this->model->getAllLowongan();
        $totalLowongan = count($listLowongan);

        $rowsHtml = '';
        if (empty($listLowongan)) {
            $rowsHtml = '<tr><td colspan="7" style="text-align:center;color:#6b7280;padding:24px;">Belum ada data lowongan.</td></tr>';
        } else {
            $no = 1;
            foreach ($listLowongan as $lowongan) {
                $rowsHtml .= $this->buildRowHtml($no, $lowongan);
                $no++;
            }
        }

        return $this->view->renderDaftar($rowsHtml, $totalLowongan);
    }

    public function tampilkanFormLowongan(?int $id = null): string
    {
        if ($id !== null) {
            $lowongan = $this->model->getLowonganById($id);
            if ($lowongan === null) {
                header("Location: index.php?modul=lowongan");
                exit();
            }

            $formData = [
                'id'          => $lowongan->getId(),
                'judulPosisi' => $lowongan->getJudulPosisi(),
                'departemen'  => $lowongan->getDepartemen(),
                'lokasi'      => $lowongan->getLokasi(),
                'kuota'       => $lowongan->getKuota(),
                'status'      => $lowongan->getStatus(),
            ];
            return $this->view->renderForm("Ubah Data Lowongan", "ubah", $formData);
        }

        return $this->view->renderForm("Tambah Lowongan Baru", "tambah", []);
    }

    public function tambahLowongan(string $judulPosisi, string $departemen, string $lokasi, int $kuota, string $status): void
    {
        if ($judulPosisi !== '' && $departemen !== '' && $lokasi !== '') {
            $kuota = max(1, $kuota);
            $status = in_array($status, ['Dibuka', 'Ditutup'], true) ? $status : 'Dibuka';
            $this->model->addLowongan($judulPosisi, $departemen, $lokasi, $kuota, $status);
        }
    }

    public function ubahLowongan(int $id, string $judulPosisi, string $departemen, string $lokasi, int $kuota, string $status): void
    {
        if ($id > 0 && $judulPosisi !== '' && $departemen !== '' && $lokasi !== '') {
            $kuota = max(1, $kuota);
            $status = in_array($status, ['Dibuka', 'Ditutup'], true) ? $status : 'Dibuka';
            $this->model->updateLowongan($id, $judulPosisi, $departemen, $lokasi, $kuota, $status);
        }
    }

    public function hapusLowongan(int $id): void
    {
        if ($id > 0) {
            $this->model->deleteLowongan($id);
        }
    }
}
