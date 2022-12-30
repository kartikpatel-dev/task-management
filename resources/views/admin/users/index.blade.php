@extends('admin.layouts.app')

@section('Title', 'Users List')

@php
    $qryString = explode('?', Request::fullUrl());
    $qryString = !empty($qryString[1]) ? '?' . $qryString[1] : null;
@endphp

@section('content')

    <div class="row">
        <div class="col-md-12">
            @include('admin.layouts.messages')

            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6 align-self-center">
                            <h4 class="card-title">Search By</h4>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <form method="GET" action="">

                        <div class="row align-items-end">
                            <div class="col-md-4 form-group">
                                <label for="search_keryword">{{ __('Search by') }}</label>
                                <input type="text" name="search_keryword" id="search_keryword"
                                    value="{{ old('search_keryword', request()->get('search_keryword')) }}"
                                    class="form-control{{ $errors->has('search_keryword') ? ' is-invalid' : '' }}"
                                    placeholder="Search..." autocomplete="off">
                            </div>

                            <div class="col-md-4 form-group">
                                <button type="submit" class="btn btn-success btn-fill">Search</button>

                                <a href="{{ route('admin.users.index') }}" class="btn btn-info">Reset Search</a>

                                <a href="{{ route('admin.users.pdf') . $qryString }}" target="_blank" class="btn btn-dark">{{ __('Print') }}</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-4 align-self-center">
                            <h4 class="card-title">@yield('Title')</h4>
                        </div>
                        <div class="col-md-4 align-self-center d-flex justify-content-center">
                            <h4 class="card-title text-info">{!! __('Total <span id="total_count"></span> User') !!}</h4>
                        </div>
                        <div class="col-md-4">
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
                const search_keryword = jQuery('#search_keryword').val();

                const urlUri = '&search_keryword=' + search_keryword;

                jQuery.ajax({
                    url: "<?php echo route('admin.users.index'); ?>?page=" + page + urlUri,
                    cache: false,
                    beforeSend: function() {
                        // Show image container
                        jQuery("#loader").show();
                    },
                    success: function(response) {
                        jQuery('#data_list').html(response.users);
                        jQuery('#total_count').html(response.total_count);
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

            // search start
            /* jQuery(document).on('keyup', '#search_keryword', function(e) {
                    e.preventDefault();
            
                    search_data();
                });
            
                jQuery("#role").change(function() {
                    search_data();
                });
            
                jQuery("input[name='status']:radio").change(function() {
                    search_data();
                }); */

            /* function search_data()
                {
                    var searchKeryword = jQuery('#search_keryword').val();
                    var role = jQuery('#role').val();
                    var status = jQuery('input[name="status"]:radio:checked').val();
                    // if( status==undefined) { status = ''; }
            
                    var urlUri = 'searchKeryword='+searchKeryword+'&role='+role+'&status='+status;
                    jQuery.ajax({
                        url: "<?php //echo route('admin.users.index');
                        ?>?"+urlUri,
                        cache: false,
                        beforeSend: function(){
                            // Show image container
                            jQuery("#loader").show();
                        },
                        success: function(response){
                            jQuery('#data_list').html(response.users);
                            // jQuery('html, body').animate({ scrollTop: 0 }, 'slow');
                        },
                        complete:function(data){
                            // Hide image container
                            jQuery("#loader").hide();
                        }
                    });
                } */
            // search end
        });
    </script>
@endsection
