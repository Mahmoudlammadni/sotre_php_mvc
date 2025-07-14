document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('productSearch');
        const productsTableBody = document.getElementById('productsTableBody');
        const searchLoading = document.getElementById('searchLoading');
        let searchTimeout;
        
        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            searchLoading.classList.add('visible');
            
            searchTimeout = setTimeout(() => {
                const searchTerm = this.value.trim();
                
                fetch(`index.php?controller=product&action=search&term=${encodeURIComponent(searchTerm)}`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    // Clear existing rows
                    productsTableBody.innerHTML = '';
                    
                    // Add new rows
                    if (data.length > 0) {
                        data.forEach(product => {
                            productsTableBody.innerHTML += `
                            <tr>
                                <td class="product-image-cell">
                                    ${product.image_path ? 
                                        `<img src="/sotre_php_mvc/${escapeHtml(product.image_path)}" 
                                              alt="${escapeHtml(product.name)}">` : 
                                        '<div class="text-gray-400">No image</div>'}
                                </td>
                                <td>${escapeHtml(product.name)}</td>
                                <td>${escapeHtml(product.description)}</td>
                                <td>${escapeHtml(product.price)} MAD</td>
                                <td>${escapeHtml(product.quantity)}</td>
                                <td class="user-actions-cell">
                                    <a href="/sotre_php_mvc/index.php?controller=product&action=edite&id=${product.id}">
                                        <button class="user-action-btn user-edit-btn">
                                            Edit
                                        </button>
                                    </a>
                                    <?php if ($_SESSION['user']['role_name'] === 'admin'): ?>
                                    <a href="/sotre_php_mvc/index.php?controller=product&action=destroy&id=${product.id}" 
                                       onclick="return confirm('Are you sure you want to delete this product?');">
                                        <button class="user-action-btn user-delete-btn">
                                            Delete
                                        </button>
                                    </a>
                                    <?php endif; ?>
                                </td>
                            </tr>`;
                        });
                    } else {
                        productsTableBody.innerHTML = `
                        <tr>
                            <td colspan="6" class="no-results">
                                No products found matching "${escapeHtml(searchTerm)}"
                            </td>
                        </tr>`;
                    }
                    
                    searchLoading.classList.remove('visible');
                })
                .catch(error => {
                    console.error('Error:', error);
                    productsTableBody.innerHTML = `
                    <tr>
                        <td colspan="6" class="no-results">
                            Error loading products
                        </td>
                    </tr>`;
                    searchLoading.classList.remove('visible');
                });
            }, 300);
        });
        
        // Simple HTML escaping function
        function escapeHtml(unsafe) {
            if (!unsafe) return '';
            return unsafe.toString()
                .replace(/&/g, "&amp;")
                .replace(/</g, "&lt;")
                .replace(/>/g, "&gt;")
                .replace(/"/g, "&quot;")
                .replace(/'/g, "&#039;");
        }
    });