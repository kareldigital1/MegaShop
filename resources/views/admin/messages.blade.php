@extends('base')

@section('title', 'Messages')

@section('content')
    <div class="d-flex min-vh-100" style="background-color: white;">
        @include('Admin.sidebar')
        <div class="container-fluid">
            <h1>Gestion des Messages</h1>
            <p>Liste des messages reçus des clients.</p>

            <div class="table-responsive bg-white rounded shadow-sm">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Nom</th>
                            <th>Email</th>
                            <th>Message</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($messages as $message)
                            <tr>
                                <td>{{ $message->name }}</td>
                                <td>{{ $message->email }}</td>
                                <td>{{ $message->content }}</td>
                                <td>{{ $message->created_at->format('d/m/Y H:i') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
