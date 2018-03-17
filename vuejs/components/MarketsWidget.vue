<template>
    <div>
        <div>Live XMR value</div>
        <ul v-if="ready" class="fa-ul">
            <list-item v-for="coin in apiData"
                       :key="coin.ticker.target"
                       :icon="icons[coin.ticker.target]"
                       :label="coin.ticker.target"
                       labelClass="mono">
                <span>
                    <span v-if="coin.ticker.target == 'BTC'" class="mono">{{ coin.ticker.price }}</span>
                    <span v-else class="mono">{{ toMoney(coin.ticker.price) }}</span>
                </span>
            </list-item>
        </ul>

        <div class="small">
            Updated: <span class="highlight">{{ formattedLastUpdate }}</span>
        </div>

        <div class="small">
            Data from <a target="_blank" href="https://www.cryptonator.com">Cryptonator</a>
        </div>
    </div>
</template>

<script>
    import ListItem from "./ListItem.vue"

    import axios from 'axios'
    import moment from 'moment'

    export default {
        name: 'MarketsWidget',
        components: { ListItem },
        data() {
            return {
                ready: false,
                icons: {
                    USD: 'dollar',
                    CAD: 'dollar',
                    EUR: 'eur',
                    BTC: 'btc',
                },
                apiData: [
                    { ticker: { target: 'BTC' } },
                    { ticker: { target: 'USD' } },
                    { ticker: { target: 'CAD' } },
                    { ticker: { target: 'EUR' } }
                ],
                timestamp: 0,
                formattedLastUpdate: '',
                errors: []
            }
        },
        methods: {
            fetchApiData(currency) {
                axios.get('https://api.cryptonator.com/api/ticker/xmr-' + currency)
                    .then(response => {

                        var foundIndex = this.apiData.findIndex(x => x.ticker.target == currency)

                        if (foundIndex >= 0)
                            this.apiData[foundIndex] = response.data

                        if (this.timestamp == 0) {
                            this.timestamp = response.data.timestamp
                            this.updateUpdateTime()
                        }
                        else {
                            this.timestamp = response.data.timestamp
                        }

                        let allAreReady = true
                        for (let coin of this.apiData) {
                            if (!coin.ticker.price)
                                allAreReady = false
                        }
                        this.ready = allAreReady

                    })
                    .catch(e => {
                        this.errors.push(e.message)
                    }).then(() => {
                        setTimeout(this.fetchApiData.bind(null, currency), 60000)
                    })
            },
            toMoney(value) {
                return Number.parseFloat(value)
                    .toLocaleString('en-US', { maximumSignificantDigits: 5, minimumSignificantDigits: 4 })
            },
            updateUpdateTime() {
                this.formattedLastUpdate = moment.unix(this.timestamp).fromNow()
                setTimeout(this.updateUpdateTime, 10000)
            }
        },
        created() {
            this.fetchApiData('BTC')
            this.fetchApiData('USD')
            this.fetchApiData('CAD')
            this.fetchApiData('EUR')
        }
    }
</script>