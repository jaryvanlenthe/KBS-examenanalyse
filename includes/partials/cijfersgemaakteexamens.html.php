<?php 
$examencijferresultaten = getAllExamResultsWithNterm($_SESSION['gebruiker_id']);
if(empty($examencijferresultaten)){
	echo"Er zijn nog geen resultaten ingevoerd, klik <a class='button' href='/dashboard/examenresultatentoevoegen.php'>hier</a> om resultaten toe te voegen.";
} else {
?>
<script type="text/javascript">
$(function(aantalexamens) {

	
	var data = [
	<?php
	$examencijferresultaten = getAllExamResultsWithNterm($_SESSION['gebruiker_id']);
	foreach ($examencijferresultaten as $resultaat){
		$cijfer = $resultaat['examen_score']/$resultaat['maxscore'] * 9 + $resultaat['nterm'];
		echo '["	'.$resultaat['examenjaar'].' Tijdvak '.$resultaat['tijdvak'].'",'.$cijfer."],";
	}
	
	?>
	];
	$.plot("#examencijferresultaten", [ data ], {
		series: {
			bars: {
				show: true,
				barWidth: 0.9,
				align: "center"
			}
		},
		xaxis: {
			mode: "categories",
			tickLength: 0
		},
		yaxis: {
				min: 0,
				max: 10,
				ticks: 10
		}
	});
});
</script>
<style>

.examencijferresultaten-container {
	width: 100%;
	height: 300px;
}

.examencijferresultaten-placeholder {
	width: 100%;
	height: 90%;
	font-size: 10px;
	line-height: 1.0em;
}


</style>
<div id="content">

		<div class="examencijferresultaten-container">
			<div id="examencijferresultaten" class="examencijferresultaten-placeholder"></div>
		</div>

</div>

<?php
}
?>