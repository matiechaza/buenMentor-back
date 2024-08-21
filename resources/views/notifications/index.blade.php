<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-12">
            <div class="px-4 py-5 sm:p-6 bg-white">
                <h2 class="text-2xl font-semibold mb-4">Notifications</h2>

                <ul class="list-disc pl-5">
                    @forelse ($notifications as $notification)
                        <li class="{{ $notification->read_at ? 'text-gray-500' : 'text-black' }}">
                            <a href="{{ route('notifications.read', $notification->id) }}">
                                {{ $notification->data['message'] ?? 'You have a new booking!' }}
                            </a>
                            <span class="text-sm text-gray-400">{{ $notification->created_at->diffForHumans() }}</span>
                        </li>
                    @empty
                        <li>No notifications found.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>
