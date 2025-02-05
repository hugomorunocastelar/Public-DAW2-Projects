package com.daw2.viajesclase.models.dto;

import com.daw2.viajesclase.models.entity.Viaje;
import lombok.AllArgsConstructor;
import lombok.Data;
import lombok.NoArgsConstructor;

import java.util.ArrayList;
import java.util.Date;
import java.util.List;

@NoArgsConstructor
@AllArgsConstructor
@Data
public class ViajeDTO {

    private long id;
    private String referencia;
    private String titulo;
    private String slug;
    private Double precio;
    private Integer participantes;
    private Date salida;
    private Date llegada;
    private String foto;
    private String observaciones;
    private Boolean active = true;

    public static ViajeDTO from(Viaje entity)
    {
        ViajeDTO dto = null;
        if(entity != null)
        {
            dto = new ViajeDTO();
            dto.setId(entity.getId());
            dto.setReferencia(entity.getReferencia());
            dto.setTitulo(entity.getTitulo());
            dto.setSlug(entity.getSlug());
            dto.setPrecio(entity.getPrecio());
            dto.setParticipantes(entity.getParticipantes());
            dto.setSalida(entity.getSalida());
            dto.setLlegada(entity.getLlegada());
            dto.setFoto(entity.getFoto());
            dto.setObservaciones(entity.getObservaciones());
            dto.setActive(entity.getActive());
        }
        return dto;
    }

    public static List<ViajeDTO> from(List<Viaje> list) {
        List<ViajeDTO> dtos = null;
        if (list != null) {
            dtos = new ArrayList<>();
            for (Viaje viaje : list) {
                dtos.add(from(viaje));
            }
        }
        return dtos;
    }

    public Viaje to()
    {
        Viaje entity = new Viaje();
        entity.setId(id);
        entity.setReferencia(referencia);
        entity.setTitulo(titulo);
        entity.setSlug(slug);
        entity.setPrecio(precio);
        entity.setParticipantes(participantes);
        entity.setSalida(salida);
        entity.setLlegada(llegada);
        entity.setFoto(foto);
        entity.setObservaciones(observaciones);
        entity.setActive(active);

        return entity;
    }
    
}
