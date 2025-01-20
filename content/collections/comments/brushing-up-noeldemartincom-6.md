---
id: brushing-up-noeldemartincom-6
blueprint: comment
title: 'Brushing up noeldemartin.com - 6'
task: 'entry::brushing-up-noeldemartincom'
publication_date: '2019-11-03 11:51:01'
---

It's taken almost a month but I've finally got my new laptop, and it's working like a charm. The laptop is [Asus TUF FX504](https://www.asus.com/us/Laptops/ASUS-TUF-Gaming-FX504/), and even thou it's a gamming laptop, I use it for development. I had my doubts about it, but so far I don't regret it.

I've continued with the improvements I had pending for the website, this time they were UI related. I've upgraded the [TailwindCSS](https://tailwindcss.com/) version given that 1.0 has been released, and I've also set up [PurgeCSS](https://www.purgecss.com/) for a smaller bundle. Together with other improvements (removing the title font, removing functionality that's covered with Nova, etc.) the JS and CSS assets are now very light, less than 100kb before gzipping. Which would be more impressive if it weren't because this website has almost no functionality, being a content site. On that note, I've also applied many ideas I got from reading [Refactoring UI](https://refactoringui.com/). Maybe the most impactful has been reducing the width of almost everything on the site for readability. The site is now taller, but hopefully easier to read and browse.

One last thing I did was unifying the navbar for mobile and desktop. On desktop, the navbar is fixed under the header. But in mobile it's a drawer toggled with a button in the header. I had this implemented with two elements whose visibility was toggled depending on the layout. I decided to change it to a single element and use CSS "magic" to change the styles depending on the layout. I was inspired to do this looking at [CSS Zen Garden](http://www.csszengarden.com/), and the end result is a single `nav` element. Which should be better for screen readers and accesibility.

I've stored some snapshots of the website in the wayback machine, so you should be able to compare the live site with [the archives](https://web.archive.org/web/*/https://noeldemartin.com/now) to spot some differences.
