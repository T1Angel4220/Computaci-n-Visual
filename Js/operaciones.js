class Suma{
    constructor(numero1, numero2){
        this.numero1 = numero1;
        this.numero2 = numero2;
    }

    sumarNumeros(){
        return this.numero1 + this.numero2;
    }

}

function sumadeNumeros(){
    var num1 = parseInt(document.getElementById("txtPrimerN").value);
    var num2 = parseInt(document.getElementById("txtSegundoN").value);
    //var suma = num1 + num2;
    var obj = new Suma(num1, num2);
    document.getElementById("Total").innerText="La suma es: " + obj.sumarNumeros();
}