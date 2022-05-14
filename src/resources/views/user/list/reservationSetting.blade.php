{{-- src/resources/views/layouts/common.blade.php継承 --}}
@extends('layouts.common')

@include('user.parts.sidebar_user')
@section('content')
<div class="p-5">
    <div class="font-bold text-2xl text-center">予約公開設定</div>
    <form action="{{ route('reservation.post.store') }}" method="POST" class="pt-12 text-center">
    @csrf
        <div class="pb-5 text-2xl underline decoration-dashed decoration-amber-500">予約公開日を設定する</div>
        <label for="reservation_date">日付を選択:</label>
        <input type="date" name="reservation_date">
        <div class="pt-12 pb-5 text-2xl underline decoration-dashed decoration-amber-500">予約公開時間を設定する</div>
        <label for="reservation_hour">時:</label>
        <select name="reservation_hour">
            @for ($i=0; $i<=23; $i++)
                <option value="{{ $i < 10 ? '0'.$i: $i }}">{{ $i < 10 ? '0'.$i: $i }}</option>
            @endfor
        </select>
        <label for="reservation_minute">分:</label>
        <select name="reservation_minute">
            @foreach ($minuteList as $m)
                <option value="{{ $m }}">{{ $m }}</option>
            @endforeach
        </select>
        <input type="hidden" name="title" value="{{ $title }}">
        <input type="hidden" name="body" value="{{ $body }}">
        <input type="hidden" name="category" value="{{ $category }}">
        <div class="pt-12">
            <button type="submit" name="reservation" class="inline-block px-6 py-2.5 bg-amber-500 text-white font-medium text-lg leading-tight uppercase rounded-full shadow-md hover:bg-amber-600 hover:shadow-lg focus:bg-amber-600 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-amber-700 active:shadow-lg transition duration-150 ease-in-out">
                上記の内容で記事を予約公開する
            </button>
        </div>
    </form>
</div>
@endsection