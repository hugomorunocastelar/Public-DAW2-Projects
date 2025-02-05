package com.daw2.aprende.models.dto;

import com.daw2.aprende.models.entity.Persona;
import lombok.*;

import java.util.ArrayList;
import java.util.List;

@NoArgsConstructor
@AllArgsConstructor
@Getter
@Setter
@ToString
public class PersonaDTO {
    private int id;
    private String nif;
    private String nombre;
    private String apellido1;
    private String apellido2;

    public static PersonaDTO from(Persona entity)
    {
        PersonaDTO dto = null;
        if (entity != null)
        {
            dto = new PersonaDTO();
            dto.setId(entity.getId());
            dto.setNif(entity.getNif());
            dto.setNombre(entity.getNombre());
            dto.setApellido1(entity.getApellido1());
            dto.setApellido2(entity.getApellido2());
        }
        return dto;
    }

    public static List<PersonaDTO> from(List<Persona> list)
    {
        List<PersonaDTO> dtos = null;
        if(list != null)
        {
            dtos = new ArrayList<>();
            for (Persona persona : list)
            {
                dtos.add(from(persona));
            }
        }
        return dtos;
    }

    public Persona to()
    {
        Persona entity = new Persona();
        entity.setId(id);
        entity.setNif(nif);
        entity.setNombre(nombre);
        entity.setApellido1(apellido1);
        entity.setApellido2(apellido2);
        return entity;
    }


}
