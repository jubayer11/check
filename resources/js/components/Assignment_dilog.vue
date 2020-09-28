<template>
    <div>
        <v-dialog v-model="dialog" persistent max-width="600px">
            <template v-slot:activator="{ on }">
                <v-btn rounded depressed v-on="on" style="float: right;margin-right:5%;color: white;background-color: #3b5998;">Add<v-icon>add</v-icon></v-btn>
            </template>
            <v-card>
                <v-card-title>
                    <span class="headline" style="color: #3b5998;">Create Assignment</span>
                </v-card-title>
                <v-card-text>
                    <v-container>
                        <v-form @submit.prevent="send">
                        <v-text-field v-model="form.title" label="Title*"  required ></v-text-field>
                            <span class="red--text" v-if="errors.title">{{errors.title[0]}}</span>
                        <v-textarea
                            label="Description*"
                            v-model="form.body"
                        ></v-textarea>
                            <span class="red--text" v-if="errors.body">{{errors.body[0]}}</span>
                        <div>
                            <v-dialog
                                ref="dialog"
                                v-model="modal"
                                :return-value.sync="form.deadline"
                                persistent
                                width="290px"
                            >
                                <template v-slot:activator="{ on }">
                                    <v-text-field
                                        v-model="form.deadline"
                                        label="Deadline*"
                                        prepend-icon="event"
                                        readonly
                                        v-on="on"
                                    ></v-text-field>
                                </template>
                                <v-date-picker color="#3b5998" v-model="form.deadline" scrollable>
                                    <v-spacer></v-spacer>
                                    <v-btn text color="primary" @click="modal = false">Cancel</v-btn>
                                    <v-btn text color="primary" @click="$refs.dialog.save(form.deadline)">OK</v-btn>
                                </v-date-picker>
                            </v-dialog>
                        </div>
                            <span class="red--text" v-if="errors.deadline">{{errors.deadline[0]}}</span>
                        <div class="form-group">
                            <h4>Add File:</h4>
                            <input type="file" accept=".doc,.docx,.pptx,.pdf,.jpeg,.png" @change="filechanged"   class="form-control form-control-lg" placeholder="Large form control">
                        </div>
                            <br>
                            <v-progress-linear
                                v-model="uploadPercentage"
                                height="25"
                                reactive
                            >
                                <strong>{{ Math.ceil(uploadPercentage) }}%</strong>
                            </v-progress-linear>
                        </v-form>
                    </v-container>


                    <small>*indicates required field</small>
                    <br>
                    <small>.doc,docx,pptx,pdf,jpeg,png are only allowed for file upload</small>

                </v-card-text>
                <v-card-actions>
                    <div class="flex-grow-1"></div>
                    <v-btn style="background-color:#3b5998;color:white" text @click="dialog = false">Close</v-btn>
                    <v-btn type="submit" style="background-color:#3b5998;color:white"  text @click="send">Create</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
        {{gettingclass_id}}
        {{gettingUserId}}
        {{cheeckingX}}
    </div>
</template>

<script>
    export default {
        props:['data1'],
        data(){
            return {
                dialog: false,
                modal: false,
                form:{
                    check:0,
                    title:null,
                    body:null,
                    file:null,
                    class_id:null,
                    user_id:null,
                    deadline: new Date().toISOString().substr(0, 10),
                },
                errors:{},
                x:0,
                uploadPercentage: 0,

            }
        },
        methods:{
            filechanged(e){
                var fileReader=new FileReader();
                fileReader.readAsDataURL(e.target.files[0]);
                fileReader.onload = (e) => {
                    this.form.file=e.target.result
                }
                this.form.check=1;
            },
            send(){
                axios.post('/lms/api/class/assignment',this.form,
                    {
                        onUploadProgress: e =>
                        {
                            if (e.lengthComputable){
                                this.uploadPercentage=(e.loaded/e.total)*100
                            }
                        }
                    }
                )
                    .then(res =>
                        this.dialog=false,
                        this.$toasted.show('Assignments Created',{type:'success'}),
                        EventBus.$emit('newAssignment',this.form),
                        this.errors='',
                        this.x=0
                    )
                    .catch(error =>this.errors = error.response.data.errors)

            },
        },
        computed:{
            cheeckingX()
            {
                if (this.x==0){
                    this.form={};
                    this.x=1;
                }
            },
            gettingclass_id(){
                this.form.class_id=this.data1;
            },
            gettingUserId(){
              this.form.user_id=User.id();
            },

        }

    }
</script>
