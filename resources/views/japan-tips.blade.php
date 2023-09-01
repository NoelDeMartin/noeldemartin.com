@extends('layouts.master', ['minimal' => true])

@section('content')
    <article>
        <h1 class="mb-1">@lang('japan.title')</h1>

        <div class="max-w-readable">
            {!! markdown(trans('japan.content')) !!}
        </div>
    </article>
@endsection
