
@extends('layouts.app')
@section('content')
<div class="container rounded shadow p-5">
    <div class="row">
        <div class="col-6">
            <h4>{{$album->name}} Album</h4>
            <div class=" bg-dark " style="height:3px;width:8%"></div>
        </div>
        <div class="col-6 text-right">
            <a  class="btn btn-dark"  href="{{url('picture/upload/'.$album->id)}}">
                <i class="fa fa-plus"></i> Upload Picture
            </a>
        </div>
    </div> 
    <div class="row mt-5">
        @forelse ($pictures as $picture)
            <div class="col-6 text-center">
                <img src="{{ $picture->getFirstMediaUrl('pictures') }}" alt="{{$picture->name}}" class="col-6">
                <div class="font-weight-bold" >{{$picture->name}}</div>
            </div>
        @empty
            <div class="col-12 text-center font-weight-bold">
                {{'Album is empty'}}
            </div>
        @endforelse
    </div>
</div>
@endsection
