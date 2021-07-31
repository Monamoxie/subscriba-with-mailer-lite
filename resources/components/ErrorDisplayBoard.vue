<template>
    <div class="error-display-board">
        <div class="alert alert-danger pulse-effect" :class="{ 'alert-dismissible fade show' : dismissible } ">
            <button v-show="dismissible" type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <h6 class="alert-heading text-center">{{ serverResponse[0].message }}</h6>
            <hr/>
            <div v-for="(errorGroups, key) of serverResponse[0].errors" :key="key">
                <ul>
                    <li v-for="(listOfErrors, index) of errorGroups" :key="index">
                        <i class=" fa fa-times-circle"></i> {{ listOfErrors }}
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: 'ErrorDisplayBoard',
    props: {
        serverResponse: {
        type: Array,
        required: true
        },
        dismissible: {
        type: Boolean,
        default: false
        }
    }
}
</script>
<style scoped>
    .error-display-board ul li {
        list-style: none;
    }
</style>
