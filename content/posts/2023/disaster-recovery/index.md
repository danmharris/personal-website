---
title: "Disaster Recovery"
date: 2023-04-09T12:00:00+01:00
---

Well it finally happened. After just over a year of its current incarnation and about another year on top of running without major
downtime, I finally managed to break my Kubernetes (K8s) cluster to the point where I need to rebuild from scratch.

Thankfully I still have access to my volume data so it _should_ be recoverable, however I am using this opportunity to take stock
of things and learn some lessons to make my life easier in the future.

## The how

My K8s cluster is managed using an OS called Talos, which is built to be a lightweight and secure way
to run clusters without much overhead. It uses an API driven design - meaning you don't have SSH access or things like that - just
a CLI utility that manages it all for you. I've been a big fan of it as it makes my life easier and allows you to easily declare
and maintain clusters.

I'll be honest though, I hadn't been doing a good job on keeping it up to date. At the time of the breakage I was running version
0.14, released in December 2021. I was also running a recently unmaintained version of K8s: 1.23. My weekend job was to update
both of these to at least maintained versions - getting them to the absolute latest was a bonus. To try and make things as smooth as
possible I was going to bump the OS of each node by one version until they reached a version that supported the next K8s version, at
which point I'd bump that. Rinse and repeat, job done right?

Everything was going well until I tried updating the control plane node. I only have one so messing this up would be a pain (you can
probably guess which bit I messed up). Ran the Talos upgrade command and rebooted and saw it was getting stuck trying to route to the
API IP address. Talos lets you use a shared virtual IP (VIP) to get access to the K8s API, for if you have multiple control plane nodes.
Internally it uses the etcd leader to work this out, so the fact it couldn't get one was not a good sign.

Not a problem I thought. A nice thing of the Talos design is it allows you to rollback to the previous version by choosing a different
boot menu option. That came back up fine and everything was working as it was before. So I thought I would add a new control plane node
on the newer version and then remove the old node - as I thought there was an issue with the current node. Added the new node and everything
seemed fine so I ran the reset command on the old one.

It timed out trying to reset this node and then when I tried looking at the status on the new node I got the dreaded error message:
"no etcd leader". This was now _really_ bad. My old control plane had not been able to voluntarily leave the etcd cluster and then had reset
itself. This means the node that was left does not have quorum anymore and can't maintain a healthy state, with no easy way of getting the old
node back in. I believe you can technically recover etcd from this state but its a lot of hassle so at this point I cut my losses and shut
everything down.

## Going forward

Unfortunately I don't have much time at the moment so I'm going to be labless for a little bit, but there are a few things I'd like to change
for this rebuilt cluster:

### Better backups

Currently I use the VM automatic backup built in to Proxmox to back up the NFS VM that I use to host my volumes. This has likely saved my bacon
this time but isn't ideal as they aren't application aware - backing up databases this way can lead to problems. I want to, where possible, back
up things in an application aware way so that they are consistent and easily restorable. For other cases I'd like to find a tool that can natively
backup the volumes themselves and restore into new volumes so I don't have to manually copy things on the disk of the NFS server.

Also whenever I attempt to do maintenance I should really take a backup of the K8s nodes, just in case something goes wrong. That way all is not
lost when it does.

### Documenting

When I eventually get around to rebuilding the cluster I'm going to be going in slightly blind - lots of things have been bolted on in the last
year and I have no idea how straightforward its going to be to get everything back up and the precise order it goes in. I am going to document
each and every step I perform and rectify any issues that crop up after the fact and then do a trial disaster recovery on a test cluster to see
how everything works. This is something I hope to practice every so often.

This will require a bit of reconfiguring as I don't want some resources to come up on test runs, such as my prod LetsEncrypt configuration for
cert-manager for example.

### Keeping on top of things

Whilst this wasn't the main cause of the issue, it did make me realise that I haven't been keeping on top of my updates in this area. I have automatic
updates on my Debian machines and use Renovate for my K8s apps but nothing for the runtime and OS for it.
I think I need to set aside a scheduled maintenance period where I do these kinds of updates. In addition subscribing to the mailing list for releases
from Talos and K8s probably would be a good reminder of the need to update.

### Other bits and pieces

If I'm honest this gives me a perfect opportunity to do some housekeeping bits I've wanted to do for a while. Things like reorganising my namespaces
and flux manifests are a lot easier when you don't have to worry about existing resources to shuffle about. I have too many apps on their own namespaces
currently, which isn't really necessary, so it'll be good to reduce this number. Its also a prime opportunity to rebuild my NFS server that I use for the
volumes.

--

This is part of the fun of having a homelab, as frustrating as it may seem. Events like this give me the opportunity to make improvements to infrastructure
and make sure it is more reliable and flexible going forward. It wouldn't be called a lab otherwise! Time to see how the rebuild goes...
