import { Line } from 'vue-chartjs'

export default Line.extend({
    name: 'LineChart',
    props: {
        label: {
            type: String,
            default: ''
        },
        labels: {
            type: Array,
            default: function () { return [] }
        },
        values: {
            type: Array,
            default: function () { return [] }
        }
    },
    mounted () {
        // Overwriting base render method with actual data.
        this.renderChart({
            labels: this.labels,
            datasets: [
                {
                    label: this.label,
                    backgroundColor: '#4286f4',
                    data: this.values
                }
            ]},
            {
                responsive: true,
                maintainAspectRatio: false,
                tooltips: {
                    mode: 'index',
                    intersect: false,
                },
                hover: {
                    mode: 'nearest',
                    intersect: true
                },
                legend: {
                    display: false
                },
                scales:
                {
                    xAxes: [{
                        display: false
                    }],
                    yAxes: [{
                        display: false
                    }],
                },
                elements: { point: { radius: 3 } }
            })
    }
})