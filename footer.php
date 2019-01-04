		</div><!-- #content -->

		<footer id="colophon" class="site-footer" role="contentinfo">
			
			<div class="fl">
			<p>© Tous droits réservés 2018</p>
			<?php
				/*Menu Footer*/ 
				if ( has_nav_menu( 'bottom' ) ) : 
					wp_nav_menu ( array (
					'theme_location' => 'bottom' ,
					'menu_class' => 'footer-menu', // classe CSS pour customiser mon menu
					) ); 
				endif;
			?>
			</div>
			
			<div class="imgContainer">
				<img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo-footer.png" alt="logo greenpi">
			</div> 
			<ul>
				<a href="https://www.facebook.com/greenpibox/" target="_blank">
					<li><span class="typcn typcn-social-facebook"></span></li>
				</a> 
				<a href="https://twitter.com/Green_Pi_Box" target="_blank">
					<li><span class="typcn typcn-social-twitter"></span></li>
				</a>
			</ul>

		</footer><!-- #colophon -->
</div><!-- #page -->
<?php wp_footer(); ?>

</body>
</html>
