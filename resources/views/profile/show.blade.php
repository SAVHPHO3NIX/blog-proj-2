<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex items-center">
                        <div class="mr-4">
                            @if ($user->profile_photo_url)
                                <img class="h-16 w-16 rounded-full" src="{{ $user->profile_photo_url }}"
                                    alt="{{ $user->name }}">
                            @else
                                <div class="h-16 w-16 rounded-full bg-gray-300 flex items-center justify-center">
                                    <svg class="h-8 w-8 text-gray-500" fill="none" stroke-linecap="round"
                                        stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path d="M12 14l9-5-9-5-9 5 9 5z" />
                                        <path d="M12 14l9-5-9-5-9 5 9 5z" />
                                        <path d="M12 14l9-5-9-5-9 5 9 5z" />
                                    </svg>
                                </div>
                            @endif
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold">{{ $user->name }}</h3>
                            <p class="text-sm">{{ $user->bio }}</p>
                        </div>
                    </div>
                    <div class="mt-4">
                        <p>{{ __('Followers') }}: {{ $followersCount }}</p>
                        <p>{{ __('Following') }}: {{ $followingCount }}</p>
                        <p>{{ __('Posts') }}: {{ $postsCount }}</p>
                        <p>{{ __('Comments') }}: {{ $commentsCount }}</p>
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('userprofile.edit') }}"
                            class="inline-flex items-center px-4 py-2 bg-blue-600 dark:bg-blue-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 dark:hover:bg-blue-600 focus:outline-none focus:border-blue-700 dark:focus:border-blue-800 focus:ring focus:ring-blue-200 dark:focus:ring-blue-500 active:bg-blue-700 dark:active:bg-blue-800 disabled:opacity-25 transition ease-in-out duration-150">
                            {{ __('Edit Profile') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
