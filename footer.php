<?php
/**
 * Alexander Georgiev (www.ageorgiev) - Main Footer File
 *
 * @package one-minimal
 */
?>

<footer id="site-footer">
<?php if (is_active_sidebar('main-footer')) :?>
	<div id="main-footer">
		<div class="container">
			<div class="row">				
					<?php dynamic_sidebar('main-footer'); ?>
					<div class="clearfix"></div>
			</div>
		</div>
	</div>
<?php endif ;?>
	<div id="copyright-footer">
		<div class="container">
			<p>Alexander Georgiev - Copyright 2015-2018®
				<a href="/terms-and-conditions/">Terms and Conditions</a> <!-- <a href="//www.iubenda.com/privacy-policy/8030319" class="iub-legal-only iubenda-embed" title="Privacy Policy">Privacy Policy</a><script type="text/javascript">(function (w,d) {var loader = function () {var s = d.createElement("script"), tag = d.getElementsByTagName("script")[0]; s.src = "//cdn.iubenda.com/iubenda.js"; tag.parentNode.insertBefore(s,tag);}; if(w.addEventListener){w.addEventListener("load", loader, false);}else if(w.attachEvent){w.attachEvent("onload", loader);}else{w.onload = loader;}})(window, document);</script> -->
					<ul class="social-media">
							<li><a title="Write an email" href='mailto:<?php the_author_meta('email');?>'><i class="fa fa-envelope"></i></a></li>							
							<li><a title="Facebook Page" target="_blank" href='<?php the_author_meta('facebook');?>'><i class="fa fa-facebook"></i></a></li>
							<li><a title="Twitter Profile" target="_blank" href='https://twitter.com/<?php the_author_meta('twitter');?>'><i class="fa fa-twitter"></i></a></li>
							<li><a title="Instagram" target="_blank" href='https://www.instagram.com/ageorgiev91/'><i class="fa fa-instagram"></i></a></li>
							<li><a title="Google Plus Profile" target="_blank" href='<?php the_author_meta('googleplus');?>'><i class="fa fa-google-plus"></i></a></li>
							<li><a title="LinkedIn Profile" target="_blank" href='https://www.linkedin.com/in/ageorgiev91/'><i class="fa fa-linkedin"></i></a></li>		</ul>
			</p>

		</div>
	</div>
</footer>
<div id="to-top" class="hidden-sm-down">
   <i class="fa fa-chevron-up"></i>
</div>
<script type="text/javascript">
    (function () {
        var options = {
            facebook: "876823685697283", // Facebook page ID
            email: "a.georgiev.91@gmail.com", // Email
            company_logo_url: "https://scontent.fsof3-1.fna.fbcdn.net/v/t1.0-9/14650292_1201762759870039_5160169964385147367_n.jpg?oh=dff130247cc625e7f7de00db11be6de8&oe=5A4D5292", // URL of company logo (png, jpg, gif)
            greeting_message: "Hello, how can I help you?", // Text of greeting message
            call_to_action: "", // Call to action
            button_color: "#129BF4", // Color of button
            position: "right", // Position may be 'right' or 'left'
            order: "facebook,email" // Order of buttons
        };
        var proto = document.location.protocol, host = "whatshelp.io", url = proto + "//static." + host;
        var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = url + '/widget-send-button/js/init.js';
        s.onload = function () { WhWidgetSendButton.init(host, proto, options); };
        var x = document.getElementsByTagName('script')[0]; x.parentNode.insertBefore(s, x);
    })();
</script>

		<?php wp_footer();?>
	</body>
</html>