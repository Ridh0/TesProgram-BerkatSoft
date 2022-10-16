<template>
    <div class="login">
        <div class="container" style="margin-top: 100px">
            <div class="row justify-content-center">
                <div class="col-md-5">
                    <div v-if="loginFailed" class="alert alert-danger">
                        Email atau Password Anda salah.
                    </div>
                    <div class="card">
                        <div class="card-body">
                            Register
                            <hr />
                            <form @submit.prevent="register">
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        v-model="user.name"
                                        placeholder="Masukkan Nama"
                                    />
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input
                                        type="email"
                                        class="form-control"
                                        v-model="user.email"
                                        placeholder="Masukkan Email"
                                    />
                                </div>

                                <div class="form-group">
                                    <label>Password</label>
                                    <input
                                        type="password"
                                        class="form-control"
                                        v-model="user.password"
                                        placeholder="Masukkan Password"
                                    />
                                </div>

                                <button type="submit" class="btn btn-primary mt-3">
                                    LOGIN
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
import axios from "axios";

export default {
    name: "Login",

    data() {
        return {
            loggedIn: localStorage.getItem("loggedIn"),
            //state token
            token: localStorage.getItem("token"),
            //state validation
            //state login failed
            loginFailed: null,
            user: {
                name: "",
                email: "",
                password: "",
            },
        };
    },
    methods: {
         register() {
            axios
                .get("http://localhost:8000/sanctum/csrf-cookie")
                .then((response) => {
                    console.log(response);
                    axios
                        .post("http://localhost:8000/api/register", this.user)
                        .then((res) => {
                            console.log(res);

                            if (res.data.success) {
                                //set localStorage
                                localStorage.setItem("loggedIn", "true");

                                //set localStorage Token
                                localStorage.setItem("token", res.data.token);

                                //change state
                                this.$router.push({ name: "dashboard" });
                            } else {
                                //set state login failed
                                this.loginFailed = true;
                            }
                            //redirect dashboard
                        })
                        .catch((error) => {
                                console.log(error);
                            });
                      
                      
                });
        },
    },

    //check user already logged in
    mounted() {
        if (this.loggedIn) {
            return this.$router.push({ name: "dashboard" });
        }
    },
};
</script>
