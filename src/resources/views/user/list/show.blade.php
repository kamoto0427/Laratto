{{-- src/resources/views/layouts/common.blade.php継承 --}}
@extends('layouts.common')

@include('user.parts.sidebar_user')
@section('content')
<div class="px-8 py-8 mx-auto bg-white">
    <div class="flex items-center justify-between">
        <span class="text-sm font-light text-gray-600">{{ $showPostData->updated_at ? $showPostData->updated_at : $showPostData->created_at }}</span>
    </div>

    <div class="mt-2">
        <p class="text-2xl font-bold text-gray-800">{{ $showPostData->title }}</p>
        <p class="mt-8 text-gray-600">{{ $showPostData->body }}</p>
    </div>
</div>
@endsection