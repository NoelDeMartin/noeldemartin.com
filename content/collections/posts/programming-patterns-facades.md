---
id: programming-patterns-facades
blueprint: post
title: 'Programming Patterns: Facades'
publication_date: '2026-10-12T10:36:24+02:00'
modification_date: '2026-10-12T10:36:24+02:00'
---

{{ partial:components/callout title="Programming Patterns"
    content="This is part of my Programming Patterns series, check it out to find more."
    url="https://noeldemartin.com/blog/programming-patterns"
    image="/img/blog/ProgrammingPatternsSeries.jpg"
    icon="icons/blog"
    target="_blank"
/}}

<img src="/img/blog/ProgrammingPatternsFacades.jpg" alt="" class="sr-only" />

When they were introduced, Laravel Facades were one of the most controversial parts of the framework. Nowadays, I don't see many people talking about them anymore. For me, they've become one of my favorite patterns.

## Previously, on Programming Patterns...

Two blog posts ago, [I talked about Magic Objects](https://noeldemartin.com/blog/programming-patterns-magic-objects). It produced exactly the reactions I was expecting:

<figure>

![Screenshot of a Reddit comment saying "There are countries where you would be thrown into a pit of crocodiles for this."](/img/blog/ProgrammingPatternsMagicObjectsHate.png)

<figcaption>(Thanks for <a href="https://www.reddit.com/r/PHP/comments/1uvdl3j/comment/oxbpk9y" target="_blank">the comment</a>, dirtside, it made my day!)</figcaption>

</figure>

As I mentioned in that blog post, these sorts of patterns do not appeal to everyone's taste. But I love them! If I hadn't been able to use them, my life as a developer would have been a lot more grim.

Though of course, it's arguable how relevant they are anymore, given that very few of us are still writing code by hand... But do you know who else likes these patterns? AI!

Or maybe I shouldn't say it "likes" the patterns, but it definitely has no trouble using them. These also tend to result in shorter and more readable code (that's usually the point). If I were really trying to sell the idea, I would say that they are more "token efficient".

However, they _are_ sharp knives. It's still your job as a developer to keep AI in check and prevent abuse.

Today's topic is definitely another sharp knife. Let's get into it.

## Facades in a nutshell

In case this is your first time hearing about facades, they are static accessors to Laravel's service container instances. Taylor Otwell, the creator of Laravel, likes this pattern so much that he used it for the license plate in his Lamborghini:

<a href="https://x.com/taylorotwell/status/1647011864054775808" target="_blank">

![Taylor Otwell Tweet about his Lamborghini with a plate saying "FACADE"](/img/blog/TaylorLamboTweet.png)

</a>

I am aware that this description can be a bit confusing if you're not familiar with dependency injection, but once you start using it you'll realize it isn't that complicated. In fact, in my JavaScript version, I don't use a service container at all!

Let's look at an example that will hopefully clear things up. Imagine that you have the following code:

```ts
class ShoppingCart {
    constructor(
        private price: number,
        private payment: IPaymentGateway,
    ) {}

    async purchase() {
        await this.payment.charge(this.price);
    }
}
```

You've probably seen something like this before. You have a class or function that needs to use an external service or API. Since you're a good developer and know about the SOLID principles, you don't hard-code the 3rd party integration right there. Instead, you create an interface and implementation (for example, we could have a `StripePaymentGateway` implementation).

That's all fine and good, but whenever you follow this approach, you're going to face a conundrum: Should you create a singleton with global state, or should you pass around the resolved instance like we did in our example?

Using globals is a lot easier to work with, because you write less code and avoid the headaches of passing data around. But using arguments is technically more correct, and will make your life a lot easier in unit tests. That is usually called "dependency injection" (the D in SOLID).

Facades give us a 3rd option. You can have global state, but this global state can be swapped at runtime:

```ts [ShoppingCart.ts]
class ShoppingCart {
    constructor(private price: number) {}

    async purchase() {
        await PaymentGateway.charge(this.price);
    }
}
```

```ts [ShoppingCart.test.ts]
it('makes a purchase', async () => {
    const cart = new ShoppingCart(42);
    const paymentMock = new MockPaymentGateway();

    PaymentGateway.setInstance(paymentMock);

    await cart.purchase();

    expect(paymentMock.charge).toHaveBeenCalledWith(42);
});
```

## Implementation

