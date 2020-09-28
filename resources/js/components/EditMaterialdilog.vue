<template>
    <div>
        <v-dialog v-model="dialog" persistent max-width="600px">
            <template v-slot:activator="{ on }">
                <v-btn   width="70" v-on="on" class="primary" depressed  >Edit</v-btn>
            </template>
            <v-card>
                <v-card-title>
                    <span class="headline">Edit Material</span>
                </v-card-title>
                <v-card-text>
                    <v-container>

                        <v-select
                            :items="items"
                            label="Select Material"
                            v-model="material.option"
                        ></v-select>



                        <v-text-field label="Enter title*"  v-model="material.title" required ></v-text-field>

                        <v-text-field label="Enter Lecture No*" type="number"  v-model="material.lecture" required ></v-text-field>

                        <v-textarea
                            label="Description"
                            v-model="material.body"
                        ></v-textarea>
                        <div class="form-group">
                            <h4>Add File:</h4>
                            <input type="file" accept=".doc,.docx,.pptx,.pdf,.jpeg,.png,.wav,.mp3,.avi,.flv,.mkv,.mp4,.mpg" @change="filechanged"   class="form-control form-control-lg" placeholder="Large form control">
                        </div>


                    </v-container>

                </v-card-text>
                <v-card-actions>
                    <div class="flex-grow-1"></div>
                    <v-btn style="background-color:#3b5998;color:white" text @click="dialog = false" >Close</v-btn>
                    <v-btn style="background-color:#3b5998;color:white"  text  @click="update" >Save</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
        {{edit}}
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
            material:{},
            checking:0,


        }),
        computed:{
            edit(){
                this.material=this.data;
            }
        },
        methods:{
            filechanged(e){
                var fileReader=new FileReader();
                fileReader.readAsDataURL(e.target.files[0]);
                fileReader.onload = (e) => {
                    this.material.file=e.target.result
                }
                this.checking=1;
            },

            update(){
                axios.put(`/lms/api/material/${this.material.lmsclass_id}`,{material:this.material,check:this.checking})
                    .then(res => this.dialog = false,this.$toasted.show('Material Edited',{type:'success'}))

            },

        },


    }
</script>
