<?php
/**
 * Created by PhpStorm.
 * User: shady
 * Date: 12/25/18
 * Time: 8:38 PM
 */
// Check if the form was submitted
include("SfsApplication.php");
$app = new SfsApplication();
$app->authenticate();
$fm = $app->getFm();
$uploadDir = $fm->getDatedFolder();
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Check if file was uploaded without errors
    if(isset($_FILES["file"]) && $_FILES["file"]["error"] == 0){
        $allowed = $fm->getAllowedFiles();
        $filename = $_FILES["file"]["name"];
        $filetype = $_FILES["file"]["type"];
        $filesize = $_FILES["file"]["size"];
        $random_name = $fm->randomName() . "." . pathinfo($filename, PATHINFO_EXTENSION);;
        // Verify file extension
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        if(!array_key_exists($ext, $allowed)) die("Помилка: Оберіть один з дозволених форматів файла.");

        // Verify file size - 5MB maximum
        $maxsize = intval( $fm->getMaxUploadFileSize() ) * 1024 * 1024;
        if($filesize > $maxsize) die("Помилка: Файл надто завеликий.");

        // Verify MYME type of the file
        if(in_array($filetype, $allowed)){
            // Check whether file exists before uploading it
            if(file_exists("{$uploadDir}/" . $random_name)){
                echo $filename . " вже існує.";
            } else{
                move_uploaded_file($_FILES["file"]["tmp_name"], "{$uploadDir}/" . $random_name);
                $fm->createFile($filename, "{$uploadDir}/". $random_name, $fm->getDatedUrl($random_name));
                echo "Файл завантажено успішно.";
            }
        } else{
            echo "Помилка: Проблема при завантаженні файла. Спробуйте ще раз пізніше.";
        }
    } else{
        echo "Error: " . $_FILES["file"]["error"];
    }
}