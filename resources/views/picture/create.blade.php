
@extends('layouts.app')
@section('content')

<div class="container rounded shadow col-8 p-5">
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
    <form action="{{ url("picture/store") }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="album" value="{{$album->id}}">
        <div class="form-group">
            <label for="Name">Name</label>
            <input type="text" name="name" class="form-control" placeholder="name">
            @if($errors->has('name'))
            <strong class="text-danger">{{ $errors->first('name') }}</strong>
            @endif
        </div>

        <div class="form-group">
            <div class="mb-3">
                <label>picture file</label>
                <input type="file" name="picture" class="form-control">
                @if($errors->has('picture'))
                <strong class="text-danger">{{ $errors->first('picture') }}</strong>
                @endif
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

@endsection
@extends('layouts.footer')