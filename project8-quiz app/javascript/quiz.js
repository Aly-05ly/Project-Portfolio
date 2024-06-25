// 1. GET ELEMENTS using class  -document.querySelector("");
// starting page
const start_btn = document.querySelector(".start_btn button");
const info_box = document.querySelector(".info_box");
// below
const exit_btn = info_box.querySelector(".buttons .quit");
const continue_btn = info_box.querySelector(".buttons .restart");
// quiz
const quiz_box = document.querySelector(".quiz_box");
const option_list = document.querySelector(".option_list");
const result_box = document.querySelector(".result_box");
// counting
const time_line = document.querySelector("header .time_line");
const timeText = document.querySelector(".timer .time_left_txt");
const timeCount = document.querySelector(".timer .timer_sec");

// 2. CLICK START
start_btn.onclick = ()=>{
    info_box.classList.add("activeInfo"); //show info box (add)
}
// 3. CLICK EXIT
exit_btn.onclick = ()=>{
    info_box.classList.remove("activeInfo"); //hide info box (remove)
}
// 4. CLICK CONTINUE
continue_btn.onclick = ()=>{
    info_box.classList.remove("activeInfo"); 
    quiz_box.classList.add("activeQuiz");
    showQuetions(0); 
    queCounter(1); 
    startTimer(20); 
    startTimerLine(0); 
}

// 5. VARIABLES
let timeValue =  20;
let que_count = 0;
let que_numb = 1;
let userScore = 0;
let counter;
let counterLine;
let widthValue = 0;

// 6. RESTART
const restart_quiz = result_box.querySelector(".buttons .restart");

restart_quiz.onclick = ()=>{
    quiz_box.classList.add("activeQuiz"); 
    result_box.classList.remove("activeResult"); 
    timeValue = 20; 
    que_count = 0;
    que_numb = 1;
    userScore = 0;
    widthValue = 0;
    // function calls
    showQuetions(que_count); 
    queCounter(que_numb); 
    clearInterval(counter); 
    clearInterval(counterLine); 
    startTimer(timeValue); 
    startTimerLine(widthValue);

    //set to time left
    timeText.textContent = "Time Left"; 
    next_btn.classList.remove("show"); 
}

// 7. QUIT
const quit_quiz = result_box.querySelector(".buttons .quit");

quit_quiz.onclick = ()=>{
    //reload window
    window.location.reload(); 
}

// 9. NEXT BUTTON
const next_btn = document.querySelector("footer .next_btn");
const bottom_ques_counter = document.querySelector("footer .total_que");

next_btn.onclick = ()=>{
    if(que_count < questions.length - 1){ 
        //if question count is less than total question
        que_count++; 
        que_numb++; 
        // call functions
        showQuetions(que_count); 
        queCounter(que_numb); 
        clearInterval(counter);
        clearInterval(counterLine); 
        startTimer(timeValue); 
        startTimerLine(widthValue); 
        //set to time left
        timeText.textContent = "Time Left"; 
        next_btn.classList.remove("show");
    }else{
        // if finish
        clearInterval(counter); 
        clearInterval(counterLine); 
        showResult(); 
    }
}

// 8. SHOW QUESTIONS
function showQuetions(index){
    const que_text = document.querySelector(".que_text");
    let que_tag = '<span>'+ questions[index].numb + ". " + questions[index].question +'</span>';
    let option_tag = '<div class="option"><span>'+ questions[index].options[0] +'</span></div>'
    + '<div class="option"><span>'+ questions[index].options[1] +'</span></div>'
    + '<div class="option"><span>'+ questions[index].options[2] +'</span></div>'
    + '<div class="option"><span>'+ questions[index].options[3] +'</span></div>';
    //add new span tag inside que_tag
    que_text.innerHTML = que_tag; 
    //add new div tag inside option_tag
    option_list.innerHTML = option_tag; 
    
    const option = option_list.querySelectorAll(".option");
    // onclick to all options
    for(i=0; i < option.length; i++){
        option[i].setAttribute("onclick", "optionSelected(this)");
    }
}

