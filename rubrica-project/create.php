<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./form.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
   
    <title>Document</title>
</head>

<body class="p-3 m-0 border-0 bd-example m-0 border-0 bd-example-position-utils">
<?php


?>

    <div class="container d-flex align-items-center justify-content-center min-vh-100">

        <form class="d-flex flex-column align-items-center border border-2 rounded p-3 custom-form" method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">
            <h1>Inserisci le tue informazioni</h1>
            <label for="file-input" class="cursor-pointer align-self-center">
                <img src="./man-empty-avatar-photo-placeholder-for-social-networks-resumes-forums-and-dating-sites-male-and-female-no-photo-images-for-unfilled-user-profile-free-vector.jpg" width="100px" alt="" id="img-placeholder" role="button" class="rounded-circle">
            </label>
            <input type="hidden" name="MAX_FILE_SIZE" value="10240" id="">
            <input id="file-input" type="file" class="d-none" name="image" />
            <div class="form-field-container">

                <div class="mb-3 d-flex mt-3 gap-3 ">
                    <input type="text" class="form-control" aria-describedby="" placeholder="nome" name="nome">
                    <input type="text" class="form-control" aria-describedby="" placeholder="cognome" name="cognome">
                </div>
                <div class="mb-3 d-flex gap-3">
                    <input type="text" class="form-control" aria-describedby="" placeholder="Società" name="società">
                    <input type="text" class="form-control" aria-describedby="" placeholder="Qualifica" name="qualifica">
                </div>
                <div class="mb-3 d-flex gap-3">
                    <input type="email" class="form-control" aria-describedby="emailHelp" placeholder="email" name="email">
                    <input type="text" class="form-control" placeholder="numero di telefono" name="numero-di-telefono">
                </div>
                <div class="mb-3 d-flex gap-3">
                    <label for="data-di-nascita">Data di nascita</label>
                    <input type="date" class="form-control" name="data-di-nascita" />
                </div>
            </div>
                <button type=" submit" class="btn btn-primary align-self-center">Invia</button>
        </form>
    </div>





   


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>