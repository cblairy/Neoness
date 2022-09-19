<div style="background-color:white; width:20%; margin:auto; padding:20px; border-radius:20px">
<?php

echo "<p>$user</p>";
echo "<p>email : $email</p>";
echo "<p>tel : $phone</p>";

?>
<button>Modify your informations</button><br><br>

<a href="delete_account" onclick="return confirm('Are you sure? \nThis action is irreversible')">Delete my account</a>
</div>