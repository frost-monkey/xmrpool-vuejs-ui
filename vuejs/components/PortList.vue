<template>
    <div>
        <div v-if="ports" v-for="portRow in portRows" class="row_no-padding group">
            <div v-for="port in portRow" :key="port.port" class="col span_4_of_12">
                <ul class="fa-ul" style="margin-top: 0;">
                    <list-item icon="plug" label="Port" :text="port.port"
                               hoverText="" />
                    <list-item icon="sliders" label="Starting difficulty" :text="port.difficulty"
                               hoverText="" />
                    <list-item :icon="typeIcon(port)" label="Type" :text="typeLabel(port)"
                               hoverText="" />
                    <list-item icon="question" label="Description" :text="port.desc"
                               hoverText="" />
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
    import ListItem from './ListItem.vue'

    export default {
        name: 'port-list',
        components: {
            ListItem
        },
        props: {
            ports: {
                type: Array,
                default() { return null }
            }
        },
        methods: {
            typeIcon(port) {
                return port.type && port.type == 'SSL' ? 'lock' : 'unlock'
            },
            typeLabel(port) {
                return port.type && port.type == 'SSL' ? 'SSL/TLS' : 'Open'
            }
        },
        computed: {
            portRows() {
                if (!this.ports) {
                    return []
                }

                let rows = []

                let rowIndex = 0
                let row = []
                for (let index = 0; index < this.ports.length; index++) {
                    row.push(this.ports[index])

                    if ((index + 1) % 3 === 0) { // New row
                        rows.push(row)
                        row = []
                    }
                    else if (index === this.ports.length - 1) { // Last port, we're done!
                        rows.push(row)
                    }
                }

                return rows
            }
        }
    }
</script>