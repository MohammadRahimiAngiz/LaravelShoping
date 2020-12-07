@extends('home.layouts.masterHome')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Article</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Home</a></div>
                <div class="breadcrumb-item"><a href="#">Products</a></div>
                <div class="breadcrumb-item">Product</div>
            </div>
        </div>

ul#nav>li.item$*4>a{item $}>strong{item $}
        <div class="section-body">
            <h2 class="section-title">All Products</h2>
            <div class="row">
                @foreach ($products as $product)
                    <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                        <article class="article article-style-b">
                            <div class="article-header">
                                <div class="article-image" data-background="assets/img/news/img02.jpg" style="background-image: url(&quot;assets/img/news/img02.jpg&quot;);">
                                </div>
                                <div class="article-badge">
                                    <div class="article-badge-item bg-danger"><i class="fas fa-fire"></i> Trending</div>
                                </div>
                            </div>
                            <div class="article-details">
                                <div class="article-title">
                                    <h2><a href="{{url("product/$product->slug_title")}}">{{$product->title}}</a></h2>
                                </div>
                                <p>{{$product->description}} </p>
                                <div class="article-cta">
                                    <small class="text-muted float-left">Price: <strong>{{$product->price}} $</strong></small>
                                    <a href="{{url("product/$product->slug_title")}}">Read More <i class="fas fa-chevron-right"></i></a>
                                </div>
                            </div>
                        </article>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
