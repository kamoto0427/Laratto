{{-- layouts.common.blade.phpのレイアウト継承 --}}
@extends('layouts.common')

{{-- ヘッダー呼び出し --}}
@include('common.header')
{{-- サイドバー呼び出し --}}
@include('common.sidebar')
{{-- メイン部分作成 --}}
@section('content')
<div class="px-8 py-8 mx-auto bg-white">
    <div class="flex items-center justify-between">
        <span class="text-sm font-light text-gray-600">最終更新日時:{{ $post->updated_at }}</span>
    </div>

    <div class="mt-2">
        <p class="text-2xl font-bold text-gray-800">{{ $post->title }}</p>
        <p class="mt-8 text-gray-600">{{ $post->body }}</p>
    </div>
</div>
@endsection
{{-- フッター呼び出し --}}
@include('common.footer')