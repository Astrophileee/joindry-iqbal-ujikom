<?php

namespace App\Imports;

use App\Models\Paket;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class PaketImport implements ToModel, WithHeadingRow, WithValidation
{
    /**
     * @param array $row
     *
     * @return Paket|null
     */
    public function model(array $row)
    {
        return new Paket([
           'nama_paket'     => $row['nama_paket'],
           'jenis'    => $row['jenis'],
           'harga' => $row['harga'],
           'id_outlet' => Auth::user()->id_outlet
        ]);
    }
    public function headingRow(): int
    {
        return 2;
    }

    public function rules(): array
    {
        return [
            'jenis' => Rule::in(['kiloan','selimut','bed_cover','kaos','lainnya']),
        ];
    }
}