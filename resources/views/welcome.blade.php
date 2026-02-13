@extends('layouts.app')

@section('title', 'Movies')


@section('content')
    <div
        class="sticky top-16 z-40 w-full bg-[#FDFDFC]/95 dark:bg-[#0a0a0a]/95 backdrop-blur-md py-4 px-2 border-b border-gray-200 dark:border-gray-800 shadow-sm mb-4 transition-colors duration-300">
        <form method="GET" action="{{ route('movie.index') }}"
            class="w-full max-w-2xl mx-auto flex shadow-md rounded-lg overflow-hidden">
            <div class="flex items-center pl-4 bg-white dark:bg-gray-700">
                <svg viewBox="0 0 1024 1024" class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none">
                        <path
                            d="M448 768A320 320 0 1 0 448 128a320 320 0 0 0 0 640z m297.344-76.992l214.592 214.592-54.336 54.336-214.592-214.592a384 384 0 1 1 54.336-54.336z"
                            fill="#919191"></path>
                </svg>
                {{-- &#128269 --}}
            </div>
            <input type="text" name="q" placeholder="Search movies (e.g. Batman)..." value="{{ request('q') }}"
                class="w-full p-3 bg-white dark:bg-gray-700 text-gray-800 dark:text-white focus:outline-none placeholder-gray-400"
                autocomplete="off">
            <button type="submit"
                class="bg-[#F5C518] hover:bg-[#E2B616] text-black font-bold py-2 px-6 transition-colors duration-200">
                Search
            </button>
        </form>
    </div>
    @if(empty($movies))
    <div class="w-full h-full items-center flex flex-col">
        <p class="text-white">No movies found!</p>
    </div>
    @endif
    <div class="flex flex-col gap-4 mt-4" id="movie-container">
        @include('partials.MovieCard', ['movies' => $movies])
    </div>
    <div id="scroll-sentinel" class="h-10 mt-4"></div>
    <div id="loading-spinner" class="hidden text-center py-4 text-gray-500">Loading more movies...</div>
    <script>
        let page = {{ $page }};
        const query = "{{ $query ?? '' }}";
        let isLoading = false;
        let hasMore = true;

        const sentinel = document.getElementById('scroll-sentinel');
        const container = document.getElementById('movie-container');
        const spinner = document.getElementById('loading-spinner');

        const observer = new IntersectionObserver((entries) => {
            if (entries[0].isIntersecting && !isLoading && hasMore) {
                loadMore();
            }
        });

        observer.observe(sentinel);

        function loadMore() {
            isLoading = true;
            spinner.classList.remove('hidden');
            page++;

            let url = `{{ route('movie.index') }}?page=${page}`;
            if (query) url += `&q=${query}`;

            axios.get(url, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => {
                    const html = response.data;

                    if (!html || html.trim().length === 0) {
                        hasMore = false;
                        sentinel.remove();
                    } else {
                        container.insertAdjacentHTML('beforeend', html);
                    }
                })
                .catch(err => {
                    console.error(err);
                    hasMore = false;
                })
                .finally(() => {
                    isLoading = false;
                    spinner.classList.add('hidden');
                });
        }
    </script>
@endsection
