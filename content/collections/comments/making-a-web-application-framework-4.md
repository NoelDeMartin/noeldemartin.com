---
id: making-a-web-application-framework-4
blueprint: comment
title: 'Making a Web Application Framework - 4'
task: 'entry::making-a-web-application-framework'
publication_date: '2023-12-10 09:50:31'
---

It is done! We have a full-fledged\* Solid App built with AerogelJS: [Ramen](https://ramen.noeldemartin.com/)!

(\* Well, maybe saying "full-fledged" is stretching it a bit, it's a very simple app 😅️)

It has taken a bit longer than I expected for a couple of reasons, but overall I'm quite happy with the end result. If you're curious, I suggest that you go straight to the [source code](https://github.com/noeldemartin/ramen), because the UI is exactly the same as before.

One of the reasons for the delay has been [yak shaving](https://seths.blog/2005/03/dont_shave_that/). Or maybe said differently, over engineering. [I've talked about this before](https://noeldemartin.com/tasks/housekeeping-2023) (it's actually a recurring theme of this journal), but I think I've got a new twist on it. I've realized that the source of all my misfortunes is my tendency to DCDD ([Dream Code](https://nobackend.org/2013/05/welcome-to-noBackend.html) Driven Development, I just made that up).

For example, let's take a look at one of the integration tests for Ramen:

```ts
it('Teaches Ramen', () => {
    // Arrange
    cy.intercept('PATCH', cssPodUrl('/cookbook/juns-ramen')).as('learnRamen');

    cy.createSolidDocument(
        '/settings/privateTypeIndex',
        'privateTypeIndex.ttl',
    );
    cy.updateSolidDocument(
        '/settings/privateTypeIndex',
        'register-cookbook.sparql',
        { cookbookId: '#cookbook' },
    );
    cy.updateSolidDocument('/profile/card', 'register-type-index.sparql');
    cy.createSolidContainer('/cookbook/', 'Cookbook');

    cy.ariaInput('Login url').clear().type(`${cssUrl()}{enter}`);
    cy.cssLogin();

    // Act
    cy.see("You don't know how to make Ramen");
    cy.matchImageSnapshot();
    cy.press('Teach me');

    // Assert
    cy.see('You know how to make Ramen!');
    cy.see(`Your Ramen recipe is at ${cssPodUrl('/cookbook/juns-ramen#it')}`);

    cy.get('@learnRamen').its('response.statusCode').should('eq', 201);
    cy.fixture('learn-ramen.sparql').then((sparql) => {
        cy.get('@learnRamen').its('request.body').should('be.sparql', sparql);
    });
});
```

This test is quite short, but there are a lot of things going on: [Snapshot Testing](https://jestjs.io/docs/snapshot-testing), [Accessibility Testing](https://www.w3.org/WAI/standards-guidelines/aria/), [Solid CRUD Testing](https://github.com/CommunitySolidServer/CommunitySolidServer), etc. It is indeed encapsulating a lot of complexity, but you wouldn't say that the code itself _is_ complex. This is what I mean with [conceptual compression](https://www.youtube.com/watch?v=zKyv-IGvgGE&t=1037s). And this is the type of code I consider [good code](https://noeldemartin.com/blog/10-years-as-a-software-developer#2-write-good-code).

The problem, of course, is that reaching that point takes a lot of effort. This is now [real code](https://github.com/NoelDeMartin/ramen/blob/f41add1f29dac86b306a7aac109205cc6185f5bc/cypress/e2e/cookbook.cy.ts#L36..L61), but getting there was not straightforward. And I wonder about the alternatives. Surfacing all that complexity to the end user? Doing less? I'm in favour of the latter, but certainly not the former. Although I realize there is such a thing as overdoing it, and I have a tendency to compress too early. This is something I've known for a while, but I recently read a blog post that may finally get me to improve: [Live with it for a while](https://world.hey.com/jason/live-with-it-for-a-while-a9191f5f).

So yeah, my over engineering afflictions are still ongoing. But I have a renewed resolve to alleviate them by doing less and living with "bad code" for a while.

However, this time I cannot attribute all the delays to my over engineering. It seems like I've also started to feel a bit of [maintenance burden](https://nolanlawson.com/2017/03/05/what-it-feels-like-to-be-an-open-source-maintainer/). Nothing like the author of that post, but for a couple of weeks it seemed like I wasn't making any progress. And after some reflection, I realized I had spent too much time doing reactive work; things people asked of me or caused by some external dependency.

Not that it was all bad, though, many good things came out of those: giving feedback for [rdfjs.dev](https://rdfjs.dev/), giving feedback for [soukai-solid-utils](https://github.com/pondersource/soukai-solid-utils), participating in the [Solid Practitioners](https://github.com/solid-contrib/practitioners/blob/main/meetings/2023-11-10.md) group, etc. Although I probably spent more time on some of them than I should (of my own volition by the way, I'm not saying that anybody coerced me into contributing). But there was one particularly nasty task of [rewriting all my CSS testing helpers](https://github.com/NoelDeMartin/aerogel/commit/295a894bf18ef6c653e7296f8a56dc93ff238acb) because [the account management architecture changed completely in 7.0.0](https://github.com/CommunitySolidServer/CommunitySolidServer/commit/a47f5236ef651dd8eaeb344fd83c7ef82f9730ac).

I suppose those are the cost of doing business though, and I'm aware this is nothing compared to what popular repository maintainers must go through. For the most part, I still feel like [no one is looking](https://noeldemartin.com/blog/working-in-the-open-when-no-one-is-looking), but I get [some interactions](https://github.com/NoelDeMartin/aerogel/issues/1) from time to time. And I'm still torn on whether that's a good thing or a bad thing. One the one hand, I like the fact that I can be left to my own devices and just enjoy the work that I do. On the other hand, it would be nice that my work is useful to more people. But as Naval says, [it's better to be anonymous and rich than to be poor and famous](https://youtu.be/3J0CKZLsF-s?si=RmFZ5_DUWWTP1F5z&t=104). And being a popular open source maintainer certainly takes you down the path of "poor and famous". So I'm fine being anonymous and well off for the time being.

Now that I'm done with the fundamentals of the framework, and I have proved that I can make a "real app" with it, the next step is to actually start doing something useful. I have two possibilities at the moment: [migrating Solid Focus](https://github.com/NoelDeMartin/solid-focus/issues/10) (which I'll probably rewrite from scratch) or migrating [Media Kraken](https://noeldemartin.github.io/media-kraken/) and implement [TV Shows tracking](https://github.com/NoelDeMartin/media-kraken/issues/5). As much as I'd like to do the latter, it's more likely that I do the former, because Solid Focus was my first Solid App and it is the one in more need of a facelift.

Whatever I decide, I won't have any updates until January so I hope you enjoy the end of the year and have a chance to spend it with the ones you love. As for me, I can't wait to do [my end of year ritual](https://noeldemartin.social/@noeldemartin/105525557154075833) and I'm looking forward to yet another lap around the sun in this hunk of stone.
