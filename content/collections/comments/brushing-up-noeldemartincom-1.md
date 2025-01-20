---
id: brushing-up-noeldemartincom-1
blueprint: comment
title: 'Brushing up noeldemartin.com - 1'
task: 'entry::brushing-up-noeldemartincom'
publication_date: '2019-09-11 10:36:12'
---

I've just finished upgrading the website to Laravel 6.0 using [Laravel Shift](https://laravelshift.com). The previous version I had running was 5.7, so I've had to run 2 Shifts: `5.7 to 5.8` and `5.8 to 6.0`. The whole process took me about an hour from start to finish; from creating the account to deploying the changes. I had to pay a total of 22$.

Overall I'd say it was a good experience. The Laravel [upgrade notes](https://laravel.com/docs/6.0/upgrade) indicate that this process should take about an hour for each version, which makes it a total of 2 hours plus testing, deploying, etc. So I could say I saved myself an hour here.

Now, there are some things to keep in mind.

First, Shift gets more expensive the older your Laravel application gets. This means if I stay up to date from now on, doing this will be cheaper.

Second, my website is a very simple application, it does little else than CRUD operations and there is almost no business logic (publishing posts and tasks, that's it). On the one hand, this means I could have done the migration myself without too many hurdles, which makes automating this less valuable. On the other hand, it's easy for me to trust the automation without looking at the changes, because the application is so simple that it was easy to see that nothing was broken. I guess it all comes down to how much you trust your tests, and if you do, Laravel Shift is awesome. (If you don't, you should reconsider why not and fix them.)

There are also some things I would improve.

The way this works is that Shift opens a PR in your repository with the upgrade changes, and it includes some comments with additional details. I found some of the details lacking information or too vague. There was for example one comment against using strings for class names, but it didn't indicate which files had the problem.

Something else I'd improve is the access to the [Shifty Coders](https://laravelshift.com/shifty-coders) community. This is a Slack community that is recommended on the PR in order to get help, but I was not thrilled to learn that it's a paid community. I don't have problems with paid communities in general, but in this case when it's being suggested as a place to get help using a paid service, I don't think it should be. Specially since I'd probably only use it to get help with the service. If I'd be interested in a community for all things Laravel, there are others that may or may not be better.

In summary, I'm happy with the experience and I'll probably use it again. I'm looking forward to test it with a bigger project to see if my opinions holds up.
