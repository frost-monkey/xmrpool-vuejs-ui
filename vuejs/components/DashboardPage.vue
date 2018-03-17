<template>
    <div>
        <div class="stats-alert">
            <transition name="fade">
                <div v-if="show" class="stats-alert__content"><i class="fa fa-spinner fa-spin fa-fw"></i>&nbsp;Stats updated</div>
            </transition>
        </div>

        <section v-if="poolStats" class="row group alt">
            <div v-if="poolStats && poolStats.network">
                <div class="col span_4_of_12">
                    <h2>Network stats</h2>
                    <network-stats-box v-bind:difficulty="poolStats.network.difficulty"
                                       v-bind:coinDifficultyTarget="poolStats.config.coinDifficultyTarget"
                                       v-bind:lastBlockTimestamp="poolStats.network.timestamp"
                                       v-bind:lastBlockText="formattedNetworkLastBlock"
                                       v-bind:height="poolStats.network.height"
                                       v-bind:reward="poolStats.network.reward"
                                       v-bind:hash="poolStats.network.hash.toString()"
                                       v-bind:coinUnits="poolStats.config.coinUnits" />
                </div>
                <div class="col span_4_of_12">
                    <h2>Pool stats</h2>
                    <pool-stats-box v-bind:hashRate="poolStats.pool.hashrate"
                                    v-bind:lastBlockTimestamp="poolStats.pool.stats.lastBlockFound"
                                    v-bind:lastBlockText="formattedPoolLastBlock"
                                    v-bind:miners="poolStats.pool.miners"
                                    v-bind:poolFees="poolFees"
                                    v-bind:networkDifficulty="poolStats.network.difficulty" />
                </div>
                <div class="col span_4_of_12">
                    <h2>Market</h2>
                    <markets-widget />
                </div>
            </div>
            <div v-else style="text-align: center; padding: 3rem 0 3rem 0;">
                <i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading&hellip;</span>
            </div>
        </section>

        <div v-if="poolStats">
            <wallet-stats-box v-bind:coinUnits="poolStats.config.coinUnits" />
        </div>
    </div>
</template>

<script>
    import MarketsWidget from './MarketsWidget.vue'
    import NetworkStatsBox from './NetworkStatsBox.vue'
    import PoolStatsBox from './PoolStatsBox.vue'
    import WalletStatsBox from "./WalletStatsBox.vue"

    import axios from 'axios'
    import moment from 'moment'

    export default {
        name: 'DashboardPage',
        components: { MarketsWidget, NetworkStatsBox, PoolStatsBox, WalletStatsBox },
        props: {
            value: {
                type: Object,
                default() { return null }
            }
        },
        data() {
            return {
                poolStats: this.value,
                errors: [],
                show: false
            }
        },
        watch: {
            value: function (val) {
                this.poolStats = val
            },
        },
        computed: {
            poolFees() {
                return this.poolStats.config.fee + '%'
            },
            formattedPoolLastBlock() {
                return moment(parseFloat(this.poolStats.pool.stats.lastBlockFound)).fromNow();
            },
            formattedNetworkLastBlock() {
                return moment.unix(parseFloat(this.poolStats.network.timestamp)).fromNow();
            }
        },
        methods: {
            hideUpdateMessage() {
                this.show = false;
            },
            onLookupClick() {

            }
        }
    }
</script>