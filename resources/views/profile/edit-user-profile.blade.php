<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('userprofile.update') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                            <div>
                                <label for="name"
                                    class="block font-medium text-sm text-gray-700 dark:text-gray-300">{{ __('Name') }}</label>
                                <input id="name"
                                    class="block mt-1 w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                                    type="text" name="name" value="{{ old('name', $user->name) }}" required>
                            </div>
                            <div>
                                <label for="bio"
                                    class="block font-medium text-sm text-gray-700 dark:text-gray-300">{{ __('Bio') }}</label>
                                <input id="bio"
                                    class="block mt-1 w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                                    type="text" name="bio" value="{{ old('bio', $user->bio) }}">
                            </div>
                            <div>
                                <label for="profile_photo"
                                    class="block font-medium text-sm text-gray-700 dark:text-gray-300">{{ __('Profile Photo') }}</label>
                                <input id="profile_photo"
                                    class="block mt-1 w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                                    type="file" name="profile_photo">
                            </div>
                        </div>
                        <div class="mt-4">
                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 bg-blue-600 dark:bg-blue-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 dark:hover:bg-blue-600 focus:outline-none focus:border-blue-700 dark:focus:border-blue-800 focus:ring focus:ring-blue-200 dark:focus:ring-blue-500 active:bg-blue-700 dark:active:bg-blue-800 disabled:opacity-25 transition ease-in-out duration-150">
                                {{ __('Update Profile') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
