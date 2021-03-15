### Buildroot "Pure" firmware for BeagleBone

```
curl -s https://buildroot.org/downloads/buildroot-2020.11.tar.gz | tar xvz -C ./ 
mv ./buildroot* ./buildroot 
cd buildroot 
make BR2_EXTERNAL=../ pure_defconfig 
make -j$(nproc)

```
