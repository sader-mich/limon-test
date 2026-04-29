$('.acc-toolbar-toggle-link').click(function() {
    $('nav.acc-toolbar').toggleClass('acc-toolbar-open');
});

var textSizeChangeCount = 0;
document.getElementById('increaseTextSize').addEventListener('click', function() {
    if (textSizeChangeCount < 8) {
        var currentFontSize = parseFloat(getComputedStyle(document.body).fontSize);
        var newFontSize = currentFontSize + 1;
        document.body.style.fontSize = newFontSize + 'px';
        textSizeChangeCount++;
    }
});
document.getElementById('decreaseTextSize').addEventListener('click', function() {
    if (textSizeChangeCount > -8) {
        var currentFontSize = parseFloat(getComputedStyle(document.body).fontSize);
        var newFontSize = currentFontSize - 1;
        document.body.style.fontSize = newFontSize + 'px';
        textSizeChangeCount--;
    }
});

document.getElementById('grayscale').addEventListener('click', function() {
    var currentFilter = getComputedStyle(document.body).filter;
    if (currentFilter === 'none') {
        document.body.style.filter = 'grayscale(100%)';
    } else {
        document.body.style.filter = 'none';
    }
});

document.getElementById('highContrast').addEventListener('click', function() {
    document.body.classList.toggle('high-contrast');
});

document.getElementById('negativeContrast').addEventListener('click', function() {
    document.body.classList.toggle('negative-contrast');
});

document.getElementById('lightBackground').addEventListener('click', function() {
    document.body.classList.toggle('light-background');
});

document.getElementById('underlineLinks').addEventListener('click', function() {
    document.body.classList.toggle('underline-links');
});

document.getElementById('readabilityFont').addEventListener('click', function() {
    document.body.classList.toggle('readability-font');
});

document.getElementById('resetAccessibility').addEventListener('click', function() {
    document.body.style.fontSize = '';
    document.body.style.filter = '';
    document.body.classList.remove('high-contrast');
    document.body.classList.remove('negative-contrast');
    document.body.classList.remove('light-background');
    document.body.classList.remove('underline-links');
    document.body.classList.remove('readability-font');
    textSizeChangeCount = 0;
});