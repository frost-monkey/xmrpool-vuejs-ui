<template>
    <li class="list-item__li">
        <i v-if="icon" :class="iconClass"></i>
        <span :class="labelClass">{{ label }}</span>:

        <span v-if="htmlText" :title="hoverText" class="list-item__text" :class="hoverClass"
              v-html="htmlText" />

        <span v-else :title="hoverText" class="list-item__text" :class="hoverClass">{{ text }}<slot></slot></span>
    </li>
</template>

<script>
    export default {
        name: 'ListItem',
        props: {
            icon: {
                type: String,
                default: ''
            },
            label: {
                type: String,
                default: ''
            },
            text: {
                type: [ String, Number ],
                default: ''
            },
            htmlText: {
                type: String,
                default: null
            },
            hoverText: {
                type: String,
                default: ''
            },
            labelClass: {
                type: String,
                default: ''
            },
        },
        computed: {
            iconClass() {
                return 'fa-li fa fa-' + this.icon
            },
            hoverClass() {
                return this.hoverText ? 'list-item__hover' : ''
            }
        }
    }
</script>