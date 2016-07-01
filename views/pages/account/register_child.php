<div class="container">
    <div class="row">
        <div class="comments-area">
            <h3>Cr&eacute;e toi vite un compte !</h3>
            <form method="POST" action="<?php echo action('account', 'registerChild'); ?>">
                <p>
                    <label>Pr&eacute;nom</label>
                    <span>*</span>
                    <input name="firstname" type="text" placeholder="Ton pr&eacute;nom" required>
                </p>
                <p>
                    <label>Nom</label>
                    <span>*</span>
                    <input name="lastname" type="text" placeholder="Ton nom de famille" required>
                </p>
                <p>
                    <label>Date de naissance</label>
                    <span>*</span>
                    <input name="birth" type="text" id="birthDatePicker" placeholder="Quand est ce que tu es n&eacute;e ?" required>
                </p>
                <p>
                    <label>Nom d'utilisateur</label>
                    <span>*</span>
                    <input name="username" type="text" placeholder="Exemple: mathias.dupont99" required>
                </p>
                <p>
                    <label>Mot de passe</label>
                    <span>*</span>
                    <input name="password" type="password" placeholder="Ton mot de passe avec 6 caract&eacute;res" required>
                </p>
                <p>
                    <label>Confirme ton mot de passe</label>
                    <span>*</span>
                    <input name="re-password" type="password" placeholder="Re-tape ici ton mot de passe" required>
                </p>
                <p>
                    <label class="btn1 btn2 btn-8 btn-8c"><input type="submit" name="register" value="Valider"></label>
                </p>
            </form>
        </div>
    </div>
</div>

<script src="scripts/account/register.js"></script>
