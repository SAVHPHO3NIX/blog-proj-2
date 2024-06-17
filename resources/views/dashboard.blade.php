<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Feed') }}
        </h2>
    </x-slot>

    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div
                class="mb-6 flex flex-col sm:flex-row justify-between items-center bg-white dark:bg-gray-800 p-4 rounded-lg shadow-md">

                <div class="w-full sm:w-1/2 mb-4 sm:mb-0 sm:mr-4">
                    <input type="text" id="search" placeholder="{{ __('Search posts...') }}"
                        class="w-full px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-md focus:outline-none focus:ring focus:border-blue-300 dark:focus:border-blue-600 bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-gray-300 placeholder-gray-500 dark:placeholder-gray-400">
                </div>

                <div class="w-full sm:w-1/3">
                    <select id="filter"
                        class="w-full px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-md focus:outline-none focus:ring focus:border-blue-300 dark:focus:border-blue-600 bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-gray-300">
                        <option value="all">{{ __('All Posts') }}</option>
                        <option value="following">{{ __('Following') }}</option>
                        <option value="not-following">{{ __('Not Following') }}</option>
                    </select>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 mt-6">
                <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label for="content" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Create
                            Post</label>
                        <textarea id="content" name="content" class="form-textarea mt-1 block w-full dark:bg-gray-700"></textarea>
                    </div>
                    <div class="mb-4">
                        <label for="image" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Upload
                            Image (Optional)</label>
                        <input type="file" id="image" name="image"
                            class="form-input mt-1 block w-full dark:bg-gray-700">
                    </div>
                    <div>
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-white dark:text-gray-800 dark:bg-gray-200 hover:bg-blue-600 dark:hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-gray-100 dark:focus:ring-offset-gray-600">
                            Post
                        </button>
                    </div>
                </form>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mt-6">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="mt-8" id="postsContainer">
                        <h3 class="text-lg font-medium mb-4">All Posts</h3>
                        @forelse ($posts as $post)
                            <div class="pb-4 mb-4 post">
                                <div class="flex items-center mb-2">
                                    <img src="{{ $post->user->profile_photo_url }}" alt="{{ $post->user->name }}"
                                        class="h-8 w-8 rounded-full mr-2">
                                    <span class="font-semibold">{{ $post->user->name }}</span>
                                </div>

                                @if ($post->image)
                                    <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image" class="mb-2">
                                @endif

                                {!! $post->content !!}
                                <div class="text-sm text-gray-500 dark:text-gray-400">Posted on
                                    {{ $post->created_at->format('M d, Y h:i A') }}</div>

                                <div class="flex items-center mt-2 space-x-4">
                                    @if ($post->likedBy(auth()->user()))
                                        <form action="{{ route('posts.unlike', $post) }}" method="POST"
                                            class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="text-blue-500 hover:text-blue-600 dark:text-blue-400 dark:hover:text-blue-500 focus:outline-none">
                                                Unlike
                                            </button>
                                        </form>
                                    @else
                                        <form action="{{ route('posts.like', $post) }}" method="POST"
                                            class="inline-block">
                                            @csrf
                                            <button type="submit"
                                                class="text-blue-500 hover:text-blue-600 dark:text-blue-400 dark:hover:text-blue-500 focus:outline-none">
                                                Like
                                            </button>
                                        </form>
                                    @endif

                                    <span class="text-gray-500 dark:text-gray-400">{{ $post->likes->count() }}
                                        {{ Str::plural('like', $post->likes->count()) }}</span>

                                    <div>
                                        @if ($post->user_id === auth()->id())
                                            <a href="{{ route('posts.edit', $post) }}"
                                                class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300 focus:outline-none">
                                                Edit
                                            </a>

                                            <form action="{{ route('posts.destroy', $post) }}" method="POST"
                                                class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="text-red-500 hover:text-red-600 dark:text-red-400 dark:hover:text-red-500 focus:outline-none">
                                                    Delete
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>

                                <div class="mt-4">
                                    <h4 class="text-sm font-medium mb-2">Comments</h4>
                                    @foreach ($post->comments as $comment)
                                        <div class="flex items-start mb-2 space-x-2">
                                            <img src="{{ $comment->user->profile_photo_url }}"
                                                alt="{{ $comment->user->name }}" class="h-6 w-6 rounded-full">
                                            <div class="flex-1 text-gray-500 dark:text-gray-400">
                                                {{ $comment->content }}</div>
                                            <div class="text-sm text-gray-500 dark:text-gray-400">
                                                {{ $comment->user->name }} on
                                                {{ $comment->created_at->format('M d, Y h:i A') }}
                                            </div>
                                            <div class="flex items-center space-x-1">
                                                @if ($comment->user_id === auth()->id() || $post->user_id === auth()->id())
                                                    <a href="{{ route('comments.edit', $comment) }}"
                                                        class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300 focus:outline-none">
                                                        Edit
                                                    </a>
                                                @endif

                                                @if ($comment->likedBy(auth()->user()))
                                                    <form action="{{ route('comments.unlike', $comment) }}"
                                                        method="POST" class="inline-block">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="text-blue-500 hover:text-blue-600 dark:text-blue-400 dark:hover:text-blue-500 focus:outline-none">
                                                            Unlike
                                                        </button>
                                                    </form>
                                                @else
                                                    <form action="{{ route('comments.like', $comment) }}"
                                                        method="POST" class="inline-block">
                                                        @csrf
                                                        <button type="submit"
                                                            class="text-blue-500 hover:text-blue-600 dark:text-blue-400 dark:hover:text-blue-500 focus:outline-none">
                                                            Like
                                                        </button>
                                                    </form>
                                                @endif

                                                <span
                                                    class="text-gray-500 dark:text-gray-400">{{ $comment->likes->count() }}
                                                    {{ Str::plural('like', $comment->likes->count()) }}</span>
                                            </div>
                                        </div>
                                    @endforeach

                                    <form action="{{ route('comments.store', $post) }}" method="POST" class="mt-2">
                                        @csrf
                                        <div class="flex space-x-2">

                                            <textarea name="content" rows="1"
                                                class="form-textarea flex-1 border-gray-300 dark:border-gray-600 focus:border-blue-300 focus:ring focus:ring-blue-200 dark:focus:ring-gray-600 dark:bg-gray-700 rounded-md shadow-sm"
                                                placeholder="Add a comment"></textarea>
                                            <button type="submit"
                                                class="px-4 py-2 bg-blue-500 text-white dark:text-gray-800 dark:bg-gray-200 hover:bg-blue-600 dark:hover:bg-gray-300 rounded-md focus:outline-none">
                                                Comment
                                            </button>
                                        </div>
                                    </form>
                                </div>

                            </div>

                            <hr class="my-6 border-gray-300 dark:border-gray-700">
                        @empty
                            <p class="text-gray-500 dark:text-gray-400">No posts available.</p>
                        @endforelse
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        CKEDITOR.replace('content');

        const searchInput = document.getElementById('search');
        const posts = document.querySelectorAll('.post');

        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase().trim();

            posts.forEach(post => {
                const postContent = post.textContent.toLowerCase();
                if (postContent.includes(searchTerm)) {
                    post.style.display = 'block';
                } else {
                    post.style.display = 'none';
                }
            });
        });

        const filterSelect = document.getElementById('filter');

        filterSelect.addEventListener('change', function() {
            const filterValue = this.value;

            posts.forEach(post => {
                const postOwner = post.querySelector('.font-semibold').textContent.trim();
                const isFollowing = post.querySelector('.text-blue-500');

                if (filterValue === 'all') {
                    post.style.display = 'block';
                } else if (filterValue === 'following') {
                    if (isFollowing) {
                        post.style.display = 'block';
                    } else {
                        post.style.display = 'none';
                    }
                } else if (filterValue === 'not-following') {
                    if (!isFollowing) {
                        post.style.display = 'block';
                    } else {
                        post.style.display = 'none';
                    }
                }
            });
        });
    </script>
</x-app-layout>
