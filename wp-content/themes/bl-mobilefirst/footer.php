<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package BridgeLight
 * @subpackage BridgeLight_MobileFirst
 * @since 1.0
 * @version 1.3
 */

$bl_pagedata = array(
	'share' => '공유하기',
	'kakao' => '카카오톡',
	'fb'    => '페이스북',
	'this'  => '현재 페이지',
	'home'  => '웹사이트 홈',
	'blog'  => '블로그',
	'inside'=> '인사이드',
	'appt'  => '방문·상담 전 전화예약 필수',
	'tel'   => '전화 033-243-5757',
	'fax'   => '팩스 033-243-8484',
	'w-day' => '평일 오후 2:00 ~ 9:00',
	'w-end' => '주말, 공휴일 휴무',
	'adrr'  => '24433 강원도 춘천시 스포츠타운길 534 (온의동)',
	'reg'   => '춘천교육지원청 등록 제907호 브릿지라잇 어학원',
	'corp'  => '사업자등록번호 221-81-37802',
	'privacy'=>'개인정보취급방침',
	// 'refusal'=>'이메일무단수집거부',
	'c-right'=>'ⓒ 브릿지라잇 2006-<?php echo date("Y"); ?>',
	'lang'   =>'English Website'
);

$bl_url_ko_cat = array( '/about/',       '/curriculum/',       '/admissions/',       '/news-n-events' );
$bl_url_en_cat = array( '/en/about-en/', '/en/curriculum-en/', '/en/admissions-en/', '/en/news-n-events-en' );
$bl_req_uri = $_SERVER['REQUEST_URI'];
$bl_lang_link = '/';

