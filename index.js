let loginForm = document.getElementById("loginForm");
if(loginForm){
    loginForm.addEventListener("submit", function(e){
        e.preventDefault();
        let formData = new FormData(this);

        fetch("login.php", {
            method: "POST",
            body: formData
        })
        .then(res => res.text())
        .then(data => {
            if(data === "success"){
                window.location.href = "register.html"; // Login success → Register
            } else if(data === "wrong"){
                alert("Wrong Password");
            } else {
                alert("User Not Found");
            }
        });
    });
}