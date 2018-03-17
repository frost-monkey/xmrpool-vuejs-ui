<template>
    <div>
        <section class="row group alt">
            <h2>Frequently Asked Questions</h2>
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
    import VueMarkdown from 'vue-markdown'

    import axios from 'axios'

    export default {
        name: 'FaqPage',
        components: { VueMarkdown },
        data() {
            return {
                markdownContent: null,
                errors: []
            }
        },
        methods: {
            fetchMarkdownContent() {
                axios.get('[your_domain]/services/faq/')
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