If you read [my previous post on Magic Objects](https://noeldemartin.com/blog/programming-patterns-magic-objects#the-hack), you won't be surprised here: it's proxies again!

```ts
export function facade<T extends object>(
    factory: (() => T) | (new () => T),
): T {
    let instance: T | null = null;

    const buildInstance = (): T => {
        try {
            return (factory as () => T)();
        } catch {
            return new (factory as new () => T)();
        }
    };

    const getInstance = () => instance ?? (instance = buildInstance());

    return new Proxy({} as T, {
        get: (_, property) => Reflect.get(getInstance(), property),
        set: (_, property, value) =>
            Reflect.set(getInstance(), property, value),
    });
}

// Then, you can use it like this:

class StripePaymentGateway implements IPaymentGateway {
    async charge(amount: number): Promise<void> {
        // ...
    }
}

export const PaymentGateway = facade<IPaymentGateway>(StripePaymentGateway);
```

Again, this is a very simple implementation. I'm not even implementing the `setInstance()` method I used in the example above, but you get the idea.

If you want to see a complete implementation, you can find it [on GitHub](https://github.com/NoelDeMartin/utils/blob/main/src/fluent/facade.ts).

## Use Cases

### Testing

Like I said, one of the most appealing reasons to use this pattern is to swap dependencies without the headaches of traditional dependency injection.

But I'd argue its usefulness goes beyond that. Thanks to the fact that we're already "doing magic", we can take it up a notch and [mock dependencies on the fly](https://github.com/moodlehq/moodleapp/blob/9d52da9b4e1decbaff1e4de89971b658e040be2e/src/testing/utils.ts#L329).

You can also [configure default mock behaviors](https://github.com/moodlehq/moodleapp/blob/9d52da9b4e1decbaff1e4de89971b658e040be2e/src/testing/utils.ts#L58-L83) across an entire test suite. For example, if your code really interacts with 3rd party services, it's very likely you'll want to mock them everywhere.

### Lazy facades (e.g. code splitting)

When I started using facades, I got used to how they work in PHP. But ever since I ported them to JavaScript, I've found them even more useful.

I'm sure you'll agree with me that one of the most annoying parts of JavaScript is async code. If some function needs to be async, it'll propagate throughout the codebase and soon everything will be async. But that also comes with an advantage: you can defer computation (or even importing code!) until you need it.

Traditionally, code splitting is a bit cumbersome to use:

```ts
const { default: payment } = await import('./my/payment/gateway');

await payment.charge(42);
```

That doesn't look _too_ annoying, but before you know it, you'll be writing that `await import` line everywhere.

With facades, you can encapsulate all of this in the facade definition. However, keep in mind that you'll need to use a different variety of facade I call "lazy facades". This is because, given the asynchronicity, all methods of the facade will become async (even if they weren't in the original class definition).

Let's see an example here:

```ts
// Define once...
const PaymentGateway = lazyFacade(async () => {
    const { default: payment } = await import('./my/payment/gateway');

    return payment;
});

// And use anywhere directly!
await PaymentGateway.charge(42);
```

You may be thinking that this is not that impressive, given that you could probably wrap that into a plain function. But there is a subtle advantage with facades. With a plain function, the code will be imported as soon as you call this function. But facades only call the factory method when they're actually used, so the loading of the split chunk will be deferred until it's actually needed.

And this pattern is not limited to code splitting. Sometimes, you may want to defer initializing an object as well, or you may need to call async code in a constructor. But since the latter is impossible, you have to resort to an `initialize()` function of some sort, and make sure everywhere in the codebase that methods are not called on uninitialized objects.

This also gets a lot easier with facades:

```ts
// Define once...
const Expensive = lazyFacade(async () => {
    const instance = new ExpensiveService();

    await instance.initialize();

    return instance;
});

// And use anywhere directly!
await Expensive.doSomething(42);
```

### Services

In the previous post, [I hinted](https://noeldemartin.com/blog/programming-patterns-magic-objects#vue-reactivity) at another pattern I use very often called "Services". Initially, I thought of writing a dedicated blog post for that Programming Pattern. But honestly, it's just Magic Objects + Facades.

In my Vue applications, I often encapsulate shared business logic and state in these Service classes, which are available everywhere. For example, a `Workspaces` service in [my task manager app](https://github.com/NoelDeMartin/solid-focus/blob/v0.3.3/src/services/Workspaces.ts):

```ts
class WorkspacesService extends Service {}

export default facade(WorkspacesService);
```

This service also keeps its reactive state, and I can use it anywhere in my app:

{{ noparse }}

```html
<template>
    <ul>
        <li v-for="workspace of $workspaces.all">
            {{ workspace.name }}
            <button type="button" @click="deleteWorkspace(workspace)">
                Delete
            </button>
        </li>
    </ul>
</template>

<script setup lang="ts">
    import Workspace from '@/models/Workspace';
    import Workspaces from '@/services/Workspaces';

    async function deleteWorkspace(workspace: Workspace) {
        if (!confirm('Are you sure?')) {
            return;
        }

        await Workspaces.delete(workspace);
    }
</script>
```

{{ /noparse }}

## Getting Started

If I've convinced you that this is cool and you want to dig further, here's where you can start looking:

- You can use it in your projects with the `@noeldemartin/utils` package from npm, or feel free to copy & paste the source of [facades](https://github.com/NoelDeMartin/utils/blob/main/src/fluent/facade.ts) and [lazy facades](https://github.com/NoelDeMartin/utils/blob/main/src/fluent/lazyFacade.ts) into your own codebase.
- Tell your LLMs to use it by installing [my AI skills](https://github.com/NoelDeMartin/skills). This skill is configured with `disable-model-invocation`, so you shouldn't worry that AIs abuse it without your consent.
