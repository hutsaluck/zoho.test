<template>
    <form @submit.prevent="submitForm">
        <div>
            <label>Deal Name:</label>
            <input v-model="deal_name" type="text" required>
            <span v-if="errors.deal_name" class="error">{{ errors.deal_name[0] }}</span>
        </div>
        <div>
            <label>Stage:</label>
            <input v-model="stage" type="text" required>
            <span v-if="errors.stage" class="error">{{ errors.stage[0] }}</span>
        </div>
        <div>
            <label>Account Name:</label>
            <input v-model="account_name" type="text" required>
            <span v-if="errors.account_name" class="error">{{ errors.account_name[0] }}</span>
        </div>
        <div>
            <label>Website:</label>
            <input v-model="website" type="text" required>
            <span v-if="errors.website" class="error">{{ errors.website[0] }}</span>
        </div>
        <div>
            <label>Phone:</label>
            <input v-model="phone" type="text" required>
            <span v-if="errors.phone" class="error">{{ errors.phone[0] }}</span>
        </div>
        <button type="submit">Create</button>
        <div v-if="successMessage" class="success">{{ successMessage }}</div>
        <div v-if="errorMessage" class="error">{{ errorMessage }}</div>
    </form>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            deal_name: '',
            stage: '',
            account_name: '',
            website: '',
            phone: '',
            errors: {},
            successMessage: '',
            errorMessage: '',
        };
    },
    methods: {
        async submitForm() {
            this.errors = {};
            this.successMessage = '';
            this.errorMessage = '';

            try {
                const response = await axios.post('/create', {
                    deal_name: this.deal_name,
                    stage: this.stage,
                    account_name: this.account_name,
                    website: this.website,
                    phone: this.phone,
                });
                this.successMessage = 'Records created successfully';
            } catch (error) {
                if (error.response && error.response.status === 422) {
                    this.errors = error.response.data.error;
                } else {
                    this.errorMessage = 'Failed to create records';
                }
            }
        },
    },
};
</script>

<style>
.error {
    color: red;
}
.success {
    color: green;
}
</style>
