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
 /
 Lors de la séléction du type de compte (Enfant, Parent, Professeur),
 s'il s'agit d'un enfant, affiche la saisie de l'adresse email du parent,
 sinon affiche le formulaire complet.
 /
$('#account-type').change(
	function () {
		if ($(this).val() == 'child') {
			$('#parent-mail-container').show();
			$('#registration-form').hide();
			$('#parent-mail').attr('required', true);
		}
		else if ($(this).val() == 'parent' || $(this).val() == 'teacher') {
			$('#parent-mail-container').hide();
			$('#registration-form').show();
			$('#parent-mail').removeAttr('required');
		}
	}
);

/
 Lors de la validation de l'adresse email du parent de la part de l'enfant,
 affiche le reste du formulaire.
 /
$('#parent-submit').click(
	function () {
		if ($('#parent-mail').is(':valid')) {
			//Check if parent email exist in database
			$.post(
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
		else {
			alert("Veuillez saisir une adresse email correcte.");
		}
	}
);
 */