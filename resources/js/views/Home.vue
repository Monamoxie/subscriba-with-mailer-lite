<template>
    <div class="home-wrapper container">
        <div class="row">
                <div class="col-md-6">
                    <h1>Be part <strong>of</strong> something new <span class="dot">.</span> </h1>
                    <div class="subscriba-form-wrapper subcriba-bx-shadow1" v-if="!subscribeSuccess">
                        <ErrorDisplayBoard v-if="errorResponse.length > 0 && errorResponse[0].code != 200"
                        :serverResponse="errorResponse"></ErrorDisplayBoard>
                        <form @submit.prevent="subscribe">
                            <div class="row">
                                <div class="col-md-6">
                                    <validation-provider rules="required" v-slot="{ errors }" name="Name">
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text" v-model="name" class="form-control" placeholder="Your name" required>
                                        </div>
                                        <p v-if="errors.length > 0" class="text-danger text-left m-o p-o">
                                            <small>{{ errors[0] }}</small>
                                        </p>
                                    </validation-provider>
                                </div>
                                <div class="col-md-6">
                                    <validation-provider rules="required" v-slot="{ errors }" name="Country">
                                        <div class="form-group">
                                            <label for="validationDefault01">Country</label>
                                            <country-select autocomplete  :class="'form-control'" :countryName="true" v-model="country" :country="country" topCountry="US" required/>
                                        </div>
                                        <p v-if="errors.length > 0" class="text-danger text-left m-o p-o">
                                            <small>{{ errors[0] }}</small>
                                        </p>
                                    </validation-provider>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <validation-provider rules="required|email" v-slot="{ errors }" name="Email">
                                        <div class="form-group">
                                            <label for="validationDefault01">Email</label>
                                            <input type="email" v-model="email" class="form-control" placeholder="Email address" required>
                                        </div>
                                        <p v-if="errors.length > 0" class="text-danger text-left m-o p-o">
                                            <small>{{ errors[0] }}</small>
                                        </p>
                                    </validation-provider>
                                </div>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary bubbly-button theme1" type="submit">
                                    <span v-if="processing" class="loader-palette">
                                        <PulseLoader :color="'#ffffff'" :size="12"></PulseLoader>
                                    </span>
                                    <span v-else>Subscribe</span>
                                </button>
                            </div>
                        </form>
                    </div>
                    <SuccessDisplayBoard  v-else :serverResponse="successResponse" />
                </div>
                <div class="col-md-6 side-hero">
                    <img src="img/hero.fadf5522c9bd.jpg">
                </div>
            </div>
    </div>
</template>
<script>
import ErrorDisplayBoard from '../../components/ErrorDisplayBoard'
import SuccessDisplayBoard from '../../components/SuccessDisplayBoard'
export default {
    name: 'Home',
    data () {
        return {
            name: '',
            country: 'United States',
            email: '',
            processing: false,
            errorResponse: [],
            successResponse: [],
            subscribeSuccess: false
        }
    },
    components: {
        ErrorDisplayBoard,
        SuccessDisplayBoard
    },
    methods: {
        subscribe () {
            this.processing = true
            this.errorResponse = this.successResponse = []
            this.$store.dispatch('core/subscribe', {
                name: this.name,
                country: this.country,
                email: this.email
            }).then((response) => {
                this.successResponse[0] = response.data
                this.subscribeSuccess = true
            }).catch((error) => {
                this.errorResponse[0] = error.response.data
            }).finally(() => {
                this.processing = false
            })
        }
    }
}
</script>
