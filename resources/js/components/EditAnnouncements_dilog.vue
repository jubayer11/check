<template>
    <div>
        <v-dialog v-model="dialog" persistent max-width="600px">
            <template v-slot:activator="{ on }">
                <v-btn width="80" v-on="on" color="primary" depressed>Edit</v-btn>
            </template>
            <v-card>
                <v-card-title>
                    <h3 class="headline" style="color:#3b5998;">Edit Announcement</h3>
                </v-card-title>

                <v-card-text>
                    <v-container>
                        <v-form @submit.prevent="update">
                        <v-text-field label="Title:*" v-model="announcement.title"  required ></v-text-field>
                            <span class="red--text" v-if="errors.title">{{errors.title[0]}}</span>
                        <v-textarea
                            label="Description"
                            v-model="announcement.body"
                        ></v-textarea>
                            <span class="red--text" v-if="errors.body">{{errors.body[0]}}</span>
                        </v-form>
                    </v-container>
                    <small>*indicates required field</small>

                </v-card-text>
                <v-card-actions>
                    <div class="flex-grow-1"></div>
                    <v-btn style="background-color:#3b5998;color:white"  text @click="dialog = false">Close</v-btn>
                    <v-btn style="background-color:#3b5998;color:white" text @click="update">Save</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
        {{getting}}
    </div>
</template>

<script>
    export default {
        props:['data'],
        data: () => ({
            dialog: false,
            announcement:{},
            errors:{},

        }),
        computed:{
            getting(){
                this.announcement=this.data;
            }
        },
        methods:{
            update(){
                axios.patch(`/lms/api/announcement/${this.announcement.id}`,this.announcement)
                    .then(res=>this.dialog=false,
                        this.$toasted.show('Announcement Updated',{type:'success'}),
                        this.errors='',
                    )
                    .catch(error =>this.errors = error.response.data.errors)
            }
        }
    }
</script>
