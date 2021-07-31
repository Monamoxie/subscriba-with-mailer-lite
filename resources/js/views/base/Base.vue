<template>
    <section class="base-wrapper">
        <component :is="dynamicComponent" :key="$route.name"></component>
    </section>
</template>
<script>
export default {
    name: 'Base',
    computed: {
        dynamicComponent () {
            if (this.file !== '') {
                return () => import('../' + this.file)
            }
            return ''
        }
    },
    props: {
            query: {
            type: Object,
            required: false
            },
            file: {
            type: String
            }
    }
}
</script>
