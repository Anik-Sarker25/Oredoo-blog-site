@extends('layouts.dashboard')


@section('content')
<div class="row">
    <div class="col">
        <div class="page-description">
            <h1>Post Insert</h1>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h2>Insert Post</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('blog.insert') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="exampletitle" class="form-label">Enter Title</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" name="title" id="exampletitle">
                        @error('title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="examplecategory" class="form-label">Select Category</label>
                        <select class="form-select @error('category_id') is-invalid @enderror" name="category_id" id="examplecategory">
                            <option selected>Default</option>
                            @foreach ($categorie as $category)
                                <option value="{{ $category->id }}">{{ $category->title }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="exampleCheck11">Select Tags</label>


                        @foreach ($tags as $tag)
                        <br>
                        <input type="checkbox" class="form-check-input" name="tag_id[]" value="{{ $tag->id }}" id="exampleCheck1{{ $tag->id }}">
                        <label class="form-check-label" for="exampleCheck1{{ $tag->id }}">{{ $tag->name }}</label>

                        @endforeach



                    </div>
                    <div class="mb-3">
                        <label for="exampledate" class="form-label">Enter Date</label>
                        <input type="date" value="{{ old('date') }}" class="form-control @error('date') is-invalid @enderror" name="date" id="exampledate">
                        @error('date')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="exampleimage" class="form-label">Choose Image</label>
                        <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" id="exampleimage">
                        @error('image')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exampledescription" class="form-label">Enter Description</label>
                        <textarea name="description" class="form-control @error('description') is-invalid @enderror" name="description" id="summernote" cols="30" rows="5">
                        </textarea>
                        @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <button class="btn btn-success mt-4" type="submit">Create Post</button>

                </form>
            </div>
        </div>
    </div>
</div>


@endsection


@section('scripts_content')
<script>
$(document).ready(function() {
  $('#summernote').summernote();
});
</script>


@endsection
