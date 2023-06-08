@extends('layouts.webApp')

@section('content')
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <h1 class="mb-3">Contact Us</h1>
                <form method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label for="your-name" class="form-label">Blog Title</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>
                        <div class="col-md-12">
                            <label for="your-surname" class="form-label">Blog Image</label>
                            <input type="file" name="image" id="image" required>
                        </div>

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
                        <div class="col-md-12">
                            <label for="your-message" class="form-label">Content</label>
                            <textarea class="form-control" id="blogcontent" name="blogcontent" rows="5" required></textarea>
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <button data-res="" type="submit" class="btn btn-dark w-100 fw-bold" >Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection


