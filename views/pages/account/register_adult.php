	<div class="container">
		<div class="comments-area">
			<h3>Inscription</h3>
			<form method="POST" action="<?php echo action('account', 'register'); ?>">
				<p>
					<label>Vous &ecirc;tes</label>
					<span>*</span>
					<select name="permission" class="account-select">
						<option value="parent">Un parent</option>
						<option value="teacher">Un professeur</option>
					</select>
				</p>
				<p>
					<label>Pr&eacute;nom</label>
					<span>*</span>
					<input name="firstname" type="text" placeholder="Votre pr&eacute;nom" required>
				</p>
				<p>
					<label>Nom</label>
					<span>*</span>
					<input name="lastname" type="text" placeholder="Votre nom" required>
				</p>
				<p>
					<label>Adresse e-mail</label>
					<span>*</span>
					<input name="email" type="email" placeholder="nom@domaine.com" required>
				</p>
				<p>
					<label>Mot de passe</label>
					<span>*</span>
					<input name="password" type="password" placeholder="Minimum 8 caract&egrave;res" required>
				</p>
				<p>
					<label>Confirmez votre mot de passe</label>
					<span>*</span>
					<input name="re-password" type="password" placeholder="Re-saisir le m&ecirc;me mot de passe" required>
				</p>
				<p>
					<label class="btn1 btn2 btn-8 btn-8c"><input type="submit" name="register" value="Inscription"></label>
				</p>
			</form>
		</div>
	</div>
