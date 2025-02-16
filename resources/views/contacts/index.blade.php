@extends('layouts.app')

@section('content')
<h2>Contacts List</h2>
<a href="/contacts/create">Add New Contact</a>

<form action="/contacts/import" method="post" enctype="multipart/form-data">
    @csrf
    <input type="file" name="xml_file" required>
    <button type="submit">Import XML</button>
</form>

<table>
    <tr>
        <th>Name</th>
        <th>Phone</th>
        <th>Actions</th>
    </tr>
    @foreach ($contacts as $contact)
    <tr>
        <td>{{ $contact->name }}</td>
        <td>{{ $contact->phone }}</td>
        <td>
            <a href="/contacts/{{ $contact->id }}/edit">Edit</a>
            <form action="/contacts/{{ $contact->id }}" method="POST">
                @csrf @method('DELETE')
                <button type="submit">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
@endsection
