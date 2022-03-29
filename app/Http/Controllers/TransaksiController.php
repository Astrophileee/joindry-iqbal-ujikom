<?php

namespace App\Http\Controllers;

use App\Exports\LaporanExport;
use App\Models\DetailTransaksi;
use App\Models\Member;
use App\Models\Outlet;
use App\Models\Paket;
use App\Models\Transaksi;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class TransaksiController extends Controller
{
    /**
     * Menampilkan Halaman Transaksi
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.transaksi.index',[
            'transaksi' => Transaksi::all(),
            'outlet' => Outlet::all(),
            'member' => Member::all(),
            'user' => User::all(),
            'paket' => Paket::all()
        ]);
    }

    /**
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Menyimpan data transaksi baru
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'id_paket' =>'required',
            'dibayar' =>'required',
            'deadline' =>'required',
            'id_member' => 'required'
        ]);

        $request['id_outlet']= auth()->user()->id_outlet;
        $request['kode_invoice']= Transaksi::createInvoice();
        $request['tgl']= date('Y-m-d');
        $request['tgl_bayar']= date('Y-m-d');
        $request['status']= 'baru';
        $request['dibayar']= $request->dibayar;
        $request['id_user']=auth()->user()->id;
        $request['deadline']= $request->deadline;


        $input_transaksi = Transaksi::create($request->all());
        if($input_transaksi == NULL){
            return back()->withErrors([
                'transaksi' => 'Input Transaksi Gagal',
            ]);
        }

        foreach($request->id_paket as $i => $v){
            $input_detail = DetailTransaksi::create([
                'id_transaksi' => $input_transaksi->id,
                'id_paket' => $v,
                'qty' => $request->qty[$i],
                'keterangan' => ''
            ]);
        }
        return redirect('admin/transaksi')->with('success','success');
    }

    /**
     * Menampilkan halaman invoice 
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param \App\Models\Transaksi $transaksi
     * @return \Illuminate\Http\Response
     */
    public function invoice(Request $request,Transaksi $transaksi){
        return view('admin.transaksi.invoice',[
            'transaksi' => $transaksi,
            
        ]);
        
    }

    public function updateStatus(Request $request){
        $data = Transaksi::where('id',$request->id)->first();
        $data->status = $request->status;
        $update = $data->save();

        if($update){
            $msg = $data->status=="baru"?"Status Telah DiUpdate":"Status Telah DiUpdate";
            return response()->json(['msg'=>$msg],200);
        }      
    }

    public function updatePembayaran(Request $request){
        $data = Transaksi::where('id',$request->id)->first();
        $data->dibayar = $request->status;
        $update = $data->save();

        if($update){
            $msg = $data->dibayar=="dibayar"?"Pembayaran Telah DiUpdate":"Pembayaran Telah DiUpdate";
            return response()->json(['msg'=>$msg],200);
        }      
    }

    public function laporan()
    {
        return view('admin.transaksi.laporan');
    }

    public function laporanDatatable(Request $request)
    {
        $dateStart = ($request->has('date_start') && $request->date_start != "") ? $request->date_start : date('Y-m-d', mktime(0, 0, 0, date('m'), 1, date('Y')));
        $dateEnd = ($request->has('date_end') && $request->date_end != "") ? $request->date_end : date('Y-m-d');

        $transakasi = Transaksi::whereBetween('tgl', [$dateStart, $dateEnd])->get();

        return DataTables::of($transakasi)
            ->addIndexColumn()
            ->editColumn('date', function ($t) {
                return date('d/m/Y', strtotime($t->tgl));
            })
            ->editColumn('deadline', function ($t) {
                return date('d/m/Y', strtotime($t->deadline));
            })
            ->addColumn('total_payment', function ($t) {
                return $t->getTotalPembayaran();
            })
            ->addColumn('total_item', function ($t) {
                return $t->detailtransaksi()->count();
            })->rawColumns(['actions'])->make(true);
    }

    public function exportExcel(Request $request)
    {
        $dateStart = ($request->has('date_start') && $request->date_start != "") ? $request->date_start : date('Y-m-d', mktime(0, 0, 0, date('m'), 1, date('Y')));
        $dateEnd = ($request->has('date_end') && $request->date_end != "") ? $request->date_end : date('Y-m-d');

        return Excel::download((new LaporanExport)->whereOutlet(auth()->user()->id_outlet)->setDateStart($dateStart)->setDateEnd($dateEnd), 'Transaksi-' . $dateStart . '-' . $dateEnd . '.xlsx');
    }

    public function exportPDF(Request $request)
    {
        $dateStart = ($request->has('date_start') && $request->date_start != "") ? $request->date_start : date('Y-m-d', mktime(0, 0, 0, date('m'), 1, date('Y')));
        $dateEnd = ($request->has('date_end') && $request->date_end != "") ? $request->date_end : date('Y-m-d');

        $transaksi = Transaksi::where('id_outlet', auth()->user()->id_outlet)->whereBetween('tgl', [$dateStart, $dateEnd])->with('detailtransaksi')->get();

        $pdf = Pdf::loadView('admin.transaksi.pdf', ['transaksi' => $transaksi, 'outlet' => auth()->user()->outlet, 'dateStart' => $dateStart, 'dateEnd' => $dateEnd]);
        return $pdf->stream('Transaksi-' . $dateStart . '-' . $dateEnd . '.pdf');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
