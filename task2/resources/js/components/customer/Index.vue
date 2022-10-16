//Register.vue
<template>
        <div class="dashboard" style="margin-top:80px">

    <div class="container mb-5 mt-5">
        <div class="row">
            <router-link
                :to="{ name: 'customer.create' }"
                class="btn btn-sm btn-success mr-1"
                >TAMBAH POST</router-link
            >

            <div class="col-md-12 bg-light p-5 mb-5">
                <table class="table table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Nama</th>
                            <th scope="col">Email</th>
                            <th scope="col">No Hp</th>
                            <th scope="col">Address</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(post, index) in posts" :key="index">
                            <td>{{ post.name }}</td>
                            <td>{{ post.email }}</td>
                            <td>{{ post.phone }}</td>
                            <td>{{ post.address }}</td>
                            <td class="text-center">
                                <router-link
                                    :to="{
                                        name: 'customer.edit',
                                        params: { id: post.id },
                                    }"
                                    class="btn btn-sm btn-primary mr-1"
                                    >EDIT</router-link
                                >
                                <button
                                    @click.prevent="postDelete(post.id)"
                                    class="btn btn-sm btn-danger ml-1"
                                >
                                    DELETE
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-12" v-if="adduser">
                <h2>Create User Here</h2>
                <form v-on:submit.prevent="create_user">
                    <div class="form-group">
                        <label for="name">Enter name</label>
                        <input
                            type="text"
                            name=" name"
                            class="form-control"
                            id="exampleInputEmail1"
                            aria-describedby="emailHelp"
                            placeholder="Enter Username"
                            v-model="form.name"
                        />
                    </div>
                    <div class="form-group">
                        <label for="email">Enter Email</label>
                        <input
                            type="email"
                            name=" email"
                            class="form-control"
                            id="exampleInputEmail1"
                            aria-describedby="emailHelp"
                            placeholder="Enter Email"
                            v-model="form.email"
                        />
                    </div>

                    <button type="submit" class="btn btn-primary">
                        Submit
                    </button>
                </form>
            </div>
        
        </div>
    </div>
    </div>
  
</template>

<script>
import axios from "axios";
import { onMounted, ref } from "vue";

export default {
    name: "IndexItem",
    data() {
        return {
            //state loggedIn with localStorage
            loggedIn: localStorage.getItem('loggedIn'),
            //state token
            token: localStorage.getItem('token'),
            //state user logged In
            user: []
        }
    },

    mounted() {
        if(!this.loggedIn) {
            return this.$router.push({ name: 'login' })
        } else {
            return false
        }
    },
    setup() {
        //reactive state
        let posts = ref([]);

        //mounted
        onMounted(() => {
            //get API from Laravel Backend
            axios
                .get("http://localhost:8000/api/customer")
                .then((response) => {
                    //assign state posts with response data
                    posts.value = response.data.data;
                })
                .catch((error) => {
                    console.log(error.response.data);
                });
        });
        //method delete
        function postDelete(id) {
            //delete data post by ID
            axios
                .delete(`http://localhost:8000/api/customer/${id}`)
                .then(() => {
                    //splice posts
                    posts.value.splice(posts.value.indexOf(id), 1);
                })
                .catch((error) => {
                    console.log(error.response.data);
                });
        }
        //return
        return {
            posts,
            postDelete,
        };
    },
};
</script>
