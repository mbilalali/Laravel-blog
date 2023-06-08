@extends('layouts.webApp')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <img src="/{{ $posts->image }}" alt="Image"/>
            </div>
            <div class="col-md-8">
                <h2>{{ $posts->title }}</h2>
                <p>{{ $posts->content }}</p>
            </div>
        </div>
    </div>
    <div class="container">

        <div class="row">
            @auth
            <div class="col-8">
                <form method="post">
                    @csrf
                    <input type="hidden" name="post_id" value="{{ $posts->id }}">
{{--                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">--}}
                <label for="input1">Name</label>
                <input type="email" class="form-control mb-3" name="name" value="{{ Auth::user()->name }}" disabled>

                <label for="input1">Email</label>
                <input type="email" class="form-control mb-3" name="email" value="{{ Auth::user()->email }}" disabled>

                <label for="textarea1">Your Comment</label>
                <textarea class="form-control" id="comment" name="comment" rows="3" placeholder="Write your story here..." required></textarea>
                    <button>Submit</button>
                </form>
            </div>
                @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                @endif
            <h1>Comments</h1>
            @endauth
{{--            @foreach($posts->comments(0)->get() as $comment)--}}


{{--                    <div class="comment mt-4 text-justify float-left">--}}


{{--                           <div class="maincomment" style="background-color: red;">--}}
{{--                               <img src="https://i.imgur.com/yTFUilP.jpg" alt="" class="rounded-circle" width="40" height="40">--}}
{{--                            <h4> {{ $comment->user->email    }} </h4>--}}
{{--                            <span>{{ $comment->date }}</span>--}}
{{--                            <br>--}}
{{--                            <p>{{ $comment->comment }}</p>--}}
{{--                            <a href="/single/remove/{{ $comment->id }}">Remove this comment</a>--}}
{{--                               @foreach($posts->comments($comment->id)->get() as $reply)--}}
{{--                               <div class="response">--}}
{{--                                   {{ $reply->comment }}--}}
{{--                               </div>--}}
{{--                               @endforeach--}}
{{--                           </div>--}}
{{--                            @auth--}}
{{--                                <div class="reply">--}}
{{--                                    <form method="POST">--}}
{{--                                        @csrf--}}
{{--                                        <input type="hidden" name="parent_id" value="{{ $comment->id }}">--}}
{{--                                        <input type="hidden" name="post_id" value="{{ $posts->id }}">--}}
{{--                                        <textarea name="reply" id="reply" required></textarea>--}}
{{--                                        <button>Submit</button>--}}
{{--                                    </form>--}}
{{--                                </div>--}}
{{--                            @endauth--}}

{{--                    </div>--}}
{{--            @endforeach--}}

            @foreach($posts->mainComments as $comment)


                    <div class="comment mt-4 text-justify float-left">


                           <div class="maincomment" style="background-color: red;">
                               <img src="https://i.imgur.com/yTFUilP.jpg" alt="" class="rounded-circle" width="40" height="40">
                            <h4> {{ $comment->user->email    }} </h4>
                            <span>{{ $comment->date }}</span>
                            <br>
                            <p>{{ $comment->comment }}</p>
                            <a href="/single/remove/{{ $comment->id }}">Remove this comment</a>
                               @foreach($comment->reply as $reply)
                               <div class="response">
                                   {{ $reply->comment }}
                               </div>
                               @endforeach
                           </div>
                            @auth
                                <div class="reply">
                                    <form method="POST">
                                        @csrf
                                        <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                                        <input type="hidden" name="post_id" value="{{ $posts->id }}">
                                        <textarea name="reply" id="reply" required></textarea>
                                        <button>Submit</button>
                                    </form>
                                </div>
                            @endauth

                    </div>
            @endforeach



        </div>
    </div>
    @endsection

    </body>
    </html>
