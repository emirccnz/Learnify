const getSetNameDiv = document.getElementById("setNameDiv")
const getMainContentDiv = document.getElementById("mainContent")
const getSetUsernameDiv = document.getElementById("setUsernameDiv")
const uploadPhoto = document.getElementById("uploadPhoto")
const userPhoto = document.getElementById("userPhoto")
const getSetUserIconDiv = document.getElementById("SetUserIconDiv")
events()


function events(){
    getSetNameDiv.children[2].addEventListener("click", ()=>{
        setName()
    })

    getSetUsernameDiv.children[2].addEventListener("click", ()=>{
        setUserName()
    })
    Array.from(getMainContentDiv.children).forEach(children => {
        children.addEventListener("click",()=>{
            children.children[1].style.display = "flex"
            if(children == getSetUserIconDiv){
                children.children[1].style.display = "block"
            }
        })
    });
    uploadPhoto.addEventListener("change", (e) => {
        const file = e.target.files[0];
    
        if (file) {
            const reader = new FileReader();
    
            
            reader.onload = function (e) {
                userPhoto.src = e.target.result; 
            };
    
            reader.readAsDataURL(file); 
        }
    });
}

function setName(){
    getSetNameDiv.children[2].style.display = "none"
    getSetNameDiv.children[1].style.display = "none"
    getSetNameDiv.children[3].style.display = "inline"
}

function setUserName(){
    getSetUsernameDiv.children[2].style.display = "none"
    getSetUsernameDiv.children[1].style.display = "none"
    getSetUsernameDiv.children[3].style.display = "inline"
}