document.addEventListener("click", function (event) {
    var sidebarToggler = document.getElementById("sidebar_toggler");
    var burgerBtn = document
        .getElementById("burgerBtn")
        .getElementsByTagName("img")[0];
    var mobOverlay = document.querySelector(".mob-overlay");
    var sidebarWrapper = document.querySelector(".sidebar-wrapper");
    var body = document.body;

    if (event.target === sidebarToggler || event.target.closest("#menuIcon")) {
        sidebarWrapper.classList.add("sidebar-show");
        mobOverlay.classList.add("active");
        body.classList.add("overflow__hidden");
    } else if (event.target === burgerBtn) {
        sidebarWrapper.classList.remove("sidebar-show");
        mobOverlay.classList.remove("active");
        body.classList.remove("overflow__hidden");
    } else if (event.target === mobOverlay) {
        sidebarWrapper.classList.remove("sidebar-show");
        mobOverlay.classList.remove("active");
    }
});
