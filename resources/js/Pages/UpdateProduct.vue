<template>
    <Layout>
        <v-app>
            <div class="container-fluid">
                <div class="row">

                    <div class="card">
                        <div class="card-header card-header-rose card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">edit_note</i>
                            </div>
                            <h4 class="card-title">Edit Product Details</h4>
                        </div>
                        <div>
                            <v-card align="center" max-width="80%">
                                <form id="addForm" @submit.prevent="update(product)">
                                    <v-container>
                                        <v-col
                                            cols="10"
                                            md="20"
                                            align="center"
                                        >

                                            <v-img
                                                v-bind:src="form.imagePath"
                                                contain
                                                max-width="30%"
                                                max-height="300px"
                                                class="grey darken-0"
                                            ></v-img>
                                        </v-col>

                                        <v-col
                                            cols="10"
                                            md="8">
                                            <v-file-input
                                                @input="form.imagePath = $event.target.files[0]"
                                                label="Update image"
                                                filled
                                                prepend-icon="mdi-camera"
                                                v-model="form.imagePath"
                                            ></v-file-input>


                                            <v-text-field

                                                v-model="form.stock_id"
                                                :counter="10"
                                                label="Stock ID"
                                                required
                                            ></v-text-field>
                                            <v-text-field
                                                v-model="form.name"
                                                :counter="50"
                                                label="Product Name"
                                                required
                                            ></v-text-field>


                                            <v-text-field
                                                v-model="form.unitPrice"
                                                :counter="50"
                                                label="Unit Price"

                                            ></v-text-field>

                                            <v-text-field
                                                v-model="form.discount_id"
                                                :counter="50"
                                                label="Discount ID"
                                                required
                                            ></v-text-field>
                                        </v-col>
                                        <v-btn color="#FF80AB" type="submit" dark>Submit</v-btn>

                                    </v-container>


                                </form>
                            </v-card>

                        </div>
                    </div>
                </div>
            </div>

        </v-app>
    </Layout>
</template>

<script>
import Layout from "../Shared/Admin/Layout";

export default {
    components: {
        Layout,
    },
    props: ['product'],
    data() {
        return {
            form: {
                id: this.product.id,
                stock_id: this.product.stock_id,
                name: this.product.name,
                imagePath: this.product.imagePath,
                unitPrice: this.product.unitPrice,
                discount_id: this.product.discount_id,
            }
        }
    },
    methods: {
        update: function () {
            this.$inertia.post('/updateProducts',this.form);
        }
    }
}
</script>


