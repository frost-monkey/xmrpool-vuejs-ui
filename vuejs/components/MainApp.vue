<template>
    <div>
        <div class="stats-alert">
            <transition name="fade">
                <div v-if="show" class="stats-alert__content"><i class="fa fa-spinner fa-spin fa-fw"></i>&nbsp;Stats updated</div>
            </transition>
        </div>

        <router-view v-model="poolStats" />
    </div>

</template>

<script>
    import axios from 'axios'
    import moment from 'moment'

    export default {
        name: 'MainApp',
        data() {
            return {
                poolStats: null,
                errors: [],
                show: false
            }
        },
        methods: {
            fetchStats() {
                axios.get('https://[your_domain]:8119/stats')
                    .then(response => {
                        this.poolStats = response.data
                    })
                    .catch(e => {
                        this.errors.push(e.message)
                    }).then(() => {
                        this.fetchLiveStats()
                    })
            },
            fetchLiveStats() {
                this.show = true;
                setTimeout(this.hideUpdateMessage, 3000)

                axios.get('https://[your_domain]:8119/live_stats')
                    .then(response => {
                        this.poolStats = response.data
                    })
                    .catch(e => {
                        this.errors.push(e.message)
                    }).then(() => {
                        this.fetchLiveStats()
                    })
            },
            hideUpdateMessage() {
                this.show = false;
            }
        },
        mounted() {
            this.fetchStats()
        }
    }
</script>