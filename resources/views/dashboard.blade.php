<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="flex items-start justify-between py-12 max-w-7xl mx-auto">
        <div class="w-2/3 mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="shadow overflow-scroll border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Target</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Shortlink</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Visits</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($links as $link)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $link->id }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $link->target }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <a href="{{ $link->url() }}" target="_blank" class="underline text-blue-400">{{ $link->url() }}</a>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            @if($link->type === 'track')
                                                {{ $link->visits ?: 0 }}
                                            @else
                                                &mdash;
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-1/3 mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('create') }}" method="POST">
                        @csrf
                        <x:label for="target" class="mb-4 text-base">Target</x:label>
                        <x:input type="url" name="target" value="{{ old('target') }}" class="w-full mb-4" />
                        @error('target')
                            <p class="text-red-600 mb-2">{{ $message }}</p>
                        @enderror


                        <x:label for="type" class="mb-4 text-base">Type</x:label>

                        <div class="space-x-4 text-gray-700">
                            <label class="space-x-2">
                                <input type="radio" name="type" value="track">
                                <span>Tracking</span>
                            </label>
                            <label class="space-x-2">
                                <input type="radio" name="type" value="anon">
                                <span>Anonymous</span>
                            </label>
                        </div>

                        @error('type')
                            <p class="text-red-600 mt-2">{{ $message }}</p>
                        @enderror

                        <x:button class="mt-4">Create</x:button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
