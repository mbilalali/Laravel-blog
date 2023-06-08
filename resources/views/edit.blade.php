@extends('layouts.webApp')

@section('content')
    <div class="container">
        <div class="row">
           <form action="{{route('editpost', $posts->id)}}}" method="POST" enctype="multipart/form-data">
                @csrf
                <label for="email" class="col-md-4 col-form-label text-md-end">Upload Image</label>
                <input type="hidden" name="id" value="{{ $posts->id }}">
                <input type="file" name="blogimage" class="form-control">
               <div class="col-md-12">
                   <label for="your-surname" class="form-label">Select Category</label>
                   <select class="form-control" name="category_id">
                       @foreach($categories as $data)
                           <option value="{{ $data->id }}">{{ $data->name }}</option>
                       @endforeach
                   </select>
               </div>
               <div class="col-md-12">
                   <label for="your-surname" class="form-label">Select Tag</label>
                   <select class="form-control" name="tag_id">
                       @foreach($tags as $tags)
                           <option value="{{ $tags->id }}">
                               {{ $tags->name }}
                           </option>
                       @endforeach
                   </select>
               </div>
                <label for="email" class="col-md-4 col-form-label text-md-end">Blog Title</label>
                <input type="text" name="title" value="{{ $posts->title }}" class="form-control">

                <label for="email" class="col-md-4 col-form-label text-md-end">Blog Content</label>
                <textarea name="content" class="form-control">{{ $posts->content }}</textarea>
                <button type="submit">Submit Now</button>
            </form>
        </div>
    </div>
    @endsection
    </body>
</html>
