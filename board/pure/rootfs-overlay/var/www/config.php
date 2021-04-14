<head>
<meta charset="utf-8">
 <title>Botic7</title>
<style>
    .radius {
/*    font-size: 15px; */
    font-family: arial; 
    background: #e0e0e0;
    border: 1px solid black;
    padding: 15px;
    margin-bottom: 15px;
    width:450px;
     }
</style>
</head>

<body bgcolor="#565656">
<div style="border-radius: 8px;" class="radius">
<form action="" method="post">
<b>Dev config options</b><br><br>
    <?php
     $a = `pidof dropbear`;
     if (empty($a)){
     echo '<input type="checkbox" name="form1[]" value="ssh"/> SSH server';
     } else {
     echo '<input type="checkbox" name="form1[]" value="ssh"checked/><b><font color="green">  SSH </b></font>server';
     }
    ?>
<br><br>
    <?php
     $a = `pidof crond`;
     if (empty($a)){
     echo '<input type="checkbox" name="form1[]" value="cron"/> Watchdog Service';
     } else {
     echo '<input type="checkbox" name="form1[]" value="cron"checked/><b><font color="green">  Watchdog Service</b></font>';
     }
    ?>
<br><br>
<input type="submit" name="formSubmit" value="Submit" />

    <?php
     $a = `pidof ap2renderer`;
     if (empty($a)){
     echo '';
     } else {
     echo '<br><br>' ;
     echo '<img src="ap_.png" width="35" height="35" align=middle>';
     $server = $_SERVER['HTTP_HOST']; 
     echo "&emsp;<a href=http://" ;   
     echo $server ;                   
     echo ":7779><b>APlayer settings</b></a>";
     }
    ?>

</form>
    <?php
     $a = $_POST['form1'];
     foreach ($a as $run) {
     if( ($run) == 'naa')
                        {`killall -15 mpd upmpdcli startroon.sh raat_app ap2renderer shairport-sync squeezelite spotifyd scream ;
			rm /etc/init.d/S99* ;
                        cp /etc/rc.botic/S99naa /etc/init.d/ && sync ; 
                        /etc/rc.botic/S99naa start` ; }

     if( ($run) == 'roon') 
                        {`killall -15 networkaudiod mpd upmpdcli ap2renderer shairport-sync squeezelite spotifyd scream ;
			rm /etc/init.d/S99* ;
                        cp /etc/rc.botic/S99roonready /etc/init.d/ && sync ; 
                        /etc/rc.botic/S99roonready start` ; }

     if( ($run) == 'mpd')
                        {`killall -15 networkaudiod startroon.sh raat_app ap2renderer shairport-sync squeezelite spotifyd scream ; 
			rm /etc/init.d/S99* ;
                        cp /etc/rc.botic/S99mpd /etc/init.d/ ; cp /etc/rc.botic/S99upmpdcli /etc/init.d/ && sync ;
                        /etc/rc.botic/S99mpd start ; /etc/rc.botic/S99upmpdcli start` ;  }

     if( ($run) == 'ap')
                       {`killall -15 mpd upmpdcli startroon.sh raat_app networkaudiod shairport-sync squeezelite spotifyd scream ; 
			rm /etc/init.d/S99* ;
                        cp /etc/rc.botic/S99aprenderer /etc/init.d/ && sync ; 
                        cd /usr/aprenderer && ./ap2renderer` ; }

     if( ($run) == 'airplay')
                        {`killall -15 mpd upmpdcli startroon.sh raat_app networkaudiod ap2renderer squeezelite spotifyd scream ; 
			rm /etc/init.d/S99* ;
                        cp /etc/rc.botic/S99shairport-sync /etc/init.d/ && sync ; 
                        /etc/init.d/S99shairport-sync start` ; }

     if( ($run) == 'sq')
                        {`killall -15 mpd upmpdcli startroon.sh raat_app networkaudiod ap2renderer shairport-sync spotifyd scream ; 
			rm /etc/init.d/S99* ;
                        cp /etc/rc.botic/S99squeezelite /etc/init.d/ && sync ; 
                        /etc/init.d/S99squeezelite start` ; }
                        
     if( ($run) == 'sp')
                        {`killall -15 mpd upmpdcli startroon.sh raat_app networkaudiod ap2renderer shairport-sync squeezelite scream; 
                        rm /etc/init.d/S99* ;
                        cp /etc/rc.botic/S99spotify /etc/init.d/ && sync ; 
                        nohup /sbin/spotifyd --no-audio-cache --no-daemon  --cache-path /tmp --bitrate 320 -d Botic7 > /dev/null 2>&1 &` ; }
    
    if( ($run) == 'scream')
                        {`killall -15 mpd upmpdcli startroon.sh raat_app networkaudiod ap2renderer shairport-sync squeezelite spotifyd ; 
                        rm /etc/init.d/S99* ;
                        cp /etc/rc.botic/S99scream /etc/init.d/ && sync ; 
                        nohup /sbin/scream > /dev/null 2>&1 &` ; }
                        
     header("Refresh: 1;");
     }
    ?>
</div>

<div style="border-radius: 8px;" class="radius">
<b>Network config</b><br><br>
<form action="" method="post">
    <?php
     $b = `ethtool eth0|grep 10Mb/s`;
     if (isset($b)){
     echo '<input type="radio" name="form2[]" value="10"checked/><b><font color="green">   10Mb/s  Half Duplex</font></b>';
     } else {
     echo '<input type="radio" name="form2[]" value="10"checked/>   10Mb/s  Half Duplex';
     }
    ?>
<br><br>
    <?php
     $b = `ethtool eth0|grep 100Mb/s`;
     if (isset($b)){
     echo '<input type="radio" name="form2[]" value="100"checked/><b><font color="green">  100Mb/s Full Duplex</font></b>';
     } else {
     echo '<input type="radio" name="form2[]" value="100"/> 100Mb/s Full Duplex';
     }
    ?>
<br><br>
<input type="submit" name="formSubmit" value="Submit" />
</form>

    <?php
     $b = $_POST['form2'];
     foreach ($b as $ver) {
     if( ($ver) == 'std')
     { 
     `uname -r |grep "4.9.146-Botic7-rt" && mv /boot/zImage /boot/4.9-rt && mv /boot/4.9-std /boot/zImage && reboot` ;
     echo '<br>' ;
     echo '<b><font color="blue">Please wait 30s...</font></b>' ; 
     }

     if( ($ver) == 'rt') 
     { 
     `uname -r |grep "4.9.146-Botic7-std" && mv /boot/zImage /boot/4.9-std && mv /boot/4.9-rt /boot/zImage && reboot` ;
     echo '<br>' ;
     echo '<b><font color="blue">Please wait 30s...</font></b>' ; 
     }
     header("Refresh: 30;");
     }
    ?>
</div>

</body>