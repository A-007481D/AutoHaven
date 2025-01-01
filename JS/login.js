function showLogin() {
    document.getElementById('loginForm').classList.remove('hidden');
    document.getElementById('signupForm').classList.add('hidden');
    document.getElementById('loginTab').classList.add('border-blue-600', 'text-blue-600');
    document.getElementById('signupTab').classList.remove('border-blue-600', 'text-blue-600');
    document.getElementById('signupTab').classList.add('border-transparent');
}

function showSignup() {
    document.getElementById('loginForm').classList.add('hidden');
    document.getElementById('signupForm').classList.remove('hidden');
    document.getElementById('signupTab').classList.add('border-blue-600', 'text-blue-600');
    document.getElementById('loginTab').classList.remove('border-blue-600', 'text-blue-600');
    document.getElementById('loginTab').classList.add('border-transparent');
}