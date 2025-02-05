import { Proveedor } from "../../proveedores/Interface/proveedor.interface";

export interface Articulo {
    id: Number,
    referencia: string,
    nombre: string,
    descripcion: string,
    proveedor: Proveedor
}