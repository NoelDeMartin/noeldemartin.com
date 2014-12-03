@extends('layouts.master')

@section('styles')
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.min.css">
@stop

@section('content')
	<h1>Edit Post {{ HTML::linkRoute('posts.destroy', 'Delete', $post->id, ['class' => 'btn btn-lg btn-danger', 'id' => 'destroy-post', 'role' => 'button']) }}</h1>

	{{ Form::open(['route' => ['posts.update', $post->id], 'method' => 'PATCH', 'role' => 'form']) }}

	<div class="form-group">
		{{ Form::text('title', Input::old('title', $post->title), ['placeholder' => 'Title', 'class' => 'form-control']) }}
	</div>

	<ul id="tabs" class="nav nav-tabs" role="tablist">
		<li id="both" class="active"><a href="javascript:void(0);">Both</a></li>
		<li id="write"><a href="javascript:void(0);">Write</a></li>
		<li id="preview"><a href="javascript:void(0);">Preview</a></li>
	</ul>
	<div id="editor" class="both">
		{{ Form::textarea('text_markdown', Input::old('text_markdown', $post->text_markdown), ['placeholder' => 'Markdown text goes here', 'id' => 'text-markdown', 'class' => 'editor-text']) }}
		<div id="column"></div>
		<div id="text-html" class="editor-text"></div>
		<div class="clearfix"></div>
	</div>

	<br>
	<div class="form-group">
		{{ Form::text('published_at', Input::old('published_at', $post->published_at->format(Post::DATE_FORMAT)), ['placeholder' => 'Publication date (dd/mm/yyyy)', 'class' => 'form-control', 'id' => 'published_at']) }}
	</div>

	{{ Form::hidden('text_html', Input::old('text_html', $post->text_html)) }}

	@foreach ($errors->all() as $error)
		<div class="alert alert-danger" role="alert">{{ $error }}</div>
	@endforeach

	{{ Form::submit('Submit', ['class' => 'btn btn-default']) }}
	{{ Form::close() }}
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
			$('input[name="text_html"]').val(textHtml.html());
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
			format: '{{ Post::DATE_FORMAT_JS }}'
		});
		$('#destroy-post').restfulize({
			method: 'DELETE',
			confirm: function() {
				return confirm('Are you sure you want to delete this post?');
			}
		});
	</script>

@stop