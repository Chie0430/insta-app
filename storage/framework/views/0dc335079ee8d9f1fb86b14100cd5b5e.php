
<div class="modal fade" id="hide-post-<?php echo e($post->id); ?>">
    <div class="modal-dialog">
        <div class="modal-content border-danger">
            <div class="modal-header border-danger">
                <h3 class="h5 modal-title text-danger">
                    <i class="fa-solid fa-eye-slash"></i> Hide Post
                </h3>
            </div>
            <div class="modal-body">
                Are you sure you want to hide post <span class="fw-bold"><?php echo e($post->id); ?></span>?
            </div>
            <div class="modal-footer border-0">
                <form action="<?php echo e(route('admin.posts.hide', $post->id)); ?>" method="post">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="button" class="btn btn-outline-danger btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger btn-sm">Hide</button>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="unhide-post-<?php echo e($post->id); ?>">
    <div class="modal-dialog">
        <div class="modal-content border-success">
            <div class="modal-header border-success">
                <h3 class="h5 modal-title text-success">
                    <i class="fa-solid fa-eye"></i> Unhide Post
                </h3>
            </div>
            <div class="modal-body">
                Are you sure you want to unhide post <span class="fw-bold"><?php echo e($post->id); ?></span>?
            </div>
            <div class="modal-footer border-0">
                <form action="<?php echo e(route('admin.posts.unhide', $post->id)); ?>" method="post">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PATCH'); ?>
                    <button type="button" class="btn btn-outline-success btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success btn-sm">Unhide</button>
                </form>
            </div>
        </div>
    </div>
</div><?php /**PATH C:\Users\Ribbonne\Desktop\laravel-insta\insta-app\resources\views/admin/posts/modal/status.blade.php ENDPATH**/ ?>