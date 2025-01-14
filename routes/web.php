<?php

use Illuminate\Support\Facades\Route;

Route::redirect('solid-world', 'https://www.youtube.com/watch?v=cajBTJXmKhA');
Route::redirect('fosdem', 'https://www.youtube.com/watch?v=kPzhykRVDuI');
Route::redirect('solid-symposium-dx', 'https://www.youtube.com/watch?v=ghGmveKKe5Y');
Route::redirect('solid-symposium-crdts', 'https://www.youtube.com/watch?v=vYQmGeaQt8E');
Route::permanentRedirect('about', '/');
Route::permanentRedirect('posts/{tag?}', '/blog/{tag}');
