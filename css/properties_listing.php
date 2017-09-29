<style>
	.stickyWrap .sortingc.asc:before{
		background-image: url("<?php echo get_template_directory_uri(); ?>/images/sort-up.png");
		background-repeat: no-repeat;
		background-size: 100% 100%;
		bottom: 0;
		content: "";
		height: 21px;
		left: -51px;
		margin: auto;
		position: absolute;
		right: 0;
		top: 0;
		width: 21px;
	}
	.stickyWrap .sortingc.desc:before{
		background-image: url("<?php echo get_template_directory_uri(); ?>/images/sort-down.png");
		background-repeat: no-repeat;
		background-size: 100% 100%;
		bottom: 0;
		content: "";
		height: 21px;
		left: -51px;
		margin: auto;
		position: absolute;
		right: 0;
		top: 0;
		width: 21px;
	}
	.funkyradio::before {
		background-image: url("<?php echo get_template_directory_uri(); ?>/images/DropArrow.png");
		background-size: cover;
		color: #ffffff;
		/* content: "?"; */
		content: "";
		font-family: fontawesome;
		font-size: 34px;
		height: 12px;
		left: 0;
		line-height: 4px;
		margin: auto;
		position: absolute;
		right: 0;
		top: -12px;
		width: 25px;
	}
</style>