<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Boro Films</title>
    <link rel="stylesheet" href="./styles/miejsca.css">
    <script defer>
        let wybrane = []
        const urlP = new URLSearchParams(window.location.search);
        const id = parseInt(urlP.get('id'));
        console.log(id);

        fetch(`./rezerwacja.php?id=${id}`, {
            method: "GET",
        })
        .then(res => res.json())
        .then(miejsca => {
            tworzenieSiedzen();
            function tworzenieSiedzen(){
                for(let i=1;i<16;i++){
                    let rzad = document.createElement("div")
                    rzad.style.display = "flex"
                    rzad.style.justifyContent = "center"
                    rzad.classList.add("rzad")
                    for(let j=1;j<21;j++){
                        let nr = document.createElement("div")
                        nr.setAttribute("rzad", i)
                        nr.setAttribute("miejsce", j)
                        nr.style.border = "2px solid black"
                        nr.style.width = "60px"
                        nr.style.height = "40px"
                        nr.style.margin = "5px"
                        nr.style.borderRadius = "5px"
                        nr.style.backgroundColor = "white"
                        nr.classList.add("miejsce")
                        nr.addEventListener("click", function(e){
                            console.log(e.target)
                            if(e.target.style.backgroundColor == "white"){
                                e.target.style.backgroundColor = "yellow"
                                wybrane.push({
                                    id: id,
                                    uzytkownik: document.getElementById("uzytkownik").innerHTML,
                                    rzad: e.target.getAttribute("rzad"),
                                    miejsce: e.target.getAttribute("miejsce"),
                                })
                                console.log(wybrane)
                            }else if(e.target.style.backgroundColor == "yellow"){
                                let index=wybrane.findIndex(selection=>{
                                    return selection.rzad == e.target.getAttribute("rzad") && selection.miejsce == e.target.getAttribute("miejsce")
                                })
                                wybrane.splice(index,1)
                                e.target.style.backgroundColor = "white"
                                console.log(wybrane)
                            }
                        })
                        rzad.append(nr)
                    }
                    document.getElementById("miejsca").append(rzad)
                }
            }
            zaznaczZajete(miejsca);
            function zaznaczZajete(miejsca){
            console.log(miejsca)
            for(var i=0;i<miejsca.length;i++){
                console.log(miejsca[i].id_uzytkownika)
                const siema = document.getElementById("miejsca")
                if(miejsca[i].id_uzytkownika == document.getElementById("uzytkownik").innerHTML){
                    siema.children[parseInt(miejsca[i].rzad)-1].children[parseInt(miejsca[i].miejsce)-1].style.backgroundColor="green"
                }else {
                    siema.children[parseInt(miejsca[i].rzad)-1].children[parseInt(miejsca[i].miejsce)-1].style.backgroundColor = "red"
                }
            }
        }
        })

        function wyslij(){
            let a = new FormData()
            a.append('wybrane',JSON.stringify(wybrane))
            if(wybrane.length>0){
                fetch('./dodanarezerwacja.php',{
                    method: 'POST',
                    body: a,
                })
                .then(res => {
                    console.log(res);
                    location.reload();
                })
            }
        }
    </script>
</head>
<body>
    <div id="main">
    <?php 
    if(isset($_SESSION["login"])){
        echo "Wybierz wolne miejsca";
        echo "<div class='nawigacja'>";
        echo "<button onclick='wyslij()' class='przycisk'>Rezerwuj</button>";
        echo "<a href='glowna1.php'><button class='przycisk'>Powrót do strony głównej</button></a>";
        echo "</div>";
        echo "<div class='sala'>";
        echo "<div class='ekran'>ekran</div>";
        echo "<div id='miejsca' style='display: flex, flex-direction: column'></div>";
        echo "<div id='uzytkownik' style='display: none'>".$_SESSION['id']."</div>";
        echo "</div>";
    }else {
        echo "Zaloguj się :)";
        echo "<a href='glowna.php'><button class='przycisk2'>Wróć do strony głównej</button></a>";
    }
    ?>
    </div>
    <footer></footer>
</body>
</html>