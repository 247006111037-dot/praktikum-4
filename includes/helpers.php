<?php
function sanitize_text(string $value): string
{
    return trim($value);
}

function validate_mahasiswa_input(array $input): array
{
    $errors = [];

    $npm = sanitize_text((string) ($input['npm'] ?? ''));
    $nama = sanitize_text((string) ($input['nama'] ?? ''));
    $jurusan = sanitize_text((string) ($input['jurusan'] ?? ''));

    if ($npm === '') {
        $errors[] = 'NPM mahasiswa wajib diisi.';
    }

    if ($nama === '') {
        $errors[] = 'Nama mahasiswa wajib diisi.';
    }

    if ($jurusan === '') {
        $errors[] = 'Jurusan wajib diisi.';
    }

    return [
        'errors' => $errors,
        'data' => [
            'npm' => $npm,
            'nama' => $nama,
            'jurusan' => $jurusan
        ]
    ];
}