<template>
    <v-container
        class="grey lighten-4"
        width="100%"
        flat
        style="padding: 1%;padding-bottom:115%"
    >
        <div>
            <v-row>
                <v-col class="d-flex" md="9">

                    <div style="display: inline-flex">
                        <v-select
                            outlined
                            :items="exams"
                            item-text="type"
                            item-value="type"
                            label="Select Exam type"
                            v-model="date.selected"
                        ></v-select>
                    </div>
                </v-col>
                <div v-if="checkShow && showingStartExam && showStartExam ||showExam">
                <v-col  class="d-flex" md="3">
                    <div class="text--right">
                        <v-btn
                            rounded
                            depressed
                            style="background-color:#3b5998;color: white"
                            @click="exam_done_Change"
                        >
                            Start Exam
                        </v-btn>
                    </div>
                </v-col>
                </div>
                <div style="margin-top: 5%" v-else>
                    <div v-if="checkShow==false && showingStartExam && showStartExam ||showExam">
                        <div class="font-weight-bold text-right" style="color: #3b5998;" v-if="distance > 0"><h2>{{`${days}d ${hours}h ${minutes}m ${seconds}s`}}</h2></div>
                        <div class="font-weight-bold text-right" v-else style="color: darkred"><h2>OVER</h2></div>
                    </div>
                </div>
            </v-row>

            <div v-if="show==true">
                <div>
                    <div v-for="(questions_s,index) in start_exam" v-if="show==true">
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
                                        :label="'Question no '+(index+1)+'(a)'"
                                        readonly
                                        outlined
                                        rounded
                                        v-model="creative_s.question_1"

                                    ></v-textarea>
                                    <v-text-fieldv
                                        :label="'Marks for '+(index+1)+'(a)'"
                                        readonly
                                        filled
                                        rounded
                                        type="number"
                                        v-model="creative_s.q1_marks"
                                    ></v-text-fieldv>
                                    <v-textarea
                                        :label="'Answer for '+(index+1)+'(a)'"
                                        filled
                                        rounded
                                        type="text"
                                        v-model="creativenesss[index].answer1"
                                        @click="checkingQuestionId(index,creative_s.id,creative_s.question_id)"
                                    ></v-textarea>
                                </div>


                                <div>

                                    <v-textarea
                                        :label="'Question no '+(index+1)+'(b)'"
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
                                    <v-textarea
                                        :label="'Answer for '+(index+1)+'(b)'"
                                        filled
                                        rounded
                                        type="text"
                                        v-model="creativenesss[index].answer2"
                                        @click="checkingQuestionId(index,creative_s.id,creative_s.question_id)"
                                    ></v-textarea>
                                </div>

                                <div>

                                    <v-textarea
                                        :label="'Question no '+(index+1)+'(c)'"
                                        readonly
                                        outlined
                                        rounded
                                        v-model="creative_s.question_3"
                                    ></v-textarea>
                                    <v-text-field
                                        :label="'Marks for '+(index+1)+'(c)'"
                                        readonly
                                        filled
                                        rounded
                                        type="number"
                                        v-model="creative_s.q3_marks"
                                    ></v-text-field>
                                    <v-textarea
                                        :label="'Answer for '+(index+1)+'(c)'"
                                        filled
                                        rounded
                                        type="text"
                                        v-model="creativenesss[index].answer3"
                                        @click="checkingQuestionId(index,creative_s.id,creative_s.question_id)"
                                    ></v-textarea>
                                </div>

                                <div>

                                    <v-textarea
                                        :label="'Question no '+(index+1)+'(d)'"
                                        readonly
                                        outlined
                                        rounded
                                        v-model="creative_s.question_4"
                                    ></v-textarea>
                                    <v-text-field
                                        :label="'Marks for '+(index+1)+'(d)'"
                                        readonly
                                        filled
                                        rounded
                                        type="number"
                                        v-model="creative_s.q4_marks"
                                    ></v-text-field>
                                    <v-textarea
                                        :label="'Answer for '+(index+1)+'(d)'"
                                        filled
                                        rounded
                                        type="text"
                                        v-model="creativenesss[index].answer4"
                                        @click="checkingQuestionId(index,creative_s.id,creative_s.question_id)"
                                    ></v-textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div v-for="(questions_s,index) in start_exam" v-if="show==true">
                    <div v-for="(question_s_s,index) in questions_s.question_s">
                        <div v-for="(multiple_s,index) in question_s_s.multiple_s_s" v-if="question_s_s.type=='Multiple'">
                            <div style="display: inline-flex;margin:5%">
                                <h4 style="color:#3b5998"> Multiple Question No:{{index+1}}</h4>

                            </div>
                            <v-textarea
                                readonly
                                outlined
                                label="Question"
                                rounded
                                v-model="multiple_s.question_s"
                            ></v-textarea>
                            <v-text-field
                                readonly
                                filled
                                label="Marks"
                                rounded
                                v-model="multiple_s.marks"
                            ></v-text-field>
                            <div>
                                <v-select
                                    :items=[multiple_s.option_1,multiple_s.option_2,multiple_s.option_3,multiple_s.option_4]
                                    label="Choose your Answer"
                                    v-model="multiplesss[index].answer"
                                    @change="checkingQuestionIdmultipule(index,multiple_s.id,multiple_s.question_id)"
                                    outlined
                                ></v-select>
                            </div>

                        </div>
                    </div>
                </div>
                <div v-for="(questions_s,index) in start_exam" v-if="show==true">
                    <div v-for="(question_s_s,index) in questions_s.question_s">
                        <div v-for="(short_s,index) in question_s_s.short_s_s" v-if="question_s_s.type=='Short'">
                            <div style="display: inline-flex;margin:5%">
                                <h4 style="color:#3b5998"> Short Question No:{{index+1}}</h4>

                            </div>
                            <v-textarea
                                readonly
                                filled
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
                            <v-textarea
                                filled
                                label="Write Your Answer"
                                rounded
                                v-model="shortsss[index].answer"
                                @change="checkingQuestionIdshort(index,short_s.id,short_s.question_id)"
                            ></v-textarea>

                        </div>
                    </div>
                </div>
                <div v-for="(questions_s,index) in start_exam" v-if="show==true">
                    <div v-for="(question_s_s,index) in questions_s.question_s">
                        <div v-for="(poll_s,index) in question_s_s.poll_s_s" v-if="question_s_s.type=='Pool'">


                            <div style="display: inline-flex;margin:5%">
                                <h4 style="color:#3b5998"> Pool Question No:{{index+1}}</h4>

                            </div>
                            <v-textarea
                                readonly
                                filled
                                label="Question"
                                rounded
                                v-model="poll_s.question_s"
                            ></v-textarea>
                            <v-select
                                :items=[poll_s.option_1,poll_s.option_2,poll_s.option_3,poll_s.option_4]
                                label="Choose your Answer"
                                v-model="pollsss[index].answer"
                                @change="checkingQuestionIdpoll(index,poll_s.id,poll_s.question_id)"
                                outlined
                            ></v-select>

                        </div>
                    </div>
                </div>

                <v-btn rounded @click="submitAnswer"  style="color: white;background-color: #3b5998">
                    Submit Answer
                </v-btn>
            </div>


            <div v-if="show==false">
                <div>
                    <div v-for="(questions_s,index) in dailyexam" v-if="show==false">
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
                                        <h4 style="color:#3b5998"> Answer For Creative Question No:{{index+1}}</h4>

                                    </div>
                                    <div v-for="A_creative_s in creative_s.Acreatives" v-if="A_creative_s.user_id==user_id">
                                        <v-textarea
                                            :label="'Answer (a)'"
                                            readonly
                                            outlined
                                            rounded
                                            v-model="A_creative_s.aquestion_1"
                                        ></v-textarea>

                                        <div>

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

                                        <div>

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

                                        <div>

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
                                        <div>

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
                <div v-for="(questions_s,index) in dailyexam" v-if="show==false">
                    <div v-for="(question_s_s,index) in questions_s.question_s">
                        <div v-for="(multiple_s,index) in question_s_s.multiple_s_s" v-if="question_s_s.type=='Multiple'">
                            <div style="display: inline-flex;margin:5%">
                                <h4 style="color:#3b5998"> Multiple Question No:{{index+1}}</h4>

                            </div>
                            <v-textarea
                                readonly
                                outlined
                                label="Question"
                                rounded
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
                                    <h4 style="color:#3b5998">Answer for Multiple Question No:{{index+1}}</h4>

                                </div>
                                <div v-for="(A_multiple_s) in multiple_s.Amultiple" v-if="A_multiple_s.user_id==user_id">

                                    <v-text-field
                                        :label="'Answer:'"
                                        readonly
                                        outlined
                                        rounded
                                        v-model="A_multiple_s.answer"
                                    ></v-text-field>
                                    <div>

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

                <div v-for="(questions_s,index) in dailyexam" v-if="show==false">
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
                                <div v-for="(A_short) in short_s.Ashort" v-if="A_short.user_id==user_id">
                                    <v-textarea
                                        outlined
                                        label="Answer"
                                        rounded
                                        v-model="A_short.answer"
                                        readonly
                                    ></v-textarea>
                                    <div>
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
                <div v-for="(questions_s,index) in dailyexam" v-if="show==false">
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
                                <div v-for="(A_poll_s,index) in poll_s.Apoll" v-if="A_poll_s.user_id==user_id">

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
            </div>

        </div>
        <div v-for="(exam_start,index) in start_exam">

            {{gettingExamDate(exam_start.end_date_s,exam_start.end_time_s,exam_start.id)}}
            <div v-for="exam_done_statuses in exam_start.exam_done_Status" v-if="exam_done_statuses.pivot.user_id==user_id">

                {{checkingPivot(exam_done_statuses.pivot.exam_done)}}
            </div>

        </div>
        {{checkingUser}}
        {{userId}}
        {{puttingExam}}
        {{filteredExams}}
        {{startexam}}
        {{filteredQuestionc}}
        {{filteredQuestionm}}
        {{filteredQuestionp}}
        {{filteredQuestions}}
        {{checingcountdown}}
       {{checkingUser_startExam}}
        {{submitAnswer_distance}}

    </v-container>
