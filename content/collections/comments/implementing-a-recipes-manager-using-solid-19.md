---
id: implementing-a-recipes-manager-using-solid-19
blueprint: comment
title: 'Implementing a Recipes Manager using Solid - 19'
task: 'entry::implementing-a-recipes-manager-using-solid'
publication_date: '2022-10-29 08:25:09'
---

Hey, so now that summer is over and I'm heading back into a more productive season, I thought it was time for a new update.

Since the last time I wrote here, I've been on and off work for holidays and such, but overall I've made good improvements. I got a lot of feedback in GitHub, and that's mostly what I've been tackling (thanks to everyone who contributed!). I also implemented a couple new features that arised from suggestions or pains whilst using the app myself. You can find everything I've done in [the changelog](https://github.com/NoelDeMartin/umai/blob/main/CHANGELOG.md), but here's some highlights:

- Added the ability to see all of someone's public recipes in the viewer, and also to publish unlisted recipes.
- Added a servings selector, which automatically recalculates ingredient quantities. It's a bit clunky, but I think it's a good experimental feature to have that isn't too intrusive.
- Added a settings modal to configure language, animations, error reporting, and proxying for importing recipes.
- Improved error handling.
- Improved a bunch of interoperability use-cases.
- Improved a bunch of accessibility issues.

From those, there are a couple that are interesting to delve into in the technical side.

The first one, interoperability. Overall, I was quite worried about this, and didn't want to dedicate a lot of time if anything difficult came up. But I have to say, at least with the tests I've done, it was easier than expected. You can get an idea of the things I did looking at [the interoperability tests](https://github.com/NoelDeMartin/umai/blob/main/cypress/integration/interoperability.spec.ts), maybe the most interesting is the ability to work with both `http://schema.org` and `https://schema.org`. There's been [a lot of headaches](https://github.com/linkeddata/rdflib.js/issues/550) with this in the RDF world, but in the end I found a decent way to do it. By default, my application will use https, but as soon as it finds a recipe using http, it will switch to that. This was very easy to achieve thanks to [soukai](https://github.com/noeldemartin/soukai-solid). Because I have all the RDF stuff encapsulated in the library, I [hardly had to change anything in the app](https://github.com/NoelDeMartin/umai/blob/main/src/services/CookbookService.ts#L261..L279) to make this work. I could even have a setting to let users choose which one to use, but I decided not to include it to avoid confusing people. The frustrating part about interoperability, though, is that in part it's outside of my control. It'd be nice if other apps worked this way, but the reality is they won't. There's nothing I can do if they are not able to interpret the recipes generated in my app. Hopefully, in the future, this type of solutions will be included at the library or protocol level, so that the entire ecosystem can benefit.

Another thing worth mentioning is accessiblity. Some months ago, I learned about it in my job at [Moodle](https://moodle.com/). But I wasn't too sure of what I was doing, because even though we passed [one of those corporate accessibility reviews](https://www.webkeyit.com/accessibility-services/digital-accessibility-audit-and-accreditation/), I didn't interact with real users with accessibility requirements. And I wasn't going to pay for this type of service for Umai. So I was very lucky to find [someone](https://devinprater.flounder.online/about.gmi) who [oferred to test it for free](https://devin.masto.host/@devinprater/108544233098896674). And I was super glad to get his reply: "it's one of the easiest and most simple web apps I've ever used". 🥳 So yeah, that was nice. If you're interested to learn about a11y as well, I'd recommend getting started with these resources:

- [BingO Bakery: Headings, Landmarks, and Tabs](https://www.youtube.com/watch?v=HE2R86EZPMA) — Video introducing some basic concepts.
- [ARIA patterns](https://www.w3.org/WAI/ARIA/apg/patterns/) — Learn about common components.
- [ARIA DevTools browser extension](https://chrome.google.com/webstore/detail/aria-devtools/dneemiigcbbgbdjlcdjjnianlikimpck) — Navigate a site like a non-sighted user would.
- [headingMaps browser extension](https://chrome.google.com/webstore/detail/headingsmap/flbjommegcjonpdmenkdiocclhjacmbi) — Navigate page headings.
- [Landmarks Navigation browser extension](https://chrome.google.com/webstore/detail/landmark-navigation-via-k/ddpokpbjopmeeiiolheejjpkonlkklgp) — Navigate landmarks.
- [Accessibility Pane in Chrome](https://developer.chrome.com/docs/devtools/accessibility/reference/#pane) — Inspect accessibility roles and values.

Something else that gave me some problems is that Inrupt's WebIds are not editable, which broke all my assumptions about WebIds and logging into Solid PODs. Logging in itself is not a problem, since [Inrupt's library](https://github.com/inrupt/solid-client-authn-js/) does all the heavy lifting, but when it comes to [type indexes](https://github.com/solid/type-indexes) and such, it's a mess. It wasn't too hard to fix for now, but this is unfortunately still under discussions so it may break again in the future. If you want to learn more about it, you can read this issue: [solid/webid-profile#40](https://github.com/solid/webid-profile/issues/40).

And with all that, I'm confident now that the application is ready for its initial release. That is, functionality-wise. I still need to do all the releasy stuff: documentation, releasing stable versions of the dependencies, etc. I'm still not super happy with the stability and performance overall, because I think it's a bit clunky and I've seen more errors than I'd like while polishing. But I won't be working on any of this for now, because I want to get the first version out of the door already.

Looking at this task's history, I realize I started working on it on December 8th, 2020. So I guess that's a decent deadline to keep in mind, and wouldn't it be funny to release it exactly on that day? 😅 In any case, I'm in the home stretch now. If I manage not to get too caught up in the documentation, it should be done soon.
