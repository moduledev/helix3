<template>
    <div class="card-body">
        <form role="form" @submit.prevent="submitForm">
            <div class="row">
                <div class="col-sm-4">
                    <!-- text input -->
                    <div class="form-group">
                        <label>Прізвище</label>
                        <input type="text" v-model="form.surname" class="form-control" placeholder="Enter ...">
                    </div>
                </div>
                <div class="col-sm-4">
                    <!-- text input -->
                    <div class="form-group">
                        <label>Ім'я</label>
                        <input type="text" v-model="form.name" class="form-control" placeholder="Enter ...">
                    </div>
                </div>
                <div class="col-sm-4">
                    <!-- text input -->
                    <div class="form-group">
                        <label>По батькові</label>
                        <input type="text" v-model="form.patronymic" class="form-control" placeholder="Enter ...">
                    </div>
                </div>
                <div class="col-sm-4">
                    <!-- text input -->
                    <div class="form-group">
                        <label>Дата народження</label>
                        <input type="text" v-model="form.dob" class="form-control" placeholder="Enter ...">
                    </div>
                </div>
                <div class="col-sm-4">
                    <!-- text input -->
                    <div class="form-group">
                        <label>Телефон</label>
                        <input type="text" v-model="form.phone" class="form-control" placeholder="Enter ...">
                    </div>
                </div>
                <div class="col-sm-4">
                    <!-- text input -->
                    <div class="form-group">
                        <label>ІНН</label>
                        <input type="text" v-model="form.ipn" class="form-control" placeholder="Enter ...">
                    </div>
                </div>
                <div class="col-sm-4">
                    <!-- text input -->
                    <div class="form-group">
                        <label>Номер авто</label>
                        <input type="text" v-model="form.car_number" class="form-control" placeholder="Enter ...">
                    </div>
                </div>
                <div class="col-sm-4">
                    <!-- text input -->
                    <div class="form-group">
                        <label>E-mail</label>
                        <input type="text" v-model="form.email" class="form-control" placeholder="Enter ...">
                    </div>
                </div>
                <div class="col-sm-4">
                    <!-- text input -->
                    <div class="form-group">
                        <label>Паспорт</label>
                        <input type="text" v-model="form.passport" class="form-control" placeholder="Enter ...">
                    </div>
                </div>
            </div>
            <div class="col-12">
                <!-- select -->
                <div class="form-group">
                    <label>Доступні БД</label>
                    <select v-model="selectedDb" class="form-control">
                        <option value="">Виберіть БД</option>
                        <option v-for="(db, index) in dbList" :key="index">{{db.slug}}</option>
                    </select>
                </div>
            </div>
            <div class="col-6">
                <button class="btn btn-info">Шукати <i class="fa fa-search"></i></button>
            </div>
        </form>
    </div>
</template>

<script>
    import axios from 'axios'

    export default {
        name: "Search",
        data() {
            return {
                form: {
                    name: '',
                    surname: '',
                    patronymic: '',
                    dob: '',
                    phone: '',
                    email: '',
                    ipn: '',
                    car_number: '',
                    passport: ''
                },
                dbList: '',
                selectedDb: ''
            }
        },
        methods: {
            submitForm() {
            }
        },
        mounted() {
            axios.get('/dbs').then((res) => {
               this.dbList = res.data
            } );
        }
    }
</script>

<style scoped>

</style>
