<template>
    <div class="subscribers-wrapper">
        <div class="container subcriba-bx-shadow1">
            <p v-if="deleting" class="alert alert-danger text-center"> Deleting record... </p>
            <p v-if="deleteErr != null" class="alert alert-danger text-center"> {{ deleteErr }} </p>
            <p v-if="deleted" class="alert alert-success text-danger"> Record deleted </p>
            <table class="table table-striped table-bordered" id="subscribers-table" ref="tableRef">
                <thead class="thead-dark">
                    <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Country</th>
                    <th scope="col">Date Subscribed</th>
                    <th scope="col">Time Subscribed</th>
                    <th ref="actionRef" scope="col">Action</th>
                    </tr>
                </thead>
            </table>
        </div>
        <EditModal :email="email" :name="name" :country="country" @editSuccess="editSuccess" v-if="showModal"/>
    </div>
</template>
<script>
import $ from 'jquery'
import "datatables.net-dt/css/jquery.dataTables.min.css"
import 'datatables.net'
import EditModal from '../../components/EditModal'
export default {
    name: 'Subscribers',
    data () {
        return {
            loadingRecords: false,
            dataLoaded: false,
            email: '',
            name: '',
            country: '',
            showModal: false,
            deleting: false,
            deleteErr: null,
            deleted: false
        }
    },
    components: {
        EditModal
    },
    created () {
        const _self = this
        $(document).ready(function () {
            _self.drawTable()
        });
    },
    methods: {
        editSubscriber (email, name, country) {
            this.name = name
            this.country = country
            this.email = email
            this.showModal = true
            console.log( this.showModal)
            window.$('#subscriba-modal').modal()
        },
        deleteSubscriber (email) {
            this.deleting = true
            this.errorResponse = this.successResponse = []
            this.$store.dispatch('core/deleteSubscriber', {
                email: email
            }).then((response) => {
                this.successResponse[0] = response.data
                this.deleted = true
                this.redrawTable()
                setTimeout(() => {
                    window.$('#subscriba-modal').modal('hide')
                    this.deleted = true       
                }, 2000);
            }).catch((error) => {
                this.deleteErr = error.response.data.message
            }).finally(() => {
                this.deleting = false
            })
        },
        setActionEvents () {
            const _self = this
            var body = $('#subscribers-table').find('tbody')
            var rows = body.find('tr');
            for (var i = 0; i < rows.length; i++) {
                var cols = $(rows[i]).find('td');
                const actionCol = cols.slice(-1)
                var spans = $(actionCol).find('span')
                for (var q = 0; q < spans.length; q++) {
                    if (q === 0) {
                        $(spans[q]).addClass('btn btn-primary btn-sm')
                        const email = $(spans[q]).attr('data-tag') 
                        const country = $(spans[q]).attr('data-c') 
                        const name = $(spans[q]).attr('data-n')
                        $(spans[q]).on("click", function(event){
                            _self.editSubscriber(email, name, country)
                        });
                    } else {
                        $(spans[q]).addClass('btn btn-danger btn-sm')
                        const email = $(spans[q]).attr('data-tag') 
                        $(spans[q]).on("click", function(event){
                            _self.deleteSubscriber(email)
                        });
                    }
                    
                }
            }
        },
        drawTable() {
            $.noConflict();
            const _self = this
            const tabulate = $('#subscribers-table').DataTable({
                "serverSide": true,
                "processing": true,
                "ajax":{
                    "url": "/api/v1/subscribers",
                    "dataType": "json",
                    "type": "GET",
                    "data":{ _token: "{{ csrf_token() }}"}
                },
                "columns": [
                    { "data": "name" },
                    { "data": "email" },
                    { "data": "country" },
                    { "data": "date_subscribe" },
                    { "data": "time_subscribe" },
                    { "data": "action" }
                ]
            });
            tabulate.on( 'draw', function () {
                _self.setActionEvents()
            });
        },
        redrawTable () {
            $('#subscribers-table').DataTable().ajax.reload()
        },
        editSuccess () {
            this.redrawTable()
            setTimeout(() => {
                window.$('#subscriba-modal').modal('hide')
                this.showModal = false
            }, 2000);
        },
    }
}
</script>
