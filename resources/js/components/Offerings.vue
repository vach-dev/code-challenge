<template>
    <div>
        <div class="container-fluid py-5">
            <div class="row">
                <div class="col-2">
                    <button class="btn btn-primary" @click="$router.push({path: '/purchases'})">Go to Purchases</button>
                </div>
                <div class="col-5">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">Title</th>
                            <th scope="col">Price</th>
                            <th class="text-center" scope="col">Quantity</th>
                            <th class="text-center" scope="col">Available Quantity</th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="item in items">
                            <input @click="errorMsg=''" type="checkbox" id="offering" :value="item" v-model="selectedOfferings">
                            <th scope="row">{{item.title}}</th>
                            <td>${{item.price}}</td>
                            <td class="text-center">
                                <select class="custom-select w-75" v-model.number="item.purchaseQuantity">
                                    <option v-for="quantity in item.quantity">{{quantity}}</option>
                                </select>
                            </td>
                            <td class="text-center">{{item.quantity}}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-5">
                    <form>
                        <div class="form-group">
                            <label for="customerName">Customer Name</label>
                            <input v-model="customerName" @input="errorMsg=''" type="text" class="form-control" id="customerName" placeholder="Enter Your Name">
                            <small v-if="errorMsg.length" id="error" class="form-text text-danger">{{errorMsg}}</small>
                        </div>
                        <div>
                            <button type="button" class="btn btn-success" @click="makePurchase">Make Purchase</button>
                        </div>
                    </form>
                    <div class="text-success">{{ responseMsg }}</div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';
    export default {
        name: "Offerings",
        computed: {
            readyToPurchaseOfferings() {
                return this.selectedOfferings.map(item => {
                    return Object.assign(item, {
                        customerName: this.customerName
                    })
                });
            }
        },
        data() {
            return {
                items: [],
                responseMsg: '',
                selectedOfferings: [],
                customerName: '',
                errorMsg: ''
            }
        },
        mounted() {
            this.init();
        },
        methods: {
            init() {
                this.getOfferings();
            },
            makePurchase() {
                let error = this.validationErrors();
                if(error) {
                    this.errorMsg = error
                } else {
                    axios.post('http://task.loc/api/purchases', {offerings: this.readyToPurchaseOfferings}).then(response => {
                        this.responseMsg = response.data.message;
                        this.getOfferings();
                        this.resetData();

                    })
                }
            },
            getOfferings() {
                axios.get('http://task.loc/api/offerings').then(response => {
                    this.items = response.data.map(offering => Object.assign(offering, {purchaseQuantity: 1}));
                })
            },
            resetData() {
                this.responseMsg = '';
                this.selectedOfferings = [];
                this.customerName = '';
                this.errorMsg = ''
            },
            validationErrors() {
                if(!this.readyToPurchaseOfferings.length) {
                    return "You hav not choose anything";
                } else if(!this.customerName.length) {
                    return "Provide Your Name"
                }
                return false
            }
        },
    }
</script>

<style scoped>

</style>