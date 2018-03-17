<template>
    <ul class="fa-ul">
        <list-item icon="tachometer" label="Hash rate" v-bind:text="hashRate"
                   hoverText="Estimated hashing power of the whole Monero network" />

        <list-item icon="clock-o" label="Block found" v-bind:text="lastBlockText"
                   hoverText="Latest block found on the network (not necessarily our pool)" />

        <list-item icon="unlock-alt" label="Difficulty" v-bind:text="difficulty.toLocaleString()"
              hoverText="Current network difficulty" />

        <list-item icon="bars" label="Blockchain height" v-bind:text="height.toLocaleString()"
              hoverText="Total number of blocks in the chain" />

        <list-item icon="money" label="Last reward" v-bind:text="lastReward"
              hoverText="Total reward (fees + block reward) for the latest block" />

        <list-item icon="chain" label="Last hash" hoverText="Follow this link for full block detail">
            <a target="_blank" :href="lastHashUrl" v-html="lastHashText" />
        </list-item>
    </ul>
</template>

<script>
    import ListItem from "./ListItem.vue"

    import moment from 'moment'

    export default {
        name: 'NetworkStatsBox',
        components: { ListItem },
        props: {
            difficulty: {
                type: Number,
                default: 0
            },
            coinDifficultyTarget: {
                type: Number,
                default: 1
            },
            lastBlockTimestamp: {
                type: Number,
                default: 0
            },
            lastBlockText: {
                type: String,
                default: ''
            },
            height: {
                type: Number,
                default: 0
            },
            reward: {
                type: Number,
                default: 0
            },
            hash: {
                type: String,
                default: ''
            },
            coinUnits: {
                type: Number,
                default: 1
            }
        },
        computed: {
            hashRate() {
                return this.toReadableHashRate(this.difficulty / this.coinDifficultyTarget) + '/sec'
            },
            lastReward() {
                return this.toReadableCoins(this.reward, 4) + ' XMR'
            },
            lastHashUrl() {
                return 'https://monerohash.com/explorer/block/' + this.hash
            },
            lastHashText() {
                return this.hash.substring(0, 8) + '&hellip;'
            }
        },
        methods: {
            toReadableHashRate(hashrate) {
                if (!hashrate || isNaN(hashrate))
                    return '0.00 H'

                hashrate = parseFloat(hashrate)

                var i = 0
                var byteUnits = ['H','KH','MH','GH','TH','PH']
                while(hashrate >= 1000) {
                    hashrate = hashrate / 1000
                    i++
                }

                return hashrate.toFixed(2) + ' ' + byteUnits[i];
            },
            toReadableCoins(coins, digits = -1) {
                var precision = digits > -1
                    ? digits
                    : this.coinUnits.toString().length - 1

                return (coins / this.coinUnits)
                    .toLocaleString('en-US', { maximumFractionDigits: precision, minimumFractionDigits: precision })
            }
        }
    }
</script>