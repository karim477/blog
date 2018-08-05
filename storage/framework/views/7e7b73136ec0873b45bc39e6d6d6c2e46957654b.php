<?php $__env->startSection('content'); ?>
<div class="container">
  <h1>Create card in "<?php echo e($post->title); ?>"</h1>
  <p>Please Enter the card details</p>

  <?php echo Form::open(['action' => ['PostsController@storeCard', $post->id],'method' => 'POST','enctype'=>'multipart/form-data']); ?>

    <div class="forom-group">
      <?php echo e(Form::label('title','Title')); ?>

      <?php echo e(Form::text('title','',['class' => 'form-control','placeholder' =>'Title'])); ?>

    </div>
    <div class="forom-group">
      <?php echo e(Form::label('body','Body')); ?>

      <?php echo e(Form::textarea('body','',['id'=>'card-body', 'class' => 'form-control','placeholder' =>'Body Text'])); ?>

    </div>  
    <div style="padding: 30px;">
      <?php echo e(Form::submit('Submit',['class'=>'btn btn-primary'])); ?>

    </div>
  <?php echo Form::close(); ?>


</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>