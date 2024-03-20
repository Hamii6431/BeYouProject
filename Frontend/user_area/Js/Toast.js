function showToast(message) {
    if (isToastVisible) return; // Ha már van aktív toast, ne hozzunk létre újat

    // Ugrik a képernyő tetejére
    window.scrollTo({ top: 0, behavior: 'smooth' });

    isToastVisible = true; // Beállítjuk, hogy van aktív toast
    const toastContainer = document.getElementById('toastContainer');
    const toast = document.createElement('div');
    toast.classList.add('toast');
    toast.textContent = message;

    toastContainer.appendChild(toast);
    setTimeout(() => {
        toast.classList.add('show');
    }, 100);

    setTimeout(() => {
        toast.classList.remove('show');
        setTimeout(() => {
            toastContainer.removeChild(toast);
            isToastVisible = false; // Miután eltávolítottuk a toastot, beállítjuk, hogy nincs aktív toast
        }, 500);
    }, 3000);
}
