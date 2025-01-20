---
id: implementing-a-media-tracker-using-solid-8
blueprint: comment
title: 'Implementing a Media Tracker using Solid - 8'
task: 'entry::implementing-a-media-tracker-using-solid'
publication_date: '2020-06-09 19:30:59'
---

It's been a month since the last update, but at least I can say that I've finished the refactor! I am confident that the foundations are done and I'll close the task in the next update.

Before I go into the details of the refactor, here's a diff of the changes in [soukai](https://github.com/NoelDeMartin/soukai/compare/4c8e6f1...e92e7a8) and [soukai-solid](https://github.com/NoelDeMartin/soukai-solid/compare/8b31b2f...03cde1f). I don't expect anyone to understand them, but you can see the magnitude of what I've been working on. Definitely not trivial, more on this later.

In my previous update I mentioned the motivations to follow this path. I've continued learning about JSON-LD and RDF data structures, and [I posted](https://forum.solidproject.org/t/how-should-embedded-entities-be-declared-in-the-type-index-registry) some of my doubts in the Solid community forums. Turns out I was missing more core concepts than I thought.

An important one is the fact that a Solid document doesn't necessarily need to declare a resource with the same url. For example, you could have a movie stored at `https://your-pod.com/movies/spirited-away` but the movie resource could have the id `<https://your-pod.com/movies/spirited-away#it>`, and it's actually not that uncommon. Something else I was assuming is that related resources would be stored in the same document, for example WatchActions. Yes, my application will store them in the same document, but this doesn't mean that the application should break if some actions are moved to different documents.

What this boils down to is that the proper way to store a Solid Document in JSON-LD format is a [graph object](https://www.w3.org/TR/json-ld/#graph-objects). And this, unfortunately, complicates things a lot. This means that a simple model update has to be translated, at the engine layer, to updating an item within an array. In order to tackle this, I've been looking how some NoSQL databases manage this kind of data. One that I've used previously and I like is [MongoDB](https://www.mongodb.com). So my current implementation is very much inspired by that.

Another consequence of this paradigm shift was refactoring relations. The implementation I had before was quite simple, and that's why they didn't handle all the use-cases. My initial approach had been to look at [Laravel relationships](https://laravel.com/docs/7.x/eloquent-relationships), but this time I went to [Rails' Active Record Associations](https://guides.rubyonrails.org/association_basics.html) . One of the main reasons why I did this is that Rails has [a decent mongodb driver](https://docs.mongodb.com/mongoid/master/tutorials/mongoid-relations), whereas Laravel doesn't.

One last thing to mention about the refactor is how nice testing has been. I had already done TDDish development in previous versions, and this meant that I could be confident to move things around knowing that tests had my back. To my surprise, I run a coverage report for the first time and both soukai and soukai-solid had more than 90% coverage, which is nice. Of course, the real proof that tests have my back will come when I upgrade the dependencies in Solid Focus and see how many regressions I find.

I still have to update the documentation for both projects, so I will process all the information I vomited above into the docs.

Now that I'm done with that huge detour, it's time to get back into retrospective mode.

This time, I felt the weight of the project and its complexity. One the things I need to improve is that I'm prone to overengineer. And I'm 100% sold on simplifying, but the thing is that simplicity is hard, possibly more than complexity. I percieve something as simple and before I know it I'm within a rabbithole of complexity. But even in hindsight I'm not sure that I could have done this any simpler, and I don't want to dedicate it more time. The problem is inherently complex, after all I'm trying to implement an Active Record library for Semantic Web technologies, and that's not trivial. Specially given that I'm not an expert in either of those domains. Maybe I shouldn't even we working on this problem at all.

In any case, I am fortunate to be able to dedicate my time on these things and potentially waste it. As I already knew, library development is a completely different beast to application development and I'll have to continue pondering on the correct way to approach it.

For now, it's back to appetite, application and release mode.
