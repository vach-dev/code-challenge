<template>
    <div>
        <div class="container">
            <div>{{ responseMsg }}</div>
            <div>
                <button class="btn btn-success" @click="$router.push({path: '/purchases'})">Go to Purchases</button>
            </div>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Title</th>
                    <th scope="col">Price</th>
                    <th class="text-center" scope="col">Quantity</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="item in items">
                    <th scope="row">{{item.title}}</th>
                    <td>${{item.price}}</td>
                    <td class="text-center">
                        <select v-model.number="quantity">
                            <option v-for="i in 10">{{i}}</option>
                        </select>
                    </td>
                    <td class="text-right">
                        <button class="btn btn-success" @click="makePurchase(item)">Make Purchase</button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';
    export default {
        name: "Offerings",
        data() {
            return {
                items: [],
                quantity: 1,
                responseMsg: '',
            }
        },
        mounted() {
            this.init();
        },
        methods: {
            init() {
                axios.get('http://task.loc/api/offerings').then(response => {
                           this.items = response.data;
                        })
            },
            makePurchase(item) {
                item.quantity = this.quantity;
                axios.post('http://task.loc/api/purchases', item).then(response => {
                    this.responseMsg = response.data.message
                })
            }
        }
    }
</script>

<style scoped>

</style>