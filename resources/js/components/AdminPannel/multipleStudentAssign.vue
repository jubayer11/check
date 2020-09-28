<template>

    <v-dialog  v-model="dialog" persistent max-width="600px">
        <template v-slot:activator="{ on }">
            <v-btn v-on="on" style="background-color: #3b5998;color: white">All Assign</v-btn>
        </template>
        <v-card>
            <v-card-title>
                <span style="color:#3b5998;" class="headline">Assign Class/Subject</span>
            </v-card-title>
            <v-card-text>
                <v-container>

                    <v-select
                        :items="data"
                        label="Select Class"
                        item-text="name"
                        item-value="id"
                        outlined
                        rounded
                        v-model="subject"
                    >

                    </v-select>
                </v-container>
                <small>*indicates required field</small>
            </v-card-text>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn style="background-color:#3b5998;color:white" text @click="dialog = false">Close</v-btn>
                <v-btn style="background-color:#3b5998;color:white;" text @click="allasaign">Assign</v-btn>
            </v-card-actions>
        </v-card>

    </v-dialog>

</template>
<script>
    export default {
        props:['data','datas'],
        data: () => ({
            dialog:false,
            subject:null,

        }),
        methods:{
            allasaign()
            {
                axios.post('/lms/api/all/students/assign',{
                    subject:this.subject,
                    students:this.datas,
                })
                    .then(res =>this.dialog=false,this.$toasted.show('Selected Students Assigned',{type:'success'}),

                    )
            },
        },

    }
</script>
