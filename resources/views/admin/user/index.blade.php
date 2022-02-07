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
                                      <th>Nama</th>
                                      <th>Email</th>
                                      <th>Outlet</th>
                                      <th>Role</th>
                                      <th>Menu</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  @foreach($user as $u)
                                  <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $u->nama }}</td>
                                    <td>{{ $u->email }}</td>
                                    <td>{{ $u->outlet->nama}}</td>
                                    <td>{{ $u->role }}</td>
                                    <td>
                                      <form action="{{ route('user.destroy', $u->id) }}" class="d-inline deleted" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger delete-produk">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                      </form>
                                      <!-- Update -->
                                      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $u->id }}">
                                        <i class="fas fa-edit"></i>
                                      </button>
                                      <!-- Modal -->
                                      <div class="modal fade" id="exampleModal{{ $u->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
                                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                              <form action="{{ route('user.update', $u->id) }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" class="form-control" id="id" name="id" value="{{ old('id') ?? $u->id }}">
                                                <label for="title"> <b> Nama Paket:  {{ $u->nama }}</b> </label>

                                                <div class="form-floating mb-4">
                                                    <select class="form-select" name="id_outlet"
                                                        aria-label="Default select example">
                                                        <option selected disabled>-- Pilih Outlet --</option>
                                                        @foreach ($outlet as $o)
                                                            <option value="{{$o->id }}" @if($o->id_outlet == $o->id) selected @endif>{{ $o->nama }}</option>
                                                        @endforeach
                                                    </select>
                                                    <label class="form-floating" for="title">Nama Outlet</label>
                                                </div>
                                                <div class="form-floating mb-4">
                                                  <input type="text" class="form-control" name="nama"
                                                      placeholder="Nama" value="{{ old('nama') ?? $u->nama }}">
                                                  <label class="form-floating" for="title">Nama</label>
                                                </div>
                                                <div class="form-floating mb-4">
                                                    <input type="email" class="form-control" name="email"
                                                        placeholder="Email" value="{{ old('email') ?? $u->email }}">
                                                    <label class="form-floating" for="title">Email</label>
                                                  </div>
                                                  <div class="form-floating mb-4">
                                                    <input type="password" class="form-control" name="password"
                                                        placeholder="Password" value="{{ old('password') }}">
                                                    <label class="form-floating" for="title">Password</label>
                                                  </div>
                                                  <div class="form-floating mb-4">
                                                    <input type="password" class="form-control" name="password_confirmation"
                                                        placeholder="Password Confirmation" value="{{ old('password_confirmation') }}">
                                                    <label class="form-floating" for="title">Password Confirmation</label>
                                                  </div>
                                                <div class="form-floating mb-4">
                                                    <select class="form-select" name="role" 
                                                        aria-label="Default select example">
                                                        <option selected disabled>-- Pilih Role --</option>
                                                        <option value="admin">Admin</option>
                                                        <option value="kasir">Kasir</option>
                                                        <option value="owner">Owner</option>
                                                    </select>
                                                    <label class="form-floating" for="title">Role User</label>
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
          <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
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
                    <input type="nama" class="form-control" id="nama" name="nama"
                        placeholder="Nama" value="{{ old('nama') }}">
                    <label class="form-floating" for="title">Nama</label>
                    @error('nama')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-floating mb-4">
                    <input type="email" class="form-control" id="email" name="email"
                        placeholder="Email" value="{{ old('email') }}">
                    <label class="form-floating" for="title">Email</label>
                    @error('email')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-floating mb-4">
                    <input type="password" class="form-control" id="password" name="password"
                        placeholder="Password" value="{{ old('password') }}">
                    <label class="form-floating" for="title">Password</label>
                    @error('password')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-floating mb-4">
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                        placeholder="Password Confirmation" value="{{ old('password_confirmation') }}">
                    <label class="form-floating" for="title">Password Confirmation</label>
                    @error('password_confirmation')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-floating mb-4">
                    <div class="form-group">
                        <label for="role">Role</label>
                        <select name="role" id="role" class="form-control">
                            <option selected disabled>-- Pilih Role --</option>
                            <option value="admin">Admin</option>
                            <option value="kasir">Kasir</option>
                            <option value="owner">Owner</option>
                        </select>
                    </div>
                    @error('role')
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