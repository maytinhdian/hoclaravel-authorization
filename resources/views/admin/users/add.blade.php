@extends('layouts.admin')

@section('title', 'Thêm người dùng')

@section('content')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Thêm người dùng</h1>

    </div>
    @if ($errors->any())
        <div class="alert alert-danger text-center">Vui lòng kiểm tra dữ liệu nhập</div>
    @endif
    <form action="" method="POST">
        <div class="mb-3">
            <label for="">Tên</label>
            <input type="text" name="name" id="" class="form-control" placeholder="Tên..." value="{{old('name')}}">
            @error('name')
                <span style="color: red">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="">Email</label>
            <input type="text" name="email" id="email" class="form-control" placeholder="Email..." value="{{old('email')}}">
            @error('email')
                <span style="color: red">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="">Mật khẩu</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="Mật khẩu...">
            @error('password')
                <span style="color: red">{{ $message }}</span>
            @enderror
        </div>
        {{-- <div class="mb-3">
            <label for="">Nhập lại mật khẩu</label>
            <input type="password" name="retype_password" id="" class="form-control"
                placeholder="Nhập lại mật khẩu...">
        </div> --}}
        <div class="mb-3">
            <label for="">Nhóm</label>
            <select name="group_id" id="" class="form-control">
                <option value="0">Chọn nhóm</option>
                @if ($groups->count()>0)
                    @foreach ($groups as $item)
                        <option value="{{$item->id}}" {{old('group_id')==$item->id?'selected':false}}>{{$item->name}}</option>
                    @endforeach
                @endif
            </select>
            @error('group_id')
                <span style="color: red">{{ $message }}</span>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Thêm mới</button>
        @csrf
    </form>

@endsection
