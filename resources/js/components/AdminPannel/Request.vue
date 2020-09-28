<template>
    <v-container class="grey lighten-4" style="padding-bottom:25%;margin-top: 0.5%;height: 100%">
        <div align="right">
            <v-text-field
                class="my-input"
                style="width: 30%;"
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
                <th width="1" class="ma-0 pa-0"></th>
                <th style=" font-size: 1.2rem " class="text-left font-weight-black">Name</th>
                <th  style=" font-size: 1.2rem " class="text-left font-weight-black">Profile</th>
                <th colspan="2" style=" font-size: 1.2rem;" class="text-center font-weight-black">Action</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(user,index) in filteredBlogs">
                <td>{{index+1}}</td>
                <td class="text-capitalize">
                    {{user.first_name}} {{user.last_name}}
                </td>
                <td >
                    <Request_details_dialog :data="user" style="float: left"></Request_details_dialog>
                </td>

                <td class="text-center ">
                    <Accept_user :user="user"></Accept_user>
                    <Delete_Request :data="user"></Delete_Request>
                </td>
            </tr>
            </tbody>
        </template>
    </v-simple-table>
    </v-container>

</template>
<script>
    import Request_details_dialog from "./Request_details_dialog.vue";
    import Delete_Request from "./Delete_Request.vue";
    import Accept_user from "./Accept_user.vue";

    export default {
        props:['data'],
        components:{Request_details_dialog,Delete_Request,Accept_user},
        data () {
            return {
                search:'',
                show:false,

            }
        },
        created(){
            this.not_Accepting_user();
            this.accepted();
        },
        methods:
            {

                not_Accepting_user()
                {
                    EventBus.$on('user-deleted',(userDelete) =>{
                        this.data.splice(this.data.indexOf(userDelete), 1);
                    })
                },
                accepted(){
                    EventBus.$on('newUser',(user) =>{
                        this.data.splice(this.data.indexOf(user), 1);
                    })
                },
            },
        computed:
            {
                filteredBlogs: function(){
                    return this.data.filter((el) => {
                        return (el.first_name.toLowerCase().match(this.search)) ||(el.first_name.toUpperCase().match(this.search));
                    });
                },
            },
    }
</script>
<style>

</style>

