{{-- 投稿：下書き保存 --}}
@if (session('saveDraft'))
    <div class="bg-blue-200 border-t border-b border-blue-500 text-blue-700 text-center px-4 py-3 font-bold">
        {{ session('saveDraft') }}
    </div>
{{-- 投稿：公開 --}}
@elseif (session('release'))
    <div class="bg-green-200 border-t border-b border-green-500 text-green-700 text-center px-4 py-3 font-bold">
        {{ session('release') }}
    </div>
{{-- 投稿：公開予約 --}}
@elseif (session('reservationRelease'))
    <div class="bg-amber-200 border-t border-b border-amber-500 text-amber-700 text-center px-4 py-3 font-bold">
        {{ session('reservationRelease') }}
    </div>
@endif
{{-- 更新：下書き保存 --}}
@if (session('updateSaveDraft'))
    <div class="bg-blue-200 border-t border-b border-blue-500 text-blue-700 text-center px-4 py-3 font-bold">
        {{ session('updateSaveDraft') }}
    </div>
{{-- 更新：公開 --}}
@elseif (session('updateRelease'))
    <div class="bg-green-200 border-t border-b border-green-500 text-green-700 text-center px-4 py-3 font-bold">
        {{ session('updateRelease') }}
    </div>
{{-- 更新：公開予約 --}}
@elseif (session('updateReservationRelease'))
    <div class="bg-amber-200 border-t border-b border-amber-500 text-amber-700 text-center px-4 py-3 font-bold">
        {{ session('updateReservationRelease') }}
    </div>
@endif
{{-- ゴミ箱:ゴミ箱に移動 --}}
@if (session('moveTrash'))
    <div class="bg-violet-200 border-t border-b border-violet-500 text-violet-700 text-center px-4 py-3 font-bold">
        {{ session('moveTrash') }}
    </div>
@endif
{{-- ゴミ箱：記事を復元 --}}
@if (session('restore'))
    <div class="bg-sky-200 border-t border-b border-sky-500 text-sky-700 text-center px-4 py-3 font-bold">
        {{ session('restore') }}
    </div>
{{-- ゴミ箱：記事を削除 --}}
@elseif (session('delete'))
    <div class="bg-red-200 border-t border-b border-red-500 text-red-700 text-center px-4 py-3 font-bold">
        {{ session('delete') }}
    </div>
@endif