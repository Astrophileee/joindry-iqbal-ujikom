<?php

namespace App\Http\Controllers;

use App\Models\Penjemputan;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;


class PenjemputanPdfController extends Controller
{
    //Mendapatkan semua data penjemputan
    public function dataPenjemputan(){

        $data = Penjemputan::all();
        return $data;
    }
    //menyimpan data penjemputan ke file pdf
    public function exportPenjemputanPDF()
    {
        $data = $this->DataPenjemputan();
        $pdf  = Pdf::loadView('admin.penjemputan.pdf', compact('data'));
        $pdf->setPaper('a4', 'potrait');

        return $pdf->stream('Laporan-penjemputan.pdf');
    }
}
