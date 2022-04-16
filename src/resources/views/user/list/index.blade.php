{{-- src/resources/views/layouts/common.blade.php継承 --}}
@extends('layouts.common')

@include('user.parts.sidebar_user')
@section('content')
<div class="h-screen overflow-y-scroll">
    <div class="px-4 sm:px-4">
        <div class="flex justify-between">
            <div class="text-2xl font-bold pt-7">投稿</div>
            <div class="pt-4">
                <button class="bg-blue-500 text-white px-4 py-2 rounded-md text-1xl font-medium hover:bg-blue-700 transition duration-300">新規追加</button>
            </div>
        </div>
        <div class="py-4">
            <div class="overflow-x-auto">
                <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                    <table class="min-w-full leading-normal">
                        <thead>
                            <tr>
                                <th scope="col" class="px-5 py-3 bg-white  border-b border-gray-200 text-gray-800  text-center text-sm uppercase font-normal">
                                    タイトル
                                </th>
                                <th scope="col" class="px-5 py-3 bg-white  border-b border-gray-200 text-gray-800  text-center text-sm uppercase font-normal">
                                    投稿ID
                                </th>
                                <th scope="col" class="px-5 py-3 bg-white  border-b border-gray-200 text-gray-800  text-center text-sm uppercase font-normal">
                                    カテゴリー
                                </th>
                                <th scope="col" class="px-5 py-3 bg-white  border-b border-gray-200 text-gray-800  text-center text-sm uppercase font-normal">
                                    ステータス
                                </th>
                                <th scope="col" class="px-5 py-3 bg-white  border-b border-gray-200 text-gray-800  text-center text-sm uppercase font-normal">
                                    日付
                                </th>
                                <th scope="col" class="px-5 py-3 bg-white  border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-normal">
                                    操作
                                </th>
                                <th scope="col" class="px-5 py-3 bg-white  border-b border-gray-200 text-gray-800  text-center text-sm uppercase font-normal">
                                    PV数
                                </th>
                                <th scope="col" class="px-5 py-3 bg-white  border-b border-gray-200 text-gray-800  text-center text-sm uppercase font-normal">
                                    お気に入り数
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($posts as $post)
                            <tr>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm w-40">
                                    <p class="text-left text-gray-900 whitespace-no-wrap">
                                        {{ $post->title }}
                                    </p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-center text-gray-900 whitespace-no-wrap">
                                        {{ $post->id }}
                                    </p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                                    <span class="relative inline-block px-3 py-1 font-semibold text-white leading-tight">
                                        <span aria-hidden="true" class="absolute inset-0 bg-green-500 rounded-full">
                                        </span>
                                        <span class="relative">
                                            @if (isset($post->category_id))
                                                {{ $post->category->category_name }}
                                            @else
                                                カテゴリーなし
                                            @endif
                                        </span>
                                    </span>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                                    @if ($post->publish_flg === 0)
                                        <span class="relative inline-block px-3 py-1 font-semibold text-blue-900 leading-tight">
                                            <span aria-hidden="true" class="absolute inset-0 bg-blue-200 opacity-50 rounded-full">
                                            </span>
                                            <span class="relative">
                                                下書き保存
                                            </span>
                                        </span>
                                    @elseif ($post->publish_flg === 1)
                                        <span class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
                                            <span aria-hidden="true" class="absolute inset-0 bg-green-200 opacity-50 rounded-full">
                                            </span>
                                            <span class="relative">公開済み</span>
                                        </span>
                                    @elseif ($post->publish_flg === 2)
                                        <span class="relative inline-block px-3 py-1 font-semibold text-amber-900 leading-tight">
                                            <span aria-hidden="true" class="absolute inset-0 bg-amber-200 opacity-50 rounded-full">
                                            </span>
                                            <span class="relative">予約公開</span>
                                        </span>
                                    @else
                                        <span class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
                                            <span aria-hidden="true" class="absolute inset-0 bg-green-200 opacity-50 rounded-full">
                                            </span>
                                            <span class="relative">下書き保存</span>
                                        </span>
                                    @endif
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-center text-gray-900 whitespace-no-wrap">
                                        {{ $post->created_at }}
                                    </p>
                                </td>
                                <td class="px-5 py-5 mr-5 border-b border-gray-200 bg-white text-sm">
                                    <a class="mr-3 text-blue-700 whitespace-no-wrap underline" href="#">
                                        Edit
                                    </a>
                                    <a class="ml-5 underline text-red-700 whitespace-no-wrap" href="#">
                                        delete
                                    </a>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-center text-gray-900 whitespace-no-wrap">
                                        {{ $post->view_counter }}
                                    </p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-center text-gray-900 whitespace-no-wrap">
                                        {{ $post->favorite_counter }}
                                    </p>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection