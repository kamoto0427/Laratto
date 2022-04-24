{{-- layouts.common.blade.phpのレイアウト継承 --}}
@extends('layouts.common')

{{-- ヘッダー呼び出し --}}
@include('common.header')
{{-- サイドバー呼び出し --}}
@include('common.sidebar')
{{-- メイン部分作成 --}}
@section('content')
<section class="h-full bg-gray-50 text-gray-600 body-font">
    <div class="px-3 py-3 mx-auto">
        @foreach ($posts as $post)
        <div class="p-2 flex flex-col items-start">
            <div class="flex">
                <span class="bg-green-500 rounded-full text-white px-3 py-1 text-xs uppercase font-medium">{{ $post->category->category_name }}</span>
                <span class="ml-5 text-gray-600">投稿日時：</span>
                <span class="text-gray-600">{{ $post->updated_at }}</span>
                <span class="ml-5 text-gray-600">投稿者：</span>
                <span class="text-blue-500"><a class="underline" href="#">{{ $post->user->name }}</a></span>
            </div>
            <h2 class="sm:text-3xl text-2xl title-font font-medium text-gray-900 mt-4 mb-4">{{ $post->title }}</h2>
            <p class="leading-relaxed mb-8">{{ $post->body }}</p>
            <div class="flex items-center flex-wrap pb-4 mb-4 border-b-2 border-gray-100 mt-auto w-full">
            <a class="px-6 py-2 inline-flex items-center text-indigo-500 transition ease-in duration-200 uppercase rounded cursor-pointer hover:bg-blue-500 hover:text-white border-2 border-blue-500 focus:outline-none">続きを読む
                <svg class="w-4 h-4 ml-2" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path d="M5 12h14"></path>
                <path d="M12 5l7 7-7 7"></path>
                </svg>
            </a>
            <span class="text-gray-500 mr-3 inline-flex items-center ml-auto leading-none text-2xl pr-3 py-1 border-r-2 border-gray-200">
                <svg class="w-5 h-5 mr-1 text-blue-300" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                <circle cx="12" cy="12" r="3"></circle>
                </svg>1.2K
            </span>
            <span class="text-gray-500 inline-flex items-center leading-none text-2xl">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-1 text-yellow-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                </svg>300
            </span>
            </div>
        </div>
        @endforeach
    </div>
</section>
@endsection
{{-- フッター呼び出し --}}
@include('common.footer')