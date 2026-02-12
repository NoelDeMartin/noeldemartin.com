---
id: the-problems-with-modals-and-how-to-solve-them
blueprint: post
title: 'The Problems With Modals, and How to Solve Them'
publication_date: '2025-08-04 17:28:00'
---

![](/img/blog/VueModals.png)

I have been building UIs on the web for 10+ years, and most of the time I've been using a component framework like Vue. There have definitely been some ups and downs in the frontend space, but overall I'm quite happy with the current state of the art (I did start on the jQuery era, after all!).

However, there is something that always bothered me: Modals.

## Classic modals

If you've used virtually any component framework, this is probably how you've been taught to open a modal:

```html
<button @click="show = true">Open Modal</button>

<MyModal :open="show" />
```

Basically, you're supposed to declare the modal component inline, and use a boolean to control whether it is open or not.

This approach is used in [shadcn](https://www.shadcn-vue.com/docs/components/dialog.html#usage), [PrimeVue](https://primevue.org/dialog/#basic), [Vuetify](https://vuetifyjs.com/en/components/dialogs/#usage), [Tailwind Plus](https://tailwindcss.com/plus/ui-blocks/application-ui/overlays/modal-dialogs#component-b6812b6c13fff16861f2645c4100ae5b), and is even featured in [the official Vue docs](https://vuejs.org/guide/built-ins/teleport.html#basic-usage).

The problem is... I don't think about modals that way!

Instead, the native JavaScript approach feels a lot more intuitive to me:

```js
alert('Hello!');
```

For starters, I don't write all my code inside of components. What if I want to open a modal from a JavaScript file? And what if that code is reused in multiple screens?

The answer is that you must do some component gymnastics to make sure that some component, somewhere, is actually declaring the modal. And then, have some roundabout mechanism to make sure that [a signal](https://vuejs.org/guide/extras/reactivity-in-depth.html#connection-to-signals) is passed around to control the modal's visibility.

But it gets even worse. What happens if you need to get a response from the modal? You'll probably need to complicate things further with events and listeners, or give up altogether and write the logic within a component.

In plain JavaScript, once again, things are a lot simpler:

```js
const answer = prompt('How many golf balls fit into a Boeing 747?');
```

You just call a function, and get a response.

What if I told you that you can also do this with Vue? This is how I've been using modals for years, and in today's blog post I'll share how you can do it too:

```js
import MyModal from './MyModal.vue';

const answer = await showModal(MyModal);
```

## Better modals

The first thing we're going to need, ironically, is somewhere to render our modals 😅.

But! We only need to do this once. We can choose a single place to render all of them, and move on with our lives. To encapsulate this behaviour, let's create a component called `ModalsPortal`:

```html [ModalsPortal.vue]
<template>
	<component
        v-for="modal of modals"
        :key="modal.id"
        :is="modal.component"
    />
</template>

<script setup>
import { modals } from './modals';
</setup>
```

This is not too different from using [Vue's `<Teleport>` component](https://vuejs.org/guide/built-ins/teleport.html), so you could say we're just adding some syntactic sugar here.

Once you've done that, you can define all the plumbing we'll need to make this work in a plain old JavaScript file:

```js [modals.js]
import { shallowRef } from 'vue';

export const modals = shallowRef([]);

export function showModal(modal) {
    modals.value = modals.value.concat([
        {
            id: Math.random(),
            component: modal,
        },
    ]);
}
```

Now, all you need to do is place a `<ModalsPortal>` somewhere in your app, and use the `showModal()` function to dynamically render modals from anywhere.

Congratulations, you're already using better modals 🥳.

## Passing and receiving data

So far, we've managed to render modals without declaring them in any template. We can already reproduce a DX similar to JavaScript's alerts:

```js
// JavaScript
alert('Hello!');

// Vue
import HelloModal from './HelloModal.vue';

showModal(HelloModal);
```

However, for any real application this is going to become limiting very quickly. We're also going to need to pass some arguments, and get a response once the modals are closed.

Sending arguments is straightforward, we can simply use Vue props:

```js [modals.js]
export function showModal(modal, args) {
    modals.value = modals.value.concat([
        {
            id: Math.random(),
            component: modal,
            props: args,
        },
    ]);
}
```

```html [ModalsPortal.vue]
<component
    v-for="modal of modals"
    :key="modal.id"
    :is="modal.component"
    v-bind="modal.props"
/>
```

But getting a response is a bit more involved. We'll need to manage the asynchronous nature of the operation, and remove the modal when it is closed.

We can do it by wrapping everything in a promise, and listen to events on the component:

```js [modals.js]
export async function showModal(modal, args) {
    const id = Math.random();

    return new Promise((resolve) => {
        modals.value = modals.value.concat([
            {
                id,
                component: modal,
                props: args,
                close(response) {
                    modals.value = modals.value.filter(
                        (modal) => modal.id !== id,
                    );

                    resolve(response);
                },
            },
        ]);
    });
}
```

{{ noparse }}

```html [ModalsPortal.vue]
<component
    v-for="modal of modals"
    :key="modal.id"
    :is="modal.component"
    v-bind="modal.props"
    @close="modal.close($event)"
/>
```

```html [MyModal.vue]
<template>
    <button @click="$emit('close', 'The Answer')">Close Modal</button>
</template>
```

{{ /noparse }}

And that's about it!

Now, you can even lazy load modals with a plain old dynamic import:

```ts
const { default: MyModal } = await import('./MyModal.vue');

const answer = await showModal(MyModal, {
    question: 'How many golf balls fit into a Boeing 747?',
});
```

Of course, if you want to use this in a real application you'll also need to take care of styling and whatnot. But this covers all the missing pieces to start using modals the right way. You can take a look at the complete example in [this Vue Playground](https://play.vuejs.org/#eNqNVW1r2zAQ/iuqKcSFxCl7+eKlYVspe4Gupd23alDVPidqZMlIspMQ8t93kmI7CaG0hSDdPTrdPffovIm+VVXS1BCl0cRkmleWGLB1NaWSl5XSltyqnAlzj0smSKFVSQbJeN/ojg++9Pi1d/bQsD9CbYiZq2VAbjts6cM6GJXMrGVGilpmlitJZhrAxhdkQyUhmZLGEg2mwgWQK8KWjGPmbch4d+kQ75GshJQMftRg7IBsL3xwQpgAbeM2hLNuqZyMAwdYPW4slJVgFnBHyOSlthbz+JoJni2uaOQTotH0rgIZSJqMAybgD3gbo20y3gsYDSNrsIyCz5JXoyTy7yujUabKimNyd5Wr29AoDTU7HxNCLX97m9U1DFt7NodsccL+albORqN7LBR0AzTqfJbpmSvAuW8e/8AK150TG1ELRL/hfACjRO1yDLDvtcwx7T2cz/aX7zeXs7/mZmVBmrYol6hDbj2eRqiP6zdK79P9mHzy57BjyGKQDHKIDO5py9/9AEUnrp38qISVBwUJhdMooP5E/PQvaGQHPNJhrzF/dkgwL3MgS55jvFtm54lmMldl7MJhCZJajU9LSyJhSe4xK27AKVCJBjU8dTGopXZXUcNE7aS9v03whozZ+GkHpZbnSF9YOuEoCdKm4UznqLSqTOoT7cFChcuD/Fue3d9b9xdcWNChdJeyXyRY8dnVFRYeiAs3uGp9aQePLFyx9WxQuw1UW/8qXTeP54obS4fPMOcNaUa8wBe4y0yAnNk5jUgmmDGdfeS6xwS+0HDrpOOnzaIZFUq3eKKKXak0agHpAtatH4vcc/DuHmxJG7ZzN6MXLvMO4fnvvThBkPv+vO/EOTQY4qJFuXmBKY+x2uPJgdvTg3rTqvnUPD2cbMauBRCcPxXkaEkOGAtaqJThTvApKfgKct86jk1EdV36Tc4NprRGv4CVt7zWxvJiPUKR4kNHYIa/oL2PCT6TI451oBL37C8sW8y0wtmREj17YfHl0P0nn/uJ7HKdOm30H5LTsjjof9/348F9DiW38cDzPhiS55+AL39IzjfuS7E9e8YmTK+d83Cev68XORRcAj7uysTtt+fRapx/4dPzjj4E/veJWc6ROE9XxfIcY6Xkg4byiKHtfxSvrok=).

## TypeScript

But we aren't done yet. If you're like me, you're probably taking advantage of Vue's TypeScript features, which have been improving a lot recently (we even have [Component Generics](https://vuejs.org/api/sfc-script-setup.html#generics) now 😍).

However, this whole modal shenanigans throws it all out of the window. We're not setting the props in the template, and the modal response doesn't take advantage of typed emits. But don't fret, this is nothing that some TypeScript wizardry can't fix 🧙.

First of all, we'll need to type the props for the modal component. This can be achieved using Vue's `Component` type, combined with some generic magic:

```ts [modals.ts]
import { Component } from 'vue';

export type GetComponentProps<T extends Component> = T extends {
    new (): { $props: infer TProps };
}
    ? TProps
    : never;

export async function showModal<T extends Component>(
    modal: T,
    args: GetComponentProps<T>,
) {
    // ...
}
```

The second part, typing the response, is once again a bit more involved. Maybe you're thinking that we could follow a similar approach, and infer the type from the `$emit` property:

```ts [modals.ts]
type GetComponentResponse<T extends Component> = T extends {
    new (): { $emit: (event: 'close', args: infer TResponse) => void };
}
    ? TResponse
    : never;

export async function showModal<T extends Component>(
    modal: T,
): Promise<GetComponentResponse<T>> {
    // ...
}
```

Whilst this _technically_ works, you'll find that it's also limiting in more realistic use-cases. The examples I've shared so far don't use any auxiliary components, but the more common scenario is that you'll have a generic `<Modal>` that you'll re-use across modals. And usually, it'll have a close button. So now we have more than one component emitting events: the generic `<Modal>`, and our custom `<MyModal>`.

Things can become complicated very quickly, but the easiest way to solve it is by introducing the concept of "modal dismissal". If the modal is closed from anywhere outside of our custom component, we can assume it's been dismissed. If we do that, we only need to add something like a `dismissed` boolean to our promise, and we're done:

```ts [modals.ts]
export async function showModal<T extends Component>(
    modal: T,
): Promise<GetComponentResponse<T> | { dismissed: true }> {
    // ...

    close(response?: GetComponentResponse<T>) {
        if (response === undefined) {
            resolve({ dismissed: true });

            return;
        }

        resolve(response);
    },

    // ...
}
```

## Putting it all together

TLDR, after following this guide, you'll be able to use Vue modals like this:

{{ noparse }}

```html [MyModal.vue]
<template>
    <Modal title="My Awesome Modal">
        <button @click="$emit('close', { answer: `Hello, ${name}!` })">
            Close
        </button>
    </Modal>
</template>

<script setup lang="ts">
    defineProps<{ name: string }>();
    defineEmits<{ close: [{ answer: string }] }>();
</script>
```

```ts
import MyModal from './MyModal.vue';
import { showModal } from './modals';

const { answer } = await showModal(MyModal, { name: 'Guest' });
```

{{ /noparse }}

Isn't that beautiful!

You can of course start doing this yourself, as I've been doing in multiple projects [over the years](https://github.com/euvl/vue-js-modal/pull/175).

But I got tired of rewriting this time and again, so I also started working on a package to make this easier. If you want to start doing this in your apps, or dive deeper into the code, check it out in GitHub: [github.com/NoelDeMartin/vue-modals](https://github.com/NoelDeMartin/vue-modals/).

## Going further

That's it for the guide, but here's some parting thoughts:

- **Did I say modals?** This whole article I've been talking about modals, but the truth is that these ideas apply just as well to other types of overlays: snackbars, toasts, etc.

- **Did I say Vue?** And yes, this also applies to React, Svelte, and many other frontend frameworks.

- **What about accessibility?** I am very aware that I have simplified a lot here. If you want to handcraft modals in your apps, you'll need to take care of focus trapping, keyboard interactions, and a million other things.

    I chose not to get into that rabbit hole because that's something that component libraries are doing right, so you don't need to worry about it. If you're curious about doing this with existing libraries, I have [documented some integrations in my project](https://github.com/NoelDeMartin/vue-modals#third-party-integrations).

- **What about the native `<dialog>`?** A couple of years ago, we got baseline support for the native [`<dialog>`](https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/dialog) element; and it seemed like it would solve all of our problems. Unfortunately, [that's not completely true](https://notesonwork.com/episodes/modals-and-popover-woes). And to make matters worse, the DX deviates from how native overlays usually work, and you have to declare modals inline.
