<?php
	$ant = $so_ant_sig["ant"];
	$sig = $so_ant_sig["sig"];
	$lnk_a = "ids=$ant[idsujeto]&ido=$ant[idobjeto]";
	$lnk_s = "ids=$sig[idsujeto]&ido=$sig[idobjeto]";
?>

<section class="panel panel-heading-transparent">						
	<header class="panel-heading">
		<h2 class="panel-title">
			<i class="fa fa-database"></i> |
			<strong >Otros sujetos-objetos</strong>
		</h2>
	</header>
	<div class="panel-body">
		<div class="col-md-6 col-sm-6 col-xs-12">
			<?php if( $ant != NULL ) { ?>
			<a href="actividad.php?<?php echo $lnk_a?>">
			<button type="button" class="mb-xs mt-xs mr-xs btn btn-default">
				<i class="fa fa-arrow-left"></i> 
				<?php echo $ant["nsujeto"]." / ".$ant["nobjeto"]; ?>
			</button>
			</a>
			<?php } ?>
		</div>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<?php if( $sig != NULL ) { ?>
			<a href="actividad.php?<?php echo $lnk_s?>">
			<button type="button" class="mb-xs mt-xs mr-xs btn btn-default">
				<?php echo $sig["nsujeto"]." / ".$sig["nobjeto"]; ?> 
				<i class="fa fa-arrow-right"></i>
			</button>
			</a>
			<?php } ?>
		</div>
	</div>
</section>