<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}

                    @if(auth()->user()->isAdmin())
                        <!-- Секция для админа -->
                        <div class="mt-8">
                            <h3 class="text-lg font-semibold mb-4">User Management</h3>

                            @if($users->count() > 0)
                                <div class="overflow-x-auto">
                                    <table class="min-w-full bg-white">
                                        <thead>
                                        <tr>
                                            <th class="px-4 py-2 border">ID</th>
                                            <th class="px-4 py-2 border">Name</th>
                                            <th class="px-4 py-2 border">Email</th>
                                            <th class="px-4 py-2 border">Role</th>
                                            <th class="px-4 py-2 border">Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($users as $user)
                                            <tr>
                                                <td class="px-4 py-2 border">{{ $user->id }}</td>
                                                <td class="px-4 py-2 border">{{ $user->name }}</td>
                                                <td class="px-4 py-2 border">{{ $user->email }}</td>
                                                <td class="px-4 py-2 border">
                                                    @if($user->isAdmin())
                                                        <span class="bg-red-100 text-red-800 px-2 py-1 rounded text-xs">Admin</span>
                                                    @else
                                                        <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded text-xs">User</span>
                                                    @endif
                                                </td>
                                                <td class="px-4 py-2 border">
                                                    @if($user->isAdmin())
                                                        @if($user->id === auth()->id())
                                                            <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-xs">Current session</span>
                                                        @else
                                                            <span class="text-gray-400 text-sm">Admin account</span>
                                                        @endif
                                                    @else
                                                        <form method="POST"
                                                              action="{{ route('admin.user-imitation', $user) }}"
                                                        >
                                                            @csrf
                                                            <button type="submit" class="bg-green-500 hover:bg-green-700 text-white px-3 py-1 rounded text-sm">
                                                                Login as User
                                                            </button>
                                                        </form>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <p class="text-gray-500">No users found.</p>
                            @endif
                        </div>
                    @else
                        <!-- User Section -->
                        <div class="mt-8">
                            <h3 class="text-lg font-semibold mb-4">Your Account</h3>
                            <p>Welcome to your personal dashboard!</p>
                            <div class="mt-4 p-4 bg-gray-50 rounded">
                                <p><strong>Name:</strong> {{ auth()->user()->name }}</p>
                                <p><strong>Email:</strong> {{ auth()->user()->email }}</p>
                                <p><strong>Role:</strong> User</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
