#!/bin/bash

out=`VBoxManage guestproperty enumerate $1_$2 | grep IP | cut -d' ' -f4 | tr -d ','`

if [ "$out" != "" ]; then
  echo $out > ../IPs/$1_$2.txt
fi
