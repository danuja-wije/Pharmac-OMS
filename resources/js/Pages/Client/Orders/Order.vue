<template>
    <StoreLayout>
        <div>
        <v-app>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div>

                            <div class="card-body">
                                <div class="toolbar">
                                    <!--        Here you can write extra buttons/actions for the toolbar              -->
                                </div>
                                <div class="material-datatables">
                                    <!-- DATATABLE-->
                                    <v-card elevation="8">
                                        <v-card-title primary-title class="justify-center"><h2>My orders</h2></v-card-title>


                                        <v-data-table
                                            :items="orders"
                                            class="table-striped table-no-bordered table-hover dataTable"
                                        >

                                            <template v-slot:item="row">
                                                <v-card
                                                    color="#e9ebf0"
                                                    elevation="2"
                                                    shaped
                                                    class="mx-auto my-12"
                                                    max-width="800"
                                                    @click="openDialog(row.item)"
                                                >
                                                    <div style="margin-left: 10px">
                                                        <v-list-item>
                                                            <v-list-item-content>
                                                                <v-row>
                                                                    <v-col>
                                                                        <v-list-item-title>Order ID: {{ row.item.id }}
                                                                        </v-list-item-title>
                                                                        <v-list-item-subtitle>
                                                                            Date: {{ row.item.created_at }}
                                                                        </v-list-item-subtitle>
                                                                        <v-list-item-subtitle>
                                                                            Status: {{ row.item.status }}
                                                                        </v-list-item-subtitle>
                                                                    </v-col>
                                                                    <v-col>
                                                                        <v-list-item>
                                                                            <v-list-item-content>
                                                                                <v-list-item-subtitle>
                                                                                    Payment Method: Credit Balance<!--Default transaction method-->
                                                                                </v-list-item-subtitle>
                                                                                <v-list-item-subtitle>
                                                                                    Net Amount: {{ row.item.amount.toFixed(2) }}
                                                                                </v-list-item-subtitle>
                                                                            </v-list-item-content>
                                                                        </v-list-item>
                                                                    </v-col>
                                                                </v-row>
                                                            </v-list-item-content>
                                                        </v-list-item>
                                                    </div>
                                                </v-card>
                                            </template>
                                        </v-data-table>
                                    </v-card>
                                </div>
                            </div>
                            <!-- end content-->
                        </div>
                        <!--  end card  -->
                    </div>
                    <!-- end col-md-12 -->
                </div>
            </div>
            <v-dialog v-model="orderDialog" persistent
                      max-width="500px">
                <v-card>
                    <v-btn
                        style="float: right"
                        color="error"
                        class="mr-4"
                        @click="closeDialog"
                        text
                    >
                        X
                    </v-btn>
                    <v-card-title>
                        <span class="headline">Order Details</span>
                    </v-card-title>

                    <v-container>
                        <v-list-item>
                            <v-list-item-content>
                                <v-row>
                                    <v-col>
                                        <v-list-item-title>Order ID: {{ this.orderData.order_id }}
                                        </v-list-item-title>
                                        <v-list-item-subtitle>
                                            Date: {{ this.orderData.date }}
                                        </v-list-item-subtitle>
                                        <v-list-item-subtitle>
                                            Payment Method: {{ this.orderData.paymentMethod }}
                                        </v-list-item-subtitle>
                                        <v-list-item-subtitle>
                                            Status: {{ this.orderData.status }}
                                        </v-list-item-subtitle>
                                    </v-col>
                                    <v-col>
                                        <v-list-item>
                                            <v-list-item-content>
                                                <v-list-item-subtitle>
                                                    Gross Amount: {{ this.orderData.grossAmount }}
                                                </v-list-item-subtitle>
                                                <v-list-item-subtitle>
                                                    Line Discount: {{ this.orderData.discount }}
                                                </v-list-item-subtitle>
                                                <v-list-item-subtitle>
                                                    Net Amount: {{ this.orderData.netAmount }}
                                                </v-list-item-subtitle>
                                            </v-list-item-content>
                                        </v-list-item>
                                    </v-col>
                                </v-row>
                            </v-list-item-content>
                        </v-list-item>
                        <template>
                            <v-simple-table
                                color="#e9ebf0"
                            >
                                <template v-slot:default>
                                    <thead>
                                    <tr>
                                        <th class="text-left">
                                            Item
                                        </th>
                                        <th class="text-left">
                                            Quantity
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>Penadol</td>
                                        <td>100</td>
                                    </tr>
                                    <tr>
                                        <td>Lidocaine Ear Drop</td>
                                        <td>25</td>
                                    </tr>
                                    </tbody>
                                </template>
                            </v-simple-table>
                        </template>
                        <div style="text-align: center; padding: 15px">
                            <v-btn
                                color="error"
                                class="mr-4"
                                @click="inquiry"
                            >
                                Inquiry
                            </v-btn>
                            <v-btn
                                dark
                                color="indigo darken-3"
                                class="mr-4"
                                @click="printOrder"
                            >
                                Print
                            </v-btn>
                        </div>

                    </v-container>

                </v-card>

            </v-dialog>
        </v-app>
        </div>
    </StoreLayout>
</template>

<script>
import StoreLayout from '../../../Shared/Storefront/StoreLayout'

export default {
    name: "Orders",
    mounted: function () {
        //this.$swal('Hello World !!!');
    },
    components: {
        StoreLayout,
    },
    props: {
        orders: Array,
    },
    methods: {
        openDialog(item) {
            this.orderDialog = true
            this.orderData.order_id = item.id
            this.orderData.date = item.created_at
            this.orderData.paymentMethod = 'Credit Balance'
            this.orderData.grossAmount = item.amount
            this.orderData.discount = item.amount*0.1
            this.orderData.netAmount = item.amount-this.orderData.discount
            this.orderData.status = item.status
        },
        closeDialog() {
            this.orderDialog = false
        },
        printOrder() {
            this.orderDialog = false
        },
        inquiry() {
            //fix this link
            this.$inertia.get('/return/store/'+this.orderData.order_id)
        },

    },
    data() {
        return {
            orderDialog: false,
            search: '',
            search2: '',
            status: {
                status: 'Rejected',
                id: '',
            },
            headers: [
                {text: 'Id', value: 'id'},
                {text: 'Cus. Id', value: 'customer_id'},
                {text: 'Amount', value: 'amount'},
                {text: 'Placed on', value: 'created_at'},
                {text: '', value: 'name', sortable: false}
            ],
            headers2: [
                {text: 'Id', value: 'id'},
                {
                    text: 'Customer',
                    align: 'start',
                    sortable: false,
                    value: 'customer.name',
                },

                {text: 'Order Type', value: 'type'},
                {text: 'Amount', value: 'amount'},
                {text: 'Status', value: 'status'},
                {text: 'Placed on', value: 'created_at'},
            ],
            orderData: {
                order_id: '',
                date: '',
                paymentMethod: '',
                status: '',
                grossAmount: '',
                discount: '',
                netAmount: '',
            }

        }
    }
}
</script>

<style scoped>

</style>
