---
id: learning-react-2
blueprint: comment
title: 'Learning React - 2'
task: 'entry::learning-react'
publication_date: '2025-12-11 20:23:00'
---

I have just finished the first 2 modules and the first project, and let me tell you... I'm going to rant 😅. If you're not in the mood for that, you may want to skip today's update. TLDR, Josh is still awesome, but I just don't like React (and I don't know if I ever will). But it seems like I'm going to be spending a lot of time working with React, so I may as well get this out of my system and accept that it is what it is.

Here's the long version:

The first 2 modules and the first project are actually the "Basic Package" of the course. So you could say I have "finished" the course, and I haven't changed my mind about React. If anything, it's gotten worse. Again, this is not Josh's fault! I still love his content, and it's thanks to him that I'm actually enjoying the course despite the incoming rant. But I just can't stand React.

If you haven't, take a look at this website: [Component Party](https://component-party.dev/?f=react-vue3). You can find a comparison of different situations solved with Vue and React. I struggle to find a single example where I'd prefer to use React (and by the way, if for some twisted reason you actually like JSX, [you can also use it in Vue](https://vuejs.org/guide/extras/render-function.html#jsx-tsx)).

Now, I understand that nothing is perfect, and software development is nothing but making trade-offs. The problem is, that I don't agree with any of the trade-offs made in React! Years ago, Evan You (the creator of Vue & Vite) talked about [Seeking the Balance in Framework Design](https://www.youtube.com/watch?v=ANtSWq-zI0s). In his talk, he goes into some of the common trade-offs found in frontend frameworks. And even though he tries to give an objective view where "all the decisions are valid", I think he fails at that. To me, this presentation is the perfect example of why Vue is better in almost every single way.

To his credit, Josh actually tackles many of the controverises with React, such as the [React vs Svelte](https://mccarroll.dev/blog/svelte) meme, or the JSX vs template conundrum. But he gives the same arguments I have already heard a thousand times. Basically, it boils down to these two: React is "just JavaScript", and he doesn't like "magic frameworks".

#### React is "just JavaScript"

This is probably the most common argument I've heard in defense of React, and I'll be blunt here: it's complete bullshit. I know JavaScript, I've even come to _like_ JavaScript. And yet, I'm constantly running into surprises with React.

And there's no better example than hooks, the beating heart of React. I linked to this in my previous update, but if you haven't seen it yet, I suggest that you read the [Rules of Hooks](https://react.dev/reference/rules/rules-of-hooks) in the official documentation. The very first rule says that you can't use hooks inside of something as essential to the language as conditionals or loops. And it doesn't get better from there. Sorry, I thought React was "just JavaScript"?

But I understand why this idea is used as a selling point for React (even though it is a lie). Because it builds on top of an even bigger idea that you also often hear React developers say: "Just use the platform". You know what's the platform? Even more essential to the Web than JavaScript? HTML!! And yet, this isn't valid React code:

```html
<h1 class="title">Hello</h1>
```

![Pulp Fiction meme of Samuel L. Jackson pointing with a gun saying "make me write className one more god damn time"](/img/tasks/react/pulp-fiction-meme.jpg)

#### "Magic" is bad

So yeah, we've already established that React is not "just JavaScript". But something else that's commonly used against other frameworks like Vue or Svelte is that they are "too magical". Josh even goes as far as using Ruby on Rails as an example of something to avoid 😱.

But what even is "magic"? Or rather, what's the difference between "magic" and encapsulation or tooling? I would say that React is pretty magical itself, given all the stupid rules for hooks, and the fact that JSX is not even valid JavaScript.

This is what Josh has to say about why React is better than these "magical frameworks":

> The React way has a steeper learning curve and it can feel a lot more high-friction, but now that I understand it, I never feel like I get lost in the woods. And that's part of what makes React so nice to use.

Well, you know what? I also went through a phase of learning the ins and outs of Laravel (a framework very similar to Ruby on Rails), and nowadays I don't get "lost in the woods" either. So if you have to go through a "steep learning curve" anyways, why does it matter if something is "magic" or not?

To me, the only difference between "magic" and encapsulation or tooling is that "magic" is a mechanism you don't understand. For example, Active Record is pretty magical, and it's also often used as an example of a bad practice. But it's one of my favorite patterns, and given that I understand it (I've even built [my own Active Record library](https://soukai.js.org/)), I don't get "lost in the woods".

#### The Joy of React

So, let's be honest here. People who prefer React over Vue/Svelte just like it better. And you know what? That's ok! It is a perfectly good argument. And ultimately, that may be the reason why I prefer Vue myself. I just feel more joy using it than React. But don't tell me that it's "just JavaScript" or "not magical".

When I started taking the course, I mentioned that I was looking forward to see why Josh thought React was so wonderful. Because I enjoy his courses, and I really respect his opinion. However, at some point in the course he mentions why React is so "joyful", and I have to say that I'm a bit disappointed. Basically, he compares it to Backbone and jQuery, and says how wonderful it is to build applications in a declarative manner, without having to fiddle with the DOM yourself. But that is true of all modern frontend frameworks, not React alone.

Maybe you are thinking that this should've been obvious before starting the course. But believe it or not, I actually read the FAQs, and there is one answering the question "Is this course right for me?" that says that the course is also for "Angular/Vue developers who just can't get the hang of React" 🤷.

---

Anyways, I hope I've gotten everything out of my system now, and I can focus on enjoying the rest of the course :). Despite what I said, I want to clarify that I still like the course, and I don't think it's been a waste of money. Once again, I'll say that Josh is awesome and I love his courses. The entertainment value alone is worth it. But I can already confirm it's not going to make me love React.

I'll end this with yet another quote from the course, and one I agree with 100%:

> When learning a new technology, it's natural to try and squeeze it into a familiar shape. But I promise you, you'll have a much better time learning to swim with the current, rather than trying to fight against it.

PS: To add a final nail to React's coffin, did you hear about last week's [React2Shell debacle](https://www.youtube.com/watch?v=QLK9G5zyU-Q)? I haven't gotten into Server Components yet, but that's yet another reason to avoid them! Not that this bug itself is a problem (it should be fixed by now), but the fact that this can happen with a "frontend" framework... yeah, isn't great.
