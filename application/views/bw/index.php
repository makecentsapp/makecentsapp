
<div class="alert alert-success" role="alert">
    <h4> Woah that's a lot of data. </h4>
</div>
<?php
$CI_vars_loaded = $this->_ci_cached_vars;
?>
<div class="alert alert-info" role="alert">
	<p>The following is every Key Value pair when var-dumping $this. The key is the button, the values are the content.</p>
</div>

<?php foreach ($this as $key => $value): ?>
	<p><i class="fab fa-500px"></i>
  		<button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#<?php echo $key ?>" aria-expanded="false" aria-controls="collapseExample">
    	<?php echo $key; ?>
  		</button>
	</p>
	<div class="collapse" id="<?php echo $key ?>">
  		<div class="card card-body">
  			<pre>
    		<?php print_r($value) ?>
    		</pre>
  		</div>
	</div>
<?php endforeach; ?>

<?php echo $this->template->layout; ?>

