<?php
//explication
//file() => Chaque ligne du fichier est mise dans un array().
//array_rand() => Tire un index au hasard parmi un array que je peux  ensuite utiliser pour faire $array[$index] et donc j' aurais ma ligne au hasard.

$lines = file('dico.txt', /*FILE_IGNORE_NEW_LINES|*/FILE_SKIP_EMPTY_LINES);
$index = array_rand($lines);
//echo $lines[$index];
?>

<html>
<head>
    <title>Jeu de pendu php/ Javascipt</title>
    <link rel=Stylesheet type="text/css" href=stylePendu.css>

<!--mettre dans le php ce code pour preparer la recuperation de la variable enjs-->
<input type="hidden" id="$lines[$index]" name="$lines[$index]"  value= <?php echo $lines[$index]?>/>


    <script language="JavaScript">

    // la rappeler le mot secret(mot aleatoire généré par la fonction php) dans le js comme ceci:
    var motSecret = document.getElementById("$lines[$index]").value;

    var tableauMot=new Array();	// Le tableau qui contient les lettres du mot a trouver
    var tailleMot;				// Le nombre de lettres du mot � trouver
    var coupsManques=0;			// Le nombre de lettres fausses essay�es
    var lettresTrouvees=0;		// Le nombre de lettres trouv�es
    var fini=false;				// true si le jeu est termin�

    tailleMot=motSecret.length;

    // Permet de changer la couleur des touches du clavier
    function changeCouleur(element,couleur){
        element.style.backgroundColor=couleur;
    }

    // Gere tous les traitements a faire lorsqu'on appuie sur une touche
    function proposer(element){

        // Si la couleur de fond est lightgreen, c'est qu'on a déjà essayé - on quitte la fonction
        if(element.style.backgroundColor=="lightGreen" ||fini) return;

        // On récupere la lettre du clavier et on met la touche en lightgreen (pour signaler qu'elle est cliquée)
        var lettre=element.innerHTML;
        changeCouleur(element,"lightGreen");

        // On met la variable trouve à false;
        var trouve=false;

        // On parcours chaque lettre du mot, on cherche si on trouve la lettre sélectionnée au clavier
        for(var i=0; i<tailleMot; i++) {

            // Si c'est le cas :
            if(tableauMot[i].innerHTML==lettre) {
                tableauMot[i].style.visibility='visible';	// On affiche la lettre
                trouve=true;
                lettresTrouvees++;
            }

        }
// Si la lettre n'est pas pr�sente, trouv� vaut toujours false :
        if(!trouve){
            coupsManques++; //compteur de coups manqués
         var pendu= document.getElementById("penduimg");
         pendu.style.marginLeft="-75px";// On change l'image du pendu
//
            // Si on a raté 7 fois :
            if(coupsManques==7){
                alert("Vous avez perdu !");
                for(var i=0; i<tailleMot; i++) tableauMot[i].style.visibility='visible';
                fini=true;
                // on affiche le mot, on fini le jeu
            }
        }
        if(lettresTrouvees==tailleMot){
            alert("Bravo ! Vous avez découvert le mot secret !");
            fini=true;
        }
    }

    </script>



</head>



<body>

    <div id="page">

     <div class=" scenespendu">
         <img  id="penduimg" name="pendu" class="pendu" src="man.png">
     </div>

        <h1>Jeu de pendu</h1>

        <h2>Entrez une lettre gràce au clavier ci-dessous; si elle est dans le mot secret, elle sera affichée mais sinon... la sentence se rapprochera !</h2>

        <table id="clavier">
            <tr>
                <td onclick="proposer(this);" >A</td>
                <td onclick="proposer(this);" >B</td>
                <td onclick="proposer(this);" >C</td>
                <td onclick="proposer(this);" >D</td>
                <td onclick="proposer(this);" >E</td>
                <td onclick="proposer(this);" >F</td>
                <td onclick="proposer(this);" >G</td>
                <td onclick="proposer(this);" >H</td>
                <td onclick="proposer(this);" >I</td>
                <td onclick="proposer(this);" >J</td>
            </tr>
            <tr>
                <td onclick="proposer(this);" >K</td>
                <td onclick="proposer(this);" >L</td>
                <td onclick="proposer(this);" >M</td>
                <td onclick="proposer(this);" >N</td>
                <td onclick="proposer(this);" >O</td>
                <td onclick="proposer(this);" >P</td>
                <td onclick="proposer(this);" >Q</td>
                <td onclick="proposer(this);" >R</td>
                <td onclick="proposer(this);" >S</td>
                <td onclick="proposer(this);" >T</td>
            </tr>
            <tr>
                <td onclick="proposer(this);" >U</td>
                <td onclick="proposer(this);" >V</td>
                <td onclick="proposer(this);" >W</td>
                <td onclick="proposer(this);" >X</td>
                <td onclick="proposer(this);" >Y</td>
                <td onclick="proposer(this);" >Z</td>
            </tr>
        </table>
        <br>
        <a class="lien" href="javascript:location.reload();">Nouvelle partie</a>
        <!--/ce script converti le nombre  du mot aléatoire en tableau ce qui permet d'afficher le nombre de cases à déquate-->
        <table id="mot">
            <tr>
                <script language="javascript">
                    for(var i=0; i<tailleMot; i++) document.write("<td> <p id=\""+i+"\">"+motSecret.charAt(i)+"</p></td>");
                </script>
            </tr>
        </table>


        <script language="javascript">
            for(var i=0; i<tailleMot; i++) tableauMot[i]=document.getElementById(i);
        </script>


    </div>
</body>

</html>

