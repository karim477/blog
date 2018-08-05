<?php $__env->startSection('content'); ?>
<div class="container">
  <a href="/posts" class="btn btn-default" style="background-color: orange;">Go Back</a>
  <a href="/posts/<?php echo e($post->id); ?>/create-card" class="btn btn-primary" style="background-color: orange;">Add Card</a>
  <h1><?php echo e($post->title); ?></h1>
  <!-- <img  style="width:100%; " src="/storage/cover_image/<?php echo e($post->cover_image); ?>"> -->
  <br><br>
  <?php $__currentLoopData = $cards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $card): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php echo e($card->id); ?>/<?php echo e($card->title); ?><br>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  <div>
    <?php echo $post->body; ?>

  </div>
  <hr>
  <small>Writen on<?php echo e($post->created_at); ?> by <?php echo e($post->user->name); ?></small>
  <hr>
  <?php if(!Auth::guest()): ?>
    <?php if(Auth::user()->id==$post->user_id): ?>
      <a href="/posts/<?php echo e($post->id); ?>/edit" class="btn btn-default">Edit</a>
      <?php echo Form::open(['action'=>['PostsController@destroy',$post->id],'method'=>'POST','class'=>'pull-right']); ?>

        <?php echo e(Form::hidden('_method','DELETE')); ?>

        <?php echo e(Form::submit('Delete',['class' =>'btn btn-danger'])); ?>

      <?php echo Form::close(); ?>

    <?php endif; ?>
  <?php endif; ?>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>