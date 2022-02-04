<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
              <img src="{{ asset('adminLTE') }}/dist/img/IMG.jpg" class="img-circle" alt="User Image" style="width: 30px">
              <span class="ml-1"> {{ Auth::user()->nama ?? '-' }}</span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
              <a href="#" class="dropdown-item">
                  <i class="fas fa-user mr-2"></i> Edit Profile
              </a>
              <button href="#" class="dropdown-item" onclick="logoutHandler()">
                  <i class="fas fa-sign-out-alt mr-2"></i> Logout
              </button>
              <form id="logoutForm" action="/logout" method="POST" class="d-inline">
                  @csrf
              </form>
          </div>
      </li>
  </ul>
  </nav>
  <!-- /.navbar -->
  <div class="wrapper">
    <div class="content-wrapper">
      <br>



      @push('script')
      <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });

        const logoutHandler = () => {
            Swal.fire({
                title: 'Logout?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#6C757D',
                cancelButtonColor: '#4DA3B8',
                confirmButtonText: 'Logout',
            }).then((result) => {
                if (!result.isConfirmed) return;
                $('#logoutForm').submit();
            });
        }
    </script>
      @endpush