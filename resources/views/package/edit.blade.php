@extends('layouts.admin')

@section('content')

@include('package.nav')

<form action="{{ route("admin.package.update",$package) }}" method="post">
    @csrf
    @method('PUT')
    <div class="card mt-3 shadow-sm">
        <div class="card-header">
            套餐设置
        </div>
        <div class="card-body">
            <x-form title="套餐名称" name="title" value="{{ $package->title }}" required class="col-12 col-md-8"></x-form>
        </div>
    </div>

    <div class="card mt-3 shadow-sm">
        <div class="card-header">
            模块选择
        </div>
        <div class="card-body">
            <module-select></module-select>
        </div>
    </div>
    <button class="btn btn-primary mt-3">保存</button>
</form>
@endsection
@push('vue')
<script>
    window.modules = @json($modules);
    window.selected = @json($package->modules);
</script>
@endpush