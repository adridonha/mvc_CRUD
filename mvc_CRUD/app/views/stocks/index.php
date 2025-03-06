
<div class="container mt-4">
    <h2>Stock Management</h2>
    
    <?php if (isset($_GET['success'])): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?php
        $message = '';
        switch($_GET['success']) {
            case 'created':
                $message = 'Stock entry created successfully!';
                break;
            case 'updated':
                $message = 'Stock entry updated successfully!';
                break;
            case 'deleted':
                $message = 'Stock entry deleted successfully!';
                break;
        }
        echo htmlspecialchars($message);
        ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php endif; ?>
    
    <div class="mb-3">
        <button type="button" class="btn btn-primary" id="toggleAddStockForm">Add New Stock Entry</button>
    </div>

    <div id="addStockForm" style="display: none;">
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">Add New Stock Entry</h5>
        </div>
        <div class="card-body">
            <form id="stockForm" action="index.php?controller=stock&action=create" method="post">
                <div class="mb-3">
                    <label for="product" class="form-label">Product</label>
                    <select class="form-control" id="product" name="product" required>
                        <?php foreach ($products as $product): ?>
                        <option value="<?php echo htmlspecialchars($product['cod']); ?>">
                            <?php echo htmlspecialchars($product['short_name']); ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="store" class="form-label">Store</label>
                    <select class="form-control" id="store" name="store" required>
                        <?php foreach ($stores as $store): ?>
                        <option value="<?php echo htmlspecialchars($store['cod']); ?>">
                            <?php echo htmlspecialchars($store['name']); ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="units" class="form-label">Units</label>
                    <input type="number" class="form-control" id="units" name="units" required min="0">
                </div>
                <button type="submit" class="btn btn-primary">Save Stock Entry</button>
                <button type="button" class="btn btn-secondary" onclick="document.getElementById('addStockForm').style.display='none'">Cancel</button>
            </form>
        </div>
    </div>
    </div>
    
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Product Code</th>
                <th>Product Name</th>
                <th>Units</th>
                <th>Store</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($stocks as $stock): ?>
            <tr>
                <td><?php echo htmlspecialchars($stock['product']); ?></td>
                <td><?php echo htmlspecialchars($stock['product_name']); ?></td>
                <td><?php echo htmlspecialchars($stock['units']); ?></td>
                <td><?php echo htmlspecialchars($stock['store']); ?></td>
                <td>
                    <button type="button" class="btn btn-sm btn-warning edit-stock"
                            data-bs-toggle="modal" data-bs-target="#editStockModal"
                            data-stock='<?php echo json_encode($stock); ?>'>
                        Edit
                    </button>
                    <button type="button" class="btn btn-sm btn-danger delete-stock"
                            data-bs-toggle="modal" data-bs-target="#deleteStockModal"
                            data-product="<?php echo htmlspecialchars($stock['product']); ?>"
                            data-store="<?php echo htmlspecialchars($stock['store']); ?>">
                        Delete
                    </button>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Edit Stock Modal -->
<div class="modal fade" id="editStockModal" tabindex="-1" aria-labelledby="editStockModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editStockModalLabel">Edit Stock Entry</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="index.php?controller=stock&action=update" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="product" id="edit-product">
                    <input type="hidden" name="store" id="edit-store">
                    <div class="mb-3">
                        <label for="edit-units" class="form-label">Units</label>
                        <input type="number" class="form-control" id="edit-units" name="units" required min="0">
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

<!-- Delete Stock Modal -->
<div class="modal fade" id="deleteStockModal" tabindex="-1" aria-labelledby="deleteStockModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteStockModalLabel">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this stock entry?
            </div>
            <div class="modal-footer">
                <form action="index.php?controller=stock&action=delete" method="POST">
                    <input type="hidden" name="product" id="delete-product">
                    <input type="hidden" name="store" id="delete-store">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Toggle Add Stock Form
    document.getElementById('toggleAddStockForm').addEventListener('click', function() {
        const form = document.getElementById('addStockForm');
        form.style.display = form.style.display === 'none' ? 'block' : 'none';
    });

    // Handle Add Stock Form submission
    document.getElementById('stockForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        
        fetch('index.php?controller=stock&action=create', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(() => {
            window.location.href = 'index.php?controller=stock&success=created';
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while saving the stock entry.');
        });
    });

    // Handle Edit Stock
    document.querySelectorAll('.edit-stock').forEach(button => {
        button.addEventListener('click', function() {
            const stock = JSON.parse(this.getAttribute('data-stock'));
            document.getElementById('edit-product').value = stock.product;
            document.getElementById('edit-store').value = stock.store;
            document.getElementById('edit-units').value = stock.units;
        });
    });

    // Handle Delete Stock
    document.querySelectorAll('.delete-stock').forEach(button => {
        button.addEventListener('click', function() {
            const product = this.getAttribute('data-product');
            const store = this.getAttribute('data-store');
            document.getElementById('delete-product').value = product;
            document.getElementById('delete-store').value = store;
        });
    });
});
</script>

<?php
require_once(__DIR__ . '/../template/footer.php');
showFooter();
?>