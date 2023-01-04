<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Project') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div
            class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-4 flex {{ Session::has('messageType') ? 'justify-between' : 'justify-end' }}">
            @if (Session::has('messageType'))
                <p class="text-sm text-gray-600">
                    <span x-data="{ show: true }" x-show="show" x-transition
                        x-init="setTimeout(() => show = false, 2000)">{!! Session::get('message') !!}</span>
                </p>
            @endif

            <a href="{{ route('projects.create') }}"
                class="bg-white py-1 px-2 flex justify-end">{{ __('Add Project') }}</a>
        </div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
                <table width="100%" class="border">
                    <thead>
                        <tr>
                            <th class="border p-2">{{ __('Name') }}</th>
                            <th class="border p-2">{{ __('Slug') }}</th>
                            <th class="border p-2">{{ __('Lead') }}</th>
                            <th class="border p-2">{{ __('Category') }}</th>
                            <th class="border p-2">{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($RS_Results->total())
                            @foreach ($RS_Results as $RS_Row)
                                <tr class="border">
                                    <td class="border p-2">{{ $RS_Row->name }}</td>
                                    <td class="border p-2">{{ $RS_Row->slug }}</td>
                                    <td class="border p-2">{{ $RS_Row->user_id }}</td>
                                    <td class="border p-2">{{ $RS_Row->category->name ?? '' }}</td>
                                    <td class="border p-2">
                                        <center>
                                            <x-primary-button class="mr-2"><a
                                                    href="{{ route('projects.edit', $RS_Row->id) }}"
                                                    title="Edit">{{ __('Edit') }}</a>
                                            </x-primary-button>

                                            <x-danger-button x-data=""
                                                x-on:click.prevent="$dispatch('open-modal', 'confirm-deletion-{{ $RS_Row->id }}')">
                                                {{ __('Delete') }}</x-danger-button>

                                            <x-modal name="confirm-deletion-{{ $RS_Row->id }}" focusable>
                                                <form method="post"
                                                    action="{{ route('projects.destroy', $RS_Row->id) }}"
                                                    class="p-6">
                                                    @csrf
                                                    @method('delete')

                                                    <h2 class="text-lg font-medium text-gray-900">
                                                        {{ $RS_Row->name }}
                                                    </h2>

                                                    <p class="mt-1 text-sm text-gray-600">
                                                        {{ $RS_Row->description }}
                                                    </p>

                                                    <div class="mt-6 flex justify-end">
                                                        <x-secondary-button x-on:click="$dispatch('close')">
                                                            {{ __('Cancel') }}
                                                        </x-secondary-button>

                                                        <x-danger-button class="ml-3">
                                                            {{ __('Delete') }}
                                                        </x-danger-button>
                                                    </div>
                                                </form>
                                            </x-modal>

                                            <x-info-button class="mr-2"><a
                                                    href="{{ route('projects.show', $RS_Row->id) }}"
                                                    title="Issue">{{ __('Issue') }}</a>
                                            </x-info-button>
                                        </center>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>

                {!! $RS_Results->onEachSide(1)->links('pagination::bootstrap-5') !!}
            </div>
        </div>
    </div>
</x-app-layout>
