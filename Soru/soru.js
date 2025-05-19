const getPaperclipIcon = document.getElementById("paperclipIcon")
const getFileInput = document.getElementById("fileInput")
const getTextarea = document.getElementById("questionInput")
const getFileButton = document.getElementById("fileButton")

events()

function events(){
    getPaperclipIcon.addEventListener("click",()=>{
        getFileInput.click();
    })
    
    getFileInput.addEventListener("click",(e)=>{
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