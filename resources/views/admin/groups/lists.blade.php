@extends('layouts.admin');

@section('title', 'Danh sách nhóm')

@section('content')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Danh sách nhóm</h1>
    </div>
    @if (session('msg'))
        <div class="alert alert-success">{{ session('msg') }}</div>
    @endif
    <p>
        <a href="{{ route('admin.groups.add') }}" class="btn btn-primary">Thêm mới</a>
    </p>
    <div class="table table-bordered">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th width="5%">STT</th>
                    <th width="">Tên</th>
                    <th width="15%">Người đăng</th>
                    <th width="15%">Phân quyền</th>
                    <th width="5%">Sửa</th>
                    <th width="5%">Xóa</th>
                </tr>
            </thead>
            <tbody>
                @if ($lists->count() > 0)
                    @foreach ($lists as $key => $item)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $item->name }}</td>
                            <td>
                                {{ !empty($item->postBy->name) ? $item->postBy->name : false }}
                            </td>
                            <td>
                                <a href="#" class="btn btn-primary">Phân quyền</a>
                            </td>
                            <td>
                                <a href="{{ route('admin.groups.edit', $item) }}" class="btn btn-warning">Sửa</a>
                            </td>
                            <td>
                                @if (Auth::user()->id !== $item->id)
                                    <a onclick="return confirm('Bạn có chắc chắn?')"
                                        href="{{ route('admin.groups.delete', $item) }}" class="btn btn-danger">Xóa</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                @endif


            </tbody>
        </table>
    </div>

@endsection
