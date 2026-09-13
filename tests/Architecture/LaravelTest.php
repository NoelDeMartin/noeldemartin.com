<?php

use App\Models\StatamicModel;
use Illuminate\Console\Command;
use Illuminate\Contracts\Container\ContextualAttribute;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Mail\Mailable;
use Illuminate\Notifications\Notification;
use Illuminate\Support\ServiceProvider;

arch()->expect('App\Traits')
    ->toBeTraits();

arch()->expect('App\Concerns')
    ->toBeTraits();

arch()->expect('App')
    ->not->toBeEnums()
    ->ignoring('App\Enums');

arch()->expect('App\Enums')
    ->toBeEnums()
    ->ignoring('App\Enums\Concerns');

arch()->expect('App\Features')
    ->toBeClasses()
    ->ignoring('App\Features\Concerns');

arch()->expect('App\Features')
    ->toHaveMethod('resolve')
    ->ignoring('App\Features\Concerns');

arch()->expect('App\Exceptions')
    ->classes()
    ->toImplement('Throwable')
    ->ignoring('App\Exceptions\Handler');

arch()->expect('App')
    ->not->toImplement(Throwable::class)
    ->ignoring('App\Exceptions');

arch()->expect('App\Http\Middleware')
    ->classes()
    ->toHaveMethod('handle');

arch()->expect('App\Models')
    ->classes()
    ->not->toHaveSuffix('Model')
    ->ignoring(StatamicModel::class);

arch()->expect('App')
    ->not->toExtend(Model::class)
    ->ignoring('App\Models');

arch()->expect('App\Http\Requests')
    ->classes()
    ->toHaveSuffix('Request');

arch()->expect('App\Http\Requests')
    ->toExtend(FormRequest::class);

arch()->expect('App\Http\Requests')
    ->toHaveMethod('rules');

arch()->expect('App')
    ->not->toExtend(FormRequest::class)
    ->ignoring('App\Http\Requests');

arch()->expect('App\Console\Commands')
    ->classes()
    ->toHaveSuffix('Command');

arch()->expect('App\Console\Commands')
    ->classes()
    ->toExtend(Command::class);

arch()->expect('App\Console\Commands')
    ->classes()
    ->toHaveMethod('handle');

arch()->expect('App')
    ->not->toExtend(Command::class)
    ->ignoring('App\Console\Commands');

arch()->expect('App\Mail')
    ->classes()
    ->toExtend(Mailable::class);

arch()->expect('App\Mail')
    ->classes()
    ->toImplement(ShouldQueue::class);

arch()->expect('App')
    ->not->toExtend(Mailable::class)
    ->ignoring('App\Mail');

arch()->expect('App\Jobs')
    ->classes()
    ->toImplement(ShouldQueue::class);

arch()->expect('App\Jobs')
    ->classes()
    ->toHaveMethod('handle');

arch()->expect('App\Listeners')
    ->toHaveMethod('handle');

arch()->expect('App\Notifications')
    ->toExtend(Notification::class);

arch()->expect('App')
    ->not->toExtend(Notification::class)
    ->ignoring('App\Notifications');

arch()->expect('App\Providers')
    ->toHaveSuffix('ServiceProvider');

arch()->expect('App\Providers')
    ->toExtend(ServiceProvider::class);

arch()->expect('App\Providers')
    ->not->toBeUsed();

arch()->expect('App')
    ->not->toExtend(ServiceProvider::class)
    ->ignoring('App\Providers');

arch()->expect('App')
    ->not->toHaveSuffix('ServiceProvider')
    ->ignoring('App\Providers');

arch()->expect('App')
    ->not->toHaveSuffix('Controller')
    ->ignoring('App\Http\Controllers');

arch()->expect('App\Http')
    ->toOnlyBeUsedIn('App\Http');

arch()->expect([
    'dd',
    'ddd',
    'die',
    'dump',
    'env',
    'exit',
    'ray',
])->not->toBeUsed();

arch()->expect('App\Policies')
    ->classes()
    ->toHaveSuffix('Policy');

arch()->expect('App\Attributes')
    ->classes()
    ->toImplement(ContextualAttribute::class)
    ->toHaveAttribute('Attribute')
    ->toHaveMethod('resolve');
