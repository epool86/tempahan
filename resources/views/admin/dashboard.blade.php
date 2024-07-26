@extends('layouts.system')

@section('top_script')
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
@endsection

@section('title')
<span>
	DASHBOARD
</span>
@endsection

@section('content')
<div class="row">

	<div class="col-md-3">
		<div class="card bg-primary text-white">
			<div class="card-body" style="height: 130px;">
				<center>
					<h1>{{ $total_booking }}</h1>
					Total Booking
				</center>
			</div>
		</div>
	</div>

	<div class="col-md-3">
		<div class="card bg-warning text-white">
			<div class="card-body" style="height: 130px;">
				<center>
					<h1>{{ $total_booking_pending }}</h1>
					Total Pending
				</center>
			</div>
		</div>
	</div>

	<div class="col-md-3">
		<div class="card bg-success text-white">
			<div class="card-body" style="height: 130px;">
				<center>
					<h1>{{ $total_booking_approved }}</h1>
					Total Approved
				</center>
			</div>
		</div>
	</div>

	<div class="col-md-3">
		<div class="card bg-info text-white">
			<div class="card-body" style="height: 130px;">
				<center>
					<h1>{{ $total_user }}</h1>
					Total Users
				</center>
			</div>
		</div>
	</div>
	
</div>

<br>

<div class="row">
	<div class="col-md-9">
		<div class="card">
			<div class="card-body">
				<div id="my_chart" style="height:200px;"></div>
			</div>
		</div>
	</div>
	<div class="col-md-3">
		<div class="card">
			<div class="card-body">
				<div id="my_chart_2" style="height:200px;"></div>
			</div>
		</div>
	</div>
</div>

<br>

<table class="table table-bordered">
	<tr>
		<th>#</th>
		<th>User Name</th>
		<th>Room Name</th>
		<th>Date</th>
		<th>Status</th>
		<th>Submitted At</th>
	</tr>
	@php($i = 0)
	@foreach($latest as $booking)
	<tr>
		<td>{{ ++$i }}</td>
		<td>
			@if($booking->user)
				{{ $booking->user->name }}
			@endif
		</td>
		<td>
			@if($booking->room)
				{{ $booking->room->name }}
			@endif
		</td>
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
			{{ $booking->created_at->format('d F Y h:i:s') }}<br>
			{{ $booking->created_at->diffForHumans() }}
		</td>
	</tr>
	@endforeach
</table>


@endsection

@section('bottom_script')
<script type="text/javascript">
	
new Morris.Bar({
  // ID of the element in which to draw the chart.
  element: 'my_chart',
  // Chart data records -- each entry in this array corresponds to a point on
  // the chart.
  data: [
    <?php foreach($graph as $data){ ?>
    { month: '<?php echo $data['month_name']; ?>', value: <?php echo $data['total_booking']; ?> },
	<?php } ?>
  ],
  // The name of the data record attribute that contains x-values.
  xkey: 'month',
  // A list of names of data record attributes that contain y-values.
  ykeys: ['value'],
  // Labels for the ykeys -- will be displayed when you hover over the
  // chart.
  labels: ['Value']
});

new Morris.Donut({
	element: 'my_chart_2',
	data: [
		{ label: 'Pending', value: {{ $total_booking_pending }} },
		{ label: 'Approved', value: {{ $total_booking_approved }} },
	],
	colors: ['#dbb732','#1a9140'],
});

</script>
@endsection