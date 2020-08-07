<template>
    <div class="mt-4">
        <div class="card"
             v-for="(result, index) in results"
             :key="index"
             v-if="results.length > 0">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-user-ninja"></i> Результат пошуку:</h3>
                <div class="card-tools">
                    <!-- Collapse Button -->
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                        class="fas fa-minus bg_red"></i></button>
                </div>
                <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <ul>
                    <li v-for="(col,key, index) in result" :key="index"
                        :class="{'filledCols': findKey(key) }">
                        {{ localize[key] ? localize[key] : key }} - {{ col }}
                    </li>
                </ul>

            </div>
            <!-- /.card-body -->
        </div>
        <div  v-if="results.length === 0" class="text-center">
            <strong>Відсутні співпадіння</strong>
        </div>
    </div>
</template>

<script>
export default {
    name: "SingleCard",
    props: ['results', 'filledCols'],
    data() {
        return {
            localize: {
                name: "Ім'я",
                surname: 'Прізвище',
                dob: 'Дата народження',
                patronymic: 'По батькові',
                car_number: 'Номер авто',
                login: 'Логін',
                position: 'Посада',
                marital_status: 'Сімейний статус',
                living: 'Умови проживання',
                occupation: 'Зайнятість',
                occupation_position: 'Статус зайнятості',
                gender: 'Стать',
                children: 'Діти',
                doc_series: 'Паспотр',
                phone: 'Телефон',
                company: 'Місце роботи',
                address: 'Адреса',
                ipn: 'ІНН',
                car_model:'Модель авто',
                develop_year:'Рік виробництва',
                car_color:'Колір авто',
                car_weight:'Вага авто',
                car_body:'Тип кузова'
            }
        }
    },
    methods: {
        findKey(key) {
               for (let item in this.filledCols){
                   if(this.filledCols[item].hasOwnProperty(key)){
                        return true
                   }
               }
        }
    }
}
</script>

<style scoped>
.bg_red {
    color: #32a1b8;
}

.filledCols {
    color: red;
}
</style>
