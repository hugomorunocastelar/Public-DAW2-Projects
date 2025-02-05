package com.daw2.viajesclase.models.dto;

import com.daw2.viajesclase.models.entity.Cliente;
import lombok.AllArgsConstructor;
import lombok.Data;
import lombok.NoArgsConstructor;

import java.util.ArrayList;
import java.util.Date;
import java.util.List;

@NoArgsConstructor
@AllArgsConstructor
@Data
public class ClienteDTO {
    private long id;
    private String nif;
    private String nombre;
    private String apellido1;
    private String apellido2;
    private Date fecha_nacimiento;
    private String foto;
    private String observaciones;
    private Boolean active = true;

    public static ClienteDTO from(Cliente entity)
    {
        ClienteDTO dto = null;
        if(entity != null)
        {
            dto = new ClienteDTO();
            dto.setId(entity.getId());
            dto.setNif(entity.getNif());
            dto.setNombre(entity.getNombre());
            dto.setApellido1(entity.getApellido1());
            dto.setApellido2(entity.getApellido2());
            dto.setFecha_nacimiento(entity.getFecha_nacimiento());
            dto.setFoto(entity.getFoto());
            dto.setObservaciones(entity.getObservaciones());
            dto.setActive(entity.getActive());
        }
        return dto;
    }

    public static List<ClienteDTO> from(List<Cliente> list) {
        List<ClienteDTO> dtos = null;
        if (list != null) {
            dtos = new ArrayList<>();
            for (Cliente cliente : list) {
                dtos.add(from(cliente));
            }
        }
        return dtos;
    }

    public Cliente to()
    {
        Cliente entity = new Cliente();
        entity.setId(id);
        entity.setNif(nif);
        entity.setNombre(nombre);
        entity.setApellido1(apellido1);
        entity.setApellido2(apellido2);
        entity.setFecha_nacimiento(fecha_nacimiento);
        entity.setFoto(foto);
        entity.setObservaciones(observaciones);
        entity.setActive(active);

        return entity;
    }
}
