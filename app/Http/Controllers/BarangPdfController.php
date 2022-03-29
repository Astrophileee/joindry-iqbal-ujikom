<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;


class BarangPdfController extends Controller
{
    //Mendapatkan semua data penjemputan
    public function dataBarang(){

        $data = Barang::all();
        return $data;
    }
    //menyimpan data penjemputan ke file pdf
    public function exportBarangPDF()
    {
        $data = $this->DataBarang();
        $pdf  = Pdf::loadView('admin.barang.pdf', compact('data'));
        $pdf->setPaper('a4', 'potrait');

        return $pdf->stream('Laporan-barang.pdf');
    }
}
