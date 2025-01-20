---
id: implementing-a-task-manager-using-solid-9
blueprint: comment
title: 'Implementing a Task Manager using Solid - 9'
task: 'entry::implementing-a-task-manager-using-solid'
publication_date: '2018-12-22 21:29:18'
---

Finally I went around improving the network usage. I used two strategies:

- **[Globbing](https://github.com/solid/solid-spec/blob/master/api-rest.md#globbing-inlining-on-get):** As I explained previously, this is currently the best way to get a bunch of records in one request from a solid POD. At some point SPARQL should be supported and replace this for most scenarios. Something new I found that I wasn't expecting is that globbing only works for resources, not containers (meaning you can get a list of all the resources within a container, excluding containers, so it isn't recursive).
- **Lazy Loading:** In order to improve the requests overall, regardless of batching or not, sections are only loaded after being visited. Instead of loading everything at once as I was doing until now.
