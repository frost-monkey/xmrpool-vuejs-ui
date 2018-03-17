# Beginner's Guide to Monero CPU Mining
This guide is intended to help miners interested in CPU mining.
#
#
## Create a Wallet
Just like for every cryptocurrency, you will need a wallet to store the coins you mine or buy. You can't really achieve anything without one. The easiest and fastest way to create a wallet is to use the [MyMonero](https://mymonero.com/MyMonero) service. Follow their instructions really carefully.

If you prefer to control everything locally, you can run your own Monero node and install the official GUI wallet. Downloads and instructions can be found here on the [official Monero page](https://getmonero.org/2016/12/22/monero-core-gui-beta-released.html).
#
#
## Easy CPU Monero Mining on Windows
Because Monero uses the CryptoNote technology, anyone with a computer can mine it with a simple CPU (processor). Depending on your computer's CPU, this operation may or may not be really lucrative. Still, this is an excellent way to make your first steps into mining. It also helps the entire network by distributing the hashing power, as long as you mine with a small/medium pool.

This tutorial will guide you through the installation and setup of a CPU miner. We truly recommend using the XMR-Stak-CPU as it is by far (15% to 30% depending on CPU) the most efficient.
#
#
### Allow "Lock pages in memory"
To work at its best, XMR-Stak-CPU must be allowed to lock pages in memory. You can make sure of this by accessing the Group Policy Editor.
1. Open a Windows Command Prompt (search for "cmd" in the Windows menu).
![w10menucmd]
#
2. Type ```gpedit.msc``` and hit enter.
![gpeditfromcmd]
#
3. *If you  have gpedit.msc installed or enabled (happens with most Windows home versions), you can skip step 4:* 
4. [Enable gpedit on Windows 10](https://www.itechtics.com/enable-gpedit-windows-10-home/ "Enable gpedit on Windows 10") | [Enable gpedit on Windows 7, 8, and 8.1](http://www.askvg.com/how-to-enable-group-policy-editor-gpedit-msc-in-windows-7-home-premium-home-basic-and-starter-editions/ "Enable gpedit on Windows 7, 8, and 8.1")
![lockpagesinmemory01]
#
5. With the Group Policity window open, navigate to: **Computer Configuration / Windows Settings / Security Settings / Local Policies / User Rights Assignments**.
6. Double-click on **Lock pages in memory**
7. Make sure your **main user account** is set in this window. If it's not, you can add it with the Add User or Group... button. Type in the name of the user you want to add, then click the Check Names button. 
![lockpagesinmemory02]
#
8. If the user is found by the system, **it will be underlined**.
![lockpagesinmemory03]
#
9. These settings will only be applied after the next reboot, so you may want to do that now.
#
#
### Install Visual C++ Redistributable
Before running the miner, you will need to download and install the Visual C++ Redistributable for Visual Studio 2015. Download it from the [official Microsoft website](https://www.microsoft.com/en-us/download/details.aspx?id=52685), and follow instructions carefully.
#
#
### Learn more about your CPU
To get the best out of the miner, you need to know what CPU is in your computer. To do this, search for System from the Windows menu, and open the best matching result. This window will open, and you'll see your CPU model almost at the center of it.
![systemcpu]
#
In this example, the CPU is an **i5-6400**. Let's Google **i5-6400 specs**. The first or second result should point to a page with the CPU's full specification. Go to that page.
![googlesearch]
#
Keep note of the following information: **number of cores**, **number of threads**, **and amount of cache/L3 cache**.
![cpuspecs]
#
#
## Setting up Stak's XMR CPU mining software
### Download the mining software
XMR-Stak-CPU miner is available for free on GitHub. Here is a direct download link for the [Windows (64-bits) version](https://github.com/fireice-uk/xmr-stak-cpu/releases/download/v1.2.0-1.4.1/xmr-stak-cpu-notls-win64.zip). If you use another OS, you can compile it yourself. Source code and other instructions are found in the [GitHub repository](https://github.com/fireice-uk/xmr-stak-cpu/releases).
#
#
### Extract the files
Now you need to extract the zip file you just downloaded.
1. Go to your Downloads folder
2. Right-click on xmr-stak-cpu-win64
3. From the menu, click on on Extract All...
4. A window opens, click the Extract button
#
#
### Adjust your mining config file
Open the extracted folder. You should see two files in it:
1. config.txt
2. xmr-stak-cpu.exe
![extractedfiles]
#
Open config.txt with your favorite text editor. Monero mining applications require, in an ideal world, 2 MB of cache per mining thread. In our example, our CPU has 6 MB of cache, so we will set the miner's configuration to run with 3 threads at a time (change the 2 at the end of the line for a 3):
```
"cpu_thread_num" : 3,
```
#
Each mining thread has its own configuration, so a line needs to be added for the third thread:
```
"cpu_threads_conf" : [
    { "low_power_mode" : false, "no_prefetch" : false, "affine_to_cpu" : 0 },
    { "low_power_mode" : false, "no_prefetch" : false, "affine_to_cpu" : 1 },
    { "low_power_mode" : false, "no_prefetch" : false, "affine_to_cpu" : 2 },
],
```
#
If your CPU has more CPU threads than CPU cores (hyperthreading technology, ex: 4 cores 8 threads), it is recommended to use even-numbered cores to make sure miner threads run on physical cores, and not virtual ones. Here's an example:
```
"cpu_threads_conf" : [
    { "low_power_mode" : false, "no_prefetch" : false, "affine_to_cpu" : 0 },
    { "low_power_mode" : false, "no_prefetch" : false, "affine_to_cpu" : 2 },
    { "low_power_mode" : false, "no_prefetch" : false, "affine_to_cpu" : 4 },
],
```
#
#
Now scroll down, set the pool address to ```pool.usxmrpool.com:3333```, set your wallet address, and leave the password field empty. Only stratum pools are supported on XMR-Stak-CPU, so it is not neccessary to prepend ```stratum+tcp://``` to the pool address.
```
"pool_address" : "pool.usxmrpool.com:3333",
"wallet_address" : "your wallet address",
"pool_password" : "",
```
#
Save and close the config file.
#
#
### Start mining!
The last thing to do is to run the mining application as an administrator. Right-click on **xmr-stak-cpu.exe** and choose **Run as administrator** from the menu.
![runasadmin]
#
#
You will know everything is working fine the second you see this message: ```Result accepted by the pool.```
![itworks]
#
#
#### Credits, contact and donations
This tutorial was written by FrostMonkey (frostmonkey@protonmail.com). Please send your comments, improvements and corrections!

XMR donations are much appreciated and can be sent to the following address. Thanks!
#### ***Tips are appreciated***
```
439nkLq5Epx8mUQyvGEJocJ3dZKNki1vqLvNCs3QHautEkoQgPxrj4BejciBXXHjKUDke7fmRGCRQXNZFemNzbzMQiLtgCq
```
[w10menucmd]: https://usxmrpool.com/images/windows-10-menu-cmd.png
[gpeditfromcmd]: https://usxmrpool.com/images/gpedit-from-cmd.png
[lockpagesinmemory01]: https://usxmrpool.com/images/lock-pages-in-memory-01.png
[lockpagesinmemory02]: https://usxmrpool.com/images/lock-pages-in-memory-02.png
[lockpagesinmemory03]: https://usxmrpool.com/images/lock-pages-in-memory-03.png
[systemcpu]: https://usxmrpool.com/images/system-cpu.png
[googlesearch]: https://usxmrpool.com/images/google-search.png
[cpuspecs]: https://usxmrpool.com/images/cpu-specs.png
[extractedfiles]: https://usxmrpool.com/images/extracted-files.png
[runasadmin]: https://usxmrpool.com/images/run-as-admin.png
[itworks]: https://usxmrpool.com/images/it-works.png
#
#
___
#
#
# **Guide to Monero GPU Mining with sgminer on Windows 10**
#
This is a beginners guide that will help get you started using sgminer with your gpu. Let's get started!
#
## **Overclocking and mining settings warning information**
#
###### PLEASE BE RESPONSIBLE! THIS IS ONLY A GUIDE THAT IS BASED OFF MY EXPERIENCE AND WHAT HAS WORKED FOR ME. ANY AND ALL OVERCLOCKING YOU DO OR OTHER MODIFICATIONS YOU DO, ARE YOUR RESPONSIBILITY. I AM NOT RESPONSIBLE FOR ANYTHING THAT HAPPENS TO YOU OR YOUR HARDWARE. OVERCLOCKING AND/OR MODIFYING YOUR HARDWARE COULD POTENTIALLY CAUSE A FIRE, INVALIDATE YOUR WARRANTY, DAMAGE ALL YOUR HARDWARE OR POSSIBLY CAUSE OTHER EVILS. AGAIN, I'M NOT RESPONSIBLE.
#
#
# **Configuring SGMiner for your GPU**
#
#### Single pool
```bat
sgminer -k cryptonight -o stratum+tcp://pool.usxmrpool.com:7777 -u "YOUR_WALLET_ADDRESS" -p x --rawintensity 896 -w 8 -g 1
pause
```
#
#
#### Multiple pool/port
```bat
sgminer -k cryptonight -o stratum+tcp://pool.usxmrpool.com:7777 -u "YOUR_WALLET_ADDRESS" -p x -o stratum+tcp://pool.usxmrpool.com:3333 -u
"YOUR_WALLET_ADDRESS" -p x --rawintensity 896 -w 8 -g 1
pause
```
#
#
#### Add multiple raw intensity settings for individual cards
#
```bat
sgminer -k cryptonight -o stratum+tcp://pool.usxmrpool.com:7777 -u "YOUR_WALLET_ADDRESS -p x --rawintensity 504, 512, 480 -w 8 -g 1
pause
```
All gpu engine clock, memory speeds, fan and tempurature settings will start at the stock settings unless changed by you with a program or by attempting to configure them with the miner.
#
#
#### Add engine clocking/memory clocking settings for all cards
#
```bat
sgminer -k cryptonight -o stratum+tcp://pool.usxmrpool.com:7777 -u "YOUR_WALLET_ADDRESS" -p x --rawintensity 896 -w 8 -g 1 --gpu-engine
1000 --gpu-memclock 1500
pause
```
These settings will be applied to all GPUs if you have multiple GPUs. In the example above all GPUs would have their core clock set to 1000 and memory clock set to 1500.
#
#
#### Add engine clocking/memory clocking settings for individual cards
#
Settings will be applied to each GPU starting at GPU 0 and continuing for each value entered.

```bat
sgminer -k cryptonight -o stratum+tcp://pool.usxmrpool.com:7777 -u "YOUR_WALLET_ADDRESS" -p x --rawintensity 896 -w 8 -g 1 --gpu-engine
1000,950,975,1025 --gpu-memclock 1500
pause
```
##### Using the example above:

- GPU 0 engine speed will be 1000 and the memory speed will be 1500.
- GPU 1 engine speed will be 950 and the memory speed will be 1500.
- GPU 2 engine speed will be 975 and the memory speed will be 1500.
- GPU 3 engine speed will be 1025 and the memory speed will be 1500.

You can enter individual memory speed values the same way.

You can change these values while sgminer is running by pressing [G] at the runtime screen then [C] on the GPU management screen then selecting the one you want to change. It can also be done by an outside program.

Please note, while you may have gone through the steps to successfully enter these values, they may not be accepted by the GPU and the current values will continue to be in use OR they may be accepted and cause sgminer to fail. It's usually best to set the speeds before you start.
#
#
#### **Setting GPU performance(starting point/what I found best)**
If the raw intensity is too high, sgminer either won't start up, it will crash or it will freeze. I've found -g 2 and a lower raw intensity to always better than -g 1 and a higher raw intensity. I've provided the settings I have found to be the best and the range of hashrates for the gpu with stock settings. Your results may vary but this should be a good starting point. To test for better results add or subtract from the raw intensity in intervals of 8 until you find the settings with the highest h/s.


###### If the raw intensity is too high: sgminer either won't start up, it will crash, or it will freeze.
#
Card|Settings|Hashrate
:-:|:-:|:-:
Rx 480|--rawintensity 504 -w 8 -g 2|~625 h/s
Rx 470|--rawintensity 512 -w 8 -g 2|~545 h/s
Rx 460|--rawintensity ??? -w 8 -g 2|None tested
R9 390|--rawintensity 632 -w 8 -g 2|~775 h/s
R9 380|--rawintensity 416 -w 8 -g 2|~535 h/s
R9 370|--rawintensity ??? -w 8 -g 2|None tested
R9 290x|--rawintensity 672 -w 8 -g 2|~790 h/s
R9 290|--rawintensity 624 -w 8 -g 2|~730 h/s
R9 280x|--rawintensity 440-424 -w 8 -g 2|~550 h/s
R9 280|--rawintensity 400 -w 8 -g 2|~500 h/s

I have found that sgminer works best all of the GPUs on your rig are the same. Mining efficiency couldn't be maximized when running different GPUs with different processors and different memory sizes.

- 2 - 480 4gb and 2 - 480 8gb = ok because they have the same processors but couldn't optimize the 8 gbs
- 2 - 290x, 1 - 290 and 1 - 390 = ok if they all have the same processors
- 3 - 390 and 2 - 280x = not so good
- 1 - 480 4gb, 1 - 390, 1 - 380, 1 - 290, 1 - 280x, 1 - 280 and what ever else you want to add = ENJOY!
#
#
##### If it runs but says no usable cldevices or GPUs found try:
#
```bat
sgminer -k cryptonight -o stratum+tcp://pool.usxmrpool.com:7777 -u "YOUR_WALLET_ADDRESS" -p x --rawintensity 896 -w 8 -g 1 --gpu-platform 0
pause
```
#### OR
#
```bat
sgminer -k cryptonight -o stratum+tcp://pool.usxmrpool.com:7777 -u "YOUR_WALLET_ADDRESS" -p x --rawintensity 896 -w 8 -g 1 --gpu-platform 1
pause
```
#
#
#### **Example of an RX 480 config :**
#
```bat
setx GPU_FORCE_64BIT_PTR 0
setx GPU_MAX_HEAP_SIZE 100
setx GPU_MAX_USE_SYNC_OBJECTS 1
setx GPU_MAX_ALLOC_PERCENT 100
setx GPU_MAX_SINGLE_ALLOC_PERCENT 100
sgminer -k cryptonight -o stratum+tcp://pool.usxmrpool.com:7777 -u "YOUR_WALLET_ADDRESS" -p x --rawintensity 504 -w 8 -g 2
pause
```
###### To save a notepad document as a bat file, use save as, then change save as type from text document to all files, then type .bat after your file name. Make sure this file is in the same folder as sgminer.exe and double click.
#
#
#### ***Tips are appreciated***
```
44oknuEnYHn1Bwb7n2M9HxfKrUVSsd11Ng4uwWbEv2T7SYXoKVFRbJuWbwaVe4vUMveKAzAiA4j8xgUi29TpKXpm43SVmHU
```
#
#
___
#
#
## **Understanding SGMiner's output**
This guide will walk you through each line of SGMiner while it is running to give you a better understanding of what everything means. Let's get started with an "example console" of a 6 GPU rig, then we will break it down.
```
sgminer 5.5.5-gm – Started [Date started] – [Running time]

------------------------------------------Mining Stat Lines-------------------------------------------------------

(5s):3.911K (avg):4.421Kh/s | A:1116695491 R:5184469 HW:0 WU:2.516/m

ST: 2 SS: 222 NB: 2109 LW: 601262 GF: 183 RF: 2

Connected to 'pool address' as user 'your wallet address'

Block: 494d7eec... Diff: 65.8T Started: [00:13:54] Best share: 26.4G

--------------------------------------------GPU Stat Lines-------------------------------------------------------

[P]ool management [G]PU management [S]ettings [D]isplay options [Q]uit:

GPU 0: 72.0C 995RPM | 741.7/734.6h/s | R:0.3% HW:0 WU:0.429/m rI:504

GPU 1: 59.0C 975RPM | 732.5/738.4h/s | R:0.5% HW:0 WU:0.419/m rI:504

GPU 2: 65.0C 940RPM | 745.5/736.0h/s | R:0.4% HW:0 WU:0.435/m rI:504

GPU 3: 68.0C 927RPM | 740.6/737.1h/s | R:0.8% HW:0 WU:0.409/m rI:504

GPU 4: 65.0C 924RPM | 742.5/737.3h/s | R:0.3% HW:0 WU:0.416/m rI:504

GPU 5: 70.0C 910RPM | 743.7/737.6h/s | R:0.6% HW:0 WU:0.409/m rI:504

----------------------------------------Running Output Log-----------------------------------------------------

[00:11:12] Accepted 1e6ff773 Diff 551K/200K GPU 2

[00:12:57] Accepted 4c44f59e Diff 228K/ 200K GPU 1

[00:13:02] Accepted 4d8d5988 Diff 216K/ 200K GPU 2

[00:14:34] Accepted 170e22e3 Diff 728K/ 200K GPU 3
```
#

## **Let's break it down :**
### Reading the mining stat output
#
```(5s):3.911K (avg):4.421Kh/s | A:1116695491 R:5184469 HW:0 WU:2.516/m```
**Following each column left to right**
- ```5s``` A 5 second exponentially decaying average hash rate
- ```avg``` An all time average hash rate
- ```A``` The total difficulty of Accepted shares
- ```R``` The total difficulty of Rejected shares
- ```HW``` The total number of HardWare errors
- ```WU``` The total Work Utility defined as the number of diff1 shares work / minute (accepted or rejected)
#
#
```ST: 2 SS: 222 NB: 2109 LW: 601262 GF: 183 RF: 2```
**Following each column left to right**
- ```ST``` is Staged work items (ready to use)
- ```SS``` is Stale Shares discarded (detected and not submitted so don't count as rejects)
- ```NB``` is New Blocks detected on the network
- ```LW``` is Locally generated Work items
- ```GF``` is Getwork Fail Occasions (server slow to provide work)
- ```RF``` is Remote Fail occasions (server slow to accept work)
#
#
```Connected to 'pool address' as user 'your wallet address'```
**Following each column left to right**
- ```'pool address'``` is the pool you are mining on (hopefully this reads  something like usxmrpool)
- ```'your wallet address'``` is the wallet you are mining to 
#
#
```Block: 494d7eec... Diff: 65.8T Started: [00:13:54] Best share: 26.4G```
**Following each column left to right**
- ```Block``` Shows a short stretch of the current block
- ```Diff``` Current network difficulty
- ```Started``` When the new block started
- ```Best``` Share All time best difficulty share you've found since starting sgminer this time
#
#
### Reading the GPU output
#
```
GPU 0: 72.0C 995RPM | 741.7/734.6h/s | R:0.3% HW:0 WU:0.429/m rI:504
GPU 1: 59.0C 975RPM | 732.5/738.4h/s | R:0.5% HW:0 WU:0.419/m rI:504
GPU 2: 65.0C 940RPM | 745.5/736.0h/s | R:0.4% HW:0 WU:0.435/m rI:504
```
**Following each column left to right**

- ```GPU 0,1,2:``` The temperature (if supported) and fanspeed (if supported)
- (left) 5 second exponentially decaying average hash rate / average hash rate for entire session (right)
- ```R:``` The % of rejected shares for the GPU
- ```HW:``` The number of hardware erorrs for the GPU
- ```WU:``` The work utility defined as the number of diff1 shares work / minute for the GPU
- ```rI:``` The raw intensity for the GPU
#
#
### Reading the output log
```
[00:11:12] Accepted 1e6ff773 Diff 551K/200K GPU 2
[00:12:57] Accepted 4c44f59e Diff 228K/ 200K GPU 1
[00:13:02] Accepted 4d8d5988 Diff 216K/ 200K GPU 2
[00:14:34] Accepted 170e22e3 Diff 728K/ 200K GPU 3
```
**Following each column left to right**
- [Time submitted]
- Accepted/Rejected
- 8 byte hex value (1e6ff773) is the 2nd 8 bytes of the share being submitted to the pool
- The 2 diff values (551K/200K) are the actual difficulty target that share reached followed by the difficulty target the pool is currently asking for
#
#
### Miner Options
The following options are available while running with a single keypress:
```
[P]ool management [G]PU management [S]ettings [D]isplay options [Q]uit:

GPU 0: 72.0C 995RPM | 741.7/734.6h/s | R:0.3% HW:0 WU:0.429/m rI:504
GPU 1: 59.0C 975RPM | 732.5/738.4h/s | R:0.5% HW:0 WU:0.419/m rI:504
GPU 2: 65.0C 940RPM | 745.5/736.0h/s | R:0.4% HW:0 WU:0.435/m rI:504
GPU 3: 68.0C 927RPM | 740.6/737.1h/s | R:0.8% HW:0 WU:0.409/m rI:504
GPU 4: 65.0C 924RPM | 742.5/737.3h/s | R:0.3% HW:0 WU:0.416/m rI:504
GPU 5: 70.0C 910RPM | 743.7/737.6h/s | R:0.6% HW:0 WU:0.409/m rI:504
```
#
```[P]``` gives you:
```
0: Enabled Alive Quota 1 Prio 0 'pool 1' User:Your address
1: Enabled Alive Quota 1 Prio 1 'pool 2' User:Your address

Current pool management strategy: Failover
[F]ailover only disabled
Pool [A]dd [R]emove [D]isable [E]nable [Q]outa change
[C]hange management strategy [S]witch pool [I]nformation
Or press any other key to continue
```
#
```[G]``` gives you:
```
GPU 0: 0.7 / 0.7 Kh/s | A:1525 R:33 HW:0 U:0.35/m I:0 xI:0 rI:504
Temp: 72.0 C F: 17% (970 RPM) E (core clock): 1303 MHz M (mem clock): 1750 Mhz Vddc: 1158963.875V A (Activity): 100% P
(Powertune): 0%
Last initialised: [2017-03-15 23:30:41]
Thread 0: 0.4 Kh/s Enabled ALIVE
Thread 1: 0.4 Kh/s Enabled ALIVE

GPU 1:...

GPU 2:...

[E]nable [D]isable [R]estart GPU [C]hange settings
[I]ntesity E[x]perimental intensity R[a]w Intensity
Or press any other key to continue
```
#
```[S]``` gives you:
```
[Q]ueue: 1
[S]cantime: 7
[E]xpiry: 28
[W]rite config file
[R]estart
Select an option or any other key to return
```
#
```[D]``` gives you:
```
[N]ormal [C]lear [S]ilent mode (disable all output)
[D]ebug:off
[P]er-device:off
[Q]uiet:off
[V]erbose:off
[R]PC debug:off
[W]orkTime details:off
[I]ncognito: off
co[M]pact: off
[L]og interval: 5
[Z]ero statistics
Select an option or any other key to return
```
#
```[Q]``` safely closes SGMiner
#
#
#### ***Tips are appreciated***
```
44oknuEnYHn1Bwb7n2M9HxfKrUVSsd11Ng4uwWbEv2T7SYXoKVFRbJuWbwaVe4vUMveKAzAiA4j8xgUi29TpKXpm43SVmHU
```
