// hamburger menu
var hamburger = document.querySelector(".hamburger");
hamburger.addEventListener("click", function () {
    document.querySelector("body").classList.toggle("active");
})

// toast
var toastElList = [].slice.call(document.querySelectorAll('.toast'))
var toastList = toastElList.map(function (toastEl) {
    return new bootstrap.Toast(toastEl) // No need for options; use the default options
});
toastList.forEach(toast => toast.show()); // This show them

// vue
window.Vue = require('vue')