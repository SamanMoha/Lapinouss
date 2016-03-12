<?php include '../_layout/header.php'; ?>

   <div class="grid_4">
		<div class="container">
		  <div class="comments-area">
			<h3>Connecte toi !</h3>
			<form method="POST" action="<?php echo getAbsolutePath("views/account"); ?>">
				<p>
					<label>Adresse e-mail</label>
					<span>*</span>
					<input type="text" value="" required>
				</p>
				<p>
					<label>Mot de passe</label>
					<span>*</span>
					<input type="password" value="" required>
				</p>
				<p>
					<label class="btn1 btn2 btn-8 btn-8c"><input type="submit" value="Valider"></label>
				</p>
			</form>
			<br />
			<h4><a href="<?php echo getAbsolutePath("views/account/signup.php"); ?>">Pas encore de compte ?</a></h4>
		    </div>
		</div>
	</div>
	
<?php include '../_layout/footer.php'; ?>