@extends('layouts.app')

@section('title', $movie['Title'] ?? 'Movie Detail')

@section('content')
    <div class="container mx-auto px-4 py-8">

        <a href="{{ url()->previous() == url()->current() ? route('movie.index') : url()->previous() }}"
            class="inline-flex items-center mb-6 text-gray-600 hover:text-blue-600 transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd"
                    d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z"
                    clip-rule="evenodd" />
            </svg>
            Back to Movies
        </a>

        <div
            class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden flex flex-col md:flex-row w-full max-w-5xl mx-auto">

            <div class="w-full md:w-1/3 h-96 md:h-auto relative bg-gray-200 shrink-0">
                <img src="{{ $movie['Poster'] }}" onerror="this.onerror=null;this.src='/images/no-image.png';"
                    alt="{{ $movie['Title'] }}" class="absolute inset-0 w-full h-full object-cover">
            </div>

            <div class="w-full md:w-2/3 p-6 md:p-8 flex flex-col">

                <div class="flex justify-between items-start">
                    <div>
                        <h1 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white mb-2">
                            {{ $movie['Title'] }}
                        </h1>
                        <div class="flex items-center text-sm text-gray-500 dark:text-gray-400 space-x-4">
                            <span>{{ $movie['Year'] }}</span>
                            <span>&bull;</span>
                            <span>{{ $movie['Rated'] ?? 'N/A' }}</span>
                            <span>&bull;</span>
                            <span>{{ $movie['Runtime'] ?? 'N/A' }}</span>
                        </div>
                    </div>

                    <div class="flex flex-col items-center ml-4">
                        <div class="flex items-center text-yellow-500">
                            <svg class="w-8 h-8 fill-current" viewBox="0 0 24 24">
                                <path
                                    d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
                            </svg>
                            <span class="text-2xl font-bold text-gray-900 dark:text-white ml-1">
                                {{ $movie['imdbRating'] ?? 'N/A' }}
                            </span>
                        </div>
                        <span class="text-xs text-gray-400">{{ $movie['imdbVotes'] ?? 0 }} votes</span>
                    </div>
                </div>

                <div class="mt-4 flex flex-wrap gap-2">
                    @foreach (explode(',', $movie['Genre']) as $genre)
                        <span
                            class="px-3 py-1 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-full text-sm font-medium">
                            {{ trim($genre) }}
                        </span>
                    @endforeach
                </div>

                <div class="mt-6 border-t border-gray-200 dark:border-gray-700 pt-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Plot</h3>
                    <p class="text-gray-600 dark:text-gray-300 leading-relaxed">
                        {{ $movie['Plot'] }}
                    </p>
                </div>

                <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                    <div>
                        <span class="block text-gray-400 font-medium">Director</span>
                        <span class="text-gray-800 dark:text-gray-200">{{ $movie['Director'] ?? 'N/A' }}</span>
                    </div>
                    <div>
                        <span class="block text-gray-400 font-medium">Writers</span>
                        <span class="text-gray-800 dark:text-gray-200">{{ $movie['Writer'] ?? 'N/A' }}</span>
                    </div>
                    <div>
                        <span class="block text-gray-400 font-medium">Actors</span>
                        <span class="text-gray-800 dark:text-gray-200">{{ $movie['Actors'] ?? 'N/A' }}</span>
                    </div>
                </div>

                <div class="mt-8 flex items-center gap-4">
                    <button
                        onclick="toggleFavDetail('{{ $movie['imdbID'] }}', '{{ addslashes($movie['Title']) }}', '{{ $movie['Year'] }}', '{{ $movie['Poster'] }}', '{{ $movie['Type'] ?? 'movie' }}', this)"
                        class="flex items-center justify-center w-full md:w-auto px-6 py-3 bg-gray-100 hover:bg-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-800 dark:text-white font-semibold rounded-lg transition group">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5 mr-2 {{ $isFavorite ? 'text-red-400' : 'text-gray-400' }} group-hover:text-red-500 transition-colors"
                            fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                        </svg>
                        <span>{{ $isFavorite ? 'Remove from Favorites' : 'Add to Favorites' }}</span>
                    </button>

                    <a href="https://www.imdb.com/title/{{ $movie['imdbID'] }}" target="_blank"
                        class="flex items-center justify-center w-full md:w-auto px-6 py-3 bg-[#F5C518] hover:bg-[#E2B616] text-black font-bold rounded-lg transition">
                        View on IMDb
                    </a>
                </div>

            </div>
        </div>
    </div>

    @once
        <script>
            function toggleFavDetail(id, title, year, poster, type, btn) {
                const icon = btn.querySelector('svg');
                const text = btn.querySelector('span');

                axios.post('{{ route('favorite.toggle') }}', {
                        imdbID: id,
                        Title: title,
                        Year: year,
                        Poster: poster,
                        Type: type
                    })
                    .then(res => {
                        if (res.data.status === 'added') {
                            icon.classList.add('text-red-400');
                            icon.classList.remove('text-gray-400');
                            text.innerText = 'Remove from Favorites';
                        } else {
                            icon.classList.remove('text-red-400');
                            icon.classList.add('text-gray-400');
                            text.innerText = 'Add to Favorites';
                        }
                    })
                    .catch(console.error);
            }
        </script>
    @endonce
@endsection
