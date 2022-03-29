<?php

namespace App\Imports;

use App\Models\Outlet;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class OutletImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return Outlet|null
     */
    public function model(array $row)
    {
        return new Outlet([
           'nama'     => $row['nama_outlet'],
           'alamat'    => $row['alamat'],
           'tlp' => $row['tlp'],
        ]);
    }
    public function headingRow(): int
    {
        return 2;
    }

}