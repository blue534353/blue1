<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.1.0/uicons-bold-straight/css/uicons-bold-straight.css'>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.1.0/uicons-regular-rounded/css/uicons-regular-rounded.css'>
</head>
<style>
body {
background-color: rgb(68, 68, 131);
text-align: center;
font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
}

.one {
padding: 10px;




}

section {
background-color: azure;
padding: 3px;
box-shadow: 1px 1px 1px 1px;
border-radius: 3px;


}

img {
width: 200px;
margin-top: 20px;

}

.ganho {
padding: 50px;
width: 28%;
position: relative;
top: -118px;
left: 270px;
background-color: azure;
text-align: center;


}

.nao {
margin-top: -100px;
padding: 30px;
background-color: azure;


}

button {
    background-color: rgb(143, 174, 183);
width: 188px;
margin-top: 5px;
height: 30px;
text-decoration: none;
font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
}

.a {
text-decoration: none;    

}

.a i {
font-size: 11px;




}

.b {


}

.b i {
font-size: 11px;



}

.c {



}




@media only screen and (max-width: 768px) {
      .class {
        flex-direction: column; /* Empilhar os itens verticalmente em telas menores */
      }
    }

    /* Consulta de Mídia para Telefones Celulares */
    @media only screen and (max-width: 480px) {
      .class section {
        font-size: 16px; /* Ajustar o tamanho da fonte para telas menores */
        padding: 15px; /* Ajustar o preenchimento para telas menores */
      }
    }


</style>




<body>
<section>
    <h2>PAINEL</h2>
</section>    
<div class="class1">
<button class="a"><i class="fi fi-bs-bank"></i> <a href="deposito.html"> DEPOSITO</a></button>
<button class="b"><i class="fi fi-rr-badge-dollar"></i> <a href="saque.html">SAQUE</a></button>
<button class="c"><i class="fi fi-rr-comment-info"></i> <a href="sobre.html">SOBRE</a></button>
</div>



<img src="blue.png" alt="">
    <section style="display: flex;
    justify-content: space-between;
    align-items: center; padding: 15px;"><h5>SALDO</h5><p>R$ 0,00</p></section>
<br>
<section style="background-color:rgb(157, 163, 154) ; display: flex;
justify-content: space-between;
align-items: center; padding: 20px;"><h5>GANHO ACUMULADO</h5><p>R$ 0,00</p></section>
<br>
<section style="background-color: rgb(186, 183, 179);">&copy;BLUE CORPORATION 2024</section>
</div>

</body>
</html>
