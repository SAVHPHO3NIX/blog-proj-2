<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Your Comments') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="mt-8">
                        <h3 class="text-lg font-medium mb-4">Your Comments</h3>
                        @forelse ($comments as $comment)
                            <div class="border-b border-gray-200 dark:border-gray-600 pb-4 mb-4">
                                <div class="text-gray-700 dark:text-gray-300">{{ $comment->content }}</div>
                                <div class="text-sm text-gray-500 dark:text-gray-400">Commented on
                                    {{ $comment->created_at->format('M d, Y h:i A') }}</div>

                                <!-- Action Buttons (Edit, Delete) -->
                                <div class="flex items-center mt-2 space-x-4">
                                    <form action="{{ route('comments.destroy', $comment) }}" method="POST"
                                        class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="text-red-500 hover:text-red-600 dark:text-red-400 dark:hover:text-red-500 focus:outline-none">
                                            Delete
                                        </button>
                                    </form>

                                    <a href="{{ route('comments.edit', $comment) }}"
                                        class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300 focus:outline-none">
                                        Edit
                                    </a>

                                    @if ($comment->likedBy(auth()->user()))
                                        <form action="{{ route('comments.unlike', $comment) }}" method="POST"
                                            class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="text-blue-500 hover:text-blue-600 dark:text-blue-400 dark:hover:text-blue-500 focus:outline-none">
                                                Unlike
                                            </button>
                                        </form>
                                    @else
                                        <form action="{{ route('comments.like', $comment) }}" method="POST"
                                            class="inline-block">
                                            @csrf
                                            <button type="submit"
                                                class="text-blue-500 hover:text-blue-600 dark:text-blue-400 dark:hover:text-blue-500 focus:outline-none">
                                                Like
                                            </button>
                                        </form>
                                    @endif
                                    <span class="text-gray-500 dark:text-gray-400">{{ $comment->likes->count() }}
                                        {{ Str::plural('like', $comment->likes->count()) }}</span>
                                </div>
                            </div>
                        @empty
                            <p class="text-gray-500 dark:text-gray-400">You haven't commented on any posts yet.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
