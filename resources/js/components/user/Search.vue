<template>
    <div class="card-body">
        <form role="form" @submit.prevent="submitForm">
            <div class="row">
                <div class="col-sm-4">
                    <!-- text input -->
                    <div class="form-group">
                        <label>Прізвище</label>
                        <input type="text" v-model="form.surname.value" class="form-control"
                               :disabled="form.surname.disable" placeholder="Enter ...">
                    </div>
                </div>
                <div class="col-sm-4">
                    <!-- text input -->
                    <div class="form-group">
                        <label>Ім'я</label>
                        <input type="text" v-model="form.name.value" class="form-control"
                               :disabled="form.name.disable"
                               placeholder="Enter ...">
                    </div>
                </div>
                <div class="col-sm-4">
                    <!-- text input -->
                    <div class="form-group">
                        <label>По батькові</label>
                        <input type="text" v-model="form.patronymic.value" class="form-control"
                               :disabled="form.patronymic.disable" placeholder="Enter ...">
                    </div>
                </div>
                <div class="col-sm-4">
                    <!-- text input -->
                    <div class="form-group">
                        <label>Дата народження</label>
                        <input type="text" v-model="form.dob.value" class="form-control"
                               :disabled="form.dob.disable"
                               placeholder="Enter ...">
                    </div>
                </div>
                <div class="col-sm-4">
                    <!-- text input -->
                    <div class="form-group">
                        <label>Телефон</label>
                        <input type="text" v-model="form.phone.value" class="form-control"
                               :disabled="form.phone.disable" placeholder="Enter ...">
                    </div>
                </div>
                <div class="col-sm-4">
                    <!-- text input -->
                    <div class="form-group">
                        <label>ІНН</label>
                        <input type="text" v-model="form.ipn.value" class="form-control"
                               :disabled="form.ipn.disable"
                               placeholder="Enter ...">
                    </div>
                </div>
                <div class="col-sm-4">
                    <!-- text input -->
                    <div class="form-group">
                        <label>Номер авто</label>
                        <input type="text" v-model="form.car_number.value" class="form-control"
                               :disabled="form.car_number.disable" placeholder="Enter ...">
                    </div>
                </div>
                <div class="col-sm-4">
                    <!-- text input -->
                    <div class="form-group">
                        <label>E-mail</label>
                        <input type="text" v-model="form.email.value" class="form-control"
                               :disabled="form.email.disable" placeholder="Enter ...">
                    </div>
                </div>
                <div class="col-sm-4">
                    <!-- text input -->
                    <div class="form-group">
                        <label>Паспорт</label>
                        <input type="text" v-model="form.doc_series.value" class="form-control"
                               :disabled="form.doc_series.disable" placeholder="Enter ...">
                    </div>
                </div>
            </div>
            <div class="col-12">
                <!-- select -->
                <div class="form-group">
                    <label>Доступні БД</label>
                    <select v-model="selectedDb" class="form-control">
                        <option value="">Виберіть БД</option>
                        <option value="search_all">Шукати серед усіх </option>
                        <option v-for="(db, index) in dbList"
                                :value="db.name"
                                :key="index">
                            {{db.slug}}
                        </option>
                    </select>
                </div>
            </div>
            <div class="col-6">
                <button class="btn btn-info">Шукати <i class="fa fa-search"></i></button>
            </div>
        </form>

        <single-card :results="results" :filledCols="filledCols"></single-card>
    </div>
</template>

<script>
    import axios from 'axios'
    import SingleCard from "./SingleCard";

    export default {
        name: "Search",
        data() {
            return {
                form: {
                    name: {
                        value: '',
                        disable: false
                    },
                    surname: {
                        value: '',
                        disable: false
                    },
                    patronymic: {
                        value: '',
                        disable: false
                    },
                    dob: {
                        value: '',
                        disable: false
                    },
                    phone: {
                        value: '',
                        disable: false
                    },
                    email: {
                        value: '',
                        disable: false
                    },
                    ipn: {
                        value: '',
                        disable: false
                    },
                    car_number: {
                        value: '',
                        disable: false
                    },
                    doc_series: {
                        value: '',
                        disable: false
                    }
                },
                dbList: '',
                selectedDb: '',
                results:[],
                filledCols:[]
            }
        },
        methods: {
            submitForm() {
                axios.post('/search', {
                    db: this.selectedDb,
                    columns: JSON.stringify(this.getFilledInputs())
                }).then((res)=>{
                    console.log(res)
                    this.results = res.data
                })
            },
            getFilledInputs(){
                let filledInputs = [];
                for (let item in this.form) {
                    if (this.form[item].value && !this.form[item].disable) {
                        let elem = {};
                        elem[item] = this.form[item].value
                        filledInputs.push(elem)
                    }
                }
                this.filledCols = filledInputs
                return filledInputs
            }
        },
        mounted() {
            axios.get('/dbs').then((res) => {
                this.dbList = res.data
            });
        },
        watch: {
            selectedDb: function (val) {
                if (val) {
                    axios.post('/getColumns', {nameDb: val}).then((res) => {
                        for (let item in this.form) {
                            if (res.data.includes(item)) {
                                this.form[item].disable = false
                            } else {
                                this.form[item].disable = true
                            }
                        }
                    })
                } else {
                    for (let item in this.form) {
                        this.form[item].disable = false
                    }
                }
            }
        },
        components: {
            'single-card': SingleCard
        }
    }
</script>

<style scoped>

</style>
