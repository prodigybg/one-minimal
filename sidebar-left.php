<?php if (is_active_sidebar('sidebar-left')) :?>
				<aside class="col-md-3" id="sidebar-left">
					<?php do_action('before_sidebar'); ?> 
					<?php dynamic_sidebar('sidebar-left'); ?> 
				</aside>
<?php endif; ?>