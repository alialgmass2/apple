 
         const tabContent = document.querySelectorAll('.tab-content .tab-pane');
         var activeElement = document.querySelector(".nav-link.active");
         var filter = document.querySelector(".filter");
         var content = document.querySelector(".filter ul");
         var leftBtn = document.querySelector(".left-btn");
         var rightBtn = document.querySelector(".right-btn");

                function showTab(tabId) {
            tabs.forEach(tab => {
                tab.classList.remove('active');
            });
            tabContent.forEach(content => {
                content.classList.remove('active');
            });
            const tab = document.querySelector(`#myTabs .nav-link[data-tab-id="${tabId}"]`);
            const content = document.querySelector(`.tab-content .tab-pane#${tabId}`);
            tab.classList.add('active');
            content.classList.add('active');
        }
                function scroll(element){
                      if (element) {
                                element.scrollIntoView({
                                    behavior: 'smooth',
                                    block: 'nearest',
                                    inline: 'start',
                                });
                            }
                }
                function updateId( newId) {
                    var currentUrl = window.location.href;
                    var urlWithoutParams = currentUrl.split('products/')[0];
                    if (isNaN(newId)) {
                        var newUrl = urlWithoutParams + `products/${newId}`;
                    } else {
                        var newUrl = urlWithoutParams + 'products/' + newId;
                    }
                    window.history.pushState(null, '', newUrl);

                }
                function clickCategory(element, newId){
                     scroll(element);
                     updateId( newId);
                }

                function getScrollStep(){
                    let activeElementRect = activeElement.getBoundingClientRect();
                    let step = activeElementRect.width;
                    return step+15
                }



        window.addEventListener("DOMContentLoaded", function () { 
                 scroll(activeElement)

            function updateScrollButtons() {
                if (content.scrollWidth > filter.offsetWidth) {
                    leftBtn.classList.add("show");
                    rightBtn.classList.add("show");
                } else {

                    leftBtn.classList.remove("show");
                    rightBtn.classList.remove("show");
                }
                if (content.scrollLeft === 0) {
                    leftBtn.classList.remove("show");
                }
                if (( content.scrollWidth - (content.scrollLeft + filter.offsetWidth) ) <2) {
                    rightBtn.classList.remove("show");
                }
            }

            content.addEventListener("scroll", function () {
                updateScrollButtons();
            });

            leftBtn.addEventListener("click", function () {
                // content.scrollLeft -= getScrollStep();
    // content.scrollLeft -= Math.min(content.scrollLeft, getScrollStep());
    var scrollDistance = content.scrollLeft - getScrollStep();
    var maxScrollDistance = Math.max(0, content.scrollLeft - filter.offsetWidth);
    content.scrollLeft = Math.min(scrollDistance, maxScrollDistance);
            });

            rightBtn.addEventListener("click", function () {
    var scrollDistance = content.scrollLeft + getScrollStep();
    var maxScrollDistance = Math.min(content.scrollLeft + filter.offsetWidth, content.scrollWidth - filter.offsetWidth);
    content.scrollLeft = Math.min(scrollDistance, maxScrollDistance);
            });

            // Initial check when the page loads
            if (content.scrollLeft + filter.offsetWidth < content.scrollWidth) {
                rightBtn.classList.add("show");
            }
        });
    