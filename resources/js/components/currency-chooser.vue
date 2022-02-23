<template>
    <select class="chooser" ref="chooser" @change="this.handleChange">
        <template v-for="currency in currencies">
            <option :value="currency.code" :selected="currency.code === selected?.code">
                {{currency.title}} ({{currency.code}})
            </option>
        </template>
    </select>
</template>

<script>
    export default {
        name: 'CurrencyChooser',
        props: {
            currencies: Array,
        },
        data() {
            return {
                selected: null,
            }
        },
        mounted() {
            this.selected = this.currencies[0]
        },
        methods: {
            handleChange(event) {
                this.selected = this.currencies.find(({ code }) => code === event.target.value)
            },
        },
    }
</script>

<style scoped lang="scss">
@import '~@sass/_variables';

.chooser {
    color: $color-secondary;
    font-size: 1.5rem;
    font-weight: bold;
    background: transparent;
    outline: none;
    border: none;
    text-align: right;
}
</style>
