---
title: "Plans for WoT"
date: 2019-11-14T20:30:34Z
---
As part of my final year project at university, I created a basic implementation of a Web of Things network (more information can be found on my [project page](/projects/wot/)). It was my intention to carry on developing this project once I graduated, and evolve it into a much larger system than merely a proof of concept as it currently stands. I'm a bit delayed but now is the time to begin making those changes. This blog post will outline the key things I want to add over the coming months, and I'll check back in with progress when I can. Note that these are all changes on the servient, the client will need to be updated in order to suport these however this will come later.

## Services as Things
This was something I never thought of before, but it was mentioned at the W3C workshop I attended and it makes a lot of sense. Each of the services provide properties, actions and events. They can easily be represented as a thing to allow for even more decoupling with the client. Currently the client expects each endpoint of the thing directory for example to be at specific URLs and return data in a specific format. If the thing directory was presented as a thing, the client would be able to infer some of this. My favourite feature though would be the capabilities with events: right now if an [adapter](#bindings-adapters) produces a new device, I would have to go to the thing directory and tell it about this new thing description manually. What if the adapter emitted an event when this happened and the thing directory is subscribed to it? The device would automatically get registered, much better!

It would also make it abundantly clear what the authorisation requirements for each endpoint are, which will be handy for the authentication changes which I'll discuss later.

## Thing Directory Structure
Something that was sort of implemented in the current version is organisation of all the devices. Rather than having all the things grouped together in one long list, it'd be nice to have them grouped by room or by type and then allow for more complex queries in the lookup endpoints.

## Proxy
The proxy was always one of the services in this project where what I wanted it to do changed over time. In the beginning it acted as a reverse proxy, taking every property, action and event. But what became apparent is that using it as a caching proxy for _only_ properties is much more beneficial, that way you don't flood a low powered device with potentially many requests at once.

I'll admit it, I am one of those people who tries reinventing the wheel too many times because "its only a small feature I need" or "thats another library I have to update", even though feature creep is most definitely a thing and the external library can probably do it 1000% better than I can. This was definitely the case with the proxy. Before the [Redis](https://redis.io/) version I wrote a ring buffer with expiration myself for some reason, but now I've realised that I could use a pre-existing caching proxy to do the work for me.

The plan for this is to remove the proxy service from the servient entirely, as I'm now starting to believe that this should be a task left to the client as opposed to the servient; realistically the servient should be kept as basic as possible (thats what WoT is trying to achieve). I'm going to use something like [squid](http://www.squid-cache.org/) as my caching proxy, and then any API requests from the client to a property of a thing will go through this.

## ~~Bindings~~ Adapters
I realise now that adapters is a much more appropriate name, and creates less confusion with the "Binding Templates" that are used by WoT for extending the thing description with protocol specific details like methods and parameters.

And of course, I want to add adapters for more devices! I plan on buying some Tuya capable devices as those seem to be a significant chunk of the market, so I'll work to get those functioning.

## Authentication & Authorisation
The cornerstone to any IoT/WoT network is appropriate access control, to prevent anyone on your network just walking in and turning stuff on or off. The project currently uses [JSON Web Tokens (JWTs)](https://jwt.io/) which I feel are great for this sort of thing, as they remove the need for any centralised database or session management.

However I am currently only performing **authentication** with them, when really thats only half the story; I also need to perform **authorisation** to check that a user or service is allowed to perform a specific interaction. To this extent, I want to create a service that allows for [OAuth](https://oauth.net/2/) (a well known and used authorisation standard) flows. This can be integrated with my use of JWTs by encoding "scopes" into the token as it is generated, that specify what the authenticated entity is allowed to perform. Any other service can then check against these scopes to ensure that the entity is permitted to perform that action.

This will likely be significant amount of work as the service needs to authenticate users first in order to work out their authorisation, so building a database of login information and groups and providing a login page that supports the OAuth endpoints. That being said its not something I've delved into before so should be interesting.

## Updating Schemas
WoT is a rapidly advancing standard, which is to be expected for something still in the draft stage. The downside to this is that in the 6 or so months where I haven't been working on it _a lot_ has changed. I need to go through and make sure everything becomes up to date.

## Packaging and Deployment
The way the software is currently packaged and deployes is very non-production. All the Flask APIs use the inbuilt server, which will need replacing with some WSGI capable server. Also it is built and installed using a bash script when something like a Makefile would be much more flexible and suitable for such a task.

-

So that's the plan, which is indeed plenty of stuff to keep me busy over the next while. I now need to plan how I'm going to order and achieve all of these tasks, as they pretty much all need doing before I can have a production ready system. I'll probably start with the authentication and authorisation service first, as then I can integrate it into the other services as I work on them.
