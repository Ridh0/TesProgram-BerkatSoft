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
                                <input type="text" class="form-control" v-model="post.name" placeholder="Masukkan Nama ">
                                <!-- validation -->
                                <div v-if="validation.name" class="mt-2 alert alert-danger">
                                    {{ validation.name[0] }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="content" class="font-weight-bold">Email</label>
                                <input type="text" class="form-control" v-model="post.email" placeholder="Masukkan Email">
                                <!-- validation -->
                                <div v-if="validation.email" class="mt-2 alert alert-danger">
                                    {{ validation.email[0] }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="content" class="font-weight-bold">No HP</label>
                                <input type="text" class="form-control" v-model="post.phone" placeholder="Masukkan No HP">
                                <!-- validation -->
                                <div v-if="validation.phone" class="mt-2 alert alert-danger">
                                    {{ validation.phone[0] }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="content" class="font-weight-bold">Address</label>
                                <input type="text" class="form-control" v-model="post.address" placeholder="Masukkan Alamat">
                                <!-- validation -->
                                <div v-if="validation.address" class="mt-2 alert alert-danger">
                                    {{ validation.address[0] }}
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
            name: '',
            email: '',
            phone: '',
            address: '',
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
            axios.get(`http://localhost:8000/api/customer/${route.params.id}`)
            .then(response => {
              
              //assign state posts with response data
              post.name    = response.data.data.name  
              post.email    = response.data.data.email  
              post.phone    = response.data.data.phone  
              post.address    = response.data.data.address  

            }).catch(error => {
                console.log(error.response.data)
            })

        })

        //method update
        function update() {

            let name   = post.name
            let phone   = post.phone
            let email   = post.email
            let address   = post.address

            axios.put(`http://localhost:8000/api/customer/${route.params.id}`, {
                name: name,
                email: email,
                phone: phone,
                address: address,
            }).then(() => {

                //redirect ke post index
                router.push({
                    name: 'customer'
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