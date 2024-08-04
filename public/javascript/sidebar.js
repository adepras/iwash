document.addEventListener("DOMContentLoaded", function () {
    const btnList = document.querySelector(".btn-list");
    const btnImage = btnList.querySelector("img");
    const sidebar = document.querySelector(".sidebar");
    const navbar = document.querySelector(".navbar");
    const mainContent = document.querySelector(".main-content");

    btnList.addEventListener("click", function (e) {
        e.preventDefault();
        sidebar.classList.toggle("collapsed");
        navbar.classList.toggle("collapsed");
        mainContent.classList.toggle("collapsed");

        if (sidebar.classList.contains("collapsed")) {
            btnImage.src = "/image/arrow-bar-right.svg";
        } else {
            btnImage.src = "/image/arrow-bar-left.svg";
        }
    });

    sidebar.addEventListener("mouseenter", function () {
        if (sidebar.classList.contains("collapsed")) {
            mainContent.classList.remove("collapsed");
            navbar.classList.remove("collapsed");
            sidebar.classList.add("uncollapsed");
            sidebar.classList.remove("collapsed");
            btnImage.src = "/image/arrow-bar-left.svg";
        }
    });

    sidebar.addEventListener("mouseleave", function () {
        if (sidebar.classList.contains("uncollapsed")) {
            mainContent.classList.add("collapsed");
            navbar.classList.add("collapsed");
            sidebar.classList.add("collapsed");
            sidebar.classList.remove("uncollapsed");
            btnImage.src = "/image/arrow-bar-right.svg";
        }
    });
});


document.addEventListener('DOMContentLoaded', function () {
    const buttons = document.querySelectorAll('.sidebar-menu button');

    buttons.forEach(button => {
        button.addEventListener('click', function () {
            const url = this.getAttribute('data-url');
            window.location.href = url;
        });
    });
});
