<?php

namespace App\Imports;

use App\Models\Member;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class MemberImport implements ToModel, WithHeadingRow, WithValidation
{
    /**
     * @param array $row
     *
     * @return Member|null
     */
    public function model(array $row)
    {
        return new Member([
           'nama'     => $row['nama'],
           'alamat'    => $row['alamat'],
           'jenis_kelamin' => $row['jenis_kelamin'],
           'tlp' => $row['telpon']
        ]);
    }
    public function headingRow(): int
    {
        return 2;
    }

    public function rules(): array
    {
        return [
            'jenis_kelamin' => Rule::in(['L','P']),
        ];
    }
}