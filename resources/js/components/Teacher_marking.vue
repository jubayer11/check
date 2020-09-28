<template>
    <v-container
        class="grey lighten-4"
        width="100%"
        flat
        style="padding: 1%;padding-bottom:115%"
    >
        <v-card   class="grey lighten-4" flat>
        <v-row align="center">
        <v-col class="d-flex" cols="12" sm="6">
            <v-select
                :items="all_exams"
                item-text="type"
                item-value="type"
                label="Select Exam type"
                v-model="exam_select"
                outlined
            ></v-select>
        </v-col>
            <v-col class="d-flex" cols="12" sm="6">
                <v-select
                    :items="selected_exam_user"
                    item-text="first_name"
                    item-value="id"
                    label="Student Who Participate in selected exam"
                    v-model="user_select"
                    @change="show=true"
                    outlined
                ></v-select>
            </v-col>
        </v-row>
        </v-card>
        <div v-if="show==true">
            <div>
                <div v-for="(questions_s,index) in filteringSelectedExam" v-if="show==true">
                    <div v-for="(question_s_s,index) in questions_s.question_s">
                        <div v-for="(creative_s,index) in question_s_s.creative_s_s" v-if="question_s_s.type=='Creative'">



                            <div style="display: inline-flex;margin:5%">
                                <h4 style="color:#3b5998"> Creative Question No:{{index+1}}</h4>

                            </div>
                            <v-textarea
                                readonly
                                filled
                                label="Story"
                                rounded
                                v-model="creative_s.story"
                            ></v-textarea>

                            <div>

                                <v-textarea
                                    :label="'question no '+(index+1)+'(a)'"
                                    readonly
                                    outlined
                                    rounded
                                    v-model="creative_s.question_1"

                                ></v-textarea>
                                <v-text-field
                                    :label="'marks for '+(index+1)+'(a)'"
                                    readonly
                                    filled
                                    rounded
                                    type="number"
                                    v-model="creative_s.q1_marks"
                                ></v-text-field>
                            </div>
                            <div>

                                <v-textarea
                                    :label="'question no '+(index+1)+'(b)'"
                                    readonly
                                    outlined
                                    rounded
                                    v-model="creative_s.question_2"
                                ></v-textarea>
                                <v-text-field
                                    :label="'Marks for '+(index+1)+'(b)'"
                                    readonly
                                    filled
                                    rounded
                                    type="number"
                                    v-model="creative_s.q2_marks"
                                ></v-text-field>
                            </div>

                            <div>

                                <v-textarea
                                    :label="'question no '+(index+1)+'(c)'"
                                    readonly
                                    outlined
                                    rounded
                                    v-model="creative_s.question_3"
                                ></v-textarea>
                                <v-text-field
                                    :label="'marks for '+(index+1)+'(c)'"
                                    readonly
                                    filled
                                    rounded
                                    type="number"
                                    v-model="creative_s.q3_marks"
                                ></v-text-field>
                            </div>

                            <div>

                                <v-textarea
                                    :label="'question no '+(index+1)+'(d)'"
                                    readonly
                                    outlined
                                    rounded
                                    v-model="creative_s.question_4"
                                ></v-textarea>
                                <v-text-field
                                    :label="'marks for '+(index+1)+'(d)'"
                                    readonly
                                    filled
                                    rounded
                                    type="number"
                                    v-model="creative_s.q4_marks"
                                ></v-text-field>
                            </div>
                            <div>
                            <div style="display: inline-flex;margin:5%">
                                <h4 style="color:#3b5998"> Answer For Question No:{{index+1}}</h4>

                            </div>
                            <div v-for="A_creative_s in creative_s.Acreatives" v-if="A_creative_s.user_id==user_select">
                                <v-textarea
                                    :label="'Answer (a)'"
                                    readonly
                                    outlined
                                    rounded
                                    v-model="A_creative_s.aquestion_1"
                                ></v-textarea>

                                <div v-if="A_creative_s.aq1_marks==null">

                                    <v-text-field
                                        :label="'marks (a) '"
                                        filled
                                        rounded
                                        type="number"
                                        v-model="Acreativenesss[index].marks1"
                                        @click="checkingAnswerId(index,A_creative_s.id,A_creative_s.question_id)"
                                    ></v-text-field>
                                </div>

                                <div v-else>

                                    <v-text-field
                                        :label="'marks (a) '"
                                        readonly
                                        filled
                                        rounded
                                        type="number"
                                        v-model="A_creative_s.aq1_marks"
                                    ></v-text-field>
                                </div>
                                <v-textarea
                                    :label="'Answer (b)'"
                                    readonly
                                    outlined
                                    rounded
                                    v-model="A_creative_s.aquestion_2"
                                ></v-textarea>
                                <div v-if="A_creative_s.aq2_marks==null">

                                    <v-text-field
                                        :label="'marks (b)'"
                                        filled
                                        rounded
                                        type="number"
                                        v-model="Acreativenesss[index].marks2"
                                        @click="checkingAnswerId(index,A_creative_s.id,A_creative_s.question_id)"
                                    ></v-text-field>
                                </div>
                                <div v-else>

                                    <v-text-field
                                        :label="'marks (b)'"
                                        readonly
                                        filled
                                        rounded
                                        type="number"
                                        v-model="A_creative_s.aq2_marks"
                                    ></v-text-field>
                                </div>

                                <v-textarea
                                    :label="'Answer (c)'"
                                    readonly
                                    outlined
                                    rounded
                                    v-model="A_creative_s.aquestion_3"
                                ></v-textarea>
                                <div v-if="A_creative_s.aq3_marks == null">

                                    <v-text-field
                                        :label="'marks (c)'"
                                        filled
                                        rounded
                                        type="number"
                                        v-model="Acreativenesss[index].marks3"
                                        @click="checkingAnswerId(index,A_creative_s.id,A_creative_s.question_id)"
                                    ></v-text-field>
                                </div>
                                <div v-else>

                                    <v-text-field
                                        :label="'marks (c)'"
                                        readonly
                                        filled
                                        rounded
                                        type="number"
                                        v-model="A_creative_s.aq3_marks"
                                    ></v-text-field>
                                </div>
                                <v-textarea
                                    :label="'Answer (d)'"
                                    readonly
                                    outlined
                                    rounded
                                    v-model="A_creative_s.aquestion_4"
                                ></v-textarea>
                                <div v-if="A_creative_s.aq4_marks==null">

                                    <v-text-field
                                        :label="'marks (d)'"
                                        filled
                                        rounded
                                        type="number"
                                        v-model="Acreativenesss[index].marks4"
                                        @click="checkingAnswerId(index,A_creative_s.id,A_creative_s.question_id)"
                                    ></v-text-field>
                                </div>
                                <div v-else>

                                    <v-text-field
                                        :label="'marks (d)'"
                                        readonly
                                        filled
                                        rounded
                                        type="number"
                                        v-model="A_creative_s.aq4_marks"
                                    ></v-text-field>
                                </div>



                            </div>
                            </div>



                        </div>
                    </div>
                </div>

            </div>
            <div v-for="(questions_s,index) in filteringSelectedExam" v-if="show==true">
                <div v-for="(question_s_s,index) in questions_s.question_s">
                    <div v-for="(multiple_s,index) in question_s_s.multiple_s_s" v-if="question_s_s.type=='Multiple'">
                        <div style="display: inline-flex;margin:5%">
                            <h4 style="color:#3b5998"> Multiple Question No:{{index+1}}</h4>

                        </div>
                        <v-textarea
                            readonly
                            label="Question"
                            rounded
                            outlined
                            v-model="multiple_s.question_s"
                        ></v-textarea>
                            <v-select
                                :items=[multiple_s.option_1,multiple_s.option_2,multiple_s.option_3,multiple_s.option_4]
                                label="Option"
                                outlined
                            ></v-select>

                        <v-text-field
                            readonly
                            filled
                            label="Marks"
                            rounded
                            v-model="multiple_s.marks"
                        ></v-text-field>
                        <div>
                            <div style="display: inline-flex;margin:5%">
                                <h4 style="color:#3b5998"> Multiple Question Answer  No:{{index+1}}</h4>

                            </div>
                            <div v-for="(A_multiple_s) in multiple_s.Amultiple" v-if="A_multiple_s.user_id==user_select">

                                <v-text-field
                                    :label="'Answer:'"
                                    readonly
                                    outlined
                                    rounded
                                    v-model="A_multiple_s.answer"
                                ></v-text-field>
                                <div v-if="A_multiple_s.marks==null">
                                    <v-text-field
                                        :label="'Marks:'"
                                        filled
                                        rounded
                                        type="number"
                                        v-model="Amultiplesss[index].marks"
                                        @change="checkingAnswerIdmultipule(index,A_multiple_s.id,A_multiple_s.question_id)"
                                    ></v-text-field>
                                </div>
                                <div v-else>

                                <v-text-field
                                    :label="'Marks:'"
                                    readonly
                                    filled
                                    rounded
                                    type="number"
                                    v-model="A_multiple_s.marks"
                                ></v-text-field>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div v-for="(questions_s,index) in filteringSelectedExam" v-if="show==true">
                <div v-for="(question_s_s,index) in questions_s.question_s">
                    <div v-for="(short_s,index) in question_s_s.short_s_s" v-if="question_s_s.type=='Short'">
                        <div style="display: inline-flex;margin:5%">
                            <h4 style="color:#3b5998"> Short Question No:{{index+1}}</h4>

                        </div>
                        <v-textarea
                            readonly
                            outlined
                            label="Question"
                            rounded
                            v-model="short_s.question_s"
                        ></v-textarea>
                        <v-text-field
                            readonly
                            filled
                            label="Marks"
                            rounded
                            type="number"
                            v-model="short_s.marks"
                        ></v-text-field>
                        <div>
                            <div style="display: inline-flex;margin:5%">
                                <h4 style="color:#3b5998"> Answer For Short Question No:{{index+1}}</h4>

                            </div>
                            <div v-for="(A_short) in short_s.Ashort" v-if="A_short.user_id==user_select">
                                <v-textarea
                                    outlined
                                    label="Answer"
                                    rounded
                                    v-model="A_short.answer"
                                    readonly
                                ></v-textarea>
                                <div v-if="A_short.marks==null">

                                    <v-text-field
                                        filled
                                        label="Marks"
                                        rounded
                                        type="number"
                                        v-model="Ashortsss[index].marks"
                                        @change="checkingAnswerIdshort(index,A_short.id,A_short.question_id)"
                                    ></v-text-field>
                                </div>
                                <div v-else>
                                    <v-text-field
                                        readonly
                                        filled
                                        label="Marks"
                                        rounded
                                        type="number"
                                        v-model="A_short.marks"
                                    ></v-text-field>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div v-for="(questions_s,index) in filteringSelectedExam" v-if="show==true">
                <div v-for="(question_s_s,index) in questions_s.question_s">
                    <div v-for="(poll_s,index) in question_s_s.poll_s_s" v-if="question_s_s.type=='Pool'">


                        <div style="display: inline-flex;margin:5%">
                            <h4 style="color:#3b5998"> Pool Question No:{{index+1}}</h4>

                        </div>
                        <v-textarea
                            readonly
                            outlined
                            label="Question"
                            rounded
                            v-model="poll_s.question_s"
                        ></v-textarea>
                        <v-select
                            :items=[poll_s.option_1,poll_s.option_2,poll_s.option_3,poll_s.option_4]
                            label="Option"
                            outlined
                        ></v-select>
                        <div>
                            <div style="display: inline-flex;margin:5%">
                                <h4 style="color:#3b5998"> Answer For Pool Question No:{{index+1}}</h4>
                            </div>
                            <div v-for="(A_poll_s,index) in poll_s.Apoll" v-if="A_poll_s.user_id==user_select">

                                <v-text-field
                                    :label="'Answer:'"
                                    readonly
                                    outlined
                                    rounded
                                    v-model="A_poll_s.answer"
                                ></v-text-field>

                            </div>

                        </div>

                    </div>
                </div>
            </div>

            <div v-if="count==true">
                <v-btn rounded @click="submitMarks"  style="color: white;background-color: #3b5998">
                    Post Marks
                </v-btn>
            </div>
        </div>



        <div v-for="all_exam in filteringSelectedExam" >
            {{ gettingUser(all_exam.exam_user)}}
        </div>
        {{getting_all_exam}}
        {{filteredExam}}
        {{filteredQuestion}}
        {{filteredAnswerc}}
        {{filteredAnswerm}}
        {{filteredAnswers}}
        {{checkingCount}}
    </v-container>
