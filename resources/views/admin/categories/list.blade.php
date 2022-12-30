<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6 align-self-center">
                <h4 class="card-title">{!! __('Total <b>' . $RS_Results->total() . '</b> results') !!}</h4>
            </div>
            @if (Route::has('admin.categories.create'))
                <div class="col-md-6">
                    <a href="{{ route('admin.categories.create') }}" class="btn btn-sm btn-info float-right">Add
                        Category</a>
                </div>
            @endif
        </div>
    </div>

    <div class="card-body">
        @if ($RS_Results->total())
            <table class="table table-hover table-striped table-bordered">
                <thead class="thead-dark">
                    <th width="45%">Name</th>
                    <th width="40%">Parent</th>
                    <th width="5%">Count</th>
                    <th width="10%">
                        <center>Action</center>
                    </th>
                </thead>
                <tbody>
                    @forelse($RS_Results as $RS_Row)
                        <tr class="delete-{{ $RS_Row->id }}">
                            <td>{{ $RS_Row->name }}</td>
                            <td>{{ !empty($RS_Row->parent_id) ? $RS_Row->parents->pluck('name')->implode(', ') : '-' }}
                            </td>
                            <td>{{ $RS_Row->parent_id }}</td>
                            <td>
                                <center>
                                    <a href="{{ route('admin.categories.edit', $RS_Row->id) }}" title="Edit"
                                        class="btn btn-xs btn-primary mx-2"><i class="fas fa-edit"></i></a>

                                    <a href="javascript:;" title="Delete" data-toggle="modal"
                                        data-target="#ajaxModelDelete" data-title="Category"
                                        data-id="{{ $RS_Row->id }}"
                                        data-url="{{ route('admin.categories.destroy', $RS_Row->id) }}"
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
