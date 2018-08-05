<?php $__env->startSection('content'); ?>

	<h1>Cards</h1>
	<?php if(count($cards) > 0): ?>
		<?php $__currentLoopData = $cards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $card): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<div class="well">
			<h3><?php echo e($card->Cardtitle); ?></h3>
			<small>Created on <?php echo e($card->created_at); ?></small>
		</div>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	<?php else: ?>
		<p>No Cards Found</p>
	<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>