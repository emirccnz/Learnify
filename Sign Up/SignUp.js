const passwordInput = document.getElementById("password");

        const lowercaseCheck = document.getElementById("lowercase");
        const uppercaseCheck = document.getElementById("uppercase");
        const numberCheck = document.getElementById("number");
        const lengthCheck = document.getElementById("length");
        const errorMessage = document.getElementById("error-message");

        passwordInput.addEventListener("input", function() {
            const passwordValue = passwordInput.value;

            const hasLowercase = /[a-z]/.test(passwordValue);
            lowercaseCheck.className = hasLowercase ? "valid" : "invalid";


            const hasUppercase = /[A-Z]/.test(passwordValue);
            uppercaseCheck.className = hasUppercase ? "valid" : "invalid";

 
            const hasNumber = /\d/.test(passwordValue);
            numberCheck.className = hasNumber ? "valid" : "invalid";

            const hasMinLength = passwordValue.length >= 8;
            lengthCheck.className = hasMinLength ? "valid" : "invalid";

       
            if (hasLowercase && hasUppercase && hasNumber && hasMinLength) {
                errorMessage.style.display = "none"; 
            } else {
                errorMessage.style.display = "block"; 
            }
        });