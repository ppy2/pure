### Buildroot "Pure" firmware for BeagleBone

```
curl -s https://buildroot.org/downloads/buildroot-2020.11.tar.gz | tar xvz -C ./ 
mv ./buildroot* ./buildroot 
cd buildroot 
make BR2_EXTERNAL=../ pure_defconfig 
make -j$(nproc)

```
![image](https://user-images.githubusercontent.com/33607921/111215283-08b43e80-85e4-11eb-98d8-0c54dc0c160b.png)

Audio endpoint for NAA, RAAT, UPNP, AirPlay, LMS, Spotify Connect, TidalConnect and multicast
streaming. This firmware supports two types of output by default - I2S and USB. The Botic7 driver settings
for the I2S bus are located in the uEnv.txt file in the “optargs =” line. For more detailed information on driver
parameters, you can refer to the official driver support page - http://bbb.ieero.com
The launch is possible both from SD and from internal eMMC memory. When the system is fully booted, all LEDs will turn off.

The firmware has standard user settings via the web interface http://pure.local \
Shell access via SSH - root / root
