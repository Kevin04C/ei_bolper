<div class="banner">
	<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
		<!-- Indicators -->
		<ol class="carousel-indicators">
			<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
			<li data-target="#carousel-example-generic" data-slide-to="1"></li>
			<li data-target="#carousel-example-generic" data-slide-to="2"></li>
		</ol>

		<!-- Wrapper for slides -->
		<div class="carousel-inner" role="listbox">
			<div class="item active">
				<img src="<?= $this->Url->build("/img/banner/img-1.jpeg", ['fullBase' => true]) ?>" class="d-block w-100" alt="...">
				<div class="carousel-caption">
					<a href="http://localhost/ei_bolper_final/productos?q=" class="btn btn-saber-mas"> Saber mas</a>
				</div>
			</div>
			<div class="item">
				<img src="<?= $this->Url->build("/img/banner/img-2.jpg", ['fullBase' => true]) ?>" class="d-block w-100" alt="...">
				<div class="carousel-caption">
					<a href="http://localhost/ei_bolper_final/productos?q=" class="btn btn-saber-mas"> Saber mas</a>
				</div>
			</div>
			<div class="item">
				<img src="<?= $this->Url->build("/img/banner/img-3.png", ['fullBase' => true]) ?>" class="d-block w-100" alt="...">
				<div class="carousel-caption">
					<a href="http://localhost/ei_bolper_final/productos?q=" class="btn btn-saber-mas"> Saber mas</a>
				</div>
			</div>
		</div>

		<!-- Controls -->
		<a class="left carousel-control" style="display: flex; align-items:center; justify-content:center" href="#carousel-example-generic" role="button" data-slide="prev">
			<i class="fa fa-chevron-left"></i>
			<span class="sr-only">Previous</span>
		</a>
		<a class="right carousel-control" style="display: flex; align-items:center; justify-content:center" href="#carousel-example-generic" role="button" data-slide="next">
			<i class="fa fa-chevron-right"></i>
			<span class="sr-only">Next</span>
		</a>
	</div>
</div>

<!-- /SECTION -->
<!-- SECTION -->
<div class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">

			<!-- section title -->
			<div class="col-md-12">
				<div class="section-title">
					<h3 class="title">Productos</h3>
					<div class="section-nav">
					</div>
				</div>
			</div>
			<!-- /section title -->

			<!-- Products tab & slick -->
			<div class="col-md-12">
				<div class="row">
					<div class="products-tabs">
						<!-- tab -->
						<div id="tab1" class="tab-pane active">
							<div class="products-slick" data-nav="#slick-nav-1">
								<?php foreach ($productos_nuevos as $prod) : ?>
									<!-- product -->
									<div class="product">
										<div class="product-img">
											<img src="<?= $this->Url->build("/" . $prod->imagen1); ?>" alt="">

											<div class="product-label">
												<?php if ($prod->cantidad > 0) : ?>
													<span class='sale'>
														<?= $prod->cantidad . " unidad(es)" ?>
													</span>
												<?php else : ?>
													<span class='new'><?= 'Sin Stock' ?></span>
												<?php endif; ?>

											</div>
										</div>
										<div class="product-body">
											<p class="product-category"> <?= $prod->categorium ? $prod->categorium->nom_categoria : 'Sin categoria' ?> </p>
											<h3 class="product-name" title="<?= $prod->nom_producto ?>"><a href="<?= $this->Url->build(['action' => 'detalle-producto', $prod->id . '-' . getSlugFromNom_producto($prod->nom_producto)]) ?>"> <?= $prod->nom_producto ?> </a></h3>
											<h4 class="product-price">
												<!-- <?= $prod->desc_producto ?> <del class="product-old-price"> <?= $prod->precio_producto ?> </del> -->
												<?php if ($oferta_activa) : ?>
													S/. <?= $prod->precio_producto ?> <del class="product-old-price"> S/. <?= $prod->desc_producto ?> </del>
												<?php else : ?>
													S/. <?= $prod->precio_producto ?>
												<?php endif; ?>
											</h4>

											<div class="product-btns">
												<a class="quick-view" href="<?= $this->Url->build(['action' => 'detalle-producto', $prod->id . '-' . getSlugFromNom_producto($prod->nom_producto)]) ?>">
													<i class="fa fa-eye"></i><span class="tooltipp">Detalle del Producto</span>
												</a>
											</div>
										</div>
										<?php if ($prod->cantidad > 0) : ?>
											<div class="add-to-cart">
												<button class="add-to-cart-btn" onclick="Carrito.agregarProducto(<?= $prod->id ?>)"><i class="fa fa-shopping-cart"></i> agregar al carrito</button>
											</div>
										<?php endif; ?>
									</div>
									<!-- /product -->
								<?php endforeach; ?>
							</div>
							<div id="slick-nav-1" class="products-slick-nav"></div>
						</div>
						<!-- /tab -->
					</div>
				</div>
			</div>
			<!-- Products tab & slick -->
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /SECTION -->

<!-- HOT DEAL SECTION -->




<!-- SECTION -->

<!-- /SECTION -->

<!-- NEWSLETTER -->
<div id="newsletter" class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">
			<div class="col-md-12">
				<div class="newsletter">
					<p>Encu&eacute;ntranos en nuestras <strong>Redes sociales</strong></p>

					<ul class="newsletter-follow">
						<li>
							<a href="https://www.facebook.com/share/gw5X7vTdxdY9gFww/?mibextid=qi2Omg " target="_blank"><i class="fa fa-facebook"></i></a>
						</li>

						<li>
							<a href="#" target="_blank"><i class="fa fa-instagram"></i></a>
						</li>
						<li>
							<a href="#" target="_blank"><i class="fa fa-hand-peace-o"></i></a>
						</li>

					</ul>
				</div>
			</div>
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /NEWSLETTER -->

<?= $this->Html->scriptBlock("var fecha_oferta = '" .  $fecha_oferta . "'"); ?>
<?php if ($imagen_promocion != '' && file_exists(WWW_ROOT . $imagen_promocion)) : ?>
	<div class="modal" id="modal_promocion" tabindex="-1">
		<div class="modal-dialog">
			<div class="modal-content">

				<div class="modal-header text-right">

					<i class="fa fa-close" onclick="cerrarModal()" style="cursor:pointer"></i>
				</div>
				<div class="modal-header text-left">
					<center><?= $texto_promocion ?></center>
					<style>
						.parrafo1 {
							font-family: 'Bruno Ace SC', cursive;
							text-transform: uppercase;
							font-weight: bold;
						}
					</style>
				</div>
				<div class="modal-body">

					<img src="<?= $this->Url->build("/" . $imagen_promocion) ?>" style="object-fit: contain; width:100%" />
				</div>
			</div>
		</div>
	</div>
<?php endif; ?>
<?php
function getSlugFromNom_producto($nombre_producto)
{
	if ($nombre_producto <> null) {
		$txt = mb_convert_case($nombre_producto, MB_CASE_LOWER);
		$txt = str_replace(" ", "-", $txt);
		return $txt;
	} else {
		return $nombre_producto;
	}
}

?>