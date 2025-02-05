package com.daw2.viajesclase.models.dto;

import com.daw2.viajesclase.models.entity.Cliente;
import com.daw2.viajesclase.models.entity.Viaje;
import com.daw2.viajesclase.models.entity.ViajeInscripcion;
import jakarta.persistence.*;
import lombok.AllArgsConstructor;
import lombok.Data;
import lombok.NoArgsConstructor;
import org.hibernate.annotations.CreationTimestamp;
import org.hibernate.annotations.UpdateTimestamp;

import java.time.Instant;
import java.time.LocalDateTime;
import java.util.ArrayList;
import java.util.List;

@NoArgsConstructor
@AllArgsConstructor
@Data
public class ViajeInscripcionDTO {

    private long id;
    private ViajeDTO viaje;
    private ClienteDTO cliente;
    private Float dto;

    public static ViajeInscripcionDTO from(ViajeInscripcion entity)
    {
        ViajeInscripcionDTO dto = null;
        if(entity != null)
        {
            dto = new ViajeInscripcionDTO();
            dto.setId(entity.getId());
            if(entity.getViaje() != null)
                dto.setViaje(ViajeDTO.from(entity.getViaje()));
            if(entity.getCliente() != null)
                dto.setCliente(ClienteDTO.from(entity.getCliente()));
            dto.setDto(entity.getDto());
        }
        return dto;
    }

    public static List<ViajeInscripcionDTO> from(List<ViajeInscripcion> entities)
    {
        List<ViajeInscripcionDTO> dtos = null;
        if(entities != null)
        {
            dtos = new ArrayList<>();
            for (ViajeInscripcion entity: entities)
            {
                dtos.add(from(entity));
            }
        }
        return dtos;
    }

    public ViajeInscripcion to()
    {
        ViajeInscripcion entity = new ViajeInscripcion();

        entity.setId(id);
        entity.setViaje(viaje.to());
        entity.setCliente(cliente.to());
        entity.setDto(dto);

        return entity;
    }
}
