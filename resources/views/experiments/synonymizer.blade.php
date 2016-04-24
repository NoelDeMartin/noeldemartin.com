@extends('layouts.experiment')

@section('styles')
	<style type="text/css">

		textarea {
			width: 100%;
			resize: none;
		}

		.btn {
			width: 100%;
		}

		#result {
			margin: 15px 0;
			padding: 10px;
			width: 100%;
			background-color: #e3e3e3;
		}

	</style>
@stop

@section('content')
	<div class="container">
		<h1>Random Synonymizer</h1>

		<textarea rows="10"></textarea>

		<a class="btn btn-lg btn-primary">
			Synonymize!
		</a>

		<p id="result"></p>
	</div>
@stop

@section('scripts')

	<script type="text/javascript">
		(function() {
			var $textarea = $('textarea'),
				$result = $('#result'),
				$button = $('.btn');
			$button.click(function() {
				$button.addClass('disabled');
				$button.text('Loading...');
				$.ajax('{{ route('experiments.synonymize_text') }}', {
					method: 'POST',
					data: {'text': $textarea.val(),
							'_token': '{{ csrf_token() }}'},
					success: function(response) {
						$result.text(response);
					},
					error: function(e) {
						$result.text("I'm sorry to let you know that something went wrong :(. Please try again.");
					},
					complete: function() {
						$button.removeClass('disabled');
						$button.text('Synonymize!');
					}
				});
			});

			function synonymize(text) {
				text = text.split(' ');
				var word;

				for (var i in text) {
					word = text[i];
					text[i] = getSynonym(word);
				}

				return text.join(' ');
			}

		})();
	</script>

@stop