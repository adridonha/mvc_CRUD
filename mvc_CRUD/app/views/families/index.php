

<div class="container mt-4">
    <h2>Families List</h2>
    
    <?php if (isset($_GET['success'])): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?php
        $message = '';
        switch($_GET['success']) {
            case 'created':
                $message = 'Family created successfully!';
                break;
            case 'updated':
                $message = 'Family updated successfully!';
                break;
            case 'deleted':
                $message = 'Family deleted successfully!';
                break;
        }
        echo htmlspecialchars($message);
        ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php endif; ?>

    <?php if (isset($_GET['error'])): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?php
        $message = '';
        switch($_GET['error']) {
            case 'missing_fields':
                $message = 'Please fill in all required fields.';
                break;
            case 'insert_failed':
                $message = 'Failed to create family.';
                break;
            case 'update_failed':
                $message = 'Failed to update family.';
                break;
            case 'delete_failed':
                $message = 'Failed to delete family.';
                break;
            case 'database_error':
                $message = 'A database error occurred.';
                break;
        }
        echo htmlspecialchars($message);
        ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php endif; ?>
    
    <div class="mb-3">
        <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addFamilyModal">Add New Family</a>
    </div>
    
    <!-- Add Family Modal -->
    <div class="modal fade" id="addFamilyModal" tabindex="-1" aria-labelledby="addFamilyModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addFamilyModalLabel">Add New Family</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="index.php?controller=family&action=create" method="POST">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="add-code" class="form-label">Code</label>
                            <input type="text" class="form-control" id="add-code" name="cod" required>
                        </div>
                        <div class="mb-3">
                            <label for="add-name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="add-name" name="name" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Family</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <?php if (isset($_GET['action']) && $_GET['action'] == 'add'): ?>
    <!-- Remove the old inline add form -->
    <?php endif; ?>
    
    <table class="table">
        <thead>
            <tr>
                <th>Code</th>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($families as $family): ?>
            <tr>
                <td><?php echo htmlspecialchars($family['cod']); ?></td>
                <td><?php echo htmlspecialchars($family['name']); ?></td>
                <td>
                    <button type="button" class="btn btn-sm btn-warning edit-family" 
                            data-bs-toggle="modal" data-bs-target="#editFamilyModal"
                            data-family='<?php echo json_encode($family); ?>'>
                        Edit
                    </button>
                    <button type="button" class="btn btn-sm btn-danger delete-family"
                            data-bs-toggle="modal" data-bs-target="#deleteFamilyModal"
                            data-cod="<?php echo htmlspecialchars($family['cod']); ?>">
                        Delete
                    </button>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Edit Family Modal -->
<div class="modal fade" id="editFamilyModal" tabindex="-1" aria-labelledby="editFamilyModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editFamilyModalLabel">Edit Family</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="index.php?controller=family&action=update" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="cod" id="edit-cod">
                    <input type="hidden" name="action" value="edit">
                    <div class="mb-3">
                        <label for="edit-name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="edit-name" name="name" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update Family</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Family Modal -->
<div class="modal fade" id="deleteFamilyModal" tabindex="-1" aria-labelledby="deleteFamilyModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteFamilyModalLabel">Delete Family</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this family?</p>
            </div>
            <div class="modal-footer">
                <form action="index.php?controller=family&action=delete" method="POST">
                    <input type="hidden" name="cod" id="delete-cod">
                    <input type="hidden" name="action" value="delete">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Edit Family
    const editButtons = document.querySelectorAll('.edit-family');
    editButtons.forEach(button => {
        button.addEventListener('click', function() {
            const family = JSON.parse(this.getAttribute('data-family'));
            document.getElementById('edit-cod').value = family.cod;
            document.getElementById('edit-name').value = family.name;
        });
    });

    // Delete Family
    const deleteButtons = document.querySelectorAll('.delete-family');
    deleteButtons.forEach(button => {
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