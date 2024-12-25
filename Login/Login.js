const emailInput = document.getElementById("email");
        const emailCheck = document.getElementById("email-check");
        const errorMessage = document.getElementById("error-message");

        emailInput.addEventListener("input", function() {
            const emailValue = emailInput.value;
            const isValidEmail = /^(.*@gmail\.com|.*@hotmail\.com)$/.test(emailValue);

            if (isValidEmail) {
                emailCheck.textContent = "✔";  
                emailCheck.className = "valid";
                errorMessage.style.display = "none"; 
            } else {
                emailCheck.textContent = "✘";  
                emailCheck.className = "invalid";
                errorMessage.style.display = "block"; 
            }
        });