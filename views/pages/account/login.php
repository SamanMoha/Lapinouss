	<div class="row">

		<div class="col-sm-2"></div>

		<div class="col-md-3">
			<div class="container">
				<div class="comments-area">
					<h3>Vous &ecirc;tes un parent ?</h3>
					<form method="POST" action="<?php echo action('account', 'login'); ?>">
						<p>
							<label>Adresse e-mail</label>
							<span>*</span>
							<input type="email" name="email" placeholder="nom@domaine.com" required>
						</p>
						<p>
							<label>Mot de passe</label>
							<span>*</span>
							<input type="password" name="password" placeholder="Votre mot de passe" required>
						</p>
						<p>
							<label class="btn1 btn2 btn-8 btn-8c"><input type="submit" name="login-parent" value="Valider"></label>
						</p>
					</form>
					<br />
				</div>
			</div>
		</div>

		<div class="col-sm-2"></div>

		<div class="col-md-3">
			<div class="container">
				<div class="comments-area">
					<h3>Tu es un enfant ?</h3>
					<form method="POST" action="<?php echo action('account', 'login'); ?>">
						<p>
							<label>Adresse e-mail</label>
							<span>*</span>
							<input type="email" name="email" placeholder="Entre ton adresse email ici" required>
						</p>
						<p>
							<label>Mot de passe</label>
							<span>*</span>
							<input type="password" name="password" placeholder="Indique ton mot de passe l&agrave;" required>
						</p>
						<p>
							<label class="btn1 btn2 btn-8 btn-8c"><input type="submit" name="login-child" value="Valider"></label>
						</p>
					</form>
					<br />
				</div>
			</div>
		</div>

		<div class="col-sm-2"></div>

	</div>

	<div class="row">
		<div class="col-sm-5"></div>
		<div class="col-md-4">
			<div class="container">
				<div class="comments-area">
					<h4><a href="<?php echo action('account', 'register'); ?>">Pas encore de compte ?</a></h4>
					<br/><br/>
				</div>
			</div>
		</div>
		<div class="col-sm-3"></div>
	</div>