if ( $GLOBALS['pll_lang'] !== 'pll_ko' ) {
	$bl_pagedata['share'] = 'Share';
	$bl_pagedata['kakao'] = 'Kakaotalk';
	$bl_pagedata['fb']    = 'Facebook';
	$bl_pagedata['this']  = 'This page';
	$bl_pagedata['home']  = 'Main page';
	$bl_pagedata['blog']  = 'Blog';
	$bl_pagedata['inside']= 'Inside';
	$bl_pagedata['blog-t']= 'Bridge Light Blog';
	$bl_pagedata['inside-t']='Bridge Light Inside';
	$bl_pagedata['fb-t']  = 'Bridge Light Facebook';
	$bl_pagedata['appt']  = 'Reservation by Phone Necessary for Visiting';
	$bl_pagedata['tel']   = 'Tel. 033-243-5757';
	$bl_pagedata['fax']   = 'Fax 033-243-8484';
	$bl_pagedata['w-day'] = 'Open: Weekday 2:00PM ~ 9:00PM';
	$bl_pagedata['w-end'] = 'Close: Weekends & Holidays';
	$bl_pagedata['addr']  = '(24433) 534, Sports town-gil, Chuncheon-si, Gangwon-do';
	$bl_pagedata['reg']   = 'Chuncheon Office of Education No. 907';
	$bl_pagedata['corp']  = 'Business License 221-81-37802';
	$bl_pagedata['privacy']='Privacy Policy';
	// $bl_pagedata['refusal']='Refusal of Email Auto-collection';
	$bl_pagedata['c-right']='ⓒ Bridge Light Inc 2006-'.date("Y");
	$bl_pagedata['lang']   ='한국어 웹사이트';

	// if ( $bl_req_uri == '/en/' ) {
	// 	$bl_lang_link = '/';
	// } else {
	// 	$bl_lang_link = str_replace( $bl_url_en_cat, $bl_url_ko_cat, $bl_req_uri );
	// }
	$bl_lang_link = $bl_req_uri == '/en/' ? '/' : str_replace( $bl_url_en_cat, $bl_url_ko_cat, $bl_req_uri );
} else {
	// if ( $bl_req_uri == '/' ) {
	// 	$bl_lang_link = '/en/';
	// } else {
	// 	$bl_lang_link = str_replace( $bl_url_ko_cat, $bl_url_en_cat, $bl_req_uri );
	// }
	$bl_lang_link = $bl_req_uri == '/' ? '/en/' : str_replace( $bl_url_ko_cat, $bl_url_en_cat, $bl_req_uri );
}
?>

		</div><!-- #content -->

		<div class="bl-share-layer">
			<div class="bl-share-box">
				<div class="title-container">
					<span class="title"><?php echo $bl_pagedata['share'] ?></span>
					<div id="bl-close-sharelayer">
						<a href="">
							<div class="bl-x-wrapper">
								<div class="icon-close"></div>
							</div>
						</a>
					</div>
				</div>
				<div class="container-wrap">
					<div class="button-container">
						<div>
							<a id="bl-share-kakao" href="javascript:;">
								<i class="bl-sp icon-kakaolink"></i>
								<div><?php echo $bl_pagedata['kakao'] ?></div>
							</a>
						</div>
						<div>
							<a id="bl-share-facebook" href="http://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>">
								<i class="bl-sp icon-fb-box"></i>
								<div><?php echo $bl_pagedata['fb'] ?></div>
							</a>
						</div>
						<div id="bl-copy-page-url">
							<a href="">
								<i class="bl-sp icb-urlcopy"></i>
								<div><?php echo $bl_pagedata['this'] ?></div>
							</a>
						</div>
						<div id="bl-copy-home-url">
							<a href="">
								<i class="bl-sp icb-urlhomecopy"></i>
								<div><?php echo $bl_pagedata['home'] ?></div>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>

		<footer id="colophon" class="site-footer" role="contentinfo">
			<div class="wrap">

				<div id="bl-social-links">
					<div><a href="http://blog.naver.com/blcorp" target="_blank"><i class="bl-sp icon-blog" title="<?php echo $bl_pagedata['blog-t'] ?>"></i><?php echo $bl_pagedata['blog'] ?></a></div>
					<div><a href="http://blog.naver.com/bomikimorr" target="_blank"><i class="bl-sp icon-inside" title="<?php echo $bl_pagedata['inside-t'] ?>"></i><?php echo $bl_pagedata['inside'] ?></a></div>
					<div><a href="https://www.facebook.com/bridgelightels/" target="_blank"><i class="bl-sp icon-fb" title="<?php echo $bl_pagedata['fb-t'] ?>"></i><?php echo $bl_pagedata['fb'] ?></a></div>
				</div>

				<ul>
					<li><?php echo $bl_pagedata['appt'] ?></li>
					<li><?php echo $bl_pagedata['tel'] ?></li>
					<li><?php echo $bl_pagedata['fax'] ?></li>
					<li><?php echo $bl_pagedata['w-day'] ?></li>
					<li><?php echo $bl_pagedata['w-end'] ?></li>
					<li><?php echo $bl_pagedata['addr'] ?></li>
					<li><?php echo $bl_pagedata['reg'] ?></li>
					<li><?php echo $bl_pagedata['corp'] ?></li>
					<li><?php echo $bl_pagedata['privacy'] ?></li>
					<!-- <li><?php echo $bl_pagedata['refusal'] ?></li> -->
					<li class="bl-lang mobile"><a href="<?php echo $bl_lang_link ?>"><?php echo $bl_pagedata['lang'] ?></a></li>
					<li><?php echo $bl_pagedata['c-right'] ?><span class="bl-lang widescreen"><a href="<?php echo $bl_lang_link ?>"><?php echo $bl_pagedata['lang'] ?></a></span></li>
				</ul>

				<!-- <div class="bl-footer-logo"></div> -->
				<svg class="bl-footer-logo" role="img">
					<use href="#svg-bl-logo" xlink:href="#svg-bl-logo"></use>
				</svg>
				<!-- <svg class="icon" style="width:50px;height:50px;" role="img"> -->
					<!-- <use href="#icon-search" xlink:href="#icon-search"></use> -->
					<!-- <use href="#bl-icon-close" xlink:href="#bl-icon-close"></use> -->
				<!-- </svg> -->

				<div class="bl-dev-code">
					<?php
						print_r( $_SERVER ); echo '<p></p>';
						// echo $_SERVER['HTTP_USER_AGENT'] . "<br>";
						// echo '<p>c-raw: '.$current_raw.'</p>';
						// echo '<p>w-raw: '.$weekago_raw.'</p>';
						// echo '<p>c-ymd: '.$current_ymd.'</p>';
						// echo '<p>w-ymd: '.$weekago_ymd.'</p>';
					// echo '<p>'.get_stylesheet_directory().'/inc/icon-functions.php'.'</p>';
					// echo '<p>'.get_stylesheet_directory_uri().'/assets/images/bl-svg-icons.svg'.'</p>';
					?>
				</div>

			</div><!-- .wrap -->
		</footer><!-- #colophon -->

	</div><!-- .site-content-contain -->
</div><!-- #page -->
<?php wp_footer(); ?>

</body>
</html>
