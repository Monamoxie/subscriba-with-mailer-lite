<template>
    <div class="subcriba-api-key-wrapper">
        <div class="form-container subcriba-bx-shadow1">
            <ErrorDisplayBoard v-if="errorResponse.length > 0 && errorResponse[0].code != 200"
            :serverResponse="errorResponse"></ErrorDisplayBoard>
            <div class="row" v-if="!saveSuccess">
                <div class="col-md-12">
                    <validation-provider rules="required" v-slot="{ errors }" name="Api key">
                        <div class="form-group">
                            <label>API Key</label>
                            <input type="text" v-model="api_key" class="form-control" placeholder="MailerLite Api Key">
                        </div>
                        <p v-if="errors.length > 0" class="text-danger text-left">
                            <small>{{ errors[0] }}</small>
                        </p>
                    </validation-provider>
                </div>
                <div class="col-md-12">
                    <button class="btn btn-primary bubbly-button" type="submit" @click="saveApiKey">
                        <span v-if="processing" class="loader-palette">
                            <PulseLoader :color="'#ffffff'" :size="12"></PulseLoader>
                        </span>
                        <span v-else>Save Api Key</span>
                    </button>
                </div>
            </div>
            <SuccessDisplayBoard  v-else :serverResponse="successResponse" />
        </div>
    </div>
</template>
<script>
import ErrorDisplayBoard from '../../components/ErrorDisplayBoard'
import SuccessDisplayBoard from '../../components/SuccessDisplayBoard'
export default {
    name: 'ApiKey',
    data () {
        return {
            processing: false,
            api_key: '',
            errorResponse: [],
            successResponse: [],
            saveSuccess: false,
        }
    },
    components: {
        ErrorDisplayBoard,
        SuccessDisplayBoard
    },
    methods: {
        saveApiKey () {
            if  (this.api_key !== '') {
                this.processing = true
                this.errorResponse = this.successResponse = []
                this.$store.dispatch('core/saveApiKey', {
                    api_key: this.api_key
                }).then((response) => {
                    this.successResponse[0] = response.data
                    this.saveSuccess = true
                }).catch((error) => {
                    this.errorResponse[0] = error.response.data
                }).finally(() => {
                    this.processing = false
                })
            }
        },
        getApiKey () {
            this.$store.dispatch('core/getApiKey').then((response) => {
                this.api_key = response.data.data !== null ? response.data.data.api_key : ''
            })
        }
    },
    mounted () {
        this.getApiKey()
    }
}
</script>