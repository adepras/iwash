@extends('admin.layouts.admin-app')

@section('title', 'Admin | Data Pelanggan')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">

    <div class="container">
        <h4>Daftar Pelanggan</h4>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>
                        <a href="{{ route('admin.menu.users', ['sortOrder' => $sortOrder === 'asc' ? 'desc' : 'asc']) }}">
                            Nama
                            @if ($sortOrder === 'asc')
                                <img src="/image/arrow-up.svg" alt="">
                            @else
                                <img src="/image/arrow-down.svg" alt="">
                            @endif
                        </a>
                    </th>
                    <th>Nomor Telepon</th>
                    <th>Email</th>
                    <th>Alamat</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $index => $user)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->phone_number }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->address }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
