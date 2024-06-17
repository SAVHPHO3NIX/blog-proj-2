<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('User Profiles') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Search and Filter Section -->
            <div
                class="mb-6 flex flex-col sm:flex-row justify-between items-center bg-white dark:bg-gray-800 p-4 rounded-lg shadow-md">
                <!-- Search Bar -->
                <div class="w-full sm:w-1/2 mb-4 sm:mb-0 sm:mr-4">
                    <input type="text" id="user-search" placeholder="{{ __('Search users...') }}"
                        class="w-full px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-md focus:outline-none focus:ring focus:border-blue-300 dark:focus:border-blue-600 bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-gray-300 placeholder-gray-500 dark:placeholder-gray-400">
                </div>

                <!-- Filter Options -->
                <div class="w-full sm:w-1/3">
                    <select id="filter-following"
                        class="w-full px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-md focus:outline-none focus:ring focus:border-blue-300 dark:focus:border-blue-600 bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-gray-300">
                        <option value="all">{{ __('All Users') }}</option>
                        <option value="following">{{ __('Following') }}</option>
                        <option value="not_following">{{ __('Not Following') }}</option>
                    </select>
                </div>
            </div>

            <div class="space-y-6" id="user-list">
                @foreach ($users as $user)
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6 user-card"
                        data-username="{{ $user->name }}"
                        data-following="{{ auth()->user()->isFollowing($user) ? 'following' : 'not_following' }}">
                        <div class="flex items-center mb-4">
                            <img src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}"
                                class="h-16 w-16 rounded-full mr-4">
                            <div>
                                <h3 class="font-semibold text-lg text-gray-700 dark:text-gray-300">{{ $user->name }}
                                </h3>
                                <p class="text-sm text-gray-500 dark:text-gray-400">{{ $user->bio }}</p>
                            </div>
                        </div>

                        <div class="flex justify-between">
                            <div>
                                <p class="text-gray-700 dark:text-gray-300"><span
                                        class="font-semibold">{{ __('Followers') }}:</span>
                                    {{ $user->followers()->count() }}</p>
                                <p class="text-gray-700 dark:text-gray-300"><span
                                        class="font-semibold">{{ __('Following') }}:</span>
                                    {{ $user->following()->count() }}</p>
                                <p class="text-gray-700 dark:text-gray-300"><span
                                        class="font-semibold">{{ __('Posts') }}:</span>
                                    {{ $user->posts()->count() }}</p>
                                <p class="text-gray-700 dark:text-gray-300"><span
                                        class="font-semibold">{{ __('Comments') }}:</span>
                                    {{ $user->comments()->count() }}</p>
                            </div>
                            <div>
                                @if (auth()->user()->isFollowing($user))
                                    <form action="{{ route('unfollow', $user) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600">
                                            {{ __('Unfollow') }}
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('follow', $user) }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                            class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                                            {{ __('Follow') }}
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('user-search');
            const filterSelect = document.getElementById('filter-following');
            const userCards = document.querySelectorAll('.user-card');

            function filterUsers() {
                const searchText = searchInput.value.toLowerCase();
                const filterValue = filterSelect.value;

                userCards.forEach(card => {
                    const username = card.getAttribute('data-username').toLowerCase();
                    const followingStatus = card.getAttribute('data-following');

                    const matchesSearch = username.includes(searchText);
                    const matchesFilter = filterValue === 'all' || filterValue === followingStatus;

                    if (matchesSearch && matchesFilter) {
                        card.style.display = '';
                    } else {
                        card.style.display = 'none';
                    }
                });
            }

            searchInput.addEventListener('input', filterUsers);
            filterSelect.addEventListener('change', filterUsers);
        });
    </script>
</x-app-layout>
