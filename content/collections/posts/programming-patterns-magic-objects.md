---
id: programming-patterns-magic-objects
blueprint: post
title: 'Programming Patterns: Magic Objects'
publication_date: '2026-07-13T16:10:00+02:00'
modification_date: '2026-07-13T16:10:00+02:00'
---

{{ partial:components/callout title="Programming Patterns"
    content="This is part of my Programming Patterns series, check it out to find more."
    url="https://noeldemartin.com/blog/programming-patterns"
    image="/img/blog/ProgrammingPatternsSeries.jpg"
    icon="icons/blog"
    target="_blank"
/}}

<img src="/img/blog/ProgrammingPatternsMagicObjects.jpg" alt="" class="sr-only" />

JavaScript is famous for its flexibility, but it lacks one of my favorite features from PHP: Magic Methods.

...or does it?

## The Pattern

TLDR, this is what we're learning today:

```js
class Parrot extends MagicObject {
    __get(property) {
        return `${property}! ${property}!`;
    }
}

const parrot = new Parrot();

console.log(parrot.foo); // "foo! foo!"
console.log(parrot.bar); // "bar! bar!"
```

In case you aren't familiar with them, [PHP's Magic Methods](https://www.php.net/manual/en/language.oop5.magic.php) are special methods that hook into object internals, such as trying to access undefined properties or methods.

Looking at the snippet above can seem like Dark Magic, but I assure you that by the end of this blog post you're going to understand exactly how that works.

## The Hack

The first hint to get that working is one of JavaScript's most powerful features: [Proxies](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Proxy). A few years ago, this was an obscure API that wasn't supported in older browsers. But nowadays, it's used virtually everywhere. Even if you aren't using them directly, I would bet you have production code using Proxies somewhere in your stack.

I won't get too much into the details here, but if this is your first time hearing about them, you'll realize they get us very close to our goal:

```js
const parrot = new Proxy(
    {},
    {
        get(target, property) {
            return `${property}! ${property}!`;
        },
    },
);

console.log(parrot.foo); // "foo! foo!"
console.log(parrot.bar); // "bar! bar!"
```

Still, the snippet I shared at the beginning used a class definition, and I was creating a "normal" instance (I wasn't wrapping it in a Proxy). So... How does that work?

The secret is that, actually, I _was_ wrapping it in a Proxy, but you didn't see it :). And no, I'm not pulling your leg. The snippet works exactly as I wrote it.

You will understand what I mean if I reveal the implementation for the parent `MagicObject` class:

```js
class MagicObject {
    constructor() {
        return new Proxy(this, {
            get(target, property) {
                return target.__get(property);
            },
        });
    }

    __get() {
        return undefined;
    }
}
```

I know this looks wrong. Returning something from a constructor 🤯!? But I can assure you it works (it says it [right there in the spec](https://262.ecma-international.org/16.0/index.html#sec-ecmascript-function-objects-construct-argumentslist-newtarget)). And no, this post is not an AI-generated hallucination. I wrote it all by myself :D.

Amazingly, this doesn't even mess with `instanceof` checks:

```js
console.log(parrot instanceof Parrot); // true
```

(We could also subvert this using the [`getPrototypeOf` trap](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Proxy/Proxy/getPrototypeOf), but it won't be necessary for the examples we're covering today).

## Use Cases

Now that I've convinced you that it works, maybe I need to convince you to use it.

The truth is that I don't use the pattern _that much_. But the few times that I do, it improves my code dramatically. Let's see some concrete examples.

### ORM

For a few years, I have been working on an ORM called [Soukai](https://soukai.js.org/), and this pattern is essential. My base `Model` class is a Magic Object, and I've configured it in such a way that fields are defined and validated with [Zod](https://zod.dev/):

```js
import { email, number, string } from 'zod';

class User extends Model {
    static fields = {
        name: string(),
        email: email(),
        age: number().optional(),
    };
}

const user = new User({ name: 'John Doe', email: 'john@example.com' });

user.age = '42'; // Throws an Error, '42' is not a number
```

But it goes beyond basic attributes. I also define relations, which allows me to do this:

```js
import Post from './models/Post';

class User extends Model {
    static relations = {
        posts: hasMany(Post, 'authorId'),
        team: belongsToOne(Team, 'teamId'),
    };
}

const user = await User.findById(42);

await user.loadPosts(); // <-- This method isn't defined, but it works!

console.log(user.posts); // Returns `Post[]`
console.log(user.team); // Returns `Team | undefined`
```

### Vue Reactivity

My frontend framework of choice has always been Vue, and you may be familiar with [Vue's reactivity system](https://vuejs.org/guide/essentials/reactivity-fundamentals.html). It's very powerful, but sometimes it's a bit cumbersome to use (with all the `.value` everywhere).

However, using this pattern, you can create a base `Service` class that converts all its properties into reactive state under the hood:

```js
class Auth extends Service {
    static fields = ['isLoggedIn'];
}

const auth = new Auth();

auth.isLoggedIn = true;

// Now, you can use `auth.isLoggedIn` in a component with reactivity.
```

You may think this is pointless, because we already have the `reactive()` helper in Vue. But this pattern also allows you to do a lot more in your service, such as validating the properties, implementing persistence, or even wrapping each service in a [Pinia store](https://pinia.vuejs.org/):

```js
class UI extends Service {
    static store = 'ui';
    static persist = ['darkMode'];
    static fields = {
        darkMode: Boolean,
    };
}

const ui = new UI();

ui.darkMode; // <-- a reactive, validated, persistent, Pinia-bound value!
```

### Sharp Knives

These are some examples of how I've been using this myself, but I know that a lot of people reading this post will still think that this is _a very bad idea_. And to those people, all I have to say is that I agree!

This is a dangerous tool, and if you abuse it, it can create a lot more problems than it solves. But I like [sharp knives](https://rubyonrails.org/doctrine#provide-sharp-knives).

Ultimately, though, it's a matter of taste. If you think this offends your sensibilities, don't use it. I have been working with it for years, and it has become one of my favorite tools.

## TypeScript

But, we aren't done yet!

If you try to use this pattern with TypeScript, you're going to find that it's very difficult without resorting to `any`.

The naive solution, and honestly one I still use in some situations, is to simply declare the dynamic fields:

```ts
class User extends Model {
    static fields = {
        name: string(),
        email: email(),
        age: number().optional(),
    };

    declare name: string;
    declare email: string;
    declare age?: number;
}
```

But this is not ideal. For one, you're duplicating the field definitions, and if they ever get out of sync it could lead to problems. But also, this goes against the dynamic nature of the pattern. If you have to declare each field manually, what's the point of using a "Magic Object" to begin with?

This is a problem I struggled with for years, but eventually I came up with a solution that I'm pretty happy with. Essentially, I'm taking advantage of JavaScript's flexibility once again by declaring a base class with a factory function.

This has the drawback that you end up with an awkward configuration: a class that extends the result of a function call. But if you place those in 2 separate files, and come up with a suffix such as `.schema.ts`, it's actually not that bad:

```ts [User.schema.ts]
export default defineModelSchema({
    fields: {
        name: string(),
        email: email(),
        age: number().optional(),
    },
});
```

```ts [User.ts]
import Model from './User.schema';

export class User extends Model {}
```

The TypeScript definition for `defineModelSchema` can get a bit out of hand, but I've found that it's generally worth it because you only have to do this once:

```ts
import type { ZodObject, ZodType, z } from 'zod';

type Schema<TFields extends Record<string, ZodType>> = {
    fields: TFields;
};

type ModelClassDefinition<TFields extends Record<string, ZodType>> = {
    new (
        attributes: z.infer<ZodObject<TFields>>,
    ): Model & z.infer<ZodObject<TFields>>;
};

function defineModelSchema<TFields extends Record<string, ZodType>>(
    schema: Schema<TFields>,
): ModelClassDefinition<TFields> {
    return class extends Model {
        static fields = schema.fields;
    } as unknown as ModelClassDefinition<TFields>;
}
```

## Getting Started

So, what do you think? Do you like it? Or do you hate it? This sort of pattern can be very divisive, and I'm looking forward to seeing what people think!

If you are intrigued by the idea, here's a couple of places where you can continue digging:

### See it in production

I am using this pattern most heavily in two projects.

As I mentioned, [Soukai](https://soukai.js.org/) is my JavaScript ORM, and this is where the pattern actually originated. Check out the [Model](https://github.com/NoelDeMartin/soukai/blob/46d749cf4b12d37e1a8f2d4b577d52a73331b30f/packages/soukai-bis/src/models/Model.ts#L68-L73) class and the [defineSchema](https://github.com/NoelDeMartin/soukai/blob/46d749cf4b12d37e1a8f2d4b577d52a73331b30f/packages/soukai-bis/src/models/schema.ts#L122-L129) function. You can also see a couple of example models in the test stubs, such as [User.ts](https://github.com/NoelDeMartin/soukai/blob/46d749cf4b12d37e1a8f2d4b577d52a73331b30f/packages/soukai-bis/src/testing/stubs/User.ts) and [User.schema.ts](https://github.com/NoelDeMartin/soukai/blob/46d749cf4b12d37e1a8f2d4b577d52a73331b30f/packages/soukai-bis/src/testing/stubs/User.schema.ts).

I have also been using this in Vue applications for a while, and more recently I started extracting all the helpers from my apps into a framework called [Aerogel](https://aerogel.js.org/). Services implement the Vue Reactivity I mentioned in the post, so check out the [Service](https://github.com/NoelDeMartin/aerogel/blob/ef95c60b3c7afb7d86a73ecd4db531347b3ba1bd/packages/core/src/services/Service.ts#L41-L45) class and the [defineServiceState](https://github.com/NoelDeMartin/aerogel/blob/ef95c60b3c7afb7d86a73ecd4db531347b3ba1bd/packages/core/src/services/utils.ts#L15-L27) function. You can see an example service in [App.ts](https://github.com/NoelDeMartin/aerogel/blob/ef95c60b3c7afb7d86a73ecd4db531347b3ba1bd/packages/core/src/services/App.ts) and [App.state.ts](https://github.com/NoelDeMartin/aerogel/blob/ef95c60b3c7afb7d86a73ecd4db531347b3ba1bd/packages/core/src/services/App.state.ts).

### Use it in your projects

The snippets I shared in this post are real working code, but if you start using this pattern you will realize there are a couple of edge-cases to consider. For example, you may still want to have normal class properties and methods, and you may want to support other operations such as `delete`.

Because I've been using this in a couple of projects, I extracted the reusable `MagicObject` class in [my utils package](https://github.com/NoelDeMartin/utils), and you're welcome to use it.

If you don't want to add yet another dependency to your projects, you also have my permission to copy-paste the full [MagicObject](https://github.com/NoelDeMartin/utils/blob/a0ef3c875be6f86a88e67b4c3c2f2d770d053c19/src/helpers/MagicObject.ts) source, given that it's mostly a self-contained file (it'd be nice if you attribute me in the commit message, though!).

### Tell your LLMs to use it

Finally, if you're working with Agents and you'd like them to take advantage of this pattern, you can also tell them to use [my LLM skills](https://github.com/NoelDeMartin/skills).

In this case, though, the skill won't be invoked automatically because it's configured with `disable-model-invocation`. As I mentioned before, this is a sharp knife and should be used with caution. We wouldn't want our LLMs to start abusing the pattern and turning our code into a mess of indirection. But for the few situations where it makes sense, do give it a try!
