@include('admin.layout.header')
@include('admin.layout.navbar')
@include('admin.layout.sidebar')
<div class="container ml-5">

        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            <i class="fas fa-user-friends nav-icon"></i> Pilih Member
        </button>
        
        <br>
        <p style="font-size:15px;">
            <b>Nama Member :</b> <span style="font-size: 15px" class="nama"></span>
        </p>
        <p style="font-size:15px;">
            <b>No Telpon :</b><span style="font-size: 15px" class="tlp"></span>
        </p>
        <p style="font-size:15px;">
            <b>Alamat :</b><span style="font-size: 15px" class="alamat"></span>
        </p>

        <form class="form-horizontal form-label-left input_mask" action="{{ route('transaksi.store') }}" id="formTransaksi" method="POST">
            @csrf
            <input type="hidden" class="id_member" name="id_member">
            <div class="form-group">
                <label class="">Tanggal Pembelian</label>
                <div class="col-md-6 col-sm-12 col-xs-12">
                    <input type="date" class="data-picker form-control col-md-12 col-xs-12" name="tanggal_masuk" required value="{{ date('Y-m-d') }}">
                </div>
                <div class=""><b>Paket : </b> </div>
                <div class="input-group mb-3 col-md-6">
                    <input type="text" class="form-control" placeholder="Paket " aria-label="Recipient's username" aria-describedby="button-addon2">
                    <button class="btn button-pilih-barang btn-outline-success" type="button" id="button-addon2" data-bs-toggle="modal" data-bs-target="#exampleModalPaket">Pilih</button>
                  </div>
                </div>
            </div>

              <table id="tblTransaksi" class="table table-sm table-bordered">
                  <thead>
                      <th>Nama Layanan</th>
                      <th>Jenis</th>
                      <th>Satuan</th>
                      <th>Harga</th>
                      <th>QTY</th>
                      <th>SubTotal</th>
                      <th><i class="fas fa-cog"></i></th>
                  </thead>
                  <tbody>
          
                  </tbody>
              </table>

              <div class="row" style="text-align: right">
                <div class="col-md-12">
                  <div class="col-md-12 col-xs-12 col-md-offset-6">
                    <label for="" class="control-label col-md-3 col-sm-6 col-xs-12">Total Harga</label>
                    <input class="mb-5" required id="totalHarga" name="total" type="text" disabled>
                  </div>
                </div>
              </div>
              <div class="row">
                  <div class="col-md-12 col-sm-6 col-xs-12" style="text-align: right; margin-right:0;padding-right:0;">
                      <div class="col-md-12 col-sm-9 col-xs-12">
                          <button type="submit" class="btn btn-success">Simpan Transaksi</button>
                      </div>
                  </div>
              </div>
          
          </div>

          <div class="modal fade" id="exampleModalPaket" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Tambah Paket</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                      <div class="row">
                          <div class="col-sm-12">
                              <div class="card-box table-responsive">
                                  <table id="datamember" class="table table-bordered table-hover">
                                      <thead>
                                          <tr>
                                            <th>#</th>
                                            <th>Nama Outlet</th>
                                            <th>Nama Paket</th>
                                            <th>Jenis</th>
                                            <th>Harga</th>
                                            <th>Menu</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                        @foreach($paket as $p)
                                          <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $p->outlet->nama }}</td>
                                            <td>{{ $p->nama_paket }}</td>
                                            <td>{{ $p->jenis }}</td>
                                            <td>Rp.{{ $p->harga }}</td>
                                            <td>
                                                <button type="button" class="pilihBarangBtn btn btn-primary" data-paket-id="{{$p->id}}" data-bs-dismiss="modal">
                                                  <span class="fw-bold me-1">&plus;</span> Pilih
                                                </button>
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
          </div>

        </form>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Tambah Paket</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              <div class="row">
                  <div class="col-sm-12">
                      <div class="card-box table-responsive">
                          <table id="datamember" class="table table-bordered table-hover">
                              <thead>
                                  <tr>
                                      <th>#</th>
                                      <th>Nama Member</th>
                                      <th>Alamat</th>
                                      <th>No Telpon</th>
                                      <th>Jenis Kelamin</th>
                                      <th>Menu</th>
                                  </tr>
                              </thead>
                              <tbody>
                                @foreach($member as $m)
                                  <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $m->nama }}</td>
                                    <td>{{ $m->alamat }}</td>
                                    <td>{{ $m->tlp }}</td>
                                    <td>{{ $m->jenis_kelamin }}</td>
                                    <td>
                                        <button type="button" class="btn btn-primary" onclick="changeMember(this)" data-id="{{ $m->id }}" data-nama="{{ $m->nama }}" data-alamat="{{ $m->alamat }}" data-notelp="{{ $m->tlp }}" data-bs-dismiss="modal">
                                          <span class="fw-bold me-1">&plus;</span> Pilih
                                        </button>
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
  </div>


@push('script')
<script>
    const Id = document.querySelector('.id_member')
    const Nama = document.querySelector('.nama')
    const Notelp = document.querySelector('.tlp')
    const Alamat = document.querySelector('.alamat')
    function changeMember(el){
    let id= el.getAttribute("data-id")
    let nama = el.getAttribute("data-nama")
    let tlp= el.getAttribute("data-notelp")
    let alamat= el.getAttribute("data-alamat")
    
    console.log(id) 
    console.log(nama)
    console.log(tlp)
    console.log(alamat)

    Id.value = id;
    Nama.innerText = nama;
    Notelp.innerText = tlp;
    Alamat.innerText = alamat;
    }

  </script>
<script>
    $(function () {
      $('#datamember').DataTable({
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
@endpush

@include('admin.layout.copyright')
@include('admin.layout.footer')