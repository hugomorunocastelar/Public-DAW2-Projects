package com.daw2.aprende.models.dto;

import com.daw2.aprende.models.entity.Persona;
import lombok.Getter;
import lombok.Setter;
import lombok.ToString;

import java.util.ArrayList;
import java.util.List;

@Getter
@Setter
@ToString
public class PersonaDTO0 {
    private int id;
    private String nombre;
    private String apellido1;
    private String apellido2;

    public PersonaDTO0() {}

    public PersonaDTO0(String nombre, String apellido1, String apellido2) {
        this.nombre = nombre;
        this.apellido1 = apellido1;
        this.apellido2 = apellido2;
    }

    public static PersonaDTO0 from(Persona entity)
    {
        PersonaDTO0 dto = null;
        if (entity != null)
        {
            dto = new PersonaDTO0();
            dto.setId(entity.getId());
            dto.setNombre(entity.getNombre());
            dto.setApellido1(entity.getApellido1());
            dto.setApellido2(entity.getApellido2());
        }
        return dto;
    }

    public static List<PersonaDTO0> from(List<Persona> list)
    {
        List<PersonaDTO0> dtos = null;
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
        entity.setNombre(nombre);
        entity.setApellido1(apellido1);
        entity.setApellido2(apellido2);
        return entity;
    }


}
