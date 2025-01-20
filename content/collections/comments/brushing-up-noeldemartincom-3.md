---
id: brushing-up-noeldemartincom-3
blueprint: comment
title: 'Brushing up noeldemartin.com - 3'
task: 'entry::brushing-up-noeldemartincom'
publication_date: '2019-09-22 09:38:44'
---

These days I've been playing around with [Laravel Nova](https://nova.laravel.com/).

My initial impressions were great. The installation process was a breeze, and I had a functional dashboard within an hour. The work involved to get there is fairly minimal, you only need to install Nova through composer and create a Nova Resource for each Eloquent Model. In order to learn the basics about Nova, I'd recommend watching [Taylor's Keynote at Laracon US 2018](https://www.youtube.com/watch?v=pLcM3mpZSV0). That's all I had seen before getting started and it was enough (along with [the docs](https://nova.laravel.com/docs) of course). There is also a [series on Laracasts](https://laracasts.com/series/laravel-nova-mastery), but I have to say I didn't enjoy it too much. Maybe because it wasn't Jeffrey Way doing it?

After the initial integration, I spent some time trying some advanced features and customizations. I didn't find the customization as easy as I expected, although I have to say I didn't spend too much time on this because they were only some nice to haves. Fortunately, most of the things I wanted to do were already available as community packages. I used these two: [a responsive theme](https://github.com/gregoriohc/laravel-nova-theme-responsive) and [a url field](https://github.com/inspheric/nova-url-field). More packages can be found on [novapackages.com](https://novapackages.com/).

But not everything was covered by packages. I write my content in markdown, and this is something Nova already supports with a Markdown field. However, this field stores the markdown on the database and renders the html with javascript on the frontend. In my current setup, I am creating the html on the server and storing it to the database as well, so there are two attributes affected by this field. I couldn't find an easy way to customize the markdown field to do that _(read the next comment for an update on this)_. So I decided to register model listeners for `saving` events and update the html attributes before saving the changes. I could also have converted the markdown to html on each request before rendering the views, but I decided to keep my application code unchanged and do all of this on the Nova side. I had to do this with multiple resources, so I used a boot method similar to the one in Eloquent models. Check it out on [this gist](https://gist.github.com/NoelDeMartin/fcc3dd15030c2137f2d5b7d871c73086).

In summary, it's easy to integrate and it can save you a ton of work. I am already writing this from Nova, so I'd recommend anyone to check it out.
