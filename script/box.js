document.addEventListener("DOMContentLoaded", () => {
    const loginopenboxbutton = document.getElementById("login-open-box-buton");
    const loginOpenBox = document.getElementById("login-open-box");
    if(loginopenboxbutton && loginOpenBox) {
    loginopenboxbutton.addEventListener("click", () => {
    if(window.getComputedStyle(loginOpenBox).display === "none") {
    loginOpenBox.style.display = "block";
} else {
    loginOpenBox.style.display = "none";
}
    });
    }
});
