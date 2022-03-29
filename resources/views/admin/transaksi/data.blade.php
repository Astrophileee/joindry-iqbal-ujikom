<div class="collapse" id="dataLaundry">
    <div class="card-body">
        <div class="x_content">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card-box table-responsive">
                        <table id="datatransaksi" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                <th>Kode</th>
                                <th>Nama Pelanggan</th>
                                <th>Item Pesanan</th>
                                <th>Tanggal Pemesanan</th>
                                <th>DeadLine</th>
                                <th>Status Cucian</th>
                                <th>Status Pembayaran</th>
                                <th>Menu</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($transaksi as $t)
                            <tr>
                                <td>{{ $t->kode_invoice }}</td>
                                <td hidden style="width: 1; height:1;">{{ $t->id }}</td>
                                <td>{{ $t->member->nama }}</td>
                                <td>{{ $t->detailtransaksi()->count() }}</td>
                                <td>{{ $t->tgl}}</td>
                                <td>{{ $t->deadline }}</td>
                                <td><select class="status form-select" name="status" id="status" aria-label="Default select example">
                                    <option value="baru" {{ $t->status === "baru" ? "selected":" " }}>Baru</option>
                                    <option value="proses" {{ $t->status === "proses" ? "selected":" " }}>Proses</option>
                                    <option value="selesai" {{ $t->status === "selesai" ? "selected":" " }}>Selesai</option>
                                    <option value="diambil" {{ $t->status === "diambil" ? "selected":" " }}>Diambil</option>
                                </select></td>
                                <td><select class="dibayar form-select" name="dibayar" id="dibayar" aria-label="Default select example">
                                    <option value="belum_dibayar" {{ $t->status === "belum_dibayar" ? "selected":" " }}>Belum Dibayar</option>
                                    <option value="dibayar" {{ $t->status === "dibayar" ? "selected":" " }}>Dibayar</option>
                                </select></td>
                                <td>
                                    <button type="submit" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $t->id}}">
                                        <i class="fas fa-eye"></i>Detail
                                    </button>
                             
                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal{{ $t->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Detail Transaksi</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <ul class="nav nav-tabs">
                                                    <li class="nav-item">
                                                    <label for="nav-detail{{ $t->id }}">
                                                        <span class="nav-link tab-detail active">Detail Pesanan</span>
                                                    </label>
                                                    <input type="radio" hidden name="modal-tab" id="nav-detail{{ $t->id }}" value="detail">
                                                    </li>
                                                    <li class="nav-item">
                                                    <label for="nav-member{{ $t->id }}">
                                                      <span class="nav-link tab-member">Detail Member</span>
                                                    </label>
                                                    <input type="radio" hidden name="modal-tab" id="nav-member{{ $t->id }}" value="member">
                                                    </li>
                                                </ul>
                                                <div class="info-detail d-block">
                                                    <table class="table table-borderless table-hover">
                                                        <tr>
                                                            <th>Kode Invoice</th>
                                                            <td>{{ $t->kode_invoice }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Nama Pelanggan</th>
                                                            <td>{{ $t->member->nama }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Tanggal Pemesanan</th>
                                                            <td>{{ $t->tgl}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Deadline</th>
                                                            <td>{{ $t->deadline }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Status Pembayaran</th>
                                                            <td>{{ $t->dibayar }}</td>
                                                        </tr>
                                                    </table>
                                                    <table class="table">
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
                                                        @foreach ($t->detailtransaksi as $dt)
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
                                                            <td>Rp.{{ number_format($t->getTotalHarga()) }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="4" style="text-align: center">Diskon</td>
                                                            <td>Rp.{{ number_format($t->getTotalDiskon()) }} | {{ $t->diskon }}% </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="4" style="text-align: center">Pajak</td>
                                                            <td>Rp.{{ number_format($t->getTotalPajak()) }} | {{ $t->pajak }}%</td>
                                                        </tr>
                                                        <tr style="background-color: lightgray">
                                                            <td colspan="4" style="text-align: center" > <b>Total Pembayaran</b> </td>
                                                            <td><b>Rp.{{ number_format($t->getTotalPembayaran()) }}</b></td>
                                                        </tr>
                                                        <tr>
                                                            <td><a href="{{ route('TransaksiInvoice', $t->id) }}" class="btn btn-success" >
                                                                <i class="fas fa-print mr-3"></i>Invoice
                                                            </a></td>
                                                        </tr>
                                                    </tbody>
                                                    </table>
                                                </div>
                                                <div class="info-member d-none">
                                                    <table class="table table-borderless table-hover">
                                                        <tr>
                                                            <th>Nama Pelanggan</th>
                                                            <td>{{ $t->member->nama }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Alamat Pelanggan</th>
                                                            <td>{{ $t->member->alamat}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>No Telpon Pelanggan</th>
                                                            <td>{{ $t->member->tlp }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Jenis Kelamin Pelanggan</th>
                                                            <td>{{ $t->member->jenis_kelamin }}</td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary">Save changes</button>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
  


@push('script')
<script>
$('#datatransaksi').on('change', '[name="modal-tab"]',function() {
    let modalBody = $(this).closest('.modal-body');
            if ($(this).val() == 'member') {
                modalBody.find('.nav-link.tab-member').addClass('active');
                modalBody.find('.nav-link.tab-detail').removeClass('active');
                modalBody.find('.info-member').removeClass('d-none');
                modalBody.find('.info-detail').removeClass('d-block');
                modalBody.find('.info-member').addClass('d-block');
                modalBody.find('.info-detail').addClass('d-none');
            } else {
                modalBody.find('.nav-link.tab-detail').addClass('active');
                modalBody.find('.nav-link.tab-member').removeClass('active');
                modalBody.find('.info-detail').removeClass('d-none');
                modalBody.find('.info-member').removeClass('d-block');
                modalBody.find('.info-detail').addClass('d-block');
                modalBody.find('.info-member').addClass('d-none');
            }
        });
    $(function () {
      $('#datatransaksi').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });
  </script>
<script>
$('#datatransaksi').on('change','.status',function(){
    let ID = $(this).closest('tr').find('td:eq(1)').text()
    let checked = ($(this).val())
    let data = {id:ID,
                status : checked,
                _token: "{{ csrf_token() }}"};
    $.post('{{ route("statusTransaksi") }}', data, function(res){
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'success',
            title: res.msg,
            showConfirmButton: false,
            timer: 1500
        })
    }).fail((err)=>{ Swal.fire({
        toast: true,
            position: 'top-end',
            icon: 'error',
            title: 'Status gagal diupdate',
            showConfirmButton: false,
            timer: 1500
        }) 
        console.log(err.responseJSON) })
})
</script>
<script>
    $('#datatransaksi').on('change','.dibayar',function(){
        let ID = $(this).closest('tr').find('td:eq(1)').text()
        let checked = ($(this).val())
        console.log(ID)
        console.log(checked)
        let data = {id:ID,
                    status : checked,
                    _token: "{{ csrf_token() }}"};
        $.post('{{ route("pembayaranTransaksi") }}', data, function(res){
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: res.msg,
                showConfirmButton: false,
                timer: 1500
            })
        }).fail((err)=>{ Swal.fire({
            toast: true,
                position: 'top-end',
                icon: 'error',
                title: 'Pembayaran gagal diupdate',
                showConfirmButton: false,
                timer: 1500
            }) 
            console.log(err.responseJSON) })
    })
    </script>
@endpush