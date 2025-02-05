package com.daw2.aprende.models.dto;

import com.daw2.aprende.models.entity.Articulo;
import lombok.AllArgsConstructor;
import lombok.Data;
import lombok.NoArgsConstructor;

import java.util.ArrayList;
import java.util.List;

@NoArgsConstructor
@AllArgsConstructor
@Data
public class ArticuloDTO {

    private long id;
    private String referencia;
    private String nombre;
    private String descripcion;

    private ProveedorDTO proveedor;

    public static ArticuloDTO from(Articulo entity) {
        ArticuloDTO dto = null;
        if (entity != null) {
            dto = new ArticuloDTO();
            dto.setId(entity.getId());
            dto.setReferencia(entity.getReferencia());
            dto.setNombre(entity.getNombre());
            dto.setDescripcion(entity.getDescripcion());
            if (entity.getProveedor() != null) {
                dto.setProveedor(ProveedorDTO.from(entity.getProveedor()));
            }
        }
        return dto;
    }

    public static List<ArticuloDTO> from(List<Articulo> list) {
        List<ArticuloDTO> dtos = null;
        if (list != null) {
            dtos = new ArrayList<>();
            for (Articulo articulo : list) {
                dtos.add(from(articulo));
            }
        }
        return dtos;
    }

    public Articulo to() {
        Articulo entity = new Articulo();
        entity.setId(id);
        entity.setReferencia(referencia);
        entity.setNombre(nombre);
        entity.setDescripcion(descripcion);
        entity.setProveedor(proveedor.to());

        return entity;
    }


}
