<template>
    <div class="mt-4">
        <div class="card" v-for="(result, index) in results" :key="index">
            <div class="card-header">
                <h3 class="card-title"> <i class="fas fa-user-ninja"></i> Результат пошуку:</h3>
                <div class="card-tools">
                    <!-- Collapse Button -->
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus bg_red"></i></button>
                </div>
                <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <ul>
                    <li v-for="(col,key, index) in result" :key="index">{{key}} - {{col}}</li>
                </ul>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</template>

<script>
    export default {
        name: "SingleCard",
        props:['results'],
        data() {

        }
    }
</script>

<style scoped>
.bg_red {
    color: #32a1b8;
}
</style>
