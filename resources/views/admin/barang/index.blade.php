@include('admin.layout.header')
@include('admin.layout.navbar')
@include('admin.layout.sidebar')
<section class="content">
    <div class="container-fluid">
        <div class="page-title">
            <div class="title_left">
                <h2 class="ml-2">Barang</h2>
            </div>

    <div class="container">
    <div class="row">
        <div class="col-md-6">
          <div class="card card-primary" style="width: 1060px">
            <div class="card-header">
              <h3 class="card-title">Data Barang</h3>
              <br>
              @error('nama_barang')
                    <div class="text">
                      <b>{{ $message }}</b>
                    </div>
                  @enderror
                  @error('merk_barang')
                    <div class="text">
                      <b>{{ $message }}</b>
                    </div>
                  @enderror
                  @error('qty')
                    <div class="text">
                      <b>{{ $message }}</b>
                    </div>
                  @enderror
                  @error('kondisi')
                    <div class="text">
                      <b>{{ $message }}</b>
                    </div>
                  @enderror
              <div class="card-tools">
                  <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <span class="fw-bold me-1">&plus;</span> Tambah
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <div class="x_content">
                  <div class="row">
                      <div class="col-sm-12">
                          <div class="card-box table-responsive">
                            <table id="datapaket" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Barang</th>
                                        <th>Merk Barang</th>
                                        <th>QTY</th>
                                        <th>Kondisi</th>
                                        <th>Tanggal Pengadaan</th>
                                        <th>Menu</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  @foreach($barang as $b)
                                  <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $b->nama_barang}}</td>
                                    <td>{{ $b->merk_barang }}</td>
                                    <td>{{ $b->qty }}</td>
                                    <td>{{ $b->kondisi }}</td>
                                    <td>{{ $b->tanggal_pengadaan }}</td>
                                    <td>
                                      <form action="{{ route('barang.destroy', $b->id) }}" class="d-inline deleted" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger delete-produk">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                      </form>
                                      <!-- Update -->
                                      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $b->id }}">
                                        <i class="fas fa-edit"></i>
                                      </button>
                                      <!-- Modal -->
                                      <div class="modal fade" id="exampleModal{{ $b->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h5 class="modal-title" id="exampleModalLabel">Edit Paket</h5>
                                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                              <form action="{{ route('barang.update', $b->id) }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" class="form-control" id="id" name="id" value="{{ old('id') ?? $b->id }}">
                                                <label for="title"> <b> Nama barang:  {{ $b->nama_barang }}</b> </label>
                                                <div class="form-floating mb-4">
                                                  <input type="text" class="form-control" id="nama_barang" name="nama_barang"
                                                      placeholder="Nama barang" value="{{ old('nama_barang') ?? $b->nama_barang }}">
                                                  <label class="form-floating" for="title">Nama barang</label>
                                                </div>
                                                <div class="form-floating mb-4">
                                                    <input type="text" class="form-control" id="merk_barang" name="merk_barang"
                                                        placeholder="Merk barang" value="{{ old('merk_barang') ?? $b->merk_barang }}">
                                                    <label class="form-floating" for="title">Merk barang</label>
                                                  </div>
                                                  <div class="form-floating mb-4">
                                                    <input type="number" class="form-control" id="qty" name="qty"
                                                        placeholder="QTY" value="{{ old('qty') ?? $b->qty }}">
                                                    <label class="form-floating" for="title">QTY</label>
                                                  </div>
                                                <div class="form-floating mb-4">
                                                    <select class="form-select" name="kondisi" id="kondisi"
                                                        aria-label="Default select example">
                                                        <option selected disabled>-- Pilih jenis --</option>
                                                        <option value="layak_pakai">Layak Pakai</option>
                                                        <option value="rusak_ringan">Rusak Ringan</option>
                                                        <option value="rusak_berat">Rusak Berat</option>
                                                    </select>
                                                    <label class="form-floating" for="title">Kondisi Barang</label>
                                                </div>
                                                <div class="form-floating mb-4">
                                                    <input type="date" class="form-control col-md-12 col-xs-12" id="tanggal_pengadaan" name="tanggal_pengadaan" value="{{ date('Y-m-d') }}">
                                                    <label class="form-floating" for="title">Tanggal Pengadaan</label>
                                                </div>
                                                <button type="submit" class="btn btn-primary added-produk">Submit</button>
                                                @method('PATCH')
                                            </form>
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
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->


  <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tambah barang</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ route('barang.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
                <div class="form-floating mb-4">
                    <input type="text" class="form-control" id="nama_barang" name="nama_barang"
                        placeholder="Nama Barang" value="{{ old('nama_barang') }}">
                    <label class="form-floating" for="title">Nama Barang</label>
                    @error('nama_barang')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-floating mb-4">
                    <input type="text" class="form-control" id="merk_barang" name="merk_barang"
                        placeholder="Merk Barang" value="{{ old('merk_barang') }}">
                    <label class="form-floating" for="title">Merk Barang</label>
                    @error('merk_barang')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-floating mb-4">
                    <input type="number" class="form-control" id="qty" name="qty"
                        placeholder="QTY" value="{{ old('qty') }}">
                    <label class="form-floating" for="title">QTY</label>
                    @error('qty')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-floating mb-4">
                    <div class="form-group">
                        <label for="kondisi">Kondisi</label>
                        <select class="form-select" name="kondisi" id="kondisi" aria-label="Default select example">
                            <option selected disabled>-- Pilih jenis --</option>
                            <option value="layak_pakai">Layak Pakai</option>
                            <option value="rusak_ringan">Rusak Ringan</option>
                            <option value="rusak_berat">Rusak Berat</option>
                        </select>
                    </div>
                    @error('kondisi')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-floating mb-4">
                    <input type="date" class="form-control col-md-12 col-xs-12" id="tanggal_pengadaan" name="tanggal_pengadaan" value="{{ date('Y-m-d') }}">
                    <label class="form-floating" for="title">Tanggal Pengadaan</label>
                    @error('tanggal_pengadaan')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary added-produk">Submit</button>
            </form>
        </div>
    </div>
  </div>
</div>

@push('script')

  <script>
    $('.delete-produk').click(function(e) {
        e.preventDefault()
        let data = $(this).closest('tr').find('td:eq(1)').text()
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                )
                $(e.target).closest('form').submit()
            }
        })
    })
  </script>

  @if (session()->has('success'))
    <script>
        Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'Paket Telah DiTambahkan',
            showConfirmButton: false,
            timer: 1500
        })
    </script>
  @endif
  @if (session()->has('edited'))
    <script>
        Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'Paket Telah DiEdit',
            showConfirmButton: false,
            timer: 1500
        })
    </script>
  @endif

  <script>
    $(function () {
      $('#datapaket').DataTable({
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