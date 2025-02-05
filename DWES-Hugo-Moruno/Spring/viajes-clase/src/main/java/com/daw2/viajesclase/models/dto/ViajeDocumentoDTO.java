package com.daw2.viajesclase.models.dto;

import com.daw2.viajesclase.models.entity.ViajeDocumento;
import lombok.AllArgsConstructor;
import lombok.Data;
import lombok.NoArgsConstructor;

import java.util.ArrayList;
import java.util.List;

@NoArgsConstructor
@AllArgsConstructor
@Data
public class ViajeDocumentoDTO {

    private long id;
    private ViajeDTO viaje;
    private String fichero;
    private String titulo;
    private String observaciones;

    public static ViajeDocumentoDTO from(ViajeDocumento entity)
    {
        ViajeDocumentoDTO dto = null;
        if(entity != null)
        {
            dto = new ViajeDocumentoDTO();
            dto.setId(entity.getId());
            if(entity.getViaje() != null)
                dto.setViaje(ViajeDTO.from(entity.getViaje()));
            dto.setFichero(entity.getFichero());
            dto.setTitulo(entity.getTitulo());
            dto.setObservaciones(entity.getObservaciones());
        }
        return dto;
    }

    public static List<ViajeDocumentoDTO> from(List<ViajeDocumento> list)
    {
        List<ViajeDocumentoDTO> dtos = null;
        if(list != null)
        {
            dtos = new ArrayList<>();
            for (ViajeDocumento dto: list)
            {
                dtos.add(from(dto));
            }
        }
        return dtos;
    }

    public ViajeDocumento to()
    {
        ViajeDocumento entity = new ViajeDocumento();
        entity.setId(id);
        entity.setViaje(viaje.to());
        entity.setFichero(fichero);
        entity.setTitulo(titulo);
        entity.setObservaciones(observaciones);
        return entity;
    }

}
