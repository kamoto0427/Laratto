@section('header')
<header class="text-gray-600 body-font">
    <div class="mx-auto flex flex-wrap p-5 flex-col md:flex-row items-center">
      <a class="flex title-font font-medium items-center text-gray-900 mb-4 md:mb-0">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1" class="w-10 h-10 text-white p-1 bg-emerald-500 rounded-full" viewBox="0 0 22 22">
            <path stroke-linecap="round" stroke-linejoin="round" d="M11 17a1 1 0 001.447.894l4-2A1 1 0 0017 15V9.236a1 1 0 00-1.447-.894l-4 2a1 1 0 00-.553.894V17zM15.211 6.276a1 1 0 000-1.788l-4.764-2.382a1 1 0 00-.894 0L4.789 4.488a1 1 0 000 1.788l4.764 2.382a1 1 0 00.894 0l4.764-2.382zM4.447 8.342A1 1 0 003 9.236V15a1 1 0 00.553.894l4 2A1 1 0 009 17v-5.764a1 1 0 00-.553-.894l-4-2z" />
        </svg>
        <span class="ml-3 text-2xl">Laratto</span>
      </a>
      <div class="md:ml-auto md:mr-auto flex flex-wrap items-center text-base justify-center">
        <div class="mb-1 xl:w-96">
          <input
            type="search"
            class="form-control block w-full px-3 py-2 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
            id="search"
            placeholder="ニュースを検索..."
          />
        </div>
      </div>
      <button class="inline-flex text-white items-center bg-emerald-500 border-0 py-1 px-3 mx-2 focus:outline-none hover:bg-emerald-400 rounded text-base mt-4 md:mt-0">
          新規登録
      </button>
      <button class="inline-flex text-white items-center bg-emerald-500 border-0 py-1 px-3 mx-2 focus:outline-none hover:bg-emerald-400 rounded text-base mt-4 md:mt-0">
          ログイン
      </button>
    </div>
</header>
@endsection