---
id: improving-solid-focus-task-manager-6
blueprint: comment
title: 'Improving Solid Focus Task Manager - 6'
task: 'entry::improving-solid-focus-task-manager'
publication_date: '2019-05-10 17:41:49'
---

What I mentioned on the last comment took longer than expected, but I'm very happy with the results! In trying to improve the tests, I realized the responsibility of interacting with the data layer is actually encapsulated in the Soukai library. The different implementation I was using for the different modes was only because I was not saving the models. And yet, I was storing their serialization to LocalStorage. Which got me thinking, and what makes more sense is to have a LocalStorage engine implemented in Soukai, which is what I did. In doing that I also realized the responsibilities for the SolidModel and the SolidEngine (within the soukai-solid package) were also mixed up, and I ended up doing a whole refactor in Soukai as well.

In summary, Soukai engines now know nothing about models, as it should be. Which is nice because I've removed a circular dependency that may have caused headaches on the future (for example models working only for certain engines, as it was happening with Solid). And in Solid Focus I've moved all the engines to the Auth service. Which means it is now possible to implement new Soukai engines to work with the application. I don't think I'll do any in the short term, but I am for example using the InMemoryEngine for tests which solves the problem I had a couple of weeks ago.

If you didn't understand anything of what I'm talking about, head to the [Soukai docs](https://soukai.js.org). Depending at which point you visit them they may already have the changes I've talked about documented, since improving documentation for all three projects (Soukai, Soukai Solid & Solid Focus) is what I'll be doing next.
