#!/bin/sh

chattr -i /etc/asound.conf
sed -i 's/card ./card 0/' /etc/asound.conf
chattr +i /etc/asound.conf
sed -i 's/serconfig=..../serconfig=SS--/' /boot/uEnv.txt
echo SS-- > /sys/module/snd_soc_botic/parameters/serconfig
echo SPDIF > /etc/output
/etc/rc.botic/S10mute stop > /dev/null 2>&1
sync
reboot


