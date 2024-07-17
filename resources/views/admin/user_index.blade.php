@extends('layouts.system')

@section('title')
<span>
	MANAGE USERS
</span>
@endsection

@section('content')

<a href="{{ route('user.create') }}" class="btn btn-primary">Add User</a>

<table class="table table-bordered">
	<tr>
		<th>#</th>
		<th>Name</th>
		<th>Email</th>
		<th>Phone</th>
		<th>Role</th>
		<th>Action</th>
	</tr>
	@php($i = 0)
	@foreach($users as $user)
	<tr>
		<td>{{ ++$i }}</td>
		<td>{{ $user->name }}</td>
		<td>{{ $user->email }}</td>
		<td>{{ $user->phone }}</td>
		<td>{{ $user->role }}</td>
		<td>
			<a href="" class="btn btn-sm btn-primary">Edit</a>
		</td>
	</tr>
	@endforeach
</table>
@endsection