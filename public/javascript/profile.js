 function addToCart(productId) {
        fetch(`index.php?controller=cart&action=add&id=${productId}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const cartCount = document.getElementById('cart-count');
                    if (cartCount) {
                        cartCount.textContent = data.cart_count;
                        cartCount.classList.remove('hidden');
                    }
                    alert('Product added to cart!');
                }
            });
    }
    
        function removeFromCart(productId) {
            if (confirm('Are you sure you want to remove this item from your cart?')) {
                fetch(`index.php?controller=cart&action=remove&id=${productId}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                        
                            window.location.reload();
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            }
        }