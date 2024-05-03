<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />
<script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>

<div
    x-data="{
        multiple: true,
        value: [1, 2],
        options: [
            { value: 1, label: 'Caleb Porzio' },
            { value: 2, label: 'Jason Beggs' },
            { value: 3, label: 'Tweedle Dee' },
            { value: 4, label: 'Tweedle Dum' },
        ],
        init() {
            this.$nextTick(() => {
                let choices = new Choices(this.$refs.select)

                let refreshChoices = () => {
                    let selection = this.multiple ? this.value : [this.value]

                    choices.clearStore()
                    choices.setChoices(this.options.map(({ value, label }) => ({
                        value,
                        label,
                        selected: selection.includes(value),
                    })))
                }

                refreshChoices()

                this.$refs.select.addEventListener('change', () => {
                    this.value = choices.getValue(true)
                })

                this.$watch('value', () => refreshChoices())
                this.$watch('options', () => refreshChoices())
            })
        }
    }"
    class="max-w-sm w-full"
>
    <select x-ref="select" :multiple="multiple"></select>
</div>
