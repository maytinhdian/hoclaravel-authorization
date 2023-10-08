@extends('layouts.admin')

@section('title', 'Thêm nhóm')

@section('content')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Thêm nhóm</h1>

    </div>
    @if ($errors->any())
        <div class="alert alert-danger text-center">Vui lòng kiểm tra dữ liệu nhập</div>
    @endif
    <form action="" method="POST">
        <div class="mb-3">
            <label for="">Tên</label>
            <input type="text" name="name" id="" class="form-control" placeholder="Tên nhóm..."
                value="{{ old('name') }}">
            @error('name')
                <span style="color: red">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Thêm mới</button>
        @csrf
    </form>

@endsection
