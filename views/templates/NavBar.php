<!-- INICIO Nav lateral -->
<section class="full-box nav-lateral">
	<div class="full-box nav-lateral-bg show-nav-lateral"></div>
	<div class="full-box nav-lateral-content">
		<figure class="full-box nav-lateral-avatar">
			<i class="far fa-times-circle show-nav-lateral"></i>
			<img src="../assets/images/Avatar.png" class="img-fluid" alt="Avatar">
			<figcaption class="roboto-medium text-center">
				DR. <?php echo $_SESSION['nombre_usuario']?><br><small class="roboto-condensed-light"><?php echo $_SESSION['sede']?></small>
			</figcaption>
		</figure>
		<div class="full-box nav-lateral-bar"></div>
		<nav class="full-box nav-lateral-menu">
			<ul>
				<li>
					<a href="<?php echo BASE_URL . 'inicio/'; ?>"><i class="fab fa-dashcube fa-fw"></i> &nbsp; Inicio</a>
				</li>
				<ul>
					<li>
					<a href="<?php echo BASE_URL . 'inicio/proveidos'; ?>"><i class="fas fa-users fa-fw"></i> &nbsp; Proveídos</a>
					</li>
				</ul>
				<ul>
					<li>
						<a href="<?php echo BASE_URL . 'inicio/listaEvaluacion'; ?>"><i class="fas fa-pallet fa-fw"></i> &nbsp; Evaluacion</a>
					</li>
				</ul>
				<li>
					<a href="<?php echo BASE_URL . 'inicio/controlJuicios'; ?>"><i class="fas fa-balance-scale"></i> &nbsp; Control de Citaciones</a>
				</li>
				<li>
					<a href="<?php echo BASE_URL . 'inicio/controlDictamenes'; ?>"><i class="fas fa-copy"></i> &nbsp; Control de Dictameness</a>
				</li>
				<ul>
					<li>
						<a href="<?php echo BASE_URL . 'inicio/evaluacionCasos'; ?>"><i class="fas fa-exchange-alt"></i> &nbsp; Revision de Casos</a>
					</li>
				</ul>
				<li>
					<a href="#" class="nav-btn-submenu"><i class="fas fa-clipboard-list"></i> &nbsp; Plantillas <i class="fas fa-chevron-down"></i></a>
					<ul>			
			
					</ul>
				</li>
				<li>
					<a href="#" class="nav-btn-submenu"><i class="fas fa-store-alt fa-fw"></i> &nbsp; Administracion <i class="fas fa-chevron-down"></i></a>
					<ul>
						<li>
							<a href="<?php echo BASE_URL . 'inicio/agregarsedes'; ?>"><i class="fas fa-clinic-medical"></i> &nbsp; Nuevas Sedes</a>
						</li>
						<li>
							<a href="<?php echo BASE_URL . 'inicio/personal'; ?>"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; Nuevo Personal</a>
						</li>
						<li>
							<a href="<?php echo BASE_URL . 'inicio/controlVacaciones'; ?>"><i class="fas fa-calendar-week"></i> &nbsp; vacaciones</a>
						</li>
						<li>
							<a href="<?php echo BASE_URL . 'inicio/sexos'; ?>"><i class="fas fa-calendar-week"></i> &nbsp; Sexo</a>
						</li>
						<li>
							<a href="<?php echo BASE_URL . 'inicio/puestos'; ?>"><i class="fas fa-calendar-week"></i> &nbsp; Puesto</a>
						</li>
					</ul>
				</li>
			</ul>
		</nav>
	</div>
</section>