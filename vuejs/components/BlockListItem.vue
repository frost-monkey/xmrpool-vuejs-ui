<template>
    <div>
        <div class="row list-row show-sm" :class="rowClass">
            <div class="col small_1_of_3">
                Time found
            </div>
            <div class="col small_2_of_3 mono" v-html="timeFound" />

            <div class="col small_1_of_3">
                Hash
            </div>
            <div class="col small_2_of_3 mono" v-html="blockLink" />


            <div class="col small_1_of_3">
                Difficulty
            </div>
            <div class="col small_2_of_3">
                {{ difficulty.toLocaleString() }}
            </div>

            <div class="col small_1_of_3">
                Height
            </div>
            <div class="col small_2_of_3">
                {{ height.toLocaleString() }}
            </div>

            <div class="col small_1_of_3">
                Reward
            </div>
            <div class="col small_2_of_3" v-html="formattedReward" />

            <div class="col small_1_of_3">
                Status
            </div>
            <div class="col small_2_of_3" v-html="status" />

            <div class="col small_1_of_3">
                Luck
            </div>
            <div class="col small_2_of_3" v-html="luck" />
        </div>

        <div class="row list-row hide-sm" :class="rowClass">
            <div class="col span_2_of_12 mono" v-html="timeFound" />
            <div class="col span_2_of_12 mono" v-html="blockLink" />
            <div class="col span_2_of_12">
                {{ difficulty.toLocaleString() }}
            </div>
            <div class="col span_2_of_12">
                {{ height.toLocaleString() }}
            </div>
            <div class="col span_2_of_12 align center" v-html="formattedReward" />
            <div class="col span_1_of_12" v-html="status" />
            <div class="col span_1_of_12 align center" v-html="luck" />
        </div>
    </div>
</template>

<script>
    import moment from 'moment'

    export default {
        name: 'BlockListItem',
        props: {
            height: {
                type: Number,
                default: 0
            },
            hash: {
                type: String,
                default: ''
            },
            timestamp: {
                type: Number,
                default: 0
            },
            difficulty: {
                type: Number,
                default: 0
            },
            shares: {
                type: Number,
                default: 0
            },
            maturity: {
                type: Number,
                default: 0
            },
            reward: {
                type: Number,
                default: 0
            },
            configCoinUnits: {
                type: Number,
                default: 0
            },
            configDepth: {
                type: Number,
                default: 0
            },
            networkHeight: {
                type: Number,
                default: 0
            }
        },
        computed: {
            rowClass() {
                if (this.maturity === 1)
                    return 'row list-row list-row__bad'

                return isNaN(this.maturity) ? 'row list-row list-row__special' : 'row list-row'
            },
            timeFound() {
                let momentDateTime = moment.unix(this.timestamp)
                let date = '<span class="datetime-date">' + momentDateTime.format('YYYY-MM-DD') + '</span>'
                let time = '<span class="datetime-time">' + momentDateTime.format('HH:mm:ss') + '</span>'

                return date + ' ' + time
            },
            blockLink() {
                return '<a target="_blank" href="https://monerohash.com/explorer/block/' + this.hash + '">' +
                           this.hash.substring(0, 8) + '&hellip;</a>&nbsp;<i class="fa fa-external-link"></i>'
            },
            formattedReward() {
                if (isNaN(this.reward)) {
                    return this.maturity !== 0 && this.maturity !== 1
                        ? '...'
                        : 'None'
                }

                return Number.parseFloat(this.reward / this.configCoinUnits)
                           .toLocaleString('en-US', { maximumFractionDigits: 4, minimumFractionDigits: 4 }) + ' XMR'
            },
            luck() {
                let luck = Math.round(this.shares / this.difficulty * 100)

                if (luck < 10)
                    return '<span class="luck-good">' + luck + '%</span>' +
                           '&nbsp;<i class="fa fa-thumbs-up luck-awesome"></i>'
                else if (luck <= 100)
                    return '<span class="luck-good">' + luck + '%</span>'
                else
                    return '<span class="luck-bad">' + luck + '%</span>'
            },
            status() {
                if (this.maturity === 0)
                    return '<i class="fa fa-check status-good list-item__hover" title="Confirmed"></i>'

                if (this.maturity === 1)
                    return '<i class="fa fa-times status-orphan list-item__hover" title="Orphaned"></i>'

                let blocksToGo = this.configDepth - (this.networkHeight - this.height);
                return '<span class="list-item__hover" title="Number of blocks to be mined by the network before ' +
                       'this one gets confirmed">' + blocksToGo + ' blocks to go</span>'
            }
        }
    }
</script>