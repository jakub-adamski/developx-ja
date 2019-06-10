<template>
    <div class="card">
        <div class="card-header">User Transactions History Component</div>
        <div class="card-body">
            <ul v-if="user_transactions_history.length" class="list-group">
                <li v-for="(user_transaction, index) in user_transactions_history" class="list-group-item">Outcome {{user_transaction.value}} - ({{user_transaction.created_at}})</li>
            </ul>
            <p v-else class="text-secondary mb-0">No transactions recorded..</p>
        </div>
    </div>
</template>

<script>
    import { mapState } from 'vuex';

    export default {
        computed: mapState({
            user_transactions_history: function(state){
                return state.user_transactions_history;
            }
        }),
        mounted() {
            this.$store.dispatch('getTransactionsHistory');
        }
    }
</script>
