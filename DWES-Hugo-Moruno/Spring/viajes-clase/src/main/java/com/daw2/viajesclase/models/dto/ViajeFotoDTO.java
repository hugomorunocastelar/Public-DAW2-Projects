package com.daw2.viajesclase.models.dto;

import com.daw2.viajesclase.models.entity.ViajeFoto;
import jakarta.persistence.*;
import lombok.AllArgsConstructor;
import lombok.Data;
import lombok.NoArgsConstructor;
import org.hibernate.annotations.CreationTimestamp;

import java.time.Instant;
import java.time.LocalDateTime;
import java.util.ArrayList;
import java.util.List;

@NoArgsConstructor
@AllArgsConstructor
@Data
public class ViajeFotoDTO {

    private long id;
    private ViajeDTO viaje;
    private String fichero;
    private String titulo;
    private String observaciones;

    public static ViajeFotoDTO from(ViajeFoto entity)
    {
        ViajeFotoDTO dto = null;
        if(entity != null)
        {
            dto = new ViajeFotoDTO();
            dto.setId(entity.getId());
            if(entity.getViaje() != null)
                dto.setViaje(ViajeDTO.from(entity.getViaje()));
            dto.setFichero(entity.getFichero());
            dto.setTitulo(entity.getTitulo());
            dto.setObservaciones(entity.getObservaciones());
        }
        return dto;
    }

    public static List<ViajeFotoDTO> from(List<ViajeFoto> list)
    {
        List<ViajeFotoDTO> dtos = null;
        if(list != null)
        {
            dtos = new ArrayList<>();
            for (ViajeFoto dto: list)
            {
                dtos.add(from(dto));
            }
        }
        return dtos;
    }

    public ViajeFoto to()
    {
        ViajeFoto entity = new ViajeFoto();

        entity.setId(id);
        entity.setViaje(viaje.to());
        entity.setFichero(fichero);
        entity.setTitulo(titulo);
        entity.setObservaciones(observaciones);

        return entity;
    }

}
