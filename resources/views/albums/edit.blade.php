@extends('layouts.app')

@section('content')

  
<div class="container shadow rounded my-5 p-5 col-7">
  @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
  <div class=" pb-4" >
    <span class="h3">Edit Album Name</span>
    <div class=" bg-dark " style="height:3px;width:8%"></div>
  </div>
  <div>
    <form method="POST" action="{{Url('albums/'.$album->id)}}" >
      <div class="form-group row">
        @csrf
        @method('PUT')
        <label for="inputAlbumName3" class="col-sm-3 col-form-label font-weight-bold">Album Name</label>
        <div class="col-sm-9">
          <input type="text" class="form-control  @error('name') is-invalid @enderror"  name="name" value="{{$album->name}}" id="inputAlbumName3" placeholder="Album Name">
          @error('name')
          <div class=" text-danger">{{ $message }}</div>
      @enderror
        </div>
      </div>
    
      <div class="text-right">
        <button type="submit" class="btn btn-dark">Submit</button>
      </div>
    </form>
  </div>
</div>



@endsection