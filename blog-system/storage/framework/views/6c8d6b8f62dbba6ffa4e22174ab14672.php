

<?php $__env->startSection('title', 'All Posts'); ?>

<?php $__env->startSection('content'); ?>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>All Posts</h1>
        <?php if(auth()->guard()->check()): ?>
        <a href="<?php echo e(route('posts.create')); ?>" class="btn btn-primary">Create Post</a>
        <?php endif; ?>
    </div>

    <?php $__empty_1 = true; $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="card mb-4">
            <?php if($post->image): ?>
                <img src="<?php echo e(asset('storage/' . $post->image)); ?>" class="card-img-top post-image" alt="<?php echo e($post->title); ?>">
            <?php endif; ?>
            <div class="card-body">
                <h2 class="card-title"><?php echo e($post->title); ?></h2>
                <p class="card-text text-muted">Posted by <?php echo e($post->user->name); ?> on <?php echo e($post->created_at->format('M d, Y')); ?></p>
                <p class="card-text"><?php echo e(Str::limit($post->content, 200)); ?></p>
                <a href="<?php echo e(route('posts.show', $post)); ?>" class="btn btn-primary">Read More →</a>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="alert alert-info">No posts found.</div>
    <?php endif; ?>

    <?php echo e($posts->links()); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\blog-system\resources\views/posts/index.blade.php ENDPATH**/ ?>