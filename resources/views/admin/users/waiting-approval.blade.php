@extends('admin.layouts.app')

@section('Title', 'User Waiting Approval')

@section('content')

    <div class="row">
        <div class="col-md-12">
            @include('layouts.messages')

            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6 align-self-center">
                            <h4 class="card-title">@yield('Title')</h4>
                        </div>

                        <div class="col-md-6">
                            <a href="{{ route('admin.users.create') }}" class="btn btn-sm btn-info float-right">Add User</a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div id="data_list" class="table-full-width table-responsive"></div>
                </div>
            </div>
        </div>
    </div>

    @include('admin.layouts.delete_modal')
@endsection

@section('js')
    <script src="{{ asset('admin/js/crud.js') }}"></script>

    <script>
        jQuery(document).ready(function() {

            // first time page load fetch data
            fetch_data(0);

            // pagination start
            jQuery(document).on('click', '.pagination a', function(e) {
                e.preventDefault();
                var page = jQuery(this).attr('href').split('page=')[1];

                fetch_data(page);
            });

            function fetch_data(page) {
                // var searchKeryword = jQuery('#search_keryword').val();
                // var role = jQuery('#role').val();
                // var status = jQuery('input[name="status"]:radio:checked').val();

                // var urlUri = '&searchKeryword='+searchKeryword+'&role='+role+'&status='+status;

                jQuery.ajax({
                    url: "<?php echo route('admin.users.waiting.approval'); ?>?page=" + page,
                    cache: false,
                    beforeSend: function() {
                        // Show image container
                        jQuery("#loader").show();
                    },
                    success: function(response) {
                        jQuery('#data_list').html(response.users);
                        jQuery('html, body').animate({
                            scrollTop: 0
                        }, 'slow');
                    },
                    complete: function(data) {
                        // Hide image container
                        jQuery("#loader").hide();
                    }
                });
            }
            // pagination end
        });
    </script>
@endsection
