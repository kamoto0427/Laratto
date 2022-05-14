{{-- src/resources/views/layouts/common.blade.php継承 --}}
@extends('layouts.common')

@include('user.parts.sidebar_user')
@section('content')
@if ($post->publish_flg === 0)
    <div class="bg-blue-200 text-center text-blue-700 font-bold">ステータス：下書き保存</div>
@elseif ($post->publish_flg === 1)
    <div class="bg-green-200 text-center text-green-700 font-bold">ステータス：公開中</div>
@elseif ($post->publish_flg === 2)
    <div class="bg-amber-200 text-center text-amber-700 font-bold">ステータス：予約公開</div>
@else
@endif
@if (isset($date) && isset($time))
    <div class="py-2 text-center">
        <span class="px-4">予約公開日:{{ $date }}</span>
        <span class="px-4">予約公開時間:{{ $time }}</span>
    </div>
@endif
<form action="{{ route('post.update', ['post_id' => $post->id]) }}" method="POST" class="p-5">
@csrf
    @if ($errors->any())
        <div class="flex shadow-lg rounded-sm">
            <div class="bg-red-600 py-4 px-6 rounded-l-lg flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" class="fill-current text-white" width="20" height="20">
                    <path fill-rule="evenodd" d="M8.22 1.754a.25.25 0 00-.44 0L1.698 13.132a.25.25 0 00.22.368h12.164a.25.25 0 00.22-.368L8.22 1.754zm-1.763-.707c.659-1.234 2.427-1.234 3.086 0l6.082 11.378A1.75 1.75 0 0114.082 15H1.918a1.75 1.75 0 01-1.543-2.575L6.457 1.047zM9 11a1 1 0 11-2 0 1 1 0 012 0zm-.25-5.25a.75.75 0 00-1.5 0v2.5a.75.75 0 001.5 0v-2.5z"></path>
                </svg>
            </div>
            <div class="px-4 py-6 bg-red-50 rounded-r-lg justify-between items-center w-full border border-l-transparent border-red-50">
                <div class="text-red-600 text-md font-bold">エラー！</div>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li  class="text-sm text-red-500">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif
    <div class="flex mt-6 mr-12">
        <div class="m-auto">
            <select name="category" class="block w-64 text-gray-700 py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500">
                <option value="">カテゴリーを選択</option>
                @foreach ($categories as $category)
                    {{-- バリデーションエラー発生時、直前で選択した値を選択した状態にする --}}
                    @if (old('category'))
                        <option value="{{ $category->id }}" @selected(old('category') == $category->id)>{{ $category->category_name }}</option>
                    {{-- 編集画面で、DBに登録しているデータを選択状態にする --}}
                    @elseif ($category->id == $post->category_id)
                        <option value="{{ $category->id }}" @selected($post->category_id)>{{ $category->category_name }}</option>
                    {{-- 上記以外の場合は、選択状態にしない(記事新規作成の初期状態など) --}}
                    @else
                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                    @endif
                @endforeach
            </select>
        </div>
        <div>
            {{-- ステータスによって、表示するボタンや文言を変更 --}}
            @if ($post->publish_flg === 0)
                <button type="submit" name="save_draft" class="px-4 py-2 text-white text-lg transition-colors duration-200 transform bg-blue-500 rounded-md hover:bg-blue-400">下書き保存</button>
                <button type="submit" name="release" class="px-4 py-2 ml-8 text-white text-lg transition-colors duration-200 transform bg-green-500 rounded-md hover:bg-green-400">更新して公開</button>
                <button formaction="{{ route('reservation.post.edit', ['post_id' => $post->id]) }}" formmethod="GET" name="reservation_release" class="px-4 py-2 ml-8 text-white text-lg transition-colors duration-200 transform bg-amber-500 rounded-md hover:bg-amber-400">予約公開</button>
            @elseif ($post->publish_flg === 1)
                <button type="submit" name="save_draft" class="px-4 py-2 text-white text-lg transition-colors duration-200 transform bg-blue-500 rounded-md hover:bg-blue-400">下書きに戻す</button>
                <button type="submit" name="release" class="px-4 py-2 ml-8 text-white text-lg transition-colors duration-200 transform bg-green-500 rounded-md hover:bg-green-400">更新して公開</button>
            @elseif ($post->publish_flg === 2)
                <button type="submit" name="save_draft" class="px-4 py-2 text-white text-lg transition-colors duration-200 transform bg-blue-500 rounded-md hover:bg-blue-400">下書きに戻す</button>
                <button type="submit" name="release" class="px-4 py-2 ml-8 text-white text-lg transition-colors duration-200 transform bg-green-500 rounded-md hover:bg-green-400">今すぐ公開</button>
                <button formaction="{{ route('reservation.post.edit', ['post_id' => $post->id]) }}" formmethod="GET" name="reservation_release" class="px-4 py-2 ml-8 text-white text-lg transition-colors duration-200 transform bg-amber-500 rounded-md hover:bg-amber-400">予約日時を変更</button>
            @else
                <button type="submit" name="save_draft" class="px-4 py-2 text-white text-lg transition-colors duration-200 transform bg-blue-500 rounded-md hover:bg-blue-400">下書き保存</button>
                <button type="submit" name="release" class="px-4 py-2 ml-8 text-white text-lg transition-colors duration-200 transform bg-green-500 rounded-md hover:bg-green-400">更新して公開</button>
                <button formaction="{{ route('reservation.post.edit', ['post_id' => $post->id]) }}" formmethod="GET" name="reservation_release" class="px-4 py-2 ml-8 text-white text-lg transition-colors duration-200 transform bg-amber-500 rounded-md hover:bg-amber-400">予約公開</button>
            @endif
        </div>
    </div>
    <div class="w-full mt-4">
        <input type="text" name="title" class="block w-full text-3xl font-bold border-none outline-none" placeholder="タイトルを追加" value="{{ old('title', $post->title) }}"/>
    </div>
    <div class="w-full mt-4">
        <textarea name="body" class="block w-full h-40 px-4 py-2 border-none resize-none text-gray-700 bg-white border rounded-md focus:outline-none focus:ring" placeholder="記事の内容を書いてください">{{ old('body', $post->body) }}</textarea>
    </div>
</form>
@endsection