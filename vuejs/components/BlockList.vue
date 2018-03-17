<template>
    <div>
        <section class="row group alt">
            <h2>General information about blocks</h2>
            <ul v-if="poolStats && poolStats.config" class="fa-ul">
                <list-item icon="link" label="Maturity depth requirement" v-bind:text="poolStats.config.depth"
                           hoverText="After a block is found, number of blocks the network has to find to confirm found block, and update your balance" />

                <list-item icon="check-square" label="Total blocks found" v-bind:text="poolStats.pool.totalBlocks"
                           hoverText="Total number of blocks found by the pool" />
            </ul>
            <div v-else style="text-align: center; padding: 3rem 0 3rem 0;">
                <i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading&hellip;</span>
            </div>
        </section>

        <section class="row group">
            <h2>Blocks mined by our pool</h2>

            <div v-if="poolBlocks">
                <div class="row table-header hide-sm">
                    <div class="col span_2_of_12">
                        Time found
                    </div>
                    <div class="col span_2_of_12">
                        Hash
                    </div>
                    <div class="col span_2_of_12">
                        Difficulty
                    </div>
                    <div class="col span_2_of_12">
                        Height
                    </div>
                    <div class="col span_2_of_12">
                        Reward
                    </div>
                    <div class="col span_1_of_12">
                        Status
                    </div>
                    <div class="col span_1_of_12">
                        Luck
                    </div>
                </div>

                <block-list-item v-for="block in poolBlocks"
                                 :key="block.height"
                                 :height="block.height"
                                 :hash="block.hash"
                                 :timestamp="block.timestamp"
                                 :difficulty="block.difficulty"
                                 :shares="block.shares"
                                 :maturity="block.maturity"
                                 :reward="block.reward"
                                 :configCoinUnits="poolStats.config.coinUnits"
                                 :configDepth="poolStats.config.depth"
                                 :networkHeight="poolStats.network.height" />
            </div>
            <div v-else style="text-align: center; padding: 3rem 0 3rem 0;">
                <i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading&hellip;</span>
            </div>

            <div class="button-row">
                <button v-if="poolBlocks" v-on:click="fetchExtraBlocks" class="button"
                        style="vertical-align:middle"><span>Show more</span></button>
            </div>
        </section>
    </div>
</template>

<script>
    import ListItem from "./ListItem.vue"
    import BlockListItem from "./BlockListItem.vue"

    import axios from 'axios'

    export default {
        name: 'BlockList',
        components: { ListItem, BlockListItem },
        props: {
            value: {
                type: Object,
                default() { return null }
            }
        },
        data() {
            return {
                poolStats: this.value,
                poolBlocks: null,
                extrablocks: null,
                errors: []
            }
        },
        watch: {
            value: function (val) {
                this.poolStats = val
                this.parsePoolBlocksData(this.poolStats.pool.blocks, true)
            },
        },
        methods: {
            fetchExtraBlocks() {
                let oldestBlockHeight = this.poolBlocks[this.poolBlocks.length - 1].height

                axios.get('https://[your_domain]:8119/get_blocks?height=' + oldestBlockHeight)
                    .then(response => {
                        this.parsePoolBlocksData(response.data, false)
                    })
                    .catch(e => {
                        this.errors.push(e.message)
                    })
            },
            parsePoolBlocksData(rawBlockData, mainBlocks) {
                if (!rawBlockData || rawBlockData.length == 0)
                    return

                let blocks = []

                for (let i = 0; i < rawBlockData.length; i++) {
                    let blockData = rawBlockData[i].split(':')
                    let blockHeight = rawBlockData[i + 1]

                    blocks.push({
                        height: parseInt(blockHeight),
                        hash: blockData[0],
                        timestamp: parseInt(blockData[1]),
                        difficulty: parseInt(blockData[2]),
                        shares:  parseInt(blockData[3]),
                        maturity:  parseInt(blockData[4]),
                        reward:  parseInt(blockData[5])
                    })

                    i++
                }

                let sortedBlocks = blocks.sort(function(a, b) {
                    return b.height - a.height
                })

                if (mainBlocks) {
                    this.poolBlocks = this.extrablocks
                        ? sortedBlocks.concat(this.extrablocks)
                        : sortedBlocks
                }
                else {
                    this.extrablocks = this.extrablocks
                        ? this.extrablocks.concat(sortedBlocks)
                        : sortedBlocks

                    this.poolBlocks = this.poolBlocks.concat(sortedBlocks)
                }
            }
        },
        mounted() {
            if (this.poolStats && this.poolStats.pool)
                this.parsePoolBlocksData(this.poolStats.pool.blocks, true)
        }
    }
</script>