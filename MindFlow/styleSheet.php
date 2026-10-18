<?php
session_start();





$s = "

<style>


/////////////////////////////////FONT///////////////////////////////////////////////
@font-face {
    font-family: OstrichSans-Heavy;
    src: url('IMAGES/OstrichSans-Heavy.otf');
 }
 .stereonic-font {
   font-family: OstrichSans-Heavy, sans-serif;
   /* Aggiungi altri attributi di stile qui se necessario */
 }
 @font-face {
    font-family: Metropolis;
    src: url('IMAGES/Metropolis1920-Regular.otf');
 }
 .stereonic-font {
   font-family: Metropolis, sans-serif;
   /* Aggiungi altri attributi di stile qui se necessario */
 }
 @font-face {
    font-family: Nordique;
    src: url('IMAGES/Nordique.otf');
 }
 .stereonic-font {
   font-family: Nordique, sans-serif;
   /* Aggiungi altri attributi di stile qui se necessario */
 }




/////////////////////////////////////BODY////////////////////////////////////////
body{
    width: 100vw;
    height: 100vh;
    margin: 0;
    padding: 0;
}




/*****************BARRA*****************/


#Barra{
    z-index: 1;
    position: fixed;
    display: flex;
    flex-direction: row; 
    justify-content: space-between;
    align-items: center;
    background-color: rgba(38, 38, 38, 1); 
    border-radius: 10px;
    color: white;
    height: 55px;
    width:98%;
    margin: 0 auto;
    margin-top: 0.6%;
    padding: 0;
    margin-left: 1%;


}
#Menu{
    height: 20px;
    margin-left: 20pt;
}
#Menu:hover{
    transform: scale(1.2);
    cursor: pointer;
}
#Titolo{
    margin-left: 25pt;
    /*vertical-align: middle;*/
    font-family: Metropolis;
    font-size: 30pt;
    color: white;
    
}
#Titolo:hover{
    transform: scale(1.05);
    cursor: pointer;
}
/*#Classroom{
    margin-right: 3%;
}*/
#Classroom:hover{
    transform: scale(1.05);
    cursor: pointer;
}
/*#Chat{
    margin-right: 3%;
}*/
#Chat:hover{
    transform: scale(1.05);
}
/*#ProfilePhoto{
    margin-right: 2%;
    
}*/
#ProfilePhoto:hover{
    transform: scale(1.05);
}
img.Barra{
    height: 30px;
    width: 30px;
    padding: 0;
    
}

.search-bar {
    /*margin-right: 5%;
    margin-left: 40%;*/
    height: 20px;
    display: flex;
    align-items: center;
    background-color: #f6f6f6;
    border: 1px solid #ddd;
    border-radius: 14px;
    padding: 8px;
    /*width: auto; /* Personalizza la larghezza */*/
}

.search-input {
    flex: 1;
    border: none;
    outline: none;
    font-family: Nordique;
    font-size: 16px;
    padding: 4px;
}

.search-button {
    background-color: #5A7FD7;
    color: #fff;
    border: none;
    border-radius: 10px;
    cursor: pointer;
    padding: 7px 15px;
    font-size: 14px;
    margin-left: 10px;
}

.search-button:hover {
    background-color: black;
    transition: 0.5s;
}


/*****LATERALE********/ 
#Lateral{
	position: fixed;
    z-index: 3;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: space-evenly;
    width: 15vw;
    height: 60vh;
    margin-left: 1%;
    margin-top: 1.7%;
    margin-right: 4%;
    border-radius: 10px;
    background-color: #262626;
}

#ProfileImageBig{
    width: 120px;
}

#NomeCognome{
    font-family: OstrichSans-Heavy;
    font-size: 18pt;
    color: white;
    margin-top: -10px;
}
#Username{
    font-family: OstrichSans-Heavy;
    font-size: 14pt;
    color: #565656;
    margin-top: -40px;
}
#EditButton{
    font-family: OstrichSans-Heavy;
    font-size: 14pt;
    color: white;
    background-color: #5A7FD7;
    border: none;
    border-radius: 15px;
    width: 2vhpx;
    margin-top: -20px;
}
#EditButton:hover{
    transform: scale(1.05);
    background-color: black;
    transition: 0.5s;
}
#Dati{
    display: flex;
    flex-direction: row;
    align-items: center;
    
}
.AccountDetails{
    margin: 1pt;
    width: calc(50px + 0.5vw);
    height: 7vh;
    background-color: #595959;
    border-radius: 10px;
    font-family: OstrichSans-Heavy;
    font-size: calc(13px + 0.4vw);
    color: white;
    text-align: center;
}
.AccountDetails:hover{cursor: pointer; transform: scale(1.05);}
.hide
{
	display: none;
}



/*******WORKFIELD*********/
#WorkField{
    margin-top: 1.7%;
    margin-left: 2%;
}
#content{
	margin-left: 22vw;
}
.Projects{
    font-family: OstrichSans-Heavy;
    font-size: 24pt;
    color: black;
}

.DatiProject{
    /*font-family: Nordique;*/
    font-size: calc(10px + 0.4vw);
    }

#BOXDati{
    color: white;
    border-radius: 20px;
    text-align: center;
    background-color: rgba(56, 56, 56, 1);
    padding-top: 15px;
    padding-bottom: 15px;
    }
#BOXDati:hover{
    font-size: 23pt;
}
.BOX:hover{
    font-size: calc(15px + 0.7vw);
    cursor: pointer;
}
#TitoloProgetto{
	font-family: OstrichSans-Heavy;
    font-size: calc(15px + 0.5vw);
    padding-bottom: 5px;
    }

