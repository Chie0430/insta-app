

<?php $__env->startSection('title', 'Show Post'); ?>

<?php $__env->startSection('content'); ?>
    <style>
        .col-4{
            overflow: scroll;
        }
        .card-body{
            position: absolute;
            top: 65px;
        }
        /* .comment-section{
            overflow: scroll;
            position: absolute;
            top: 75px;
        } */
    </style>
    <div class="row border show">
        <div class="col p-0 border-end">
            <img src="<?php echo e($post->image); ?>" alt="post id <?php echo e($post->id); ?>" class="w-100">
        </div>
        <div class="col-4 px-0 bg-white">
            <div class="card border-0">
                <div class="card-header bg-white py-3">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <a href="<?php echo e(route('profile.show', $post->user->id)); ?>">
                                <?php if($post->user->avatar): ?>
                                <img src="<?php echo e($post->user->avatar); ?>" alt="<?php echo e($post->user->name); ?>" class="rounded-circle avatar-sm">
                                <?php else: ?>
                                    <i class="fa-solid fa-circle-user text-secondary icon-sm"></i>
                                <?php endif; ?>

                            </a>
                        </div>
                        <div class="col ps-0">
                            <a href="<?php echo e(route('profile.show', $post->user->id)); ?>" class="text-decoration-none text-dark"><?php echo e($post->user->name); ?></a>
                        </div>
                        <div class="col-auto">
                            
                            <?php if(Auth::user()->id === $post->user->id): ?>
                                <button class="btn btn-sm shadow-none" data-bs-toggle="dropdown">
                                    <i class="fa-solid fa-ellipsis"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a href="<?php echo e(route('post.edit', $post->id)); ?>" class="dropdown-item">
                                        <i class="fa-regular fa-pen-to-square"></i> Edit
                                    </a>
                                    <button class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#delete-post-<?php echo e($post->id); ?>">
                                        <i class="fa-regular fa-trash-can"></i> Delete
                                    </button>
                                </div>
                                
                                <?php echo $__env->make('users.posts.contents.modals.delete', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <?php else: ?>
                                
                                <?php if($post->user->isFollowed()): ?>
                                    <form action="<?php echo e(route('follow.destroy', $post->user->id)); ?>" method="post">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="btn btn-secondary btn-sm fw-bold">Following</button>
                                    </form>
                                <?php else: ?>
                                    <form action="<?php echo e(route('follow.store', $post->user->id)); ?>" method="post">
                                        <?php echo csrf_field(); ?>
                                        <button type="submit" class="btn btn-primary btn-sm fw-bold">Follow</button>
                                    </form>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="card-body w-100">
                    
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <?php if($post->isLiked()): ?>
                                <form action="<?php echo e(route('like.destroy', $post->id)); ?>" method="post">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-sm shadow-none p-0">
                                        <i class="fa-solid fa-heart text-danger"></i>
                                    </button>
                                </form>
                            <?php else: ?>
                                <form action="<?php echo e(route('like.store', $post->id)); ?>" method="post">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="btn btn-sm shadow-none p-0">
                                        <i class="fa-regular fa-heart"></i>
                                    </button>
                                </form>
                            <?php endif; ?>
                        </div> 
                        <div class="col-auto px-0">
                            <span><?php echo e($post->likes->count()); ?></span>
                        </div>
                        <div class="col text-end">
                            <?php $__currentLoopData = $post->categoryPost; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category_post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="badge bg-secondary bg-opacity-50">
                                    <?php echo e($category_post->category->name); ?>

                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>

                    
                    <a href="<?php echo e(route('profile.show', $post->user->id)); ?>" class="text-decoration-none text-dark fw-bold"><?php echo e($post->user->name); ?></a>
                    &nbsp;
                    <p class="d-inline fw-light"><?php echo e($post->description); ?></p>
                    <p class="text-uppercase text-muted xsmall"><?php echo e(date('M d, Y', strtotime($post->created_at))); ?></p>

                    
                    
                    

                    
                    <form action="<?php echo e(route('comment.store', $post->id)); ?>" method="post">
                        <?php echo csrf_field(); ?>
                        <div class="input-group">
                            <textarea name="comment_body<?php echo e($post->id); ?>" rows="1" class="form-control form-control-sm" placeholder="Add a comment"><?php echo e(old('comment_body'. $post->id)); ?></textarea>
                            <button type="submit" class="btn btn-secondary btn-sm">Post</button>
                        </div>
                        
                        <?php $__errorArgs = ['comment_body'. $post->id];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="text-danger small"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </form>
                    <div class="mt-3">
                        
                        <?php if($post->comments->isNotEmpty()): ?>
                            <ul class="list-group mt-2">
                                <?php $__currentLoopData = $post->comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="list-group-item border-0 p-0 mb-2">
                                        <a href="<?php echo e(route('profile.show', $comment->user->id)); ?>" class="text-decoration-none text-dark fw-bold"><?php echo e($comment->user->name); ?></a>
                                        &nbsp;
                                        <p class="d-inline fw-light"><?php echo e($comment->body); ?></p>

                                        <form action="<?php echo e(route('comment.destroy', $comment->id)); ?>" method="post">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <span class="text-uppercase text-muted xsmall"><?php echo e(date('M d, Y', strtotime($comment->created_at))); ?></span>

                                            <p class="xsmall text-danger">Posted on <?php echo e($comment->created_at->diffForHumans()); ?></p>

                                            
                                            <?php if(Auth::user()->id === $comment->user->id): ?>
                                                &middot;
                                                <button type="submit" class="border-0 bg-transparent text-danger p-0 xsmall">Delete</button>
                                            <?php endif; ?>
                                        </form>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Ribbonne\Desktop\laravel-insta\insta-app\resources\views/users/posts/show.blade.php ENDPATH**/ ?>