@extends('layouts.app');

@section('content')
    <h2> From user id={{ auth()->user()->id }} </h2>
    @foreach ($userData as $udata)
    <ul>
        <li> <strong>{{ $udata->title }}</strong> = {{ $udata->description }}</li>
    </ul>
    @endforeach
@endsection