@include('admin.layout.header')
@include('admin.layout.navbar')
@include('admin.layout.sidebar')

<ul class="nav nav-tabs">
    <li class="nav-item">
      <a class="nav-link active" id="nav-data" data-toggle="collapse" href="#dataLaundry" role="button" aria-expanded="false" aria-controls="collapseExample">Data Laundry</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="nav-form" data-toggle="collapse" href="#formLaundry" role="button" aria-expanded="false" aria-controls="collapseExample"></i>&nbsp;&nbsp;Cucian Baru</a>
    </li>
</ul>

<div class="card" style="border-top: 0px;">
  <form action="{{{ route('transaksi.store') }}}" method="post">
    @csrf
    @include('admin.transaksi.form')
    @include('admin.transaksi.data')
    <input type="hidden" name="id_member" id="id_member">
  </form>
</div>

@push('script')
{{-- Menu script untuk data dan form transaksi  --}}
<script>
  $('#dataLaundry').collapse('show');

  $('#dataLaundry').on('show.bs.collapse',function(){
      $('#formLaundry').collapse('hide');
      $('#nav-form').removeClass('active');
      $('nav-data').addClass('active');
  }),

  $('#formLaundry').on('show.bs.collapse',function(){
      $('#dataLaundry').collapse('hide');
      $('#nav-data').removeClass('active');
      $('nav-form').addClass('active');
  });
</script>

@if (session()->has('success'))
<script>
    Swal.fire({
        position: 'top-end',
        icon: 'success',
        title: 'Transaksi Telah DiTambahkan',
        showConfirmButton: false,
        timer: 1500
    })
</script>
@endif

    
@endpush


@include('admin.layout.copyright')
@include('admin.layout.footer')