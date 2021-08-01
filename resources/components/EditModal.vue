<template>
    <form @submit.prevent="editSubscriber">
        <div class="modal fade" id="subscriba-modal" tabindex="9999" role="dialog" aria-labelledby="subscriba-modal-label" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Subscriber</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <ErrorDisplayBoard v-if="errorResponse.length > 0 && errorResponse[0].code != 200"
                        :serverResponse="errorResponse"></ErrorDisplayBoard>
                        <div class="subscriba-form-wrapper subcriba-bx-shadow1" v-if="!editSuccess">
                            <div class="row">
                                <div class="col-md-6">
                                    <validation-provider rules="required" v-slot="{ errors }" name="Name">
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text" v-model="editName" class="form-control" placeholder="Your name" required>
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
                                            <country-select autocomplete :class="'form-control'" :countryName="true" v-model="editCountry" :country="country" topCountry="US" required/>
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
                        </div>
                        <SuccessDisplayBoard v-else :serverResponse="successResponse" />
                    </div>
                    <div class="modal-footer" v-if="!editSuccess">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">
                            <span v-if="processing" class="loader-palette">
                                <PulseLoader :color="'#ffffff'" :size="12"></PulseLoader>
                            </span>
                            <span v-else>Save Changes</span>
                        </button>
                    </div>
                </div>
                
            </div>
        </div>
    </form>
</template>
<script>
import ErrorDisplayBoard from './ErrorDisplayBoard'
import SuccessDisplayBoard from './SuccessDisplayBoard'
export default {
    name: 'EditModal',
    data () {
        return {
            editName: this.name,
            editCountry: this.country,
            editSuccess: false,
            errorResponse: [],
            successResponse: [],
            processing: false
        }
    }, 
    components: {
        ErrorDisplayBoard,
        SuccessDisplayBoard
    },
    props: {
        email: {
            required: true
        },
        name: {
            required: true
        },
        country: {
            required: true
        },
    },
    methods: {
        editSubscriber () {
            this.processing = true
            this.errorResponse = this.successResponse = []
            this.$store.dispatch('core/editSubscriber', {
                name: this.editName,
                country: this.editCountry,
                email: this.email
            }).then((response) => {
                this.successResponse[0] = response.data
                this.editSuccess = true
                this.$emit('editSuccess')
            }).catch((error) => {
                this.errorResponse[0] = error.response.data
            }).finally(() => {
                this.processing = false
            })
        }
    }
}
</script>