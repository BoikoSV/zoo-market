<script setup>
import { ref, onMounted } from 'vue'
import {useField, useForm} from 'vee-validate'
import {object, number, string} from 'yup';
import axios from 'axios'
import { toast } from 'vue3-toastify';


const providers = ref([])
const currency = ref('')

const appLoaded = ref(false)
const hasCalculated = ref(false)
const isSubmitting = ref(false)

const price = ref('');

const itemProps = (item) => {
    return {
        title: item.title,
        value: item.slug,
    }
}

onMounted(() => {
    axios.get('http://localhost:8000/api/shipping').then((res) => {
        currency.value = res.data.data.currency
        providers.value = res.data.data.providers
        appLoaded.value = true
    }).catch((error) => {
        console.log(error)
    })
})


const { handleSubmit, handleReset, errors, defineComponentBinds } = useForm({
    validationSchema: object({
        weight: number().typeError('Weight must be a number').required('You should paste some weight')
            .positive('Weight can\'t be a negative value')
            .integer('Weight should be an integer')
            .min(1, 'Weight should be more than 1kg')
            .max(1000, 'Weight should be less than 1000kg'),
        company: string().required('Choose any company'),
    })
})


const weight = defineComponentBinds('weight');
const company = defineComponentBinds('company');


function onSuccess(values) {
    isSubmitting.value = true
    axios.get(`http://localhost:8000/api/shipping/get-price/${values.company}`, {
        params: {
            weight: values.weight
        }
    }).then((res) => {
        hasCalculated.value = true
        price.value = res.data.data.price
        isSubmitting.value = false
    })
}
function onInvalidSubmit({ values, errors, results }) {
    const msg = []
    Object.keys(errors).forEach((error) => msg.push(errors[error]))
    toast.error(msg.join(',\n'))
    console.log(errors)
    // toast(errors)
}

const submit = handleSubmit(onSuccess, onInvalidSubmit)

</script>

<template>
    <div class="d-flex h-screen flex-column justify-center align-center bg-grey-darken-4">
        <template v-if="appLoaded">
            <div class="w-50 mb-9 px-5 py-2 text-h4">
                <v-skeleton-loader
                    type="text"
                    class="w-100 bg-grey-darken-4"
                    :loading="isSubmitting"
                >
                    <div v-if="hasCalculated" class="w-100 d-flex justify-space-between">
                        <span>Calculated price:</span>
                        <span>
                            <span>{{price}}</span>
                            <span class="text-uppercase">{{currency}}</span>
                        </span>
                    </div>
                    <div v-else class="w-100 text-center">
                        Paste the data below
                    </div>

                </v-skeleton-loader>
            </div>


            <v-card
                border="md"
                class="pa-6 text-white mx-auto"
                color="#141518"
                width="400"
            >

                <v-form @submit.prevent="submit">
                    <v-text-field
                        v-bind="weight"
                        :error-messages="errors.weight"
                        label="Weight"
                    ></v-text-field>

                    <v-select
                        v-bind="company"
                        :error-messages="errors.company"
                        :item-props="itemProps"
                        :items="providers"
                        label="Company"
                    ></v-select>

                    <div class="d-flex flex-column">
                        <v-btn
                            color="success"
                            class="mt-4"
                            type="submit"
                        >
                            Calculate
                        </v-btn>
                    </div>
                </v-form>
            </v-card>
        </template>

        <v-progress-circular
            v-else
            :size="50"
            color="primary"
            indeterminate
        ></v-progress-circular>

    </div>
</template>

<style scoped>

</style>
