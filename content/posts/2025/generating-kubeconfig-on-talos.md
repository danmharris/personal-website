---
title: "Generating a kubeconfig on Talos"
date: 2025-03-06T00:00:00Z
---

Recently I reinstalled both of my personal machines and with that came the process
of regenerating all the keys and credentials I need - I backed them up but I find
it's a good opportunity to do a refresh. One of those keys is to access my home
Kubernetes cluster.

The cluster has been running on Talos and one of its advantages is that
I can keep the config for the cluster in git and use it to recover
the machine. A side effect of that is it becomes really easy to
regenerate the kubectl config.

If you have a control plane config file available for your Talos cluster you can
follow the steps below to generate yourself a new kubeconfig.

First generate the Talos secrets bundle.

```sh
$ talosctl gen secrets --from-controlplane-config controlplane.yaml
```

This will generate a secrets.yaml file which you can then use to generate a new
talosconfig file. Note that the cluster name and endpoint don't matter here -
they're only used for generating machine configs.

```sh
$ talosctl gen config unused https://unused.tld:6443 --with-secrets secrets.yaml -t talosconfig
```

This generates a talosconfig file used to access the Talos API.

```sh
$ talosctl version -n 10.23.20.3
Client:
        Tag:         v1.8.3
        SHA:         undefined
        Built:
        Go version:  go1.23.3
        OS/Arch:     linux/amd64
Server:
        NODE:        10.23.20.3
        Tag:         v1.8.1
        SHA:         477752fe
        Built:
        Go version:  go1.22.8
        OS/Arch:     linux/amd64
        Enabled:     RBAC
```

And since you can access the Talos API you can use it to generate a new kubeconfig.

```sh
$ talosctl kubeconfig
$ kubectl get nodes
NAME     STATUS   ROLES           AGE    VERSION
lychee   Ready    control-plane   325d   v1.31.1
```

Tada :tada:
