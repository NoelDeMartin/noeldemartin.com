<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\NowController;
use Illuminate\Support\Facades\Route;

Route::get('blog/rss.xml', [BlogController::class, 'feed'])->name('blog.rss');
Route::get('blog/styles.xsl', [BlogController::class, 'styles'])->name('blog.xsl');
Route::get('now/rss.xml', [NowController::class, 'feed'])->name('now.rss');
Route::get('now/styles.xsl', [NowController::class, 'styles'])->name('now.xsl');

Route::redirect('fosdem', 'https://www.youtube.com/watch?v=kPzhykRVDuI');
Route::redirect('solid-world', 'https://www.youtube.com/watch?v=cajBTJXmKhA');
Route::redirect('solid-symposium-dx', 'https://www.youtube.com/watch?v=ghGmveKKe5Y');
Route::redirect('solid-symposium-crdts', 'https://www.youtube.com/watch?v=vYQmGeaQt8E');

Route::permanentRedirect('about', '/');
Route::permanentRedirect('posts/{tag?}', '/blog/{tag}');
Route::permanentRedirect('blog/blockchains-how-do-they-work-', '/blog/blockchains-how-do-they-work');
Route::permanentRedirect('blog/blockchains-innovation-or-sham-', '/blog/blockchains-innovation-or-sham');
