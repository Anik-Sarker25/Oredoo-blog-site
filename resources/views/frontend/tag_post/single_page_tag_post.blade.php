@extends('layouts.master')


@section('content')

<!--section-heading-->
<div class="section-heading " >
    <div class="container-fluid">
         <div class="section-heading-2">
             <div class="row">
                 <div class="col-lg-12">
                     <div class="section-heading-2-title">
                         <h1>{{ $tags_name->name }}</h1>
                         <p class="links"><a href="{{ route('root') }}">Home <i class="las la-angle-right"></i></a> Blog</p>
                     </div>
                 </div>
             </div>
         </div>
     </div>
</div>


<!-- Blog Layout-2-->
<section class="blog-layout-2">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">

                @forelse ($posts as $post)
                    <!--post 1-->
                    <div class="post-list post-list-style2">
                        <div class="post-list-image">
                            <a href="{{ route('single.blog', $post->id)}}">
                                <img src="{{ asset('uploads/blog')}}/{{ $post->image }}" alt="post-image">
                            </a>
                        </div>
                        <div class="post-list-content">
                            <h3 class="entry-title">
                                <a href="{{ route('single.blog', $post->id)}}">{{ $post->title }}</a>
                            </h3>
                            <ul class="entry-meta">
                                <li class="post-author-img"><img src="{{ asset('uploads/profile')}}/{{ $post->RelationWithUser->image }}" alt="author-image"></li>
                                <li class="post-author"> <a href="author.html">{{ $post->RelationWithUser->name }}</a></li>
                                <li class="entry-cat"> <a href="{{ route('category.blog', $post->RelationWithCategory->id)}}" class="category-style-1 "> <span class="line"></span>{{ $post->RelationWithCategory->title }}</a></li>
                                <li class="post-date"> <span class="line"></span>{{ \Carbon\Carbon::parse($post->created_at)->format('d, M-Y') }}</li>
                            </ul>
                            <div class="post-exerpt">
                                <p>
                                    <?php
                                    $blog_des = strip_tags($post->description);
                                    if(strlen($blog_des > 200)):
                                        $blog_cut = substr($blog_des,0,200);
                                        $endpoint = strrpos($blog_cut, " ");
                                        $blog_des = $endpoint?substr($blog_cut,0,$endpoint):substr($blog_cut,0);
                                        $blog_des .=".....";
                                    endif;
                                    echo $blog_des;
                                    ?>
                                </p>
                            </div>
                            <div class="post-btn">
                                <a href="{{ route('single.blog', $post->id)}}" class="btn-read-more">Continue Reading <i class="las la-long-arrow-alt-right"></i></a>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-danger text-center m-5">BLOG POST IS EMPTY!</p>
                @endforelse

            </div>
        </div>
        <div class="paginate-sec mt-3" >
            {{ $posts->links() }}
        </div>
     </div>
</section>





@endsection
