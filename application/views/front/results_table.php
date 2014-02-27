<div id="table" class="section col-md-12">

	<h2 class="sub-header">Tabla de Amortizacion</h2>
		<div class="table-responsive">
		<table class="table table-striped">
			<thead>
				<th>Nº</th>
				<th>Saldo Inicial</th>
				<th>Interes</th>
				<th>Cuota</th>
				<th>Amortizacion</th>
				<th>Gastos Periodicos</th>
				<th>Recompra</th>
				<th>Saldo Final</th>
				<th>Depreciacion</th>
				<th>Ahorro Tributario</th>
				<th>IGV</th>
				<th>Flujo Bruto</th>
				<th>Flujo con IGV</th>
				<th>Flujo Neto</th>
			</thead>
			<tbody>
				<?php foreach($reporte as $row): ?>
				<tr>
					<td><?php echo $row['periodo'] ?></td>
					<td><?php echo $row['saldoInicial'] ?></td>
					<td><?php echo $row['interes'] ?></td>
					<td><?php echo $row['cuota'] ?></td>
					<td><?php echo $row['amortizacion'] ?></td>
					<td><?php echo $row['gastosPeriodicos'] ?></td>
					<td><?php echo $row['recompra'] ?></td>
					<td><?php echo $row['saldoFinal'] ?></td>
					<td><?php echo $row['depreciacion'] ?></td>
					<td><?php echo $row['ahorroTributario'] ?></td>
					<td><?php echo $row['igv'] ?></td>
					<td><?php echo $row['flujoBruto'] ?></td>
					<td><?php echo $row['flujo'] ?></td>
					<td><?php echo $row['flujoNeto'] ?></td>
				</tr>
				<?php endforeach ?>
			</tbody>
		</table>
	</div>

</div>