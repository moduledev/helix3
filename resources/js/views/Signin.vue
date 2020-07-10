<template>
    <div>
        <form @submit.prevent="submit">
            <div>
                <label for="phone">Phone</label>
                <input type="text" name="phone" id="phone" v-model="form.phone">
            </div>
            <div>
                <label for="password">Password</label>
                <input type="password" name="password" id="password" v-model="form.password">
            </div>
            <div>
                <button type="submit">Sign in</button>
            </div>
        </form>
    </div>
</template>

<script>
    import { mapActions } from 'vuex'

    export default {
        name: "Signin",
        data() {
            return {
                form: {
                    phone: '',
                    password: ''
                }
            }
        },
        methods: {
            ...mapActions({
                signIn: 'auth/signIn'
            }),
            submit() {
                //promice was given from signIn action
                this.signIn(this.form).then(()=> {
                    this.$router.replace({
                        name: 'dashboard'
                    })
                })
            }
        }
    }
</script>

<style scoped>

</style>
