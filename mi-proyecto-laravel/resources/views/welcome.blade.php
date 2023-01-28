<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="Juan Cruz Cordoneda" content="" />
    <title> DEVLIGHTS - Juan Cruz Cordoneda </title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="{{URL::asset('favicon.ico')}}" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link rel="stylesheet" href="{{URL::asset('css/styles.css')}}" />
    <link rel="stylesheet" href="{{URL::asset('css/search.css')}}" />
    @yield('css')

</head>

<body>
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container px-4 px-lg-5" style="margin: 5px auto 20; ">
            <a class="navbar-brand" href="/"> DEVLIGHTS - Juan Cruz Cordoneda </a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="/">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="">Browse</a></li>
                </ul>
                <form class="d-flex">
                    <button class="btn btn-outline-light">
                        <i class="bi-cart-fill me-1"></i>
                        Cart
                        <span class="badge bg-dark text-white ms-1 rounded-pill">0</span>
                    </button>
                </form>
            </div>
    </nav>
    <!-- Header-->
    <div class="bg-dark text-center ">
        <div class="text-center text-white bg-dark">
            <img src="{{URL::asset('re-2.jpg')}}">
        </div>
    </div>
    <section class="webdesigntuts-workshop bg-dark">
        <form action="" method="GET">
            <input type="search" name="q" placeholder="Buscar...">
            <button>Buscar</button>
        </form>
    </section>
    <!-- Section-->
    <section class="py-5 bg-dark">

        <div class="container px-4 px-lg-5 mt-5">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                @foreach($games as $game)
                <tr>
                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Sale badge-->
                            <div class="badge bg-dark text-red position-absolute" style="top: 0.5rem; right: 0.5rem; font-size: 1.2em; color:#dc3545">{{ $game->savings }}%</div>
                            <!-- Product image-->
                            <img class="card-img-top" src="{{ $game->thumb }}" alt="..." />
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder">{{ $game->title }}</h5>
                                    <!-- Product reviews-->
                                    <div class="d-flex justify-content-center small text-warning mb-2">
                                        @if( $game->steamRatingPercent >9 && $game->steamRatingPercent <19)
                                        <div class="bi-star-half"></div>
                                        @elseif( $game->steamRatingPercent >19)
                                        <div class="bi-star-fill"></div>
                                        @else
                                        <div class="bi-star"></div>
                                        @endif

                                        @if( $game->steamRatingPercent >29 && $game->steamRatingPercent <39)
                                        <div class="bi-star-half"></div>
                                        @elseif( $game->steamRatingPercent >39)
                                        <div class="bi-star-fill"></div>
                                        @else
                                        <div class="bi-star"></div> 
                                        @endif

                                        @if( $game->steamRatingPercent >49 && $game->steamRatingPercent <59)
                                        <div class="bi-star-half"></div>
                                        @elseif( $game->steamRatingPercent >59)
                                        <div class="bi-star-fill"></div>
                                        @else
                                        <div class="bi-star"></div> 
                                        @endif

                                        @if( $game->steamRatingPercent >69 && $game->steamRatingPercent <79)
                                        <div class="bi-star-half"></div>
                                        @elseif( $game->steamRatingPercent >79)
                                        <div class="bi-star-fill"></div>
                                        @else
                                        <div class="bi-star"></div> 
                                        @endif

                                        @if( $game->steamRatingPercent >89 && $game->steamRatingPercent <99)
                                        <div class="bi-star-half"></div>
                                        @elseif( $game->steamRatingPercent > 99)
                                        <div class="bi-star-fill"></div>
                                        @else
                                        <div class="bi-star"></div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#"> <span class="text-muted text-decoration-line-through">{{ $game->normalPrice }}$</span>
                                        <b>{{ $game->salePrice }}$</b> </a></div>
                            </div>
                        </div>
                    </div>
                    @endforeach

            </div>
        </div>
    </section>
    <!-- Footer-->
    <footer class="py-5 bg-dark">
        <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy; Your Website 2022</p>
        </div>
    </footer>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="{{URL::asset('js/scripts.js')}}"></script>
</body>

</html>