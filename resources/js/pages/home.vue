<template>
    <inertia-head title="Currency Exchange Rates" />

    <main class="page">
        <section class="page__title">
            <h1>Currency Exchange Rates</h1>
            <currency-chooser ref="currency" :currencies="currencies" />
        </section>

        <section class="page__content">
            <template v-for="[targetCurrencyCode, targetCurrencyRates] of groupedRates">
                <rate-chart :rates="targetCurrencyRates" />
            </template>
        </section>
    </main>
</template>

<script>
import { Head } from '@inertiajs/inertia-vue3'
import CurrencyChooser from '../components/currency-chooser'
import RateChart from '../components/rate-chart'

export default {
    components: {
        'rate-chart': RateChart,
        'currency-chooser': CurrencyChooser,
        'inertia-head': Head,
    },
    props: {
        rates: Array,
        currencies: Array,
    },
    data() {
        return {
            selectedCurrency: null,
        }
    },
    computed: {
        groupedRates() {
            const groupedRates = new Map();

            if (!this.selectedCurrency) {
                return groupedRates
            }

            const rates = this.rates.filter((rate) => rate.base_currency.code === this.selectedCurrency.code)

            rates.forEach((rate) => {
                const collection = groupedRates.get(rate.target_currency.code)

                if (collection) {
                    collection.push(rate)
                } else {
                    groupedRates.set(rate.target_currency.code, [rate])
                }
            });

            return groupedRates
        },
    },
    mounted() {
        this.selectedCurrency = this.$refs.currency.selected

        this.$watch(
            () => this.$refs.currency.selected,
            (selectedCurrency) => this.selectedCurrency = selectedCurrency
        )
    },
}
</script>

<style scoped lang="scss">
@import '~@sass/_variables';
@import '~@sass/_mixins';

.page {
    @include container($screen-lg);

    &__title h1 {
        font-size: 1.5rem;
        color: $color-primary;
    }

    &__title,
    &__content {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        align-items: center;
    }
}
</style>
