const getDropdownContents = document.querySelectorAll(".ddc1");
const getDropdownContents2 = document.querySelectorAll(".ddc2");
const getPointP = document.getElementById("pointP")
const getLessonP = document.getElementById("lessonP")
const getPaperclipIcon = document.getElementById("paperclipIcon")
const getFileInput = document.getElementById("fileInput")
const getTextarea = document.getElementById("questionInput")
const getFileButton = document.getElementById("fileButton")
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

    getPaperclipIcon.addEventListener("click",()=>{
        getFileInput.click();
    })
    getFileInput.addEventListener("change",(e)=>{
        getFileButton.style.display = "inline-flex"
        const file = e.target.files[0];
        
        if (file) {
            const reader = new FileReader();
    
            
            reader.onload = function (e) {
                getFileButton.children[0].src = e.target.result; 
            };
    
            reader.readAsDataURL(file); 
        }
        getFileButton.children[1].textContent = file.name
        
    })

    getFileButton.children[2].addEventListener("click",()=>{
        getFileButton.children[0].src = ""
        getFileButton.children[1].textContent = ""
        getFileButton.style.display = "none"
    })
}