<template>
    <v-dialog
        v-model="dialog"
        max-width="350"
    >
        <template v-slot:activator="{ on }">
            <v-btn v-on="on" color="error"  depressed >Delete</v-btn>
        </template>
        <v-card>
            <v-card-title style="font-size:1em;color:darkred" >Are you sure you want to delete?</v-card-title>

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
                    @click="DeleteAssignment"
                >
                    Delete
                </v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>

</template>
<script>
    export default {
        props:['data'],
        data () {
            return {
                dialog: false,
            }
        },
        methods:{
            DeleteAssignment(){
                axios.delete(`/lms/api/class/assignment/${this.data.id}`)
                    .then(res =>this.dialog=false,this.$toasted.show('Assignment Deleted',{type:'success'}),
                        EventBus.$emit('ass-remove',this.data)
                    )

            },
        }
    }
</script>
