document.addEventListener("DOMContentLoaded", () => {
    console.log("Index page loaded with premium style.");

    // Example: Floating button animation
    const buttons = document.querySelectorAll('.btn');
    buttons.forEach(btn => {
        btn.addEventListener('mouseover', () => {
            btn.style.boxShadow = '0 12px 20px rgba(0,0,0,0.3)';
        });
        btn.addEventListener('mouseout', () => {
            btn.style.boxShadow = '0 8px 15px rgba(0,0,0,0.2)';
        });
    });
});
