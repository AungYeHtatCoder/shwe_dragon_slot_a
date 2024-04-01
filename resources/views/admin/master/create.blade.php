@extends('admin_layouts.app')
@section('styles')
<style>
  .transparent-btn {
    background: none;
    border: none;
    padding: 0;
    outline: none;
    cursor: pointer;
    box-shadow: none;
    appearance: none;
    /* For some browsers */
  }


  .custom-form-group {
    margin-bottom: 20px;
  }

  .custom-form-group label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
    color: #555;
  }

  .custom-form-group input,
  .custom-form-group select {
    width: 100%;
    padding: 10px 15px;
    border: 1px solid #e1e1e1;
    border-radius: 5px;
    font-size: 16px;
    color: #333;
  }

  .custom-form-group input:focus,
  .custom-form-group select:focus {
    border-color: #d33a9e;
    box-shadow: 0 0 5px rgba(211, 58, 158, 0.5);
  }

  .submit-btn {
    background-color: #d33a9e;
    color: white;
    border: none;
    padding: 12px 20px;
    border-radius: 5px;
    cursor: pointer;
    font-size: 18px;
    font-weight: bold;
  }

  .submit-btn:hover {
    background-color: #b8328b;
  }
  .custom-select-wrapper {
    position: relative;
    display: inline-block;
    width: 100%;
}

.custom-select-wrapper::after {
    content: '\25BC'; /* Unicode character for "downwards black arrow" */
    position: absolute;
    top: 50%;
    right: 15px;
    transform: translateY(-50%);
    pointer-events: none; /* This makes sure clicks pass through to the select element underneath */
}

.form-control.custom-select {
    appearance: none; /* This removes default browser styling */
    -webkit-appearance: none; /* For Safari */
    -moz-appearance: none; /* For Firefox */
    padding-right: 30px; /* Make space for custom arrow */
}

/* Add more styling here for the select and wrapper elements as needed */

</style>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.min.css">
@endsection
@section('content')
<div class="container text-center mt-4">
  <div class="row">
    <div class="col-12 col-md-8 mx-auto">
      <div class="card">
        <!-- Card header -->
          
        <div class="card-header pb-0">
          <div class="d-lg-flex">
            <div>
              <h5 class="mb-0">Create New Master</h5>

            </div>
            <div class="ms-auto my-auto mt-lg-0 mt-4">
              <div class="ms-auto my-auto">
                <a class="btn btn-icon btn-2 btn-primary" href="{{ route('admin.master.index') }}">
                  <span class="btn-inner--icon mt-1"><i class="material-icons">arrow_back</i>Back</span>
                </a>
              </div>
            </div>
          </div>
        </div>
        <div class="card-body">
          <form role="form" method="POST" class="text-start" action="{{ route('admin.master.store') }}">
            @csrf
            <div class="custom-form-group">
              <label for="title">Master ID <span class="text-danger">*</span></label>
              <input type="text"  name="user_name" class="form-control" value="{{$user_name}}" readonly>
              @error('name')
              <span class="text-danger d-block">*{{ $message }}</span>
              @enderror
            </div>
            
            <div class="custom-form-group">
              <label for="title">Master Name <span class="text-danger">*</span></label>
              <input type="text"  name="name" class="form-control" value="{{old('name')}}" placeholder="6-20 characters without spacing">
              @error('player_name')
              <span class="text-danger d-block">*{{ $message }}</span>
              @enderror
            </div>
            <div class="custom-form-group">
              <label for="title">Password <span class="text-danger">*</span></label>
              <input type="text"  name="password" class="form-control" value="{{old('password')}}" placeholder="6-20 characters without spacing">
              @error('password')
              <span class="text-danger d-block">*{{ $message }}</span>
              @enderror
            </div>
            <div class="custom-form-group">
              <label for="title">Phone No</label>
              <input type="text"  name="phone" class="form-control" value="{{old('phone')}}">
              @error('phone')
              <span class="text-danger d-block">*{{ $message }}</span>
              @enderror
            </div>

            <div class="custom-form-group">
              <label>Max Balance : </label>
              <span class="badge badge-sm bg-gradient-success">{{auth()->user()->balanceFloat}}</span>
            </div>
            <div class="custom-form-group">
              <label for="title">Amount</label>
              <input type="text"  name="amount" class="form-control" value="{{old('amount')}}" placeholder="0.00">
              @error('amount')
              <span class="text-danger d-block">*{{ $message }}</span>
              @enderror
            </div>
            {{-- active and inactive with dropdown --}}
            <div class="custom-form-group">
            <label for="title">Status <span class="text-danger">*</span></label>
            <div class="custom-select-wrapper">
                <select name="status" class="form-control custom-select">
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>
            </div>
            @error('status')
            <span class="text-danger d-block">*{{ $message }}</span>
            @enderror
          </div>

           
            <div class="custom-form-group">
              <button class="btn btn-info" type="button" id="resetFormButton">Cancel</button>

              <button type="submit" class="btn btn-primary" type="button">Submit</button>
            </div>
          </form>
        </div>
        {{-- <div class="card-body">
          <form role="form" method="POST" class="text-start" action="{{ route('admin.master.store') }}">
            @csrf
            <div class="custom-form-group">
              <label for="title">Master Name <span class="text-danger">*</span></label>
              <input type="text"  name="user_name" class="form-control" value="{{$agent_name}}" readonly>
              @error('user_name')
              <span class="text-danger d-block">*{{ $message }}</span>
              @enderror
            </div>
            <div class="custom-form-group">
              <label for="title">Name <span class="text-danger">*</span></label>
              <input type="text"  name="name" class="form-control" value="{{old('name')}}">
              @error('name')
              <span class="text-danger d-block">*{{ $message }}</span>
              @enderror
            </div>
            <div class="custom-form-group">
              <label for="title">Phone No <span class="text-danger">*</span></label>
              <input type="text"  name="phone" class="form-control" value="{{old('phone')}}">
              @error('phone')
              <span class="text-danger d-block">*{{ $message }}</span>
              @enderror
            </div>
            <div class="custom-form-group">
              <label for="title">Password <span class="text-danger">*</span></label>
              <input type="text"  name="password" class="form-control" value="{{old('password')}}">
              @error('password')
              <span class="text-danger d-block">*{{ $message }}</span>
              @enderror
            </div>
            <div class="custom-form-group">
              <button type="submit" class="btn btn-primary" type="button">Create</button>
            </div>
          </form>
        </div> --}}
      </div>
    </div>
  </div>
