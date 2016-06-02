   <div class="grid_4">
		<div class="container">
		  <div class="comments-area">
			<h3>Connecte toi !</h3>
			<form method="POST" action="<?php echo action('account', 'login'); ?>">
				<p>
					<label>Adresse e-mail</label>
					<span>*</span>
					<input type="text" name="email" value="" required>
				</p>
				<p>
					<label>Mot de passe</label>
					<span>*</span>
					<input type="password" name="password" value="" required>
				</p>
				<p>
					<label class="btn1 btn2 btn-8 btn-8c"><input type="submit" name="login" value="Valider"></label>
				</p>
			</form>
			<br />
			<h4><a href="<?php echo action('account', 'register'); ?>">Pas encore de compte ?</a></h4>
		    </div>
		</div>
	</div>