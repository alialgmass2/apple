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

// Function to check if all elements and their backgrounds are loaded
function checkAllLoaded() { 
    var elements = document.getElementsByClassName("mark-background");
    var loadedCount = 0;

    if (elements.length === 0) {
        appearPageContent(); 
        return;
    }

    // Check if all elements and backgrounds are loaded
    function checkBackgroundLoad() {
        loadedCount++;
        if (loadedCount === elements.length) {
            console.log("All elements and their backgrounds are loaded.");
            appearPageContent();
        }
    }

    // Loop through elements and attach onload event listener to each background image
    for (var i = 0; i < elements.length; i++) {
        var element = elements[i];
        var backgroundImage =
            getComputedStyle(element).getPropertyValue("background-image");

        // Extract the URL of the background image
        var imageUrl = backgroundImage.match(/url\(['"]?(.*?)['"]?\)/i)[1];

        // Create a new Image object and attach the onload event listener
        var img = new Image();
        img.onload = checkBackgroundLoad;
        img.src = imageUrl;
    }
 
}

window.addEventListener("load", function () { 
    // checkAllLoaded();
    appearPageContent();
});

function appearPageContent() {
    console.log('appear')
    var spinner = document.getElementById("spinner");
    var imageContainer = document.getElementById("page");
    imageContainer.style.display = "block";
    spinner.style.display = "none";
}
