
@extends('layouts.app')

@section('content')
<h2>Edit Contact</h2>
<form action="/contacts/{{ $contact->id }}" method="POST">
    @csrf @method('PUT')
    <input type="text" name="name" value="{{ $contact->name }}" required>
    <input type="text" name="phone" value="{{ $contact->phone }}" required>
    <button type="submit">Update</button>
</form>
@endsection
