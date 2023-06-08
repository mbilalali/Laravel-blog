@extends('layouts.webApp')

@section('content')
<div class="container">
    <div class="row">
    @foreach($posts as $data)

            <div class="col-sm-4 col-md-4">
                <div class="thumbnail">
                    <div class="thumbimg">
                        <img src="/{{$data->image}}" alt="Image"/>
                    </div>
                    <div class="caption">
                        <h3>{{ $data->title }}</h3>

                        <h5>Category: <a href="{{ route('categoryTagPost', ['type'=>'category', 'slug'=> ($data->category)? $data->category->slug:'un-categories' ]) }}">{{ ($data->category)? $data->category->name:'Un-categories' }}</a></h5>
                        <h5>Tag: <a href="{{ route('categoryTagPost', ['type'=>'tag', 'slug'=>($data->tag)? $data->tag->slug:'untagged'] ) }}">{{ ($data->tag)? $data->tag->name:'Untagged' }}</a></h5>
                        <p>
                            {{ Str::limit($data->content, 100) }}
                        </p>
                        <p><a href="single/{{ $data->id }}" class="btn btn-primary" role="button">Read More ({{ count($data->comments) }})</a></p>

                        {{--                        Auth::id()--}}
                        @if(Auth::id() == $data->user_id )
                        <p><a href="edit/{{ $data->id }}" class="btn btn-primary" role="button">Edit Now</a></p>
                        @endif
                    </div>
                </div>
            </div>
    @endforeach

    </div>
</div>
@endsection

</body>
</html>
