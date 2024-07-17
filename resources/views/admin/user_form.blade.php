@extends('layouts.system')

@section('title')
<span>
	USER INFORMATION
</span>
@endsection

@section('content')
<form method="POST" action="{{ route('user.store') }}">
	@csrf

	<div class="mb-3">
		<label for="">Name</label>
		<input type="text" class="form-control" name="name" id="" value="{{ old('name') }}">
		@error('name')
		<span class="text-danger">{{ $message }}</span>
		@enderror
	</div>

	<div class="mb-3">
		<label for="">Email</label>
		<input type="text" class="form-control" name="email" id="" value="{{ old('email') }}">
		@error('email')
		<span class="text-danger">{{ $message }}</span>
		@enderror
	</div>

	<div class="mb-3">
		<label for="">Phone</label>
		<input type="text" class="form-control" name="phone" id="" value="{{ old('phone') }}">
		@error('phone')
		<span class="text-danger">{{ $message }}</span>
		@enderror
	</div>

	<div class="mb-3">
		<label for="">Role</label>
		<select class="form-control" name="role" id="">
			<option value="user">User</option>
			<option value="admin">Admin</option>
		</select>
		@error('role')
		<span class="text-danger">{{ $message }}</span>
		@enderror
	</div>

	<div class="mb-3">
		<label for="">Password</label>
		<input type="text" class="form-control" name="password">
		@error('password')
		<span class="text-danger">{{ $message }}</span>
		@enderror
	</div>

	<div class="mb-3">
		<label for="">Confirm Password</label>
		<input type="text" class="form-control" name="password_confirmation">
		@error('password_confirmation')
		<span class="text-danger">{{ $message }}</span>
		@enderror
	</div>

	<div class="mb-3">
		<button type="submit" class="btn btn-primary">Save</button>
	</div>

</form>
@endsection