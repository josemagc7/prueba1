@extends('layouts.panel')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card shadow">


            <div class="card-body "> <!-- Aquí se reduce la altura del card -->
                <div id="slideshow" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img class="d-block w-100 img-fluid" src="{{ secure_asset('img/theme/img1.jpg') }}" alt="Primera imagen">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100 img-fluid" src="{{ secure_asset('img\theme\img2.jpg') }}" alt="Segunda imagen">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100 img-fluid" src="{{ secure_asset('img\theme\img3.jpg') }}" alt="Tercera imagen">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100 img-fluid" src="{{ secure_asset('img\theme\img4.jpg') }}" alt="Cuarta imagen">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100 img-fluid" src="{{ secure_asset('img\theme\img5.jpg') }}" alt="Quinta imagen">
                        </div>
                        <div class="carousel-item ">
                            <img class="d-block w-100 img-fluid" src="{{ secure_asset('img/theme/img6.jpg') }}" alt="Sexta imagen">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100 img-fluid" src="{{ secure_asset('img\theme\img7.jpg') }}" alt="Septima imagen">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100 img-fluid" src="{{ secure_asset('img\theme\img8.jpg') }}" alt="Octava imagen">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100 img-fluid" src="{{ secure_asset('img\theme\img9.jpg') }}" alt="Novena imagen">
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        $('#slideshow').carousel({
            interval: 500
        });
    });
</script>
@endpush
