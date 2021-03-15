#!/bin/sh

chattr -i /etc/asound.conf
sed -i 's/card ./card 1/' /etc/asound.conf
chattr +i /etc/asound.conf
sed -i 's/serconfig=..../serconfig=MMMM/' /boot/uEnv.txt
echo MMMM > /sys/module/snd_soc_botic/parameters/serconfig
echo USB > /etc/output
killall mutedsc2.sh > /dev/null 2>&1
cd /etc/init.d
PLAYER=`ls S90*|grep -v -E 'upmpdcli|aprenderer'`
/etc/init.d/$PLAYER stop
/etc/init.d/$PLAYER start
sleep 1
sync



