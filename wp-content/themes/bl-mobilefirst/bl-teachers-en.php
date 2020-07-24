<?php
/**
 * Template Name: ABOUT Teachers
 *
 * 강사진
 *
 * @package BridgeLight
 * @subpackage BridgeLight_MobileFirst
 * @since 2017 Child 1.0
 */

get_header(); ?>

<?php
class Teacher {
	public $cssclass, $name, $title, $pos, $charge, $ext;
	function __construct( $cssclass, $title, $name, $charge = array("Basic Program"), $pos = "Teacher", $ext = "" ) {
		$this->cssclass = $cssclass;
		$this->title = $title;
		$this->name = $name;
		$this->charge = $charge;
		$this->pos = $pos;
		$this->ext = $ext;
	}
}
$teachers = array(
	new Teacher( "t-david",		"Principal David Orr", "David Orr", array("Stage Program"), "Principal & Founder" ),
	new Teacher( "t-bomi",		"Vice Principal Bomi Orr", "Bomi K. Orr", array("Basic Program", "Stage Program"), "Vice Principal & Founder" ),
	new Teacher( "t-yoomi",		"General Manager Yoomi Kim", "Yoomi Kim", array("Enrollment Consultation", "Basic Program"), "General Manager" ),
	new Teacher( "t-peter", 	"Teacher Sang In Lee (Peter)", "Sang In Lee 'Peter'", array("Stage Program", "Special Program"), "Team Leader" ),
	new Teacher( "t-dean",		"Teacher Young Ho Yoon (Dean)", "Young Ho Yoon 'Dean'", array("Stage Program"), "Team Leader" ),
	new Teacher( "t-ethan", 	"PR/HR/IT Manager Hyeoksoo Lee (Ethan)", "Hyeoksoo Lee 'Ethan'", array("IT, PR, HR"), "IT Manager" ),
	new Teacher( "t-eunji", 	"Assistant Manager Eunji Lee", "Eunji Lee", array("Faculty Assist"), "Team Leader" ),
	new Teacher( "t-rachel",	"Teacher Yeong Jin Hahm (Rachel)","Yeong Jin Hahm 'Rachel'" ),
	new Teacher( "t-semie",		"Teacher Seung Mee Kim (Semie)",	"Seung Mee Kim 'Semie'" ),
	new Teacher( "t-angela",	"Teacher Yoon Hee Kim (Angela)","Yoon Hee Kim  'Angela'", array("Stage Program") ),
	new Teacher( "t-jamie",		"Teacher Jin Hee Park (Jamie)",	"Jin Hee Park 'Jamie'" ),
	new Teacher( "t-elena",		"Teacher Haeryn Jeong (Elena)",	"Haeryn Jeong 'Elena'" ),
	new Teacher( "t-sheldon",	"Teacher Sheldon Weingust",	"Sheldon Weingust" ),
	new Teacher( "t-finn",		"Teacher Finn Skilton", "Finn Skilton", array("Stage Program", "Basic Program") ),
	new Teacher( "t-irene",		"Teacher Yun Ju Yun (Irene)",	"Yun Ju Yun 'Irene'" ),
	new Teacher( "t-julia",		"Teacher Ji Hyang Kim (Julia)",	"Ji Hyang Kim 'Julia'" ),
	new Teacher( "t-scarlett","Teacher Ji Hyun Lee (Scarlett)",	"Ji Hyun Lee 'Scarlett'" ),
	new Teacher( "t-jessy",		"Teacher Seon Jeong Yang (Jessy)", "Seon Jeong Yang 'Jessy'" ),
	new Teacher( "t-yunah",		"Teacher Yun Ah Lee (Yunah)", "Yun Ah Lee 'Yunah'" ),
	new Teacher( "t-eva",			"Teacher Yeon Ju Lim (Eva)",		"Yeon Ju Lim 'Eva'" ),
	new Teacher( "t-judy",		"Consulting Manager Nae Won Kwak (Judy)",	"Nae Won Kwak 'Judy'", array("General Consultation", "Reception"), "Consulting Manager" )
);
?>

<div id="teachers" class="">

	<div class="bl-page-header">
		<div class="bl-page-title">Teachers</div>
		<h1 class="bl-heading">강사진</h1>
	</div>

	<div class="bl-block">
		<div class="bl-wrap-more">

			<?php
			foreach ($teachers as $t) :
			?>

			<div class="bl-t-profile">
				<div class="bl-t-pic">
					<i class="t-bl-sp <?php echo $t->cssclass ?>" title="<?php echo $t->title ?>"></i>
				</div>
				<div class="bl-t-info">
					<span class="bl-t-name" <?php echo $t->ext ?>><?php echo $t->name ?></span>
					<span class="bl-t-position" <?php echo $t->ext ?>><?php echo $t->pos ?></span>
					<?php
					foreach( $t->charge as $ch) :
					?>
						<span class="bl-t-charge"><?php echo $ch ?></span>
					<?php
					endforeach;
					?>
				</div>
			</div>

			<?php
			endforeach;
			?>

		</div>
	</div>

</div>

<?php
get_footer();
