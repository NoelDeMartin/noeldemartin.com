<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\Health;
use App\Http\Controllers\NowController;
use App\Http\Controllers\PodcastController;
use App\Http\Controllers\SiteMap;
use App\Http\Controllers\SlidesController;
use Illuminate\Support\Facades\Route;

Route::get('blog/rss.xml', [BlogController::class, 'feed'])->name('blog.rss');
Route::get('blog/styles.xsl', [BlogController::class, 'styles'])->name('blog.xsl');
Route::get('slides/{slug}', [SlidesController::class, 'show'])->name('slides.show');
Route::get('now/rss.xml', [NowController::class, 'feed'])->name('now.rss');
Route::get('now/styles.xsl', [NowController::class, 'styles'])->name('now.xsl');
Route::get('podcast/feed.xml', [PodcastController::class, 'feed'])->name('podcast.feed');
Route::get('podcast/styles.xsl', [PodcastController::class, 'styles'])->name('podcast.xsl');
Route::get('health', Health::class)->name('health');
Route::get('sitemap.xml', SiteMap::class)->name('sitemap');

Route::redirect('fosdem', 'https://www.youtube.com/watch?v=kPzhykRVDuI');
Route::redirect('solid-world', 'https://www.youtube.com/watch?v=cajBTJXmKhA');
Route::redirect('solid-world-2025', 'https://www.youtube.com/watch?v=KN9OWj_XdkY');
Route::redirect('solid-symposium-dx', 'https://www.youtube.com/watch?v=ghGmveKKe5Y');
Route::redirect('solid-symposium-crdts', 'https://www.youtube.com/watch?v=vYQmGeaQt8E');
Route::redirect('solid-symposium-2025', 'https://www.youtube.com/watch?v=7pfUw_t6rCk');
Route::redirect('local-first', '/slides/local-first-solid-and-everything-in-between?showRecording=true');
Route::redirect('recipes', 'https://umai.noeldemartin.com/viewer?url=https://noeldemartin.solidcommunity.net/cookbook/public%23it');
Route::redirect('recipes/aguachile', 'https://umai.noeldemartin.com/viewer?url=https://noeldemartin.solidcommunity.net/cookbook/aguachile%23it');

Route::permanentRedirect('about', '/');
Route::permanentRedirect('slides', '/talks');
Route::permanentRedirect('posts', '/blog');
Route::permanentRedirect('posts/{tag}', '/blog/{tag}');
Route::permanentRedirect('blog/blockchains-how-do-they-work-', '/blog/blockchains-how-do-they-work');
Route::permanentRedirect('blog/blockchains-innovation-or-sham-', '/blog/blockchains-innovation-or-sham');
Route::permanentRedirect('tasks/attending-laracon-us', 'tasks/attending-laracon-eu');
Route::permanentRedirect('experiments', 'https://web.archive.org/web/20250120164329/https://noeldemartin.com/experiments/');
Route::permanentRedirect('experiments/freedom-calculator', 'https://freedom-calculator.noeldemartin.com');
Route::permanentRedirect('experiments/online-meeting', 'https://github.com/NoelDeMartin/noeldemartin.com/blob/c19b46c7be28e5de7fc903294554756dcaa2dae9/resources/assets/js/experiments/online-meeting.js');
Route::permanentRedirect('experiments/synonymizer', 'https://github.com/NoelDeMartin/noeldemartin.com/blob/0c99cb3149b846ffc9b9ae07c0f0d709beedf66a/app/Http/Controllers/ExperimentsController.php#L30..L53');
