@extends('layout')

@section('title', 'Photo Gallery')

@extends('Navbar')

@section('content')

    {{-- <hr class="bg-gradient mt-0 mb-0"
        style="background-image: linear-gradient(to right, rgb(255, 0, 0), rgb(0, 255, 0)); height: 20px;"> --}}

    <section class="vh-100">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6 text-black"
                    style="display: grid;
                justify-items: center;
                align-items: center;">

                    <div style="width: 50%;">

                        <p class="fs-1 fw-normal">Cull photos fast with</p>
                        <p class="fs-1 fw-bold">Narrative Select</p>
                        <p class="card-text">Game-changing image culling – powered by smart tech and designed from the
                            ground
                            up for professional photographers.</p>
                        <a href="#" class="btn btn-dark" style="width: 100%; height: 10%;">
                            <p class="fs-3 fw-bold"
                                style="display: block;    
                                align-items: center;
                                justify-items: center;">
                                Discover select
                            </p>
                        </a>

                    </div>

                </div>
                <div class="col-sm-6 px-0 d-none d-sm-block">
                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/img3.webp"
                        alt="Login image" class="w-100 vh-100" style="object-fit: cover; object-position: left;">
                </div>
            </div>
        </div>
    </section>

    <form action="{{ route('photos.upload') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="photos[]" multiple>
        <button type="submit">Upload</button>
    </form>

@endsection
