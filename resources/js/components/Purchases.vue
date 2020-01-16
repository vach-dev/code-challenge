<template>
    <div>
        <div class="container">
            <div>
                <button class="btn btn-success" @click="$router.push({path: '/'})">Go to Offerings</button>
            </div>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">offeringID</th>
                    <th scope="col">Customer Name</th>
                    <th class="text-center" scope="col">Quantity</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="item in items">
                    <td>{{item.offeringID}}</td>
                    <th scope="row">{{item.customerName}}</th>
                    <td class="text-center">{{item.quantity}}</td>
                </tr>
                </tbody>
            </table>
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