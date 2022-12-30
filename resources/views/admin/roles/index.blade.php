@extends('admin.layouts.app')

@section('Title', 'Role List')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div id="data_list" class="table-full-width table-responsive"></div>
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
                const search_keryword = jQuery('#search_keryword').val();

                const urlUri = '&search_keryword=' + search_keryword;

                jQuery.ajax({
                    url: "<?php echo Request::url(); ?>?page=" + page + urlUri,
                    cache: false,
                    beforeSend: function() {
                        // Show image container
                        jQuery("#loader").show();
                    },
                    success: function(response) {
                        jQuery('#data_list').html(response.RS_Results);
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
