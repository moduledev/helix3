<template>
    <div class="mt-4">
        <h3>Знайдено {{results.length}} співпадінь</h3>
        <div class="card"
             v-for="(result, index) in results"
             :key="index"
             v-if="results.length > 0">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-user-ninja"></i> Картка пошуку:</h3>
                <div class="card-tools">
                    <!-- Collapse Button -->
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                        class="fas fa-minus bg_red"></i></button>
                </div>
                <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body">
               <div class="row d-flex">
                   <div class="col-6">
                       <ul>
                           <li v-for="(col,key, index) in result" :key="index"
                               :class="{'filledCols': findKey(key) }">
                               {{ localize[key] ? localize[key] : key }} - {{ col }}
                           </li>
                       </ul>
                   </div>
                   <div class="col-4">
                       <img :src="'/storage/moryak/' + result.fase_id " alt="">
                   </div>
               </div>

                <div class="col-12">
                    <button class="btn btn-info">
                        Перевірити за всіма доступними БД <i class="fas fa-sync-alt"></i>
                    </button>
                </div>
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
