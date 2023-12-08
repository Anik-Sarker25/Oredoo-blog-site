@extends('layouts.master')

@section('content')

<!-- blog-slider-->
<section class="blog blog-home4 d-flex align-items-center justify-content-center">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="owl-carousel">
                    <!--post1-->
                    @foreach ($posts as $post)

                    <div class="blog-item" style="background-image: url('{{ asset('uploads/blog')}}/{{ $post->image }}')">
                        <div class="blog-banner">
                            <div class="post-overly">
                                <div class="post-overly-content">
                                    <div class="entry-cat">
                                        <a href="blog-layout-1.html" class="category-style-2">{{ $post->RelationWithCategory->title }}</a>
                                    </div>
                                    <h2 class="entry-title">
                                        <a href="{{ route('single.blog', $post->id)}}">{{ $post->title }}</a>
                                    </h2>
                                    <ul class="entry-meta">
                                        <li class="post-author"> <a href="author.html">{{ $post->RelationWithUser->name }}</a></li>
                                        <li class="post-date"> <span class="line"></span>{{ \Carbon\Carbon::parse($post->date)->format('d, M-Y') }}</li>
                                        <li class="post-timeread"> <span class="line"></span>{{ \Carbon\Carbon::parse($post->created_at)->diffForHumans() }}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    @endforeach

                    <!--/-->
                </div>
            </div>
        </div>
    </div>
</section>

<!-- top categories-->
<div class="categories">
    <div class="container-fluid">
        <div class="categories-area">
            <div class="row">
                <div class="col-lg-12 ">
                    <div class="categories-items">
                        @foreach ($categories as $category)

                        <a class="category-item" href="{{ route('category.blog', $category->id)}}">
                            <div class="image">
                                <img src="{{ asset('uploads/category')}}/{{ $category->image }}" alt="image">
                            </div>
                            <p>{{ $category->title }}<span>{{ $category->RelationWithBlog()->count() }}</span> </p>
                        </a>

                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent articles-->
