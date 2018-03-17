<template>
    <div>
        <div class="row list-row show-sm">
            <div class="col small_1_of_3">
                Time sent
            </div>
            <div class="col small_2_of_3 mono" v-html="timeSent" />

            <div class="col small_1_of_3">
                Hash
            </div>
            <div class="col small_2_of_3 mono" v-html="txLinkMobile" />

            <div class="col small_1_of_3">
                Amount
            </div>
            <div class="col small_2_of_3">
                {{ formattedAmount }}
            </div>

            <div class="col small_1_of_3">
                Mixin
            </div>
            <div class="col small_2_of_3">
                {{ mixin }}
            </div>

            <div class="col small_1_of_3">
                Payees
            </div>
            <div class="col small_2_of_3">
                {{ payees }}
            </div>
        </div>

        <div class="row list-row hide-sm">
            <div class="col span_2_of_12 mono" v-html="timeSent" />
            <div class="col span_6_of_12 mono" v-html="txLink" />
            <div class="col span_2_of_12 align-right">
                {{ formattedAmount }}
            </div>
            <div class="col span_1_of_12 align-right">
                {{ mixin }}
            </div>
            <div class="col span_1_of_12 align-right">
                {{ payees }}
            </div>
        </div>
    </div>
</template>

<script>
    import moment from 'moment'

    export default {
        name: 'PaymentListItem',
        props: {
            timestamp: {
                type: Number,
                default: 0
            },
            hash: {
                type: String,
                default: ''
            },
            amount: {
                type: Number,
                default: 0
            },
            mixin: {
                type: Number,
                default: 0
            },
            payees: {
                type: Number,
                default: 0
            },
            configCoinUnits: {
                type: Number,
                default: 0
            },
        },
        computed: {
            timeSent() {
                let momentDateTime = moment.unix(this.timestamp)
                let date = '<span class="datetime-date">' + momentDateTime.format('YYYY-MM-DD') + '</span>'
                let time = '<span class="datetime-time">' + momentDateTime.format('HH:mm:ss') + '</span>'

                return date + ' ' + time
            },
            txLink() {
                return '<a target="_blank" href="https://monerohash.com/explorer/tx/' + this.hash + '">' +
                           this.hash + '</a>&nbsp;<i class="fa fa-external-link"></i>'
            },
            txLinkMobile() {
                return '<a target="_blank" href="https://monerohash.com/explorer/tx/' + this.hash + '">' +
                           this.hash.substring(0, 8) + '&hellip;</a>&nbsp;<i class="fa fa-external-link"></i>'
            },
            formattedAmount() {
                if (isNaN(this.amount)) {
                    return '?'
                }

                return Number.parseFloat(this.amount / this.configCoinUnits)
                           .toLocaleString('en-US', { maximumFractionDigits: 2, minimumFractionDigits: 2 }) + ' XMR'
            },
        }
    }
</script>