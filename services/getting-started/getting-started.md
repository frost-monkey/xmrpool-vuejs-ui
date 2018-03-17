# Our recommended mining apps

Here's our choice of mining applications, also known as _miners_.

---

## CPU: XMR Stak CPU
<i class="fa fa-download fa-fw"></i> Download: [GitHub](https://github.com/fireice-uk/xmr-stak-cpu/releases)<br>
<i class="fa fa-file-code-o fa-fw"></i> Source code: [GitHub](https://github.com/fireice-uk/xmr-stak-cpu)

**Instructions**

Follow the [official readme](https://github.com/fireice-uk/xmr-stak-cpu#xmr-stak-cpu---monero-mining-software) or our
[Mining tutorials](https://v2.usxmrpool.com/tutorials) to get started.

**Why?**

- Very stable
- Much better hash rate than all previous CPU miners
- Can be compiled for Linux or Windows easily

---

## Nvidia (CUDA): xmrMiner
<i class="fa fa-download fa-fw"></i> Download: [GitHub](https://github.com/xmrMiner/xmrMiner-Win64)<br>
<i class="fa fa-file-code-o fa-fw"></i> Source code: [GitHub](https://github.com/xmrMiner/xmrMiner)

**Instructions**

- Install CUDA Toolkit first: [Official NVIDIA download page](https://developer.nvidia.com/cuda-toolkit)
- Make sure this is set in the _xmrMiner_easyStart.bat_ file:<br>
  <code>set poolUrl=stratum+tcp://pool.usxmrpool.com:5555</code>

**Why?**

- Very easy to get started on Windows
- Very easy to configure
- Very stable
- Much better hash rate than the old _ccminer_

---

## AMD (OpenCL): Claymore GPU Miner
<i class="fa fa-download fa-fw"></i> Download: [BitcoinTalk](https://bitcointalk.org/index.php?topic=638915.0)

**Example command line**

<code>NsGpuCNMiner -o stratum+tcp://pool.usxmrpool.com:5555 -u YOUR_WALLET_ADDRESS -p x</code>

**Why?**

- Very easy to get started on Windows
- Very stable