// 10. ICONS
let tickIconTag = '<div class="icon tick"><i class="fas fa-check"></i></div>';
let crossIconTag = '<div class="icon cross"><i class="fas fa-times"></i></div>';

// 11. OPTION SELECTED
function optionSelected(answer){
    // clear
    clearInterval(counter); 
    clearInterval(counterLine);
    // get selected answer, correct answer and options
    let userAns = answer.textContent;
    let correcAns = questions[que_count].answer; 
    const allOptions = option_list.children.length; 
    
    // if correct
    if(userAns == correcAns){ 
        userScore += 1; 
        // edit bar to green and add correct icon and text
        answer.classList.add("correct");
        answer.insertAdjacentHTML("beforeend", tickIconTag); 
        console.log("Correct Answer");
        console.log("Your correct answers = " + userScore);
    }else{
        answer.classList.add("incorrect"); 
        answer.insertAdjacentHTML("beforeend", crossIconTag); 
        console.log("Wrong Answer");
        // show correct answer
        for(i=0; i < allOptions; i++){
            if(option_list.children[i].textContent == correcAns){
                option_list.children[i].setAttribute("class", "option correct"); 
                option_list.children[i].insertAdjacentHTML("beforeend", tickIconTag); 
                console.log("Auto selected correct answer.");
            }
        }
    }
    for(i=0; i < allOptions; i++){
        // allow for only one answer
        option_list.children[i].classList.add("disabled"); 
    }
    // allow to click next
    next_btn.classList.add("show"); 
}

// 12.SHOW RESULT
function showResult(){
    info_box.classList.remove("activeInfo"); 
    quiz_box.classList.remove("activeQuiz"); 
    result_box.classList.add("activeResult"); 
    const scoreText = result_box.querySelector(".score_text");
    // show text
    if (userScore > 1){ 
        let scoreTag = '<span><p>'+ userScore +'</p> out of <p>'+ questions.length +'</p>!</span>';
        scoreText.innerHTML = scoreTag;  //adding new span tag inside score_Text
    }
    else{ 
        let scoreTag = '<span><p>'+ userScore +'</p> out of <p>'+ questions.length +'</p>. Try again.</span>';
        scoreText.innerHTML = scoreTag;
    }
}

// 14. TIMER
function startTimer(time){
    // 1 second
    counter = setInterval(timer, 1000);
    function timer(){
        //change value of timeCount to time value
        timeCount.textContent = time; 
        time--;
        if(time < 9){ 
            //if time is less than 9
            let addZero = timeCount.textContent; 
            // add zero -09
            timeCount.textContent = "0" + addZero; 
        }
        if(time < 0){ 
            clearInterval(counter);
            timeText.textContent = "Time's up"; 
            // get options and correct answers
            const allOptions = option_list.children.length; 
            let correcAns = questions[que_count].answer;
            for(i=0; i < allOptions; i++){
                // compare
                if(option_list.children[i].textContent == correcAns){
                    // add green and tick
                    option_list.children[i].setAttribute("class", "option correct"); 
                    option_list.children[i].insertAdjacentHTML("beforeend", tickIconTag); 
                    console.log("Time Off: Auto selected correct answer.");
                }
            }
            for(i=0; i < allOptions; i++){
                // one answer allowed
                option_list.children[i].classList.add("disabled"); 
            }
            next_btn.classList.add("show");
        }
    }
}

// 15. TIME LINE ABOVE QUESTION
function startTimerLine(time){
    counterLine = setInterval(timer, 39);
    function timer(){
        time += 1; 
        time_line.style.width = time + "px"; 
        if(time > 549){ 
            clearInterval(counterLine); 
        }
    }
}

// 13. QUESTION COUNTER
function queCounter(index){
    let totalQueCounTag = '<span><p>'+ index +'</p> of <p>'+ questions.length +'</p> Questions</span>';
    bottom_ques_counter.innerHTML = totalQueCounTag; 
}