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
              <h5 class="mb-0">Edit Master</h5>

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
          <form role="form" method="POST" class="text-start" action="{{ route('admin.master.update',$master->id) }}">
            @csrf
            @method('PUT')
            <div class="custom-form-group">
              <label for="title">Master Name <span class="text-danger">*</span></label>
              <input type="text"  name="name" class="form-control" value="{{$master->user_name}}" readonly>
              @error('name')
              <span class="text-danger d-block">*{{ $message }}</span>
              @enderror
            </div>
            <div class="custom-form-group">
              <label for="title">Name <span class="text-danger">*</span></label>
              <input type="text"  name="player_name" class="form-control" value="{{$master->name}}">
              @error('player_name')
              <span class="text-danger d-block">*{{ $message }}</span>
              @enderror
            </div>
            <div class="custom-form-group">
              <label for="title">Phone No <span class="text-danger">*</span></label>
              <input type="text"  name="phone" class="form-control" value="{{$master->phone}}">
              @error('phone')
              <span class="text-danger d-block">*{{ $message }}</span>
              @enderror
            </div>
            <div class="custom-form-group">
              <button type="submit" class="btn btn-primary" type="button">Update</button>
            </div>
          </form>
        </div>
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
  @if(session() -> has('success'))
  Swal.fire({
    title: successMessage,
    icon: "success",
    showConfirmButton: false,
    showCloseButton: true,
    
  });
  @elseif(session()->has('error'))
  Swal.fire({
    icon: 'error',
    title: errorMessage,
    showConfirmButton: false,
    timer: 1500
  })
  @endif
</script>
@endsection