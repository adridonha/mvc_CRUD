
<div class="container mt-4">
    <h2>Products List</h2>
    
    <?php if (isset($_GET['success'])): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?php
        $message = '';
        switch($_GET['success']) {
            case 'created':
                $message = 'Product created successfully!';
                break;
            case 'updated':
                $message = 'Product updated successfully!';
                break;
            case 'deleted':
                $message = 'Product deleted successfully!';
                break;
        }
        echo htmlspecialchars($message);
        ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php endif; ?>
    
    <div class="mb-3">
        <button type="button" class="btn btn-primary" id="toggleAddProductForm">Add New Product</button>
    </div>

    <div id="addProductForm" style="display: none;">
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">Add New Product</h5>
        </div>
        <div class="card-body">
            <form action="index.php?controller=product&action=create" method="post">
                <div class="mb-3">
                    <label for="cod" class="form-label">Code</label>
                    <input type="text" class="form-control" id="cod" name="cod" required>
                </div>
                <div class="mb-3">
                    <label for="short_name" class="form-label">Short Name</label>
                    <input type="text" class="form-control" id="short_name" name="short_name" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="RRP" class="form-label">RRP</label>
                    <input type="number" step="0.01" class="form-control" id="RRP" name="RRP" required>
                </div>
                <div class="mb-3">
                    <label for="family" class="form-label">Family</label>
                    <select class="form-control" id="family" name="family" required>
                        <?php foreach ($families as $family): ?>
                        <option value="<?php echo htmlspecialchars($family['cod']); ?>">
                            <?php echo htmlspecialchars($family['name']); ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Save Product</button>
                <button type="button" class="btn btn-secondary" onclick="document.getElementById('addProductForm').style.display='none'">Cancel</button>
            </form>
        </div>
    </div>
    </div>
    
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Code</th>
                <th>Short Name</th>
                <th>Description</th>
                <th>RRP</th>
                <th>Family</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product): ?>
            <tr>
                <td><?php echo htmlspecialchars($product['cod']); ?></td>
                <td><?php echo htmlspecialchars($product['short_name']); ?></td>
                <td><?php echo htmlspecialchars($product['description']); ?></td>
                <td><?php echo htmlspecialchars($product['RRP']); ?></td>
                <td><?php echo htmlspecialchars($product['family']); ?></td>
                <td>
                    <button type="button" class="btn btn-sm btn-warning edit-product" 
                            data-bs-toggle="modal" data-bs-target="#editProductModal"
                            data-product='<?php echo json_encode($product); ?>'>
                        Edit
                    </button>
                    <button type="button" class="btn btn-sm btn-danger delete-product"
                            data-bs-toggle="modal" data-bs-target="#deleteProductModal"
                            data-cod="<?php echo htmlspecialchars($product['cod']); ?>">
                        Delete
                    </button>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Edit Product Modal -->
<div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editProductModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProductModalLabel">Edit Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="index.php?controller=product&action=update" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="cod" id="edit-cod">
                    <div class="mb-3">
                        <label for="edit-short-name" class="form-label">Short Name</label>
                        <input type="text" class="form-control" id="edit-short-name" name="short_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit-description" class="form-label">Description</label>
                        <textarea class="form-control" id="edit-description" name="description" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="edit-rrp" class="form-label">RRP</label>
                        <input type="number" step="0.01" class="form-control" id="edit-rrp" name="RRP" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit-family" class="form-label">Family</label>
                        <select class="form-control" id="edit-family" name="family" required>
                            <?php foreach ($families as $family): ?>
                            <option value="<?php echo htmlspecialchars($family['cod']); ?>">
                                <?php echo htmlspecialchars($family['name']); ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Product Modal -->
<div class="modal fade" id="deleteProductModal" tabindex="-1" aria-labelledby="deleteProductModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteProductModalLabel">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this product?
            </div>
            <div class="modal-footer">
                <form action="index.php?controller=product&action=delete" method="POST">
                    <input type="hidden" name="cod" id="delete-cod">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Toggle Add Product Form
    document.getElementById('toggleAddProductForm').addEventListener('click', function() {
        const form = document.getElementById('addProductForm');
        form.style.display = form.style.display === 'none' ? 'block' : 'none';
    });

    // Handle Add Product Form submission
    document.querySelector('#addProductForm form').addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        
        fetch('index.php?controller=product&action=create', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(() => {
            window.location.href = 'index.php?controller=product&success=created';
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while saving the product.');
        });
    });

    // Handle Edit Product
    document.querySelectorAll('.edit-product').forEach(button => {
        button.addEventListener('click', function() {
            const product = JSON.parse(this.getAttribute('data-product'));
            document.getElementById('edit-cod').value = product.cod;
            document.getElementById('edit-short-name').value = product.short_name;
            document.getElementById('edit-description').value = product.description;
            document.getElementById('edit-rrp').value = product.RRP;
            document.getElementById('edit-family').value = product.family;
        });
    });

    // Handle Delete Product
    document.querySelectorAll('.delete-product').forEach(button => {
        button.addEventListener('click', function() {
            const cod = this.getAttribute('data-cod');
            document.getElementById('delete-cod').value = cod;
        });
    });
});
</script>

<?php
require_once(__DIR__ . '/../template/footer.php');
showFooter();
?>