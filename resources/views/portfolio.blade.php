@extends('layout')

@section('title', 'Photo Gallery')

@extends('Navbar')

@section('content')

<div style="display: flex; justify-content: space-between;">

    <div style="display: flex; flex-direction: column; flex-wrap: wrap; justify-content: flex-start;">
        @foreach ($photos->chunk(ceil($photos->count() / 2)) as $chunk)
            @foreach ($chunk as $photo)
                @php
                    $trimmedPath = Str::replaceFirst('public/photos/', '', $photo->path);
                @endphp

                <div class="card" style="width: 18rem; height: 200px;">
                    <img src="{{ asset('storage/photos/' . $trimmedPath) }}" alt="logo">
                </div>

                @if ($loop->iteration % 5 == 0)
                    <div style="flex-basis: 100%;"></div>
                @endif
            @endforeach
        @endforeach
    </div>

    <div>
        <form action="{{ route('photos.process') }}" id="processForm" method="POST">
            @csrf
            <label id="upload" for="upload" class="btn btn-dark" style="width: 100%; height: 10%;">
                <p class="fs-3 fw-bold" style="display: flex; align-items: center; justify-content: center;">
                    Process Images
                </p>
                <input type="hidden" id="album_id" name="album_id" value="{{ $photos[0]->album_id }}">
            </label>
        </form>
    </div>

</div>


@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#upload').on('click', function() {
            console.log('uploading');
            $('#processForm').submit();
        });
    });
</script>
