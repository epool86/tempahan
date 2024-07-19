@extends('layouts.system')

@section('title')
<span>
	MANAGE BOOKING
</span>
@endsection

@section('content')

<table class="table table-bordered">
	<tr>
		<th>#</th>
		<th>User Name</th>
		<th>Room Name</th>
		<th>Date</th>
		<th>Status</th>
		<th>Action</th>
	</tr>
	@php($i = ($bookings->currentPage() - 1) * $bookings->perPage())
	@foreach($bookings as $booking)
	<tr>
		<td>{{ ++$i }}</td>
		<td>{{ $booking->user->name }}</td>
		<td>{{ $booking->room->name }}</td>
		<td>{{ $booking->booking_date }}</td>
		<td>
			@if($booking->status == 0)
				<span class="badge bg-warning">Pending</span>
			@elseif($booking->status == 1)
				<span class="badge bg-success">Approved</span>
			@elseif($booking->status == 2)
				<span class="badge bg-danger">Rejected</span>
			@endif
		</td>
		<td>
			@if($booking->status == 0)
			<form method="POST" action="{{ route('admin.booking.update', $booking->id) }}">
				<input type="hidden" name="_method" value="PUT">
				@csrf
				<button type="submit" name="action" value="approve" class="btn btn-success btn-sm" onclick="return confirm('Are you sure to approve this booking?');">
					Approve
				</button>
				<button type="submit" name="action" value="reject" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure to reject this booking?');">
					Reject
				</button>
			</form>
			@endif
		</td>
	</tr>
	@endforeach
</table>

{!! $bookings->render() !!}

@endsection