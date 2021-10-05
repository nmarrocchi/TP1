<form method="post">
<div class="account">
    <label>Login : </label>
    <input type="text" class="form-input" id="login" name="login" value="Admin" required="">
    <label>Mot de passe : </label>
    <input type="text" class="form-input" id="mdp" name="mdp" value="Admin" required="">
</div>
<div class="admin">
    <label>Administrateur : </label>
    <select class="form-input" id="admin" name="admin" required="">
                                                    <option value="1">Oui</option>
                    <option value="0">Non</option>
                                            </select>
</div>
<div class="submit-button">
    <input type="submit" id="save" name="save" class="button" value="Enregistrer">
    <input type="submit" id="suppr_confirm" name="suppr_confirm" class="button" hidden="">
    <input type="button" id="suppr" name="suppr" class="button" value="Supprimer">
    <input type="button" id="cancel" name="cancel" class="button" value="Annuler" hidden="">
</div>
</form>
<script>

</script>