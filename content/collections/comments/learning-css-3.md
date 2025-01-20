---
id: learning-css-3
blueprint: comment
title: 'Learning CSS - 3'
task: 'entry::learning-css'
publication_date: '2023-03-13 06:51:12'
---

In module 3, the course takes a small detour from pure CSS to foray into the world of building UI components. And it is done with [Styled Components](https://styled-components.com/) as our guide.

I'd heard of Styled Components before, but I'd never used them. In fact, I didn't like the idea of CSS-in-JS at all. But I took this module with an open mind and it wasn't as bad as I thought. Although I still prefer [TailwindCSS](tailwindcss.com/) :D. There is actually a page in the course comparing many of the popular approaches to building CSS, including Tailwind, and I have to agree with mostly everything Josh says. To me, the killer feature in Tailwind though is that you don't have to think about naming. And unfortunately, Styled Components still has that problem. Still, it was nice to learn about a new tool.

In any case, the tool is the least important in this module. The real point is to learn how to build UI components. One of the things he mentions from the get go is that he doesn't think it's a good idea to use component libraries for "real" projects, but they are good for prototyping or small endeavours. And I strongly agree with that, I've actually worked with a bunch of component libraries in the past, and there isn't a single time I haven't regretted it. They key problem I see with them is that it's usually fine to build cookie cutter UIs, but as soon as you want to do something more unique, you're in for a world of pain.

What I enjoyed the most from this module was the exploration of different UI Component design techniques (design in terms of architecture, not UI). There is a lot of nuance, but these are some lessons I would highlight:

- There are 3 ways to tackle customizations: composition, variants, and contextual styles.
- It is important to reduce the API surface (number of props) as much as possible.
- Convention over configuration: Make it easy to follow the defaults, but possible to break from them.
- Inversion of control nesting: Declare child styles in the component itself, not the parent.

Other than that, as ever, I also learned about a couple of features I didn't know: [Tagged templates](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Template_literals#tagged_templates), the [`revert` CSS value](https://developer.mozilla.org/en-US/docs/Web/CSS/revert), and [Chrome Live Expressions](https://developer.chrome.com/docs/devtools/console/live-expressions/).
