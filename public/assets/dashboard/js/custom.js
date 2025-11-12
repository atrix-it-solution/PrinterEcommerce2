// custom.js

// Auto-dismiss alerts after 10 seconds
document.addEventListener('DOMContentLoaded', function() {
    const alerts = document.querySelectorAll('.auto-dismiss');
    
    alerts.forEach(function(alert) {
        setTimeout(function() {
            const bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        }, 10000);
    });
});

function toggleSidebar() {
        const sidebar = document.querySelector('.sidebar');
        sidebar.classList.toggle('active');
    }

    document.addEventListener("DOMContentLoaded", function () {
    let titleInput = document.querySelector('input[name="title"]'); 
    let slugInput  = document.querySelector('input[name="slug"]'); 

    if (titleInput && slugInput) {
        // Function to generate slug
        function generateSlug(text) {
            return text
                .toString()
                .normalize("NFD")                   
                .replace(/[\u0300-\u036f]/g, "")    
                .toLowerCase()
                .trim()
                .replace(/[^a-z0-9\s-]/g, "")       
                .replace(/\s+/g, '-')               
                .replace(/-+/g, '-');               
        }

        // Update slug while typing in name field
        titleInput.addEventListener("input", function () {
            slugInput.value = generateSlug(this.value);
        });
    }
});


// Enable manual slug editing
function enableSlugEditing() {
    const slugInput = document.getElementById('slugInput');
    const editSlugBtn = document.getElementById('editSlugBtn');
    
    if (slugInput.readOnly) {
        // Enable editing
        slugInput.readOnly = false;
        slugInput.focus();
        slugInput.select();
        editSlugBtn.innerHTML = '<i class="fas fa-check"></i> Save';
        editSlugBtn.classList.remove('btn-outline-secondary');
        editSlugBtn.classList.add('btn-success');
        window.isManualEdit = true;
    } else {
        // Save and disable editing
        slugInput.readOnly = true;
        editSlugBtn.innerHTML = '<i class="fas fa-edit"></i> Edit';
        editSlugBtn.classList.remove('btn-success');
        editSlugBtn.classList.add('btn-outline-secondary');
        window.isManualEdit = true;
        
        // Format the slug properly
        function generateSlug(text) {
            return text
                .toString()
                .toLowerCase()
                .trim()
                .replace(/\s+/g, '-')
                .replace(/[^\w\-]+/g, '')
                .replace(/\-\-+/g, '-')
                .replace(/^-+/, '')
                .replace(/-+$/, '');
        }
        
        slugInput.value = generateSlug(slugInput.value);
    }
}


// Initialize CKEditor only if element exists
document.addEventListener("DOMContentLoaded", function () {
    const descriptionElement = document.querySelector('#description');
    
    if (descriptionElement) {
        ClassicEditor
            .create(descriptionElement, {
                toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', 'undo', 'redo']
            })
            .catch(error => {
                console.error("CKEditor error:", error);
            });
    } else {
        console.warn("CKEditor: #description element not found");
    }
});


// Clear localStorage on frontend logout
document.addEventListener('DOMContentLoaded', function() {
    // Check if user is logged out using data attribute
    const isAuthenticated = document.documentElement.getAttribute('data-is-authenticated') === 'true';
    
    if (!isAuthenticated) {
        localStorage.removeItem('auth_token');
        localStorage.removeItem('user');
        localStorage.removeItem('token_expires_at');
    }
    
    // Add logout confirmation
    const logoutForms = document.querySelectorAll('form[action*="logout"]');
    logoutForms.forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            if (confirm('Are you sure you want to logout?')) {
                // Clear localStorage
                localStorage.removeItem('auth_token');
                localStorage.removeItem('user');
                localStorage.removeItem('token_expires_at');
                // Submit the form
                this.submit();
            }
        });
    });
});




document.addEventListener('DOMContentLoaded', function() {
    const manageStockCheckbox = document.getElementById('manageStock');
    const stockQuantityField = document.getElementById('stockQuantityField');
    const stockQuantityInput = document.getElementById('stock_quantity');

    // Toggle stock quantity field visibility
    manageStockCheckbox.addEventListener('change', function() {
        if (this.checked) {
            stockQuantityField.style.display = 'block';
            // Set default value if empty
            if (!stockQuantityInput.value) {
                stockQuantityInput.value = '0';
            }
        } else {
            stockQuantityField.style.display = 'none';
            stockQuantityInput.value = '';
        }
    });

    // Initialize on page load
    if (manageStockCheckbox.checked) {
        stockQuantityField.style.display = 'block';
        if (!stockQuantityInput.value) {
            stockQuantityInput.value = '0';
        }
    }
});





