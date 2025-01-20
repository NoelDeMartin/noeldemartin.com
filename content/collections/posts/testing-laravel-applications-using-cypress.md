---
id: testing-laravel-applications-using-cypress
blueprint: post
title: 'Testing Laravel Applications Using Cypress'
publication_date: '2019-11-18 11:24:00'
modification_date: '2020-07-23 16:14:40'
---

![Laravel + Cypress](/img/blog/LaravelCypress.jpg)

You won't usually see technical posts in this blog, but this time I decided to shake things up. I've been working with Laravel for many years now, and one of the main advantages is its easy of use and eloquence. In those areas, I don't find libraries that rival Laravel often.

But some months ago I found Cypress and it does. These two technologies don't seem like a good fit out of the box, but in this post I'll tell you what I've done to mix their magic.

## What we are going to achieve

Before getting down to the nitty-gritty, let me show you what we're going to achieve:

```js
describe('Welcome', () => {
    it('Shows "Laravel"', () => {
        cy.visit('/');

        cy.contains('Laravel');
    });
});
```

```js
describe('Authentication', () => {
    it('Logs in users', () => {
        cy.create('User').then((user) => {
            cy.visit('/login');

            cy.get('input[name="email"]').type(user.email);
            cy.get('input[name="password"]').type('password');
            cy.get('button[type="submit"]').click();

            cy.contains(user.name);
            cy.contains('You are logged in!');
        });
    });

    it('Maintains sessions for logged in users', () => {
        cy.login();

        cy.visit('/');

        cy.contains('You are logged in!');
    });
});
```

Does that look simple and easy to understand? I'm happy it does, that's the point.

If you're familiar with Cypress, there are a couple of things that may have jumped at you. Cypress knows how to interact with the browser, but what's going on with `cy.create('User')` and `cy.login()`?

Those are actually calling Laravel's [factories](https://laravel.com/docs/6.x/database-testing#using-factories) and [authentication](https://laravel.com/docs/6.x/authentication) services under the hood. That's the magic we're going to build now.

For the remainder of this post, I will assume you are familiar with Laravel and Cypress. If you aren't, I encourage you to check out this [introduction to Laravel](https://laracasts.com/series/laravel-6-from-scratch/episodes/1) and this [introduction to Cypress](https://docs.cypress.io/guides/core-concepts/introduction-to-cypress.html).

## Preparing Cypress tests, no magic yet

Cypress is often associated with Javascript applications because it's a frontend testing tool. But it's just interacting with a browser to test your application. So any application that is running in a browser is testable with Cypress. That includes Ruby on Rails, Django and of course Laravel.

That's why in order to write our first test, we don't need to do anything special. If you launch your Laravel application and prepare your Cypress configuration with the `baseUrl` pointing to your Laravel app, you're ready to go.

Your first test can be something like this:

```js
it('Shows "Laravel"', () => {
    cy.visit('/');

    cy.contains('Laravel');
});
```

Unfortunately, that's as far as we can go without making some customizations. Laravel tests will typically populate the database and interact with other services. Let's do it.

## Adding backend communication

If you look around the Cypress documentation, you will find that they mention [test environment specific routes](https://docs.cypress.io/guides/getting-started/testing-your-app.html). This is a good approach to establish communication between our tests and our backend.

You can add this to your Laravel routes file:

```php
if (App::environment('testing')) {
    Route::get('/_testing/login', function () {
        Auth::login(factory(\App\User::class)->create());
    });
}
```

This will allow us to write a test like this:

```js
it('Maintains sessions for logged in users', () => {
    cy.request('/_testing/login');

    cy.visit('/');

    cy.contains('You are logged in!');
});
```

_Remember to be running your app in `testing` environment._

That gets the job done, but let's not stop here. In a way this kills the readability we love so much. It's still "readable", but if we continue down this path you'll notice how it becomes more and more cumbersome.

## Making it readable

One way to encapsulate this behaviour is by defining a [custom Cypress command](https://docs.cypress.io/api/cypress-api/custom-commands.html).

All we need to do is adding the following to the `cypress/support/commands.js` file:

```js
Cypress.Commands.add('login', () => cy.request('/_testing/login'));
```

And now our test will be that much readable:

```js
it('Maintains sessions for logged in users', () => {
    cy.login();

    cy.visit('/');

    cy.contains('You are logged in!');
});
```

You may be surprised if I tell you that this is actually all you need to know in order to test your Laravel applications with Cypress!

Anything else you need can be added following the same pattern. Define a Laravel route, and then define a custom Cypress command that encapsulates the request.

For the sake of clarity, let's do another example.

## Hooking up model factories

As I mentioned earlier, another common operation in Laravel tests is populating the database. This is normally done using factories, so let's create a new command for that.

Add the following to your routes file:

```php
if (App::environment('testing')) {
    Route::get('/_testing/create', function () {
        $modelClass = 'App\\' . request('model');

        return factory($modelClass)->create();
    });
}
```

And then define the following command:

```js
Cypress.Commands.add('create', (model) => {
    return cy.request('/_testing/create?model=' + model).its('body');
});
```

Now we can write this test:

```js
it('Logs in users', () => {
    cy.create('User').then((user) => {
        cy.visit('/login');

        cy.get('input[name="email"]').type(user.email);
        cy.get('input[name="password"]').type('password');
        cy.get('button[type="submit"]').click();

        cy.contains(user.name);
        cy.contains('You are logged in!');
    });
});
```

## Going further

This is as far as we'll go in this post, but you'll find a couple of things that can be improved if you want to use this approach. Things such as moving the testing routes to controllers, implementing tests setup and teardown, adding other arguments to the create command, etc.

In order to get you started, I've released a Cypress plugin and a Laravel package that add this functionality. Check out [cypress-laravel](https://github.com/NoelDeMartin/cypress-laravel) and [laravel-cypress](https://github.com/NoelDeMartin/laravel-cypress).

Another meaningful aspect of testing applications is running them automatically with every code change. It's also important to run tests in an environment that is not dependant on your local machine. For this purpose, I've also created a sandbox repository configured with Github Actions for CI. Use it to get started with your own projects, or just to tinker around. Check it out at [laravel-cypress-sandbox](https://github.com/NoelDeMartin/laravel-cypress-sandbox/).

I hope this was useful, let me know what you think and don't hesitate in asking anything!
