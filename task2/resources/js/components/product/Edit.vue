<template>
        <div class="dashboard" style="margin-top:80px">

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 rounded shadow">
                    <div class="card-body">
                        <h4>EDIT POST</h4>
                        <hr>

                        <form @submit.prevent="update">
                            <div class="form-group">
                                <label for="title" class="font-weight-bold">Nama</label>
                                <input type="text" class="form-control" v-model="post.product_name" placeholder="Masukkan Nama">
                                <!-- validation -->
                                <div v-if="validation.product_name" class="mt-2 alert alert-danger">
                                    {{ validation.product_name[0] }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="content" class="font-weight-bold">Harga</label>
                                <input type="text" class="form-control" v-model="post.selling_price" placeholder="Email">
                                <!-- validation -->
                                <div v-if="validation.selling_price" class="mt-2 alert alert-danger">
                                    {{ validation.selling_price[0] }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="content" class="font-weight-bold">Jumlah</label>
                                <input type="text" class="form-control" v-model="post.product_quantity" placeholder="Email">
                                <!-- validation -->
                                <div v-if="validation.product_quantity" class="mt-2 alert alert-danger">
                                    {{ validation.product_quantity[0] }}
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">SIMPAN</button>
                        </form>                        

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</template>
<script>
import { reactive, ref, onMounted } from 'vue'
import { useRouter, useRoute } from 'vue-router'
import axios from 'axios'

export default {
  name: 'CustomerEdit',
   setup() {

        //state posts
        const post = reactive({
            product_name: '',
            selling_price: '',
            product_quantity: '',
        })

        //state validation
        const validation = ref([])

        //vue router
        const router = useRouter()

        //vue router
        const route = useRoute()

        //mounted
        onMounted(() => {

            //get API from Laravel Backend
            axios.get(`http://localhost:8000/api/product/${route.params.id}`)
            .then(response => {
              
              //assign state posts with response data
              post.product_name    = response.data.data.product_name  
              post.selling_price    = response.data.data.selling_price  
              post.product_quantity    = response.data.data.product_quantity  

            }).catch(error => {
                console.log(error.response.data)
            })

        })

        //method update
        function update() {

            let product_name   = post.product_name
            let selling_price   = post.selling_price
            let product_quantity   = post.product_quantity

            axios.put(`http://localhost:8000/api/product/${route.params.id}`, {
                product_name: product_name,
                selling_price: selling_price,
                product_quantity: product_quantity,
            }).then(() => {

                //redirect ke post index
                router.push({
                    name: 'product'
                })

            }).catch(error => {
                //assign state validation with error 
                validation.value = error.response.data
            })

        }

        //return
        return {
            post,
            validation,
            router,
            update
        }

    }

}
</script>
<style>
    body{
        background: lightgray;
    }
</style>