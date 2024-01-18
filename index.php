<?php
if ($_FILES['file']['name'][0] != '') {
    $file = $_FILES['file'];

    if ($file['error'] !== UPLOAD_ERR_OK) {
        echo new Exception('Ошибка при загрузке файла!');
    }

    try {
        $newFormat = $_POST['newFormat'];
        $info = pathinfo($file['name']);

        $newFile = new Imagick($file['tmp_name']);
        $newFile->setFormat($newFormat);
        $newFile->writeImage($info['filename'] . '.' . $newFormat);

    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

/**
 * @return string[]
 */
function getImageTypes(): array
{
    return ['jpg', 'png', 'tiff',];
}
?>

<!doctype html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
        <link href="style.css" rel="stylesheet">
        <title>Akson</title>
    </head>

    <body>
        <form method="POST"  enctype="multipart/form-data">
            <div class="row col-12" style="margin-left: 1rem">
                <div class="col-3">
                    <label style="color: darkred">Загрузите файл для конвертирования: </label>

                    <div style="margin-top: 1rem">
                        <input name="file" type="file" accept=".jpg, .png, .tiff">
                    </div>
                </div>

                <div class="col-2" style="margin-left: -3rem">
                    <label style="color: darkred"> Выберите формат: </label>

                    <div style="margin-top: 0.5rem">
                        <select class="select-css" name="newFormat">
                            <?php
                            foreach (getImageTypes() as $imageType) {
                                echo "<option value=\"$imageType\"'> $imageType </option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="row col-1" style="margin-left: -8rem">
                    <div style="margin-left: -2rem">
                        <button style="margin-top: 2rem;" class="btn btn-success" type="submit"> Конвертировать </button>
                    </div>
                </div>
            </div>

            <?php if (isset($newFile)) :?>
                <hr>

                <h4 style="margin-top: 2rem; color: darkred"> Файл сконвертирован! </h4>

                <div style="margin-top: 1rem">
                    <a class="btn btn-success" target="_blank" href="<?= $newFile->getImageFilename() ?>"> Открыть файл </a>
                </div>
            <?php endif;  ?>
        </form>
    </body>
</html>
