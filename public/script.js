const urlParams = new URLSearchParams(window.location.search);
const buttons = document.querySelectorAll('.tab');

if (urlParams.get('page')) {
    const param = urlParams.get('page');
    if (param == 'movies') {
        buttons[1].style.backgroundColor = '#2d2d2d';
        buttons[1].style.borderBottom = '1px solid beige';
    } else if (param == 'members') {
        buttons[0].style.backgroundColor = '#2d2d2d';
        buttons[0].style.borderBottom = '1px solid beige';
    }
} else {
    buttons[1].style.backgroundColor = '#2d2d2d';
    buttons[1].style.borderBottom = '1px solid beige';
}