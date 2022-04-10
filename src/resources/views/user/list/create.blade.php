{{-- src/resources/views/layouts/common.blade.php継承 --}}
@extends('layouts.common')

@include('user.parts.sidebar_user')
@section('content')
    <form action="{{ route('post.store') }}" method="POST" class="p-5">
    @csrf
        <div class="flex mt-6 mr-12">
            <div class="m-auto">
                <select name="category" class="block w-64 text-gray-700 py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500">
                    <option value="">カテゴリーを選択</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <button type="submit" name="save_draft" class="px-4 py-2 text-white text-lg transition-colors duration-200 transform bg-blue-500 rounded-md hover:bg-blue-400">下書き保存</button>
                <button type="submit" name="release" class="px-4 py-2 ml-8 text-white text-lg transition-colors duration-200 transform bg-green-500 rounded-md hover:bg-green-400">公開</button>
                <button type="submit" name="reservation_release" class="px-4 py-2 ml-8 text-white text-lg transition-colors duration-200 transform bg-amber-500 rounded-md hover:bg-amber-400">予約公開</button>
            </div>
        </div>
        <div class="w-full mt-4">
            <input type="text" name="title" class="block w-full text-3xl font-bold border-none outline-none" placeholder="タイトルを追加" />
        </div>
        <div class="w-full mt-4">
            <textarea name="body" class="block w-full h-40 px-4 py-2 border-none text-gray-700 bg-white border rounded-md focus:outline-none focus:ring" placeholder="記事の内容を書いてください"></textarea>
        </div>
    </form>
@endsection