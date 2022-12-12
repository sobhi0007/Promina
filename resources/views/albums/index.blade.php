@extends('layouts.app')

@section('content')

<div class="container shadow rounded pb-5 pt-5">
  @if (session('success'))
  <div class="alert alert-success">
    {{ session('success') }}
  </div>
@endif

@if (session('error'))
<div class="alert alert-danger">
{{ session('error') }}
</div>
@endif

@if (session('status'))
<div class="alert alert-success">
  {{ session('status') }}
</div>
@endif
  @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
  @endif
   <div class="row my-4 col-12">
        <div class="col-6">
            <span class="h3">Albums</span>
            <div class=" bg-dark " style="height:3px;width:8%"></div>
        </div>
    
    <div class="col-6 text-right">
      
            <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#exampleModal">
                <i class="fa fa-plus"></i> Add Album
            </button>
  
   </div> 
</div>
{{ $dataTable->table() }}
{{ $dataTable->scripts() }}
@endsection

@extends('layouts.footer')

@extends('layouts.modal')

@section('header')
   Create an album
@endsection


@section('body')
<form method="POST" action="/albums">
  <div class="form-group row">
    @csrf
    <label for="inputAlbumName3" class="col-sm-3 col-form-label">Album Name</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" name="name" id="inputAlbumName3" placeholder="Album Name">
    </div>
  </div>

  <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-dark">Submit</button>
  </div>
</form>
@endsection