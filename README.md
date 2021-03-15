### Buildroot "Pure" firmware for BeagleBone

```
curl -s https://buildroot.org/downloads/buildroot-2020.11.tar.gz | tar xvz -C ./ 
mv ./buildroot* ./buildroot 
cd buildroot 
make BR2_EXTERNAL=../ pure_defconfig 
make -j$(nproc)

```
![image](https://user-images.githubusercontent.com/33607921/111215283-08b43e80-85e4-11eb-98d8-0c54dc0c160b.png)
