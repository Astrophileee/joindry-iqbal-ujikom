@include('admin.layout.header')
@include('admin.layout.navbar')
@include('admin.layout.sidebar')
<section class="content">
    <div class="container-fluid">
        <div class="page-title">
            <div class="title_left">
                <h2 class="ml-2">Outlet</h2>
            </div>

    <div class="container">
    <div class="row">
        <div class="col-md-6">
          <div class="card card-primary" style="width: 1060px">
            <div class="card-header">
              <h3 class="card-title">Data Outlet</h3>
              <br>
              @error('nama')
                    <div class="text">
                      <b>{{ $message }}</b>
                    </div>
                  @enderror
                  @error('alamat')
                    <div class="text">
                      <b>{{ $message }}</b>
                    </div>
                  @enderror
                  @error('tlp')
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
                            <table id="dataoutlet" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama</th>
                                        <th>Alamat</th>
                                        <th>No Telpon</th>
                                        <th>Menu</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  @foreach($outlet as $o)
                                  <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $o->nama }}</td>
                                    <td>{{ $o->alamat }}</td>
                                    <td>{{ $o->tlp }}</td>
                                    <td>
                                      @if ($o->canDelete())
                                      <form action="{{ route('outlet.destroy', $o->id) }}" class="d-inline deleted" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger delete-outlet">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                      </form>
                                      @else
                                      <button type="submit" class="btn btn-secondary delete-outlet" disabled>
                                          <i class="fas fa-trash"></i>
                                      </button>
                                      @endif
                                      <!-- Update -->
                                      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $o->id }}">
                                        <i class="fas fa-edit"></i>
                                      </button>
                                      <!-- Modal -->
                                      <div class="modal fade" id="exampleModal{{ $o->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h5 class="modal-title" id="exampleModalLabel">Edit Outlet</h5>
                                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                              <form action="{{ route('outlet.update', $o->id) }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" class="form-control" id="id" name="id" value="{{ old('id') ?? $o->id }}">
                                                <label for="title"> <b> Nama Outlet:  {{ $o->nama }}</b> </label>

                                                <div class="form-floating mb-4">
                                                  <input type="text" class="form-control" id="nama" name="nama"
                                                      placeholder="Nama Outlet" value="{{ old('nama') ?? $o->nama }}">
                                                  <label class="form-floating" for="title">Nama Outlet</label>
                                                </div>
                                                <div class="form-floating mb-4">
                                                  <input type="text" class="form-control" id="alamat" name="alamat"
                                                      placeholder="Alamat Outlet" value="{{ old('alamat') ?? $o->alamat }}">
                                                  <label class="form-floating" for="title">Alamat Outlet</label>
                                                </div>
                                                <div class="form-floating mb-4">
                                                  <input type="text" class="form-control" id="tlp" name="tlp"
                                                      placeholder="No Telpon" value="{{ old('tlp') ?? $o->tlp }}">
                                                  <label class="form-floating" for="title">No Telpon</label>
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
        <h5 class="modal-title" id="exampleModalLabel">Tambah Outlet</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{ route('outlet.store') }}" method="POST" enctype="multipart/form-data">
          @csrf
              <div class="form-floating mb-4">
                  <input type="text" class="form-control" id="nama" name="nama"
                      placeholder="Nama Outlet" value="{{ old('nama') }}">
                  <label class="form-floating" for="title">Nama Outlet</label>
                  @error('nama')
                    <div class="text-danger">
                      {{ $message }}
                    </div>
                  @enderror
              </div>
              <div class="form-floating mb-4">
                  <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat Outlet"
                      value="{{ old('alamat') }}">
                  <label class="form-floating" for="title">Alamat Outlet</label>
                  @error('alamat')
                    <div class="text-danger">
                      {{ $message }}
                    </div>
                  @enderror
              </div>
              <div class="form-floating mb-4">
                  <input type="number" class="form-control" id="tlp" name="tlp"
                      placeholder="No Telpon Outlet" value="{{ old('tlp') }}">
                  <label class="form-floating" for="title">No Telpon Outlet</label>
                  @error('tlp')
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
    $('.delete-outlet').click(function(e) {
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
            title: 'Outlet Telah DiTambahkan',
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
            title: 'Outlet Telah DiEdit',
            showConfirmButton: false,
            timer: 1500
        })
    </script>
  @endif

  <script>
    $(function () {
      $('#dataoutlet').DataTable({
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