
    var closeButtons = document.querySelectorAll('.close-button');
    closeButtons.forEach(function (button) {
    button.addEventListener('click', function () {
        var alert = this.parentNode;
        alert.style.display = 'none';
    });
});
