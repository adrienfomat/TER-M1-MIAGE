document.getElementById('menu-toggle').addEventListener('click', function() {
    const menu = document.getElementById('vertical-menu');
    if (menu.style.display === 'block') {
        menu.style.display = 'none';
    } else {
        menu.style.display = 'block';
    }
});