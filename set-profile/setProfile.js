const getSetNameDiv = document.getElementById("setNameDiv")
const getMainContentDiv = document.getElementById("mainContent")
const getSetUsernameDiv = document.getElementById("setUsernameDiv")
const uploadPhoto = document.getElementById("uploadPhoto")
const userPhoto = document.getElementById("userPhoto")
const getSetUserIconDiv = document.getElementById("SetUserIconDiv")
const getSetSurnameDiv = document.getElementById("setSurnameDiv")
const getOldPswInput = document.getElementById("oldPsw")
const getNewPass = document.getElementById("password")
const getAgPass = document.getElementById("agPsw")
events()


function events(){

    getNewPass.addEventListener("keyup",isPassMatch)
    getAgPass.addEventListener("keyup",isPassMatch)

    getSetNameDiv.children[2].addEventListener("click", ()=>{
        setName()
    })
    getSetSurnameDiv.children[2].addEventListener("click", ()=>{
        setSurname()
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


function isPassMatch(){
    debugger
    if(getNewPass.value!=getAgPass.value){
        getNewPass.nextElementSibling.style.display = "inline-block"
        getAgPass.nextElementSibling.style.display = "inline-block"
    }
    else{
        getNewPass.nextElementSibling.style.display = "none"
        getAgPass.nextElementSibling.style.display = "none"
    }
}


function setName(){
    getSetNameDiv.children[2].style.display = "none"
    getSetNameDiv.children[1].style.display = "none"
    getSetNameDiv.children[3].style.display = "inline"
}

function setSurname(){
    getSetSurnameDiv.children[2].style.display = "none"
    getSetSurnameDiv.children[1].style.display = "none"
    getSetSurnameDiv.children[3].style.display = "inline"
}

function setUserName(){
    getSetUsernameDiv.children[2].style.display = "none"
    getSetUsernameDiv.children[1].style.display = "none"
    getSetUsernameDiv.children[3].style.display = "inline"
}