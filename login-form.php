<?php
/*
If you would like to edit this file, copy it to your current theme's directory and edit it there.
Theme My Login will always look in your theme's directory first, before using this default template.
*/
wp_redirect(site_url().'/?au=login');
?>
<section class="wp_login_form">
	<div class="contanror">
	<div class="tml tml-login" id="theme-my-login<?php $template->the_instance(); ?>">
	<?php //$template->the_action_template_message( 'login' ); ?>
	<?php $template->the_errors(); ?>
	<form name="loginform" id="loginform<?php $template->the_instance(); ?>" action="<?php $template->the_action_url( 'login', 'login_post' ); ?>" method="post">
		<p class="tml-user-login-wrap">
			<label for="user_login<?php $template->the_instance(); ?>"><?php
				if ( 'username' == $theme_my_login->get_option( 'login_type' ) ) {
					_e( 'Username', 'theme-my-login' );
				} elseif ( 'email' == $theme_my_login->get_option( 'login_type' ) ) {
					_e( 'E-mail', 'theme-my-login' );
				} else {
					_e( 'Username or E-mail', 'theme-my-login' );
				}
			?></label>
			<input type="text" name="log" id="user_login<?php $template->the_instance(); ?>" class="input" value="<?php $template->the_posted_value( 'log' ); ?>" size="20" />
		</p>

		<p class="tml-user-pass-wrap">
			<label for="user_pass<?php $template->the_instance(); ?>"><?php _e( 'Password', 'theme-my-login' ); ?></label>
			<input type="password" name="pwd" id="user_pass<?php $template->the_instance(); ?>" class="input" value="" size="20" autocomplete="off" />
		</p>

		<?php do_action( 'login_form' ); ?>

		<div class="tml-rememberme-submit-wrap">
			<p class="tml-rememberme-wrap">
				<input name="rememberme" type="checkbox" id="rememberme<?php $template->the_instance(); ?>" value="forever" />
				<label for="rememberme<?php $template->the_instance(); ?>"><?php esc_attr_e( 'Remember Me', 'theme-my-login' ); ?></label>
			</p>
				<input type="hidden" name="redirect_to" value="<?php $template->the_redirect_url( 'login' ); ?>" />
				<input type="hidden" name="instance" value="<?php $template->the_instance(); ?>" />
				<input type="hidden" name="action" value="login" />
		</div>
		<div class="login_submit">	
			<input type="submit" name="wp-submit" id="wp-submit<?php $template->the_instance(); ?>" value="<?php esc_attr_e( 'Login', 'theme-my-login' ); ?>" />
		</div>
	</form>
	<?php //$template->the_action_links( array( 'login' => false ) ); ?>
</div>
	</div>
</section>	


<script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.min.js"></script>
<script>
jQuery(document).ready(function($) {
    var userlogin = "Please enter your login email address";
    var userpass = "Please enter your login password";
    $('#theme-my-login #loginform').validate({
        onfocusout: function(element) {
            this.element(element);
        },
        rules: {
            log: {
         //   email : true,
			required: true,
            },
            pwd: {
                required: true,
            },
        },
        messages: {
          //  log: userlogin,
           // pwd: userpass,
        },
        errorElement: "div",
        errorPlacement: function(error, element) {
            element.after(error);
        }
    });
});
</script>