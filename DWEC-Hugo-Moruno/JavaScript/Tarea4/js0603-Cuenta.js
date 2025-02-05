class Cuenta
{

    titular = "";                                               //Declaración de atributos
    cantidad = 0.0;
    deuda = 0.0;

    constructor(titular, cantidad)                              //Constructor parametrizado
    {

        this.titular = titular;
        if (cantidad != '')
        {
            this.cantidad = parseFloat(cantidad);
        }

    }
                                                                //GETTERS
    getTitular()
    {
        return this.titular;
    }

    getCantidad()
    {
        return this.cantidad;
    }

    getDeuda()
    {
        return this.deuda;
    }
                                                                //SETTERS
    setTitular(titular)
    {
        this.titular = titular;
    }

    setCantidad(cantidad)
    {
        if(parseFloat(cantidad) >= 0)
        {
            this.cantidad = parseFloat(cantidad);
        }
        else
        {
            console.log("Cantidad no válida.")
        }
    }

    setDeuda(deuda)
    {
        if(parseFloat(deuda > 0))
        {
            this.deuda = parseFloat(deuda) * -1;
        }
        else
        {
            this.deuda = parseFloat(deuda);
        }
    }
                                                                //MÉTODOS ESPECIALES
    ingresar(ingreso)
    {
        if(parseFloat(ingreso) > 0)
        {
            if(this.deuda < 0)
            {
                this.retirar(this.deuda);
            }
            this.cantidad = this.cantidad + parseFloat(ingreso);
        }
    }

    retirar(cantidad)
    {
        if(parseFloat(cantidad) > 0)
        {
            this.cantidad = this.cantidad - parseFloat(cantidad);
            if(this.cantidad < 0)
            {
                this.deuda = this.cantidad;
                this.cantidad = 0;
            }
        }
    }

    pagarDeuda()
    {
        if(this.cantidad >= (this.deuda * -1))
        {
            this.cantidad = this.cantidad + this.deuda;
            this.deuda = 0;
        }
        else
        {
            this.cantidad = this.cantidad + this.deuda;
            this.deuda = this.cantidad;
            this.cantidad = 0;
        }
    }
                                                                //TOSTRING
    toString()
    {
        console.log("Titular: ",this.titular, " Cantidad: ",this.cantidad, " Deuda: ",this.deuda);
    }

}

let c1 = new Cuenta('Hugo', 0.0);                               //PRUEBAS UNITARIAS

c1.setTitular('Mery');
c1.setCantidad(10000);
c1.setDeuda(20);
c1.pagarDeuda();
c1.toString();

let c2 = new Cuenta('Hugo', 10);

c2.setDeuda(20);
c2.pagarDeuda();
c2.toString();

let c3 = new Cuenta('Javi', 5000);

c3.toString();
c3.ingresar(547);
c3.toString();
c3.retirar(1060);
c3.toString();
c3.retirar(5000);
c3.toString();

let c4 = new Cuenta();

c4.setTitular('Marta');
c4.setCantidad('10.20');
c4.toString();
c4.setDeuda(5.10);
c4.pagarDeuda();
c4.toString();