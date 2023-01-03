@section('Title', (!empty($RS_Row) ? 'Edit' : 'Add') . ' Category')

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @yield('Title')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        @if (!empty($RS_Row))
                            @php $action = route('categories.update', $RS_Row->id); @endphp
                        @else
                            @php $action = route('categories.store'); @endphp
                        @endif

                        <form method="post" action="{{ $action }}" class="space-y-6">
                            @csrf
                            @if (!empty($RS_Row))
                                @method('patch')
                            @endif

                            <div>
                                <x-input-label for="name" :value="__('Name')" />
                                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                                    :value="old('name', $RS_Row->name ?? '')" required autofocus autocomplete="name" />
                                <x-input-error class="mt-2" :messages="$errors->get('name')" />
                            </div>

                            <div>
                                <x-input-label for="description" :value="__('Description')" />
                                <x-textarea id="description" name="description" class="mt-1 block w-full">
                                    {{ old('description', $RS_Row->description ?? '') }}
                                </x-textarea>
                                <x-input-error class="mt-2" :messages="$errors->get('description')" />
                            </div>

                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Save') }}</x-primary-button>
                                <x-secondary-button><a href="{{ route('categories.index') }}">{{ __('Back') }}</a>
                                </x-secondary-button>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
