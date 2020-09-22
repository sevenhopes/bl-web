<?php
/**
 * Template Name: ADMISSIONS Appt & Visit
 *
 * 예약 및 방문
 *
 * @package BridgeLight
 * @subpackage BridgeLight_MobileFirst
 * @since 2017 Child 1.0
 */

get_header(); ?>

<div id="appt-and-visit" class="">

	<div class="bl-page-header">
		<div class="bl-page-title">Appointment & Visit</div>
		<h1 class="bl-heading">예약 및 방문</h1>
	</div>

	<div class="bl-block">
		<div class="bl-block-header">
			<h2 class="bl-block-title">Make an appointment</h2>
		</div>

		<div class="bl-wrap">
			<ul>
				<li>Telephone/Fax : 033-243-5757 / 033-243-8484</li>
				<li>Business Hours : 2:00 pm ~ 9:00 pm, Mon to Fri</li>
				<li class="bl-ue">Make a reservation call before your visit, please.</li>
			</ul>
		</div>
	</div>

	<div class="bl-block">
		<div class="bl-block-header">
			<h2 class="bl-block-title">Location</h2>
		</div>

		<div class="bl-wrap">
			<h3>Address</h3>
			<ul>
				<li>Address : (24433) 534, Sports town-gil, Chuncheon-si, Gangwon-do</li>
				<!-- <li>지번명 : 강원도 춘천시 온의동 65-27</li> -->
			</ul>

			<h3>Map View</h3>
			<div class="bl-wrap-more">
				<div id="bl-map"></div>
			</div>

			<h3>Street View</h3>
			<div class="bl-wrap-more">
				<div id="bl-street"></div>
			</div>
		</div>
	</div>

</div>

<?php
get_footer();
