   <div class="grid_4">
		<div class="container">
		  <div class="comments-area">
			<h3>Cr&eacute;e toi vite un compte !</h3>
			<form method="POST" action="<?php echo action('account', 'register'); ?>">
				<p>
					<label>Tu es</label>
					<span>*</span>
					<select name="account-type" id="account-type" class="account-select">
						<option value=""></option>
						<option value="child">Un enfant</option>
						<option value="parent">Un parent</option>
						<option value="teacher">Un professeur</option>
					</select>
				</p>
				
				<div id="parent-mail-container" style="display: none">
					<p>
						<label>Adresse e-mail du parent</label>
						<span>*</span>
						<input id="parent-mail" type="email" value="" required>
					</p>
					<p id="parent-submit" >
						<label class="btn1 btn2 btn-8 btn-8c"><input type="submit" value="Valider"></label>
					</p>
				</div>
				
				<div id="registration-form" style="display: none">
					<p>
						<label>Pr&eacute;nom</label>
						<span>*</span>
						<input name="firstname" type="text" value="" required>
					</p>
					<p>
						<label>Nom</label>
						<span>*</span>
						<input name="lastname" type="text" value="" required>
					</p>
					<p>
						<label>Date de naissance</label>
						<span>*</span>
						<input name="birth" type="text" id="birthDatePicker" required>
					</p>
					<p>
						<label>Adresse e-mail</label>
						<span>*</span>
						<input name="email" type="email" value="" required>
					</p>
					<p>
						<label>Mot de passe</label>
						<span>*</span>
						<input name="password" type="password" value="" required>
					</p>
					<p>
						<label>Confirme ton mot de passe</label>
						<span>*</span>
						<input type="password" value="" required>
					</p>
					<p>
						<label class="btn1 btn2 btn-8 btn-8c"><input type="submit" value="Valider"></label>
					</p>
				</div>
			</form>
		    </div>
		</div>
	</div>

   <script>
	   /*
	   		Initialisation du datepicker
	   */
	   $('#birthDatePicker').datepicker(
		   {
			   changeYear: true,
			   minDate: new Date(1940, 0, 1),
			   maxDate: '-1',
			   defaultDate: new Date(1999, 0, 1)
		   }
	   );

	   /*
	   		Lors de la séléction du type de compte (Enfant, Parent, Professeur),
	   		s'il s'agit d'un enfant, affiche la saisie de l'adresse email du parent,
	   		sinon affiche le formulaire complet.
	   */
	   $('#account-type').change(
		   function () {
			   if ($(this).val() == 'child') {
					$('#parent-mail-container').show();
				   	$('#registration-form').hide();
			   }
			   else if ($(this).val() == 'parent' || $(this).val() == 'teacher') {
				   $('#parent-mail-container').hide();
				   $('#registration-form').show();
			   }
			   else {
				   $('#parent-mail-container').hide();
				   $('#registration-form').hide();
			   }
		   }
	   );

	   /*
	   		Lors de la validation de l'adresse email du parent de la part de l'enfant,
	   		affiche le reste du formulaire.
	    */
	   $('#parent-submit').click(
		   function () {
			   if ($('#parent-mail').is(':valid')) {
				   //Check if parent email exist in database
				   $.get(
					   '/Lapinouss/account/existsParent',
					   {
						   json: '',
						   email: $('#parent-mail').val()
					   },
					   function () {
						   $('#parent-submit').hide();
						   $('#registration-form').show();
					   }
				   )
				   .fail(
					   function () {
						   alert("L'adresse email ne correspond a aucun parent.");
					   }
				   );
			   }
		   }
	   );
   </script>