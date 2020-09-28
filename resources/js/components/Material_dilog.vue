<template>
    <div>
        <v-dialog v-model="dialog" persistent max-width="600px">
            <template v-slot:activator="{ on }">
                <v-btn rounded v-on="on"  style="background-color: #3b5998;color:white;">Add Material</v-btn>
            </template>
            <v-card>
                <v-card-title>
                    <span class="headline">Create Class</span>
                </v-card-title>
                <v-card-text>
                    <v-container>

                        <v-select
                            :items="items"
                            label="Select Material*"
                            v-model="material.options"
                        ></v-select>

                        <span class="red--text" v-if="errors.options">{{errors.options[0]}}</span>
                        <v-text-field label="Enter title*"  v-model="material.title" required ></v-text-field>
                        <span class="red--text" v-if="errors.title">{{errors.title[0]}}</span>
                        <v-text-field label="Enter Lecture No*" type="number"  v-model="material.lecture" required ></v-text-field>
                        <span class="red--text" v-if="errors.lecture">{{errors.lecture[0]}}</span>
                        <v-textarea
                            label="Description"
                            v-model="material.body"
                        ></v-textarea>
                        <div class="form-group">
                            <h4>Add File:</h4>
                            <input  accept=".doc,.docx,.pptx,.pdf,.jpeg,.png,.wav,.mp3,.avi,.flv,.mkv,.mp4,.mpg,.wmv" type="file"  @change="filechanged"   class="form-control form-control-lg" placeholder="Large form control">
                        </div>
                        <br>
                        <v-progress-linear
                                v-model="uploadPercentage"
                                height="25"
                                reactive
                        >
                            <strong>{{ Math.ceil(uploadPercentage) }}%</strong>
                        </v-progress-linear>
                    </v-container>
                    <small>*indicates required field</small>
                </v-card-text>
                <v-card-actions>
                    <div class="flex-grow-1"></div>
                    <v-btn style="background-color:#3b5998;color:white" text @click="dialog = false">Close</v-btn>
                    <v-btn style="background-color:#3b5998;color:white"  text  @click="send">Save</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
        {{user}}
        {{cheeckingX}}
    </div>
</template>

<script>
    export default {
        props:['data'],
        data: () => ({
            dialog: false,
            modal: false,
            menu2: false,
            items: ['Lesson', 'Document', 'Image', 'Audio','Video','Youtube','link'],
            material:{
                title:null,
                body:null,
                file:null,
                options:null,
                user_id:null,
                lmsclass_id:null,
                check:0,
                lecture:null,


            },
            uploadPercentage: 0,

            x:0,
            errors:{},
        }),
        methods:{
            filechanged(e){
                var fileReader=new FileReader();
                fileReader.readAsDataURL(e.target.files[0]);
                fileReader.onload = (e) => {
                    this.material.file=e.target.result
                }
                this.material.check=1;
            },
            send(){
                this.$Progress.start()
                axios.post('/lms/api/material',this.material,
                    {
                        onUploadProgress: e =>
                        {
                            if (e.lengthComputable){
                                this.uploadPercentage=(e.loaded/e.total)*100
                            }
                        }
                    })
                  .then(res =>
                      this.dialog=false,
                      EventBus.$emit('newMaterial',this.material),
                      this.$toasted.show('Material Created',{type:'success'}),
                      this.errors='',
                      this.x=0,
                  )
                  .catch(error =>this.errors = error.response.data.errors)


            },
        },
        computed:{
            cheeckingX()
            {
                if (this.x==0){
                    this.material={};
                    this.x=1;
                    this.uploadPercentage=0;
                }
            },
            user(){
                this.material.user_id=User.id();
                this.material.lmsclass_id=this.data;
            }
        }
    }
</script>
