<template>
    <div class="chart">
        <line-chart
            adapter="highcharts"
            legend="top"
            :data="data"
            :label="label"
            :min="min - padding"
            :max="max + padding"
            :presicion="precision" />
    </div>
</template>

<script>
export default {
    name: 'RateChart',
    props: {
        rates: Array,
    },
    data() {
        return {
            precision: 5,
        }
    },
    computed: {
        data() {
            return this.rates.reduce((data, { timestamp, rate }) => {
                data.push([timestamp, rate])

                return data
            }, [])
        },
        max() {
            return this.rates.reduce((max, { rate }) => max > rate ? max : rate, 0)
        },
        min() {
            return this.rates.reduce((min, { rate }) => min < rate ? min : rate, Number.MAX_SAFE_INTEGER)
        },
        padding() {
            return parseFloat(((this.max - this.min) / 2).toFixed(this.precision))
        },
        label() {
            return `${this.rates[0].base_currency.code} / ${this.rates[0].target_currency.code}`
        },
    },
}
</script>

<style scoped lang="scss">
@import '~@sass/_variables';
@import '~@sass/_mixins';

.chart {
    @include box;

    background: $color-white;
    width: 45%;
}

@media screen and (max-width: $screen-md) {
    .chart {
        width: 100%;
    }
}
</style>
