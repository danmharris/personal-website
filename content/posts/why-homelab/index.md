---
title: "Why have a Homelab?"
date: 2020-03-05T20:00:00Z
---

When you enter my flat, you can hear the faint hum from the cupboard. Peering into it reveals a stack of networking and server equipment. When people see this, they often ask: What's this all for and why do you have it? Homelabbing, as it's known, is a hobby where people have enterprise level networking infrastructure and a variety of servers in their own home. It's something that I had been doing on-and-off for about 5 years but more actively for the last 6 months (now that I have my own home). In this post I want to discuss the reasons behind why I do it; who knows maybe I'll get some others interested! In a series of other posts I'll discuss anything of interest in my setup.

## You learn a lot

Last year I started full time work for a software company, that requires some networking/sysadmin know-how to do the job effectively: things like configuration management for example. By having a lab at home, I can mess around with similar technologies to work without the risk of messing anything up and at my own pace. Likewise it means I don't waste time at work sitting on the software docs trying to work out how to do something.

It has also opened my eyes into key best practice in the industry. Things like security and automation are much clearer to me now and I feel I have a deeper understanding of why they are necessary and the processes involved.

## You're in control

You always read about how an online service has been harvesting and selling data to third parties or having a data breach, resulting in your personal information being plastered somewhere. If you run services yourself, you do not need to worry about privacy as you are in control of the data. In addition, your services are isolated so that you can only access them when you're at home. Want to access them away from home? Having a VPN such as OpenVPN installed means I, and only I, can get back into my network as if I was at home.

One notable example of this is Nextcloud, which in fact at the time of writing has just released version 18 which provides many cloud like services such as a native calendar, email Client, notes app and file sharer. I've recently set this up to auto backup my photos I take on my phone instead of uploading them to Google Photos, which works just as seamlessly.

{{< figure src="nextcloud.png" alt="Nextcloud Calendar" caption="Like any other online calendar, just mine." >}}

## It's handy to have there

To be honest, some of the things you can get going are just plain useful. If you can think of it there is definitely a piece of software out there that can do it for you. My go-to place is the awesome-selfhosted list which gives lists of open source, self hosted software for a variety of categories.

Ny favourite ones which have been the document storage tools, for which I use a couple. I have a simple wiki set up that is a place to jot anything down that I may need to refer to later: things like my WiFi passwords or how to do something on an appliance I own. The other is Bookstack which I use for recipes. Anytime I find a recipe I like I add it to there. As the name suggests it arranges everything in books and chapters, akin to a recipe book which is why I find it useful for this. That's one thing I like to tell people of how "I have a web server for storing my recipes on".

{{< figure src="bookstack.png" alt="BookStack page" caption="I have all my recipes at my disposal now" >}}

As mentioned above, homelabbing teaches you to follow best practice. Probably one of the most useful one of these is in regards to backups. In my lab I have built a backup infrastructure that ensures my data is replicated and minimises the risk of loss. For instance, the Nextcloud data mentioned above is stored on my NAS which backs up weekly  to an external drive. Every time I go back to see family I sync the NAS to a portable drive which is taken with me and synced to a drive there.

## Its fun!

Lastly - and possibly most importantly - like any other hobby homelabbing is just fun. Yes it can be an expensive one and yes it can be quite frustrating at times; especially when a service isn't working and you have to sit there to try and fix it otherwise you won't be getting online. But that also brings quite a lot of satisfaction when something does get going. It gives me something to do when I'm bored and if I'm not feeling it one week then it just chugs away in the background.

There's also an active online community for this sort of thing. /r/homelab is full of people sharing what they've done, helping others and giving ideas on tools they could use. There's a wide range of skill levels and industries: you don't have to work in software/IT to be into this sort of thing.

{{< figure src="grafana.png" alt="Grafana Dashboard" caption="Network dashboards become an addiction..." >}}
