
<div class="modal fade" id="edit-category-<?php echo e($category->id); ?>">
    <div class="modal-dialog">
        <form action="<?php echo e(route('admin.categories.update', $category->id)); ?>" method="post">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PATCH'); ?>
            <div class="modal-content border-warning">
                <div class="modal-header border-warning">
                    <h3 class="h5 modal-title">
                        <i class="fa-regular fa-pen-to-square"></i> Edit Category
                    </h3>
                </div>
                <div class="modal-body">
                    <input type="text" name="new_name" class="form-control" placeholder="Category name" value="<?php echo e($category->name); ?>">
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-outline-warning btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-warning btn-sm">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>


<div class="modal fade" id="delete-category-<?php echo e($category->id); ?>">
    <div class="modal-dialog">
        <form action="<?php echo e(route('admin.categories.destroy', $category->id)); ?>" method="post">
            <?php echo csrf_field(); ?>
            <?php echo method_field('DELETE'); ?>
            <div class="modal-content border-danger">
                <div class="modal-header border-danger">
                    <h3 class="h5 modal-title">
                        <i class="fa-regular fa-trash-can"></i> Delete Category
                    </h3>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete category <span class="mt-1 text-muted fw-bold"><?php echo e($category->name); ?></span>?</p>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-outline-danger btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </div>
            </div>
        </form>
    </div>
</div><?php /**PATH C:\Users\Ribbonne\Desktop\laravel-insta\insta-app\resources\views/admin/categories/modal/action.blade.php ENDPATH**/ ?>