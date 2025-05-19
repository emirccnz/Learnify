const getRepliesButton = document.getElementById("repliesBtn");
const getQuestionsButton = document.getElementById("questionsBtn");
const getContentDiv = document.getElementById("contentDiv")
const getSoruDivs = document.querySelectorAll(".soruDiv");
events();

function events(){
    getRepliesButton.addEventListener("click" , ()=> {
        showReplies()
    })
    getQuestionsButton.addEventListener("click", ()=>{
        showQuestions()
    })

    getSoruDivs.forEach(function(div){
        div.addEventListener("click",()=>{
            location.href = ""
        })
    })
}

function showReplies(){
    getQuestionsButton.style.border = "none";
    getRepliesButton.style.borderBottom = "1px blue solid";
    getContentDiv.children[0].style.display = "flex"
    getContentDiv.children[1].style.display = "none"
}
function showQuestions(){
    getRepliesButton.style.border = "none";
    getQuestionsButton.style.borderBottom = "1px blue solid";
    getContentDiv.children[1].style.display = "flex"
    getContentDiv.children[0].style.display = "none"
}
