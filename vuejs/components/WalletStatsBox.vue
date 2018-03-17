<template>
    <div>
        <!--div v-for="payment in payments">
            <pre>{{ payment.height }}</pre> {{ payment.amount / coinUnits }}
        </div-->

        <section>
            <div>
                <h2>Wallet Stats</h2>
                <p>
                    Please enter your wallet address below to access your wallet's stats.
                </p>
                <input class="input large-text-input" type="text" v-model="walletAddress">

                <ul v-if="errors && errors.length > 0" class="fa-ul">
                    <li v-for="error in errors" class="list-item__li">
                        <i class="fa-li fa fa-close"></i>{{ error }}
                    </li>
                </ul>
            </div>

            <div class="row_no-padding group">
                <div v-if="stats" class="col span_4_of_12">
                    <h3>Live Stats</h3>
                    <ul class="fa-ul">
                        <list-item icon="tachometer"
                                   label="Hash rate"
                                   :text="hashRateText" />
                        <list-item icon="clock-o"
                                   label="Last share submitted"
                                   :text="lastShareTimeText" />
                        <list-item icon="cloud-upload"
                                   label="Total hashes submitted"
                                   :text="totalHashesSubmitted.toLocaleString()" />
                        <list-item icon="bank"
                                   label="Pending balance"
                                   :htmlText="balanceText" />
                        <list-item icon="money"
                                   label="Total paid"
                                   :htmlText="totalPaidText" />
                    </ul>
                </div>

                <div v-if="chartHashRates" class="col span_8_of_12">
                    <h3>Hash Rate</h3>
                    <div style="background-color: #ececec; padding: 1rem 1rem 1rem 1rem;">
                        <line-chart :height="300" :labels="chartHashRates.labels" :values="chartHashRates.values" />
                    </div>
                </div>
            </div>

            <div v-if="payments && payments.length > 0">
                <h3>My Payments</h3>

                <div class="row table-header hide-sm">
                    <div class="col span_2_of_12">
                        Time sent
                    </div>
                    <div class="col span_6_of_12">
                        Hash
                    </div>
                    <div class="col span_2_of_12 align-right">
                        Amount
                    </div>
                    <div class="col span_1_of_12 align-right">
                        Mixin
                    </div>
                    <div class="col span_1_of_12 align-right">
                        Payees
                    </div>
                </div>

                <payment-list-item v-for="payment in payments"
                                   :key="payment.timestamp"
                                   :timestamp="payment.timestamp"
                                   :hash="payment.hash"
                                   :amount="payment.amount"
                                   :mixin="payment.mixin"
                                   :payees="payment.payees"
                                   :configCoinUnits="coinUnits" />
            </div>
            <div v-else-if="payments && payments.length == 0">
                <h3>My Payments</h3>
                <p>No payments were made to this wallet.</p>
            </div>
            <div v-else-if="stats" style="text-align: center; padding: 3rem 0 3rem 0;">
                <h3>My Payments</h3>
                <i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading&hellip;</span>
            </div>
        </section>
    </div>
</template>

<script>
    import ListItem from "./ListItem.vue"
    import LineChart from "./charts/LineChart.js"
    import PaymentListItem from "./PaymentListItem.vue"

    import axios from 'axios'
    import moment from 'moment'

    export default {
        name: 'WalletStatsBox',
        components: { ListItem, LineChart, PaymentListItem },
        props: {
            coinUnits: {
                type: Number,
                default: 1
            }
        },
        data() {
            return {
                walletAddress: '',
                stats: null,
                payments: null,
                chartHashRates: null,
                errors: [],
                show: false,
                hashRateText: '',
                lastShareTimeText: '',
                totalHashesSubmitted: 0,
                balanceText: '',
                totalPaidText: ''
            }
        },
        watch: {
            walletAddress() {
                this.fetchStats(false)
            }
        },
        methods: {
            fetchStats(longPoll) {
                if (!this.walletAddress)
                    return

                if (!this.walletAddress.startsWith('4') || this.walletAddress.length != 95) {
                    this.errors = []
                    this.errors.push('Invalid wallet address format')
                    return
                }
                else {
                    this.errors = []
                }


                axios.get('https://[your_domain]:8119/stats_address?address=' + this.walletAddress +
                          '&longpoll=' + longPoll)
                    .then(response => {

                        this.stats = response.data.stats

                        if (response.data.payments)
                            this.parsePayments(response.data.payments, true)

                        if (response.data.charts)
                            this.parseHashRates(response.data.charts.hashrate)

                        this.hashRateText = this.stats.hashrate ? this.stats.hashrate : '0 H/s'
                        this.lastShareTimeText = moment.unix(parseFloat(this.stats.lastShare)).fromNow()
                        this.totalHashesSubmitted = parseInt(this.stats.hashes)
                        this.balanceText = this.toReadableCoins(parseInt(this.stats.balance)) + '&nbsp;XMR'
                        this.totalPaidText = this.stats.paid
                            ? this.toReadableCoins(parseInt(this.stats.paid), 1) + '&nbsp;XMR'
                            : '0&nbsp;XMR'
                    })
                    .catch(e => {
                        this.errors.push(e.message)
                    }).then(() => {
                        if (!this.errors || this.errors.length == 0) {
                            this.fetchStats(true)
                        }
                    })
            },
            parsePayments(rawData) {
                let payments = []

                for (let i = 0; i < rawData.length; i++) {
                    let blockData = rawData[i].split(':')
                    let blockHeight = rawData[i + 1]

                    payments.push({
                        height: parseInt(blockHeight),
                        hash: blockData[0],
                        amount: parseInt(blockData[1])
                    })

                    i++
                }

                this.payments = payments.sort(function(a, b) {
                    return b.height - a.height
                })
            },
            parseHashRates(rawData) {
                let chartHashRates = {}

                chartHashRates.labels = rawData.map(function(a) {
                    return moment.unix(a[0]).format('YYYY-MM-DD HH:mm:ss')
                })

                chartHashRates.values = rawData.map(function(a) {
                    return a[1]
                })

                this.chartHashRates = chartHashRates
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