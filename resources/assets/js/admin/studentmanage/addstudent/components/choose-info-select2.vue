<template>
    <select :required="required" :data-placeholder="dataPlaceholder" class="select">
        <option></option>
        <!--<option v-for="option in options">{{option.name}}</option>-->
    </select>
</template>
<script>
    export default {
        props: ['options', 'value','data-placeholder','required'],
        mounted: function () {
            var vm = this
            // $el chính nó
            console.log(vm.options)
            $(this.$el).select2({ data: vm.options })
                .val(this.value)
                .trigger('change')
                // emit event on change.
                .on('change', function () {
                    vm.$emit('input', this.value)
                })
        },
        watch: {
            // value: function (value) {
            //     // update value
            //     $(this.$el)
            //         .val(value)
            //         .trigger('change')
            // },
            // options: function (options) {
            //     $(this.$el).empty().select2({ data: options })
            // }
        },
        destroyed: function () {
            $(this.$el).off().select2('destroy')
        }
    }
</script>