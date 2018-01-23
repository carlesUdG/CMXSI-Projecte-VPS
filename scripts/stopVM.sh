#!/bin/bash
VBoxManage controlvm $1_$2 savestate
rm ../IPs/$1_$2.txt
