---
title: WiFi Packet Sniffer
techs: Java, pcap4J, Wireshark
source_code: https://github.com/ElliotAlexander/COMP3210-DNS-Packet-Sniffing
---
Done for a Advanced Networks coursework, me and my partner explored whether it was possible to decrypt arbitrary WPA2 packets on a network where the shared key was known. It was discovered to be possible through the use of a wireless adapter in promiscuious mode and a relatively small application. This was paired with a frontend which stored the packet information in a time series database which could then be visualised in Grafana.

Our findings are presented in two reports, which can be found [in the source repository](https://github.com/ElliotAlexander/COMP3210-DNS-Packet-Sniffing/tree/master/docs).
