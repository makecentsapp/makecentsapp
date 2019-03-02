
<div class="alert alert-success mt-3" role="alert">
    <h4> Testing ATMOS. As soon as you leave this page, it will be vanilla bootstrap again.  </h4>
</div>
<?php
$CI_vars_loaded = $this->_ci_cached_vars;
?>
<pre>
	<?php //print_r($CI_vars_loaded); ?>
	<?php //echo "USER ID: " . $this->user->info->ID; ?>
</pre>


<?php
//Example form to submit to a echo back function:
/*	public function echo_post()
	{
		$this->output->enable_profiler(TRUE);
		$postdata = $this->input->post();
		foreach ($postdata as $key => $value) {
			echo "Post Key: " . $key . " Value: " . $value;
			echo "<br>";
		}
	}*/
// Open form and set URL for submit form
echo form_open(site_url("BW/echo_post")); //CSRF TOKEN is auto included with this function
//OR
//Open your form tag... <form bla bla>
/*<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">*/
?>
<p>Testing some icons..</p>
<p><span class="fas fa-paper-plane"></span></p>
<h4> This will just echo back the posted data. With the profiler on.</h4>
  <div class="form-group">
    <label for="inputEmail">Email address</label>
    <input type="email" name="email" class="form-control" id="inputEmail" aria-describedby="emailHelp" placeholder="Enter email">
    <small id="emailHelp" class="form-text text-muted">This is a label. I made this.</small>
  </div>
  <div class="form-group">
    <label for="inputPassword">Password</label>
    <input type="password" name="password" class="form-control" id="inputPassword" placeholder="Password">
  </div>
  <div class="form-group form-check">
    <input type="checkbox" name="check1" class="form-check-input" id="check1">
    <label class="form-check-label" for="check1">Check me out</label>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
<?php echo form_close();?>


<hr>


<div class="alert alert-info" role="alert">
	<p>The following is every Key Value pair when var-dumping $this. The key is the button, the values are the content.</p>
</div>
<?php foreach ($this as $key => $value): ?>
	<p>
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