</div>
@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.all.min.js"></script>

<script src="{{ asset('admin_app/assets/js/plugins/choices.min.js') }}"></script>
<script src="{{ asset('admin_app/assets/js/plugins/quill.min.js') }}"></script>

<script>
  var errorMessage = @json(session('error'));
  var successMessage = @json(session('success'));
  var url = 'https://maxwinapi.online/login';
  var name = @json(session('username'));
  var pw = @json(session('password'));

  @if(session() -> has('success'))
  Swal.fire({
    title: successMessage,
    icon: "success",
    showConfirmButton: false,
    showCloseButton: true,
    html: `
  <table class="table table-bordered" style="background:#eee;">
  <tbody>
  <tr>
    <td>username</td>
    <td id="tusername"> ${name}</td>
  </tr>
  <tr>
    <td>pw</td>
    <td id="tpassword"> ${pw}</td>
  </tr>
  <tr>
    <td>url</td>
    <td id=""> ${url}</td>
  </tr>
  <tr>
    <td></td>
    <td><a href="#" onclick="copy()" class="btn btn-sm btn-primary">copy</a></td>
  </tr>
 </tbody>
  </table>
  `
  });
  @elseif(session()->has('error'))
  Swal.fire({
    icon: 'error',
    title: errorMessage,
    showConfirmButton: false,
    timer: 1500
  })
  @endif
  function copy() {
       var username= $('#tusername').text();
        var password= $('#tpassword').text();
        var copy = "url : "+url+"\nusername : "+username+"\npw : "+password;
        copyToClipboard(copy)
  }
  function copyToClipboard(v) {
            var $temp = $("<textarea>");
            $("body").append($temp);
            var html = v;
            $temp.val(html).select();
            document.execCommand("copy");
            $temp.remove();
        }

  </script>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('resetFormButton').addEventListener('click', function () {
            var form = this.closest('form');
            form.querySelectorAll('input[type="text"]').forEach(input => {
                // Resets input fields to their default values
                input.value = '';
            });
            form.querySelectorAll('select').forEach(select => {
                // Resets select fields to their default selected option
                select.selectedIndex = 0;
            });
            // Add any additional field resets here if necessary
        });
    });
</script>

@endsection