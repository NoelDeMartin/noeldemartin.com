---
id: housekeeping-2
blueprint: comment
title: 'ousekeepin - 2'
task: 'entry::housekeeping'
publication_date: '2020-08-30 11:26:16'
---

I'm back! I enjoyed a couple of weeks away from the keyboard, and one of the highlights was doing part of the [Camino de Santiago](https://caminoways.com/ways/northern-way-camino-del-norte). We walked 150km in 6 days, and I'm looking forward to doing more of that in the future. This is a kind of tourism I don't do often, but I'll probably start doing it in other countries as well.

Back on the keyboard front, there's been [some](https://github.com/NoelDeMartin/media-kraken/issues/5) [activity](https://github.com/NoelDeMartin/media-kraken/issues/6) in the media-kraken repo. I've been accumulating some things I'd like to do before moving forward to a different project, and I'll probably do those before getting started with other housekeeping tasks. But definitely no new features for a while.

Something I can cross off the housekeeping list is a couple of things for the [cypress-laravel](https://github.com/NoelDeMartin/cypress-laravel) package. Jeffrey Way recently released [a Laravel package](https://github.com/laracasts/cypress) with a lot of overlap with my solution. But [it's not exactly the same](https://github.com/NoelDeMartin/cypress-laravel/pull/6#issuecomment-668616047), and there are some design choices that are different. For example, his solution consists of a Laravel package that publishes Cypress assets in the project and my solution consists of two packages - one for Laravel and one for Cypress. So I'll continue maintaining my own. Today I released [a new version](https://github.com/NoelDeMartin/cypress-laravel/releases/tag/v0.2.0) with support for custom commands, which should make it more extensible. I also closed pending issues and added the functionality to swap env files inspired by Jeffrey's package (and Laravel Dusk).
