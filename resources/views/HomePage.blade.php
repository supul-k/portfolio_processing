@extends('layout')

@section('title', 'Photo Gallery')

@section('content')
    <h2>Welcome to my Home page!</h2>
    <!-- Include your specific content here -->

    <form action="{{ route('photos.upload') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="photos[]" multiple>
        <button type="submit">Upload</button>
    </form>
    
@endsection
