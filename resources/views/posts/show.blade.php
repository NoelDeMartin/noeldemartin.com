@inject('links', 'App\Social\LinksGenerator')

@extends('layouts.master')

@section('content')
    <article class="max-w-readable mx-auto">

        <h1>{{ $post->title }}</h1>

        <div class="flex mb-4">

            <time datetime="{{ $post->published_at->toDateTimeString() }}">
                @icon('calendar', 'h-4 fill-current')
                <span class="ml-1">{{ $post->published_at->toFormattedDateString() }}</span>
            </time>

            <time datetime="{{ $post->duration }}M">
                @icon('timer', 'h-4 fill-current')
                <span class="ml-1">{{ $post->duration }} min.</span>
            </time>

        </div>

        {!! $post->text_html !!}

    </article>

    <div id="share" class="text-right">
        <a href="{!! $links->twitter($post) !!}" class="dialog text-blue-darkest hover:text-blue">
            @icon('twitter-round', 'h-8 fill-current')
        </a>
        <a href="{!! $links->linkedin($post) !!}" class="dialog text-blue-darkest hover:text-blue">
            @icon('linkedin-round', 'h-8 fill-current')
        </a>
        <a href="{!! $links->email($post) !!}" class="text-blue-darkest hover:text-blue">
            @icon('email-round', 'h-8 fill-current')
        </a>
        <a href="{!! $links->raw($post) !!}" class="copy text-blue-darkest hover:text-blue">
            @icon('link-round', 'h-8 fill-current')
        </a>
    </div>
@stop

@section('scripts')
    <script type="text/javascript">
        (function () {
            $('#share a.dialog').click(function () {
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

            $('#share a.copy').click(function () {
                if (navigator.clipboard && navigator.clipboard.writeText) {
                    navigator.clipboard.writeText(this.href);
                } else {
                    try {
                        var input = document.createElement('input');
                        input.value = this.href;
                        input.style = 'position:fixed; top: -9999px';
                        document.body.appendChild(input);
                        input.focus();
                        input.select();
                        document.execCommand('copy');
                        input.remove();
                        showToast('Link copied to clipboard!');
                    } catch(e) {
                        window.prompt('Copy this link:', this.href);
                    }
                }
                return false;
            });
        })();
    </script>
@stop
