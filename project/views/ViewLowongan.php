<?php

require_once __DIR__ . '/KontrakViewLowongan.php';

class ViewLowongan implements KontrakViewLowongan
{
    public function renderDaftar(string $rowsHtml, int $totalData): string
    {
        $template = file_get_contents(__DIR__ . '/../template/skin_lowongan.html');
        return strtr($template, [
            '{{TABLE_ROWS}}' => $rowsHtml,
            '{{TOTAL_DATA}}' => (string) $totalData,
        ]);
    }

    public function renderForm(string $formTitle, string $action, array $formData = []): string
    {
        $template = file_get_contents(__DIR__ . '/../template/form_lowongan.html');
        $status = (string) ($formData['status'] ?? 'Dibuka');

        $replacements = [
            '{{FORM_TITLE}}'       => htmlspecialchars($formTitle, ENT_QUOTES, 'UTF-8'),
            '{{ACTION}}'           => htmlspecialchars($action, ENT_QUOTES, 'UTF-8'),
            '{{ID}}'               => htmlspecialchars((string) ($formData['id'] ?? ''), ENT_QUOTES, 'UTF-8'),
            '{{JUDUL_POSISI}}'     => htmlspecialchars((string) ($formData['judulPosisi'] ?? ''), ENT_QUOTES, 'UTF-8'),
            '{{DEPARTEMEN}}'       => htmlspecialchars((string) ($formData['departemen'] ?? ''), ENT_QUOTES, 'UTF-8'),
            '{{LOKASI}}'           => htmlspecialchars((string) ($formData['lokasi'] ?? ''), ENT_QUOTES, 'UTF-8'),
            '{{KUOTA}}'            => htmlspecialchars((string) ($formData['kuota'] ?? '1'), ENT_QUOTES, 'UTF-8'),
            '{{SELECTED_DIBUKA}}'  => $status === 'Dibuka' ? 'selected' : '',
            '{{SELECTED_DITUTUP}}' => $status === 'Ditutup' ? 'selected' : '',
        ];

        return strtr($template, $replacements);
    }
}
