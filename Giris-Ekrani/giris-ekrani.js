const getLeftArrBtn = document.getElementById("leftArrBtn");
const getRightArrBtn = document.getElementById("rightArrBtn");
const getLessonsBox = document.getElementById("lessonsBox");
const getCommentDiv = document.getElementById("commentsID");
const getQuestionInput = document.getElementById("questionInput");
const getPart4Div = document.getElementById("part4Div");
let counter = 0
let i= 0;
let isAnimating = false;
events()
changeComment();
changeInput();

function events(e){
    getLeftArrBtn.addEventListener("click" , ()=>{

        changeLessonsToLeft()
    });

    getRightArrBtn.addEventListener("click",()=>{
        changeLessonsToRight();
    }); 

    getPart4Div.addEventListener("mouseover",()=>{
        showReply()

    })

    getPart4Div.addEventListener("mouseleave",()=>{
        hideReply()
    })
}


async function changeLessonsToRight(){
    await moveLessons(counter,"-15rem")
    getLessonsBox.children[counter].style.display = "none";
    if(counter == 0){
        counter = 4;
    }
    counter -=1;
    getLessonsBox.children[counter].style.transform = "translateX(+15rem)"
    getLessonsBox.children[counter].style.display = "block";
    await setTimeout(()=>{moveLessons(counter,"0rem")},45)
    
}


async function changeLessonsToLeft(){
    await moveLessons(counter,"+15rem")
    getLessonsBox.children[counter].style.display = "none";
    if(counter == 3){
        counter = -1;
    }
    counter +=1;
    getLessonsBox.children[counter].style.transform = "translateX(-15rem)"
    getLessonsBox.children[counter].style.display = "block";
    await setTimeout(()=>{moveLessons(counter,"0rem")})
    
}

function moveLessons(a,b) {
    return new Promise((resolve)=>{
        const currentOpacity = window.getComputedStyle(getLessonsBox.children[a]).opacity;
        getLessonsBox.children[a].style.transform = `translateX(${b})`
        getLessonsBox.children[a].style.transition = "transform 0.3s , opacity 0.3s"
        if(currentOpacity == "0"){
            getLessonsBox.children[a].style.opacity = "1"
        }
        else{
            getLessonsBox.children[a].style.opacity = "0"
        }
        setTimeout(()=>{resolve()},300)
    })
}


function changeComment(){
    getCommentDiv.children[i].style.display = "none";
    i++;
    if(i==4){
        i = 0
    }
    getCommentDiv.children[i].style.display = "block";
    setTimeout(changeComment,2000);
}

async function changeInput(){
    let lessonName = "Geometri".split('');
    await writeAndDeleteInput(lessonName);
    lessonName = "Edebiyat".split('');
    await writeAndDeleteInput(lessonName);
    lessonName = "Biyoloji".split('');
    await writeAndDeleteInput(lessonName);
    lessonName = "Tarih".split('');
    await writeAndDeleteInput(lessonName);
    lessonName = "ve dahası..."
    await writeAndDeleteInput(lessonName);
    changeInput()
}
async function writeAndDeleteInput(lessonName) {
    for (const element of lessonName) {
        getQuestionInput.setAttribute("placeholder", getQuestionInput.getAttribute("placeholder") + element);
        await waitSeconds(150);
    }

    for(let j = 0; j< lessonName.length;j++){
        getQuestionInput.setAttribute("placeholder", getQuestionInput.getAttribute("placeholder").slice(0,-1))
        await waitSeconds(100)
    }
}
async function waitSeconds(second) {
    return new Promise(resolve => {
        setTimeout(resolve, second);
    });
}

async function showReply(){
 
    await waitSeconds(1500);
    getPart4Div.children[1].children[1].children[0].style.display = "none";
    getPart4Div.children[1].children[1].children[1].style.display = "block";
    await waitSeconds(500)
    getPart4Div.children[1].children[1].children[1].style.opacity = "1";
    isAnimating=false
}

async function hideReply(){

    await waitSeconds(1500);
    getPart4Div.children[1].children[1].children[1].style.opacity = "0";
    await waitSeconds(500)
    getPart4Div.children[1].children[1].children[1].style.display = "none";
    getPart4Div.children[1].children[1].children[0].style.display = "block";

}