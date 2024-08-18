

function goToPath(event) {
    let parentNode = event.target;
    console.log(parentNode)
    while (parentNode.tagName !== 'BUTTON') {
        parentNode = parentNode.parentElement;
        if (!parentNode) {
            return;
        }
    }
    const productId = parentNode.dataset.route;
    console.log(productId)
    window.location.href =productId;
}
console.log('r')