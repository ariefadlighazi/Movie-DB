@foreach ($movies as $m)
    @php
        $id = is_array($m) ? $m['imdbID'] : $m->imdbID;
        $title = is_array($m) ? $m['Title'] : $m->Title;
        $year = is_array($m) ? $m['Year'] : $m->Year;
        $poster = is_array($m) ? $m['Poster'] : $m->Poster;
        $type = is_array($m) ? $m['Type'] : $m->Type;
        $isFav = in_array($id, $userFavorites ?? (auth()->user() ? auth()->user()->favorites()->pluck('imdbID')->toArray() : []));
    @endphp
    <div
        class="group relative flex flex-row bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg transition-all duration-200 overflow-hidden h-40 min-w-auto max-w-lg"
        id="movie-card-{{ $id }}">
        <div class="w-28 flex-shrink-0 relative bg-gray-200">
            <img src="{{ $poster }}" onerror="this.onerror=null;this.src='/images/no-image.png';" loading="lazy"
                alt="{{ $title }}"
                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
        </div>
        <div class="flex-1 p-4 flex flex-col justify-between">
            <div>
                <div class="flex justify-between items-start">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white leading-tight line-clamp-2"
                        title="{{ $title }}">
                        {{ $title }}
                    </h3>
                    <button
                        onclick="toggleFav('{{ $id }}', '{{ addslashes($title) }}', '{{ $year }}', '{{ $poster }}', '{{ $type }}', this)"
                        class="ml-2 {{ $isFav ? 'text-red-400' : 'text-gray-400' }} hover:text-red-500 focus:outline-none transition-colors"
                        title="{{ $isFav ? 'Remove from favorites' : 'Add to Favorites' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24"
                            stroke="none">
                            <path
                                d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                        </svg>
                    </button>
                </div>

                <div class="mt-1 flex items-center text-sm text-gray-500 dark:text-gray-400">
                    <span>{{ $year }}</span>
                    <span class="mx-2">•</span>
                    <span class="capitalize border border-gray-300 dark:border-gray-600 rounded px-1.5 text-xs">
                        {{ $type }}
                    </span>
                </div>
            </div>
            <div class="flex items-center justify-between mt-2">
                <div class="flex items-center text-yellow-500 text-sm font-semibold">
                    <svg class="w-4 h-4 mr-1 fill-current" viewBox="0 0 20 20">
                        <path
                            d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z" />
                    </svg>
                    <span>N/A</span>
                </div>

                <a href="{{ route('movie.detail', ['id' => $id]) }}"
                    class="inline-flex items-center px-4 py-2 bg-[#F5C518] hover:bg-[#E2B616] text-black text-sm font-bold rounded shadow-sm transition-colors">
                    View Details &rarr;
                </a>
            </div>
        </div>
    </div>
@endforeach

@once
    <script>
        function toggleFav(id, title, year, poster, type, btn) {
            const isRed = btn.classList.contains('text-red-400');

            if (!isRed) {
                btn.classList.add('text-red-400');
                btn.classList.remove('text-gray-400');
            } else {
                btn.classList.remove('text-red-400');
                btn.classList.add('text-gray-400');
            }

            axios.post('{{ route('favorite.toggle') }}', {
                    imdbID: id,
                    Title: title,
                    Year: year,
                    Poster: poster,
                    Type: type
                })
                .then(res => {
                    console.log(res.data.status);
                    if (window.location.pathname.includes('favorites')) {
                        const card = document.getElementById(`movie-card-${id}`);
                        if (card) card.style.display = 'none';
                    }
                })
                .catch(err => {
                    console.error(err);
                    if (!isRed) {
                        btn.classList.remove('text-red-400');
                        btn.classList.add('text-gray-400');
                    }
                });
        }
    </script>
@endonce
