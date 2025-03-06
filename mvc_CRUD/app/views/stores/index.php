
<div class="container mt-4">
    <h2>Stores List</h2>
    
    <?php if (isset($_GET['success'])): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?php
        $message = '';
        switch($_GET['success']) {
            case 'created':
                $message = 'Store created successfully!';
                break;
            case 'updated':
                $message = 'Store updated successfully!';
                break;
            case 'deleted':
                $message = 'Store deleted successfully!';
                break;
        }
        echo htmlspecialchars($message);
        ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php endif; ?>
    
    <div class="mb-3">
        <button type="button" class="btn btn-primary" id="toggleAddStoreForm">Add New Store</button>
    </div>
    
    <div id="addStoreForm" style="display: none;">
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">Add New Store</h5>
        </div>
        <div class="card-body">
            <form action="index.php?controller=store&action=create" method="post">
                <div class="mb-3">
                    <label for="cod" class="form-label">Code</label>
                    <input type="text" class="form-control" id="cod" name="cod" required>
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="tlf" class="form-label">Phone</label>
                    <input type="text" class="form-control" id="tlf" name="tlf" required>
                </div>
                <button type="submit" class="btn btn-primary">Save Store</button>
                <button type="button" class="btn btn-secondary" onclick="document.getElementById('addStoreForm').style.display='none'">Cancel</button>
            </form>
        </div>
    </div>
    </div>
    
    <?php if (isset($_GET['action']) && $_GET['action'] == 'edit' && isset($_GET['cod'])): ?>
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">Edit Store</h5>
        </div>
        <div class="card-body">
            <form action="index.php?controller=store&action=update" method="post">
                <input type="hidden" name="cod" value="<?php echo htmlspecialchars($_GET['cod']); ?>">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($store_to_edit['name'] ?? ''); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="tlf" class="form-label">Phone</label>
                    <input type="text" class="form-control" id="tlf" name="tlf" value="<?php echo htmlspecialchars($store_to_edit['tlf'] ?? ''); ?>" required>
                </div>
                <button type="submit" class="btn btn-primary">Update Store</button>
                <a href="index.php?controller=store" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
    <?php endif; ?>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Code</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($stores as $store): ?>
            <tr>
                <td><?php echo htmlspecialchars($store['cod']); ?></td>
                <td><?php echo htmlspecialchars($store['name']); ?></td>
                <td><?php echo htmlspecialchars($store['tlf']); ?></td>
                <td>
                    <a href="index.php?controller=store&action=edit&cod=<?php echo $store['cod']; ?>" class="btn btn-sm btn-warning">Edit</a>
                    <form action="index.php?controller=store&action=delete" method="post" style="display: inline;">
                        <input type="hidden" name="cod" value="<?php echo $store['cod']; ?>">
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this store?');">Delete</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script>
document.getElementById('toggleAddStoreForm').addEventListener('click', function() {
    var form = document.getElementById('addStoreForm');
    form.style.display = form.style.display === 'none' ? 'block' : 'none';
});
</script>

<?php
require_once(__DIR__ . '/../template/footer.php');
showFooter();
?>