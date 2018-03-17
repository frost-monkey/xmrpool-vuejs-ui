<template>
    <div>
        <section class="row group alt">
            <h2>General information about payments</h2>
            <ul v-if="poolStats && poolStats.pool" class="fa-ul">
                <list-item icon="money" label="Minimum payment threshold" v-bind:text="minPayment"
                           hoverText="The minimum amount your balance has to reach before your get a payment" />

                <list-item icon="cut" label="Denomination unit" v-bind:text="denominationUnit"
                           hoverText="Smallest fraction or decimal for each payment" />

                <list-item icon="bank" label="Total payments" v-bind:text="poolStats.pool.totalPayments"
                           hoverText="Total number of payments sent by the pool" />

                <list-item icon="vcard" label="Total paid miners" v-bind:text="poolStats.pool.totalMinersPaid"
                           hoverText="Total number of miners paid by the pool" />
            </ul>
            <div v-else style="text-align: center; padding: 3rem 0 3rem 0;">
                <i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading&hellip;</span>
            </div>
        </section>

        <section class="row group">
            <h2>Payments made by our pool</h2>

            <div v-if="poolPayments">
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

                <payment-list-item v-for="payment in poolPayments"
                                   :key="payment.timestamp"
                                   :timestamp="payment.timestamp"
                                   :hash="payment.hash"
                                   :amount="payment.amount"
                                   :mixin="payment.mixin"
                                   :payees="payment.payees"
                                   :configCoinUnits="poolStats.config.coinUnits" />
            </div>
            <div v-else style="text-align: center; padding: 3rem 0 3rem 0;">
                <i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading&hellip;</span>
            </div>

            <div class="button-row">
                <button v-if="poolPayments" v-on:click="fetchExtraPayments" class="button"
                        style="vertical-align:middle"><span>Show more</span></button>
            </div>
        </section>
    </div>
</template>

<script>
    import ListItem from "./ListItem.vue"
    import PaymentListItem from "./PaymentListItem.vue"

    import axios from 'axios'
    import moment from 'moment'

    export default {
        name: 'PaymentList',
        components: { ListItem, PaymentListItem },
        props: {
            value: {
                type: Object,
                default() { return null }
            }
        },
        data() {
            return {
                poolStats: this.value,
                poolPayments: null,
                extraPayments: null,
                errors: []
            }
        },
        watch: {
            value: function (val) {
                this.poolStats = val
                this.parsePoolPaymentsData(this.poolStats.pool.payments, true)
            },
        },
        computed: {
            minPayment() {
                return (this.poolStats.config.minPaymentThreshold / this.poolStats.config.coinUnits)
                    .toLocaleString('en-US', { maximumFractionDigits: 2, minimumFractionDigits: 2 }) + ' XMR'
            },
            denominationUnit() {
                return (this.poolStats.config.denominationUnit / this.poolStats.config.coinUnits)
                    .toLocaleString('en-US', { maximumFractionDigits: 2, minimumFractionDigits: 2 }) + ' XMR'
            }
        },
        methods: {
            fetchExtraPayments() {
                let oldestPaymentTime = this.poolPayments[this.poolPayments.length - 1].timestamp

                axios.get('https://[your_domain]:8119/get_payments?time=' + oldestPaymentTime)
                    .then(response => {
                        this.parsePoolPaymentsData(response.data, false)
                    })
                    .catch(e => {
                        this.errors.push(e.message)
                    })
            },
            parsePoolPaymentsData(rawPaymentData, mainPayments) {
                if (!rawPaymentData || rawPaymentData.length == 0)
                    return

                let payments = []

                for (let i = 0; i < rawPaymentData.length; i++) {
                    let paymentData = rawPaymentData[i].split(':')
                    let paymentTimestamp = rawPaymentData[i + 1]

                    payments.push({
                        timestamp: parseInt(paymentTimestamp),
                        hash: paymentData[0],
                        amount: parseInt(paymentData[1]),
                        mixin:  parseInt(paymentData[3]),
                        payees:  parseInt(paymentData[4])
                    })

                    i++
                }

                let sortedPayments = payments.sort(function(a, b) {
                    return b.timestamp - a.timestamp
                })

                if (mainPayments) {
                    this.poolPayments = this.extraPayments
                        ? sortedPayments.concat(this.extraPayments)
                        : sortedPayments
                }
                else {
                    this.extraPayments = this.extraPayments
                        ? this.extraPayments.concat(sortedPayments)
                        : sortedPayments

                    this.poolPayments = this.poolPayments.concat(sortedPayments)
                }
            }
        },
        mounted() {
            if (this.poolStats && this.poolStats.pool)
                this.parsePoolPaymentsData(this.poolStats.pool.payments, true)
        }
    }
</script>