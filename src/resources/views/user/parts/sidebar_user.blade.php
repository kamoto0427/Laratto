@section('sidebar')
<div class="h-screen hidden lg:block shadow-lg relative w-50">
    <div class="bg-amber-100 h-full">
        <div class="flex items-center justify-start pt-6 ml-8">
            <p class="font-bold text-xl">
                Laratto
            </p>
        </div>
        <nav class="mt-6">
            <div>
                <a class="flex items-center px-4 py-2 mt-2 text-gray-600 transition-colors duration-200 transform hover:bg-sky-500 hover:text-white"
                href="{{ route('top') }}">
                    <span class="text-left">
                        <svg width="20" height="20" fill="currentColor" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1472 992v480q0 26-19 45t-45 19h-384v-384h-256v384h-384q-26 0-45-19t-19-45v-480q0-1 .5-3t.5-3l575-474 575 474q1 2 1 6zm223-69l-62 74q-8 9-21 11h-3q-13 0-21-7l-692-577-692 577q-12 8-24 7-13-2-21-11l-62-74q-8-10-7-23.5t11-21.5l719-599q32-26 76-26t76 26l244 204v-195q0-14 9-23t23-9h192q14 0 23 9t9 23v408l219 182q10 8 11 21.5t-7 23.5z">
                            </path>
                        </svg>
                    </span>
                    <span class="mx-2 text-md font-normal">
                        総合トップへ戻る
                    </span>
                </a>
            </div>
            <div>
                <a class="flex items-center px-4 py-2 mt-2 text-gray-600 transition-colors duration-200 transform hover:bg-sky-500 hover:text-white"
                href="#">
                    <span class="text-left">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M5 4a2 2 0 012-2h6a2 2 0 012 2v14l-5-2.5L5 18V4z" />
                        </svg>
                    </span>
                    <span class="mx-2 text-md font-normal">
                        マイニュース
                    </span>
                </a>
            </div>
            <div>
                <a class="flex items-center px-4 py-2 mt-2 text-gray-600 transition-colors duration-200 transform hover:bg-sky-500 hover:text-white"
                href="#">
                    <span class="text-left">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M18 13V5a2 2 0 00-2-2H4a2 2 0 00-2 2v8a2 2 0 002 2h3l3 3 3-3h3a2 2 0 002-2zM5 7a1 1 0 011-1h8a1 1 0 110 2H6a1 1 0 01-1-1zm1 3a1 1 0 100 2h3a1 1 0 100-2H6z" clip-rule="evenodd" />
                        </svg>
                    </span>
                    <span class="mx-2 text-md font-normal">
                        投稿
                    </span>
                </a>
            </div>
            <div>
                <a class="flex items-center px-4 py-2 mt-2 text-gray-600 transition-colors duration-200 transform hover:bg-sky-500 hover:text-white"
                href="#">
                    <span class="text-left">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M2 9.5A3.5 3.5 0 005.5 13H9v2.586l-1.293-1.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 15.586V13h2.5a4.5 4.5 0 10-.616-8.958 4.002 4.002 0 10-7.753 1.977A3.5 3.5 0 002 9.5zm9 3.5H9V8a1 1 0 012 0v5z" clip-rule="evenodd" />
                        </svg>
                    </span>
                    <span class="mx-2 text-md font-normal">
                        下書き保存
                    </span>
                </a>
            </div>
            <div>
                <a class="flex items-center px-4 py-2 mt-2 text-gray-600 transition-colors duration-200 transform hover:bg-sky-500 hover:text-white"
                href="#">
                    <span class="text-left">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                        </svg>
                    </span>
                    <span class="mx-2 text-md font-normal">
                        公開予約
                    </span>
                </a>
            </div>
            <div>
                <a class="flex items-center px-4 py-2 mt-2 text-gray-600 transition-colors duration-200 transform hover:bg-sky-500 hover:text-white"
                href="#">
                    <span class="text-left">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M4 3a2 2 0 100 4h12a2 2 0 100-4H4z" />
                            <path fill-rule="evenodd" d="M3 8h14v7a2 2 0 01-2 2H5a2 2 0 01-2-2V8zm5 3a1 1 0 011-1h2a1 1 0 110 2H9a1 1 0 01-1-1z" clip-rule="evenodd" />
                          </svg>
                    </span>
                    <span class="mx-2 text-md font-normal">
                        ゴミ箱
                    </span>
                </a>
            </div>
            <div>
                <a class="flex items-center px-4 py-2 mt-2 text-gray-600 transition-colors duration-200 transform hover:bg-sky-500 hover:text-white"
                href="#">
                    <span class="text-left">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z" />
                        </svg>
                    </span>
                    <span class="mx-2 text-md font-normal">
                        統計データ
                    </span>
                </a>
            </div>
            <div>
                <a class="flex items-center px-4 py-2 mt-2 text-gray-600 transition-colors duration-200 transform hover:bg-sky-500 hover:text-white"
                href="#">
                    <span class="text-left">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M11 3a1 1 0 100 2h2.586l-6.293 6.293a1 1 0 101.414 1.414L15 6.414V9a1 1 0 102 0V4a1 1 0 00-1-1h-5z" />
                            <path d="M5 5a2 2 0 00-2 2v8a2 2 0 002 2h8a2 2 0 002-2v-3a1 1 0 10-2 0v3H5V7h3a1 1 0 000-2H5z" />
                        </svg>
                    </span>
                    <span class="mx-2 text-md font-normal">
                        ログアウト
                    </span>
                </a>
            </div>
        </nav>
    </div>
</div>
@endsection