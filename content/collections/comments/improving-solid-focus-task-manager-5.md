---
id: improving-solid-focus-task-manager-5
blueprint: comment
title: 'Improving Solid Focus Task Manager - 5'
task: 'entry::improving-solid-focus-task-manager'
publication_date: '2019-04-28 19:04:34'
---

I've been writing more tests with Cypress and it's awesome. I mentioned before that I wasn't able to set up Typescript for the tests, but I've finally fixed that (turns out I wasn't installing the `@cypress/webpack-preprocessor` npm package).

I had managed to do the first tests with relative ease, but it's true that I hadn't really got into it. I consider myself more of a [bottom-up learner](https://www.quora.com/What-is-bottom-up-learning), so I got into the Cypress documentation (that is great, btw) and started reading for a while. I'd recommend anyone who wants to use it to read this guide because it cleared a lot of my doubts: [Introduction to Cypress](https://docs.cypress.io/guides/core-concepts/introduction-to-cypress.html).

I've now finished tests covering the basic functionality, but I found a problem with the current approach. The application has two modes for data storage: Offline (local storage) and Solid. I did this at the beginning in order to isolate the functionality from Solid particulars, and I also think it could be useful for a lot of people who don't want to use Solid. But the problem with that is there are two implementations of the data management layer. It's not a problem per se, but the tests are now only testing the offline part. I could test the Solid implementation as well, but it would be pointless because the user interaction and expectations are all the same (so the tests would look the same except for the login). This could be solved if I delegate all the responsibility to Soukai instead. I could stub Soukai and make sure that it's used appropriately, then the production app would simply change between a Solid engine or a LocalStorage engine.

I'll try to tinker with that for a bit to see if I can come up with a decent approach. If I don't I'll just postpone it, because I have already planned to do this at some point to improve data synchronization (storing pending changes when the network is off, etc.).
