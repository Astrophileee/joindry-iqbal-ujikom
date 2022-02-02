@include('admin.layout.header')
@include('admin.layout.navbar')
@include('admin.layout.sidebar')
<section class="content">
    <div class="container-fluid">
        <div class="page-title">
            <div class="title_left">
                <h2 class="ml-2">Paket</h2>
            </div>

    <div class="container">
    <div class="row">
        <div class="col-md-6">
          <div class="card card-primary" style="width: 1060px">
            <div class="card-header">
              <h3 class="card-title">Data Paket</h3>
              <br>
              @error('nama_paket')
                    <div class="text">
                      <b>{{ $message }}</b>
                    </div>
                  @enderror
                  @error('harga')
                    <div class="text">
                      <b>{{ $message }}</b>
                    </div>
                  @enderror
                  @error('jenis')
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
                                      <form action="{{ route('paket.destroy', $p->id) }}" class="d-inline deleted" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger delete-produk">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                      </form>
                                      <!-- Update -->
                                      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $p->id }}">
                                        <i class="fas fa-edit"></i>
                                      </button>
                                      <!-- Modal -->
                                      <div class="modal fade" id="exampleModal{{ $p->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h5 class="modal-title" id="exampleModalLabel">Edit Paket</h5>
                                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                              <form action="{{ route('paket.update', $p->id) }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" class="form-control" id="id" name="id" value="{{ old('id') ?? $p->id }}">
                                                <label for="title"> <b> Nama Paket:  {{ $p->nama_paket }}</b> </label>

                                                <div class="form-floating mb-4">
                                                    <select class="form-select" name="id_outlet" id="id_outlet"
                                                        aria-label="Default select example">
                                                        <option selected disabled>-- Pilih Outlet --</option>
                                                        @foreach ($outlet as $o)
                                                            <option value="{{$o->id }}" @if($o->id_outlet == $o->id) selected @endif>{{ $o->nama }}</option>
                                                        @endforeach
                                                    </select>
                                                    <label class="form-floating" for="title">Nama Outlet</label>
                                                </div>
                                                <div class="form-floating mb-4">
                                                  <input type="text" class="form-control" id="nama_paket" name="nama_paket"
                                                      placeholder="Nama Paket" value="{{ old('nama_paket') ?? $p->nama_paket }}">
                                                  <label class="form-floating" for="title">Nama Paket</label>
                                                </div>
                                                <div class="form-floating mb-4">
                                                    <select class="form-select" name="jenis" id="jenis"
                                                        aria-label="Default select example">
                                                        <option selected disabled>-- Pilih jenis --</option>
                                                        <option value="kaos">Kaos</option>
                                                        <option value="selimut">Selimut</option>
                                                        <option value="bed_cover">Bed Cover</option>
                                                        <option value="lainnya">Lainnya</option>
                                                    </select>
                                                    <label class="form-floating" for="title">Jenis Paket</label>
                                                </div>
                                                <div class="form-floating mb-4">
                                                  <input type="text" class="form-control" id="harga" name="harga"
                                                      placeholder="Alamat Outlet" value="{{ old('harga') ?? $p->harga }}">
                                                  <label class="form-floating" for="title">Alamat Outlet</label>
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
            <h5 class="modal-title" id="exampleModalLabel">Tambah Paket</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ route('paket.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
                <div class="form-floating mb-4">
                        <select class="form-select" name="id_outlet" id="id_outlet"
                            aria-label="Default select example">
                            <option selected disabled>-- Pilih Outlet --</option>
                            @foreach ($outlet as $o)
                                <option value="{{ $o->id }}">{{ $o->nama }}</option>
                            @endforeach
                        </select>
                        <label class="form-floating" for="title">Nama Outlet</label>
                        @error('id_outlet')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                        @enderror
                </div>
                <div class="form-floating mb-4">
                    <input type="text" class="form-control" id="nama_paket" name="nama_paket"
                        placeholder="Nama Paket" value="{{ old('nama_paket') }}">
                    <label class="form-floating" for="title">Nama Paket</label>
                    @error('nama_paket')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-floating mb-4">
                    <div class="form-group">
                        <label for="jenis">Jenis</label>
                        <select name="jenis" id="jenis" class="form-control">
                            <option selected disabled>-- Pilih jenis --</option>
                            <option value="kaos">Kaos</option>
                            <option value="selimut">Selimut</option>
                            <option value="bed_cover">Bed Cover</option>
                            <option value="lainnya">Lainnya</option>
                        </select>
                    </div>
                    @error('jenis')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-floating mb-4">
                    <input type="number" class="form-control" id="harga" name="harga"
                        placeholder="Harga Paket" value="{{ old('harga') }}">
                    <label class="form-floating" for="title">Harga Paket</label>
                    @error('harga')
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