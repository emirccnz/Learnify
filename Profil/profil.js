const getRepliesButton = document.getElementById("repliesBtn");
const getQuestionsButton = document.getElementById("questionsBtn");
const getContentDiv = document.getElementById("contentDiv")
events();

function events(){
    getRepliesButton.addEventListener("click" , ()=> {
        showReplies()
    })
    getQuestionsButton.addEventListener("click", ()=>{
        showQuestions()
    })
}

function showReplies(){
    getQuestionsButton.style.border = "none";
    getRepliesButton.style.borderBottom = "1px blue solid";
    getContentDiv.children[0].style.display = "block"
    getContentDiv.children[1].style.display = "none"
}
function showQuestions(){
    getRepliesButton.style.border = "none";
    getQuestionsButton.style.borderBottom = "1px blue solid";
    getContentDiv.children[1].style.display = "block"
    getContentDiv.children[0].style.display = "none"
}