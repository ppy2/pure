#!/bin/bash

curl -s https://buildroot.org/downloads/buildroot-2020.11.tar.gz | tar xvz -C ./
mv ./buildroot* ./buildroot
cd buildroot
make BR2_EXTERNAL=../ pure_defconfig
sed -i "s/sha256  2f3b54d08d048f5977b80cb6cb4744994370def7553ee634d39dbbb6ccf87546  ethtool-5.8.tar.xz/sha256  724eb8bd3c3a389fe285735959a1902fbd9310624656ad3220c5f23df1053c39  ethtool-5.7.tar.xz/g"  package/ethtool/ethtool.hash
sed -i "s/5\.8/5\.7/g" package/ethtool/ethtool.mk
make -j$(nproc)