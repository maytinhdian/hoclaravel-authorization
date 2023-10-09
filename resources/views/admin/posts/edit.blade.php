@extends('layouts.admin')

@section('title', 'Sửa bài viết')

@section('content')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Sửa bài viết</h1>

    </div>

    @if ($errors->any())
        <div class="alert alert-danger text-center">Vui lòng kiểm tra dữ liệu nhập</div>
    @endif

    @if (session('msg'))
        <div class="alert alert-success">{{ session('msg') }}</div>
    @endif
    <form action="" method="POST">
        <div class="mb-3">
            <label for="">Tiêu đề</label>
            <input type="text" name="title" id="" class="form-control" placeholder="Tiêu đề..."
                value="{{ old('title') ?? $post->title }}">
            @error('title')
                <span style="color: red">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="">Nội dung</label>
            <textarea name="content" class="form-control" id="" cols="" rows="10" placeholder="Nội dung bài viết" value="">{{ old('content') ?? $post->content }}</textarea>
            @error('content')
                <span style="color: red">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Cập nhật</button>
        @csrf
    </form>

@endsection
