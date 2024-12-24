const passwordInput = document.getElementById("password");

        const lowercaseCheck = document.getElementById("lowercase");
        const uppercaseCheck = document.getElementById("uppercase");
        const numberCheck = document.getElementById("number");
        const lengthCheck = document.getElementById("length");
        const errorMessage = document.getElementById("error-message");

        passwordInput.addEventListener("input", function() {
            const passwordValue = passwordInput.value;

            // Küçük harf kontrolü
            const hasLowercase = /[a-z]/.test(passwordValue);
            lowercaseCheck.className = hasLowercase ? "valid" : "invalid";

            // Büyük harf kontrolü
            const hasUppercase = /[A-Z]/.test(passwordValue);
            uppercaseCheck.className = hasUppercase ? "valid" : "invalid";

            // Rakam kontrolü
            const hasNumber = /\d/.test(passwordValue);
            numberCheck.className = hasNumber ? "valid" : "invalid";

            // Minimum 8 karakter kontrolü
            const hasMinLength = passwordValue.length >= 8;
            lengthCheck.className = hasMinLength ? "valid" : "invalid";

            // Hata mesajını göster / gizle
            if (hasLowercase && hasUppercase && hasNumber && hasMinLength) {
                errorMessage.style.display = "none"; // Eğer her şey doğruysa hata mesajını gizle
            } else {
                errorMessage.style.display = "block"; // Eğer herhangi biri yanlışsa hata mesajını göster
            }
        });