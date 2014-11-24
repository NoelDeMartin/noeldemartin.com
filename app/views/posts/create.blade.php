@extends('layouts.master')

@section('styles')

	<style type="text/css">

		#editor {
			border: 1px solid #aaa;
			height: 500px;
		}

		#editor .editor-text {
			padding: 15px;
			height: 100%;
			width: 100%;
			float: left;
			overflow-y: hidden;
		}

		#editor.both .editor-text {
			width: 49.5%;
		}

		#editor .editor-text:hover {
			overflow-y: auto;
		}

		#editor #text-markdown {
			border: 0px;
			background: #d8d8d8;
			resize: none;
		}

		#editor #column {
			background: #aaa;
			float: left;
			width: 1%;
			height: 100%;
		}

		#editor.preview #column,
		#editor.preview #text-markdown,
		#editor.write #column,
		#editor.write #text-html {
			display: none;
		}

	</style>

@stop

@section('content')
	<h1>Create Post</h1>

	{{ Form::open(['route' => 'posts.store', 'role' => 'form']) }}

	<div class="form-group">
		{{ Form::text('title', null, ['placeholder' => 'Title', 'class' => 'form-control']) }}
	</div>

	<ul id="tabs" class="nav nav-tabs" role="tablist">
		<li id="both" class="active"><a href="#">Both</a></li>
		<li id="write"><a href="#">Write</a></li>
		<li id="preview"><a href="#">Preview</a></li>
	</ul>
	<div id="editor" class="both">
		{{ Form::textarea('text_markdown', null, ['placeholder' => 'Markdown text goes here', 'id' => 'text-markdown', 'class' => 'editor-text']) }}
		<div id="column"></div>
		<div id="text-html" class="editor-text"></div>
		<div class="clearfix"></div>
	</div>

	<br>
	<div class="form-group">
		{{ Form::text('published_at', null, ['placeholder' => 'Publication date (dd/mm/yyyy)', 'class' => 'form-control']) }}
	</div>

	{{ Form::hidden('author_id', 1) }}
	{{ Form::hidden('text_html', "") }}

	@foreach ($errors->all() as $error)
		<div class="alert alert-danger" role="alert">{{ $error }}</div>
	@endforeach

	{{ Form::submit('Submit', ['class' => 'btn btn-default']) }}
	{{ Form::close() }}
@stop

@section('scripts')

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
	</script>

@stop