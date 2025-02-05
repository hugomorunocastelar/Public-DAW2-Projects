package com.daw2.aprende.models.dto;

import com.daw2.aprende.models.entity.Proveedor;
import lombok.AllArgsConstructor;
import lombok.Data;
import lombok.NoArgsConstructor;

import java.util.ArrayList;
import java.util.List;

@NoArgsConstructor
@AllArgsConstructor
@Data
public class ProveedorDTO {

    private long id;
    private String nif;
    private String nombre;
    private String apellido1;
    private String apellido2;


    public static ProveedorDTO from(Proveedor entity) {
        ProveedorDTO dto = null;
        if (entity != null) {
            dto = new ProveedorDTO();
            dto.setId(entity.getId());
            dto.setNif(entity.getNif());
            dto.setNombre(entity.getNombre());
            dto.setApellido1(entity.getApellido1());
            dto.setApellido2(entity.getApellido2());

        }
        return dto;
    }

    public static List<ProveedorDTO> from(List<Proveedor> list) {
        List<ProveedorDTO> dtos = null;
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
