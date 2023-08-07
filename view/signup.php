<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Ajouter les liens CSS Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../view/stylesheets/style.css?v=<?php echo time(); ?>">
    <title>Register</title>
    <style>
        /* Style pour les messages de feedback personnalisés */
        .valid-feedback {
            display: none;
            color: #28a745;
        }

        .is-valid ~ .valid-feedback {
            display: block;
        }

        .invalid-feedback {
            display: none;
            color: #dc3545;
        }

        .is-invalid ~ .invalid-feedback {
            display: block;
        }
    </style>
</head>
<body>
    
    <main class="container mt-4">
        <form action="../controller/register_redirect.php" method="post">
            <h1 class="mb-4">Sign Up</h1>
            <div class="mb-3">
                <label for="username" class="form-label">Username:</label>
                <input type="text" name="username" id="username" class="form-control" required>
                <div class="valid-feedback">
                    Looks good!
                </div>
                <div class="invalid-feedback">
                    Please choose a username.
                </div>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" name="email" id="email" class="form-control" required>
                <div class="valid-feedback">
                    Looks good!
                </div>
                <div class="invalid-feedback">
                    Please provide a valid email.
                </div>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password:</label>
                <input type="password" name="password" id="password" class="form-control" required>
                <div class="valid-feedback">
                    Looks good!
                </div>
                <div class="invalid-feedback">
                    Please choose a password.
                </div>
            </div>
            <div class="mb-3">
                <label for="confirm_password" class="form-label">Password Again:</label>
                <input type="password" name="confirm_password" id="confirm_password" class="form-control" required>
                <div class="valid-feedback">
                    Looks good!
                </div>
                <div class="invalid-feedback">
                    Passwords don't match.
                </div>
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" name="agree" id="agree" class="form-check-input" value="yes" required/>
                <label for="agree" class="form-check-label">I agree with the <a href="#" title="term of services">term of services</a></label>
                <div class="invalid-feedback">
                    You must agree before submitting.
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Register</button>
            <footer class="mt-3">Already a member? <a href="signin.php">Login here</a></footer>
        </form>
    </main>

    <!-- Ajouter les scripts Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        var username = document.getElementById("username");
        var email = document.getElementById("email");
        var password = document.getElementById("password");
        var confirm_password = document.getElementById("confirm_password");

        function validateUsername() {
            username.classList.toggle("is-valid", username.value !== "");
            username.classList.toggle("is-invalid", username.value === "");
        }

        function validateEmail() {
            email.classList.toggle("is-valid", email.value !== "");
            email.classList.toggle("is-invalid", email.value === "");
        }

        function validatePassword() {
            password.classList.toggle("is-valid", password.value !== "");
            password.classList.toggle("is-invalid", password.value === "");
        }

        function validateConfirmPassword() {
            confirm_password.classList.toggle("is-valid", confirm_password.value !== "" && confirm_password.value === password.value);
            confirm_password.classList.toggle("is-invalid", confirm_password.value === "" || confirm_password.value !== password.value);
        }

        function validateAgree() {
            document.getElementById("agree").classList.toggle("is-valid", document.getElementById("agree").checked);
            document.getElementById("agree").classList.toggle("is-invalid", !document.getElementById("agree").checked);
        }

        function validateForm() {
            validateUsername();
            validateEmail();
            validatePassword();
            validateConfirmPassword();
            validateAgree();
        }

        username.addEventListener("input", validateUsername);
        email.addEventListener("input", validateEmail);
        password.addEventListener("input", validatePassword);
        confirm_password.addEventListener("input", validateConfirmPassword);
        document.getElementById("agree").addEventListener("change", validateAgree);

        document.querySelector("form").addEventListener("submit", function(event) {
            validateForm();
            if (!this.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
        });
    </script>
</body>
</html>
