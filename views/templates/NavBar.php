<!-- INICIO Nav lateral -->
<section class="full-box nav-lateral">
	<div class="full-box nav-lateral-bg show-nav-lateral"></div>
	<div class="full-box nav-lateral-content">
		<figure class="full-box nav-lateral-avatar">
			<i class="far fa-times-circle show-nav-lateral"></i>
			<img src="../assets/images/Avatar.png" class="img-fluid" alt="Avatar">
			<figcaption class="roboto-medium text-center">
				<?php echo $_SESSION['nombre_usuario']?>
				<br>
				<small class="roboto-condensed-light"><?php echo $_SESSION['sede']?></small>
			</figcaption>
		</figure>
		<div class="full-box nav-lateral-bar"></div>
		<nav class="full-box nav-lateral-menu">
			<ul>
				<li>
					<a href="<?php echo BASE_URL . 'inicio/'; ?>"><i class="fab fa-dashcube fa-fw"></i> &nbsp; Inicio</a>
				</li>
				<ul>
					<li class="menu-item" data-menu="3">
						<a href="<?php echo BASE_URL . 'inicio/proveidos'; ?>"><i class="fas fa-users fa-fw"></i> &nbsp; Proveídos</a>
					</li>
				</ul>
				<ul>
					<li class="menu-item" data-menu="4">
						<a href="<?php echo BASE_URL . 'inicio/listaEvaluacion'; ?>"><i class="fas fa-pallet fa-fw"></i> &nbsp; Evaluacion</a>
					</li>
				</ul>
					<li class="menu-item" data-menu="5">
						<a href="<?php echo BASE_URL . 'inicio/controlJuicios'; ?>"><i class="fas fa-balance-scale"></i> &nbsp; Control de Citaciones</a>
					</li>
					<li class="menu-item" data-menu="6">
						<a href="<?php echo BASE_URL . 'inicio/controlDictamenes'; ?>"><i class="fas fa-copy"></i> &nbsp; Control de Dictamenes</a>
					</li>
				<ul>
					<li class="menu-item" data-menu="7">
						<a href="<?php echo BASE_URL . 'inicio/evaluacionCasos'; ?>"><i class="fas fa-exchange-alt"></i> &nbsp; Revision de Casos</a>
					</li>
				</ul>
					<li >
						<a href="#" class="nav-btn-submenu menu-item" data-menu="9"><i class="fas fa-store-alt fa-fw"></i> &nbsp; Administracion <i class="fas fa-chevron-down"></i></a>
							<ul>
								<li class="menu-item" data-menu="8">
									<a href="<?php echo BASE_URL . 'inicio/sedes'; ?>"><i class="fas fa-clinic-medical"></i> &nbsp; Sedes</a>
								</li>
								<li class="menu-item" data-menu="9">
									<a href="<?php echo BASE_URL . 'inicio/personal'; ?>"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; Personal</a>
								</li>
								<li class="menu-item" data-menu="10">
									<a href="<?php echo BASE_URL . 'inicio/controlVacaciones'; ?>"><i class="fas fa-calendar-week"></i> &nbsp; Vacaciones</a>
								</li>
								<li class="menu-item" data-menu="2">
									<a href="<?php echo BASE_URL . 'inicio/sexos'; ?>"><i class="fas fa-venus-mars"></i> &nbsp; Sexo</a>
								</li>
								<li class="menu-item" data-menu="11">
									<a href="<?php echo BASE_URL . 'inicio/puestos'; ?>"><i class="fas fa-user-tie"></i> &nbsp; Puesto</a>
								</li>
								<li class="menu-item" data-menu="16">
									<a href="<?php echo BASE_URL . 'inicio/fiscalias'; ?>"><i class="fas fa-landmark"></i> &nbsp; Fiscalias</a>
								</li>
								<li class="menu-item" data-menu="12">
									<a href="<?php echo BASE_URL . 'inicio/reconocimientos'; ?>"><i class="fas fa-calendar-week"></i> &nbsp; Reconocimientos</a>
								</li>
								<li class="menu-item" data-menu="13">
									<a href="<?php echo BASE_URL . 'inicio/modulos'; ?>"><i class="fas fa-th-large"></i> &nbsp; Modulos</a>
								</li>
								<li class="menu-item" data-menu="14">
									<a href="<?php echo BASE_URL . 'inicio/permisos'; ?>"><i class="fas fa-user-shield"></i> &nbsp; Permisos</a>
								</li>
								<li>
									<a href="<?php echo BASE_URL . 'inicio/bitacora'; ?>"><i class="fas fa-list"></i> &nbsp; Bitácora</a>
								</li>
							</ul>
					</li>
				<li class="menu-item" data-menu="17">
					<a href="<?php echo BASE_URL . 'inicio/plantillas'; ?>"><i class="fas fa-save"></i> &nbsp; Plantillas </a>
				</li>
				<li class="menu-item" data-menu="18">
					<a href="<?php echo BASE_URL . 'inicio/reportes'; ?>"><i class="fas fa-poll-h"></i> &nbsp; Reportes </a>
				</li>
			</ul>
		</nav>
	</div>
</section>

<script>
	document.addEventListener('DOMContentLoaded', function() {
		const permisos = <?php echo json_encode($_SESSION['permisos_pantallas']); ?>;

		// Oculta elementos que no están en los permisos del usuario
		document.querySelectorAll('.menu-item').forEach(item => {
			let menuId = parseInt(item.getAttribute('data-menu')); 
			let tienePermiso = permisos.some(permiso => permiso.id_modulo === menuId); 
			
			if (!tienePermiso) {
				item.style.display = 'none'; 
			}
		});
	});

</script>