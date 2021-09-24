<?php 

// OVERRIDE POSTED_ON FUNCTION

function sitepoint_base_posted_on() {
	$post_icon = '';
	switch ( get_post_format() ) {
		case 'aside':
			$post_icon = 'fa-file-o';
			break;
		case 'audio':
			$post_icon = 'fa-volume-up';
			break;
		case 'chat':
			$post_icon = 'fa-comment';
			break;
		case 'gallery':
			$post_icon = 'fa-camera';
			break;
		case 'image':
			$post_icon = 'fa-picture-o';
			break;
		case 'link':
			$post_icon = 'fa-link';
			break;
		case 'quote':
			$post_icon = 'fa-quote-left';
			break;
		case 'status':
			$post_icon = 'fa-user';
			break;
		case 'video':
			$post_icon = 'fa-video-camera';
			break;
		default:
			$post_icon = 'fa-calendar';
			break;
	}

	// Translators: 1: Icon 2: Permalink 3: Post date and time 4: Publish date in ISO format 5: Post date
	$date = sprintf( '<span class="publish-date"><i class="fa %1$s" aria-hidden="true"></i> <a href="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s" itemprop="datePublished">%4$s</time></a></span>',
		$post_icon,
		esc_url( get_permalink() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() )
	);

	// Translators: 1: Date link 2: Author link 3: Categories 4: No. of Comments
	$author = sprintf( '<span class="publish-author"><i class="fa fa-pencil" aria-hidden="true"></i> <address class="author vcard"><a class="url fn n" href="%1$s" rel="author">%2$s</a></address></span>',
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		get_the_author()
	);

	// Return the Categories as a list
	$categories_list = get_the_category_list( esc_html__( ' ', 'sitepoint-base' ) );

	// Translators: 1: Permalink 2: Title 3: No. of Comments
	$comments = sprintf( '<span class="comments-link"><i class="fa fa-comment" aria-hidden="true"></i> <a href="%1$s">%2$s</a></span>',
		esc_url( get_comments_link() ),
		( get_comments_number() > 0 ? sprintf( _n( '%1$s Comment', '%1$s Comments', get_comments_number(), 'sitepoint-base' ), get_comments_number() ) : esc_html__( 'No Comments', 'sitepoint-base' ) )
	);

	
	
	
	
	
	// SEED STAT PRO
	// DOCS: https://docs.seedwebs.com/article/95-seed-stat-pro
	
	$seed_stat_pro = do_shortcode('[s_stat icon="graph" style="format"]');

	// Translators: 1: Date 2: Author 3: Categories 4: SEED STAT PRO 5: Comments
	printf( wp_kses( __( '<div class="header-meta">%1$s%2$s<span class="post-categories">%3$s</span>&nbsp; %4$s%5$s</div>', 'sitepoint-base' ), array(
		'div' => array (
			'class' => array() ),
		'span' => array(
			'class' => array() ) ) ),
		$date,
		$author,
		$categories_list,
		$seed_stat_pro,
		( is_search() ? '' : $comments )
	);
}