@extends('layouts.app')
@section('content')


<p> Edit Page </p>
    
<form action="/update/{{ $projectData->id }}/" method="POST">
        {{ method_field('PATCH') }}
        {{ csrf_field() }}

        <div class="form-group">
            <label class = "label" for="title"> Title</label>
            
                <input type="text" class="form-control" name="title" value="{{ $projectData->title }}" placeholder="Title"/>
            </div>

       

        <div class="form-group">
                <label class = "label" for="description"> Description</label>
                
                    <textarea name="description" class="form-control" > {{ $projectData->description }}</textarea>
    
        </div>
        <button type="submit" class="btn btn-primary">Submit</button> &nbsp; 
    </form>

    <form action="/destroy/{{ $projectData->user_id }}" method="POST" role="form">
        @method('DELETE')
        @csrf
        
        <button type="submit" class="btn btn-default" > Delete</button>


@endsection