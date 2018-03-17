<template>
    <ul class="fa-ul">
        <list-item icon="tachometer" label="Hash rate" v-bind:text="readableHashRate"
                   hoverText="Total hashing power from miners connected to the pool" />

        <list-item icon="clock-o" label="Block found" v-bind:text="lastBlockText"
                   hoverText="Latest block found by the pool" />

        <list-item icon="users" label="Connected miners" v-bind:text="miners.toString()"
                   hoverText="Miners currently connected (identified by wallet addresses)" />

        <list-item icon="percent" label="Pool fees" v-bind:text="poolFees"
                   hoverText="Percentage of the reward kept by the pool each time a block is found" />

        <list-item icon="history" label="Block found every" v-bind:htmlText="readableAverageBlockTime"
                   hoverText="Estimated average time between blocks found by the pool (actual period will vary a lot, and it's normal)" />
    </ul>
</template>

<script>
    import ListItem from "./ListItem.vue"

    import moment from 'moment'

    export default {
        name: 'PoolStatsBox',
        components: { ListItem },
        props: {
            lastBlockTimestamp: {
                type: String,
                default: ''
            },
            lastBlockText: {
                type: String,
                default: ''
            },
            hashRate: {
                type: Number,
                default: 0
            },
            miners: {
                type: Number,
                default: 0
            },
            poolFees: {
                type: String,
                default: ''
            },
            networkDifficulty: {
                type: Number,
                default: 0
            }
        },
        computed: {
            readableHashRate() {
                return this.toReadableHashRate(this.hashRate) + '/sec'
            },
            blockFound() {
                return moment(parseFloat(this.lastBlockTimestamp)).fromNow()
            },
            readableAverageBlockTime() {
                return moment.duration(Math.round(this.networkDifficulty / this.hashRate), "seconds").humanize() +
                       '<span class="normal"> (est.)</span>';
            }
        },
        methods: {
            toReadableHashRate(hashrate) {
                if (!hashrate || isNaN(hashrate))
                    return '0.00 H';

                hashrate = parseFloat(hashrate);

                var i = 0;
                var byteUnits = ['H','KH','MH','GH','TH','PH'];
                while(hashrate >= 1000) {
                    hashrate = hashrate / 1000;
                    i++;
                }

                return hashrate.toFixed(2) + ' ' + byteUnits[i];
            },
            toReadableCoins(coins, digits = -1) {
                var precision = digits > -1
                    ? digits
                    : this.coinUnits.toString().length - 1;

                return (coins / this.coinUnits).toFixed(precision);
            },
        },
        created() {

        }
    }
</script>