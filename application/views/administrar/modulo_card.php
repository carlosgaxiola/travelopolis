<?php if (isset($modulo)): ?>
<div class="info-box">
	<span class="info-box-icon bg-aqua">
		<i class="<?php echo $modulo['fa_icon'] ?>"></i>
	</span>
	<div class="info-box-content">
		<span class="info-box-number"><?php echo $modulo['nombre'] ?></span>		
	</div>
</div>
<?php else: ?>
<?php endif; ?>