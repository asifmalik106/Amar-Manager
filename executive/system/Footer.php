<footer>
    <script src="<?php echo BASE_URL; ?>asset/js/jquery.min.js"></script>
	<script src="<?php echo BASE_URL; ?>asset/bootstrap/js/bootstrap.min.js"></script>
	<script src="<?php echo BASE_URL; ?>asset/js/metisMenu.min.js"></script>
	<script src="<?php echo BASE_URL; ?>asset/js/sb-admin-2.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.4/sweetalert2.min.js"></script>
	<?php
		if(isset($data['js'])){
			foreach ($data['js'] as $js) {
				echo '<script type="text/javascript" src="'.BASE_URL.'asset/'.$js.'"></script>';
			}
		}
	?>
</footer>