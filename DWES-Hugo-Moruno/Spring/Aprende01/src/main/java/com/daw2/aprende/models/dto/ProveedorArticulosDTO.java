package com.daw2.aprende.models.dto;

import com.daw2.aprende.models.entity.Articulo;
import com.daw2.aprende.models.entity.Proveedor;
import lombok.AllArgsConstructor;
import lombok.Data;
import lombok.NoArgsConstructor;

import java.util.ArrayList;
import java.util.List;

@NoArgsConstructor
@AllArgsConstructor
@Data
public class ProveedorArticulosDTO {

    private long id;
    private String nif;
    private String nombre;
    private String apellido1;
    private String apellido2;
    private List<ArticuloDTO> articulos;


    public static ProveedorArticulosDTO from(Proveedor entity) {
        ProveedorArticulosDTO dto = null;
        if (entity != null) {
            dto = new ProveedorArticulosDTO();
            dto.setId(entity.getId());
            dto.setNif(entity.getNif());
            dto.setNombre(entity.getNombre());
            dto.setApellido1(entity.getApellido1());
            dto.setApellido2(entity.getApellido2());
            dto.setArticulos(ArticuloDTO.from(entity.getArticulos()));
        }
        return dto;
    }

    public static List<ProveedorArticulosDTO> from(List<Proveedor> list) {
        List<ProveedorArticulosDTO> dtos = null;
        if (list != null) {
            dtos = new ArrayList<>();
            for (Proveedor proveedor : list) {
                dtos.add(from(proveedor));
            }
        }
        return dtos;
    }

    public Proveedor to() {
        Proveedor entity = new Proveedor();
        entity.setId(id);
        entity.setNif(nif);
        entity.setNombre(nombre);
        entity.setApellido1(apellido1);
        entity.setApellido2(apellido2);
        return entity;
    }


}
