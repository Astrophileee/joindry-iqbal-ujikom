<?php

namespace App\Imports;

use App\Models\Barang;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class BarangImport implements ToModel, WithHeadingRow, WithValidation
{
    
    /**
     * @param array $row
     *
     * @return Barang|null
     */
    public function model(array $row)
    {
        $tanggal = date('Y-m-d H:i:s',($row['waktu_pakai'] - 25569)*86400);
        return new Barang([
           'nama_barang' => $row['nama_barang'],
           'waktu_pakai' => $tanggal,
           'nama_pemakai' => $row['nama_pemakai'],
           'status' => $row['status'],
        ]);
    }
    public function headingRow(): int
    {
        return 1;
    }

    public function rules(): array
    {
        return [
            'status' => Rule::in(['belum_selesai','selesai']),
        ];
    }
}