<div class="container">
    <div class="comments-area">
        <h3>Ajouter un enfant</h3>
        <form method="POST" action="<?php echo action('account', 'registerChild'); ?>">
            <p>
                <label>Pr&eacute;nom</label>
                <span>*</span>
                <input name="firstname" type="text" placeholder="Son pr&eacute;nom" required>
            </p>
            <p>
                <label>Nom</label>
                <span>*</span>
                <input name="lastname" type="text" placeholder="Son nom de famille" required>
            </p>
            <p>
                <label>Mot de passe</label>
                <span>*</span>
                <input name="password" type="password" placeholder="Mot de passe avec 6 caract&egrave;res" required>
            </p>
            <p>
                <label>Confirme ton mot de passe</label>
                <span>*</span>
                <input name="re-password" type="password" placeholder="Re-saisir le m&ecirc;me mot de passe" required>
            </p>
            <p>
                <label class="btn1 btn2 btn-8 btn-8c"><input type="submit" name="register" value="Ajouter"></label>
            </p>
        </form>
    </div>
</div>

<script src="scripts/account/register.js"></script>
