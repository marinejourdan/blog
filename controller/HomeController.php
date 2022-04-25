 <?php
namespace App\Controller;

class HomeController{

    function displayHome(){
        // Démarrage de la mémoire tampon :
        // (tt ce qui est echo ou HTML en dehors des balise php est "retenu")
        ob_start();
        // On définit des variable, ici un pauvre titre mais
        // pour displayPost il faudra récupérer l'object post
        $title = "testtesttesttesttest";
        // On inclut le template qui correspond à la function (equivalent de echo ;)
        // dedans on peut faire des foreach et echo des variable définie au-dessus
        // On récupère tt ce qui est dans la mémoire tampon et on le colle dans une variable
        include_once ("./view/home.html.php");
        $content=ob_get_clean();

        // Tt revient à la normal à partir d'ici
        // On "affiche" la structure html complète qui se charge de faire un echo $content
        // pour placer le contenu au bon endroit dans le html ;)
        include_once ("./layout.html.php");
    }
}
