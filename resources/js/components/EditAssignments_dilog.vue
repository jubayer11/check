<template>
    <div>
        <v-dialog v-model="dialog" persistent max-width="600px">
            <template v-slot:activator="{ on }">
                <v-btn v-on="on" color="primary" depressed>Edit</v-btn>
            </template>
            <v-card>
                <v-card-title>
                    <span class="headline" style="color:#3b5998;">Edit Assignment</span>
                </v-card-title>
                <v-card-text>
                    <v-container>
                        <v-form @submit.prevent="update">
                        <v-text-field v-model="assignment.title" label="Title:*"  required ></v-text-field>
                        <span class="red--text" v-if="errors.title">{{errors.title[0]}}</span>
                        <v-textarea
                            label="Description"
                            v-model="assignment.body"
                        ></v-textarea>
                        <span class="red--text" v-if="errors.body">{{errors.body[0]}}</span>
                        <div>
                            <v-dialog
                                ref="dialog"
                                v-model="modal"
                                :return-value.sync="assignment.deadline"
                                persistent
                                width="290px"
                            >
                                <template v-slot:activator="{ on }">
                                    <v-text-field
                                        v-model="assignment.deadline"
                                        label="Deadline"
                                        prepend-icon="event"
                                        readonly
                                        v-on="on"
                                    ></v-text-field>
                                </template>
                                <v-date-picker color="#3b5998" v-model="assignment.deadline" scrollable>
                                    <v-spacer></v-spacer>
                                    <v-btn text color="primary" @click="modal = false">Cancel</v-btn>
                                    <v-btn text color="primary" @click="$refs.dialog.save(assignment.deadline)">OK</v-btn>
                                </v-date-picker>
                            </v-dialog>
                        </div>
                        <span class="red--text" v-if="errors.deadline">{{errors.deadline[0]}}</span>
                        <div class="form-group">
                            <h4>Add File:</h4>
                            <input type="file" @change="filechanged" accept=".doc,.docx,.pptx,.pdf,.jpeg,.png"  class="form-control form-control-lg" placeholder="Large form control">
                        </div>

                        </v-form>

                    </v-container>
                    <small>*indicates required field</small>
                    <br>
                    <small>.doc,docx,pptx,pdf,jpeg,png are only allowed for file upload</small>
                </v-card-text>
                <v-card-actions>
                    <div class="flex-grow-1"></div>
                    <v-btn style="background-color:#3b5998;color:white" text @click="dialog = false">Close</v-btn>
                    <v-btn style="background-color:#3b5998;color:white"  text @click="update">Update</v-btn>
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
            assignment:{
                check:0,
            },
            errors:{},

        }),
        computed:{
            getting(){
                this.assignment=this.data;
            }
        },
        methods:{
            filechanged(e){
                var fileReader=new FileReader();
                fileReader.readAsDataURL(e.target.files[0]);
                fileReader.onload = (e) => {
                    this.assignment.file=e.target.result
                }
                this.assignment.check=1;
            },
            update(){
                axios.patch(`/lms/api/class/assignment/${this.assignment.id}`,this.assignment)
                    .then(res=>this.dialog=false,
                        this.$toasted.show('Assignment Updated',{type:'success'}),
                        this.errors='',
                    )
                    .catch(error =>this.errors = error.response.data.errors)
            },

        }
    }
</script>
