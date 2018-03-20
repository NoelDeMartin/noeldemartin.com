@extends('layouts.experiment')

@section('title', 'Freedom Calculator')

@push('styles')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <style type="text/css">
        html {
            background: #CAFCF7;
            font-size: 16px;
        }

        @media only screen and (max-width: 989px) {
            html {
                font-size: 14px;
            }
        }

        @media only screen and (max-width: 750px) {
            html {
                font-size: 12px;
            }
        }

        @media only screen and (max-width: 500px) {
            html {
                font-size: 10px;
            }
        }

        body {
            background: #CAFCF7;
            width: 100%;
            max-width: 1240px;
            margin: auto;
            padding: 0 1rem;
        }

        h1 {
            text-align: center;
            font-size: 8rem;
            font-style: italic;
            font-weight: bold;
        }

        #explanation {
            font-size: 1.5rem;
            font-style: italic;
        }

        #wrapper {
            position: relative;
            background-color: #F1FFFE;
            border-radius: 1rem;
            overflow: hidden;
        }

        #calculator {
            font-size: 2rem;
            padding: 0 3rem;
        }

        #calculator p {
            margin: 2rem 0;
        }

        #calculator input {
            text-align: center;
            border: 1px dashed #bbb;
            background: rgba(255, 255, 255, 0.8);
        }

        #freedom {
            background-color: #CAF3FD;
            color: #000156;
            padding: 0 3rem 3rem 3rem;
        }

        #freedom #freedom-message {
            font-size: 1.5rem;
            padding-top: 1rem;
        }

        #freedom #freedom-deadline {
            font-size: 4rem;
            text-align: center;
        }

        #freedom #freedom-save {
            float: right;
        }

        #social {
            text-align: center;
        }

        #social .social-share {
            display: inline-block;
            width: 4rem;
            height: 4rem;
            margin: 0.5rem;
            background-repeat: no-repeat;
            background-position: center;
            background-size: contain;
            text-indent: 100%;
            white-space: nowrap;
            overflow: hidden;
        }

        #social .social-share.twitter {
            background-image: url('../img/twitter.png');
        }

        #social .social-share.facebook {
            background-image: url('../img/facebook.png');
        }

        #social .social-share.gplus {
            background-image: url('../img/gplus.png');
        }

    </style>
@endpush

@section('content')
    <h1>Freedom Calculator</h1>
    <p id="explanation">How much freedom do you have right now? Until when will you last if your income drops to 0 right now?</p>
    <div id="wrapper">
        <div id="calculator">
            <p>How much do you have? <input id="wealth" value="{!! request()->get('wealth', '0') !!}" type="text" onclick="this.select();"/></p>
            <p>How much do you spend? <input id="expenses" value="{!! request()->get('expenses', '0') !!}" type="text" onclick="this.select();"/> every
                <select id="expense-rate">
                    <option value="day" {!! (request()->get('expense-rate') == 'day')? 'selected="selected"' : '' !!}>day</option>
                    <option value="week" {!! (request()->get('expense-rate') == 'week')? 'selected="selected"' : '' !!}>week</option>
                    <option value="month" {!! (request()->get('expense-rate', 'month') == 'month')? 'selected="selected"' : '' !!}>month</option>
                </select>
            </p>
        </div>
        <div id="freedom">
            <p id="freedom-message"></p>
            <p id="freedom-deadline"></p>
            <a id="freedom-save" target="_blank">Save this result</a>
        </div>
    </div>
    <div id="social">
        <a class="social-share share-popup twitter" href="https://twitter.com/intent/tweet?text=Calculate your freedom with this calculator&url={!! urlencode(route('experiments.freedom-calculator')) !!}&via=NoelDeMartin">Twitter</a>
        <a class="social-share share-popup facebook" href="https://www.facebook.com/sharer/sharer.php?u={!! urlencode(route('experiments.freedom-calculator')) !!}">Facebook</a>
        <a class="social-share share-popup gplus" href="https://plus.google.com/share?url={!! urlencode(route('experiments.freedom-calculator')) !!}">Google+</a>
    </div>
@stop

@push('scripts')
    <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script type="text/javascript">
        (function() {
            var $freedomMessage = freedomDeadline = $('#freedom-message'),
                $freedomDeadline = $('#freedom-deadline'),
                $freedomSave = $('#freedom-save'),
                $wealth = $('#wealth'),
                $expenses = $('#expenses'),
                $expenseRate = $('#expense-rate');

            var updateDeadline = function() {
                // Update link
                $freedomSave.attr('href', '{!! route('experiments.freedom-calculator') !!}'
                                            + '?wealth=' + $wealth.val()
                                            + '&expenses=' + $expenses.val()
                                            + '&expense-rate=' + $expenseRate.val());
                // Update message
                var dayBurn = $expenses.val();
                if ($expenseRate.val() == 'week') {
                    dayBurn /= 7;
                } else if ($expenseRate.val() == 'month') {
                    dayBurn /= 30;
                }
                var daysLeft = $wealth.val() / dayBurn;
                if (!isNaN(daysLeft) && daysLeft != Infinity) {
                    var monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
                    var deadline = new Date(new Date().getTime() + 24*60*60*1000*daysLeft);
                    if (!isNaN(deadline.getTime())) {
                        $freedomMessage.text('You are free until');
                        $freedomDeadline.text(monthNames[deadline.getMonth()] + ' ' + deadline.getDate() + ' ' + deadline.getFullYear());
                        return;
                    }
                }

                $freedomMessage.text('');
                $freedomDeadline.text('You are free forever');
            }

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

            $('.share-popup').click(function () {
                    var width = Math.min(screen.width*0.8, 600),
                        height = Math.min(screen.height*0.6, 600),
                        left = (screen.width/2)-(width/2),
                        top = (screen.height/2)-(height/2);
                    window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes' +
                                                        ',width=' + width +
                                                        ',height=' + height +
                                                        ',top=' + top +
                                                        ',left=' + left);
                    return false;
            });
        })();
    </script>
@endpush
