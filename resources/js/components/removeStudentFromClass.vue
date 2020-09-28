<template>
    <v-dialog
        v-model="dialog"
        max-width="350"
    >
        <template v-slot:activator="{ on }">
            <v-btn v-on="on" small color="error my-3" width="70"  depressed >Remove</v-btn>
        </template>
        <v-card>
            <v-card-title style="font-size:1em;color:darkred" >Are you sure you want to Remove?</v-card-title>

            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn
                    small
                    style="background-color:#3b5998;color:white"
                    text
                    @click="dialog = false"
                >
                    Cancel
                </v-btn>

                <v-btn
                    small
                    style="background-color:#3b5998;color:white"
                    text
                    @click="deleteClassHead"
                >
                    Delete
                </v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>

</template>
<script>
    export default {
        props:['data','data1'],
        data () {
            return {
                dialog: false,
            }
        },
        methods:{
            deleteClassHead(){
                axios.post(`/lms/api/unassaign_student/${this.data.id}/${this.data1}`)
                    .then(res =>this.dialog=false,this.$toasted.show('User Deleted',{type:'success'}),
                        EventBus.$emit('user-remove',this.data)
                    )
            }
        }
    }
</script>
