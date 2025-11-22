document.addEventListener('livewire:initialized', () => {
    window.initRazorpay = function (options) {
        const rzp = new Razorpay(options);
        document.getElementById('rzp-button').onclick = function (e) {
            e.preventDefault();
            rzp.open();
        };
    };
});