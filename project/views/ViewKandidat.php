<?php

require_once __DIR__ . '/KontrakView.php';

class ViewKandidat implements KontrakView
{
    public function renderDaftar(string $rowsHtml, int $totalData): string
    {
        $template = file_get_contents(__DIR__ . '/../template/skin.html');
        return strtr($template, [
            '{{TABLE_ROWS}}' => $rowsHtml,
            '{{TOTAL_DATA}}' => (string) $totalData,
        ]);
    }

    public function renderForm(string $formTitle, string $action, array $formData = []): string
    {
        $template = file_get_contents(__DIR__ . '/../template/form.html');

        $replacements = [
            '{{FORM_TITLE}}'       => htmlspecialchars($formTitle, ENT_QUOTES, 'UTF-8'),
            '{{ACTION}}'           => htmlspecialchars($action, ENT_QUOTES, 'UTF-8'),
            '{{ID}}'               => htmlspecialchars((string) ($formData['id'] ?? ''), ENT_QUOTES, 'UTF-8'),
            '{{NAMA}}'             => htmlspecialchars((string) ($formData['nama'] ?? ''), ENT_QUOTES, 'UTF-8'),
            '{{POSISI}}'           => htmlspecialchars((string) ($formData['posisi'] ?? ''), ENT_QUOTES, 'UTF-8'),
            '{{DOMISILI}}'         => htmlspecialchars((string) ($formData['domisili'] ?? ''), ENT_QUOTES, 'UTF-8'),
            '{{SKOR_TES}}'         => htmlspecialchars((string) ($formData['skorTes'] ?? '0'), ENT_QUOTES, 'UTF-8'),
            '{{PENGALAMAN_TAHUN}}' => htmlspecialchars((string) ($formData['pengalamanTahun'] ?? '0'), ENT_QUOTES, 'UTF-8'),
        ];

        return strtr($template, $replacements);
    }
}
