

<template>
    <v-container class="grey lighten-4" style="padding-bottom:25%;margin-top: 0.5%;height: 100%">
        <v-row class="d-flex">
            <v-col md="6">
        <head_dialog></head_dialog>
            </v-col>
            <v-col md="6">
                <div align="right">
                    <v-text-field
                        class="my-input"
                        style="width: 70%;"
                        placeholder="Search By Name"
                        outlined
                        rounded
                        append-icon
                        v-model="search"
                    >
                        <v-tooltip slot="append" bottom>
                            <v-icon slot="activator" color="primary" dark>search</v-icon>
                            <span>Tooltip</span>
                        </v-tooltip>
                    </v-text-field>

                </div>
            </v-col>
        </v-row>
            <v-simple-table
                fixed-header
                width="100%"
                height="100%"
                class="grey lighten-4"
                flat

            >

                <template v-slot:default>
                    <thead>
                    <tr>
                        <th style=" font-size: 1.2rem "  class="text-left">Name</th>
                        <th style=" font-size: 1.2rem "  class="text-center">Status</th>
                        <th style=" font-size: 1.2rem "  colspan="2" class="text-center">Action</th>
                    </tr>
                    </thead>
                    <tbody v-if="dataH.length">
                    <tr v-for=" Head in filtered" v-if="Head.name !='No Class'">
                        <td class="text-capitalize" style="font-size: 1rem">{{Head.name}}</td>
                        <td class="text-center">
                            <v-btn width="80" small v-if="Head.status==1" depressed class="info">Active</v-btn>
                            <v-btn small v-else width="80"  depressed style="color:white;background-color:#ff531a">In-Active</v-btn>

                        </td>

                        <td class="text-center">
                            <Edit_dialog :data="Head"></Edit_dialog>
                            <Delete_dialog :data="Head"></Delete_dialog>
                        </td>
                    </tr>
                    </tbody>
                </template>
            </v-simple-table>

    </v-container>

</template>
<script>
    import details_dilog from "./details_dilog.vue";
    import head_dialog from "./class_head_dialog.vue"
    import Edit_dialog from "./Edit_class_head.vue";
    import Delete_dialog from "./Delete_class_head.vue";

    export default {
        props:['dataH'],
        components:{details_dilog,head_dialog,Edit_dialog,Delete_dialog},
        data () {
            return {
                deleteId:null,
                search:'',
            }
        },
        created()
        {
          this.Createhead();
          this.Deletehead();
        },
        methods:
            {
                Createhead(){
                    EventBus.$on('class-head-created',(ann) =>{
                        this.dataH.unshift(ann)
                    })
                },
                Deletehead(){
                    EventBus.$on('class-head-deleted',(annd) =>{
                        this.dataH.splice(this.dataH.indexOf(annd), 1);
                    })
                },
            },
        computed:{
            filtered: function(){
                return this.dataH.filter((el) => {
                    return (el.name.toLowerCase().match(this.search)) ||(el.name.toUpperCase().match(this.search));
                });
            },
        }



    }
</script>
<style>

</style>


