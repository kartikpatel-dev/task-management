<style type="text/css">
    h1,
    h2 {
        text-align: center;
    }

    table {
        width: 100%;
    }

    table td,
    table th {
        border: 1px solid black;
        border-collapse: collapse;
        padding: 8px;
    }
</style>
<h1>{{ config('app.name', 'Laravel') }}</h1>
<h2>{{ __('User List') }}</h2>
<table cellspacing="0">
    <thead class="thead-dark">
        <th>Name</th>
        <th>Email ID</th>
        <th>Mobile Number</th>
        <th>City</th>
        <th>Status</th>
    </thead>
    <tbody>
        @forelse($RS_Results as $user)
            <tr class="delete-{{ $user->id }}">
                <td>{{ $user->full_name }}</td>
                <td>{{ $user->email }}</td>
                <td>({{ $user->dial_code ?? 91 }}) {{ $user->mobile_number }}</td>
                <td>{{ $user->city }}</td>
                <td>
                    <center>
                        {{ $user->status }}
                    </center>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5">No data found.</td>
            </tr>
        @endforelse
    </tbody>
</table>
