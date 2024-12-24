const getAnswerBtns = document.querySelectorAll(".answerBtn");

events()

function events() {
    Array.from(getAnswerBtns).forEach((button,index)=>{
        button.addEventListener("click",(e)=>{
            const questDiv = e.target.closest(".quest");
            const questHTML = questDiv.outerHTML;
            localStorage.setItem("selectedQuest",questHTML);
            window.location.href = "/cevapla/cevapla.html"
        })
    })
}