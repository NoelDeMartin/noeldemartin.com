@extends('layouts.master')

@section('styles')
	<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.3/css/jquery.dataTables.min.css">
	<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/plug-ins/a5734b29083/integration/bootstrap/3/dataTables.bootstrap.css">
@stop

@section('content')
	<h1>Posts</h1>
	<table id="posts" class="table">
		<thead>
			<tr>
				<th>Title</th>
				@if (Auth::check() && Auth::user()->is_admin)
					<th></th>
				@endif
				<th>Publication Date</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($posts as $post)
				<tr>
					<td>{{HTML::linkRoute('posts.show', $post->title, $post->id) }}</td>
					@if (Auth::check() && Auth::user()->is_admin)
						<td>{{HTML::linkRoute('posts.edit', 'edit', $post->id) }}</td>
					@endif
					<td data-order="{{ $post->published_at->timestamp }}">
						@if ($post->isPublished())
							{{ $post->published_at->toFormattedDateString() }}
						@else
							{{ $post->published_at->toFormattedDateString() }} (Not Published)
						@endif
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	@if (Auth::check() && Auth::user()->is_admin)
		{{ HTML::linkRoute('posts.create', 'New Post', [], ['class' => 'btn btn-lg btn-primary', 'role' => 'button']) }}
	@endif
@stop

@section('scripts')
	<script src="//cdn.datatables.net/1.10.3/js/jquery.dataTables.min.js"></script>
	<script src="//cdn.datatables.net/plug-ins/a5734b29083/integration/bootstrap/3/dataTables.bootstrap.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('#posts').DataTable({
				'aaSorting': [[{{ Auth::check() && Auth::user()->is_admin? 2 : 1}},'desc']],
				fnDrawCallback: function(oSettings) {
					if (oSettings.aiDisplay.length <= oSettings._iDisplayLength) {
						$('.dataTables_paginate').hide();
						$('.dataTables_info').hide();
					} else {
						$('.dataTables_paginate').show();
						$('.dataTables_info').show();
					}
				}
			});
		});
	</script>
@stop