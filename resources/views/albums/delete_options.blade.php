@extends('layouts.app')

@section('content')

<div class="container p-5 col-8 shadow">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
  @endif
<div class="h5">Would you like to move pictures to another album before deleteing this album ? </div>
<form action="{{url('album/change_album')}}" method="post">
    @csrf
    <input type="hidden" name="old_album" value="{{$album_current->id}}">
    <select class="form-control" name="album">
        <option value="">just select an album ..</option>
        @foreach ($album_all as $album)
         <option value="{{$album->id}}">{{$album->name}}</option>
        @endforeach
      </select>
      <input type="submit" value="Move and delete " class="btn btn-primary my-2" >
      <a href="{{url('album/forcedelete/'.$album_current->id)}}" class="btn btn-danger my-2" >Delete anyway</a>
</form>
</div>
@endsection

@extends('layouts.footer')

