const emailInput = document.getElementById("email");
        const emailCheck = document.getElementById("email-check");
        const errorMessage = document.getElementById("error-message");

        emailInput.addEventListener("input", function() {
            const emailValue = emailInput.value;

            // E-posta geçerlilik kontrolü: sadece gmail.com veya hotmail.com
            const isValidEmail = /^(.*@gmail\.com|.*@hotmail\.com)$/.test(emailValue);

            if (isValidEmail) {
                emailCheck.textContent = "✔";  // Geçerli mail ise tik işareti
                emailCheck.className = "valid";
                errorMessage.style.display = "none"; // Geçerli mail olduğunda hata mesajını gizle
            } else {
                emailCheck.textContent = "✘";  // Geçersiz mail ise çarpı işareti
                emailCheck.className = "invalid";
                errorMessage.style.display = "block"; // Geçersiz mail olduğunda hata mesajını göster
            }
        });