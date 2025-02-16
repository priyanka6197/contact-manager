<?php 
@extends('layouts.app')

@section('content')
<h2>Add Contact</h2>
<form action="/contacts" method="POST">
    @csrf
    <input type="text" name="name" placeholder="Name" required>
    <input type="text" name="phone" placeholder="Phone" required>
    <button type="submit">Save</button>
</form>
@endsection