<section class="section-feature-1">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8 oredoo-content">
                <div class="theiaStickySidebar">
                    <div class="section-title">
                        <h3>recent Articles </h3>
                        <p>Discover the most outstanding articles in all topics of life.</p>
                    </div>

                    @foreach ($recent_posts as $post)
                        <!--post1-->
                        <div class="post-list post-list-style4">
                            <div class="post-list-image">
                                <a href="{{ route('single.blog', $post->id)}}">
                                    <img src="{{ asset('uploads/blog')}}/{{ $post->image }}" alt="post-image">
                                </a>
                            </div>
                            <div class="post-list-content">
                                <ul class="entry-meta">
                                    <li class="entry-cat">
                                        <a href="{{ route('category.blog', $post->RelationWithCategory->id)}}" class="category-style-1">{{ $post->RelationWithCategory->title }}</a>
                                    </li>
                                    <li class="post-date"> <span class="line"></span>{{ \Carbon\Carbon::parse($post->created_at)->diffForHumans() }}</li>
                                </ul>
                                <h5 class="entry-title">
                                    <a href="{{ route('single.blog', $post->id)}}">
                                        @php
                                            $blog_title = strip_tags($post->title);
                                            if(strlen($blog_title > 200)):
                                                $blog_cut = substr($blog_title,0,60);
                                                $endpoint = strrpos($blog_cut, " ");
                                                $blog_title = $endpoint?substr($blog_cut,0,$endpoint):substr($blog_cut,0);
                                                $blog_title .=".....";
                                            endif;
                                            echo $blog_title;
                                        @endphp
                                    </a>
                                </h5>

                                <div class="post-btn">
                                    <a href="{{ route('single.blog', $post->id)}}" class="btn-read-more">Continue Reading <i
                                        class="las la-long-arrow-alt-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach


                    <!--pagination-->
                    <div class="pagination">
                        <div class="pagination-area">
                            <div class="pagination-list">
                                <ul class="list-inline">
                                    <li><a href="#"><i class="las la-arrow-left"></i></a></li>
                                    <li><a href="#" class="active">1</a></li>
                                    <li><a href="#">2</a></li>
                                    <li><a href="#">3</a></li>
                                    <li><a href="#">4</a></li>
                                    <li><a href="#"><i class="las la-arrow-right"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--Sidebar-->
            <div class="col-lg-4 oredoo-sidebar">
                <div class="theiaStickySidebar">
                    <div class="sidebar">
                        <!--search-->
                        <div class="widget">
                            <div class="widget-title">
                                <h5>Search</h5>
                            </div>
                            <div class=" widget-search">
                                <form action="https://oredoo.assiagroupe.net/Oredoo/search.html">
                                    <input type="search" id="gsearch" name="gsearch" placeholder="Search ....">
                                    <a href="search.html" class="btn-submit"><i class="las la-search"></i></a>
                                </form>
                            </div>
                        </div>

                        <!--popular-posts-->
                        <div class="widget">
                            <div class="widget-title">
                                <h5>popular Posts</h5>
                            </div>

                            <ul class="widget-popular-posts">

                                @foreach ($popular_posts as $post)
                                    <!--post1-->
                                    <li class="small-post">
                                        <div class="small-post-image">
                                            <a href="{{ route('single.blog', $post->id)}}">
                                                <img src="{{ asset('uploads/blog')}}/{{ $post->image }}" alt="post-image">
                                                <small class="nb">{{ $loop->index +1 }}</small>
                                            </a>
                                        </div>
                                        <div class="small-post-content">
                                            <p>
                                                <a href="{{ route('single.blog', $post->id)}}">
                                                    {{-- {{ $post->title }} --}}
                                                    @php
                                                        $blog_title = strip_tags($post->title);
                                                        if(strlen($blog_title > 200)):
                                                            $blog_cut = substr($blog_title,0,60);
                                                            $endpoint = strrpos($blog_cut, " ");
                                                            $blog_title = $endpoint?substr($blog_cut,0,$endpoint):substr($blog_cut,0);
                                                            $blog_title .=".....";
                                                        endif;
                                                        echo $blog_title;
                                                    @endphp
                                                </a>
                                            </p>
                                            <small> <span class="slash"></span>{{ \Carbon\Carbon::parse($post->created_at)->diffForHumans() }}</small>
                                        </div>
                                    </li>
                                @endforeach

                                {{ $popular_posts->links()}}

                            </ul>
                        </div>

                        <!--newslatter-->
                        <div class="widget widget-newsletter">
                            <h5>Subscribe To Our Newsletter</h5>
                            <p>No spam, notifications only about new products, updates.</p>
                            <form action="#" class="newslettre-form">
                                <div class="form-flex">
                                    <div class="form-group">
                                        <input type="email" class="form-control" placeholder="Your Email Adress"
                                            required="required">
                                    </div>
                                    <button class="btn-custom" type="submit">Subscribe now</button>
                                </div>
                            </form>
                        </div>

                        <!--stay connected-->
                        <div class="widget ">
                            <div class="widget-title">
                                <h5>Stay connected</h5>
                            </div>

                            <div class="widget-stay-connected">
                                <div class="list">
                                    <div class="item color-facebook">
                                        <a href="#"><i class="fab fa-facebook"></i></a>
                                        <p>Facebook</p>
                                    </div>

                                    <div class="item color-instagram">
                                        <a href="#"><i class="fab fa-instagram"></i></a>
                                        <p>instagram</p>
                                    </div>

                                    <div class="item color-twitter">
                                        <a href="#"><i class="fab fa-twitter"></i></a>
                                        <p>twitter</p>
                                    </div>

                                    <div class="item color-youtube">
                                        <a href="#"><i class="fab fa-youtube"></i></a>
                                        <p>Youtube</p>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!--Tags-->
                        <div class="widget">
                            <div class="widget-title">
                                <h5>Tags</h5>
                            </div>
                            <div class="widget-tags">
                                <ul class="list-inline">
                                    <li>
                                        <a href="#">Travel</a>
                                    </li>
                                    <li>
                                        <a href="#">Nature</a>
                                    </li>
                                    <li>
                                        <a href="#">tips</a>
                                    </li>
                                    <li>
                                        <a href="#">forest</a>
                                    </li>
                                    <li>
                                        <a href="#">beach</a>
                                    </li>
                                    <li>
                                        <a href="#">fashion</a>
                                    </li>
                                    <li>
                                        <a href="#">livestyle</a>
                                    </li>
                                    <li>
                                        <a href="#">healty</a>
                                    </li>
                                    <li>
                                        <a href="#">food</a>
                                    </li>
                                    <li>
                                        <a href="#">interior</a>
                                    </li>
                                    <li>
                                        <a href="#">branding</a>
                                    </li>
                                    <li>
                                        <a href="#">web</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/-->
        </div>
    </div>
</section>

@endsection



