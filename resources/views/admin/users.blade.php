@extends('admin.dashboard')

@section('content')
    <main class="h-full overflow-y-auto">
        <div class="container px-6 mx-auto grid">
            <div class="flex flex-row">
                <!--Header -->
                <h2 class="px-4 py-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                    USERS
                </h2>
                <div class="float-right">
                    <a href="{{ route('register')}}">
                        <button class="float-right px-4 py-2 mt-5 text-m font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                        New User
                        </button>
                    </a>                    
                </div>
            </div>

            <!-- Cards -->
            <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4">
                <!-- Card -->
                <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                    <div
                        class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full dark:text-orange-100 dark:bg-orange-500">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                            No. of  users
                        </p>
                        <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                            {{$users->count()}}
                        </p>
                    </div>
                </div>               
            </div>

            <!-- Table -->
            <div class="w-full overflow-hidden rounded-lg shadow-xs">
                <div class="w-full overflow-x-auto">
                    <table class="w-full whitespace-no-wrap">
                        <thead>
                            <tr
                                class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                <th class="px-4 py-3">Date Added</th>
                                <th class="px-4 py-3">Name</th>
                                <th class="px-4 py-3">Email</th>
                                <th class="px-4 py-3">Admin</th>
                                <th class="px-4 py-3">Delete</th>
                            </tr>
                        </thead>
                        
                        <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                            @foreach ($users as $user)
                                <tr class="text-gray-700 dark:text-gray-400">
                                    <td class="px-4 py-3 text-xs">
                                        {{  ($user->created_at)->diffForHumans()  }}
                                    </td>
                                    
                                    <td class="px-4 py-3 text-sm">
                                        {{$user->name}}
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        {{$user->email}}
                                    </td>
                                    @if ($user->admin)
                                    <td>
                                        <form action="{{ route('admin.adminuser', ['id' => $user->id]) }}" method="post" onsubmit="return confirm('Click okay to revoke admin priviledges')">
                                            @csrf
                                            <button type="submit" class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-full dark:text-red-100 dark:bg-red-700">Revoke Admin</button>
                                        </form>
                                    </td>
                                    @else
                                    <td>
                                        <form action="{{ route('admin.adminuser', ['id' => $user->id]) }}" method="post" onsubmit="return confirm('Click okay to add admin priviledge to user')">
                                            @csrf
                                            <button type="submit" class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">Make Admin</button>
                                        </form>
                                    </td>
                                    @endif                                   
                                    <td class="px-4 py-3 text-sm">
                                        <form action="{{ route('admin.userdelete', ['id' => $user->id]) }}" method="post" onsubmit="return confirm('Click okay to delete this user')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-full dark:text-red-100 dark:bg-red-700">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
@endsection