</template>
<script>


    import User from "../Helpers/User";

    export default {
        props: ['data', 'exam1'],

        data: () => ({
            dailyexam: {},
            date: {
                selected: null,
            },
            show: false,
            exams: {},
            start_exam: {},
            start_exam_status: 1,
            filteringc:{},
            filteringm:{},
            filterings:{},
            filteringp:{},
            question_id:{
                qcreative_id:null,
                qmultiple_id:null,
                qshort_id:null,
                qpoll_id:null,
                user_id:null,
            },
            dates:null,
            times:null,
            some:"",
            countDownDate:null,
            days: 0,
            hours: 0,
            minutes: 0,
            seconds: 0,
            distance: 0,
            showingStartExam:false,
            checkShow:true,
            student_start_exam:{},
            user_id:null,
            exam_done_done:5,
            showStartExam:false,
            showExam:false,
            startExam_id:null,
            checking_distance:true,





            creativenesss: [{question_id:0,answer1:null,answer2:null,answer3:null,answer4:null},{question_id:0,answer1:null,answer2:null,answer3:null,answer4:null},{question_id:0,answer1:null,answer2:null,answer3:null,answer4:null},{question_id:0,answer1:null,answer2:null,answer3:null,answer4:null},{question_id:0,answer1:null,answer2:null,answer3:null,answer4:null},{question_id:0,answer1:null,answer2:null,answer3:null,answer4:null},{question_id:0,answer1:null,answer2:null,answer3:null,answer4:null},{question_id:0,answer1:null,answer2:null,answer3:null,answer4:null},{question_id:0,answer1:null,answer2:null,answer3:null,answer4:null},{question_id:0,answer1:null,answer2:null,answer3:null,answer4:null},{question_id:0,answer1:null,answer2:null,answer3:null,answer4:null},{question_id:0,answer1:null,answer2:null,answer3:null,answer4:null},{question_id:0,answer1:null,answer2:null,answer3:null,answer4:null},{question_id:0,answer1:null,answer2:null,answer3:null,answer4:null},{question_id:0,answer1:null,answer2:null,answer3:null,answer4:null},{question_id:0,answer1:null,answer2:null,answer3:null,answer4:null},{question_id:0,answer1:null,answer2:null,answer3:null,answer4:null},{question_id:0,answer1:null,answer2:null,answer3:null,answer4:null},{question_id:0,answer1:null,answer2:null,answer3:null,answer4:null},{question_id:0,answer1:null,answer2:null,answer3:null,answer4:null},{question_id:0,answer1:null,answer2:null,answer3:null,answer4:null},{question_id:0,answer1:null,answer2:null,answer3:null,answer4:null},{question_id:0,answer1:null,answer2:null,answer3:null,answer4:null},{question_id:0,answer1:null,answer2:null,answer3:null,answer4:null},{question_id:0,answer1:null,answer2:null,answer3:null,answer4:null},{question_id:0,answer1:null,answer2:null,answer3:null,answer4:null},{question_id:0,answer1:null,answer2:null,answer3:null,answer4:null},{question_id:0,answer1:null,answer2:null,answer3:null,answer4:null},{question_id:0,answer1:null,answer2:null,answer3:null,answer4:null},{question_id:0,answer1:null,answer2:null,answer3:null,answer4:null},{question_id:0,answer1:null,answer2:null,answer3:null,answer4:null},{question_id:0,answer1:null,answer2:null,answer3:null,answer4:null},{question_id:0,answer1:null,answer2:null,answer3:null,answer4:null},{question_id:0,answer1:null,answer2:null,answer3:null,answer4:null},{question_id:0,answer1:null,answer2:null,answer3:null,answer4:null},{question_id:0,answer1:null,answer2:null,answer3:null,answer4:null},{question_id:0,answer1:null,answer2:null,answer3:null,answer4:null},{question_id:0,answer1:null,answer2:null,answer3:null,answer4:null},{question_id:0,answer1:null,answer2:null,answer3:null,answer4:null},{question_id:0,answer1:null,answer2:null,answer3:null,answer4:null},{question_id:0,answer1:null,answer2:null,answer3:null,answer4:null},{question_id:0,answer1:null,answer2:null,answer3:null,answer4:null},{question_id:0,answer1:null,answer2:null,answer3:null,answer4:null},{question_id:0,answer1:null,answer2:null,answer3:null,answer4:null},{question_id:0,answer1:null,answer2:null,answer3:null,answer4:null},{question_id:0,answer1:null,answer2:null,answer3:null,answer4:null},{question_id:0,answer1:null,answer2:null,answer3:null,answer4:null},{question_id:0,answer1:null,answer2:null,answer3:null,answer4:null},{question_id:0,answer1:null,answer2:null,answer3:null,answer4:null},{question_id:0,answer1:null,answer2:null,answer3:null,answer4:null},{question_id:0,answer1:null,answer2:null,answer3:null,answer4:null},{question_id:0,answer1:null,answer2:null,answer3:null,answer4:null},{question_id:0,answer1:null,answer2:null,answer3:null,answer4:null},{question_id:0,answer1:null,answer2:null,answer3:null,answer4:null},{question_id:0,answer1:null,answer2:null,answer3:null,answer4:null},{question_id:0,answer1:null,answer2:null,answer3:null,answer4:null},{question_id:0,answer1:null,answer2:null,answer3:null,answer4:null},{question_id:0,answer1:null,answer2:null,answer3:null,answer4:null},{question_id:0,answer1:null,answer2:null,answer3:null,answer4:null},{question_id:0,answer1:null,answer2:null,answer3:null,answer4:null},{question_id:0,answer1:null,answer2:null,answer3:null,answer4:null},{question_id:0,answer1:null,answer2:null,answer3:null,answer4:null},{question_id:0,answer1:null,answer2:null,answer3:null,answer4:null},{question_id:0,answer1:null,answer2:null,answer3:null,answer4:null},{question_id:0,answer1:null,answer2:null,answer3:null,answer4:null},{question_id:0,answer1:null,answer2:null,answer3:null,answer4:null},{question_id:0,answer1:null,answer2:null,answer3:null,answer4:null},{question_id:0,answer1:null,answer2:null,answer3:null,answer4:null},{question_id:0,answer1:null,answer2:null,answer3:null,answer4:null},{question_id:0,answer1:null,answer2:null,answer3:null,answer4:null},{question_id:0,answer1:null,answer2:null,answer3:null,answer4:null},{question_id:0,answer1:null,answer2:null,answer3:null,answer4:null},{question_id:0,answer1:null,answer2:null,answer3:null,answer4:null},{question_id:0,answer1:null,answer2:null,answer3:null,answer4:null},{question_id:0,answer1:null,answer2:null,answer3:null,answer4:null},{question_id:0,answer1:null,answer2:null,answer3:null,answer4:null},{question_id:0,answer1:null,answer2:null,answer3:null,answer4:null},{question_id:0,answer1:null,answer2:null,answer3:null,answer4:null},{question_id:0,answer1:null,answer2:null,answer3:null,answer4:null},{question_id:0,answer1:null,answer2:null,answer3:null,answer4:null},{question_id:0,answer1:null,answer2:null,answer3:null,answer4:null},{question_id:0,answer1:null,answer2:null,answer3:null,answer4:null},{question_id:0,answer1:null,answer2:null,answer3:null,answer4:null},{question_id:0,answer1:null,answer2:null,answer3:null,answer4:null},{question_id:0,answer1:null,answer2:null,answer3:null,answer4:null},{question_id:0,answer1:null,answer2:null,answer3:null,answer4:null},{question_id:0,answer1:null,answer2:null,answer3:null,answer4:null},{question_id:0,answer1:null,answer2:null,answer3:null,answer4:null},{question_id:0,answer1:null,answer2:null,answer3:null,answer4:null},{question_id:0,answer1:null,answer2:null,answer3:null,answer4:null},{question_id:0,answer1:null,answer2:null,answer3:null,answer4:null},{question_id:0,answer1:null,answer2:null,answer3:null,answer4:null},{question_id:0,answer1:null,answer2:null,answer3:null,answer4:null},{question_id:0,answer1:null,answer2:null,answer3:null,answer4:null},{question_id:0,answer1:null,answer2:null,answer3:null,answer4:null},{question_id:0,answer1:null,answer2:null,answer3:null,answer4:null},{question_id:0,answer1:null,answer2:null,answer3:null,answer4:null},{question_id:0,answer1:null,answer2:null,answer3:null,answer4:null},{question_id:0,answer1:null,answer2:null,answer3:null,answer4:null},{question_id:0,answer1:null,answer2:null,answer3:null,answer4:null},{question_id:0,answer1:null,answer2:null,answer3:null,answer4:null},{question_id:0,answer1:null,answer2:null,answer3:null,answer4:null},{question_id:0,answer1:null,answer2:null,answer3:null,answer4:null},{question_id:0,answer1:null,answer2:null,answer3:null,answer4:null},{question_id:0,answer1:null,answer2:null,answer3:null,answer4:null},{question_id:0,answer1:null,answer2:null,answer3:null,answer4:null},{question_id:0,answer1:null,answer2:null,answer3:null,answer4:null},{question_id:0,answer1:null,answer2:null,answer3:null,answer4:null},{question_id:0,answer1:null,answer2:null,answer3:null,answer4:null},{question_id:0,answer1:null,answer2:null,answer3:null,answer4:null},{question_id:0,answer1:null,answer2:null,answer3:null,answer4:null},{question_id:0,answer1:null,answer2:null,answer3:null,answer4:null},{question_id:0,answer1:null,answer2:null,answer3:null,answer4:null},{question_id:0,answer1:null,answer2:null,answer3:null,answer4:null},{question_id:0,answer1:null,answer2:null,answer3:null,answer4:null},{question_id:0,answer1:null,answer2:null,answer3:null,answer4:null},{question_id:0,answer1:null,answer2:null,answer3:null,answer4:null},{question_id:0,answer1:null,answer2:null,answer3:null,answer4:null},{question_id:0,answer1:null,answer2:null,answer3:null,answer4:null},{question_id:0,answer1:null,answer2:null,answer3:null,answer4:null},{question_id:0,answer1:null,answer2:null,answer3:null,answer4:null},{question_id:0,answer1:null,answer2:null,answer3:null,answer4:null},{question_id:0,answer1:null,answer2:null,answer3:null,answer4:null},{question_id:0,answer1:null,answer2:null,answer3:null,answer4:null},{question_id:0,answer1:null,answer2:null,answer3:null,answer4:null},{question_id:0,answer1:null,answer2:null,answer3:null,answer4:null},{question_id:0,answer1:null,answer2:null,answer3:null,answer4:null},{question_id:0,answer1:null,answer2:null,answer3:null,answer4:null},{question_id:0,answer1:null,answer2:null,answer3:null,answer4:null},{question_id:0,answer1:null,answer2:null,answer3:null,answer4:null},{question_id:0,answer1:null,answer2:null,answer3:null,answer4:null},{question_id:0,answer1:null,answer2:null,answer3:null,answer4:null},{question_id:0,answer1:null,answer2:null,answer3:null,answer4:null},{question_id:0,answer1:null,answer2:null,answer3:null,answer4:null},{question_id:0,answer1:null,answer2:null,answer3:null,answer4:null},{question_id:0,answer1:null,answer2:null,answer3:null,answer4:null},{question_id:0,answer1:null,answer2:null,answer3:null,answer4:null},],
            multiplesss: [{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,}],
            shortsss: [{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,}],
            pollsss: [{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,},{question_id:0,}],
        }),
        mounted(){

            var vm = this
            var x = setInterval(function() {
                var now = new Date().getTime();
                vm.distance = vm.countDownDate - now;
                vm.days = Math.floor(vm.distance / (1000 * 60 * 60 * 24));
                vm.hours = Math.floor((vm.distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                vm.minutes = Math.floor((vm.distance % (1000 * 60 * 60)) / (1000 * 60));
                vm.seconds = Math.floor((vm.distance % (1000 * 60)) / 1000);

            }, 1000);
        },



        methods: {
            exam_done_Change(){
                axios.post(`/lms/api/class/exam/exam_done/${this.startExam_id}`,{
                   user_id:this.user_id,
                    check:this.exam_done_done,


                })
                    .then(res =>this.dialog=false,this.$toasted.show('Exam Started',{type:'success'}),
                        this.show=true,
                        this.checkShow=false,

                    )
            },
            gettingExamDate(data,data1,id){
                this.dates=data;
                this.times=data1;
                this.startExam_id=id;
            },

            checkingPivot(data){
              this.exam_done_done=data;
            },
            updating_Examuser(){
                axios.patch(`/lms/api/class/exam/updating_Examuser/${this.startExam_id}`,{
                    user_id:this.user_id,
                    check:this.exam_done_done,
                })

            },

            submitAnswer(){
                this.updating_Examuser();
                axios.post(`/lms/api/class/exam/answer/${this.data}`,{
                    form:this.question_id,
                    Acreatives:this.filteringc,
                    Amultiples:this.filteringm,
                    Apools:this.filteringp,
                    Ashorts: this.filterings,

                })
                    .then(res =>this.dialog=false,this.$toasted.show('Exam Done',{type:'success'}),
                      window.location.reload(true)

                    )
            },
            checkingQuestionId(index,id,question_id){
                this.creativenesss[index].question_id=id;
                this.question_id.qcreative_id=question_id;
            },
            checkingQuestionIdmultipule(index,id,question_id){
                this.multiplesss[index].question_id=id;
                this.question_id.qmultiple_id=question_id;
            },
            checkingQuestionIdshort(index,id,question_id){
                this.shortsss[index].question_id=id;
                this.question_id.qshort_id=question_id;
            },
            checkingQuestionIdpoll(index,id,question_id){
                this.pollsss[index].question_id=id;
                this.question_id.qpoll_id=question_id;
            },





        },
        computed: {
            submitAnswer_distance(){
                if (this.distance<0 && this.checking_distance==true){
                    this.checking_distance=false;
                    this.updating_Examuser();
                    axios.post(`/lms/api/class/exam/answer/${this.data}`,{
                        form:this.question_id,
                        Acreatives:this.filteringc,
                        Amultiples:this.filteringm,
                        Apools:this.filteringp,
                        Ashorts: this.filterings,
                        user_id:this.user_id,
                        check:this.exam_done_done,
                        start_exam_id:this.startExam_id,

                    })
                        .then(res =>this.$toasted.show('Exam Done',{type:'success'}),
                            window.location.reload(true)



                        )

                }
            },
            checkingUser_startExam(){
                if (this.exam_done_done== 5 || this.exam_done_done== 0){
                    this.showStartExam=true;
                }
                else
                {
                    this.showStartExam=false;
                }

            },

            checkingUser(){
                this.user_id=User.id();
            },


            checingcountdown(){
                this.some=this.dates+" "+this.times;
                this.countDownDate=new Date(this.some).getTime();
            },
            userId(){
                this.question_id.user_id=User.id();
            },
            filteredExams: function () {
                this.dailyexam = this.exams.filter((exam) => {
                    return exam.type.match(this.date.selected);
                });
            },
            filteredQuestionc: function () {
                this.filteringc = this.creativenesss.filter((el) => {
                    return (el.question_id !=0)
                });
            },
            filteredQuestionm: function () {
                this.filteringm = this.multiplesss.filter((el) => {
                    return (el.question_id !=0)
                });
            },
            filteredQuestionp: function () {
                this.filteringp = this.pollsss.filter((el) => {
                    return (el.question_id !=0)
                });
            },
            filteredQuestions: function () {
                this.filterings = this.shortsss.filter((el) => {
                    return (el.question_id !=0)
                });
            },

            puttingExam() {
                this.exams = this.exam1;
            },
            startexam: function () {
                this.start_exam=this.exams.filter((el) => {
                    if (el.status_s == this.start_exam_status && el.exam_done == 0){
                        this.showingStartExam=true;
                    }
                    return (el.status_s == this.start_exam_status && el.exam_done == 0)
                });


            },




        },
    }

</script>
