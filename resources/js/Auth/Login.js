document.getElementById('loginForm').addEventListener('submit', function(event) {
    let valid = true;

    // Clear previous errors
    document.getElementById('emailError').textContent = '';
    document.getElementById('passwordError').textContent = '';
    document.getElementById('email').classList.remove('is-invalid');
    document.getElementById('password').classList.remove('is-invalid');

    // Validate email
    const email = document.getElementById('email').value;
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!email) {
        document.getElementById('emailError').textContent = 'Email is required.';
        document.getElementById('email').classList.add('is-invalid');
        valid = false;
    } else if (!emailPattern.test(email)) {
        document.getElementById('emailError').textContent = 'Invalid email format.';
        document.getElementById('email').classList.add('is-invalid');
        valid = false;
    }

    // Validate password
    const password = document.getElementById('password').value;
    if (!password) {
        document.getElementById('passwordError').textContent = 'Password is required.';
        document.getElementById('password').classList.add('is-invalid');
        valid = false;
    } else if (password.length < 6) {
        document.getElementById('passwordError').textContent = 'Password must be at least 6 characters.';
        document.getElementById('password').classList.add('is-invalid');
        valid = false;
    }

    if (!valid) {
        event.preventDefault();
    }
});