.BOX{
    font-family: Nordique;
    word-spacing: -1px;
    Background-color: #D9F2D0;
    border-radius: 20px;
    height: 15vw;
    width: 15vw;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    margin-right: 5vh;
    
    min-width: 17vw;
    min-height: 17vw;
    }
img.UserProject{
    height: 40px;
    width: 40px;
    border-radius: 20px;
    margin-top: 1vh;
    margin-left: 1vh;
}
img.UserProject:hover{
    transform: scale(1.2);
}

.Boxes{
    z-index: 0;
    display: flex;
    flex-direction: row;
    
}
.proj-container{
	width : 100%; 
    height : 40vh; 
    overflow-x : scroll; 
    overflow-y : visible;


}

input[type='submit'] {
	margin-top: 3%;
   /* background-color: #4CAF50; */
    color: white; 
    padding: 1.5vh; 
    border-radius: 20px;
    border: none; /* nessun bordo */
    cursor: pointer; /* cambia il cursore al passaggio del mouse */
    /*width: 50%;  larghezza */
}

input[type='submit']:hover {
   /* opacity: 0.8;  opacità al passaggio del mouse */
}

#chatbox{
	width: 17%;
    max-heigth: 10px;
    background-color: #262626;
    color: white;
    border-radius: 20px;
    position: fixed; /* Posizione fissa */
    right: 10px; /* Allineato a destra */
    top: 120px;* Allineato in basso */
    border: 1px solid #000; /* Bordo della chat box */
    overflow-y: auto; /* Permette lo scorrimento se il contenuto supera l'altezza */
    padding: 10px; /* Padding intorno al testo */
    
}

.slide-out-blurred-left{-webkit-animation:slide-out-blurred-left .6s cubic-bezier(.55,.055,.675,.19) both;animation:slide-out-blurred-left .6s cubic-bezier(.55,.055,.675,.19) both}
@-webkit-keyframes slide-out-blurred-left{0%{-webkit-transform:translateX(0) scaleY(1) scaleX(1);transform:translateX(0) scaleY(1) scaleX(1);-webkit-transform-origin:50% 50%;transform-origin:50% 50%;-webkit-filter:blur(0);filter:blur(0);opacity:1}100%{-webkit-transform:translateX(-1000px) scaleX(2) scaleY(.2);transform:translateX(-1000px) scaleX(2) scaleY(.2);-webkit-transform-origin:100% 50%;transform-origin:100% 50%;-webkit-filter:blur(40px);filter:blur(40px);opacity:0}}@keyframes slide-out-blurred-left{0%{-webkit-transform:translateX(0) scaleY(1) scaleX(1);transform:translateX(0) scaleY(1) scaleX(1);-webkit-transform-origin:50% 50%;transform-origin:50% 50%;-webkit-filter:blur(0);filter:blur(0);opacity:1}100%{-webkit-transform:translateX(-1000px) scaleX(2) scaleY(.2);transform:translateX(-1000px) scaleX(2) scaleY(.2);-webkit-transform-origin:100% 50%;transform-origin:100% 50%;-webkit-filter:blur(40px);filter:blur(40px);opacity:0}}

.slide-in-blurred-left{-webkit-animation:slide-in-blurred-left .6s cubic-bezier(.23,1.000,.32,1.000) both;animation:slide-in-blurred-left .6s cubic-bezier(.23,1.000,.32,1.000) both}
@-webkit-keyframes slide-in-blurred-left{0%{-webkit-transform:translateX(-1000px) scaleX(2.5) scaleY(.2);transform:translateX(-1000px) scaleX(2.5) scaleY(.2);-webkit-transform-origin:100% 50%;transform-origin:100% 50%;-webkit-filter:blur(40px);filter:blur(40px);opacity:0}100%{-webkit-transform:translateX(0) scaleY(1) scaleX(1);transform:translateX(0) scaleY(1) scaleX(1);-webkit-transform-origin:50% 50%;transform-origin:50% 50%;-webkit-filter:blur(0);filter:blur(0);opacity:1}}@keyframes slide-in-blurred-left{0%{-webkit-transform:translateX(-1000px) scaleX(2.5) scaleY(.2);transform:translateX(-1000px) scaleX(2.5) scaleY(.2);-webkit-transform-origin:100% 50%;transform-origin:100% 50%;-webkit-filter:blur(40px);filter:blur(40px);opacity:0}100%{-webkit-transform:translateX(0) scaleY(1) scaleX(1);transform:translateX(0) scaleY(1) scaleX(1);-webkit-transform-origin:50% 50%;transform-origin:50% 50%;-webkit-filter:blur(0);filter:blur(0);opacity:1}}

/****DA RENDRE GUARDABILE*****/
.dropbtn1, .dropbtn2, .dropbtn3, .dropbtn4{
  background-color: #3498DB;
  color: white;
  padding: 10px;
  font-size: 16px;
  border: none;
  cursor: pointer;
}

.dropbtn:hover, .dropbtn:focus {
  background-color: #2980B9;
}

.dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f1f1f1;
  min-width: 160px;
  overflow: auto;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

.dropdown a:hover {background-color: #ddd;}

.show {display: block;}


.reloadbutton{
	background-color: #5A7FD7;
    border: none;
    border-radius: 10px;
    font-family: Nordique;
    font-size: 17pt;
    color: white;
    width: 7vw;
    
}
.reloadbutton:hover{cursor: pointer;}


.Folder:hover{
	transform: scale(1.01);
    cursor: pointer;
}






</style>










";


echo $s
?>
