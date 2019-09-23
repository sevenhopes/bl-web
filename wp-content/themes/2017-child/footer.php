<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.2
 */

?>

		</div><!-- #content -->

		<div class="bl-share-layer">
			<div class="bl-share-box">
				<div class="title-container">
					<span class="title">공유하기</span>
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
								<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/icon-kakaolink.png"/>
								<div>카카오톡</div>
							</a>
						</div>
						<div>
							<a id="bl-share-facebook" href="http://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>">
								<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/icon-fb.png"/>
								<div>페이스북</div>
							</a>
						</div>
						<div id="bl-copy-page-url">
							<a href="">
								<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/icb-urlcopy.png"/>
								<div>현재 페이지</div>
							</a>
						</div>
						<div id="bl-copy-home-url">
							<a href="">
								<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/icb-urlhomecopy.png"/>
								<div>웹사이트 홈</div>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>

		<footer id="colophon" class="site-footer" role="contentinfo">
			<div class="wrap">

				<div id="bl-social-links">
					<div><a href="http://blog.naver.com/blcorp" target="_blank"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/icon-blog.png" alt="브릿지라잇 블로그" />블로그</a></div>
					<div><a href="http://blog.naver.com/bomikimorr" target="_blank"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/icon-inside.png" alt="브릿지라잇 인사이드" />인사이드</a></div>
					<div><a href="https://www.facebook.com/bridgelightels/" target="_blank"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/icon-fb.png" alt="브릿지라잇 페이스북" />페이스북</a></div>
				</div>

				<ul>
					<li>방문·상담 전 전화예약 필수</li>
					<li>전화 033-243-5757, 8484</li>
					<!-- <li>전화 <a href="tel:033-243-5757">033-243-5757</a>, <a href="tel:033-243-8484">8484</a></li> -->
					<li>팩스 033-243-8484</li>
					<li>평일 오후 2:00 ~ 9:00</li>
					<li>주말, 공휴일 휴무</li>
					<li>24433 강원도 춘천시 스포츠타운길 534 (온의동)</li>
					<li>춘천교육지원청 등록 제907호 브릿지라잇 어학원</li>
					<li>사업자등록번호 221-81-37802</li>
					<li>개인정보취급방침</li>
					<li>이메일무단수집거부</li>
					<li>ⓒ 브릿지라잇 2006-<?php echo date("Y"); ?></li>
				</ul>

				<div class="bl-footer-logo">
				</div>

			</div><!-- .wrap -->
		</footer><!-- #colophon -->
	</div><!-- .site-content-contain -->
</div><!-- #page -->
<?php wp_footer(); ?>

</body>
</html>
