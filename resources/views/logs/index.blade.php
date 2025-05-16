@extends('layouts.app')
@section('title', 'Activity Logs')

@section('content')
<h4 class="text-white mb-4">Activity Logs</h4>

<table class="table table-bordered bg-white">
    <thead class="table-dark">
        <tr>
            <th>User</th>
            <th>Action</th>
            <th>Details</th>
            <th>Timestamp</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($logs as $log)
            <tr>
                <td>{{ $log->user->name ?? 'Unknown' }}</td>
                <td>{{ $log->action }}</td>
                <td>{{ $log->details }}</td>
                <td>{{ $log->created_at->format('Y-m-d H:i') }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="4" class="text-center">No logs found.</td>
            </tr>
        @endforelse
    </tbody>
</table>

<div class="d-flex justify-content-center mt-3">
    {{ $logs->links('pagination::bootstrap-5') }}
</div>
@endsection
