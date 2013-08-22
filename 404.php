<?php
include 'includes/header.php';
?>
    <script language="JavaScript" type="text/javascript">
        var count = 15
        var redirect = "/"
        function countDown() {
            if (count <= 0) {
                window.location = redirect;
            } else {
                count--;
                document.getElementById("timer").innerHTML = " " + count + " "
                setTimeout("countDown()", 1000)
            }
        }
    </script>

    <div class="text-center">
        <div class="alert">
            <strong>ERREUR 404 !!</strong>

            <p>La page que vous souhaitez n'existe pas.</p>
        </div>
        <img border="0" src="./assets/img/404-error.png" width="433" height="346">

        <div class="alert alert-danger">
            <p class="text-info">Vous allez être redigiré sur notre page d'accueil dans <span id="timer"
                                                                                              style="color:red; font-size: 18pt; padding-top: 15px;"><script>countDown();</script></span>
                secondes.
            </p>
        </div>
    </div>
<?php
include 'includes/footer.php';
?>