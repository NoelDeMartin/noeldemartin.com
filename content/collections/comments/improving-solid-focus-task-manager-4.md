---
id: improving-solid-focus-task-manager-4
blueprint: comment
title: 'Improving Solid Focus Task Manager - 4'
task: 'entry::improving-solid-focus-task-manager'
publication_date: '2019-04-15 19:11:10'
---

Today I completed the migration to Soukai. All the data management operations to interact with a Solid POD are now delegated to [soukai-solid](https://github.com/NoelDeMartin/soukai-solid) (except authentication that's still using `solid-auth-client`). One example of a model defined with soukai-solid can be found [here](https://github.com/NoelDeMartin/solid-focus/blob/23f61def82d6fd78c7a5b0eb744b7c73a7a07735/src/models/soukai/Task.ts).

I believe this is an important stepping stone for me to start creating Solid applications. Using this library I can focus on app development and encapsulate Solid specifics. During the development of the library, I've been asking some members of the Linked Data community what's their opinion on this, and most of them agree that the complex relations between LD documents cannot be fully expressed with objects. That's why an ODM comes as an unorthodox approach. I still have to look at LDFlex again, because last time I checked it was lacking some features that I've been told are now available. But my opinion is that using both approaches should be compatible and even preferable. My opinion is heavily biased given my background, in particular working with Laravel's [Eloquent](https://laravel.com/docs/5.8/eloquent). That's why once I have documented and cleaned up the repositories, I'll open a thread on the Solid forum to discuss both approaches and learn more about the topic. It may be my inexperience with Linked Data talking, but I see a lot of value on combining both approaches. I'll expand on this when I open the forum thread.

Also continuing with something I mentioned last time, I've updated the deployment strategy for the javascript libraries using npm. As noted on the previous comment, I created a dev branch with the new changes, but the problem was that it wasn't possible to reference that branch from CI services (because they pull from the npm registry). I was struggling to find a good solution, until I found out about [npm tags](https://docs.npmjs.com/cli/dist-tag). The idea is that once a new version of a package is pushed to npm, it's by default tagged as `latest`. But this can be overriden, and I've started using the `next` tag to publish development versions of the libraries. The name of the version also indicates that it isn't stable with the suffix `-dev.{commit hash}`. This solution is still not perfect because I'm forced to commit changes to `package-lock.json` frequently, but it's the best approach I could come up with. When I start doing releases I'll see how cumbersome it really is.

Now what's left of this task is to document the changes to the libraries and implement more tests for new features regarding Soukai, and I'll finish by finally implementing some new features.
