let registerForm = document.getElementById("registerForm");
if(registerForm){
    registerForm.addEventListener("submit", function(e){
        e.preventDefault();
        let formData = new FormData(this);

        fetch("register.php", {
            method: "POST",
            body: formData
        })
        .then(res => res.text())
        .then(data => {
            if(data === "success"){
                alert("Registration Successful!");
                window.location.href = "login.html"; // Back to login
            } else {
                alert("Registration Failed! Maybe Email already exists");
            }
        });
    });
}