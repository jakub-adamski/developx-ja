<template>
    <div class="card">
        <div class="card-header">User Withdraw Component</div>
        <div class="card-body">
            <div class="form-group">
                <label for="amount_to_withdraw_input">Amount to withdraw:</label>
                <input type="number" class="form-control" id="amount_to_withdraw_input" aria-describedby="amount_to_withdraw_help" placeholder="Enter amount.." v-model="amount_to_withdraw">
                <small id="amount_to_withdraw_help" class="form-text text-muted">Available notes: {{ available_notes }}</small>
            </div>
            <button class="btn btn-primary" @click="withdraw()">Withdraw</button>
            <div v-if="results">
                <h3 class="mt-4">Your notes:</h3>
                <p class="text-success" v-for="(notes, index) in results">
                    {{ notes.note_count }} x {{ notes.note }} = {{ notes.total }}
                </p>
            </div>
            <div v-else-if="errors">
                <h3 class="mt-4">Errors:</h3>
                <p class="text-danger">{{ errors }}</p>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: [
            'available_notes',
        ],
        data() {
            return {
                amount_to_withdraw: null,
                results: null,
                errors: null
            }
        },
        methods: {
            withdraw() {
                if(this.amount_to_withdraw){
                    var this2 = this;
                    axios.post('api/user/transaction', {value: this.amount_to_withdraw})
                        .then(function (response) {
                            this2.results = response.data.results;
                            this2.errors = null;
                            this2.amount_to_withdraw = null;
                            this2.$store.dispatch('getTransactionsHistory');
                        })
                        .catch(error => {
                            this2.results = null;
                            if (typeof error.response.data === 'object') {
                                this.errors =  _.flatten(_.toArray(error.response.data.errors)).join();
                            } else {
                                this.errors = ['Something went wrong. Please try again.'];
                            }
                        });
                }else{
                    this.errors = null;
                    this.results = null;
                }
            }
        },
        mounted() {
            //console.log('Component mounted.', this.available_notes)
        }
    }
</script>
