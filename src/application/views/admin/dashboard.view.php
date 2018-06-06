<!-- <h2 class="page-header">Dashboard</h2> -->
<div class="row">
<?php
	create_panel("teal", "user", $data['jmlmember'], "Jumlah Member");
	create_panel("blue", "gift", $data['jmlproduk'], "Jumlah Produk");
	create_panel("orange", "shopping-cart", $data['jmltransaksi'], "Jumlah Transaksi");
	create_panel("red", "envelope", $data['jmlpesan'], "Pesan");
?>
</div>

<?php start_content(); ?>
	<h3 class="page-header">Statistik</h3>
	<div class="canvas-wrapper">
		<canvas id="line-chart" height="150" width="600"></canvas>
	</div>
<?php end_content(); ?>
<?php
/*
	<script type="text/javascript">
		$(function() {
			// pengaturan chart
			var lineChartData = {
				labels: ?= json_encode($data['namabulan']); ?>,
				datasets : [{
					fillColor: "rgba(48, 164, 255, 0.2)",
					strokeColor: "rgba(48, 164, 255, 1)",
					pointColor: "rgba(48, 164, 255, 1)",
					pointStrokeColor: "#fff",
					pointHighlightFill: "#fff",
					pointHighlightStroke: "rgba(48, 164, 255, 1)",
					data: <?= json_encode($data['data']); ?>
				}]
			}

			var chart = document.getElemetById("line-chart").getContext("2d");
			window.myLine = new Chart(chart).Line(lineChartData, {responsive: true});
		});
	</script>
*/
?>