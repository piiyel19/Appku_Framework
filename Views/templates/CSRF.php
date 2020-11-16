<form method="get" action="<?= $url;?>">
  <input type="text" name="accnt" placeholder="accnt number" />
  <input type="hidden" name="csrf_token" value="<?= $token; ?>" />
  <input type="submit" />
</form>