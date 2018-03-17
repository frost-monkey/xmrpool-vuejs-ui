<template>
    <div>
        <section class="row group alt">
            <div class="col span_6_of_12">
                <h2>About the pool</h2>
                <ul class="fa-ul">
                    <li><i class="fa-li fa fa-location-arrow"></i>Based in Seattle, Washington: excellent ping times
                        on USA and Canada's west coast</li>
                    <li><i class="fa-li fa fa-angle-double-right"></i>Minimum payout: <span class="highlight">1.0 XMR</span></li>
                    <li><i class="fa-li fa fa-percent"></i>Very low fees: <span class="highlight">0.5%</span></li>
                    <li><i class="fa-li fa fa-money"></i>Reward system: <span class="highlight">RBPPS</span></li>
                    <li><i class="fa-li fa fa-lock"></i>SSL/TLS, website and mining support</li>
                    <li><i class="fa-li fa fa-shield"></i>DDoS protected for better uptime</li>
                    <li><i class="fa-li fa fa-cogs"></i>Running Monero version: <span class="highlight">0.11.0.0</span></li>
                    <li><i class="fa-li fa fa-star"></i>This is a young pool and we are still ironing things out. Please be
                    patient and thanks for mining with us!</li>
                </ul>
            </div>

            <div class="col span_6_of_12">
                <h2>Status updates</h2>
                <ul class="fa-ul">
                    <li><i class="fa-li fa fa-calendar"></i><span class="date">2017-09-12</span>Server upgrade took
                        about 40 minutes (thank you for your patience). The pool now has dedicated CPU cores, and is
                        ready to welcome more miners! Tell all your friends! :-)</li>
                    <li><i class="fa-li fa fa-calendar"></i><span class="date">2017-08-30</span>We've suffered, along
                        with other pools in North America, a solid DDOS attack today. We have improved our protection,
                        but it comes with a bit more latency. We'll see where this brings us, and possibly make further
                        adjustments as the dust settles.</li>
                    <li><i class="fa-li fa fa-calendar"></i><span class="date">2017-08-28</span>To help deal with the
                        recent orphan problem which affects many pools in North America, we just started new nodes in
                        Frankfurt and Amsterdam, and will add another in France as soon as possible. As of now, this is
                        our best way of overcoming the problem. Thanks a lot for your patience, nobody likes orphans!</li>
                    <li><i class="fa-li fa fa-calendar"></i><span class="date">2017-03-09</span>Want to talk with us in
                        our private Slack account? Send your email address to
                        <a href="mailto:frostmonkey@protonmail.com">frostmonkey@protonmail.com</a> to get an invite.</li>
                </ul>
            </div>
        </section>

        <section class="row group">
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

        <section v-if="poolStats && poolStats.config" class="row group alt">
            <h2>How to connect to the pool</h2>

            <ul class="fa-ul">
                <list-item icon="handshake-o" label="Mining address" text="[mining_url]"
                           hoverText="Use this address in your mining software configuration" />
            </ul>

            <h3>Available ports</h3>
            <port-list :ports="poolStats.config.ports" />
        </section>

        <!--section class="row group alt">
            <div v-if="chartHashrate" style="display: flex;">
                <div style="width: 20%;">
                    <div>Profit</div>
                    <line-chart class="mini-chart" :height="140" :labels="chartProfit.labels" :values="chartProfit.values" />
                </div>
                <div style="width: 20%;">
                    <div>USD Value</div>
                    <line-chart class="mini-chart" :height="140" :labels="chartPrice.labels" :values="chartPrice.values" />
                </div>
                <div style="width: 20%;">
                    <div>Difficulty</div>
                    <line-chart class="mini-chart" :height="140" :labels="chartDifficulty.labels" :values="chartDifficulty.values" />
                </div>
                <div style="width: 20%;">
                    <div>Pool hashrate</div>
                    <line-chart class="mini-chart" :height="140" :labels="chartHashrate.labels" :values="chartHashrate.values" />
                </div>
                <div style="width: 20%;">
                    <div>Workers</div>
                    <line-chart class="mini-chart" :height="140" :labels="chartWorkers.labels" :values="chartWorkers.values" />
                </div>
            </div>
        </section-->
    </div>
</template>

<script>
    import LineChart from './charts/LineChart.js'
    import ListItem from './ListItem.vue'
    import MarketsWidget from './MarketsWidget.vue'
    import NetworkStatsBox from './NetworkStatsBox.vue'
    import PoolStatsBox from './PoolStatsBox.vue'
    import PortList from './PortList.vue'

    import moment from 'moment'

    export default {
        name: 'HomeApp',
        components: { LineChart, ListItem, MarketsWidget, NetworkStatsBox, PoolStatsBox, PortList },
        props: {
            value: {
                type: Object,
                default() { return null }
            }
        },
        data() {
            return {
                poolStats: this.value,
                chartDifficulty: null,
                chartHashrate: null,
                chartPrice: null,
                chartProfit: null,
                chartWorkers: null,
            }
        },
        watch: {
            value: function (val) {
                this.poolStats = val

                this.chartDifficulty = this.parseChartData(this.poolStats.charts.difficulty)
                this.chartHashrate = this.parseChartData(this.poolStats.charts.hashrate)
                this.chartPrice = this.parseChartData(this.poolStats.charts.price)
                this.chartProfit = this.parseChartData(this.poolStats.charts.profit)
                this.chartWorkers = this.parseChartData(this.poolStats.charts.workers)
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
            parseChartData(rawData) {
                let chartHashrate = {}

                chartHashrate.labels = rawData.map(function(a) {
                    return moment.unix(a[0]).format('YYYY-MM-DD HH:mm:ss')
                })

                chartHashrate.values = rawData.map(function(a) {
                    return a[1]
                })

                return chartHashrate
            }
        }
    }
</script>

<style>
    .fade-enter-active, .fade-leave-active {
        transition: opacity 3s
    }
    .fade-enter, .fade-leave-to /* .fade-leave-active in <2.1.8 */ {
        opacity: 0
    }
</style>