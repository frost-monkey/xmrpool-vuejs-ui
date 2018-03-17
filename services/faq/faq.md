# What is mining?

The process of cryptographically computing a mathematical proof for a block, containing a number of transactions, which
is then added to the blockchain. Very simply, you are helping to do the “accounting” for the network. More miners is a
great thing, and the more miners spread out over the network, the better.

# What’s the difference between H/s, kH/s, MH/s, etc.?

This is based off the International System of Units:
+ 1 H/s is the standard. It stands for hashes per second.
+ 1 kiloH/s = 1000 H/s
+ 1 MegaH/s = 1000 kH/s
+ 1 GigaH/s = 1000 MH/s
+ 1 TeraH/s = 1000 GH/s
+ 1 PetaH/s = 1000 TH/s

# I've been mining for minutes/hours, why can't I see my stats?

As soon as you start mining, your stats should become available within a minute or two. If they don't, first, make sure
your mining application (miner) doesn't report any error. It if doesn't, and you see messages like `Share accepted...`
or `Result accepted...`, then most of the time it's because the pool address in your config file or command line is
wrong, and you are mining at another pool. Believe us, it happens all the time! :-)

# I've been mining for a while, why don't I have a balance yet?

You are rewarded once we (the pool) find a block. Your reward will show up in your pending balance once the block that
was found has 60 confirmations. 60 confirmations usually takes 2-3 hours. You can follow this by clicking the
[pool's blocks page](/blocks "Blocks found by the pool").

# Why has it taken so long to find a block?

The amount of time to find a block varies. The “Block found every:” is an *estimated average* as to how long it will
take the pool to find a block. This is calculated using our pool's hashrate in comparison to the difficulty. The
difficulty changes according to the total network hashrate.

# When do I get my pending balance?

Your balance will be paid out once it reaches 1&nbsp;XMR. It will be paid in .1 denominations. If you have a
1.3758365&nbsp;XMR pending balance, you will be paid 1.3&nbsp;XMR, and have the rest roll over toward your next payout.
Payments are sent approximately once per day, but sometimes quicker.

# What are pool and miner fees?

_US XMR Pool_ charges a pool fee of 0.5%. Every time we find a block and are given a reward for it, the pool fee is
taken directly from this reward. The remainder, 99.5% of it, is distributed to miners (you).

The mining software you are using (also called a miner), may also have a fee, often between 1% and 2%. Unlike pool fee,
this one is based on mining time. The miner will use, for example, 1% of your mining time for its own wallet. Most
mining softwares display a message during the fee mining period, so you know exactly when it happens, and for how long.

# What do the colors and percentages mean in the pool's blocks page?

100% means we found a block at the predicted average time it would take based on our pool hashrate, the network’s
hashrate and difficulty. Under 100% (green) means we were "lucky" and found it ahead of schedule. Over 100% (red)
means we were "unlucky" and it took longer than expected. It's all supposed to average out to 100% in the end. If we
find a block and it is grayed out, that means it is an orphan block.

# Uhhhh, so what is an orphan block?

Because it takes several seconds for the information found in one place of the network to reach the whole network
(because of geographical and technical constraints), two miners can find the same block at the same time. One of the
blocks will be verified and confirmed by the network before the other. The first block is said to be accepted or
comfirmed, while the other block is rejected or orphaned.

More on the subject in this Stack Exchange question:
[What is an orphan block](https://monero.stackexchange.com/questions/3311/what-are-orphaned-blocks "What is an orphan block")

# How do the rewards for mining work?

_US XMR Pool_ uses the RBPPS reward system. RBPPS stands for Round Based Pay Per Share. Put simply, that means you are
paid per share submitted between blocks found (the round). Let's say 100 shares were submitted to the pool since the
last block found by the pool. Now we find a new block and your miner submitted 10 of those 100 shares. You would be
rewarded with 10/100 or 10% of the total reward, minus pool fees (0.5%). Time is not a factor in this.

# Why is the minimum payment threshold 1.0&nbsp;XMR?

To keep pool fees as low as possible, _US XMR Pool_ has a relatively high minimum payment threshold (1.0&nbsp;XMR). This
is because the pool pays all transaction fees when miners (you) are issued payments. Issuing less payments means less
transaction fees for the pool, making us able to keep the pool fees very low.

As an example,
[this payment transaction](https://monerohash.com/explorer/tx/9763fe19a3cd14b459d252052f9aaa53e20b8f44a0cfbe53dda9fd66e6038760)
for 12.6&nbsp;XMR earned the pool 0.063&nbsp;XMR (pool fee being 0.5%), and had a fee of 0.02195019&nbsp;XMR, meaning a
profit of 0.041&nbsp;XMR for the pool.

# What is pool hopping?

Pool hopping is when someone, usually with a lot of hashing power, joins a pool right after the pool found a block,
hoping the pool gets lucky so they can get a larger reward. Let's say they usually mine at a large pool. They will “hop”
to small pools to claim a large portion of the reward if the pool gets lucky while not missing out on much at the larger
pool they usually mine at. They can get 10-20% more reward that way, while smaller miners lose out on reward. This isn't
fair for anyone, and this is why we do not tolerate it.

# Where can I learn more on Monero and mining?

Here are our favorite resources that will help any Monero enthusiast or miner learn more on the all aspects of this
cryptocurrency:
+ [Monero.how](https://www.monero.how "Monero.how") - Lots of general information, tutorials, exchanges, etc.
+ [Stack Exchange](https://monero.stackexchange.com "Stack Exchange") - You can search or ask any question here.
+ [Monero community on Redit](https://www.reddit.com/r/Monero "Monero community on Redit") - Anything Monero related
+ [Monero](https://getmonero.org "getmonero.org") - Official Monero website
