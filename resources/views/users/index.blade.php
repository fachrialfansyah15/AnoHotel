<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users - AnoHotel</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 min-h-screen p-8">

<div class="max-w-7xl mx-auto">

    <div class="flex justify-between items-center mb-8">

        <div>
            <h1 class="text-4xl font-bold text-blue-700">
                Users
            </h1>

            <p class="text-gray-500 mt-2">
                User management system
            </p>
        </div>

        @can('manage-users')

<a href="{{ route('users.create') }}" class="btn">
    + Add User
</a>

@endcan

    </div>

    <div class="bg-white rounded-3xl shadow-xl overflow-hidden">

        <table class="w-full">

            <thead class="bg-blue-700 text-white">

                <tr>
                    <th class="text-left p-5">Name</th>
                    <th class="text-left p-5">Email</th>
                    <th class="text-left p-5">Role</th>
                    <th class="text-left p-5">Action</th>
                </tr>

            </thead>

            <tbody>

                @forelse($users as $user)

                <tr class="border-b hover:bg-gray-50">

                    <td class="p-5">
                        {{ $user->name }}
                    </td>

                    <td class="p-5">
                        {{ $user->email }}
                    </td>

                    <td class="p-5">

                        <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm capitalize">
                            {{ $user->role }}
                        </span>

                    </td>

                    <td class="p-5 flex gap-3">

                        @can('admin-only')

                        <a
                            href="{{ route('users.edit', $user->id) }}"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg"
                        >
                            Edit
                        </a>

                        <form
                            action="{{ route('users.destroy', $user->id) }}"
                            method="POST"
                        >
                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg"
                            >
                                Delete
                            </button>

                        </form>

                        @endcan

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="4" class="text-center py-10 text-gray-500">
                        No users found
                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

</body>
</html>