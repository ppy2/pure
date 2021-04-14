#!/bin/sh
BOARD_DIR="$(dirname $0)"
DATE=`date +"%d.%m.%Y"` 
UID=`uuidgen`
cp $BOARD_DIR/uEnv.txt $BINARIES_DIR/uEnv.txt
echo "uprclautostart = 1" > $TARGET_DIR/etc/upmpdcli.conf
echo "friendlyname = Pure" >> $TARGET_DIR/etc/upmpdcli.conf
rm $TARGET_DIR/etc/init.d/*upmpdcli $TARGET_DIR/etc/init.d/*shairport-sync $TARGET_DIR/etc/init.d/*mpd $TARGET_DIR/etc/init.d/*sysctl
sed -i 's/;cgi.force_redirect = 1/cgi.force_redirect = 0/g' $TARGET_DIR/etc/php.ini
sed -i 's/;cgi.redirect_status_env =/cgi.redirect_status_env ="yes";/g' $TARGET_DIR/etc/php.ini
sed -i "s/ver.<\/span>/ver. $DATE<\/span>/g" $TARGET_DIR/var/www/tabs.php
sed -i "s/xxxxxxx/$UID/g" $TARGET_DIR/etc/raat.conf
sed -i "/::shutdown:/d" $TARGET_DIR/etc/inittab
sed -i "/Stuff to do before/d" $TARGET_DIR/etc/inittab
#echo "::sysinit:/usr/bin/runsvdir -P /etc/service" >> $TARGET_DIR/etc/inittab
echo " " >> $TARGET_DIR/var/www/tabs.php
echo " " >> ../board/pure/rootfs-overlay/var/www/tabs.php
cp -f $BOARD_DIR/S41dhcpcd $TARGET_DIR/etc/init.d/S41dhcpcd

