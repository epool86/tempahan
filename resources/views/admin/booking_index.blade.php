@extends('layouts.system')

@section('title')
<span>
	MANAGE BOOKING
</span>
@endsection

@section('content')

<div class="row">
	<div class="col-md-3">
		<select class="form-control mb-2" name="room_id" id="room_id" onchange="filter()">
			<option @if($room_id == "ALL") selected @endif value="ALL">All Room</option>
			@foreach($rooms as $room)
				<option @if($room_id == $room->id) selected @endif value="{{ $room->id }}">{{ $room->name }}</option>
			@endforeach
		</select>
	</div>
	<div class="col-md-3">
		<select class="form-control mb-2" name="month" id="month" onchange="filter()">
			<option @if($month == "ALL") selected @endif value="ALL">All Month</option>
			<option @if($month == 1)  selected @endif value="1" >January</option>
			<option @if($month == 2)  selected @endif value="2" >February</option>
			<option @if($month == 3)  selected @endif value="3" >March</option>
			<option @if($month == 4)  selected @endif value="4" >April</option>
			<option @if($month == 5)  selected @endif value="5" >May</option>
			<option @if($month == 6)  selected @endif value="6" >June</option>
			<option @if($month == 7)  selected @endif value="7" >July</option>
			<option @if($month == 8)  selected @endif value="8" >August</option>
			<option @if($month == 9)  selected @endif value="9" >September</option>
			<option @if($month == 10) selected @endif value="10">October</option>
			<option @if($month == 11) selected @endif value="11">November</option>
			<option @if($month == 12) selected @endif value="12">December</option>
		</select>
	</div>
	<div class="col-md-3">
		<select class="form-control mb-2" name="year" id="year" onchange="filter()">
			<option @if($year == "ALL") selected @endif value="ALL">All Year</option>
			<option @if($year == 2023) selected @endif value="2023">2023</option>
			<option @if($year == 2024) selected @endif value="2024">2024</option>
			<option @if($year == 2025) selected @endif value="2025">2025</option>
		</select>
	</div>
	<div class="col-md-3">
		<input type="text" class="form-control" name="search" id="search" onkeyup="search()">
	</div>
</div>

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

{!! $bookings->appends($_GET)->render() !!}

<script type="text/javascript">

	function filter(){

		var room_id = document.getElementById("room_id").value;
		var month = document.getElementById("month").value;
		var year = document.getElementById("year").value;
		var search = document.getElementById("search").value;

		self.location = "?room_id=" + room_id + "&month=" + month + "&year=" + year + "&search=" + search;

	}

	function search(){

		
	}

</script>

@endsection