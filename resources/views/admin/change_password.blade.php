@include('user.layouts.head')
<body>
  <div class=" container-fluid" id="main">
    <div class="login-card pt-5">
      <div class="row">
        <div class="col-md-6 offset-md-3">
          <div class="p-3 shadow bg-transparent border border-1 border-light rounded-4">
            <div class="text-center mt-3">
              <img src="{{ asset('/assets/img/logo.png') }}" alt="" style="width: 120px; height: auto" />
            </div>
            <h5 class="text-center mt-3 text-white">Change Password</h5>
           
            <form action="" method="POST">
                @csrf
              <div class="mb-3">
                <label for="login" class="form-label text-white">New Password</label>
                <input type="text" name="password" id="password" class="form-control" placeholder="Enter new password">
                @error('password')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
      
              <div class="mb-3">
                <label for="login" class="form-label text-white">Confirm Password</label>
                <input type="text" name="password_confirmation" id="login" class="form-control" placeholder="Enter confirmation password ">
                @error('password')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
      
              <div class="mb-3">
                <button type="submit" class="btn btn-primary w-100">Save</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>


  </div>



</body>
@include('user.layouts.js')
@yield('script')
<script>
  function PwdView() {
    var x = document.getElementById("password");
    var y = document.getElementById("eye");

    if (x.type === "password") {
      x.type = "text";
      y.classList.remove('fa-eye');
      y.classList.add('fa-eye-slash');
    } else {
      x.type = "password";
      y.classList.remove('fa-eye-slash');
      y.classList.add('fa-eye');
    }
  }
</script>