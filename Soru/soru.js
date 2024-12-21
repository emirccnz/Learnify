const getDropdownContents = document.querySelectorAll(".ddc1");
const getDropdownContents2 = document.querySelectorAll(".ddc2");
const getPointP = document.getElementById("pointP")
const getLessonP = document.getElementById("lessonP")
events()
function events(){
    getClickedTextContent(getDropdownContents);
    getClickedTextContent(getDropdownContents2)
}

function getClickedTextContent(a){
    a.forEach(content => {
        content.addEventListener("click", (e) => {
            e.preventDefault()
            let clicked = e.target.textContent;
            if(a == getDropdownContents){
                getLessonP.textContent = clicked + "   "
            }
            if(a==getDropdownContents2){
                getPointP.textContent = clicked + "   "
            }
        });
    });


}