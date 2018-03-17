<template>
    <div>
        <section v-if="poolStats && poolStats.config" class="row group alt">
            <h2>Getting Started</h2>
            <p>
                This page shows connection details and recommended mining applications for our pool.
            </p>
        </section>

        <section v-if="poolStats && poolStats.config" class="row group">
            <h3>How to connect to the pool</h3>

            <ul class="fa-ul">
                <list-item icon="handshake-o" label="Mining address" text="[mining_url]"
                           hoverText="Use this address in your mining software configuration" />
            </ul>

            <h3>Available ports</h3>
            <port-list :ports="poolStats.config.ports" />
        </section>

        <section v-if="poolStats && poolStats.config" class="row group alt">
            <div class="col span_4_of_12">
                <h3>Encrypted connection</h3>
                <p>
                    With Claymore's GPU miner, starting with v9.7, you can mine over an encrypted connection. Your
                    Claymore developer fees will be reduced from 2.5% to 2.0%. Simply use this option:
                    <br>
                    <code>-o ssl://[mining_url]:10443</code>
                </p>
            </div>
            <div class="col span_4_of_12">
                <h3>Setting fixed difficulty</h3>
                <p>
                    For fixed difficulty, simply append the desired value to your wallet address, seperated by a dot,
                    like this:
                    <br>
                    <code>WALLET_ADDRESS.desired_difficulty</code>
                </p>
            </div>
            <div class="col span_4_of_12">
                <h3>Need higher difficulty?</h3>
                <p>
                    If you need a port with a higher starting difficulty, please contact us. We have other ports
                    available, but we don't make them public to help prevent pool hopping.
                </p>
            </div>
        </section>

        <section class="row group">
            <div v-if="markdownContent">
                <vue-markdown class="faq" :breaks="false" :source="markdownContent" />
            </div>
            <div v-else style="text-align: center; padding: 3rem 0 3rem 0;">
                <i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading&hellip;</span>
            </div>
        </section>
    </div>
</template>

<script>
    import ListItem from './ListItem.vue'
    import PortList from './PortList.vue'
    import VueMarkdown from 'vue-markdown'

    import axios from 'axios'

    export default {
        name: 'GettingStartedPage',
        components: { ListItem, PortList, VueMarkdown },
        props: {
            value: {
                type: Object,
                default() { return null }
            }
        },
        data() {
            return {
                poolStats: this.value,
                markdownContent: null,
                errors: []
            }
        },
        watch: {
            value: function (val) {
                this.poolStats = val
            },
        },
        methods: {
            fetchMarkdownContent() {
                axios.get('https://[your_domain]/services/getting-started/')
                    .then(response => {
                        this.markdownContent = response.data
                    })
                    .catch(e => {
                        this.errors.push(e.message)
                    })
            },
        },
        mounted() {
            this.fetchMarkdownContent()
        }
    }
</script>