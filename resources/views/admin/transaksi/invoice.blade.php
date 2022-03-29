@include('admin.layout.header')
@include('admin.layout.navbar')
@include('admin.layout.sidebar')
<!-- Main content -->
<div class="invoice p-3 mb-3">
    <!-- title row -->
    <div class="row">
      <div class="col-12">
        <h4>
          <i class="fas fa-globe"></i> JoinDry, DYN.
          <small class="float-right">{{ date("Y-m-d",strtotime($transaksi->tgl)) }}</small>
        </h4>
      </div>
      <!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
      <div class="col-sm-4 invoice-col">
        From
        <address>
          <strong>{{ $transaksi->user->nama }}</strong><br>
          {{ $transaksi->outlet->nama }}<br>
        </address>
      </div>
      <!-- /.col -->
      <div class="col-sm-4 invoice-col">
        To
        <address>
          <strong>{{ $transaksi->member->nama }}</strong><br>
          {{ $transaksi->member->alamat }}<br>
          {{ $transaksi->member->jenis_kelamin }}<br>
          {{ $transaksi->member->tlp }}<br>
        </address>
      </div>
      <!-- /.col -->
      <div class="col-sm-4 invoice-col">
        <b>Invoice #{{ $transaksi->kode_invoice }}</b><br>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- Table row -->
    <div class="row">
      <div class="col-12 table-responsive">
        <table class="table table-striped">
          <thead>
            <tr>
                <th>#</th>
                <th>Nama Paket</th>
                <th>QTY</th>
                <th>Harga</th>
                <th>SubTotal</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($transaksi->detailtransaksi as $dt)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $dt->paket->nama_paket }}</td>
                    <td>{{ $dt->qty }}</td>
                    <td>{{ number_format($dt->paket->harga) }}</td>
                    <td>Rp.{{ number_format($dt->qty * $dt->paket->harga) }}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="4" style="text-align: center">Total</td>
                <td>Rp.{{ number_format($transaksi->getTotalHarga()) }}</td>
            </tr>
            <tr>
                <td colspan="4" style="text-align: center">Diskon</td>
                <td>Rp.{{ number_format($transaksi->getTotalDiskon()) }} | {{ $transaksi->diskon }}% </td>
            </tr>
            <tr>
                <td colspan="4" style="text-align: center">Pajak</td>
                <td>Rp.{{ number_format($transaksi->getTotalPajak()) }} | {{ $transaksi->pajak }}%</td>
            </tr>
            <tr style="background-color: lightgray">
                <td colspan="4" style="text-align: center" > <b>Total Pembayaran</b> </td>
                <td><b>Rp.{{ number_format($transaksi->getTotalPembayaran()) }}</b></td>
            </tr>
            <tr>
                <td colspan="5" style="text-align: right"><a  class="btn btn-success" >
                    <i class="fa fa-file-excel mr-3"></i>Excel
                </a></td>
            </tr>
        </tbody>
        </table>
    </div>
          </tbody>
        </table>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->


   
    
</section>
<!-- /.content -->
</div>

@include('admin.layout.copyright')
@include('admin.layout.footer')