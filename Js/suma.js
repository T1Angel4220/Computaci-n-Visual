function SUMA(){
    var numero1=parseInt(document.getElementById("numero1").value);
    var numero2=parseInt(document.getElementById("numero2").value);

    var total = numero1 + numero2;

    document.getElementById("total").innerText="La suma es " + total;
}


function CALCULOFACTORIAL() {
    var numero = parseInt(document.getElementById("numerofactorial").value);


    // Inicializar la variable para calcular el factorial
    var factorial = 1;

    // Calcular el factorial
    for (var i = 1; i <= numero; i++) {
        factorial *= i;
    }

    // Mostrar el resultado
    document.getElementById("resultado").innerText = 
        "El factorial de " + numero + " es " + factorial;
}

function calcularFibonacci() {
    // Obtener el valor del input
    let limite = parseInt(document.getElementById("limite").value);


    // Generar la serie de Fibonacci
    let serie = [];
    let a = 0, b = 1;

    // Calcular la serie hasta el límite
    while (a <= limite) {
        serie.push(a); // Agregar el número actual a la serie
        let temp = a + b; // Calcular el siguiente número
        a = b; // Actualizar a
        b = temp; // Actualizar b
    }

    // Mostrar la serie
    document.getElementById("resultado").innerText = "Serie de Fibonacci hasta " + limite + ": " + serie.join(", ");
}
