import { Component, OnInit } from '@angular/core';
import { ProveedoresService } from './Service/proveedores.service';
import { tap } from 'rxjs';
import { Proveedor } from './Interface/proveedor.interface';
import { DialogService } from 'src/app/shared/services/dialog.service';

@Component({
  selector: 'app-proveedores',
  templateUrl: './proveedores.component.html',
  styleUrls: ['./proveedores.component.css']
})
export class ProveedoresComponent implements OnInit {

  proveedores: Proveedor[] = [];

  constructor(
    private proveedorService: ProveedoresService,
    private dialogService: DialogService
  ) { }

  ngOnInit(): void {

    this.getProveedores();

  }

  getProveedores()
  {
    this.proveedorService.getAll()
      .pipe(
        tap(console.log)
      )
      .subscribe( proveedor => {
          this.proveedores = proveedor;
        }
      )
  }

  borrarProveedor(proveedor: Proveedor)
  {
    this.dialogService.solicitarConfirmacion('Seguro que quiere borrar?', 'Atención!', () => {

      this.proveedorService.borrar(proveedor).subscribe(() => {
        console.log('Eliminada receta');
        this.getProveedores();
      });

    });
  }

}
