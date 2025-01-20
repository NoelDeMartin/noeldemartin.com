---
id: implementing-a-recipes-manager-using-solid-6
blueprint: comment
title: 'Implementing a Recipes Manager using Solid - 6'
task: 'entry::implementing-a-recipes-manager-using-solid'
publication_date: '2021-04-16 15:48:53'
---

Hi again!

It's been only a week since I updated this task, but I decided to go ahead and kickstart the next cycle. The conversations about [authentication](https://forum.solidproject.org/t/authenticating-offline-first-solid-apps/4208) and [CRDTs](https://forum.solidproject.org/t/request-for-comments-crdtish-approach-to-solid/4211) are still ongoing, but I didn't get any strong arguments against what I had in mind, so I'll start working on it. There are some concerns that I haven't resolved, but I think the best way to proceed is to start working on the real thing.

As part of the shaping process, I implemented a proof of concept using a Solid POD to sync changes across devices:

<a href="https://noeldemartin.com/videos/umai-crdt.mp4" target="_blank">
    <video autoplay loop>
        <source src="/videos/umai-crdt.mp4" type="video/mp4">
    </video>
</a>

There is a lot of hard-coded parts, that's why I didn't push this code to github. But I am very pleased with the result.

So, for this cycle I'll focus on the following:

- **Offline-first:** This may seem small, but there are actually a lot of things to do here. My intention is to be done with the data layer after this, so it should take the main focus.<br><br>
- **Recipe ingredients:** This is important to see that the offline-first approach works for more complex structures, like lists.<br><br>
- **Interoperability:** Like last time with the vocabs, this is sort of a wildcard goal. So maybe I won't do anything, but the idea is to be compatible with other apps who would interact with the POD storing the recipes.

The cycle should be done by May 31st.

You may notice that this cycle still doesn't have many features in scope. My idea right now is to use this cycle to get all the non-UI stuff finished, and focus the next cycle on UI, branding, and adding more features. Although I cannot tell for sure because that's the whole point of the Shape Up methodology.

So yeah, the first version of the app won't be finished at least until July. But that's ok, I'm in no rush.

PS: Google recently started [tracking people using Google Chrome](https://plausible.io/blog/google-floc), even if your site doesn't use Google services. You can prevent it by adding an HTTP header, as I did with my sites. But I cannot do it in my apps because they are hosted using Github Pages, so I'm considering giving [render.com](https://render.com) a try. I'll report on the experience in a future update.