</template>
<script>


    export default {
        props:['data1','exam2'],
        data(){
            return{
                count:false,
                show:false,
                all_exams:{},
                exam_select:null,
                selected_exam_user:{},
                user_select:null,
                filteringSelectedExam:null,
                selectedUserId:null,
                index_s:null,
                Afilteringc:{},
                Afilteringm:{},
                Afilterings:{},
                answer_id:{
                    acreative_id:null,
                    amultiple_id:null,
                    ashort_id:null,

                },
                Acreativenesss: [{question_id:0,marks1:null,marks2:null,marks3:null,marks4:null},{question_id:0,marks1:null,marks2:null,marks3:null,marks4:null},{question_id:0,marks1:null,marks2:null,marks3:null,marks4:null},{question_id:0,marks1:null,marks2:null,marks3:null,marks4:null},{question_id:0,marks1:null,marks2:null,marks3:null,marks4:null},{question_id:0,marks1:null,marks2:null,marks3:null,marks4:null},{question_id:0,marks1:null,marks2:null,marks3:null,marks4:null},{question_id:0,marks1:null,marks2:null,marks3:null,marks4:null},{question_id:0,marks1:null,marks2:null,marks3:null,marks4:null},{question_id:0,marks1:null,marks2:null,marks3:null,marks4:null},{question_id:0,marks1:null,marks2:null,marks3:null,marks4:null},{question_id:0,marks1:null,marks2:null,marks3:null,marks4:null},{question_id:0,marks1:null,marks2:null,marks3:null,marks4:null},{question_id:0,marks1:null,marks2:null,marks3:null,marks4:null},{question_id:0,marks1:null,marks2:null,marks3:null,marks4:null},{question_id:0,marks1:null,marks2:null,marks3:null,marks4:null},{question_id:0,marks1:null,marks2:null,marks3:null,marks4:null},{question_id:0,marks1:null,marks2:null,marks3:null,marks4:null},{question_id:0,marks1:null,marks2:null,marks3:null,marks4:null},{question_id:0,marks1:null,marks2:null,marks3:null,marks4:null},{question_id:0,marks1:null,marks2:null,marks3:null,marks4:null},{question_id:0,marks1:null,marks2:null,marks3:null,marks4:null},{question_id:0,marks1:null,marks2:null,marks3:null,marks4:null},{question_id:0,marks1:null,marks2:null,marks3:null,marks4:null},{question_id:0,marks1:null,marks2:null,marks3:null,marks4:null},{question_id:0,marks1:null,marks2:null,marks3:null,marks4:null},{question_id:0,marks1:null,marks2:null,marks3:null,marks4:null},{question_id:0,marks1:null,marks2:null,marks3:null,marks4:null},{question_id:0,marks1:null,marks2:null,marks3:null,marks4:null},{question_id:0,marks1:null,marks2:null,marks3:null,marks4:null},{question_id:0,marks1:null,marks2:null,marks3:null,marks4:null},{question_id:0,marks1:null,marks2:null,marks3:null,marks4:null},{question_id:0,marks1:null,marks2:null,marks3:null,marks4:null},{question_id:0,marks1:null,marks2:null,marks3:null,marks4:null},{question_id:0,marks1:null,marks2:null,marks3:null,marks4:null},{question_id:0,marks1:null,marks2:null,marks3:null,marks4:null},{question_id:0,marks1:null,marks2:null,marks3:null,marks4:null},{question_id:0,marks1:null,marks2:null,marks3:null,marks4:null},{question_id:0,marks1:null,marks2:null,marks3:null,marks4:null},{question_id:0,marks1:null,marks2:null,marks3:null,marks4:null},{question_id:0,marks1:null,marks2:null,marks3:null,marks4:null},{question_id:0,marks1:null,marks2:null,marks3:null,marks4:null},{question_id:0,marks1:null,marks2:null,marks3:null,marks4:null},{question_id:0,marks1:null,marks2:null,marks3:null,marks4:null},{question_id:0,marks1:null,marks2:null,marks3:null,marks4:null},{question_id:0,marks1:null,marks2:null,marks3:null,marks4:null},{question_id:0,marks1:null,marks2:null,marks3:null,marks4:null},{question_id:0,marks1:null,marks2:null,marks3:null,marks4:null},{question_id:0,marks1:null,marks2:null,marks3:null,marks4:null},{question_id:0,marks1:null,marks2:null,marks3:null,marks4:null},{question_id:0,marks1:null,marks2:null,marks3:null,marks4:null},{question_id:0,marks1:null,marks2:null,marks3:null,marks4:null},{question_id:0,marks1:null,marks2:null,marks3:null,marks4:null},{question_id:0,marks1:null,marks2:null,marks3:null,marks4:null},{question_id:0,marks1:null,marks2:null,marks3:null,marks4:null},{question_id:0,marks1:null,marks2:null,marks3:null,marks4:null},{question_id:0,marks1:null,marks2:null,marks3:null,marks4:null},{question_id:0,marks1:null,marks2:null,marks3:null,marks4:null},{question_id:0,marks1:null,marks2:null,marks3:null,marks4:null},{question_id:0,marks1:null,marks2:null,marks3:null,marks4:null},{question_id:0,marks1:null,marks2:null,marks3:null,marks4:null},{question_id:0,marks1:null,marks2:null,marks3:null,marks4:null},{question_id:0,marks1:null,marks2:null,marks3:null,marks4:null},{question_id:0,marks1:null,marks2:null,marks3:null,marks4:null},{question_id:0,marks1:null,marks2:null,marks3:null,marks4:null},{question_id:0,marks1:null,marks2:null,marks3:null,marks4:null},{question_id:0,marks1:null,marks2:null,marks3:null,marks4:null},{question_id:0,marks1:null,marks2:null,marks3:null,marks4:null},{question_id:0,marks1:null,marks2:null,marks3:null,marks4:null},{question_id:0,marks1:null,marks2:null,marks3:null,marks4:null},{question_id:0,marks1:null,marks2:null,marks3:null,marks4:null},{question_id:0,marks1:null,marks2:null,marks3:null,marks4:null},{question_id:0,marks1:null,marks2:null,marks3:null,marks4:null},{question_id:0,marks1:null,marks2:null,marks3:null,marks4:null},{question_id:0,marks1:null,marks2:null,marks3:null,marks4:null},{question_id:0,marks1:null,marks2:null,marks3:null,marks4:null},{question_id:0,marks1:null,marks2:null,marks3:null,marks4:null},{question_id:0,marks1:null,marks2:null,marks3:null,marks4:null},{question_id:0,marks1:null,marks2:null,marks3:null,marks4:null},{question_id:0,marks1:null,marks2:null,marks3:null,marks4:null},{question_id:0,marks1:null,marks2:null,marks3:null,marks4:null},{question_id:0,marks1:null,marks2:null,marks3:null,marks4:null},{question_id:0,marks1:null,marks2:null,marks3:null,marks4:null},],
                Amultiplesss: [{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,}],
                Ashortsss: [{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,}],

            }
        },
        computed:{
            checkingCount(){
                if (this.Afilteringc != '' || this.Afilteringm != '' || this.Afilterings != ''){
                    this.count=true;
                }


            },
            getting_all_exam(){
              this.all_exams=this.exam2;
            },

            filteredExam: function () {
                this.filteringSelectedExam = this.all_exams.filter((el) => {
                    return (el.type == this.exam_select)
                });
            },
            filteredQuestion: function () {
                this.filteringSelectedExam = this.all_exams.filter((el) => {
                    return (el.type == this.exam_select)
                });
            },
            filteredAnswerc: function () {
                this.Afilteringc = this.Acreativenesss.filter((el) => {
                    return (el.question_id !=0)
                });
            },
            filteredAnswerm: function () {
                this.Afilteringm = this.Amultiplesss.filter((el) => {
                    return (el.question_id !=0)
                });
            },

            filteredAnswers: function () {
                this.Afilterings = this.Ashortsss.filter((el) => {
                    return (el.question_id !=0)
                });
            },






        },
        methods:{
            submitMarks(){
                axios.patch(`/lms/api/class/exam/marks/${this.data1}`,{
                    form:this.answer_id,
                    Mcreatives:this.Afilteringc,
                    Mmultiples:this.Afilteringm,
                    Mshorts: this.Afilterings,

                })
                    .then(res =>this.dialog=false,this.$toasted.show('Marks Posted',{type:'success'}),
                        // window.location.reload(true)
                    )

            },
            checkingAnswerId(index,id,question_id){
                this.Acreativenesss[index].question_id=id;
                this.answer_id.acreative_id=question_id;
            },
            checkingAnswerIdmultipule(index,id,question_id){
                this.Amultiplesss[index].question_id=id;
                this.answer_id.amultiple_id=question_id;
            },
            checkingAnswerIdshort(index,id,question_id){
                this.Ashortsss[index].question_id=id;
                this.answer_id.ashort_id=question_id;
            },
            gettingUser(datas){
                this.selected_exam_user=datas;
            },
            gettinguserId(data){
                this.selectedUserId=data;
            }

        }

    }

</script>
