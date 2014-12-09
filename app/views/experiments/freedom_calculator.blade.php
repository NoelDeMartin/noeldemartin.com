@extends('layouts.experiment')

@section('styles')
	<style type="text/css">
		body {
			background: #CAFCF7;
			text-align: center;
			height: 100%;
			width: 100%;
			position: absolute;
			top: 0;
		}
		h1 {
			width: 100%;
			position: fixed;
			top: 10%;
			font-size: 8rem;
		}
		#wrapper {
			display: block;
			position: relative;
			top: 40%;
			transform: translateY(-50%);
		}
		#calculator {
			font-size: 4rem;
			background-color: rgba(255,255,255,0.8);
			width: 50%;
			margin: auto;
			padding: 20px;
			margin-top: 40px;
			border-radius: 2rem;
		}
		#calculator input {
			background-color: rgba(255,255,255,0.7);
			text-decoration: none;
			text-align: center;
			outline: 0;
			border: 1px dashed #aaa;
		}
		#freedom {
			font-size: 3rem;
			width: 50%;
			margin: auto;
			padding: 20px;
			margin-top: 40px;
			border-radius: 2rem;
		}
	</style>
@stop

@section('content')
	<h1><strong><i>Freedom Calculator</i></strong></h1>
	<div id="wrapper">
		<div id="calculator">
			<p> I have <input id="wealth" value="{{ Input::get('wealth', '0') }}" type="text" onclick="this.select();"/> €</p>
			<p>I expend <input id="expenses" value="{{ Input::get('expenses', '0') }}" type="text" onclick="this.select();"/> each
				<select id="expense-rate">
					<option value="day" {{ (Input::get('expense-rate') == 'day')? 'selected="selected"' : '' }}>Day</option>
					<option value="week" {{ (Input::get('expense-rate') == 'week')? 'selected="selected"' : '' }}>Week</option>
					<option value="month" {{ (Input::get('expense-rate') == 'month')? 'selected="selected"' : '' }}>Month</option>
				</select>
			</p>
		</div>
		<div id="freedom">
			<p id="freedom-message"></p>
			<p id="freedom-deadline"></p>
		</div>
	</div>
@stop

@section('scripts')
	<script type="text/javascript">
		var $freedomMessage = freedomDeadline = $('#freedom-message'),
			$freedomDeadline = $('#freedom-deadline'),
			$wealth = $('#wealth'),
			$expenses = $('#expenses'),
			$expenseRate = $('#expense-rate');

		var updateDeadline = function() {
			var dayBurn = $expenses.val();
			if ($expenseRate.val() == 'week') {
				dayBurn /= 7;
			} else if ($expenseRate.val() == 'month') {
				dayBurn /= 30;
			}
			var daysLeft = $wealth.val() / dayBurn;
			if (isNaN(daysLeft) || daysLeft == Infinity) {
				$freedomMessage.text('You will be free forever');
				$freedomDeadline.text('');
			} else {
				var monthNames = [ "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December" ];
				var deadline = new Date(new Date().getTime() + 24*60*60*1000*daysLeft);
				$freedomMessage.text('You will be free until');
				$freedomDeadline.text(deadline.getDate() + ' of ' + monthNames[deadline.getMonth()] + ' of ' + deadline.getFullYear());
			}
		};

		var forceInteger = function() {
			var $this = $(this),
				value = parseInt($this.val());
			if (isNaN(value) || value == Infinity) {
				value = 0;
			}
			$this.val(value);
			$this.attr('size', value.toString().length);
		}

		$wealth.keyup(updateDeadline);
		$wealth.keyup(forceInteger);
		$expenses.keyup(updateDeadline);
		$expenses.keyup(forceInteger);
		$expenseRate.change(updateDeadline);

		$wealth.trigger('keyup');
		$expenses.trigger('keyup');
	</script>
@stop