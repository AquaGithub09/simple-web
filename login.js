document.addEventListener('DOMContentLoaded', (event) => {
    if (localStorage.getItem('rememberMe') === 'true') {
        document.getElementById('email_address').value = localStorage.getItem('email_address');
        document.getElementById('password').value = localStorage.getItem('password');
        document.getElementById('remember-me').checked = true;
    }
});

function saveLoginInfo() {
    const email = document.getElementById('email_address').value;
    const password = document.getElementById('password').value;
    const rememberMe = document.getElementById('remember-me').checked;

    if (rememberMe) {
        localStorage.setItem('email_address', email);
        localStorage.setItem('password', password);
        localStorage.setItem('rememberMe', true);
    } else {
        localStorage.removeItem('email_address');
        localStorage.removeItem('password');
        localStorage.removeItem('rememberMe');
    }

    return true;
}
