@include('admin.layout.header')
@include('admin.layout.navbar')
@include('admin.layout.sidebar')
<section class="content">
    <div class="container-fluid">
        <div class="page-title">
            <div class="title_left">
                <h2 class="ml-2">Transaksi</h2>
            </div>

<div class="container">
    <div class="row">
        <div class="col-md-6">
          <div class="card card-primary" style="width: 1060px">
            <div class="card-header">
              <h3 class="card-title">Data Transaksi</h3>
              <div class="card-tools">
                  <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <a href="/admin/transaksi/create" type="button">
                    <span class="fw-bold me-1">&plus;</span> Tambah
                    </a>
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
                                        <th>Kode Invoice</th>
                                        <th>Member</th>
                                        <th>Tanggal</th>
                                        <th>Deadline</th>
                                        <th>Tanggal Bayar</th>
                                        <th>Biaya Tambahan</th>
                                        <th>Diskon</th>
                                        <th>Jenis Diskon</th>
                                        <th>Pajak</th>
                                        <th>status</th>
                                        <th>Dibayar</th>
                                        <th>User</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  @foreach($transaksi as $t)
                                  <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $t->outlet->nama }}</td>
                                    <td>{{ $t->kode_invoce }}</td>
                                    <td>{{ $t->member->nama }}</td>
                                    <td>{{ $t->tanggal }}</td>
                                    <td>{{ $t->tgl }}</td>
                                    <td>{{ $t->deadlien }}</td>
                                    <td>{{ $t->tgl_bayar }}</td>
                                    <td>{{ $t->biaya_tambahan }}</td>
                                    <td>{{ $t->diskon }}</td>
                                    <td>{{ $t->jenis_diskon }}</td>
                                    <td>{{ $t->pajak }}</td>
                                    <td>{{ $t->status }}</td>
                                    <td>{{ $t->dibayar }}</td>
                                    <td>{{ $t->user->nama }}</td>
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
        "autoWidth": true,
        "responsive": true,
      });
    });
  </script>
@endpush
@include('admin.layout.copyright')
@include('admin.layout.footer')