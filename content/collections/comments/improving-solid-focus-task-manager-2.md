---
id: improving-solid-focus-task-manager-2
blueprint: comment
title: 'Improving Solid Focus Task Manager - 2'
task: 'entry::improving-solid-focus-task-manager'
publication_date: '2019-02-25 18:06:42'
---

Last week I released a new version of the app with some UX improvements and bug fixes. You can check the details [here](https://github.com/NoelDeMartin/solid-focus/releases/tag/v0.1.1).

I'll now start working on the data layer integration. The current implementation is quite naive, because I wanted to learn the basics and know what's going on under the hood. But it's clear that it wouldn't be scalable to continue working on the application.

I saw Ruben Verborgh's LDFlex library, which he introduced in [this post](https://ruben.verborgh.org/blog/2018/12/28/designing-a-linked-data-developer-experience) and I'd recommend you to read. I want to take another look to see how it works, but I'm more inclined to use a different approach to manage models and decouple that from the UI components as much as possible. I'm used to doing that in my applications, because I've done most of my data management with Laravel through an API. So I'd like to keep a similar workflow that's worked so well for me. But I have to keep in mind that this is a different paradigm and that may not be the right approach.
