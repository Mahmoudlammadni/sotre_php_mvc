  document.getElementById('categorySearch').addEventListener('input', function(e) {
            const searchTerm = e.target.value.trim();
            const loadingIndicator = document.getElementById('searchLoading');
            
            loadingIndicator.classList.add('visible');
            
            if (searchTerm.length === 0) {
                fetchCategories();
                return;
            }
            
            const xhr = new XMLHttpRequest();
            xhr.open('GET', `/sotre_php_mvc/index.php?controller=category&action=index&term=${encodeURIComponent(searchTerm)}`, true);
            xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
            
            xhr.onload = function() {
                if (this.status === 200) {
                    const results = JSON.parse(this.responseText);
                    updateTable(results);
                }
                loadingIndicator.classList.remove('visible');
            };
            
            xhr.send();
        });
        
        function fetchCategories() {
            const xhr = new XMLHttpRequest();
            xhr.open('GET', '/sotre_php_mvc/index.php?controller=category&action=index', true);
            xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
            
            xhr.onload = function() {
                if (this.status === 200) {
                    const results = JSON.parse(this.responseText);
                    updateTable(results);
                }
                document.getElementById('searchLoading').classList.remove('visible');
            };
            
            xhr.send();
        }
        
        function updateTable(categories) {
            const tbody = document.getElementById('categoriesTableBody');
            tbody.innerHTML = '';
            
            if (categories.length === 0) {
                tbody.innerHTML = `
                    <tr class="no-results">
                        <td colspan="4">No categories found</td>
                    </tr>
                `;
                return;
            }
            
            categories.forEach(category => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${escapeHtml(category.id)}</td>
                    <td>${escapeHtml(category.name)}</td>
                    <td>${escapeHtml(category.description)}</td>
                    <td class="user-actions-cell">
                        <a href="/sotre_php_mvc/index.php?controller=category&action=edit&id=${category.id}">
                            <button class="user-action-btn user-edit-btn">
                                Edit
                            </button>
                        </a>
                        <?php if ($_SESSION['user']['role_name'] === 'admin'): ?>
                        <a href="/sotre_php_mvc/index.php?controller=category&action=destroy&id=${category.id}" 
                           onclick="return confirm('Are you sure you want to delete this category?');">
                            <button class="user-action-btn user-delete-btn">
                                Delete
                            </button>
                        </a>
                        <?php endif; ?>
                    </td>
                `;
                tbody.appendChild(row);
            });
        }
        
        function escapeHtml(unsafe) {
            return unsafe
                .toString()
                .replace(/&/g, "&amp;")
                .replace(/</g, "&lt;")
                .replace(/>/g, "&gt;")
                .replace(/"/g, "&quot;")
                .replace(/'/g, "&#039;");
        }