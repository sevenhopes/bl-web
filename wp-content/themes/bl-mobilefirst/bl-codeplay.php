<?php
/**
 * Template Name: codeplay
 *
 * 개발용 페이지
 *
 * @package BridgeLight
 * @subpackage BridgeLight_MobileFirst
 * @since 2017 Child 1.0
 */

$currentLocale = setlocale(LC_ALL, 0);
$currentLanguage = 'none';

if ( function_exists( 'pll_current_language' ) ) {
	$currentLanguage = pll_current_language();	// either ‘name’ or ‘locale’ or ‘slug’, defaults to ‘slug’
}

get_header(); ?>

<div class="wrap">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<div class="bl-block">
				<span><?php echo 'pll_lang = '.$currentLanguage; ?></span>
			</div>

			

			<!-- <h1>Naver Blog the Most Recent Post</h1> -->

			<!-- <form>
				<fieldset>
					<legend>블로그 RSS 파싱 테스트</legend>
					<?php
					// $rss = simplexml_load_file( 'http://rss.blog.naver.com/bomikimorr.xml' );

					function produce_XML_object_tree($raw_XML) {
						libxml_use_internal_errors(true);
						try {
							$xmlTree = new SimpleXMLElement($raw_XML);
						} catch (Exception $e) {
							// Something went wrong.
							$error_message = 'SimpleXMLElement threw an exception.';
							foreach(libxml_get_errors() as $error_line) {
								$error_message .= "\t" . $error_line->message;
							}
							trigger_error($error_message);
							return false;
						}
						return $xmlTree;
					}

					$xml_feed_url = 'http://rss.blog.naver.com/bomikimorr.xml';
					$ch = curl_init();
					curl_setopt($ch, CURLOPT_URL, $xml_feed_url);
					curl_setopt($ch, CURLOPT_HEADER, false);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					$xml = curl_exec($ch);
					curl_close($ch);

					$rss = produce_XML_object_tree($xml);

					if ($rss) :
					?>
					<h3><?php echo $rss->channel->title ?></h3>
					<ul>
						<?php
						foreach( $rss->channel->item as $chan ) {
							echo "<p>카테고리: [".$chan->category."]</p>";
							echo "<li>제목: <a href=\"".$chan->link."\">";
							echo $chan->title;
							echo "</a></li>\n";
							echo "<p>글 내용: [".$chan->description."]</p>";
							echo "<p>태그: ".$chan->tag."</p>";

							break;
						}
					endif;
						?>
					</ul>
				</fieldset> -->

		</main><!-- #main -->
	</div><!-- #primary -->
</div><!-- .wrap -->

<?php
get_footer();
