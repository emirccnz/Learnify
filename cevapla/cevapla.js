const getQuestDiv = document.getElementById("quest");
const selectedQuest = localStorage.getItem('selectedQuest');
events()

function events() {
    window.addEventListener("DOMContentLoaded",()=>{
        if(selectedQuest){
            
            console.log(selectedQuest)
            getQuestDiv.insertAdjacentHTML("beforebegin",selectedQuest)
            localStorage.removeItem("selectedQuest")
        }
        getQuestDiv.style.display = "none"
    })
}