const getAnswerBtns = document.querySelectorAll(".answerBtn");
const notificationIcon = document.querySelector(".fa-bell");
const notificationPopup = document.querySelector(".notificationPopup");


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

    notificationIcon.addEventListener("click", () =>{
        notificationPopup.style.display = (notificationPopup.style.display === "block") ? "none" : "block"; 
    });

    document.addEventListener("click", (e)=>{
        if(!notificationIcon.contains(e.target) && !notificationPopup.contains(e.target)){
            notificationPopup.style.display = "none"
        }
    })

}

