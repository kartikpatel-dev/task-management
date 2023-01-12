<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <a href="{{ route('projects.index') }}"
                class="hover:text-gray-700 hover:border-gray-300">{{ __('Project') }}</a> / {{ $RS_Row->name }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <header>
                <h2 class="text-3xl text-gray-900">
                    {{ $RS_Row->slug . ' ' . __('Issues') }}
                </h2>
            </header>

            @if ($RS_Row->statuses->count() > 0)
                <ul class="status_list lg:gap-4 sm:gap-8 grid grid-cols-12 col-span-10 col-start-2 gap-3">
                    @foreach ($RS_Row->statuses as $RS_Row_Status)
                        <li
                            class="status_item bg-white shadow-sm sm:rounded-lg pb-4 group mb-6 md:md-0 col-span-12 sm:col-span-6 lg:col-span-3 group-link-underline">
                            <h3 class="status_item_heading bg-gray-200 text-lg py-1 px-2 font-bold">
                                {{ $RS_Row_Status->name }}
                                <span
                                    class="issue_count {{ Str::slug($RS_Row_Status->name) }}">{{ $RS_Row_Status->projectIssues->count() == 0 ? __('0 issue') : ($RS_Row_Status->projectIssues->count() == 1 ? __('1 issue') : $RS_Row_Status->projectIssues->count() . __(' issues')) }}</span>
                            </h3>

                            <div class="issue-sortable issue_list px-4 pt-3 status_{{ $RS_Row_Status->id }}"
                                data-class="{{ Str::slug($RS_Row_Status->name) }}"
                                data-status-id="{{ $RS_Row_Status->id }}">
                                @if ($RS_Row_Status->projectIssues->count() > 0)
                                    @foreach ($RS_Row_Status->projectIssues as $RS_Row_ProIssue)
                                        @if ($RS_Row->id == $RS_Row_ProIssue->project_id)
                                            @include('projects.issue_item')
                                        @endif
                                    @endforeach
                                @endif
                            </div>

                            <div class="issue_item create_issue_main bg-gray-200 mt-3 px-4 pt-2 pb-3" data-project-id="{{ $RS_Row->id }}">
                                <div class="create_issue_tile">{{ __('+ Create issue') }}</div>
                                <div class="create_issue_form">
                                    <x-textarea data-project-id="{{ $RS_Row->id }}"
                                        data-project-slug="{{ $RS_Row->slug }}"
                                        data-status-id="{{ $RS_Row_Status->id }}" id="issue_title"
                                        class="issue_title mt-1 block w-full"></x-textarea>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</x-app-layout>
