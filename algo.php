<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <style>
        h1 {
            font-family: Arial;
            text-align: center;
            color: orange;
        }
    </style>

    <h1>Exercice Php</h1>

    <?php

    // Exercice 1 ----------- variable
    
    $Mavariable = 5;
    echo $Mavariable;
    echo '<br>';
    echo gettype($Mavariable);
    echo '<br>';
    $prenom = 'kylian';
    echo $prenom;
    echo '<br>';
    $foo = false;
    echo gettype($foo);
    echo '<br>';
    echo '<br>';

    // --------------------------
    
    // Exercice 2 - Opérateur 
    

    $prixht = 100;
    $tva = 20;
    $calcultva = ($prixht * $tva) / 100;
    echo $calcultva;
    echo '<br>';
    echo '<br>';
    $a = "bonjour";
    $phrase = "<p>${a}, l'adrarrrr</p>";
    echo $phrase;
    function ma_fonction($a, $b) {
        $result = $a - $b;
        return $result;
    }
    echo ma_fonction(20, 5);

    echo '<br>';
    echo '<br>';

    // --------------------------
    
    // Exercice 3 - Opérateur 
    

    function nombre_arrondis($nombre) {
        $arrondi = round($nombre);
        return $arrondi;
    }
    echo nombre_arrondis(15, 5);
    echo '<br>';
    echo '<br>';

    // --------------------------
    


    function addition($a, $b, $c) {
        $result = $a + $b + $c;
        return $result;
    }

    echo addition(20, 20, 20);

    echo '<br>';
    echo '<br>';

    function moyenne($a, $b, $c) {
        $result = ($a + $b + $c) / 3;
        return $result;
    }

    echo moyenne(20, 20, 20);

    echo '<br>';
    echo '<br>';

    function nbrpositif($a) {
        if($a >= 0) {
            echo "le nombre {$a} est positif";
        } else
            echo "le nombre {$a} est negatif";
    }

    echo nbrpositif(-30);

    echo '<br>';
    echo '<br>';

    function nbrplsgrand($a, $b, $c) {
        if($a > $b and $a > $c) {
            echo "{$a} est le plus grand chiffre";
        } elseif($b > $c) {
            echo "{$b} est le plus grand chiffre";
        } else {
            echo "{$c} est le plus grand chiffre";
        }
    }
    echo nbrplsgrand(100, 30, 50);

    echo '<br>';
    echo '<br>';

    function nbrplspetit($a, $b, $c) {
        if($a < $b and $a < $c) {
            echo "{$a} est le plus petit chiffre";
        } elseif($b < $c) {
            echo "{$b} est le plus petit chiffre";
        } else {
            echo "{$c} est le plus petit chiffre";
        }
    }

    echo nbrplspetit(30, 50, 40);

    echo '<br>';
    echo '<br>';



    function agechildren($a) {
        if($a >= 6 and $a <= 7) {
            echo "{$a} est dans la catégorie Poussin";
        } elseif($a >= 8 and $a <= 9) {
            echo "{$a} est dans la catégorie Pupille";
        } elseif($a >= 10 and $a <= 11) {
            echo "{$a} est dans la catégorie Minime";
        } else {
            echo "{$a} est dans la catégorie Cadet";
        }
    }
    agechildren(9);

    echo '<br>';
    echo '<br>';

    /* Exercice 12 : Les boucles Créer un script qui affiche les nombres de 1 -> 5 (méthode echo).*/

    for($i = 1; $i <= 5; $i++) {
        echo $i;
    }

    echo '<br>';
    echo '<br>';


    /* Exercice 13 : Ecrire une fonction qui prend un nombre en paramètre (variable $nbr), et qui ensuite affiche les dix nombres suivants. Par exemple, si la valeur de nbr équivaut à : 17, la fonction affichera les nombres de 18 à 27 (méthode echo). */



    //  Exercice 14 :
    
    function maxTab($tabNumber1) {
        $max = $tabNumber1[0];
        foreach($tabNumber1 as $number) {
            if($max < $number) {
                $max = $number;
            }
        }
        echo "Le nombre maximum dans le tableau est $max";
    }


    //  Exercice 15 :
    
    function minTab($tabNumber) {
        $min = $tabNumber[0];
        foreach($tabNumber as $number) {
            if($min > $number) {
                $min = $number;
            }
        }
        echo "Le nombre maximum dans le tableau est $min";
    }


    minTab([20, 3, 100, 50, 80]);

    echo '<br>';
    echo '<br>';


    //  Exercice 16 : Créer une fonction qui affiche la moyenne du tableau.
    
    function moyenn($tabNumber) {
        $somme = 0;
        $length = 0;
        foreach($tabNumber as $number) {
            $somme += $number;
            $length++;
        }
        $result = $somme / $length;
        echo "la moyenne du tableau est égal à $result";
    }

    moyenn([1, 2, 3]);

    ?>
</body>

</html>