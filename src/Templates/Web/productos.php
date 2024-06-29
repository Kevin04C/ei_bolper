<!-- SECTION -->
<div class="section">
	<!-- container -->
	<form id="form_filtros">
		<div class="container">
			<div>
				<input type="hidden" placeholder="Busque aquí" name="q" value="<?= $opt_search ?? '' ?>">
			</div>
			<!-- row -->
			<div class="row">
				<!-- ASIDE -->
				<div id="aside" class="col-md-3">
					<div class="aside">
						<h3 class="aside-title">Marcas</h3>
						<div class="checkbox-filter">
							<?php foreach ($lista_de_marcas as $marca) : ?>
								<div class='input-checkbox'>
									<?php
									$checked = '';
									if ($opt_marca == $marca->marca_producto) {
										$checked = 'checked';
									}
									?>
									<input type='checkbox' id='marca-<?= $marca->marca_producto ?>' class='filtro_input' name='opt_marca' value="<?= $marca->marca_producto ?>" <?= $checked ?>>
									<label for='marca-<?= $marca->marca_producto ?>'>
										<span></span>
										<?= $marca->marca_producto ?>
									</label>
								</div>
							<?php endforeach; ?>
						</div>
					</div>
					<!-- /aside Widget -->

					<!-- aside Widget -->
					<div class="aside">
						<h3 class="aside-title">Precios</h3>
						<div class="price-filter">
							<div id="price-slider"></div>
							<div class="input-number price-min">
								<input id="price-min" type="number" class='filtro_precio' name="opt_precio_ini">
								<span class="qty-up">+</span>
								<span class="qty-down">-</span>
							</div>
							<span>-</span>
							<div class="input-number price-max">
								<input id="price-max" type="number" class='filtro_precio' name="opt_precio_fin">
								<span class="qty-up">+</span>
								<span class="qty-down">-</span>
							</div>
						</div>
						<div style="padding-top:10px" class="text-center">
							<button class="button-subm"> Buscar productos </button>
						</div>
					</div>
					<!-- /aside Widget -->

					<!-- aside Widget -->
					<!-- /aside Widget -->

					<!-- ASIDE
					<div class="aside">
						<h3 class="aside-title">Top 3 Ventas</h3>
						<?php foreach ($productos_mas_vendidos as $v) : ?>
				
							<?php if ($v->producto) : ?>

								<div class="product-widget">
									<div class="product-img">
									<img src="<?= $this->Url->build("/" . $v->producto->imagen1); ?>" alt="">
								</div>
								<div class="product-body">
									<h3 class="product-name" title="<?= $v->producto->nom_producto ?>"><a href="<?= $this->Url->build(['action' => 'detalle-producto', $v->producto->id . '-' . getSlugFromNom_producto($producto->nom_producto)]) ?>" > <?= $v->producto->nom_producto ?> </a></h3>
									<h4 class="product-price"> 
										<?php if ($oferta_activa) : ?>
											S/. <?= $v->producto->precio_producto ?> <del class="product-old-price"> <?= $v->producto->desc_producto ?> </del>
										<?php else : ?>
											S/. <?= $v->producto->precio_producto ?>
										<?php endif; ?>
									</h4>
								</div>
							</div>
							<?php endif; ?>
					
						<?php endforeach; ?>
					</div>
					 -->
				</div>
				<!-- /ASIDE -->

				<!-- STORE -->
				<div id="store" class="col-md-9">
					<!-- store top filter -->
					<div class="store-filter clearfix">
						<div class="store-sort">
							<label>
								Ordenar por:
								<select class="input-select filtro_input" name="opt_order">
									<option value="">-</option>
									<option value="precio_bajo" <?= $opt_order == 'precio_bajo' ? 'selected' : '' ?>> Precio desde el mas bajo </option>
									<option value="precio_alto" <?= $opt_order == 'precio_alto' ? 'selected' : '' ?>> Precio desde el mas alto </option>
									<option value="alf_az" <?= $opt_order == 'alf_az' ? 'selected' : '' ?>> Alfabeticamente A-Z </option>
									<option value="alf_za" <?= $opt_order == 'alf_za' ? 'selected' : '' ?>> Alfabeticamente Z-A </option>
								</select>
							</label>

							<!-- <label>
								Show:
								<select class="input-select">
									<option value="0">20</option>
									<option value="1">50</option>
								</select>
							</label> -->
						</div>
						<!-- <ul class="store-grid">
							<li class="active"><i class="fa fa-th"></i></li>
							<li><a href="#"><i class="fa fa-th-list"></i></a></li>
						</ul> -->
					</div>
					<!-- /store top filter -->

					<!-- store products -->
					<div class="row">
						<!-- product -->
						<?php foreach ($lista_de_productos as $producto) : ?>
							<div class='col-md-4 col-xs-6'>
								<div class='product'>
									<div class='product-img'>
										<img src="<?= $this->Url->build("/" . $producto->imagen1); ?>" alt="">
										<div class='product-label'>
											<?php if ($producto->cantidad > 0) : ?>
												<span class='sale'>
													<?= $producto->cantidad . " Unidad(es)" ?>
												</span>
											<?php else : ?>
												<span class='new'>
													Sin Stock
												</span>
											<?php endif; ?>
										</div>
									</div>

									<div class='product-body'>

										<p class='product-category'> <?= $producto->marca_producto ?> </p>
										<h3 class='product-name' title="<?= $producto->nom_producto ?>">
											<a href="<?= $this->Url->build(['action' => 'detalle-producto', $producto->id . '-' . getSlugFromNom_producto($producto->nom_producto)]) ?>"><?= $producto->nom_producto ?></a>
										</h3>
										<h4 class='product-price'>
											<?php if ($oferta_activa) : ?>
												S/. <?= $producto->desc_producto ?> <del class="product-old-price"> <?= $producto->precio_producto ?> </del>
											<?php else : ?>
												S/. <?= $producto->precio_producto ?>
											<?php endif; ?>
											<!-- $ <?= number_format((float) $producto->desc_producto, 2) ?> <del class='product-old-price'>$ <?= number_format((float) $producto->precio_producto, 2) ?> </del> -->
										</h4>
										<!-- <div class='product-rating'>
												<i class='fa fa-star'></i>
												<i class='fa fa-star'></i>
												<i class='fa fa-star'></i>
												<i class='fa fa-star'></i>
												<i class='fa fa-star'></i>
											</div> -->
										<div class='product-btns'>
											<a class="quick-view" href="<?= $this->Url->build(['action' => 'detalle-producto', $producto->id]) ?>">
												<i class="fa fa-eye"></i><span class="tooltipp">Detalle del Producto</span>
											</a>
										</div>
									</div>
									<!-- si el stock es mayor que 0 entonces se muestra el boton -->
									<?php if ($producto->cantidad > 0) : ?>
										<div class='add-to-cart'>
											<button class="add-to-cart-btn" type="button" onclick="Carrito.agregarProducto(<?= $producto->id ?>)"><i class="fa fa-shopping-cart"></i> agregar al carrito</button>
										</div>
									<?php endif; ?>
								</div>
							</div>
							<div class='clearfix visible-sm visible-xs'></div>
						<?php endforeach; ?>
						<!-- /product -->

					</div>
					<!-- /store products -->

					<!-- store bottom filter -->
					<div class="store-filter clearfix" style="margin-top:80px;text-align:center">
						<?= $this->element('paginador') ?>
					</div>
					<!-- /store bottom filter -->
				</div>
				<!-- /STORE -->
			</div>
			<!-- /row -->
		</div>
	</form>
	<!-- /container -->
</div>
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
							<a href="https://api.whatsapp.com/send?phone=944195972&text=Empezar" target="_blank"><i class="fa fa-whatsapp"></i></a>
						</li>
						<li>
							<a href="https://www.instagram.com/datacenterperu.huaraz/" target="_blank"><i class="fa fa-instagram"></i></a>
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


<?= $this->Html->scriptBlock("var opt_precio_ini = '" .  $opt_precio_ini . "' , opt_precio_fin = '" . $opt_precio_fin . "'"); ?>
<?php
function getSlugFromNom_producto($nombre_producto)
{
	$txt = strtolower($nombre_producto);
	$txt = str_replace(" ", "-", $txt);
	return $txt;
}

?>