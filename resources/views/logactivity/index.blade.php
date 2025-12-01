@extends('layout.app')

@section('content')
    <h3 class="mb-4">log Activity</h3>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>username</th>
                <th>activity</th>
                <th>waktu</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($logs as $log)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $log->username }}</td>
                    <td>{{ $log->activity }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
