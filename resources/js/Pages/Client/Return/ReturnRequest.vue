<template>
    <Layout>
    <v-app>
        <div style="max-width:65%; padding-left: 20%">
        <form>
            <br/>
            <v-card-title>
                Return Request
            </v-card-title>
            <v-text-field
                v-model="order_id"
                :error-messages="orderidErrors"
                :counter="10"
                label="Order ID"
                required
                @input="$v.order_id.$touch()"
                @blur="$v.order_id.$touch()"
            ></v-text-field>
            <v-text-field
                v-model="reason"
                :error-messages="reasonErrors"
                label="Reason"
                required
                @input="$v.reason.$touch()"
                @blur="$v.reason.$touch()"
            ></v-text-field>
            <v-select
                v-model="select"
                :items="items"
                :error-messages="selectErrors"
                label="Type"
                required
                @change="$v.select.$touch()"
                @blur="$v.select.$touch()"
            ></v-select>

            <v-file-input
                chips
                multiple
                label="Images"
            ></v-file-input>

            <v-btn
                class="mr-4"
                @click="submit"
            >
                submit
            </v-btn>
            <v-btn @click="reset">
                clear
            </v-btn>

        </form>
        </div>
    </v-app>
    </Layout>
</template>

<script>
import Layout from '../../../Shared/Admin/Layout'

//import { validationMixin } from 'vuelidate'
//import { required} from 'vuelidate/lib/validators'


export default {
    components:{
        Layout,
    },
    props:[],

    mixins: [validationMixin],

    validations: {
        order_id: { required},
        reason: { required},
        select: { required },

    },

    data: () => ({
        order_id: '',
        reason: '',
        select: null,
        items: [
            'Reorder',
            'Refund',
        ],
        checkbox: false,
    }),

    computed: {
        selectErrors () {
            const errors = []
            if (!this.$v.select.$dirty) return errors
            !this.$v.select.required && errors.push('Type is required')
            return errors
        },
        orderidErrors () {
            const errors = []
            if (!this.$v.order_id.$dirty) return errors
            !this.$v.order_id.required && errors.push('Order ID is required.')
            return errors
        },
        reasonErrors () {
            const errors = []
            if (!this.$v.reason.$dirty) return errors
            !this.$v.reason.required && errors.push('Reason is required')
            return errors
        },
    },

    methods: {
        reset () {
            this.form.reset()
        },
        submit(){
            this.$inertia.post('/supplier/store',this.form);
            this.form.reset()
        },
    },
}
</script>
