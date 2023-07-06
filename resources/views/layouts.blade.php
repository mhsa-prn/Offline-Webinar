<!doctype html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.104.2">
    <title>وبینار دات آی آر</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/pricing/">





    <link href="/css/bootstrap.rtl.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/Vazirmatn-font-face.css">
    <link rel="stylesheet" href="/css/style.css">

    <!-- Favicons -->



    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        .b-example-divider {
            height: 3rem;
            background-color: rgba(0, 0, 0, .1);
            border: solid rgba(0, 0, 0, .15);
            border-width: 1px 0;
            box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
        }

        .b-example-vr {
            flex-shrink: 0;
            width: 1.5rem;
            height: 100vh;
        }

        .bi {
            vertical-align: -.125em;
            fill: currentColor;
        }

        .nav-scroller {
            position: relative;
            z-index: 2;
            height: 2.75rem;
            overflow-y: hidden;
        }

        .nav-scroller .nav {
            display: flex;
            flex-wrap: nowrap;
            padding-bottom: 1rem;
            margin-top: -1px;
            overflow-x: auto;
            text-align: center;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
        }
    </style>


    <!-- Custom styles for this template -->
    <link href="/css/pricing.css" rel="stylesheet">
</head>
<body>

<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
    <symbol id="check" viewBox="0 0 16 16">
        <title>Check</title>
        <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
    </symbol>
</svg>

<div class="container py-3">
    <header>
        <nav class="navbar navbar-expand-lg bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="/">وبینار دات آی آر</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="/">خانه</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="/home">پروفایل</a>
                        </li>


                        @foreach(\App\Models\Category::where('parent_id',null)->get() as $category)
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="{{ route('categories.show',$category->id) }}" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ $category->name }}
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ route('categories.show',$category->id) }}">{{ $category->name }}</a></li>
                                    @foreach($category->child as $child)
                                        <li><a class="dropdown-item" href="{{ route('categories.show',$child->id) }}">{{ $child->name }}</a></li>
                                    @endforeach
                                </ul>
                            </li>

                        @endforeach
                    </ul>
                    <form class="d-flex" role="search" action="/">
                        <input class="form-control me-2" type="search" placeholder="نام وبینار" aria-label="Search"
                               name="search">
                        <button class="btn btn-outline-success" type="submit">جستجو</button>
                    </form>
                </div>
            </div>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>


</div>


<script src="/js/bootstrap.bundle.min.js"></script>
</body>
</html>
