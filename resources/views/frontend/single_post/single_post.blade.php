@extends('layouts.master')

@section('content')
 <!--post-single-->
 <section class="post-single">
    <div class="container-fluid ">
        <div class="row ">
            <div class="col-lg-12">
                <!--post-single-image-->
                    <div class="post-single-image">
                        <img src="{{ asset('uploads/blog')}}/{{ $posts->image }}" alt="post-image">
                    </div>

                    <div class="post-single-body">
                        <!--post-single-title-->
                        <div class="post-single-title">
                            <h2>{{ $posts->title}}</h2>
                            <ul class="entry-meta">
                                <li class="post-author-img"><img src="{{ asset('uploads/profile')}}/{{ $posts->RelationWithUser->image }}" alt=""></li>
                                <li class="post-author"> <a href="author.html">{{ $posts->RelationWithUser->name }}</a></li>
                                <li class="entry-cat"> <a href="{{ route('category.blog', $posts->RelationWithCategory->id)}}" class="category-style-1 "> <span class="line"></span> {{ $posts->RelationWithCategory->title }}</a></li>
                                <li class="post-date"> <span class="line"></span>{{ \Carbon\Carbon::parse($posts->created_at)->format('d, M-Y') }}</li>
                            </ul>

                        </div>

                        <!--post-single-content-->
                        <div class="post-single-content">

                            @php
                                echo $posts->description;
                            @endphp


                        </div>

                        <!--post-single-bottom-->
                        <div class="post-single-bottom">
                            <div class="tags">
                                <p>Tags:</p>
                                <ul class="list-inline">

                                    @foreach ($posts->ManyWithTags as $tag)
                                        <li >
                                            <a href="{{ route('single.tag_post', $tag->id)}}">{{ $tag->name}}</a>
                                        </li>
                                    @endforeach

                                </ul>
                            </div>
                            <div class="social-media">
                                <p>Share on :</p>
                                <ul class="list-inline">
                                    <li>
                                        <a href="#">
                                            <i class="fab fa-facebook"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fab fa-instagram"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fab fa-twitter"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" >
                                            <i class="fab fa-youtube"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" >
                                            <i class="fab fa-pinterest"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <!--post-single-author-->
                        <div class="post-single-author ">
                            <div class="authors-info">
                                <div class="image">
                                    <a href="author.html" class="image">
                                        <img src="assets/img/author/1.jpg" alt="">
                                    </a>
                                </div>
                                <div class="content">
                                    <h4>sarah smith</h4>
                                    <p> Etiam vitae dapibus rhoncus. Eget etiam aenean nisi montes felis pretium donec veni. Pede vidi condimentum et aenean hendrerit.
                                        Quis sem justo nisi varius.
                                    </p>
                                    <div class="social-media">
                                        <ul class="list-inline">
                                            <li>
                                                <a href="#">
                                                    <i class="fab fa-facebook"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <i class="fab fa-instagram"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <i class="fab fa-twitter"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#" >
                                                    <i class="fab fa-youtube"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#" >
                                                    <i class="fab fa-pinterest"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!--post-single-comments-->
                        @auth
                            <div class="post-single-comments">
                                <!--Comments-->
                                <h4 >{{$comments->count()}} Comments</h4>
                                @if (auth()->user()->block_status == "unblocked")
                                <ul class="comments">

                                    @foreach ($comments as $comment)
                                        <!--comment1-->
                                        <li class="comment-item pt-0">
                                            <img src="{{ Avatar::create($comment->name)->toBase64() }}" alt="">
                                            <div class="content">
                                                <div class="meta">
                                                    <ul class="list-inline">
                                                        <li><a href="#">{{ $comment->name }}</a> </li>
                                                        <li class="slash"></li>
                                                        <li>{{ \Carbon\Carbon::parse($comment->created_at)->diffForHumans() }}</li>
                                                    </ul>
                                                </div>
                                                <p>{{ $comment->message }}</p>
                                                <a href="#reply" id="{{ $comment->id }}" onclick="Reply(event);chenge();" class="btn-reply"><i class="las la-reply"></i> Reply</a>
                                            </div>
                                        </li>
                                        @foreach ($comment->reletionwithreply as $reply)
                                            <!--Reply-->
                                            <li class="comment-item pt-0" style="margin-left: 100px;">
                                                <img src="{{ Avatar::create($reply->name)->toBase64() }}" alt="">
                                                <div class="content">
                                                    <div class="meta">
                                                        <ul class="list-inline">
                                                            <li><a href="#">{{ $reply->name }}</a> </li>
                                                            <li class="slash"></li>
                                                            <li>{{ \Carbon\Carbon::parse($reply->created_at)->diffForHumans() }}</li>
                                                        </ul>
                                                    </div>
                                                    <p>{{ $reply->message }}</p>
                                                    <a href="#reply" id="{{ $reply->id }}" onclick="Reply(event);chenge();" class="btn-reply"><i class="las la-reply"></i> Reply</a>
                                                </div>
                                            </li>
                                            @foreach ($reply->reletionwithreply as $t)
                                                <!--Reply-->
                                                <li class="comment-item pt-0" style="margin-left: 200px;">
                                                    <img src="{{ Avatar::create($t->name)->toBase64() }}" alt="">
                                                    <div class="content">
                                                        <div class="meta">
                                                            <ul class="list-inline">
                                                                <li><a href="#">{{ $t->name }}</a> </li>
                                                                <li class="slash"></li>
                                                                <li>{{ \Carbon\Carbon::parse($t->created_at)->diffForHumans() }}</li>
                                                            </ul>
                                                        </div>
                                                        <p>{{ $t->message }}</p>
                                                        <a href="#reply" id="{{ $t->id }}" onclick="Reply(event);chenge();" class="btn-reply"><i class="las la-reply"></i> Reply</a>
                                                    </div>
                                                </li>
                                                @foreach ($t->reletionwithreply as $item)
                                                    <!--Reply-->
                                                    <li class="comment-item pt-0" style="margin-left: 300px;">
                                                        <img src="{{ Avatar::create($item->name)->toBase64() }}" alt="">
                                                        <div class="content">
                                                            <div class="meta">
                                                                <ul class="list-inline">
                                                                    <li><a href="#">{{ $item->name }}</a> </li>
                                                                    <li class="slash"></li>
                                                                    <li>{{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</li>
                                                                </ul>
                                                            </div>
                                                            <p>{{ $item->message }}</p>

                                                        </div>
                                                    </li>
                                                @endforeach
                                            @endforeach
                                        @endforeach
                                    @endforeach

                                </ul>
                                <!--Leave-comments-->
                                <div class="comments-form" id="reply">
                                    <h4 id="change">Leave a Comment</h4>
                                    <!--form-->
                                    <form class="form " action="{{route('comment')}}" method="POST" id="main_contact_form">
                                        @csrf
                                        <p>Your email adress will not be published ,Requied fileds are marked*.</p>
                                        @if (session('comment_success'))
                                            <div class="alert alert-success contact_msg" role="alert">
                                                {{session('comment_success')}}
                                            </div>
                                        @endif
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="Name*" value="{{auth()->user()->name}}">
                                                    @error('name')
                                                    <span class="text-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                                <input type="hidden" name="post_id" class="form-control" value="{{ $posts->id }}">
                                                <input type="hidden" name="parent_id" id="pushid" class="form-control" value="">
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror"  value="{{auth()->user()->email}}" placeholder="Email*">
                                                    @error('email')
                                                    <span class="text-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <textarea name="message" id="message" cols="30" rows="5" class="form-control @error('message') is-invalid @enderror" placeholder="Message*"></textarea>
                                                    @error('message')
                                                    <span class="text-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                {!! NoCaptcha::display() !!}
                                            </div>

                                            <div class="col-lg-12">
                                                {{-- <div class="mb-20">
                                                    <input name="name" type="checkbox" value="1" required="required">
                                                    <label for="name"><span>save my name , email and website in this browser for the next time I comment.</span></label>
                                                </div> --}}

                                                <button type="submit" class="btn-custom">
                                                    Send Comment
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                    <!--/-->
                                </div>
                                @else
                                    <p class="text-danger text-center">comments are off for blocked users!</p>
                                @endif
                            </div>
                        @endauth
                    </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('scripts_content')
<script>

    function chenge() {
        document.getElementById("change").innerHTML = "Leave a Reply";
    }
    let pushid = document.querySelector('#pushid');
    function Reply(event) {
        pushid.value = event.target.getAttribute('id');
    }

</script>

@endsection
