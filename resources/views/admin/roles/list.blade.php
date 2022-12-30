<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6 align-self-center">
                <h4 class="card-title">{!! __('Total <b>' . $RS_Results->total() . '</b> results') !!}</h4>
            </div>
            @if (Route::has('admin.roles.create'))
                <div class="col-md-6">
                    <a href="{{ route('admin.roles.create') }}" class="btn btn-sm btn-info float-right">Add Role</a>
                </div>
            @endif
        </div>
    </div>

    <div class="card-body">
        @if ($RS_Results->total())
            <table class="table table-hover table-striped table-bordered">
                <thead class="thead-dark">
                    <th width="45%">Name</th>
                    <th width="45%">Slug</th>
                    <th width="10%">
                        <center>Action</center>
                    </th>
                </thead>
                <tbody>
                    @forelse($RS_Results as $RS_Row)
                        <tr class="delete-{{ $RS_Row->id }}">
                            <td>{{ $RS_Row->name }}</td>
                            <td>{{ $RS_Row->slug }}</td>
                            <td>
                                <center>
                                    <a href="{{ route('admin.roles.edit', $RS_Row->id) }}" title="Edit"
                                        class="btn btn-xs btn-primary mx-2"><i class="fas fa-edit"></i></a>

                                    <a href="javascript:;" title="Delete" data-toggle="modal"
                                        data-target="#ajaxModelDelete" data-title="Role" data-id="{{ $RS_Row->id }}"
                                        data-url="{{ route('admin.roles.destroy', $RS_Row->id) }}"
                                        class="btn btn-xs btn-danger delete"><i class="fas fa-trash"></i></a>
                                </center>
                            </td>
                        </tr>
                    @empty
                    @endforelse
                </tbody>
            </table>

            {!! $RS_Results->onEachSide(1)->links('pagination::bootstrap-5') !!}
        @else
            <p>{{ __('No data found.') }}</p>
        @endif

    </div>
</div>
