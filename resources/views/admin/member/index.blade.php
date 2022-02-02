@include('admin.layout.header')
@include('admin.layout.navbar')
@include('admin.layout.sidebar')
<section class="content">
    <div class="container-fluid">
        <div class="page-title">
            <div class="title_left">
                <h2 class="ml-2">Member</h2>
            </div>
    <div class="container">
    <div class="row">
        <div class="col-md-6">
          <div class="card card-primary" style="width: 1060px">
            <div class="card-header">
              <h3 class="card-title">Data Member</h3>
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
                  @error('jenis_kelamin')
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
                                      <form action="{{ route('member.destroy', $m->id) }}" class="d-inline deleted" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger delete-member">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                      </form>
                                      <!-- Update -->
                                      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $m->id }}">
                                        <i class="fas fa-edit"></i>
                                      </button>
                                      <!-- Modal -->
                                      <div class="modal fade" id="exampleModal{{ $m->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h5 class="modal-title" id="exampleModalLabel">Edit Member</h5>
                                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                              <form action="{{ route('member.update', $m->id) }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" class="form-control" id="id" name="id" value="{{ old('id') ?? $m->id }}">
                                                <label for="title"> <b> Nama Member:  {{ $m->nama }}</b> </label>

                                                <div class="form-floating mb-4">
                                                  <input type="text" class="form-control" id="nama" name="nama"
                                                      placeholder="Nama Member" value="{{ old('nama') ?? $m->nama }}">
                                                  <label class="form-floating" for="title">Nama Member</label>
                                                </div>
                                                <div class="form-floating mb-4">
                                                  <input type="text" class="form-control" id="alamat" name="alamat"
                                                      placeholder="Alamat Member" value="{{ old('alamat') ?? $m->alamat }}">
                                                  <label class="form-floating" for="title">Alamat Member</label>
                                                </div>
                                                <div class="form-floating mb-4">
                                                  <input type="text" class="form-control" id="tlp" name="tlp"
                                                      placeholder="No Telpon" value="{{ old('tlp') ?? $m->tlp }}">
                                                  <label class="form-floating" for="title">No Telpon</label>
                                                </div>
                                                <div class="form-floating mb-4">
                                                    <select class="form-select" name="jenis_kelamin" id="jenis_kelamin"
                                                        aria-label="Default select example">
                                                        <option selected disabled>-- Pilih Jenis Kelamin --</option>
                                                        <option value="L">Laki Laki</option>
                                                        <option value="P">Perempuan</option>
                                                    </select>
                                                    <label class="form-floating" for="title">Jenis Kelamin</label>
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
        <h5 class="modal-title" id="exampleModalLabel">Tambah Member</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{ route('member.store') }}" method="POST" enctype="multipart/form-data">
          @csrf
              <div class="form-floating mb-4">
                  <input type="text" class="form-control" id="nama" name="nama"
                      placeholder="Nama Member" value="{{ old('nama') }}">
                  <label class="form-floating" for="title">Nama Member</label>
                  @error('nama')
                    <div class="text-danger">
                      {{ $message }}
                    </div>
                  @enderror
              </div>
              <div class="form-floating mb-4">
                  <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat member"
                      value="{{ old('alamat') }}">
                  <label class="form-floating" for="title">Alamat Member</label>
                  @error('alamat')
                    <div class="text-danger">
                      {{ $message }}
                    </div>
                  @enderror
              </div>
              <div class="form-floating mb-4">
                  <input type="number" class="form-control" id="tlp" name="tlp"
                      placeholder="No Telpon Member" value="{{ old('tlp') }}">
                  <label class="form-floating" for="title">No Telpon Member</label>
                  @error('tlp')
                    <div class="text-danger">
                      {{ $message }}
                    </div>
                  @enderror
              </div>
              <div class="form-floating mb-4">
                <div class="form-group">
                    <label for="jenis_kelamin">Jenis Kelamin</label>
                    <select name="jenis_kelamin" id="jenis_kelamin" class="form-control">
                        <option selected disabled>-- Pilih jenis Kelamin --</option>
                        <option value="L">Laki Laki</option>
                        <option value="P">Perempuan</option>
                    </select>
                </div>
                @error('jenis_kelamin')
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
    $('.delete-member').click(function(e) {
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
            title: 'Member Telah DiTambahkan',
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
            title: 'Member Telah DiEdit',
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