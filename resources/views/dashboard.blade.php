<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 max-w-7xl mx-auto">
        {{-- <div class="max-w-7xl mx-auto sm:px-6 lg:px-8"> --}}
        <div class="lg:gap-16 sm:gap-8 grid grid-cols-4 col-span-10 col-start-2 gap-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 text-center max-w-sm text-2xl font-bold leading-tight">
                    <a href="{{ route('categories.index') }}">{{ __("Category") }}</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
