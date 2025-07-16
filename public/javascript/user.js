  document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('userSearch');
        const tableBody = document.getElementById('usersTableBody');
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
                
                fetch(`index.php?controller=user&action=index&term=${encodeURIComponent(searchTerm)}`, {
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
                                <td colspan="7" class="no-results">No users found matching "${searchTerm}"</td>
                            </tr>
                        `;
                        return;
                    }
                    
                    data.forEach(user => {
                        const row = document.createElement('tr');
                        row.innerHTML = `
                            <td>${user.id}</td>
                            <td>${user.username}</td>
                            <td>${user.email}</td>
                            <td>${user.role_name}</td>
                            <td class="user-password-field">••••••••</td>
                            <td class="user-actions-cell">
                                <a href="/sotre_php_mvc/index.php?controller=user&action=edite&id=${user.id}">
                                    <button class="user-action-btn user-edit-btn">
                                        Update
                                    </button>
                                </a>
                                <a href="/sotre_php_mvc/index.php?controller=user&action=destroy&id=${user.id}" 
                                   onclick="return confirm('Are you sure you want to delete this user?');">
                                    <button class="user-action-btn user-delete-btn">
                                        Delete
                                    </button>
                                </a>
                            </td>
                            <td>${new Date(user.created_at).toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' })}</td>
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