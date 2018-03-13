@extends('layouts.master')

@section('styles')
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.min.css">
@stop

@section('content')
	<h1>
		Edit Post
		<a
			href="{!! route('posts.destroy', [$post->id]) !!}"
			class="btn btn-lg btn-danger"
			id="destroy-post"
			role="button"
		>
			Delete
		</a>
	</h1>

	<form action="{!! route('posts.update', [$post->id]) !!}" method="POST" role="form">

		<div class="form-group">
			<input type="text" name="title" value="{{ old('title', $post->title) }}" placeholder="Title" class="form-control">
		</div>

		<ul id="tabs" class="nav nav-tabs" role="tablist">
			<li id="both" class="active"><a href="javascript:void(0);">Both</a></li>
			<li id="write"><a href="javascript:void(0);">Write</a></li>
			<li id="preview"><a href="javascript:void(0);">Preview</a></li>
		</ul>
		<div id="editor" class="both">
			<textarea
				name="text_markdown"
				placeholder="Markdown text goes here"
				id="text-markdown"
				class="editor-text"
			>{{ old('text_markdown', $post->text_markdown) }}</textarea>
			<div id="column"></div>
			<div class="post editor-text"><div id="text-html" class="body readable-text"></div></div>
			<div class="clearfix"></div>
		</div>

		<br>
		<div class="form-group">
			<input
				type="text"
				name="published_at"
				value="{{ old('published_at', $post->published_at->format(App\Models\Post::DATE_FORMAT)) }}"
				placeholder="Publication date (dd/mm/yyyy)"
				class="form-control"
				id="published_at"
			>
		</div>

		<input type="hidden" name="text_html" value="{{ old('text_html', $post->text_html) }}">

		@foreach ($errors->all() as $error)
			<div class="alert alert-danger" role="alert">{!! $error !!}</div>
		@endforeach

		<input type="hidden" name="_method" value="PATCH" />
		<input type="hidden" name="_token" value="{{ csrf_token() }}">

		<input type="submit" value="Submit" class="btn btn-default">
	</form>
@stop

@section('scripts')

	<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>
	<script src="/js/marked.min.js"></script>
	<script type="text/javascript">
		var editor = $('#editor'),
			textMarkdown = $('#text-markdown'),
			textHtml = $('#text-html'),
			tabs = $('#tabs'),
			tabsChildren = $('#tabs li');

		// Allow tab character
		textMarkdown.on('keydown', function(e) {
			if ((e.keyCode || e.which) == 9) {
				e.preventDefault();
				var start = textMarkdown.get(0).selectionStart,
					end = textMarkdown.get(0).selectionEnd;

				// set textarea value to: text before caret + tab + text after caret
				textMarkdown.val(
						textMarkdown.val().substring(0, start)
							+ "\t" + textMarkdown.val().substring(end));

				// put caret at right position again
				textMarkdown.get(0).selectionStart = textMarkdown.get(0).selectionEnd = start + 1;
			}
		});

		// Update Html
		textHtml.html(marked(textMarkdown.val()));
		textMarkdown.on('keyup', function(e) {
			textHtml.html(marked(textMarkdown.val()));
		});

		$('form').on('submit', function() {
			$('input[name="text_html"]').val(marked(textMarkdown.val()));
			return true;
		})

		// Tabs
		tabs.delegate('li', 'click', function() {
			var activeTab = $(this);
			tabsChildren.each(function () {
				var tab = $(this);
				if (tab.attr('id') != activeTab.attr('id')) {
					tab.removeClass('active');
				} else {
					tab.addClass('active');
					editor.attr('class', tab.attr('id'));
				}
			});
		});

		// Initialize components
		$('#published_at').datepicker({
			format: '{!! App\Models\Post::DATE_FORMAT_JS !!}'
		});
		$('#destroy-post').restfulize({
			method: 'DELETE',
			params: {
				'_token' : '{{ csrf_token() }}'
			},
			confirm: function() {
				return confirm('Are you sure you want to delete this post?');
			}
		});
	</script>

@stop
