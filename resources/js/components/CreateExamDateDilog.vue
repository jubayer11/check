<template>
    <v-dialog
        ref="dialog"
        v-model="modal"
        :return-value.sync="date"
        persistent
        width="290px"
    >
        <template v-slot:activator="{ on }">
            <v-text-field
                v-model="date"
                label="Picker in dialog"
                prepend-icon="event"
                readonly
                v-on="on"
            ></v-text-field>
        </template>
        <v-date-picker color="#3b5998" v-model="date" scrollable>
            <div class="flex-grow-1"></div>
            <v-btn text style="background-color: #3b5998;color: white" @click="modal = false">Cancel</v-btn>
            <v-btn text style="background-color: #3b5998;color: white" @click="save(date)">OK</v-btn>
        </v-date-picker>
    </v-dialog>
</template>
<script>
    export default {
        data() {
            return {

                date: new Date().toISOString().substr(0, 10),

            }
        },
        methods:{
            save(date){
                this.$refs.dialog.save(date)
                EventBus.$emit('exam_date',this.date)
            },
        }

    }
</script>
