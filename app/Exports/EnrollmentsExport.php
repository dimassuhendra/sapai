<?php

namespace App\Exports;

use App\Models\Enrollment;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class EnrollmentsExport implements FromQuery, WithHeadings, WithMapping
{
    protected $status, $limit;

    public function __construct($status, $limit)
    {
        $this->status = $status;
        $this->limit = $limit;
    }

    public function query()
    {
        $query = Enrollment::with(['user', 'program'])
            ->where('status_bayar', $this->status)
            ->orderBy('created_at', 'desc');

        if ($this->limit != 'all') {
            $query->limit((int)$this->limit);
        }

        return $query;
    }

    // Menentukan judul kolom di baris pertama Excel
    public function headings(): array
    {
        return [
            'Tanggal Daftar',
            'Nama Lengkap',
            'Email',
            'Program',
            'Harga',
            'Status Bayar'
        ];
    }

    // Memetakan data dari database ke kolom Excel
    public function map($enrollment): array
    {
        return [
            $enrollment->tgl_daftar,
            $enrollment->user->nama_lengkap,
            $enrollment->user->email,
            $enrollment->program->nama_program,
            $enrollment->program->harga,
            strtoupper($enrollment->status_bayar),
        ];
    }
}
