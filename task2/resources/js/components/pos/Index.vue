//Register.vue
<template>
    <div class="dashboard" style="margin-top: 80px">
        <div class="card mt-4 mb-4">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <div>
                        <h3><b>Sales Order </b></h3>
                    </div>
                 
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Nama Customer</th>
                            <th scope="col">Nama Product</th>
                            <th scope="col">Jumlah Product</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="order in orders" :key="order.id">
                            <td>{{ order.name }}</td>
                            <td>{{ order.product_name }}</td>
                            <td>{{ order.product_quantity }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
          
        </div>
        <div class="card mt-4 ">
            <div class="card-header">
                <div class="col-sm-12">Tabel Product</div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="d-flex justify-content-end mb-2">
                        <label class="mb-0 d-flex align-items-center mr-2"
                            >Search:</label
                        >
                        <input
                            type="text"
                            v-model="searchTerm"
                            class="form-control"
                            style="width: 200px"
                        />
                    </div>
                    <div
                        class="col-md-3 col-sm-6"
                        v-for="product in filtersearch"
                        :key="product.id"
                    >
                        <div class="card card-product">
                            <button
                                class="btn btn-sm"
                                @click.prevent="AddToCart(product.id)"
                                v-if="product.product_quantity >= 1"
                            >
                                <div class="card-body mt-4">
                                    <h5 class="card-title">
                                        {{ product.product_name }}
                                    </h5>
                                    <span
                                        v-if="product.product_quantity >= 1"
                                        class="badge badge-success"
                                        >Available ({{
                                            product.product_quantity
                                        }})
                                    </span>
                                    <span v-else class="badge badge-danger"
                                        >Stock Out</span
                                    >
                                </div>
                            </button>
                            <button class="btn btn-sm" v-else disabled>
                                <td class="productIMage">
                                    <img
                                        :src="`/${product.image}`"
                                        id="em_photo"
                                    />
                                </td>
                                <div class="card-body mm">
                                    <h5 class="card-title">
                                        {{ product.product_name }}
                                    </h5>
                                    <span
                                        v-if="product.product_quantity >= 1"
                                        class="badge badge-success"
                                        >Available ({{
                                            product.product_quantity
                                        }})
                                    </span>
                                    <span v-else class="badge badge-danger"
                                        >Stock Out</span
                                    >
                                </div>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mt-4">
            <div class="cards-head">
                <div class="d-flex justify-content-between">
                    <div>
                        <h3><b>Sales Order </b></h3>
                    </div>
                 
                </div>
            </div>
            <div class="card-body">
                <table class="table table-sm table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Qty</th>
                            <th scope="col">Unit</th>
                            <th scope="col">Total</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="card in cards" :key="card.id">
                            <th>{{ card.product_name }}</th>
                            <td>
                                <input
                                    type="text"
                                    readonly=""
                                    style="width: 20px"
                                    :value="card.product_quantity"
                                />
                                <button
                                    @click.prevent="increment(card.id)"
                                    class="btn btn-sm btn-success"
                                >
                                    +
                                </button>
                                <button
                                    @click.prevent="decrement(card.id)"
                                    class="btn btn-sm btn-danger"
                                    v-if="card.product_quantity >= 2"
                                >
                                    -
                                </button>
                                <button
                                    class="btn btn-sm btn-danger"
                                    v-else
                                    disabled
                                >
                                    -
                                </button>
                            </td>
                            <td>{{ card.product_price }}</td>
                            <td>{{ card.sub_total }}</td>
                            <td>
                                <a
                                    @click="removeItem(card.id)"
                                    class="btn btn-sm btn-danger"
                                    >x</a
                                >
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div>
                <ul class="list-group">
                    <li class="subTotal list-group-item">
                        Total Quantity:
                        <strong>{{ qty }}</strong>
                    </li>
                    <li class="subTotal list-group-item">
                        Sub Total:
                        <strong>{{ subtotal }}</strong>
                    </li>
                    
                        <li class="subTotal list-group-item">
                            Total:
                            <strong> </strong>
                        </li>
                </ul>
                <br />
                <form @submit.prevent="orderdone">
                    <label>Customer Name</label>
                    <select class="form-control" v-model="customer_id">
                        <option
                            :value="customer.id"
                            v-for="customer in customers"
                            :key="customer.id"
                        >
                            {{ customer.name }}
                        </option>
                    </select>
                    <label>Pay</label>
                    <input
                        type="text"
                        class="form-control"
                        required=""
                        v-model="pay"
                    />
                    <label>Due</label>
                    <input
                        type="text"
                        class="form-control"
                        required=""
                        v-model="due"
                    />
                    <label>Pay By </label>
                    <select class="form-control" v-model="payby">
                        <option value="HandCash">Cash</option>
                        <option value="Cheaque">Debit</option>
                    </select>
                    <br />
                    <button type="submit" class="btn btn-success">
                        Submit
                    </button>
                </form>
            </div>
        </div>
      
    </div>
</template>

<script>
import axios from "axios";
export default {
    
    data() {
        return {
               //state loggedIn with localStorage
            loggedIn: localStorage.getItem('loggedIn'),
            //state token
            token: localStorage.getItem('token'),
            //state user logged In
            form: {
                name: "",
                email: "",
                address: "",
                photo: "",
                phone: "",
            },
            customer_id: "",
            pay: "",
            due: "",
            payby: "",
            products: [],
            categories: "",
            getproducts: [],
            customers: "",
            searchTerm: "",
            getsearchTerm: "",
            errors: "",
            cards: "",
            orders: "",
            vats: "",
        };
    },
    
    mounted() {
        if(!this.loggedIn) {
            return this.$router.push({ name: 'login' })
        }else{
            return false
        }
    },
    created() {
        this.allProduct();
        this.allCategory();
        this.allCustomer();
        this.AllCart();
        this.Order();
    },
    computed: {
        filtersearch() {
            return this.products.filter((product) => {
                return product.product_name.match(this.searchTerm);
            });
        },
        getfiltersearch() {
            return this.getproducts.filter((getproduct) => {
                return getproduct.product_name.match(this.getsearchTerm);
            });
        },
        qty() {
            let sum = 0;
            for (let i = 0; i < this.cards.length; i++) {
                sum += parseFloat(this.cards[i].product_quantity);
            }
            return sum;
        },
        subtotal() {
            let sub = 0;
            for (let i = 0; i < this.cards.length; i++) {
                sub += parseFloat(this.cards[i].sub_total);
            }
            return sub;
        },
    },
    methods: {
        // cart methods
        AddToCart(id) {
            axios.get("http://127.0.0.1:8000/api/addTocart/" + id).then(() => {
                this.$router.go(this.$router.currentRoute);
            });
        },
        AllCart() {
            axios
                .get("http://127.0.0.1:8000/api/allCart/")
                .then(({ data }) => (this.cards = data))
                .catch();
        },
        Order() {
            axios
                .get("http://127.0.0.1:8000/api/order/")
                .then(({ data }) => (this.orders = data))
                .catch();
        },
        removeItem(id) {
            axios.get("http://127.0.0.1:8000/api/removeCart/" + id).then(() => {
                this.$router.go(this.$router.currentRoute);
            });
        },
        increment(id) {
            axios.get("http://127.0.0.1:8000/api/increment/" + id).then(() => {
                this.$router.go(this.$router.currentRoute);

                Notification.cart_increment();
            });
        },
        decrement(id) {
            axios.get("http://127.0.0.1:8000/api/decrement/" + id).then(() => {
                this.$router.go(this.$router.currentRoute);

                Notification.cart_decrement();
            });
        },
        orderdone() {
            let total = (this.subtotal * 1) / 100 + this.subtotal;
            var data = {
                qty: this.qty,
                subtotal: this.subtotal,
                customer_id: this.customer_id,
                payby: this.payby,
                pay: this.pay,
                due: this.due,
                total: total,
            };
            axios.post("/api/orderdone/", data).then(() => {
                this.$router.go(this.$router.currentRoute);

                Notification.success();
                this.$router.push("/order");
            });
        },
        //carts end
        allProduct() {
            axios
                .get("http://127.0.0.1:8000/api/product/")
                .then((response) => {
                    //assign state posts with response data
                    this.products = response.data.data;
                })
                .catch();
        },
        allCategory() {
            axios
                .get("http://127.0.0.1:8000/api/category/")
                .then(({ data }) => (this.categories = data))
                .catch();
        },
        subproduct(id) {
            axios
                .get("http://127.0.0.1:8000/api/getting/product/" + id)
                .then(({ data }) => (this.getproducts = data))
                .catch((error) => (this.errors = error.response.data.errors));
        },
        allCustomer() {
            axios
                .get("http://127.0.0.1:8000/api/customer/")
                .then((response) => {
                    //assign state posts with response data
                    this.customers = response.data.data;
                })
                .catch();
        },
        //image validationmethod
        onFileselected(event) {
            let file = event.target.files[0];
            if (file.size > 1048770) {
                Notification.image_validation();
            } else {
                let reader = new FileReader();
                reader.onload = (event) => {
                    this.form.photo = event.target.result;
                    console.log(event.target.result);
                };
                reader.readAsDataURL(file);
            }
        },
        customerInsert() {
            axios
                .post("/api/customer/", this.form)
                .then(() => {
                    $("#closeModal").click();
                    this.allCustomer();
                    Notification.success();
                })
                .catch((error) => (this.errors = error.response.data.errors));
        },
    },
};
</script>
