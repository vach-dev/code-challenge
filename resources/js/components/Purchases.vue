<template>
    <div>
        <div class="container-fluid py-5">
            <div class="row">
                <div class="col-2">
                    <button class="btn btn-primary" @click="$router.push({path: '/'})">Go to Offerings</button>
                </div>
                <div class="col-10">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">Purchase Id</th>
                            <th scope="col">Offering</th>
                            <th class="text-center" scope="col">Quantity</th>
                            <th class="text-center" scope="col">Unit Price</th>
                            <th class="text-center" scope="col">Total</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="item in items">
                            <td>{{item.id}}</td>
                            <th scope="row">{{item.offering ? item.offering.title : ''}}</th>
                            <td class="text-center">{{item.quantity}}</td>
                            <td class="text-center">${{item.offering ? item.offering.price : ''}}</td>
                            <td class="text-center">${{item.offering ? item.offering.price * item.quantity : ''}}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        name: "Purchases",
        data() {
            return {
                items: [],
            }
        },
        mounted() {
            this.init();
        },
        methods: {
            init() {
                axios.get('http://task.loc/api/purchases').then(response => {
                    this.items = response.data;
                })
            },
        }
    }
</script>

<style scoped>

</style>