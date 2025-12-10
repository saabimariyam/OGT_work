// humburger menu
    const menuBtn = document.getElementById("menuBtn");
const navMenu = document.getElementById("navMenu");

menuBtn.addEventListener("click", () => {
    navMenu.classList.toggle("showMenu");


        // rotate icon
        menuBtn.classList.toggle("active");

        // change icon (bars <-> X)
        if (menuIcon.classList.contains("fa-bars")) {
            menuIcon.classList.remove("fa-bars");
            menuIcon.classList.add("fa-xmark");
        } else {
            menuIcon.classList.remove("fa-xmark");
            menuIcon.classList.add("fa-bars");
        }
    });
