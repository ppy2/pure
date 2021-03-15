#!/usr/bin/env bash

die() {
  cat <<EOF >&2
Error: $@

Usage: ${0} -c GENIMAGE_CONFIG_FILE
EOF
  exit 1
}

# Parse arguments and put into argument list of the script
opts="$(getopt -n "${0##*/}" -o c: -- "$@")" || exit $?
eval set -- "$opts"

GENIMAGE_TMP="${BUILD_DIR}/genimage.tmp"

while true ; do
	case "$1" in
	-c)
	  GENIMAGE_CFG="${2}";
	  shift 2 ;;
	--) # Discard all non-option parameters
	  shift 1;
	  break ;;
	*)
	  die "unknown option '${1}'" ;;
	esac
done

[ -n "${GENIMAGE_CFG}" ] || die "Missing argument"

# Pass an empty rootpath. genimage makes a full copy of the given rootpath to
# ${GENIMAGE_TMP}/root so passing TARGET_DIR would be a waste of time and disk
# space. We don't rely on genimage to build the rootfs image, just to insert a
# pre-built one in the disk image.

trap 'rm -rf "${ROOTPATH_TMP}"' EXIT
ROOTPATH_TMP="$(mktemp -d)"

rm -rf "${GENIMAGE_TMP}"

genimage \
	--rootpath "${ROOTPATH_TMP}"     \
	--tmppath "${GENIMAGE_TMP}"    \
	--inputpath "${BINARIES_DIR}"  \
	--outputpath "${BINARIES_DIR}" \
	--config "${GENIMAGE_CFG}"

mkdir -p output/images/rootfs
mkdir -p output/images/boot
mkdir -p /home/pureupdate
sync
mount -o loop,offset=33554944 output/images/sdcard.img output/images/rootfs
rsync -a --delete --numeric-ids output/images/rootfs/ /home/pureupdate/
umount output/images/rootfs
mount -o loop,offset=512 output/images/sdcard.img output/images/boot
rsync -a --delete --numeric-ids output/images/boot/ /home/pureupdate/boot/
umount output/images/boot
chmod 644 /home/pureupdate/etc/shadow
rm -fR /home/pureupdate/lost+found
chmod 755 /home/pureupdate/root
chmod 744 /home/pureupdate/usr/libexec/dbus-daemon-launch-helper
chmod 644 /home/pureupdate/usr/libexec/ssh-keysign

gzip -f output/images/sdcard.img
mv output/images/sdcard.img.gz output/images/Pure_`date +"%d_%m_%Y"`.gz
