<template>
    <div class="dashboard" style="margin-top: 80px">
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="card border-0 rounded shadow">
                        <div class="card-body">
                            <h4>TAMBAH POST</h4>
                            <hr />

                            <form @submit.prevent="store">
                                <div class="form-group">
                                    <label for="title" class="font-weight-bold"
                                        >Nama</label
                                    >
                                    <input
                                        type="text"
                                        class="form-control"
                                        v-model="post.name"
                                        placeholder="Masukkan Nama Customer"
                                    />
                                    <!-- validation -->
                                    <div
                                        v-if="validation.nama"
                                        class="mt-2 alert alert-danger"
                                    >
                                        {{ validation.nama[0] }}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label
                                        for="content"
                                        class="font-weight-bold"
                                        >Email</label
                                    >
                                    <input
                                        type="text"
                                        class="form-control"
                                        v-model="post.email"
                                        placeholder="Masukan Email Customer"
                                    />
                                    <!-- validation -->
                                    <div
                                        v-if="validation.email"
                                        class="mt-2 alert alert-danger"
                                    >
                                        {{ validation.email[0] }}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label
                                        for="content"
                                        class="font-weight-bold"
                                        >No Hp</label
                                    >
                                    <input
                                        type="text"
                                        class="form-control"
                                        v-model="post.phone"
                                        placeholder="Masukan No HP"
                                    />
                                    <!-- validation -->
                                    <div
                                        v-if="validation.phone"
                                        class="mt-2 alert alert-danger"
                                    >
                                        {{ validation.phone[0] }}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label
                                        for="content"
                                        class="font-weight-bold"
                                        >Address</label
                                    >
                                    <input
                                        type="text"
                                        class="form-control"
                                        v-model="post.address"
                                        placeholder="Masukan Alamat Customer"
                                    />
                                    <!-- validation -->
                                    <div
                                        v-if="validation.address"
                                        class="mt-2 alert alert-danger"
                                    >
                                        {{ validation.address[0] }}
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">
                                    SIMPAN
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { reactive, ref } from "vue";
import { useRouter } from "vue-router";
import axios from "axios";

export default {
    name: "CreateItem",

    setup() {
        //state posts
        const post = reactive({
            name: "",
            email: "",
            phone: "",
            address: "",
        });

        //state validation
        const validation = ref([]);

        //vue router
        const router = useRouter();

        //method store
        function store() {
            let name = post.name;
            let phone = post.phone;
            let email = post.email;
            let address = post.address;

            axios
                .post("http://localhost:8000/api/customer", {
                    name: name,
                    email: email,
                    phone: phone,
                    address: address,
                })
                .then(() => {
                    //redirect ke post index
                    router.push({
                        name: "customer",
                    });
                })
                .catch((error) => {
                    //assign state validation with error
                    validation.value = error.response.data;
                });
        }

        //return
        return {
            post,
            validation,
            router,
            store,
        };
    },
};
</script>

<style>
body {
    background: lightgray;
}
</style>
