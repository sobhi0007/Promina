@extends('layouts.app')

@section('content')
        <div class="container mt-5">
            <div class="row">
                @if ($message = Session::get('success'))
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                    {{ $message }}
                </div>
                @endif
                <div class="col-md-12">
                    <table class="table">
                        <thead>
                            <tr>
                        
                                <th>Name</th>
                                <th>picture</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pictures->pictures as $picture)
                            <tr>
                             
                                <td>{{ $picture->name }}</td>
                                <td><img src="{{ $picture->getFirstMediaUrl('pictures') }}" alt="no picture" width="100" height="100"></td>
                                <td>
                                    <a class="btn btn-xs btn-primary" href="{{ url('picture/edit',$picture->id) }}">
                                        Edit
                                    </a>
                                </td>
                                <td>
                                    <form action="{{ url('picture/destroy',$picture->id) }}" method="POST" onsubmit="return confirm('{{ trans('are You Sure ? ') }}');"
                                        style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="Delete">
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @endsection
        @extends('layouts.footer')       