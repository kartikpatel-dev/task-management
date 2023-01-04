<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(function() {
            $(".issue_title").on('keypress', function(e) {
                const key = e.which;
                if (key == 13) {
                    let project_slug = $(this).data('project-slug');
                    let project_id = $(this).data('project-id');
                    let status_id = $(this).data('status-id');
                    let issue_title = $(this).val();

                    $.ajax({
                        url: "<?php echo route('project-issues.store'); ?>",
                        type: 'POST',
                        data: {
                            project_slug: project_slug,
                            project_id: project_id,
                            status_id: status_id,
                            issue_title: issue_title,
                        },
                        dataType: 'JSON',
                        cache: false,
                        beforeSend: function() {},
                        success: function(response) {
                            console.log(response);
                        },
                        error: function(response) {},
                        complete: function(data) {}
                    });
                }
            });

            // $(".issue-sortable").sortable();
            $(".issue-sortable").sortable({
                connectWith: ".issue-sortable"
            }).disableSelection();
        });
    </script>
</body>

</html>
