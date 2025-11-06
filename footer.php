<footer class="footer">
	<section class="footbox">
	    <div class="container">
	    	<div class="foot">
	    		<div class="copyright">
		    		<p><?php echo get_theme_mod('ds_banquan') ?> </p>
		    	</div>
		    	<div class="foot_nav">
					<?php wp_nav_menu(
					    array(
					    'theme_location'  => 'footnav',
					    'container'       => 'nav',
					    'container_class' => 'dbdh',
					    'depth'           => 1,
					    )
					);
					?>
					<?php if( get_theme_mod('ds_beian') ): ?>
					<a class="beian" href="https://beian.miit.gov.cn/" rel="external nofollow" target="_blank" title="备案号"><i class="bi bi-shield-check me-1"></i><?php echo get_theme_mod('ds_beian') ?></a>
					<?php endif; ?>
		    	</div>
		    </div>
	    </div>
	</section>
	<button class="scrollToTopBtn" title="返回顶部"><i class="bi bi-chevron-up"></i></button>
</footer>

<?php ds_nopic_des(); ?>

<?php echo get_theme_mod('ds_footer'); ?>
<?php wp_footer();?>
</body>
</html>