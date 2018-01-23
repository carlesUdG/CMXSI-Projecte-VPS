#!/bin/bash
VBoxManage clonevm $1 --options link --name $1_$2 --basefolder /var/www/html/users/$2 --snapshot snap2 --register && VBoxManage modifyvm $1_$2 --memory $3
