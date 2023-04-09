---
title: "Homelab Update: February 2023"
date: 2023-02-18T12:00:00Z
draft: true
---

It's been a while since I last posted on here! I'm planning on posting more regularly here, though we'll have to see whether that comes to fruition or not.
I thought as the first post back would be to give an update on the homelab which I last discussed when I [introduced Kubernetes]({{< ref "/posts/2021/delving-into-kubernetes/index.md">}}).

## The hardware

The hardware has remained _mostly_ the same for the last few years. The primary server/VM host is a Dell PowerEdge R210ii which has an i3, 16GB RAM and a 1TB SSD. This is still
adequate for my needs, though in June 2022 I added a new piece of hardware for compute: An HP T630 thin client. This was an experiment more than anything as they could, at least at the time,
be acquired relatively cheaply and use very little power. Again its been fine for my needs but unfortunately the price has jumped since then and I don't think I can justify getting
anything else like it.

The storage is on a Synology DS214j 2 Bay NAS with 2x3TB WD Red drives in it. Its pretty weak by today's standards but I don't hit it all too hard and I still have plenty of space on it.

## The software

Kubernetes is now my primary platform for running apps and services, and has grown quite significantly since 2021. I've learned a lot more of the workings of running a cluster
and also some tools and utilities for making this job a whole lot easier. Some of the additions are:

- [external-dns](https://github.com/kubernetes-sigs/external-dns) - Automatically creates DNS records for ingress resources on my DNS server, to save managing them separately
- [calico](https://www.tigera.io/project-calico/) - This is a container network interface (CNI) which replaces flannel from before. A nicety it has is BGP support. So I have it peering with my primary router and means
  I can give services IP addresses without the need for tools like metallb.
- [renovate](https://github.com/renovatebot/renovate) - Not _really_ just for Kubernetes but I added this on a CronJob to check the manifests for potential updates. This makes keeping apps up to date a lot easier.

I've been making a strive to have as much infrastructure as code as possible now, and removing the need to do any manual clicking around in interfaces or commands in a terminal.
To help with that I've been making more extensive use of [Ansible](https://www.ansible.com/). It is now responsible for making VMs, setting up the OS of them and creating any necessary DNS records.
There's also a complementary playbook to tear them back down. For a while I did this resource creation with [terraform](https://www.terraform.io/), however I felt the Ansible integration was a bit nicer for this use case.

That doesn't mean to say I don't use terraform. Most recently I have begun moving configuration of the software itself (rather than the provisioning) into terraform configuration.
Things like managing databases and eventually my SSO configuration. There seems to be much better community support for these type of providers; previously I ran into issues with
ones for tools like Proxmox and PowerDNS.

## Upcoming plans

In the short term the major change is going to be a new primary server. Electricity prices in the UK are extortinate at the moment and I want to try and make some savings where I can.
And since the server runs 24/7 this is a sensible candidate; it's also getting pretty old by today's standards. My current plan is to buy a small form factor PC (namely an ASRock DeskMeet) and put an i3 and a decent amount of RAM and use this. I can do this without completely breaking the bank as I have storage lying around and don't need a crazy amount of power. When I do this I'm going to make the final push to move everything to infrastructure as code, and build a brand new kubernetes cluster.

That doesn't mean I'm going to throw out the old hardware though. One thing I've wanted for a while is a sandbox/dev environment. Its funny since its just a "homelab" but I do actively use the services deployed to it and downtime can be a nuisance and its essentially a production environment. So I'd like to repurpose this old hardware as a sandbox environment that I can try new things out on. It'll be set up very similar to the prod environment and will only be powered on when I need it. I haven't decided how I'm going to manage it yet, either re-organise the current GitHub repo to support multiple environment or, more likely, create a sandbox repo.

The current VM host has a VM for [Home Assistant](https://www.home-assistant.io/) to manage my IoT devices, but I intend to move this to the thin client as a dedicated machine when I move everything else. This'll make
it easier for plugging in devices such as Zigbee radios etc.

Longer term I'd love to replace the NAS with a custom build that has a lot more space and power. However it isn't particularly high on my priority list right now as the current one
works fine. When that does happen the original one will likely be repurposed as a backup target for the new one.

## GitHub

The entirety of my homelab configuration is now on GitHub! Its a monorepo that includes all the tools mentioned above and is what my homelab uses as its source of truth.
To get around having publicly exposed secrets, a combination of SOPS and Ansible Vault are used to encrypt secrets before they are committed and are decrypted at runtime.

https://github.com/danmharris/homelab
