package com.daw2.viajesclase.models.dto;

import com.daw2.viajesclase.models.entity.ViajeInscripcion;
import com.daw2.viajesclase.models.entity.ViajePago;
import lombok.AllArgsConstructor;
import lombok.Data;
import lombok.NoArgsConstructor;
import org.hibernate.validator.internal.engine.ValidatorImpl;

import java.util.ArrayList;
import java.util.List;

@NoArgsConstructor
@AllArgsConstructor
@Data
public class ViajePagoDTO {

    private long id;
    private ViajeInscripcionDTO viajeInscripcion;
    private Double pago;

    public static ViajePagoDTO from(ViajePago entity)
    {
        ViajePagoDTO dto = null;
        if (entity != null)
        {
            dto = new ViajePagoDTO();
            dto.setId(entity.getId());
            if(entity.getViajeInscripcion() != null)
                dto.setViajeInscripcion(ViajeInscripcionDTO.from(entity.getViajeInscripcion()));
            dto.setPago(entity.getPago());
        }
        return dto;
    }

    public static List<ViajePagoDTO> from(List<ViajePago> list)
    {
        List<ViajePagoDTO> dtos = null;
        if (list != null)
        {
            dtos = new ArrayList<>();
            for (ViajePago entity: list)
            {
                dtos.add(from(entity));
            }
        }
        return dtos;
    }

    public ViajePago to()
    {
        ViajePago entity = new ViajePago();
        entity.setId(id);
        entity.setViajeInscripcion(viajeInscripcion.to());
        entity.setPago(pago);

        return entity;
    }

}
