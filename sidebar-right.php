<?php if (is_active_sidebar('sidebar-right')) : ?> 
				<aside class="col-lg-3" id="sidebar-right">
					<?php do_action('before_sidebar'); ?> 
					<?php dynamic_sidebar('sidebar-right'); ?> 
				</aside>
<?php endif; ?>