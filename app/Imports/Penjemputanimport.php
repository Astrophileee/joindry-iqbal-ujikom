<?php

namespace App\Imports;

use App\Models\Member;
use App\Models\Penjemputan;
use App\Models\Pickup;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class Penjemputanimport implements WithValidation, ToModel,  WithHeadingRow
{
    private $id_outlet;


    /**
     * @param array $row
     *
     * @return Pickup|null
     */
    public function model(array $row)
    {
        $memberId = null;
        $member = Member::where('nama', $row['nama_pelanggan'])->where('tlp', $row['nomor_telepon'])->where('alamat', $row['alamat_pelanggan'])->where('jenis_kelamin', $row['jenis_kelamin'])->first();
        if ($member) {
            $memberId = $member->id;
        } else {
            $member = Member::create([
                'nama' => $row['nama_pelanggan'],
                'tlp' => $row['nomor_telepon'],
                'alamat' => $row['alamat_pelanggan'],
                'jenis_kelamin' => $row['jenis_kelamin'],
            ]);
            $memberId = $member->id;
        }

        $status = '';
        switch ($row['status_penjemputan']) {
            case 'tercatat':
                $status = 'tercatat';
                break;
            case 'penjemput':
                $status = 'penjemput';
                break;
            case 'selesai':
                $status = 'selesai';
                break;
        }

        return new Penjemputan([
            'id_member' => $memberId,
            'status' => $status,
            'petugas' => $row['nama_petugas_penjemputan'],
        ]);
    }

    public function rules(): array
    {
        return [
            'status' => Rule::in(['tercatat', 'penjemputan', 'selesai']),
            'jenis_kelamin' => Rule::in(['L', 'P']),
        ];
    }
}