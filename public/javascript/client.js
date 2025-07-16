document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('clientSearch');
    const tableBody = document.getElementById('clientsTableBody');
    const searchLoading = document.getElementById('searchLoading');
    
    let searchTimeout;
    
    searchInput.addEventListener('input', function() {
        clearTimeout(searchTimeout);
        searchLoading.classList.add('visible');
        
        searchTimeout = setTimeout(() => {
            const searchTerm = this.value.trim();
            
            if (searchTerm === '') {
             
                window.location.reload();
                return;
            }
            
            fetch(`index.php?controller=client&action=index&term=${encodeURIComponent(searchTerm)}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                tableBody.innerHTML = '';
                
                if (data.length === 0) {
                    tableBody.innerHTML = `
                        <tr>
                            <td colspan="8" class="no-results">No clients found matching "${searchTerm}"</td>
                        </tr>
                    `;
                    return;
                }
                
                data.forEach(client => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${client.client_id}</td>
                        <td>${client.username}</td>
                        <td>${client.email}</td>
                        <td class="user-password-field">••••••••</td>
                        <td>${client.phone}</td>
                        <td>${client.address}</td>
                        <td class="user-actions-cell">
                            <a href="/sotre_php_mvc/index.php?controller=client&action=edit&id=${client.user_id}">
                                <button class="user-action-btn user-edit-btn">
                                    Edit
                                </button>
                            </a>
                            <a href="/sotre_php_mvc/index.php?controller=client&action=destroy&id=${client.user_id}" 
                               onclick="return confirm('Are you sure you want to delete this user?');">
                                <button class="user-action-btn user-delete-btn">
                                    Delete
                                </button>
                            </a>
                        </td>
                        <td>${new Date(client.created_at).toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' })}</td>
                    `;
                    tableBody.appendChild(row);
                });
            })
            .catch(error => {
                console.error('Error:', error);
            })
            .finally(() => {
                searchLoading.classList.remove('visible');
            });
        }, 300); 
    });
});